<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

pnModLangLoad('lobby','email');

/**
 * notification to admin about a new group
 *
 */
function lobby_notify_newgroup($obj) 
{
  	$adminmail = pnConfigGetVar('adminmail');
  	if (isset($adminmail)) {
		$render = pnRender::getInstance('lobby');
		$render->assign($obj);
		$category = pnModAPIFunc('lobby','categories','get',array('id' => $obj['ud']));
		if ($category['accepted'] != 1) {
			$render->assign('official', 1);
		}
		$message = $render->fetch('lobby_email_newgroup.htm');
		$subject = _LOBBY_EMAIL_NEW_GROUP_FOR." ".pnConfigGetVar('sitename');
		$result = pnMail($adminmail, $subject, $message, $headers, $html); 
		return $result;
	}
}

/**
 * new group accepted by admin
 *
 */
function lobby_notify_groupaccepted($gid)
{
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $gid));
	$render = pnRender::getInstance('lobby');
	$render->assign($group);
	$message = $render->fetch('lobby_email_groupaccepted.htm');
	$subject = '"'.$group['title'].'" '._LOBBY_EMAIL_ACCEPTED_AT."  ".pnConfigGetVar('sitename');
	$to = pnUserGetVar('email', (int)$group['uid']);
	$result = pnMail($to, $subject, $message, $headers, $html); 
	return $result;
}


/**
 * new member waiting or added
 *
 */
function lobby_notify_newmember($gid, $uid)
{
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $gid));
	$render = pnRender::getInstance('lobby');
	$render->assign($group);
	$render->assign('uname',pnUserGetVar('uname',$uid));
	$message = $render->fetch('lobby_email_newmember.htm');
	if ($group['moderated'] == 1) {
	  	$subject = _LOBBY_EMAIL_NEW_REQUEST_FOR_GROUP;
	} else {
	  	$subject = _LOBBY_EMAIL_NEW_GROUP_MEMBER_FOR;
	}
	$subject.= ' "'.$group['title'].'" '._LOBBY_EMAIL_AT."  ".pnConfigGetVar('sitename');
	$to = pnUserGetVar('email', (int)$group['uid']);
	$result = pnMail($to, $subject, $message, $headers, $html); 
	return $result;
}

/**
 * member deleted group membership, notification for group owner
 *
 */
function lobby_notify_quitmember($gid, $uid, $text)
{
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $gid));
	$render = pnRender::getInstance('lobby');
	$render->assign($group);
	if ($text != '') {
		$render->assign('text', $text);
	}
	$render->assign('uname',pnUserGetVar('uname',$uid));
	$message = $render->fetch('lobby_email_quitmember.htm');
  	$subject = _LOBBY_EMAIL_MEMBERSHIP_ENDED;
	$subject.= ' "'.$group['title'].'" '._LOBBY_EMAIL_AT."  ".pnConfigGetVar('sitename');
	$to = pnUserGetVar('email', (int)$group['uid']);
	$result = pnMail($to, $subject, $message, $headers, $html); 
	return $result;
}

/**
 * reject a membership request
 *
 */
function lobby_notify_rejectmembershiprequest($group, $uid)
{
	$render = pnRender::getInstance('lobby');
	$render->assign($group);
	$render->assign('youruname',pnUserGetVar('uname',$uid));
	$message = $render->fetch('lobby_email_requestrejected.htm');
	$subject = _LOBBY_MEMBERSHIP_REQUEST_FOR.' "'.$group['title'].'" '._LOBBY_WAS_REJECTED;
	$to = pnUserGetVar('email', (int)$uid);
	$result = pnMail($to, $subject, $message, $headers, $html); 
	return $result;	
}

/**
 * accept a membership request
 *
 */
function lobby_notify_newgroupmember($group,$uid)
{
	$render = pnRender::getInstance('lobby');
	$render->assign($group);
	$render->assign('youruname',pnUserGetVar('uname',$uid));
	$message = $render->fetch('lobby_email_requestaccepted.htm');
	$subject = _LOBBY_MEMBERSHIP_REQUEST_FOR.' "'.$group['title'].'" '._LOBBY_WAS_ACCEPTED;
	$to = pnUserGetVar('email', (int)$uid);
	$result = pnMail($to, $subject, $message, $headers, $html); 
	return $result;	
}

/**
 * send new topic information
 *
 */
function lobby_notify_newtopic($topic,$title,$text,$poster,$fid,$tid)
{
  	// get all subscribers for forum
  	$forum_subscribers = pnModAPIFunc('lobby','subscriptions','get',array('fid' => $topic['fid']));
  	$emails = array();
  	foreach ($forum_subscribers as $x) {
		$uid = $x['uid'];
		$email = pnUserGetVar('email',$uid);
		if (isset($email) && ($email != '')) {
		  	$emails[$uid] = $email;
		}
	}
	// send mails to subscribers
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $topic['gid']));
	foreach ($emails as $uid=>$to) {
	  	if ($uid != pnUserGetVar('uid')) {
		  	$render = pnRender::getInstance('lobby');
		  	$render->assign('uname', pnUserGetVar('uname',$uid));
		  	$render->assign('posteruname', pnUserGetVar('uname',$poster));
		  	$render->assign('title',	$title);
		  	$render->assign('text',	$text);
		  	$render->assign('tid',	$tid);
		  	$render->assign('fid',	$fid);
		  	$render->assign('id',	$topic['gid']);
		  	$message = $render->fetch('lobby_email_topicnotify.htm');
		  	$subject = _LOBBY_EMAIL_NEWTOPIC_GROUP.' "'.$group['title'].'" '._LOBBY_EMAIL_AT.' "'.pnConfigGetVar('sitename').'"';
			$result = pnMail($to, $subject, $message, $headers, $html); 
		}
	}
}

/**
 * send new reply information
 *
 */
function lobby_notify_newreply($topic,$posting)
{
  	// get all subscribers for forum
  	$forum_subscribers = pnModAPIFunc('lobby','subscriptions','get',array('fid' => $topic['fid']));
  	$emails = array();
  	foreach ($forum_subscribers as $x) {
		$uid = $x['uid'];
		$email = pnUserGetVar('email',$uid);
		if (isset($email) && ($email != '')) {
		  	$emails[$uid] = $email;
		}
	}
	// get all subscribers to topic
  	$topic_subscribers = pnModAPIFunc('lobby','subscriptions','get',array('tid' => $topic['id']));
  	foreach ($topic_subscribers as $x) {
		$uid = $x['uid'];
		$email = pnUserGetVar('email',$uid);
		if (isset($email) && ($email != '')) {
		  	$emails[$uid] = $email;
		}
	}
	// get lobbypager value
  	$postsperpage 	= pnModGetVar('lobby','postsperpage');
	$replies 		= $topic['replies'];
	$page 			= floor($replies/$postsperpage);
	if ($page == 0) {
	  	$lobbypager = 1;
	} else {
		$lobbypager 	= ($page*10)+1;
	}
	// send mails to subscribers
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $topic['gid']));
	foreach ($emails as $uid=>$to) {
	  	if ($uid != pnUserGetVar('uid')) {
		  	$render = pnRender::getInstance('lobby');
		  	$render->assign('lobbypager', $lobbypager);
		  	$render->assign('uname', pnUserGetVar('uname',$uid));
		  	$render->assign('posteruname', pnUserGetVar('uname',$posting['uid']));
		  	$render->assign('topicuname', pnUserGetVar('uname',$topic['uid']));
		  	$render->assign('topic',	$topic);
		  	$render->assign('posting',	$posting);
		  	$message = $render->fetch('lobby_email_replynotify.htm');
		  	$subject = _LOBBY_EMAIL_NEWREPLY.' "'.$posting['title'].'" '._LOBBY_IN_GROUP.' "'.$group['title'].'" '._LOBBY_EMAIL_AT.' "'.pnConfigGetVar('sitename').'"';
			$result = pnMail($to, $subject, $message, $headers, $html); 
		}
	}
}

/**
 * send invitation to a user
 *
 */
function lobby_notify_invitation($group,$uid,$from_uid,$text)
{
	$render = pnRender::getInstance('lobby');
	$render->assign($group);
	$render->assign($uid);
	$uname = pnUserGetVar('uname',$from_uid);
	$render->assign('youruname',pnUserGetVar('uname',$uid));
	$render->assign('uname',$uname);
	$render->assign('group',$group);
	$message = $render->fetch('lobby_email_invitation.htm');
	$subject = _LOBBY_GROUP_INVITATION_FOR.' "'.$group['title'].'" '._LOBBY_FROM." ".$uname;
	$to = pnUserGetVar('email', (int)$uid);
	$result = pnMail($to, $subject, $message, $headers, $html); 
	return $result;	
}