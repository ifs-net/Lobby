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
	var $album;
	var $gid;
    function initialize(&$render)
    {
      	$gid  = (int)FormUtil::getPassedValue('id');
      	$aid  = (int)FormUtil::getPassedValue('aid');
      	$this->gid = $gid;

        // Sync blind by default
    	Loader::includeOnce('modules/lobby/includes/common_groups.php');
		lobby_groupsync($gid);

      	if ($aid > 0) {
      	  	// load forum
      	  	$album = pnModAPIFunc('lobby','albums','get',array('id' => $aid, 'gid' => $gid));
      	  	$this->album = $album[0];
      	  	if ($this->album['gid'] == $this->gid) {
				$render->assign($this->album);
			}
		}
		$public_status_items = array (
			array('text' => _LOBBY_ALL, 'value' => 0),
			array('text' => _LOBBY_SITEMEMBERS, 'value' => 1),
			array('text' => _LOBBY_GROUPMEMBERS, 'value' => 2)
			);
		$render->assign('public_status_items', $public_status_items);
		$albums = pnModAPIFunc('lobby','albums','get',array('gid' => $this->gid));
		$render->assign('albums', $albums);
		// Set page title
		PageUtil::setVar('title', _LOBBY_ALBUM_MANAGEMENT);
		return true;
    }
    function handleCommand(&$render, &$args)
    {
		if ($args['commandName']=='update') {
			// get the form data and do a validation check
		    $obj = $render->pnFormGetValues();
		    // Create forum or update existing forum information
		    if ($this->album['id'] > 0) {
		      	// Delete Forum?
		      	if ($obj['delete'] == 1) {
		      	    // remove album
		      	    $result = pnModAPIFunc('lobby','albums','del',$this->album);
		      	    if ($result) {
                        LogUtil::registerStatus(_LOBBY_ALBUM_DELETED);
                    } else {
                        LogUtil::registerError('_LOBBY_ALBUM_DELETE_ERROR');
                    }
				} else {
					// Update existing forum
					$obj['id'] = $this->album['id'];
					$album = DBUtil::selectObjectByID('lobby_albums',$obj['id']);
					$album['title'] = $obj['title'];
					$album['date'] = $obj['date'];
					$album['public_status'] = $obj['public_status'];
					$album['description'] = $obj['description'];
					$result = DBUtil::updateObject($album,'lobby_albums');
					if ($result) {
						LogUtil::registerStatus(_LOBBY_ALBUM_UPDATED);
					} else {
						LogUtil::registerError(_LOBBY_ALBUM_UPDATE_ERROR);
						return false;				  	
					}
				}
			} else {
			  	// Create new forum
			  	$obj['gid'] = $this->gid;
				$result = pnModAPIFunc('lobby','albums','add',$obj);
				if (!$result) {
				  	return false;
				}
			}
		  	return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'albummanagement')));
		}
		return true;
    }
}
