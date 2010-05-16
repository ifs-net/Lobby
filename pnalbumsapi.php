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
 * get albums
 *
 * @args['gid']			int		group id
 * @args['id']			int		album id
 * @args['showall']		int		optional, ==1 show all not considering permissions
 *
 * @return int or boolean
 */
function lobby_albumsapi_get($args)
{
  	$id = (int)$args['id'];
  	$gid = (int)$args['gid'];
  	$showall = (int)$args['showall'];
 	$tables = pnDBGetTables();
  	$column = $tables['lobby_albums_column'];

	$where = array();
	if (!($gid > 0)) {
	    // get album and group id to check ownership later...
        $result = DBUtil::selectObjectByID('lobby_albums',$id);
        $gid = $result['gid'];
    }
	if ($gid > 0) $where[] = "tbl.".$column['gid']." = ".$gid;
	if ($id > 0) $where[] = "tbl.".$column['id']." = ".$id;

	if (($showall == 1) || (SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN))) {
	  	$mystatus = 2;
	} else {
		if (!pnUserLoggedIn()) {
		  	$mystatus = 0;
		} else {
		  	if ($gid > 0) {
				$groupstatus = pnModAPIFunc('lobby','groups','isMember',array('uid' => pnUserGetVar('uid'), 'gid' => $gid));
			  	if ($groupstatus > 0) {
				    $mystatus = 2;
				} else {
					$mystatus = 1;
				}
			} else {
			  	// Todo: Check here if user making this call is member of the group
			  	// ...
			  	// till then: easy way!
			  	$mystatus = 1; // no access for internal group albums
			}
		}
	}
	$where[] 	= "tbl.".$column['public_status']." <= ".$mystatus;

	$wherestring = implode(' AND ',$where);
	$orderby = $column['date']." DESC";
	$result = DBUtil::selectObjectArray('lobby_albums',$wherestring,$orderby);
	if ($id > 0) {
        // add fotos to album
        $orderby = 'date DESC';
        $where = 'aid = '.$id;
        $pictures = DBUtil::selectObjectArray('lobby_albums_pictures',$where,$orderby);
        foreach ($pictures as $item) {
            $picture = pnModAPIFunc('UserPictures','user','get',array('id' => $item['pid']));
            if ($picture[0]['id'] > 0) {
                $content[] = $picture[0];
            }
        }
        $result[0]['pictures'] = $content;
        $resultObject =  $result;
	} else {
        // add index foto to each album
        $resultList = array();
        foreach ($result as $item) {
            $where = 'aid = '.$item['id'];
            $albumpictures = DBUtil::selectObjectArray('lobby_albums_pictures',$where,$orderby,-1,1);
            $coverId = (int)$albumpictures[0]['pid'];
            if ($coverId > 0) {
                $picture = pnModAPIFunc('UserPictures','user','get',array('id' => $coverId));
                if ($picture[0]['id'] > 0) {
                    $item['cover'] = $picture[0]; 
                }
            }
            $resultList[]=$item;
        }
        $resultObject = $resultList;
	}
	return $resultObject;
}

/**
 * add a new album
 *
 * This function adds a new forum into the database
 *
 * @args['gid']				int		
 * @args['id']				int		
 * @args['title']			string 	
 * @args['description']		string 	
 * @args['public_status']	string 	
 *
 * @return boolean
 */
function lobby_albumsapi_add($args)
{
	$obj['gid']				= (int)$args['gid'];
	if (!($obj['gid']) > 0) {
	  	LogUtil::registerError(_LOBBY_ALBUMM_CREATION_ERROR);
		return false;
	}
	if (!isset($args['date']) || ($args['date'] == null) || ($args['date'] == '')) {
        $obj['date'] = date("Y-m-d H:i:s",time());
    } else {
        $obj['date'] = $args['date'];
    }
	$obj['title']			= $args['title'];
	$obj['description']		= $args['description'];
	$obj['public_status']	= $args['public_status'];
	
	$result = DBUtil::insertObject($obj,'lobby_albums');
	if ($result > 0) {
	  	LogUtil::registerStatus(_LOBBY_ALBUM_CREATED);
	  	return $result;
	} else {
	  	LogUtil::registerError(_LOBBY_ALBUM_CREATION_ERROR);
		return false;
	}

}

/**
 * delete a album
 *
 * $args['id']		int		album id
 * @return		booleam
 */
function lobby_albumsapi_del($args)
{
	$id = (int)$args['id'];
	if (!($id > 0)) {
		return false;
	} else {
		// albums
		$where = 'aid = '.$id;
		$result = DBUtil::deleteWhere('lobby_albums_pictures',$where);
		if ($result) {
    		$where = 'id = '.$id;
            $result = DBUtil::deleteWhere('lobby_albums',$where);
        } 
        return $result;
	}
}








/**
 * add a picture to a album
 *
 * $args['aid']     int     album id
 * $args['pid']     int     userpicture picture id
 * @return      boolean
 */
function lobby_albumsapi_addPicture($args) 
{
    $aid = (int)$args['aid'];
    $pid = (int)$args['pid'];
    $uid = pnUserGetVar('uid');
    if (!($aid > 0) || !($pid > 0)) {
        return false;
    }
    // Load Group
    $album = lobby_albumsapi_get(array('id' => $aid));
    $album = $album[0];
//    if (pnusergetvar('uid') == 26351)  prayer($album);
    if (!$album) {
        return false;
    }
  	$group = pnModAPIFunc('lobby','groups','get',array('id' => $album['gid']));
//  	prayer($group);
  	if (!$group) {
        return false;
    }
    // Check permission
    $memberStatus = pnModAPIFunc('lobby','groups','getMemberStatus',array('group' => $group, 'uid' => $uid));
    if (!($memberStatus > 0)) {
        return false;
    }
    // Add Picture (if picture is not already added)
    $where = "aid = $aid and pid = $pid";
    $result = (int)DBUtil::selectObjectCount('lobby_albums_pictures',$where);
    if ($result > 0) {
        LogUtil::registerError(_LOBBY_PICTURE_ALREADY_EXISTS);
        return false;
    }
    // get Picture and check ownership
    $picture = pnModAPIFunc('UserPictures','user','get',array('id' => $pid));
    if ($picture[0]['uid'] != $uid) {
        return false;
    }
    // Add picture now
    $obj = array(
        'date'  => date("Y-m-d H:i:s",time()),
        'aid'   => $aid,
        'pid'   => $pid
    );
    $result = DBUtil::insertObject($obj,'lobby_albums_pictures');
    return $result;
}


/**
 * delete a picture to a album
 *
 * $args['aid']     int     album id
 * $args['pid']     int     userpicture picture id
 * @return      boolean
 */
function lobby_albumsapi_delPicture($args) 
{
    $aid = (int)$args['aid'];
    $pid = (int)$args['pid'];
    $uid = pnUserGetVar('uid');
    if (!($aid > 0) || !($pid > 0)) {
        return false;
    }
    // Load Group
    $album = lobby_albumsapi_get(array('id' => $aid));
    if (!$album) {
        return false;
    }
    $album=$album[0];
  	$group = pnModAPIFunc('lobby','groups','get',array('id' => $album['gid']));
  	if (!$group) {
        return false;
    }
    // Check permission
    $memberStatus = pnModAPIFunc('lobby','groups','getMemberStatus',array('group' => $group, 'uid' => $uid));
    if (!($memberStatus > 0)) {
        return false;
    }
    // Delete Picture if picture_uid = $uid or admin...
    $where = "aid = $aid and pid = $pid";
    if ($memberStatus < 2) {
        // we need to check id picture id belongs to user
        $picture = pnModAPIFunc('UserPictures','user','get',array('id' => $pid));
        if ((int)$picture[0]['uid'] != $uid) {
            LogUtil::registerError(_LOBBY_NO_PERM_TO_DEL_PICTURE);
            return false;
        }
    }
    $result = (int)DBUtil::deleteWhere('lobby_albums_pictures',$where);
    return $result;
}

