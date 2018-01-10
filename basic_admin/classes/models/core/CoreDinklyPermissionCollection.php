<?php
/**
 * CoreDinklyPermissionCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCoreClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CoreDinklyPermissionCollection extends DinklyDataCollection
{
	public static function getByArrayOfIds($db = null, $perm_ids)
	{
		$peer_object = new DinklyPermission();

		if($db == null) { $db = self::fetchDB(); }

		$clean_ids = array();
		if(!is_array($perm_ids)) { return false; }

		foreach($perm_ids as $id)
		{
			if(is_numeric($id)) { $clean_ids[] = $id; }
		}
		
		$query = $peer_object->getSelectQuery() . " where id in (" . implode(',', $clean_ids) . ")";

		return self::getCollection($peer_object, $query, $db);
	}

	public static function getAll($db = null)
	{
		$peer_object = new DinklyPermission();

		if($db == null) { $db = self::fetchDB(); }
		
		$query = $peer_object->getSelectQuery() . " order by name";

		return self::getCollection($peer_object, $query, $db);
	}

	public static function isUniqueName($db = null, $name)
	{
		$user = new DinklyPermission();

		if($db == null) { $db = self::fetchDB(); }
		
		$query = $user->getSelectQuery() . " where name=" . $db->quote($name);

		$results = $db->query($query)->fetchAll();

		if($results != array() && $results != NULL)
		{
			return false;
		}
		else { return true; }
	}
}

