<?php
require 'security.php';
require 'core.php';


	$nonce=time();
	$timestamp=time();
		
	$oauth = array(
			'oauth_callback' => 'https://stuiis.cms.gre.ac.uk/sc1984h/emotigre/user_home_timeline_formatted.php',
			'oauth_consumer_key' => $consumer_key,
			'oauth_nonce' => $nonce,
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_timestamp' => $timestamp,
			'oauth_version' => '1.0');
	
	
	$baseURI='https://api.twitter.com/oauth/request_token';
	
	$baseString = buildBaseString($baseURI, $oauth);
	$composite_key=getCompositeKey($consumer_secret,null);
	$oauth_signature=base64_encode(hash_hmac('sha1',$baseString,$composite_key,true));	
	$oauth['oauth_signature'] = $oauth_signature;


	$response=sendRequest($oauth, $baseURI);

	if($response!=null && !empty($response)){
		parse_str($response, $responseArrray);
        if(empty($responseArrray['oauth_token'])){
            die ('<h1>Wrong token received from Twitter:</h1>'.$response);
        }
		$oauth_token=$responseArrray['oauth_token'];
		$oauth_token_secret=$responseArrray['oauth_token_secret'];
		$user_screen_name=$responseArray['screen_name'];

		$authUrl='https://api.twitter.com/oauth/authorize?oauth_token='.$oauth_token;
		Redirect($authUrl);
	}
	else{
		echo '<h1>Wrong response received from Twitter</h1>';
		echo 'Response: '.$response."<br />";
	}


?>