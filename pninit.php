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
  * initialise the module
  *
  */
function lobby_init() {
  	// Create tables
  	$tables = array (
  		'lobby_pages',
  		'lobby_groups',
  		'lobby_categories',
  		'lobby_moderators',
  		'lobby_members',
  		'lobby_members_pending',
  		'lobby_invitations',
  		'lobby_news',
  		'lobby_users',
  		'lobby_forums',
	  	'lobby_forum_subscriptions',
	  	'lobby_forum_topics',
	  	'lobby_forum_topic_subscriptions',
	  	'lobby_forum_posts',
	  	'lobby_forum_posts_text',
	  	'lobby_albums',
	  	'lobby_albums_pictures',
		  );
	foreach ($tables as $table) {
		if (!DBUtil::createTable($table)) {
		  	return false;
		}
	}
	// Set initial values for module variables
	pnModSetVar('lobby','postsperpage',10);
	pnModSetVar('lobby','topicsperpage',15);
	pnModSetVar('lobby','newsperpage',15);
	return true;
}

/**
 * upgrade routine
 */

function lobby_upgrade($oldversion)
{
   switch($oldversion) {
     case '1.0':
     case '1.1':
   	  	if (!DBUtil::changeTable('lobby_groups')) return false;
    }
     case '1.2':
   	  	if (!DBUtil::changeTable('lobby_groups')) return false;
   	  	if (!DBUtil::createTable('lobby_albums')) return false;
   	  	if (!DBUtil::createTable('lobby_albums_pictures')) return false;
    }
    return true;
}
 /**
  * initialise the module
  *
  */
function lobby_delete() {
  	// Drop tables
  	$tables = array (
  		'lobby_pages',
  		'lobby_groups',
  		'lobby_categories',
  		'lobby_moderators',
  		'lobby_members',
  		'lobby_members_pending',
  		'lobby_invitations',
  		'lobby_news',
  		'lobby_users',
  		'lobby_forums',
	  	'lobby_forum_subscriptions',
	  	'lobby_forum_topics',
	  	'lobby_forum_topic_subscriptions',
	  	'lobby_forum_posts',
	  	'lobby_forum_posts_text',
	  	'lobby_albums',
	  	'lobby_albums_pictures',
		  );
	foreach ($tables as $table) {
		if (!DBUtil::dropTable($table)) {
		  	return false;
		}
	}
	// Delete module variables
	pnModDelVar('lobby');
	return true;
}
