<?php
 require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req-dropdown.php';
global $wpdb;
    $compid = $_SESSION['compid'];
        $emp_total = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=1 AND bs.BA_Id=1 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        $emp_approved = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=3 AND bs.BA_Id=1 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        $emp_pending = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=1 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        $emp_rejected = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=3 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        
        $count_total = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Active !=9 AND REQ_Type IN (2,3,4)"));
        $count_approved = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Status=2 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)"));
        $count_pending = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Status=1 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)"));
        $count_rejected = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Status=3 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)"));

?>
<div class="wrap erp hrm-dashboard">

    <div class="erp-single-container">
        <!--div class="erp-area-left"-->
                <div class="postbox">
                <div class="inside">
				    <div class="badge-container">
                        <div class="badge-wrap badge-aqua">

                            <table class="wp-list-table widefat striped admins">
                                <tr>
                                    <td colspan="2"><h1 style="text-align:center;"><b>Employee's Booking / Cancellation Requests</b></h1></td>
                                </tr>
                                <tr>
                                <td width="90%">Pending Requests</td>
                                <td width="10%">
								<a href="admin.php?page=requestview&selFilter=1"><span class="oval-1"> <?php echo $emp_total ?>
								</span></a></td>
                                </tr>
                                <tr>
                                <td width="90%">Pending Cancellation Requests</td>
                                <td width="20%"><a href="admin.php?page=requestview&selFilter=2"><span class="oval-3"><?php echo $emp_approved;?></span></a></td>
                                </tr>
                                <tr>
                                <td width="90%">All Booking Requests</td>
                                <td width="10%"><a href="admin.php?page=requestview&selFilter=3"><span class="oval-4"><?php echo $emp_pending; ?></span></a></td>
                                </tr>
                                <tr>
                                <td width="90%">All Cancellation Requests</td>
                                <td width="10%"><a href="admin.php?page=requestview&selFilter=4"><span class="oval-2"><?php echo $emp_rejected; ?></span></a></td>
                                </tr>
                            </table>
<!--                               <label class="progress-bar"><?php echo $appRate; ?>% approval rate</label>-->
                            </div><!-- .badge-wrap -->

                            <div class="badge-wrap badge-aqua">
                                <table class="wp-list-table widefat striped admins">
                                    <tr>
                                    <td colspan="2"><h1 style="text-align:center;"><b>Travel Desk Expense Requests</b></h1></td>
                                    </tr>
                                    <tr>
                                    <td width="90%">Pending Requests</td>
                                    <td width="10%"><a href="admin.php?page=tdeskrequestview&selReqstatus=1"><span class="oval-1"><?php echo $count_pending?></span></a></td>
                                    </tr>
                                    <tr>
                                    <td width="90%">Approved</td>
                                    <td width="10%"><a href="admin.php?page=tdeskrequestview&selReqstatus=2"><span class="oval-3"><?php echo $count_approved ?></span></a></td>
                                    </tr>
                                    <tr>
                                    <td width="90%">Rejected</td>
                                    <td width="10%"><a href="admin.php?page=tdeskrequestview&selReqstatus=3"><span class="oval-4"><?php echo $count_rejected?></span></a></td>
                                    </tr>
                                    <tr>
                                    <td width="90%">Total Requests</td>
                                    <td width="10%"><a href="admin.php?page=tdeskrequestview"><span class="oval-2"><?php echo $count_total ?></span></a></td>
                                    </tr>
                                </table>
                            </div><!-- .badge-wrap -->
                        
					       </div>
                        </div>
                    </div>
            <div class="postbox">
                <div class="inside">
                    <h2>Ticket Booking / Cancellation Requests</h2>
                    <?php
                   $table = new WeDevs\ERP\Traveldesk\Traveldeskdashboard_List_Table();
					$table->prepare_items();

                    $message = '';
                    if ('delete' === $table->current_action()) {
                        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
                    }
                    if(isset($_GET['status'])){
                        if($_GET['status'] == 'success'){
                            $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Booked Successfully', 'companies_table_list')) . '</p></div>';
                        }
                    }
                    ?>
                <div class="list-table-wrap erp-traveldesk-wrap">
                    <div class="list-table-inner erp-traveldesk-inner">
                        <?php echo $message;?>
                        <?php $table->views(); ?>
                        <form method="post">
                          <input type="hidden" name="page" value="Requests" />
                          <?php $table->search_box('Search Request Code', 'search_id'); ?>
                        </form>

                        <form method="GET">
                            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                            <?php $table->display() ?>
                        </form>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>