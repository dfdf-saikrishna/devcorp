<div class="postbox">
    <div class="inside">
    <h2><?php _e( 'Finance Approver Listing', 'superadmin' ); ?></h2>
     <form method="POST" action="#">
            <div class="workforce-filter-form-inner">
	<!--div class="alignleft"-->
            <a href="#" id="remove_finance" class="btn btn-danger col-md-3 col-xs-12 pull-left">Remove as Finance Approver</a> 
        <!--/div-->
		</form>
    <!-- Messages -->
    <div style="display:none" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>
    <div style="display:none" id="success" class="notice notice-success is-dismissible">
        <p id="p-success"></p>
    </div>
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Company\Finance_Approvers_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'finance_approvers_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="box panel-widget-style list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>

    
</div>
