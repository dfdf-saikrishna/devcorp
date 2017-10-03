<div class="wrap erp-hr-travelagent" id="wp-erp">

    <h2>
        <?php
        _e( 'Client Allocations', 'erp' );
        ?>
    </h2>
	<?php
        $tauser_table = new \WeDevs\ERP\Travelagent\Travel_Agent_Client_Allocation();
        $tauser_table->prepare_items();
        $message = '';
            if ('delete' === $tauser_table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
                ?>

     <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
			<form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php $tauser_table->search_box('Search Client', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $tauser_table->display() ?>
            </form>

        </div>
        </div>

</div>

