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
 * get members of a group
 *
 * $args['uid']		int			user id		(optional)
 * $args['gid']		int			group id
 * $args['count']	int			optional == 1 only counting
 * $args['pending']	int			optional == 1 show pending members
 * $args['online']	int			optional == 1 only users that are online now
 * $args['offset']	int			optional
 * $args['numrows']	int			optional
 * $args['showall']	int			optional ==1 if all groups should be used (index page e.g.)
 * $args['groupinformation']	int			optional ==1 if group information should be added to result
 * $args['sort']	string		sort criteria
 * @return			array
 */
function lobby_membersapi_get($args)
{
  	// Get Tables
  	$tables = pnDBGetTables();
  	$pending = (int)$args['pending'];
  	if ($pending == 1) {
	  	$column = $tables['lobby_members_pending_column'];
	  	$table = 'lobby_members_pending';
	} else {
	  	$column = $tables['lobby_members_column'];
	  	$table = 'lobby_members';
	}
	// Get Parameters
	$uid 		= (int)$args['uid'];
	$gid 		= (int)$args['gid'];
	$count 		= (int)$args['count'];
	$showall 	= (int)$args['showall'];
	$online 	= (int)$args['online'];
	$groupinformation = (int)$args['groupinformation'];
	if (!($gid > 0) && ($showall != 1)) {
//  	  	LogUtil::registerError(_LOBBY_GROUP_GETMEMBERS_PARAMFAILURE);
		return false;
	} else {
	  	// Cache function
	  	static $lobbyCacheMembers;
	    $varName = "x";
	    if ($pending == 1) 	$varName.= "p";
	    if ($count == 1) 	$varName.= "c";
	    if ($uid > 1) 		$varName.="u".$uid."u";
	    if ($showall == 1) 	$varName.="s";
	    if ($online == 1) 	$varName.="o";
	    if ($groupinformation = 1) $varName.="g";
	  	if (isset($lobbyCacheMembers)) {
	  	  	if (isset($lobbyCacheMembers[$varName])) {
					return $lobbyCacheMembers[$varName];
				}
		}
		// Start to build sql statement
		if ($showall == 0) $where = $column['gid']." = ".$gid."";
		if ($uid > 1) {
			$where.=" AND tbl.".$column['uid']." = ".$uid;
		}
	  	$users_column = $tables['users_column'];
		$joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
								'join_field'          =>  'uname',			// field in the join table that should be in the result with
	                         	'object_field_name'   =>  'uname',			// ...this name for the new column
	                         	'compare_field_table' =>  'uid',			// regular table column that should be equal to
	                         	'compare_field_join'  =>  'uid');			// ...the table in join_table
		if ($groupinformation == 1) {
			$joinInfo[] = array (	'join_table'          =>  'lobby_groups',			// table for the join
									'join_field'          =>  array('title','description','members','articles','forums','topics','postings','moderated','accepted','last_action','category','coordinates'),			// field in the join table that should be in the result with
		                         	'object_field_name'   =>  array('title','description','members','articles','forums','topics','postings','moderated','accepted','last_action','category','coordinates'),			// ...this name for the new column
		                         	'compare_field_table' =>  'gid',			// regular table column that should be equal to
		                         	'compare_field_join'  =>  'id');			// ...the table in join_table
		}
		// online (optional)
		if ($online == 1) {
			$idletime = (pnConfigGetVar('secinactivemins') * 60);
	
			// join information because we need the join to the sessions table
			$joinInfo[] = array (	'join_table'          =>  'session_info',	// table for the join
									'join_field'          =>  'lastused',			// field in the join table that should be in the result with
		                         	'object_field_name'   =>  'session_uid',	// ...this name for the new column
		                         	'compare_field_table' =>  'uid',				// regular table column that should be equal to
		                         	'compare_field_join'  =>  'uid');			// ...the table in join_table
	
		    $sess_column 	= &$tables['session_info_column'];
		    $where.= " AND ".$sess_column['lastused']." > '".date("Y-m-d H:i:s",(time()-$idletime))."'";
		}
	    if (($count == 1) && ($online != 1)) {
			$result = DBUtil::selectObjectCount($table,$where);
		} elseif (($count == 1) && ($online != 1)) {
			$result = DBUtil::selectExpandedObjectCount($table,$joinInfo,$where);
		} else {
		  	$offset = $args['offset'];
		  	$numrows = $args['numrows'];
		  	$sort = $args['sort'];
		  	if ($sort == 'latest') {
				$orderby = "tbl.".$column['id']." DESC";
			} else {
				$orderby = "a.".$users_column['uname']." ASC";
			}
			$result = DBUtil::selectExpandedObjectArray($table,$joinInfo,$where,$orderby,$offset,$numrows);
			if ($uid > 1) {
				$result = $result[0];
			}
		}
	}
	// Cache result
	$lobbyCacheMembers[$varName] = $result;
	// return result
	return $result;
}

/**
 * add a user to a group
 * 
 * @args['uid']		int			user id
 * @args['gid']		int			group id
 * @args['text']	string		request text
 * @return			boolean
 */
function lobby_membersapi_add($args)
{
	$uid = (int)$args['uid'];
	$gid = (int)$args['gid'];
	$text = $args['text'];
	if (!($uid > 1) || !($gid > 0)) {
  	  	LogUtil::registerError(_LOBBY_GROUP_ADDMEMBER_FAILURE);
		return false;
	} else {
	  	// get Group
	  	$group = pnModAPIFunc('lobby','groups','get',array('id' => $gid));
  		$groupOwner = (($group['uid'] == pnUserGetVar('uid')) || (SecurityUtil::checkPermission('lobby::'.$id, '::', ACCESS_ADMIN)));
	  	if ($group['id'] != $gid) {
	  	  	// Something went wrong, groups not existent or something like that
	  	  	LogUtil::registerError(_LOBBY_GROUP_ADDMEMBER_FAILURE);
		    return false;
		} else {
			$obj = array(
				'gid' 	=> $gid, 
				'uid' 	=> $uid,
				'text'	=> $text,
				'date'	=> date("Y-m-d H:i:s",time())
				);
			if (($group['moderated'] == 1) && ($group['uid'] != $uid)) {
			  	// is the member already member or pending?
			  	$table = pnDBGetTables();
			  	$column_pending = $table['lobby_members_pending_column'];
			  	$column_members = $table['lobby_members_column'];
			  	$where_pending = $column_pending['uid']." = ".$uid." AND ".$column_pending['gid']." = ".$gid;
			  	$where_members = $column_members['uid']." = ".$uid." AND ".$column_members['gid']." = ".$gid;
			  	$pending_count = (int)DBUtil::selectObjectCount('lobby_members_pending',$where_pending);
			  	$members_count = (int)DBUtil::selectObjectCount('lobby_members',$where_members);
			  	if ($pending_count > 0) {
			  	  	// if the call was done by the group owner we will move the contact from pending status
			  	  	if ($groupOwner) {
			  	  	  	// get object, add it into member table and delete delte it from pending table
						$pending = DBUtil::selectObject('lobby_members_pending',$where_pending);
						$result = DBUtil::deleteObject($pending,'lobby_members_pending');
						if (!$result) {
							return LogUtil::registerError('_LOBBY_GROUP_PENDING_ACCEPT_ERROR');
						}
						if ($members_count == 0) {
						  	if (!$result) {
								return LogUtil::registerError('_LOBBY_GROUP_PENDING_ACCEPT_ERROR');
							}
						} else {
							return LogUtil::registerError(_LOBBY_GROUP_ADD_ALREDY_MEMBER);
						}
					} else {
						return LogUtil::registerError(_LOBBY_GROUP_ADD_ALREDY_PENDING);
					}
				} else if ($members_count > 0) {
				    return LogUtil::registerError(_LOBBY_GROUP_ADD_ALREDY_MEMBER);
				}
				else {
					$result = DBUtil::insertObject($obj,'lobby_members_pending');
					if ($result) {
						return LogUtil::registerStatus(_LOBBY_GROUP_REQUESTSENT);
					}
					else {
						return LogUtil::registerError(_LOBBY_GROUP_JOINERROR);
					}
				}
				
			}
		  	// Insert Member now into database
			$result = DBUtil::insertObject($obj,'lobby_members');
			// Set message
			if ($result) {
				LogUtil::registerStatus(str_replace('%member%',pnUserGetVar('uname', $uid),_LOBBY_GROUPS_MEMBERADDED));
			} else {
			  	LogUtil::registerError(_LOBBY_GROUPS_ADDERROR);
			}
			// Send an Email to the user that was added
			if ($group['uid'] == $uid) {
				// ToDo: Email schicken "wurde hinzugefügt"
			}
		}
	}
}

/**
 * reject a user's request to be added to a group
 * 
 * @args['uid']		int			user id
 * @args['group']	object		group
 * @return			boolean
 */
function lobby_membersapi_reject($args)
{
	$uid = (int)$args['uid'];
	$group = $args['group'];
	$gid = (int)$group['id'];
	if (!($uid > 1) || !($gid > 0)) {
  	  	LogUtil::registerError(_LOBBY_GROUP_REJECT_MEMBER_FAILURE);
		return false;
	} else {
	  	// get Group
	  	$table 		= pnDBGetTables();
	  	$column		= $table['lobby_members_pending_column'];
	  	$where		= $column['uid']." = ".$uid." AND ".$column['gid']." = ".$gid;
		$result		= DBUtil::selectObjectArray('lobby_members_pending',$where);
		$obj = $result[0];
		$result = DBUtil::deleteObject($obj,'lobby_members_pending');
		if ($result) {
			LogUtil::registerStatus(_LOBBY_MEMBERSHIP_REQUEST_REJECTED);
			// send Mail
			Loader::includeOnce('modules/lobby/includes/common_email.php');
			lobby_notify_rejectmembershiprequest($group,$uid);
			return true;
		} else {
		  	LogUtil::registerError(_LOBBY_MEMBERSHIP_REJECT_ERROR);
		  	return false;
		}
	}
}

/**
 * reject a user's request to be added to a group
 * 
 * @args['uid']		int			user id
 * @args['gid']		int			group id
 * @return			boolean
 */
function lobby_membersapi_del($args)
{
  	prayer($args);
	$uid = (int)$args['uid'];
	$gid = (int)$args['gid'];
	if (!(($uid > 1) && ($gid > 0))) {
  	  	LogUtil::registerError(_LOBBY_GROUP_DELETE_MEMBER_FAILURE);
		return false;
	} else {
	  	// Is the user a member of this group?
	  	$isMember = pnModAPIFunc('lobby','groups','isMember',array('uid' => $uid, 'gid' => $gid));
	  	$group = pnModAPIFunc('lobby','group','get',array('id' => $gid));
	  	$isOwner = ($group['uid'] == $uid);
	  	if (!$isMember) {
		    LogUtil::registerError(_LOBBY_USER_NOT_A_MEMBER);
		    return false;
		} else if ($isOwner) {
		    LogUtil::registerError(_LOBBY_USER_IS_OWNER);
		    return false;
		} else {
		  	$table 		= pnDBGetTables();
		  	$column		= $table['lobby_members_column'];
		  	$where		= $column['uid']." = ".$uid." AND ".$column['gid']." = ".$gid;
			return DBUtil::deleteWhere('lobby_members',$where);
		}
	}
}

/**
 * get the memberships of a user
 *
 * $args['uid']		int		user id
 * @return			array
 */
function lobby_membersapi_getMemberships($args)
{
	$uid = (int)$args['uid'];
	if ($uid == 0) {
		return false;
	} else {
	  	$tables = pnDBGetTables();
	  	$column = $tables['lobby_members_column'];
	  	$where = $column['uid']." = '".$uid."'";
		$result = DBUtil::selectObjectArray('lobby_members',$where);
		$r = array();
		foreach ($result as $item) {
			$r[]=$item['gid'];
		}
		return $r;
	}
}