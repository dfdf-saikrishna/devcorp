<?php
$msg	=$_GET['msg'];
global $wpdb;
global $totalActCost;
global $totEstCost;
global $totalPaytotd;
global $bRdids;
$reqid = $_GET['reqid'];
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
//$godown	=$_GET['godown'];

$et = 1;

$showProCode = 1;

$postTrvEdit = 1; // for remove rows


$go = 0;

$row = $wpdb->get_row("SELECT * from requests req, request_employee re where req.REQ_Id='$reqid' AND RT_Id IN (1,2) AND req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empuserid' AND REQ_Active != 9 AND re.RE_Status=1");

if (!$row->REQ_Id) {

    $go = 1;
} else {

    if ($row->REQ_Claim) {

        $go = 1;
    }
}


$imdir = WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";
?>
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<div class="postbox">
<div class="inside">
    <!-- //breadcrumb-->
    <div style="display:none" align="center" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>
    <div style="display:none" align="center" id="success" class="notice notice-success is-dismissible">
         <p id="p-success"><?php echo $_GET['msg'] ;?></p>
    </div>
                    <header class="panel-heading sm" data-color="theme-inverse">
                        <h3>Post Travel Expense Submit Claim</h3>
                        <label class="color">Upload &amp; Add <strong> Bills &amp; Total Cost </strong></label>
                    </header>
                    <form class="form-horizontal" method="post" id="formUpdatePretrvRequest" name="formUpdatePretrvRequest" action="#" data-collabel="3" data-alignlabel="left" parsley-validate enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $row->REQ_Code; ?>" name="requestcode" id="requestcode"  />
                        <input type="hidden" value="1" name="ectype"/>
                        <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"/>
                            <?php
							_e(requestDetails(1));
                            $approver = isApprover();
                            if ($approver) {

                                //echo 'sdfsdfsdf1';

                                require WPERP_EMPLOYEE_VIEWS . "/employee-details.php";
                                //echo '<br>';
                            } else {

                                //echo 'sdfsdfsdf2';

                                require WPERP_EMPLOYEE_VIEWS . "/my-details.php";
                                //echo '<br>';
                            }
                            //echo '<br>';

                            require WPERP_EMPLOYEE_VIEWS . "/claim-status.php";
                            //echo '<br><br>';
                            ?>
							<div class="table-responsive">
                            <div class="table-wrapper">
							<table class="table">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>Date</th>
                                            <th >Expense Description</th>
                                            <th >Expense Category</th>
                                            <th>Place</th>
                                            <th>Estimated Cost</th>
                                            <th >Total Cost</th>
                                            <th>Bills</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $selsql = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot where rd.REQ_Id='$row->REQ_Id' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");

                                        $rdidarry = array();

                                        $paytotd = 0;
                                        $totalCost = 0;

                                        foreach ($selsql as $rowsql) {
                                            ?>
                                            <tr>
												<?php $freturn = $rowsql->RD_ReturnDate; ?>
                                                <td data-title="Date" class="scrollmsg"><?php echo date('d/m/Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                                                <td data-title="Description"><div style="height:40px; overflow:auto;"><?php echo stripslashes($rowsql->RD_Description) ?></div></td>
                                                <td data-title="Category"><?php echo $rowsql->EC_Name; ?>
                                                    <?php echo $rowsql->MOD_Name; ?></td>
                                                <td style="font-size:11px; text-align:left;" data-title="Place"><?php
                                                    if ($rowsql->EC_Id == 1) {

                                                        echo '<b>From:</b> ' . $rowsql->RD_Cityfrom . '<br />';
                                                        echo '<b>To:</b> ' . $rowsql->RD_Cityto;
                                                    } else {
														if ($rowsql->EC_Id == 3){
															echo '<span class="status-3">&nbsp;&nbsp;&nbsp;N/A&nbsp;&nbsp;&nbsp;</span>';
														}	
														else{
                                                        echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;
														}	
                                                        if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration where SD_Id='$rowsql->SD_Id'"))
                                                            echo '<br>Stay :' . $rowsd->SD_Name;
                                                    }
                                                    ?>
													<?php if($freturn && $freturn != "0000-00-00"){ 
													$freturndate = $rowsql->RD_ReturnDate;
													?>
													<span class="status-2">Return Journey Included</span>
													<?php } ?>
													</td>
                                                <?php
                                                $bookedAmnt = 0;

                                                $bookd = 0;
                                                $cancelled = 0;
                                                $bkdamnt = 0;

                                                if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {

                                                    // BOOKING STATUS

                                                    if ($selbs = $wpdb->get_row("SELECT BA_Id, BS_TicketAmnt FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1")) {

                                                        $bookd = 1;

                                                        if ($selcn = $wpdb->get_row("SELECT BA_Id, BS_CancellationAmnt, BS_Id FROM booking_status where RD_Id='$rowsql->RD_Id' AND BA_Id IN (4,5,6,7) AND BS_Status=3 AND BS_Active=1")) {
                                                            $cancelled = 1;

                                                            $paytotd+=$selcn->BS_CancellationAmnt;
                                                        } else {

                                                            //$ptacost=$selbs->BS_TicketAmnt;

                                                            $paytotd+=$selbs->BS_TicketAmnt;
                                                        }

                                                        //$bookedAmnt=$selbs->BS_TicketAmnt;
                                                    }
                                                }

                                                if ($bookd) {

                                                    if ($cancelled)
                                                        $totalCost += $selcn->BS_CancellationAmnt;
                                                    else
                                                        $totalCost += $selbs->BS_TicketAmnt;
                                                } else {

                                                    if ($rowptac = $wpdb->get_row("select PTAC_Cost FROM pre_travel_actual_cost where RD_Id = '$rowsql->RD_Id' and PTAC_Status = 1")) {

                                                        $totalCost += $rowptac->PTAC_Cost;
                                                    } else {

                                                        $totalCost += $rowsql->RD_Cost;
                                                    }
                                                }
                                                ?>
                                                <td align="right" data-title="Estimated Cost"><?php echo $rowsql->RD_Cost ? IND_money_format($rowsql->RD_Cost) . '.00' : approvals(5); ?></td>

                                                <td align="right" data-title="Total Cost" ><?php
                                                    if ($bookd)
                                                        echo 'Booked Amnt=' . IND_money_format($selbs->BS_TicketAmnt) . ".00<br>";

                                                    if ($cancelled) {

                                                        echo $selcn->BS_CancellationAmnt ? '<span style="color:#E05252;">Cancellation Chrgs=' . IND_money_format($selcn->BS_CancellationAmnt) . ".00</span><br>" : '<span style="color:#E05252;">Cancellation Chrgs=00.00</span>';
                                                    }

                                                    if (!$bookd && !$cancelled) {

                                                        if ($selptaccost = $wpdb->get_row("SELECT PTAC_Cost FROM pre_travel_actual_cost where RD_Id='$rowsql->RD_Id' and PTAC_Status=1")) {

                                                            echo IND_money_format($selptaccost->PTAC_Cost) . ".00";
                                                        } else {

                                                            echo IND_money_format($rowsql->RD_Cost) . ".00";
                                                        }
                                                    }

                                                    $totCost+=$rowsql->RD_Cost;
                                                    ?></td>
                                                <td align="left" data-title="Bills"><?php
                                                    if ($cancelled) {

                                                        echo approvals(5);
                                                    } else {

                                                        $seluplfiles = $wpdb->get_results("SELECT * FROM pre_travel_actual_bills where RD_Id='$rowsql->RD_Id' AND PTAB_Status=1");

                                                        if (!$seluplfiles) {
															
															if ($rowsql->EC_Id == 3){
																$rdid = $rowsql->RD_Id;
																$seluplfiles=$wpdb->get_row("SELECT * FROM requests_files WHERE RD_Id='$rdid' AND RF_Status=1");
																echo '<a href="'.$seluplfiles->RF_Name.'" download class="btn btn-link">Download Receipt</a>';
															}
															else{
                                                            //echo '<span class="label label-warning">not uploaded</span>';
																	$readOnly = 0;
																	$bookedAmnt = 0;
																	$bills = NULL;
																	$imdir = WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";
																	if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {
																		
																		// BOOKING STATUS

																		if ($selbs = $wpdb->get_row("SELECT BS_Id, BA_Id, BS_TicketAmnt FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1")) {

																			
																			if ($selbs->BA_Id == 2) {

																				$bookedAmnt = $selbs->BS_TicketAmnt;

																				$seldocs = $wpdb->get_results("SELECT * FROM booking_documents where BS_Id='$selbs->BS_Id'");
																					
																				$doc = NULL;

																				$f = 1;

																				foreach ($seldocs as $docs) {

																					$doc.='<a href="' . $imdir . $docs->BD_Filename . '" download class="btn btn-link">Download Receipt</a><br>';

																					$f++;
																				}


																				$bills = $selbs->BD_Filename;

																				$readOnly = 1;
																			} else {

																				$readOnly = 0;
																			}
																		} else {

																			$readOnly = 0;
																		}
																	}
																	if ($readOnly) {

																		echo '<u>Booked by Travel Desk</u><br><br>';

																		//echo '<b>Booked Amnt: </b>' . IND_money_format($bookedAmnt) . '.00<br />';

																		echo $doc;
																	}
															}
                                                        } else {

                                                            $j = 1;
															
                                                            foreach ($seluplfiles as $rowuplfiles) {

                                                                $temp = explode(".", $rowuplfiles->PTAB_Filename);

                                                                $ext = end($temp);
                                                                
                                                                $fileurl = WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/" . $rowuplfiles->PTAB_Filename;

                                                                echo $j . ') <a href="' . $fileurl . '" download> file' . $j . "." . $ext . '</a><br />&nbsp;';


                                                                $j++;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $row++;


                                            array_push($rdidarry, $rowsql->RD_Id);
                                        }
                                        ?>
                                    </tbody>
									<tr height="30">
                                        <td style="text-align:right;" align="right" colspan="6" width="90%">Total Estimated Cost</td>
                                        <td align="right" width="10%"><?php echo IND_money_format($totCost) . ".00"; ?></td>
                                    </tr>
                                    <tr height="30">
                                        <td style="text-align:right;" align="right" colspan="6" width="90%">Total Cost</td>
                                        <td align="right" width="10%"><span id="totalactcostid"><?php echo IND_money_format($totalCost) . ".00"; ?></span></td>
                                    </tr>
                                    <tr height="30">
                                      <td style="text-align:right;" align="right" colspan="6" width="90%">Payable to Travel Desk</td>
                                      <td align="right" width="10%"><?php echo $paytotd ? IND_money_format($paytotd) . ".00" : 'NIL';   ?></td>
                                    </tr>
									<tr height="30">
                                        <td style="text-align:right;" align="right" colspan="6" width="90%">Claim Amount (Rs)</td>
                                        <td align="right"  width="10%"><?php echo IND_money_format($totalCost - $paytotd) . ".00"; ?></td>
                                    </tr>
                                </table>
                            </div>

                            <input type="hidden" id="hidrowno" name="hidrowno" value="<?php echo $rows - 1; ?>" />
                            <input type="hidden" name="totrows" id="totrows" value="<?php echo $rows - 1; ?>" />


                            <?php
                            if (!$row->REQ_Claim) {
                                ?>
                                <!--div class="col-sm-12" align="right">
                                    <div class="form-group"> <a title="Add Rows" class="button-primary" href="javascript:addRowSubmitClaim();"><i class="fa fa-plus"></i></a> <span id="removebuttoncontainer"> </span> </div>
                                </div-->
                            <?php } ?>
                            
                            </div>
                            <?php
                            $claimAmnt = abs($totalActCost - $totalPaytotd);
                            ?>
                            <span id="totaltable">
                                <?php if ($claimAmnt) { ?>
                                    <table class="wp-list-table widefat striped admins" style="font-weight:bold;">
                                        <tr>
                                            <td align="right" width="85%">Claim Amount (Rs)</td>
                                            <td align="center" width="5%">:</td>
                                            <td align="right" width="10%"><?php echo IND_money_format($claimAmnt) . ".00"; ?></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </span> <br />
                            <br />
                            <br />
                            <div class="row">
                                <style type="text/css">
                                    #my_centered_buttons { text-align: center; width:100%;}
                                </style>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="form-group" id="my_centered_buttons">
                                        <button type="submit" name="submitUpdPretrvReq" id="submitUpdPretrvReq" class="btn btn-success" onclick="">Submit</button>
                                        <button type="button" name="goback" onclick="javascript:window.history.back();" class="btn btn-warning">Back</button>
                                    </div>
                                </div>
                            </div>
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
