<?php
global $showProCode;
global $etEdit;
require_once WPERP_EMPLOYEE_PATH . '/includes/functions-pre-travel-req.php';
global $wpdb;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
?>
<style type="text/css">
#my_centered_buttons { text-align: center; width:100%; margin-top:60px; }
.SmallInput { width: 150px;}
</style>
<div class="postbox">
    <div class="inside">
        <div class="wrap pre-travel-request erp" id="wp-erp">
            <h2><?php _e( 'Mileage Expense Request', 'employee' ); ?></h2>
            <!-- Messages -->
            <?php if(isset($_GET['status'])){?>
            <div style="display:block" id="success" class="notice notice-success is-dismissible">
            <p id="p-success"><?php echo $_GET['msg'] ;?></p>
            </div>
            <?php } ?>
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
            <form name="post-travel-req-form" id="post-travel-req-form" action="#" method="post" enctype="multipart/form-data">
            <?php
                $row=0;
                require WPERP_EMPLOYEE_VIEWS."/employee-detailsnew.php";
            ?>
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
            <div class="table-wrapper" style="background-repeat:repeat;margin-top:0px;">
                <h4 >/ Mileage Rates /</h4>
               <p style="border-bottom:thin dashed #999999;">&nbsp;</p>
               <?php
               $selamnt=$wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' AND MOD_Id='31' AND MIL_Status=1 AND MIL_Active=1");
               ?>
               <input type="hidden" id="hiddenTwowheeler" name="hiddenTwowheeler" value="<?php echo $selamnt->MIL_Amount?>" />
                <dl> <b>Two Wheeler:</b> <?php if($selamnt) echo  $selamnt->MIL_Amount; else echo 'N/A'; ?> / Km, 

                <?php   
                $selamnt=$wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' AND MOD_Id='32' AND MIL_Status=1 AND MIL_Active=1");
                ?>
              <input type="hidden" id="hiddenFourwheeler" name="hiddenFourwheeler" value="<?php if($selamnt) echo $selamnt->MIL_Amount?>" />
                
                <b>Four Wheeler:</b> <?php if($selamnt) echo $selamnt->MIL_Amount; else echo 'N/A'; ?> / Km</dl> 
				<div class="table-responsive" style="margin-top:0px;">
                <form name="post-travel-req-form" action="#" method="post" enctype="multipart/form-data">
            <table class="table" border="0" id="table-mileage-travel">
                  <thead class="thead-inverse">
                    <tr>
                      <th class="column-primary">Date</th>
                      <th class="column-primary">Expense Description</th>
                      <th class="column-primary">Expenses Category</th>
                      <th class="column-primary" >City/Location</th>
                      <th class="column-primary">Distance (in km)</th>
                      <th class="column-primary">Total Cost</th>
                      <th class="column-primary">Upload Bills/Tickets</th>
                    </tr>
                  </thead>
                  <tbody class="panel-body search-tabs-bg">
                    <tr>
                      <input type="hidden" value="5" name="ectype"/>
                      <input type="hidden" value="0" name="expenseLimit">
                      <td data-title="Date" class="scrollmsg"><input name="txtDate[]" id="txtDate1" class="posttraveldate form-control SmallInput" required placeholder="dd-mm-yyyy" autocomplete="off"/><input name="txtStartDate[]" id="txtStartDate1" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" />
                        <input name="txtEndDate[]" id="txtEndDate1" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" />
                        <input type="text" name="textBillNo[]" id="textBillNo1" autocomplete="off"  class="" style="display:none;" value="n/a"/></td>
                      <td data-title="Description"><textarea cols="15" name="txtaExpdesc[]" id="txtaExpdesc1" required class="form-control SmallInput" autocomplete="off"></textarea>
                        <select name="selExpcat[]" id="selExpcat1" required class="form-control SmallInput" style="display:none;">
                          <option value="5">select</option>
                        </select></td>
                      <td data-title="Category"><select name="selModeofTransp[]" required id="selModeofTransp1" class="form-control SmallInput" onchange="return getAmount(this.value, 1);">
                          <option value="">Select</option>
                          <?php 
					  
					  $selsql=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id=5 AND MOD_Status=1");
					  
					  foreach($selsql as $rowsql)
					  {
					  	
						$readonly=NULL;
						
						if(!$selamnt=$wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' AND MOD_Id='$rowsql->MOD_Id' AND MIL_Status=1 AND MIL_Active=1")){
						
							$readonly='disabled="disabled"';
						
						}
					  	
					  ?>
                          <option value="<?php echo $rowsql->MOD_Id; ?>" <?php echo $readonly; ?>><?php echo $rowsql->MOD_Name; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td data-title="City/Location"><span id="city1container">
                        <input  name="from[]" id="from1" type="text" placeholder="From" class="form-control SmallInput" required  autocomplete="off">
                        <input  name="to[]" id="to1" type="text" placeholder="To" class="form-control SmallInput" required  autocomplete="off">
                        </span><select name="selStayDur[]" class="form-control SmallInput" style="display:none;">
                          <option value="n/a">Select</option>
                        </select></td>
                      <td data-title="Distance (in km)"><input type="text" class="form-control SmallInput" name="txtdist[]"  id="txtdist1" onkeyup="return mileageAmount(this.value, 1);" autocomplete="off"/></td>
                      <td data-title="Total Cost"> <input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost1" readonly="readonly"  autocomplete="off"/></td>
                      <td data-title="Upload bills / tickets"><input type='file' required name='file1[]' id="file1[]" multiple="true"></td>
                    </tr>
                  </tbody>
                </table>
                <span id="totaltablepost"></span>
                <div class="hidden-sm hidden-md hidden-xs" style="float:right;"><a title="Add Rows" class="btn btn-success btn-sm"><span id="add-row-mileage">Add +</span></a> <span class="removebuttoncontainer"></span></div>
				<div class="hidden-lg" style="float:left;  padding-top:10px; padding-bottom:10px;"><a title="Add Rows" class="btn btn-success btn-sm"><span id="add-row-mileage">Add +</span></a> <span class="removebuttoncontainer"></span></div>
			</div>
            <div id="my_centered_buttons">
                <span class="erp-loader" style="margin-left:67px;margin-top: 4px;display:none"></span>
            <input type="submit" name="submit-post-travel-request" id="submit-post-travel-request" class="btn btn-success">
           
            <button type="button" id="clearpost" class="btn btn-warning">Reset</button>
            </div>
            </form>
			</div>
            <div style="margin-top:0px" id="grade-limit" class="postbox leads-actions closed">
                <div class="handlediv" title="<?php _e( 'Click to toggle', 'erp' ); ?>"><br></div>
                <h3 class="hndle"><span><?php _e( 'Grade Limits', 'erp' ); ?></span></h3>
                <div class="inside">
                   <!-- Grade Limits -->
                   <?php _e(gradeLimits(''));?>
                </div>
            </div><!-- .postbox -->
        </div>
    </div>
    
</div>
