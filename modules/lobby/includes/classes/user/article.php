<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schie�l
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
     	$gid = (int)FormUtil::getPassedValue('id');
     	$this->gid = $gid;
      	// Load article if id is set
     	$story = (int)FormUtil::getPassedValue('story');
     	if ($story > 0) {
			$this->id = $story;
			$article = pnModAPIFunc('lobby','news','get',array('id' => $this->id, 'gid' => $gid));
			$article['articletext'] = $article['text'];
			$render->assign($article);
		}
		$public_status_items = array (
			array('text' => _LOBBY_ALL, 'value' => 0),
			array('text' => _LOBBY_SITEMEMBERS, 'value' => 1),
			array('text' => _LOBBY_GROUPMEMBERS, 'value' => 2)
			);
		$render->assign('public_status_items', $public_status_items);

		if (!($this->id > 0)) {
			// Add initial date
			$initDate = date("Y-m-d H:i",time());
			$render->assign('date',$initDate);
		}
		return true;
    }
    function handleCommand(&$render, &$args)
    {
		if ($args['commandName']=='update') {
			// get the form data and do a validation check
		    $obj = $render->pnFormGetValues();		    
                    $obj['uid'] = pnUserGetVar('uid');
                    $obj['gid'] = $this->gid;
                    $obj['text']= $obj['articletext'];
                    $obj['date'] = DateUtil::transformInternalDate(DateUtil::parseUIDate($obj['date']));
		    // preview mode?
		    if ($obj['preview'] == 1) {
				LogUtil::registerStatus(_LOBBY_NEWS_ARTICLEPREVIEW);
				$render->assign('preview', 	1);
				$render->assign('title',	$obj['title']);
				$render->assign('text',		$obj['text']);
				$render->assign('date',		$obj['date']);
				$render->assign('uid',		$obj['uid']);
			}
			else {
			    if (!$render->pnFormIsValid()) return false;
			    // store or update group
			    if ($this->id > 0) {
					$obj['id'] = $this->id;
			      	// Is there an action to be done?
			      	if ($obj['delete'] == 1) {
						$result = DBUtil::deleteObject($obj,'lobby_news');
						if ($result) {
							LogUtil::registerStatus(_LOBBY_NEWS_DELETED);
							// Update group information
							Loader::includeOnce('modules/lobby/includes/common_groups.php');
							lobby_groupsync($this->id);
							return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'sync' => 1, 'do' => "news")));
						} else {
							LogUtil::registerError(_LOBBY_NEWS_UPDATEERROR);
						}
					} else {
						// update an existing article
						$result = DBUtil::updateObject($obj,'lobby_news');
						if ($result) {
							LogUtil::registerStatus(_LOBBY_NEWS_UPDATED);
							return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'do' => 'news', 'story' => $obj['id'])));
						} else {
							LogUtil::registerError(_LOBBY_NEWS_UPDATEERROR);
							return false;
						}
					}
				} else {
				  	// add new article
					$result = DBUtil::insertObject($obj,'lobby_news');
					if ($result) {
						LogUtil::registerStatus(_LOBBY_NEWS_CREATED);
						return $render->pnFormRedirect(pnModURL('lobby','user','group',array('id' => $this->gid, 'sync' => 1, 'do' => 'news', 'story' => $obj['id'])));
					} else {
						LogUtil::registerError(_LOBBY_NEWS_CREATIONERROR);
						return false;
					}
				}
			}
		}
		return true;
    }
}
