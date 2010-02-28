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
 * return news as rss
 * 
 * @return       output       The main module page
 */
function lobby_rss_news()
{
 	// Create output and call handler class
	$render = pnRender::getInstance('lobby');

	// Get parameters
	$id = (int)FormUtil::getPassedValue('id');	
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $id));
	if ($group['id'] != $id) {
		print "group not found";
		return true;
	}
	
	// Assign variables
	$articles = pnModAPIFunc('lobby','news','get',array('gid' => $id, 'numrows' => 50));
	$group['date'] = date('r', strtotime($group['date']));
	$render->assign('group',		$group);
	$render->assign('author',		pnUserGetVar('uname',$group['uid']));

	foreach ($articles as $a) {
	  	$a['date'] = date('r',strtotime($a['date']));
		$r[] = $a;
	}
	$render->assign('articles', 	$r);

    // Return the output
    $output = $render->display('lobby_rss_news.htm');
	header ("content-type: text/xml");
    print $output;
    return true;
}

/**
 * return new members as rss
 * 
 * @return       output       The main module page
 */
function lobby_rss_members()
{
 	// Create output and call handler class
	$render = pnRender::getInstance('lobby');

	// Get parameters
	$id = (int)FormUtil::getPassedValue('id');	
	$group = pnModAPIFunc('lobby','groups','get',array('id' => $id));
	if ($group['id'] != $id) {
		print "group not found";
		return true;
	}


	// Assign variables
    $members = pnModAPIFunc('lobby','members','get',array('gid' => $group['id'], 'numrows' => 100, 'offset' => null, 'sort' => 'latest'));
	$render->assign('members',		$members);
	$render->assign('group',		$group);

    // Return the output
    $output = $render->display('lobby_rss_members.htm');
	header ("content-type: text/xml");
    print $output;
    return true;
}
