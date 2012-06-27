# kohana-weibo

This module is a wrapper of weibo [PHP SDK](http://code.google.com/p/libweibo/), 
and can supply full features, just use it like original SDK.

这个module对微博的PHP SDK进行了包装，能提供所有的原始特性，就像使用原始的SDK那样来使用就可以了。

## Installation
	
	git submodule git@github.com:JeremyWei/kohana-weibo.git modules/weibo
	git submodule update --recursive

## Using Weibo

Enable:

	Kohana::modules(array(
		 //'auth'       => MODPATH.'auth',       // Basic authentication
		 'cache'      => MODPATH.'cache',      // Caching with multiple backends
		 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
		 'database'   => MODPATH.'database',   // Database access
		// 'image'      => MODPATH.'image',      // Image manipulation
		// 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
		 'unittest'   => MODPATH.'unittest',   // Unit testing
		// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
		 'weibo'   => MODPATH.'weibo',           // Weibo SDK
		));
Config:
create file application/config/weibo.php:

	<?php defined('SYSPATH') or die('No direct script access.');
	return array(
		'app_key'    => 'your app key',
		'app_secret' => 'your app secret',
		'callback'   => 'http://example.com/callback',
	);

Generate authorization url:

	$oauth = Weibo::factory('oauth');
	$callback = 'http://example.com/callback';
	$url = $oauth->getAuthorizeURL($callback);

Authorization:

	$post = $this->request->post();
	if (isset($post['code'])) {
		$keys = array();
		$keys['code'] = $post['code'];
		$keys['redirect_uri'] = $callback;
		try {
			$token = $oauth->getAccessToken('code', $keys);
		} catch (OAuthException $e) {
		}
	}

Call method:

	$client = Weibo::factory('client', $access_token);
	$user_info = $client->show_user_by_id($uid); // invoke method defined in class SaeTClientV2

