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
 * get topics for a forum
 *
 * @param $args['fid']			int			forum id
 * @param $args['id']			int			topic id (optional)
 * @param $args['offset']		int			optional offset
 * @param $args['numrows']		int			optional numrows
 * @param $args['date']			int			optional date filter
 * @param $args['count']		int			optional to count only
 * @param $args['sort']			string		optional, == creationdate if topics, not postings should be handled
 * @param $args[]'official']	int			optional, ==1 if only topics from official groups should be loaded
 * @param $args['owngroups']	int			optional, ==1 if only own groups should be handled
 * @param $args['sticky']		int			optional, ==1 if marked topics should be on top
 * @return int or boolean
 */
function lobby_forumtopicsapi_get($args)
{
  	$fid 		= (int)$args['fid'];
  	$gid 		= (int)$args['gid'];
  	$id 		= (int)$args['id'];
  	$count		= (int)$args['count'];
  	$official	= (int)$args['official'];
  	$sticky		= (int)$args['sticky'];
  	$owngroups  = (int)$args['owngroups'];
  	$sort		= $args['sort'];
  	$date 		= $args['date'];
  	$offset 	= $args['offset'];
  	$numrows 	= $args['numrows'];
  	$tables 	= pnDBGetTables();
  	$column 	= $tables['lobby_forum_posts_column'];
  	$column_topics     = $tables['lobby_forum_topics_column'];
  	$column_forums     = $tables['lobby_forums_column'];
  	$column_groups     = $tables['lobby_groups_column'];
  	$column_categories = $tables['lobby_categories_column'];

	$whereArray = array();
	// Should only own groups or all groups be handled?
	if ($owngroups == 1) {
	  	// show only own groups, also for admin
	  	if (!pnUserLoggedIn()) {
		    return array();
		} else {
		  	// Get groups
		  	$groups = pnModAPIFunc('lobby','members','getMemberships',array('uid' => pnUserGetVar('uid')));
		  	foreach ($groups as $group) {
			    $whereOrArray[] = "tbl.".$column_topics['gid']." = ".$group;
			}
			if (count($whereOrArray) > 0) {
				$whereArray[] = "(".implode(' OR ',$whereOrArray).")";
			} else {
			  	return array();
			}
		}
	} else {
	  	// handle all groups
		if ($fid > 0) {
			$whereArray[] = "tbl.".$column['fid']." = ".$fid;
		}
		if ($gid > 0) {
			$whereArray[] = "tbl.".$column_topics['gid']." = ".$gid;
		}
		if (!pnUserLoggedIn()) {
		  	$mystatus = 0;
		} else {
		  	if (!($gid > 0)) {
			    $isMember = false;
			} else {
				$isMember = pnModAPIFunc('lobby','groups','isMember',array('uid' => pnUserGetVar('uid'), 'gid' => $gid));
			}
		  	if ($isMember) {
				$mystatus = 2;
			} else {
			  	$mystatus = 1;
			}
		}
		// Admin Check
	    if (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) {
		  	$mystatus = 2;
		}
		
		if ($mystatus < 2) {
			$whereArray[] = "b.".$column_forums['public_status']." <= ".$mystatus;
		}
	}
	if ($date != '') {
	  	if ($sort == 'creationdate') {
		  	$whereArray[] = "tbl.".$column_topics['date']." > '".$date."'";
		} else {
		  	$whereArray[] = "tbl.".$column_topics['last_date']." > '".$date."'";
		}
	}

	// a
	$joinInfo[] = array (	'join_table'          =>  'lobby_forum_posts',	// table for the join
							'join_field'          =>  'title',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'title',			// ...this name for the new column
                         	'compare_field_table' =>  'id',			// regular table column that should be equal to
                         	'compare_field_join'  =>  'id');			// ...the table in join_table
	// b
	$joinInfo[] = array (	'join_table'          =>  'lobby_forums',	// table for the join
							'join_field'          =>  'title',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'forum_title',			// ...this name for the new column
                         	'compare_field_table' =>  'fid',			// regular table column that should be equal to
                         	'compare_field_join'  =>  'id');			// ...the table in join_table
	// c
	$joinInfo[] = array (	'join_table'          =>  'lobby_forum_posts_text',	// table for the join
							'join_field'          =>  'text',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'text',			// ...this name for the new column
                         	'compare_field_table' =>  'id',			// regular table column that should be equal to
                         	'compare_field_join'  =>  'id');			// ...the table in join_table
	// d
	$joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
							'join_field'          =>  'uname',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'uname',			// ...this name for the new column
                         	'compare_field_table' =>  'uid',			// regular table column that should be equal to
                         	'compare_field_join'  =>  'uid');			// ...the table in join_table
	// e
	$joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
							'join_field'          =>  'uname',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'last_uname',		// ...this name for the new column
                         	'compare_field_table' =>  'last_uid',		// regular table column that should be equal to
                         	'compare_field_join'  =>  'uid');			// ...the table in join_table
	// f
	$joinInfo[] = array (	'join_table'          =>  'lobby_groups',			// table for the join
							'join_field'          =>  'title',			// field in the join table that should be in the result with
                         	'object_field_name'   =>  'group_title',		// ...this name for the new column
                         	'compare_field_table' =>  'gid',		// regular table column that should be equal to
                         	'compare_field_join'  =>  'id');			// ...the table in join_table

    // If only official postings should be included we will add an where clase and a join information
    if ($official == 1) {
      	$category_table = DBUtil::getLimitedTablename('lobby_categories');
		$whereArray[] = "f.".$column_groups['category']." IN ( 
					SELECT ".$column_categories['id']." from ".$category_table." WHERE official = 1
				)";
	}

	// Build where string
	$where = implode(' AND ',$whereArray);

	if ($sticky == 1) {
		$orderby = $column_topics['marked']." = 1 DESC, ";
	}
	if ($sort == 'creationdate') {
		$orderby.= "tbl.".$column_topics['date']." DESC";
	} else{
		$orderby.= "tbl.".$column_topics['last_date']." DESC";
	}
	if ($id > 0) {
		$result = DBUtil::selectExpandedObjectByID('lobby_forum_topics',$joinInfo,$id);
	} else {
	  	if ($count == 1) {
			$result = DBUtil::selectExpandedObjectCount('lobby_forum_topics',$joinInfo,$where);
		} else {
			$result = DBUtil::selectExpandedObjectArray('lobby_forum_topics',$joinInfo,$where,$orderby,$offset,$numrows);
		}
	}
//	prayer($result);
	return $result;
}

/**
 * creates a new topic
 *
 * $args['gid']				int			group id
 * $args['fid']				int			forum id
 * $args['uid']				int			user id (optional)
 * $args['title']			string 		title
 * $args['date']			string 		date (optional)
 * $args['text']			string 		content
 * $args['quiet']			boolean		no output and notification email
 * @return int (new id) or false otherwise
 */
function lobby_forumtopicsapi_add($args)
{
	$gid	= (int)$args['gid'];
	$fid	= (int)$args['fid'];
	$uid	= (int)$args['uid'];
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
	if (!($uid > 0)) {
		$uid = pnUserGetVar('uid');
	}
	if (isset($args['date']) && ($args['date'] != '')) {
		$date = $args['date'];
	} else {
		$date	= date("Y-m-d H:i:s");
	}
	$posting = array(
			'uid'		=> $uid,
			'date'		=> $date,
			'fid'		=> $fid,
			'gid'		=> $gid,
			'date'		=> $date,
			'text'		=> $text,
			'title'		=> $title,
			'quiet'		=> $quiet,
			'tid'		=> 0		// topic id == 0 means that posting is topic
		);
	// Create posting
	$post_id = pnModAPIFunc('lobby','forumposts','add',$posting);
	if (!$post_id) {
	  	return false;
	} else {
		// Create topic with post id
		$topic = array (
				'id'		=> $post_id,
				'date'		=> $date,
				'last_date'	=> $date,
				'gid'		=> $gid,
				'uid'		=> $uid,
				'fid'		=> $fid
			);
		$result = DBUtil::insertObject($topic,'lobby_forum_topics','id',true);
		if ($result > 0) {
		  	$obj_post = DBUtil::selectObjectByID('lobby_forum_posts',$post_id);
		  	$obj_post_text = DBUtil::selectObjectByID('lobby_forum_posts_text',$post_id);
		  	// update id
		  	$obj_post['tid'] 	  = $result['id'];
		  	$obj_post_text['tid'] = $result['id'];
		  	DBUtil::updateObject($obj_post,'lobby_forum_posts');
		  	DBUtil::updateObject($obj_post_text,'lobby_forum_posts_text');
			// update forum information!
			$forum = DBUtil::selectObjectByID('lobby_forums',$fid);
			$forum['topics']++;
			$forum['posts']++;
			$forum['last_poster']		= $uid;
			$forum['last_topic_poster'] = $uid;
			$forum['last_poster_date'] 	= $date;
			$forum['last_topic_date'] 	= $date;
			DBUtil::updateObject($forum,'lobby_forums');

			// send notification emails only if date was not set.
			// if date was set the function was called by the import tool
			if (!$args['quiet']) {
				// make abo for topic
				if ($subscribe == 1) {
					pnModAPIFunc('lobby','subscriptions','set',array('tid' => $obj_post['tid'], 'uid' => pnUserGetVar('uid')));
				}
		  		Loader::includeOnce('modules/lobby/includes/common_email.php');
				lobby_notify_newtopic($topic,$obj_post['title'],$obj_post_text['text'],$topic['uid'],$topic['fid'],$topic['id']);
			  	// Status message
				LogUtil::registerStatus(_LOBBY_TOPIC_CREATED);
			}
		  	return $result;
		} else {
		  	LogUtil::registerError(_LOBBY_TOPIC_CREATION_ERROR);
			return false;
		}
	}
}

/**
 * delete a topic with all postings
 *
 * $args['id']		int		topic id
 * @return		booleam
 */
function lobby_forumtopicsapi_del($args)
{
	$id = (int)$args['id'];
	if (!($id > 0)) {
		return false;
	} else {
		// delete Subscriptions
		if (!DBUtil::deleteWhere('lobby_forum_topic_subscriptions','tid ='.$id)) {
		  	return false;
		}
		// get topic
		$obj = DBUtil::selectObjectByID('lobby_forum_topics',$id);
		// get all posts
		$posts = pnModAPIFunc('lobby','forumposts','get',array('tid' => $id));
		foreach ($posts as $post) {
		  	$result = pnModAPIFunc('lobby','forumposts','del',array('id' => $post[id]));
		  	if (!$result) {
			    return false;
			}
		}
		// delete topic
		$result = DBUtil::deleteObject($obj,'lobby_forum_topics');
		return $result;
	}
}

/**
 * move a topic to another forum
 *
 * @param	$args['id']		int		topic id
 * @param	$args['to']		int		target forum id
 * @return	boolean
 */
function lobby_forumtopicsapi_move($args)
{
  	$id = (int)$args['id'];
  	$to = (int)$args['to'];
  	// get topic
  	$topic = lobby_forumtopicsapi_get(array('id' => $id));
  	// get target forum
  	$forum = pnModAPIFunc('lobby','forums','get',array('id' => $to, 'gid' => $topic['gid']));
  	// Target forum must be in same group as destination
  	if ($forum['gid'] != 0 ) {
	    if ($topic['gid'] == $forum['gid']) {
		  	// update topic
		  	$obj = DBUtil::selectObjectByID('lobby_forum_topics',$id);
		  	$obj['fid'] = $to;
		  	$result = DBUtil::updateObject($obj,'lobby_forum_topics');
		  	if ($result) {
		  	  	$tables = pNDBGetTables();
		  	  	$column = $tables['lobby_forum_posts_column'];
		  	  	$where = $column['tid']." = ".$id;
			    $objects = DBUtil::selectObjectArray('lobby_forum_posts',$where);
			    foreach ($objects as $o) {
				  	$o['fid'] = $to;
				  	DBUtil::updateObject($o,'lobby_forum_posts');
				}
				return true;
			} else {
			  	LogUtil::registerError('could not update org topic');
			  	return false;
			}
		} else {
		  	LogUtil::registerError('cannot move topic to another group!');
		  	return false;
		}
	} else {
	  	LogUtil::registerError('wrong / no group selected');
	  	return false;
	}
}

/**
 * sync a topic
 *
 * @param	$args['id']		int		topic id
 * @return 	boolean
 */
function lobby_forumtopicsapi_sync($args)
{
  	// Parameters
  	$id = (int)$args['id'];

  	// Tables
  	$tables  = pnDBGetTables();
  	$pcolumn = $tables['lobby_forum_posts_column'];
  	$tcolumn = $tables['lobby_forum_topics_column'];

	DBUtil::SQLCache(true);

  	// Get object 
  	$topic = DBUtil::selectObjectByID('lobby_forum_topics',$id);
  	if ($topic['id'] != $id) {
	    return false;
	}

  	// Get replies
  	$replies = DBUtil::selectObjectCountByID('lobby_forum_posts',$id,$pcolumn['tid']);
  	$replies--; // The original topic post is not a reply
  	$topic['replies'] = $replies;
  	
  	// Last reply and last_date
  	if ($replies == 0) {
 	    $topic['last_date'] = $topic['date'];
 	    $topic['last_pid']  = $topic['id'];
 	    $topic['last_uid']  = $topic['uid'];
	} else {
	  	$where = $pcolumn['tid']." = ".$id;
	  	$orderby = $pcolumn['date'].' DESC';
	  	$result = DBUtil::selectObjectArray('lobby_forum_posts',$where,$orderby,-1,1);
	  	$lastpost = $result[0];
	  	$topic['last_date'] = $lastpost['date'];
	  	$topic['last_pid']  = $lastpost['id'];
 	    $topic['last_uid']  = $lastpost['uid'];
	}
	
	// Update object
	$result = DBUtil::updateObject($topic,'lobby_forum_topics');
	return $result;
}