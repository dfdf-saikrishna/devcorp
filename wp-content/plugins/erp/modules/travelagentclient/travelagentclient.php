<?php
namespace WeDevs\ERP\Travelagentclient;

use WeDevs\ERP\Framework\Traits\Hooker;

/**
 * The HRM Class
 *
 * This is loaded in `init` action hook
 */
class Travelagentclient {

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
       // $this->init_filters();

        do_action( 'erp_hrm_loaded' );
    }

    /**
     * Define the plugin constants
     *
     * @return void
     */
    private function define_constants() {
        define( 'WPERP_TRAVELAGENT_CLIENT_FILE', __FILE__ );
        define( 'WPERP_TRAVELAGENT_CLIENT_PATH', dirname( __FILE__ ) );
        define( 'WPERP_TRAVELAGENT_CLIENT_VIEWS', dirname( __FILE__ ) . '/views' );
        define( 'WPERP_TRAVELAGENT_CLIENT_JS_TMPL', WPERP_TRAVELAGENT_CLIENT_VIEWS . '/js-templates' );
        define( 'WPERP_TRAVELAGENT_CLIENT_ASSETS', plugins_url( '/assets', __FILE__ ) );
    }

    /**
     * Include the required files
     *
     * @return void
     */
    private function includes() {

        //require_once WPERP_TRAVELAGENT_PATH . '/includes/functions-tadashboard.php';
        require_once WPERP_TRAVELAGENT_CLIENT_PATH . '/includes/actions-filters.php';
		require_once WPERP_TRAVELAGENT_CLIENT_PATH . '/includes/functions-travelagentc-common.php';
		require_once WPERP_EMPLOYEE_PATH . '/includes/functions-common.php';
		//require_once WPERP_TRAVELAGENT_PATH . '/includes/functions-travelagentclient.php';
		//require_once WPERP_TRAVELAGENT_PATH . '/includes/functions-travelagentbankdetails.php';
		//require_once WPERP_TRAVELAGENT_PATH . '/includes/functions-invoice.php';
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
     * Init classes
     *
     * @return void
     */
    private function init_classes() {
        new Ajax_Handler();
        new Form_Handler();
       // new Announcement();
        new Admin\Admin_Menu();
        //new Admin\User_Profile();
        //new Hr_Log();
        new Emailer();
    }

    
    /**
     * Load admin scripts and styles
     *
     * @param  string
     *
     * @return void
     */
    public function admin_scripts( $hook ) {
        //var_dump( $hook );

        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '';

        wp_enqueue_media();
        wp_enqueue_script( 'erp-tiptip' );

        if ( 'hr-management_page_erp-hr-employee' == $hook ) {
            wp_enqueue_style( 'erp-sweetalert' );
            wp_enqueue_script( 'erp-sweetalert' );
        }
        wp_enqueue_script( 'wp-erp-tac', WPERP_TRAVELAGENT_CLIENT_ASSETS . "/js/travelagentclient$suffix.js", array( 'erp-script' ), date( 'Ymd' ), true );
        wp_enqueue_script( 'wp-erp-hr-leave', WPERP_EMPLOYEE_ASSETS . "/js/leave$suffix.js", array(
         'erp-script',
            'wp-color-picker'
        ), date( 'Ymd' ), true );
        
        $localize_script = apply_filters( 'erp_hr_localize_script', array(
            'nonce'              => wp_create_nonce( 'wp-erp-ta-nonce' ),
            'popup'              => array(
            'travelagentuser_title'    => __( 'Create Travel Agent User', 'erp' ),
            'travelagentuser_update'    => __( 'Edit Travel Agent User', 'erp' ),
            'travelagentclient_title'    => __( 'Create Travel Agent Client', 'erp' ),   
            'travelagentclient_update'    => __( 'Edit Travel Agent Client', 'erp' ),
			'travelagentbankdetails_title'    => __( 'Create Travel Agent Bank Details', 'erp' ),
			'travelagentbankdetails_update'    => __( 'Edit Travel Agent Bank Details', 'erp' ),
			'travelagentclaims_create'=> __( 'Send Claims', 'erp' ),
            'update' => __( 'Update', 'erp' )
              ),
       ) );
        
        wp_localize_script( 'wp-erp-tac', 'wpErpTac', $localize_script );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'erp-select2' );
        wp_enqueue_style( 'erp-tiptip' );
        wp_enqueue_style( 'erp-style' );

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
            case 'toplevel_page_UserM':
                erp_get_js_template( WPERP_TRAVELAGENT_JS_TMPL . '/travelagentuser-create.php', 'travelagentuser-create' );
                break;
            case 'group-request_page_group-request':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
            case 'admin_page_request-Edit':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
            case 'booking-request_page_Add':
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/bus-quote.php', 'bus-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote.php', 'flight-get-quote' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/flight-quote-return.php', 'flight-get-quote-return' );
                erp_get_js_template( WPERP_EMPLOYEE_JS_TMPL . '/hotel-quote.php', 'hotel-get-quote' );
                break;
			case 'toplevel_page_ClientM':
                erp_get_js_template( WPERP_TRAVELAGENT_JS_TMPL . '/travelagentclient-create.php', 'travelagentclient-create' );
                break;
			case 'toplevel_page_BankM':
                erp_get_js_template( WPERP_TRAVELAGENT_JS_TMPL . '/travelagentbankdetails-create.php', 'travelagentbankdetails-create' );
                break;	
            default:
                # code...
                break;
        }

    }
}

