<?php
/**
 * BaseAdminController
 *
 * @package    Dinkly
 * @subpackage CoreBaseAdminController
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class BaseAdminController extends Dinkly
{
	/**
	 * Default Constructor
	 *
	 */
	public function __construct()
	{
		//Let's make this accessible across the admin for display of all dates
		$this->date_format = null;

		//We use this for the profile modal
		$this->logged_user = null;

		$this->db = DinklyDataConnector::fetchDB();

		if(DinklyUser::isLoggedIn() && DinklyUser::isMemberOf('admin'))
		{
			$this->logged_user = new DinklyUser($this->db);
			$this->logged_user->init(DinklyUser::getAuthSessionValue('logged_id'));
			$this->date_format = $this->logged_user->getDateFormat() . ' ' . $this->logged_user->getTimeFormat();
			return false;
		}
		else if(Dinkly::getCurrentModule() != 'login')
		{
			$this->loadModule('admin', 'login', 'default', true);
		}

		return true;
	}
}