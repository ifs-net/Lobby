<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

// general
define('_LOBBY_YES',						'yes');
define('_LOBBY_NO',							'no');
define('_LOBBY_BACKEND',					'Administration of "lobby" module');

// Header
define('_LOBBY_MAIN',						'Administration backend');
define('_LOBBY_PENDING_GROUPS',				'Activate pending groups');
define('_LOBBY_CATEGORY_MANAGEMENT',		'Manage categories');
define('_LOBBY_SETTINGS',					'Settings');
define('_LOBBY_IMPORT',						'Import');

// main
define('_LOBBY_AMDIN_TEXT',					'Welcome to the admin backend. You can activate pending groups and configure main settings here');
define('_LOBBY_AMDIN_PENDING_GROUPS',		'Amount of pending groups');

// import
define('_LOBBY_IMPORT_MANAGEMENT',			'Import different content into groups');
define('_LOBBY_IMPORT_USERS',				'Import user groups');
define('_LOBBY_IMPORT_USERS_TEXT',			'Just choose the user group you want to import. Action will be done immediately after clicking the button');
define('_LOBBY_IMPORT_FORUMS',				'Import forums');
define('_LOBBY_IMPORT_FORUMS_TEXT',			'Choose the source and target. Import will be done immediately after a click on the button');
define('_LOBBY_COPY_FROM',					'Copy from');
define('_LOBBY_COPY_TO',					'to');
define('_LOBBY_SELECT_FOR_ACTION',			'Choose for import');
define('_LOBBY_NO_IMPORT_SELECTED',			'Please choose an import type!');
define('_LOBBY_IMPORT_SKIP_USER',			'User not imported because the user is already member of the target group');
define('_LOBBY_ADDED_USER',					'Adding user');
define('_LOBBY_IMPORTED_USERS',				'user imported sucessfully');
define('_LOBBY_FAILED_USER',				'Importing users failed');
define('_LOBBY_TOPIC_IMPORT_ERROR',			'Importing topic failed');
define('_LOBBY_TOPIC_IMPORTED',				'Topic imported');
define('_LOBBY_POSTING_IMPORT_ERROR',		'Postings belonging to a topic could not be imported');

// categories
define('_LOBBY_CATEGORY_OFFICIAL',			'official category');
define('_LOBBY_CATEGORY_MANAGEMENT',		'Manage categories');
define('_LOBBY_CATEGORY_TITLE',				'category title');
define('_LOBBY_CATEGORY_UPDATE_STORE',		'store / update');
define('_LOBBY_CATEGORY_INSERTED',			'Category was added');
define('_LOBBY_CATEGORY_STOREFAILURE',		'Storing or updating category failed');
define('_LOBBY_CATEGORY_UPDATED',			'Category updated');
define('_LOBBY_CATEGORY_OFFICIAL_EXPL',		'Official groups are moderated and have to be activated by the site administrator. Groups that are not marked as official (non official) will be active after the user creates them.');
define('_LOBBY_CATEGORY_NOCATECORIES',		'There are no categories created yet');
define('_LOBBY_CATEGORY_OVERVIEW',			'Category overview. Click on the title to modify a category');
define('_LOBBY_CATEGORY_DELETE',			'Delete this category (only possible if category is not used yet)');
define('_LOBBY_CATEGORY_DELETEERROR',		'Deleting category failed');
define('_LOBBY_CATEGORY_DELETED',			'Category deleted');

// pending
define('_LOBBY_PENDING_NO_PENDING',			'No groups are pending');
define('_LOBBY_GROUP_NAME',					'Description');
define('_LOBBY_GROUP_AUTHOR',				'Creator');
define('_LOBBY_GROUP_ DATE',				'Creation date');
define('_LOBBY_GROUP_CATEGORY',				'Category');
define('_LOBBY_ACTION',						'Action');
define('_LOBBY_ACCEPT',						'activate');
define('_LOBBY_DELETE',						'delete');
define('_LOBBY_GROUP_ACCEPTED',				'Group was activated');
define('_LOBBY_GROUP_ACCEPTED_ERROR',		'Activating group failed');

// settings
define('_LOBBY_CREATE_GROUP_URL',			'You can optionally specify a url here that should be linked with the "create new group" link instead of standard page (for example, to create an explanation page)');
define('_LOBBY_CREATE_GROUP_URL_TEXT',		'If there is no URL specified the users will automatically be forwarded to the group creation form. You may want to create your own page to explain this step and link the form manually');
define('_LOBBY_SETTINGS_MANAGEMENT',		'Manage settings');
define('_LOBBY_TOPICS_PER_PAGE',			'Amount of topics to show on a page');
define('_LOBBY_POSTS_PER_PAGE',				'Amount of postings to show in a topic page');
define('_LOBBY_NEWS_PER_PAGE',				'News items per page in the news section');
define('_LOBBY_SETTINGS_UPDATE',			'Store settings');
define('_LOBBBY_SETTINGS_STORED',			'Settings stored');