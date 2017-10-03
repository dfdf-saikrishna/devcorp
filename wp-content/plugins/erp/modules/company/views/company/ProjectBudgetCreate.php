<?php ?>
<div class="wrap erp-company-projectbudget" id="wp-erp">
<div class="page-header">
	
	<h1>Project Code</h1>

	

	
		
	<div class="page-header-actions">
		 <a href="#" id="erp-projectcode-budget" class="btn btn-primary" data-single="1">
			Add Project Code	</a>
	</div><!-- /.page-header-actions -->
</div>

    <!--<h2>DashBoard</h2>-->
    <!--h2><?php _e('Project Codes', 'company'); ?>
        <a href="#" id="erp-projectcode-budget" class="add-new-h2" data-single="1"><?php _e('Add Project Code', 'erp'); ?></a></h2-->

    <?php
    global $wpdb;
    $table = new WeDevs\ERP\Company\Projectbudget_List_Table();
    $table->prepare_items();
        $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p style="text-align:center;">' . sprintf(__('Project Code closed Successfully', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
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
