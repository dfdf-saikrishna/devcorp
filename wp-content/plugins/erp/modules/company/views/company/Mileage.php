<?php ?>
<div class="wrap erp-company-mileage" id="wp-erp">
    <!--<h2>DashBoard</h2>-->
    <h1><?php _e('Mileage', 'company'); ?></h1>
	 <a href="#" id="erp-new-mileage" class="btn btn-primary" data-single="1"><?php _e('Add Mileage', 'erp'); ?></a>
    <?php
    global $wpdb;

    $table = new WeDevs\ERP\Company\Mileage_List_Table();
    $table->prepare_items();
        ?>
        <div class="list-table-wrap erp-company-mileage-wrap">
        <div class="list-table-inner erp-company-mileage-wrap-inner">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>


</div>
