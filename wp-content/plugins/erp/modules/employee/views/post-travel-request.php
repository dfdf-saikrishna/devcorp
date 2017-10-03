<?php
global $showProCode;
global $etEdit;
require_once WPERP_EMPLOYEE_PATH . '/includes/functions-pre-travel-req.php';
global $wpdb;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");	
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
            <h2><?php _e( 'Post Travel Expense Request', 'employee' ); ?></h2>
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
            <div  class="table-responsive" style="margin-top:30px;">
            <table class="table" border="0" id="table-pre-travel">
                  <thead class="thead-inverse">
                    <tr>
                      <th width="14%" class="column-primary">Date</th>
                      <th width="14%"  class="column-primary">Expense Description</th>
                      <th width="14%" class="column-primary" colspan="2">Expense Category</th>
                      <th width="30%"  class="column-primary" >Place</th>
                      <th width="14%" class="column-primary">Estimated Cost</th>
                      <th width="14%" class="column-primary">Upload Bills/Tickets</th>
                    </tr>
                  </thead>
                  <tbody class="panel-body search-tabs-bg">
                    <tr>
                      <td data-title="Date" class=""><input name="txtDate[]" id="txtDate1" class="posttraveldate  SmallInput form-control" placeholder="dd/mm/yyyy" autocomplete="off"/>
                      <input name="txtStartDate[]" id="txtStartDate1" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate1" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" />
                      <input type="text" name="textBillNo[]" id="textBillNo1" autocomplete="off"  class="" style="display:none;" value="n/a"/>
                      </td>
                      <td data-title="Description"><textarea name="txtaExpdesc[]" id="txtaExpdesc1" class="form-control SmallInput" autocomplete="off"></textarea><input type="text" class="" name="txtdist[]" id="txtdist1" autocomplete="off" style="display:none;" value="n/a"/></td>
                      <td data-title="Category">
					  <select name="selExpcat[]" class="form-control SmallInput" id="selExpcat1" onchange="javascript:getMotPosttravel(this.value,1)">
                          <option value="">Select</option>
                          <?php
                          foreach($selexpcat as $rowexpcat)
				  {
				  ?>
                          <option value="<?php echo $rowexpcat->EC_Id?>" ><?php echo $rowexpcat->EC_Name; ?></option>
                          <?php } ?>
                         
                        </select></td>
                      <td data-title="Category"><span id="modeoftr1acontent">
                        <select  name="selModeofTransp[]"  id="selModeofTransp1" class="form-control SmallInput">
                          <option value="">Select</option>
                          <?php
                          foreach($selmode as $rowsql)
					  {
					  ?>
                          <option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option>
                          <?php } ?>
                        </select>
                        </span></td>
                        <td data-title="Place"><span id="city1container">
                        <input  name="from[]" id="from1" type="text" placeholder="From" class="form-control SmallInput">
                        <input  name="to[]" id="to1" type="text" placeholder="To" class="form-control SmallInput">
                        </span></td>
                        <td data-title="Estimated Cost"><span id="cost1container">
                        <input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost" onkeyup="valPreCost(this.value,1);" onchange="valPreCost(this.value,1);" autocomplete="off"/>
                        </br><span class="red" id="show-exceed1"></span>
                        <input type="hidden" value="2" name="ectype" id="ectype"/>
                        <input type="hidden" value="0" name="expenseLimit" id="expenseLimit"/>
                        <input type="hidden" value="n/a" name="selStayDur[]" id="selStayDur1">
                        <input type="hidden" name="action" id="send_post_travel_request" value="send_post_travel_request">
                        </span></td>
                        <td>
						<input type="file" name='file1[]' required id="file1" multiple="true">
						<!--input type='file' name='file1[]' required id="file1" multiple="true" class="" style="width:150px;"-->
						<!--label class="btn btn-primary">
							Browse &hellip; <input type="file" name='file1[]' required id="file1" multiple="true" style="display: none;">
						</label-->
						</td>
						
                    </tr>
                  </tbody>
                </table>
                <span id="totaltablepost"> </span>
                <div class="hidden-sm hidden-md hidden-xs" style="float:right;"><a title="Add Rows" class="btn btn-success btn-sm"><span id="add-row-posttravel">Add +</span></a> <span class="removebuttoncontainer"></span></div>
				<div class="hidden-lg" style="float:left;  padding-top:10px; padding-bottom:10px;"><a title="Add Rows" class="btn btn-success btn-sm"><span id="add-row-posttravel">Add +</span></a> <span class="removebuttoncontainer"></span></div>
            </div>
            <div id="my_centered_buttons"><hr>
                <span class="erp-loader" style="margin-left:67px;margin-top: 4px;display:none"></span>
            <input type="submit" name="submit-post-travel-request" id="submit-post-travel-request" class="btn btn-success">
            <button type="submit" id="clearpost" class="btn btn-warning">Reset</button>
            </div>
            </form>
            <div style="margin-top:30px" id="grade-limit" class="postbox leads-actions closed">
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
