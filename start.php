<?php
/**
 * Main plugin file
 */

require_once(__DIR__ . '/lib/functions.php');
@include_once(__DIR__ . '/vendor/autoload.php');

// register default Elgg events
elgg_register_event_handler('init', 'system', 'msgraph_init');

/**
 * Called during system init
 *
 * @return void
 */
function msgraph_init() {
	
	// register page handelr
	elgg_register_page_handler('msgraph', '\ColdTrick\MsGraph\PageHandler::msgraph');
}
