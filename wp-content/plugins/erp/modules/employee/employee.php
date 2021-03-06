<?php
namespace WeDevs\ERP\Employee;

use WeDevs\ERP\Framework\Traits\Hooker;

/**
 * The HRM Class
 *
 * This is loaded in `init` action hook
 */
class Employee {

    use Hooker;

    private $plugin;

    /**
     * Kick-in the class
     *
     * @param \WeDevs_ERP $plugin
     */
    public function __construct( \WeDevs_ERP $plugin ) {
        $this->plugin = $plugin;

        // Define constants
        $this->define_constants();

        // Include required files
        $this->includes();

        // Initialize the classes
        $this->init_classes();

        // Initialize the action hooks
        $this->init_actions();

        // Initialize the filter hooks
        $this->init_filters();

        do_action( 'erp_hrm_loaded' );
    }

    /**
     * Define the plugin constants
     *
     * @return void
     */
    private function define_constants() {
        define( 'WPERP_EMPLOYEE_FILE', __FILE__ );
        define( 'WPERP_EMPLOYEE_PATH', dirname( __FILE__ ) );
        define( 'WPERP_EMPLOYEE_VIEWS', dirname( __FILE__ ) . '/views' );
        define( 'WPERP_EMPLOYEE_JS_TMPL', WPERP_EMPLOYEE_VIEWS . '/js-templates' );
        define( 'WPERP_EMPLOYEE_ASSETS', plugins_url( '/assets', __FILE__ ) );
    }

    /**
     * Include the required files
     *
     * @return void
     */
    private function includes() {
        require_once WPERP_EMPLOYEE_PATH . '/includes/actions-filters.php';
        require_once WPERP_EMPLOYEE_PATH . '/includes/layout-functions.php';
        require_once WPERP_EMPLOYEE_PATH . '/includes/functions-common.php';
        require_once WPERP_EMPLOYEE_PATH . '/includes/functions-employee-requests.php';
        require_once WPERP_EMPLOYEE_PATH . '/includes/functions-get-quote.php';
        require_once WPERP_EMPLOYEE_PATH . '/includes/functions-rest-api.php';
    }

    /**
     * Initialize WordPress action hooks
     *
     * @return void
     */
    private function init_actions() {
        $this->action( 'admin_enqueue_scripts', 'admin_scripts' );
        $this->action( 'admin_footer', 'admin_js_templates' );
    }

    /**
     * Initialize WordPress filter hooks
     *
     * @return void
     */
    private function init_filters() {
        add_filter( 'erp_settings_pages', array( $this, 'add_settings_page' ) );
    }

    /**
     * Init classes
     *
     * @return void
     */
    private function init_classes() {
        new Ajax_Handler();
        new Form_Handler();
        new Announcement();
        new Admin\Admin_Menu();
        //new Admin\User_Profile();
        //new Hr_Log();
        new Emailer();
    }

    /**
     * Register HR settings page
     *
     * @param array
     */
    public function add_settings_page( $settings = [] ) {

        $settings[] = include __DIR__ . '/includes/class-settings.php';

        return $settings;
    }

    /**
     * Load admin scripts and styles
     *
     * @param  string
     *
     * @return void
     */
    public function admin_scripts( $hook ) {
        // var_dump( $hook );

        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '';

        wp_enqueue_media();
        wp_enqueue_script( 'erp-tiptip' );

        if ( 'hr-management_page_erp-hr-employee' == $hook ) {
            wp_enqueue_style( 'erp-sweetalert' );
            wp_enqueue_script( 'erp-sweetalert' );
        }

        wp_enqueue_script( 'wp-crp-emp', WPERP_EMPLOYEE_ASSETS . "/js/employee$suffix.js", array( 'erp-script' ), date( 'Ymd' ), true );
        wp_enqueue_script( 'wp-crp-time', "//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js", array( 'erp-script' ), date( 'Ymd' ), true );
        wp_enqueue_script( 'wp-erp-hr-leave', WPERP_EMPLOYEE_ASSETS . "/js/leave$suffix.js", array(
            'erp-script',
            'wp-color-picker'
        ), date( 'Ymd' ), true );

        $localize_script = apply_filters( 'erp_hr_localize_script', array(
            'nonce'              => wp_create_nonce( 'wp-erp-hr-nonce' ),
            'popup'              => array(
                'dept_title'         => __( 'New Department', 'erp' ),
                'dept_submit'        => __( 'Create Department', 'erp' ),
                'location_title'     => __( 'New Location', 'erp' ),
                'location_submit'    => __( 'Create Location', 'erp' ),
                'dept_update'        => __( 'Update Department', 'erp' ),
                'Recharge'           => __( 'Mobile Recharge', 'erp' ),
                'DataCard'           => __( 'DataCard Recharge', 'erp' ),
                'desig_title'        => __( 'New Designation', 'erp' ),
                'desig_submit'       => __( 'Create Designation', 'erp' ),
                'desig_update'       => __( 'Update Designation', 'erp' ),
                'employee_title'     => __( 'New Employee', 'erp' ),
                'company_title'     => __( 'New Company', 'corptne' ),
                'employee_create'    => __( 'Create Company', 'erp' ),
                'employee_update'    => __( 'Update Company', 'erp' ),
                'employment_status'  => __( 'Employment Status', 'erp' ),
                'update_status'      => __( 'Update', 'erp' ),
                'policy'             => __( 'Leave Policy', 'erp' ),
                'policy_create'      => __( 'Create Policy', 'erp' ),
                'holiday'            => __( 'Holiday', 'erp' ),
                'holiday_create'     => __( 'Create Holiday', 'erp' ),
                'holiday_update'     => __( 'Update Holiday', 'erp' ),
                'new_leave_req'      => __( 'Leave Request', 'erp' ),
                'take_leave'         => __( 'Send Leve Request', 'erp' ),
                'terminate'          => __( 'Terminate', 'erp' ),
                'leave_reject'       => __( 'Reject Reason', 'erp' ),
                'already_terminate'  => __( 'Sorry, this employee is already terminated', 'erp' ),
                'already_active'     => __( 'Sorry, this employee is already active', 'erp' )
            ),
            'emp_upload_photo'       => __( 'Upload Employee Photo', 'erp' ),
            'emp_set_photo'          => __( 'Set Photo', 'erp' ),
            'confirm'                => __( 'Are you sure?', 'erp' ),
            'delConfirmDept'         => __( 'Are you sure to delete this department?', 'erp' ),
            'delConfirmPolicy'       => __( 'Are you sure to delete this policy?', 'erp' ),
            'delConfirmHoliday'      => __( 'Are you sure to delete this Holiday?', 'erp' ),
            'delConfirmEmployee'     => __( 'Are you sure to delete this employee?', 'erp' ),
            'restoreConfirmEmployee' => __( 'Are you sure to restore this employee?', 'erp' ),
            'delConfirmEmployeeNote' => __( 'Are you sure to delete this employee note?', 'erp' ),
            'delConfirmEntitlement'  => __( 'Are you sure to delete this Entitlement? If yes, then all leave request under this entitlement also permanently deleted', 'erp' ),
            'make_employee_text'     => __( 'This user already exists, Do you want to make this user as a employee?', 'erp' ),
            'employee_exit'          => __( 'This employee already exists', 'erp' ),
            'employee_created'       => __( 'Employee successfully created', 'erp' ),
            'create_employee_text'   => __( 'Click to create employee', 'erp' ),
            'empty_entitlement_text' => sprintf( '<span>%s <a href="%s" title="%s">%s</a></span>', __( 'Please create entitlement first', 'erp' ), add_query_arg( [ 'page' => 'erp-leave-assign', 'tab' => 'assignment' ], admin_url( 'admin.php' ) ), __( 'Create Entitlement', 'erp' ), __( 'Create Entitlement', 'erp' ) ),
        ) );

        // if its an employee page
        /* if ( 'toplevel_page_companiesmenu' == $hook ) {
            wp_enqueue_script( 'post' );

            $employee                          = new Employee();
            $localize_script['employee_empty'] = $employee->to_array();
        } */
        wp_localize_script( 'wp-crp-emp', 'wpErpHr', $localize_script );
        wp_localize_script( 'wp-crp-time', 'wpErpHr', $localize_script );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'erp-select2' );
        wp_enqueue_style( 'erp-tiptip' );
        wp_enqueue_style( 'erp-style' );
        
        //Request Page Css
        
        if ( 'admin_page_Pre-travel' == $hook ) {
            /*wp_enqueue_style( 'erp-req-bootstrap' );
            wp_enqueue_style( 'erp-req-font-icon-picker' );
            wp_enqueue_style( 'erp-req-icomoon' );
            wp_enqueue_style( 'erp-req-style-one' );
            wp_enqueue_style( 'erp-req-custom-one' );
            wp_enqueue_style( 'erp-req-custom-two' );
            wp_enqueue_style( 'erp-req-custom-responsive' );
            wp_enqueue_style( 'erp-req-timepicker' );*/
        }

        if ( 'hr-management_page_erp-hr-reporting' == $hook ) {
            wp_enqueue_script( 'erp-flotchart' );
            wp_enqueue_script( 'erp-flotchart-time' );
            wp_enqueue_script( 'erp-flotchart-pie' );
            wp_enqueue_script( 'erp-flotchart-orerbars' );
            wp_enqueue_script( 'erp-flotchart-axislables' );
            wp_enqueue_script( 'erp-flotchart-valuelabel' );
            wp_enqueue_style( 'erp-flotchart-valuelabel-css' );
        }
    }

    /**
     * Print JS templates in footer
     *
     * @return void
     */
    public function admin_js_templates() {
        global $current_screen;

        //var_dump( $current_screen->base );
        switch ($current_screen->base) {
        
            case 'travel-expense_page_Pre-travel':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/getQuoteBus.php', 'getquote-bus' );
                break;
            
            case 'companies_page_companies-admin':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/companyadmin-create.php', 'companyadmin-create' );
                break;
            
            case 'toplevel_page_companiesmenu':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-employee.php', 'erp-new-employee' );
                break;
			case 'companies_page_mastercompaniesview':
				erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-employee.php', 'erp-new-employee' );
                break;
            
            case 'toplevel_page_superadmin-dashboard':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-employee.php', 'erp-new-employee' );
                break;
				
            case 'toplevel_page_erp-hr':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-leave-request.php', 'erp-new-leave-req' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/leave-days.php', 'erp-leave-days' );
                break;

            case 'hr-management_page_erp-hr-depts':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-dept.php', 'erp-new-dept' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/row-dept.php', 'erp-dept-row' );
                break;
            
            case 'admin_page_Pre-travel':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
            
            case 'toplevel_page_employee':
            	erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote-booking.php', 'bus-booking-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-booking.php', 'flight-booking-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote-booking.php', 'hotel-booking-quote' );
                break;
            
            case 'admin_page_Post-travel-edit':
            	erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
            case 'admin_page_Pre-travel-edit':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
                
            case 'admin_page_View-Post-Request':
            	erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote-booking.php', 'bus-booking-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-booking.php', 'flight-booking-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote-booking.php', 'hotel-booking-quote' );
                break;
                
            case 'admin_page_View-Appr-Request':
            	erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote-booking.php', 'bus-booking-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-booking.php', 'flight-booking-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote-booking.php', 'hotel-booking-quote' );
                break;
             
            case 'request-with-approval_page_Request-With-Approval':
             	erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
                
             case 'admin_page_create-utility':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/recharge.php', 'erp-recharge' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/data-card.php', 'erp-datacard' );
                break;
                
             case 'admin_page_Edit-Appr-Request':
             	erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;

            case 'hr-management_page_erp-hr-designation':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-designation.php', 'erp-new-desig' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/row-desig.php', 'erp-desig-row' );
                break;

            case 'hr-management_page_erp-hr-employee':
            case 'hr-management_page_erp-hr-my-profile':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-employee.php', 'erp-new-employee' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/row-employee.php', 'erp-employee-row' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/employment-status.php', 'erp-employment-status' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/compensation.php', 'erp-employment-compensation' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/job-info.php', 'erp-employment-jobinfo' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/work-experience.php', 'erp-employment-work-experience' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/education-form.php', 'erp-employment-education' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/performance-reviews.php', 'erp-employment-performance-reviews' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/performance-comments.php', 'erp-employment-performance-comments' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/performance-goals.php', 'erp-employment-performance-goals' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/dependents.php', 'erp-employment-dependent' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-dept.php', 'erp-new-dept' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/new-designation.php', 'erp-new-desig' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/employee-terminate.php', 'erp-employment-terminate' );
                break;

            case 'leave_page_erp-leave-policies':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/leave-policy.php', 'erp-leave-policy' );
                break;

            case 'leave_page_erp-holiday-assign':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/holiday.php', 'erp-hr-holiday-js-tmp' );
                break;

            case 'toplevel_page_erp-leave':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/leave-reject.php', 'erp-hr-leave-reject-js-tmp' );
                break;
            default:
                # code...
                break;
        }

    }
}

