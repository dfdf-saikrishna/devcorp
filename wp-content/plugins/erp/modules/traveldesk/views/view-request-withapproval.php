<div class="wrap erp-hr-companyadmin" id="wp-erp">
    <h2><?php _e( 'Individual Employee Request [With Approval] Listing', 'superadmin' ); ?></h2>
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

            $table = new WeDevs\ERP\Traveldesk\Request_WithAppr_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'finance_approvers_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="list-table-wrap erp-hr-employees-wrap" style="padding: 20px;background: #fff;">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
			<form method="post">
			  <input type="hidden" name="page" value="Requests" />
			  <span style="
    margin: 0px!important;
float: right;"<?php $table->search_box('Search Request Code', 'search_id'); ?></span>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>

    
</div>
