<?php ?>
<div class="wrap erp-company-designations" id="wp-erp">
    <!--<h2>DashBoard</h2>-->
	<div class="page-header">
    <h1><?php _e('Designations', 'company'); ?></h1>
	</div>
	<div class="row">
	<div class="col-md-2">
	<a href="#" id="erp-new-designations" class="btn btn-primary btn-block" data-single="1"><?php _e('Add Designation', 'erp'); ?></a>
	</div>
	</div>
        

    <?php
    global $wpdb;

    $table = new WeDevs\ERP\Company\Designation_List_Table();
    $table->prepare_items();
        ?>
        <div class="list-table-wrap erp-company-designations-wrap">
        <div class="list-table-inner erp-company-designations-wrap-inner">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>


</div>
