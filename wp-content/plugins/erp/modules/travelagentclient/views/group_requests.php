<?php
$compid = $_SESSION['compid'];
global $wpdb;
$dep=$_POST['depId'];
$selected_status=$_POST['filter_status'];
$grade=$_POST['egId'];
?>
<div class="wrap erp-hr-company" id="wp-erp">
    <h1>Group Requests</h1>
    <form method="POST" action="#">
    <div class="filter-top">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="s" placeholder="Request Code" class="form-control">
            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btn-primary btn-block" value="Filter Requests">
            </div>
            <div class="col-md-2">
                <a href="admin.php?page=group-request"  class="btn btn-primary btn-block">Add Request</a>
            </div>
        </div>
    </div>
    </form>
		


	<div class="workforce-filter-wrapper">
	<!--h2>
        <?php
        //_e( 'Employee', 'erp' );

        if ( current_user_can( 'companyadmin' ) ) {
            ?>
                <a href="#" id="erp-companyemployee-new" class="add-new-h2"><?php _e( 'Add New', 'erp' ); ?></a>
            <?php
        }
        ?>
    </h2-->
        <?php
    	$selected_status = ( isset($_GET['filter_status']) ) ? $_GET['filter_status'] : 0;
        $dep = ( isset($_GET['depId']) ) ? $_GET['depId'] : '';
        $grade = ( isset($_GET['egId']) ) ? $_GET['egId'] : '';
        ?>
        
    
    <!-- Messages -->
    <div style="display:none;" class="updated below-h2" id="message"><p id="p-success">Request Deleted Successfully</p></div>
	<?php
        $employee_table = new \WeDevs\ERP\Travelagentclient\Group_Requests_List_Table();
        $employee_table->prepare_items();
        $message = '';
            if ('delete' === $employee_table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
                ?>
     <div class="list-table-wrap erp-hr-employees-wrap box panel-widget-style">
        
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
			<!--form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php //$employee_table->search_box('Search Employee', 'search_id'); ?>
			</form-->
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $employee_table->display() ?>
            </form>

        </div>
        </div>

</div>

