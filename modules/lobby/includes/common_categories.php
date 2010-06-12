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
 * switch categories into form pulldown format
 *
 */
function lobby_categoriesToPullDown($categories)
{
	$result = array();
  	foreach ($categories as $category) {
  	  	if ($category['official'] == 1) {
			$category['title'].="*";
		}
	    $result[] = array ('text' => (string)$category['title'], 'value' => (int)$category['id']);
	}
	return $result;
}

/**
 * switch category into form pulldown format
 *
 */
function lobby_categoryToPullDown($category)
{
	$result = array();
    $result[] = array ('text' => (string)$category['title'], 'value' => (int)$category['id']);
   	return $result;
}