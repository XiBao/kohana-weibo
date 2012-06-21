<?php defined('SYSPATH') or die('No direct script access.');
/**
 * SINA Weibo PHP SDK for Kohana 3
 *
 *
 * @package    Weibo
 * @category   SDK
 * @author     Jeremy Wei
 * @copyright  (c) 2012 Jeremy Wei
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Weibo {

	/**
	 * OAuth 
	 *
	 * @var SaeTOAuthV2
	 **/
	protected $sae_oauth;

	/**
	 * OAuth client
	 *
	 * @var SaeTClientV2
	 **/
	protected $sae_client;

	/**
	 * App key
	 *
	 * @var string
	 **/
	protected $app_key;

	/**
	 * App secret
	 *
	 * @var string
	 **/
	protected $app_secret;

	/**
	 * Access token
	 *
	 * @var string
	 **/
	protected $access_token;

	/**
	 * return instance of SaeTOAuthV2
	 *
	 * @return SaeTOAuthV2
	 **/
	public function get_oauth()
	{
		// Create SaeTOAuthV2 instance
		$this->sae_oauth = new SaeTOAuthV2($this->app_key, $this->app_secret);

		return $this->sae_oauth;
	}

	/**
	 * return instance of SaeTClientV2
	 *
	 * @return SaeTClientV2
	 **/
	public function get_client($access_token)
	{
		if (!$access_token)
		{
			throw new Exception("access_token is missing");
		}
		else
		{
			$this->access_token = $access_token;
		}

		//
		$this->sae_client = new SaeTClientV2($this->app_key, $this->app_secret, $this->access_token);

		return $this->sae_client;
	}

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct($app_key=NULL, $app_secret=NULL)
	{
		// load class from vendor
		require Kohana::find_file('vendor', 'saetv2.ex.class');

		// If app_key empty then load it from kohana config
		if (!$app_key)
		{
			$this->app_key = Kohana::$config->load('weibo.app_key');
		}
		else
		{
			$this->app_key = $app_key;
		}

		// If app_secret empty then load it from kohana config
		if (!$app_secret)
		{
			$this->app_secret = Kohana::$config->load('weibo.app_secret');
		}
		else
		{
			$this->app_secret = $app_secret;
		}
	}
}
