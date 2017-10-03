<?php
global $wpdb;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$reqid = $_GET['reqid'];
$selExpType = $_GET['selExpenseType'];
//echo $selExpType;die;
$et = 2;
$showProCode = 1;
$row = $wpdb->get_results("SELECT * FROM requests req, request_employee re Where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1");
//$empid = $row['EMP_Id'];
?>
        <div class="wrap pre-travel-request refresh_status request" id="wp-erp">
        <div class="row">
            <div class="col-lg-8" ></div>
            <!-- //content > row > col-lg-8 -->
            <div class="col-lg-4"></div>
            <!-- //content > row > col-lg-4 -->
        </div>
        <!-- //content > row-->
        <div class="row">
            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid" >
            <input type="hidden" value="<?php echo $et; ?>" name="et" id="et"  />
            <div class="col-lg-12" >
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Post Travel Expense Request Details</h3>
                        <label class="color">Request<em><strong> Details Display</strong></em></label>
                        <div style="display:none" id="failure" class="notice notice-error is-dismissible">
                            <p id="p-failure"></p>
                        </div>

                        <div style="display:none" id="notice" align="center" class="notice notice-warning is-dismissible">
                            <p id="p-notice"></p>
                        </div>

                        <div style="display:none" id="success" align="center" class="notice notice-success is-dismissible">
                            <p id="p-success"></p>
                        </div>

                        <div style="display:none" id="info" align="center" class="notice notice-info is-dismissible">
                            <p id="p-info"></p>
                        </div>
                    </header>                       
                    <input type="hidden" value="<?php echo $selExpType; ?>" name="selExpenseType" id="selExpenseType"  />

                    <div class="panel-body">
                        <form id="request_form" name="input" action="#" method="post">
							<?php
                            _e(requestDetails(2));
                            ?>
                            <?php
                            require WPERP_EMPLOYEE_VIEWS . '/finance-details.php';
                            ?>
                            <div`   id="no-more-tables">
                                <table class="wp-list-table widefat striped admins" id="table1" style="font-size:11px;">
                                    <thead class="cf">
                                        <tr>
                                            <th class="column-primary">Date</th>
                                            <th class="column-primary">Expense Description</th>
                                            <th class="column-primary">Expense Category</th>
                                            <th class="column-primary">Place</th>
                                            <th class="column-primary">Upload bills / tickets</th>
                                            <th class="column-primary">Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selsql = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot Where rd.REQ_Id='$row->REQ_Id' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1");

                                        foreach ($selsql as $rowsql) {
                                            ?>
                                            <tr>
                                                <td data-title="Date">
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
                                                <td data-title="Expense Description"><div style="height:40px; overflow:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                                                <td data-title="Expenses Category"><?php echo $rowsql->EC_Name; ?><br/><?php echo $rowsql->MOD_Name; ?></td>
                                                <td data-title="City/Location"><?php
                                                    if ($rowsql->EC_Id == 1 && $rowsql->MOD_Id !=3) {
                    
                                                        echo '<b>From:</b> ' . $rowsql->RD_Cityfrom . '<br />';
                                                        echo '<b>To:</b> ' . $rowsql->RD_Cityto;
                                                    }
                                                    else if ($rowsql->EC_Id == 1 && $rowsql->MOD_Id ==3) {
                    
                                                        echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom . '<br />';
                                                        echo '<b>Pickup Time:</b> ' . $rowsql->pickup . '<br />';
                                                        echo '<b>Dropoff Time:</b> ' . $rowsql->dropoff;
                                                    } else {

                                                        echo '<b>Loc:</b> ' . $rowsql->RD_Cityfrom;

                                                        if ($rowsd = $wpdb->get_results("SELECT SD_Name FROM stay_duration Where SD_Id='$rowsql->SD_Id'"))
                                                            echo '<br>Stay :' . $rowsd->SD_Name;
                                                    }
                                                    ?></td>
                                                <td data-title="Upload bills"><?php
                                                    $selfiles = $wpdb->get_results("SELECT * FROM requests_files where RD_Id='$rowsql->RD_Id'");

                                                    if (count($selfiles)) {

                                                        $j = 1;
                                                        foreach ($selfiles as $rowfiles) {
                                                            $temp = explode(".", $rowfiles->RF_Name);
                                                            $ext = end($temp);

                                                            $fileurl = "/erp/modules/company/upload/" . $compid . "/bills_tickets/" . $rowfiles->RF_Name;
                                                            ?>
                                                            <?php echo $j . ") "; ?><a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download="file-name"><?php echo 'file' . $j . "." . $ext; ?></a><br />
                                                            <?php
                                                        }
                                                    } else {

                                                        echo approvals(5);
                                                    }
                                                    ?>
                                                </td>
                                                <td  data-title="Total Cost"><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                                            </tr>
                                            <?php
                                            $totalcost = "";
                                            $totalcost+=$rowsql->RD_Cost;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <table class="wp-list-table widefat striped admins" style="font-weight:bold">
                                    <tr>
                                        <td align="right" width="85%">Total Cost</td>
                                        <td align="center" width="5%">:</td>
                                        <td align="right" width="10%"><?php echo IND_money_format($totalcost) . ".00"; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <br />
                            <br />
                        </form>
                        <div id="chatContainer">
                            <?php
                            $val = 2;
                            _e(chat_box(2, ''));
                            ?>
                        </div>
                        <?php require WPERP_EMPLOYEE_VIEWS . '/accounts-requests-action.php'; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php
$callChatmsg = 1;
?>
