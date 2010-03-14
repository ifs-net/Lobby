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
 * switch memnbers into form pulldown format
 *
 */
function lobby_groupsync($id)
{
  	// Check parameter
  	$id = (int)$id;
  	if (!($id > 0)) {
	    return false;
	}

	// get group object without caching
	$group = DBUtil::selectObjectByID('lobby_groups',$id,'id',null,null,null,false,null);
	
  	// sync members
  	$group['members'] = (int)DBUtil::selectObjectCountByID('lobby_members',$id,'gid');

  	// sync albums
  	$group['albums'] = (int)DBUtil::selectObjectCountByID('lobby_albums',$id,'gid');
  	
  	// sync articles
  	$group['articles'] = (int)DBUtil::selectObjectCountByID('lobby_news',$id,'gid');

  	// sync topics
  	$group['topics'] = DBUtil::selectObjectCountByID('lobby_forum_topics',$id,'gid');
  	
  	// sync postings
  	// get forums first
  	$forums = DBUtil::selectObjectArray('lobby_forums','gid = '.$id);
  	$fres = array();
  	foreach ($forums as $item) {
        $fres[] = $item['id'];
    }
    if (count($fres) > 0) {
        $fstring = implode(', ',$fres);
      	$group['postings'] = DBUtil::selectObjectCount('lobby_forum_posts','fid IN ('.$fstring.')');
    } else {
        $group['postings'] = 0;
    }

  	// sync forums
  	$group['forums'] = DBUtil::selectObjectCountByID('lobby_forums',$id,'gid');
  	
	pnModAPIFunc('lobby','forums','sync',array('gid' => $id));
  	
  	return DBUtil::updateObject($group,'lobby_groups');	
}

/**
 * handle last visit date
 *
 */
function lobby_lastvisit($group)
{
  	// Variables
  	$expiretime 	= 1*60*60; // 1h
	$groupvar 		= '_lobby_'.$group['id'];
	$groupvar_ts	= '_lobby_ts_'.$group['id'];
	$uid 			= pnUserGetVar('uid');
	// There is a visit. Only go on if user is logged in
	if (!pnUserLoggedIn()) {
	  	return true;
	} else {
	  	// Get last action timestamp from session variables
		$lastaction 	= (int)SessionUtil::getVar($groupvar);
		$lastaction_ts 	= (int)SessionUtil::getVar($groupvar_ts);
	  	// Should the last login date be resetted?
	  	$reset = (int)FormUtil::getPassedValue('reset');
	  	if (($reset == 1) && ($lastaction_ts > 0)) {
	  	  	$lastaction_ts = 1; // reset will be done now automatically
		}
		// Is there already a session for this user?
		if (!($lastaction_ts > 0)) {
		  	// Get database entry from lobby_users table
		  	$obj = DBUtil::selectObjectByID('lobby_users',$uid);
		  	$obj['array'] 		= unserialize($obj['array']);
		  	$obj['last_action'] = date("Y-m-d H:i:s",time());
	  	  	$lastaction = (time()-(60*60*24*7*52)); // No last usage found? Set last usage to 52 Weeks... Should be enough ;)
		  	if (!((int)$obj['id'] > 0)) {
			    // Create new entry in datbase
			    $array = array();
			    $array[$group['id']] 	= $lastaction; 
			    $obj['array'] 			= serialize($array);
			    $obj['id'] 				= $uid;
			    DBUtil::insertObject($obj,'lobby_users','id',true,true);
			} else {
			  	// Set entry in database to time()
			  	$array = $obj['array'];
			  	if ($array[$group['id']] > 0) {
			  	  	// If there is an old entry use this as last action timestamp
					SessionUtil::setVar($groupvar,$array[$group['id']]);
				} else {
			  	  	// Otherwise last visit is some days ago (faked..)
			  	 	SessionUtil::setVar($groupvar,$lastaction); 
				}
				// Store last update of last visit variable
				SessionUtil::setVar($groupvar_ts,time());
				// Store actual real timestamp now
			  	$array[$group['id']] 	= time();
			  	$obj['array'] 			= serialize($array);
			    DBUtil::updateObject($obj,'lobby_users');
			}
		} else {
			//Session exists already, Check for age
			if ($lastaction_ts < (time()-$expiretime)) {
			  	// Session has expired, set new variables
			  	$lastaction = time();
			  	SessionUtil::setVar($groupvar,$lastaction);
				SessionUtil::setVar($groupvar_ts,$lastaction);
				// Store into Database
				// An database entry must exist now because we created it before in this routine here
				$obj = DBUtil::selectObjectByID('lobby_users',$uid);
			  	$obj['array'] = unserialize($obj['array']);
				$obj['array'][$group['id']] = $lastaction;
			  	$obj['array'] = serialize($obj['array']);
			  	$obj['last_action'] = date("Y-m-d H:i:s",time());
				DBUtil::updateObject($obj,'lobby_users');
			}
		}
		return $lastaction;
	}
}

/**
 * build coordinates for mymap
 *
 */
function lobby_buildcoordinates($groups,$width,$height) {
  	$coords = array();
	foreach ($groups as $group) {
	  	$c = $group['coordinates'];
	  	$c = unserialize($c);
	  	$lat = $c['lat'];
	  	$lng = $c['lng'];
	    $coords[] = array(
	    			'lat'	=> $lat,
	    			'lng'	=> $lng,
	    			'title'	=> $group['title'],
	    			'text'	=> '<a href='.pnModURL('lobby','user','group',array('id' => $group['id'])).'>'._LOBBY_VISIT.'</a>'
					);
												// only one marker displayed!
	}
    $mapcode = pnModAPIFunc('MyMap','user','generateMap',array(
			'coords'	=> $coords,		// must be an array
			'maptype'	=> 'HYBRID',	// HYBRID, SATELLITE or NORMAL
			'width'		=> $width,			// width in pixels
			'height'	=> $height,			// height in pixels
			'zoomfactor' => 10			// zoomfactor - 1 is closest
		));							// zoomfactor only relevant if there is
	return $mapcode;
}