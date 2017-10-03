<?php
$reqid = $_GET['reqid'];
$et = 1;
$showProCode = 1;
global $wpdb;
$compid = $_SESSION['compid'];
// $selsql = select_query("requests req, request_employee re", "*", "req.REQ_Id='$reqid' AND COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.RE_Status=1", $filename);

$row = $wpdb->get_row("SELECT * From requests req, employees emp, request_employee re where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND (req.REQ_Active !=9 AND REQ_Type IN (2,3,4)) AND RE_Status=1");
//print_r($row);die;)
$curdate = date('Y-m-d');
?>

<input type="hidden" name="reqcode" id="reqcode" value="<?php echo $row->REQ_Code ?>" />
<input type="hidden" name="reqtype" id="reqtype" value="<?php echo $row->REQ_Type ?>" />
<div id="content">
    <div class="row">
        <div class="col-lg-8" ></div>
        <!-- //content > row > col-lg-8 -->
        <div class="col-lg-4"></div>
        <!-- //content > row > col-lg-4 -->
    </div>
    <!-- //content > row-->
    <div class="row">
        <div class="col-lg-12" >
            <section class="panel">
                <header class="panel-heading">
                    <?php
                    $title = NULL;

                    switch ($row->REQ_Type) {

                        case 2:
                            $title = 'Without Approval';
                            break;

                        case 3:
                            $title = 'With Approval';
                            break;

                        case 4:
                            $title = 'Group';
                            break;
                    }
                    ?>
                    <h3>Travel Desk Raised Pre Travel Request Details [<?php echo $title ?> ]</h3>
                    <label class="color">Request<em><strong> Details Display</strong></em></label>
                </header>
                <div class="panel-body">

                    <?php
                    $approver = isApprover();
                    if ($row->REQ_Type != 4) {

                        if ($approver) {
                            require WPERP_EMPLOYEE_VIEWS . '/finance-details.php';
                            echo '<br>';
                        } else {
                            require WPERP_EMPLOYEE_VIEWS . '/my-details.php';
                            echo '<br>';
                        }
                    } else {
                        echo '</br/><br/>';
                        echo '<table class="wp-list-table widefat striped admins">';
                        echo '<tr>';
                        echo '<td width="20%">Employees</td>';
                        echo '<td width="5%">:</td>';
                        $selsql = $wpdb->get_results("SELECT EMP_Code, EMP_Name From request_employee re, employees emp Where re.REQ_Id='$row->REQ_Id' AND re.EMP_Id = emp.EMP_Id AND re.RE_Status=1");
                        //print_r($selsql);die;
                        $emps = NULL;

                        foreach ($selsql as $rowsql) {

                            $emps .= $rowsql->EMP_Code . '--' . $rowsql->EMP_Name . ", ";
                        }

                        $emps = rtrim($emps, ", ");

                        echo '<td width="25%">' . $emps . '</td><br/><br/>';
                    }

                    _e(requestDetails(1));
                    echo '<br>';
                    ?>
                    <div class="table-responsive">
                        <table class="wp-list-table widefat striped admins" id="table1" style="font-size:11px;">
                            <thead>
                                <tr>
                                    <th class="column-primary">Date</th>
                                    <th class="column-primary">Expense<br />
                                        Description</th>
                                    <th  class="column-primary">Expense <br />
                                        Category</th>
                                    <th class="column-primary">Place</th>
                                    <th class="column-primary">Total Cost</th>
                                    <?php
                                    if ($row->REQ_Type == 2 || ($row->REQ_Type == 3 && $row->REQ_Status == 2) || $row->REQ_Type == 4) {
                                        ?>
                                        <th class="column-primary">Booking Status</th>
                                        <th class="column-primary">Cancellation Status </th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selsql = $wpdb->get_results("SELECT * From request_details rd, expense_category ec, mode mot Where rd.REQ_Id='$row->REQ_Id' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");

                                $rdidarry = array();

                                foreach ($selsql as $rowsql) {
                                    ?>
                                    <tr>
                                        <td ><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                                        <td ><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                                        <td width="8%"><?php echo $rowsql->EC_Name; ?><br/>
                                            <?php echo $rowsql->MOD_Name; ?></td>
                                        <td ><?php
                                            if ($rowsql->EC_Id == 1) {

                                                echo '<b>From:</b> ' . $rowsql->RD_Cityfrom . '<br />
									  <b>To:</b> ' . $rowsql->RD_Cityto;
                                            } else {

                                                echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;

                                                if ($rowsd = $wpdb->get_results("Select SD_Name FROM stay_duration Where SD_Id='$rowsql->SD_Id'")) {

                                                    echo '<br>Stay :' . $rowsd->SD_Name;
                                                }
                                            }
                                            ?></td>
                                        <td ><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                                        <?php
                                        if ($row->REQ_Type == 2 || ($row->REQ_Type == 3 && $row->REQ_Status == 2) || $row->REQ_Type == 4) {
                                            ?>
                                            <td><?PHP
                                               // $imdir = "company/upload/$compid/bills_tickets/";

                                                if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {


                                                    // check for self booking

                                                    if ($selrdbs = $wpdb->get_row("Select * from booking_status  Where RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                                        echo bookingStatus(8);
                                                        
                                                        echo '<br><b>Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date));
                                                    } else {

                                                        $selrdbs = $wpdb->get_row("Select * from booking_status Where RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");

                                                        if ($selrdbs->RD_Id) {

                                                            echo bookingStatus($selrdbs->BA_Id);

                                                            $seldocs = $wpdb->get_results("SELECT * From booking_documents Where BS_Id='$selrdbs->BS_Id'");

                                                            $doc = NULL;

                                                            $f = 1;

                                                            foreach ($seldocs as $docs) {
                                                                $fileurl = WPERP_COMPANY_DOWNLOADS."/erp/modules/company/upload/" . $compid . "/bills_tickets/";

                                                                //$imdir = WPERP_COMPANY_DOWNLOADS . '/' . $compid . "/bills_tickets/";

                                                                /* $doc.='<b>Uploaded File no. ' . $f . ': </b>'.'<a href = "<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download = "file-name">download</a><br>'; */
                                                                $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $fileurl . $docs->BD_Filename . '" download = "billtickets-file" >download</a><br>';

                                                                $f++;
                                                            }



                                                            switch ($selrdbs->BA_Id) {
                                                                case 2:
                                                                    echo '<br><b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
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

                                                    echo bookingStatus(NULL);
                                                }
                                                ?></td>
                                            <td><?PHP
                                           
                                                if (in_array($rowsql->MOD_Id, array(1, 2, 5))) {
                                                    // check for self booking

                                                    if ($selrdbss = $wpdb->get_results("Select * from booking_status Where RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                                        echo bookingStatus(NULL);
                                                    } else {
                                                        $selrdcs = $wpdb->get_results("Select * from booking_status Where RD_Id='$rowsql->RD_Id' AND BS_Status=3 AND BS_Active=1");
                                                        if (!empty($selrdcs->RD_Id)) {
                                                            if ($selrdcs->RD_Id) {

                                                                echo bookingStatus($selrdcs->BA_Id);

                                                                $doc = NULL;

                                                                if ($selrdcs->BA_Id == 6) {

                                                                    $seldocs = $wpdb->get_results("SELECT * From booking_documents Where BS_Id='$selrdcs->BS_Id'");

                                                                    $f = 1;

                                                                    foreach ($seldocs as $docs) {

                                                                        $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="download-file.php?file=' . $imdir . $docs->BD_Filename . '" class="btn btn-link">download</a><br>';

                                                                        $f++;
                                                                    }
                                                                }

                                                                switch ($selrdcs->BA_Id) {

                                                                    case 6:
                                                                        echo '<br><b>Cancellation Amnt:</b> ' . IND_money_format($selrdcs->BS_CancellationAmnt) . '.00<br>';
                                                                        echo $doc;
                                                                        echo '<b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate)) . "<br>";
                                                                        break;

                                                                    case 7:
                                                                        echo '<br><b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate)) . "<br>";
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
                                                ?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    /* if(!$rowsql[RD_Duplicate])
                                      $totalcost+=$rowsql->RD_Cost; */

                                    /* echo 'Cancellation='.$selrdcs->BS_CancellationAmnt."<br>";

                                      echo 'Booking='.$selrdbs->BS_TicketAmnt."<br>"; */
                                    if (!empty($selrdcs->BS_CancellationAmnt)) {
                                        if ($selrdcs->BS_CancellationAmnt) {
                                             $totalcost = "";
                                            $totalcost+=$selrdcs->BS_CancellationAmnt;
                                        } 
                                    }
                                    if(!empty($selrdbs->BS_TicketAmnt)) {
                                             $totalcost = "";

                                            $totalcost+=$selrdbs->BS_TicketAmnt;
                                        }

                                        array_push($rdidarry, $rowsql->RD_Id);
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <table class="wp-list-table widefat striped admins" style="font-weight:bold;">
                            <tr>
                                <td align="right" width="85%">Total Cost</td>
                                <td align="center" width="5%">:</td>
                                <td align="right" width="10%"><?php echo IND_money_format($totalcost) . ".00"; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <p>&nbsp;</p>
                    <div id="quoteDivId">
                        <?php
//print_r($rdidarry);

                        $a = 1;
                        foreach ($rdidarry as $rdid) {

                            //echo 'Rdid='.$rdid;
                            $selrgquote = $wpdb->get_results("SELECT * From request_getquote rg, get_quote_flight gqf Where RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1 ORDER BY GQF_Price ASC");

                            if (count($selrgquote)) {


                                if ($rowRdDetails = $wpdb->get_results("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id From request_details rd, mode mo Where RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")) {
                                    ?>
                                    <div id="field<?php echo $i; ?>" class="col-sm-6">
                                        <div class="table-responsive">
                                            <table class="wp-list-table widefat striped admins">
                                                <thead>
                                                    <tr>
                                                        <th><?PHP echo $rowRdDetails->MOD_Name; ?></th>
                                                        <?php if ($rowRdDetails->MOD_Name == "Flight" || $rowRdDetails->MOD_Name == "Bus") { ?>
                                                            <th><?php echo date('D, d F, Y', strtotime($rowRdDetails->RD_Dateoftravel)); ?></th>
                                                            <th><?php echo $rowRdDetails->RD_Cityfrom ?> to <?php echo $rowRdDetails->RD_Cityto ?></th>
                                                            <?php
                                                        }

                                                        if ($rowRdDetails->MOD_Name == "Hotel") {

                                                            $staydays = "+" . $rowRdDetails->SD_Id . " day";

                                                            $date = strtotime($staydays, strtotime($rowRdDetails->RD_Dateoftravel));

                                                            $checkoutdate = date("Y-m-d", $date);
                                                            ?>
                                                            <th>
                                                                <?php echo " Check-In: " . date('D, d F Y', strtotime($rowRdDetails->RD_Dateoftravel)) . ", <br> Check-Out: " . date('D, d F Y', strtotime($checkoutdate)); ?>
                                                            </th>
                                                            <th><?php echo $rowRdDetails->RD_Cityfrom ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <?php if ($rowRdDetails->MOD_Name == "Flight" || $rowRdDetails->MOD_Name == "Bus") { ?>
                                            <div class="table-responsive">
                                                <table class="wp-list-table widefat striped admins" style="font-size:10px;">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>DEPARTURE</th>
                                                            <th>ARRIVAL</th>
                                                            <th><?php
                                                                if ($rowRdDetails->MOD_Id == '1')
                                                                    echo 'DURATION';
                                                                else
                                                                    echo 'Seats';
                                                                ?></th>
                                                            <th style="text-align:right">PRICE (Rs)&nbsp;&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody align="center">
                                                        <?php
                                                        foreach ($selrgquote as $rowrgquote) {


                                                            if ($rowrgquote->MOD_Id == '2') {

                                                                $flightname = 'Bus';
                                                            } else {

                                                                $flightname = $rowrgquote->GQF_AirlineName;

                                                                $flightname = preg_replace('~[\r\n]+~', '', $flightname);
                                                            }


                                                            $style = NULL;

                                                            if ($rowrgquote->RG_Pref == 2)
                                                                $style = 'style="background-color:#E0F0FF;"';
                                                            ?>
                                                            <tr >
                                                                <td <?php echo $style; ?>><span class="logo pull-left text-left <?php echo getFlightLogo($flightname); ?>"></span><br />
                                                                    <?php echo $rowrgquote->GQF_AirlineName; ?><br />
                                                                    <?php echo ($rowRdDetails->MOD_Name == 'Flight') ? $rowrgquote->GQF_AirlineCode : NULL; ?> - <?php echo $rowrgquote->GQF_FlightNumber; ?></td>
                                                                <td  <?php echo $style; ?>><?php echo date('h:i a', strtotime($rowrgquote->GQF_DepTIme)); ?><br />
                                                                    <?php echo $rowrgquote->GQF_Origin; ?> </td>
                                                                <td <?php echo $style; ?>><?php echo date('h:i a', strtotime($rowrgquote->GQF_ArrTime)); ?> <br />
                                                                    <?php echo $rowrgquote->GQF_Destination; ?></td>
                                                                <td <?php echo $style; ?>><?php echo $rowrgquote->GQF_Duration; ?> [
                                                                    <?php
                                                                    if ($rowRdDetails->MOD_Name == 'Flight') {

                                                                        if ($rowrgquote->GQF_Stops == 0)
                                                                            echo "Non Stop";
                                                                        else
                                                                            echo $rowrgquote->GQF_Stops . " Stop";
                                                                    } else if ($rowRdDetails->MOD_Name == 'Bus') {

                                                                        echo $rowrgquote->GQF_Stops . " Seats";
                                                                    }
                                                                    ?>
                                                                    ]</td>
                                                                <td <?php echo $style; ?> class="text-right"><?php echo IND_money_format($rowrgquote->GQF_Price); ?>&nbsp;&nbsp;</td>
                                                            </tr>
                                                            <!-- end ngRepeat: flt in (filterdlist=(flights|masterfilter:journeyFilterRequest:filterData.dep))|orderBy:sortFn:order|limitTo:displayed -->
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                        }
                                        if ($rowRdDetails->MOD_Name == "Hotel") {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="wp-list-table widefat striped admins" style="font-size:10px;">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>HOTEL NAME</th>
                                                            <th>ROOM CATEGORY</th>
                                                            <th>ROOM TYPE</th>
                                                            <th style="text-align:right">PRICE (Rs)&nbsp;&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody align="center">
                                                        <?php
                                                        foreach ($selrgquote as $rowrgquote) {

                                                            $style = NULL;

                                                            if ($rowrgquote->RG_Pref == 2)
                                                                $style = 'style="background-color:#E0F0FF; text-align:center;"';
                                                            ?>
                                                            <tr >
                                                                <td data-title="ROOM IMAGE" style="width:10%" <?php echo $style; ?>><?PHP if ($rowrgquote->GQF_DepTIme) { ?>
                                                                        <img class="img-responsive img-rounded" width="50" height="50" align="absmiddle" src="<?php echo $rowrgquote->GQF_DepTIme; ?>" />
                                                                    <?php } else echo '<span>N/A</span>'; ?></td>
                                                                <td data-title="HOTEL"  <?php echo $style; ?>><?php echo strip_tags($rowrgquote->GQF_AirlineName); ?></td>
                                                                <td data-title="ROOM CATEGORY" <?php echo $style; ?>><?php echo $rowrgquote->GQF_FlightNumber; ?></td>
                                                                <td data-title="ROOM TYPE" <?php echo $style; ?>><?php echo $rowrgquote->GQF_ArrTime; ?></td>
                                                                <td data-title="PRICE" <?php echo $style; ?> align="right" ><?php echo IND_money_format($rowrgquote->GQF_Price); ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                            }


                            $a++;
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <p>&nbsp;</p>
                    </form>
                    <br />
                    <br />
                    <div id="chatContainer">
                        <?php
                        $val = 1;
                        _e(chat_box(1, '1'));
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    <br />
                    <br />
                    <?php
                    //print_r($selsql);
                        $selsql = $wpdb->get_row("SELECT * from requests req, request_employee re, employees emp where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND req.COM_Id='$compid' AND RE_Status=1");
                        
                 // $selsql = $wpdb->get_results("SELECT * from requests req, request_employee re where req.REQ_Id='$reqid' AND COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.RE_Status=1");
    // print_r($selsql);
              $selrepmngrid = $wpdb->get_row("SELECT EMP_Id FROM employees where EMP_Code='$selsql->EMP_Reprtnmngrcode'");
               // print_r($selrepmngrid);die;
                    $action_buttons = "
              <input type=\"hidden\" value=\"" . $reqid . "\" name=\"reqid\" id=\"reqid\"  />
			  <input type=\"hidden\" value=" . $selrepmngrid->EMP_Id . " name=\"empid\">
			  
			  <div class=\"row\">
                <div class=\"col-sm-3\"></div>
                <div class=\"col-sm-3\">
                  <div class=\"form-group\"> 
                    <input type=\"submit\" name=\"approveAccGrpClaim\" id=\"approveAccGrpClaim\" class=\"btn btn-success\" onclick=\"return submitAccClaim(1)\" value=\"Approve\"  />
                  </div>
                </div>
                <div class=\"col-sm-3\">
                  <div class=\"form-group\">
                    <input type=\"submit\" name=\"rejectAccGrpClaim\" id=\"rejectAccGrpClaim\" class=\"btn btn-theme\" onclick=\"return submitAccClaim(2)\" value=\"Reject\"  />
                  </div>
                </div>
                <div class=\"col-sm-3\">
                  <div class=\"form-group\">
                    <button type=\"button\" name=\"goback\" onclick=\"javascript:window.history.back();\" class=\"btn btn-info btn-transparent\">Back</button>
                  </div>
                </div>
              </div>
			  
			   </form>
			  ";

//echo 'ReqClaim='.$row->REQ_Claim	  ;

                    if ($row->REQ_Claim) {

                        echo '<div class="row" align="center"> <a href="javascript:void(0);" class="btn btn-success">Request Claimed on ' . date("d/m/y", strtotime($row->REQ_ClaimDate)) . '</a> </div> ';

                        //$selrow=$wpdb->get_results("Selectpayment_details", Where, "REQ_Id='$reqid' AND PD_Status=1");

                        $selrow = $wpdb->get_results("Select payment_details pd, payment_modes pm Where REQ_Id='$reqid' AND PD_Status=1 and pd.PM_Id=pm.PM_Id");

                        //echo $selrow->PD_Id;
                        ?>
                        <br />
                        <br />
                        <div class="col-xs-offset-4">
                            <section class="panel">
                                <header class="panel-heading">
                                    <h3>Payment Details</h3>
                                </header>
                                <div class="panel-body">

                                    <div id="detailsformid">
                                        <ul class="list-group">
                                            <li class="list-group-item"><span class="badge"><?php echo $selrow->PM_Name; ?></span> Payment mode</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge"><?php echo ($selrow->PD_ChequeNumber) ? 'value="' . $selrow->PD_ChequeNumber . '"' : ''; ?></span> Cheque Number</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge"><?php echo ($selrow->PD_ChequeDate) ? 'value="' . $selrow->PD_ChequeDate . '"' : ''; ?></span> Cheque Date</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 1) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_ChequeIssuingbb) ? 'value="' . $selrow->PD_ChequeIssuingbb . '"' : ''; ?>
                                                </span> Issuing Bank</li>
                                            <li class="list-group-item"  <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_CashPaymentDetails) ? stripslashes($selrow->PD_CashPaymentDetails) : ''; ?>
                                                </span> Payment Details</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_BTTransactionId) ? 'value="' . $selrow->PD_BTTransactionId . '"' : ''; ?>
                                                </span> Transaction Id</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_BTBankDetails) ? 'value="' . $selrow->PD_BTBankDetails . '"' : ''; ?>
                                                </span> Bank Name</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_BTTransferDate) ? 'value="' . $selrow->PD_BTTransferDate . '"' : ''; ?>
                                                </span> Transaction Date</li>
                                            <li class="list-group-item" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>><span class="badge">
                                                    <?php echo ($selrow->PD_OthersPaymentDetails) ? stripslashes($selrow->PD_OthersPaymentDetails) : ''; ?>
                                                </span> Payment Details</li>
                                        </ul>
                                        <div class="form-group offset">
                                            <div>
                                                <button name="buttonedit" id="buttonedit" class="btn btn-theme" type="button" >Edit</button>
                                                <!-- <button type="button" class="btn" >Cancel</button>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div id="updateformid" style="display:none;">
                                        <form class="form-horizontal" data-collabel="3" data-alignlabel="left" parsley-validate  data-label="color"  name="form1" method="post" action="action.php?reqid=<?php echo $reqid; ?>">
                                            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid" >
                                            <div class="form-group">
                                                <label class="control-label">Payment mode</label>
                                                <div>
                                                    <select class="form-control" name="selPaymentMode" id="selPaymentMode" parsley-required="true">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $selsql = $selsql = $wpdb->get_results("SELECT * From payment_modes");

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
                                                        <input type="text" class="form-control" name="txtChequeNumber" id="txtChequeNumber"  <?php echo ($selrow->PD_ChequeNumber) ? 'value="' . $selrow->PD_ChequeNumber . '"' : ''; ?> />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Cheque Date</label>
                                                    <div>
                                                        <div class="row">
                                                            <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" >
                                                                <input type="text" <?php /* ?>name="txtDate[]"<?php */ ?> name="txtCqDate" id="txtCqDate" class="form-control"  <?php echo ($selrow->PD_ChequeDate) ? 'value="' . $selrow->PD_ChequeDate . '"' : ''; ?>>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
                                                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                </span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Issuing Bank</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtBankBranch" id="txtBankBranch"  <?php echo ($selrow->PD_ChequeIssuingbb) ? 'value="' . $selrow->PD_ChequeIssuingbb . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="cashid" <?php echo ($selrow->PM_Id == 2) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">
                                                    <label class="control-label">Payment Details</label>
                                                    <div>
                                                        <textarea class="form-control" data-height="auto" name="txtaCshComments" id="txtaCshComments" ><?php echo ($selrow->PD_CashPaymentDetails) ? stripslashes($selrow->PD_CashPaymentDetails) : ''; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="banktransferid" <?php echo ($selrow->PM_Id == 3) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">
                                                    <label class="control-label">Transaction Id</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtTransId" id="txtTransId"  <?php echo ($selrow->PD_BTTransactionId) ? 'value="' . $selrow->PD_BTTransactionId . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Bank Name</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="txtBankdetails" id="txtBankdetails"  <?php echo ($selrow->PD_BTBankDetails) ? 'value="' . $selrow->PD_BTBankDetails . '"' : ''; ?>/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Transaction Date</label>
                                                    <div>
                                                        <div class="row">
                                                            <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" >
                                                                <input type="text" <?php /* ?>name="txtDate[]"<?php */ ?> name="txtBBDate" id="txtBBDate" class="form-control"  <?php echo ($selrow->PD_BTTransferDate) ? 'value="' . $selrow->PD_BTTransferDate . '"' : ''; ?>>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
                                                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                </span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="othersid" <?php echo ($selrow->PM_Id == 4) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="form-group">
                                                    <label class="control-label">Payment Details</label>
                                                    <div>
                                                        <textarea class="form-control" data-height="auto" name="txtaOtherComments" ><?php echo ($selrow->PD_OthersPaymentDetails) ? stripslashes($selrow->PD_OthersPaymentDetails) : ''; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group offset">
                                                <div>
                                                    <button name="buttonClaimed" id="buttonClaimed" class="btn btn-theme" type="submit">Update</button>
                                                    <button type="reset" class="btn" id="detailscancelid">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <?php
                        
                    } else {
			
                        //echo  'Req Status='.$row->REQ_Status;

                        $flag = 0;

                        if ($row->REQ_Type == 4) {

                            $flag = 1;
                        }


                        if ($row->REQ_Status == 2) {
                            if (!$flag) {
                                ?>
                                <div class="col-xs-offset-4">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            <h3>Payment Details</h3>
                                        </header>
                                        <div class="panel-body">
                                            <form class="form-horizontal" data-collabel="3" data-alignlabel="left" parsley-validate  data-label="color"  name="form1" method="post" action="action.php?reqid=<?php echo $reqid; ?>">
                                                <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid" >
                                                <div class="form-group">
                                                    <label class="control-label">Payment mode</label>
                                                    <div>
                                                        <select class="form-control" name="selPaymentMode" id="selPaymentMode" parsley-required="true">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $selsql = $selsql = $wpdb->get_results("SELECT * From payment_modes");

                                                            foreach ($selsql as $rowsql) {
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
                                                            <div class="row">
                                                                <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" >
                                                                    <input type="text" <?php /* ?>name="txtDate[]"<?php */ ?> name="txtCqDate" id="txtCqDate" class="form-control"  >
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                    </span> </div>
                                                            </div>
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
                                                            <div class="row">
                                                                <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left"  data-date-format="dd MM yyyy - HH:ii p" >
                                                                    <input type="text" <?php /* ?>name="txtDate[]"<?php */ ?> name="txtBBDate" id="txtBBDate" class="form-control"  >
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                    </span> </div>
                                                            </div>
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
                                                <div class="form-group offset">
                                                    <div>
                                                        <button name="buttonClaimed" id="buttonClaimed" class="btn btn-theme" type="submit">Submit</button>
                                                        <button type="reset" class="btn" >Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                                <?php
                            }
                        } else {

                            echo $action_buttons;
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>
