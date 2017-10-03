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
  
  $Rdid = $_GET['rdid'];

  If (isset($_POST["additionalCharges"])) {
    $additionalCharges =$_POST["additionalCharges"];
    $retHashSeq        = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
          
  } else {
    $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  }

  $hash = hash("sha512", $retHashSeq);
  if ($hash != $posted_hash) { 
    echo "Invalid Transaction. Please try again";
    
  }
  
  //} else { temporary
    echo "<h3>Thank You. Your order status is ". $status .".</h3>";
    echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
    //echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";

    	
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
	    <td><h4 align="center">  Your E-Ticket as on <?php echo date("Y/m/d");?> </h4><br><h4 align="center">PNR NO: <?php echo $FlightDetails['PNR']; ?></h4><br><h4 align="center">Bus: <?php echo 'Chennai' . "-" .  'Bangalore'; ?></h4><br></td>
	    
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
	<tr><td id=main>Invoice Date: <?php echo date("d/m/Y"); ?></td>
	<td>Invoice No: <?php echo "123456"; ?></td>
	</tr>
	<tr><td id=main>First name: <?php echo "Sai Krishna"; ?></td>
	<td>Last name: <?php echo "Boppana"; ?></td>
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
	<?php echo "Chennai"; ?>
	</td>
	<td>
	<?php echo "Bangalore"; ?>
	</td>
	<td>
	<?php echo "123456"; ?>
	</td>
	<td>
	<?php echo date("h:i:sa"); ?>	
	</td>
	<td>
	<?php echo date("h:i:sa"); ?>
	</td>
	<td>
	<?php echo "600"; ?>
	</td>
	</tr>
	
	</table>
	
	
	<table border="1" style="width:68%">
	  <tr>
	    <td> Please note:</td>
	 
	  </tr>
	  <tr>
	    <td> <h6> <?php echo "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."; ?> </h6> </td>
	    </tr>
		
	</table>
    	</div>
    	<input type='button' id='btn' value='Print' onclick='printDiv();'>


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