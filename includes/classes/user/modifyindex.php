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
    function initialize(&$render)
    {
     	$id = (int)FormUtil::getPassedValue('id');
     	$this->id = $id;
      	// Load article if id is set
		$index = DBUtil::selectObjectByID('lobby_pages',$this->id);
		$render->assign($index);

		// add scribite support
		if (pnModAvailable('scribite')) {
			$scribite = pnModFunc('scribite','user','loader', array(
										'modname' => 'lobby',
			                            'editor'  => pnModGetVar('scribite', 'editor'),
			                            'areas'   => array('text'),
			                            'tpl'     => 'lobby_user_groups_include_modifyindex.htm'
									));
		    PageUtil::AddVar('rawtext', $scribite);
		}
		return true;
    }
    function handleCommand(&$render, &$args)
    {
		if ($args['commandName']=='update') {
			// get the form data and do a validation check
		    $obj = $render->pnFormGetValues();		    
			$obj['id'] = $this->id;
		    // preview mode?
		    if ($obj['preview'] == 1) {
				LogUtil::registerStatus(_LOBBY_INDEXPAGE_ARTICLEPREVIEW);
				$render->assign($obj);
			}
			else {
			    if (!$render->pnFormIsValid()) return false;
			    // store or update group
			    $count = DBUtil::selectObjectCountByID('lobby_pages',$this->id);
			    if ($count == 1) {
					$result = DBUtil::updateObject($obj,'lobby_pages');
				} else {
					$result = DBUtil::insertObject($obj,'lobby_pages','',false,true);
				}
				if ($result) {
					LogUtil::registerStatus(_LOBBY_INDEXPAGE_CREATED);
					return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->id)));
				} else {
					LogUtil::registerError(_LOBBY_INDEXPAGE_CREATIONERROR);
					return false;
				}
			}
		}
		return true;
    }
}
