<div class="postbox">
   <div class="inside">
<div class="filter-top">
    <form method="POST" action="#">
    <div class="row">
    <div class="col-md-3">
        <input type="text" class="form-control" name="s" placeholder="Reference Number">
    </div>
    <div class="col-md-3">
              <input type="submit" class="btn btn-primary btn-block" value="Filter">
    </div>
    </div>
    </form>
</div>
    <h2><?php
        _e('Travel Desk Claims', 'employee');
        //$tdcid = $_GET['tdcid'];
        
        ?>

        <div style="display:none" align="center" id="failure" class="notice notice-error is-dismissible">
            <p id="p-failure"></p>
        </div>
        <div style="display:none" align="center" id="success" class="notice notice-success is-dismissible">
            <p id="p-success"></p>
        </div>
        <?php
        global $wpdb;

        $table = new WeDevs\ERP\Employee\TravelDesk_Claims();
        $table->prepare_items();
        ?>
        <div class="box panel-widget-style">
              
	<div class="postbox">
                <div class="inside">
                    
                    
        <form method="post">
            <input type="hidden" name="page" value="my_list_test" />
<?php //$table->search_box('Request Code', 'search_id'); ?>
        </form>

        <div class="list-table-wrap erp-employee-payment-wrap">
            <div class="list-table-inner erp-employee-payment-wrap-inner">
                <form method="GET">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
<?php $table->display() ?>
                </form>

            </div>
            </div>
            </div>
            </div>
        </div>


</div>
