<?php
/**
 * DinklyGroupCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCoreClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CoreDinklyGroupCollection extends DinklyDataCollection
{
	public static function getByArrayOfIds($db = null, $group_ids)
	{
		$peer_object = new DinklyGroup();

		if($db == null) { $db = self::fetchDB(); }

		$clean_ids = array();
		if(!is_array($group_ids)) { return false; }

		foreach($group_ids as $id)
		{
			if(is_numeric($id)) { $clean_ids[] = $id; }
		}
		
		$query = $peer_object->getSelectQuery() . " where id in (" . implode(',', $clean_ids) . ")";

		return self::getCollection($peer_object, $query, $db);
	}

	public static function getAll($db = null)
	{
		$peer_object = new DinklyGroup();

		if($db == null) { $db = self::fetchDB(); }
		
		$query = $peer_object->getSelectQuery() . " order by name";

		return self::getCollection($peer_object, $query, $db);
	}

	public static function isUniqueName($db = null, $name)
	{
		$user = new DinklyGroup();

		if($db == null) { $db = self::fetchDB(); }
		
		$query = $user->getSelectQuery() . " where name=" . $db->quote($name);

		$results = $db->query($query)->fetchAll();

		if($results != array() && $results != NULL)
		{
			return false;
		}
		else { return true; }
	}

	public static function isUniqueAbbreviation($db = null, $abbr)
	{
		$user = new DinklyGroup();

		if($db == null) { $db = self::fetchDB(); }
		
		$query = $user->getSelectQuery() . " where abbreviation=" . $db->quote($abbr);

		$results = $db->query($query)->fetchAll();

		if($results != array() && $results != NULL)
		{
			return false;
		}
		else { return true; }
	}
}

