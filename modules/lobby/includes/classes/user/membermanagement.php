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
    var $id;
    var $gid;
    function initialize(&$render)
    {	    
      	$gid = (int)FormUtil::getPassedValue('id');
      	$this->gid = $gid;
      	// Get user list
      	$users = pnModAPIFunc('lobby','members','get',array('gid' => $this->gid));
      	$users_items = lobby_membersToPullDown($users);
      	$render->assign('users_items', $users_items);
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
		    // user is loaded now.
		  	return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'membermanagement', 'action' => 'modify', 'uid' => $obj['user'])));
		}
		return true;
    }
}
