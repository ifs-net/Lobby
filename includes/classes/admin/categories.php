<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

class lobby_admin_categoriesHandler
{
    var $id;
    function initialize(&$render)
    {	    
		$uid = pnUserGetVar('uid');
		$yesno_items = array (
			array('text' => _LOBBY_YES, 'value' => 1),
			array('text' => _LOBBY_NO, 'value' => 0),
			);
		$render->assign('yesno_items', $yesno_items);
		// load existing categories
		$categories = pnModAPIFunc('lobby','categories','get');
		$render->assign('categories',$categories);
		// load category that should be edited?
		$id = (int)FormUtil::getPassedValue('id');
		if ($id > 0) {
		  	$category = pnModAPIFunc('lobby','categories','get',array('id' => $id));
		  	$render->assign($category);
		  	$this->id = $id;
		}
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
		    
		    if ($this->id > 0) {
		      	if ($obj['delete'] == 1) {
				    $obj['id'] = $this->id;
				    $result = DBUtil::deleteObject($obj,'lobby_categories');
				    if ($result) {
						LogUtil::registerStatus(_LOBBY_CATEGORY_DELETED);
					} else {
						LogUtil::registerError(_LOBBY_CATEGORY_DELETEERROR);
					}
				} else {
					// update object
					$obj['id'] = $this->id;
					$result = DBUtil::updateObject($obj,'lobby_categories');
					if ($result) {
						LogUtil::registerStatus(_LOBBY_CATEGORY_UPDATED);
					} else {
						LogUtil::registerError(_LOBBY_CATEGORY_STOREFAILURE);
					}
				}
			} else {
				// store new object
				$result = DBUtil::insertObject($obj,'lobby_categories');
				if ($result) {
					LogUtil::registerStatus(_LOBBY_CATEGORY_INSERTED);
				} else {
					LogUtil::registerError(_LOBBY_CATEGORY_STOREFAILURE);
				}
			}
		}
		return $render->pnFormRedirect(pnModURL('lobby','admin','categories'));
    }
}
