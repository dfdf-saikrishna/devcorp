<?php
global $wpdb;
//require("header.php");
//require("config.php");
//$msg	=$_GET['msg'];
$reqid = $_GET['reqid'];
//$godown = $_GET['godown'];
$empuserid=$_SESSION['empuserid'];
$compid =$_SESSION['compid'];
$et = 1;
global $totCost;
$showProCode = 1;

/* if((!is_numeric($reqid)) || (($msg) && (!is_numeric($msg))) || (($godown) && (!is_numeric($godown))))
  exit; */




$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active=1 AND re.RE_Status=1");


//$find_empcodes = explode(",", $empcodes);
//
//
//if (($row->EMP_Reprtnmngrcode == $emp_code) || (in_array("'" . $row->EMP_Reprtnmngrcode . "'", $find_empcodes)) || ($row->EMP_Id == $empuserid)) {
//    // echo 'ok'; 
//} else {
//    //echo '<script>window.location.href="employee-dashboard.php?msg=1"</script>';
//}
//
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
<div id="main">
    <!-- //breadcrumb-->
    <div id="content" class="container">
        <div class="row">
            <div class="postbox">
                <div class="inside">
                    <header class="panel-heading sm" data-color="theme-inverse">
                        <h3>Post Travel Expense View Claim</h3>
                        <label class="color">Claim <strong> Details Display </strong></label>
                    </header>
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
                    <form class="form-horizontal" method="post" id="formUpdatePretrvRequest" name="formUpdatePretrvRequest" action="#" data-collabel="3" data-alignlabel="left" parsley-validate enctype="multipart/form-data">
                        <input type="hidden" value="1" name="ectype"/>
                        <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="req_id"  />
                        
                            <?php
							_e(requestDetails(1));
                            $approver = isApprover();
                            if ($approver) {

                                require WPERP_EMPLOYEE_VIEWS . "/employee-details.php";
                                //echo '<br>';
                            } else {

                                require WPERP_EMPLOYEE_VIEWS . "/my-details.php";
                                //echo '<br>';
                            }
                            
//			 require("employee-request-details.php");
                            //echo '<br>';
                            require WPERP_EMPLOYEE_VIEWS . "/claim-status.php";
//require("claim-status.php");
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
                                        <td align="right" width="90%" colspan="6" style="text-align:right;">Total Estimated Cost</td>
                                        <td align="right" width="10%"><?php echo IND_money_format($totCost) . ".00"; ?></td>
                                    </tr>
                                    <tr height="30">
                                        <td align="right" width="90%" colspan="6" style="text-align:right;">Total Cost</td>
                                        <td align="right"  width="10%"><?php echo IND_money_format($totalCost) . ".00"; ?></td>
                                    </tr>
                                    <?php
//$totalPaytotd=$totActCost-$actCost;
                                    ?>
                                    <tr height="30">
                                        <td align="right" width="90%" colspan="6" style="text-align:right;">Payable to Travel Desk (Rs)</td>
                                        <td align="right" width="10%"><?php echo $paytotd ? IND_money_format($paytotd) . ".00" : 'NIL'; ?> </td>
                                    </tr>
                                    <tr height="30">
                                        <td align="right" width="90%" colspan="6" style="text-align:right;">Claim Amount (Rs)</td>
                                        <td align="right"  width="10%"><?php echo IND_money_format($totalCost - $paytotd) . ".00"; ?></td>
                                    </tr>
                                </table>
                            </div>
							</div>
							</div>
							
                            <?php
							//Quote Details
							require WPERP_EMPLOYEE_VIEWS . "/quote-details.php";
							?>
                            <br />
                            <?php
                            $update_claim = "<div class='col-sm-2 col-xs-12 pull-right'><a  class=\"btn btn-warning btn-block\" href=\"admin.php?page=Submit+Claim&reqid&reqid=$reqid\">Update Claim</a></div>";

                            $curDate = date('Y-m-d');

                            $curDate = strtotime($curDate);

                            $dot = strtotime($rowsql->RD_Dateoftravel);

                            /* echo 'curdate='.$curDate."<br>";

                              echo 'date of trv='.$dot."<br>";

                              if(){ */

                            if ($curDate >= $dot) {

                                if (!$approver) {

                                    if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim where REQ_Id='$reqid'")) {

                                        if ($selclaim->PTC_Status != 2) {

                                            //echo $update_claim;
                                        }
                                    }
                                } else {
//if its my request
                                    if ($empuserid == $row->EMP_Id) {

//if its had gone for claim
                                        if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim where REQ_Id='$reqid'")) {

//if claim is not approved
                                            if ($selclaim->PTC_Status != 2) {

                                                //echo $update_claim;
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            <?php
                            $request_claimed = "<div class=\"col-sm-12\" align=\"center\"> <a class=\"btn btn-green\" onclick=\"javascript:void(0);\" style=\"width:200px;\">Request Claimed <br />
			on " . date('d/M/y', strtotime($row->REQ_ClaimDate)) . "</a> </div>";

                            $claim_approved = "<div class=\"row\" align=\"center\"> <a href=\"javascript:void(0);\" class=\"button-primary\">Claim Approved</a> </div>";

                            $action_buttons = "<div class=\"row\">
                <div class=\"col-sm-3\"></div>
                <div class=\"col-sm-3\">
                  <div class=\"form-group\">
                    <input type=\"submit\" name=\"approveClaim\" align=\"right\" id=\"approveClaim\" class=\"btn btn-success\" value=\"Approve Claim\"  />
                  </div>
                </div>
                <div class=\"col-sm-3\">
                  <div class=\"form-group\">
                    <input type=\"submit\" name=\"rejectClaim\" align=\"right\" id=\"rejectClaim\" class=\"btn btn-danger\" onclick=\"return submitClaim(2)\" value=\"Reject Claim\"  />
                  </div>
                </div>
                <div class=\"col-sm-3\">
                  <div class=\"form-group\">
                    <button type=\"button\" name=\"goback\" align=\"right\" onclick=\"javascript:window.history.back();\" class=\"btn btn-primary\">Back</button>
                  </div>
                </div>
              </div>";


                            $request_claimed_notupdated = "<div class=\"col-sm-12\" align=\"center\"> <span class=\"label label-warning\">Claimed Not Updated by Finance</span></div>";




                            if ($row->REQ_Claim) {

                                echo $request_claimed;


                                $selrow = $wpdb->get_row("SELECT * FROM payment_details where REQ_Id='$reqid' AND PD_Status=1");
                                ?>
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <div class="col-xs-offset-4">
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
                                                        $selsql = $wpdb->get_results("SELECT * FROM payment_modes");

                                                        foreach ($selsql as $rowsql) {
                                                            ?>
                                                            <option value="<?php echo $rowsql->PM_Id; ?>" <?php echo ($selrow->PM_Id == $rowsql->PM_Id) ? 'selected="selected"' : ''; ?> ><?php echo $rowsql->PM_Name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="chequeid" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>  >
                                                <div class="form-group">
                                                    <label class="control-label">Cheque Number</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber" readonly="readonly"  <?php echo ($selrow->PD_ChequeNumber) ? 'value="' . $selrow->PD_ChequeNumber . '"' : ''; ?> />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Cheque Date</label>
                                                    <div>
                                                        <div class="row">
                                                            <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" >
                                                                <input type="text" <?php /* ?>name="txtDate[]"<?php */ ?> name="txtCqDate" id="txtCqDate" readonly="readonly" class="form-control"  <?php echo ($selrow->PD_ChequeDate) ? 'value="' . $selrow->PD_ChequeDate . '"' : ''; ?>>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-times"></i></button>
                                                                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-calendar"></i></button>
                                                                </span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Issuing Bank</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch" readonly="readonly"  <?php echo ($selrow->PD_ChequeIssuingbb) ? 'value="' . $selrow->PD_ChequeIssuingbb . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="cashid" <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">
                                                    <label class="control-label">Payment Details</label>
                                                    <div>
                                                        <textarea class="form-control" data-height="auto" name="txtaCshComments" readonly="readonly" id="txtaCshComments" ><?php echo ($selrow->PD_CashPaymentDetails) ? stripslashes($selrow->PD_CashPaymentDetails) : ''; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="banktransferid" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">
                                                    <label class="control-label">Transaction Id</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtTransId" id="txtTransId"  readonly="readonly"  <?php echo ($selrow->PD_BTTransactionId) ? 'value="' . $selrow->PD_BTTransactionId . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Bank Name</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  readonly="readonly"  <?php echo ($selrow->PD_BTBankDetails) ? 'value="' . $selrow->PD_BTBankDetails . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Transaction Date</label>
                                                    <div>
                                                        <div class="row">
                                                            <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" >
                                                                <input type="text" name="txtBBDate" id="txtBBDate"  readonly="readonly" class="form-control"  <?php echo ($selrow->PD_BTTransferDate) ? 'value="' . $selrow->PD_BTTransferDate . '"' : ''; ?>>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-times"></i></button>
                                                                    <button class="btn btn-default" type="button" disabled="disabled"><i class="fa fa-calendar"></i></button>
                                                                </span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="othersid" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">
                                                    <label class="control-label">Payment Details</label>
                                                    <div>
                                                        <textarea class="form-control" data-height="auto" name="txtaOtherComments"  readonly="readonly" ><?php echo ($selrow->PD_OthersPaymentDetails) ? stripslashes($selrow->PD_OthersPaymentDetails) : ''; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <?php
                            } else {
                                if ($approver) {

                                    if (!$selmyreq = $wpdb->get_row("SELECT ptc.PTC_Id FROM pre_travel_claim ptc, requests req, request_employee re, employees emp where ptc.REQ_Id='$reqid' AND re.EMP_Id='$empuserid' AND ptc.REQ_Id=req.REQ_Id AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1")) {
                                        if ($selptc->PTC_RepMngrStatus == 1) {
                                            echo $action_buttons;
                                        }
                                    }
                                } else { // if not an approver
                                    if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim where REQ_Id='$reqid' AND PTC_Status=2")) {

                                        echo $request_claimed_notupdated;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- //content > row-->
    </div>
    <!-- //content-->
</div>
