<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

Loader::includeOnce('modules/lobby/includes/common_categories.php');

class lobby_user_editHandler
{
    var $id;
    var $group;
    function initialize(&$render)
    {	    
		$uid = pnUserGetVar('uid');
		$yesno_items = array (
			array('text' => _LOBBY_YES, 'value' => 1),
			array('text' => _LOBBY_NO, 'value' => 0),
			);
		$render->assign('yesno_items', $yesno_items);
		// Assign categories
		$categories = pnModAPIFunc('lobby','categories','get');
		$category_items = lobby_categoriesToPullDown($categories);		
		// is there a group that should be loaded?
		$id = (int)FormUtil::getPassedValue('id');
		if ($id > 0) {
			$group = DBUtil::selectObjectByID('lobby_groups',$id);
			$coords = unserialize($group['coordinates']);
			$group['lng'] = $coords['lng'];
			$group['lat'] = $coords['lat'];
			$this->group = $group;
			if (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN) || ($group['uid'] == pnUserGetVar())) {
				$render->assign($group);
				$render->assign('edit', 1);
				// overwrite category items
				if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) {
					$category = pnModAPIFunc('lobby','categories','get',array('id' => $group['category']));
					$category_items = lobby_categoryToPullDown($category);
				} else {
					$category = pnModAPIFunc('lobby','categories','get');
					$category_items = lobby_categoriesToPullDown($category);
			}
			}
		}
		$render->assign('category_items', $category_items);
		// Is MyMap module available?
		$mymapavailable = pnModAvailable('MyMap');
		if ($mymapavailable) {
			$render->assign('mymapavailable', $mymapavailable);
			$render->assign('coords', $coords);
		}
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
		    
		    // is there a special action to be done?
		    $delete = (int)$obj['delete'];
		    // Should the group be deleted?
		    if ($delete == 1) {
			  	// delete forums
			  	$id = $this->group['id'];
			  	$forums = pnModAPIFunc('lobby','forums','get',array('gid' => $id));
			  	prayer($forums);
			  	$fids = array();
			  	foreach ($forums as $forum) {
				    $result = pnModAPIFunc('lobby','forums','del',array('id' => $forum['id']));
				  	if (!$result) {
					    return LogUtil::registerError(_LOBBY_DELETION_FORUMS_FAILS);
					}
				}
			  	// delete news articles
			  	$where = 'gid = '.$id;
			  	$result = DBUtil::deleteWhere('lobby_news',$where);
			  	if (!$result) {
				    return LogUtil::registerError(_LOBBY_DELETION_NEWS_FAILS);
				}
			  	// delete index page
			  	$result = DBUtil::deleteObjectByID('lobby_pages',$id);
			  	// delete members
			  	$where = 'gid = '.$id;
			  	$result = DBUtil::deleteWhere('lobby_members',$where);
			  	if (!$result) {
				    return LogUtil::registerError(_LOBBY_DELETION_MEMBER_FAILS);
				}
			  	// delete pending members
			  	$result = DBUtil::deleteWhere('lobby_members_pending',$where);
			  	if (!$result) {
				    return LogUtil::registerError(_LOBBY_DELETION_MEMBER_PENDING_FAILS);
				}
			  	// delete moderators
			  	$result = DBUtil::deleteWhere('lobby_moderators',$where);
			  	if (!$result) {
				    return LogUtil::registerError(_LOBBY_DELETION_MODERATORS_FAILS);
				}
				// delete group information itself
			  	$result = DBUtil::deleteObject($this->group,'lobby_groups');
			  	if (!$result) {
				    return LogUtil::registerError(_LOBBY_DELETION_GROUP_FAILS);
				} else {
				  	LogUtil::registerStatus(_LOBBY_GROUP_DELETED);
				  	return $render->pnFormRedirect(pnModURL('lobby','user','main'));
				}
			  	
			}
		    
			// is there a coordinate?
		    if (($obj['lng'] != '') && ($obj['lat'] != '')) {
				$coords = array(
		    		'lng' => str_replace(',','.',$obj['lng']),
		    		'lat' => str_replace(',','.',$obj['lat'])
				);
				unset($obj['lng']);
				unset($obj['lat']);
				$obj['coordinates'] = serialize($coords);
		    } else {
			  	$obj['coords'] = '';
			}

		    // store or update group
		    if ($this->group['id'] > 0) {
				// update an existing group
				$upd = $this->group;
				$upd['coordinates']     = $obj['coordinates'];
				$upd['description']     = $obj['description'];
				$upd['moderated']       = $obj['moderated'];
				$upd['indextopics']     = $obj['indextopics'];
				$upd['forumsvisible']   = $obj['forumsvisible'];
				if (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)){
					$upd['category'] = $obj['category'];
				} 
				$result = DBUtil::updateObject($upd,'lobby_groups');
				if ($result) {
					LogUtil::registerStatus(_LOBBY_GROUP_UPDATED);
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $upd['id'])));
				} else {
				  	LogUtil::registerError(_LOBBY_GROUP_UPDATE_ERROR);
				}
			} else {
			  	// a new group has to be created
			  	// is there already a groupt named like the new group?
			  	$count = DBUtil::selectObjectCount('lobby_groups','title LIKE \''.DataUtil::formatForStore($obj['title'])."'");
			  	if ($count > 0) {
					LogUtil::registerError(_LOBBY_GROUP_ALREADY_EXISTS);
					return false;
				}
			  	$obj['date'] = date("Y-m-d H:i:s",time());
			  	$obj['last_action'] = $obj['date'];
			  	$obj['uid'] = pnUserGetVar('uid');
			  	// get category
			  	$category = pnModAPIFunc('lobby','categories','get',array('id' => $obj['category']));
			  	if ($category['official'] == 1) {
				    LogUtil::registerStatus(_LOBBY_GROUP_PENDING);
				} else {
				  	$obj['accepted'] = 1;
				}
				$result = DBUtil::insertObject($obj,'lobby_groups');
				if ($result) {
					LogUtil::registerStatus(str_replace('%group%',$obj['title'],_LOBBY_GROUPS_ADDED));
				} else {
					LogUtil::registerError(_LOBBY_GROUPS_ADDERROR);
					return false;
				}
				// statusmessage about the things that will go on now
				LogUtil::registerStatus(_LOBBY_GROUP_EDIT_INITPROCESS);
				// add the owner to the new group
				pnModAPIFunc('lobby','members','add',array('uid' => pnUserGetVar('uid'), 'gid' => $obj['id']));
				// add owner as moderator
				pnModAPIFunc('lobby','moderators','add',array('uid' => pnUserGetVar('uid'), 'gid' => $obj['id']));
				// add new forums to the group
				if ($obj['skeleton'] == 1) {
					$forums = array ();
					$forums[] = array (	'public_status'	=> 2,
										'title' 		=> _LOBBY_FORUMTITLE_INTRODUCTION,
										'description'	=> _LOBBY_FORUMTITLE_INTRODUCTION_DESC				);
					$forums[] = array (	'public_status'	=> 1,
										'title' 		=> _LOBBY_FORUMTITLE_Q_AND_A,
										'description'	=> _LOBBY_FORUMTITLE_Q_AND_A_DESC					);
					$forums[] = array (	'public_status'	=> 1,
										'title' 		=> _LOBBY_FORUMTITLE_TALK,
										'description'	=> _LOBBY_FORUMTITLE_TALK_DESC						);
					$forums[] = array (	'public_status'	=> 2,
										'title' 		=> _LOBBY_FORUMTITLE_PRIVATE,
										'description'	=> _LOBBY_FORUMTITLE_PRIVATE_DESC					);
					foreach ($forums as $forum) {
						pnModAPIFunc('lobby','forums','add',array('gid' => $obj['id'], 'title' => $forum['title'], 'description' => $forum['description'], 'public_status' => $forum['public_status']));
					}
				}
				// send Mail
				Loader::includeOnce('modules/lobby/includes/common_email.php');
				lobby_notify_newgroup($obj);
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $obj['id'])));
			}
		}
		return true;
    }
}
