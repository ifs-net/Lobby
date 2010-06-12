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
 * Populate tables array for the module
 *
 * @return       array       The table information.
 */
function lobby_pntables()
{
    // Initialise table array
    $table = array();

    $lobby = DBUtil::getLimitedTablename('lobby');
    $table['lobby'] = $lobby;

    // Set the table name
	$table['lobby_groups']						= $lobby."_groups";
    $table['lobby_categories'] 					= $lobby."_categories";
    $table['lobby_moderators'] 					= $lobby."_moderators";
    $table['lobby_members'] 					= $lobby."_members";
    $table['lobby_pages']	 					= $lobby."_pages";
    $table['lobby_users']	 					= $lobby."_users";
    $table['lobby_members_pending'] 			= $lobby."_members_pending";
    $table['lobby_invitations']		 			= $lobby."_invitations";
    $table['lobby_news']			 			= $lobby."_news";
    $table['lobby_forums']			 			= $lobby."_forums";
    $table['lobby_forum_subscriptions']			= $lobby."_forum_subscriptions";
    $table['lobby_forum_topics']	 			= $lobby."_forum_topics";
    $table['lobby_forum_topic_subscriptions'] 	= $lobby."_forum_topic_subscriptions";
    $table['lobby_forum_posts']				 	= $lobby."_forum_posts";
    $table['lobby_forum_posts_text'] 			= $lobby."_forum_posts_text";
    $table['lobby_albums']           			= $lobby."_albums";
    $table['lobby_albums_pictures']    			= $lobby."_albums_pictures";

    // Columns for tables
    $table['lobby_groups_column'] = array (
    			'id'					=> 'id',
    			'uid'					=> 'uid',
    			'title'					=> 'title',
    			'date'					=> 'date',
    			'members'				=> 'members',
    			'articles'				=> 'articles',
    			'indextopics'			=> 'indextopics',
    			'topics'				=> 'topics',
    			'forums'				=> 'forums',
    			'postings'				=> 'postings',
    			'picture'				=> 'picture',
    			'forumsvisible'			=> 'forumsvisible',
    			'description'			=> 'description',
    			'last_action'			=> 'last_action',
    			'accepted'				=> 'accepted',
    			'moderated'				=> 'moderated',
    			'category'				=> 'category',
    			'albums'                => 'albums',
    			'albums_pictures'       => 'albums_pictures',
    			'coordinates'			=> 'coordinates',
    			'boxes_shownews'        => 'boxes_shownews',
    			'boxes_showforumlinks'  => 'boxes_showforumlinks',
    			'boxes_showalbums'      => 'boxes_showalbums'
    			);
    $table['lobby_groups_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'uid'					=> "I NOTNULL DEFAULT 0",
    			'title'					=> "C(60) NOTNULL DEFAULT ''",
    			'date'					=> "T NOTNULL",
    			'members'				=> "I NOTNULL DEFAULT 0",
    			'articles'				=> "I NOTNULL DEFAULT 0",
    			'indextopics'			=> "I NOTNULL DEFAULT 5",
    			'topics'				=> "I NOTNULL DEFAULT 0",
    			'forums'				=> "I NOTNULL DEFAULT 0",
    			'postings'				=> "I NOTNULL DEFAULT 0",
    			'picture'				=> "C(120) NOTNULL DEFAULT ''",
    			'forumsvisible'			=> "I(1) NOTNULL DEFAULT 1",
    			'description'			=> "C(255) NOTNULL DEFAULT ''",
    			'last_action'			=> "T NOTNULL",
    			'accepted'				=> "L NOTNULL DEFAULT 0",
    			'moderated'				=> "L NOTNULL DEFAULT 0",
    			'category'				=> "I NOTNULL DEFAULT 0",
    			'albums'				=> "I NOTNULL DEFAULT 0",
    			'albums_pictures'		=> "I NOTNULL DEFAULT 0",
    			'coordinates'			=> "C(99) NOTNULL DEFAULT ''",
    			'boxes_shownews'        => "I(1) NOTNULL DEFAULT 1",
    			'boxes_showforumlinks'  => "I(1) NOTNULL DEFAULT 1",
    			'boxes_showalbums'      => "I(1) NOTNULL DEFAULT 1"
    			);
    $table['lobby_categories_column'] = array (
    			'id'					=> 'id',
    			'title'					=> 'title',
    			'official'				=> 'official'
    			);
    $table['lobby_categories_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'title'					=> "C(60) NOTNULL DEFAULT ''",
    			'official'				=> "L NOTNULL"
    			);
    $table['lobby_pages_column'] = array (
    			'id'					=> 'id',
    			'text'					=> 'text'
    			);
    $table['lobby_pages_column_def'] = array (
    			'id'					=> "I NOTNULL PRIMARY",
    			'text'					=> "XL NOTNULL"
    			);
    $table['lobby_users_column'] = array (
    			'id'					=> 'id',
    			'array'					=> 'array',
    			'last_action'			=> 'last_action'
    			);
    $table['lobby_users_column_def'] = array (
    			'id'					=> "I NOTNULL PRIMARY",
    			'array'					=> "XL NOTNULL",
    			'last_action'			=> "T NOTNULL"
    			);
    $table['lobby_moderators_column'] = array (
    			'id'					=> 'id',
    			'gid'					=> 'gid',
    			'uid'					=> 'uid'
    			);
    $table['lobby_moderators_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 0"
    			);
    $table['lobby_members_column'] = array (
    			'id'					=> 'id',
    			'gid'					=> 'gid',
    			'uid'					=> 'uid',
    			'date'					=> 'date'
    			);
    $table['lobby_members_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 0",
    			'date'					=> "T NOTNULL"
    			);
    $table['lobby_members_pending_column'] = array (
    			'id'					=> 'id',
    			'gid'					=> 'gid',
    			'uid'					=> 'uid',
    			'date'					=> 'date',
    			'text'					=> 'text'
    			);
    $table['lobby_users_column'] = array (
    			'id'					=> 'id',
    			'array'					=> 'array',
    			'last_action'			=> 'last_action'
    			);
    $table['lobby_users_column_def'] = array (
    			'id'					=> "I PRIMARY",
    			'array'					=> "XL NOTNULL",
    			'last_action'			=> "T NOTNULL"
    			);
    $table['lobby_members_pending_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 0",
    			'date'					=> "T NOTNULL",
    			'text'					=> "C(255) NOTNULL DEFAULT ''"
    			);
    $table['lobby_invitations_column'] = array (
    			'id'					=> 'id',
    			'gid'					=> 'gid',
    			'uid'					=> 'uid',
    			'invited_uid'			=> 'invited_uid',
    			'text'					=> 'text',
    			'date'					=> 'date'
    			);
    $table['lobby_invitations_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 0",
    			'invited_uid'			=> "I NOTNULL DEFAULT 0",
    			'text'					=> "C(255) NOTNULL DEFAULT ''",
    			'date'					=> "T NOTNULL"
    			);
    $table['lobby_news_column'] = array (
    			'id'					=> 'id',
    			'gid'					=> 'gid',
    			'public_status'			=> 'public_status',
    			'uid'					=> 'uid',
    			'title'					=> 'title',
    			'text'					=> 'text',
    			'date'					=> 'date',
    			'sent'					=> 'sent'
				);
    $table['lobby_news_column_def'] = array (
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'public_status'			=> "L NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 0",
    			'title'					=> "C(60) NOTNULL DEFAULT ''",
    			'text'					=> "XL NOTNULL",
    			'date'					=> "T NOTNULL",
    			'sent'					=> "I(1) NOTNULL DEFAULT 0"
				);
    $table['lobby_forums_column'] = array(
    			'id'					=> 'id',
    			'gid'					=> 'gid',
    			'title'					=> 'title',
    			'description'			=> 'description',
    			'sort_nr'				=> 'sort_nr',
    			'topics'				=> 'topics',
    			'posts'					=> 'posts',
    			'public_status'			=> 'public_status',
    			'last_poster'			=> 'last_poster',
    			'last_poster_date'		=> 'last_poster_date',
    			'last_poster_tid'		=> 'last_poster_tid',
    			'last_topic_poster'		=> 'last_topic_poster',
    			'last_topic_date'		=> 'last_topic_date',
    			'last_tid'				=> 'last_tid'
    			);
    $table['lobby_forums_column_def'] = array(
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'title'					=> "C(60)",
    			'description'			=> "C(255)",
    			'sort_nr'				=> "I NOTNULL DEFAULT -1",
    			'topics'				=> "I NOTNULL DEFAULT 0",
    			'posts'					=> "I NOTNULL DEFAULT 0",
    			'public_status'			=> "L NOTNULL DEFAULT 0",
    			'last_poster'			=> "I NOTNULL DEFAULT 0",
    			'last_poster_date'		=> "T NOTNULL",
    			'last_poster_tid'		=> "I NOTNULL DEFAULT 0",
    			'last_topic_poster'		=> "I NOTNULL DEFAULT 0",
    			'last_topic_date'		=> "T NOTNULL",
    			'last_tid'				=> "I NOTNULL DEFAULT 0"
    			);
    $table['lobby_forum_subscriptions_column'] = array(
    			'id'					=> 'id',
    			'fid'					=> 'fid',
    			'uid'					=> 'uid'
    			);    			
    $table['lobby_forum_subscriptions_column_def'] = array(
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'fid'					=> "I NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 1"
    			);
    $table['lobby_forum_topics_column'] = array(
    			'id'					=> 'id',
    			'fid'					=> 'fid',
    			'pid'					=> 'pid',
    			'gid'					=> 'gid',
    			'replies'				=> 'replies',
    			'locked'				=> 'locked',
    			'marked'				=> 'marked',
    			'date'					=> 'date',
    			'last_date'				=> 'last_date',
    			'last_pid'				=> 'last_pid',
    			'last_uid'				=> 'last_uid',
    			'uid'					=> 'uid'
    			);    			
    $table['lobby_forum_topics_column_def'] = array(
    			'id'					=> "I NOTNULL PRIMARY",
    			'fid'					=> "I NOTNULL DEFAULT 0",
    			'pid'					=> "I NOTNULL DEFAULT 0",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'replies'				=> "I NOTNULL DEFAULT 0",
    			'locked'				=> "L NOTNULL DEFAULT 0",
    			'marked'				=> "L NOTNULL DEFAULT 0",
    			'date'					=> "T NOTNULL",
    			'last_date'				=> "T NOTNULL",
    			'last_pid'				=> "I NOTNULL DEFAULT 0",
    			'last_uid'				=> "I NOTNULL DEFAULT 1",
    			'uid'					=> "I NOTNULL DEFAULT 1"
    			);
    $table['lobby_forum_topic_subscriptions_column'] = array(
    			'id'					=> 'id',
    			'tid'					=> 'tid',
    			'uid'					=> 'uid'
    			);    			
    $table['lobby_forum_topic_subscriptions_column_def'] = array(
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'tid'					=> "I NOTNULL DEFAULT 0",
    			'uid'					=> "I NOTNULL DEFAULT 1"
    			);
    $table['lobby_forum_posts_column'] = array(
			    'id'      				=> 'id',
			    'uid'					=> 'uid',
			    'fid'					=> 'fid',
			    'tid'					=> 'tid',
			    'title'					=> 'title',
			    'date'					=> 'date'
			    );
    $table['lobby_forum_posts_column_def'] = array(
    			'id'					=> "I AUTOINCREMENT PRIMARY",
    			'uid'					=> "I NOTNULL DEFAULT 1",
    			'fid'					=> "I NOTNULL DEFAULT 0",
    			'tid'					=> "I NOTNULL DEFAULT 0",
    			'title'					=> "C(100) NOTNULL DEFAULT ''",
    			'date'					=> "T NOTNULL"
    			);
    $table['lobby_forum_posts_text_column'] = array(
			    'id'      				=> 'id',
			    'text'					=> 'text'
			    );
    $table['lobby_forum_posts_text_column_def'] = array(
    			'id'					=> "I NOTNULL PRIMARY ",
    			'text'					=> "XL NOTNULL"
    			);
    $table['lobby_albums_column'] = array(
			    'id'      				=> 'id',
			    'gid'      				=> 'gid',
			    'title'    				=> 'title',
			    'description'  		    => 'description',
			    'date'    				=> 'date',
			    'public_status'			=> 'public_status'
			    );
    $table['lobby_albums_column_def'] = array(
    			'id'					=> "I AUTOINCREMENT PRIMARY ",
    			'gid'					=> "I NOTNULL DEFAULT 0",
    			'title'					=> "C(125) NOTNULL DEFAULT ''",
    			'description'			=> "XL NOTNULL",
    			'date'       			=> "T NOTNULL",
    			'public_status'			=> "L NOTNULL DEFAULT 0"
    			);
    $table['lobby_albums_pictures_column'] = array(
			    'id'      				=> 'id',
			    'aid'      				=> 'aid',
			    'pid'    				=> 'pid',
			    'date'                  => 'date'
			    );
    $table['lobby_albums_pictures_column_def'] = array(
    			'id'					=> "I AUTOINCREMENT PRIMARY ",
    			'aid'					=> "I NOTNULL DEFAULT 0",
    			'pid'					=> "I NOTNULL DEFAULT 0",
			    'date'                  => "T NOTNULL"
    			);
	// Return table information
	return $table;
}
