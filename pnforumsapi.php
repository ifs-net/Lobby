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
 * add a new forum
 *
 * This function adds a new forum into the database
 *
 * @args['gid']				int		
 * @args['id']				int		
 * @args['title']			string 	
 * @args['description']		string 	
 * @args['public_status']	string 	
 *
 * @return boolean
 */
function lobby_forumsapi_add($args)
{
	$obj['gid']				= (int)$args['gid'];
	if (!($obj['gid']) > 0) {
	  	LogUtil::registerError(_LOBBY_FORUM_CREATION_ERROR);
		return false;
	}
	$obj['title']			= $args['title'];
	$obj['description']		= $args['description'];
	$obj['public_status']	= $args['public_status'];
	
	$result = DBUtil::insertObject($obj,'lobby_forums');
	if ($result > 0) {
	  	LogUtil::registerStatus(str_replace('%forum%', $obj['title'], _LOBBY_FORUM_CREATED));
	  	return $result;
	} else {
	  	LogUtil::registerError(_LOBBY_FORUM_CREATION_ERROR);
		return false;
	}

}

/**
 * get forums
 *
 * @args['gid']			int		group id
 * @args['id']			int		forum id
 * @args['showall']		int		optional, ==1 show all not considering permissions
 *
 * @return int or boolean
 */
function lobby_forumsapi_get($args)
{
  	$id = (int)$args['id'];
  	$gid = (int)$args['gid'];
  	$showall = (int)$args['showall'];
//  	if ($gid == 0) {
//	    LogUtil::registerError('no group id specified  -  might cause problems!');
//	}
  	$tables = pnDBGetTables();
  	$column = $tables['lobby_forums_column'];

	$where = array();
	if ($gid > 0) $where[] = "tbl.".$column['gid']." = ".$gid;
	if ($id > 0) $where[] = "tbl.".$column['id']." = ".$id;

	if (($showall == 1) || (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN))) {
	  	$mystatus = 2;
	} else {
		if (!pnUserLoggedIn()) {
		  	$mystatus = 0;
		} else {
		  	if ($gid > 0) {
				$groupstatus = pnModAPIFunc('lobby','groups','isMember',array('uid' => pnUserGetVar('uid'), 'gid' => $gid));
			  	if ($groupstatus > 0) {
				    $mystatus = 2;
				} else {
					$mystatus = 1;
				}
			} else {
			  	// Todo: Check here if user making this call is member of the group
			  	// ...
			  	// till then: easy way!
			  	$mystatus = 1; // no access for internal group forums
			}
		}
	}
	$where[] 	= "tbl.".$column['public_status']." <= ".$mystatus;

	$wherestring = implode(' AND ',$where);
	$orderby = $column['sort_nr']." ASC";
	$result = DBUtil::selectObjectArray('lobby_forums',$wherestring,$orderby);
	if ($id > 0) {
	  	return $result[0];
	} else {
		return $result;
	}
}

/**
 * delete a forum
 *
 * $args['id']		int		forum id
 * @return		booleam
 */
function lobby_forumsapi_del($args)
{
	$id = (int)$args['id'];
	if (!($id > 0)) {
		return false;
	} else {
		// forums
		$forum = DBUtil::selectObjectByID('lobby_forums',$id);
		// delete Subscriptions
		if (!DBUtil::deleteWhere('lobby_forum_subscriptions','fid ='.$id)) {
		  	return false;
		}
		$obj = DBUtil::selectObjectByID('lobby_forum_topics',$id);
		// get all topics
		$topics = pnModAPIFunc('lobby','forumtopics','get',array('fid' => $id));
		foreach ($topics as $topic) {
			$result = pnModAPIFunc('lobby','forumtopics','del',array('id' => $topic[id]));
			if (!$result) {
			    return false;
			}
		}
		// delete forum
		$result = DBUtil::deleteObject($forum,'lobby_forums');
		return $result;
	}
}

/**
 * Sync forum
 *
 * @param $args['gid']	int		group id
 * @param $args['id']	int		forum id
 * @return boolean
 */
function lobby_forumsapi_sync($args)
{
  	$gid = (int)$args['gid'];
  	$id  = (int)$args['id'];
 
 	if (($gid == 0) && ($id == 0)) {
		return false;
	}
  	
  	// sync each forum
  	if ($gid > 0) {
	    $where = 'gid = '.$gid;
	} else {
	  	$where = 'id ='.$id;
	}
  	$forums = DBUtil::selectObjectArray('lobby_forums',$where);
  	$group['postings'] = 0;
  	foreach ($forums as $forum) {
		// sync postings and topics for each forum
		$forum['posts']=(int)DBUtil::selectObjectCountByID('lobby_forum_posts',$forum['id'],'fid');
		$forum['topics']=(int)DBUtil::selectObjectCountByID('lobby_forum_topics',$forum['id'],'fid');
		// ToDo: get last poster uid, date
		$result = DBUtil::selectObjectArray('lobby_forum_topics','fid = '.$forum['id'],'id DESC');
		if ($result) {
		  	$last = $result[0];
		  	$forum['last_topic_date']   = $last['last_date'];
		  	$forum['last_topic_poster']	= $last['uid'];
		  	$forum['last_tid']          = $last['id'];
		}
		$result = DBUtil::selectObjectArray('lobby_forum_posts','fid = '.$forum['id'],'id DESC');
		if ($result) {
		  	$last = $result[0];
		  	$forum['last_poster']      = $last['uid'];
		  	$forum['last_poster_date'] = $last['date'];
		  	$forum['last_poster_tid']  = $last['tid'];
		}
		
		// sync posts for group
		$group['postings']+=$forum['posts'];
		// update forum
		DBUtil::updateObject($forum,'lobby_forums');
		
	}
	return true;
}