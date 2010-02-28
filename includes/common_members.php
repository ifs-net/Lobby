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
 * switch memnbers into form pulldown format
 *
 */
function lobby_membersToPullDown($users)
{
	$result = array();
  	foreach ($users as $user) {
	    $result[] = array ('text' => (string)$user['uname'], 'value' => $user['uid']);
	}
	return $result;
}