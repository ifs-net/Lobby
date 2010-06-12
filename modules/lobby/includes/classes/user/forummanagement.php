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
	var $fid;
	var $gid;
    function initialize(&$render)
    {
      	$gid  = (int)FormUtil::getPassedValue('id');
      	$fid  = (int)FormUtil::getPassedValue('fid');
		$sync = (int)FormUtil::getPassedValue('sync');
      	$this->gid = $gid;
      	if ($fid > 0) {
      	  	// load forum
      	  	$forum = pnModAPIFunc('lobby','forums','get',array('id' => $fid, 'gid' => $gid));
      	  	if ($forum['gid'] == $forum['gid']) {
				$render->assign($forum);
				$this->fid = $fid;
				// should forum be synced?
				if ($sync == 1) {
				  	// Get Topics and sync them
				  	$topics = pnModAPIFunc('lobby','forumtopics','get',array('fid' => $fid));
				  	$counter = 0;
				  	foreach ($topics as $topic) {
				  	  	pnModAPIFunc('lobby','forumtopics','sync',array('id' => $topic['id']));
					    $counter++;
					}
					LogUtil::registerStatus($counter.' '._LOBBY_TOPICS_SYNCED_IN.' '.$forum['title']);
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $gid, 'do' => 'forummanagement')));
				}
			}
		}
		$public_status_items = array (
			array('text' => _LOBBY_ALL, 'value' => 0),
			array('text' => _LOBBY_SITEMEMBERS, 'value' => 1),
			array('text' => _LOBBY_GROUPMEMBERS, 'value' => 2)
			);
		$render->assign('public_status_items', $public_status_items);
		$forums = pnModAPIFunc('lobby','forums','get',array('gid' => $this->gid));
		// we need to re-work at the sort_nr's
		$c = 0;
		$changes = false;
		$farray  = array();
		$ffarray = array();
		$narray  = array();
		foreach ($forums as $f) {
			$c++;
			if ($f['sort_nr'] != $c) {
			  	$f['sort_nr'] = $c;
			  	DBUtil::updateObject($f,'lobby_forums');
			  	$changes = true;
			}
			$narray[$previous] = $f['id'];
			$f['previous'] = $previous;
			$previous = $f['id'];
			$farray[] = $f;
		}
		foreach ($farray as $f) {
		  	$f['next'] = $narray[$f['id']];
		  	$ffarray[] = $f;
		}
		// get "next" entry for each forum
		if ($changes) {
			return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'forummanagement')));
		}
		// Has the sort order changed?
		$switch = (int) FormUtil::getPassedValue('switch');
		if ($switch == 1) {
		  	$f1 = (int)FormUtil::getPassedValue('forum1');
		  	$f2 = (int)FormUtil::getPassedValue('forum2');
		  	$o1 = DBUtil::selectObjectByID('lobby_forums',$f1);
		  	$o2 = DBUtil::selectObjectByID('lobby_forums',$f2);
		  	if (($o2['gid'] == $o1['gid']) && ($o1['gid'] == $this->gid)) {
			    $dummy = $o1['sort_nr'];
			    $o1['sort_nr'] = $o2['sort_nr'];
			    $o2['sort_nr'] = $dummy;
			    DBUtil::updateObject($o1,'lobby_forums');
			    DBUtil::updateObject($o2,'lobby_forums');
				return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'forummanagement')));
			}
		}
		$render->assign('forums', $ffarray);
		// Set page title
		PageUtil::setVar('title', _LOBBY_FORUM_MANAGEMENT);
		return true;
    }
    function handleCommand(&$render, &$args)
    {
		if ($args['commandName']=='update') {
			// get the form data and do a validation check
		    $obj = $render->pnFormGetValues();
		    // Create forum or update existing forum information
		    if ($this->fid > 0) {
		      	// Delete Forum?
		      	if ($obj['delete'] == 1) {
				    $result = pnModAPIFunc('lobby','forums','del',array('id' => $this->fid));
				    if ($result) {
					  	LogUtil::registerStatus(_LOBBY_FORUM_DELETED);
					  	return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' =>$this->gid, 'sync' => '1', 'do' => 'forummanagement')));
					} else {
					  	LogUtil::registerError(_LOBBY_FORUM_DELETE_ERROR);
					}
				} else {
					// Update existing forum
					$obj['id'] = $this->fid;
					$forum = DBUtil::selectObjectByID('lobby_forums',$this->fid);
					$forum['title'] = $obj['title'];
					$forum['public_status'] = $obj['public_status'];
					$forum['description'] = $obj['description'];
					$result = DBUtil::updateObject($forum,'lobby_forums');
					if ($result) {
						LogUtil::registerStatus(_LOBBY_FORUM_UPDATED);
					} else {
						LogUtil::registerError(_LOBBY_FORUM_UPDATE_ERROR);
						return false;				  	
					}
				}
			} else {
			  	// Create new forum
			  	$obj['gid'] = $this->gid;
				$result = pnModAPIFunc('lobby','forums','add',$obj);
				if (!$result) {
				  	return false;
				}
			}
		  	return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'sync' => 1, 'do' => 'forummanagement')));
		}
		return true;
    }
}
