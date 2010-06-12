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
 * the main user function
 * 
 * @return       output       The main module page
 */
function lobby_user_main()
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = pnRender::getInstance('lobby');

	// Assign variables
	// Get new founded groups
	$newGroups = pnModAPIFunc('lobby','groups','get',array('orderby' => 'latest', 'numrows' => 7, 'offset' => 0));
	$render->assign('newGroups', $newGroups);
	// Get news memberships
	$newMembers = pnModAPIFunc('lobby','members','get',array('showall' => 1, 'numrows' => 7, 'offset' => 0, 'sort' => 'latest', 'groupinformation' => 1));
	$render->assign('newMembers', $newMembers);
	// Get news
	$allNews = pnModAPIFunc('lobby','news','get',array('numrows' => 7, 'offset' => 0));
	$render->assign('allNews', $allNews);
	$ownNews = pnModAPIFunc('lobby','news','get',array('onlyown' => 1, 'numrows' => 7, 'offset' => 0));
	$render->assign('ownNews', $ownNews);
	// Get topics
	$allTopics = pnModAPIFunc('lobby','forumtopics','get',array('numrows' => 7, 'offset' => 0));
	$render->assign('allTopics', $allTopics);
	$ownTopics = pnModAPIFunc('lobby','forumtopics','get',array('numrows' => 7, 'offset' => 0, 'owngroups' => 1));
	$render->assign('ownTopics', $ownTopics);
	$modVars = pnModGetVar('lobby');
	$render->assign('modVars', $modVars);
	$loggedIn = (int)pnUserLoggedIn();
	$render->assign('loggedIn', $loggedIn);

    // Return the output
    return $render->fetch('lobby_user_main.htm');
}

/**
 * show forum posts
 * 
 * @return       output       The main module page
 */
function lobby_user_forums($args)
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = pnRender::getInstance('lobby');
	$module = pnModGetName();
	if (isset($args) && ($module != 'lobby')) {
	  	// This is important if function is embedded via content for example
		$numrows = (int)$args['numrows'];
		$offset = (int)$args['lobbypager'];
		// Module != lobby, so we have to load the css
		PageUtil::addVar('stylesheet','modules/lobby/pnstyle/style.css');
		// Pager causes problems when integrated in other modules...
		$countTopics = false;
	} else {
		$numrows = (int)FormUtil::getPassedValue('numrows');
		$offset = (int)FormUtil::getPassedValue('lobbypager');
		$countTopics = true;
	}
	if ($numrows == 0 ) {
	  	$numrows = 15;
	}
	if ($offset > 0) {
		$offset--;
	} else {
	  $offset = 0;
	}

	
	// Assign some variables and parameters
	$render->assign('numrows', 		$numrows);
	$render->assign('includeforum', 1);
	$render->assign('includegroup', 1);

	// Get mode and Topics
	$mode = (int)FormUtil::getPassedValue('mode');
	if ($mode == 3) {
	  	$owngroups = 1;
	} else {
	  	if (pnUserLoggedIn()) {
		    $owngroups = 2;
		} else {
		  $owngroups = 0;
		}
		if ($mode == 2) {
	  		$official = 1;
		} 
	}

	// Get topics
	$allTopics = pnModAPIFunc('lobby','forumtopics','get',array('numrows' => $numrows, 'offset' => $offset, 'owngroups' => $owngroups, 'official' => $official));
	if ($countTopics) {
		$allTopicsCount = pnModAPIFunc('lobby','forumtopics','get',array('count' => 1, 'owngroups' => $owngroups, 'official' => $official));
	}

	$render->assign('allTopics', $allTopics);
	$render->assign('allTopicsCount', $allTopicsCount);
	$ownTopics = pnModAPIFunc('lobby','forumtopics','get',array('numrows' => $numrows, 'offset' => $offset, 'owngroups' => 1));
	$render->assign('ownTopics', $ownTopics);

	// Assign postsperpage value for index page
  	$postsperpage = pnModGetVar('lobby','postsperpage');
  	$render->assign('postsperpage', $postsperpage);

    // Return the output
    return $render->fetch('lobby_user_forums.htm');
}

/**
 * list available groups
 * 
 * @return       output
 */
function lobby_user_list($args)
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = pnRender::getInstance('lobby');

	// Assign variables
	$itemsperpage = 15;
	$offset = (int)FormUtil::getPassedValue('lobbypager');
	if ($offset > 0) {
		$offset--;
	}
	
	// Get Category filter
	if (isset($args) && (count($args) > 0)) {
		$cat    = (int)$args['cat'];
		$map    = (int)$args['map'];
		$width  = (int)$args['width'];
		$height = (int)$args['height'];
		$notext = (int)$args['notext'];
		$order  = (string)$args['order'];
	} else {
		$cat    = (int)FormUtil::getPassedValue('cat');
		$map    = (int)FormUtil::getPassedValue('map');
		$width  = (int)FormUtil::getPassedValue('width');
		$height = (int)FormUtil::getPassedValue('height');
		$notext = (int)FormUtil::getPassedValue('notext');
		$order  = (string)FormUtil::getPassedValue('order');
	}
	if ($width == 0) {
	  	$width = 900;
	}
	if ($height == 0) {
	  	$height = 400;
	}
	
	// Get groups
	$mymap = pnModAvailable('MyMap');
	if (($mymap) && ($map == 1)) {
		$render->assign('map', 1);
		$code = pnModAPIFunc('lobby','groups','getMapCode',array('cat' => $cat, 'width' => $width, 'height' => $height));
		$render->assign('code', $code);
	} else {
		$groups = pnModAPIFunc('lobby','groups','get',array('orderby' => $order, 'numrows' => $itemsperpage, 'offset' => $offset, 'cat' => $cat));
	}
	$groupscount = pnModAPIFunc('lobby','groups','get',array('count' => 1, 'cat' => $cat));
	$render->assign('mymap',       $mymap);
	$render->assign('notext',      $notext);
	$render->assign('groups',      $groups);
	$render->assign('cat',         $cat);
	$render->assign('groupscount', $groupscount);
	$render->assign('itemsperpage',$itemsperpage);
	
	// Get categories and assign them to template
	$categories = pnModAPIFunc('lobby','categories','get');
	$render->assign('categories',  $categories);

    // Return the output
    return $render->fetch('lobby_user_list.htm');
}

/**
 * the main user function
 * 
 * @return       output
 */
function lobby_user_group()
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) return LogUtil::registerPermissionError();

	//*** START OF STANDARD DATA FOR LEFT COLUMN **//
	// Common groups functions inclusion
	Loader::includeOnce('modules/lobby/includes/common_groups.php');

	// Get group id
  	$id = (int)FormUtil::getPassedValue('id');

	// should a synchronisation be done?
	$sync = (int)FormUtil::getPassedValue('sync');
	if ($sync == 1) {
		$result = lobby_groupsync($id);
	}
	
	// Add JS
	PageUtil::addVar('javascript','modules/lobby/includes/javascript/lobby.js');

	// get group
  	$group = pnModAPIFunc('lobby','groups','get',array('id' => $id));
  	if (!($id > 0) || ($group['id'] != $id)) {
	    LogUtil::registerError(_LOBBY_GROUP_NONEXISTENT);
	    return pnRedirect(pnModURL('lobby'));
	} 

	// Last visit handling - important for forums
	$lastvisit = lobby_lastvisit($group);

	// Create output and call handler class
	$render = FormUtil::newpnForm('lobby');

	// Assign variables
	$render->assign('group',$group);
	
	// check if permissions are group owner:
	$groupOwner = (($group['uid'] == pnUserGetVar('uid')) || (SecurityUtil::checkPermission('lobby::'.$id, '::', ACCESS_ADMIN)));
	$render->assign('groupOwner', $groupOwner);
	
	$loggedIn = pnUserLoggedIn();
	$render->assign('loggedIn',$loggedIn);
	
	if ($loggedIn) {
		$memberStatus = pnModAPIFunc('lobby','groups','getMemberStatus',array('group' => $group, 'uid' => pnUserGetVar('uid')));
		$render->assign('memberStatus', $memberStatus);
	}

	// get category
	$category = pnModAPIFunc('lobby','categories','get',array('id' => $group['category']));
	$render->assign('category',$category);
	
	// get members
	$facts['members'] = pnModAPIFunc('lobby','members','get',array('gid' => $group['id'], 'count' => 1));
	if ($groupOwner) {
		$facts['pending'] = (int)pnModAPIFunc('lobby','members','get',array('gid' => $group['id'],'pending' => 1, 'count' => 1));		
	}

	// get moderators
	$moderators = pnModAPIFunc('lobby','moderators','get',array('gid' => $group['id']));
	$render->assign('moderators', $moderators);
	$isModerator = pnModAPIFunc('lobby','moderators','isModerator',array('gid' => $group['id'], 'uid' => pnUserGetVar('uid')));
	if ($isModerator || $groupOwner) {
	  	$render->assign('moderator', 1);
	  	$render->assign('authid', SecurityUtil::generateAuthKey());
	}
	
	// Get Newsarticles
	$newsperpage = pnModGetVar('lobby',$newsperpage);
	$articles_short = pnModAPIFunc('lobby','news','get',array('gid' => $id, 'numrows' => 5));
	$render->assign('articles_short', $articles_short);
	// If latest article > last visit the news - box should be opened by default.
	$first_article = $articles_short[0];
	$openNews = 0;
	if ($first_article['id'] > 0) {
        if ((int)strtotime($first_article['date']) > $lastvisit) {
            $openNews = 1;
        }
    }
    if ($group['boxes_shownews'] == 1) {
        $openNews = 1;
    }
    $render->assign('openNews', $openNews);


    // Load Userpictures lang if module is available
    if (pnModAvailable('UserPictures')) {
        pnModLangLoad('UserPictures','user');
    }
    
    // get albums
    if ($group['albums'] > 0) {
        // get all and take care of viewers permissions
        $albums = pnModAPIFunc('lobby','albums','get',array('gid' => $group['id']));
        $latestpicture = $albums[0];
        $render->assign('latestpicture',$latestpicture);
    }

	// Assign facts
	$facts['creator'] 		= pnUserGetVar('uname',$group['uid']);
	$facts['status']  		= (int)pnModAPIFunc('lobby','groups','getMemberStatus',array('group' => $group));
	$facts['newsperpage']	= 25;

	// loggedin-Status, Userinfo and facts
	$render->assign('loggedin', (int)pnUserLoggedIn());
	$render->assign('viewer_uid', pnUserGetVar('uid'));
	$render->assign('facts',$facts);

	// Get Pager information
  	$offset = (int)FormUtil::getPassedValue('lobbypager');
  	if ($offset > 0) {
	    $offset--;
	}
	
	// Get action if set
	$action = FormUtil::getPassedValue('action');

	// Set Standard page title
	PageUtil::setVar('title', _LOBBY_GROUP.' '.$group['title']);
		
	// Assign some values for forum shortlinks
	if (pnUserLoggedIn() && ($lastvisit > 0)) {
	  	$lastvisit_date = date("Y-m-d H:i:s",$lastvisit);
	  	$render->assign('lastvisit', $lastvisit_date);
	  	$render->assign('lastvisit_encoded', base64_encode($lastvisit_date));
	}

	//*** END OF STANDARD DATA FOR LEFT COLUMN **//
	
	$do = FormUtil::getPassedValue('do');
	if (!isset($do) || ($do == '')) {
    	$incFile = "lobby_includes_index.htm";
    } else {
    	$incFile = "lobby_includes_".$do.".htm";
    }
	if ($render->template_exists($incFile)) {
        $render->assign('incFile', $incFile);
    }
	switch ($do) {
	  	case 'albummanagement':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
	  		$template = 'albummanagement';
		    Loader::includeOnce('modules/lobby/includes/classes/user/albummanagement.php');
	  		break;
	  	case 'forummanagement':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
	  		$template = 'forummanagement';
		    Loader::includeOnce('modules/lobby/includes/classes/user/forummanagement.php');
	  		break;
	  	case 'modifyindex':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
	  		$template = 'modifyindex';
		    Loader::includeOnce('modules/lobby/includes/classes/user/modifyindex.php');
	  		break;
	  	case 'membermanagement':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
			// Check for action
			if (isset($action) && ($action == 'modify')) {
		  		$template = 'membermanagement_modify';
			    Loader::includeOnce('modules/lobby/includes/classes/user/membermanagement_modify.php');
			} else {
		  		$template = 'membermanagement';
			    Loader::includeOnce('modules/lobby/includes/classes/user/membermanagement.php');
			}
	  		break;
	  	case 'sync':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
			// Check for action
			$template = 'index';
			Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
			Loader::includeOnce('modules/lobby/includes/common_groups.php');
			$result = lobby_groupsync($id);
		  	if ($result) {
			  	LogUtil::registerStatus(_LOBBY_GROUP_SYNCED);
			} else {
			  	LogUtil::registerError(_LOBBY_GROUP_SYNC_ERROR);
			}
			return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
	  		break;
	  	case 'pending':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
			// is there a action to do?
			if (($action == 'deny') || ($action == 'accept')) {
			  	$add = (int)FormUtil::getPassedValue('add');
			  	if ($action == 'accept') {
					pnModAPIFunc('lobby','members','add',array('gid' => $id, 'uid' => $add));
					// send Mail
					Loader::includeOnce('modules/lobby/includes/common_email.php');
					lobby_notify_newgroupmember($group,$add);
				} else {
					pnModAPIFunc('lobby','members','reject',array('group' => $group, 'uid' => $add));
					// Mail was sent through function!
				}
				// Clear the browsers URL
				return pnRedirect(pnModURL('lobby','user','group',array('id' => $id, 'do' => 'pending')));
			}
	  		$pending = pnModAPIFunc('lobby','members','get',array('pending' => 1, 'gid' => $id));
	  		$render->assign('pending',$pending);
	  		$authid = SecurityUtil::generateAuthKey();
	  		$render->assign('authid', $authid);
	  		$template = 'pending';
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
	  		break;
	  	case 'invite':
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
		    $args = array (
			    'uname' => FormUtil::getPassedValue('uname'),
			    'text'  => FormUtil::getPassedValue('invitetext'),
			    'id' 	=> $id,
			    'group' => $group
			);
		    pnModAPIFunc('lobby','groups','invite',$args);
		    return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
	  		break;
	  	case 'help':
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
		    $template = 'help';
	  		break;
	  	case 'news':
	  		$story = (int)FormUtil::getPassedValue('story');
	  		if ($story > 0) {
				$article = pnModAPIFunc('lobby','news','get',array('gid' => $id, 'id' => $story, 'infuture' => $groupOwner));
				$render->assign($article);
				if (strtotime($article['date']) > time()) {
					$render->assign('infuture', 1);
				}
				// is the article to be sent to all?
				if ($groupOwner) {
					$send = (int) FormUtil::getPassedValue('send');
					if ($send == 1) {
					  	if ($article['sent'] == 1) {
						    LogUtil::registerError(_TRACKING_ARTICLE_SENT_ALREADY);
						} else {
						  	$result = pnModAPIFunc('lobby','news','sendStory',$article);
						  	if ($result) {
							    LogUtil::registerStatus(_LOBBY_ARTICLE_SENT_TO_GROUP);
							} else {
							  	LogUtil::registerError(_LOBBY_ARTICLE_SENT_ERROR);
							}
						}
					}
				}
				// Set page title
				PageUtil::setVar('title', $article['title'].' :: '._LOBBY_GROUP_NEWS.' '.$group['title']);
		  		$template = 'news_story';
			} else {
			  	$articles = pnModAPIFunc('lobby','news','get',array('gid' => $id, 'infuture' => $groupOwner, 'numrows' => $facts['newsperpage'], 'offset' => $offset));
			  	$render->assign('articles',$articles);
		  		$template = 'news';
				// Set page title
				PageUtil::setVar('title', _LOBBY_GROUP_NEWS.' '.$group['title']);
		  	}
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
	  		break;
	  	case 'albums':
			$template = 'albums';
		    Loader::includeOnce('modules/lobby/includes/classes/user/albums.php');
		    break;
	  	case 'article':
	  		// Only the group owner or sysadmin should be allowed to view this site
		    if (!$groupOwner) {
			  	LogUtil::registerError(_LOBBY_ONLY_ADMIN_ACCESS);
			  	return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
			$template = 'article';
		    Loader::includeOnce('modules/lobby/includes/classes/user/article.php');
		    break;
	  	case 'join':
	  		$template = 'join';
	  		if ($memberStatus > 0) {
			    LogUtil::registerError(_LOBBY_USER_ALREADY_MEMBER);
			    return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
		    Loader::includeOnce('modules/lobby/includes/classes/user/join.php');
	  		break;
	  	case 'forums':
			// Assign postsperpage value for index page
     	  	$postsperpage = pnModGetVar('lobby','postsperpage');
			$posts = pnModAPIFunc('lobby','forumtopics','get',array('gid' => $id, 'numrows' => 5));
			$render->assign('topics', 		$posts);
     	  	$render->assign('postsperpage', $postsperpage);
			$render->assign('includeforum',1);
			// Check for action
			if (isset($action) && (($action == 'latesttopics') || ($action == 'latestposts'))) {
				$render->assign('mode', $action);
	       	  	$topicsperpage = pnModGetVar('lobby','topicsperpage');
	       	  	$render->assign('topicsperpage', $topicsperpage);
			  	$hours = (int)FormUtil::getPassedValue('hours');
			  	$date = FormUtil::getPassedValue('date');
			  	if ($date != '') {
			  	  	$date=base64_decode($date);
				    $date = date("Y-m-d H:i:s",strtotime($date));
				} else if (!($hours > 0)) {
				    $hours = 24;
				    $date = date("Y-m-d H:i:s",time()-60*60*$hours);
					$render->assign('hours',$hours);
				} else if ($hours > 0) {
					$render->assign('hours',$hours);
				    $date = date("Y-m-d H:i:s",time()-60*60*$hours);
				}
				// Assign date
				$render->assign('date',$date);
				if (($action == 'latesttopics')) {
					$sort = 'creationdate';
				}
				$topics = pnModAPIFunc('lobby','forumtopics','get',array('gid' => $id, 'numrows' => $topicsperpage, 'offset' => $offset, 'sort' => $sort, 'date' => $date));
				$topics_count = pnModAPIFunc('lobby','forumtopics','get',array('gid' => $id, 'date' => $date, 'sort' => $sort, 'count' => 1));
				$render->assign('topics',$topics);
				$render->assign('topics_count',$topics_count);
		  		$template = 'forums_latesttopics';
			} else {			  
		  		$template = 'forums';
		  		$forums = pnModAPIFunc('lobby','forums','get',array('gid' =>$id, 'showall' => $group['forumsvisible']));
		  		$render->assign('forums', $forums);
		  	}
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
	  		break;
	  	case 'forum':
	  		$template = 'forum';
		    Loader::includeOnce('modules/lobby/includes/classes/user/forum.php');
	  		break;
	  	case 'members':
	  		$template = 'members';
			// Load member information
			$membersperpage = 56;
			$members = pnModAPIFunc('lobby','members','get',array('gid' => $group['id'], 'numrows' => $membersperpage, 'offset' => $offset, 'sort' => 'uname'));
			$render->assign('members',$members);
			$render->assign('membersperpage', $membersperpage);
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
	  		break;
	  	case 'quit':
	  		if (!pnUserLoggedIn()) {
			    LogUtil::registerPermissionError();
			    return pnRedirect(pnModURL('lobby','user','group',array('id' => $id)));
			}
			$confirm = (int)FormUtil::getPassedValue('confirm');
			if ($confirm == 1) {
				if (SecurityUtil::confirmAuthKey()) {
					// delete user from group
					$result = pnModAPIFunc('lobby','members','del',array('gid' => $id, 'uid' => pnUserGetVar('uid')));
					if (!$result) {
						LogUtil::registerError(_LOBBY_GROUP_DELETE_MEMBER_FAILURE);
					} else {
					  	// send email to group owner
					  	Loader::includeOnce('modules/lobby/includes/common_email.php');
					  	lobby_notify_quitmember($id,pnUserGetVar('uid'),FormUtil::getPassedValue('text'));
						// display message and return to group's index page
						LogUtil::registerStatus(_LOBBY_MEMBERSHIP_QUITTED);
						return pnRedirect(pnModUrl('lobby','user','group',array('id' => $id)));
					}
				} else {
					// authkey wrong
					LogUtil::registerAuthIDError();
				}
			}
	  		$authid = SecurityUtil::generateAuthKey();
	  		$render->assign('authid', $authid);
	  		$template = 'quit';
			// Load member information
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
	  		break;
	  	default:
	  		// Load individual home page
	  		$index = pnModAPIFunc('lobby','pages','get',array('gid' => $id));
	  		if (strlen($index) > 10) {
			    $render->assign('index', $index);
			}
			// Load member information
			$membersperpage = 14;
			$members = pnModAPIFunc('lobby','members','get',array('gid' => $group['id'], 'numrows' => $membersperpage, 'offset' => $offset, 'sort' => 'latest'));
			$render->assign('members',$members);
			$render->assign('membersperpage', $membersperpage);
			// Add online members
			$onlinemembers = pnModAPIFunc('lobby','members','get',array('online' => 1, 'gid' => $group['id']));
			$onlinememberscount = pnModAPIFunc('lobby','members','get',array('count' => 1, 'online' => 1, 'gid' => $group['id']));
			$render->assign('onlinemembers',$onlinemembers);
			$render->assign('onlinememberscount',$onlinememberscount);
			// Load forum information
			$topics = pnModAPIFunc('lobby','forumtopics','get',array('gid' => $id, 'numrows' => $group['indextopics'], 'sort' => 'creationdate'));
			$render->assign('topics', $topics);
			$posts = pnModAPIFunc('lobby','forumtopics','get',array('gid' => $id, 'numrows' => $group['indextopics']));
			$render->assign('posts', $posts);
			$render->assign('indexpage', 1);
			$template = "index";
			// Get module availability for mymap module
			$mymapavailable = pnModAvailable('MyMap');
			$render->assign('mymapavailable', $mymapavailable);
			$coords = unserialize($group['coordinates']);
			$render->assign('coords', $coords);
			// Assign postsperpage value for index page
     	  	$postsperpage = pnModGetVar('lobby','postsperpage');
     	  	$render->assign('postsperpage', $postsperpage);
			$render->assign('includeforum',1);
			// Load dummy class
		    Loader::includeOnce('modules/lobby/includes/classes/user/dummy.php');
			break;
	}
	// Assign template for plugin and return output
	$render->assign('template','lobby_user_groups_include_'.$template.'.htm');
    return $render->pnFormExecute('lobby_user_group.htm',new lobby_user_pluginHandler());
}

/**
 * edit group information
 * 
 * @return       output
 */
function lobby_user_edit()
{
  	// load handler class
	Loader::requireOnce('modules/lobby/includes/classes/user/edit.php');

    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_COMMENT)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = FormUtil::newpnForm('lobby');

    // Return the output
    return $render->pnFormExecute('lobby_user_edit.htm', new lobby_user_editHandler());
}

/**
 * fake links for netbiker...
 */
function lobby_user_memberslist() {
  	$gid = Formutil::getpassedvalue('gid');
  	$args = array (
  		'gid' => $gid
	  );
  	return pnRedirect(pnModURL('Groups','user','memberslist',$args));
}
function lobby_user_membership() {
  	$action = Formutil::getpassedvalue('action');
  	$gid = Formutil::getpassedvalue('gid');
  	$args = array (
  		'action' => $action,
  		'gid'	=> $gid
	  );
  	return pnRedirect(pnModURL('Groups','user','membership',$args));
}