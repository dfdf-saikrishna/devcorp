<?php
global $wpdb;
global $totalcost;
global $claimAmnt;
$compid = $_SESSION['compid'];
$supid = $_SESSION['supid'];
$reqid = $_GET['reqid'];
$row=$wpdb->get_row("SELECT * FROM requests req, request_employee re, assign_company ac WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND req.COM_Id=ac.COM_Id AND ac.SUP_Id = $supid AND AC_Status = 1 AND AC_Active = 1 AND REQ_Type=2 AND RE_Status=1");

$empid=$row->EMP_Id;
$selsql = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id=$reqid AND rd.RD_Type=2 AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id ORDER BY rd.RD_Dateoftravel ASC");
$rdidarry = array();
?>
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<style type="text/css">
    #my_centered_buttons { text-align: center; width:100%;}
    /* Quote */
   .eicon
   {
   text-align:center;
   color:#0096A8 !important;
   font-size:20px;
   }
   .ired{
   color: red !important;
   }
   .pgbg{
   background-color:#F8F8F8;
   }
   .img-responsive{
   	padding-top:25px;
   }
   .esthead
   {font-size:15px; letter-spacing:-0.28px;color:#000;padding:10px;}
   .wbg{background-color:#fff;}
   .pt15{padding-top:15px;}
   .pb15{padding-bottom:15px;}
   .bghlt{background:rgba(155,154,155,0.35);border 0 solid rgba(150,150,150,0.39);}
   .planefa{font-size:28px !important; margin-right:5px; color:#0096A8;}
   .mapfa {font-size:24px !important; margin-right:5px;}
   .18fnt {font-size:18px;}
   .22fnt {font-size:22px;}
   .gclr { color:#0096A8;}
   .splane{font-size:11px;color;#4A4A4A;}
   .c1a{color;#1A1A1A;}
   @media screen and (min-width: 780px) {
   //.pgbg{margin-top:12px;}
   .myrow {
   height:20px;
   }
   .imgsty{ height:96px !important;}
   }
   @media screen and (min-width: 100px)
   {
   .imgsty{ height:96px !important;}
   }
   /* Quote */	
</style>
<div class="postbox">
    <div class="inside">
        <div class="wrap pre-travel-request refresh_status request" id="wp-erp">
            <h2><?php _e('Booking Requests Details', 'employee'); ?></h2>
            <div>
                <!-- Employee Details -->
                <?php require_once WPERP_TRAVELAGENT_CLIENT_VIEWS . '/employee-details.php'; ?>
            </div>
            <div>
                <!-- Request Details -->
                <?php _e(travelagentuserrequestDetails(1)); ?>
            </div>
            	
            <!-- Messages -->
            <div style="display:none" id="failure" class="notice notice-error is-dismissible">
                <p id="p-failure"></p>
            </div>

            <div style="display:none" id="notice" class="notice notice-warning is-dismissible">
                <p id="p-notice"></p>
            </div>

            <div style="display:none" id="success" class="notice notice-success is-dismissible">
                <p id="p-success"></p>
            </div>

            <div style="display:none" id="info" class="notice notice-info is-dismissible">
                <p id="p-info"></p>
            </div>
            <div>
                <form id="pre-travel-details" name="input" action="#" method="post">
                    <div class="table-wrapper">
                    <table class="table" border="0" id="table1">
                        <thead class="cf">
                            <tr>
                                <th class="column-primary">Date</th>
                                <th class="column-primary">Expense Description</th>
                                <th class="column-primary" colspan="2">Expense Category</th>
                                <th class="column-primary" >Place</th>
                                <th class="column-primary">Estimated Cost</th>
                                <th class="column-primary">Booking Status</th>
                                <th class="column-primary">Cancellation Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($selsql as $rowsql) {
                                ?>
                                <tr>
                            <?php $freturn = $rowsql->RD_ReturnDate; ?>
                            <input type="hidden" id="et" value="1">
                            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"/>
                            <input type="hidden" name="reqcode" id="reqcode" value="<?php echo $row->REQ_Code ?>" />
                            <td data-title="Date"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                            <td data-title="Description"><?php echo stripslashes($rowsql->RD_Description); ?></td>
                            <td data-title="Category"><?php echo $rowsql->EC_Name; ?></td>
                            <td data-title="Category"><?php echo $rowsql->MOD_Name; ?></td>
                            <td data-title="Place"><?php
                                if ($rowsql->EC_Id == 1) {

                                    echo '<b>From:</b> ' . $rowsql->RD_Cityfrom . '<br />';
                                    echo '<b>To:</b> ' . $rowsql->RD_Cityto;
                                } else {

                                    echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;
                                    if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'"))
                                        echo '<br>Stay :' . $rowsd->SD_Name;
                                }
                                ?>
                                <?php echo $freturn; ?>
                                <?php if($freturn && $freturn!='0000-00-00'){ ?>
                                <span class="status-2">Return Journey Included</span>
                                <?php } ?>
                                </td>
                            <td data-title="Estimated Cost"><?php echo $rowsql->RD_Cost ? IND_money_format($rowsql->RD_Cost) . ".00" : approvals(5); ?></td>
                            
                            <td><?PHP
                                // if($row['REQ_Status']==2){

                                $imdir = WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";

                                if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {


                                    // check for self booking

                                    if ($selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                        echo bookingStatus(8);
                                        echo '<br><b>Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date));
                                    } else {

                                        $selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");
                                        if ($selrdbs) {

                                            echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

                                            echo '----------------------------------<br>';

                                           echo bookingStatus($selrdbs->BA_Id);


                                            $seldocs = $wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdbs->BS_Id'");

                                            $doc = NULL;

                                            $f = 1;

                                            foreach ($seldocs as $docs) {

                                                $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link" download>download</a><br>';

                                                $f++;
                                            }



                                            switch ($selrdbs->BA_Id) {
                                                case 2:
                                                    echo '<br><b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
                                                    echo $doc;
                                                    echo '<b>Booked Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
                                                    break;

                                                case 3:
                                                    echo '<br><b>Failed Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
                                                    break;
                                            }
                                        } else {

                                            echo bookingStatus(NULL);
                                        }
                                    }
                                } else {

                                    echo bookingStatus(NULL);
                                }

                                //}
                                ?></td>
                            <td><?PHP
                                //if($row['REQ_Status']==2){
                                $canc = false;
                                if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {


                                    // check for self booking

                                    if ($selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                        echo bookingStatus(NULL);
                                    } else {

                                        $selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=3 AND BS_Active=1");

                                        if ($selrdbs) {


                                            echo '<b title="Cancellation Request Date">Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

                                            echo '----------------------------------<br>';

                                            //echo ($selrdbs['BA_Id']==1) ? bookingStatus($selrdbs['BA_Id'])."<br>" : '';

                                            if ($selrdbs->BA_Id == 1) {

                                                echo bookingStatus($selrdbs->BA_Id) . "<br>";
                                            } else {


                                                echo bookingStatus($selrdbs->BA_Id);

                                                $seldocs = $wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdbs->BS_Id'");

                                                $doc = NULL;

                                                $f = 1;

                                                foreach ($seldocs as $docs) {

                                                    $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link" download>download</a><br>';

                                                    $f++;
                                                }

                                                switch ($selrdbs->BA_Id) {

                                                    case 4: case 6:
                                                        $canc = true;
                                                        echo '<br><b>Cancellation Amnt:</b> ' . IND_money_format($selrdbs->BS_CancellationAmnt) . '.00<br>';
                                                        echo $doc;
                                                        echo '<b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate)) . "<br>";
                                                        break;

                                                    case 5: case 7:
                                                        echo '<br><b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate)) . "<br>";
                                                        break;
                                                }
                                            }
                                        } else {

                                            echo bookingStatus(NULL);
                                        }
                                    }
                                } else {

                                    echo bookingStatus(NULL);
                                }

                                //}
                                ?></td>
                            </tr>
                            <?php
//                            $totalcost = "";
                            if ($rowsql->RD_Status == 1){
                            	//if($rowsql->MOD_Id == 5)
                            	//$totalcost+=$rowsql->RD_Cost*$rowsql->SD_Id;
                            	//else
                                $totalcost+=$rowsql->RD_Cost;
                                    if($canc){
					
                						$claimAmnt+=$selrdcs->BS_CancellationAmnt;
                					
                					} else {
                					
                						$claimAmnt+=$selrdbs->BS_TicketAmnt;
                					}
                                }

                            array_push($rdidarry, $rowsql->RD_Id);
                        }
                        ?>
                        
                            <tr>
                                <td align="right" width="85%" colspan="6">Total Estimated Cost</td>
                                <td align="center" width="5%">:</td>
                                <td align="right" width="10%"><?php echo IND_money_format($totalcost) . ".00"; ?></td>
                            </tr>
                            <tr>
                                <td align="right" width="85%" colspan="6">Total Cost (Rs)</td>
                                <td align="center" width="5%">:</td>
                                <td align="right" width="10%"><?php echo IND_money_format($claimAmnt) . ".00"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                        
                        </div>
                   
                </form>
            </div>
       
            <?php foreach($rdidarry as $rdid){	?>
            
            
            <?php	
		//echo 'Rdid='.$rdid;
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	    //print "<pre>";print_r($selrgquote);print "</pre>";
			if(count($selrgquote)){			
	                                        
				if($rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")){

	    ?>

            <?php if($rowRdDetails->MOD_Name=="Flight") { ?>	
            <div class="container pgbg flight-quote1">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo date('d-m-Y',strtotime($rowRdDetails->RD_Dateoftravel));?><?php if($freturn){echo  " " ."|" . " " .  date('d-m-Y',strtotime($freturn)); }?></span>  </div>
               </div>
               <br><br>
               <div class="row flight-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/AirlineLogo/'.$rowrgquote->GQF_AirlineCode.'.gif ';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
               ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3">Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    <?php if($rowRdDetails->MOD_Name=="Hotel") { ?>	
            <div class="container pgbg hotel">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-hospital-o planefa " aria-hidden="true" ></i><span class="gclr 22fnt">HOTELS</span> </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"> BLR - MAA </span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15"><i class="fa fa-calendar mapfa" aria-hidden="true"></i><span class="18fnt">12 , Apr 2017 </span>  </div>
               </div>
               <br><br>
               <div class="row hotel-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3">Spice jet</span> <br> <span class="splane quote-dep3"> Dep.12.45 AM </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">2000</span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    <?php if($rowRdDetails->MOD_Name=="Bus") { ?>
            <div class="container pgbg bus3">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo $rowRdDetails->RD_Dateoftravel;?> </span>  </div>
               </div>
               <br><br>
               <div class="row bus-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/quote-bus.png';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
               ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3"> Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    
 	    <?php } ?>
 	    
 	    
 	    <?php } ?>
 	    
	    <?php } ?>

        </div>


    </div>
</div>

