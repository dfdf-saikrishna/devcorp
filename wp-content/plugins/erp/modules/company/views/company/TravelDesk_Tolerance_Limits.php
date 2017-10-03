    <?php
    global $wpdb;
    $compid = $_SESSION['compid'];
    $row = $wpdb->get_results("SELECT * FROM tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
    ?>
    <div class="wrap erp-hr-company" id="wp-erp">
    <h2><?php _e('Travel Desk Tolerance Limits', 'company'); ?></h2>
    </div>
    <!-- Messages -->
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
	<div class="filter-top">
	<div class="row">
	<?php if($row){ ?>
	
        <div class="col-md-3"><h4 style="text-align:right;">Percentage Limit</h4></div>
    <div class="col-md-4">
		<div class="input-group input-group-lg">
		  <span class="input-group-addon" id="sizing-addon1"><strong>%</strong></span>
		  <input type="number" class="form-control" maxlength = "3" name="txtLimitPercentage" id="txtLimitPercentage" placeholder="digits only" aria-describedby="sizing-addon1" value="<?php echo $row[0]->TL_Percentage ? $row[0]->TL_Percentage : NULL; ?>" min="1" max="99">
		</div>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-warning btn-lg btn-block" id="submitToleranceLimits" ><?php echo $row[0]->TL_Id ? 'Update' : ''; ?></button>
	</div>
	 <div class="col-md-3"></div>
	<?php } 
	else{ ?>
	<div class="col-md-3"><h4 style="text-align:right;">Percentage Limit</h4></div>
	<div class="col-md-4">
		<div class="input-group input-group-lg">
						  <span class="input-group-addon" id="sizing-addon1"><strong>%</strong></span>
						  <input type="number" maxlength = "3" class="form-control" name="txtLimitPercentage" id="txtLimitPercentage" placeholder="digits only" aria-describedby="sizing-addon1" min="1" max="99">
						</div>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-success btn-lg btn-block" id="submitToleranceLimits" >Submit</button>
	</div>
	 <div class="col-md-3"></div>
    <?php } ?>

    </div>
	</div>
	
	
	
	
	
    <div class="wrap erp-company-traveldesklimits" id="wp-erp">    
                <input type="hidden" id="tlId" >
        <?php
        global $wpdb;
        $table = new WeDevs\ERP\Company\TravelDesk_Tolerance_List_Table();
        $table->prepare_items();
        $message = '';
        if ('delete' === $table->current_action()) {
            $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'tolerance_limits_table'), count($_REQUEST['id'])) . '</p></div>';
        }
        ?>
        <div class="list-table-wrap erp-company-traveldesklimits-wrap">
            <div class="list-table-inner erp-company-traveldesklimits-wrap-inner">
                <form method="GET">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                    <?php $table->display() ?>
                </form>

            </div>
        </div>
          <input type="hidden" name="action" id="erp-tolerance-action" value="tolerance_limit_amount">
    </div>
