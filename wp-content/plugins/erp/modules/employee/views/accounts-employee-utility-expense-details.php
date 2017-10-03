<?php
global $wpdb;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$reqid = $_GET['reqid'];
$selExpType = $_GET['selExpenseType'];
$et = 6;
$showProCode = 1;

$row = $wpdb->get_results("SELECT * FROM  requests req, request_employee re where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1");
?>
<div style="display:none" align="center" id="failure" class="notice notice-error is-dismissible">
                                    <p id="p-failure"></p>
                                </div>
                                <div style="display:none" align="center" id="success" class="notice notice-success is-dismissible">
                                    <p id="p-success"></p>
                                </div>
<div class="postbox">
    <div class="inside">
    <div class="wrap pre-travel-request erp" id="wp-erp">
        <div class="row">
            <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid" >
            <input type="hidden" value="<?php echo $et; ?>" name="et" id="et"  />
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
                        <h3>Utility Requests Details</h3>
                        <label class="color">Request<em><strong> Details Display</strong></em></label>
                    </header>
                    <div class="panel-body">
                      <!--<form action="action.php?reqid=<?php //echo $reqid;  ?>" method="post" name="form1" id="form1">-->
                        <?php
                        require WPERP_EMPLOYEE_VIEWS . '/finance-details.php';
                        ?>
                        <p>&nbsp;</p>
                        <?php
                        _e(requestDetails(6));
                        ?>
                        <div class="clearfix"></div>
                        <p>&nbsp;</p><p>&nbsp;</p>
                        <div id="no-more-tables">
                            <table class="wp-list-table widefat striped admins" id="table1" style="font-size:11px;">
                                <thead class="cf">
                                    <tr>
                                        <th class="column-primary">Start Date</th>
                                        <th class="column-primary">End Date</th>
                                        <th class="column-primary">Expense Description</th>
                                        <th class="column-primary">Expense Type</th>
                                        <th class="column-primary">Bill Number</th>
                                        <th class="column-primary">Upload bills</th>
                                        <th class="column-primary">Bill Amount (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $selsql = $wpdb->get_results("SELECT * FROM  request_details rd, expense_category ec, mode mot where rd.REQ_Id='$row->REQ_Id' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Id ASC");

                                    foreach ($selsql as $rowsql) {
                                        ?>
                                        <tr align="center">
                                            <td  data-title="Start Date"><?php echo date('d-M-Y', strtotime($rowsql->RD_StartDate)); ?></td>
                                            <td  data-title="End Date" ><?php echo date('d-M-Y', strtotime($rowsql->RD_EndDate)); ?></td>
                                            <td data-title="Expense Description"><div style="height:40px; overflow:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                                            <td data-title="Expenses Category"><?php echo $rowsql->MOD_Name; ?></td>
                                            <td data-title="Bill Number"><b><?php echo $rowsql->RD_BillNumber; ?></b></td>
                                            <td data-title="Upload bills"><?php
                                    $selfiles = $wpdb->get_results("SELECT * FROM  requests_files where RD_Id='$rowsql->RD_Id'");

                                    if (count($selfiles)) {

                                        $j = 1;
                                        foreach ($selfiles as $rowfiles) {
                                            $temp = explode(".", $rowfiles->RF_Name);
                                            $ext = end($temp);

                                            $fileurl = "/erp/modules/company/upload/" . $compid . "/bills_tickets/" . $rowfiles->RF_Name;
                                                ?>
                                                        <?php echo $j . ") "; ?><a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download="file-name"><?php echo 'file' . $j . "." . $ext; ?></a><br />
                                                        <?php
                                                        $j++;
                                                    }
                                                } else {

                                                    echo approvals(5);
                                                }
                                                ?>
                                            </td>
                                            <td  data-title="Bill Amount (Rs)"><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                                        </tr>
                                                <?php
                                                $totalcost = "";
                                                $totalcost+=$rowsql->RD_Cost;
                                            }
                                            ?>
                                </tbody>
                            </table>
                            <table class="wp-list-table widefat striped admins" style="font-weight:bold;">
		                    <tr>
		                    <td align="right" width="85%">Total Cost</td>
		                    <td align="center" width="5%">:</td>
		                    <td align="right"><?php echo IND_money_format($totalcost-$paytotd).".00"; ?></td>
		                    </tr>
	                    </table>
                        </div>
                        <p>&nbsp;</p>
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
    </div>
</div>
<!-- //main-->

<!--
                /////////////////////////////////////////////////////////////////
                //////////     RIGHT NAV MENU     //////////
                /////////////////////////////////////////////////////////////
-->
<!-- //nav right menu-->
<?php
$callChatmsg = 1;
?>
