<?php
require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req.php';
global $wpdb;
$showProCode = 1;
global $empuserid;
global $totalcost;
$rdidarry=array();
$compid = $_SESSION['compid'];
$reqid	=$_GET['reqid'];
$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Claim IS NULL and req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active != 9 AND REQ_Type=3 AND RE_Status=1");
$empuserid = $row->EMP_Id;
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
$selsql=$wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id=$row->REQ_Id AND rd.RD_Type=2 AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
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
<div class="wrap erp travel-desk-request request">

    <div class="erp-single-container">  
          <div class="postbox" id="emp_details">
                
              <div class="inside">
                      <h2><?php _e( 'Individual Employee Request [ with approval ] Details', 'traveldesk' ); ?></h2>
              <!-- Request Details -->
              <?php _e(requestDetails(1)); ?>
			  <?php
                require WPERP_TRAVELDESK_VIEWS."/employee-details.php";
              ?>
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
              <div class="table-responsive" style="margin-top:60px;">
                <!--form id="pre-travel-details" name="input" action="#" method="post"-->
            <table class="table" id="table1">
                  <thead class="thead-inverse">
                    <tr>
                      <th class="column-primary">Date</th>
                      <th class="column-primary">Expense Description</th>
                      <th class="column-primary" colspan="2">Expense Category</th>
                      <th class="column-primary" >Place</th>
                      <?php if($row->REQ_PreToPostStatus){ ?>
                      <th class="column-primary">Select</th>
                      <?php } ?>
                      <th class="column-primary">Booking Status</th>
                      <th class="column-primary">Cancellation Status</th>
					  <th class="column-primary">Estimated Cost</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $j=1;
                    foreach($selsql as $rowsql){
                    ?>
                    <tr>
                      <?php $freturn = $rowsql->RD_ReturnDate; ?>
                      <input type="hidden" id="et" value="1">
                      <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"/>
                      <input type="hidden" name="reqcode" id="reqcode" value="<?php echo $row->REQ_Code?>" />
                      <input type="hidden" name="ImageUrl" id="ImageUrl" value="<?php echo WPERP_EMPLOYEE_ASSETS;?>">
                      <input type="hidden" value="<?php echo date('d-m-Y', strtotime($rowsql->RD_Dateoftravel)); ?>" name="txtDate[]" id="txtDate<?php echo $rowsql->RD_Id; ?>"/>
                    <input type="hidden" value="<?php echo $rowsql->MOD_Id; ?>" name="selModeofTransp[]"  id="selModeofTransp<?php echo $rowsql->RD_Id; ?>"/>
                    <input type="hidden" value="<?php echo $rowsql->RD_Cityfrom; ?>" name="from[]" id="from<?php echo $rowsql->RD_Id; ?>"/>
                    <input type="hidden" value="<?php echo $rowsql->RD_Cityto; ?>" name="to[]" id="to<?php echo $rowsql->RD_Id; ?>"/>
                    <input type="hidden" value="<?php echo $rowsql->RD_Cost; ?>" name="txtCost[]" id="txtCost<?php echo $rowsql->RD_Id; ?>"/>
                      
                      <td data-title="Date" style="width: 9%;"><?php echo date('d-M-Y',strtotime($rowsql->RD_Dateoftravel));?></td>
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
                        } else{

                            echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;
                            if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'"))
                                echo '<br>Stay :' . $rowsd->SD_Name;
                        }

                      ?>
                      <?php if($freturn){ ?>
                      <span class="status-2">Return Journey Included</span>
                      <?php } ?>
                      </td>
                      <?php if($row->REQ_PreToPostStatus){ ?>
                      <!-- Book Tickets -->
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
                               <?php } ?>
                      <!----- BOOKING STATUS STATUS ------>
                      <td><?PHP
                                // if($row['REQ_Status']==2){

                                $imdir = "company/upload/$compid/bills_tickets/";

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

                                                $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="download-file.php?file=' . $imdir . $docs->BD_Filename . '" class="btn btn-link">download</a><br>';

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

                                                    $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="download-file.php?file=' . $imdir . $docs->BD_Filename . '" class="btn btn-link">download</a><br>';

                                                    $f++;
                                                }

                                                switch ($selrdbs->BA_Id) {

                                                    case 4: case 6:
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
								<td data-title="Estimated Cost"><?php  echo $rowsql->RD_Cost ? IND_money_format($rowsql->RD_Cost).".00" :  approvals(5);  ?></td>
                      </tr>
                    <?php
                    if(!$rowsql->RD_Duplicate)
                    $totalcost+=$rowsql->RD_Cost;
		    $j++;
                    array_push($rdidarry, $rowsql->RD_Id);
                    
                   } ?>
				   <tr ><td align="right" colspan="8"  style="text-align:right;font-weight:bold;">Total Estimated Cost</td><td align="right" colspan="" width="10%" style="font-weight:bold;"><?php echo IND_money_format($totalcost) . ".00"; ?></td></tr>
                  </tbody>
                </table>
                    <?php
                    $selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1");
                    if($row->REQ_PreToPostStatus){
                    $shows = 0;
                    //if ($selptc = $wpdb->get_row("SELECT REQ_Id FROM pre_travel_claim WHERE REQ_Id='$reqid'")) {
		    if($selrdbs->BA_Id == 1){	
                        $shows = 1;
                    }
                    //echo 'Current Date='.$row['REQ_Status'];
                    if ($seltd = count($wpdb->get_results("SELECT TD_Id FROM travel_desk WHERE COM_Id='$compid'"))) {
		        
                        if (!$shows) {
                 
                            if ($approver/* && $curDate >= $rowsql['RD_Dateoftravel'] */) {

                                if ($row->EMP_Id == $empuserid) {
                                    ?>
                                    <!--table class="table" style="font-weight:bold;"><tr ><td align="right" width="85%">Total Estimated Cost</td><td align="center" width="5%">:</td><td align="right" width="10%"><?php //echo IND_money_format($totalcost) . ".00"; ?></td></tr></table-->

                                    <div style="float:right;">
                                        <!--button type="submit" name="bookTickets" id="bookTickets" class="button button-primary" value="1">Book Tickets</button-->
                                        <button type="button" name="buttonSelfbooking1" id="buttonSelfbooking" class="btn btn-success" value="2">Book Tickets</button>
                                        <button type="submit" class="btn btn-danger" name="cancelTickets" id="cancelTickets" value="3">Cancel Tickets</button>
                                    </div>
                                    <br />
                                    <br />
                                    <?php
                                }
                            } else {

                                if ($row->REQ_Status == 2/* && $curDate >= $rowsql['RD_Dateoftravel'] */) {
                                    ?>
                                    <br />
                                    <br />
                                    <div style="float:right;">  
                                        <!--button type="submit" name="bookTickets" id="bookTickets" class="button button-primary" value="1">Book Tickets</button-->
                                        <button type="button" name="buttonSelfbooking1" id="buttonSelfbooking" class="button button-primary" value="2">Book Tickets</button>

                                        <!--button type="submit" class="button erp-button-danger" name="cancelTickets" id="cancelTickets" value="3">Cancel Tickets</button-->
                                    </div>
                                    <br />
                                    <br />
                                    <?php
                                }
                            }
                        }
                    }
                    }
                    ?>
                    <p>&nbsp;</p>
                    <?php $paytotd = ""; ?>
                    <div style="text-align:right;"> Claim Amount: <b><?php echo IND_money_format($totalcost-$paytotd).".00"; ?></b> </div>
                    
                </form>
            </div>
            <?php
			//Quote Details
			require WPERP_EMPLOYEE_VIEWS . "/quote-details.php";
			?>
                
                 <!-- Notes -->
        <?php _e(chat_box(3,3));?>  
        </div>
        </div>
    </div>
</div>

<script>

function showHideBooking(flid, bookingActionval)
{
	//alert(flid);
	
	var divcan			=	'amntDiv'+flid;
	var txtAmnt			=	'txtAmount'+flid;	
	var bookingbutton	=	'buttonUpdateStatus'+flid;
	var cancelButton	=	'buttonCancel'+flid;
	var selectOptionval	=	'selectoptionval'+flid;
	var ticketdiv		=	'ticketUploaddiv'+flid;
	var fileattach		=	'fileattach'+flid+'[]';
	
		
	switch(bookingActionval){
		
		case '2': // booked
		document.getElementById(txtAmnt).placeholder ="Booked Amount";
		document.getElementById(txtAmnt).value=null;
		document.getElementById(divcan).style.display='inline';
		document.getElementById(ticketdiv).style.display='inline';
		document.getElementById(fileattach).value=null;
		break;
				
		case '3': // failed to book
		document.getElementById(txtAmnt).value=null;
		document.getElementById(divcan).style.display='none';
		document.getElementById(fileattach).value=null;
		document.getElementById(ticketdiv).style.display='none';
		break;
		
		default: // select
		document.getElementById(divcan).style.display='none';
		document.getElementById(txtAmnt).value=null;
		document.getElementById(fileattach).value=null;
		document.getElementById(ticketdiv).style.display='none';
		document.getElementById(bookingbutton).style.display='none';
		document.getElementById(cancelButton).style.display='none';
		
		
	}		
		
		
		if(bookingActionval){
			document.getElementById(bookingbutton).style.display='inline';
			document.getElementById(cancelButton).style.display='inline';
		}
		
	
}

function showHideCanc(flid, bookingActionval)
{
	var cancAmntDiv		=	'cancAmntDiv'+flid;	
	var txtCancAmnt		=	'txtCanAmount'+flid;
	var ticketCancDiv	=	'ticketCancDiv'+flid;
	var fileCanAttach	=	'fileCanAttach'+flid+'[]';
	var bookingbutton	=	'buttonUpdateStatusCanc'+flid;
	var cancelButton	=	'buttonCancelCanc'+flid;	
	
	//alert(bookingActionval);
	
	switch(bookingActionval){
		
		case '4': case '6':
		document.getElementById(cancAmntDiv).style.display='inline';
		document.getElementById(txtCancAmnt).value=null;
		document.getElementById(txtCancAmnt).placeholder="Cancellation Amount";
		document.getElementById(ticketCancDiv).style.display='inline';
		document.getElementById(fileCanAttach).value=null;
		break;
				
		case '5': case '7':
		document.getElementById(txtCancAmnt).placeholder ="";
		document.getElementById(txtCancAmnt).value=null;
		document.getElementById(cancAmntDiv).style.display='none';
		document.getElementById(fileCanAttach).value=null;		
		document.getElementById(ticketCancDiv).style.display='none';
		break;
		
		
		default:
		document.getElementById(cancAmntDiv).style.display='none';
		document.getElementById(txtCancAmnt).value=null;
		document.getElementById(ticketCancDiv).style.display='none';
		document.getElementById(fileCanAttach).value=null;
		document.getElementById(bookingbutton).style.display='none';
		document.getElementById(cancelButton).style.display='none';
		
		
	}
	
	if(bookingActionval){
	
		document.getElementById(bookingbutton).style.display='inline';
		document.getElementById(cancelButton).style.display='inline';
	
	}
}
</script>
