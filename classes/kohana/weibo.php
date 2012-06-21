<?php defined('SYSPATH') or die('No direct script access.');
/**
 * SINA Weibo PHP SDK for Kohana 3
 *
 *
 * @package    Weibo
 * @category   SDK
 * @author     Jeremy Wei
 * @copyright  (c) 2012 Jeremy Wei
 * @license    http://www.opensource.org/licenses/mit-license.php
 */
class Kohana_Weibo {

	/**
	 * SaeTOAuthV2 instance
	 *
	 * @var SaeTOAuthV2
	 **/
	static public $oauth;

	/**
	 * SaeTClientV2 instance 
	 *
	 * @var SaeTClientV2
	 **/
	static public $client;

	/**
	 * Factory
	 * 
	 * @param $type string ['oauth' or 'client'] 
	 * @return mixed
	 **/
	public static function factory($type='oauth', $access_token='')
	{
		// load class from vendor
		if (!class_exists('SaeTOAuthV2') || !class_exists('SaeTClientV2'))
		{
			require Kohana::find_file('vendor', 'saetv2.ex.class');	
		}
		
		switch ($type) {

			case 'oauth':

				if (!self::$oauth)
				{
					self::$oauth = new SaeTOAuthV2(Kohana::$config->load('weibo.app_key'), 
						Kohana::$config->load('weibo.app_secret'));
				}

				return self::$oauth;
				break;
			
			case 'client':

				if (!self::$client)
				{
					self::$client = new SaeTClientV2(Kohana::$config->load('weibo.app_key'), 
						Kohana::$config->load('weibo.app_secret'), $access_token);
				}

				return self::$client;
				break;
				
			default:
				break;
		}
	}
}
