<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

/**
 * get moderators
 *
 * @args['uid']		int			user id		(optional)
 * @args['gid']		int			group id
 * @args['count']	int			optional == 1 only counting
 * @return			array
 */
function lobby_moderatorsapi_get($args)
{
  	$tables = pnDBGetTables();
  	$column = $tables['lobby_moderators_column'];
  	$table  = 'lobby_moderators';

	$uid    = (int)$args['uid'];
	$gid    = (int)$args['gid'];
	$count  = (int)$args['count'];
	if (!($gid > 0)) {
  	  	LogUtil::registerError(_LOBBY_GROUP_GETMODERATORS_PARAMFAILURE);
		return false;
	} else {
		$where = $column['gid']." = ".$gid."";
		if ($uid > 1) {
			$where.=" AND tbl.".$column['uid']." = ".$uid;
		}
		$joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
								'join_field'          =>  'uname',			// field in the join table that should be in the result with
	                         	'object_field_name'   =>  'uname',			// ...this name for the new column
	                         	'compare_field_table' =>  'uid',			// regular table column that should be equal to
	                         	'compare_field_join'  =>  'uid');			// ...the table in join_table
	    if ($count == 1) {
			$result = (int)DBUtil::selectObjectCount($table,$where);
		} else {
			$result = DBUtil::selectExpandedObjectArray($table,$joinInfo,$where,$orderby,$offset,$numrows);
			if ($uid > 1) {
				$result = $result[0];
			}
		}
	}
	return $result;
}

/**
 * add a moderator to a group
 * 
 * @args['uid']		int			user id
 * @args['gid']		int			group id
 * @return			boolean
 */
function lobby_moderatorsapi_add($args)
{
	$uid = (int)$args['uid'];
	$gid = (int)$args['gid'];
	if (!($uid > 1) || !($gid > 0)) {
  	  	LogUtil::registerError(_LOBBY_GROUP_ADDMODERATOR_FAILURE);
		return false;
	} else {
	  	// get Group
	  	$group = pnModAPIFunc('lobby','groups','get',array('id' => $gid));
	  	if ($group['id'] != $gid) {
	  	  	// Something went wrong, groups not existent or something like that
	  	  	LogUtil::registerError('Group could not be found!');
		    return false;
		} else {
			$obj = array(
				'gid' 	=> $gid, 
				'uid' 	=> $uid
				);
			// Security Check
			if (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN) || ($group['uid'] == pnUserGetVar('uid'))) {
			  	if (lobby_moderatorsapi_isModerator($args)) {
			  	  	LogUtil::registerError(_LOBBY_GROUPS_ALREADY_MOD);
				    return false;
				}
			  	// Insert moderator now into database
				$result = DBUtil::insertObject($obj,'lobby_moderators');
				// Set message
				if ($result) {
					LogUtil::registerStatus(str_replace('%user%', pnUserGetVar('uname',$obj['uid']),_LOBBY_GROUPS_MODERATORADDED));
				} else {
				  	LogUtil::registerError(_LOBBY_GROUPS_MODERATORADDERROR);
				}
			  	
			} else {
				LogUtil::registerError(_LOBBY_GROUP_MODERATORS_ACCESS_DENY);
				return false;
			}
		}
	}
}

/**
 * delete a moderator from a group
 * 
 * @args['uid']		int			user id
 * @args['gid']		int			group id
 * @return			boolean
 */
function lobby_moderatorsapi_del($args)
{
	$uid = (int)$args['uid'];
	$gid = (int)$args['gid'];
	if (!($uid > 1) || !($gid > 0)) {
  	  	LogUtil::registerError(_LOBBY_GROUP_DELMODERATOR_FAILURE);
		return false;
	} else {
	  	// get Group
	  	$group = pnModAPIFunc('lobby','groups','get',array('id' => $gid));
	  	if ($group['id'] != $gid) {
	  	  	// Something went wrong, groups not existent or something like that
	  	  	LogUtil::registerError('Group could not be found!');
		    return false;
		} else {
			// Security Check
			if (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN) || ($group['uid'] == pnUserGetVar('uid'))) {
				if (!lobby_moderatorsapi_isModerator($args)) {
				  	LogUtil::registerError(_LOBBY_GROUP_WAS_NO_MODERATOR);
				  	return false;
				}
				// get moderator
				$moderator = lobby_moderatorsapi_get($args);
				$obj = DBUtil::selectObjectByID('lobby_moderators',$moderator['id']);
				$result = DBUtil::deleteObject($obj,'lobby_moderators');
				if ($result) {
					LogUtil::registerStatus(_LOBBY_GROUPS_MODERATORREMOVED);
				} else {
				  	LogUtil::registerError(_LOBBY_GROUPS_MODERATORDELERROR);
				}
			  	
			} else {
				LogUtil::registerError(_LOBBY_GROUP_MODERATORS_ACCESS_DENY);
				return false;
			}
		}
	}
	return true;
}

/**
 * checks if a user is a moderator
 * 
 * @args['uid']		int			user id
 * @args['gid']		int			group id
 * @return			boolean
 */
function lobby_moderatorsapi_isModerator($args)
{
  	if (!pnUserLoggedIn()) {
	    return false;
	}else {
	  	$args['count'] = 1;
	  	$result = (int)lobby_moderatorsapi_get($args);
		return ($result > 0);
	}
}
