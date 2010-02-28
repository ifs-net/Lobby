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
 * get index page of a group
 *
 * @args['gid']		int			group id		(optional)
 * @return			array
 */
function lobby_pagesapi_get($args)
{
  	$id = (int)$args['gid'];
  	$result = DBUtil::selectObjectByID('lobby_pages',$id);
  	if (isset($result['text']) && ($result['text'] != ''))
  	return $result['text'];
}