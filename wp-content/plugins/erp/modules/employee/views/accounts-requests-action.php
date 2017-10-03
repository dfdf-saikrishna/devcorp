 
<p>&nbsp;</p>
<style type="text/css">
    #my_centered_buttons { text-align: center; width:100%;}
</style>
<?php
global $workflow;
global $travel;
global $wpdb;
$compid = $_SESSION['compid'];
$reqid = $_GET['reqid'];
$selExpType = $_GET['selExpenseType'];
//echo $selExpType;die;
$empuserid = $_SESSION['empuserid'];
$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re Where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1");
if($row->REQ_PreToPostStatus){
	$et = "1";
}
if ($row->REQ_Claim) {
    echo '<br /><br /><div class="col-sm-12" align="center"><button name="buttonClaimed" class="button button-primary" style="width:200px;"  type="button" onclick="javascript:void(0);">Request Claimed  on ' . date("d/M/y", strtotime($row->REQ_ClaimDate)) . '</a> </div>';
} else {
    $actionButtons = '<br />
        <div id="my_centered_buttons" class="financeactions">
        <a href="" id="submitApprove" name="submitApprove" class="btn btn-success">Approve</a> 
        <button type="button" name="submitReject" id="submitReject" class="btn btn-danger">Reject</button>
        <button type="button" name="back" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
        </div>';
    $request = $wpdb->get_row("SELECT * FROM requests req, request_employee re Where req.REQ_Id='$reqid' AND COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.RE_Status=1");
    $empid = $request->EMP_Id;


    //$approver = isApprover();


    $limitFlag = '<div id="notice" class="notice notice-warning is-dismissible"><p id="p-notice">Sorry. Total expense cost exceeded your approval limit.</p></div>';

    // checking reporting manager has approved ?

    $repMngrApprvd = 0;

    if ($selMngrStatus = $wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=1 AND REQ_Status=2 AND RS_Status=1"))
        $repMngrApprvd = 1;

    // checking second level manager has approved ?

    $secMngrApprvd = 0;

    if ($selsecMngrStatus = $wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=5 AND REQ_Status=2 AND RS_Status=1"))
        $secMngrApprvd = 1;

    // checking finance has approved ?

    $finApprvd = 0;

    if ($selMngrStatus = $wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=2 AND REQ_Status IN (2,4) AND RS_Status=1"))
        $finApprvd = 1;


    // finance approval limit

    $limit = 0;

    //echo 'Total Cost='.$totalcost;

    if ($selfinlimit = $wpdb->get_row("SELECT APL_LimitAmount FROM approval_limit WHERE EMP_Id=$empuserid AND APL_Status=1 AND APL_Status IS NOT NULL AND APL_Active=1")) {

        $limit_amnt = $selfinlimit->APL_LimitAmount;

        if ($limit_amnt <= $totalcost)
            $limit = 1;
    }

    $mydetails = myDetails();
    $emp_code = $mydetails->EMP_Code;
    $workflow = workflow();
    switch ($et) {
        case 1:

            $expPol = $workflow->COM_Pretrv_POL_Id;
            break;

        case 2:

            $expPol = $workflow->COM_Posttrv_POL_Id;
            break;

        case 3:

            $expPol = $workflow->COM_Othertrv_POL_Id;
            break;

        case 5:

            $expPol = $workflow->COM_Mileage_POL_Id;
            break;

        case 6:

            $expPol = $workflow->COM_Utility_POL_Id;
            break;
    }
    if ($travel) {
        $filename = 'accounts-travel-desk-request-details.php';
        $expPol = 4;
    }
    switch ($expPol) {
        // employee --> rep manager --> finance

        case 1:

            //if its not my request and approval is waiting from sec manager
            if ($secMngrApprvd) {

                if (!$finApprvd) {

                    if (!$limit)
                        echo $actionButtons;
                    else
                        echo $limitFlag;
                }
            }
            //if its not my request and approval is waiting from rep manager
            else if ($repMngrApprvd) {

                if (!$finApprvd) {

                    if (!$limit)
                        echo $actionButtons;
                    else
                        echo $limitFlag;
                }
            }


            break;



        // employee --> finance --> rep manager

        case 2:
        if (!$finApprvd) {
            if (!$limit)
                echo $actionButtons;
            else
                echo $limitFlag;
        }
            break;
        // employee -- > finance
        case 4:
            //if($secMngrApprvd) 
            //{
            if (!$finApprvd) {

                if (!$limit)
                    echo $actionButtons;
                else
                    echo $limitFlag;
            }
            //}
//                    else if(!$secMngrApprvd){
//                        if(!$finApprvd){
//				
//				if(!$limit)
//				echo $actionButtons;
//				else
//				echo $limitFlag;
//				
//			}
//                    }

            break;
    }
}
?>
<?php
//echo 'req stat='.$row['REQ_Status'];


if ($row->REQ_Status == 2) {
    ?>


    <div class="col-lg-121">
        <?php
        // echo $row->REQ_Status; 
//if its a pre travel request this block is not needed here
        if ($et != 1) {

            if ($row->REQ_Status == 2) {

                if (!$row->REQ_Claim) {
                    ?>
                    <style type="text/css">
                        #my_centered_buttons { text-align: center; width:100%;}

                    </style>
                    <div class="col-lg-12">
                        <div style="display:none" align="center" id="failure" class="notice notice-error is-dismissible">
                            <p id="p-failure"></p>
                        </div>
                        <div style="display:none" align="center" id="success" class="notice notice-success is-dismissible">
                            <p id="p-success"></p>
                        </div>
                        <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"  />
                        <input type="hidden" value="<?php echo $et; ?>" name="et" id="et"  />
                        <input type="hidden" value="<?php echo $selExpType; ?>" name="selExpenseType" id="selExpenseType"  />
                        <input type="hidden" value="<?php echo $travel; ?>" name="travel" id="travel" />
                        <div class="col-xs-offset-4">
                            <section class="panel">
                                <div class="panel-body" align="right">
                                    <h3>Payment Details</h3>
                                    <form class="form-horizontal" data-collabel="3" data-alignlabel="left" parsley-validate  data-label="color"  name="form1" method="post" action="">
                                        <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid" >
                                        <input type="hidden" value="<?php echo $et; ?>" name="et" id="et"  />
                                        <div class="form-group"><br/>
                                            <label class="control-label"><code>Payment mode</code></label>

                                            <select class="form-control" name="selPaymentMode" id="selPaymentMode" parsley-required="true" style="
    float: right;
">
                                                <option value="">Select</option>
                                                <?php
                                                $selpayModes = $wpdb->get_results("SELECT * FROM payment_modes");

                                                foreach ($selpayModes as $value) {
                                                    ?>
                                                    <option value="<?php echo $value->PM_Id; ?>"  ><?php echo $value->PM_Name; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div id="chequeid" style="display:none;">
                                            <div class="form-group">
                                                <label class="control-label"><code>Cheque Number</code></label>
                                                <input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber"   />
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                $rows = 1;
                                                ?>
                                                <br/>
                                                <label class="control-label"><code>Cheque Date</code></label>
                                                <input type="text"  name="txtCqDate" id="txtCqDate" class="erp-date-field" placeholder="dd/mm/yyyy" autocomplete="off"/>
                                            </div>   <br/>
                                            <div class="form-group">
                                                <label class="control-label"><code>Issuing Bank</code></label>
                                                <input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch"  />
                                            </div>
                                        </div>   <br/>
                                        <div id="cashid" style="display:none;">
                                            <div class="form-group">
                                                <label class="control-label"><code>Payment Details</code></label>
                                                <textarea class="form-control" data-height="auto" name="txtaCshComments" id="txtaCshComments" ></textarea>
                                            </div>
                                        </div>   
                                        <div id="banktransferid" style="display:none;"><br/>
                                            <div class="form-group">
                                                <div>
                                                    <label class="control-label"><code>Transaction Id</code></label>
                                                    <input type="text" class="form-control" name="txtTransId" id="txtTransId"  />
                                                </div>
                                            </div>  
                                            <div class="form-group"> <br/>
                                                <label class="control-label"><code>Bank Name</code></label>

                                                <input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  />

                                            </div>   <br/>
                                            <div class="form-group">
                                                <label class="control-label"><code>Transaction Date</code></label>
                                                <input type="text" name="txtBBDate" id="txtBBDate" class="erp-date-field" paleceholder="d/m/y" >
                                            </div>
                                        </div>   <br/>
                                        <div id="othersid" style="display:none;">
                                            <div class="form-group">
                                                <label class="control-label"><code>Payment Details</code></label>
                                                <textarea class="form-control" data-height="auto" id="txtaOtherComments" name="txtaOtherComments" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group offset" style="
    margin-top: 65px;
"><br/>
                                            <div>
                                                <button name="buttonClaimed" id="buttonClaimed" class="button button-primary" type="submit">Submit</button>
                                                <button type="reset" class="button button-primary">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <?php
                    } else if ($row->REQ_Claim) {

                        $selrow = $wpdb->get_row("SELECT * FROM payment_details pd, payment_modes pm where REQ_Id='$reqid' AND PD_Status=1 and pd.PM_Id=pm.PM_Id");

                        //echo 'PAYMENT='.$selrow[PM_Id;
                        ?>
                        <br />
                        <br />
                        <div class="col-sm-4"> </div>
                        <div class="col-sm-81" style="text-align:right;">
                            <section class="panel">
                                <header class="panel-heading">
                                    <h3>Payment Details</h3>
                                </header>
                                <div class="panel-body">
                                    <div id="detailsformid" style="text-align:right;">
                                        <ul class="list-group">
                                            <li class="list-group-item"><span class="badge"><?php echo $selrow->PM_Name; ?></span> <span class="badge12" style="
    margin-right: 15px;
    /* margin-left: -18px; */
">Payment mode : </span></li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge"><?php echo ($selrow->PD_ChequeNumber) ? $selrow->PD_ChequeNumber : ''; ?></span><span class="badge12" style="
    margin-right: 15px;
    /* margin-left: -18px; */
"> Cheque Number : </span></li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge"><?php echo ($selrow->PD_ChequeDate) ? $selrow->PD_ChequeDate : ''; ?></span> Cheque Date</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_ChequeIssuingbb) ? $selrow->PD_ChequeIssuingbb : ''; ?>
                                                </span> Issuing Bank</li>
                                            <li class="list-group-item"  <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_CashPaymentDetails) ? stripslashes($selrow->PD_CashPaymentDetails) : ''; ?>
                                                </span> <span class="badge12" style="
    margin-right: 15px;
    /* margin-left: -18px; */
">Payment Details : </span></li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_BTTransactionId) ? $selrow->PD_BTTransactionId : ''; ?>
                                                </span> Transaction Id</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_BTBankDetails) ? $selrow->PD_BTBankDetails : ''; ?>
                                                </span> Bank Name</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_BTTransferDate) ? $selrow->PD_BTTransferDate : ''; ?>
                                                </span> Transaction Date</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_OthersPaymentDetails) ? stripslashes($selrow->PD_OthersPaymentDetails) : ''; ?>
                                                </span> Payment Details</li>
<li class="list-group-item" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:block;"'; ?>><button name="buttonedit" id="buttonedit" class="button button-primary" type="button" >Edit</button></li>
                                        </ul>
                                        <div class="form-group offset">
                                            <div>
                                               <!-- <button name="buttonedit" id="buttonedit" class="button button-primary" type="button" >Edit</button>-->
                                                <!-- <button type="button" class="btn" >Cancel</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div id="updateformid" style="display:none;">
                                        <form class="form-horizontal" data-collabel="3" data-alignlabel="left" parsley-validate  data-label="color"  name="form1" method="post" action="action.php?reqid=<?php echo $reqid; ?>">
                                            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid" >
                                            <div class="form-group">   <br/>
                                                <label class="control-label"><code>Payment mode</code></label>
                                                <select class="form-control" name="selPaymentMode" id="selPaymentMode" parsley-required="true" style="
    float: right;
">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $selsql = $wpdb->get_results("SELECT * FROM  payment_modes");

                                                    foreach ($selsql as $rowsql) {
                                                        ?>
                                                        <option value="<?php echo $rowsql->PM_Id; ?>" <?php echo ($selrow->PM_Id == $rowsql->PM_Id) ? 'selected="selected"' : ''; ?> ><?php echo $rowsql->PM_Name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div id="chequeid" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>  >
                                                <div class="form-group">   <br/>
                                                    <label class="control-label"><code>Cheque Number</code></label>
                                                    <input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber"  <?php echo ($selrow->PD_ChequeNumber) ? 'value="' . $selrow->PD_ChequeNumber . '"' : ''; ?> />
                                                </div>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label"><code>Cheque Date</code></label>
                                                    <input type="text" name="txtCqDate" id="txtCqDate" class="erp-date-field"  placeholder="d/m/y" <?php echo ($selrow->PD_ChequeDate) ? 'value="' . $selrow->PD_ChequeDate . '"' : ''; ?>>
                                                </div>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label"><code>Issuing Bank</code></label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch"  <?php echo ($selrow->PD_ChequeIssuingbb) ? 'value="' . $selrow->PD_ChequeIssuingbb . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="cashid" <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label">Payment Details</label>
                                                    <textarea class="form-control" data-height="auto" name="txtaCshComments" id="txtaCshComments" style="
    width: 30%;
    float: right;
" ><?php echo ($selrow->PD_CashPaymentDetails) ? stripslashes($selrow->PD_CashPaymentDetails) : ''; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div id="banktransferid" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label"><code>Transaction Id</code></label>
                                                    <input type="text" class="form-control" name="txtTransId" id="txtTransId"  <?php echo ($selrow->PD_BTTransactionId) ? 'value="' . $selrow->PD_BTTransactionId . '"' : ''; ?>/>
                                                </div>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label"><code>Bank Name</code></label>
                                                    <input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  <?php echo ($selrow->PD_BTBankDetails) ? 'value="' . $selrow->PD_BTBankDetails . '"' : ''; ?>/>
                                                </div>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label"><code>Transaction Date</code></label>
                                                    <input type="text" name="txtBBDate" id="txtBBDate" class="erp-date-field" placeholder="d/m/y" <?php echo ($selrow->PD_BTTransferDate) ? 'value="' . $selrow->PD_BTTransferDate . '"' : ''; ?>>
                                                </div>
                                            </div>
                                            <div id="othersid" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">   <br/>
                                                    <label class="control-label">Payment Details</label>
                                                    <textarea class="form-control" data-height="auto" id="txtaOtherComments" name="txtaOtherComments" ><?php echo ($selrow->PD_OthersPaymentDetails) ? stripslashes($selrow->PD_OthersPaymentDetails) : ''; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group offset" style="
    margin-top: 65px;
">
                                                <div >
                                                    <button name="buttonClaimed" id="buttonClaimed" class="button button-primary" type="submit">Update</button>
                                                    <button type="reset"class="button button-primary"  id="detailscancelid">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div> <input type="hidden" name="action" id="erp-finance-action" value="approve_finance_request">
    </div> <input type="hidden" name="action" id="erp-finance-action" value="approve_finance_reject">
    <input type="hidden" name="action" id="erp-payment-action" value="all_payment_details_create">

<?php } ?>
