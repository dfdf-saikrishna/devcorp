<div class="postbox">
    <div class="inside">
<div class="wrap erp-company-traveldesk" id="wp-erp">
<div class="page-header">
	
	<h1>Travel Desk</h1>
	
	<div class="page-header-actions">
		<a href="#" id="erp-new-traveldesk" class="btn btn-primary" data-single="1">
			Add Travel Desk</a>
	</div><!-- /.page-header-actions -->
</div>

    <!--<h2>DashBoard</h2>-->
    <!--h2><?php _e('Travel Desk', 'company'); ?>
        <a href="#" id="erp-new-traveldesk" class="add-new-h2" data-single="1"><?php _e('Add Travel Desk', 'erp'); ?></a></h2-->

    <?php
    global $wpdb;

    $table = new WeDevs\ERP\Company\TravelDesk_List_Table();
    $table->prepare_items();
        ?>
        <div class="box panel-widget-style list-table-wrap erp-company-traveldesk-wrap">
        <div class="list-table-inner erp-company-traveldesk-wrap-inner">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>


</div>
