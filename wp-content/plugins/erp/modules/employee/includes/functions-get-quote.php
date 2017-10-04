<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getBusSeatLayout($posted){
     global $wpdb;
     include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthStore.php';

     include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthRequester.php';

     include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/SSAPICaller.php';
     
     echo "<form method='GET' action='generateForm.php' name='form3' onSubmit=''>";
     
    $image_seater_vacant= WPERP_EMPLOYEE_ASSETS."/images/seats/ac_semi_sleeper_vacant.jpg";
    $image_seater_selected= WPERP_EMPLOYEE_ASSETS."/images/seats/ac_sleeper_selected.jpg";
    $image_seater_unavailable= WPERP_EMPLOYEE_ASSETS."/images/seats/ac_semi_sleeper_unavailable.jpg";
    $image_seater_ladies=WPERP_EMPLOYEE_ASSETS."/images/seats/non_ac_seater_ladies.jpg";
    $image_sleeper_vacant=WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_available.jpg";
    $image_sleeper_unavailable=WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_unavailable.jpg";
    $image_sleeper_ladies=WPERP_EMPLOYEE_ASSETS."/images/seats/non_sleeper_ac_ladies.jpg";
    $image_vertical_sleeper_vacant=WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_vertical_vacant.jpg";
    $image_vertical_sleeper_unavailable=WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_vertical_unavailable.jpg";
    $image_vertical_sleeper_ladies=WPERP_EMPLOYEE_ASSETS."/images/seats/non_ac_vertical_sleeper_ladies.jpg";

    $image_empty_row=WPERP_EMPLOYEE_ASSETS."/images/seats/no_seat.jpg";
    echo "<h3>SEAT LAYOUT</h3>";
   
    $flag=0;  // for flaging if sleeper or seater bus
    $flag2=0; //  for flaging if completely vertical sleepers
    $flagseatsleep1=0; // for seaters in lower
    $flagseatsleep2=0; // for upper sleepers
    
    $flaglsleep=0;  // flag if lower has sleepers
    $flaglseat=0;  // flag if lower has seats   
    $rowvalue=1;
    $y=0;
// Getting the chosen bus id.
//     if(isset($_GET['chosentwo']))
//    {
//
//      $chosenbusid=$_GET['chosentwo'];
//           //echo "The chosen bus id on second page ( after the filtering) is".$chosenbusid;
//
//    }
//   else
//    {$chosenbusid=$_GET['chosenone'];
//    // echo "The chosen bus id on main page is".$chosenbusid;
//    }
//    $sourceid = 
//    $destinationid =      
//    $date =
//    $chosenbusid = 
     $from = $posted['from'];
     $to = $posted['to'];
     //$expdate = $posted['expdate'];
     $expdate = date('Y-m-d', strtotime('+1 day'));

     if (!$from) $from = "Bangalore";
        else {
                
                $selfrom = $wpdb->get_row("SELECT Loc_Id FROM bus_locations WHERE Loc_Name='$from'");
                $source = $selfrom->Loc_Id;
        }

        if (!$to) $to = "Hyderabad";
        else {      
                $selTo = $wpdb->get_row("SELECT Loc_Id FROM bus_locations WHERE Loc_Name='$to'");
                $destid = $selTo->Loc_Id;
      }
      //echo $source . $destid . $expdate;
      $sourceid = $source;
      $destinationid = $destid;
      $date = $expdate;
      $chosenbusid = $posted['id'];

      $result1 =getAvailableTrips($sourceid,$destinationid,$date); 
      $tripdetails = getTripDetails($chosenbusid);     
      $tripdetails2 = json_decode($tripdetails);

        $seats = $tripdetails2->seats;


// foreach loop for the value variable
foreach ($tripdetails2 as $key => $value)
{
    if(is_array($value)) 
    {
        
        $s=array(array());
        $sleeper=array(array(array()));
        $seatsleep=array(array(array()));

        foreach ($value as $k => $v) 
        {
            foreach ($v as $k1 => $v1)//checking first for seater and sleeper bus
            {
                if(isset($v->zIndex)&&isset($v->length)&&isset($v->width))
                {
                    if ($v->zIndex==0) // checks lower berths
                    {
                        if (($v->length==2 && $v->width==1 )||($v->length==1 && $v->width==2 )) // both vertical and horizontal sleepers in Lower Berth
                        {
                            $flaglsleep=1;
                            $seatsleep[$v->zIndex][$v->row][$v->column]=$v;  
                        }
                        elseif ($v->length==1 && $v->width==1)
                        {
                            $flagseatsleep1=1; 
                            $flaglseat=1;
                            $seatsleep[$v->zIndex][$v->row][$v->column]=$v;
                        }
                    }

                    elseif ($v->zIndex==1) // only sleepers in  upper berths
                    {
                   
                        $seatsleep[$v->zIndex][$v->row][$v->column]=$v;
                        $flagseatsleep2=1;
                    }



                }

            }//ends foreach ($v as $k1 => $v1)


        }//ends foreach ($value as $k => $v)


        if (($flagseatsleep1==1)&&($flagseatsleep2==1)) // if it is a seater+sleeper
        {
            //echo "THIS IS SEATER+ SLEEPER";
            /*
            $seatsleep[0]  // this is seats/sleepers lower level;

            $seatsleep[1]   // these are sleepers upper level

            */

            $rowcountseater = count($seatsleep[0]);

            $max=0;
            $mini = array(); // holds the number of seats in every row
            for ($i=0; $i <=$rowcountseater ; $i++)
            { 
  
             if(isset($seatsleep[0][$i]))
                {
                $mini[$i]=count($seatsleep[0][$i]);
                }

            }

            $min=max($mini);

            $posi=array();
            $countter=0;

            for ($j=0; $j <=$rowcountseater ; $j++) // for finding the maximum number of seats in each row and using that as the limit in the for loop
            {
                $countter=0;
                $i=0;
                do
                { 
                    if(!empty($seatsleep[0][$j]))
                    {
                        if(empty($seatsleep[0][$j][$i]))
                        {

                            if (empty($seatsleep[0][$j][$i+1]))
                            {
    
                                if(isset($mini[$j]))
                                {
                                    if($countter==$mini[$j])        
                                    {

                                    $posi[$j]=$i; 
        
                                    break;
                                    }
                                }
                            }

                        }

                        else
                        { $countter++;
                        $pos=$i;
                        }
                    }

                    $i++;
                } 
                    while (($i<$min*2));
           

            }
            $actual = max($posi);

            for($i=0;$i<=$rowcountseater;$i++)
            {

                if(!empty($seatsleep[0][$i]))
                {

                    if(count($seatsleep[0][$i])>$max)
                    {
                      $max=count($seatsleep[0][$i]);
                    }
                    if (count($seatsleep[0][$i])<$min) 
                    {
                      $min=count($seatsleep[0][$i]);
                    }
                }



            }

            $rowcountsleeper = count($seatsleep[1]); 
            $rowcountseater = count($seatsleep[0]);
            $sleeperperrowcount = count($seatsleep[1][0]);


            //For getting the number of seats per row in seater


                for($i=0;$i<=$rowcountseater;$i++)
                {

                    if(!empty($seatsleep[0][$i]))

                    {
                        $flagS=0;
                        $flagSL=0;

                        $seatcount=count($seatsleep[0][$i]);

                        if(!empty($seatsleep[0][$i][0]))
                        {

                            if(($seatsleep[0][$i][0]->length==2 && $seatsleep[0][$i][0]->width==1)||($seatsleep[0][$i][0]->length==1 && $seatsleep[0][$i][0]->width==2))
                            {
                              $flagSL=1;
                            }
                            else
                            {
                              $flagS=1;
                            }


                            for ($j=1; $j <$seatcount ; $j++) 
                            { 
                             
                                if(!empty($seatsleep[0][$i][$j]))
                                {
                                    if ($flagS==1 && (($seatsleep[0][$i][$j]->length==2 && $seatsleep[0][$i][$j]->width==1)||($seatsleep[0][$i][$j]->length==1 && $seatsleep[0][$i][$j]->width==2)))
                                    {
                                
                                    $flagSL=1;
                                    break;
                                    }
                                    elseif ($flagSL==1 && ($seatsleep[0][$i][$j]->length==1 && $seatsleep[0][$i][$j]->width==1)) 
                                    {
                                        
                                    $flagS=1;
                                        break;

                                    }
                              
                                }

                            }


                        }




                    }

                    if($flagS==1 && $flagSL==1)
                    {break;
                    }

                }

                if($flagS==1 && $flagSL==1)
                {
                  $seatperrowcount=$min*2;

                }
                else
                {
                  $seatperrowcount = $max;
                }
            // ends finding the limit for the seater loop (number of seats in a row)



            // FUNCTION CALL (1) UPPER BERTHS IN SEATER+SLEEPER
            generatelayout($rowcountsleeper,$sleeperperrowcount,$seatsleep,1,1);   


            //LOWER BERTHS
            // if seats and sleepers lower berths
            if ($flaglseat==1 && $flaglsleep==1)
            {

                generatelayout($rowcountseater,$actual,$seatsleep,0,1);

            }

            elseif ($flaglseat==1 && $flaglsleep==0) 
            {
                
                generatelayout($rowcountseater,$seatperrowcount,$seatsleep,0,1);
            }



        } //ends if it is a seater+sleeper

        //  If its not sleeper+seater -> basic seater/ sleeper
        elseif((($flagseatsleep1==0)&&($flagseatsleep2==0))||(($flagseatsleep1==1)&&($flagseatsleep2==0))||(($flagseatsleep1==0)&&($flagseatsleep2==1)))
        {
        

            $sleepersize=array(array(array()));

            foreach ($value as $k => $v) 
            {
                    foreach ($v as $k1 => $v1) 
                    {
                    
                        if(isset($v->length)&&isset($v->width))
                        {

                            if($v->length==1 && $v->width==1) // condition for seater or semi-sleeper
                          
                            {

                                $flag=2;
                                if(!strcmp($k1,'row'))
                                {
                                    $s[$v1][$v->column]=$v;

                                }
                            }
                            else if(($v->length==2 && $v->width==1)||($v->length==1 && $v->width==2)) // condition for horizontal sleeper
                            {  
                                $flag=1;

                                    if($v->length==2 && $v->width==1)
                                    { 
                                       $flag2=1;
                                    }

                                    if(!strcmp($k1,'row'))
                                    {
                                        if($v1>=$rowvalue)
                                       { $rowvalue=$v1;}


                                        $sleeper[$v->zIndex][$v1][$v->column]=$v;
                                        $sleepersize[$v->zIndex][$v1][$v->column]=$v->column;


                                    }

                            }
                   

                        }

                    }
                }

                $rowcountseater = count($s);  
                $seatperrowcount = count($s[0]);
                $c=0;
                for($i=0;$i<=$rowvalue;$i++)
                {
                  
                  if(!empty($sleeper[0][$i]))
                    {$c++;}
                }
                $rowcountsleeper=$c;


                // If it is a sleeper
                if ($flag==1)
                {

                    if (!empty($sleeper[0][$rowvalue]))
                    {  
                     $sleeperperrowcount0= count($sleeper[0][$rowvalue]);
                    }
                    else
                    { 
                        $sleeperperrowcount0=0;
                    }

                    if (!empty($sleeper[1][$rowvalue]))
                    {   
                    $sleeperperrowcount1= count($sleeper[1][$rowvalue]);
                    } // change made here
                    else
                    {
                        $sleeperperrowcount1=0;
                    }


                    $sleeperperrowcount = max($sleeperperrowcount1,$sleeperperrowcount0);

                    $MAXX=0;

                    for ($i=1; $i >=0 ; $i--)
                    {   
                        

                        for ($j=0; $j <=$rowvalue ; $j++)
                        {
                           if(!empty($sleepersize[$i][$j])) 
                            {
                              $X=max($sleepersize[$i][$j]);  
                            }
                            else
                            {
                               $X=0; 
                            }

                            if($X>$MAXX)
                            {
                                $MAXX = $X;
                            }

                        }
                       
                        if($flag2==1) // horizontal + vertical sleepers
                       {

                       //generate seatlayout 
                        generatelayout($rowvalue,$MAXX,$sleeper,$i,0);
                       }
                       else
                       {
                        $Z=$sleeperperrowcount+1;
                        generatelayout($rowvalue,$Z,$sleeper,$i,0);

                       }

                    }

                }
                elseif ($flag==2) // If it is seater
                {
                    

                    if(!empty($s))
                    {
                        generateLayoutSeater($rowcountseater,$seatperrowcount,$s);

                    }

                }




        } // ends if NOT sleeper+seater



    } //ends if(is_array($value))


}// foreach loop for the value variable ends


echo "<div>Seats</div>";
echo "<textarea id='t' name='seatnames' class='input'>Seats:</textarea><br><br>";

echo "<div style='bold'> BOARDING POINTS</div>";
$result2=json_decode($result1);
foreach ($result2 as $key => $values) 
{

    if(is_array($values))
    {
        foreach ($values as $k => $v) 
        {

           foreach ($v as $k1 => $v1) 
           {

                if($v->id==$chosenbusid)
                {
                      $v2=listofboardingpoints($v->boardingTimes,$chosenbusid);
                      echo $v2;
                      
                      break;
                }

            }
        }
    }
    else
    {

        foreach ($values as $k1 => $v1) 
        {
          
          if($values->id==$chosenbusid)
            {
                $v2=listofboardingpoints($values->boardingTimes,$chosenbusid);
                echo $v2;
                          
                break;
            }
        }

    }   


}





?>
<div id="selection"></div>
<?php

echo "<input type='hidden' name='chosensource' class='btnclass' value='".$sourceid."'/>";
echo "<input type='hidden' name='chosendestination' class='btnclass' value='".$destinationid."'/>";      
echo "<input type='hidden' name='chosenbus' class='btnclass' value='".$chosenbusid."' /></td>";

echo "<input type='submit' value='Continue' class='submit'>";

      

     //$tripId = $posted['id'];
     //$result = getTripDetails($tripId);
     //echo $result;die;
}

function getAvailableTripsBus($sourceId,$destinationId,$date)
{
	return invokeGetRequestbus("availabletrips?source=".$sourceId. "&destination=" . $destinationId . "&doj=" . $date); 		
}

function getBus($posted,$exptype,$selection=null){
    global $wpdb;
    
    // session_start();
    // include("function.php");

    //include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthStore.php';

    //include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthRequester.php';

    //include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/SSAPICaller.php';
    
    //require("company-mark-up-down-details.php");

		

    $sourceid = $_GET['sourceList'];
    $destid = $_GET['destinationList'];
    $date = $_GET['datepicker'];
    
    $from = $posted['from'];
    $to = $posted['to'];
		
    
    if (!$from) $from = "Bangalore";
    else {
            
            $selfrom = $wpdb->get_row("SELECT Loc_Id FROM bus_locations WHERE Loc_Name='$from'");
            $sourceid = $selfrom->Loc_Id;
    }

    if (!$to) $to = "Hyderabad";
    else {      
            $selTo = $wpdb->get_row("SELECT Loc_Id FROM bus_locations WHERE Loc_Name='$to'");
            $destid = $selTo->Loc_Id;
    }

    // echo 'Exp date='.$expdate."<br />";

    //if (!$expdate) {
            //$expdate = date('Y-m-d', strtotime('+1 day'));
            $expdate = date("Y-m-d", strtotime($posted['expdate']));

            // $expdate="2015-05-05";

    //}

    $sessid=time();

    /*$sourceid=3;
    $destid=6;
    $date="2015-05-05";*/

    //if (!session_id()) session_start();
    global $result;
    $result = getAvailableTripsBus($sourceid, $destid, $expdate);
    //$result = "T234";die;
    $data = json_decode($result, true);
    $modeid = $wpdb->get_row("Select MOD_Id FROM mode WHERE MOD_Name='$exptype'");
    
    //print_r($data);die;
    foreach ($data['availableTrips'] as $val){
        //$sessid = time();
        //$id = $val['id'];
        $seats = $val['availableSeats'];
        $array = $val['fares'];
        //if(!$price)
        //$price = implode(', ', $val['fares']);
        if (is_array($array)) {
        $num = count($array);
        $fares = '';
        for ($l = 0; $l < $num; $l++) {

                // $fares=$fares." <br />".$v1[$l];

                $fares = (int)$array[$l];
        }
        $price = $fares;
        }
        else{
            $price = $val['fares'];
        }
        $busName = $val['travels'];
        $busType = $val['busType'];
        $depTime = $val['departureTime'];
        $depTime = date('h:i a', strtotime($depTime));
        $arrTime = $val['arrivalTime'];
        $arrTime = date('h:i a', strtotime($arrTime));
        $ac = $val['AC'];
        $busId = $val['id'];
        $timeslot = timeSlot($val['departureTime'],$val['arrivalTime']);
        $insql = "INSERT INTO get_quote_flight(GQF_SessId, GQF_Origin, GQF_Destination, GQF_DepDate, MOD_Id, GQF_Stops, GQF_Price, GQF_AirlineName, GQF_FlightNumber, GQF_DepTIme, GQF_ArrTime, GQF_AirlineCode, GQF_Uid, location)
	VALUES ('$sessid', '$from', '$to', '$expdate', '$modeid->MOD_Id', '$seats', '$price', '$busName', '$busType','$depTime','$arrTime','$ac','$busId','$timeslot')";
        $wpdb->query($insql);
    }
    
    //echo $result;die;
    if($selection){
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$selection' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
		//print_r($selrgquote);
		$option1 = $selrgquote[0]->GQF_Uid;
		$option2 = $selrgquote[1]->GQF_Uid;
		$option3 = $selrgquote[2]->GQF_Uid;
		if($selrgquote[0]->RG_Pref == 2){
			$pref = $selrgquote[0]->GQF_Uid;
		}
		if($selrgquote[1]->RG_Pref == 2){
			$pref = $selrgquote[1]->GQF_Uid;
		}
		if($selrgquote[2]->RG_Pref == 2){
			$pref = $selrgquote[2]->GQF_Uid;
		}
    	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid' AND (GQF_Uid = '$option1' OR GQF_Uid = '$option2' OR GQF_Uid = '$option3') ORDER BY FIELD(GQF_Uid, $pref) DESC");
    }else{
    	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid' ORDER BY GQF_Price ASC");
    }
    $count = count($wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid'"));
    $minprice =	$wpdb->get_row("SELECT MIN(GQF_Price) as minprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
    $maxprice =	$wpdb->get_row("SELECT MAX(GQF_Price) as maxprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
    $busNames = $wpdb->get_results("SELECT DISTINCT GQF_AirlineName,GQF_Price FROM get_quote_flight WHERE GQF_SessId='$sessid' GROUP BY GQF_AirlineName");
    $busnames = array('buses' => $busNames);
    //print_r($minprice);die;
    $minPrice =	$minprice->minprice;
    $maxPrice =	$maxprice->maxprice;
    $countArray = array('count' => $count, 'minprice' => $minPrice, 'maxprice' => $maxPrice, 'session' => $sessid);
    //$result = json_encode($result,true);
    //$result = json_encode($response,true);
    $response = array('response' => $result);
    $obj_merged = (object) array_merge((array) $countArray, (array) $response, (array) $busnames);
    return $obj_merged;

}
function timeSlot($totMin,$totMax){
    	$timestringmin = "";
        $oneDay = 24 * 60;
        $time = $totMin % $oneDay;
        $hours = floor($time / 60);
        //console.log("from"+hours);
        if ($hours < 6) {
            $timestringmin = "0 - 6 AM";
        }
        if ($hours < 12) {
            $timestringmin = "6 AM - 12 PM";
        }
        if ($hours < 18) {
            $timestringmin = "12 PM - 6 PM";
        }
        if ($hours < 24) {
            $timestringmin = "6 PM - 12 AM";
        }
        return $timestringmin;
}

function getFlight($posted,$exptype,$selection=null){
	
	
	/*
	$hparams=array();
	$wsdl = "http://uatapi.ezeego1.com/HOTELWEBSERVICE_V1/Service.asmx"; 
	// This is sample web service URL, Kindly update this url which is provided.
	$hparams["AccountNo"]='EZ000145';
	$hparams["UserName"]='saikrishna.b@corptne.com';
	$hparams["Password"]='15CBJ0@YII8';
	$hparams["CompId"]='EZ';
	$hparams["Channel"]='SUBAGENT';
	$hparams["Language"]='GB';
	$client_header = new SoapHeader('http://uatapi.ezeego1.com/HOTELWEBSERVICE_V1/Service.asmx',$hparams,false);
	//$client_header = new SoapHeader('http://68.67.69.16/~demo/API/AIR/try.php','AuthenticationData',$hparams,false);
	$cliente = new SoapClient($wsdl);
	$cliente->__setSoapHeaders(array($client_header));
	$opta=array();
	$opta["Search"]["request"]["Origin"]				=	$from;
	$opta["Search"]["request"]["Destination"]			=	$to;
	$opta["Search"]["request"]["DepartureDate"]			=	$expdate;
	$opta["Search"]["request"]["ReturnDate"]			=	"2015-11-30T00:00:00";
	$opta["Search"]["request"]["Type"]					=	"OneWay";
	$opta["Search"]["request"]["CabinClass"]			=	"All";
	$opta["Search"]["request"]["PreferredCarrier"]		=	"";
	$opta["Search"]["request"]["AdultCount"]			=	"1";
	$opta["Search"]["request"]["ChildCount"]			=	"0";
	$opta["Search"]["request"]["InfantCount"]			=	"0";
	$opta["Search"]["request"]["SeniorCount"]			=	"0";
	$opta["Search"]["request"]["PromotionalPlanType"]	=	"Normal";
	$opta["Search"]["request"]["IsDirectFlight"]		=	true;

	$data	=	array();

	$data	= (array)$cliente->__call('Search', $opta);
	
	print_r($data);
	echo "test";
	
	*/
	
	
	
	
	
	
	
	
	
    global $wpdb;
    //$date = $_GET['datepicker'];
    //return $posted;die;
    $bdepartureDate = $posted['expdate'];
    $bdepartureDate = explode("-", $bdepartureDate);
    $bdepartureDate = $bdepartureDate[2] . "-" . $bdepartureDate[1] . "-" . $bdepartureDate[0];
    $departureDate = $posted['expdate'];
    $departureDate = date("Y-m-d\T00:00:00", strtotime($departureDate));
    $from = $posted['from'];
    $from = explode(", ", $from);
    $from = $from[0];
    $to = $posted['to'];
    $to = explode(", ", $to);
    $to = $to[0];
    $adultcount = $posted['adultCount'];
    if(!$adultcount)
    $adultcount = "1";
    $children = $posted['children'];
    if(!$children)
    $children = "0";
    $infants = $posted['infants'];
    if(!$infants)
    $infants = "0";
    $return = $posted['returnF'];
    $returnDate = date("Y-m-d\T00:00:00", strtotime($return));
    if($from){
    $selfrom = $wpdb->get_row("SELECT cityCode FROM airports WHERE cityName='$from'");
    $sourceCode = $selfrom->cityCode;
    }
    if($to){
    $selTo = $wpdb->get_row("SELECT cityCode FROM airports WHERE cityName='$to'");
    $destCode = $selTo->cityCode;
    }
    $hparams=array();
    $hparams["ClientId"]='ApiIntegrationNew';
    $hparams["EndUserIp"]='182.71.129.241';
    $hparams["UserName"]='firstventure';
    $hparams["Password"]='travel@1234'; 
    $url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate";
    $hparams = json_encode($hparams,true);
    $response = httpPost($url,$hparams);
    $response = json_decode($response,true);  
    $sessid = $response['TokenId'];
    $tokenid = $response['TokenId'];
    $url = "http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search/";
    if($return)
    $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $response['TokenId'], "AdultCount" => $adultcount, "ChildCount" => $children, "InfantCount" => $infants, "DirectFlight" => True, "OneStopFlight" => False, "JourneyType" => "2", "PreferredAirlines" => null, "Segments" => [ ["Origin" => $sourceCode, "Destination" => $destCode, "FlightCabinClass" => "1", "PreferredDepartureTime" => $departureDate, "PreferredArrivalTime" => $departureDate],["Origin" => $destCode, "Destination" => $sourceCode, "FlightCabinClass" => "1", "PreferredDepartureTime" => $returnDate, "PreferredArrivalTime" => $returnDate] ] ];
    else
    $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $response['TokenId'], "AdultCount" => $adultcount, "ChildCount" => $children, "InfantCount" => $infants, "DirectFlight" => True, "OneStopFlight" => False, "JourneyType" => "1", "PreferredAirlines" => null, "Segments" => [ ["Origin" => $sourceCode, "Destination" => $destCode, "FlightCabinClass" => "1", "PreferredDepartureTime" => $departureDate, "PreferredArrivalTime" => $departureDate] ] ];
    $data = json_encode($data,true);
    //$opta = json_encode($opta,true);
    //return $data;die;
    //return $response = httpPost($url,$data);die;
    //echo $url;
    //echo $data;die;
    $response = httpPost($url,$data);
    //echo $response;die;
    $data 	= 	json_decode($response, true);
/*print_r($data);*/

/*echo '<pre>';
print_r($jsonencodedval['SearchResult']['Result']['WSResult'][0]['Segment']['WSSegment']['Airline']); 
echo '</pre>';
exit;*/
$sessid=time();
$price = $AirlineCode = $FlightNumber = $cityFrom = $cityTo = $AirlineName = $DepTIme = $ObDuration = $Stop = $ArrTime = 0;


$values = NULL;
$traceId = $data['Response']['TraceId'];
foreach ($data['Response']['Results'][0] as $val){
    
	// ticket fare
	$resultIndex            =       $val['ResultIndex'];
	$price 			= 	$val['Fare']['BaseFare'] 			+ 
						$val['Fare']['Tax'] 				+ 
						$val['Fare']['FareBreakdown']['ServiceTax'] 			+ 
						$val['Fare']['FareBreakdown']['AdditionalTxnFee'] 	+ 
						//$val['Fare']['AirTransFee'] 		+ 
						$val['Fare']['OtherCharges'];
	
	
	$AirlineCode 	= $val['Segments'][0][0]['Airline']['AirlineCode'];
	
	$AirlineName 	= $val['Segments'][0][0]['Airline']['AirlineName'];
	
	
	$FlightNumber 	= $val['Segments'][0][0]['Airline']['FlightNumber'];
	
	
	$cityFrom 		= $val['Segments'][0][0]['Origin']['Airport']['CityName'];
	
	$cityTo 		= $val['Segments'][0][0]['Destination']['Airport']['CityName'];
	
	
	$DepTIme 		= $val['Segments'][0][0]['Origin']['DepTime'];
	
	$ArrTime 		= $val['Segments'][0][0]['Destination']['ArrTime'];
	
	$Stop 			= $val['Segments'][0][0]['StopOver'];
	
	$hoursconvert 	= $val['Segments'][0][0]['Duration'];
    
    if($hoursconvert>60){
        $ObDuration     = intdiv($hoursconvert, 60).'h '. ($hoursconvert % 60).'m';
    }
    if($hoursconvert<60){
    
    $ObDuration     = ($hoursconvert % 60).'m';
	}
    if($hoursconvert==60){
    
    $ObDuration     = intdiv($hoursconvert, 60).'h';
	}
	$amnt = $price;
	
	
	//if($setmarkup)
	//$price = getMarkFare($db_markstatus, $db_mcid, $db_markfare, $amnt);
					
					
	$price = ceil($price);
	
	$amnt = ceil($amnt);		

	$DepTIme = date('h:i a', strtotime($DepTIme));
	$ArrTime = date('h:i a', strtotime($ArrTime));
	$returnJourney = false;
	
	$values .= " ('$sessid', '$price', '$db_cmmid', '$db_markfare', '$db_markstatus', '$amnt', '$bdepartureDate', '$AirlineCode', '$FlightNumber', '$cityFrom', '$cityTo', '$AirlineName', '$DepTIme', '$ObDuration', '$Stop', '$ArrTime','$traceId','$resultIndex','$tokenid','$returnJourney'), ";
	
	
	//echo $insql; exit;
	
	
}
//Return Journey
foreach ($data['Response']['Results'][1] as $val){
    
	// ticket fare
	$resultIndex            =       $val['ResultIndex'];
	$price 			= 	$val['Fare']['BaseFare'] 			+ 
						$val['Fare']['Tax'] 				+ 
						$val['Fare']['FareBreakdown']['ServiceTax'] 			+ 
						$val['Fare']['FareBreakdown']['AdditionalTxnFee'] 	+ 
						//$val['Fare']['AirTransFee'] 		+ 
						$val['Fare']['OtherCharges'];
	
	
	$AirlineCode 	= $val['Segments'][0][0]['Airline']['AirlineCode'];
	
	$AirlineName 	= $val['Segments'][0][0]['Airline']['AirlineName'];
	
	
	$FlightNumber 	= $val['Segments'][0][0]['Airline']['FlightNumber'];
	
	
	$cityFrom 		= $val['Segments'][0][0]['Origin']['Airport']['CityName'];
	
	$cityTo 		= $val['Segments'][0][0]['Destination']['Airport']['CityName'];
	
	
	$DepTIme 		= $val['Segments'][0][0]['Origin']['DepTime'];
	
	$ArrTime 		= $val['Segments'][0][0]['Destination']['ArrTime'];
	
	$Stop 			= $val['Segments'][0][0]['StopOver'];
	
	
	$ObDuration 	= $val['Segments'][0][0]['Duration'];
	
	$amnt = $price;
	
	
	//if($setmarkup)
	//$price = getMarkFare($db_markstatus, $db_mcid, $db_markfare, $amnt);
					
					
	$price = ceil($price);
	
	$amnt = ceil($amnt);		

	$DepTIme = date('h:i a', strtotime($DepTIme));
	$ArrTime = date('h:i a', strtotime($ArrTime));
	$returnJourney = true;
	
	$values .= " ('$sessid', '$price', '$db_cmmid', '$db_markfare', '$db_markstatus', '$amnt', '$bdepartureDate', '$AirlineCode', '$FlightNumber', '$cityFrom', '$cityTo', '$AirlineName', '$DepTIme', '$ObDuration', '$Stop', '$ArrTime','$traceId','$resultIndex','$tokenid','$returnJourney'), ";
	
	
	
	
}

$insql = "INSERT INTO get_quote_flight(GQF_SessId, GQF_Price, CMM_Id, GQF_MarkFare, GQF_MarkUpDown, GQF_ActualPrice, GQF_DepDate, GQF_AirlineCode, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_AirlineName, GQF_DepTIme, GQF_Duration, GQF_Stops,  GQF_ArrTime, GQF_TraceId, GQF_ResultIndex, GQF_TokenId, Return_Journey) VALUES ";


if($values){
	$values = rtrim($values, ", ");
	$insql = $insql.$values;
        $wpdb->query($insql);
	//rawExeQuery($insql, $filename, $show=false);
}

//return $response;
if($selection){
$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$selection' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
		//print_r($selrgquote);
		$option1 = $selrgquote[0]->GQF_FlightNumber;
		$option2 = $selrgquote[1]->GQF_FlightNumber;
		$option3 = $selrgquote[2]->GQF_FlightNumber;
		if($selrgquote[0]->RG_Pref == 2){
			$pref = $selrgquote[0]->GQF_FlightNumber;
		}
		if($selrgquote[1]->RG_Pref == 2){
			$pref = $selrgquote[1]->GQF_FlightNumber;
		}
		if($selrgquote[2]->RG_Pref == 2){
			$pref = $selrgquote[2]->GQF_FlightNumber;
		}
$result = $wpdb->get_results("SELECT FORMAT(GQF_Price, 0) AS GQF_Price, CMM_Id, GQF_MarkFare, GQF_MarkUpDown, GQF_ActualPrice, GQF_DepDate, GQF_AirlineCode, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_AirlineName, GQF_DepTIme, GQF_Duration, GQF_Stops,  GQF_ArrTime, GQF_TraceId, GQF_ResultIndex, GQF_TokenId, Return_Journey, GQF_Id FROM get_quote_flight WHERE GQF_SessId='$sessid' AND (GQF_FlightNumber = '$option1' OR GQF_FlightNumber = '$option2' OR GQF_FlightNumber = '$option3') ORDER BY FIELD(GQF_FlightNumber, $pref) DESC");
}else{
$result = $wpdb->get_results("SELECT FORMAT(GQF_Price, 0) AS GQF_Price, CMM_Id, GQF_MarkFare, GQF_MarkUpDown, GQF_ActualPrice, GQF_DepDate, GQF_AirlineCode, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_AirlineName, GQF_DepTIme, GQF_Duration, GQF_Stops,  GQF_ArrTime, GQF_TraceId, GQF_ResultIndex, GQF_TokenId, Return_Journey, GQF_Id FROM get_quote_flight WHERE GQF_SessId='$sessid' ORDER BY GQF_Price ASC");
}
//return $result = json_encode($result,true);die;
//return $result;
$count = count($wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid'"));
    $minprice =	$wpdb->get_row("SELECT MIN(GQF_Price) as minprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
    $maxprice =	$wpdb->get_row("SELECT MAX(GQF_Price) as maxprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
    $busNames = $wpdb->get_results("SELECT DISTINCT GQF_AirlineName FROM get_quote_flight WHERE GQF_SessId='$sessid'");
    $busnames = array('flights' => $busNames);
    //print_r($minprice);die;
    $minPrice =	$minprice->minprice;
    $maxPrice =	$maxprice->maxprice;
    $countArray = array('count' => $count, 'minprice' => $minPrice, 'maxprice' => $maxPrice, 'session' => $sessid);
    //$result = json_encode($result,true);
    //$result = json_encode($response,true);
    $response = array('response' => $result);
    $session = array('session' => $sessid);
    $obj_merged = (object) array_merge((array) $countArray, (array) $response, (array) $busnames, (array) $session);
    return $obj_merged;
}

function getHotel($posted,$exptype,$selection=null){
    //print_r($posted);die;
    global $wpdb;
    global $values;
    //$stay = $posted['stay'];
    $datefrom = $posted['trvDate'];
    $dateto = $posted['trvTo'];
	$datefromezeego = date("d M Y", strtotime($datefrom));
    $datetoezeego = date("d M Y", strtotime($dateto));
    $datefrom = date("Ymd", strtotime($datefrom));
    $dateto = date("Ymd", strtotime($dateto));
    // Calculate Stay Duration
    $to = strtotime($dateto);
    $from = strtotime($datefrom);
    $datediff = $to - $from;

    $stay = floor($datediff / (60 * 60 * 24));
  
    
    $city = $posted['city'];
    $cityArray = explode("-", $city);
    $city = $cityArray[0];
    $counrty = $cityArray[1];
    if($city){
    $hotel = $wpdb->get_row("SELECT HotelId FROM hotels_goibibo WHERE cityName='$city' AND countryName='$counrty'");
    $hotelId = $hotel->HotelId;
    }
    
    $apiType = $wpdb->get_row("SELECT * FROM hotel_api WHERE Status='1'");
    if($apiType->Type=='IbIbo')
    {
    
	    $url = "http://pp.goibibobusiness.com/api/hotels/b2b/get_city_hotels/?query=hotels-".$hotelId."-".$datefrom."-".$dateto."-1-1_0&sort_type=popularity";

	    //$data = [ "query" => "hotels-".$hotelId."-".$datefrom."-".$dateto."-1-1_0", "sort_type" => "popularity" ];
	    $response = httpGet($url); 
	    //return $response;die;
	    $data 	= 	json_decode($response, true);
	    
	    $city = $data['data']['city_meta_info']['c'];
	    $country = $data['data']['city_meta_info']['country'];
	    $sessid=time();
	    
	    foreach ($data['data']['city_hotel_info'] as $val){
	    	
	    	$hotelName = $val['hn'];
	    	
	    	$hotelName = str_replace("'","\'",$hotelName);
	    	
		$hotelId = $val['hc'];
						
		$area = $val['tmob'];
		
		$price = $val['prc']*$stay;
		
		$available = $val['room_count'];

		$tRating = $val['ta_rat'];
		
		$propertyType = $val['tg'];
		$propertyType = implode(",",$propertyType);
		//$propertyType = implode(", ", $propertyType);
		
		/*foreach ($propertyType as $value)
		{
			$tablename = "hotel_property";
			$property_data = array(
		        'GQF_SessId' => $sessid,
		        'HotelId' => $hotelId,
		        'PropertyType' => $value,
		    	);
		    	$wpdb->insert($tablename, $property_data);
		}*/
		
		$hotelType = $val['ht'];
		$hotelType = implode(",",$hotelType);
		//$hotelType = implode(", ", $hotelType);
		/*foreach ($hotelType as $value)
		{
			$tablename = "hotel_type";
			$hoteltype_data = array(
		        'GQF_SessId' => $sessid,
		        'HotelId' => $hotelId,
		        'HotelType' => $value,
		    	);
		    	$wpdb->insert($tablename, $hoteltype_data);
		}*/
		
		$amenities = $val['fm'];
		$amenities = implode(",",$amenities);
		//$amenities = implode(", ", $amenities);
		/*foreach ($amenities as $value)
		{
			$tablename = "hotel_amenities";
			$amenities_data = array(
		        'GQF_SessId' => $sessid,
		        'HotelId' => $hotelId,
		        'Amenities' => $value,
		    	);
		    	$wpdb->insert($tablename, $amenities_data);
		}*/
		
		$hotelrating = $val['hr'];
		
		
		$location = $val['l'];
		
		$values .= " ('$sessid', '$price', '$hotelId', '$hotelName', '$area', '$city', '$country', '$available', '$hotelrating', '$location','$tRating','$propertyType','$hotelType','$amenities'), ";
		
		//echo $insql; exit;
		//echo $values;die;
		
	}
	
	$insql = "INSERT INTO get_quote_flight(GQF_SessId, GQF_Price, GQF_AirlineCode, GQF_AirlineName, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_Stops, hotelrating, location, trating, propertytype, hoteltype, amenities) VALUES ";
	
	
	if($values){
		$values = rtrim($values, ", ");
		$insql = $insql.$values;
		//echo $insql;die;
	        $wpdb->query($insql);
		//rawExeQuery($insql, $filename, $show=false);
	}
	
	$property = $data['data']['city_meta_info']['property'];
	$a = str_replace( ' ', '', array_keys($property) );
	$b = array_map('trim', $property);
	$property= array_combine($a, $b);
	$property = array('property' => $property);
	$hotel_star = $data['data']['city_meta_info']['hotel_star'];
	$a = str_replace( '0', 'zero', array_keys($hotel_star) );
	$b = array_map('trim', $hotel_star);
	$hotel_star= array_combine($a, $b);
	$a = str_replace( '1', 'one', array_keys($hotel_star) );
	$b = array_map('trim', $hotel_star);
	$hotel_star= array_combine($a, $b);
	$a = str_replace( '2', 'two', array_keys($hotel_star) );
	$b = array_map('trim', $hotel_star);
	$hotel_star= array_combine($a, $b);
	$a = str_replace( '3', 'three', array_keys($hotel_star) );
	$b = array_map('trim', $hotel_star);
	$hotel_star= array_combine($a, $b);
	$a = str_replace( '4', 'four', array_keys($hotel_star) );
	$b = array_map('trim', $hotel_star);
	$hotel_star= array_combine($a, $b);
	$a = str_replace( '5', 'five', array_keys($hotel_star) );
	$b = array_map('trim', $hotel_star);
	$hotel_star= array_combine($a, $b);
	$hotel_star = array('hotelstar' => $hotel_star);
	$hotel_type = $data['data']['city_meta_info']['hotel_type'];
	$a = str_replace( ' ', '', array_keys($hotel_type) );
	$b = array_map('trim', $hotel_type);
	$hotel_type= array_combine($a, $b);
	$hotel_type = array('hoteltype' => $hotel_type);
	$amenities = $data['data']['city_meta_info']['amenities'];
	$a = str_replace( ' ', '', array_keys($amenities) );
	$b = array_map('trim', $amenities);
	$amenities= array_combine($a, $b);
	$a = str_replace( '/', '', array_keys($amenities) );
	$b = array_map('trim', $amenities);
	$amenities= array_combine($a, $b);
	$a = str_replace( '-', '', array_keys($amenities) );
	$b = array_map('trim', $amenities);
	$amenities= array_combine($a, $b);
	$amenities = array('amenities' => $amenities);
	
	//return $response;
	if($selection){
	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid' ORDER BY FIELD(GQF_FlightNumber, $selection) DESC");
	}else{
	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid'");
	}
	//$result = json_encode($result,true);
	
	//return $result;
	$count = count($wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid'"));
	$minprice =	$wpdb->get_row("SELECT MIN(GQF_Price) as minprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
	$maxprice =	$wpdb->get_row("SELECT MAX(GQF_Price) as maxprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
	
	//print_r($minprice);die;
	$minPrice =	$minprice->minprice;
	$maxPrice =	$maxprice->maxprice;
	$countArray = array('count' => $count, 'minprice' => $minPrice, 'maxprice' => $maxPrice, 'session' => $sessid);
	//$result = json_encode($result,true);
	//$result = json_encode($response,true);
	$response = array('response' => $result);
	$obj_merged = (object) array_merge((array) $countArray, (array) $response, (array) $property, (array) $hotel_star, (array) $hotel_type, (array) $amenities);
	return $obj_merged;
}
else if($apiType->Type=='TBO'){

$hparams=array();
    $hparams["ClientId"]='ApiIntegration';
    $hparams["EndUserIp"]='182.71.129.241';
    $hparams["UserName"]='firstventure';
    $hparams["Password"]='travel@1234';
    $url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate";
    $hparams = json_encode($hparams,true);
    $response = httpPost($url,$hparams);
    $response = json_decode($response,true); 
    $sessid = $response['TokenId'];
    $tokenid = $response['TokenId'];
    $stay = $posted['stay'];
    $datefrom = date("d/m/Y", strtotime($datefrom));
    if($city){
    $hotel = $wpdb->get_row("SELECT countrycode,cityid FROM tbo_hotel_cities WHERE Destination='$city' AND country='$counrty'");
    $CountryCode = $hotel->countrycode;
    $CityId = $hotel->cityid;
    }
    
    $url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelResult/";
    $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $response['TokenId'], "CheckInDate" => $datefrom, "NoOfNights" => $stay, "CountryCode" => $CountryCode, "CityId" => $CityId, "PreferredCurrency" => "INR", "GuestNationality" => "1", "NoOfRooms" => "1", "RoomGuests" => [ ["NoOfAdults" => "1", "NoOfChild" => '0'] ], "MaxRating" => '5', "MinRating" => '0' ];
    $data = json_encode($data,true);
    echo 
    //$opta = json_encode($opta,true);
    //return $data;die;
    //return $response = httpPost($url,$data);die;
    $response = httpPost($url,$data);
    echo $response;die;
    //$data 	= 	json_decode($response, true);
   


}
else if($apiType->Type=='EZEEGO'){
	if($city){
    $hotel = $wpdb->get_row("SELECT countryCode,cityCode FROM airports WHERE cityName='$city'");
    $CountryCode = $hotel->countryCode;
    $CityId = $hotel->cityCode;
    }
	$string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:temp="http://tempuri.org/">
   <soapenv:Header/>
   <soapenv:Body>
      <temp:Hotel_Search>
         <!--Optional:-->
         <temp:HotelSearch><![CDATA[<Hotels>
	<Header>
		<AccountNo>EZ000145</AccountNo>
		<UserName>saikrishna.b@corptne.com</UserName>
		<Password>15CBJ0@YII8</Password>
		<CompId>EZ</CompId>
		<Channel>SUBAGENT</Channel>
		<Language>GB</Language>
	</Header>
	<HotelSearch_Query>
		<ResponseType>JSON</ResponseType>
		<CustomerNationality>IN</CustomerNationality>
		<CustomerCountryOfResidence>IN</CustomerCountryOfResidence>
		<Stay CheckIn="'.$datefromezeego.'" CheckOut="'.$datetoezeego.'" CityCode="'.$CityId.'" CountryCode="'.$CountryCode.'" HotelName="" />
		<Preferences>
			<Availability Available="1" OnRequest="0" />
			<Page Offset="1">2000</Page>
		</Preferences>
		<Rooms>
			<Room>
				<Occupancy>
					<NoAdults>1</NoAdults>
					<NoChildren>0</NoChildren>					
				</Occupancy>
			</Room>
		</Rooms>
		<MetaSearch>False</MetaSearch>	
	</HotelSearch_Query>
</Hotels>]]></temp:HotelSearch>
      </temp:Hotel_Search>
   </soapenv:Body>
</soapenv:Envelope>';
$url = "http://uatapi.ezeego1.com/HOTELWEBSERVICE_V1/Service.asmx?wsdl"; 
$response = httpPostxml($url,$string);
$result = strip_tags($response, '<?xml version="1.0" encoding="utf-8"?>');
//echo $response;
$data 	= 	json_decode($result, true);
// response format

$city = $data['HotelSearchRS']['HotelDetails']['Stay']['@CityName'];
	    $country = $data['HotelSearchRS']['HotelDetails']['Stay']['@Country'];
	    $sessid=time();
	    
	    foreach ($data['HotelSearchRS']['HotelDetails']['Hotel'] as $val){
	    	
	    	$hotelName = $val['HNm'];
	    	
	    	//$hotelName = str_replace("'","\'",$hotelName);
	    	
		$hotelId = $val['@HCode'];
						
		$area = $val['HImg'];
		$areaarray = explode(';',$area);
		$area = $areaarray[1];
		
		$price = $val['@GrossRate']*$stay;
		
		/*$available = $val['room_count'];*/

		$tRating = $val['@StarRating'];
		
		/*$propertyType = $val['tg'];
		$propertyType = implode(",",$propertyType);*/
		//$propertyType = implode(", ", $propertyType);
		
		/*foreach ($propertyType as $value)
		{
			$tablename = "hotel_property";
			$property_data = array(
		        'GQF_SessId' => $sessid,
		        'HotelId' => $hotelId,
		        'PropertyType' => $value,
		    	);
		    	$wpdb->insert($tablename, $property_data);
		}*/
		
		/*$hotelType = $val['ht'];
		$hotelType = implode(",",$hotelType);*/
		//$hotelType = implode(", ", $hotelType);
		/*foreach ($hotelType as $value)
		{
			$tablename = "hotel_type";
			$hoteltype_data = array(
		        'GQF_SessId' => $sessid,
		        'HotelId' => $hotelId,
		        'HotelType' => $value,
		    	);
		    	$wpdb->insert($tablename, $hoteltype_data);
		}*/
		
		/*$amenities = $val['fm'];
		$amenities = implode(",",$amenities);*/
		//$amenities = implode(", ", $amenities);
		/*foreach ($amenities as $value)
		{
			$tablename = "hotel_amenities";
			$amenities_data = array(
		        'GQF_SessId' => $sessid,
		        'HotelId' => $hotelId,
		        'Amenities' => $value,
		    	);
		    	$wpdb->insert($tablename, $amenities_data);
		}*/
		
		$hotelrating = $val['@StarRating'];
		
		
		$location = $val['Chennai'];
		
		$values .= " ('$sessid', '$price', '$hotelId', '$hotelName', '$area', '$city', '$country', '$available', '$hotelrating', '$location','$tRating','$propertyType','$hotelType','$amenities','$datefrom','$dateto'), ";
		
		//echo $insql; exit;
		//echo $values;die;
		
	}
	
	$insql = "INSERT INTO get_quote_flight(GQF_SessId, GQF_Price, GQF_AirlineCode, GQF_AirlineName, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_Stops, hotelrating, location, trating, propertytype, hoteltype, amenities, GQF_DepTIme, GQF_ArrTime) VALUES ";
	
	
	if($values){
		$values = rtrim($values, ", ");
		$insql = $insql.$values;
		//echo $insql;die;
	        $wpdb->query($insql);
		//rawExeQuery($insql, $filename, $show=false);
	}
	
	$property = $data['HotelSearchRS']['HotelLocation']['Location'];	
	$property = array('property' => $property);
	$hotel_star = $data['HotelSearchRS']['HotelStar']['Star'];
	$hotel_star = array('hotelstar' => $hotel_star);
	$hotel_type = $data['HotelSearchRS']['PropertyType']['Type'];
	$hotel_type = array('hoteltype' => $hotel_type);
	//$amenities = $data['data']['city_meta_info']['amenities'];
	//$amenities = array('amenities' => $amenities);
	
	//return $response;
	if($selection){
	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid' ORDER BY FIELD(GQF_FlightNumber, $selection) DESC");
	}else{
	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid'");
	}
	//$result = json_encode($result,true);
	
	//return $result;
	//$count = count($wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid'"));
	//$minprice =	$wpdb->get_row("SELECT MIN(GQF_Price) as minprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
	//$maxprice =	$wpdb->get_row("SELECT MAX(GQF_Price) as maxprice FROM get_quote_flight WHERE GQF_SessId='$sessid'");
	
	//print_r($minprice);die;
	$minPrice =	$data['HotelSearchRS']['HotelPrice']['@Min'];
	$maxPrice =	$data['HotelSearchRS']['HotelPrice']['@Max'];
	$count =  $data['HotelSearchRS']['TotalHotels'];
	$countArray = array('count' => $count, 'minprice' => $minPrice, 'maxprice' => $maxPrice, 'session' => $sessid);
	//$result = json_encode($result,true);
	//$result = json_encode($response,true);
	$response = array('response' => $result);
	$obj_merged = (object) array_merge((array) $countArray, (array) $response, (array) $property, (array) $hotel_star, (array) $hotel_type, (array) $amenities);
	return $obj_merged;
	//print_r($obj_merged);die;

// response format
//die;
}



}