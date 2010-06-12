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
 * Check if a post is still editable
 *
 */
function lobby_editablePost($post)
{

	$topic = pnModAPIFunc('lobby','forumtopics','get',array('id' => $post['tid']));
	if (($post['id'] == $post['tid']) && ($topic['replies'] > 0)) {
		return false;
	} else {
	  	$tables = pnDBGetTables();
	  	$column = $tables['lobby_forum_posts_column'];
	  	$where = $column['id']." > ".$post['id']." AND ".$post['tid']." = ".$column['tid'];
	  	$result = DBUtil::selectObjectCount('lobby_forum_posts',$where);
	  	if ($result == 0) {
		    return true;
		} else {
		  	return false;
		}
	}
}