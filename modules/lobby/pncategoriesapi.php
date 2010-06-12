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
 * get all categories
 * 
 * @args['id']	int			id of category (optional)
 * @return		array       the categories
 */
function lobby_categoriesapi_get($args)
{
	// Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_OVERVIEW)) {
		return false;
	}
	$id = (int)$args['id'];
	if ($id > 0) {
	  	$result = DBUtil::selectObjectByID('lobby_categories',$id);
	} else {
		$result = DBUtil::selectObjectArray('lobby_categories');
	}
	return $result;
}