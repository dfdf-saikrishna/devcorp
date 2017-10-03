<?php
global $etEdit;
$showProCode = 1;
require_once WPERP_EMPLOYEE_PATH . '/includes/functions-pre-travel-req.php';
global $wpdb;
global $totalcost;
$paytotd=0;
$reqid = $_GET['reqid'];
$row=$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Id='$reqid' AND RT_Id=5 AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND REQ_Active=1 AND re.RE_Status=1");
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
?>
<style type="text/css">
#my_centered_buttons { text-align: center; width:100%; margin-top:60px; }
</style>
<div class="postbox">
    <div class="inside">
        <div class="wrap pre-travel-request erp" id="wp-erp">
            <h2><?php _e( 'Mileage Expense Request', 'employee' ); ?></h2>
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
			<!-- Request Details -->
            <?php _e(requestDetails(5));?>
            <?php
                require WPERP_EMPLOYEE_VIEWS."/employee-details.php";
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
            <div class="table-wrapper" style="background-repeat:repeat;margin-top:0px;">
                <h4 >/ Mileage Rates /</h4>
               <p style="border-bottom:thin dashed #999999;">&nbsp;</p>
               <?php
               $selamnt=$wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' AND MOD_Id='31' AND MIL_Status=1 AND MIL_Active=1");
               ?>
               <input type="hidden" id="hiddenTwowheeler" name="hiddenTwowheeler" value="<?php echo $selamnt->MIL_Amount?>" />
                <dl> <b>Two Wheeler:</b> <?php if($selamnt) echo  $selamnt->MIL_Amount; else echo 'N/A'; ?> / Km, 

                <?php   
                $selamnt=$wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' AND MOD_Id='32' AND MIL_Status=1 AND MIL_Active=1");
                ?>
              <input type="hidden" id="hiddenFourwheeler" name="hiddenFourwheeler" value="<?php if($selamnt) echo $selamnt->MIL_Amount?>" />
                
                <b>Four Wheeler:</b> <?php if($selamnt) echo $selamnt->MIL_Amount; else echo 'N/A'; ?></dl> / Km
                <form name="post-travel-req-form" action="#" method="post" enctype="multipart/form-data">
            <table class="wp-list-table widefat striped admins" border="0" id="table1">
                  <thead class="cf">
                    <tr>
                      <th width="10%">Date</th>
                      <th width="15%">Expense Description</th>
                      <th width="20%" colspan="2">Expense Category</th>
                      <th width="15%">City / Location</th>
                       <th width="10%" style="text-align:right;">Distance (in km)</th>
                       <th width="10%" style="text-align:right;">Cost / km</th>
                      <th width="10%" style="text-align:right;">Total Cost</th>
                      <th width="10%">Upload<br />
                        bills / tickets</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                        
                        $selsql=$wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id=$row->REQ_Id AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Id ASC");
                        foreach($selsql as $rowsql){
                        ?>
                    <tr>
                      <input type="hidden" id="et" value="5">
                      <input type="hidden" value="<?php echo $reqid; ?>" name="req_id" id="req_id"/>
                      <input type="hidden" name="reqcode" id="reqcode" value="<?php echo $row->REQ_Code?>" />
                      <td align="center" data-title="Date"><?php echo date('d/M/Y',strtotime($rowsql->RD_Dateoftravel));?></td>
                      <td data-title="Description"><div style="height:40px; overflow:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                      <td data-title="Category"><?php echo $rowsql->EC_Name; ?></td>
                      <td data-title="Category"><?php echo $rowsql->MOD_Name; ?></td>
                      <td data-title="City/Location"><?php 
						
							echo '<b>From:</b> '.$rowsql->RD_Cityfrom.'<br />';
							echo '<b>To:</b> '.$rowsql->RD_Cityto;
						?></td>
                        
                         <td align="right" style="padding-right:2px;" data-title="Distance (in km)"><b><?php echo $rowsql->RD_Distance; ?> Km</b></td>
                         <td align="right" style="padding-right:2px;"><b><?php echo $rowsql->RD_Rate; ?> / Km</b></td>
                        <td align="right" data-title="Total Cost"><?php echo IND_money_format($rowsql->RD_Cost).".00"; ?></td>
                        
                      <td data-title="Upload bills / tickets"><?php 	
                                                
						$selfiles=$wpdb->get_results("SELECT * FROM requests_files WHERE RD_Id='$rowsql->RD_Id'");
						
						if(count($selfiles)){
						
							$j=1;						
							foreach($selfiles as $rowfiles)
							{
								$temp=explode(".",$rowfiles->RF_Name);
								$ext=end($temp);
								
								$fileurl="/erp/modules/company/upload/".$compid."/bills_tickets/".$rowfiles->RF_Name;
								
							?>
                        <?php echo $j.") "; ?><a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download><?php echo 'file'.$j.".".$ext;  ?></a><br />
                        <?php 
							
							$j++;
							}
						
						} else {
						
							echo approvals(5);
						
						}
						
						 ?>
                      </td>
                    </tr>
                    <?php  
					
                    $totalcost+=$rowsql->RD_Cost;


                    } ?>
                  </tbody>
                </table>
                <table class="table" style="font-weight:bold;">
                  <tr>
                    <td align="right" width="85%">Claim Amount</td>
                    <td align="center" width="5%">:</td>
                    <td align="right"><?php echo IND_money_format($totalcost-$paytotd).".00"; ?></td>
                  </tr>
                </table>
            </div>
            <!-- Edit Buttons -->
            <?php
		global $wpdb;
		if($row->REQ_Claim)
		{
			echo '<br /><br /><div class="col-sm-12" align="center"><button name="buttonClaimed" class="btn btn-green" style="width:200px;"  type="button" onclick="javascript:void(0);">Request Claimed <br /> on '.date("d/M/y",strtotime($row->REQ_ClaimDate)).'</a> </div>';
			
			$selrow=$wpdb->get_row("SELECT * FROM payment_details WHERE REQ_Id='$reqid' AND PD_Status=1");
							
			?>
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		    <div class="col-xs-offset-4" style="margin-left: 72.333333%;">
		      <section class="panel">
		        <header class="panel-heading">
		          <h3>Payment Details</h3>
		        </header>
		        <div class="panel-body">
		          <div class="form-group">
		            <label class="control-label">Payment mode</label>
		            <div>
		              <select class="form-control" name="selPaymentMode" id="selPaymentMode" disabled="disabled">
		                <option value="">Select</option>
		                <?php 
								 
								$selsql=$wpdb->get_results("SELECT * FROM payment_modes");
								  
								  foreach($selsql as $rowsql){
								  
								  ?>
		                <option value="<?php echo $rowsql->PM_Id; ?>" <?php echo ($selrow->PM_Id==$rowsql->PM_Id) ? 'selected="selected"' : ''; ?> ><?php echo $rowsql->PM_Name; ?></option>
		                <?php } ?>
		              </select>
		            </div>
		          </div>
		          <div id="chequeid" <?php echo ($selrow->PM_Id==1) ? 'style="display:block;"' : 'style="display:none;"'; ?>  >
		            <div class="form-group">
		              <label class="control-label">Cheque Number</label>
		              <div>
		                <input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber" readonly="readonly"  <?php echo ($selrow->PD_ChequeNumber) ? 'value="'.$selrow->PD_ChequeNumber.'"' : ''; ?> />
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Cheque Date</label>
		              <div>
		                <div class="row">
		                  <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" style="
    padding-left: 15px !important;
">
		                    <input type="text" <?php /*?>name="txtDate[]"<?php */?> name="txtCqDate" id="txtCqDate" readonly="readonly" class="form-control"  <?php echo ($selrow->PD_ChequeDate) ? 'value="'.$selrow->PD_ChequeDate.'"' : ''; ?>>
		                    <!--<span class="input-group-btn">
		                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-times"></i></button>
		                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-calendar"></i></button>
		                    </span>--></div>
		                </div>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Issuing Bank</label>
		              <div>
		                <input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch" readonly="readonly"  <?php  echo ($selrow->PD_ChequeIssuingbb) ? 'value="'.$selrow->PD_ChequeIssuingbb.'"' : ''; ?>/>
		              </div>
		            </div>
		          </div>
		          <div id="cashid" <?php echo ($selrow->PM_Id==2) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
		            <div class="form-group">
		              <label class="control-label">Payment Details</label>
		              <div>
		                <textarea class="form-control" data-height="auto" name="txtaCshComments" readonly="readonly" id="txtaCshComments" ><?php  echo ($selrow->PD_CashPaymentDetails) ? stripslashes($selrow->PD_CashPaymentDetails) : ''; ?>
		</textarea>
		              </div>
		            </div>
		          </div>
		          <div id="banktransferid" <?php echo ($selrow->PM_Id==3) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
		            <div class="form-group">
		              <label class="control-label">Transaction Id</label>
		              <div>
		                <input type="text" class="form-control" name="txtTransId" id="txtTransId"  readonly="readonly"  <?php  echo ($selrow->PD_BTTransactionId) ? 'value="'.$selrow->PD_BTTransactionId.'"' : ''; ?>/>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Bank Name</label>
		              <div>
		                <input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  readonly="readonly"  <?php  echo ($selrow->PD_BTBankDetails) ? 'value="'.$selrow->PD_BTBankDetails.'"' : ''; ?>/>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Transaction Date</label>
		              <div>
		                <div class="row">
		                  <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p"  >
		                    <input type="text" name="txtBBDate" id="txtBBDate"  readonly="readonly" class="form-control"  <?php  echo ($selrow->PD_BTTransferDate) ? 'value="'.$selrow->PD_BTTransferDate.'"' : ''; ?>>
		                    <span class="input-group-btn">
		                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-times"></i></button>
		                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-calendar"></i></button>
		                    </span> </div>
		                </div>
		              </div>
		            </div>
		          </div>
		          <div id="othersid" <?php echo ($selrow->PM_Id==4) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
		            <div class="form-group">
		              <label class="control-label">Payment Details</label>
		              <div>
		                <textarea class="form-control" data-height="auto" name="txtaOtherComments"  readonly="readonly" ><?php  echo ($selrow->PD_OthersPaymentDetails) ? stripslashes($selrow->PD_OthersPaymentDetails) : ''; ?>
		</textarea>
		              </div>
		            </div>
		          </div>
		        </div>
		      </section>
		    </div>
		    <?php
				
		}
		else{ ?>
            <?php //_e(Actions(5));?>
            <?php } ?>
            </form>
        </div>
    </div>
    
</div>
