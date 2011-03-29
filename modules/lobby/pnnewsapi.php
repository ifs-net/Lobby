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
 * get all news
 * 
 * @args['gid']		int			id of group 			(optional)
 * @args['id']		int			id of special article	(optional)
 * @args['infuture']int			==1 also show future art(optional)
 * @args['offset']	int			offset for dbutil		(optional)
 * @args['numrows']	int			numrows for dbutil		(optional)
 * @args['since']   int         date-timestamp, news since.. (optional)
 * @args['count']	int			==1 count, returns int	(optional)
 * @args['onlyown']	int			==1 only show own groups (optional)
 * $args['catfilter'] int       category filter, id of category (optional)
 * @return			array       the categories
 */
function lobby_newsapi_get($args)
{
    // Security check: by public status and group membership is integrated
    $id 	= (int)$args['id'];
    $gid 	= (int)$args['gid'];
    $count 	= (int)$args['count'];
    $onlyown 	= (int)$args['onlyown'];
    $since      = $args['since'];
    $category   = (int)$args['catfilter'];
    $infuture = (int)$args['infuture'];
    print $infuture;
    if (($onlyown == 1) && (!(pnUserGetVar('uid') > 1))) {
        return array();
    }
    if ($gid > 0) {
        $groupstatus = pnModAPIFunc('lobby','groups','isMember',array('uid' => pnUserGetVar('uid'), 'gid' => $gid));
    } else {
        $groupstatus = 0;
    }
    $tables = pnDBGetTables();
    $news_column = $tables['lobby_news_column'];
    $groups_column = $tables['lobby_groups_column'];
    $where = array();
    if ($gid > 0) {
        $where[] = "tbl.".$news_column['gid']." = ".$gid;
    }
    if ($category > 0) {
        $where[] = "b.".$groups_column['category']." = ".$category;
    }
    if ($id > 0) {
        $where[] = "tbl.".$news_column['id']." = ".$id;
    }
    if ($infuture != 1) {
        $where[] = "tbl.".$news_column['date']." <= '".date("Y-m-d H:i:s",time())."'";
    }
    if (isset($since) && ($since != '')) {
        $where[] = "tbl.".$news_column['date']." >= '".$since."'";
    }
    if (!pnUserLoggedIn()) {
            $mystatus = 0;
    } else {
        if ($groupstatus > 0) {
            $mystatus = 2;
        } else {
                $mystatus = 1;
        }
    }

    // add in part for sql query if no gid is given
    if (!($gid > 0)) {
        if (pnUserLoggedIn()) {
            // get user's groups an add them
            $groups = pnModAPIFunc('lobby','members','getMemberships',array('uid' => pnUserGetVar('uid')));
            if (count($groups) > 0) {
                $in = "(".implode(',',$groups).")";
            }
        }
    }
    // If only own groups should be displayed but there are no groups => return
    if (($onlyown == 1) && (!(count($groups) > 0))) {
        return array();
    }
    if (isset($in) && (strlen($in) > 0) && ($onlyown == 1)) {
        $where[] = "tbl.".$news_column['gid']." IN "."(".implode(',',$groups).")";
    } else if (isset($in) && (strlen($in) > 0)) {
        $where[] = "( tbl.".$news_column['public_status']." <= ".$mystatus." OR tbl.".$news_column['gid']." IN "."(".implode(',',$groups).") )";
    } else {
        $where[] = "tbl.".$news_column['public_status']." <= ".$mystatus;
    }
    $orderby 	= "tbl.".$news_column['date']." DESC";
    $numrows 	= $args['numrows'];
    $offset 	= $args['offset'];

    // build where part for sql query
    $wherestring = implode(' AND ',$where);
    // get result
    if ($count == 1) {
        $result = DBUtil::selectObjectCount('lobby_news',$wherestring);
    } else {
            // joinArray
        $joinInfo[] = array (	'join_table'          =>  'users',			// table for the join
                                'join_field'          =>  'uname',			// field in the join table that should be in the result with
                                'object_field_name'   =>  'uname',			// ...this name for the new column
                                'compare_field_table' =>  'uid',			// regular table column that should be equal to
                                'compare_field_join'  =>  'uid');			// ...the table in join_table
        $joinInfo[] = array (	'join_table'          =>  'lobby_groups',	// table for the join
                                'join_field'          =>  array('category','title'),			// field in the join table that should be in the result with
                                'object_field_name'   =>  array('category','group_title'),	// ...this name for the new column
                                'compare_field_table' =>  'gid',			// regular table column that should be equal to
                                'compare_field_join'  =>  'id');			// ...the table in join_table
        $result = DBUtil::selectExpandedObjectArray('lobby_news',$joinInfo,$wherestring,$orderby,$offset,$numrows);
    }
    if (!$result) {
        return array();
    }
    if ($id > 0) {
        return $result[0];
    } else {
        return $result;
    }
}

/**
 * Send an article to all group members
 *
 * @param $article	(object)		Article
 * @return boolean
 */
function lobby_newsapi_sendStory($story) {

	if (!$story || !($story['id'] > 0)) {
	  	return false;
	}
  	// Assign Data
    $render = pnRender::getInstance('lobby');
    $render->assign($story);
    $output = $render->fetch('lobby_email_story.htm');

	// Get Members and Group
	$members = pnModAPIFunc('lobby','members','get',array('gid' => $story['gid']));
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $story['gid']));
	
	// Prepare and send mail
    $subject = _LOBBY_GROUP_NEWS_FROM.' '.$group['title'].': '.$story['title'];
    $body = $output;
    foreach ($members as $m) {
	  	$to = pnUserGetVar('email',$m['uid']);
	  	if ($to != '') {
		    $result = pnMail($to, $subject, $body, array('header' => '\nMIME-Version: 1.0\nContent-type: text/html'), true);
			if (!$result) {
			  	return false;
			} 
		}
	}
	// Mark article as sent
	$obj = DBUtil::selectObjectByID('lobby_news',$story['id']);
	$obj['sent'] = 1;
	DBUtil::updateObject($obj,'lobby_news');
	// return success
	return true;
}

