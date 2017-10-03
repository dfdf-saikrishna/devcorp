<div class="wrap erp-hr-companyadmin" id="wp-erp">
<div class="postbox">
    <div class="col-md-12">
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
        </div>
<div class="inside">
    
    <div class="filter-top">
        
    <div class="col-md-8">
        <?php
    $compid = $_SESSION['compid'];
    global $wpdb;
    $allemps=$wpdb->get_results("SELECT EMP_Id, EMP_Code, EMP_Name FROM employees WHERE COM_Id='$compid' AND EMP_Status=1 AND EMP_AccountsApprover=1 AND EMP_Access=1 ORDER BY EMP_Name ASC");
    ?>
    <div class="col-md-4"><label for="erp-hr-leave-req-employee-id">Select Finance Approver<span class="required">*</span></label></div>
    
    <div class="col-md-8">
        
        <select name="employee_id" id="select-finance-approver" required="required" class="form-control">
    <option value="0">- Select -</option>
    <?php
    foreach($allemps as $value){
    ?>
    <option value="<?php echo $value->EMP_Id;?>"><?php echo $value->EMP_Code." - ".$value->EMP_Name; ?></option>
    <?php } ?>
    </select>
    </div>
    
    </div>
    <div class="col-md-4">
        <div class="col-md-8">
        <input type="hidden" id="aplId">
        <input  value="" id="limit_amount" type="text" class="form-control">
        </div>
        <div class="col-md-4">
            <input type="submit" class="btn btn-primary btn-block" id="submit_app_limit">
        </div>
    </div>

    </div>
    
    <!-- Messages -->
   
    
    </div>
 
    <div id="approvers_limit" style="display:none;text-align: center">
    
    </div>
        <?php
            global $wpdb;

            $table = new WeDevs\ERP\Company\Approval_Limits();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>
</div>
        </div>
        </div>

    
</div>
