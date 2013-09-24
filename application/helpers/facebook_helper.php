<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'facebook/src/facebook.php';

function fb_get_login_url() {
	$pageId =  '290565884375303';
	$appId = '304434692907683';
	$secret = '84a7a57800a59f11e336f877826ed100';

	$facebook = new Facebook(array( 'appId'  => $appId, 'secret' => $secret));
	$params = array( 'scope' => 'email, user_activities, user_location', 'redirect_uri' => base_url().'index.php/mod_login/login_with_facebook');
	return $facebook->getLoginUrl($params);
}

function fb_get_user_data() {
	$pageId =  '290565884375303';
	$appId = '304434692907683';
	$secret = '84a7a57800a59f11e336f877826ed100';

	$facebook = new Facebook(array( 'appId'  => $appId, 'secret' => $secret));
	$user_id = $facebook->getUser();

	if ($user_id) {
		try {
			return  $facebook->api('/me');
		} catch (FacebookApiException $e) {
			error_log($e);
			return "";
		}
			
	} else {
		return "";
	}
}

function fb_posting_img($imgUrl, $title, $desc, $type = "POST_IMG") {
	// Facebook Config
	$pageId =  '290565884375303';
	$appId = '304434692907683';
	$secret = '84a7a57800a59f11e336f877826ed100';

	$facebook = new Facebook(array( 'appId'  => $appId, 'secret' => $secret));
	$user_id = $facebook->getUser();

	if($user_id) {
		$accounts = $facebook->api('/me/accounts', 'GET');
		// Set Administrator
		foreach($accounts['data'] as $account) {
			if($account['id'] == $pageId) {
				$token = $account['access_token'];
			}
		}

		// Data
		if ($type == "POST_IMG") {
			if (file_exists($imgUrl)) {
				$attachment = array('access_token' => $token,
							    'message' => $desc,
								'url' => $imgUrl,
							    'name' => $title );
				// Posting data
				try {
					$photo = $facebook->api('/'.$pageId.'/photos', 'POST', $attachment);
					return '{"notif":"ss_post"}';
				} catch (Exception $e){
					return '{"notif":"err_post_","message":"'.$e->getMessage().'"}';
				}
			} else {
				$attachment = array('access_token' => $token,
								'name' => $title,
								'message' => $desc );
				// Posting data
				try {
					$res = $facebook->api('/'.$pageId.'/feed','POST',$attachment);
					return '{"notif":"ss_post"}';
				} catch (Exception $e){
					return '{"notif":"err_post","message":"'.$e->getMessage().'"}';
				}
			}
		} else {
			$attachment = array('access_token' => $token,
								'name' => $title,
								'message' => $desc );
			// Posting data
			try {
				$res = $facebook->api('/'.$pageId.'/feed','POST',$attachment);
				return '{"notif":"ss_post"}';
			} catch (Exception $e){
				return '{"notif":"err_post","message":"'.$e->getMessage().'"}';
			}
		}
	} else {
		$login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream' ) );
		redirect($login_url);
		return '{"notif":"not_logged"}';
	}
}



