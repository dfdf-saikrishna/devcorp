<?php

namespace WeDevs\ERP\Company;

use WeDevs\ERP\Framework\Traits\Ajax;
use WeDevs\ERP\Framework\Traits\Hooker;
use WeDevs\ERP\HRM\Models\Dependents;
use WeDevs\ERP\HRM\Models\Education;
use WeDevs\ERP\HRM\Models\Work_Experience;

/**
 * Ajax handler
 *
 * @package WP-ERP
 */
class Ajax_Handler {

    use Ajax;

use Hooker;

    /**
     * Bind all the ajax event for HRM
     *
     * @since 0.1
     *
     * @return void
     */
    public function __construct() {

        // Company Employee
        $this->action('wp_ajax_companyemployee_create', 'companyemployee_create');
        $this->action('wp_ajax_companyemployee_get', 'companyemployee_get');
        $this->action('wp_ajax_companyemployee-delete', 'companyemployee_remove');
        $this->action('wp_ajax_companyemployee_view', 'companyemployee_view');
        $this->action('wp_ajax_allow-access', 'allow_access');
        $this->action('wp_ajax_block-access', 'block_access');
        $this->action('wp_ajax_subcats_edit', 'subcats_edit');
         $this->action('wp_ajax_subcats_update', 'subcats_update');
        // Company Admin
        $this->action('wp_ajax_companyadmin_create', 'companyadmin_create');
        $this->action('wp_ajax_companyadmin_get', 'companyadmin_get');
        $this->action('wp_ajax_companyadmin-delete', 'companyadmin_remove');

        //Upload Employee
        $this->action('wp_ajax_employee-upload', 'employee_upload');

        // Workflow
        $this->action('wp_ajax_save-PreTrvPol', 'save_PreTrvPol');
        $this->action('wp_ajax_save-PostTrvPol', 'save_PostTrvPol');
        $this->action('wp_ajax_save-GenExpReq', 'save_GenExpReq');
        $this->action('wp_ajax_save-MileageReq', 'save_MileageReq');
        $this->action('wp_ajax_save-UtilityReq', 'save_UtilityReq');

        // Finance
        $this->action('wp_ajax_get-limit-amount', 'get_limit_amount');
        $this->action('wp_ajax_set-limit-amount', 'set_limit_amount');
        $this->action('wp_ajax_remove-finance-approver', 'remove_finance_approver');
        $this->action('wp_ajax_set-finance-approver', 'set_finance_approver');


        // Employee
        $this->action('wp_ajax_erp-hr-employee-new', 'employee_create');
        $this->action('wp_ajax_erp-hr-emp-get', 'company_get');
        $this->action('wp_ajax_erp-hr-employeeview-get', 'employeeview_get');
        $this->action('wp_ajax_erp-hr-companyview-get', 'companyview_get');
        $this->action('wp_ajax_erp-hr-emp-delete', 'employee_remove');
        $this->action('wp_ajax_erp-hr-emp-restore', 'employee_restore');
        $this->action('wp_ajax_erp-hr-emp-update-status', 'employee_update_employment');
        $this->action('wp_ajax_erp-hr-emp-update-comp', 'employee_update_compensation');
        $this->action('wp_ajax_erp-hr-emp-delete-history', 'employee_remove_history');
        $this->action('wp_ajax_erp-hr-emp-update-jobinfo', 'employee_update_job_info');
        $this->action('wp_ajax_erp-hr-empl-leave-history', 'get_employee_leave_history');
        $this->action('wp_ajax_erp-hr-employee-new-note', 'employee_add_note');
        $this->action('wp_ajax_erp-load-more-notes', 'employee_load_note');
        $this->action('wp_ajax_erp-delete-employee-note', 'employee_delete_note');
        $this->action('wp_ajax_erp-hr-emp-update-terminate-reason', 'employee_terminate');
        $this->action('wp_ajax_erp-hr-emp-activate', 'employee_termination_reactive');
        $this->action('wp_ajax_erp-hr-convert-wp-to-employee', 'employee_create_from_wp_user');
        $this->action('wp_ajax_erp_hr_check_user_exist', 'check_user');
        $this->action('wp_ajax_empnotify-list', 'empnotify_list');
        $this->action('wp_ajax_empnotify-send', 'empnotify_send');

        //Grades
        $this->action('wp_ajax_grades_create', 'grades_create');
        $this->action('wp_ajax_grades_get', 'grades_get');
		$this->action('wp_ajax_auto_approval', 'auto_approval');
        //Grades
        $this->action('wp_ajax_designation_create', 'designation_create');
        $this->action('wp_ajax_designation_get', 'designation_get');
        //Grades
        $this->action('wp_ajax_departments_create', 'departments_create');
        $this->action('wp_ajax_departments_get', 'departments_get');
        //Mielage
        $this->action('wp_ajax_mileage_create', 'mileage_create');
        $this->action('wp_ajax_mileage_get', 'mileage_get');
        //Travel DEsk
        $this->action('wp_ajax_traveldesk_create', 'traveldesk_create');
        $this->action('wp_ajax_traveldesk_get', 'traveldesk_get');
        //limits
        $this->action('wp_ajax_tolerance_limit_amount', 'tolerance_limit_amount');

        //Project Code
        $this->action('wp_ajax_projectcode_create', 'projectcode_create');
        $this->action('wp_ajax_projectcode_get', 'projectcode_get');
        $this->action('wp_ajax_projectbudget_create', 'projectbudget_create');
        $this->action('wp_ajax_projectbudget_get', 'projectbudget_get');
        //costcenter
        $this->action('wp_ajax_costcenter_create', 'costcenter_create');
        $this->action('wp_ajax_costcenter_get', 'costcenter_get');
        $this->action('wp_ajax_get-costcenter-details', 'get_costcenter_details');
        $this->action('wp_ajax_get-project-codes', 'get_project_codes');

        //categorybudget
        $this->action('wp_ajax_categorybudget_create', 'categorybudget_create');
        $this->action('wp_ajax_categorybudget_get', 'categorybudget_get');
        $this->action('wp_ajax_projectcode_change', 'projectcode_change');
        //grade limits
        //$this->action('wp_ajax_gradelimits-create', 'gradelimits_create');
        $this->action('wp_ajax_gradelimits_get', 'gradelimits_get');
        $this->action('wp_ajax_gradelimitscat-get', 'gradelimitscat_get');
        $this->action('wp_ajax_gradelimitsaccomadation_get', 'gradelimitsaccomadation_get');
          $this->action('wp_ajax_gradelimitothers_get', 'gradelimitothers_get');
      $this->action('wp_ajax_gradelimitgeneral_get', 'gradelimitgeneral_get');


        //Mielage
        $this->action('wp_ajax_subcategory_create', 'subcategory_create');
        $this->action('wp_ajax_subcategory_get', 'subcategory_get');
		
    }
	
	public function auto_approval(){
		global $wpdb;
		$compid = $_SESSION['compid'];
		$posted = array_map('strip_tags_deep', $_POST);
		$grades = $posted['grades'];
		$selgrades = $wpdb->get_results("SELECT * From employee_grades Where COM_Id='$compid' AND EG_Status=1");
		foreach($selgrades as $selgrade)
		{
			if(in_array($selgrade->EG_Id,$grades))
			{
				$wpdb->update('employee_grades', array('EMP_Grade' => '1'), array('EG_Id' => $selgrade->EG_Id));
			}
			else
			{
				$wpdb->update('employee_grades', array('EMP_Grade' => '0'), array('EG_Id' => $selgrade->EG_Id));
			}
		}
		$response = array('status' => 'success', 'message' => "Auto Approval Submitted Successfully");
    	$this->send_success($response);
	}
        //Sub category functions
    public function subcategory_create() {
       // $compid = $_SESSION['compid'];
        //echo $compid;die;
        //$this->send_success("fjjkdfj");
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
        $subcategory = subcategory_create($posted);
        $subcategorydata = $posted;
        $this->send_success($subcategorydata);
    }
    
    public function get_project_codes(){
    	global $wpdb;
    	$posted = array_map('strip_tags_deep', $_POST);
    	$CostCenter = $posted['CostCenter'];
    	$result = $wpdb->get_results("SELECT * FROM project_code WHERE CC_Id = '$CostCenter' AND PC_Active=1");
    	$this->send_success($result);
    }
    
    public function subcats_edit(){
    	global $wpdb;
    	$compid = $_SESSION['compid'];
    	$posted = array_map('strip_tags_deep', $_POST);
    	$id = $posted['id'];
    	$mode = $wpdb->get_row("SELECT MOD_Name,MOD_Id FROM mode WHERE MOD_Id=$id AND COM_Id ='$compid'");
    	$this->send_success($mode);
    }
    
    public function subcats_update(){
    	global $wpdb;
    	$tablename='mode';
    	$compid = $_SESSION['compid'];
    	$posted = array_map('strip_tags_deep', $_POST);
    	$id = $posted['modeid'];
    	$modename=$posted['modename'];
    	$mode = $wpdb->update($tablename,array( 'MOD_Name' => $modename),array( 'MOD_Id' => $id ));
    	$response = array('status' => 'Success', 'message' => "Expense Category Updated Successfully");
    	$this->send_success($response);
    }

    public function subcategory_get() {
        global $wpdb;

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        $response = $wpdb->get_row("SELECT * FROM mode WHERE MOD_Id = $id");

        $this->send_success($response);
    }
    //costcenter
    public function costcenter_create() {
        //$this->send_success('lakshmi');
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);
        $posted = array_map('strip_tags_deep', $_POST);
        $costcenter = costcenter_create($posted);
        $costcenterdata = $posted;
        //echo $posted;die;
        $this->send_success($costcenterdata);
    }
    
    //GET Employee Notification List
    public function empnotify_list() {
        global $wpdb;
    	$data = array_map('strip_tags_deep', $_POST);
    	$fuId = $data['fuId'];
	$response = $wpdb->get_results("SELECT * FROM mail_notifications WHERE FU_Id = '$fuId'");
    	$this->send_success($response);
    }
    
    public function empnotify_send() { 
        global $wpdb;
    	$data = array_map('strip_tags_deep', $_POST);
    	$array = $data['select'];
    	if (empty($array))
    	{
    	$response = array('status' => 'Failure', 'message' => "Please Select Atleast One Employee");
    	$this->send_success($response);
    	}
        foreach ($array as $user_id) {
            // user notification email
	    $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
	    $send_login = isset($posted['login_info']) ? true : false;
	    if (is_a($emailer, '\WeDevs\ERP\Email')) {
	        //$this->send_success($emailer);
	        $emailer->trigger($user_id, $send_login);
	        $wpdb->delete( 'mail_notifications', array( 'ID' => $user_id ) );
	    }
        }
        $response = array('status' => 'Success', 'message' => "Activation Mail sent for Selected Users");
    	$this->send_success($response);
    }
   
    //costcenter

    public function categorybudget_create() {

        global $wpdb;
        $tablename = 'Categorybudgets';
        $compid = $_SESSION['compid'];
        $data = array_map('strip_tags_deep', $_POST);
       //$ccLocation = $data['company']['txtCostcenter'];
        $pcid = $data['company']['txtprojectcode'];
        $cctravel = $data['company']['txtCategorytravel'];
        $ccmileage = $data['company']['txtCategorymileage'];
        $ccutility = $data['company']['txtCategoryutility'];
        $ccother = $data['company']['txtCategoryothers'];
          
       $pcBudget = $wpdb->get_row("SELECT PC_Budget FROM project_code WHERE PC_Id = '$pcid' AND COM_Id='$compid'");
       $ccId = $wpdb->get_row("SELECT CC_Id,cc_Budget FROM project_code WHERE PC_Id = '$pcid' AND COM_Id='$compid'");
       $totalccbudget= $ccId->cc_Budget;
       $total=$cctravel+$ccmileage+$ccutility+$ccother;
       $totalpcbudget= $pcBudget->PC_Budget;
       //$this->send_success($totalpcbudget);die;
        
     if($total>$totalpcbudget) 
       {
        $this->send_success("Budget limits exceeded");
        }
      else 
     {
        $company_data = array(
        'COM_Id' => $compid,
        'CB_Active' => '1',
        'PC_Budget' => $totalpcbudget,
        'CC_Id' => $ccId->CC_Id,
        'PC_Id' => $pcid,
        'Travel_Category' => $data['company']['txtCategorytravel'],
        'Project_code' => $data['company']['txtprojectcode'],
        'Milage_Category' => $data['company']['txtCategorymileage'],
        'Utility_Category' => $data['company']['txtCategoryutility'],
        'Others_Category' => $data['company']['txtCategoryothers'],
         
        );
        if($categoryId = $wpdb->get_row("SELECT CB_Id FROM $tablename WHERE PC_Id = '$pcid'"))
        $categorybudgetrdata = $wpdb->update($tablename, $company_data, array('CB_Id' => $categoryId->CB_Id));
        else
        $categorybudgetrdata = $wpdb->insert($tablename, $company_data);
        
        $categorybudgetrdata = $data;
        //echo $posted;die;
        $this->send_success($company_data);
        }
    }

    public function projectcode_change() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $ccid=$posted['id'];
        $cost_center = $wpdb->get_row("SELECT cc_Budget FROM cost_center WHERE CC_Id = $ccid");
        $totalsum = $wpdb->get_row("SELECT SUM(PC_Budget) as total FROM project_code WHERE CC_Id = '$ccid' AND COM_Id='$compid' AND PC_Status='1' AND PC_Active='1'");
        $remaining_budget = $cost_center->cc_Budget-$totalsum->total;
        $response = array('remaining_budget' => $remaining_budget, 'total_budget' => $cost_center->cc_Budget);
        $this->send_success($response);
    }

    public function costcenter_get() {
        global $wpdb;
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $response = $wpdb->get_row("SELECT * FROM cost_center WHERE CC_Id = $id");
        $this->send_success($response);
    }
    
    public function get_costcenter_details(){
    	global $wpdb;
        $compid = $_SESSION['compid'];
    	$posted = array_map('strip_tags_deep', $_POST);
    	$costcenter = $posted['costcenter'];
    	$projects = $wpdb->get_results("SELECT * FROM project_code WHERE CC_Id = $costcenter AND COM_Id = $compid");
    	$table = array();
	$table['cols'] = array(
		/* define your DataTable columns here
		 * each column gets its own array
		 * syntax of the arrays is:
		 * label => column label
		 * type => data type of column (string, number, date, datetime, boolean)
		 */
	    	array('label' => 'Label of column 1', 'type' => 'string'),
		array('label' => 'Label of column 2', 'type' => 'number'),
		// etc...
	);
	$cc = $wpdb->get_row("SELECT cc_Budget FROM cost_center WHERE CC_Id = $costcenter AND COM_Id = $compid");
	$rows = array();
    	$temp = array();
    	foreach ($projects as $row) {
	$percent = ( $row->PC_Budget / $cc->cc_Budget ) * 100;
	// each column needs to have data inserted via the $temp array
	$temp[] = array('v' => $row->PC_Budget, 'f' => $row->PC_Code);
	$temp[] = array('v' => $percent, 'f' => null);		
	// etc...
	$rows[] = array('c' => $temp);
	$temp = null;

    	}
    	$totalsum = $wpdb->get_row("SELECT SUM(PC_Budget) as total FROM project_code WHERE CC_Id = '$costcenter' AND COM_Id='$compid' AND PC_Status='1' AND PC_Active='1'");
    	$remaining = ( $totalsum->total / $cc->cc_Budget ) * 100;
    	$remaining = 100 - $remaining;
	$temp[] = array('v' => $row->PC_Budget, 'f' => 'Remaining Budget');
	$temp[] = array('v' => $remaining, 'f' => null);
	$rows[] = array('c' => $temp);
	// insert the temp array into $rows
    	//$rows[] = array('c' => $temp);
    	
    	// populate the table with rows of data
	$table['rows'] = $rows;
    	$jsonTable = json_encode($table,true);

    	$this->send_success($jsonTable);
    }

    //costcenter
    public function projectcode_create() {
        //$this->send_success('lakshmi');
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);
        $posted = array_map('strip_tags_deep', $_POST);
        $projectcode = projectcode_create($posted);
        $projectcodedata = $posted;
        //echo $posted;die;
        $this->send_success($projectcode);
    }

    public function projectcode_get() {
        global $wpdb;
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $response = $wpdb->get_row("SELECT * FROM project_code WHERE PC_Id = $id");
        $category_budget = $wpdb->get_row("SELECT * FROM Categorybudgets WHERE PC_Id = $id");
        //print_r($category_budget);die;
        //$response['category_budget'] = $category_budget;
        $cost_center = $wpdb->get_row("SELECT cc_Budget FROM cost_center WHERE CC_Id = $response->CC_Id");
        $obj_merged = (object) array_merge((array) $response, (array) $category_budget, (array) $cost_center);
        $this->send_success($obj_merged);
    }
    
    public function projectbudget_create() {
        $posted = array_map('strip_tags_deep', $_POST);
        $projectcode = pbudget_create($posted);
        $projectcodedata = $posted;
        //echo $posted;die;
        $this->send_success($projectcode);
    }

    public function projectbudget_get() {
        global $wpdb;
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $response = $wpdb->get_row("SELECT * FROM project_code WHERE PC_Id = $id");
        $this->send_success($response);
    }

    //grades createfunctions
    public function grades_create() {
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
        $gardes = grades_create($posted);
        $gardesdata = $posted;
        $this->send_success($gardesdata);
    }

    public function grades_get() {
        global $wpdb;
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $response = $wpdb->get_row("SELECT * FROM employee_grades WHERE EG_Id = $id");
        $this->send_success($response);
    }

    //desgination_createfunctions
    public function designation_create() {
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
        $designation = designation_create($posted);

        $designationdata = $posted;

        $this->send_success($designationdata);
    }

    public function designation_get() {
        global $wpdb;

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        $response = $wpdb->get_row("SELECT * FROM designation WHERE DES_Id = $id");

        $this->send_success($response);
    }

    //Mileage functions
    public function departments_create() {
        //$this->send_success('fvjnf');
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
        $departments = departments_create($posted);
        $departmentsdata = $posted;
        $this->send_success($departmentsdata);
    }

    public function departments_get() {
        global $wpdb;

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        $response = $wpdb->get_row("SELECT * FROM department WHERE DEP_Id = $id");

        $this->send_success($response);
    }

    public function traveldesk_create() {
        // $this->verify_nonce( 'wp-erp-hr-travelagent-nonce' );
        //$this->send_success('lakshmi');
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);
        $posted = array_map('strip_tags_deep', $_POST);
        //print_r($posted);die;
        $traveldesk_id = traveldesk_create($posted);

        $traveldesk = new TravelDesk($traveldesk_id);
        //if ( isset( $posted['user_notification'] ) && $posted['user_notification'] == 'on' ) {
        $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
        $send_login = isset($posted['login_info']) ? true : false;

        if (is_a($emailer, '\WeDevs\ERP\Email')) {
            $emailer->trigger($traveldesk_id, $send_login);
        }
        $data = $posted;
        $this->send_success($data);
    }

    public function traveldesk_get() {
        global $wpdb;

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        $response = $wpdb->get_row("SELECT * FROM travel_desk WHERE TD_Id = $id");
        $this->send_success($response);
    }

    public function tolerance_limit_amount() {
        //$this->send_success('testing');
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $txtLimitPercentage = trim($data['txtLimitPercentage']);
        $tlId = $data['tlId'];

        //$txtLimitPercentage ? $txtLimitPercentage = "'" . $txtLimitPercentage . "'" : $txtLimitPercentage = "0";

        $row = $wpdb->get_results("SELECT * FROM  tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
//print_r($row[0]->TL_Id);die;
        //foreach ($row as $rowtlid){
//        if (!empty($rowtlid !=->TL_Id)) {
        if ($row[0]->TL_Id != "") {
            if ($txtLimitPercentage == $row[0]->TL_Percentage) {

                $response = array('status' => 'info', 'message' => "Please choose a different percentage to update the tolerance limits");
                $this->send_success($response);
                exit;
            } else {
                date_default_timezone_set('Asia/Kolkata');
                $date = date('y-m-d  h:i:s');

                if ($wpdb->update('tolerance_limits', array('TL_Status' => '2', 'TL_ClosedDate' => $date), array('COM_Id' => $compid))) {

                    if ($wpdb->insert('tolerance_limits', array('COM_Id' => $compid, 'TL_Percentage' => $txtLimitPercentage,))) {

                        $response = array('status' => 'info', 'message' => "Previous tolerance limit was closed and new tolerance limit added successfully");
                        $this->send_success($response);
                        exit;
                    } else {
                        $response = array('status' => 'failure', 'message' => "Error!! Please try again");
                        $this->send_success($response);
                        exit;
                    }
                } else {

                    $response = array('status' => 'failure', 'message' => "Error!! Please try again");
                    $this->send_success($response);
                    exit;
                }
            }
        } else {
            if ($wpdb->insert('tolerance_limits', array('COM_Id' => $compid, 'TL_Percentage' => $txtLimitPercentage,))) {
                $response = array('status' => 'success', 'message' => "Tolerance limit added successfully");
                $this->send_success($response);
                exit;
            } else {

                $response = array('status' => 'failure', 'message' => "Error!! Please try again");
                $this->send_success($response);
                exit;
            }
        }
        //}
    }

    public function gradelimitscat_get() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        if (isset($_POST['id'])) {
            $id = $data['id'];
            $compid = $_SESSION['compid'];
            //$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
            $response = $wpdb->get_row("SELECT * FROM employee_grades eg, grade_limits gl WHERE eg.COM_Id='$compid' AND eg.EG_Id='$id' AND eg.EG_Id=gl.EG_Id AND eg.EG_Status=1 AND gl.GL_Status=1 ORDER BY eg.EG_Id ASC ");
            $this->send_success($response);
        } else {
            $gradelimits = gradelimitscat_create($posted);
            $this->send_success($gradelimits);
        }
    }
       public function gradelimitsaccomadation_get() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        if (isset($_POST['id'])) {
            $id = $data['id'];
            $compid = $_SESSION['compid'];
            //$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
            $response = $wpdb->get_row("SELECT * FROM employee_grades eg, grade_limits gl WHERE eg.COM_Id='$compid' AND eg.EG_Id='$id' AND eg.EG_Id=gl.EG_Id AND eg.EG_Status=1 AND gl.GL_Status=1 ORDER BY eg.EG_Id ASC ");
            $this->send_success($response);
        } else {
            $gradelimits = gradelimitsaccomadation_create($posted);
            $this->send_success($gradelimits);
        }
    }
     public function gradelimitothers_get() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        if (isset($_POST['id'])) {
            $id = $data['id'];
            $compid = $_SESSION['compid'];
            //$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
            $response = $wpdb->get_row("SELECT * FROM employee_grades eg, grade_limits gl WHERE eg.COM_Id='$compid' AND eg.EG_Id='$id' AND eg.EG_Id=gl.EG_Id AND eg.EG_Status=1 AND gl.GL_Status=1 ORDER BY eg.EG_Id ASC ");
            $this->send_success($response);
        } else {
            $gradelimits = gradelimitsotthers_create($posted);
            $this->send_success($gradelimits);
        }
    }
       public function gradelimitgeneral_get() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        if (isset($_POST['id'])) {
            $id = $data['id'];
            $compid = $_SESSION['compid'];
            //$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
            $response = $wpdb->get_row("SELECT * FROM employee_grades eg, grade_limits gl WHERE eg.COM_Id='$compid' AND eg.EG_Id='$id' AND eg.EG_Id=gl.EG_Id AND eg.EG_Status=1 AND gl.GL_Status=1 ORDER BY eg.EG_Id ASC ");
            $this->send_success($response);
        } else {
            $gradelimits = gradelimitsgeneral_create($posted);
            $this->send_success($gradelimits);
        }
    }


    //gradelimits functions
    public function gradelimits_create() {

        // $this->send_success("test123");
        $posted = array_map('strip_tags_deep', $_POST);
        $gradelimits = gradelimits_create($posted);
        $gradelimitsdata = $posted;
        $this->send_success($gradelimits);
    }

    public function gradelimits_get() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        if (isset($_POST['id'])) {
            $id = $data['id'];
            $compid = $_SESSION['compid'];
            //$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
            $response = $wpdb->get_row("SELECT * FROM employee_grades eg, grade_limits gl WHERE eg.COM_Id='$compid' AND eg.EG_Id='$id' AND eg.EG_Id=gl.EG_Id AND eg.EG_Status=1 AND gl.GL_Status=1 ORDER BY eg.EG_Id ASC ");
            //echo $response;die;
            $this->send_success($response);
        } else {
            $gradelimits = gradelimits_create($posted);
            //$gradelimitsdata = $posted;
            $this->send_success($gradelimits);
        }
    }

    //Mileage functions
    public function mileage_create() {
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
        $mileage = mileage_create($posted);
        $mileagedata = $posted;
        $this->send_success($mileagedata);
    }

    public function mileage_get() {
        global $wpdb;

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        $response = $wpdb->get_row("SELECT * FROM mileage WHERE MIL_Id = $id");

        $this->send_success($response);
    }

    /**
     * Delete a department
     *
     * @return void
     */
    public function designation_delete() {
        $this->verify_nonce('wp-erp-hr-nonce');

        //check permission
        if (!current_user_can('erp_manage_designation')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id) {
            // @TODO: check permission
            $deleted = erp_hr_delete_designation($id);

            if (is_wp_error($deleted)) {
                $this->send_error($deleted->get_error_message());
            }

            $this->send_success(__('Designation has been deleted', 'erp'));
        }

        $this->send_error(__('Something went wrong!', 'erp'));
    }

    public function employee_upload() {
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $this->send_success($data);
    }

    /**
     * Function to return Limit Amount
     *
     * @return void
     */
    public function get_limit_amount() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $row = $wpdb->get_row("SELECT * FROM approval_limit WHERE EMP_Id='$data[employee_id]' AND APL_Status=1 AND APL_Active=1");
        $this->send_success($row);
    }

    public function set_limit_amount() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $txtLimitAmount = trim($data['limit_amount']);
        $empid = $data['empid'];
        $aplid = $data['aplId'];

        if ($aplid) {

            $rowaplid = $wpdb->get_row("SELECT * FROM approval_limit WHERE APL_Id='$aplid' AND APL_Status=1 AND APL_Active=1");

            if ($txtLimitAmount == $rowaplid->APL_LimitAmount) {

                //header("location:$filename?msg=1&empid=$empid");
                $response = array('status' => 'notice', 'message' => "Please choose a different amount to update the approval limits");
                $this->send_success($response);
                exit;
            } else {
                if ($wpdb->update('approval_limit', array('APL_Status' => '2', 'APL_ClosedDate' => 'NOW()'), array('EMP_Id' => $empid, 'APL_Id' => $aplid))) {

                    if ($wpdb->insert('approval_limit', array('EMP_Id' => $empid, 'APL_LimitAmount' => $txtLimitAmount,))) {

                        $response = array('status' => 'info', 'message' => "Previous amount limit was closed and new amount limit added successfully");
                        $this->send_success($response);
                        exit;
                    } else {
                        $response = array('status' => 'failure', 'message' => "Error!! Please try again");
                        $this->send_success($response);
                        exit;
                    }
                } else {

                    $response = array('status' => 'failure', 'message' => "Error!! Please try again");
                    $this->send_success($response);
                    exit;
                }
            }
        } else {

            if ($wpdb->insert('approval_limit', array('EMP_Id' => $empid, 'APL_LimitAmount' => $txtLimitAmount,))) {
                $response = array('status' => 'success', 'message' => "Amount limit added successfully");
                $this->send_success($response);
                exit;
            } else {

                $response = array('status' => 'failure', 'message' => "Error!! Please try again");
                $this->send_success($response);
                exit;
            }
        }
    }

    public function set_finance_approver() {
        global $wpdb;
        global $blocked;
        $adminid = $_SESSION['adminid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $array = $data['select'];
        foreach ($array as $value) {

            $selemp = $wpdb->get_row("SELECT EMP_Code, EMP_Access FROM employees WHERE EMP_Id='$value'");
            if ($selemp->EMP_Access == 1) {

                if (!$sel = $wpdb->get_row("SELECT * FROM accounts_set_approver WHERE EMP_Id='$value' AND ASA_Set=1")) {

                    $wpdb->insert('accounts_set_approver', array('EMP_Id' => $value, 'COM_Id' => $compid, 'ASA_SetBy' => $adminid));
                    $wpdb->update('employees', array('EMP_AccountsApprover' => 1), array('EMP_Id' => $value));

                    $user_id = $wpdb->get_row("SELECT user_id FROM employees WHERE EMP_Id='$value'");
                    $user = get_user_by('id', intval($user_id->user_id));
                    $user->add_role('finance');
                }
            } else {
                $blocked.=$selemp->EMP_Code . ", ";
            }
        }
        $blocked = rtrim($blocked, ", ");
        if ($blocked)
            $response = array('status' => 'failure', 'message' => "Employee Not Active.$blocked");
        else
            $response = array('status' => 'success', 'message' => "Employee set as finance approver successfully");
        $this->send_success($response);
        exit;
    }

    public function remove_finance_approver() {
        global $wpdb;
        global $blocked;
        $adminid = $_SESSION['adminid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $array = $data['select'];
        foreach ($array as $value) {
            $selemp = $wpdb->get_row("SELECT EMP_Code, EMP_Access FROM employees WHERE EMP_Id='$value'");
            if ($wpdb->get_row("SELECT * FROM accounts_set_approver WHERE EMP_Id='$value' AND ASA_Set=1")) {
                $wpdb->update('accounts_set_approver', array('ASA_Set' => 2, 'ASA_ResetDate' => 'NOW()', 'ASA_ResetBy' => $adminid), array('EMP_Id' => $value, 'ASA_Set' => 1));
                $wpdb->update('employees', array('EMP_AccountsApprover' => 0), array('EMP_Id' => $value));
                $user_id = $wpdb->get_row("SELECT user_id FROM employees WHERE EMP_Id='$value'");
                $user = get_user_by('id', intval($user_id->user_id));
                $user->remove_role('finance');
            } else {
                $blocked.=$selemp->EMP_Code . ", ";
            }
        }
        if ($blocked) {
            $response = array('status' => 'failure', 'message' => "Employee Not Active.$blocked");
            $this->send_success($response);
        } else {
            $response = array('status' => 'success', 'message' => "Employee removed as finance approver successfully");
            $this->send_success($response);
        }
    }

    public function allow_access() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $array = $data['select'];
        foreach ($array as $value) {
            $wpdb->update('employees', array('EMP_Access' => 1), array('EMP_Id' => $value));
        }
        $response = array('status' => 'success', 'message' => "Employee Activated Successfully");
        $this->send_success($response);
        exit;
    }

    public function block_access() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $array = $data['select'];
        foreach ($array as $value) {
            $wpdb->update('employees', array('EMP_Access' => 2), array('EMP_Id' => $value));
        }
        $response = array('status' => 'success', 'message' => "Employee Blocked Successfully");
        $this->send_success($response);
        exit;
    }

    public function save_PreTrvPol() {
        global $wpdb;
        $adminid = $_SESSION['adminid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $selPreTrvPol = $data['select'];

        if ($selPreTrvPol != 0) {


            if ($selpol = $wpdb->get_row("SELECT * FROM workflow_period WHERE COM_Id='$compid' AND RT_Id=1 AND WP_Status=1")) {
                $wpdb->update('workflow_period', array('WP_Removed_Admid' => $adminid), array('WP_Status' => 2, 'WP_To' => 'NOW()', 'WP_Id' => $selpol->WP_Id));

                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selPreTrvPol, 'RT_Id' => 1, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Pre travel expense request workflow updated Successfully";
            } else {
                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selPreTrvPol, 'RT_Id' => 1, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Pre travel expense request workflow added Successfully";
            }

            $wpdb->update('company', array('COM_Pretrv_POL_Id' => $selPreTrvPol), array('COM_Id' => $compid));

            $response = array('status' => 'success', 'message' => $msg);
            $this->send_success($response);
            exit;
        } else {
            $response = array('status' => 'failure', 'message' => 'Please select a workflow to update');
            $this->send_success($response);
            exit;
        }
    }

    public function save_PostTrvPol() {
        global $wpdb;
        $adminid = $_SESSION['adminid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $selPostTrvPol = $data['select'];

        if ($selPostTrvPol != 0) {


            if ($selpol = $wpdb->get_row("SELECT * FROM workflow_period WHERE COM_Id='$compid' AND RT_Id=2 AND WP_Status=1")) {
                $wpdb->update('workflow_period', array('WP_Removed_Admid' => $adminid), array('WP_Status' => 2, 'WP_To' => 'NOW()', 'WP_Id' => $selpol->WP_Id));

                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selPostTrvPol, 'RT_Id' => 2, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Post travel expense request workflow updated Successfully";
            } else {
                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selPostTrvPol, 'RT_Id' => 2, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Post travel expense request workflow added Successfully";
            }

            $wpdb->update('company', array('COM_Posttrv_POL_Id' => $selPostTrvPol), array('COM_Id' => $compid));

            $response = array('status' => 'success', 'message' => $msg);
            $this->send_success($response);
            exit;
        } else {
            $response = array('status' => 'failure', 'message' => 'Please select a workflow to update');
            $this->send_success($response);
            exit;
        }
    }

    public function save_GenExpReq() {
        global $wpdb;
        $adminid = $_SESSION['adminid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $selCompanyPol = $data['select'];

        if ($selCompanyPol != 0) {


            if ($selpol = $wpdb->get_row("SELECT * FROM workflow_period WHERE COM_Id='$compid' AND RT_Id=3 AND WP_Status=1")) {
                $wpdb->update('workflow_period', array('WP_Removed_Admid' => $adminid), array('WP_Status' => 2, 'WP_To' => 'NOW()', 'WP_Id' => $selpol->WP_Id));

                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selCompanyPol, 'RT_Id' => 2, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "General expense request workflow updated Successfully";
            } else {
                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selCompanyPol, 'RT_Id' => 3, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "General expense request workflow added Successfully";
            }

            $wpdb->update('company', array('COM_Othertrv_POL_Id' => $selCompanyPol), array('COM_Id' => $compid));

            $response = array('status' => 'success', 'message' => $msg);
            $this->send_success($response);
            exit;
        } else {
            $response = array('status' => 'failure', 'message' => 'Please select a workflow to update');
            $this->send_success($response);
            exit;
        }
    }

    public function save_MileageReq() {
        global $wpdb;
        $adminid = $_SESSION['adminid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $selCompanyPol = $data['select'];

        if ($selCompanyPol != 0) {


            if ($selpol = $wpdb->get_row("SELECT * FROM workflow_period WHERE COM_Id='$compid' AND RT_Id=5 AND WP_Status=1")) {
                $wpdb->update('workflow_period', array('WP_Removed_Admid' => $adminid), array('WP_Status' => 2, 'WP_To' => 'NOW()', 'WP_Id' => $selpol->WP_Id));

                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selCompanyPol, 'RT_Id' => 5, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Mileage request workflow updated Successfully";
            } else {
                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selCompanyPol, 'RT_Id' => 5, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Mileage request workflow added Successfully";
            }

            $wpdb->update('company', array('COM_Mileage_POL_Id' => $selCompanyPol), array('COM_Id' => $compid));

            $response = array('status' => 'success', 'message' => $msg);
            $this->send_success($response);
            exit;
        } else {
            $response = array('status' => 'failure', 'message' => 'Please select a workflow to update');
            $this->send_success($response);
            exit;
        }
    }

    public function save_UtilityReq() {
        global $wpdb;
        $adminid = $_SESSION['adminid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;

        $selCompanyPol = $data['select'];

        if ($selCompanyPol != 0) {


            if ($selpol = $wpdb->get_row("SELECT * FROM workflow_period WHERE COM_Id='$compid' AND RT_Id=6 AND WP_Status=1")) {
                $wpdb->update('workflow_period', array('WP_Removed_Admid' => $adminid), array('WP_Status' => 2, 'WP_To' => 'NOW()', 'WP_Id' => $selpol->WP_Id));

                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selCompanyPol, 'RT_Id' => 6, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Utility request workflow updated Successfully";
            } else {
                $wpdb->insert('workflow_period', array('COM_Id' => $compid, 'POL_Id' => $selCompanyPol, 'RT_Id' => 6, 'WP_Added_Admid' => $adminid, 'WP_From' => 'NOW()'));

                $msg = "Utility request workflow added Successfully";
            }

            $wpdb->update('company', array('COM_Utility_POL_Id' => $selCompanyPol), array('COM_Id' => $compid));

            $response = array('status' => 'success', 'message' => $msg);
            $this->send_success($response);
            exit;
        } else {
            $response = array('status' => 'failure', 'message' => 'Please select a workflow to update');
            $this->send_success($response);
            exit;
        }
    }

    /**
     * Create/update an employee
     *
     * @return void
     */
    public function companyadmin_create() {
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );
        //$data = "sai";
        //$this->send_success( $data );
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );

        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
//        $posted['type']       = 'customer';
        // Check permission for editing and adding new employee
//        if ( isset( $posted['user_id'] ) && $posted['user_id'] ) {
//            if ( ! current_user_can( 'erp_edit_employee', $posted['user_id'] ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        } else {
//            if ( ! current_user_can( 'erp_create_employee' ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        }

        $employee_id = companyadmin_create($posted);

//        if ( is_wp_error( $employee_id ) ) {
//            $this->send_error( $employee_id->get_error_message() );
//        }

        $employee = new Employee($employee_id);
        $data = $employee->to_array();
        $data['work']['joined'] = $employee->get_joined_date();
        $data['work']['type'] = $employee->get_type();
        $data['url'] = $employee->get_details_url();

        // user notification email
        //if ( isset( $posted['user_notification'] ) && $posted['user_notification'] == 'on' ) {
        $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
        $send_login = isset($posted['login_info']) ? true : false;

        if (is_a($emailer, '\WeDevs\ERP\Email')) {
            $emailer->trigger($employee_id, $send_login);
        }
        //}
        $data = $posted;
        $this->send_success($data);
    }

    public function companyadmin_get() {
        global $wpdb;
        //       $this->verify_nonce( 'wp-erp-hr-nonce' );

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        //    $user        = get_user_by( 'id', $employee_id );
        //     if ( ! $user ) {
        //          $this->send_error( __( 'Employee does not exists.', 'erp' ) );
        //     }
//       $employee = new Employee( $user );
//        $this->send_success( $employee->to_array() );
        $response = $wpdb->get_row("SELECT * FROM admin WHERE ADM_Id = $id");
        $this->send_success($response);
    }

    /**
     * Create/update an employee
     *
     * @return void
     */
    public function employee_create() {
        $this->verify_nonce('wp-erp-hr-employee-nonce');

        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
//        $posted['type']       = 'customer';
        // Check permission for editing and adding new employee
//        if ( isset( $posted['user_id'] ) && $posted['user_id'] ) {
//            if ( ! current_user_can( 'erp_edit_employee', $posted['user_id'] ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        } else {
//            if ( ! current_user_can( 'erp_create_employee' ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        }

        $employee_id = company_create($posted);

//        if ( is_wp_error( $employee_id ) ) {
//            $this->send_error( $employee_id->get_error_message() );
//        }

        $employee = new Employee($employee_id);
        $data = $employee->to_array();
        $data['work']['joined'] = $employee->get_joined_date();
        $data['work']['type'] = $employee->get_type();
        $data['url'] = $employee->get_details_url();

        // user notification email
        //if ( isset( $posted['user_notification'] ) && $posted['user_notification'] == 'on' ) {
        $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
        $send_login = isset($posted['login_info']) ? true : false;

        if (is_a($emailer, '\WeDevs\ERP\Email')) {
            $emailer->trigger($employee_id, $send_login);
        }
        //}
        //$data = $posted;
        $this->send_success($data);
    }

    /**
     * Get an employee for ajax
     *
     * @return void
     */
    public function company_get() {
        global $wpdb;
//        $this->verify_nonce( 'wp-erp-hr-nonce' );
//
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
//        $user        = get_user_by( 'id', $employee_id );
//
//        if ( ! $user ) {
//            $this->send_error( __( 'Employee does not exists.', 'erp' ) );
//        }
//
//        $employee = new Employee( $user );
        //$this->send_success( $employee->to_array() );
        $response = $wpdb->get_row("SELECT * FROM company WHERE COM_Id = $id");
        $this->send_success($response);
    }

    /**
     * Create/update an employee
     *
     * @return void
     */
    public function companyemployee_create() {
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);
//alert($posted);
        $posted = array_map('strip_tags_deep', $_POST);
        $companyemployee_id = companyemployee_create($posted);
        // user notification email
        $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
        $send_login = isset($posted['login_info']) ? true : false;
	if($companyemployee_id!="User email already Exists"){
        if (is_a($emailer, '\WeDevs\ERP\Email')) {
            $emailer->trigger($companyemployee_id, $send_login);
        }
	}
        $data = $posted;
        $this->send_success($companyemployee_id);
    }

    public function companyemployee_get() {
        global $wpdb;
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $response = $wpdb->get_row("SELECT * FROM employees WHERE EMP_Id = $id");
        $this->send_success($response);
    }

    /**
     * Gets the leave dates
     *
     * Returns the date list between the start and end date of the
     * two dates
     *
     * @since 0.1
     *
     * @return void
     */
    public function companyemployee_view() {
        //$this->send_success( "teststsfd" );
        global $wpdb;
        // $this->verify_nonce( 'wp-erp-hr-nonce' );
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
	
        $response = $wpdb->get_row("SELECT * FROM employees WHERE EMP_Id = '$data[id]'");

        $this->send_success($response);
        //$this->send_success( array( 'id' => $id));
    }

}