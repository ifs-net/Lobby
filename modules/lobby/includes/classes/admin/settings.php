<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

class lobby_admin_settingsHandler
{
    var $id;
    function initialize(&$render)
    {	    
		$modvars = pnModGetVar('lobby');
		$render->assign($modvars);
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
		    pnModSetVar('lobby','postsperpage',		$obj['postsperpage']);
		    pnModSetVar('lobby','topicsperpage',	$obj['topicsperpage']);
		    pnModSetVar('lobby','newsperpage',		$obj['newsperpage']);
		    pnModSetVar('lobby','creategroupurl',	$obj['creategroupurl']);
		    LogUtil::registerStatus(_LOBBBY_SETTINGS_STORED);
		    return $render->pnFormRedirect(pnModURL('lobby','admin','settings'));
		}
		return $render->pnFormRedirect(pnModURL('lobby','admin','categories'));
    }
}
