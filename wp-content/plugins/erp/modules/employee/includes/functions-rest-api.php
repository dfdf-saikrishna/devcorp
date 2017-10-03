<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function httpPost($url,$params)
{
    $ch = curl_init();
    //$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/errors/error_log.txt', 'a+');
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params ); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
    //curl_setopt($ch, CURLOPT_VERBOSE, 1);
    //curl_setopt($ch, CURLOPT_STDERR, $fp);
    if(curl_error($ch))
    {
    return 'error:' . curl_error($ch);
    }
    else{
    return $result=curl_exec ($ch); 
    }
    curl_close($curl);
}

function httpPostxml($url,$params)
{
    $curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 300000,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $params,
	  CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"content-type: text/xml",
		"postman-token: acb10835-f6d1-e6ef-bf78-65851d09ae70",
		"soapaction: http://tempuri.org/Hotel_Search"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  return "cURL Error #:" . $err;
	} else {
	  return $response;
	}
}

function mobileApi($uniqueorderid,$mobile,$operator,$amount){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://joloapi.com/api/recharge.php?mode=0&userid=estoor&key=174611741762437&operator=$operator&service=$mobile&amount=$amount&orderid=$uniqueorderid",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "",
	  CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: 0117256b-1c5f-6b7a-23da-6f77e5934f47"
	  ),
	));
	
	return $response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);

}

function httpGet($url){

$login = 'saikrishna.b@corptne.com';
$password = 'corptne@123';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
$result = curl_exec($ch);
curl_close($ch);  
return $result;


}

	
	include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthStore.php';

    	include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthRequester.php';
	$key = "6VNfowB27b07PELJw2YreYmRC35aDK"; 
	$secret = "cIFZX4vz6CKfJATvjpwhRKfdCSgH4U";

	$base_url = "http://api.seatseller.travel/";
	//$base_url = "http://46.137.192.242/";
	//$base_url = "http://beta.seatseller.travel:8080/";
	function invokeGetRequestbus($requestUrl)
	{
		global $key, $secret, $base_url,$source,$destination,$doj,$tripId,$boarding;
                $base_url = "http://api.seatseller.travel/";
                $key = "6VNfowB27b07PELJw2YreYmRC35aDK"; 
                $secret = "cIFZX4vz6CKfJATvjpwhRKfdCSgH4U";
		$url = $base_url.$requestUrl;
		$curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, 				CURLOPT_CONNECTTIMEOUT => 0);
		$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
		OAuthStore::instance("2Leg", $options);
		$method = "GET";
		$params = null;
		try
		{
			$request = new OAuthRequester($url, $method, $params);
			$result = $request->doRequest();
			$response = $result['body'];
			return $response;
		}
		catch(OAuthException2 $e)
		{
			echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			echo "generic exception".$e1."<hr></br>";
		}
	}
	