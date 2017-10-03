<?php
global $wpdb;
$tdcid = $_GET['tdcid'];
//$reqid = $_GET['reqid'];
//echo $tdcid;die;
$compid = $_SESSION['compid'];
$rows = $wpdb->get_row("SELECT * FROM travel_desk_claims WHERE TDC_Id='$tdcid' AND COM_Id='$compid'");
global $rdids;
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.opline{padding:20px;}
.firstbx{background-color:#F8F8F8;padding-top:10px;padding-bottom:10px; border: 1px solid #E1E1E1;}
.dnld{color:#0096A8;}
.dnld:hover{background:#0096A8;color:#fff;border-color:#0096A8 !important;}
.firstbox tr{border: 1px solid #E1E1E1;padding:2em;}
table{width:100%;}
td{padding:10px;}
 
.drop-shadow
{
  background: #FFFFFF;box-shadow: 0 2px 4px 0 rgba(83,83,83,0.50);
}

</style>
<div class="payment">
    <style type="text/css">
        #my_centered_buttons { text-align: center; width:100%;}
    </style>
    <div style="display:none" align="center" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>
    <div style="display:none" align="center" id="success" class="notice notice-success is-dismissible">
        <p id="p-success"></p>
    </div>
    <div class="postbox">
        <div class="inside">
            
            <div class="row">
		<?php
	            $tdbaId = $rows->TDBA_Id;
	            $bank_details = $wpdb->get_row("SELECT TDBA_AccountNumber FROM travel_desk_bank_account WHERE TDBA_Id='$tdbaId'");
                ?>
		<div class="col-md-3 col-sm-3 col-lg-3 "><p class="h3"><?php _e('Claim Details', 'employee'); ?></p><span><?php echo date('d F Y', strtotime($rows->TDC_Date)) ?></span></div>
		
		<div class="col-md-3 col-sm-3 col-lg-3 "><p><table><tbody><tr><td> Reference# </td> <td><input class="form-control input-sm" id="inputsm" value="<?php echo $rows->TDC_ReferenceNo ?>" type="text" disabled></td></tr></tbody></table></p></div>
		
		<div class="col-md-3 col-sm-3 col-lg-3 "><p><table><tbody><tr><td> Invoice# </td> <td><input class="form-control input-sm" id="inputsm" type="text" value="<?php echo $rows->TDC_InvoiceNo ?>" disabled></td></tr></tbody></table></p></div>
		
		<div class="col-md-3 col-sm-3 col-lg-3 "><p><table><tbody><tr><td>Account# </td> <td> <input class="form-control input-sm" id="inputsm" type="text" value="<?php echo $bank_details->TDBA_AccountNumber; ?>" disabled></td></tr></tbody></table></p></div>
		
		
	    </div>

                <br>
                <br>
                <br>
                <!--  /////////////////////////////////////////-->
				
				<div class="bs-example table-responsive">
    <table class="table table-bordered">
        <thead class="thead-inverse">
            <tr>
			  <th>Sl.no. </th>
			  <th>Request Code</th>
			  <th>Quantity</th>
			  <th>Request Date</th>
			  <th>Amount (Rs)</th>
			  <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
		<?php
                    $selsql = $wpdb->get_results("SELECT * FROM travel_desk_claim_requests tdcr, requests req WHERE TDC_Id='" . $tdcid . "' and tdcr.REQ_Id = req.REQ_Id");

                    $totqty = 0;
                    $totalamnt = 0;

                    $i = 1;
                    $j = 1;

                    foreach ($selsql as $rowsql) {
                        ?>
		<tr>
                            <td ><?php echo $i; ?>. </td>
                            <td ><?php echo $rowsql->REQ_Code; ?></td>
                            <?php
								$getvals = $wpdb->get_results("SELECT DISTINCT (rd.RD_Id) FROM request_details rd, booking_status bs WHERE rd.REQ_Id='$rowsql->REQ_Id' AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3)  AND BS_Active=1 AND RD_Status=1");
								foreach ($getvals as $values) {
									
									$rdids.=$values->RD_Id . ",";
									
									$countAll=count($wpdb->get_results("SELECT BS_Id FROM booking_status WHERE RD_Id='$values->RD_Id' AND BS_Active=1"));
									
																		
									if($countAll==2){
									
										if($rowcn=$wpdb->get_results("SELECT BA_Id, BS_CancellationAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=3 AND BS_Active=1")){
										
											if($rowcn[0]->BA_Id==4 || $rowcn[0]->BA_Id==6){
												
												$totalcosts	+=	$rowcn[0]->BS_CancellationAmnt;
											
											}
											
										
										} else {
										
											$rowbk=$wpdb->get_results("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
											
											$totalcosts	+=	$rowbk[0]->BS_TicketAmnt;
										
										}
										
										
									} else {
									
										$rowbk=$wpdb->get_results("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
										
										$totalcosts	+=	$rowbk[0]->BS_TicketAmnt;
									
									}
									
									
									
								}
								
								//echo 'totalcost='.$totalcosts."<br>";

								$rdids = rtrim($rdids, ",");

								if (!$rdids)
								$rdids = "'" . "'";

                              // echo 'Reqids='.$rdids;
							   
							   $totqty += count($getvals);
							   
							   
							   $totalamnt	+=	$totalcosts;
							   
                                                            ?>
                            <td><?php echo count($getvals);  ?></td>
                            <td><?php  echo date('d-M-Y', strtotime($rowsql->REQ_Date)) ?></td>
                            <td><?php echo IND_money_format($totalcosts). ".00"; $totalcosts = NULL ; ?></td>
                            <td><a class="traveldeskrequestarrow" data-id="<?php echo $rowsql->REQ_Id;?>" data-toggle="collapse" href="#collapse"><i class="collapse-caret fa fa-angle-down" style="font-size: 18px; border-radius:50%; background: #0073aa; padding: 1px 5px; color: #fff;"></i> </a> </td>
                          </tr>
					
			<tr>
			<td colspan="6">
			<table class="hide-table<?php echo $rowsql->REQ_Id;?> invoice-details table-bordered table collapse" style="font-size:11px;">
                            <thead class="thead-inverse">
                              <tr>
                                <th>Date</th>
                                <th>Expense Description</th>
                                <th colspan="2">Expense Category</th>
                                <th>Place</th>
                                <th>Estimated Cost</th>
                                <th>Booking Status</th>
                                <th>Cancellation Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
							$rddetails = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mo WHERE REQ_Id='$rowsql->REQ_Id' AND rd.RD_Id IN($rdids) AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mo.MOD_Id AND RD_Status=1 ORDER BY RD_Id ASC");

							$rdids = "";
							
							foreach ($rddetails as $rowdetails) {
								?>
                              <tr>
                                <td><?php 
								
								echo date('d-M-Y', strtotime($rowdetails->RD_Dateoftravel)); 
								
								?></td>
                                <td><?php echo stripslashes($rowdetails->RD_Description); ?></td>
                                <td><?php echo $rowdetails->EC_Name; ?></td>
                                <td><?php echo $rowdetails->MOD_Name; ?></td>
                                <td><?php 
					
									if($rowdetails->EC_Id==1) {
										
										echo '<b>From:</b> '.$rowdetails->RD_Cityfrom.'<br />
										<b>To:</b> '.$rowdetails->RD_Cityto;						
									
									} else {
									
										echo '<b>Loc:</b> '.$rowdetails->RD_Cityfrom;
										
										if ($rowsd=$wpdb->get_results("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowdetails->SD_Id'")) {
										
											echo '<br>Stay :'.$rowsd->SD_Name;
												
										}
									
									}
						
						?></td>
                                <td><?php echo IND_money_format($rowdetails->RD_Cost) . ".00"; ?></td>
								
								
								
                                <!----- BOOKING STATUS STATUS ------>
                                <td><?php
								
								
								$selrdbs = $wpdb->get_results("SELECT * FROM booking_status WHERE RD_Id='$rowdetails->RD_Id' AND BS_Status=1 AND BS_Active=1");

						if ($selrdbs[0]->RD_Id) {
						
							echo ($selrdbs[0]->BA_Id == 1) ? bookingStatus($selrdbs[0]->BA_Id) . "<br>" : '';

							echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs[0]->BS_Date)) . "<br>";

							echo '----------------------------------<br>';

							$query = "BA_Id IN (2,3)";
						}

					   

							echo bookingStatus($selrdbs[0]->BA_Id);

							//echo 'baid='.$selrdbs['BA_Id'];

							//$imdir = "../company/upload/$cmpid/bills_tickets/";


$imdir = WPERP_COMPANY_DOWNLOADS .'/company/upload/'. $cmpid .'/bills_tickets/';	
							



							switch ($selrdbs[0]->BA_Id) {

								case 2:
									$doc = NULL;
								
									$seldocs = $wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='". $selrdbs[0]->BS_Id ."'");
	
									$f = 1;
	
									foreach ($seldocs as $docs) {
	
										$doc.='<b>Uploaded File no. ' . $f . ': </b> <a download="bills_tickets" href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link">download</a><br>';
	
										$f++;
									}
									echo '<br>';
									echo '<b>Booked Amnt:</b> ' . IND_money_format($selrdbs[0]->BS_TicketAmnt) . '.00</span><br>';
									echo $doc;
									echo '<b>Booked Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdbs[0]->BA_ActionDate));
									break;

								case 3:
									echo '<br>';
									echo '<strong>Failed Date</strong>: ' . date('d-M-y (h:i a)', strtotime($selrdbs[0]->BA_ActionDate));
									break;
							}
											
											?>
                                </td>
                                <!----- CANCELLATION STATUS ------>
                                <td><?php
								
								$selrdcs = $wpdb->get_results("SELECT * FROM booking_status WHERE RD_Id='$rowdetails->RD_Id' AND BS_Status=3 AND BS_Active=1");
								if(!empty($selrdcs->RD_Id))	{
								if ($selrdcs->RD_Id) {
		
									echo ($selrdcs->BA_Id == 1) ? bookingStatus($selrdcs->BA_Id) . "<br>" : '';
		
									echo '<b title="cancellation request date">Request Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdcs->BS_Date)) . "<br>";
		
									echo '----------------------------------<br>';
		
									$query = "BA_Id IN (4,5)";
								}
								}
		if(!empty($selrdcs->BA_Id))	{
							echo bookingStatus($selrdcs->BA_Id);

							


							switch ($selrdcs->BA_Id) {

								case 4: case 6:
									
									$doc = NULL;
								
									$seldocs = select_all("booking_documents", "*", "BS_Id='$selrdcs[BS_Id]'", $filename, 0);
	
									$f = 1;
	
									foreach ($seldocs as $docs) {
	
										$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="download-file.php?file=' . $imdir . $docs['BD_Filename'] . '" class="btn btn-link">download</a><br>';
	
										$f++;
									}
									
									echo '<br><b>Cancellation Amnt</b>: ' . IND_money_format($selrdcs['BS_CancellationAmnt']) . '.00<br>';
									echo $doc;
									echo '<b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs['BA_ActionDate']));
									break;

								case 5: case 7:
									echo '<br><b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs['BA_ActionDate']));
									break;
							}
											
		}                                                 
                                                            ?>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
						  <?php 
						  $i++;
						  } ?>
			</td>
			</tr>
			
        </tbody>
    </table>
</div>

                <!-- ////////////////////////////////////////-->
                <br>
                <br>
                <div class="row" style="border-bottom: 1px solid #eee;border-top: 1px solid #eee;">
                  
	                <div class="col-md-4 col-sm-4"><h3>Remarks</h3>
				<div class="firstbx">
				<p class="padding10">&nbsp;<?php echo stripslashes($rows->TDC_Remarks) ?></p>
		        </div>
		
		</div>
		<?php
        if ($rows->TDC_Status == 1 && $rows->TDC_Level == 2) {
        ?>
	<div class="col-md-4 col-sm-4"><h3>Payment Details</h3>
	<div >
	
	
	<table class="firstbx">
	<tr>
	<td><p>Payment mode</p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><select class="form-control" name="selPaymentMode" id="selPaymentMode" required>
	        <option value="">Select</option>
	        <?php
	        $selsql = $wpdb->get_results("SELECT * FROM payment_modes");
	        foreach ($selsql as $rowsql) {
	            ?>
	            <option value="<?php echo $rowsql->PM_Id; ?>"  ><?php echo $rowsql->PM_Name; ?></option>
	        <?php } ?>
	    </select></p></td></td>
	</tr>
	
	<tr class="chequeid" style="display:none;"><td><p>Cheque # </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber"   /></p></td></tr>
	
	<tr class="chequeid" style="display:none;"><td><p>Cheque Date </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p>
                                        <input type="text"  name="txtCqDate" id="txtCqDate" class="erp-date-field" placeholder="dd/mm/yyyy" autocomplete="off"/></p></td></tr>
	
	<tr class="chequeid" style="display:none;"><td><p>Issuing Bank </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch"  /></p></td></tr>
	
	
	<tr class="cashid" style="display:none;"><td><p>Payment Details </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><textarea class="form-control" data-height="auto" name="txtaCshComments" id="txtaCshComments" ></textarea></p></td></tr>
	
	
	<tr class="banktransferid" style="display:none;"><td><p>Transaction Id </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtTransId" id="txtTransId"  /></p></td></tr>
	
	<tr class="banktransferid" style="display:none;"><td><p>Bank Name </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails" /></p></td></tr>
	
	<tr class="banktransferid" style="display:none;"><td><p>Transaction Date </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" name="txtBBDate" id="txtBBDate" class="erp-date-field" placeholder="dd/mm/yy" ></p></td></tr>
	
	<tr class="othersid" style="display:none;"><td><p>Payment Details </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><textarea class="form-control" data-height="auto" name="txtaOtherComments" ></textarea></p></td></tr>
		
	<tr><td><p><button name="accTdClaimed" id="accTdClaimed" class="button button-primary"  type="submit">Submit</button></p></td> <td><p>&nbsp;&nbsp;</p></td> <td><p><button type="reset" class="button erp-button-danger" >Cancel</button></p></td></tr>
	</table>
	</div>
	</div>
	
            <?php
        } else if ($rows->TDC_Status == 2) {

	            $selrow = $wpdb->get_row("SELECT * FROM travel_desk_claim_payments tdcp, payment_modes pm Where TDC_Id='$tdcid' AND TDCP_Status=1 and tdcp.PM_Id=pm.PM_Id");
	            //print_r($selrow);
	            //die;
	            //echo '<div class="col-lg-633" align="center"> <a href="javascript:void(0);" class="button button-primary">Request Claimed on ' . date("d/m/y", strtotime($selrow->TDCP_AddedDate)) . '</a> </div> ';
                ?>
                
                <div class="col-md-4 col-sm-4">
                <h3>Payment Details : &nbsp;<button name="buttonedit" id="buttonedit" class="btn btn-warning" type="button" >Edit</button></h3>
			<div id="paymentdetailsreload">
			<div id="detailsformid">
			<table class="firstbx">
			<tr style="display:block;">
			<td><p>Payment mode</p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo $selrow->PM_Name; ?></p></td></td>
			</tr>
			<tr <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Cheque No # </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_ChequeNumber) ? $selrow->TDCP_ChequeNumber : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Cheque Date </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_ChequeDate) ? $selrow->TDCP_ChequeDate : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Issuing Bank </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_ChequeIssuingbb) ? $selrow->TDCP_ChequeIssuingbb : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Payment Details </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_CashPaymentDetails) ? $selrow->TDCP_CashPaymentDetails : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Transaction Id </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_BTTransactionId) ? $selrow->TDCP_BTTransactionId : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Bank Name </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_BTBankDetails) ? $selrow->TDCP_BTBankDetails : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Transaction Date </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_BTTransferDate) ? $selrow->TDCP_BTTransferDate : ''; ?></p></td></tr>
			
			<tr <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Payment Details </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo ($selrow->TDCP_OthersPaymentDetails) ? $selrow->TDCP_OthersPaymentDetails : ''; ?></p></td></tr>
			</table>
			</div>
			
			
			
			<!-- update form -->
			
			<div id="updateformid" style="display:none;">
                            <table class="firstbx">
				<tr style="display:block;">
				<td><p>Payment mode</p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><select class="form-control" name="selPaymentMode" id="selPaymentMode" required>
				        <option value="">Select</option>
				        <?php
				        $selsql = $wpdb->get_results("SELECT * FROM payment_modes");
				        foreach ($selsql as $rowsql) {
				            ?>
				            <option value="<?php echo $rowsql->PM_Id; ?>" <?php echo ($selrow->PM_Id == $rowsql->PM_Id) ? 'selected="selected"' : ''; ?> ><?php echo $rowsql->PM_Name; ?></option>
				        <?php } ?>
				    </select></p></td></td>
				</tr>
				<input type="hidden" value="<?php echo $tdcid; ?>" name="tdcid" id="tdcid" >
				<tr class="chequeid" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Cheque No# </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber"  <?php echo ($selrow->TDCP_ChequeNumber) ? 'value="' . $selrow->TDCP_ChequeNumber . '"' : ''; ?> /></p></td></tr>
				
				<tr class="chequeid" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Cheque Date </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p>
			                                        <input type="text" name="txtCqDate" id="txtCqDate" class="erp-date-field"  placeholde="dd/mm/yy" <?php echo ($selrow->TDCP_ChequeDate) ? 'value="' . $selrow->TDCP_ChequeDate . '"' : ''; ?>></p></td></tr>
				
				<tr class="chequeid" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Issuing Bank </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch"  <?php echo ($selrow->TDCP_ChequeIssuingbb) ? 'value="' . $selrow->TDCP_ChequeIssuingbb . '"' : ''; ?>/></p></td></tr>
				
				
				<tr class="cashid" <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Payment Details </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><textarea class="form-control" data-height="auto" name="txtaCshComments" id="txtaCshComments" style="width: 30%;" ><?php echo ($selrow->TDCP_CashPaymentDetails) ? stripslashes($selrow->TDCP_CashPaymentDetails) : ''; ?></textarea></p></td></tr>
				
				
				<tr class="banktransferid" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Transaction Id </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtTransId" id="txtTransId"  <?php echo ($selrow->TDCP_BTTransactionId) ? 'value="' . $selrow->TDCP_BTTransactionId . '"' : ''; ?>/></p></td></tr>
				
				<tr class="banktransferid" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Bank Name </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  <?php echo ($selrow->TDCP_BTBankDetails) ? 'value="' . $selrow->TDCP_BTBankDetails . '"' : ''; ?>/></p></td></tr>
				
				<tr class="banktransferid" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Transaction Date </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><input type="text" name="txtBBDate" id="txtBBDate" class="erp-date-field"  placeholder="dd/mm/yy" <?php echo ($selrow->TDCP_BTTransferDate) ? 'value="' . $selrow->TDCP_BTTransferDate . '"' : ''; ?>></p></td></tr>
				
				<tr class="othersid" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>><td><p>Payment Details </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><textarea class="form-control" data-height="auto" name="txtaOtherComments" ><?php echo ($selrow->TDCP_OthersPaymentDetails) ? stripslashes($selrow->TDCP_OthersPaymentDetails) : ''; ?></textarea></p></td></tr>
					
				<tr style="display:block;"><td><p><button name="accTdClaimed" id="accTdClaimed" class="button button-primary" type="submit" >Update</button></p></td> <td><p>&nbsp;&nbsp;</p></td> <td><p><button type="reset" id="resetupdateform" class="button">Cancel</button></p></td></tr>
				</table>
			
			</div>
			
			
			
			<!-- update form -->
			
			
			
			
			</div>
		</div>
                <?php } ?>
                
                
                
                
                
                <div class="col-md-4 col-sm-4">
		        <div >
	                <?php if ($rows->TDC_Level == 1 || $rows->TDC_Level == 3): ?>
	                <div class=""><h3>Claim status : &nbsp;<button type="button" class="btn btn-warning">Pending</button></h3>
	                <? else: ?>
	                <div class=""><h3>Claim status : &nbsp;<button type="button" class="btn btn-success">Approved</button></h3>
	                <? endif; ?>
	                <table class="firstbx">
			<tbody><tr><td><p> Total Quantity </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo $totqty; ?></p></td></tr>
			<?php
	                    $servTax = $rows->TDC_ServiceCharges * ($rows->TDC_ServiceTax / 100);
	                ?>
			<tr><td><p> Service Tax </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p> <?php echo $servTax ?></p></td></tr>
			
			<tr><td><p> Service Charge </p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo $rows->TDC_ServiceCharges; ?></p></td></tr>
			<?php
			$servTaxarr = explode(".", $servTax);
			$servTax = $servTaxarr[0];
			$servTaxend = $servTaxarr[1];
			?>
			<tr><td><p> Booking Amount</p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo IND_money_format($totalamnt); ?></p></td></tr>
			<tr><td><p> Total Amount</p></td> <td><p>&nbsp;:&nbsp;</p></td> <td><p><?php echo IND_money_format($totalamnt + $servTax + $claimsview->TDC_ServiceCharges) . "." . $servTaxend; ?></p></td></tr>
			</tbody></table>
	                </div>
	                
		</div>
		<br>
		<div class="row">
		
		<?php  $fileurl = "/erp/modules/company/upload/" . $compid . "/bills_tickets/" . $rows->TDC_Filename; ?>
		
                        <div class="col-md-12"><a href=" <?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>"  download="file-name"><span style="color: red;"><button class="btn btn-default dnld pull-right"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download Invoice</button></a></div>
                </div>
                </br>
                        <!--<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>-->
                        <!--<a href="#" class="btn btn-theme-inverse hidden-print"> SAVE </a>-->
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php
            $selq = $wpdb->get_row("SELECT * FROM travel_desk_claims_notes WHERE TDC_Id=$tdcid");

            if (count($selq) > 0) {
                ?>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <h4>Notes</h4>
                        <hr>
                        <dd id="sumitnotes">
                            <?php
                            foreach ($selq as $results):

                                switch ($results->TDCN_Type):

                                    case 1:
                                        echo '<dl><b>Finance: </b>' . stripslashes($results->TDCN_Text) . '<br><span style="font-size:9px;">' . date('d/m/y h:i a', strtotime($results->TDCN_Date)) . '</span></dl>';
                                        break;

                                    case 2:
                                        echo '<dl><b>Travel Desk: </b>' . stripslashes($results->TDCN_Text) . '<br><span style="font-size:9px;">' . date('d/m/y h:i a', strtotime($results->TDCN_Date)) . '</span></dl>';
                                        break;

                                endswitch;

                            endforeach;
                            ?>
                        </dd>
                    </div>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
           
			<div class="col-md-12">
			<?php
            if ($rows->TDC_Status == 1) {
                e(chat_box(2, ''));
            }
            ?>
			</div>
            
	    <input type="hidden" value="<?php echo $tdcid; ?>" name="tdcid" id="tdcid" >
            <div class="clearfix"></div>
           <p>&nbsp;</p>
            <?php if ($rows->TDC_Level == 1 || $rows->TDC_Level == 3) { ?>
                <div  class="traveldeskactions col-md-12"  style="text-align:center;">
				<button type="submit" name="buttontdclaimApproval" id="buttontdclaimApproval" class="btn btn-primary">Approve</button>
				<button type="submit" name="buttontdclaimRejection" id="buttontdclaimRejection" class="btn btn-danger">Reject</button></div>
            </div>
            <?php
        }
	?>
	
	
	<?php
        
        if ($rows->TDC_Status == 2) {

            $selrow = $wpdb->get_row("SELECT * FROM travel_desk_claim_payments tdcp, payment_modes pm Where TDC_Id='$tdcid' AND TDCP_Status=1 and tdcp.PM_Id=pm.PM_Id");
            //print_r($selrow);
            //die;
            echo '<div class="col-lg-633" align="center"> <a href="javascript:void(0);" class="btn btn-success">Request Claimed on ' . date("d/m/y", strtotime($selrow->TDCP_AddedDate)) . '</a> </div> ';
            ?>
            
           
    <input type="hidden" name="action" id="erp-payment-action" value="payment_details_create"> 
    <input type="hidden" name="action" id="erp-approve-action" value="traveldesk_approve_request">
    <input type="hidden" name="action" id="erp-reject-action" value="traveldesk_reject_request"> 

<?php } ?>