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
define('_LOBBY_OCLOCK',							'o\'clock');
define('_LOBBY_GO',								'go');
define('_LOBBY_YES',							'yes');
define('_LOBBY_NO',								'no');
define('_LOBBY_ONLY_ADMIN_ACCESS',				'Only administrators and group creators have access to this function');
define('_LOBBY_FORUMS',							'Forums');
define('_LOBBY_FORUM',							'Forum');
define('_LOBBY_NEWS',							'News');
define('_LOBBY_BY',								'of');
define('_LOBBY_HOURS',							'hours');
define('_LOBBY_GROUP',							'Group');
define('_LOBBY_AUTHOR',							'Author');
define('_LOBBY_DATE',							'Date');
define('_LOBBY_OF',								'of');
define('_LOBBY_VISIT',							'visit');
define('_LOBBY_LAST',							'last');
define('_LOBBY_QUOTE',							'Cite text');
define('_LOBBY_GO_TO_TOP',						'Go to top');
define('_LOBBY_EDIT',							'modify');

// main
define('_LOBBY_WELCOME',						'Welcome to your network');
define('_LOBBY_INTRO_WELCOME_TEXT',				'This is an overview of all groups. Feel free to create your own group!');
define('_LOBBY_CREATE_GROUP',					'Create your own group');
define('_LOBBY_RECENT_JOINS',					'New memberships');
define('_LOBBY_NEW_GROUPS',						'New groups');
define('_LOBBY_ALL_GROUPS_NEWS',				'News of all groups');
define('_LOBBY_MY_GROUPS_NEWS',					'News of my groups');
define('_LOBBY_ALL_GROUPS_POSTS',				'Topics of all groups');
define('_LOBBY_MY_GROUPS_POSTS',				'Topics of my groups');
define('_LOBBY_NO_NEW_GROUPS',					'No new groups created');
define('_LOBBY_GROUP_EDIT_INFORMATION',			'Main settings');
define('_LOBBY_GROUP_ADMIN_SYNC',				'Sync group');
define('_LOBBY_GROUP_ONLINE_MEMBERS',			'Members that are online');
define('_LOBBY_OUR_PLACE',						'This is the group\'s home');
define('_LOBBY_SHORT_LATEST_TOPICS',			'Sort by latest topics');
define('_LOBBY_SHORT_LATEST_POSTINGS',			'Sort by latest replied');
define('_LOBBY_FORUM_SHORTLINK_LATEST',			'Postings since last visit');
define('_LOBBY_FORUM_SHORTLINK_24',				'Postings of last 24h');
define('_LOBBY_FORUM_SHORTLINK_WEEK',			'Postings for last week');
define('_LOBBY_FORUM_SHORTLINK_LATEST_TOPICS',	'Topics since last visit');
define('_LOBBY_FORUM_SHORTLINK_24_TOPICS',		'Topics of last 24h');
define('_LOBBY_FORUM_SHORTLINK_WEEK_TOPICS',	'Topics for last week');
define('_LOBBY_SHOW_ALL_GROUPS',				'Display all groups');
define('_LOBBY_FORUM_SHORTLINK_ALL',			'Display all forums');
define('_LOBBY_NO_TOPICS_YET',					'No topics found yet');
define('_LOBBY_NO_NEW_ARTICLES',				'No article written yet');
define('_LOBBY_GROUP_FORUM_SHORTLINKS',			'Quick forum access');
define('_LOBBY_YOU_NEED_HELP',					'You need help');
define('_LOBBY_CLICK_HERE',						'click here');
define('_LOBBY_GROUP_HELP',						'You need help');
define('_LOBBY_NO_NEW_MEMBERS',					'No memberships found yet');
define('_LOBBY_ENTERED',						'has joined');
define('_LOBBY_GROUP_QUIT',						'Cancel membership');
define('_LOBBY_FORUMS_OVERVIEW_LINK',			'Current discussions of group');
define('_LOBBY_FORUMS_OWN_OVERVIEW_LINK',		'Current  discussions of own groups');

// forums
define('_LOBBY_DISPLAY_MODE',					'filter topics');
define('_LOBBY_SHOW_ALL',						'all groups');
define('_LOBBY_SHOW_ALL_OFFICIAL',				'official groups');
define('_LOBBY_SHOW_OWN',						'your own groups');

// list
define('_LOBBY_GROUPS_LIST',					'Available groups');
define('_LOBBY_GROUPS_LIST_TEXT',				'All available groups are listed here.');
define('_LOBBY_QUICKDATA',						'Group facts');
define('_LOBBY_MEMBERS',						'Members');
define('_LOBBY_VISIT_GROUP',					'Visit group');
define('_LOBBY_CAT_FILTER_HINT',				'If you only want to display a special category click on the categories name');
define('_LOBBY_CAT_FILTER_DEACTIVATE',			'Deactivate filter');
define('_LOBBY_OPTIONS',						'Options');

// invite
define('_LOBBY_UNAME_NOT_FOUND',				'User name could not be found');
define('_LOBBY_USER_INVITED',					'User was invited to group');
define('_LOBBY_USER_ALREADY_MEMBER',			'User is already a member of the group');
define('_LOBBY_USER_INVITATION_ERROR',			'Internal error - Invitation could not be sent');
define('_LOBBY_INVITATIONS_ONLY_MEMBERS',		'You have to be a member of a group to recommend the group to another user');
define('_LOBBY_USER_ALREADY_INVITED',			'An invitation for this group was already sent to this user earlier');

// edit
define('_LOBBY_EDIT_INDEX_POSTINGS',            'Number of forum topics / postings that should be shown at the group index page');
define('_LOBBY_LAT',							'Latitude');
define('_LOBBY_LNG',							'Longitude');
define('_LOBBY_CLICK_CARD_FOR_COORDS',			'Just click on the card to grab coordinates of a visible point');
define('_LOBBY_MODIFY_GROUUP',					'Modify group or create new group');
define('_LOBBY_EDIT_GROUP_TITLE',				'Group title');
define('_LOBBY_EDIT_GROUP_NOCHANGELATER',		'You can not change this value after the group has been created');
define('_LOBBY_EDIT_GROUP_DESCRIPTION',			'Public description of the group');
define('_LOBBY_EDIT_GROUP_CATEGORY',			'Category to use for this group');
define('_LOBBY_EDIT_GROUP_MODERATED',			'Moderate new membership requests');
define('_LOBBY_EDIT_UPDATE_STORE',				'create / update group');
define('_LOBBY_EDIT_OFFICIALGROUPSECPL',		'If you choose an official group your request has to be accepted and activated by the site administrator before it can be used by other users');
define('_LOBBY_GROUPS_ADDERROR',				'Adding group failed');
define('_LOBBY_GROUPS_ADDED',					'The group "%group%" was added');
define('_LOBBY_GROUP_PENDING',					'You will be informed after the group was accepted by the admin.');
define('_LOBBY_FORUMTITLE_INTRODUCTION',		'Newbie forum');
define('_LOBBY_FORUMTITLE_INTRODUCTION_DESC',	'Say hello to the group as a new member here!');
define('_LOBBY_FORUMTITLE_Q_AND_A',				'Questions and answerd');
define('_LOBBY_FORUMTITLE_Q_AND_A_DESC',		'You need help? You want to know something? Ask here!');
define('_LOBBY_FORUMTITLE_PRIVATE',				'Private, internal forum');
define('_LOBBY_FORUMTITLE_PRIVATE_DESC',		'Discuss things in here that should be private');
define('_LOBBY_FORUMTITLE_TALK',				'Public group forum');
define('_LOBBY_FORUMTITLE_TALK_DESC',			'You can discuss public things here that could be read by other users that are not members, too');
define('_LOBBY_GROUP_EDIT_INITPROCESS',			'Group standard template was applied to group');
define('_LOBBY_GROUP_OWNER_NODELETE',			'You can not add the group creator as moderator');
define('_LOBBY_GROUP_ALREADY_EXISTS',			'The chosen title of the group already exists. Choose another one please');
define('_LOBBY_CREATE_FORUMS',					'Create some example forums');
define('_LOBBY_DELETE_GROUP',					'Delete group and every data that belongs to the group');
define('_LOBBY_DELETION_MEMBER_FAILS',			'Deleting the group failed');
define('_LOBBY_DELETION_NEWS_FAILS',			'Deleting news failed');
define('_LOBBY_DELETION_MODERATORS_FAILS',		'Deleting moderator failed');
define('_LOBBY_DELETION_MEMBER_PENDING_FAILS',	'Deleting membership request failed');
define('_LOBBY_DELETION_FORUMS_FAILS',			'Deleting forum failed');
define('_LOBBY_DELETION_GROUP_FAILS',			'Deleting group core data failed');
define('_LOBBY_GROUP_DELETED',					'Group was deleted');
define('_LOBBY_FORUMS_VISIBLE_TO_ALL',			'The forums in the forum overview should be visible to everybody. Topics and postings in the forums can only be read as you set the individual permissions.');

// groups api
define('_LOBBY_GROUP_ADDMEMBER_FAILURE',		'Adding a new member failed');
define('_LOBBY_GROUPS_MEMBERADDED',				'The user "%member%" was added to the group');
define('_LOBBY_GROUP_GETMEMBERS_PARAMFAILURE',	'Parameter for reading group data incorrect');
define('_LOBBY_GROUP_SYNCED',					'Group was synced');
define('_LOBBY_GROUP_SYNC_ERROR',				'Sync failed');
define('_LOBBY_REALLY_DELETE',					'Do you really want to do this delete action');

// group
define('_LOBBY_GROUPINDEX',						'Show index page for all groups');
define('_LOBBY_GROUP_NOT_YET_ACCEPTED',			'This group has not been activated by the site admin yet. Use the time for setting up your new group. After the group is accepted by the site administrator it will be online!');
define('_LOBBY_GROUP_INDEX_PAGE',				'To the group\'s index page');
define('_LOBBY_GROUP_NONEXISTENT',				'The chosen group does not exist or is not active yet.');
define('_LOBBY_GROUP_NEWS',						'Group news');
define('_LOBBY_GROUP_NONEWS',					'No news up to now');
define('_LOBBY_GROUP_FACTS',					'Facts');
define('_LOBBY_GROUP_LASTACTION',				'Last activity');
define('_LOBBY_GROUP_MEMBERS',					'Members');
define('_LOBBY_GROUP_ARTICLES',					'Articles (News)');
define('_LOBBY_GROUP_FORUMS',					'Group forums');
define('_LOBBY_GROUP_TOPICS',					'Forum topics');
define('_LOBBY_GROUP_POSTINGS',					'Forum postings');
define('_LOBBY_GROUP_NEW_TOPICS',				'New forum topics');
define('_LOBBY_GROUP_NEW_POSTINGS',				'New forum postings');
define('_LOBBY_GROUP_CATEGORY',					'Category');
define('_LOBBY_GROUP_CREATOR',					'Creator');
define('_LOBBY_GROUP_MODERATORS',				'Moderators');
define('_LOBBY_GROUP_YOURSTATUS',				'Your status');
define('_LOBBY_GROUP_MEMBER',					'Member');
define('_LOBBY_GROUP_NO_MEMBER',				'Guest');
define('_LOBBY_GROUP_JOIN',						'join');
define('_LOBBY_GROUP_PUBLICGROUP',				'Group is public - you can join the group right now');
define('_LOBBY_GROUP_MODERATEDGROUP',			'Group is moderated - you can create a membership request');
define('_LOBBY_GROUP_ADMIN_MENU',				'Manage');
define('_LOBBY_GROUP_ADMIN_PENDING',			'Pending requests');
define('_LOBBY_GROUP_ADMIN_MEMBER_MANAGEMENT',	'Manage members');
define('_LOBBY_GROUP_ADMIN_NEW_ARTICLE',		'Write article');
define('_LOBBY_GROUP_ADMIN_FORUM_MANAGEMENT',	'Manage forums');
define('_LOBBY_NEWS_INDEX',						'To the articles');
define('_LOBBY_GROUP_INVITE',					'Invite friends');
define('_LOBBY_GROUP_NOMEMBERS',				'No members yet');
define('_LOBBY_GROUP_NOMEMBERS_ONLINE',			'No members online');
define('_LOBBY_GROUP_RESPONSIBLE',				'Group creator');
define('_LOBBY_GROUP_FORUM_INDEX',				'Group forum overview');
define('_LOBBY_GROUP_FORUM_RECENT_TOPICS',		'latest topics');
define('_LOBBY_GROUP_FORUM_RECENT_POSTS',		'latest postings');
define('_LOBBY_GROUP_TROUBLE_CONTACT',			'Please contact the group creator in case of any problems');
define('_LOBBY_GROUP_MORE_TROUBLE_CONTACT',		'Pleas inform the site administrator if problems rise up the group creator can not solve');
define('_LOBBY_GROUP_MODIFY_INDEX',				'Create an individual home page for the group');
define('_LOBBY_GROUP_ADMIN_INDEXPAGE',			'Modify home page');
define('_LOBBY_GROUP_LATEST_MEMBERS',			'Latest members');
define('_LOBBY_GROUP_UPDATED',					'Group was updated');
define('_LOBBY_GROUP_UPDATE_ERROR',				'Updating group failed');

// group // invite
define('_LOBBY_INVITE_ENTER_TEXT',				'Invitation text');
define('_LOBBY_INVITE_TO_SITE',					'Invite other users');
define('_LOBBY_INVITE_ENTER_UNAME',				'Enter username');
define('_LOBBY_INVITE_NO_MEMBER',				'Invite externals');

// group // quit
define('_LOBBY_QUIT_MEMBERSHIP',				'Cancel membership');
define('_LOBBY_QUIT_MEMBERSHIP_TEXT',			'Cancelling the membership will send an email information to the creator of the group');
define('_LOBBY_QUIT_MEMBERSHIP_LINK',			'Cancel membership now');
define('_LOBBY_MEMBERSHIP_QUITTED',				'Membership was cancelled');
define('_LOBBY_MEMBERSHIP_QUIT_REASON',			'Please describe for the group creator the reason why you are cancelling your membership');

// group // forums
define('_LOBBY_GROUP_NO_FORUM',					'No forum created yet');
define('_LOBBY_FORUM_TOPICS',					'Topics');
define('_LOBBY_FORUM_POSTS',					'Postings');
define('_LOBBY_FORUM_LATES_TOPIC',				'Latest topic');
define('_LOBBY_FORUM_LATES_POST',				'Latest posting');
define('_LOBBY_PUBLIC_STATUS_GROUP',			'Visible and usable only by members of this group');
define('_LOBBY_PUBLIC_STATUS_REGUSERS',			'Visible and usable by registered users of this website');
define('_LOBBY_PUBLIC_STATUS_ALL',				'Visible for all, usable for registered users of this website');
define('_LOBBY_SINCE_DATE',						'since the date');
define('_LOBBY_SINCE',							'since');
define('_LOBBY_TOPICS_SHOW',					'show');
//define('_LOBBY_FORUM_TOPICS_OF_LAST',			'Themen der letzten');
define('_LOBBY_LATEST_POSTS',					'Latest forum posts');
define('_LOBBY_LATEST_TOPICS',					'Latest forum topics');

// group // join
define('_LOBBY_GROUP_JOINGROUP',				'Join this group');
define('_LOBBY_GROUP_JOIN_MODERATED',			'Group is moderated. This means, that nobody can join the group without the permission of the group creator. You can add text for the group creator that will be added to your membership request');
define('_LOBBY_GROUP_JOIN_TEXT',				'Additional information for the group creator');
define('_LOBBY_GROUP_JOIN_NOW',					'Join the group now');
define('_LOBBY_GROUP_JOIN_REQUEST',				'Send membership request');
define('_LOBBY_GROUP_JOIN_PUBLIC',				'You will become an active member immediately after submitting your request');
define('_LOBBY_GROUP_REQUESTSENT',				'Membership request was sent to the group owner.');
define('_LOBBY_GROUP_JOINERROR',				'Sending membership request failed');
define('_LOBBY_GROUP_ADD_ALREDY_MEMBER',		'You are already a member of this group');
define('_LOBBY_GROUP_ADD_ALREDY_PENDING',		'There is still an active membership request. Please wait until the group creator has decided');
define('_LOBBY_GROUPS_ADDERROR',				'Adding a user to the group failed!');

// groups // pending
define('_LOBBY_GROUP_PENDING_MEMBERS',			'Pending membership requests');
define('_LOBBY_GROUP_PENDING_TEXT',				'Overview about all pending membership requests');
define('_LOBBY_GROUP_NO_PENDING',				'No pending requests found');
define('_LOBBY_GROUP_PENDING_ACCEPT',			'accept');
define('_LOBBY_GROUP_PENDING_DENY',				'reject');
define('_LOBBY_GROUP_PENDING_ACCEPT_ERROR',		'Adding member to group failed');


// group // article
define('_LOBBY_NEWS_ADDARTICLE',				'Write or modify article');
define('_LOBBY_NEWS_EXPLANATION',				'You can write new articles here and set permissions individually for each article');
define('_LOBBY_NEWS_TITLE',						'Title of article');
define('_LOBBY_NEWS_TEXT',						'Article body');
define('_LOBBY_NEWS_STORE_UPDATE',				'Article was stored / updated');
define('_LOBBY_NEWS_PUBLIC_STATUS',				'Set visibility level for article');
define('_LOBBY_ALL',							'All user including guests should be able to read this article');
define('_LOBBY_GROUPMEMBERS',					'Only members of this group should be able to read this article');
define('_LOBBY_SITEMEMBERS',					'Members and registered users of this website should have access');
define('_LOBBY_NEWS_DELETE_ARTICLE',			'Delete the article');
define('_LOBBY_NEWS_DATE',						'Date and time of article');
define('_LOBBY_NEWS_DATE_EXPLANATION',			'if you specify a future date the article will automatically be displayed after the specified timestamp');
define('_LOBBY_NEWS_PREVIEW_ARTICLE',			'Preview mode - just preview, no storing');
define('_LOBBY_NEWS_ARTICLEPREVIEW',			'The article was not stored yet. To quit preview mode, remove the checkbox at "'._LOBBY_NEWS_PREVIEW_ARTICLE.'" please!');
define('_LOBBY_FORUM_PREVIEW',					'This is a preview. To quit preview mode remove the checkbox "'._LOBBY_NEWS_PREVIEW_ARTICLE.'" please.');
define('_LOBBY_NEWS_PREVIEW',					'Create article preview');
define('_LOBBY_NEWS_WRITTENBY',					'Author');
define('_LOBBY_NEWS_CREATED',					'Article created');
define('_LOBBY_NEWS_CREATIONERROR',				'Creating article failed');
define('_LOBBY_NEWS_EDIT',						'Edit article');
define('_LOBBY_ARTICLE_PREVIEW',				'Article preview');
define('_LOBBY_NEWS_UPDATED',					'Article was updated');
define('_LOBBY_NEWS_UPDATEERROR',				'Updating article failed!');
define('_LOBBY_NEWS_DELETED',					'Article deleted');

//group // news
define('_LOBBY_NEWS_PUBLICSTATUS_TEXT',			'If you are not a member of this group not all news and topics might be displayed for you. Get a member of the group to access all information!');
define('_LOBBY_NEWS_INFUTURE',					'This article timestamp is in future. This Article can only be read by group admin');
define('_LOBBY_NEWS_NOAUTH_NOCONTENT',			'The chosen article does not exist or you are not allowed to view the article');
define('_LOBBY_NEWS_SEND_TO_GROUP',				'Send article via email to all group members');
define('_LOBBY_ARTICLE_SENT_TO_GROUP',			'Article was sent to all group members');
define('_LOBBY_ARTICLE_SENT_ERROR',				'Article could not be sent - sending was cancelled');
define('_LOBBY_GROUP_NEWS_FROM',				'News of group');
define('_LOBBY_NEWS_MAIL_FOOTER',				'This mail has been sent by the creator of the group. Please contact the group creator if there are any questions.');
define('_LOBBY_DEAR',							'Dear user');
define('_LOBBY_GROUP_NEWS_RELEASED',			'you are a member of a group whoose group creator has written a news article and sent this article to all members!');
define('_LOBBY_GROUP_LINK',						'Link to group');
define('_TRACKING_ARTICLE_SENT_ALREADY',		'An article can not be mailed twice!');

// group // membermanagement
define('_LOBBY_MEMBER_MANAGEMENT',				'Member management');
define('_LOBBY_MEMBER_MANAGEMENT_EXPLANATION',	'You can manage members and their permisisons here.');
define('_LOBBY_MEMBER_MANAGEMENT_HOWTO',		'Please choose a member you want to modify fist. After doing this you will be able to modify the chosen member.');
define('_LOBBY_MEMBER_MANAGEMENT_SELECTUSER',	'Choose member of group');
define('_LOBBY_MEMBER_MANAGEMENT_LOAD',			'load user data');
define('_LOBBY_GROUP_REJECT_MEMBER_FAILURE',	'Parameters wrong for rejecting a group membership');
define('_LOBBY_GROUP_DELETE_MEMBER_FAILURE',	'Deleting membership failed');
define('_LOBBY_USER_NOT_A_MEMBER',				'The person is not a member of the group');
define('_LOBBY_USER_IS_OWNER',					'The person is creator of the group');
define('_LOBBY_USER_DELETED',					'User has been deleted from the group');

// group // membermanagement // modify
define('_LOBBY_MEMBER_MANAGEMENT_GETERROR',		'User data could not be loaded');
define('_LOBBY_MEMBER_MANAGEMENT_SELECTEDUSER',	'Chosen user');
define('_LOBBY_MEMBER_MANAGEMENT_USER',			'User data');
define('_LOBBY_MEMBER_MANAGEMENT_DELETE',		'Remove the membership of the user');
define('_LOBBY_MEMBER_MANAGEMENT_APPLY',		'Apply changes');
define('_LOBBY_MEMBER_MANAGEMENT_MODERATOR',	'User is moderator');
define('_LOBBY_MEMBER_MANAGEMENT_NOCHANGE',		'No changes were made');
define('_LOBBY_MEMBER_MANAGEMENT_BACKLINK',		'Back to member management page');
define('_LOBBY_MEMBERSHIP_REQUEST_REJECTED',	'Request was rejected');
define('_LOBBY_MEMBERSHIP_REJECT_ERROR',		'Rejecting request failed');

// group // modifyindex
define('_LOBBY_INDEXPAGE_CREATED',				'Home page was stored');
define('_LOBBY_INDEXPAGE_CREATIONERROR',		'Storing home page failed');
define('_LOBBY_INDEXPAGE_ARTICLEPREVIEW',		'The page was not stored yet because you are in preview mode. Please remove checkbox at "'._LOBBY_NEWS_PREVIEW_ARTICLE.'" to quit preview mode!');
define('_LOBBY_INDEXPAGE_PREVIEW',				'Preview');
define('_LOBBY_INDEXPAGE_EXPLANATION',			'You can store a little information page to display important information for your group and for new members.');
define('_LOBBY_INDEXPAGE_STORE_UPDATE',			'Store / update');
define('_LOBBY_INDEXPAGE_TEXT',					'Content that should be added above the group index page');

// group // forummanagement
define('_LOBBY_FORUM_MANAGEMENT',				'Manage forums');
define('_LOBBY_FORUM_MANAGEMENT_EXPLANATION',	'You can manage the forums and forum permissions here. You can change the settings later, too');
define('_LOBBY_FORUM_ADD_NEW_FORUM',			'Add new forum');
define('_LOBBY_FORUM_EXISTING_FORUMS',			'Existing forums');
define('_LOBBY_FORUM_TITLE',					'Forum title');
define('_LOBBY_FORUM_DESCRIPTION',				'Description');
define('_LOBBY_FORUM_PUBLIC_STATUS',			'Content should be visible for');
define('_LOBBY_FORUM_STORE_UPDATE',				'udpate / store');
define('_LOBBY_FORUM_CREATED',					'Forum "%forum%" was added');
define('_LOBBY_FORUM_SYNC_HINT',				'Please use sync function if topics or postings are not displayed the way they should be displayed or if the facts section displays wrong information.');
define('_LOBBY_FORUM_CREATION_ERROR',			'Adding forum failed');
define('_LOBBY_FORUM_NOFORUMS',					'No forum added yet');
define('_LOBBY_FORUM_UPDATED',					'Settings updated');
define('_LOBBY_FORUM_UPDATE_ERROR',				'Updating forum settings failed');
define('_LOBBY_FORUM_DELETED',					'Forum was deleted');
define('_LOBBY_FORUM_DELETE_ERROR',				'Deleting forum failed');
define('_LOBBY_FORUM_DELETE',					'Delete forum, topics and postings');
define('_LOBBY_FORUM_WRITABLE_HINT',			'Remember that forums that are public can also be used by other users than the group members.');
define('_LOBBY_FORUM_CLICK_TO_EDIT',			'To modify a forum click the edit link in the forum line. ');
define('_LOBBY_SYNC_FORUM',						'sync');
define('_LOBBY_TOPICS_SYNCED_IN',				'Topics synced in');
define('_LOBBY_FORUM_PERMISSIONS',				'Permissions');
define('_LOBBY_FORUM_POS',						'Position');
define('_LOBBY_MOVE_UP',						'Move up');
define('_LOBBY_MOVE_DOWN',						'Move down');
define('_LOBBY_FORUM_ACTION',					'Action');
define('_LOBBY_STATUS_PUBLIC',					'Guests: read, Users: write, Members: write');
define('_LOBBY_STATUS_MEMBERS',					'Guests: none, Users: write, Members: write');
define('_LOBBY_STATUS_PRIVATE',					'Guests: none, Users: none, Members: write');

// forumtopics api
define('_LOBBY_TOPICSAPI_ADD_PARAMERROR',		'Wrong parameters for topic add api function');
define('_LOBBY_TOPIC_CREATION_ERROR',			'Topic creation error');

// moderators api
define('_LOBBY_GROUP_GETMODERATORS_PARAMFAILURE','Wrong parameter for get moderators function');
define('_LOBBY_GROUP_ADDMODERATOR_FAILURE',		'Wrong parameter for adding a new moderator');
define('_LOBBY_GROUP_MODERATORS_ACCESS_DENY',	'You have no permission to add or remove a moderator');
define('_LOBBY_GROUPS_MODERATORADDERRO',		'Adding moderator failed');
define('_LOBBY_GROUPS_MODERATORADDED',			'User "%user%" is now marked as moderator. Permissions have been granted');
define('_LOBBY_GROUPS_ALREADY_MOD',				'User is already moderator');
define('_LOBBY_GROUP_DELMODERATOR_FAILURE',		'Wrong parameter for delete moderator from group api function');
define('_LOBBY_GROUP_WAS_NO_MODERATOR',			'The user is no moderator and can not be deleted as moderator');
define('_LOBBY_GROUPS_MODERATORREMOVED',		'Moderator permissions removed from user');
define('_LOBBY_GROUPS_MODERATORDELERROR',		'Removing permissions failed');

// group // forum
define('_LOBBY_CFORUM_SUBSCRIBED',				'Subscription active');
define('_LOBBY_FORUM_INDEX',					'Forum overview');
define('_LOBBY_FORUM_PUBLICSTATUS_TEXT',		'Maybe not all information available here is displayed to you. If you are not a member of this group join the group to access all information');
define('_LOBBY_NEW_TOPIC',						'Create new topic');
define('_LOBBY_FORUM_NOPOSTS',					'No topic created yet or no permissions to access topics');
define('_LOBBY_FORUM_TOPIC_TITLE',				'Title');
define('_LOBBY_FORUM_TOPIC_LASTDATE',			'Date');
define('_LOBBY_FORUM_TOPIC_EXPLANATION',		'Start a new topic here. Please consider netiquette!');
define('_LOBBY_FORUM_TOPIC_REPLIES',			'Replies');
define('_LOBBY_NEW_REPLY',						'Write reply');
define('_LOBBY_FORUM_REPLY_EXPLANATION',		'You can add a reply here. Please use preview function before sending the reply and read the written reply before posting it!');
define('_LOBBY_FORUM_REPLY_PREFIX',				'Reply');
define('_LOBBY_REPLY_POSTED',					'Reply posted');
define('_LOBBY_FORUM_NO_POST_AUTH',				'Only group members can discuss here. Please join the group if you want to discuss here!');
define('_LOBBY_FORUM_STORE_REPLY',				'Store reply');
define('_LOBBY_NO_FORUM_SELECTED',				'No valid forum chosen');
define('_LOBBY_FORUM_NOT_SUBSCRIBED',			'no subscription');
define('_LOBBY_FORUM_SUBSCRIBED',				'subscription active');
define('_LOBBY_FORUM_SUBSCRIBE',				'subscribe');
define('_LOBBY_FORUM_SUBSCRIBED_NOW',			'Forum subscribed');
define('_LOBBY_FORUM_SUBSCRIBE_ERROR',			'Subscribing failed');
define('_LOBBY_FORUM_ALREADY_SUBSCRIBED',		'Subscription exists already');
define('_LOBBY_FORUM_UNSUBSCRIBE',				'Delete subscription');
define('_LOBBY_FORUM_UNSUBSCRIBED_NOW',			'Subscription deleted');
define('_LOBBY_FORUM_UNSUBSCRIBE_ERROR',		'Subscription deletion error for forum');
define('_LOBBY_TOPIC_SUBSCRIBED_NOW',			'Topic subscribed');
define('_LOBBY_TOPIC_SUBSCRIBE_ERROR',			'Topic subscription error');
define('_LOBBY_TOPIC_ALREADY_SUBSCRIBED',		'Topic subscribed already');
define('_LOBBY_TOPIC_UNSUBSCRIBED_NOW',			'Subscription deleted');
define('_LOBBY_TOPIC_UNSUBSCRIBE_ERROR',		'Deleting topic subscription failed');
define('_LOBBY_POSTING_TITLE',					'Topic title');
define('_LOBBY_FORUM_STORE',					'Store topic');
define('_LOBBY_FORUM_JUST_PREVIEW',				'Activate preview mode');
define('_LOBBY_POSTING_CONTENT',				'Content of posting');
define('_LOBBY_TOPIC_CREATED',					'Topic created');
define('_LOBBY_TOPIC_CREATION_ERROR',			'Topic creation error');
define('_LOBBY_FORUM_CONTAINS',					'Forum contains');
define('_LOBBY_TOPICS_AND',						'topics and');
define('_LOBBY_POSTS',							'postings');
define('_LOBBY_MODERATOR_ACTIONS',				'Moderator actions');
define('_LOBBY_TOPIC_DELETE',					'delete topic');
define('_LOBBY_TOPIC_CLOSE',					'close topic');
define('_LOBBY_TOPIC_REOPEN',					'reopen topic');
define('_LOBBY_TOPIC_MARK',						'mark topic');
define('_LOBBY_TOPIC_UNMARK',					'remove topic marker');
define('_LOBBY_TOPIC_MOVE',						'move topic');
define('_LOBBY_TOPIC_UPDATE_FAILED',			'updating topic failed');
define('_LOBBY_MODERATION_TOPIC_DELETED',		'Topic deleted');
define('_LOBBY_EDIT_NOTPOSSIBLE',				'You can not modify the posting now. Modifications are only possible until the first reply is posted. Only group moderators are able to apply changes later.');
define('_LOBBY_MODERATION_TOPIC_UNMARKED',		'Topic is not marked any more');
define('_LOBBY_MODERATION_TOPIC_MARKED',		'Topic marked');
define('_LOBBY_MODERATION_TOPIC_REOPENED',		'Topic reopened');
define('_LOBBY_MODERATION_TOPIC_CLOSED',		'Topic closed');
define('_LOBBY_FORUM_TOPIC_LOCKED',				'Topic was closed. No more replies are possible.');
define('_LOBBY_ILLEGAL_MODERATOR_ACTION',		'You are not a moderator... Go away!');
define('_LOBBY_MODERATOR_DELETE_POSTING',		'Delete this post');
define('_LOBBY_MODERATION_POSTING_DELETED',		'Post deleted');
define('_LOBBY_FORUM_INSTANT_ABO',				'Subscribe topic if there is no subscription yet');
define('_LOBBY_FORUM_POSTING_INFO',				'Information');
define('_LOBBY_FORUM_TOPICS_LAST_VISIT',		'Show topics since last visit');
define('_LOBBY_FORUM_POSTINGS_LAST_VISIT',		'Show postings since last visit');
define('_LOBBY_FORUM_LATEST_POSTING',			'Show latest posting');
define('_LOBBY_RESET_LAST_VISIT',				'reset');
define('_LOBBY_MODERATOR_EDIT_POSTING',			'Edit post');
define('_LOBBY_FORUM_EDIT_HINT',				'Postings can be added afterwards until the first reply has been stored. After this a post can only be modified by a group moderator');
define('_LOBBY_LAST_EDITED',					'Edited ');
define('_LOBBY_POST_MODIFIED',					'Posting was modified');
define('_LOBBY_MOVE_TOPIC_TO',					'Move topic to');
define('_LOBBY_MODERATION_HOTTOPIC',			'Hot discussed topic');
define('_LOBBY_POST_MODIFY_ERROR',				'Changing posting failed');
define('_LOBBY_TOPIC_MOVED',					'Topic moved');
define('_LOBBY_NO_EDIT_PERMISSION',				'No permission');
define('_LOBBY_LAST_REPLY',						'last reply');
define('_LOBBY_MARK_QUOTE',						'Please mark the text you want to cite and click the cite link to add the cite. You can add multiple cites to a posting.');
define('_LOBBY_MARK_QUOTE_DONE',				'The following text was added as a cite.');

//groups //help
define('_LOBBY_HELP_PAGE',						'Some explanations that might help you to use the groups');
define('_LOBBY_HELP_INTRODUCTION',				'You can find some help here for the daily group usage. If there are further questions, please contact the support of this website.');
define('_LOBBY_HELP_GENERAL',					'General information');
define('_LOBBY_HELP_GENERAL_TEXT',				'You can create own groups with this software. Groups will have their group title, a group description and you will be able to create an individual setup. You will be able to manage memberships, pending members and you can add some coordinates to your group to make it be displayed in an overview map.');
define('_LOBBY_HELP_MEMBERSHIP',				'Group memberships');
define('_LOBBY_HELP_MEMBERSHIP_TEXT',			'Everybody can join every group. But the group creator can decide if users should immediately become a member of if they have to pass a moderation process. In this case you are a new member of the group if the creator allows you to join the group.');
define('_LOBBY_HELP_GROUPRULES',				'Group rules');
define('_LOBBY_HELP_GROUPRULES_TEXT',			'Every group has to create their own rules. The responsible person for a group is the group creator.');
define('_LOBBY_HELP_FUNCTIONS',					'group functions');
define('_LOBBY_HELP_COORDS',					'Setup coordinate');
define('_LOBBY_HELP_COORDS_TEXT',				'If you want to be listed regionally add a coordinate to your group to integrate the group into a big map.');
define('_LOBBY_HELP_NEWS',						'Articles and news');
define('_LOBBY_HELP_NEWS_TEXT',					'Every group has its own news system. News can also be sent by email (newsletter) to all group members. The permissions for every article can be set individually.');
define('_LOBBY_HELP_FORUMS',					'Forums');
define('_LOBBY_HELP_FORUMS_TEXT',				'Setup your own forums with an individual permission management.');
define('_LOBBY_HELP_FORUMS_TEXT2',				'Topics and forums can be subscribed. Information emails will be sent to all subscribed users if there are new replies or topics.');
define('_LOBBY_HELP_FORUMS_TEXT3',				'To make it easy you can create defined forums in the group creation process.');
define('_LOBBY_HELP_MISC',						'Other');
define('_LOBBY_HELP_NAVIGATION_HINT',			'Please do not use the back and forward buttons of your webbrowser while you surf and use the groups. This might cause errors in some cases! Please navigate using the link structure.');

// forum legend
define('_LOBBY_FORUM_LEGEND',					'Legend');
define('_LOBBY_FORUM_HOT_TOPIC',				'Hot discussed topic');
define('_LOBBY_FORUM_TOPIC_MARKED',				'marked topic');
define('_LOBBY_FORUM_LAST_TOPIC_LINK',		    'Link to latest reply (red border = unread reply exists)');

// list
define('_LOBBY_SORT_CRITERIA',                  'resort');
define('_LOBBY_ALPHABETICAL',                   'alphabetical (A-Z)');
define('_LOBBY_LATEST',                         'Creation date (latest first)');
define('_LOBBY_COUNTEDMEMBERS',                 'Memberships');
define('_LOBBY_MAP',                            'show all groups in map');
define('_LOBBY_NO_CAT_FILTER',                  'show all categories');
define('_LOBBY_RELOAD',                         'reload');
define('',              '');
define('',              '');

