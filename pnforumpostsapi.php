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
 * get postings for a given topic
 *
 * $args['tid']				int			topic id
 *										or
 * @args['offset']			int			offset for pager
 * @args['numrows']			int			numrows for pager
 * $args['id']				int			posting id
 * @return					array
 */
function lobby_forumpostsapi_get($args) {
	$tid = (int)$args['tid'];
	$pid = (int)$args['id'];
	$numrows 	= $args['numrows'];
	$offset 	= $args['offset'];

  	$tables = pnDBGetTables();
  	$column = $tables['lobby_forum_posts_column'];
  	$column_posts = $tables['lobby_forum_posts_column'];
	
	$joinInfo[] = array (	'join_table'          =>  'lobby_forum_posts_text',	// table for the join
							'join_field'          =>  'text',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'text',			// ...this name for the new column
                         	'compare_field_table' =>  'id',			// regular table column that should be equal to
                         	'compare_field_join'  =>  'id');			// ...the table in join_table

	$joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
							'join_field'          =>  'uname',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'uname',			// ...this name for the new column
                         	'compare_field_table' =>  'uid',			// regular table column that should be equal to
                         	'compare_field_join'  =>  'uid');			// ...the table in join_table

	if ($pid > 0) {
	  	$result = DBUtil::selectExpandedObjectByID('lobby_forum_posts',$joinInfo,$pid);
	  	return $result;
	} else if ($tid > 0){
	  	// Load complete postings tree
		$orderby = $column_posts['date']." ASC";
		$where = $column_posts['tid']." = ".$tid;
		$result = DBUtil::selectExpandedObjectArray('lobby_forum_posts',$joinInfo,$where,$orderby,$offset,$numrows);
		if ($pid > 0) {
		  	return $result[0];
		} else {
			return $result;
		}
	  	
	}
}

/**
 * creates a new posting
 *
 * $args['fid']				int			forum id
 * $args['tid']				int			topic id
 * $args['uid']				int			user id (optional)
 * $args['title']			string 		title
 * $args['text']			string 		content of posting
 * $args['date']			string 		date (optional)
 * $args['quiet']			boolean		no output and notification email
 * @return int (new id) or false otherwise
 */
function lobby_forumpostsapi_add($args)
{
	$fid	= (int)$args['fid'];
	$uid	= (int)$args['uid'];
	$tid	= (int)$args['tid'];
	$quiet  = $args['quiet'];
	if (
		(	!($fid > 0 )	)
		||
		(	($uid < 2)	&&	(!$quiet)	)
		) {
	  	LogUtil::registerError(_LOBBY_TOPICSAPI_ADD_PARAMERROR);
		return false;
	}
	$title	= $args['title'];
	$text	= $args['text'];
	$subscribe = (int)$args['subscribe'];
	if (!$uid > 0) {
		$uid = pnUserGetVar('uid');
	}
	if (isset($args['date']) && ($args['date'] != '')) {
		$date = $args['date'];
	} else {
		$date	= date("Y-m-d H:i:s");
	}
	// check text for NULL, important for import function for Dizkus
	if (!isset($text)) {
	  	$text = '';
	}
	$posting = array (
			'uid'		=> $uid,
			'date'		=> $date,
			'tid'		=> $tid,
			'fid'		=> $fid,
			'date'		=> $date,
			'title'		=> $title,
			'text'		=> $text
		);
	// get topic
	if ($tid  > 0) {
	  	// We need this check to see if topic was closed till now..
	  	// only neccesarry if topic id is given - new topic otherwise!
	  	$topic = DBUtil::selectObjectByID('lobby_forum_topics',$tid);
	  	if ($topic['locked'] == 1) {
	  	  	LogUtil::registerError(_LOBBY_FORUM_TOPIC_LOCKED);
			return false;
		}
	}
	$result = DBUtil::insertObject($posting,'lobby_forum_posts');
	if (!$result) {
	  	return false;
	}

	// Add text
	$result = DBUtil::insertObject($posting,'lobby_forum_posts_text','',false,true);
	if (!$result) {
	  	// Failure? delete post and return false success
	  	DBUtil::deleteObject($posting,'lobby_forum_posts');
	  	return false;
	} else {
	  	// Update topic information is not done automatically and has to be 
		// called by the function that adds a new post
	  	if ($tid > 0) {
			if (!$args['quiet']) {
				LogUtil::registerStatus(_LOBBY_REPLY_POSTED);
				// send notification emails
				Loader::includeOnce('modules/lobby/includes/common_email.php');
				lobby_notify_newreply($topic,$posting);
			}
			// make abo for topic
			if ($subscribe == 1) {
				pnModAPIFunc('lobby','subscriptions','set',array('tid' => $tid, 'uid' => pnUserGetVar('uid')));
			}
		}
	  	return $posting['id'];
	}
}

/**
 * delete a post
 *
 * $args['id']		int		post id
 * @return		booleam
 */
function lobby_forumpostsapi_del($args)
{
	$id = (int)$args['id'];
	if (!($id > 0)) {
		return false;
	} else {
		$obj = DBUtil::selectObjectByID('lobby_forum_posts',$id);
		$obj_text = DBUtil::selectObjectByID('lobby_forum_posts_text',$id);
		if (($obj['id'] == ($obj_text['id'])) && ($id == $obj['id'])) {
		  	//delete objects
			DBUtil::deleteObject($obj,'lobby_forum_posts');
			DBUtil::deleteObject($obj_text,'lobby_forum_posts');
			return true;
		} else {
		  	return false;
		}
	}
}