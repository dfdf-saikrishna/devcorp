<?php
$reqid = $_GET['reqid'];
$et = 4;

$row = $wpdb->get_results("SELECT * FROM requests req, request_employee re where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND req.REQ_Active=1 AND re.RE_Status=1");

$empid = $row->EMP_Id;
?>

<div id="main">
    <!-- //breadcrumb-->
    <div id="content">
        <div class="row">
            <div class="col-lg-8" ></div>
            <!-- //content > row > col-lg-8 -->
            <div class="col-lg-4"></div>
            <!-- //content > row > col-lg-4 -->
            <div style="display:none" align="center" id="failure" class="notice notice-error is-dismissible">
                <p id="p-failure"></p>
            </div>
            <div style="display:none" align="center" id="success" class="notice notice-success is-dismissible">
                <p id="p-success"></p>
            </div>
            <!-- //content > row-->
            <div class="row">
                <div class="col-lg-12" >
                    <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"  />
                    <input type="hidden" value="<?php echo $et; ?>" name="et" id="et"  />
                    <input type="hidden" value="<?php echo $travel; ?>" name="travel" id="travel" />
                    <section class="panel">
                        <header class="panel-heading">
                            <h3>Pre Travel Expense Request Details</h3>
                            <label class="color">Request<em><strong> Details Display</strong></em></label>
                        </header>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <tbody>
                                        <tr>
                                            <td width="20%">Request Id:</td>
                                            <td width="5%">:</td>
                                            <td width="25%"><b><?php echo $row->REQ_Code; ?></b></td>
                                            <?php
                                            $fin_block = '<td width="20%">Finance Approval</td>
					<td width="5%">:</td>
					<td width="25%">';

                                            $finRow = 0;

                                            if ($selFinance = $wpdb->get_row("SELECT * FROM request_status where REQ_Id='$reqid' AND RS_EmpType=2  AND RS_Status=1")) {
                                                $finRow = 1;

                                                $approvals = approvals($selFinance->REQ_Status);

                                                $fin_block.=$approvals;

                                                $rsdate = " on " . date('d-M, y', strtotime($selFinance->RS_Date));

                                                $fin_block.=$rsdate;
                                            } else {

                                                $approvals = approvals(1);

                                                $fin_block.=$approvals;
                                            }


                                            $fin_block.='</td>';

                                            $expPol = 4;

                                            echo $fin_block;
                                            ?>
                                        </tr>
                                        <!---- SECOND ROW ---->
                                        <tr>
                                            <td width="20%">Request Date:</td>
                                            <td width="5%">:</td>
                                            <td width="25%"><?php echo date('d-M-y h:i a', strtotime($row->REQ_Date)); ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p style="border-bottom:thin dashed #000000;">&nbsp;</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="font-size:11px;">
                                    <thead>
                                        <tr>
                                            <th width="10%">Date</th>
                                            <th width="15%">Expense Description</th>
                                            <th width="15%" colspan="2">Expense Category</th>
                                            <th width="10%">Place</th>
                                            <th width="10%">Estimated Cost</th>
                                            <th width="20%">Booking Status</th>
                                            <th width="20%">Cancellation Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selsql = $wpdb->get_row("SELECT * FROM request_details rd, expense_category ec, mode mot where rd.REQ_Id='$reqid' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");

                                        foreach ($selsql as $rowsql) {
                                            ?>
                                            <tr>
                                                <td align="center"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                                                <td><div style="height:40px; overflow-y:auto;" align="justify"><?php echo $rowsql->RD_Description; ?></div></td>
                                                <td width="15%"><?php echo $rowsql->EC_Name; ?></td>
                                                <td width="17%"><?php echo $rowsql->MOD_Name; ?></td>
                                                <td style="font-size:11px;"><?php if ($rowsql->EC_Id == 1) { ?>
                                                        <b>From:</b> <?php echo $rowsql->RD_Cityfrom; ?><br />
                                                        <b>To:</b> <?php echo $rowsql->RD_Cityto; ?>
                                                    <?php } else { ?>
                                                        <b>Loc:</b> <?php echo $rowsql->RD_Cityfrom; ?>
                                                        <?php
                                                        if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration where SD_Id='$rowsql->SD_Id'")) {
                                                            echo '<br>Stay :' . $rowsd->SD_Name;
                                                        }
                                                        ?>
                                                    <?php } ?></td>
                                                <td align="right"><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                                                <td><?PHP
                                                    if ($row->REQ_Status == 2) {

                                                        $imdir = WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/" . $compid . "/bills_tickets/";

                                                        if (($rowsql->MOD_Id == 1) || ($rowsql->MOD_Id == 2) || ($rowsql->MOD_Id == 5)) {


                                                            // check for self booking

                                                            if ($selrdbs = $wpdb->get_row("SELECT * FROM booking_status whereRD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1", $filename)) {

                                                                echo bookingStatus(8);
                                                                echo '<br><b>Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date));
                                                            } else {

                                                                $selrdbs = $wpdb->get_row("SELECT * FROM booking_status whereRD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1", $filename);

                                                                if ($selrdbs->RD_Id) {

                                                                    echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

                                                                    echo '----------------------------------<br>';

                                                                    echo bookingStatus($selrdbs->BA_Id);

                                                                   // $fileurl = WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/" . $compid . "/bills_tickets/";


                                                                    switch ($selrdbs->BA_Id) {
                                                                        case 2:
                                                                            echo '<br><b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
                                                                            echo '<b>Uploaded File: </b> <a href="' . $imdir . $selrdbs->BD_Filename . '" download="billtickets" class="btn btn-link">download</a><br>';
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
                                                    } else {

                                                        echo bookingStatus(NULL);
                                                    }
                                                    ?></td>
                                                <td><?PHP
                                                    if ($row->REQ_Status == 2) {

                                                        if (($rowsql->MOD_Id == 1) || ($rowsql->MOD_Id == 2) || ($rowsql->MOD_Id == 5)) {


                                                            // check for self booking

                                                            if ($selrdbs = $wpdb->get_row("SELECT * FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                                                echo bookingStatus(NULL);
                                                            } else {

                                                                $selrdbs = $wpdb->get_row("SELECT * FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=3 AND BS_Active=1");

                                                                if ($selrdbs->RD_Id) {


                                                                    echo '<b title="Cancellation Request Date">Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

                                                                    echo '----------------------------------<br>';

                                                                    echo ($selrdbs->BA_Id == 1) ? bookingStatus($selrdbs->BA_Id) . "<br>" : '';


                                                                    switch ($selrdbs->BA_Id) {

                                                                        case 4:
                                                                            echo bookingStatus($selrdbs->BA_Id);
                                                                            echo '<br><b>Cancellation Amnt:</b> ' . IND_money_format($selrdbs->BS_CancellationAmnt) . '.00<br>';
                                                                            echo '<b>Uploaded File:</b> <a href="' . $imdir . $selrdbs->BD_Filename . '" download="billtickets" class="btn btn-link">download</a><br>';
                                                                            echo '<b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate)) . "<br>";
                                                                            break;

                                                                        case 5:
                                                                            echo bookingStatus($selrdbs->BA_Id);
                                                                            echo '<br><b>Cancellation Date:</b> ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate)) . "<br>";
                                                                            break;
                                                                    }
                                                                } else {

                                                                    echo bookingStatus(NULL);
                                                                }
                                                            }
                                                        } else {

                                                            echo bookingStatus(NULL);
                                                        }
                                                    } else {

                                                        echo bookingStatus(NULL);
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php
                                            $totalcost="";
                                            if (!$rowsql->RD_Duplicate)
                                                $totalcost+=$rowsql->RD_Cost;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <tr>
                                        <td align="right" width="70%">&nbsp;</td>
                                        <td align="right" width="30%">Total&nbsp;&nbsp;:- &nbsp;<?php echo IND_money_format($totalcost) . ".00"; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="right" >&nbsp;</td>
                                        <td align="right" >&nbsp;</td>
                                    </tr>
                                    <?php
                                    $claimSubmitted = 1;

                                    $curDate = date('Y-m-d');


                                    if ($selclaim = $wpdb->get_row("SELECT * FROM pre_travel_claim where REQ_Id='$reqid'")) {

                                        $claimSubmitted = 0;
                                        ?>
                                        <tr>
                                            <td align="right" width="70%">&nbsp;</td>
                                            <td align="right" width="30%"><button name="buttnEdit" class="btn btn-green" style="width:200px;"  type="button" onclick="window.location.href = '/admin.php?page=Claimview&reqid=reqid=<?php echo $reqid; ?>'">View Submitted Claim</button></td>
                                        </tr>
                                        <?php
                                    } elseif ($row->REQ_Status == 2 && $rowsql->RD_Dateoftravel <= $curDate) {
                                        ?>
                                        <tr>
                                            <td align="right" width="70%">&nbsp;</td>
                                            <td align="right" width="30%"><button name="buttnEdit" class="btn btn-theme" style="width:200px;"  type="button" onclick="javascript:void(0);">Not Submitted Claim</button></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <br />
                            <br />
                            <div id="chatContainer">
                                <?php
                                $val = 2;
                                _e(chat_box(2, ''));

                                $travel = 1;
                                ?>
                            </div>
                            <?php require WPERP_EMPLOYEE_VIEWS . '/accounts-requests-action.php'; ?>

                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- //content-->
    </div>
    <!-- //main-->
    <!-- //nav right menu-->
    <?php
    $callChatmsg = 1;
    ?>
