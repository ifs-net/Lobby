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
 * bbsmile plugin
 * shows all available smilies
 *
 *@params textfieldid
 */
function smarty_function_bbsmile($params, &$smarty)
{
    $out = "";
	if(pnModAvailable('bbsmile') && pnModIsHooked('bbsmile', 'lobby')) {
	    $out = pnModFunc('bbsmile', 'user', 'bbsmiles',
	                     array('textfieldid' => $params['textfieldid']));
	}
	return $out;
}
