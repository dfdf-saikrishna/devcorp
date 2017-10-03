<?php
$compid = $_SESSION['compid'];
global $wpdb;
$dep=$_POST['depId'];
$selected_status=$_POST['filter_status'];
$grade=$_POST['egId'];
?>
<div class="postbox">
   <div class="inside">
<div class="filter-top">
    <form method="POST" action="#">
    <div class="row">
	<div class="col-md-12">
    <div class="col-md-2">
        <input type="text" name="s" placeholder="Employee Name" class="form-control">
    </div>
    
    <div class="col-md-2">
       
                <select name="depId" id="depId" class="form-control selectpicker input-medium">
                <option value="">- Departments -</option>
                <?php
                $selpol = $wpdb->get_results("SELECT * From department WHERE COM_Id='$compid' AND DEP_Status=1 ORDER BY DEP_Name ASC");
                foreach ($selpol as $rowsql) {
                    ?>
                    <option value="<?php echo $rowsql->DEP_Id; ?>" <?php if ($dep == $rowsql->DEP_Id) echo 'selected="selected"'; ?> ><?php echo $rowsql->DEP_Name; ?></option>
                <?php } ?>
            </select>

    </div>
    
    <div class="col-md-2">
                <select name="egId" id="egId" class="form-control selectpicker input-medium">
                <option value="">- Grades -</option>
                <?php
                //$gradeid=$_GET['egId'];
                //print_r($gradeid);
                $selpol = $wpdb->get_results("SELECT * From  employee_grades WHERE COM_Id='$compid' AND EG_Status=1");
                foreach ($selpol as $rowemp) {
                    ?>
                    <option value="<?php echo $rowemp->EG_Id; ?>" <?php if ($grade == $rowemp->EG_Id) echo 'selected="selected"'; ?> ><?php echo $rowemp->EG_Name ?></option>
                <?php } ?>
     
        </select>
    </div>
    
    <div class="col-md-2">
        <select name="filter_status" id="filter_status" class="form-control selectpicker input-medium">
                <option value="">- Status -</option>
                <option value="1" <?php if ($selected_status == 1) echo 'selected="selected"'; ?> >Allowed</option>
                <option value="2" <?php if ($selected_status == 2) echo 'selected="selected"'; ?> >Blocked</option>
            </select>
    </div>
    
    <div class="col-md-2">
              <input type="submit" class="btn btn-primary btn-block" value="Filter Employees">
    </div>
	</div>
    </div>
  
    
    </form>
</div>






















<div class="wrap erp-hr-company" id="wp-erp">

<div class="page-header">
	
	<h3>Employees</h3>
	
    <div class="row">
	<div class="col-md-12">
	<div class="col-md-2">
		<a id="erp-companyemployee-new" class="btn btn-success btn-block"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Employee</a>
	</div>
    <div class="col-md-2">
        <a href="#" id="set_finance" class="btn btn-primary btn-block"><i class="fa fa-plus-circle" aria-hidden="true"></i> Finance Approver</a>
    </div>
    <div class="col-md-2">
        <a href="#" id="remove_finance" class="btn btn-danger btn-block"><i class="fa fa-minus-circle" aria-hidden="true"></i> Finance Approver</a>
    </div>
    <div class="col-md-2">
        <a href="#" id="allow_access" class="btn btn-success btn-block"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Allow Access</a>
    </div>
    <div class="col-md-2">
        <a href="#" id="remove_access" class="btn btn-danger btn-block"><i class="fa fa-lock" aria-hidden="true"></i> Block Access</a>
    </div>
	</div>
    </div>
<!-- /.page-header-actions -->
</div>

	
    <!-- Messages -->
    <div style="display:none" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>
    <div style="display:none" id="success" class="notice notice-success is-dismissible">
        <p id="p-success"></p>
    </div>
        <?php
    	$selected_status = ( isset($_GET['filter_status']) ) ? $_GET['filter_status'] : 0;
        $dep = ( isset($_GET['depId']) ) ? $_GET['depId'] : '';
        $grade = ( isset($_GET['egId']) ) ? $_GET['egId'] : '';
        ?>
        
    
    
	<?php
        $employee_table = new \WeDevs\ERP\Company\Employee_List_Table();
        $employee_table->prepare_items();
        $message = '';
            if ('delete' === $employee_table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
                ?>
     <div class="box panel-widget-style list-table-wrap erp-hr-employees-wrap" style="margin-bottom:20px;">
        
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
			<!--form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php //$employee_table->search_box('Search Employee', 'search_id'); ?>
			</form-->
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $employee_table->display() ?>
            </form>

        </div>
        </div>

</div>

