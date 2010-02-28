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
 * Smarty modifier to create a link to a topic
 *
 * Available parameters:

 * Example
 *
 *   <!--[$uid|userlink uname=$uname]-->
 *
 * @param        array    $string     the contents to transform
 * @return       string   the modified output
 */
function smarty_function_userlink($params, &$smarty)
{
  	$uid = $params['uid'];
  	$uname = $params['uname'];
  	$float = $params['float'];
  	$backgroundcolor = $params['backgroundcolor'];

	// at least we need a user id
    if(!isset($uid)) {
        return '';
    }

	if (!isset($float)) {
	  	$float = 'left';
	}
	// get user's avatar
	$avatar = pnUserGetVar('_YOURAVATAR',$uid);
	if (($avatar != '') && ($avatar != 'blank.gif')) {
	  	$avatar = pnGetBaseURL().'images/avatar/'.$avatar;
	} else {
		 $avatar = pnGetBaseURL().'images/icons/large/mac.gif';
	}

	// username given as parameter?
	if (!isset($uname) || ($uname == '')) {
		$uname = pnUserGetVar('uname',$uid);
	}

	// get static variables to create unique number for THIS plugin call
  	static $lobby_unique_counter;

	// count...
  	if (!($lobby_unique_counter > 0)) {
	    $lobby_unique_counter = 1;
	} else {
	 	$lobby_unique_counter++;
	}
	
	// return unique value for this modifier call...	
	$number = $lobby_unique_counter;

	// create output
	$render = pnRender::getInstance('lobby');
	
	// assign variables
	$render->assign('avatar',	$avatar);
	$render->assign('uname', 	$uname);
	$render->assign('number', 	$number);
	$render->assign('uid',		$uid);
	$render->assign('float',	$float);
	if (isset($backgroundcolor) && (strlen($backgroundcolor) > 0)) {
	  	$backgroundcolor = "background-color: ".$backgroundcolor.";";
		$render->assign('backgroundcolor',	$backgroundcolor);
	}
	
	// return created output
	return 	$render->fetch('lobby_plugins_userlink.htm');
}
