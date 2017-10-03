<div class="wrap erp-hr-companyadmin" id="wp-erp">
<?php
global $wpdb;
		$selected_request =$_POST['filter_request'];
		$selected_status=$_POST['filter_status'];
		$emp=$_POST['filter_emp'];
        //if(isset($_REQUEST['selReqstatus'])){
        //$selected_status = $_REQUEST['selReqstatus'];
		//}

?>
<div class="filter-top">
    <form method="POST" action="#">
    <div class="row">
    <div class="col-md-3">
        <input type="text" class="form-control" name="s" placeholder="Employee Request">
    </div>
    <div class="col-md-1">
              <input type="submit" class="btn btn-primary btn-block" value="Filter">
    </div>
    </div>
    </form>
</div>
    <h2><?php _e( 'My Pending Payment Requests', 'superadmin' ); ?></h2>
        <?php
        //require '/../includes/class_table_view.php';
            
            global $wpdb;
            
            $table = new WeDevs\ERP\Employee\My_Payment_Requests_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner box panel-widget-style" style="margin-bottom:10px;">
            <?php echo $message;?>
            <?php //$table->views(); ?>
			<form method="post">
			  <input type="hidden" name="page" value="Requests" />
			  <?php //$table->search_box('Search Request Code', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <!--input type="button" class="button-primary" value="Approve"-->
                <?php $table->display() ?>
            </form>

        </div>
        </div>

    
</div>