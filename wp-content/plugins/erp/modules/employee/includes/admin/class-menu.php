<?php

namespace WeDevs\ERP\Employee\Admin;

use WeDevs\ERP\Employee\Companyview;

/**
 * Admin Menu
 */
class Admin_Menu {

    /**
     * Kick-in the class
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'));
//       register_nav_menus(
//        array(
//            'employee_Dashboard' => __( 'Employee Dashboard' ), 
//    	'account_Dashboard' => __( 'Finance Dashboard' )
//                )
//        );
    }

//function register_my_menus() {
//  register_nav_menus(
//    array(  
//    	'employee_Dashboard' => __( 'Employee Dashboard'), 
//    	'account_Dashboard' => __( 'Expanded Footer' )
//    )
//  );
//} 
//add_action( 'init', 'register_my_menus' );
    /**
     * Add menu items
     *
     * @return void
     */
    public function admin_menu() {

        /*         * ********************************
         * 
         * Employee Menus
         * 
         *  ********************************* */
        if (current_user_can('employee')) {

            add_menu_page(__('Dashboard', 'employee'), __('Dashboard', 'employee'), 'employee', 'dashboard', array($this, 'employee_Dashboard'), WPERP_iCONS . 'dashboard.svg');
            add_submenu_page('', 'Upload', 'View Request', 'employee', 'View-Request', array($this, 'view_request'));
            add_submenu_page('', 'Upload', 'View Traveldesk Request', 'employee', 'View-traveldesk-Request', array($this, 'view_traveldesk_request'));
            add_submenu_page('', 'Upload', 'View Post Request', 'employee', 'View-Post-Request', array($this, 'view_post_request'));
            add_submenu_page('', 'Upload', 'View Emp Requests', 'employee', 'View-Emp-Requests', array($this, 'view_emp_request'));
            add_submenu_page('', 'Upload', 'View Payment Requests', 'employee', 'View-payment-Requests', array($this, 'view_payment_request'));
            add_submenu_page('', 'Upload', 'View claim Requests', 'employee', 'View-claim-Requests', array($this, 'view_claim_request'));
            add_submenu_page('', 'Upload', 'View My Requests', 'employee', 'View-My-Requests', array($this, 'view_my_request'));

            if (current_user_can('finance')) {

                add_menu_page(__('Finance Dashboard', 'finance'), __('Finance Dashboard', 'finance'), 'finance', 'financemenu', array($this, 'account_Dashboard'), WPERP_iCONS . 'finance.svg');
                add_submenu_page('', 'Finance', 'travel desk', 'finance', 'traveldeskdetails', array($this, 'Traveldetails'));
                //add_submenu_page('financemenu', 'Finance', 'testingclaims', 'finance', 'pretravelclaims', array($this, 'pretravelclaims'));
                $overview = add_submenu_page('financemenu', 'Finance', 'Overview', 'finance', 'financemenu', array($this, 'account_Dashboard'), 'financemenu_init');
                add_submenu_page('financemenu', 'Upload', ' All Expense Requests', 'finance', 'View-All-Accounts-Requests', array($this, 'view_all_accounts_request'));
                add_submenu_page('', 'Upload', ' All Claim Requests', 'finance', 'view-account-claim-requests', array($this, 'view_account_claim_requests'));
                add_submenu_page('', 'view', 'All Pre Requests', 'finance', 'Pretravel view', array($this, 'accountspretravel'));
                add_submenu_page('', 'view', 'View Claims', 'finance', 'Claimview', array($this, 'pretravelviewclaims'));
                add_submenu_page('', 'view', 'All post Requests', 'finance', 'Posttravel', array($this, 'accountsposttravel'));
                add_submenu_page('', 'view', 'All mileage Requests', 'finance', 'Mileage', array($this, 'accountsmileagetravel'));
                add_submenu_page('', 'view', 'All other Requests', 'finance', 'others', array($this, 'accountsothertravel'));
                add_submenu_page('', 'view', 'All utility Requests', 'finance', 'utility', array($this, 'accountsutilitytravel'));

                //add_menu_page('', 'Finance Dashboard', 'finance', 'finance-dashboard', 'financeDashboard','dashicons-admin-users');
                add_submenu_page('', 'pre', 'Travel Expense Requests', 'finance', 'travel', array($this, 'Travel_Requests'), 'dashicons-money');
                add_submenu_page('', 'Upload', 'View Accounts Request', 'employee', 'View-Accounts-Request', array($this, 'view_accounts_request'));
                add_submenu_page('', 'Upload', 'View Post Accounts Request', 'employee', 'View-Post-Accounts-Request', array($this, 'view_post_accounts_request'));
                add_submenu_page('', 'Upload', 'View Mileage Accounts Request', 'employee', 'View-Mileage-Accounts-Request', array($this, 'view_mileage_accounts_request'));
                add_submenu_page('', 'Upload', 'View Utility Accounts Request', 'finance', 'View-Utility-Accounts-Request', array($this, 'view_utility_accounts_request'));
                add_submenu_page('', 'Upload', 'View Others Accounts Request', 'finance', 'View-Others-Accounts-Request', array($this, 'view_others_accounts_request'));
               
                add_submenu_page('financemenu', 'finance-requests', ' All Finance Requests', 'finance', 'View-Expense-Requests', array($this, 'All_Expense_Request'));
//
                //add_menu_page('', 'Expense', 'finance', 'FinanceExpense', array($this, 'All_Expense_Request'), WPERP_iCONS . 'expenses.svg');
                //$overview = add_submenu_page('', 'All Expense Requests', 'Overview', 'finance', 'FinanceExpense', array($this, 'All_Expense_Request'), 'FinanceExpense_init');
                add_submenu_page('financemenu', 'Claims', 'Travel Desk Claims', 'finance', 'TravelClaims', array($this, 'TravelDeskClaims'));
                add_submenu_page('', 'Claims', 'view', 'finance', 'TravelClaimsView', array($this, 'TdInvoiceDisplay'));


                //add_submenu_page('FinanceExpense', 'view', 'View Travel & General &Utility Expense', 'finance', 'view', array($this,'Travel_Request'));
                //add_submenu_page('FinanceExpense', 'General', 'View General Expense', 'finance', 'General', array($this,'General_Request'));
                //add_submenu_page('FinanceExpense', 'utility', 'View Utility Expense', 'finance', 'Utility', array($this,'Utility_Request'));
            }
            //add_menu_page('Employee Profile', 'Employee Profile', 'employee', 'employee-profile', 'employement_details','dashicons-admin-users');

            add_menu_page('Travel Expense', '  Travel Expense ', 'employee', 'TravelExpense', array($this, 'requests_overview'), WPERP_iCONS . 'travel.svg');
            //add_submenu_page('TravelExpense', 'Expense Request', ' Pre Travel', 'employee', 'TravelExpense&tab=My_Pre_Travel_Expenses', array($this, 'pre_travel_request'));
            add_submenu_page('Travel Expense', 'seatlayout', 'seatlayout', 'employee', 'seatlayout', array($this, 'seatlayout'));
            add_submenu_page('Travel Expense', 'generateForm', 'generateForm', 'employee', 'generateForm', array($this, 'generateForm'));
            add_submenu_page('Travel Expense', 'generateFlightForm', 'generateFlightForm', 'employee', 'generateFlightForm', array($this, 'generateFlightForm'));
            add_submenu_page('', 'Expense Request', ' Pre Travel Edit', 'employee', 'Pre-travel-edit', array($this, 'pre_travel_request_edit'));
            add_submenu_page('', 'Expense Request', ' Post Travel Edit', 'employee', 'Post-travel-edit', array($this, 'post_travel_request_edit'));
            //add_submenu_page('TravelExpense', 'Post Travel', 'Post Travel', 'employee', 'TravelExpense&tab=My_Post_Travel_Expenses', array($this, 'post_travel_request'));
             add_submenu_page('', 'Expense Request', '', 'employee', 'Pre-travel', array($this, 'pre_travel_request'));
              add_submenu_page('', 'Expense Request', '', 'employee', 'Post-travel', array($this, 'post_travel_request'));

            add_submenu_page('', 'Expense Request', '', 'employee', 'flight-payment', array($this, 'flight_payment'));
            add_submenu_page('', 'Expense Request', '', 'employee', 'bus-payment', array($this, 'bus_payment'));
            add_submenu_page('', 'Expense Request', '', 'employee', 'success-flight', array($this, 'success_flight'));
            add_submenu_page('', 'Expense Request', '', 'employee', 'success-bus', array($this, 'success_bus'));   
            add_submenu_page('', 'Expense Request', '', 'employee', 'failure-flight', array($this, 'failure_flight'));

            add_menu_page('General Expense', 'General Expense', 'employee', 'GeneralExpense', array($this, 'general_exp_list'), WPERP_iCONS . 'expenses.svg');
            //$overview = add_submenu_page('GeneralExpense', 'General Expense', 'General Expense', 'employee', 'GeneralExpense', array($this, 'general_expense'));
            //add_submenu_page('GeneralExpense', ' Mileage ', 'Mileage Request', 'employee', 'GeneralExpense&tab=Mileage_Requests_List', array($this, 'Mileage_Request'));
            //add_submenu_page('GeneralExpense', 'Utilities', 'Utility Request', 'employee', 'GeneralExpense&tab=Utility_Requests_List', array($this, 'Utility_Request'));
            //add_submenu_page('GeneralExpense', 'others', 'Others Request', 'employee', 'GeneralExpense&tab=Other_Requests_List', array($this, 'Others_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'mileage-utility', array($this, 'general_expense'));
			add_submenu_page('', 'others', 'Others Request', 'employee', 'general-expense-list', array($this, 'general_exp_list'));
			add_submenu_page('', 'others', 'Others Request', 'employee', 'create-mileage', array($this, 'create_mileage_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'create-utility', array($this, 'create_utility_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'create-others', array($this, 'create_others_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'view-mileage', array($this, 'view_mileage_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'view-utility', array($this, 'view_utility_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'view-others', array($this, 'view_others_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'edit-mileage', array($this, 'edit_mileage_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'edit-utility', array($this, 'edit_utility_Request'));
            add_submenu_page('', 'others', 'Others Request', 'employee', 'edit-others', array($this, 'edit_others_Request'));
             add_submenu_page('', 'claimsview', 'View Claim', 'employee', 'View Claim', array($this, 'view_claim'));
           
                add_submenu_page('', 'claimssubmit', 'Submit Claim', 'employee', 'Submit Claim', array($this, 'submit_claim'));
            if (!current_user_can('finance')) {
                add_menu_page(__('Delegate', 'employee'), __('Delegeate', 'employee'), 'employee', 'delegate', array($this, 'delegates_view'), 'dashicons-star-filled');
                $overview = add_submenu_page('delegate', 'View/Modify Delegate', 'View/Modify Delegate', 'employee', 'delegate', array($this, 'delegates_view'));
                add_submenu_page('delegate', 'Create Delegate', 'Create Delegate', 'employee', 'create-delegate', array($this, 'create_delegate'));
                add_submenu_page('', 'Edit Delegate', 'Edit Delegate', 'employee', 'edit-delegate', array($this, 'edit_delegate'));
            }
            add_menu_page('Reports', 'Reports', 'employee', 'Reports', array($this, 'Reports'), WPERP_iCONS . 'reports.svg');
        }
    }
    
    
    public function success_flight(){
    	include WPERP_EMPLOYEE_VIEWS . '/success-flight.php';
    }
    
    public function success_bus(){
    	include WPERP_EMPLOYEE_VIEWS . '/success-bus.php';
    }
    
    public function failure_flight(){
    	include WPERP_EMPLOYEE_VIEWS . '/failure-flight.php';
    }
    
    public function flight_payment(){
    	include WPERP_EMPLOYEE_VIEWS . '/flight-payment.php';
    }
    
    public function bus_payment(){
    	include WPERP_EMPLOYEE_VIEWS . '/bus-payment.php';
    }
    
    public function seatlayout(){
         include WPERP_EMPLOYEE_VIEWS . '/seat-layout.php';
    }
    
    public function generateForm(){
         include WPERP_EMPLOYEE_VIEWS . '/generateForm.php';
    }
  
     public function generateFlightForm(){
         include WPERP_EMPLOYEE_VIEWS . '/generateFlightForm.php';
    }

    public function pretravelviewclaims() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-employee-pretravelrequest-view-claim.php';
    }

    public function accountspretravel() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-employee-pre-travel-request-details.php';
    }

    public function accountsposttravel() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-employee-post-travel-request-details.php';
    }

    public function accountsmileagetravel() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-employee-mileage-expense-details.php';
    }

    public function accountsothertravel() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-employee-other-expense-details.php';
    }

    public function accountsutilitytravel() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-employee-utility-expense-details.php';
    }

    public function TdInvoiceDisplay() {
        include WPERP_EMPLOYEE_VIEWS . '/travel-desk-claims.php';
    }

    function pretravelclaims() {
        include WPERP_EMPLOYEE_VIEWS . '/ pretravel-account-claims.php';
    }

    function create_delegate() {
        include WPERP_EMPLOYEE_VIEWS . '/create_delegate.php';
    }

    function edit_delegate() {
        include WPERP_EMPLOYEE_VIEWS . '/edit_delegate.php';
    }

    function delegates_view() {
        include WPERP_EMPLOYEE_VIEWS . '/delegates_view.php';
    }

    function edit_mileage_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/edit_mileage_Request.php';
    }

    function edit_utility_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/edit_utility_Request.php';
    }

    function edit_others_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/edit_others_Request.php';
    }

    function view_mileage_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/view_mileage_Request.php';
    }

    function view_utility_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/view_utility_Request.php';
    }

    function view_others_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/view_others_Request.php';
    }

    function general_expense() {
        include WPERP_EMPLOYEE_VIEWS . '/general_expeses.php';
    }

    function All_Expense_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/All_Expense_Request.php';
    }

    function Others_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/Others_Request.php';
    }

    function create_mileage_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/Create_Mileage_Request.php';
    }
    function general_exp_list() {
        include WPERP_EMPLOYEE_VIEWS . '/general_expense_list.php';
    }
    
    function Reports() {
        include WPERP_EMPLOYEE_VIEWS . '/reports.php';
    }

    function create_utility_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/Create_Utility_Request.php';
    }

    function create_others_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/Create_Others_Request.php';
    }

    function Utility_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/Utility-Request.php';
    }

    function Mileage_Request() {
        include WPERP_EMPLOYEE_VIEWS . '/Mileage_Request.php';
    }

    function pre_travel_request() {
        include WPERP_EMPLOYEE_VIEWS . '/pre-travel-request.php';
    }

    function pre_travel_request_edit() {
        include WPERP_EMPLOYEE_VIEWS . '/pre-travel-request-edit.php';
    }

    function post_travel_request_edit() {
        include WPERP_EMPLOYEE_VIEWS . '/post-travel-request-edit.php';
    }

    public function post_travel_request() {
        include WPERP_EMPLOYEE_VIEWS . '/post-travel-request.php';
    }

    public function view_request() {
        include WPERP_EMPLOYEE_VIEWS . '/pre-travel-request-details.php';
    }
    
    public function view_traveldesk_request() {
        include WPERP_EMPLOYEE_VIEWS . '/traveldesk-request-details.php';
    }

    public function view_post_request() {
        include WPERP_EMPLOYEE_VIEWS . '/post-travel-request-details.php';
    }

    public function requests_overview() {
        include WPERP_EMPLOYEE_VIEWS . '/view-all-request-details.php';
    }

    public function view_emp_request() {
        include WPERP_EMPLOYEE_VIEWS . '/emp-requests-listing.php';
    }
    
    public function view_payment_request() {
        include WPERP_EMPLOYEE_VIEWS . '/payment-requests-listing.php';
    }
    
    public function view_claim_request() {
        include WPERP_EMPLOYEE_VIEWS . '/claim-requests-listing.php';
    }

    public function view_my_request() {
        include WPERP_EMPLOYEE_VIEWS . '/my-requests-listing.php';
    }

    public function view_accounts_request() {
        include WPERP_EMPLOYEE_VIEWS . '/finance-requests-details.php';
    }

    public function view_post_accounts_request() {
        include WPERP_EMPLOYEE_VIEWS . '/finance-post-requests-details.php';
    }

    public function view_mileage_accounts_request() {
        include WPERP_EMPLOYEE_VIEWS . '/finance-mileage-requests-details.php';
    }

    public function view_utility_accounts_request() {
        include WPERP_EMPLOYEE_VIEWS . '/finance-utility-requests-details.php';
    }

    public function view_others_accounts_request() {
        include WPERP_EMPLOYEE_VIEWS . '/finance-others-requests-details.php';
    }

    public function view_claim() {
        include WPERP_EMPLOYEE_VIEWS . '/employee-pre-travel-request-view-claim.php';
    }

    public function submit_claim() {
        include WPERP_EMPLOYEE_VIEWS . '/employee-pre-travel-request-submit-claim.php';
    }

    public function view_all_accounts_request() {
        include WPERP_EMPLOYEE_VIEWS . '/view-account-requests.php';
    }
    
    public function view_account_claim_requests() {
        include WPERP_EMPLOYEE_VIEWS . '/view-account-claim-requests.php';
    }

    function employee_Dashboard() {
        include WPERP_EMPLOYEE_VIEWS . '/employee-dashboard.php';
    }

    function account_Dashboard() {
        include WPERP_EMPLOYEE_VIEWS . '/accounts-dashboard.php';
    }

    function Traveldetails() {
        include WPERP_EMPLOYEE_VIEWS . '/account-semployee-traveldesk-raised-details.php';
    }

    function TravelDeskClaims() {
        include WPERP_EMPLOYEE_VIEWS . '/traveldesk-claims.php';
    }

    function Travel_Requests() {
        include WPERP_EMPLOYEE_VIEWS . '/Travel_Requests.php';
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
     * Handles the dashboard page
     *
     * @return void
     */
    public function dashboard_page() {
        include WPERP_CORPTNE_VIEWS . '/dashboard.php';
    }

    /**
     * Handles the dashboard page
     *
     * @return void
     */
    public function companies_list() {
        include WPERP_CORPTNE_VIEWS . '/superadmin/companies_list.php';
    }

    public function workflow() {

        include WPERP_CORPTNE_VIEWS . '/superadmin/workflow.php';
    }

    /**
     * Handles the expense category list page
     *
     * @return void
     */
    public function expensecategory_list() {
        include WPERP_CORPTNE_VIEWS . '/superadmin/expensecategory_list.php';
    }

    /**
     * Handles the company expense category list page
     *
     * @return void
     */
    public function companyexpensecategory_list() {
        include WPERP_CORPTNE_VIEWS . '/superadmin/companyexpensecategory_list.php';
    }

    /**
     * Handles the companyDashboard page
     *
     * @return void
     */
    public function company_dashboard() {
        include WPERP_CORPTNE_VIEWS . '/company/dashboard.php';
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
     * Render the leave policy page
     *
     * @return void
     */
    public function leave_policy_page() {
        include WPERP_HRM_VIEWS . '/leave/leave-policies.php';
    }

    /**
     * Render the holiday page
     *
     * @return void
     */
    public function holiday_page() {
        include WPERP_HRM_VIEWS . '/leave/holiday.php';
    }

    /**
     * Render the leave entitlements page
     *
     * @return void
     */
    public function leave_entitilements() {
        include WPERP_HRM_VIEWS . '/leave/leave-entitlements.php';
    }

    /**
     * Render the leave entitlements calendar
     *
     * @return void
     */
    public function leave_calendar_page() {
        include WPERP_HRM_VIEWS . '/leave/calendar.php';
    }

    /**
     * Render the leave requests page
     *
     * @return void
     */
    public function leave_requests() {
        $view = isset($_GET['view']) ? $_GET['view'] : 'list';

        switch ($view) {
            case 'new':
                include WPERP_HRM_VIEWS . '/leave/new-request.php';
                break;

            default:
                include WPERP_HRM_VIEWS . '/leave/requests.php';
                break;
        }
    }

    /**
     * An empty page for testing purposes
     *
     * @return void
     */
    public function empty_page() {
        
    }

}