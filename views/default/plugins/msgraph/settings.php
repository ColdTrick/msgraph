<?php

/* @var $plugin \ElggPlugin */
$plugin = elgg_extract('entity', $vars);

echo elgg_view_input('text', [
	'label' => elgg_echo('msgraph:settings:tenant_id'),
	'help' => elgg_echo('msgraph:settings:tenant_id:help'),
	'name' => 'params[tenant_id]',
	'value' => $plugin->getSetting('tenant_id', 'common'),
]);

echo elgg_view_input('text', [
	'label' => elgg_echo('msgraph:settings:client_id'),
	'help' => elgg_echo('msgraph:settings:client_id:help'),
	'name' => 'params[client_id]',
	'value' => $plugin->client_id,
]);

echo elgg_view_input('text', [
	'label' => elgg_echo('msgraph:settings:client_secret'),
	'help' => elgg_echo('msgraph:settings:client_secret:help'),
	'name' => 'params[client_secret]',
	'value' => $plugin->client_secret,
]);

echo elgg_view_input('url', [
	'label' => elgg_echo('msgraph:settings:app_uri'),
	'help' => elgg_echo('msgraph:settings:app_uri:help'),
	'name' => 'params[app_uri]',
	'value' => $plugin->app_uri,
]);
