<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

$modversion['name']           = 'lobby';
// the version string must not exceed 10 characters!
$modversion['version']        = '1.2';
$modversion['description']    = 'social network interaction platform';
$modversion['displayname']    = 'lobby';

// The following in formation is used by the credits module
// to display the correct credits
$modversion['changelog']      = 'docs/changelog.txt';
$modversion['credits']        = 'docs/credits.txt';
$modversion['help']           = 'docs/help.txt';
$modversion['license']        = 'docs/license.txt';
$modversion['official']       = 0;
$modversion['author']         = 'Florian Schiessl';
$modversion['contact']        = 'http://www.ifs-net.de/';

// The following information tells the PostNuke core that this
// module has an admin option.
$modversion['admin']          = 1;

// module dependencies
$modversion['dependencies'] = array(
	array(	'modname'    => 'EZComments',
			'minversion' => '1.6', 'maxversion' => '',
            'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
	array(	'modname'    => 'ContactList',
			'minversion' => '1.1', 'maxversion' => '',
            'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
	array(	'modname'    => 'MyProfile',
			'minversion' => '1.2', 'maxversion' => '',
            'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
	array(  'modname'    => 'UserPictures',
	        'minversion' => '1.1', 'maxversion' => '',
	        'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
	array(  'modname'    => 'InterCom',
	        'minversion' => '2.1', 'maxversion' => '',
	        'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
	array(  'modname'    => 'scribite',
	        'minversion' => '2.0', 'maxversion' => '',
	        'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
	array(  'modname'    => 'Invitation',
	        'minversion' => '1.0', 'maxversion' => '',
	        'status'     => PNMODULE_DEPENDENCY_RECOMMENDED),
    array(	'modname'    => 'MyMap',
            'minversion' => '1.3', 'maxversion' => '',
            'status'     => PNMODULE_DEPENDENCY_RECOMMENDED)
	);

// This one adds the info to the DB, so that users can click on the 
// headings in the permission module
$modversion['securityschema'] = array();
