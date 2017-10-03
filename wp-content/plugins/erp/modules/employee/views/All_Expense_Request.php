<?php
	global $wpdb;
	$selected_request=$_POST['filter_request'];
	$emp=$_POST['filter_emp'];
?>
<div class="postbox">
   <div class="inside">
<div class="filter-top">
    <form method="POST" action="#">
    <div class="row">
    <div class="col-md-3">
        <input type="text" name="s" placeholder="Employee Request" class="form-control">
    </div>
    
    <div class="col-md-3">
        <select name="filter_request" id="filter_request" class="form-control">
                <option value="">- Select -</option>
                <?php
                $selsql = $wpdb->get_results("SELECT * From expense_category WHERE EC_Id IN (1,3,6)");
                foreach ($selsql as $rowsql) {
                    ?>
                    <option value="<?php echo $rowsql->EC_Id; ?>" <?php if ($selected_request == $rowsql->EC_Id) echo 'selected="selected"'; ?> ><?php echo $rowsql->EC_Name; ?></option>
                <?php } ?>
        </select>
    </div>
    
    <div class="col-md-3">
        <select name="filter_emp" id="filter_emp" class="form-control">
            <option value="">- Select Finance Approver -</option>
            <?php
            $selsql = $wpdb->get_results("SELECT * FROM company cmp, employees emp, department dep, designation des, employee_grades eg WHERE emp.COM_Id='$compid' AND emp.COM_Id=cmp.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id AND emp.EMP_Status=1 AND emp.EMP_Access=1 AND emp.EMP_AccountsApprover=1");
            foreach ($selsql as $rowemp) {
                ?>
                <option value="<?php echo $rowemp->EMP_Id; ?>" <?php if ($emp == $rowemp->EMP_Id) echo 'selected="selected"'; ?> ><?php echo $rowemp->EMP_Code . " - " . $rowemp->EMP_Name; ?></option>
            <?php } ?>
        </select>
    </div>
    
    <div class="col-md-1">
              <input type="submit" class="btn btn-primary" value="Filter">
    </div>
    </div>
    </form>
</div>
	 <h2><?php _e( 'Finance Expense Requests', 'finance' ); ?></h2>
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Employee\All_Expense_Requests_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
			<form method="post">
			  <input type="hidden" name="page" value="Requests" />
			  <?php $table->search_box('Search Request Code', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>

    
</div>
