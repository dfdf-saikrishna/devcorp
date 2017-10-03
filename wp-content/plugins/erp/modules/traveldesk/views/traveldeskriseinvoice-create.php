<style>
.invoice-details{
display:none;
}
</style>
<?php 
$cmpid = $_SESSION['compid'];
$tdid = $_SESSION['tdid'];
$reqids = $_REQUEST['reqid'];
$comrow	=	companyDetails('COM_LOGO, COM_Name', $cmpid);
?>
<script type="text/javascript">
    window.wpErpCurrenttdriseinvoiceview = <?php echo json_encode( $tdriseinvoiceview->to_array() ); ?>
</script>
<script type='text/javascript' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="postbox">
    <div class="inside">
    <div class="wrap" id="wp-erp">
            <h2><?php echo $comrow[0]->COM_Name; ?> - Invoices</h2>
            <label class="color">Send for<strong> Invoices </strong></label>
          </header>
          <form class="form-horizontal" method="post" id="tdinvoiceForm" name="invoiceForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $reqids; ?>" name="reqids" />
            <input type="hidden" value="<?php echo $cmpid; ?>" name="cmpid" />
            <input type="hidden" value="<?php echo $tdid; ?>" name="tdid" />
			
			<!---- header --->
			
			<div class="filter-top">
			
			<div class="row">
			<div class="col-md-10">
				<input type="text" class="form-control" name="txtInvoiceNo" id="txtInvoiceNo" placeholder="Invoice No">
			</div>
			
			<div class="col-md-2">
				<input type="file" name="fileattach" id="fileattach" required>
			</div>
			
			</div>
		
		</div>
			
			<!-- header -->
			
			
			
			<div class="erp-area-right erp-hide-print col-md-3" style="float:right; border:1px solid #cacaca; height:200px; border-radius:5px; margin-top:35px;" >
     
                      <h4 style="margin-top: -12px; text-align:center; background: white; width: 170px; text-transform: uppercase;">Payment Details</h4>
          
                    <strong>Service Tax:</strong>
                    
                      <div class="input-group">
                        <input type="text" class="form-control calcInvoiceAmnt" parsley-type="number" <?php /*?> parsley-required="true"<?php */?> name="txtServiceTax" id="txtServiceTax" maxlength="6">
                        <span class="input-group-addon">&nbsp;%&nbsp;</span> </div>
                   
                    
                    <br />
                    <strong>Service Charges:</strong>
                   
                      <div class="input-group">
                        <input type="text" class="form-control calcInvoiceAmnt" parsley-type="digits"<?php /*?> parsley-required="true"<?php */?> name="txtServiceChrgs" id="txtServiceChrgs" maxlength="6">
                        <span class="input-group-addon">.00</span> </div>
                
                    
					<div class="col-sm-12">
					<br />
                      <div class="form-group">
                        <button type="button" class="btn btn-primary pull-right" name="buttonCalculate" id="buttonCalculate">calculate</button>
                      </div>
                    </div>
                    <br />
                    
                    <br />
                     <input type="hidden" name="txtAccNo" id="txtAccNo" value="<?php echo $bank_details[0]->TDBA_Id; ?>" />
                  </div>
				  
					
				  
				  
				  
				  
            
			  <?php 
			  global $wpdb;
			  $tduserid =$_SESSION['tdid'];
				// select bank details of travel agentl
				$selba = $wpdb->get_results(" SELECT TDBA_Id, TDBA_AccountNumber FROM travel_desk_bank_account WHERE  TD_Id='$tduserid' AND  TDBA_Status=1"); 
				
				$bank_details = $selba;
				
				if(empty($bank_details)){ 
					
					echo '<div class="alert alert-info">
							Sorry. You haven\'t assigned any bank account to this company. Please Assign one and create your invoice.
							</div>';
				
				} else {
			  ?>
              <div class="invoice">
                <!--<div class="row">
                
                  <?php 
				  
				if($comrow['COM_LOGO'])
				echo '<img alt="" src="../admin/'.$comrow[0]->COM_LOGO .'> ';
				
				
				?>
                </div>-->
                
                
                  
                </div>
                <br>
                <br>
                <?php
				global $wpdb;
				$selsql = $wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$cmpid' AND req.REQ_Id IN ($reqids) AND req.REQ_Id=rd.REQ_Id  AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC LIMIT 0, 101");
				//print_r($selsql);
				if (!empty($selsql)) {
    ?>
                <div class="panel-group col-md-9 col-sm-12">
                 <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="thead-inverse">
                        <tr height="35">
                          <th style="text-align:left;">Sl.no. </th>
                          <th style="text-align:left; padding-left:5px;">Request Code</th>
                          <th style="text-align:left;">Quantity</th>
                          <th>Date</th>
                          <th style="text-align:left; padding-left:35px;">Amount (Rs)</th>
                          <th style="text-align:left; padding-left:5px;">&nbsp;</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <?php
				
				$i=1;
				
				$totqty=0;
				
				$totalamnt=0; $totalcosts=0;
				foreach ($selsql as $rowsql) {
					?>
                  
				  
                      <div class="table-responsive">
                        <table class="table" onmouseover="this.style.fontWeight='bold'" onmouseout="this.style.fontWeight='normal'">
                          <tr>
                            <td  width="10%"><?php echo $i; ?>. </td>
                            <td  width="25%"><?php echo $rowsql->REQ_Code; ?></td>
                            <?php
								$getvals = $wpdb->get_results("SELECT DISTINCT (rd.RD_Id) FROM request_details rd, booking_status bs WHERE rd.REQ_Id='$rowsql->REQ_Id' AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3)  AND BS_Active=1 AND RD_Status=1");
								$rdids="";
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
                            <td width="10%" style="text-align:center;"><?php echo count($getvals);  ?></td>
                            <td width="35%" style="text-align:center; padding-left:30px;"><?php  echo date('d-M-Y', strtotime($rowsql->REQ_Date)) ?></td>
                            <td width="20%" style="text-align:center;"><?php echo IND_money_format($totalcosts). ".00"; $totalcosts = NULL ; ?></td>
                            <td><a class="traveldeskrequestarrow" data-id="<?php echo $rowsql->REQ_Id;?>" data-toggle="collapse" href="#collapse"><i class="collapse-caret fa fa-angle-down"></i> </a> </td>
                          </tr>
                        </table>
						
						
                      
                          <table class="hide-table<?php echo $rowsql->REQ_Id;?> invoice-details table table-bordered table-hover collapse" style="font-size:11px;">
                            <thead>
                              <tr>
                                <th width="10%">Date</th>
                                <th width="20%">Expense<br />
                                  Description</th>
                                <th width="10%" colspan="2">Expense <br />
                                  Category</th>
                                <th width="10%">Place</th>
                                <th width="10%">Estimated <br />
                                  Cost</th>
                                <th width="20%">Booking Status</th>
                                <th  width="20%">Cancellation <br />
                                  Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
							$rddetails = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mo WHERE REQ_Id='$rowsql->REQ_Id' AND rd.RD_Id IN($rdids) AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mo.MOD_Id AND RD_Status=1 ORDER BY RD_Id ASC");
							
							$rdids = "";

							foreach ($rddetails as $rowdetails) {
								?>
                              <tr>
                                <td align="center"><?php 
								
								echo date('d-M-Y', strtotime($rowdetails->RD_Dateoftravel)); 
								
								?></td>
                                <td><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowdetails->RD_Description); ?></div></td>
                                <td width="5%"><?php echo $rowdetails->EC_Name; ?></td>
                                <td width="5%"><?php echo $rowdetails->MOD_Name; ?></td>
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
                                <td align="right"><?php echo IND_money_format($rowdetails->RD_Cost) . ".00"; ?></td>
								
								
								
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
                              <?php
                                                         
                                                        }
                                                        ?>
                            </tbody>
                          </table>
                 
                    <!-- //panel-collapse -->
                  </div>
                  <?php
                                    $i++;
                                }
								
								
								//echo 'count of tickets='.$j;
								
								
								

                                //mysqli_free_result($ressql); 
                                ?>
                  <!-- //panel -->
                  <input type="hidden" name="hiddenTickets" id="hiddenTickets" value="<?php echo $totqty; ?>"  />
                </div>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-9">
                    <!-- <div class="align-lg-left"> 795 Park Ave, Suite 120 <br>
                      San Francisco, CA 94107 <br>
                      P: (234) 145-1810 <br>
                      Full Name <br>
                      first.last@email.com </div>-->
                  </div>
                 
					
				 
				 
				 
                    <div class="erp-area-right erp-hide-print col-md-3" style="padding-left:0px;" >
					<hr>
					<h4>PAYMENT SUMMARY</h4>
					
					  <div>
                        <div style="display: block; background: #f4f6fb; padding: 10px 5px; border:1px solid #cacaca; border-bottom:0px;"> 
							Total Quantity: 
							<strong class="pull-right" style="width:40%; border-left:1px solid #cacaca; "><?php echo $totqty; ?></strong> 
						</div>
						<div style="display: block; background: #f4f6fb; padding: 10px 5px; border:1px solid #cacaca; border-bottom:0px;"> 
							Booking Amount: 
							<strong class="pull-right" style="width:40%; border-left:1px solid #cacaca; "><?php echo IND_money_format($totalamnt). '.00'; ?></strong> 
						</div>
                        <div style="display:none; background: #f4f6fb; padding: 10px 5px;  border:1px solid #cacaca; border-bottom:0px;" id="servicetaxlistid">
							Service Tax: 
							<strong class="pull-right" style="width:40%; border-left:1px solid #cacaca; " id="servicetaxid"></strong>
						</div>
                        <div style="display:none; background: #f4f6fb; padding: 10px 5px;  border:1px solid #cacaca; border-bottom:0px;" id="serviceamntlistid">
							Service Charges: 
							<strong class="pull-right" style="width:40%; border-left:1px solid #cacaca; "id="servicechargesid"></strong>
						</div>
                        <div style="display: block; background: #2b3244; color:#fff; padding: 10px 5px;"> 
							Total amount: 
							<strong class="pull-right" id="totalamountid"><?php echo IND_money_format($totalamnt). '.00'; ?></strong> 
						</div>
						
                        <input type="hidden" name="totalAmount" value="<?php echo $totalamnt; ?>" id="totalAmount" />
                        <!--  <li> Discount: ----- </li>
                        <li> Grand Total: <strong>$3,485</strong> </li>-->
                      </div>
                      <br>
                      <!--<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>-->
                      <!--<a href="#" class="btn btn-theme-inverse hidden-print"> SAVE </a>-->
                    </div>
						
                 
                </div>
                
                 
                  <div class="col-md-12">
                    <div class="form-group">
					<hr>
                      <h4>Remarks</h4>
					<div>
                        <textarea data-height="auto" name="txtaRemarks" id="txtaRemarks" class="form-control"></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 pull-right">
                    <div class="form-group">		
					<input type="hidden" value="1" name="claimsSubmitsss">
                   <button type="submit" name="claimsSubmitsss-invoice" id="claimsSubmit" onclick="this.disabled=true; this.value='Sending...'; invoiceForm.submit();" class="btn btn-success">Send for Claims</button>
					 <input type="hidden" name="action" id="traveldeskclaims_create" value="traveldeskclaims_create">
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
			  
			  <?php }  ?>
			  
            </div>
			</form>
        </section>
      </div>
    </div>
    <!-- //content > row > col-lg-8 -->
    <!-- //content > row > col-lg-4 -->
    <!-- //content > row-->
  </div>
  <!-- //content-->
</div>
<!-- //main-->
<!--
		/////////////////////////////////////////////////////////////////
		//////////     RIGHT NAV MENU     //////////
		/////////////////////////////////////////////////////////////
		-->
<!-- //nav right menu-->
<!-- //wrapper-->



                    <?php //do_action( 'erp_hr_employee_single_after_info', $companyview ); ?>

                </div><!-- .erp-profile-top -->

               

                <?php //do_action( 'erp_hr_employee_single_bottom', $companyview ); ?>

            </div><!-- #erp-area-left-inner -->
        </div><!-- .leads-left -->
    </div><!-- .erp-leads-wrap -->
	</div>










