<h2 style="margin-top: 5%;"><?php _e( 'Company Admins : ', 'superadmin' ); ?><a href="#" id="companyadmin-new"  class="add-new-h2 button button-primary" style="    border: 1px solid #13eafe;"><?php _e( ' Add New', 'superadmin' ); ?></a></h2>

<div class="wrap erp-hr-companyadmin" id="wp-erp">
    
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Corptne\Companiesadmin_List_Table();
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
