<?php
global $wpdb;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$reqid = $_GET['reqid'];
$selExpType = $_GET['selExpenseType'];
$et = 3;
$showProCode = 1;
$row = $wpdb->get_results("SELECT * FROM requests req, request_employee re where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1");
//$empid = $row['EMP_Id'];
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
                        <h3>Other-Travel Requests Details</h3>
                        <label class="color">Request<em><strong> Details Display</strong></em></label>
                    </header>
                    <div class="panel-body">
                        <form action="action.php?reqid=<?php echo $reqid; ?>" method="post" name="form1" id="form1">
                            <?php
                            require WPERP_EMPLOYEE_VIEWS . '/finance-details.php';

                            echo '<br><br>';

                            _e(requestDetails(3));
                            ?>
                            <br/>
                            <div id="no-more-tables">
                               <table class="wp-list-table widefat striped admins" border="0" id="table1">
                                    <thead class="cf">
                                        <tr>
                                            <th class="column-primary">Date</th>
                                            <th class="column-primary">Expense Description</th>
                                            <th class="column-primary">Expense Category</th>
                                            <th class="column-primary">Upload<br />
                                                bills / tickets</th>
                                            <th class="column-primary">Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        $resql = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot  where rd.REQ_Id=$row->REQ_Id AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1");

                                        foreach ($resql as $rowsql) {
                                            ?>
                                            <tr>
                                                <td  data-title="Date"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                                                <td data-title="Expense Description"><p style="height:20px; overflow:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></p></td>
                                                <td  data-title="Expenses Category"><?php echo $rowsql->MOD_Name; ?></td>
                                                <td data-title="Upload Bills / Tickets"><?php
                                                    $j = 1;

                                                    $selsql = $wpdb->get_results("SELECT * FROM requests_files where RD_Id=$rowsql->RD_Id");

                                                    foreach ($selsql as $rowfiles) {
                                                        $temp = explode(".", $rowfiles->RF_Name);
                                                        $ext = end($temp);

                                                        $fileurl = "/erp/modules/company/upload/" . $compid . "/bills_tickets/" . $rowfiles->RF_Name;
                                                        ?>
                                                        <?php echo $j . ") "; ?><a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download="file-name"><?php echo 'file' . $j . "." . $ext; ?></a><br />
                                                        <?php
                                                        $j++;
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
                           	<table class="wp-list-table widefat striped admins" style="font-weight:bold;">
		                    <tr>
		                    <td align="right" width="85%">Total Cost</td>
		                    <td align="center" width="5%">:</td>
		                    <td align="right"><?php echo IND_money_format($totalcost-$paytotd).".00"; ?></td>
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
    </div>
    <!-- //content-->
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
