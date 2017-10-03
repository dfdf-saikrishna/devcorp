<?php
namespace WeDevs\ERP\travelagentuser\Admin;
use WeDevs\ERP\travelagentuser\Invoiceview;
use WeDevs\ERP\travelagentuser\Riseinvoiceview;
use WeDevs\ERP\travelagentuser\clientview;
use WeDevs\ERP\travelagentuser\requestview;
/**
 * Admin Menu
 */
class Admin_Menu {

    /**
     * Kick-in the class
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * Add menu items
     *
     * @return void
     */
    public function admin_menu() {
        
        /* *********************************
        * Super Admin Dashboard
        *  **********************************/
	if ( current_user_can( 'travelagentuser' ) ) {
    add_menu_page('agent Dashboard', 'Dashboard', 'travelagentuser', 'dashboard', array( $this, 'dashboard_page'),'dashicons-dashboard');  
    
		  add_submenu_page('', 'travelagent-user-dashboard', 'Booking Requests', 'travelagentuser', 'requestview', array( $this,'travelagent_booking_requests'));
		  add_submenu_page('', 'travelagent-user-dashboard', 'RequestDetails', 'travelagentuser', 'RequestDetails', array($this, 'travel_agent_request_details'));
		  add_submenu_page('', 'travelagent-user-dashboard', 'GroupRequestDetails', 'travelagentuser', 'GroupRequestDetails', array($this, 'travel_agent_group_request_details'));
    //add_menu_page('Client', 'Client', 'travelagentuser','Client', array( $this,'booking_requests'),'dashicons-admin-users');
        //$overview = add_submenu_page( 'UserM', 'Overview', 'Overview', 'travelagentuser', 'UserM', array( $this,'travel_agent_user_listing'));
		//add_submenu_page('booking-requests', 'Add', 'Add Request', 'travelagentuser', 'Add', array( $this,'add_booking_request'));
		//add_submenu_page('', 'Details', 'Request Details', 'travelagentuser', 'request-details', array( $this,'booking_request_details'));
		//add_submenu_page('', 'Edit', 'Request Edit', 'travelagentuser', 'request-Edit', array( $this,'booking_request_Edit'));
        //add_submenu_page('UserM', 'UserActions', 'View /Edit/Delete user', 'travelagentuser', 'UserActions', 'UserManagement');
        
   //add_menu_page('Client', 'Group Request', 'travelagentuser','group-request', array( $this, 'travel_agent_client_listing'),'dashicons-admin-users');
		//$overview = add_submenu_page( 'ClientM', 'Overview', 'Overview', 'travelagentuser', 'ClientM', array( $this,'travel_agent_client_listing'));
		//add_submenu_page('group-request', 'group-request', 'Group Request', 'travelagentuser', 'group-request', array( $this,'add_group_request'));
		//add_submenu_page('', 'ClientMActions', 'View /Edit Client', 'travelagentuser', 'Clientview', array($this, 'clientview_page'));
        //add_submenu_page('ClientM', 'ClientAlloc', 'Client Allocations', 'travelagentuser', 'ClientAllocations',array( $this,'travel_agent_client_allocation'));
        //add_submenu_page('', 'request', 'requestview', 'travelagentuser', 'requestview', array($this, 'requestview_page'));
        
   // add_menu_page('InvoiceM', 'Invoice', 'travelagentuser','InvoiceM', array( $this,'company_invoicemanagement'),'dashicons-id-alt');
		//$overview = add_submenu_page( 'InvoiceM', 'Overview', 'Overview', 'travelagentuser', 'InvoiceM', array( $this,'company_invoicemanagement'));
	//	add_submenu_page('InvoiceM', 'Create', 'Create Invoice', 'travelagentuser', 'createinvoice', array( $this,'company_invoicecreate'));
        //add_submenu_page('', 'ViewInv', 'View Invoice ', 'travelagentuser', 'ViewInvoice', array( $this,'view_invoice'));
        //add_submenu_page('', 'RiseInv', 'RiseInvoice', 'travelagentuser', 'RiseInvoice',  array( $this, 'riseinvoiceview_page' ));
       
    //add_menu_page('BankM', 'Bank Management', 'travelagentuser','BankM', array( $this,'travel_agent_bank_details'),'dashicons-money');
		//$overview = add_submenu_page( 'BankM', 'Overview', 'Overview', 'travelagentuser', 'BankM', array( $this,'travel_agent_bank_details'));
		//add_submenu_page('BankM', 'BankActions', 'View /Edit Bank Details', 'travelagentuser', 'BankActions', 'BankrManagement');
    
	   }

    }

	
		/**
     * Handles the employeeview page
     *
     * @return void
     */
    public function riseinvoiceview_page() {
       $action = isset( $_GET['action'] ) ? $_GET['action'] : 'view';
	   $id     = $_GET['id'];
		 switch ($action) {
            case 'view':
                $riseinvoiceview = new Riseinvoiceview($id);
                 if ( !$id ) {
                    wp_die( __( 'not found!', 'erp' ) );
                }
			
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travelagentuserriseinvoice-create.php';
                break;
            default:
            $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuserriseinvoice-create.php';
                break;
        }

        $template = apply_filters( 'erp_travelagentuser_templates', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }
    /**
     * Handles HR calendar script
     *
     * @return void
     */
    function hr_calendar_script() {
        wp_enqueue_script( 'erp-momentjs' );
        wp_enqueue_script( 'erp-fullcalendar' );
        wp_enqueue_style( 'erp-fullcalendar' );
    }

    /**
     * Handles the dashboard page
     *
     * @return void
     */
    public function dashboard_page() {
        include WPERP_TRAVELAGENT_USER_VIEWS . '/dashboard.php';
    }
    
    public function add_booking_request() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/add-booking-request.php';
    }
    
    public function add_group_request(){
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/add-group-request.php';
    }
    
    public function booking_request_details() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/booking-request-details.php';
    }
    
    public function booking_request_edit() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/booking-request-edit.php';
    }
    
    public function travelagent_booking_requests(){
        include WPERP_TRAVELAGENT_USER_VIEWS . '/travelagent-user-requests.php';
    }
    
    public function travel_agent_request_details(){
        include WPERP_TRAVELAGENT_USER_VIEWS . '/travel-agent-request-details.php';
    }
    
    public function travel_agent_group_request_details(){
        include WPERP_TRAVELAGENT_USER_VIEWS . '/travel-agent-group-request-details.php';
    }
    
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function travel_agent_client_listing() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travel-agent-client-listing.php';
    }
	
	/**
     * Handles the travelagentuser clientallocation page
     *
     * @return void
     */
    public function travel_agent_client_allocation() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travel-agent-client-allocation.php';
    }
    
	/**
     * Handles the travelagentuser user listing list Page
     *
     * @return void
     */
    public function booking_requests() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/booking_requests.php';
    }
	
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function company_invoicemanagement() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travel_agent_companyinvoice_details.php';
    }
	
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function company_invoicecreate() {
		
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travel_agent_companyinvoice_create.php';
    }
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function InvoiceManagement() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/invoicemanagement.php';
    }
	/**
     * Handles the bank details page
     *
     * @return void
     */
    public function travel_agent_bank_details() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travel_agent_bank_details.php';
    }
	
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function view_invoice() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'view';
        $id     = isset( $_GET['tdcid'] ) ? intval( $_GET['tdcid'] ) : 0;
		
        switch ($action) {
            case 'view':
                $invoiceview = new Invoiceview( $id );
                if ( !$id ) {
                    wp_die( __( 'Invoice id not found!', 'erp' ) );
                }  
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/invoiceview.php';
                break;

            default:
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/invoiceview.php';
                break;
        }

        $template = apply_filters( 'erp_hr_company_templates', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

	/**
     * Handles the clientview page
     *
     * @return void
     */
    public function clientview_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'view';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
		
        switch ($action) {
            case 'view':
                $clientview = new clientview( $id );
                if ( !$id ) {
                    wp_die( __( 'Client not found!', 'erp' ) );
                }  
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/clientview.php';
                break;

            default:
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/clientview.php';
                break;
        }

        $template = apply_filters( 'erp_travelagentuser_templates', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }
	
	/**
     * Handles the clientview page
     *
     * @return void
     */
    public function requestview_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'view';
        $comid     = $_GET['id'];
		$selFilter     = $_GET['selFilter'];
		
        switch ($action) {
            case 'view':
                $requestview = new requestview( $comid,$selFilter );
                if ( !$comid ) {
                    wp_die( __( 'Client not found!', 'erp' ) );
                }  
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentuser/travel-agent-request-listing.php';
                break;

            default:
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/requestview.php';
                break;
        }

        $template = apply_filters( 'erp_travelagentuser_templates', $template, $action, $comid,$selFilter );

        if ( file_exists( $template ) ) {
            include $template;
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
