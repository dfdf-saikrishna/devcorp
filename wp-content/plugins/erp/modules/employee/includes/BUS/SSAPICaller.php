<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";

	$key = "6VNfowB27b07PELJw2YreYmRC35aDK"; 
	$secret = "cIFZX4vz6CKfJATvjpwhRKfdCSgH4U";

	$base_url = "http://api.seatseller.travel/";
	//$base_url = "http://46.137.192.242/";
	//$base_url = "http://beta.seatseller.travel:8080/";
	function invokeGetRequest($requestUrl)
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

	function invokePostRequest($requestUrl, $blockRequest)
	{		
		global $key, $secret, $base_url;
		$url = $base_url.$requestUrl;
		$curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, 				CURLOPT_CONNECTTIMEOUT => 0);
		$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
		OAuthStore::instance("2Leg", $options);
		$method = "POST";
		$params = null;
		try
		{
			$request = new OAuthRequester($url, $method, $params, $blockRequest);
			echo "Timeout is: ".$curl_options[CURLOPT_TIMEOUT]."<hr></br>";
			echo "Connection timeout is: ".$curl_options[CURLOPT_CONNECTTIMEOUT ]."<hr></br>";
			$result = $request->doRequest(0,$curl_options);
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

	function getAllSources()
	{
		return invokeGetRequest("sources");
	}
	
	function getAllDestinations($sourceId)
	{
		return invokeGetRequest("destinations?source=".$sourceId);
	}

	function getAvailableTrips($sourceId,$destinationId,$date)
	{
		return invokeGetRequest("availabletrips?source=".$sourceId. "&destination=" . $destinationId . "&doj=" . $date); 		
	}
	 

	function getBoardingPoint($boarding,$tripId)
	{
		return invokeGetRequest("boardingPoint?id=".$boarding. "&tripId=" .$tripId);
	}

	function getTripDetails($tripId)
	{
		return invokeGetRequest("tripdetails?id=".$tripId); 	
	}
	
	function blockTicket($blockRequest)
	{	
		/*foreach($blockRequest->inventoryItems as $inventory)
		{
			echo "</hr></br>Seat Name:".$inventory->name;
			echo "</hr></br>Fare:".$inventory->fare;
			echo "</hr></br>Gender:".$inventory->ladiesSeat."</hr></br>";
		}
		*/	return invokePostRequest("blockTicket",$blockRequest); 
	}

	function confirmTicket($blockKey)
	{
			return invokePostRequest("bookticket?blockKey=".$blockKey,"");
	} 
	function getTicket($ticketId)
	{
		
		return invokeGetRequest("ticket?tin=".$ticketId);
	}

	function getCancellationData($cancellationId)
	{
		return invokeGetRequest("cancellationdata?tin=".$cancellationId);
		echo " <hr>The ticket details are:".$cancellationId."<hr/>";
	}

	function cancelTicket($cancelRequest)
	{
		return invokePostRequest("cancelticket",$cancelRequest);
	}
?>

