<div class="wrap erp-hr-companyadmin" id="wp-erp">
<?php
global $wpdb;
		$selected_request =$_REQUEST['filter_request'];
		$selected_status=$_REQUEST['filter_status'];
		$emp=$_REQUEST['filter_emp'];
        if(isset($_REQUEST['selReqstatus'])){
        $selected_status = $_REQUEST['selReqstatus'];
		}

?>
<div class="filter-top">
    <form method="POST" action="#">
    <div class="row">
    <div class="col-md-3">
        <input type="text" class="form-control" name="s" placeholder="Request Code">
    </div>
    <div class="col-md-3">
        <select name="selReqstatus" id="selReqstatus" class="form-control selectpicker input-medium" >
                <option value="">- All -</option>
                <option value="2" <?php if ($selected_status == 2) echo 'selected="selected"'; ?> >Approved</option>
                <option value="1" <?php if ($selected_status == 1) echo 'selected="selected"'; ?> >Pending</option>
                <option value="3" <?php if ($selected_status == 3) echo 'selected="selected"'; ?> >Rejected</option>
        </select>
    </div>
    <div class="col-md-3">
              <input type="submit" class="btn btn-primary btn-block" value="Filter">
    </div>
    </div>
    </form>
</div>


    <h2><?php _e( 'Claim Requests', 'superadmin' ); ?></h2>
        <?php
        //require '/../includes/class_table_view.php';
            
            global $wpdb;
            
            $table = new WeDevs\ERP\Employee\Emp_Claims_List();
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