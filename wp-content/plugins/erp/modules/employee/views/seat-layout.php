<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
    #image {
background: url(/images/ac_semi_sleeper_vacant.jpg) no-repeat;
}

.checkbox:checked + .containers{
		outline: 2px solid black;	}
.containers {position: relative;
		outline: 1px solid #cacaca;
		}

.containers:hover {position: relative;
		    border: 1px solid red;
    z-index: 999999;
    width: 73px;
    height: 59px;
			}

.container_vert {  position: relative;
	outline: 1px solid white;}

.container_vert:hover {  position: relative;
	outline: 2px solid red;
		} 

.container_un {position: relative;
		opacity:0.8;
		filter:alpha(opacity=80);}

.container_vert_un {  position: relative;
			opacity:0.45;
		filter:alpha(opacity=45);}
.checkbox{position: relative; bottom: 0px; right:0px;}
.checkbox:hover{

}

/*
.imagehover{
outline: 1px solid white; 
}

.imagehover:hover{
 outline: 2px solid red; 
}
*/

.submit {
    background-color: #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
     border:none;
}


.submit:hover {
    border: none;
    background:red;
    box-shadow: 0px 0px 1px #777;
    
}
.input{ border:1px solid #C01C22;
	background: #FDF4A5;
	font-family:"cursive",Georgia;
	font-size: 16px;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<title>SEAT LAYOUT</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

          
<script language="javascript" type="text/javascript">
imgseaterArr=new Array(); 
imgladiesseaterArr=new Array();
imgvsleeperArr=new Array();
imgladiesvsleeperArr=new Array();
imghsleeperArr=new Array();
imgladieshsleeperArr=new Array();

for(var i=0;i<100;i++)
{
  imgseaterArr[i]=new Array("<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/ac_semi_sleeper_vacant.jpg","<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/ac_sleeper_selected.jpg"); 
  imgladiesseaterArr[i]=new Array("<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/non_ac_seater_ladies.jpg","<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/ac_sleeper_selected.jpg"); 

  imgvsleeperArr[i]=new Array("<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/volvo_sleeper_vertical_vacant.jpg","<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/volvo_sleeper_vertical_selected.jpg");
    imgladiesvsleeperArr[i]=new Array("<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/non_ac_vertical_sleeper_ladies.jpg","<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/volvo_sleeper_vertical_selected.jpg");

  imghsleeperArr[i]=new Array("<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/volvo_sleeper_vacant.jpg","<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/volvo_sleeper_selected.jpg");
  imgladieshsleeperArr[i]=new Array("<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/non_sleeper_ac_ladies.jpg","<?php echo WPERP_EMPLOYEE_ASSETS?>/images/seats/volvo_sleeper_selected.jpg");

}

function swapseater(chk,ind){
img=document.images['img'+ind]; 
if(chk){ 
img.src=imgseaterArr[ind][1]; 
img.alt=imgseaterArr[ind][1]; 
} 
else{ 
img.src=imgseaterArr[ind][0]; 
img.alt=imgseaterArr[ind][0]; 
} 
}

function swapladiesseater(chk,ind){ 
img=document.images['img'+ind]; 
if(chk){ 
img.src=imgladiesseaterArr[ind][1]; 
img.alt=imgladiesseaterArr[ind][1]; 
} 
else{ 
img.src=imgladiesseaterArr[ind][0]; 
img.alt=imgladiesseaterArr[ind][0]; 
} 
}

function swapvsleeper(chk,ind){ 
img=document.images['vsleep'+ind]; 
if(chk){ 
img.src=imgvsleeperArr[ind][1]; 
img.alt=imgvsleeperArr[ind][1]; 
} 
else{ 
img.src=imgvsleeperArr[ind][0]; 
img.alt=imgvsleeperArr[ind][0]; 
} 
}
function swapladiesvsleeper(chk,ind){ 
img=document.images['vsleep'+ind]; 
if(chk){ 
img.src=imgladiesvsleeperArr[ind][1]; 
img.alt=imgladiesvsleeperArr[ind][1]; 
} 
else{ 
img.src=imgladiesvsleeperArr[ind][0]; 
img.alt=imgladiesvsleeperArr[ind][0]; 
} 
}

function swaphsleeper(chk,ind){ 
img=document.images['hsleep'+ind]; 
if(chk){ 
img.src=imghsleeperArr[ind][1]; 
img.alt=imghsleeperArr[ind][1]; 
} 
else{ 
img.src=imghsleeperArr[ind][0]; 
img.alt=imghsleeperArr[ind][0]; 
} 
}


function swapladieshsleeper(chk,ind){ 
img=document.images['hsleep'+ind]; 
if(chk){ 
img.src=imgladieshsleeperArr[ind][1]; 
img.alt=imgladieshsleeperArr[ind][1]; 
} 
else{ 
img.src=imgladieshsleeperArr[ind][0]; 
img.alt=imgladieshsleeperArr[ind][0]; 
} 
}
function getXMLHTTP() { 
        var xmlhttp=false;  
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {       
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
            
        return xmlhttp;
    }

function BoardingPoint(chosenboardingpoint,chosentripid){
   var strURL="<?php echo plugins_url();?>/erp/modules/employee/views/BoardingPoint.php?boardingpointsList="+chosenboardingpoint+"&chosentripid="+chosentripid;
   var req = getXMLHTTP();
    if(req) {

            req.onreadystatechange = function() {
                    if (req.readyState == 4) {

                        if (req.status == 200) {
                            document.getElementById('selection').innerHTML=req.responseText;
    } else {
                            alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                        }
                    }               
                }   
                    req.open("GET",strURL,true);
                    req.send(null);

    }

    }
    </script>
</head>
<body>

<?php
    global $wpdb;
    include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthStore.php';

    include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthRequester.php';

    include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/SSAPICaller.php';

    $base_url = "http://api.seatseller.travel/";

    echo "<form method='POST' action='#' name='seat_layout' id='seat_layout'>";

    $image_seater_vacant= WPERP_EMPLOYEE_ASSETS."images/ac_semi_sleeper_vacant.jpg";
    $image_seater_selected= WPERP_EMPLOYEE_ASSETS."images/ac_sleeper_selected.jpg";
    $image_seater_unavailable= WPERP_EMPLOYEE_ASSETS."images/ac_semi_sleeper_unavailable.jpg";
    $image_seater_ladies=WPERP_EMPLOYEE_ASSETS."images/non_ac_seater_ladies.jpg";
    $image_sleeper_vacant=WPERP_EMPLOYEE_ASSETS."images/volvo_sleeper_available.jpg";
    $image_sleeper_unavailable=WPERP_EMPLOYEE_ASSETS."images/volvo_sleeper_unavailable.jpg";
    $image_sleeper_ladies=WPERP_EMPLOYEE_ASSETS."images/non_sleeper_ac_ladies.jpg";
    $image_vertical_sleeper_vacant=WPERP_EMPLOYEE_ASSETS."images/volvo_sleeper_vertical_vacant.jpg";
    $image_vertical_sleeper_unavailable=WPERP_EMPLOYEE_ASSETS."images/volvo_sleeper_vertical_unavailable.jpg";
    $image_vertical_sleeper_ladies=WPERP_EMPLOYEE_ASSETS."images/non_ac_vertical_sleeper_ladies.jpg";

    $image_empty_row=WPERP_EMPLOYEE_ASSETS."images/no_seat.jpg";
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
//
//      $sourceid=$_GET['sourceList'];
//     $destinationid=$_GET['destinationList'];
//     $date=$_GET['datepicker'];
    
     $from = $_GET['source'];
     $to = $_GET['destination'];
     //$expdate = $posted['expdate'];
     //$expdate = date('Y-m-d', strtotime('+1 day'));
     $expdate = date("Y-m-d", strtotime($_GET['traveldate']));
     
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
      $chosenbusid = $_GET['busid'];
      $rdid = $_GET['rdid'];
      
      
 $result1 = getAvailableTrips($sourceid,$destinationid,$date);
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


echo "<div class='filter-top'><div class='col-md-1'>Seats</div>";
echo "<div class='col-md-3'><textarea id='t' name='seatnames' class='form-control'>Seats:</textarea></div>";

echo "<div style='bold' class='col-md-1'> BOARDING POINTS</div>";
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

function listofboardingpoints($v1,$chosenbusid)
{
    echo "<input type='hidden' name='chosenbusid' class='btnclass' value='".$chosenbusid."'/>";
    $chosentripid = (String)$chosenbusid;
    $listout="<div class='col-md-3'><select onChange='BoardingPoint(this.value,\"".$chosentripid."\")' id='boardingpointsList' name='boardingpointsList' class='form-control'>";
        if(is_array($v1))

        {
            foreach ($v1 as $v1)  
            {
                  $timehold=$v1->time;
                  $timehold2= getTime($timehold);
                  $listout =$listout."<option value=".$v1->bpId."> LOCATION:".$v1->location." TIME: ".$timehold2."</option>";  
            }
            $listout=$listout."</select></div>";
        }
        else
        {
            $timehold=$v1->time;
            $timehold2= getTime($timehold);
            $listout =$listout."<option value=".$v1->bpId."> LOCATION:".$v1->location." TIME: ".$timehold2."</option>";  
            $listout=$listout."</select>";

        }

return $listout;
}

function getTime($totMin)
{

       $timestring="";

       $oneDay=24*60;
       $noOfDays = floor($totMin / $oneDay);
       $time = $totMin % $oneDay;

       $hours = floor($time/60);
       $minutes = floor($time%60);


       if($minutes<10)
       {
        $minutes='0'.$minutes;
       }

        if($hours%12==0)
        {
          $timestring.="00";
        }
        else
        { $timestring.=$hours%12;
        }
        $timestring.=":";
        $timestring.=$minutes;

        if($hours<12)
        {
        $timestring.=" AM";
        }

        else
        {
        $timestring.=" PM";
        }

        return $timestring;
}
$y=0;


function generatelayout($rowcountsleeper,$sleeperperrowcount,$seatsleep,$UpperLower,$horVer)
{

    if  ($UpperLower==1)
        {
            echo "<caption><br>UPPER SECTION</caption> ";
            $i=1;

            if($horVer==1)
            {
                $klimit = ($sleeperperrowcount*2+1) ;
            }
            elseif ($horVer==0) 
            {
                $klimit = $sleeperperrowcount+1 ;
            }


        }
    elseif ($UpperLower==0)
        {
            echo "<br><caption>LOWER SECTION</caption> ";
            $i=0;
            $klimit=$sleeperperrowcount;
        }

        $x=0;
        $y = 1;
        echo "<table frame='box'><tbody>";
        $l=0;
        for ($j=0; $j <=$rowcountsleeper ; $j++) 
        { 
        
            echo "<tr>";

            for ($k=0; $k <=$klimit ; $k++) 
            { 
              
               if(!empty($seatsleep[$i][$j][$k]))
               { 
       
                    if($seatsleep[$i][$j][$k]->length==2 && $seatsleep[$i][$j][$k]->width==1)
                    {

                        if(!strcmp($seatsleep[$i][$j][$k]->available,'true'))    
                        {
           
                            if(!strcmp($seatsleep[$i][$j][$k]->ladiesSeat,'true'))
                            {
                            echo "<td><div id='c_b' class='containers'><label for='hsleep".$i.$j.$k."'><img name='hsleep".$y."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/non_sleeper_ac_ladies.jpg title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapladieshsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }

                            else
                            {
                            echo "<td><div id='c_b' class='containers'><label for='hsleep".$i.$j.$k."'><img name='hsleep".$y."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_vacant.jpg title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."'onclick='swaphsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }
                        }
                        else
                        {
                        echo "<td><div class='container_un'><img src=".WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_unavailable.jpg></div></td>";
                        } 

                    }
      
                    elseif ($seatsleep[$i][$j][$k]->length==1 && $seatsleep[$i][$j][$k]->width==2) 
                    {
       
                        if(!strcmp($seatsleep[$i][$j][$k]->available,'true'))    
                        {
                            if(!strcmp($seatsleep[$i][$j][$k]->ladiesSeat,'true'))
                            {
                            echo "<td><div id='c_b' class='container_vert'><label for='vsleep".$i.$j.$k."'><img name='vsleep".$y."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/non_ac_vertical_sleeper_ladies.jpg title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapvsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }

                            else
                            {
                                echo "<td><div id='c_b' class='container_vert'><label for='vsleep".$i.$j.$k."'><img name='vsleep".$y."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_vertical_vacant.jpg title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."'onclick='swapvsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td> ";
                            }
                        }
                        else
                       {
                        echo "<td><div class='container_vert_un'><img src=".WPERP_EMPLOYEE_ASSETS."/images/seats/volvo_sleeper_vertical_unavailable.jpg></div></td>";
                       } 

                    }
                    elseif ($seatsleep[$i][$j][$k]->length==1 && $seatsleep[$i][$j][$k]->width==1) 
                    {
                        $storeseatname=$seatsleep[$i][$j][$k]->name;

                        if(!strcmp($seatsleep[$i][$j][$k]->available,'true'))
                        {
                            if(!strcmp($seatsleep[$i][$j][$k]->ladiesSeat,'true'))
                            {
                            echo "<td><div id='c_b'class='containers'><label for='seat".$j.$k."'><img name='img".$l."' id='".$k.$j."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/non_ac_seater_ladies.jpg title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='seat".$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapladiesseater(this.checked,".$l++.")' style='visibility:hidden'/></label></div></td>" ;

                            } 
                             else
                            {
                           
                             echo "<td><div id='c_b'class='containers'><label for='seat".$j.$k."'><img name='img".$l."' id='".$k.$j."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/ac_semi_sleeper_vacant.jpg title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat".$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapseater(this.checked,".$l++.")' style='visibility:hidden'/></label></div></td>";

                            }  
                        }
                        else
                        {
                            echo "<td><div class='container_un'><img src=".WPERP_EMPLOYEE_ASSETS."/images/seats/ac_semi_sleeper_unavailable.jpg></div></td>";
                        }    
                    }

                }

                if(empty($seatsleep[$i][$j][$k]))
                {
                  
                    if (empty($seatsleep[$i][$j])) 
                    {
                    echo "<td><img src=".WPERP_EMPLOYEE_ASSETS."/images/seats/no_seat.jpg></td>";
                    }
                    elseif (!empty($seatsleep[$i][$j])) 
                    {
                    echo "<td></td>";
                    }
                  
                
                }



            }

        echo "</tr>";
        }
        echo "</tbody></table>";
}

function generateLayoutSeater($rowcountseater,$seatperrowcount,$s)
{
    if(!empty($s))
   { 
    echo "<div class='table-responsive'><table frame='box'><tbody>";
    $k=0;
    for ($i=0; $i <=$rowcountseater ; $i++) 
    { 
        echo "<tr>";
  
        for ($j=0; $j <= $seatperrowcount ; $j++) 
        { 
    
            if(!empty($s[$i][$j]))
            { 
                $storeseatname=$s[$i][$j]->name;
                if(!strcmp($s[$i][$j]->available,'true'))    

                {
                   if(!strcmp($s[$i][$j]->ladiesSeat,'true'))
                   {
                    echo "<td><div id='c_b'class='containers'><label for='seat".$i.$j."'><img name='img".$k."' id='".$j.$i."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/non_ac_seater_ladies.jpg title='Seat Number:".$s[$i][$j]->name." | Fare: ".$s[$i][$j]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='seat".$i.$j."' value='".$s[$i][$j]->name."' onclick='swapladiesseater(this.checked,".$k++.")' style='visibility:hidden'/></label></div></td>" ;
                   }

                    else
                    {
               
                 echo "<td><div id='c_b'class='containers'><label for='seat".$i.$j."'><img name='img".$k."' id='".$j.$i."' src=".WPERP_EMPLOYEE_ASSETS."/images/seats/ac_semi_sleeper_vacant.jpg title='Seat Number:".$s[$i][$j]->name." | Fare: ".$s[$i][$j]->fare."' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat".$i.$j."' value='".$s[$i][$j]->name."' onclick='swapseater(this.checked,".$k++.")' style='visibility:hidden'/></label></div></td>";

                    }
                }
                else
                {
                        echo "<td><div class='container_un'><img src=".WPERP_EMPLOYEE_ASSETS."/images/seats/ac_semi_sleeper_unavailable.jpg></div></td>";
                }  

            }

            if(empty($s[$i][$j]))
            {
          
                if (empty($s[$i])) 
                {
                    echo "<td><img src=".WPERP_EMPLOYEE_ASSETS."/images/seats/no_seat.jpg></td>";
                }
            elseif (!empty($s[$i])) 
            
              {
                echo "<td></td>";
              }
          
            }

        }
  
    echo "</tr>";
    }
echo "</table></div>";
}

}



?>
<script type="text/javascript">

function swapImage(id,primary,secondary) 
{
    src=document.getElementById(id).src;
    if (src.match(primary)) {
      document.getElementById(id).src=secondary;
    } else {
      document.getElementById(id).src=primary;
    }
}


function updateTextArea() 
{         
         var allVals = [];
         $('#c_b :checked').each(function() {
           allVals.push($(this).val());
         });
         $('#t').val(allVals)
}
$(function() 
{
       $('#c_b input').click(updateTextArea);
       updateTextArea();
});

</script>
<div id="selection"></div>

<?php

echo "<input type='hidden' name='chosensource' class='btnclass' id='chosensource' value='".$sourceid."'/>";
echo "<input type='hidden' name='chosendestination' class='btnclass' id='chosendestination' value='".$destinationid."'/>";      
echo "<input type='hidden' name='chosenbus' class='btnclass' id='chosenbus' value='".$chosenbusid."' /></td>";
echo "<input type='hidden' name='rdid' class='btnclass' id='rdid' value='".$rdid."' /></td>";
echo "<div class='col-md-3 pull-right' style='padding-top:10px;'><input type='submit' value='Continue' id='bus_personal_details' class='btn btn-primary'></div></div>";
?>

</body>
</html>
