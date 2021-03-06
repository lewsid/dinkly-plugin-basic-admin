<?php
/**
 * CoreDinklyUser
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCoreClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CoreDinklyUser extends BaseDinklyUser
{
	protected $groups = array();

	//Assumes email addresses are being used for usernames
	public function initWithEmail($email)
	{
		if(!$this->db) { throw New Exception("Unable to perform init without a database object"); }

		$query = $this->getSelectQuery() . " where username=" . $this->db->quote($email);
		$result = $this->db->query($query)->fetchAll();
				
		if($result != array())
		{
			$this->hydrate($result, true);
			return true;
		}
		
		return false;
	}

	protected function convertDate($format = null, $datetime)
	{
		if($format)
		{
			if($datetime == '0000-00-00 00:00:00' || !$datetime)
			{
				return null;
			}

			return date($format, strtotime($datetime));
		}

		return $datetime;
	}

	public function getDateFormat()
	{
		if(!$this->DateFormat)
		{
			return 'm/d/y';
		}
		else { return $this->DateFormat; }
	}

	public function getTimeFormat()
	{
		if(!$this->TimeFormat)
		{
			return 'H:i:s';
		}
		else { return $this->TimeFormat; }
	}

	public function getCreatedAt($format = null, $timezone = null)
	{
		if($this->CreatedAt != '' && $this->CreatedAt != null && $this->CreatedAt != '0000-00-00 00:00:00')
		{
			if(!$format) { $format = 'Y-m-d G:i:s'; }
		
			$date = new DateTime($this->CreatedAt);

			if(!$timezone)
			{
				$date->setTimezone(new DateTimeZone('America/New_York'));
			}
			else
			{
				$date->setTimezone(new DateTimeZone($timezone));
			}

			return $date->format($format);
		}
		else
		{
			return null;
		}
	}

	public function getUpdatedAt($format = null, $timezone = null)
	{
		if($this->UpdatedAt != '' && $this->UpdatedAt != null && $this->UpdatedAt != '0000-00-00 00:00:00')
		{
			if(!$format) { $format = 'Y-m-d G:i:s'; }
		
			$date = new DateTime($this->UpdatedAt);

			if(!$timezone)
			{
				$date->setTimezone(new DateTimeZone('America/New_York'));
			}
			else
			{
				$date->setTimezone(new DateTimeZone($timezone));
			}

			return $date->format($format);
		}
		else
		{
			return null;
		}
	}

	public function getLastLoginAt($format = null, $timezone = null)
	{
		if($this->LastLoginAt != '' && $this->LastLoginAt != null && $this->LastLoginAt != '0000-00-00 00:00:00')
		{
			if(!$format) { $format = 'Y-m-d G:i:s'; }
		
			$date = new DateTime($this->LastLoginAt);

			if(!$timezone)
			{
				$date->setTimezone(new DateTimeZone('America/New_York'));
			}
			else
			{
				$date->setTimezone(new DateTimeZone($timezone));
			}

			return $date->format($format);
		}
		else
		{
			return null;
		}
	}

	public function getGroups()
	{
		if($this->groups == array())
		{
			$this->groups = DinklyUserGroupCollection::getGroupsByUser($this->db, $this->getId());
		}

		return $this->groups;
	}

	public function delete()
	{
		$group_ids = array();
		$groups = $this->getGroups();

		if($groups != array())
		{
			foreach($groups as $group)
			{
				$this->removeFromGroup($group->getId());
			}
		}

		parent::delete();
	}

	public function removeFromGroup($group_id)
	{
		$group = new DinklyGroup();
		$group->init($group_id);

		//If the group isn't new, that means it exists, which is a good thing
		if(!$group->isNew())
		{
			$group_join = new DinklyUserGroup();
			$group_join->initWithUserAndGroup($this->getId(), $group_id);
			
			if(!$group_join->isNew())
			{
				$group_join->delete();

				return true;
			}
		}

		return false;
	}

	public function addToGroups($group_ids)
	{
		if($group_ids != array())
		{
			foreach($group_ids as $id)
			{
				$group = new DinklyGroup();
				$group->init($id);

				//If the group isn't new, that means it exists, which is a good thing
				if(!$group->isNew())
				{
					//Make sure this join record doesn't already exist first
					$group_join = new DinklyUserGroup();
					$group_join->initWithUserAndGroup($this->getId(), $id);
					
					if($group_join->isNew())
					{
						$group_join->setDinklyUserId($this->getId());
						$group_join->setDinklyGroupId($id);
						$group_join->save();
					}
				}
			}

			return true;
		}

		return false;
	}

	public static function isMemberOf($group_abbreviation)
	{
		if(static::getLoggedGroups() != array())
		{
			foreach(static::getLoggedGroups() as $group)
			{
				if($group['abbreviation'] == $group_abbreviation)
				{
					return true;
				}
			}
		}
	}

	public static function hasPermission($permission_name)
	{
		if(static::getLoggedPermissions() != array())
		{
			foreach(static::getLoggedPermissions() as $permission)
			{
				if($permission['name'] == $permission_name)
				{
					return true;
				}
			}
		}
	}

	/**
	 * Set password of admin user
	 *
	 * @param string $password: password you wish to set for admin user
	 *
	 * 
	 */
	public function setPassword($password)
	{
		if (function_exists('password_hash'))
			$this->Password = password_hash($password, PASSWORD_DEFAULT);
		else
			$this->Password = crypt($password);

		$this->regDirty['password'] = true;
	}

	public function sendSetPasswordEmail()
	{
		$link = Dinkly::getConfigValue('current_app_url', 'admin') . "/admin/login/reset_password/k/" . $this->getAutoLoginHash();

		$to      = $this->getUsername();
		$subject = "Reset Password";
		$message = "Here's the link to reset your password: " . $link;
		$headers = 'From: webmaster@example.com' 
			. "\r\n" . 'Reply-To: webmaster@example.com' 
			. "\r\n" . 'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);

		return true;
	}

	/**
	 * Check Dinkly session to see if admin user is logged in
	 *
	 * 
	 * @return bool true if logged in, false if not
	 */
	public static function isLoggedIn($app = null)
	{
		if(static::getAuthSessionValue('logged_in', $app)) { return true; }
		return false;
	}

	public static function getAuthSessionValue($key, $app = null)
	{
		if(!$app) { $app = Dinkly::getCurrentAppName(); }

		if(!isset($_SESSION['dinkly']['auth'])) { $_SESSION['dinkly']['auth'] = array(); }

		if(!isset($_SESSION['dinkly']['auth'][$app]))
		{
			$_SESSION['dinkly']['auth'][$app] = array();
		}

		if(isset($_SESSION['dinkly']['auth'][$app][$key]))
		{ 
			return $_SESSION['dinkly']['auth'][$app][$key];
		}

		return false;
	}

	public static function setAuthSessionValue($key, $value, $app = null)
	{
		if(!$app)
		{
			$app = Dinkly::getCurrentAppName();
		}
		
		if(!isset($_SESSION['dinkly']['auth'][$app]))
		{
			$_SESSION['dinkly']['auth'][$app] = array();
		}
		$_SESSION['dinkly']['auth'][$app][$key] = $value;
	}

	/**
	 * Retrieve all objects matching array of passed property/value pairs
	 *
	 * @param bool $is_logged_in: set true to log in admin user
	 * @param int $user_id: userid to set logged in
	 * @param string $username: username of logged in user
	 * @param array $groups: groups user has access to
	 * @param string $app: set explicit app to authenticate against
	 * @param boolean $auth_all_apps: log user into all apps
	 * @param string $username: username of admin user to set sessions
	 * 
	 */
	public static function setLoggedIn($is_logged_in, $user_id, $username, $groups = array(), $app = null, $auth_all_apps = false)
	{
		if(!$app) $app = Dinkly::getCurrentAppName();

		$apps = Dinkly::getValidApps();

		//If set, we'll set the user logged in for each app, overrides explicit app being passed
		if($auth_all_apps)
		{
			if($apps != array())
			{
				foreach($apps as $a)
				{
					static::setAuthSessionValue('logged_in', $is_logged_in, $a);
					static::setAuthSessionValue('logged_username', $username, $a);
					static::setAuthSessionValue('logged_id', $user_id, $a);
				}
			}
		}
		else
		{
			static::setAuthSessionValue('logged_in', $is_logged_in, $app);
			static::setAuthSessionValue('logged_username', $username, $app);
			static::setAuthSessionValue('logged_id', $user_id, $app);
		}

		if($groups != array())
		{
			$logged_groups = array();
			$logged_permissions = array();

			foreach($groups as $group)
			{
				$logged_groups[] = array('id' => $group->getId(), 'abbreviation' => $group->getAbbreviation());

				$permissions = $group->getPermissions();

				if($permissions != array())
				{
					foreach($permissions as $permission)
					{
						$logged_permissions[] = array('id' => $permission->getId(), 'name' => $permission->getName());
					}
				}
			}

			if($auth_all_apps)
			{
				if($apps != array())
				{
					foreach($apps as $a)
					{
						static::setAuthSessionValue('logged_groups', $logged_groups, $a);
						static::setAuthSessionValue('logged_permissions', $logged_permissions, $a);
					}
				}
			}
			else
			{
				static::setAuthSessionValue('logged_groups', $logged_groups, $app);
				static::setAuthSessionValue('logged_permissions', $logged_permissions, $app);
			}
		}
	}

	/**
	 * Check Dinkly session to get username of admin that is logged in
	 *
	 * 
	 * @return mixed string | bool: string username if logged in, else false
	 */
	public static function getLoggedUsername()
	{
		return static::getAuthSessionValue('logged_username');
	}

	public static function getLoggedGroups()
	{
		return static::getAuthSessionValue('logged_groups');
	}

	public static function getLoggedPermissions()
	{
		return self::getAuthSessionValue('logged_permissions');
	}

	public static function getLoggedId()
	{
		return static::getAuthSessionValue('logged_id');
	}

	public static function formatOffset($offset)
	{
        $hours = $offset / 3600;
        $remainder = $offset % 3600;
        $sign = $hours > 0 ? '+' : '-';
        $hour = (int) abs($hours);
        $minutes = (int) abs($remainder / 60);

        if ($hour == 0 AND $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');

	}

	/**
	 * Clear Dinkly session variables to log out user
	 * 
	 */
	public static function logout()
	{	
		$_SESSION['dinkly']['auth'][Dinkly::getCurrentAppName()] = null;
	}

	/**
	 * Broken out here for easy overriding. Send off to be authenticated
	 *
	 * @param int $user_id: userid to set logged in
	 * @param string $username: username of logged in user
	 * @param array $groups: groups user has access to
	 * 
	 * @return bool: true if correct credentials and logged on, false otherwise
	 */
	public static function handleLogin($user_id, $username, $groups)
	{
		static::setLoggedIn(true, $user_id, $username, $groups);
	}

	/**
	 * Verify with database the user credentials are correct and log in if so
	 * 
	 *
	 * @param string $username: input username of user attempting to log in
	 * @param string $input_password: input password of user attempting to log in
	 * 
	 * @return bool: true if correct credentials and logged on, false if not, false if inside brute-force cooldown
	 */
	public static function authenticate($username, $input_password)
	{
		$dbo = static::fetchDB();

		$sql = "select * from dinkly_user where username=".$dbo->quote($username);
		$result = $dbo->query($sql)->fetchAll();

		//We found a match for the username      
		if($result != array())
		{
			$user = new DinklyUser();
			$user->init($result[0]['id']);

			//Check for brute forcing attempt
			$fail_count = $user->getFailedLoginCount();
			$last_attempt_time = strtotime($user->getLastFailedLoginAt());
			$seconds_since_last_attempt = time() - $last_attempt_time;

			//For every 5 failed attempts, we double the cooldown period
			//Example: 10 failures = 120 seconds, 15 failures = 240 seconds, 20 failures = 480 seconds
			$cooldown = 60;
			if($fail_count >= 10)
			{
				$multiplier = floor($fail_count / 5);
				
				for($i = 1; $i <= $multiplier; $i++)
				{
					if($i > 1)
					{
						$cooldown = $cooldown * 2;
					}
				}
			}

			//Before we even check the password, make sure we're not in the cooldown window
			if(($fail_count % 5 == 0) && $seconds_since_last_attempt <= $cooldown)
			{
				$user->setIsLocked(true);
				$user->save();

				return false;
			}
			
			//The user is outside the initial brute-force cool down window or has less than 5 failed attempts
			$hashed_password = $result[0]['password'];

			if(function_exists('password_verify'))
			{
				$valid_password = password_verify($input_password, $hashed_password) == $hashed_password;
			}
			else
			{
				$valid_password = crypt($input_password, $hashed_password) == $hashed_password;
			}

			if($valid_password)
			{
				$count = $user->getLoginCount() + 1;

				$user->setFailedLoginCount(0);
				$user->setLastLoginAt(date('Y-m-d G:i:s'));
				$user->setLoginCount($count);
				$user->setIsLocked(false);
				$user->save();

				static::handleLogin($result[0]['id'], $result[0]['username'], $user->getGroups());

				return true;
			}
			else
			{
				//User authentication failed
				$fail_count = $user->getFailedLoginCount();
				$fail_count++;
				$user->setFailedLoginCount($fail_count);
				$user->setLastFailedLoginAt(date('Y-m-d G:i:s'));
				$user->save();

				return false;
			}
		}

		return false;
	}
}