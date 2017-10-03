
<?php ?>
<div class="wrap erp-company-departments" id="wp-erp">
    <!--<h2>DashBoard</h2>-->
	<div class="page-header">
    <h1><?php _e('Departments', 'company'); ?></h1>
	</div>
	<div class="row">
	<div class="col-md-2">
	<a href="#" id="erp-new-departments" class="btn btn-primary btn-block" data-single="1"><?php _e('Add Departments', 'erp'); ?></a>
	</div>
	</div>
        

    <?php
    global $wpdb;

    $table = new WeDevs\ERP\Company\Departments_List_Table();
    $table->prepare_items();
        ?>
        <div class="list-table-wrap erp-company-departments-wrap">
        <div class="list-table-inner erp-company-departments-wrap-inner">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>


</div>
