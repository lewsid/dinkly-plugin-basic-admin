<?php
/**
 * AdminUserController
 *
 * @package    Dinkly
 * @subpackage AppsDinklyUserController
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class AdminUserController extends BaseAdminUserController
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Load default view
	 *
	 * This is an example of how to add custom functionality to the load functions in the base controller
	 *
	 * @return bool: always returns true on successful construction of view
	 *
	 */
	public function loadDefault($parameters = array())
	{
		parent::loadDefault();

		return true;
	}
}