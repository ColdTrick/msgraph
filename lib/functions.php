<?php
/**
 * All helper functions are bundled here
 *
 */

/**
 * Get the OAuth provider
 *
 * @return false|\League\OAuth2\Client\Provider\GenericProvider
 */
function msgraph_get_oauth_provider() {
	static $provider;
	
	if (isset($provider)) {
		return $provider;
	}
	
	$provider = false;
	
	$client_id = elgg_get_plugin_setting('client_id', 'msgraph');
	$client_secret = elgg_get_plugin_setting('client_secret', 'msgraph');
	$tenant_id = elgg_get_plugin_setting('tenant_id', 'msgraph', 'common');
	
	if (empty($client_id) || empty($client_secret)) {
		return false;
	}
	
	$provider = new \League\OAuth2\Client\Provider\GenericProvider([
		'clientId' => $client_id,
		'clientSecret' => $client_secret,
		'redirectUri' => elgg_normalize_url('msgraph/authorize'),
		'urlAuthorize' => "https://login.microsoftonline.com/{$tenant_id}/oauth2/authorize",
		'urlAccessToken' => "https://login.microsoftonline.com/{$tenant_id}/oauth2/token",
		'urlResourceOwnerDetails' => '',
	 	'scope' => 'User.Read',
		'verify'=> false,
	]);
	
	return $provider;
}
