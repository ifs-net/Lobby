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
 * bbcode plugin
 * shows all available bbcode tags
 *
 *@params $params $images boolean if true then show images instead of text links
 *@params $params $textfieldid string id of the textfield to update
 */
function smarty_function_plainbbcode($params, &$smarty)
{
    extract($params);

    $out = "";
    if(isset($params['textfieldid']) && !empty($params['textfieldid'])) {
	    if(pnModAvailable('bbcode') && pnModIsHooked('bbcode', 'lobby')) {
	        $out = pnModFunc('bbcode', 'user', 'bbcodes', $params);
	    }
    }
	return $out;
}
