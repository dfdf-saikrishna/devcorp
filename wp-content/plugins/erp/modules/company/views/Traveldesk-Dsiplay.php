<?php
global $wpdb;
$compid = $_SESSION['compid'];
$reqid = $_GET['reqid'];

$et = 1;

$showProCode = 1;

$row = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re where req.REQ_Id=$reqid AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id=$compid AND (req.REQ_Active !=9 AND REQ_Type IN (2,3,4)) AND RE_Status=1");
?>

<div id="main">
    <!-- //breadcrumb-->
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
                        <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" />
                        <input type="hidden" name="actionButton" id="actionButton" />
                        <input type="hidden" name="reqcode" id="reqcode" value="<?php echo $row->REQ_Code ?>" />
                        <input type="hidden" name="reqtype" id="reqtype" value="<?php echo $row->REQ_Type ?>" />
                        <?php
                        if ($row->REQ_Type != 4) {

                            require WPERP_COMPANY_PATH . '/includes/employee-details.php';
                        } else {
                            echo '<table class="wp-list-table widefat striped admins">';
                            echo '<th>Employees </th>';
                            echo '<th align="center">:</th>';

                            $selsql = $wpdb->get_results("SELECT EMP_Code, EMP_Name FROM request_employee re, employees emp where re.REQ_Id='$row->REQ_Id' AND re.EMP_Id = emp.EMP_Id AND re.RE_Status=1");

                            $emps = NULL;

                            foreach ($selsql as $rowsql) {

                                $emps .= $rowsql->EMP_Code . '--' . $rowsql->EMP_Name . ", ";
                            }

                            $emps = rtrim($emps, ", ");

                            echo '<td>' . $emps . '</td>';


                            echo '</div><br><br><br><br>';
                            echo '</table>';
                        }

                        require WPERP_COMPANY_PATH . '/includes/employee-request-details.php';
                        echo '<br>';
                        ?>
                        <div class="table-responsive">
                            <table class="wp-list-table widefat striped admins" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th >Expense<br />
                                            Description</th>
                                        <th  >Expense <br />
                                            Category</th>
                                        <th >Place</th>
                                        <th >Total Cost</th>
                                        <?php
                                        if ($row->REQ_Type == 2 || ($row->REQ_Type == 3 && $row->REQ_Status == 2) || $row->REQ_Type == 4) {
                                            ?>
                                            <th >Booking Status</th>
                                            <th >Cancellation Status </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $row->REQ_Id;
                                    $selsql = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot where rd.REQ_Id=$id AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");

                                    foreach ($selsql as $rowsql) {
                                        ?>
                                        <tr>
                                            <td ><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                                            <td ><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                                            <td width="8%"><?php echo $rowsql->EC_Name; ?><br/><?php echo $rowsql->MOD_Name; ?></td>
                                            <td ><?php
                                                if ($rowsql->EC_Id == 1) {

                                                    echo '<b>From:</b> ' . $rowsql->RD_Cityfrom . '<br />
									  <b>To:</b> ' . $rowsql->RD_Cityto;
                                                } else {

                                                    echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;

                                                    if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration where SD_Id='$rowsql->SD_Id'")) {

                                                        echo '<br>Stay :' . $rowsd->SD_Name;
                                                    }
                                                }
                                                ?></td>
                                            <td ><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                                            <?php
                                            if ($row->REQ_Type == 2 || ($row->REQ_Type == 3 && $row->REQ_Status == 2) || $row->REQ_Type == 4) {
                                                ?>
                                                <td><?PHP
                                                    if (($rowsql->MOD_Id == 1) || ($rowsql->MOD_Id == 2) || ($rowsql->MOD_Id == 5)) {


                                                        // check for self booking

                                                        if ($selrdbs = $wpdb->get_row("SELECT * FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                                            echo bookingStatus(8);
                                                            echo '<br><b>Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date));
                                                        } else {

                                                            $selrdbs = $wpdb->get_row("SELECT * FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");

                                                            if ($selrdbs->RD_Id) {

                                                                echo bookingStatus($selrdbs->BA_Id);

                                                                $seldocs = $wpdb->get_results("SELECT * FROM booking_documents where BS_Id='$selrdbs->BS_Id'");

                                                                $doc = NULL;

                                                                $f = 1;

                                                                foreach ($seldocs as $docs) {
                                                                    // $imdir = "upload/$compid/bills_tickets/";
                                                                    // $firlurl=
                                                                    $fileurl = "/erp/modules/upload/" . $compid . "/bills_tickets/" . $docs->BD_Filename;
                                                                    $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . WPERP_COMPANY_DOWNLOADS . $fileurl . '" download = "Billtickets" >download</a><br>';

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
                                                    if (($rowsql->MOD_Id == 1) || ($rowsql->MOD_Id == 2) || ($rowsql->MOD_Id == 5)) {


                                                        // check for self booking

                                                        if ($selrdbss = $wpdb->get_row("SELECT * FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=2 AND BS_Active=1")) {

                                                            echo bookingStatus(NULL);
                                                        } else {

                                                            $selrdcs = $wpdb->get_row("SELECT * FROM booking_status where RD_Id='$rowsql->RD_Id' AND BS_Status=3 AND BS_Active=1");
                                                            if (!empty($selrdcs->RD_Id)) {
                                                                if ($selrdcs->RD_Id) {

                                                                    echo bookingStatus($selrdcs->BA_Id);

                                                                    $doc = NULL;

                                                                    if ($selrdcs->BA_Id == 6) {

                                                                        $seldocs = $wpdb->get_results("SELECT * FROM booking_documents where BS_Id='$selrdcs->BS_Id'");

                                                                        $f = 1;

                                                                        foreach ($seldocs as $docs) {
                                                                            $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . WPERP_COMPANY_DOWNLOADS . $imdir .$docs->BD_Filename . '" download = "Billtickets" >download</a><br>';

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
                                        /* if(!$rowsql->RD_Duplicate)
                                          $totalcost+=$rowsql->RD_Cost; */
                                        $totalcost = "";
                                        //print_r();
                                        if (!empty($selrdcs->BS_CancellationAmnt)) {
                                            if ($selrdcs->BS_CancellationAmnt) {

                                                $totalcost+=$selrdcs->BS_CancellationAmnt;
                                            }
                                        } else {

                                            $totalcost+=$selrdbs->BS_TicketAmnt;
                                        }
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
                        <?php
                        $curdate = date('Y-m-d');

//if(/*($curdate >= $rowsql->RD_Dateoftravel) && */($row->REQ_Type==2) ){

                        $show = 0;
                        $approver = 0;
                        // $approver = isApprover();
                        if ($approver) {

                            if ($selmyreq = $wpdb->get_row("SELECT req.REQ_Id  FROM requests req, request_employee re where req.REQ_Id='$row->REQ_Id' AND req.REQ_Id=re.REQ_Id AND re.RE_Status=1")) {

                                if ($row->REQ_Type == 2 || $row->REQ_Type == 3) {

                                    $show = 1;
                                } else {

                                    if (($row->REQ_Type == 3) && ($row->REQ_Status == 2))
                                        $show = 1;
                                    else
                                        $show = 0;
                                }
                            } else {

                                $show = 0;
                            }
                        } else {


                            if ($row->REQ_Type == 2 || $row->REQ_Type == 3) {

                                $show = 1;
                            } else {

                                if (($row->REQ_Type == 3) && ($row->REQ_Status == 2))
                                    $show = 1;
                                else
                                    $show = 0;
                            }
                        }

                        if ($show)
                           // $req = $row->REQ_Id;
                        echo '<br><br><div align="right"><a href="admin.php?page=Traveldeskclaims&reqid='.$row->REQ_Id.' class="button button-primary">Submit for Claim</a></div>';
                        ?>
                        </form>
                        <br />
                        <br />
                        <!--                        <div id="chatContainer">
                                                   
                                                </div>-->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- //content-->
</div>
<!-- //main-->
