<?php
global $wpdb;
global $showProCode;
require_once WPERP_TRAVELDESK_PATH . '/includes/functions-group-requests.php';
$compid = $_SESSION['compid'];
$allemps=$wpdb->get_results("SELECT EMP_Id, EMP_Code, EMP_Name FROM employees WHERE COM_Id='$compid' AND EMP_Status=1 ORDER BY EMP_Name ASC");
?>
<style type="text/css">
#my_centered_buttons { text-align: center; width:100%; margin-top:60px; }
</style>
<form name="post-travel-req-form" id="traveldesk_request" action="#" method="post" enctype="multipart/form-data">
<div class="postbox">
    <div class="inside">
        <h2>Group Request</h2>
        <code>CREATE Group Booking Request</code>
        <div class="filter-top" style="text-align: center;">
        <label class="control-label">Search Employee :</label>
        <select class="erp-select2" style="width:50%;" multiple="multiple" name="selEmployees[]" id="selEmployees" parsley-required="true">
       <?php foreach($allemps as $value){ ?>
          <option value="<?php echo $value->EMP_Id;?>"><?php echo $value->EMP_Code." - ".$value->EMP_Name; ?></option>
          <?php } ?>
        </select>
        </div>
    </div>
</div>
<div class="postbox testpost">
    <div class="inside">
        <?php
            $row=0;
            require WPERP_TRAVELDESK_VIEWS."/groupEmp-details.php";
        ?>
        <div class="table-responsive" style="margin-top:60px;">
        <form id="group_request" name="traveldesk_request" action="#" method="post" enctype="multipart/form-data">
        <table class="table" id="group_request">
        <thead class="thead-inverse">
          <tr>
            <th>Date</th>
            <th >Expense Description</th>
            <th colspan="2">Expense Category</th>
            <th >Place</th>
            <th>Unit Cost</th>
            <th>Total Cost</th>
            <th>Bills / Tickets</th>
          </tr>
        </thead>
		<tbody class="panel-body search-tabs-bg">
          <input type="hidden" value="0" name="expenseLimit" id="expenseLimit"/>
          <input type="hidden" value="3" name="addnewrequest" id="addnewrequest"/>
          <input type="hidden" value="1" name="ectype"/>
          <tr>
            <td><input name="txtDate[]"  id="txtDate1" class="erp-leave-date-field form-control" placeholder="dd/mm/yyyy" autocomplete="off"/></td>
            <td><textarea name="txtaExpdesc[]" id="txtaExpdesc1" data-height="auto" class="form-control" autocomplete="off"></textarea></td>
            <td><select name="selExpcat[]" id="selExpcat1" class="form-control" style="width:110px;" onchange="javascript:getMotPreTravel(this.value,1)">
                <option value="">Select</option>
                <?php 
                        
                        $selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2)");

                        foreach($selexpcat as $rowexpcat)
                        {
                        ?>
                <option value="<?php echo $rowexpcat->EC_Id?>" ><?php echo $rowexpcat->EC_Name; ?></option>
                <?php } ?>
              </select></td>
            <td><span id="modeoftr1acontent">
              <!--select name="selModeofTransp[]" id="selModeofTransp1" class="form-control" onchange="setFromTo(this.value, 1);">
                <option value="">Select</option>
                <?php					  
                                //$selsql=$wpdb->get_results("SELECT * FROM mode WHERE MOD_Id IN (1,2,5)");

                                //foreach($selsql as $rowsql)
                                //{
                                ?>
                <option value="<?php //echo $rowsql->MOD_Id; ?>"><?php //echo $rowsql->MOD_Name; ?></option>
                <?php //} ?>
              </select-->
              </span></td>
            <td><span id="city1container">
              <input  name="from[]" id="from1" type="text" placeholder="From" class="form-control" autocomplete="off">
              <input  name="to[]" id="to1" type="text" placeholder="To" class="form-control" autocomplete="off" >
              </span></td>
            <!--<td><input type="text" class="" name="txtCost[]" id="txtCost1" style="width:110px;" onkeyup="valGroupRequestCost(this.value);"  autocomplete="off"/>
            </td>
            <td><input type="text" class="" name="txtTotalCost[]" onkeypress="return false;" id="txtTotalCost1" onkeyup="valPreCost(this.value);" style="width:110px;" autocomplete="off"/></td>-->
            <td><input type="text" class="form-control" name="txtTotalCost[]" id="txtTotalCost1" onkeyup="valGroupRequestCost(this.value);"  autocomplete="off"/>
                      </td>
                      <td><input type="text" class="form-control" name="txtCost[]" id="txtCost1" onkeypress="return false;" onkeyup="valPreCost(this.value);" autocomplete="off"/></td>
                              
			<td><input type='file' name='file1[]' id="file1[]" multiple="true" onchange="Validate(this.id);"></td>
          </tr>
		  </tbody>
      </table>
      <span id="totaltable"> </span>
	  
	  <div class="hidden-sm hidden-md hidden-xs" style="float:right;"><a title="Add Rows" class="btn btn-success btn-sm"><span id="add-traveldesk-groupreq">Add +</span></a> <span class="removebuttoncontainer"></span></div>
	  <div class="hidden-lg" style="float:left;  padding-top:10px; padding-bottom:10px;"><a title="Add Rows" class="btn btn-success btn-sm"><span id="add-traveldesk-groupreq">Add +</span></a> <span class="removebuttoncontainer"></span></div>
      </div>
	  <div id="my_centered_buttons">
        <span class="erp-loader" style="margin-left:67px;margin-top: 4px;display:none"></span>
       <!-- <input type="submit" name="submit-traveldesk-request_withoutappr" id="submit-traveldesk-request_withoutappr" class="button button-primary">-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
       <input type="submit" name="addnewRequest" id="addnewRequest" class="btn btn-success">

	   <button type="button" id="cleartraveldesk" class="btn btn-warning">Reset</button>
      </div>
      </form>
      
    </div>
</div>
</form>
