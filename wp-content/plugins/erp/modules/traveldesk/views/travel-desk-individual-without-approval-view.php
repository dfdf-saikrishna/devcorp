<?php
//require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req.php';
global $wpdb;
global $empuserid;
global $totalcost;
$compid = $_SESSION['compid'];
$reqid	=$_GET['reqid'];
$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Claim IS NULL and req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active != 9 AND REQ_Type=2 AND RE_Status=1");
$empuserid = $row->EMP_Id;
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
if(!empty($empdetails)){
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
}
$selsql=$wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id=$row->REQ_Id AND rd.RD_Type=2 AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
?>
<style type="text/css">
#my_centered_buttons { text-align: center; width:100%; margin-top:60px; }
</style>
<div class="wrap erp travel-desk-request">

    <div class="erp-single-container">  
          <div class="postbox" id="emp_details">
                
              <div class="inside">
                      <h2><?php _e( 'Individual Employee Request [ without approval ] Details', 'traveldesk' ); ?></h2>
                      <table class="wp-list-table widefat striped admins">
                        <tr>
                          <td width="20%">Employee Code</td>
                          <td width="5%">:</td>
                          <td width="25%"><?php if(!empty($empdetails)){ echo $empdetails->EMP_Code?> (<?php echo $empdetails->EG_Name?>) <?php }else{ echo "__"; } ?></td>
                          <td width="20%">Company Name</td>
                          <td width="5%">:</td>
                          <td width="25%"><?php if(!empty($empdetails)){  echo stripslashes($empdetails->COM_Name); }else{ echo "__"; } ?></td>
                        </tr>
                        <tr>
                          <td width="20%">Employee Name</td>
                          <td width="5%">:</td>
                          <td width="25%"><?php if(!empty($empdetails)){  echo $empdetails->EMP_Name; }else{ echo "__"; } ?></td>
              
                          <td width="20%">Reporting Manager Code</td>
                          <td width="5%">:</td>
                          <td width="25%"><?php if(!empty($repmngname)){
						  echo $empdetails->EMP_Reprtnmngrcode; }else{ echo "__"; }?></td>
                        </tr>
                        <tr>
                          <td>Employee Designation </td>
                          <td>:</td>
                          <td><?php if(!empty($empdetails)){ echo $empdetails->DES_Name; }else{ echo "__"; } ?></td>
                          <td>Reporting Manager Name</td>
                          <td>:</td>
                          <td><?php if(!empty($repmngname)){ echo $repmngname->EMP_Name; }else{ echo "__"; }?></td>
                        </tr>
                        <tr>
                          <td width="20%">Employee Department</td>
                          <td width="5%">:</td>
                          <td width="25%"><?php if(!empty($empdetails)){ echo $empdetails->DEP_Name; }else{ echo "__"; }  ?></td>
                        </tr>
                      </table>
       
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
                <form id="traveldesk_request" name="traveldesk_request" action="#" method="post" enctype="multipart/form-data">
                <table class="wp-list-table widefat striped admins" border="0" id="traveldesk_request">
                      <thead class="cf">
                        <tr>
                          <th class="column-primary">Date</th>
                          <th class="column-primary">Expense Description</th>
                          <th class="column-primary" colspan="2">Expense Category</th>
                          <th class="column-primary" >Place</th>
                          <th width="7%">Estimated Cost</th>
                          <th class="column-primary">Booking Status</th>
                          <th class="column-primary">Cancellation Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          $cntRds	=	count($selsql);
				
                          $j=1;
                          $rows=1;
                          foreach($selsql as $rowsql){


                          ?>
                        <tr>
                              <td align="center"><?php echo date('d-M-Y',strtotime($rowsql->RD_Dateoftravel));?></td>
                              <td><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                              <td><?php echo $rowsql->EC_Name; ?></td>
                              <td><?php echo $rowsql->MOD_Name; ?></td>
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
                                <td align="right"><?php echo IND_money_format($rowsql->RD_Cost).".00"; ?></td>
                                <!----- BOOKING STATUS STATUS ------>
                                <td><?php 
                                                    
                                                    $selrdbs=$wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");



                                                    if($row->REQ_Status==2 && !$selrdbs->RD_Id) {
                                                            
                                                            $wpdb->insert( 'booking_status', array( 'RD_Id' => $rowsql->RD_Id, 'BS_Status' => 1, 'BA_Id' => 1 ));
                                                            $ins = $wpdb->insert_id;
                                                            //echo 'last id'	= $ins."<br>";
                                                            
                                                            $selrdbs=$wpdb->get_row("SELECT * FROM booking_status WHERE BS_Id=$ins");

                                                    }


                                                             if($selrdbs->RD_Id){
                                                            ?>
                                  <form method="post" id="bookingForm<?php echo $j; ?>" name="bookingForm<?php echo $j; ?>" onsubmit="return submitBookingForm(<?php echo $j; ?>);">
                                    <input type="hidden" name="rdid<?php echo $j; ?>" id="rdid<?php echo $j; ?>" value="<?php echo $rowsql->RD_Id ?>" />
                                    <input type="hidden" name="type<?php echo $j; ?>" id="type" value="1" />
                                    <div id="bookingStatusContainer<?php echo $j; ?>">
                                      <?php 
                                                                    if($selrdbs->RD_Id){

                                                                            echo ($selrdbs->BA_Id==1) ? bookingStatus($selrdbs->BA_Id)."<br>": '';

                                                                            echo '<b>Request date: </b>'.date('d-M-y (h:i a)',strtotime($selrdbs->BS_Date))."<br>";

                                                                            echo '----------------------------------<br>';

                                                                            $query="BA_Id IN (2,3)";

                                                                    } 

                                                                            if($selrdbs->BA_Id == 2 || $selrdbs->BA_Id == 3){

                                                                                    echo bookingStatus($selrdbs->BA_Id);

                                                                                    //echo 'baid='.$selrdbs['BA_Id'];

                                                                                    $imdir=WPERP_TRAVELDESK_PATH . "/upload/$compid/bills_tickets/";


                                                                                    $doc=NULL;

                                                                                    if($selrdbs->BA_Id == 2){
                                                                                            
                                                                                            $seldocs=$wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdbs->BS_Id'");

                                                                                            $f=1;

                                                                                            foreach($seldocs as $docs){

                                                                                            //echo $imdir.$docs['BD_Filename']."<br>";

                                                                                                    $doc.='<b>Uploaded File no. '.$f.': </b> <a href="/wp-admin/admin.php?page=Download-File&file='.$imdir.$docs->BD_Filename.'" class="btn btn-link">download</a><br>';

                                                                                                    $f++;
                                                                                            }

                                                                                    }



                                                                                    switch ($selrdbs->BA_Id){

                                                                                            case 2:
                                                                                            echo '<br>';
                                                                                            echo '<b>Booked Amnt:</b> '.IND_money_format($selrdbs->BS_TicketAmnt).'.00</span><br>';
                                                                                            echo $doc;
                                                                                            echo '<b>Booked Date</b>: '.date('d-M-y (h:i a)',strtotime($selrdbs->BA_ActionDate));
                                                                                            break;

                                                                                            case 3:
                                                                                            echo '<br>';
                                                                                            echo '<strong>Failed Date</strong>: '.date('d-M-y (h:i a)',strtotime($selrdbs->BA_ActionDate));
                                                                                            break;

                                                                                    }




                                                                            } else if($selrdbs->BA_Id == 1) {

                                                                            ?>
                                      <div class="col-sm-12" id="imgareaid<?php echo $j; ?>"></div>
                                      <div class="col-sm-8">
                                        <div class="form-group">
                                          <div>
                                            <select name="selBookingActions<?php echo $j; ?>" id="selBookingActions<?php echo $j; ?>" class="form-control" onchange="showHideBooking(<?php echo $j; ?>,this.value)" >
                                              <option value="">Select</option>
                                              <?php                                     
                                                                                      $ba=$wpdb->get_results("SELECT * FROM booking_actions WHERE $query");

                                                                                      foreach($ba as $barows){
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
                                            <input type="file" multiple="true" name="fileattach<?php echo $j; ?>[]" id="fileattach<?php echo $j; ?>[]" onchange="return Validate(this.id);">
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
					
					$enableCanc=0;
					
					if($row->REQ_Status==2 &&  ($selrdbs->BA_Id==2)){	

						if($selptc=$wpdb->get_row("SELECT PTC_Id, PTC_Status FROM pre_travel_claim WHERE REQ_Id='$row->REQ_Id'")){
							
							$enableCanc=1;
							
						}
										
						if($selrdbs->RD_Id && !$enableCanc){
						?>
                      <form method="post" id="cancellationForm<?php echo $j; ?>" name="cancellationForm<?php echo $j; ?>" onsubmit="return submitCancellationForm(<?php echo $j; ?>);" enctype="multipart/form-data">
                        <input type="hidden" name="rdid1<?php echo $j; ?>" id="rdid1<?php echo $j; ?>" value="<?php echo $rowsql->RD_Id ?>" />
                        <input type="hidden" name="type1<?php echo $j; ?>" id="type1" value="2" />
                        <div id="cancelStatusContainer<?php echo $j; ?>">
                          <?php 						
											
							if($selrdcs=$wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=3 AND BS_Active=1")){
							
								echo bookingStatus($selrdcs->BA_Id);
								
								
								$doc=NULL;
				
								if($selrdcs->BA_Id==6){                                                                    
									$seldocs=$wpdb->get_results("SELECT * FROM booking_documents WHERE BS_Id='$selrdcs->BS_Id'");
																		
									$f=1;
										
									foreach($seldocs as $docs){
									
										$doc.='<b>Uploaded File no. '.$f.': </b> <a href="'.$imdir.$docs->BD_Filename.'" class="btn btn-link">download</a><br>';
										
										$f++;
									}
								
								}
								
								
								switch ($selrdcs->BA_Id){
								
									case 6:
									echo '<br><b>Cancellation Amnt</b>: '.IND_money_format($selrdcs->BS_CancellationAmnt).'.00<br>';
									echo $doc;
									echo '<b>Cancellation Date</b>: '.date('d-M-y (h:i a)',strtotime($selrdcs->BA_ActionDate));
									break;
									
									case 7:
									echo '<br><b>Cancellation Date</b>: '.date('d-M-y (h:i a)',strtotime($selrdcs->BA_ActionDate));
									break;
	
								}
								
								
							
							} else {
							
								
								 
							
								if(!$row->REQ_Claim) {	   
							
						  ?>
                          <div class="col-sm-12" id="imgareaid2<?php echo $j; ?>"></div>
                          <div class="col-sm-8">
                            <div class="form-group">
                              <div>
                                <select name="selCancActions<?php echo $j; ?>" id="selCancActions<?php echo $j; ?>" class="form-control" onChange="showHideCanc(<?php echo $j; ?>,this.value)">
                                  <option value="-1">Select</option>
                                  <?php                             
								  $ba=$wpdb->get_results("SELECT * FROM booking_actions WHERE BA_Id IN (6,7)");
								  
								  foreach($ba as $barows){
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
                          <input type="hidden" value="<?php echo $j; ?>" name="iteration">
                                <button name="buttonUpdateStatusCanc" id="buttonUpdateStatusCanc<?php echo $j; ?>" style="display:none;" type="submit" value="<?php echo $j; ?>" class="button-primary">Update</button>
                                
                                <button name="buttonCancelCanc" id="buttonCancelCanc<?php echo $j; ?>" style="display:none;" onClick="cancelCancstat(<?php echo $j; ?>)" type="button" class="button erp-button-danger">Cancel</button>
                              
                          <?Php		
						  
						  } else {
						  
						  	echo bookingStatus(NULL);		
						  
						  }	
						  
						  		  
					  } 
					   ?>
                        
                      </form>
                      <?php 
						  } else {
						  	
							echo bookingStatus(NULL);
									  
						  }
					  
					  } else {
					  
					  	echo approvals(5);
						
					  }
					  ?>
                    </td>
                            
                        </tr>
                        <?php 					
                        $totalcost+=$rowsql->RD_Cost;

                        $rows++; 

                        } ?>
                      </tbody>
                    </table>
                    <span id="totaltable"> 
                    <table class="wp-list-table widefat striped admins" style="font-weight:bold;">
                        <tr>
                          <td align="right" width="85%">Total Cost</td>
                          <td align="center" width="5%">:</td>
                          <td align="right" width="10%"><?php echo IND_money_format($totalcost).".00"; ?></td>
                        </tr>
                    </table>
                    </span>
                </div>
                </form>
                <!-- Notes -->
        <?php _e(chat_box(3,2));?>  
        </div>
        </div>
    </div>
</div>
<script>
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
    /*
	
    ---------- CANCELLATION REQUEST ---------------

    */
	
	
function cancelCancstat(buttonId)
{	
	var selCancActions	=	'selCancActions'+buttonId;
	var cancAmntDiv		=	'cancAmntDiv'+buttonId;
	var canAmnt			=	'txtCanAmount'+buttonId;
	var bookingbutton	=	'buttonUpdateStatusCanc'+buttonId;
	var cancelButton	=	'buttonCancelCanc'+buttonId;
	var ticketcandiv	=	'ticketCancDiv'+buttonId;
	var fileCanAttach	=	'fileCanAttach'+buttonId+'[]'
	
	//document.getElementById(selCancActions).value=null;
	document.getElementById(cancAmntDiv).style.display='none';
	document.getElementById(canAmnt).value=null;
	document.getElementById(fileCanAttach).value=null;
	document.getElementById(ticketcandiv).style.display='none';
	document.getElementById(bookingbutton).style.display='none';
	document.getElementById(cancelButton).style.display='none';
	
}
</script>

