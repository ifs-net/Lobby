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
 * get all groups
 * 
 * @args['id']		int			id of group 			(optional)
 * @args['offset']	int			offset for dbutil		(optional)
 * @args['numrows']	int			numrows for dbutil		(optional)
 * @args['orderby']	string		sort criteria			(optional)
 * @args['pending']	int			==1 only pending		(optional)
 * @args['count']	int			==1 only count groups	(optional)
 * @args['cat']		int			category id				(optional)
 * @return			array       the categories
 */
function lobby_groupsapi_get($args)
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) {
		return false;
	}
	// Parameters
	$pending = (int)$args['pending'];
	$id      = (int)$args['id'];
	$cat     = (int)$args['cat'];
	$count   = (int)$args['count'];
	if ($id > 0) {
	  	$group = DBUtil::selectObjectByID('lobby_groups',$id);
	  	if (($group['accepted'] == 1) || ($group['uid'] == pnUserGetVar('uid') || SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN))) {
		    $result = $group;
		} else {
			$result = array();
		}
	} else {
	  	$numrows 	= $args['numrows'];
	  	$offset 	= $args['offset'];
	  	$order 	    = $args['orderby'];
	  	if (!isset($order) || ($order == '')) {
            $orderby = 'title ASC';
        } else if ($order == 'latest') {
            $orderby = 'date DESC';
        } else if ($order == 'members') {
            $orderby = 'members DESC';
        }
	  	$table 		= pnDBGetTables();
	  	$column		= $table['lobby_groups_column'];

	  	$users_column = $tables['users_column'];
		$joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
								'join_field'          =>  'uname',			// field in the join table that should be in the result with
	                         	'object_field_name'   =>  'uname',			// ...this name for the new column
	                         	'compare_field_table' =>  'uid',			// regular table column that should be equal to
	                         	'compare_field_join'  =>  'uid');			// ...the table in join_table
		$joinInfo[] = array (	'join_table'          =>  'lobby_categories',	// table for the join
								'join_field'          =>  'title',			// field in the join table that should be in the result with
	                         	'object_field_name'   =>  'categoryname',			// ...this name for the new column
	                         	'compare_field_table' =>  'category',			// regular table column that should be equal to
	                         	'compare_field_join'  =>  'id');			// ...the table in join_table

	  	if ($pending == 1) {
			$where = $column['accepted']." = 0 ";
		} else {
			$where = "(".$column['accepted']." = 1 OR ".$column['uid']." = ".(int)pnUserGetVar('uid').")";
		}
		if ($cat > 0) {
		  	$where.=" AND ".$column['category']." = ".$cat;
		}
		if ($count == 1) {
			$result = DBUtil::selectExpandedObjectCount('lobby_groups',$joinInfo,$where);
		} else {
			$result = DBUtil::selectExpandedObjectArray('lobby_groups',$joinInfo,$where,$orderby,$offset,$numrows);
		}
		return $result;
	}
	return $result;
}

/**
 * get status in a group
 * 
 * @args['group']	object		group
 * @args['uid']		int			user id (optional)
 * @return			int
 *					0 = no member
 * 					1 = member
 *					2 = owner
 */
function lobby_groupsapi_getMemberStatus($args)
{
 	$group = $args['group'];
 	if (!is_array($group)) return 0;
 	$uid = (int)$args['uid'];
 	if (!($uid > 1)) {
	   	if (pnUserLoggedIn()) {
			$uid = pnUserGetVar('uid');
		} else {
			return 0;
		}
	}
	if ($uid == 1) {
		$status = 0;
	} else if ($group['uid'] == $uid) {
	  	$status = 2;
	} else {
		$status = (int)pnModAPIFunc('lobby','members','get',array('uid' => $uid, 'gid' => $group['id'], 'count' => 1));
	}
	return $status;
}

/**
 * Check if a given user id is member of a given group id
 *
 * @args['uid']		int			user id
 * @args['gid']		int			group id
 * @return			boolean
 */
function lobby_groupsapi_isMember($args) {
  	$args['count'] = 1;
	$member_count = pnModAPIFunc('lobby','members','get',$args);
	return ($member_count > 0);
}

/**
 * Accept a group
 *
 * $args['id']		int			group id
 * @return			boolean
 */
function lobby_groupsapi_accept($args)
{
	// Get Parameter
	$id = (int)FormUtil::getPassedValue('id');
	if (!($id > 0)) {
		return false;
	}
	// Load group
	$group = DBUtil::selectObjectByID('lobby_groups',$id);
	// modify if not accepted and loaded and return success
	if (!($group['id'] == $id) || ($group['accepted'] == 1)) {
		return false;
	} else {
		$group['accepted'] = 1;
		return DBUtil::updateObject($group,'lobby_groups');
	}
}

/**
 * Checks if a user is group owner
 *
 * $args['id']			int		group id
 * $args['uid']			int		user id
 * @return				boolean
 */
function lobby_groupsapi_isOwner($args) 
{
  	$id = (int)$args['id'];
  	$uid = (int)$args['uid'];
  	if (!($id > 0) || !($uid > 0)) {
		return false;
	} else {
		$group = DBUtil::selectObjectByID('lobby_groups',$id);
		return ($group['uid'] == $uid);
	}
}

/**
 * Invite a user into a group
 * $args['group']		object	group
 * $args['id']			int		group id
 * $args['uname']		string	username
 * $args['text']		string	optional invitation text
 * @return				boolean + status message
 */
function lobby_groupsapi_invite($args)
{
	$uname = $args['uname'];
	$uid = pnUserGetIDFromName($uname);
	$id = $args['id'];
	$text = $args['text'];
  	$group = $args['group'];
	// check for valid username
	if (!($uid > 1)) {
	  	LogUtil::registerError(_LOBBY_UNAME_NOT_FOUND);
	  	return false;
	} else {
	  	$new_isMember = lobby_groupsapi_isMember(array('uid' => $uid, 'gid' => $id));
	  	$isMember = lobby_groupsapi_isMember(array('uid' => pnUserGetVar('uid'), 'gid' => $id));
	  	if ($new_isMember) {
	  	  	// user already member of group
		    LogUtil::registerError(_LOBBY_USER_ALREADY_MEMBER);
		    return false;
		} elseif (!$isMember) {
	  	  	// inviting user shoul be member of the group he invites another person to
		    LogUtil::registerError(_LOBBY_INVITATIONS_ONLY_MEMBERS);
		    return false;
		} else {
		  	// user already invited?
		  	$where = "gid = '".$id."' AND invited_uid = '".$uid."'";
		  	$res = DBUtil::selectObjectCount('lobby_invitations',$where);
		  	if ($res > 0) {
			    LogUtil::registerError(_LOBBY_USER_ALREADY_INVITED);
			    return false;
			}
		  	// invite user
		  	$obj = array (
		  		'gid' => $id,
		  		'uid' => pnUserGetVar('uid'),
		  		'invited_uid' => $uid,
		  		'text' => $text,
		  		'date' => date("Y-m-d H:i:s",time())
			  );
			$result = DBUtil::insertObject($obj,'lobby_invitations');
			if ($result) {
			  	// send email
			  	Loader::includeOnce('modules/lobby/includes/common_email.php');
				lobby_notify_invitation($group,$uid,pnUserGetVar('uid'),$text);
			  	// register status message
				LogUtil::registerStatus(_LOBBY_USER_INVITED);
			} else {
			  	// register status message
			  	LogUtil::registerError(_LOBBY_USER_INVITATION_ERROR);
			}
		}
	}
}

/**
 * sync group
 *
 * @param	$args['id']		int		group id
 * @return boolean
 */
function lobby_groupsapi_sync($args)
{
  	$id = (int)$args['id'];
  	Loader::includeOnce('modules/lobby/includes/common_groups.php');
  	return lobby_groupsync($id);
}

/**
 * get map code for category
 *
 * @param $args['cat']
 * @param $args['width']
 * @param $args['height']
 * @return string	html code
 */
function lobby_groupsapi_getMapCode($args)
{
  	$cat     = $args['cat'];
  	$width   = $args['width'];
  	$height  = $args['height'];
	$groups  = pnModAPIFunc('lobby','groups','get',array('cat' => $cat));
	Loader::includeOnce('modules/lobby/includes/common_groups.php');
	$code = lobby_buildcoordinates($groups,$width,$height);
	return $code;  
}