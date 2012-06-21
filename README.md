#kohana-weibo

## Installation
git submodule git@github.com:JeremyWei/kohana-weibo.git modules/weibo
git submodule update --recursive

## Using Weibo
This module is a wrapper of weibo PHP SDK, and can supply full of the features,
just use it like original SDK.
这个module对微博的PHP SDK进行了包装，能提供所有的原始特性，就像使用原始的SDK那样来使用就可以了。

## Example
// Generate authorization url
$oauth = Weibo::factory('oauth');
$callback = 'http://example.com/callback';
$url = $oauth->getAuthorizeURL($callback);

// Authorization
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

// Call method
$client = Weibo::factory('client', $access_token);
$user_info = $client->show_user_by_id($uid); // invoke method defined in class SaeTClientV2

