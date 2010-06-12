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
  	var $id;
	function initialize(&$render)
    {	    
    	$this->id = FormUtil::getPassedValue('id');
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

		    // Handle the join request
		    pnModAPIFunc('lobby','members','add',array(
				'text'	=> $obj['text'],
				'uid'	=> pnUserGetVar('uid'),
				'gid'	=> $this->id
				));
			// send Mail
			Loader::includeOnce('modules/lobby/includes/common_email.php');
			lobby_notify_newmember($this->id, pnUserGetVar('uid'));
			return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->id)));
		}
		return true;
    }
}
