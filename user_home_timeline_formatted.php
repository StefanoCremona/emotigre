<?php
require 'tmhOAuth.php';
require 'security.php';
require 'core.php';
require 'user.php';

echo "GET Request after Log-In via Twitter <br />";
$user_token = $_GET["oauth_token"];
$user_verifier = $_GET["oauth_verifier"];
$oauth_token=$_GET["oauth_token"];

if(!empty($user_verifier))
{
    $oauth_access=array(
				'oauth_consumer_key' => $consumer_key,
				//'oauth_nonce' => $nonce,
				//'oauth_nonce' => time(),
				//'oauth_signature'=>$oauth_signature,
				//'oauth_signature_method' => 'HMAC-SHA1',
				//'oauth_timestamp' => $timestamp,
				//'oauth_timestamp' => time(),
				'oauth_token'=>$user_token,
				'oauth_version' => '1.0',
				'oauth_verifier'=>$user_verifier
		);
    echo '$oauth_access: ';
    print_r($oauth_access);
    echo '</BR>';

		$access_token_url='https://api.twitter.com/oauth/access_token';
		$response=sendRequest($oauth_access, $access_token_url);
    echo 'Response: '.$response.'</BR>';

		parse_str($response,$responseArray);

		//GET variables
		$user_token=$responseArray['oauth_token'];
		$user_secret=$responseArray['oauth_token_secret'];
		$user_id=$responseArray['user_id'];
		$screen_name=$responseArray['screen_name'];
}


echo 'User Screen Name: '.$screen_name."<br />".'Consumer Key: '.$consumer_key."<br />".'Consumer Secret: '.$consumer_secret."<br />";
echo 'User Token: '.$user_token."<br />".'User Secret: '.$user_secret."<br /><br />";

//require 'userAlreadyRegistered.php';
$user = new User();
$user->getUserByScreenName($screen_name);

$connection = new tmhOAuth(array(
  'consumer_key'    => $consumer_key,
  'consumer_secret' => $consumer_secret,
  'user_token'      => $user_token,
  'user_secret'     => $user_secret
));



// Get my account's home timeline 
$connection->request('GET', $connection->url('1.1/statuses/home_timeline'), array(
  'screen_name' => $screen_name
));

echo "Retrieving Tweets...<br /><br />";

// Get the HTTP response code for the API request
$response_code = $connection->response['code'];


// Convert the JSON response into an array
$response_data = json_decode($connection->response['response'],true);

// A response code of 200 is a success
if ($response_code <> 200) {
  print "Error: $response_code\n";
}

// Display the response HTTP code
$code = $connection->response['code'];
print "<strong>Code:</strong> $code<br/>";

// Display only the text field of the first tweet
//print 'Hello '.$user->screenName.'!</br>';
print "<strong>Response of </strong><pre style='word-wrap: break-word'>".sizeof($response_data).' tweets!<b/r>';
print_r($response_data[0]['text']);
print "</pre><br/><br/>";
if (isset($user->id)) {
	print 'Hello '.$user->screenName.'!<br />Your username is already present in our database.<br />Please login with the username and password you have already provided us.<br/>';
	print '<a href="index.html">Home</a>';
} else {
	print 'Hello '.$screen_name.'!<br />You are required to provide a password for the following accesses.';
}

?>
