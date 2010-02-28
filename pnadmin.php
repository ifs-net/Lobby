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
 * the main user function
 * 
 * @return       output       The main module page
 */
function lobby_admin_main()
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = pnRender::getInstance('lobby');
	
	// Get pending categories
	$pending = pnModAPIFunc('lobby','groups','get',array('pending' => 1));
	$render->assign('pending', $pending);

    // Return the output
    return $render->fetch('lobby_admin_main.htm');
}

/**
 * pending groups management
 * 
 * @return       output       The main module page
 */
function lobby_admin_pending()
{
    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = pnRender::getInstance('lobby');
	
	// Get Action
	$action = FormUtil::getPassedValue('action');
	$id = (int)FormUtil::getPassedValue('id');
	if (isset($action) && ($action == 'accept') && ($id > 0)) {
	  	$result = pnModAPIFunc('lobby','groups','accept',array('id' => $id));
	  	if ($result) {
			// send Mail
			Loader::includeOnce('modules/lobby/includes/common_email.php');
			lobby_notify_groupaccepted($id);
			LogUtil::registerStatus(_LOBBY_GROUP_ACCEPTED);
		} else {
			LogUtil::registerError(_LOBBY_GROUP_ACCEPTED_ERROR);
		}
		return pnRedirect(pnModURL('lobby','admin','pending'));
	}
	
	// Get pending categories
	$pending = pnModAPIFunc('lobby','groups','get',array('pending' => 1));
	$render->assign('pending', $pending);
	$authid = SecurityUtil::generateAuthKey();
	$render->assign('authid', $authid);

    // Return the output
    return $render->fetch('lobby_admin_pending.htm');
}

/**
 * the category management function
 * 
 * @return       output       The main module page
 */
function lobby_admin_categories()
{
  	// load handler class
	Loader::requireOnce('modules/lobby/includes/classes/admin/categories.php');

    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = FormUtil::newpnForm('lobby');

    // Return the output
    return $render->pnFormExecute('lobby_admin_categories.htm', new lobby_admin_categoriesHandler());
}

/**
 * the category management function
 * 
 * @return       output       The main module page
 */
function lobby_admin_settings()
{
  	// load handler class
	Loader::requireOnce('modules/lobby/includes/classes/admin/settings.php');

    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = FormUtil::newpnForm('lobby');

    // Return the output
    return $render->pnFormExecute('lobby_admin_settings.htm', new lobby_admin_settingsHandler());
}

/**
 * import groups, forums, etc.
 * 
 * @return       output       The main module page
 */
function lobby_admin_import()
{
  	// load handler class
	Loader::requireOnce('modules/lobby/includes/classes/admin/import.php');

    // Security check
    if (!SecurityUtil::checkPermission('lobby::', '::', ACCESS_ADMIN)) return LogUtil::registerPermissionError();

	// Create output and call handler class
	$render = FormUtil::newpnForm('lobby');

    // Return the output
    return $render->pnFormExecute('lobby_admin_import.htm', new lobby_admin_importHandler());
}
