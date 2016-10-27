<?php

/* @var $plugin ElggPlugin */
$plugin = elgg_extract('entity', $vars);

$user = elgg_get_page_owner_entity();
if (!($user instanceof ElggUser)) {
	return;
}

if (!$user->canEdit()) {
	return;
}

// $plugin->unsetUserSetting('access_token', $user->getGUID());

$token = $plugin->getUserSetting('access_token', $user->getGUID());
if (!empty($token)) {
	/* @var $token \League\OAuth2\Client\Token\AccessToken */
	$token = unserialize($token);
	
	if ($token->hasExpired()) {
		echo 'Token has expired';
	} else {
		$provider = msgraph_get_oauth_provider();
		
		try {
			/* @var $client \GuzzleHttp\Client */
			$client = $provider->getHttpClient();
			$headers = $provider->getHeaders($token);
			
			$headers['Content-Type'] = 'application/json';
	
			$r = $client->get('https://graph.microsoft.com/v1.0/me', [
				 'headers' => $headers,
			]);
			
			$stream = $r->getBody();
			$json = $stream->getContents();
			$json = json_decode($json, true);
			
			$body = '';
			
			foreach ($json as $key => $value) {
				$body .= elgg_format_element('label', [], $key);
				$body .= ' => ';
				if (is_array($value)) {
					$body .= implode(', ', $value);
				} else {
					$body .= $value;
				}
				
				$body .= '<br />';
			}
			
			echo elgg_view_module('info', elgg_echo('msgraph:usersettings:data'), $body);
			
		} catch (Exception $e) {
			echo $e->getCode();
			echo $e->getMessage();
		}
	}
} else {
	echo elgg_view('output/url', [
		'text' => elgg_echo('msgraph:usersettings:authorize'),
		'href' => "msgraph/authorize?forward_url=settings/plugins/{$user->username}/msgraph",
	]);
	echo '<br />';
	echo '<br />';
}
