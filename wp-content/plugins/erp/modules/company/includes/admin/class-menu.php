<?php

namespace WeDevs\ERP\Company\Admin;

use WeDevs\ERP\Company\Companyview;
use WeDevs\ERP\Company\Employeeview;

/**
 * Admin Menu
 */
class Admin_Menu {

    /**
     * Kick-in the class
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    /**
     * Add menu items
     *
     * @return void
     */
    public function admin_menu() {

        /*         * ********************************
         * 
         * Company Admin
         * 
         *  ********************************* */
        if (current_user_can('companyadmin')) {
            add_menu_page(__('Dashboard', 'companyadmin'), __('Dashboard', 'companyadmin'), 'companyadmin', 'dashboard', array($this, 'company_dashboard'), 'dashicons-dashboard');

            add_menu_page('Employeemanagement', 'Employee management', 'companyadmin', 'menu', array($this, 'employee_list'), 'dashicons-admin-users');

            $overview = add_submenu_page('menu', 'Add Employees', 'Add Employees', 'companyadmin', 'menu', array($this, 'employee_list'));
            add_submenu_page('menu', 'Upload', 'Upload Employees', 'companyadmin', 'Upload-Employees', array($this, 'upload_employees'));
            add_submenu_page('menu', 'Grades', ' Grades', 'companyadmin', 'Grades', array($this, 'Grades'));
                        add_submenu_page('menu', 'Delegation', 'Delegation', 'companyadmin', 'delegation', array($this, 'empdelegates_list'));

            add_submenu_page('', 'Upload', 'Upload Employees', 'companyadmin', 'Export-Employees', array($this, 'export_employees'));
            add_submenu_page('', 'Upload', 'Display Employees', 'companyadmin', 'Employeesdisplay', array($this, 'EmployeeDisplay'));
            add_submenu_page('menu', 'Profile', 'Employee Profile', 'companyadmin', 'Profile', array($this, 'employeeprofile'));
           // add_submenu_page('', 'Logs', 'View  Employees Logs', 'companyadmin', 'Logs', array($this, 'employeelogs_list'));
            add_submenu_page('menu', 'Des', 'Employees Designation', 'companyadmin', 'Des', array($this, 'Designations'));
           add_submenu_page('', 'dep', 'Employees Departments', 'companyadmin', 'Dep', array($this, 'Departments'));
           // add_submenu_page('', 'dep', 'Employees Departments Manager List', 'companyadmin', 'Department', array($this, 'DepartmentsList'));
	    
	    add_menu_page(__('ExpenseManagment', 'companyadmin'), __('Expense Managment', 'companyadmin'), 'companyadmin', 'expensemenu', array($this, 'ExpenseManagment'));
	    $overview = add_submenu_page('expensemenu', 'Upload Expense Policy', 'Expense Policy', 'companyadmin', 'expensemenu', array($this, 'ExpenseManagment'));

//add_submenu_page('expensemenu', __('default', 'companyadmin'), __('Expense Category', 'companyadmin'), 'companyadmin', 'categeory', array($this, 'DefaultCategory'));

 add_submenu_page('expensemenu', __('Expense Category', 'companyadmin'), __('Add Custom Expense Category', 'companyadmin'), 'companyadmin', 'addcat', array($this, 'SubCatModes'));

            add_submenu_page('expensemenu', __('gradelimitcat', 'companyadmin'), __('Grade Limits', 'companyadmin'), 'companyadmin', 'gradelimitcat', array($this, 'gradelimitcat'));

add_submenu_page('expensemenu', __('Expense Requests', 'companyadmin'), __('Expense Requests', 'companyadmin'), 'companyadmin', 'Expense-Requests', array($this, 'expense_requests'));



            //add_submenu_page('Expense', 'Policy', 'Upload/View Policy', 'companyadmin', 'Policy', 'Expense');Grades-Limits-Cat
           
            
           add_submenu_page('expensemenu', __('Mileage', 'companyadmin'), __('Mileage', 'companyadmin'), 'companyadmin', 'Mileage', array($this, 'Mileage'));
	    
	    add_submenu_page('expensemenu', __('Approval WorkFlow', 'companyadmin'), __('Approval WorkFlow', 'companyadmin'), 'companyadmin', 'Approval-Workflow', array($this, 'company_workflow'));
	    
	     add_menu_page('BudgetController', 'Budget Control', 'companyadmin', 'Budget', array($this, 'CostCenter'), 'dashicons-portfolio');
	     $overview = add_submenu_page('Budget', 'Center', 'Cost Center', 'companyadmin', 'Budget', array($this, 'CostCenter'));
            //add_submenu_page('Budget', 'Project', 'Project Code', 'companyadmin', 'Project', 'BudgetController');
            
            add_submenu_page('Budget', 'Category', 'Project Code', 'companyadmin', 'project-budget', array($this, 'ProjectBudget'));
            add_submenu_page('Budget', 'Project Code', 'Project Budget', 'companyadmin', 'Project', array($this, 'ProjectCode'));
            //add_submenu_page('Budget', 'Category', 'Category Budget', 'companyadmin', 'Category', array($this, 'CategoryBudget'));
	    
            add_menu_page('Finance Approvers', 'Finance Approvers', 'companyadmin', 'finance', array($this, 'finance_approvers'), 'dashicons-money');
            add_submenu_page('finance', 'action', 'Approver List', 'companyadmin', 'finance', array($this, 'finance_approvers'));
            //add_submenu_page('finance', 'action', 'View/Edit/Delete employee', 'companyadmin', 'finaceEmp', 'finance');
            add_submenu_page('finance', 'Limits', 'Set/Edit Limits', 'companyadmin', 'Limits', array($this, 'approver_limits'));
	    add_submenu_page('finance', 'Limits', 'View Requests', 'companyadmin', 'Accounts-Requests', array($this, 'view_all_accounts_request'));
            //add_submenu_page('finance', 'Limits', 'View Pending', 'companyadmin', 'Pending-Accounts-Requests', array($this, 'view_all_accounts_request'));

	    
            //add_menu_page('WorkFlow', 'WorkFlow', 'companyadmin', 'WorkFlow', array($this, 'company_workflow'), 'dashicons-networking');

            add_menu_page('View/Edit/Delete Travel Desk', 'Travel Desk', 'companyadmin', 'Travel', array($this, 'TravelDesk'), 'dashicons-location');
            $overview = add_submenu_page('Travel', 'Add TravelDesk', 'Create TravelDesk', 'companyadmin', 'Travel', array($this, 'TravelDesk'));
            add_submenu_page('Travel', 'Action', 'View Employee requests', 'companyadmin', 'TravelDeskRequests', array($this, 'TravelDeskRequests'));
            add_submenu_page('', 'Claims', 'Travel Desk Claims', 'companyadmin', 'Claims', array($this, 'TdInvoiceDisplay'));
            add_submenu_page('Travel', 'Invoice', 'View Invoices', 'companyadmin', 'Invoice', array($this, 'TravelDesk_Invoice'));
            // add_submenu_page('', 'DeskLogs', 'Travel Desk Logs', 'companyadmin', 'DeskLogs', array($this, 'TravelDesk_Logs'));
            add_submenu_page('Travel', 'ToleranceLimits', 'Tolerance Limits', 'companyadmin', 'Tolerance', array($this, 'TravelDesk_Tolerance'));
	    	    
            //add_menu_page('Requests', 'Expense Requests', 'companyadmin', 'Expense-Requests', array($this, 'expense_requests'), 'dashicons-money');
            add_submenu_page('', 'Pre Travel', 'View Pre Travel Requests', 'companyadmin', 'pretravel', array($this, 'PreDisplay'));
            add_submenu_page('', 'Post Travel', 'View Post Travel Requests', 'companyadmin', 'posttravel', array($this, 'PostDisplay'));
            add_submenu_page('', 'Mileage Travel', 'View Mileage Travel Requests', 'companyadmin', 'mileage', array($this, 'MileageDisplay'));
            add_submenu_page('', 'Other Travel', 'View Other Travel Requests', 'companyadmin', 'Others', array($this, 'OtherDisplay'));
            add_submenu_page('', 'Utility Travel', 'View Utility Travel Requests', 'companyadmin', 'utility', array($this, 'utilityDisplay'));
            add_submenu_page('', 'Traveldesk Travel', 'View Traveldesk Requests', 'companyadmin', 'Traveldesk', array($this, 'TraveldeskDsiplay'));
            add_submenu_page('', 'Traveldesk Travel', 'View PRE Traveldesk claims', 'companyadmin', 'Traveldeskclaims', array($this, 'TraveldeskPreclaims'));

            add_menu_page('ReportsGraphs', 'Analytics / Reports', 'companyadmin', 'Graphs', array($this, 'TravelGraphs'), 'dashicons-chart-bar');
            $overview = add_submenu_page('Graphs', 'Total Budget / Spend', 'Total Budget / Spend', 'companyadmin', 'Graphs', array($this, 'TravelGraphs'));
            //add_submenu_page('Graphs', 'Tracker', 'Total Budget / Spend', 'companyadmin', 'Total-Budget', array($this, 'TravelGraphs'));
            add_submenu_page('Graphs', 'Tracker', 'Category wise Spend', 'companyadmin', 'Category-Spend', array($this, 'EmployeeGraphs'));
            add_submenu_page('Graphs', 'Tracker', 'Department wise Spend', 'companyadmin', 'Department-Spend', array($this, 'TravelGraphs'));
            add_submenu_page('Graphs', 'Tracker', 'Costcenter Budget / Spend', 'companyadmin', 'CostCenter-Spend', array($this, 'EmployeeGraphs'));
            add_submenu_page('Graphs', 'Tracker', 'Project Budget / Spend', 'companyadmin', 'ProjectBudget-Spend', array($this, 'EmployeeGraphs'));
            //add_submenu_page('Graphs', 'EmployeeWise', 'Employee Wise', 'companyadmin', 'Employeewise', array($this, 'EmployeeGraphs'), 'ReportsGraphs');
            //add_submenu_page('Graphs', 'Tracker', 'Travel Spend Tracker related to Air / Car / Hotels / Bus', 'companyadmin', 'Tracker', array($this, 'TravelGraphs'));
        }
    }

    /**
     * Handles HR calendar script
     *
     * @return void
     */
    function hr_calendar_script() {
        wp_enqueue_script('erp-momentjs');
        wp_enqueue_script('erp-fullcalendar');
        wp_enqueue_style('erp-fullcalendar');
    }

    /**
     * Handles thecompany calling tablefunctions page
     *
     * @return void
     */
    public function dashboard_page() {
        include WPERP_CORPTNE_VIEWS . '/dashboard.php';
    }
    
    public function TravelDeskRequests(){
    	include WPERP_COMPANY_VIEWS . '/travel-requests.php';
    }
    
    public function view_all_accounts_request() {
        include WPERP_COMPANY_VIEWS  . '/view-account-requests.php';
    }

    public function Designations() {
        include WPERP_COMPANY_VIEWS . '/company/Designations.php';
    }

    public function DepartmentsList() {
        include WPERP_COMPANY_VIEWS . '/company/admindepartmentmanagerlisting.php';
    }

    public function Departments() {
        include WPERP_COMPANY_VIEWS . '/company/Department.php';
    }

    public function Grades() {
        include WPERP_COMPANY_VIEWS . '/company/Grades.php';
    }

    public function SubCatModes() {
        include WPERP_COMPANY_VIEWS . '/company/Sub-Cat-Modes.php';
    }

    public function ExpenseGrades() {
        include WPERP_COMPANY_VIEWS . '/company/ExpenseGrades.php';
    }

    public function TravelDesk() {
        include WPERP_COMPANY_VIEWS . '/company/traveldesk.php';
    }

    public function TravelDesk_Invoice() {
        include WPERP_COMPANY_VIEWS . '/company/TravelDesk-Invoice.php';
    }

    public function TravelDesk_Logs() {
        include WPERP_COMPANY_VIEWS . '/company/TravelDesk_Logs.php';
    }

    public function TravelDesk_Tolerance() {
        include WPERP_COMPANY_VIEWS . '/company/TravelDesk_Tolerance_Limits.php';
    }

    public function DefaultCategory() {
        include WPERP_COMPANY_VIEWS . '/company/expensedeafultcat.php';
    }

    public function Mileage() {
        include WPERP_COMPANY_VIEWS . '/company/Mileage.php';
    }

    public function ExpenseManagment() {
        include WPERP_COMPANY_VIEWS . '/company/ExpenseManagment.php';
    }

    public function ProjectCode() {
        include WPERP_COMPANY_VIEWS . '/company/ProjectCodeCreate.php';
    }
    
    public function ProjectBudget() {
        include WPERP_COMPANY_VIEWS . '/company/ProjectBudgetCreate.php';
    }
	
    public function CostCenter() {
        include WPERP_COMPANY_VIEWS . '/company/CostCenter.php';
    }

    public function CategoryBudget() {
        include WPERP_COMPANY_VIEWS . '/company/CategoryBudget.php';
    }
  
   

    public function ReportsGraphs() {
        include WPERP_COMPANY_VIEWS . '/reporting/Reportingraphs.php';
    }

    public function EmployeeGraphs() {
        include WPERP_COMPANY_VIEWS . '/reporting/Employeegraphs.php';
    }

    public function TravelGraphs() {
        include WPERP_COMPANY_VIEWS . '/reporting/TravelGraphs.php';
    }

    public function company_dashboard() {
        include WPERP_COMPANY_VIEWS . '/company/dashboard.php';
    }

    public function employeeprofile() {
        include WPERP_COMPANY_VIEWS . '/company/employeeprofile.php';
    }

    public function PreDisplay() {
        include WPERP_COMPANY_VIEWS . '/pre-travel-display.php';
    }

    public function gradelimitcat() {
        include WPERP_COMPANY_VIEWS . '/Grades-Limits-Cat.php';
    }

    public function PostDisplay() {
        include WPERP_COMPANY_VIEWS . '/post-travel-display.php';
    }

    public function UtilityDisplay() {
        include WPERP_COMPANY_VIEWS . '/utilirty-expense-details.php';
    }

    public function OtherDisplay() {
        include WPERP_COMPANY_VIEWS . '/other-expense-display.php';
    }

    public function MileageDisplay() {
        include WPERP_COMPANY_VIEWS . '/mileage-display.php';
    }

    public function TraveldeskDsiplay() {
        include WPERP_COMPANY_VIEWS . '/Traveldesk-Dsiplay.php';
    }

    public function TraveldeskPreclaims() {
        include WPERP_COMPANY_VIEWS . '/Pretravel-traveldesk-claims.php';
    }
    public function TdInvoiceDisplay() {
        include WPERP_COMPANY_VIEWS . '/travel-desk-claims.php';
    }

    public function EmployeeDisplay() {
        include WPERP_COMPANY_VIEWS . '/employee-display.php';
    }

    /**
     * Handles company admin page
     *
     * @return void
     */
    public function companiesadmin() {
        include WPERP_CORPTNE_VIEWS . '/companyadmin/view.php';
    }

    /**
     * Handles Requests page
     *
     * @return void
     */
    public function expense_requests() {
        include WPERP_COMPANY_VIEWS . '/expense_requests.php';
    }

    /**
     * Handles Approver Limits page
     *
     * @return void
     */
    public function approver_limits() {
        include WPERP_COMPANY_VIEWS . '/approver_limits.php';
    }

    /**
     * Handles the dashboard page
     *
     * @return void
     */
    public function employee_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'view':
                $employee = new Employee($id);
                if (!$employee->id) {
                    wp_die(__('Employee not found!', 'erp'));
                }

                $template = WPERP_HRM_VIEWS . '/employee/single.php';
                break;

            default:
                $template = WPERP_HRM_VIEWS . '/employee.php';
                break;
        }

        $template = apply_filters('erp_hr_employee_templates', $template, $action, $id);

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Handles the dashboard page
     *
     * @return void
     */
    public function companyview_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'view':
                $companyview = new Companyview($id);
                if (!$id) {
                    wp_die(__('Company not found!', 'erp'));
                }
                $template = WPERP_CORPTNE_VIEWS . '/company/companyview.php';
                break;

            default:
                $template = WPERP_CORPTNE_VIEWS . '/companyview.php';
                break;
        }

        $template = apply_filters('erp_hr_company_templates', $template, $action, $id);

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Employee my profile page template
     *
     * @since 0.1
     *
     * @return void
     */
    public function employee_my_profile_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? intval($_GET['id']) : intval(get_current_user_id());

        switch ($action) {
            case 'view':
                $employee = new Employee($id);
                if (!$employee->id) {
                    wp_die(__('Employee not found!', 'erp'));
                }

                $template = WPERP_HRM_VIEWS . '/employee/single.php';
                break;

            default:
                $template = WPERP_HRM_VIEWS . '/employee/single.php';
                break;
        }

        $template = apply_filters('erp_hr_employee_my_profile_templates', $template, $action, $id);

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Handles the dashboard page
     *
     * @return void
     */
    public function department_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'view':
                $template = WPERP_HRM_VIEWS . '/departments/single.php';
                break;

            default:
                $template = WPERP_HRM_VIEWS . '/departments.php';
                break;
        }

        $template = apply_filters('erp_hr_department_templates', $template, $action, $id);

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Render the designation page
     *
     * @return void
     */
    public function designation_page() {
        include WPERP_HRM_VIEWS . '/designation.php';
    }

    /**
     * Renders ERP HR Reporting Page
     *
     * @return void
     */
    public function reporting_page() {

        $action = isset($_GET['type']) ? $_GET['type'] : 'main';

        switch ($action) {
            case 'age-profile':
                $template = WPERP_HRM_VIEWS . '/reporting/age-profile.php';
                break;

            case 'gender-profile':
                $template = WPERP_HRM_VIEWS . '/reporting/gender-profile.php';
                break;

            case 'headcount':
                $template = WPERP_HRM_VIEWS . '/reporting/headcount.php';
                break;

            case 'salary-history':
                $template = WPERP_HRM_VIEWS . '/reporting/salary-history.php';
                break;

            case 'years-of-service':
                $template = WPERP_HRM_VIEWS . '/reporting/years-of-service.php';
                break;
            case 'years-of-service':
                $template = WPERP_HRM_VIEWS . '/reporting/Reportingraphs.php';
                break;

            default:
                $template = WPERP_HRM_VIEWS . '/reporting.php';
                break;
        }

        $template = apply_filters('erp_hr_reporting_pages', $template, $action);

        if (file_exists($template)) {

            include $template;
        }
    }

    /**
     * Handles the Employe list Page
     *
     * @return void
     */
    public function employee_list() {
        include WPERP_COMPANY_VIEWS . '/company/employee_list.php';
    }

    /**
     * Handles the Employe Log list Page
     *
     * @return void
     */
    public function employeelogs_list() {
        include WPERP_COMPANY_VIEWS . '/company/employeelogs_list.php';
    }

    /**
     * Handles the Employe Delegates list Page
     *
     * @return void
     */
    public function empdelegates_list() {
        include WPERP_COMPANY_VIEWS . '/company/empdelegates_list.php';
    }

    /**
     * Upload Employees Page
     *
     * @return void
     */
    public function upload_employees() {
        include WPERP_COMPANY_VIEWS . '/upload-employees.php';
    }

    /**
     * Export Employees Page
     *
     * @return void
     */
    public function export_employees() {
        include WPERP_COMPANY_VIEWS . '/export-employees.php';
    }

    /**
     * Finance Approvers Page
     *
     * @return void
     */
    public function finance_approvers() {
        include WPERP_COMPANY_VIEWS . '/finance-approver-listing.php';
    }

    /**
     * Handles the employeeview page
     *
     * @return void
     */
    public function employeeview_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        // $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        echo $id = isset($_POST['employee_id']);
        switch ($action) {
            case 'view':
                $employeeview = new Employeeview($id);
                /* if ( !$id ) {
                  wp_die( __( 'Employee not found!', 'erp' ) );
                  } */
                $template = WPERP_COMPANY_VIEWS . '/company/employeeview.php';
                break;

            default:
                $template = WPERP_COMPANY_VIEWS . '/employeeview.php';
                break;
        }

        $template = apply_filters('erp_hr_company_templates', $template, $action, $id);

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Workflow Page
     *
     * @return void
     */
    public function company_workflow() {
        include WPERP_COMPANY_VIEWS . '/workflow.php';
    }

}
