<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

function smarty_function_subscription($params, &$smarty)
{
	$fid = (int)$params['fid'];
	$tid = (int)$params['tid'];
	$status = (int)$params['status'];
	$gid = (int)$params['gid'];

	$authid = SecurityUtil::generateAuthKey();
	$c='';
	
//	if ($status < 1) {
//	  	return '';
//	}
	
	if ($tid > 0) {
	  	// Check if forum itself is subscribed
	  	$f_subscribed = pnModAPIFunc('lobby','subscriptions','get',array('fid' => $fid, 'uid' => pnUserGetVar('uid')));
	  	if ($f_subscribed) {
		    $c.='<a href="'.pnModURL('lobby','user','group',array('id' => $gid, 'do' => 'forum', 'fid' => $fid)).'">'._LOBBY_CFORUM_SUBSCRIBED.'</a>';
		} else {
			$subscribed = pnModAPIFunc('lobby','subscriptions','get',array('tid' => $tid, 'uid' => pnUserGetVar('uid')));
			if ($subscribed) {
			  	$c.=_LOBBY_FORUM_SUBSCRIBED.', <a href="'.pnModURL('lobby','user','group',array('id' => $gid, 'do' => 'forum', 'fid' => $fid, 'topic' => $tid, 'action' => 'unsubscribe', 'authid' => $authid)).'">'._LOBBY_FORUM_UNSUBSCRIBE."</a>";
			} else {
			  	$c.=_LOBBY_FORUM_NOT_SUBSCRIBED.', <a href="'.pnModURL('lobby','user','group',array('id' => $gid, 'do' => 'forum', 'fid' => $fid, 'topic' => $tid, 'action' => 'subscribe', 'authid' => $authid)).'">'._LOBBY_FORUM_SUBSCRIBE."</a>";
			}
		}
	} else if ($fid > 0) {
		$subscribed = pnModAPIFunc('lobby','subscriptions','get',array('fid' => $fid, 'uid' => pnUserGetVar('uid')));
		if ($subscribed) {
	  	$c.=_LOBBY_FORUM_SUBSCRIBED.', <a href="'.pnModURL('lobby','user','group',array('id' => $gid, 'do' => 'forum', 'fid' => $fid, 'action' => 'unsubscribe', 'authid' => $authid)).'">'._LOBBY_FORUM_UNSUBSCRIBE."</a>";
		} else {
		  	$c.=_LOBBY_FORUM_NOT_SUBSCRIBED.', <a href="'.pnModURL('lobby','user','group',array('id' => $gid, 'do' => 'forum', 'fid' => $fid, 'action' => 'subscribe', 'authid' => $authid)).'">'._LOBBY_FORUM_SUBSCRIBE."</a>";
		}
	} else {
		return '';
	}
	// return text
	return $c;
}
