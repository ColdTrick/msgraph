<?php
/**
 * Main plugin file
 */

@include_once(__DIR__ . '/vendor/autoload.php');

// register default Elgg events
elgg_register_event_handler('init', 'system', 'msgraph_init');

/**
 * Called during system init
 *
 * @return void
 */
function msgraph_init() {
	
}
