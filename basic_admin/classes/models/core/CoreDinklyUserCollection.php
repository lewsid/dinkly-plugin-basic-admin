<?php
/**
 * CoreDinklyUserCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCoreClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CoreDinklyUserCollection extends DinklyDataCollection
{
	public static function isUniqueUsername($db = null, $username)
	{
		$user = new DinklyUser();

		if($db == null) { $db = self::fetchDB(); }
		
		$query = $user->getSelectQuery() . " where username=" . $db->quote($username);

		$results = $db->query($query)->fetchAll();

		if($results != array() && $results != NULL)
		{
			return false;
		}
		else { return true; }
	}

	public static function getByArrayOfIds($db = null, $user_ids)
	{
		$peer_object = new DinklyUser();

		if($db == null) { $db = self::fetchDB(); }

		$clean_ids = array();
		if(!is_array($user_ids)) { return false; }

		foreach($user_ids as $id)
		{
			if(is_numeric($id)) { $clean_ids[] = $id; }
		}
		
		$query = $peer_object->getSelectQuery() . " where id in (" . implode(',', $clean_ids) . ")";

		return self::getCollection($peer_object, $query, $db);
	}

	public static function getTotalUserCount($db = null)
	{
		if($db == null) { $db = self::fetchDB(); }

		$query = "select count(*) as num from dinkly_user";

		$results = $db->query($query)->fetchAll();

		return $results[0]['num'];
	}

	public static function getTotalLockedCount($db = null)
	{
		if($db == null) { $db = self::fetchDB(); }

		$query = "select count(*) as num from dinkly_user where is_locked = 1";

		$results = $db->query($query)->fetchAll();

		return $results[0]['num'];
	}

	public static function getTodayLoginCount($db = null)
	{
		if($db == null) { $db = self::fetchDB(); }

		$query = "select count(*) as num from dinkly_user where last_login_at > '" . date('Y-m-d') . "'";

		$results = $db->query($query)->fetchAll();

		return $results[0]['num'];
	}
}