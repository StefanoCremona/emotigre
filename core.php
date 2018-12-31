<?php

function get_nonce($length=12, $include_time=true) {
	if ($this->config['force_nonce'] == false) {
		$sequence = array_merge(range(0,9), range('A','Z'), range('a','z'));
		$length = $length > count($sequence) ? count($sequence) : $length;
		shuffle($sequence);

		$prefix = $include_time ? microtime() : '';
		return md5(substr($prefix . implode('', $sequence), 0, $length));
	}
}

function get_timestamp(){
	return time();
}

function buildBaseString($baseURI, $params){

	$r = array(); //temporary array
	ksort($params); //sort params alphabetically by keys
	foreach($params as $key=>$value){
		$r[] = "$key=" . rawurlencode($value); //create key=value strings
	}//end foreach

	return 'POST&' . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); 
}

function getCompositeKey($consumerSecret, $requestToken){
	return rawurlencode($consumerSecret) . '&' . rawurlencode($requestToken);
}


function buildAuthorizationHeader($oauth){
	$r = 'Authorization: OAuth '; //header prefix

	$values = array(); //temporary key=value array
	foreach($oauth as $key=>$value)
		$values[] = "$key=\"" . rawurlencode($value) . "\""; //encode key=value string

	$r .= implode(', ', $values); //reassemble
	return $r; //return full authorization header
}

/**
 * Method for sending a request to Twitter.
 * @param array $oauth the oauth array
 * @param string $baseURI the request URI
 * @return string the response from Twitter
 **/
function sendRequest($oauth, $baseURI){
	$header = array( buildAuthorizationHeader($oauth), 'Content-Length: 0', 'Expect:'); //create header array and add 'Expect:'

	$options = array(CURLOPT_HTTPHEADER => $header, //use our authorization and expect header
			CURLOPT_HEADER => false, //don't retrieve the header back from Twitter
			CURLOPT_URL => $baseURI, //the URI we're sending the request to
			CURLOPT_POST => true, //this is going to be a POST - required
			CURLOPT_RETURNTRANSFER => true, //return content as a string, don't echo out directly
			CURLOPT_CAINFO => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cacert.pem',
			CURLOPT_CAPATH => dirname(__FILE__),
			CURLOPT_SSL_VERIFYPEER => true); //don't verify SSL certificate, just do it

	$ch = curl_init(); //get a channel
	curl_setopt_array($ch, $options); //set options
	$response = curl_exec($ch); //make the call
	curl_close($ch); //hang up

	return $response;
}//end sendRequest()

function getResponseHeader($header) {
	foreach ($response as $key => $r) {
		if (stripos($r, $header) !== FALSE) {
			list($headername, $headervalue) = explode(":", $r, 2);
			return trim($headervalue);
		}
	}
}

function Redirect($url, $permanent = false)
{
	if (headers_sent() === false)
	{
		header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	}

	exit();
}
?>