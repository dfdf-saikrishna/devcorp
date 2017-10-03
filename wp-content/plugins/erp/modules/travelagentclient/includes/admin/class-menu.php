<?php
namespace WeDevs\ERP\travelagentclient\Admin;
use WeDevs\ERP\travelagentclient\Invoiceview;
use WeDevs\ERP\travelagentclient\Riseinvoiceview;
use WeDevs\ERP\travelagentclient\clientview;
use WeDevs\ERP\travelagentclient\requestview;
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
	if ( current_user_can( 'travelagentclient' ) ) {
    add_menu_page('agent Dashboard', 'Dashboard', 'travelagentclient', 'dashboard', array( $this, 'dashboard_page'),'dashicons-dashboard');  
		  
    add_menu_page('User', 'Booking Request', 'travelagentclient','booking-requests', array( $this,'booking_requests'),'dashicons-admin-users');
        //$overview = add_submenu_page( 'UserM', 'Overview', 'Overview', 'travelagentclient', 'UserM', array( $this,'travel_agent_user_listing'));
		add_submenu_page('booking-requests', 'Add', 'Add Request', 'travelagentclient', 'Add', array( $this,'add_booking_request'));
		add_submenu_page('', 'Details', 'Request Details', 'travelagentclient', 'request-details', array( $this,'booking_request_details'));
		add_submenu_page('', 'Edit', 'Request Edit', 'travelagentclient', 'request-Edit', array( $this,'booking_request_Edit'));
        //add_submenu_page('UserM', 'UserActions', 'View /Edit/Delete user', 'travelagentclient', 'UserActions', 'UserManagement');
        
   add_menu_page('Client', 'Group Request', 'travelagentclient','group-requests', array( $this, 'group_requests'),'dashicons-admin-users');
		//$overview = add_submenu_page( 'ClientM', 'Overview', 'Overview', 'travelagentclient', 'ClientM', array( $this,'travel_agent_client_listing'));
		add_submenu_page('group-requests', 'group-request', 'Add Request', 'travelagentclient', 'group-request', array( $this,'add_group_request'));
		add_submenu_page('', 'group-request-details', 'Group Request Details', 'travelagentclient', 'group-request-details', array( $this,'group_request_details'));
		add_submenu_page('', 'group-request-edit', 'Group Request Edit', 'travelagentclient', 'group-request-edit', array( $this,'group_request_edit'));
		//add_submenu_page('', 'ClientMActions', 'View /Edit Client', 'travelagentclient', 'Clientview', array($this, 'clientview_page'));
        //add_submenu_page('ClientM', 'ClientAlloc', 'Client Allocations', 'travelagentclient', 'ClientAllocations',array( $this,'travel_agent_client_allocation'));
        //add_submenu_page('', 'request', 'requestview', 'travelagentclient', 'requestview', array($this, 'requestview_page'));
        
    add_menu_page('InvoiceM', 'Invoice', 'travelagentclient','InvoiceM', array( $this,'view_invoices'),'dashicons-id-alt');
		$overview = add_submenu_page( 'InvoiceM', 'Overview', 'Overview', 'travelagentclient', 'InvoiceM', array( $this,'view_invoices'));
		add_submenu_page('InvoiceM', 'Create', 'Bank Details', 'travelagentclient', 'bank-details', array( $this,'view_bank_details'));
        add_submenu_page('', 'ViewInv', 'View Invoice ', 'travelagentclient', 'ViewInvoice', array( $this,'view_invoice'));
        add_submenu_page('', 'RiseInv', 'RiseInvoice', 'travelagentclient', 'RiseInvoice',  array( $this, 'riseinvoiceview_page' ));
        add_submenu_page('', 'RiseInv', 'ClaimView', 'travelagentclient', 'ClaimView',  array( $this, 'claims_view' ));
       
    //add_menu_page('BankM', 'Bank Management', 'travelagentclient','BankM', array( $this,'travel_agent_bank_details'),'dashicons-money');
		//$overview = add_submenu_page( 'BankM', 'Overview', 'Overview', 'travelagentclient', 'BankM', array( $this,'travel_agent_bank_details'));
		//add_submenu_page('BankM', 'BankActions', 'View /Edit Bank Details', 'travelagentclient', 'BankActions', 'BankrManagement');
    
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
			
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travelagentclientriseinvoice-create.php';
                break;
            default:
            $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclientriseinvoice-create.php';
                break;
        }

        $template = apply_filters( 'erp_travelagentclient_templates', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }
    
    public function claims_view(){
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagent_claim_view.php';
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
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/dashboard.php';
    }
    
    public function view_bank_details() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/traveldesk_bank_details.php';
    }
    
    public function view_invoices(){
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/view-invoices.php';
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
    
    public function group_requests(){
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/group_requests.php';
    }
    
    public function group_request_details(){
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/group_request_details.php';
    }
    
    public function group_request_edit(){
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/group_request_edit.php';
    }
    
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function travel_agent_client_listing() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travel-agent-client-listing.php';
    }
	
	/**
     * Handles the travelagentclient clientallocation page
     *
     * @return void
     */
    public function travel_agent_client_allocation() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travel-agent-client-allocation.php';
    }
    
	/**
     * Handles the travelagentclient user listing list Page
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
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travel_agent_companyinvoice_details.php';
    }
	
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function company_invoicecreate() {
		
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travel_agent_companyinvoice_create.php';
    }
	/**
     * Handles the dashboard page
     *
     * @return void
     */
    public function InvoiceManagement() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/invoicemanagement.php';
    }
	/**
     * Handles the bank details page
     *
     * @return void
     */
    public function travel_agent_bank_details() {
        include WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travel_agent_bank_details.php';
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
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/invoiceview.php';
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
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/clientview.php';
                break;

            default:
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/clientview.php';
                break;
        }

        $template = apply_filters( 'erp_travelagentclient_templates', $template, $action, $id );

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
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/travelagentclient/travel-agent-request-listing.php';
                break;

            default:
                $template = WPERP_TRAVELAGENT_CLIENT_VIEWS . '/requestview.php';
                break;
        }

        $template = apply_filters( 'erp_travelagentclient_templates', $template, $action, $comid,$selFilter );

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
