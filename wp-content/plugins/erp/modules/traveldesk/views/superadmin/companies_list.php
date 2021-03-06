<?php 

?>
<div class="wrap erp-hr-employees" id="wp-erp">
     <h2>Individual Employee Request [ without approval ]</h2>
    <h2><?php _e( 'Companies', 'traveldesk' ); ?><a href="#" id="erp-company-new" class="add-new-h2"><?php _e( 'Add New', 'traveldesk' ); ?></a></h2>
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Traveldesk\Companies_List_Table();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
			<form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php $table->search_box('Search Company', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>

    
</div>
