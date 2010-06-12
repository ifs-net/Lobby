<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

Loader::includeOnce('modules/lobby/includes/common_members.php');

class lobby_user_pluginHandler
{
    var $uid;
    var $gid;
    var $moderator;
    function initialize(&$render)
    {	    
      	$gid = (int)FormUtil::getPassedValue('id');
      	$uid = (int)FormUtil::getPassedValue('uid');
      	$this->gid = $gid;
      	$this->uid = $uid;
      	$moderator = pnModAPIFunc('lobby','moderators','isModerator',array('uid' => $this->uid, 'gid' => $this->gid));
      	if ($moderator) {
		    $render->assign('moderator', 1);
		} else {
		    $render->assign('moderator', 0);
		}
      	// Get user
      	$user = pnModAPIFunc('lobby','members','get',array('gid' => $this->gid, 'uid' => $this->uid));
      	if (!isset($user) || !is_array($user)) {
		    LogUtil::registerError(_LOBBY_MEMBER_MANAGEMENT_GETERROR);
		    return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'membermanagement')));
		}
      	$render->assign($user);
		return true;
    }
    function handleCommand(&$render, &$args)
    {
		if ($args['commandName']=='update') {
		    // Security check 
		    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_COMMENT)) return LogUtil::registerPermissionError();

			// get the pnForm data and do a validation check
		    $obj = $render->pnFormGetValues();
		    if (!$render->pnFormIsValid()) return false;
		    
		    $moderator = pnModAPIFunc('lobby','moderators','isModerator',array('uid' => $this->uid, 'gid' => $this->gid));

		  	$isGroupOwner = pnModAPIFunc('lobby','groups','isOwner',array('id' => $this->gid, 'uid' => $this->uid));
		    // delete user?
		    if ($obj['delete'] == 1) {
			  	if ($isGroupOwner) {
					LogUtil::registerError(_LOBBY_GROUP_OWNER_NODELETE);
				} else {
					if ($moderator) {
					  	pnModAPIFunc('lobby','moderators','del',array('gid' => $this->gid, 'uid' => $this->uid));
					}
				  	$result = pnModAPIFunc('lobby','members','del',array('uid' => $this->uid, 'gid' => $this->gid));
				  	if ($result) {
					    LogUtil::registerStatus(_LOBBY_USER_DELETED.': '.pnUserGetVar($this->uid,'uname'));
					}
				}
			} else if (($obj['moderator'] == 1) && (!$moderator)) {
			  	pnModAPIFunc('lobby','moderators','add',array('gid' => $this->gid, 'uid' => $this->uid));
			} else if (($obj['moderator'] != 1) && ($moderator)) {
			  	if (!$isGroupOwner) {
				  	// If person was a moderator delete moderator status!
				  	pnModAPIFunc('lobby','moderators','del',array('gid' => $this->gid, 'uid' => $this->uid));
				} else {
					LogUtil::registerError(_LOBBY_GROUP_OWNER_NODELETE);
				}
			} else {
			  	// Otherwise say that we did nothing...
				LogUtil::registerStatus(_LOBBY_MEMBER_MANAGEMENT_NOCHANGE);
			}
			return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' =>  'membermanagement')));
		}
		return true;
    }
}