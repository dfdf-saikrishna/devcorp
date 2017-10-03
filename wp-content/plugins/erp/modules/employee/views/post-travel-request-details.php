<?php
require_once WPERP_EMPLOYEE_PATH . '/includes/functions-pre-travel-req.php';
$showProCode = 1;
global $wpdb;
global $totalcost;
global $bookingcost;
$curDate = date('Y-m-d');
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$selexpcat = $wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode = $wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
$reqid = $_GET['reqid'];
$selsql = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id='$reqid' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
$row = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
if($row->REQ_PreToPostStatus){
	$colspan = 8;
}
else{
	$colspan = 6;
}
$rdidarry = array();
$bookingcount = 0;
global $freturn;
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
   
   .img-responsive{
   	padding-top:15px;
   	width:35%;
   }
   .esthead
   {font-size:15px; letter-spacing:-0.28px;color:#000;padding:10px;}
   .wbg{background-color:#fff;}
   .pt15{padding-top:15px;}
   .pb15{padding-bottom:15px;}
  
   
   .18fnt {font-size:18px;}
   .22fnt {font-size:22px;}
   
   .c1a{color;#1A1A1A;}
   /* Quote */		
</style>
        <div class="wrap pre-travel-request request" id="wp-erp">
            <h2><?php _e('Post Travel Requests Details', 'employee'); ?></h2>
            <!-- Messages -->
            <!-- Messages -->
            <?php
            if (isset($_REQUEST['msg'])) {
                $msg = $_REQUEST['msg'];
                // booking 
                $a = $_GET['a'];
                $c = $_GET['c'];
                $b = $_GET['b'];
                $d = $_GET['d'];


                // self booking
                $s = $_GET['s'];

                // cancellation
                $p = $_GET['p'];
                $h = $_GET['h'];
                $f = $_GET['f'];

                switch ($msg) {
                    case 1:
                        $msg = '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success">You have successfully Approved this Pre Travel Expense Request</p>
                           </div>';
                        break;

                    case 4:
                        $msg = '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success">You have successfully added a note. </p>
                           </div>';

                        break;

                    case 6:

                        $msg = '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success">You have successfully Rejected this Pre Travel Expense Request </p>
                           </div>';
                        break;


                    // booking request 
                    case 7:

                        $msg = NULL;
                        if ($a) {
                            $a = convert_number($a);
                            $msg = '<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                                <p id="p-notice"><?php echo $b; ?> ' . $a . ' record was already send to travel desk for booking.</p>
                            </div>';
                        }

                        if ($b) {
                            $b = convert_number($b);
                            $msg.= '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success">' . $b . ' records successfully send to travel desk for booking. </p>
                            </div>';
                        }

                        break;


                    /*
                      SELF BOOKING
                     */

                    case 8:

                        $msg = "";
                        if ($a) {
                            $a = convert_number($a);
                            $msg = '<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                                <p id="p-notice"><?php echo $b; ?> ' . $a . ' records was already set as self booking. </p>
                            </div>';
                        }

                        if ($s) {
                            $s = convert_number($s);
                            $msg.= '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success"> ' . $s . ' records were successfully set as self booking. </p>
                            </div>';
                        }
                        break;


                    case 9:

                        $msg = "";

                        if ($h) {
                            $h = convert_number($h);
                            $msg = '<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                                <p id="p-notice"><?php echo $b; ?> ' . $h . ' records not yet booked. Cancellation not possible.</p>
                            </div>';
                        }

                        if ($p) {
                            $p = convert_number($p);
                            $msg.='<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                                <p id="p-notice"><?php echo $b; ?> ' . $p . ' records are under processing by the travel desk.</p>
                            </div>';
                        }
                        if ($f) {
                            $f = convert_number($f);
                            $msg.='<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                                <p id="p-notice"><?php echo $b; ?> ' . $f . ' records were failed to book by the travel desk. It cannot be cancelled.</p>
                            </div>';
                        }
                        if ($b) {
                            $b = convert_number($b);
                            $msg.= '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success"> ' . $b . ' records were successfully sent for cancellation. </p>
                            </div>';
                        }
                        if ($c) {
                            $c = convert_number($c);
                            $msg.= '<div style="display:block" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success"> ' . $j . ' records were already cancelled. Please go through the request details carefully </p>
                            </div>';
                        }
                        break;


                    case 11:
                        $msg = '<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                            <p id="p-notice"><?php echo $b; ?>Finance Approval pending.</p>
                          </div>';
                        break;
						
					case 12:
                        $msg = '<div style="display:block" id="notice" class="notice notice-warning is-dismissible">
                            <p id="p-notice"><?php echo $b; ?>Please Submit the Request for Approval</p>
                          </div>';
                        break;
                }
                echo $msg;
            }
            ?>
            <div style="display:none" id="failure" align="center" class="notice notice-error is-dismissible">
                <p id="p-failure"></p>
            </div>

            <div style="display:none" id="notice" align="center" class="notice notice-warning is-dismissible">
                <p id="p-notice"></p>
            </div>

            <div style="display:none" id="success" align="center" class="notice notice-success is-dismissible">
                <p id="p-success"></p>
            </div>

            <div style="display:none" id="info" align="center" class="notice notice-info is-dismissible">
                <p id="p-info"></p>
            </div>
	    <!-- Request Details -->
			<?php
			if($row->REQ_PreToPostStatus)
            _e(requestDetails(1)); 
			else
			 _e(requestDetails(2));

            require WPERP_EMPLOYEE_VIEWS . "/employee-details.php";
            ?>
            <?php
            	$req_details = $wpdb->get_row("SELECT * FROM request_details WHERE REQ_Id = '$row->REQ_Id'");
            	$category_budgets = $wpdb->get_row("SELECT * FROM Categorybudgets WHERE PC_Id = '$req_details->PC_Id'");
            	
            	$travel_budget = $wpdb->get_row("SELECT SUM(RD_Cost) as total FROM request_details WHERE PC_Id = '$req_details->PC_Id' AND EC_Id = '1'");
            	$accomodation =  $wpdb->get_row("SELECT SUM(RD_Cost) as total FROM request_details WHERE PC_Id = '$req_details->PC_Id' AND EC_Id = '2'");
            	$other =  $wpdb->get_row("SELECT SUM(RD_Cost) as total FROM request_details WHERE PC_Id = '$req_details->PC_Id' AND EC_Id = '4'");
            	
            	$utility =  $wpdb->get_row("SELECT SUM(RD_Cost) as total FROM request_details WHERE PC_Id = '$req_details->PC_Id' AND EC_Id = '3'");
            	
		if($category_budgets){
                if($category_budgets->Travel_Category < $travel_budget->total){
                	$budget = '100';
                }
                else if($category_budgets->Milage_Category < $accomodation->total){
                	$budget = '100';
                }
                else if($category_budgets->Others_Category < $other->total){
                	$budget = '100';
                }
                else if($category_budgets->Utility_Category < $utility->total){
                	$budget = '100';
                }
	    	if($budget=='100')
	    	{
	    	?>
	    	<div style="display:block" id="failure" class="notice notice-error is-dismissible">
                <p style="text-align:center" id="p-failure">Budget Limit Reached 100% Cannot Approve the Request</p>
            </div>
	   <?php } }?>
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
            <div style="margin-top:60px;">
                <form id="request_form_post" name="input" action="#" method="post">
				<div class="table-responsive">
                    <table class="table" border="0" id="table1">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="column-primary">Date</th>
                                <th class="column-primary">Expense Description</th>
                                <th class="column-primary" colspan="2">Expense Category</th>
                                <th class="column-primary" >Place</th>
								<?php if(!$row->REQ_PreToPostStatus){ ?>
                                <th class="column-primary" >Upload bills / tickets</th>
								<?php } ?>
                                <?php if($row->REQ_PreToPostStatus){ ?>
                                <th class="column-primary">Select</th>
                                <th class="column-primary">Booking Status</th>
                                <th class="column-primary">Cancellation Status</th>
                                <?php } ?>
								<th class="column-primary">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($selsql as $rowsql) {
                            ?>
                            <tr>
                            <?php $freturn = $rowsql->RD_ReturnDate; ?>
                            <input type="hidden" id="et" value="2">
                            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"/>
							<input type="hidden" value="<?php echo $reqid; ?>" name="req_id" id="req_id"/>
                            <input type="hidden" class="row" value="<?php echo $rowsql->RD_Id;?>">
                            <input type="hidden" value="<?php echo date('d-m-Y', strtotime($rowsql->RD_Dateoftravel)); ?>" name="txtDate[]" id="txtDate<?php echo $rowsql->RD_Id; ?>"/>
                            <input type="hidden" value="<?php echo $rowsql->MOD_Id; ?>" name="selModeofTransp[]"  id="selModeofTransp<?php echo $rowsql->RD_Id; ?>"/>
                            <input type="hidden" value="<?php echo $rowsql->RD_Cityfrom; ?>" name="from[]" id="from<?php echo $rowsql->RD_Id; ?>"/>
                            <input type="hidden" value="<?php echo $rowsql->RD_Cityto; ?>" name="to[]" id="to<?php echo $rowsql->RD_Id; ?>"/>
                            <input type="hidden" value="<?php echo $rowsql->RD_Cost; ?>" name="txtCost[]" id="txtCost<?php echo $rowsql->RD_Id; ?>"/>
                            <input type="hidden" name="ImageUrl" id="ImageUrl" value="<?php echo WPERP_EMPLOYEE_ASSETS;?>">
                            <td data-title="Date" style="width: 9%;">
							<?php
							if ($rowsql->EC_Id == 2 && $rowsql->MOD_Id ==5) {
								echo '<b>ChekIn</b> :' . date('d-M-Y', strtotime($rowsql->RD_Dateoftravel));
								echo '<br><b>CheckOut</b> :' . date('d-M-Y', strtotime($rowsql->RD_EndDate));
							}
							else{
								echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel));
							}
							?>
							</td>
                            <td data-title="Description"><?php echo stripslashes($rowsql->RD_Description); ?></td>
                            <td data-title="Category"><?php echo $rowsql->EC_Name; ?></td>
                            <td data-title="Category"><?php echo $rowsql->MOD_Name; ?></td>
                            <td data-title="Place"><?php
                                if ($rowsql->EC_Id == 1 && $rowsql->MOD_Id !=3) {

                                    echo '<b>From:</b> ' . $rowsql->RD_Cityfrom . '<br />';
                                    echo '<b>To:</b> ' . $rowsql->RD_Cityto;
                                }
                                else if ($rowsql->EC_Id == 1 && $rowsql->MOD_Id ==3) {

                                    echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom . '<br />';
                                    echo '<b>Pickup Time:</b> ' . $rowsql->pickup . '<br />';
                                    echo '<b>Dropoff Time:</b> ' . $rowsql->dropoff;
                                }
								else if ($rowsql->EC_Id == 3) {

                                    echo '<b>Loc:</b> ----------<br />';
									$bookingcost+=$rowsql->RD_Cost;
                                   
                                }
								else {

                                    echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;


                                    if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'"))
                                        echo '<br>Stay :' . $rowsd->SD_Name;
                                }
                                ?>
                                <?php if($freturn && $freturn != "0000-00-00"){ 
								 $freturndate = $rowsql->RD_ReturnDate;
								?>
                                <span class="status-2">Return Journey Included</span>
                                <?php } ?>
                                </td>
								<?php if(!$row->REQ_PreToPostStatus){ ?>
								<td data-title="Upload bills"><?php
                                $selfiles = $wpdb->get_results("SELECT * FROM requests_files WHERE RD_Id='$rowsql->RD_Id'");

                                if (count($selfiles)) {

                                    $j = 1;
                                    foreach ($selfiles as $rowfiles) {
                                        $temp = explode(".", $rowfiles->RF_Name);
                                        $ext = end($temp);

                                        $fileurl = "/erp/modules/company/upload/" . $compid . "/bills_tickets/" . $rowfiles->RF_Name;
                                        ?>
                                        <?php echo $j . ") "; ?><a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download="file-name"><?php echo 'file' . $j . "." . $ext; ?></a><br />
                                        <?php
                                        $j++;
                                    }
                                } else {

                                    echo approvals(5);
                                }
                                ?>
								</td>
								<?php } ?>
                            <?php if($row->REQ_PreToPostStatus){ ?>
                            <td><?php
                                // echo 'Approver='.$approver."<br>";
                                $approver = isApprover();
                                if ($approver) {

                                    if ($empuserid == $row->EMP_Id) {

                                        if ($row->REQ_Status == 2) {
                                            // find out for which and all booking is possible
					    $selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1");
                                            if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {
                                                ?>
                                                <input type="checkbox" <?php
                                                if (!($selrdbs->BS_Status == 2))
                                                    echo 'value="' . $rowsql->RD_Id . '" name="rdid[]" id="rdid[]"';
                                                else
                                                    echo 'disabled="disabled"';
                                                ?>  />
                                                       <?Php
                                                   } else {

                                                       echo '<input type="checkbox" disabled="disabled" />';
                                                   }
                                               } else {

                                                   echo '<input type="checkbox" disabled="disabled" />';
                                               }
                                           } else {

                                               echo '<input type="checkbox" disabled="disabled" />';
                                           }
                                       } elseif (!$approver) {


                                           //echo 'Req status='.$row['REQ_Status']."<Br>"; 


                                           if ($row->REQ_Status == 2) {


                                               // find out for which and all booking is possible

                                               if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {


                                                   /* if this mode is able to book, show checkbox else show n/a status */

                                                   echo '<input type="checkbox" value="' . $rowsql->RD_Id . '" name="rdid[]" id="rdid[]" />';
                                               } else {

                                                   echo '<input type="checkbox" disabled="disabled" />';
                                               }
                                           } else {

                                               echo '<input type="checkbox" disabled="disabled" />';
                                           }
                                       }
                                       ?></td>
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
										
										echo ($selrdbs->BA_Id==1) ? bookingStatus($selrdbs->BA_Id)."<br>": '';
                                            echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

                                            echo '----------------------------------<br>';

                                           //echo bookingStatus($selrdbs->BA_Id);


                                            $seldocs = $wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdbs->BS_Id'");

                                            $doc = NULL;

                                            $f = 1;

                                            foreach ($seldocs as $docs) {

                                                $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link" download>download</a><br>';

                                                $f++;
                                            }



                                            switch ($selrdbs->BA_Id) {
                                                case 2:
													$bookingcount++;
                                                    echo '<br><b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
													$bookingcost+=$selrdbs->BS_TicketAmnt;
                                                    echo $doc;
                                                    echo '<b>Booked Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
                                                    break;

                                                case 3:
													$bookingcount++;
                                                    echo '<br><b>Failed Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
                                                    break;
                                            }
                                        } else {

                                            echo bookingStatus(NULL);
                                        }
                                    }
                                } else {
									if($rowsql->EC_Id == 3){	
									$selfiles = $wpdb->get_results("SELECT * FROM requests_files WHERE RD_Id='$rowsql->RD_Id'");
									
									if (count($selfiles)) {
										$bookingcount++;
										$j = 1;
										foreach ($selfiles as $rowfiles) {
											$temp = explode(".", $rowfiles->RF_Name);
											$ext = end($temp);

											$fileurl=$rowfiles->RF_Name;
											?>
											<?php echo $j.") "; ?><a href="<?php echo $fileurl; ?>" download><?php echo 'file'.$j.".".$ext;  ?></a><br />
											<?php
											$j++;
										}
									} else {
										echo approvals(5);
									}
									}
									else{
										echo approvals(5);
									}
									
								
                                    //echo bookingStatus(NULL);
                                }

                                //}
                                ?></td>
                            <td><?PHP
                                //if($row['REQ_Status']==2){

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
														$calcanc = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");
														$bookingcost-=$calcanc->BS_TicketAmnt;
														$bookingcost+=$selrdbs->BS_CancellationAmnt;
                                                        echo '<br><b>Cancellation Amnt:</b> ' . IND_money_format($selrdbs->BS_CancellationAmnt) . '.00<br>';
                                                        echo $doc;
                                                        echo '<b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate)) . "<br>";
                                                        break;

                                                    case 5: case 7:
														$calcanc = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");
														$bookingcost-=$calcanc->BS_TicketAmnt;
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
                                <?php } ?>
								<td data-title="Estimated Cost"><?php echo $rowsql->RD_Cost ? IND_money_format($rowsql->RD_Cost) . ".00" : approvals(5); ?></td>
                            </tr>
                                <?php
                                //if (!$rowsql->RD_Duplicate)
                                    //$totalcost+=$rowsql->RD_Cost;
                                if (!$rowsql->RD_Duplicate){
                            	//if($rowsql->MOD_Id == 5)
                            	//$totalcost+=$rowsql->RD_Cost*$rowsql->SD_Id;
                            	//else
                                $totalcost+=$rowsql->RD_Cost;
                                }

                                array_push($rdidarry, $rowsql->RD_Id);
                            }
                            ?>
							<tr ><td align="right" colspan="<?php echo $colspan;?>" style="text-align:right;font-weight:bold;">Total Estimated Cost</td><td align="right" colspan="" width="10%" style="font-weight:bold;"><?php echo IND_money_format($totalcost) . ".00"; ?></td></tr>
							<?php
							if(!$bookingcost)
								$bookingcost = "00";
							?>
							<tr ><td align="right" colspan="<?php echo $colspan;?>"  style="text-align:right;font-weight:bold;">Total Cost</td><td align="right" colspan="" width="10%" style="font-weight:bold;"><?php echo IND_money_format($bookingcost) . ".00"; ?></td></tr>
						    </tbody>
							</table>
                        </div>
                    
                    <?php
                    if($row->REQ_PreToPostStatus){
                    $shows = 0;
                    if ($selptc = $wpdb->get_row("SELECT REQ_Id FROM pre_travel_claim WHERE REQ_Id='$reqid'")) {

                        $shows = 1;
                    }
                    //echo 'Current Date='.$row->REQ_Status;
                    if ($seltd = count($wpdb->get_results("SELECT TD_Id FROM travel_desk WHERE COM_Id='$compid'"))) {

                        if (!$shows) {
                        
                            if ($approver/* && $curDate >= $rowsql['RD_Dateoftravel'] */) {

                                //if ($row->EMP_Id == $empuserid) {
                                    ?>
								<?php
								if ($row->EMP_Id == $empuserid) { ?>
									<div class="pull-right">
                                        <div class="row">
											<div class="col-md-4 col-sm-12 col-xs-12"><button type="submit" name="bookTickets" id="bookTickets" class="btn btn-success  btn-block" value="1">Book Tickets</button></div>
											<div class="col-md-4 col-sm-12 col-xs-12"><button type="button" name="buttonSelfbooking1" id="buttonSelfbooking" class="btn btn-primary  btn-block" value="2">Self Booking</button></div>
											<div class="col-md-4 col-sm-12 col-xs-12"><button type="submit" name="cancelTickets"  id="cancelTickets"class="btn btn-danger  btn-block "   value="3">Cancel Tickets</button></div>
										</div>
										
                                        
                                        
                                    </div>
                                    
                                    <?php
                                }
                            } else {

                                if ($row->REQ_Status == 2/* && $curDate >= $rowsql['RD_Dateoftravel'] */) {
                                    ?>
                                    
                                    <div style="float:right;">  
                                        <div class="col-md-4 col-sm-12 col-xs-12"><button type="submit" name="bookTickets" id="bookTickets" class="btn btn-success btn-block" value="1">Book Tickets</button></div>
                                        <div class="col-md-4 col-sm-12 col-xs-12"><button type="button" name="buttonSelfbooking1" id="buttonSelfbooking" class="btn btn-primary  btn-block" value="2">Self Booking</button></div>
                                        <div class="col-md-4 col-sm-12 col-xs-12"><button type="submit" class="btn btn-danger  btn-block" name="cancelTickets" id="cancelTickets" value="3">Cancel Tickets</button></div>`
                                    </div>
                                   
                                    <?php
                                }
                            }
                        }
                    }
                    }
                    ?>
                  <br><br>
                    <?php $paytotd = ""; ?>
                    <?php if($row->REQ_PreToPostStatus): ?>
                    <div class="align-sm-right" style="margin-top:20px;">
                        <?php
                        $view_submit_claim = "
				  <div align=\"right\">
				  	<a  class=\"btn btn-primary\" href=\"admin.php?page=View+Claim&reqid=$reqid\">View Claim</a>
					<!--a  class=\"btn btn-warning\" href=\"admin.php?page=Submit+Claim&reqid=$reqid\">Update Claim</a--></td>
                  		  </div>";

                        $view_claim = "
				  <div align=\"right\">
				  	<a class=\"btn btn-primary\" href=\"admin.php?page=View+Claim&reqid=$reqid\">View Claim</a>
				  </div>";


                        $submit_claim = "
				  <div align=\"right\">
				  <a  class=\"btn btn-success submitcliam\"  href=\"admin.php?page=Submit+Claim&reqid=$reqid\">Submit Claim</a>
				  </div>";


                        $claim_not_submitted = "
				  <div align='right'>
				  	<a  class=\"button-primary button\" href=\"javascript:void(0);\">Claim Not Submitted </a>
				  </div>";


                        $curDate = strtotime($curDate);

                        $dot = strtotime($rowsql->RD_Dateoftravel);

                        /* echo 'curdate='.$curDate."<br>";

                          echo 'date of trv='.$dot."<br>";

                          if($curDate >= $dot){ */
                        $approver=  isApprover();
                        if (!$approver) {

                            if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim where REQ_Id='$reqid'")) {

                                if ($selclaim->PTC_Status != 2) {
                                    echo $view_submit_claim;
                                } else {

                                    echo $view_claim;
                                }
                            } else {
                                if ($row->REQ_Status == 2 && ($row->EMP_Id == $empuserid)) {

                                    echo $submit_claim;
                                }
                            }
                        } else {
                            //if its my request
                            if ($empuserid == $row->EMP_Id) {

                                //if its had gone for claim
                                if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim  where REQ_Id='$reqid'")) {

                                    //if claim is not approved
                                    if ($selclaim->PTC_Status != 2) {

                                        echo $view_submit_claim;
                                    } else {

                                        echo $view_claim;
                                    }
                                } else {
                                    if ($row->REQ_Status == 2){
										$reqcount = count($rdidarry);
										if($reqcount == $bookingcount)
                                        echo $submit_claim;
                                    }
                                }
                            }
                            else {
                                //if its had gone for claim
                                if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim where REQ_Id='$reqid'")) {

                                    echo $view_claim;
                                } else {

                                    //if ($row->REQ_Status == 2)
                                        //echo $claim_not_submitted;
                                }
                            }
                        }

                        //}
                        ?>
                    </div>
                    
                    <?php else: ?>

                    <div style="text-align:right;"> Claim Amount: <b><?php echo IND_money_format($totalcost-$paytotd).".00"; ?></b> </div>
                    <?php endif; ?>
                </form>
<br/>
<br/>
<br/>
            </div>
            <?php
			//Quote Details
			require WPERP_EMPLOYEE_VIEWS . "/quote-details.php";
			?>
            
        <!-- Edit Buttons -->
            <?php require WPERP_EMPLOYEE_VIEWS . '/payment-details.php'; ?>