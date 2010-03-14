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
    var $gid;
    function initialize(&$render)
    {
     	$gid =    (int)FormUtil::getPassedValue('id');
     	$aid =    (int)FormUtil::getPassedValue('aid');
        $delete = (int)FormUtil::getPassedValue('delete');
     	$this->gid = $gid;
     	pnModLangLoad('UserPictures');
     	// Load albums
     	$albums = pnModAPIFunc('lobby','albums','get',array('gid' => $this->gid));
     	$render->assign('albums', $albums);
     	// Check edit mode and get own pictures if needed
     	$editmode = (int)FormUtil::getPassedValue('editmode');
     	// Add a picture if pid is given
     	$pid = (int)FormUtil::getPassedValue('pid');
     	if ($pid > 0) {
     	   if ($delete == 1) {
         	   $result = pnModAPIFunc('lobby','albums','delPicture',array('aid' => $aid, 'pid' => $pid));
         	   if ($result) {
                  LogUtil::registerStatus(_LOBBY_PICTURE_DELETED);
               } else {
                  LogUtil::registerStatus(_LOBBY_PICTURE_DEL_ERROR);
               }
           } else {
         	   $result = pnModAPIFunc('lobby','albums','addPicture',array('aid' => $aid, 'pid' => $pid));
         	   if ($result) {
                  LogUtil::registerStatus(_LOBBY_PICTURE_ADDED);
               } else {
                  LogUtil::registerStatus(_LOBBY_PICTURE_ADD_ERROR);
               }
           }
        }
        // Handle editmode and get own pictures id needed
     	$render->assign('editmode', $editmode);
     	if ($editmode == 1) {
           $pictures = pnModAPIFunc('UserPictures','user','get',array('uid' => pnUserGetVar('uid'), 'template_id' => 0));
           $render->assign('ownPictures', $pictures);
        }
      	// Load album if id is set
     	if ($aid > 0) {
			$album = pnModAPIFunc('lobby','albums','get',array('id' => $aid,'gid' => $this->gid));
			$this->album = $album;
			$render->assign($album);
		}
		// Add style sheet
		PageUtil::addVar('stylesheet',ThemeUtil::getModuleStylesheet('UserPictures'));
		return true;
    }
}
