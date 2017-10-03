<?php
global $wpdb;
$tdcid = $_GET['tdcid'];
//$reqid = $_GET['reqid'];
//echo $tdcid;die;
$compid = $_SESSION['compid'];
$comrow = companyUserDetails("COM_Name", $compid);
$rows = $wpdb->get_row("SELECT * FROM travel_desk_claims WHERE TDC_Id='$tdcid' AND COM_Id='$compid'");
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div id="main">
  <div id="content">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading sm" data-color="theme-inverse">
            <h2>Invoice Details - <?php echo $comrow->COM_Name; ?></h2>
          </header>
          <div class="panel-body">
            <div class="invoice">
              <div class="row">
                <?php if($msg) echo $msg; ?>
                <div class="col-sm-6">
                  <h4>Reference NO. #<?php echo $rows->TDC_ReferenceNo?></h4>
                  <span><?php echo date('d F Y', strtotime($rows->TDC_Date))?></span> </div>
                <div class="col-md-6 align-lg-right">
                  <div class="col-sm-12">
                    <h4>Payment Details :</h4>
                  </div>
                  <div class="col-sm-8"> <strong>Service Tax:</strong> </div>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <input type="text" class="form-control" parsley-type="number" parsley-required="true" name="txtServiceTax" id="txtServiceTax" readonly="readonly" value="<?php echo $rows->TDC_ServiceTax?>">
                      <span class="input-group-addon">&nbsp;%&nbsp;</span> </div>
                  </div>
                  <div class="clearfix"></div>
                  <br />
                  <div class="col-sm-8"> <strong>Service Charges:</strong> </div>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <input type="text" class="form-control" parsley-type="digits" parsley-required="true" name="txtServiceChrgs" id="txtServiceChrgs" readonly="readonly" value="<?php echo $rows->TDC_ServiceCharges / $rows->TDC_Quantity; ?>">
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="clearfix"></div>
                  <br />
                  <div class="col-sm-8"> <strong>Account No:</strong> </div>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <?php
                      
					  $bank_details=$wpdb->get_row("SELECT TDBA_AccountNumber FROM travel_desk_bank_account WHERE TDBA_Id='$rows->TDBA_Id'");
					  ?>
                      <input type="text" class="form-control"  name="txtAccNo" id="txtAccNo" readonly="readonly" parsley-required="true" value="<?php echo $bank_details->TDBA_AccountNumber; ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"> </div>
              <hr>
              <br>
              <br>
              <!--  /////////////////////////////////////////-->
              <div class="panel-group">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr height="35">
                        <th width="10%" style="text-align:left;">Sl.no. </th>
                        <th width="25%" style="text-align:left; padding-left:5px;">Request Code</th>
                        <th width="10%" style="text-align:left;">Quantity</th>
                        <th width="35%" >Date</th>
                        <th width="20%" style="text-align:left;">Amount (Rs)</th>
                        <th width="5%" style="text-align:left; padding-left:5px;">&nbsp;</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <?php
			  
			  
			  $selsql=$wpdb->get_results("SELECT * FROM travel_desk_claim_requests tdcr, requests req WHERE TDC_Id=$tdcid and tdcr.REQ_Id = req.REQ_Id");
			  
			  
				
				$totqty=0; $totalamnt=0;
			  
				$i=1; $j = 1;

				foreach ($selsql as $rowsql) {
				
					
					
					
					switch($rowsql->REQ_Active){
					
						case 1:	
							$reqcode = $rowsql->REQ_Code;								
						break;
						
						case 9:
							$reqcode = '<i title="Removed Request">'.$rowsql->REQ_Code.'</i>';
						break;
						
					
					}
				
				
					?>
                <div class="panel panel-shadow">
                  <header class="panel-heading" style="padding:0 10px">
                    <div class="table-responsive">
                      <table class="table table-hover" onmouseover="this.style.fontWeight='bold'" onmouseout="this.style.fontWeight='normal'">
                        <tr>
                          <td  width="10%"><?php echo $i; ?>. </td>
                          <?php	
								
								
                
				$getvals = $wpdb->get_results("SELECT DISTINCT (rd.RD_Id) FROM request_details rd, booking_status bs WHERE rd.REQ_Id=$rowsql->REQ_Id AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3)  AND BS_Active=1");
					
					
					foreach ($getvals as $values) {
								

						$rdids.=$values->RD_Id . ",";
						$countAll = count($wpdb->get_results("SELECT BS_Id FROM booking_status WHERE RD_Id='$values->RD_Id' AND BS_Active=1"));
						
															
						if($countAll==2){
						                
							if($rowcn=$wpdb->get_row("SELECT BA_Id, BS_CancellationAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=3 AND BS_Active=1")){
							
								if($rowcn->BA_Id==4 || $rowcn->BA_Id==6){
									
									$totalcosts	+=	$rowcn->BS_CancellationAmnt;
								
								}
							
							} else {
							   
								$rowbk = $wpdb->get_row("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
								
								$totalcosts	+=	$rowbk->BS_TicketAmnt;
							
							}
							
							
						} else {
						    
							$rowbk=$wpdb->get_row("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
							
							$totalcosts	+=	$rowbk->BS_TicketAmnt;
						
						}
						
						
						
					}
					
					//echo 'totalcost='.$totalcosts."<br>";

					$rdids = rtrim($rdids, ",");

					if (!$rdids)
					$rdids = "'" . "'";

				   //echo 'Reqids='.$rdids;
				   
				   $totqty += count($getvals);
				   
				   
				   $totalamnt	+=	$totalcosts;
					
							   
            ?>
                          <td  width="25%"><?php echo $reqcode; ?></td>
                          <td width="10%" style="text-align:center;"><?php echo count($getvals);  ?></td>
                          <td width="35%" style="text-align:center; padding-left:30px;"><?php  echo date('d-M-Y', strtotime($rowsql->REQ_Date)) ?></td>
                          <td width="20%" style="text-align:center;"><?php echo IND_money_format($totalcosts). ".00"; $totalcosts = NULL ; ?></td>
                          <td><a data-toggle="collapse" href="#collapse<?php echo $i; ?>"><i class="collapse-caret fa fa-angle-down"></i> </a> </td>
                        </tr>
                      </table>
                    </div>
                  </header>
                  <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="font-size:11px;">
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
							$rddetails = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mo WHERE REQ_Id='$rowsql->REQ_Id' AND rd.RD_Id IN($rdids) AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mo.MOD_Id ORDER BY RD_Id ASC");
                            
							$rdids = "";

							foreach ($rddetails as $rowsql) {
								?>
                            <tr>
                              <td align="center"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); 
							  if($rowsql->RD_Status == 9){
							
									echo removedByUser();
								}
							  ?></td>
                              <td><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                              <td width="5%"><?php echo $rowsql->EC_Name; ?></td>
                              <td width="5%"><?php echo $rowsql->MOD_Name; ?></td>
                              <td><?php 
					
									if($rowsql->EC_Id==1) {
										
										echo '<b>From:</b> '.$rowsql->RD_Cityfrom.'<br />
										<b>To:</b> '.$rowsql->RD_Cityto;						
									
									} else {
									
										echo '<b>Loc:</b> '.$rowsql->RD_Cityfrom;
										
										if ($rowsd=$wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'")) {
										
											echo '<br>Stay :'.$rowsd->SD_Name;
												
										}
									
									}
									
									?></td>
                              <td align="right"><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                              <!----- BOOKING STATUS STATUS ------>
                              <td><?php
							  
							    
								$selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");



							
									
						if ($selrdbs->RD_Id) {

							echo ($selrdbs->BA_Id == 1) ? bookingStatus($selrdbs->BA_Id) . "<br>" : '';

							echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

							echo '----------------------------------<br>';

							$query = "BA_Id IN (2,3)";
						}

					   

							echo bookingStatus($selrdbs->BA_Id);

							//echo 'baid='.$selrdbs['BA_Id'];

							$imdir = WPERP_COMPANY_DOWNLOADS .'/erp/modules/company/upload/'. $compid .'/bills_tickets/';
							
							
							$doc = NULL;



							switch ($selrdbs->BA_Id) {

								case 2:
								
									
								        
									$seldocs = $wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdbs->BS_Id'");
	
									$f = 1;
	
									foreach ($seldocs as $docs) {
	
										$doc.='<b>Uploaded File no. ' . $f . ': </b> <a download href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link">download</a><br>';
	
										$f++;
									}
									echo '<br>';
									echo '<b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
									echo $doc;
									echo '<b>Booked Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
									break;

								case 3:
									echo '<br>';
									echo '<strong>Failed Date</strong>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
									break;
							}
											
											?>
                              </td>
                              <!----- CANCELLATION STATUS ------>
                              <td><?php
							  
							    
								$selrdcs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=3 AND BS_Active=1");
									
								if ($selrdcs->RD_Id) {
		
									echo ($selrdcs->BA_Id == 1) ? bookingStatus($selrdcs->BA_Id) . "<br>" : '';
		
									echo '<b title="cancellation request date">Request Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdcs->BS_Date)) . "<br>";
		
									echo '----------------------------------<br>';
		
									$query = "BA_Id IN (4,5)";
								}


		

							echo bookingStatus($selrdcs->BA_Id);

							

							


							switch ($selrdcs->BA_Id) {

								case 4:
										
										$doc = NULL;
								        
										$seldocs = $wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdcs->BS_Id'");
		
										$f = 1;
		
										foreach ($seldocs as $docs) {
		
											$doc.='<b>Uploaded File no. ' . $f . ': </b> <a download href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link">download</a><br>';
		
											$f++;
										}
								
										echo '<br><b>Cancellation Amnt</b>: ' . IND_money_format($selrdcs->BS_CancellationAmnt) . '.00<br>';
										echo $doc;
										echo '<b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;

								case 5:
									echo '<br><b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;
							}
											
                                                                               
                                                            ?>
                              </td>
                            </tr>
                            <?php
                                                            $j++;
                                                        }
                                                        ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- //panel-body -->
                  </div>
                  <!-- //panel-collapse -->
                </div>
                <?php
                                    $i++;
                                }

                                //mysqli_free_result($ressql); 
                                ?>
                <!-- //panel -->
              </div>
              <!-- ////////////////////////////////////////-->
              <br>
              <br>
              <div class="row">
                <div class="col-sm-6">
                  <!--<div class="align-lg-left"> 795 Park Ave, Suite 120 <br>
                    San Francisco, CA 94107 <br>
                    P: (234) 145-1810 <br>
                    Full Name <br>
                    first.last@email.com </div>-->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Invoice No.</label>
                      <div>
                        <input type="text" name="txtInvoiceNo" id="txtInvoiceNo" class="form-control" disabled="disabled" value="<?php echo $rows->TDC_InvoiceNo ?>" />
                      </div>
                    </div>
                  </div>
                  <?php if($rows->TDC_Filename):?>
                  <div class="clearfix"></div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Invoice Doc.</label>
                      <div> <a href="<?php echo $imdir . $rows->TDC_Filename;?>"  download><span style="color: red;"><button class="btn btn-default dnld"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download Invoice</button></a> </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="clearfix"></div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Remarks</label>
                      <div>
                        <textarea data-height="auto" name="txtaRemarks" id="txtaRemarks" class="form-control" disabled="disabled"><?php echo stripslashes($rows->TDC_Remarks) ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <p>&nbsp;</p>
                </div>
                <div class="col-sm-6">
                  <div class="align-lg-right">
                    <ul>
                      <li> Total Quantity: <strong><?php echo $totqty; ?></strong> </li>
                      <?php 
					  
					  	$servTax=$rows->TDC_ServiceCharges * ($rows->TDC_ServiceTax/100);
						
						
						$totAmount = $totalamnt + $servTax + $rows->TDC_ServiceCharges;
						
					  ?>
                      <li id="servicetaxlistid">Service Tax: <strong id="servicetaxid"><?php echo $servTax ?></strong></li>
                      <li id="serviceamntlistid">Service Charges: <strong id="servicechargesid"><?php echo $rows->TDC_ServiceCharges; ?></strong></li>
                      <li> Total amount: <strong><?php echo IND_money_format($totalamnt + $servTax + $rows->TDC_ServiceCharges). '.00'; ?> </strong> </li>
                      <!--  <li> Discount: ----- </li>
                        <li> Grand Total: <strong>$3,485</strong> </li>-->
                    </ul>
                    <br>
                    <!-- <a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>-->
                    <!--<a href="#" class="btn btn-theme-inverse hidden-print"> SAVE </a>-->
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>
              <?php 
			  
			  
			  
			 			 $selsql = "
										
										SELECT
										  *
										FROM
										  travel_desk_claim_payments tdcp
										INNER JOIN
										  payment_modes pm USING(PM_Id)
										WHERE
										  TDC_Id = '$tdcid' AND TDCP_Status = 1
										ORDER BY
										  tdcp.TDCP_Id 
								
								";
								
								//echo $selsql;
								
								$ressql = $wpdb->get_results($selsql);
								
								$table = null;
								
								$i = 1;
								
								
								$table = null;
								
								if(!empty($ressql)){
								
									foreach($ressql as $rowsql){
									
									
									    
										switch($rowsql->PM_Id){
										
											case 1: // by cheque
												$table .= ' <table class="table table-bordered">
												<caption style="text-align:left; font-size: 14px; " class="text-primary"> Payment #'.$i.' - '.$rowsql->PM_Name.'</caption>
													<thead>
													  <tr>
														<th style="text-align:left;">Cheque Number</th>
														<th style="text-align:left;">Cheque Date</th>
														<th style="text-align:left;">Issuing Bank</th>
														<th style="text-align:right;" width="15%">Amount</th>
														<th style="text-align:center;"  width="20%">Payment Updated Date</th>
													  </tr>
													</thead>
													<tbody>
													  <tr>
														<td>'.$rowsql->TDCP_ChequeNumber.'</td>
														<td>'.$rowsql->TDCP_ChequeDate.'</td>
														<td>'.$rowsql->TDCP_ChequeIssuingbb.'</td>
														<td style="text-align:right;">'.IND_money_format($rowsql->TDCP_Amount).'</td>
														<td style="text-align:center;">'.date('d-m-Y', strtotime($rowsql->TDCP_AddedDate)).'</td>
													  </tr>
													  
													</tbody>
												  </table>';
											break;
											
											
											
											case 2:  case 4: // cash transfer // other
												$table .= ' <table class="table table-bordered">
												<caption style="text-align:left; font-size: 14px; " class="text-primary"> Payment #'.$i.' - '.$rowsql->PM_Name.'</caption>
													<thead>
													  <tr>
														<th style="text-align:left;">Payment Details</th>
														<th style="text-align:right;" width="15%">Amount</th>
														<th style="text-align:center;" width="20%">Payment Updated Date</th>
													  </tr>
													</thead>
													<tbody>
													  <tr>
														<td>'.$rowsql->TDCP_CashPaymentDetails.$rowsql->TDCP_OthersPaymentDetails.'</td>
														<td style="text-align:right;">'.IND_money_format($rowsql->TDCP_Amount).'</td>
														<td style="text-align:center;">'.date('d-m-Y', strtotime($rowsql->TDCP_AddedDate)).'</td>
													  </tr>
													  
													</tbody>
												  </table>';
											break;
											
											
											case 3: // bank transfer
												$table .= ' <table class="table table-bordered">
												<caption style="text-align:left; font-size: 14px; " class="text-primary"> Payment #'.$i.' - '.$rowsql->PM_Name.'</caption>
													<thead>
													  <tr>
														<th style="text-align:left;">Transaction Id</th>
														<th style="text-align:left;">Bank Name</th>
														<th style="text-align:left;">Transaction Date</th>
														<th style="text-align:right;" width="15%">Amount</th>
														<th style="text-align:center;" width="20%">Payment Updated Date</th>
													  </tr>
													</thead>
													<tbody>
													  <tr>
														<td>'.$rowsql->TDCP_BTTransactionId.'</td>
														<td>'.$rowsql->TDCP_BTBankDetails.'</td>
														<td>'.$rowsql->TDCP_BTTransferDate.'</td>
														<td style="text-align:right;">'.IND_money_format($rowsql->TDCP_Amount).'</td>
														<td style="text-align:center;">'.date('d-m-Y', strtotime($rowsql->TDCP_AddedDate)).'</td>
													  </tr>
													  
													</tbody>
												  </table>';
											break;
											
	
										
										}
										
										$i++; 
									
									} 
								
							}
			 
			
				if($rows->TDC_Status==1){
				
					
					
					?>
              <div class="col-lg-2"></div>
              <div class="col-lg-10">
                <section class="panel">
                  <header class="panel-heading">
                    <h3>Payment Details</h3>
                  </header>
                  <div class="panel-body">
                    <form class="form-horizontal" data-collabel="4" data-alignlabel="left" data-label="color"  name="form1" method="post" action="action.php">
                      <input type="hidden" value="<?php echo $tdcid; ?>" name="tdcid" id="tdcid" >
                      <input type="hidden" name="totAmnt" id="totAmnt" value="<?php echo $totAmount; ?>"  />
                      <input type="hidden" name="hiddnArr" id="hiddnArr" value="<?php echo $rows->TDC_Arrears; ?>"  />
                      <?php 
					  
					  // checking for arrears
					  
					 
					  
					  if($rows->TDC_Arrears){
					  
					  
					  
					  	?>
                      <div class="text-right"> <span class="label label-primary">Arrears: Rs <?php echo IND_money_format($rows->TDC_Arrears).'.00'; ?></span> </div>
                      <p>&nbsp;</p>
                      <?PHP
								
								
								echo $table;
			  
					  	
						}
					  
					 	?>
                      <p>&nbsp;</p>
                      <div class="form-group">
                        <label class="control-label">Payment mode</label>
                        <div>
                          <select class="form-control" name="selPaymentMode" id="selPaymentModetc">
                            <option value="">Select</option>
                            <?php 
						  $selsql=$selsql=$wpdb->get_results("SELECT * FROM payment_modes");
						  
						  foreach($selsql as $rowsql){
						  ?>
                            <option value="<?php echo $rowsql->PM_Id; ?>"  ><?php echo $rowsql->PM_Name; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div id="chequeid" style="display:none;">
                        <div class="form-group">
                          <label class="control-label">Cheque Number</label>
                          <div>
                            <input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber"   />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Cheque Date</label>
                          <div>
                            <input type="text" name="txtCqDate" id="txtCqDate" class="form-control erp-date-field" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Issuing Bank</label>
                          <div>
                            <input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch"  />
                          </div>
                        </div>
                      </div>
                      <div id="cashid" style="display:none;">
                        <div class="form-group">
                          <label class="control-label">Payment Details</label>
                          <div>
                            <textarea class="form-control" data-height="auto" name="txtaCshComments" id="txtaCshComments" ></textarea>
                          </div>
                        </div>
                      </div>
                      <div id="banktransferid" style="display:none;">
                        <div class="form-group">
                          <label class="control-label">Transaction Id</label>
                          <div>
                            <input type="text" class="form-control" name="txtTransId" id="txtTransId"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Bank Name</label>
                          <div>
                            <input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Transaction Date</label>
                          <div>
                            <input type="text" name="txtBBDate" id="txtBBDate" class="form-control erp-date-field"  >
                          </div>
                        </div>
                      </div>
                      <div id="othersid" style="display:none;">
                        <div class="form-group">
                          <label class="control-label">Payment Details</label>
                          <div>
                            <textarea class="form-control" data-height="auto" name="txtaOtherComments" ></textarea>
                          </div>
                        </div>
                      </div>
                      <div id="amountDiv" style="display:none;">
                        <div class="form-group">
                          <label class="control-label">Amount</label>
                          <div>
                            <input class="form-control allownumericwithoutdecimal" name="txtAmnt" id="txtAmnt" maxlength="7" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group offset">
                        <div>
                          <button name="accTcClaimed" id="accTcClaimed" class="btn btn-theme" type="submit">Submit</button>
                          <button type="reset" class="btn" >Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </section>
              </div>
              <?PHP
					
				
				} else if($rows->TDC_Status==2){					
				  
				  ?>
              <div class="col-lg-2"></div>
              <div class="col-lg-10">
                <section class="panel">
                  <header class="panel-heading">
                    <h3>Payment Details</h3>
                  </header>
                  <div class="panel-body">
                    <div id="detailsformid"> <?php echo $table;; ?>
                      <div class="well bg-success">
                        <h3><i class="fa fa-check"></i> Payment Cleared</h3>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
              <?php }  ?>
            </div>
          </div>
          <!--</form>-->
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