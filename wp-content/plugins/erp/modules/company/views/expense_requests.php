<?php
global $wpdb;
$selected_request =$_POST['filter_request'];
$selected_status=$_POST['filter_status'];
$emp=$_POST['filter_emp'];
$compid = $_SESSION['compid'];
//$selected_request = ( isset($_GET['filter_request']) ) ? $_GET['filter_request'] : 0;
//$selected_status = ( isset($_GET['filter_status']) ) ? $_GET['filter_status'] : 0;
//$emp = ( isset($_GET['filter_emp']) ) ? $_GET['filter_emp'] : '';


?>





<div class="postbox">
   <div class="inside">
    <form method="POST" action="#">
    <div class="row filter-top">
    <div class="col-md-3">
        <input type="text" class="form-control" name="s" placeholder="Employee Request">
    </div>
    
    <div class="col-md-3">
        <select name="filter_request" id="filter_request" class="form-control selectpicker input-medium">
                <option value="">- All -</option>
                <?php
                $selsql = $wpdb->get_results("SELECT * From request_type");
                foreach ($selsql as $rowsql) {
                    ?>
                    <option value="<?php echo $rowsql->RT_Id; ?>" <?php if ($selected_request == $rowsql->RT_Id) echo 'selected="selected"'; ?> ><?php echo $rowsql->RT_Name; ?></option>
                <?php } ?>
        </select>
    </div>
    
    <div class="col-md-3">
        <select name="filter_status" id="filter_status" class="form-control selectpicker input-medium" >
                <option value="">- All -</option>
                <option value="2" <?php if ($selected_status == 2) echo 'selected="selected"'; ?> >Approved</option>
                <option value="1" <?php if ($selected_status == 1) echo 'selected="selected"'; ?> >Pending</option>
                <option value="3" <?php if ($selected_status == 3) echo 'selected="selected"'; ?> >Rejected</option>
        </select>
    </div>
    
    <div class="col-md-2">
        <select name="filter_emp" id="filter_emp" class="form-control">
                <option value="">- All -</option>
                <?php
                $selsql = $wpdb->get_results("SELECT EMP_Id, EMP_Code, EMP_Name From employees WHERE EMP_Status=1 AND COM_Id=$compid");
                foreach ($selsql as $rowemp) {
                    ?>
                    <option value="<?php echo $rowemp->EMP_Id; ?>" <?php if ($emp == $rowemp->EMP_Id) echo 'selected="selected"'; ?> ><?php echo $rowemp->EMP_Code . " - " . $rowemp->EMP_Name; ?></option>
                <?php } ?>
            </select>
    </div>
    
    <div class="col-md-1">
              <input type="submit" class="btn btn-primary btn-block" value="Filter">
    </div>
    </div>
    </form>

    <h2><?php _e( 'Expense Requests', 'superadmin' ); ?></h2>
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Company\Requests_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="box panel-widget-style list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
			<form method="post">
			  <input type="hidden" name="page" value="Requests" />
			  <?php //$table->search_box('Search Request Code', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>

    
</div>
