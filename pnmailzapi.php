<?php

/*
 * get plugins with type / title
 *
 * @param   $args['id']     int     optional, show specific one or all otherwise
 * @return  array
 */
function lobby_mailzapi_getPlugins($args)
{
    // Load language definitions
    pnModLangLoad('lobby','mailz');
    
    $plugins = array();
    // Add first plugin.. You can add more using more arrays
    $plugins[] = array(
        'pluginid'      => 1,   // internal id for this module
        'title'         => _LOBBY_GROUP_NEWS_ALL,
        'description'   => _LOBBY_GROUP_NEWS_AL_TEXT,
        'module'        => 'lobby'
    );
    return $plugins;
}

/*
 * get content for plugins
 *
 * @param   $args['pluginid']       int         id number of plugin (internal id for this module, see getPlugins method)
 * @param   $args['params']         string      optional, show specific one or all otherwise
 * @param   $args['uid']            int         optional, user id for user specific content
 * @param   $args['contenttype']    string      h or t for html or text
 * @param   $args['last']           datetime    timtestamp of last newsletter
 * @return  array
 */
function lobby_mailzapi_getContent($args)
{
    // Load language definitions
    pnModLangLoad('lobby','mailz');
    switch ($args['pluginid']) {
        case 1:
            // All news from all groups ()
            $since = '2009-08-26';
            // Get params
            $cat = (int) $args['params']['category'];
            if ($cat > 0) {
                $catFilter = $cat;
            }
        	$allNews = pnModAPIFunc('lobby','news','get',array('since' => $since, 'catfilter' => $catFilter));
            if ($args['contenttype'] == 't') {
                // Text plugin
            	$output.="\n";
                foreach ($allNews as $news) {
                    $output.=$news['title']." (".$news['group_title']."):\n";
                    $output.=pnGetBaseURL().pnModURL('lobby','user','group',array('id' => $news['gid'], 'do' => "news", 'story' => $news['id']))."\n\n";
                }
            } else {
                // Html plugin
                $render = pnRender::getInstance('lobby');
                $render->assign('allNews', $allNews);
                $output = $render->fetch('lobby_mailz_allnews.htm');
            }
            return $output;
            break;
        default:
            return 'wrong plugin id given';
    }

    // return emtpy string because we do not need anything to display in here...    
    return '';
}

