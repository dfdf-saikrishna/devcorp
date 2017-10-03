<?php ?>
<div class="wrap erp-company-projectcode" id="wp-erp">
<div class="page-header">
	
	<h1>Project Budget</h1>

	

	
		
	<div class="page-header-actions">
		 <a href="#" id="erp-new-projectcode" class="btn btn-primary" data-single="1">
			Add Project Budget		</a>
	</div><!-- /.page-header-actions -->
</div>

    <!--<h2>DashBoard</h2>-->
    <!--h2><?php _e('Project Budget', 'company'); ?>
        <a href="#" id="erp-new-projectcode" class="add-new-h2" data-single="1"><?php _e('Add Project Budget', 'erp'); ?></a></h2-->

    <?php
    global $wpdb;
    $table = new WeDevs\ERP\Company\Projectcodes_List_Table();
    $table->prepare_items();
    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p style="text-align:center;">' . sprintf(__('Project Code deleted Successfully', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
    }
        ?>
        <div class="box panel-widget-style list-table-wrap erp-company-projectcode-wrap">
        <div class="list-table-inner erp-company-projectcode-wrap-inner">
            <?php echo $message;?>
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>


</div>
