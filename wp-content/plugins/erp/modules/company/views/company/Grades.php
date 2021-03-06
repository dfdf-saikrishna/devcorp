<?php ?>
<div class="wrap erp-company-grades" id="wp-erp">
<div class="wrap" id="wp-erp">
<div class="page-header">
	
	<h1>Grades</h1>
</div>
       <div style="display:none" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>

    <div style="display:none" id="notice" class="notice notice-warning is-dismissible">
        <p id="p-notice"></p>
    </div>

    <div style="display:none" id="success" class="notice notice-success is-dismissible">
        <p id="p-success"></p>
    </div>

    <div style="display:none" id="info" class="notice notice-info is-dismissible">
        <p id="p-info"></p>
    </div>
	
    <!--<h2>DashBoard</h2>-->
    <!--h2><?php _e('Grades', 'company'); ?>
        <a href="#" id="erp-new-grades" class="add-new-h2" data-single="1"><?php _e('Add Grades', 'erp'); ?></a></h2-->
	<div class="row">
	<div class="col-md-2">
	<a href="#" id="erp-new-grades" class="btn btn-primary btn-block" data-single="1">Add Grades</a>
	</div>
	</div>
    <?php
    global $wpdb;

    $table = new WeDevs\ERP\Company\Grades_List_Table();
    $table->prepare_items();
     $message = '';
        if ('delete' === $table->current_action()) {
            $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'grades_table_list'), count($_REQUEST['id'])) . '</p></div>';
        }
        ?>
        <div class="list-table-wrap erp-company-grades-wrap">
        <div class="list-table-inner erp-company-grades-wrap-inner">
            <div class="box panel-widget-style" style="margin-bottom:20px;">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>
            </div>

        </div>
        </div>

</div>
