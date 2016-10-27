<?php
/**
 * Get an oauth authorization token
 */

elgg_gatekeeper();

$provider = msgraph_get_oauth_provider();
if (empty($provider)) {
	register_error(elgg_echo('msgraph:no_provider'));
	forward(REFERER);
}

$session = elgg_get_session();
$code = get_input('code');

if (empty($code)) {
	$forward = get_input('forward_url');
	
	if (!empty($forward)) {
		$session->set('msgraph_forward', $forward);
	}
	
	forward($provider->getAuthorizationUrl());
} else {
	
	try {
		$access_token = $provider->getAccessToken('authorization_code', [
			'code' => $code,
			'resource' => 'https://graph.microsoft.com',
		]);
	} catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
		register_error($e->getMessage());
		forward();
	}
	
	elgg_set_plugin_user_setting('access_token', serialize($access_token), 0, 'msgraph');
	system_message(elgg_echo('msgraph:authorize:saved'));
	
	$forward = $session->get('msgraph_forward');
	$session->remove('msgraph_forward');
	
	forward($forward);
}
