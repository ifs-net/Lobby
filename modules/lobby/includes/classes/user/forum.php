<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

class lobby_user_pluginHandler
{
    var $fid;
    var $gid;
    var $tid;
    var $pid;
    function initialize(&$render)
    {
     	$gid = (int)FormUtil::getPassedValue('id');
     	$fid = (int)FormUtil::getPassedValue('fid');
     	$tid = (int)FormUtil::getPassedValue('topic');
     	$this->tid = $tid;
     	$this->gid = $gid;
     	$this->fid = $fid;
     	
     	// is there an action to be done?
     	$action = FormUtil::getPassedValue('action');
     	if ($action == 'subscribe') {
     	  	if (!SecurityUtil::confirmAuthKey()) {
				LogUtil::registerAuthIDError();
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('do' => 'forum', 'id' => $gid, 'fid' => $fid, 'topic' => $tid)));
     	  	} else if ($tid > 0) {
				pnModAPIFunc('lobby','subscriptions','set',array('tid' => $tid, 'uid' => pnUserGetVar('uid')));
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('do' => 'forum', 'id' => $gid, 'fid' => $fid, 'topic' => $tid)));
			} else if ($fid > 0) {
				pnModAPIFunc('lobby','subscriptions','set',array('fid' => $fid, 'uid' => pnUserGetVar('uid')));
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('do' => 'forum', 'id' => $gid, 'fid' => $fid)));
			}
		} else if ($action == 'unsubscribe') {
     	  	if (!SecurityUtil::confirmAuthKey()) {
				LogUtil::registerAuthIDError();
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('do' => 'forum', 'id' => $gid, 'fid' => $fid, 'topic' => $tid)));
     	  	} else if ($tid > 0) {
				pnModAPIFunc('lobby','subscriptions','del',array('tid' => $tid, 'uid' => pnUserGetVar('uid')));
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('do' => 'forum', 'id' => $gid, 'fid' => $fid, 'topic' => $tid)));
			} else if ($fid > 0) {
				pnModAPIFunc('lobby','subscriptions','del',array('fid' => $fid, 'uid' => pnUserGetVar('uid')));
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('do' => 'forum', 'id' => $gid, 'fid' => $fid)));
			}
		} else if (($action == 'edit') && (!isset($this->pid))) { // We will handle it later to store the edited post
		  	// Assign editmode
		  	$pid = (int)FormUtil::getPassedValue('pid');
		  	$post = pnModAPIFunc('lobby','forumposts','get',array('id' => $pid));
		  	// Security Check
			$isModerator = pnModAPIFunc('lobby','moderators','isModerator',array('gid' => $this->gid, 'uid' => pnUserGetVar('uid')));
		  	// Load lib and check if Posting is really editable
		  	Loader::includeOnce('modules/lobby/includes/common_forum.php');
		  	if (!lobby_editablePost($post)) {
		  	  	if (!($isModerator || (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)))) {
				    LogUtil::registerError(_LOBBY_EDIT_NOTPOSSIBLE);
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'forum', 'fid' => $this->fid, 'topic' => $tid)));
				}
			}
		  	if ($post['uid'] == pnUserGetVar('uid') || $isModerator || (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN))) {
		  	  	// Assign content to Template
			  	$render->assign('editmode', 1);
			  	$render->assign($post);
			  	$this->pid = $post['id'];
			  	// check if really editable!
			  	// Todo
			} else {
			  	LogUtil::registerError(_LOBBY_NO_EDIT_PERMISSION);
			}
		} else if ($action == 'moderate') {
		  	$moderation = FormUtil::getPassedValue('moderation');
		  	// get group
		  	$group = pnModAPIFUnc('lobby','groups','get',array('id' => $this->gid));
			$groupOwner = (($group['uid'] == pnUserGetVar('uid')) || (SecurityUtil::checkPermission('lobby::'.$id, '::', ACCESS_ADMIN)));
			$isModerator = ($groupOwner || pnModAPIFunc('lobby','moderators','isModerator',array('gid' => $this->gid, 'uid' => pnUserGetVar('uid'))));
			if (!pnUserLoggedIn()) {
				$isModerator = false;
			}
			if (!$isModerator) {
			  	LogUtil::registerError(_LOBBY_ILLEGAL_MODERATOR_ACTION);
			} else if (SecurityUtil::confirmAuthKey()){
				$topic = DBUtil::selectObjectByID('lobby_forum_topics',$this->tid);
				if ($moderation == 'close') {
				  	LogUtil::registerStatus(_LOBBY_MODERATION_TOPIC_CLOSED);
				  	$topic['locked'] = 1;
				} else if ($moderation == 'reopen') {
				  	LogUtil::registerStatus(_LOBBY_MODERATION_TOPIC_REOPENED);
				  	$topic['locked'] = 0;
				} else if ($moderation == 'mark') {
				  	LogUtil::registerStatus(_LOBBY_MODERATION_TOPIC_MARKED);
				  	$topic['marked'] = 1;
				} else if ($moderation == 'unmark') {
				  	LogUtil::registerStatus(_LOBBY_MODERATION_TOPIC_UNMARKED);
				  	$topic['marked'] = 0;
				} else if ($moderation == 'delete') {
				  	LogUtil::registerStatus(_LOBBY_MODERATION_TOPIC_DELETED);
				  	pnModAPIFunc('lobby','forumtopics','del',array('id' => $topic['id']));
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $gid, 'sync' => 1, 'do' => 'forum', 'fid' => $fid)));
				} else if ($moderation == 'deleteposting') {
				  	$pid = (int)FormUtil::getPassedValue('pid');
				  	$posting = pnModAPIFunc('lobby','forumposts','get',array('id' => $pid));
				  	if ($posting['fid'] == $fid) {
				  	  	pnModAPIFunc('lobby','forumposts','del',array('id' => $pid));
				  	  	pnModAPIFunc('lobby','forumtopics','sync',array('id' => $posting['tid']));
				  	  	// Sync forum the topic was inside
				  	  	pnModAPIFunc('lobby','forums','sync',array('id' => $posting['fid']));
					  	LogUtil::registerStatus(_LOBBY_MODERATION_POSTING_DELETED);
					  	// Redirect now - sync already done... Otherwise the next updateobject will cancel our sync
						return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $gid, 'sync' => 1, 'do' => 'forum', 'fid' => $fid, 'topic' => $this->tid)));
					}
				} else if ($moderation == 'move') {
				  	// Get Parameter and move actual topic
				  	$to_forum = (int)FormUtil::getPassedValue('to_forum','POST');
				  	$result = pnModAPIFunc('lobby','forumtopics','move',array('id' => $this->tid, 'to' => $to_forum));
				  	if ($result) {
					    LogUtil::registerStatus(_LOBBY_TOPIC_MOVED);
					    // Sync forums of the group
				  	  	pnModAPIFunc('lobby','forums','sync',array('gid' => $gid));
						return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $gid, 'sync' => 1, 'do' => 'forum', 'fid' => $to_forum, 'topic' => $this->tid)));
					}
				}
				// Update topic
				$result = DBUtil::updateObject($topic,'lobby_forum_topics');
				if (!$result) {
					LogUtil::registerError(_LOBBY_TOPIC_UPDATE_FAILED);
				} else {
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $gid, 'sync' => 1, 'do' => 'forum', 'fid' => $fid, 'topic' => $tid)));
				}
			} else {
				LogUtil::registerAuthIDError();
			}
		}
     	
     	// load forum for group
     	$forum = pnModAPIFunc('lobby','forums','get',array('id' => $this->fid, 'gid' => $this->gid));
     	// no forum?
     	if (!($forum['id'] > 0) || ($forum['gid'] != $this->gid)) {
			LogUtil::registerError(_LOBBY_NO_FORUM_SELECTED);
			return pnRedirect(pnModURL('lobby','user','group',array('do'=>'forums', 'id' => $gid)));
		}
     	$render->assign('forum', $forum);
     	// offset and numrows..
     	// Now we need to check if a topic should be loaded or the complete topic index of a forum is needed
	  	$offset = (int)FormUtil::getPassedValue('lobbypager');
	  	if ($offset > 0) {
		    $offset--;
		}
     	if ($tid > 0) {
		  	$mode="posts";
		  	// number of posts per page;
     	  	$numrows = pnModGetVar('lobby','postsperpage');
	     	// assign topic - needed in topic and postings view
	     	$topic = pnModAPIFunc('lobby','forumtopics','get',array('id' => $this->tid, 'gid' => $this->gid));
			// load a special topic
	     	$posts = pnModAPIFunc('lobby','forumposts','get',array('tid' => $this->tid, 'numrows' => $numrows, 'offset' => $offset));
	     	$render->assign('posts',$posts);
	     	$render->assign('topic', $topic);
	     	// assign title for new reply
	     	if ($action != 'edit') {
			   $render->assign('title', _LOBBY_FORUM_REPLY_PREFIX.': '.$topic['title']);
			}
	     	$render->assign('postcount', ($topic['replies']+1));
			// Set page title
			PageUtil::setVar('title', $topic['title']." :: ".$forum['title']);
		} else {
		  	$mode="topics";
		  	// number of posts per page;
     	  	$numrows 	 = pnModGetVar('lobby','topicsperpage');
     	  	$postsperpage = pnModGetVar('lobby','postsperpage');
	     	// load postings
	     	$topics 	= pnModAPIFunc('lobby','forumtopics','get',array('fid' => $this->fid, 'numrows' => $numrows, 'offset' => $offset, 'gid' => $this->gid, 'sticky' => 1));
	     	$render->assign('topics',		$topics);
	     	$render->assign('postsperpage', $postsperpage);
			// Set page title
			PageUtil::setVar('title', $forum['title']);
		}
		$render->assign('mode',$mode);
     	$render->assign('numrows', $numrows);
		return true;
    }
    
    function handleCommand(&$render, &$args)
    {
		if ($args['commandName'] == 'update') {
			// get the form data and do a validation check
		    $obj = $render->pnFormGetValues();		    
		    // are we in edit mode?
		    if ($this->pid > 0) {
			  	// Load lib and check if Posting is really editable
			  	$pid = (int)FormUtil::getPassedValue('pid');
			  	$post = pnModAPIFunc('lobby','forumposts','get',array('id' => $pid));
				$isModerator = pnModAPIFunc('lobby','moderators','isModerator',array('gid' => $this->gid, 'uid' => pnUserGetVar('uid')));
			  	Loader::includeOnce('modules/lobby/includes/common_forum.php');
			  	if (!lobby_editablePost($post)) {
			  	  	if (!($isModerator || (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)))) {
					    LogUtil::registerError(_LOBBY_EDIT_NOTPOSSIBLE);
						return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'forum', 'fid' => $this->fid, 'topic' => $tid)));
					}
				}
				// We have to update / store a posting
				$obj1 = DBUtil::selectObjectByID('lobby_forum_posts',$this->pid);
				$obj2 = DBUtil::selectObjectByID('lobby_forum_posts_text',$this->pid);
				$obj1['title'] = $obj['title'];
			  	$bbcode = pnModIsHooked('bbcode','lobby');
			  	if ($bbcode) {
				    $bbcode_start = "[size=small][i]";
				    $bbcode_end = "[/i][/size]";
				}
				$obj2['text'] = $obj['text'].$bbcode_start."\n
				"._LOBBY_LAST_EDITED.': '.date("Y-m-d H:i:s",time()).' '._LOBBY_BY.' '.pnUserGetVar('uname').$bbcode_end."\n";
				$tables = pnDBGetTables();
				$posts_column = $tables['lobby_forum_posts_column'];
				$poststext_column = $tables['lobby_forum_posts_text_column'];
				$obj['title'] = DataUtil::formatForStore($obj1['title']);
				$obj['text'] = DataUtil::formatForStore($obj2['text']);
				$sql1 = "UPDATE ".$tables['lobby_forum_posts']." SET ".$posts_column['title']." = '".$obj['title']."' WHERE ".$posts_column['id']." = ".$this->pid;
				$sql2 = "UPDATE ".$tables['lobby_forum_posts_text']." SET ".$poststext_column['text']." = '".$obj['text']."' WHERE ".$poststext_column['id']." = ".$this->pid;
				$result = DBUtil::executeSQL($sql1);
//DBUtil-Bug?				$result = DBUtil::updateObject($obj1,'lobby_forums_posts',$posts_column['id']);
				if ($result) {
					$result2 = DBUtil::executeSQL($sql2);
//DBUtil-Bug?			  	$result2 = DBUtil::updateObject($obj2,'lobby_forums_posts_text',$posts_column['id'],true,false);
				}
				// print message
				if ($result2) {
					LogUtil::registerStatus(_LOBBY_POST_MODIFIED);
					// return to topic and sync before returning
			  	  	pnModAPIFunc('lobby','forums','sync',array('id' => $this->fid));
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'forum', 'fid' => $this->fid, 'topic' => $this->tid)));
				} else {
				  	LogUtil::registerError(_LOBBY_POST_MODIFY_ERROR);
				  	return false;
				}
			}
		    // get Variables
			$obj['uid'] = pnUserGetVar('uid');
			$obj['gid'] = $this->gid;
			$obj['fid'] = $this->fid;
		    // preview mode?
		    if ($obj['preview'] == 1) {
				LogUtil::registerStatus(_LOBBY_FORUM_PREVIEW);
				$render->assign('preview', 	1);
				$render->assign('title',	$obj['title']);
				$render->assign('text',		$obj['text']);
			}
			else {
			    if (!$render->pnFormIsValid()) return false;
			    // store or update group
			    if ($this->id > 0) {
					$obj['id'] = $this->id;
			      	// Is there an action to be done?			      	
				} else {
					if ($this->tid > 0) {	// add new post
						$obj['tid'] = $this->tid;
						$pid = pnModAPIFunc('lobby','forumposts','add',$obj);
						
						// Sync topic
						pnModAPIFunc('lobby','forumtopics','sync',array('id' => $this->tid));

						// get lobbypager value
					  	$postsperpage 	= pnModGetVar('lobby','postsperpage');
					  	$topic 			= pnModAPIFunc('lobby','forumtopics','get',array('id' => $this->tid, 'fid' => $this->fid));
						$replies 		= $topic['replies'];
						$page 			= floor($replies/$postsperpage);
						if ($page == 0) {
						  	$lobbypager = 1;
						} else {
							$lobbypager 	= ($page*10)+1;
						}
						return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'sync' => 1, 'do' => 'forum', 'fid' => $this->fid, 'topic' => $this->tid, 'lobbypager' => $lobbypager))."#".$pid);
					} else {				// add new topic
						$newtopic = pnModAPIFunc('lobby','forumtopics','add',$obj);
						$tid  = $newtopic['id'];
						if ($tid > 0) {
						  	// return to new topic but sync before doing this
					  	  	pnModAPIFunc('lobby','forums','sync',array('id' => $this->fid));
							return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'sync' => 1, 'do' => 'forum', 'fid' => $this->fid, 'topic' => $tid)));
						} else {
							LogUtil::registerError(_LOBBY_TOPIC_CREATION_ERROR);
							return false;
						}
					}
				}
			}
		}
		return true;
    }
}
