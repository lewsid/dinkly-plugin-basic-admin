<?php
/**
 * BaseAdminHomeController
 *
 * @package    Dinkly
 * @subpackage BaseAdminHomeHomeController
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class BaseAdminHomeController extends AdminController 
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Loads default admin home page using headers
	 * 
	 * @return bool: always returns true on successful construction of default admin home view
	 * 
	 */
	public function loadDefault($parameters = array())
	{
		$this->total_users = DinklyUserCollection::getTotalUserCount($this->db);
		$this->locked_accounts = DinklyUserCollection::getTotalLockedCount($this->db);
		$this->logins_today = DinklyUserCollection::getTodayLoginCount($this->db);

		return true;
	}
}