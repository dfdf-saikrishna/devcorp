<?php
  global $wpdb;
  $status      =$_POST["status"];
  $firstname   =$_POST["firstname"];
  $amount      =$_POST["amount"];
  $txnid       =$_POST["txnid"];
  $posted_hash =$_POST["hash"];
  $key         =$_POST["key"];
  $productinfo =$_POST["productinfo"];
  $email       =$_POST["email"];
  $salt        ="eCwWELxi";
  
  $Tid = $_GET['Tid'];

  If (isset($_POST["additionalCharges"])) {
    $additionalCharges =$_POST["additionalCharges"];
    $retHashSeq        = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
          
  } else {
    $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  }

  $hash = hash("sha512", $retHashSeq);
  if ($hash != $posted_hash) { 
    echo "Invalid Transaction. Please try again";
    $ticket_data = array(
        'BookingId' => $FlightDetails['BookingId'],
        'PNR' => $FlightDetails['PNR'],
        'Status' => "2",
        );
    	$tablename = "flight_transaction";
    	$wpdb->update($tablename, $ticket_data, array('B_Id' => $Tid));
    	echo "Your ticket not Bookied, Please Try Again";
    	die;
  }

  //} else { temporary
    echo "<h3>Thank You. Your order status is ". $status .".</h3>";
    echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
    //echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";

    $transaction_details = $wpdb->get_row("SELECT * FROM flight_transaction WHERE B_Id = $Tid");
    
    //print_r($transaction_details);
    
    	$TraceId = $transaction_details->TraceId;
        $ResultIndex = $transaction_details->ResultIndex;
        $TokenId = $transaction_details->TokenId;
        $Title = $transaction_details->Title;
        $FirstName = $transaction_details->FirstName;
        $LastName = $transaction_details->LastName;
        $PaxType = $transaction_details->PaxType;
        $DateOfBirth = date("Y-m-d H:i:s", strtotime($transaction_details->DateOfBirth));
        $Gender = $transaction_details->Gender;
        $PassportNo = $transaction_details->PassportNo;
        $PassportExpiry = date("Y-m-d H:i:s", strtotime($transaction_details->PassportExpiry));
        $AddressLine1 = $transaction_details->AddressLine1;
        $AddressLine2 = $transaction_details->AddressLine2;
        $City = $transaction_details->City;
        $CountryCode = $transaction_details->CountryCode;
        $CountryName = $transaction_details->CountryName;
        $ContactNo = $transaction_details->ContactNo;
        $Email = $transaction_details->Email;
        $FFAirline = $transaction_details->FFAirline;
        $FFNumber = $transaction_details->FFNumber;
        $BaseFare = $transaction_details->BaseFare;
        $Tax = $transaction_details->Tax;
        $TransactionFee = $transaction_details->TransactionFee;
        $YQTax = $transaction_details->YQTax;
        $AdditionalTxnFeeOfrd = $transaction_details->AdditionalTxnFeeOfrd;
        $AdditionalTxnFeePub = $transaction_details->AdditionalTxnFeePub;
        $AirTransFee = $transaction_details->AirTransFee;
        $MCode = $transaction_details->MCode;
        $MDescription = $transaction_details->MDescription;
        $SCode = $transaction_details->SCode;
        $SDescription = $transaction_details->SDescription;
    	$Rdid = $transaction_details->Rdid;
    	
   	$burl = "http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Book/";
        $url = "http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Ticket/";
        $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $TokenId, "TraceId" => $TraceId, "ResultIndex" => $ResultIndex, "Passengers" => [ ["Title" => $Title, "FirstName" => $FirstName, "LastName" => "LastName", "PaxType" => $PaxType, "DateOfBirth" => $DateOfBirth, "Gender" => $Gender, "PassportNo" => $PassportNo, "PassportExpiry" => $PassportExpiry, "AddressLine1" => $AddressLine1, "AddressLine2" => $AddressLine2, "City" => $City, "CountryCode" => $CountryCode, "CountryName" => $CountryName, "ContactNo" => $ContactNo, "Email" => $Email, "IsLeadPax" => "true", "FFAirline" => $FFAirline, "FFNumber" => $FFNumber, "Fare" => [ ["BaseFare" => $BaseFare, "Tax" => $Tax, "TransactionFee" => $TransactionFee, "YQTax" => $YQTax, "AdditionalTxnFeeOfrd" => $AdditionalTxnFeeOfrd, "AdditionalTxnFeePub" => $AdditionalTxnFeePub, "AirTransFee" => $AirTransFee] ] ] ] ];
        $data = json_encode($data,true);
        //echo $data;die;
        $booking = httpPost($burl,$data);
        //print_r($booking);
        
        $booking = json_decode($booking,true);
        if($booking['Response']['Error']['ErrorCode']>0){
        	$response = httpPost($url,$data);
        	$resp = json_decode($response,true);
        }
        else{
        
	        $TraceId = $data['Response']['TraceId'];
	        $PNR = $data['Response']['Response']['PNR'];
	        $BookingId = $data['Response']['Response']['BookingId'];
	        $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $TokenId, "TraceId" => $TraceId, "PNR" => $PNR, "BookingId" => $BookingId ];
	    	$response = httpPost($url,$data);
	    	$resp = json_decode($response,true);
    	
    	}
    	if($resp['Response']['Error']['ErrorMessage']){
    	    echo "<h4>Error : </h4>" . $resp['Response']['Error']['ErrorMessage'] . "Your Payment Will be Refunded";
    	    $ticket_data = array(
            'Status' => "3",
            );
        	$tablename = "flight_transaction";
        	$wpdb->update($tablename, $ticket_data, array('B_Id' => $Tid));
    	}
    	else{
    	$data = json_decode($response,true);
    	//print "<pre>";print_r($data);print "</pre>";
    	$FlightDetails = $data['Response']['Response']['FlightItinerary'];
    	$PassengerDetails = $FlightDetails['Passenger'][0];
    	
    	$ticket_data = array(
        'BookingId' => $FlightDetails['BookingId'],
        'PNR' => $FlightDetails['PNR'],
        'Status' => "2",
        );
    	$tablename = "flight_transaction";
    	$wpdb->update($tablename, $ticket_data, array('B_Id' => $Tid));
    	
    	//update SelfBooking
    	$booking_data = array(
        'RD_Id' => $Rdid,
        'BS_Status' => "2",
        );
        $tablename = "booking_status";
        $wpdb->insert($tablename, $booking_data);
    	?>
    <div id='DivIdToPrint'>
    <table border="1" style="width:68%">
	  <tr>
	    <td><h4 align="center">  Your E-Ticket as on <?php echo date("Y/m/d");?> </h4><br><h4 align="center">PNR NO: <?php echo $FlightDetails['PNR']; ?></h4><br><h4 align="center">Flight: <?php echo $FlightDetails['Segments'][0]['Airline']['AirlineName'] . "-" .  $FlightDetails['Segments'][0]['Airline']['FlightNumber']; ?></h4><br></td>
	    
	  </tr>
	  <tr>
	    <td><p>
		<h5>
		To fly easy please present the E-Ticket with a valid photo identification at the airport and check-in counter. <br>
		The check-in counters are open 3 hours prior to departure and close strictly 2 hours prior to departure. </h5>
		</p></td>
	    
	  </tr>
	</table>





	<table border="1" style="width:68%">
	<tr><td id=main>Invoice Date: <?php echo $FlightDetails['InvoiceCreatedOn']; ?></td>
	<td>Invoice No: <?php echo $FlightDetails['InvoiceNo']; ?></td>
	</tr>
	<tr><td id=main>First name: <?php echo $PassengerDetails['FirstName']; ?></td>
	<td>Last name: <?php echo $PassengerDetails['LastName']; ?></td>
	</tr>
	
	<table>
	
	
	
	<table border="1" style="width:68%">
	<tr>
	<td>
	From
	</td>
	<td>
	To
	</td>
	<td>
	Ticket Number
	</td>
	<td>
	Dept time
	</td>
	<td>
	Arrival time
	</td>
	<td>
	Fare
	</td>
	</tr>
	<tr>
	<td>
	<?php echo $FlightDetails['Segments'][0]['Origin']['Airport']['AirportName']; ?>
	</td>
	<td>
	<?php echo $FlightDetails['Segments'][0]['Destination']['Airport']['AirportName']; ?>
	</td>
	<td>
	<?php echo $PassengerDetails['Ticket']['TicketNumber']; ?>
	</td>
	<td>
	<?php echo $FlightDetails['Segments'][0]['Origin']['DepTime']; ?>	
	</td>
	<td>
	<?php echo $FlightDetails['Segments'][0]['Destination']['ArrTime']; ?>
	</td>
	<td>
	<?php echo $PassengerDetails['Fare']['PublishedFare']; ?>
	</td>
	</tr>
	
	</table>
	
	
	<table border="1" style="width:68%">
	  <tr>
	    <td> Please note:</td>
	 
	  </tr>
	  <tr>
	    <td> <h6> <?php echo $FlightDetails['FareRules'][0]['FareRuleDetail']; ?> </h6> </td>
	    </tr>
		
	</table>
    	</div>
    	<input type='button' id='btn' value='Print' onclick='printDiv();'>
<?php    
    	
    	
    	
        
        
    
  }
  /*else{
  	$ticket_data = array(
        'Status' => "3",
        );
    	$tablename = "flight_transaction";
    	$wpdb->update($tablename, $ticket_data, array('B_Id' => $Tid));
  }*/
    
  //} temporary        
?>

<script>

function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

</script>	