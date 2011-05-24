<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schie�l
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

/**
 * function sets  subscription status
 *
 * $args['fid']		int		forum id
 * $args['tid']		int		topic id
 * $args['uid']		int		user id
 * @return		boolean
 */
function lobby_subscriptionsapi_set($args)
{
	$fid = (int)$args['fid'];
	$tid = (int)$args['tid'];
	$uid = (int)$args['uid'];
	
	$forum = pnModAPIFunc('lobby','forums','get',array('id' => $fid));
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $forum['gid']));
	$memberstatus = pnModAPIFunc('lobby','groups','getMemberStatus',array('group' => $group, 'uid' => $uid));
	// Check if user is in the group if a private forum is selected
	if ( ($forum['public_status'] == 2) && ($memberstatus < 1) ) {
		LogUtil::registerError(_LOBBY_FORUM_NO_PERMISSION);
		return false;
	}
	
	if ($fid > 0) {
	  	$is = lobby_subscriptionsapi_get($args);
	  	if (!$is) {
		    $obj = array (
		    		'fid' => $fid,
		    		'uid' => $uid
				);
			$result = DBUtil::insertObject($obj,'lobby_forum_subscriptions');
			if ($result) {
			  	LogUtil::registerStatus(_LOBBY_FORUM_SUBSCRIBED_NOW);
			} else {
			  	LogUtil::registerError(_LOBBY_FORUM_SUBSCRIBE_ERROR);
			}
		} else {
		  	LogUtil::registerStatus(_LOBBY_FORUM_ALREADY_SUBSCRIBED);
		}
	} else if ($tid > 0) {
	  	$is = lobby_subscriptionsapi_get($args);
	  	if (!$is) {
		    $obj = array (
		    		'tid' => $tid,
		    		'uid' => $uid
				);
			$result = DBUtil::insertObject($obj,'lobby_forum_topic_subscriptions');
			if ($result) {
			  	LogUtil::registerStatus(_LOBBY_TOPIC_SUBSCRIBED_NOW);
			} else {
			  	LogUtil::registerError(_LOBBY_TOPIC_SUBSCRIBE_ERROR);
			}
		} else {
		  	LogUtil::registerStatus(_LOBBY_TOPIC_ALREADY_SUBSCRIBED);
		}
	} else {
	  	// wrong parameters
	  	return false;
	}
}

/**
 * function gets subscription status
 *
 * $args['fid']		int		forum id
 * $args['tid']		int		topic id
 * $args['uid']		int		user id
 * @return		boolean
 */
function lobby_subscriptionsapi_get($args)
{
	$fid = (int)$args['fid'];
	$tid = (int)$args['tid'];
	$uid = (int)$args['uid'];
	$tables = pnDBGetTables();
	$column_forums  = $tables['lobby_forum_subscriptions_column'];
	$column_topics  = $tables['lobby_forum_topic_subscriptions_column'];
	$column_members = $tables['lobby_members_column'];
	$table_members  = $tables['lobby_members'];
	
	// Information for security check:
	// public_status from forum:
	// 0 = all, 1 = registered users, 2 = members of group.

	if ($tid > 0) {
	    $whereArray = array();
	    // get topic for security check
	    // get topic
	    $topic = pnModAPIFunc('lobby','forumtopics','get',array('id' => $tid));
	    // get forum and its pubic_status
	    $forum = pnModAPIFunc('lobby','forums','get',array('id' => $topic['fid']));
	    // get information if user is member of group or not
	    if ($forum['public_status'] > 1) {
	        $whereArray[] = $column_topics['uid']." IN (SELECT ".$column_members['uid']." FROM ".$table_members." WHERE ".$column_members['gid']." = ".$forum['gid'].")";
	    }
	    
	    // subscribe topic
		if ($uid > 1) {
			$whereArray[] = $column_topics['uid']." = ".$uid;
		}
		$whereArray[] = $column_topics['tid']." = ".$tid;
		$where = implode(' AND ',$whereArray);
		if (($uid > 1) && ($tid > 0)) {
			$result = DBUtil::selectObjectCount('lobby_forum_topic_subscriptions',$where);
			if ($result != 0) {
			  	return true;
			} else {
				return false;
			}
		} else {
			$result = DBUtil::selectObjectArray('lobby_forum_topic_subscriptions',$where);
			return $result;
		}
	} else if ($fid > 0){
            // forum
            $whereArray = array();
	    // get topic for security check
	    // get forum and its pubic_status
	    $forum = pnModAPIFunc('lobby','forums','get',array('id' => $fid,'showall' => 1));
	    // get information if user is member of group or not
	    if ($forum['public_status'] > 1) {
	        $whereArray[] = $column_topics['uid']." IN (SELECT ".$column_members['uid']." FROM ".$table_members." WHERE ".$column_members['gid']." = ".$forum['gid'].")";
	    }
	  	if ($uid > 1) {
		  	$whereArray[] = $column_forums['uid']." = ".$uid;
		}
		$whereArray[] = $column_forums['fid']." = ".$fid;
		$where = implode(' AND ',$whereArray);
		if (($uid > 1) && ($fid > 0)) {
			$result = DBUtil::selectObjectCount('lobby_forum_subscriptions',$where);
			if ($result != 0) {
			  	return true;
			} else {
				return false;
			}
		} else {
			$result = DBUtil::selectObjectArray('lobby_forum_subscriptions',$where);
			return $result;
		}
	} else {
	  	// parameters wrong?
		return false;
	}
}


/**
 * function deletes subscription 
 *
 * $args['fid']		int		forum id
 * $args['tid']		int		topic id
 * $args['uid']		int		user id
 * @return		boolean
 */
function lobby_subscriptionsapi_del($args)
{
	$fid = (int)$args['fid'];
	$tid = (int)$args['tid'];
	$uid = (int)$args['uid'];
	if ($uid == 0) {
		$uid = pnUserGetVar('uid');
	}
	
	$tables = pnDBGetTables();
	$column_forums = $tables['lobby_forum_subscriptions_column'];
	$column_topics = $tables['lobby_forum_topic_subscriptions_column'];
	if ($tid > 0) {
	  	// topic
		$where = $column_topics['uid']." = ".$uid." AND ".$column_topics['tid']." = ".$tid;	
		$result = DBUtil::selectObjectArray('lobby_forum_topic_subscriptions',$where);
		if (!$result) {
		  	return false;
		} else {
			$obj=$result[0];
			$result = DBUtil::deleteObject($obj,'lobby_forum_topic_subscriptions');
			if ($result) {
			  	LogUtil::registerStatus(_LOBBY_TOPIC_UNSUBSCRIBED_NOW);
			} else {
			  	LogUtil::registerError(_LOBBY_TOPIC_UNSUBSCRIBE_ERROR);
			}
		}
	} else if ($fid > 0){
	  	// forum
		$where = $column_forums['uid']." = ".$uid." AND ".$column_forums['fid']." = ".$fid;
		$result = DBUtil::selectObjectArray('lobby_forum_subscriptions',$where);
		if (!$result) {
		  	return false;
		} else {
			$obj=$result[0];
			$result = DBUtil::deleteObject($obj,'lobby_forum_subscriptions');
			if ($result) {
			  	LogUtil::registerStatus(_LOBBY_FORUM_UNSUBSCRIBED_NOW);
			} else {
			  	LogUtil::registerError(_LOBBY_FORUM_UNSUBSCRIBE_ERROR);
			}
		}
	} else {
	  	// parameters wrong?
		return false;
	}
}
