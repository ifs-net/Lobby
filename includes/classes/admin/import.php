<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

class lobby_admin_importHandler
{
    var $id;
    function initialize(&$render)
    {	    
      	// Get Groups groups
      	$groups = pnModAPIFunc('Groups','user','getall');
      	$groups_items = array( array('text' => _LOBBY_SELECT_FOR_ACTION, 'value' => -1) );
      	foreach ($groups as $group) {
		    $groups_items[] =	array('text' => $group['name'], 'value' => $group['gid']);
		}
		// Get lobby groups
		$groups = pnModAPIFunc('lobby','groups','get');
      	$lobby_groups_items = array( array('text' => _LOBBY_SELECT_FOR_ACTION, 'value' => -1) );
      	foreach ($groups as $group) {
      	  	$sort_groups[$group['id']] = $group;	// we need this later for forum import
		    $lobby_groups_items[] =	array('text' => $group['title'], 'value' => $group['id']);
		}

		$dizkus = pnModAvailable('Dizkus');
		if ($dizkus) {
			// Get lobby forums
		  	$lobby_forums = pnModAPIFunc('lobby','forums','get',array('showall' => 1));
	      	$lobby_forums_items = array( array('text' => _LOBBY_SELECT_FOR_ACTION, 'value' => -1) );
	      	foreach ($lobby_forums as $forum) {
				$gid = $forum['gid'];
				$grouptitle = $sort_groups[$gid]['title'];
			    $lobby_forums_items[] =	array('text' => $forum['id'].': '.$grouptitle.' - '.$forum['title'], 'value' => $forum['id']);
			}
			// Get Dizkus forums
	      	$forums_items = array( array('text' => _LOBBY_SELECT_FOR_ACTION, 'value' => -1) );
			$forums = pnModAPIFunc('Dizkus','admin','readforums');
			foreach ($forums as $forum) {
			 	$forums_items[] = array( 'text' => $forum['forum_id'].': '.$forum['forum_name'], 'value' => $forum['forum_id']);
			}
		}
		
		// Assign data
		$render->assign('dizkus',               $dizkus);
		$render->assign('groups_items',         $groups_items);
		$render->assign('lobby_groups_items',   $lobby_groups_items);
		$render->assign('forums_items',         $forums_items);
		$render->assign('lobby_forums_items',   $lobby_forums_items);
				
		return true;
    }
    function handleCommand(&$render, &$args)
    {
	    // Security check 
	    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) {
		  	return LogUtil::registerPermissionError();
		}
		if ($args['commandName']=='update') {
			// get the pnForm data and do a validation check
		    $obj = $render->pnFormGetValues();
		    if (!$render->pnFormIsValid()) return false;
		 
		 	if (($obj['group'] > 0) && ($obj['lobby_group'])) {
		 	  	$counter=0;
				// Import group
				// Get members of Groups group
				$group = pnModAPIFunc('Groups','user','get',array('gid' => $obj['group']));
				$users = $group['members'];
				$date  = date("Y-m-h H:i:s",time());
				foreach ($users as $user) {
				  	// Check if user is already a member
					$isMember = pnModAPIFunc('lobby','groups','isMember',array('uid' => $user['uid'], 'gid' => $obj['lobby_group']));
					if ($isMember) {
					  	LogUtil::registerStatus(_LOBBY_IMPORT_SKIP_USER.': '.pnUserGetVar('uname',$user['uid']));
					} else {
					  	$insert = array(
						  		'uid'  => $user['uid'],
						  		'gid'  => $obj['lobby_group'],
						  		'date' => $date
							);
						$result = DBUtil::insertObject($insert,'lobby_members');
						if ($result) {
						  	LogUtil::registerStatus(_LOBBY_ADDED_USER.': '.pnUserGetVar('uname',$user['uid']));
						  	$counter++;
						} else {
						  	LogUtil::registerError(_LOBBY_FAILED_USER.': '.pnUserGetVar('uname',$user['uid']));
						}
					}
				}
				pnModAPIFunc('lobby','groups','sync',array('id' => $obj['lobby_group']));
				LogUtil::registerStatus(_LOBBY_IMPORTED_USERS.': '.$counter);
			} else if (($obj['forum'] > 0) && ($obj['lobby_forum'])) {
			  	// Get target group
			  	pnModLangLoad('lobby','user');
			  	$lobby_forum = pnModAPIFunc('lobby','forums','get',array('id' => $obj['lobby_forum'],'showall' => 1));
			  	$lobby_group = pnModAPIFunc('lobby','groups','get',array('id' => $lobby_forum['gid']));

				// Import forum
				$forum = pnModAPIFunc('Dizkus','user','readforum',array('forum_id' => $obj['forum'], 'topics_per_page' => -1));
				$counter_topics = 0;
				$counter_posts  = 0;
				$topics = $forum['topics'];
				foreach ($topics as $topic) {
				  	$topic = pnModAPIFunc('Dizkus','user','readtopic',array('topic_id' => $topic['topic_id'], 'complete' => true));
 					$title = $topic['topic_title'];
 					$posts = $topic['posts'];
 					$text = $posts[0]['post_text'];
 					//$text = str_replace("<br />","\n",$text);
				  	$args = array (
				  		'gid'	=> $lobby_group['id'],
				  		'fid'	=> $lobby_forum['id'],
				  		'uid'	=> $posts[0]['poster_data']['uid'],
				  		'title'	=> $title,
				  		'text'	=> $text,
				  		'date'	=> $posts[0]['post_time'],
				  		'quiet' => true
					  );
					$result = pnModAPIFunc('lobby','forumtopics','add',$args);
					if ($result) {
					  	$tid = $result['id'];
					  	LogUtil::registerStatus(_LOBBY_TOPIC_IMPORTED.': '.$title.' ('.$tid.')');
					  	$first = true;
					  	foreach ($posts as $post) {
					  	  	if (!$first) {
							  	$args = array (
							  		'tid'	=> $tid,
							  		'gid'	=> $lobby_group['id'],
							  		'fid'	=> $lobby_forum['id'],
							  		'uid'	=> $post['poster_data']['uid'],
							  		'title'	=> $title,
							  		'text'	=> $post['post_text'],
							  		'quiet' => true,
							  		'date'	=> $post['post_time']
								  );
					  	  	  	$result2 = pnModAPIFunc('lobby','forumposts','add',$args);
					  	  	  	if (!$result2) {
									LogUtil::registerError(_LOBBY_POSTING_IMPORT_ERROR);
								}
							} else {
								$first = false;
							}
						}
					  	// Sync topic
				  	  	pnModAPIFunc('lobby','forumtopics','sync',array('id' => $tid));
					} else {
					  	LogUtil::registerError(_LOBBY_TOPIC_IMPORT_ERROR.': ID '.$tid);
					}
				pnModAPIFunc('lobby','groups','sync',array('id' => $lobby_forum['gid']));
				}
			} else {
			  	LogUtil::registerError(_LOBBY_NO_IMPORT_SELECTED);
			}
		}
		// return with redirect
		return $render->pnFormRedirect(pnModURL('lobby','admin','import'));
    }
}
