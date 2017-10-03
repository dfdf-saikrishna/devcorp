<?php 
ob_start();
global $rdids;
global $wpdb;
$reqid	=$_GET['reqid'];
$compid = $_SESSION['compid'];
$et=1;$showProCode=1;
$row=$wpdb->get_row("Select * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active=1");
require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req-dropdown.php';
if(!count($row)){
	header("location:travel-desk-dashboard.php?msg=1");exit;
}
global $totalcost;

$empid=$row->EMP_Id;
?>
<link rel="stylesheet" type="text/css" href="../css/raw.common.min.css">
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
   
   @media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
  .table-responsive
  {overflow-x:hidden;}  
}
</style>
<div class="wrap">
<div class="postbox">
    <div class="inside">
          <header class="panel-heading">
            <h3>Pre Travel Expense Request Details</h3>
          </header>
		  
          
          
          <?php 
		  echo '<br>';
		  $rowtl=$wpdb->get_row("Select * FROM tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
		if(!empty($rowtl)){
		  if($rowtl->TL_Percentage){
		  echo ' <div class="alert alert-warning"><i><b>Note: </b>Tolerance Limit '.$rowtl->TL_Percentage .'%. Please dont exceed the tolerance limit for booking tickets amounts. </i></div>
          		<br />';
		}}
		  ?>
		  <?php
			$message = '';
			if(isset($_GET['status'])){
				if($_GET['status'] == 'success'){
					$message = '<div class="updated below-h2" id="message" style="text-align:center;"><p>' . sprintf(__('Booked Successfully', 'companies_table_list')) . '</p></div>';
				}
				if($_GET['status'] == 'failure'){
					$message = '<div class="error below-h2" id="message" style="text-align:center;"><p>' . sprintf(__('Failed to Book', 'companies_table_list')) . '</p></div>';
				}
				if($_GET['status'] == 'tolerance'){
					$message = '<div class="error below-h2" id="message" style="text-align:center;"><p>' . sprintf(__('Tolerance Limit exceeds Please try Again', 'companies_table_list')) . '</p></div>';
				}
			}
			?>
			<?php echo $message;?>
			<div>
                <!-- Request Details -->
                <?php _e(requestDetails(1)); ?>
            </div>
            <?php 
                require WPERP_TRAVELDESK_VIEWS."/employee-details.php";
                // require WPERP_EMPLOYEE_VIEWS."/employee-request-details.php";
                echo '<br>';
                ?>
            <div class="" id="resultid"></div>
           <!-- <div class="col-sm-6 align-sm-right"> Font Size:&nbsp; <span class="tooltip-area"> <a name="buttonIncrease" id="buttonIncrease" class="btn btn-default btn-sm" title="Increase"><i class="fa fa-plus-circle"></i></a> <a name="buttonDecrease" id="buttonDecrease"  class="btn btn-default btn-sm" title="Decrease"><i class="fa fa-minus-circle"></i></a> </span> </div>-->
            <input type="hidden" value="<?php echo $filename; ?>" name="filename" id="filename"  />
            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" />
			
			<div class=" table-responsive">
		   <div class="table-wrapper">
			
              <table class="table"  style="font-size:11px;">
                <thead class="thead-inverse">
                  <tr>
                    <th>Date</th>
                    <th>Expense<br />
                      Description</th>
                    <th colspan="2">Expense <br />
                      Category</th>
                    <th>Place</th>
                    <th>Booking Status</th>
                    <th>Cancellation <br />
                      Status</th>
					<th>Estimated <br />
					  Cost</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					
					$selsql=$wpdb->get_results("SELECT DISTINCT(rd.RD_Id) FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND req.REQ_Id='$reqid' AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3) AND REQ_Active=1 AND RD_Status=1 AND BS_Active=1");
					
					foreach($selsql as $value){
						
						$rdids.=$value->RD_Id .",";
						
					}
					
					$rdids=rtrim($rdids,",");
					
									  
				   $selsql=$wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id=$row->REQ_Id AND rd.RD_Id IN ($rdids) AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
					
				$j=1;
				
				$rdidarry=array();
				  foreach($selsql as $rowsql){
				  
				  
				  	
				  ?>
                  <tr>
				  <?php $freturn = $rowsql->RD_ReturnDate;?>
                          <td align="center"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                          <td><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                          <td width="5%"><?php echo $rowsql->EC_Name; ?></td>
                          <td width="5%"><?php echo $rowsql->MOD_Name; ?></td>
                          <td><?php if ($rowsql->EC_Id == 1) { ?>
                            <b>From:</b> <?php echo $rowsql->RD_Cityfrom; ?><br />
                            <b>To:</b> <?php echo $rowsql->RD_Cityto; ?>
                            <?php } else { ?>
                            <b>Loc:</b> <?php echo $rowsql->RD_Cityfrom; ?>
                            <?php                                       
							if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'")) {
								echo '<br>Stay :' . $rowsd->SD_Name;
							}
							?>
                            <?php } ?>
							<?php if($freturn && $freturn != "0000-00-00"){ 
							$freturndate = $rowsql->RD_ReturnDate;
							?>
								<span class="status-2">Return Journey Included</span>
							<?php } ?>
							</td>
                          <!----- BOOKING STATUS STATUS ------>
                          <td><?php
                          
			$selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");



			if ($selrdbs->RD_Id) {
                                                                        ?>
                            <form method="post" id="bookingForm<?php echo $j; ?>" name="bookingForm<?php echo $j; ?>" enctype="multipart/form-data">
                              <input type="hidden" name="rdid<?php echo $j; ?>" id="rdid<?php echo $j; ?>" value="<?php echo $rowsql->RD_Id ?>" />
                              <input type="hidden" name="type<?php echo $j; ?>" id="type" value="1" />
                              <div id="bookingStatusContainer<?php echo $j; ?>">
							  <input type="hidden" name="bookingcost<?php echo $j; ?>" id="bookingcost" value="<?php echo $rowsql->RD_Cost; ?>" />
                                <?php
				if ($selrdbs->RD_Id) {

					echo ($selrdbs->BA_Id == 1) ? bookingStatus($selrdbs->BA_Id) . "<br>" : '';

					echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

					echo '----------------------------------<br>';

					$query = "BA_Id IN (2,3)";
				}

				if ($selrdbs->BA_Id == 2 || $selrdbs->BA_Id == 3) {
                    echo bookingStatus($selrdbs->BA_Id);
					//echo 'baid='.$selrdbs['BA_Id'];

					$imdir= WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";
							

					$doc = NULL;

					if ($selrdbs->BA_Id == 2) {

						$seldocs = $wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='". $selrdbs->BS_Id ."'");

						$f = 1;

						foreach ($seldocs as $docs) {

							$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link" download>download</a><br>';

							$f++;
						}
					}



					switch ($selrdbs->BA_Id) {

						case 2:
							$bookingcost+=$selrdbs->BS_TicketAmnt;
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
				} else if ($selrdbs->BA_Id == 1) {
                                                                                    ?>
                                <div class="col-sm-8" id="imgareaid<?php echo $j; ?>"></div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <div>
                                      <select name="selBookingActions<?php echo $j; ?>" id="selBookingActions<?php echo $j; ?>" class="form-control" onchange="showHideBookingcustom(<?php echo $j; ?>, this.value)" >
                                        <option value="">Select</option>
                                        <?php
											$ba = $wpdb->get_results("Select * FROM booking_actions WHERE $query");

											foreach ($ba as $barows) {
                                                                                                        ?>
                                        <option value="<?php echo $barows->BA_Id; ?>"><?php echo $barows->BA_Name; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-8" style="display:none;" id="amntDiv<?php echo $j; ?>">
                                  <div class="form-group">
                                    <div>
                                      <input type="text" class="form-control"  name="txtAmount<?php echo $j; ?>" onkeyup="return checkCost(this.id)"  id="txtAmount<?php echo $j; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-8" id="ticketUploaddiv<?php echo $j; ?>" style="display:none;">
                                  <div class="form-group">
                                    <div>
                                      <input type="file" multiple="true" class="fileattach" name="fileattach<?php echo $j; ?>[]" id="fileattach<?php echo $j; ?>[]" onchange="return Validate(this.id);">
                                      <!-- //fileinput-->
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <div>
                                      <button name="buttonUpdateStatus" id="buttonUpdateStatus<?php echo $j; ?>" value="<?php echo $j; ?>" style="display:none; width:75px; height:20px; padding-bottom:20px;" type="submit" class="btn btn-link">Update</button>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <div>
                                      <button name="buttonCancel" id="buttonCancel<?php echo $j; ?>" value="<?php echo $j; ?>" style="display:none; width:75px; height:20px; padding-bottom:20px;" onclick="cancelBookingstat(this.value)" type="button" class="btn btn-link">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                                <?Php
                                                                                }
                                                                                ?>
                              </div>
                            </form>
                            <?php
                                                                    } else {

                                                                        echo bookingStatus(NULL);
                                                                    }
                                                                    ?>
                          </td>
                          <!----- CANCELLATION STATUS ------>
                          <td><?php
									if ($selrdcs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='". $rowsql->RD_Id ."' AND BS_Status=3 AND BS_Active=1")) {
										?>
                            <form method="post" id="cancellationForm<?php echo $j; ?>" name="cancellationForm<?php echo $j; ?>" enctype="multipart/form-data">
                              <input type="hidden" name="rdid1<?php echo $j; ?>" id="rdid1<?php echo $j; ?>" value="<?php echo $rowsql->RD_Id ?>" />
                              <input type="hidden" name="type1<?php echo $j; ?>" id="type1" value="2" />
                              <div id="cancelStatusContainer<?php echo $j; ?>">
                                <?php
						if ($selrdcs->RD_Id) {

							echo ($selrdcs->BA_Id == 1) ? bookingStatus($selrdcs->BA_Id) . "<br>" : '';

							echo '<b title="cancellation request date">Request Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdcs->BS_Date)) . "<br>";

							echo '----------------------------------<br>';

							$query = "BA_Id IN (4,5)";
						}
						
						//echo 'Baid='.$selrdcs['BA_Id']; 			


						if ($selrdcs->BA_Id == 4 || $selrdcs->BA_Id == 5 || $selrdcs->BA_Id == 6 || $selrdcs->BA_Id == 7) {

							$cancellationstatus = bookingStatus($selrdcs->BA_Id);
							echo $cancellationstatus;

							$doc = NULL;

							if ($selrdcs->BA_Id == 4 || $selrdcs->BA_Id == 6) {

								$seldocs = $wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='$selrdcs->BS_Id'");

								$f = 1;
							$imdir= WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";
								
								foreach ($seldocs as $docs) {
								
                                   
									$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" download="file_name" class="btn btn-link">download</a><br>';

									$f++;
								}
							}


							switch ($selrdcs->BA_Id) {

								case 4: case 6:
									$calcanc = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");
									$bookingcost-=$calcanc->BS_TicketAmnt;
									$bookingcost+=$selrdbs->BS_CancellationAmnt;
									echo '<br><b>Cancellation Amnt</b>: ' . IND_money_format($selrdcs->BS_CancellationAmnt) . '.00<br>';
									echo $doc;
									echo '<b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;

								case 5: case 7:
									$calcanc = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");
									$bookingcost-=$calcanc->BS_TicketAmnt;
									echo '<br><b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;
							}
																					
																					
																					
                      } else if ($selrdcs->BA_Id == 1) {
                                                                                    ?>
                                <div class="col-sm-12" id="imgareaid2<?php echo $j; ?>"></div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <div>
                                      <select name="selCancActions<?php echo $j; ?>" id="selCancActions<?php echo $j; ?>" class="form-control" onChange="showHideCanc(<?php echo $j; ?>, this.value)">
                                        <option value="">Select</option>
                                        <?php
                                                                                                    $ba = $wpdb->get_results("Select * FROM booking_actions WHERE $query");

                                                                                                    foreach ($ba as $barows) {
                                                                                                        ?>
                                        <option value="<?php echo $barows->BA_Id; ?>"><?php echo $barows->BA_Name; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-8" id="cancAmntDiv<?php echo $j; ?>" style="display:none;">
                                  <div class="form-group">
                                    <div>
                                      <input type="text" class="form-control"  name="txtCanAmount<?php echo $j; ?>" onKeyUp="return checkCost(this.id)"  id="txtCanAmount<?php echo $j; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-8" id="ticketCancDiv<?php echo $j; ?>" style="display:none;">
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="fileCanAttach<?php echo $j; ?>[]" id="fileCanAttach<?php echo $j; ?>[]" multiple="true" onchange="return Validate(this.id);">
                                      <!-- //fileinput-->
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <div>
                                      <button name="buttonUpdateStatusCanc" id="buttonUpdateStatusCanc<?php echo $j; ?>" value="<?php echo $j; ?>" style="display:none; width:75px; height:20px; padding-bottom:20px;" type="submit" class="btn btn-link">Update</button>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <div>
                                      <button name="buttonCancelCanc" id="buttonCancelCanc<?php echo $j; ?>" style="display:none; width:75px; height:20px; padding-bottom:20px;" onClick="cancelCancstat(<?php echo $j; ?>)" type="button" class="btn btn-link">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                                <?Php
                                                                                }
                                                                                ?>
                              </div>
                            </form>
                            <?php
                                                                    } else {
                                                                        echo bookingStatus(NULL);
                                                                    }
                                                                    ?>
                          </td>
						  <td align="right"><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                        </tr>
                  <?php 	  
					$totalcost+=$rowsql->RD_Cost;
					$j++;
					
					array_push($rdidarry, $rowsql->RD_Id);
					
					} 
					
					?>
					<tr>
                        <td align="right" colspan="7" style="text-align:right;font-weight:bold;">Total Estimated Cost</td><td align="right" colspan="" width="10%" style="font-weight:bold;"><?php echo IND_money_format($totalcost) . ".00"; ?></td>
						<?php
						if(!$bookingcost)
							$bookingcost = "00";
						?>
						<tr ><td align="right" colspan="7"  style="text-align:right;font-weight:bold;">Total Cost</td><td align="right" colspan="" width="10%" style="font-weight:bold;"><?php echo IND_money_format($bookingcost) . ".00"; ?></td></tr>
					</tr>
                </tbody>
              </table>
			  </div>
          </div>

			<?php
			//Quote Details
			require WPERP_EMPLOYEE_VIEWS . "/quote-details.php";
			?>
               
            <div class="clearfix"></div>
            <p style="height:40px;">&nbsp;</p>
            
            <div id="chatContainer">
              <?php
			 // $val=1;
			   _e(chat_box(1,1));  
			   //require("chat.php");?>
            </div>
          </div>
		</div>
