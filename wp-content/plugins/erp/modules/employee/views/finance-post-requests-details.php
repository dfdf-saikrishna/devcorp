<?php
require_once WPERP_EMPLOYEE_PATH . '/includes/functions-pre-travel-req.php';
global $wpdb;
global $totalcost;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
$reqid  =   $_GET['reqid'];
$selsql=$wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id='$reqid' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
$row=$wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
$et=2;
$rdidarry = array();
?>
<style type="text/css">
#my_centered_buttons { text-align: center; width:100%;}
</style>
<div class="postbox">
    <div class="inside">
        <div class="wrap pre-travel-request" id="wp-erp">
            <h2><?php _e( 'Post Travel Requests Details', 'employee' ); ?></h2>
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
            <?php _e(requestDetails(2));?>
			</br>
            <?php
			require WPERP_EMPLOYEE_VIEWS . '/finance-details.php';
			?>
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
            <form id="request_form" name="input" action="#" method="post">
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
                                <th class="column-primary">Total Cost</th>
                                <?php if($row->REQ_PreToPostStatus){ ?>
                                <th class="column-primary">Select</th>
                                <th class="column-primary">Booking Status</th>
                                <th class="column-primary">Cancellation Status</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($selsql as $rowsql) {
                            ?>
                            <tr>
                            <?php $freturn = $rowsql->RD_ReturnDate; ?>
                            <input type="hidden" id="et" value="2">
                            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="req_id"/>
							<input type="hidden" value="<?php echo $reqid; ?>" name="reqoid" id="reqid"/>
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
								echo '<b>ChekIn</b> :' . $rowsql->RD_Dateoftravel;
								echo '<br><b>CheckOut</b> :' . $rowsql->RD_EndDate;
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
                            <!--td data-title="Upload bills"><?php
							/*
								if($rowsql->EC_Id == 3){
                                $selfiles = $wpdb->get_results("SELECT * FROM requests_files WHERE RD_Id='$rowsql->RD_Id'");
								
                                if (count($selfiles)) {

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
								*/
                                ?>
                            </td-->
                            <td data-title="Estimated Cost"><?php echo $rowsql->RD_Cost ? IND_money_format($rowsql->RD_Cost) . ".00" : approvals(5); ?></td>
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
                                                    echo '<br><b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
													$bookingcost+=$selrdbs->BS_TicketAmnt;
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
									
									if($rowsql->EC_Id == 3){
									$selfiles = $wpdb->get_results("SELECT * FROM requests_files WHERE RD_Id='$rowsql->RD_Id'");
									
									if (count($selfiles)) {

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
                                <?php } ?>
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
							<tr ><td align="right" colspan="8" style="text-align:right;font-weight:bold;">Total Estimated Cost</td><td align="right" width="10%"><?php echo IND_money_format($totalcost) . ".00"; ?></td></tr>
							<tr ><td align="right" colspan="8" style="text-align:right;font-weight:bold;">Total Cost</td><td align="right" width="10%"><?php echo IND_money_format($bookingcost) . ".00"; ?></td></tr>
						</tbody>
                    </table>
                </form>
				</div>
            </div>
            <?php	
            		if($row->REQ_PreToPostStatus):
                        $claimSubmitted = 1;

                        $curDate = date('Y-m-d');

                        if ($selclaim = $wpdb->get_results("SELECT * FROM  pre_travel_claim Where REQ_Id='$reqid'")) {

                            $claimSubmitted = 0;
                            ?>
                            </br>
                            <div class="" align="right"><a name="buttnEdit" class="btn btn-primary" href="/wp-admin/admin.php?page=Claimview&reqid=<?php echo $reqid; ?>">View Claim</a></div>
                            <?php
                        } elseif ($row->REQ_Status == 2 && $rowsql->RD_Dateoftravel <= $curDate) {
                            ?>
                            <div align="right"><a class="button button-primary" href="javascript:void(0);">Claim Not Submitted </a></div>
                            <?php
                        }
                        ?>
                    
        	    <? endif; ?>  
        <!-- Notes -->
        <?php _e(chat_box(2,''));?> 
		
 <?php //_e(FinanceActions(2,$totalcost)); ?>
    <?php
    //check booking
    $reqid = $_GET['reqid'];
    $reqtype = $wpdb->get_row("SELECT * FROM requests WHERE REQ_Id='$reqid'");
    if($reqtype->REQ_PreToPostStatus==1 && $reqtype->REQ_Status==2){
    $selsql = $wpdb->get_row("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id='$reqid' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
    $selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$selsql->RD_Id' AND BS_Active=1");
    if($selrdbs->BS_Status == '2'){
	require WPERP_EMPLOYEE_VIEWS . '/accounts-requests-action.php';
    }
    //elseif($selrdbs->BS_Status == '1'){
        //echo '<div class="col-lg-633" align="center"> <a href="javascript:void(0);" class="btn btn-warning">Booking Not Completed</a> </div>';
    //}
    }
    else{
    	require WPERP_EMPLOYEE_VIEWS . '/accounts-requests-action.php';    
    }
    
    ?>
</div>	
    </div>
<!--    <div id="my_centered_buttons">
    <button type="button" name="submit" id="submit-pre-travel-request" class="button button-primary">Submit</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" name="reset" id="reset" class="button">Reset</button>
    </div>-->
    <!-- Edit Buttons -->
   
</div>
                </div> 