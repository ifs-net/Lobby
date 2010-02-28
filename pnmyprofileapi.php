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
 * on Load function
 *
 * @return void
 */
function lobby_myprofileapi_onLoad() {
  	return true;
}

/**
 * This function returns 1 if Ajax should not be used loading the plugin
 *
 * @return string
 */

function lobby_myprofileapi_noAjax($args)
{
  	return true;
}

/**
 * This function returns the name of the tab
 *
 * @return string
 */
function lobby_myprofileapi_getTitle($args)
{
  	$uid = (int)FormUtil::getPassedValue('uid');
  	$memberships = pnModAPIFunc('lobby','members','getMemberships',array('uid' => $uid));
  	$counter = count($memberships);
  	if ($counter > 0) {
	    pnModLangLoad('lobby','myprofile');
	    return _LOBBY_TABTITLE;
	} else {
	  	return false;
	}
}

/**
 * This function returns additional options that should be added to the plugin url
 *
 * @return string
 */
function lobby_myprofileapi_getURLAddOn($args)
{
    return '';
}

/**
 * This function shows the content of the main MyProfile tab
 *
 * @return output
 */
function lobby_myprofileapi_tab($args)
{
    // Security check 
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) return LogUtil::registerPermissionError();

	// Load lang defines
    pnModLangLoad('lobby','myprofile');

	// Get parameter
    $uid = FormUtil::getPassedValue('uid');
    if (!isset($uid) || (!($uid>0))) {
		logUtil::registerError(_LOBBY_NOUSERSPECIFIED);
		return pnRedirect(pnModURL('lobby','user','main'));
    }
    
    // Get groups
  	$memberships = pnModAPIFunc('lobby','members','getMemberships',array('uid' => $uid));
  	$groups = array();
    foreach ($memberships as $ms) {
	  	$group  = pnModAPIFunc('lobby','groups','get',array('id' => $ms));
	  	$status = pnModAPIFunc('lobby','groups','getMemberStatus',array('uid' => $uid, 'group' => $group));
	  	if ($status == 2) {
		    $group['owner'] = 1;
		} else {
		  	$isMod = pnModAPIFunc('lobby','moderator','isModerator',array('gid' => $group['id'], 'uid' => $uid));
		  	if ($isMod) {
			    $group['moderator'] = 1;
			}
		}
		$groups[] = $group;
	}
    
    // Get render instance
	$render = pnRender::getInstance('lobby');
	
	// Assign variales
	$render->assign('uname', pnUserGetVar('uname',$uid));
	$render->assign('groups', $groups);
	
	// Get output
	$output = $render->fetch('lobby_myprofile_tab.htm');
	return $output;
}

