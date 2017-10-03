<?php

namespace WeDevs\ERP\Travelagentclient;

/**
 * PART 2. Defining Custom Table List
 * ============================================================================
 *
 * In this part you are going to define custom table list class,
 * that will display your database records in nice looking table
 *
 * http://codex.wordpress.org/Class_Reference/WP_List_Table
 * http://wordpress.org/extend/plugins/custom-list-table-example/
 */
//if (!class_exists('WP_List_Table')) {
//require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
//}

/**
 * Custom_Table_Example_List_Table class that will display our custom table
 * records in nice table
 */
class TravelDesk_Invoices extends \WP_List_Table {

    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct() {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'invoice',
            'plural' => 'invoices',
        ));
    }

    function extra_tablenav($which) {
        $compid = $_SESSION['compid'];
        global $wpdb;
        if ($which != 'top') {
            return;
        }
        $selected_status = ( isset($_GET['filter_status']) ) ? $_GET['filter_status'] : 0;
       
        }

        function column_paidamount($item) {
            if($item['TDC_PaidAmount']) 
            echo IND_money_format($item['TDC_PaidAmount']).'.00'; 
            else  
            echo '--';
        }

        function column_totalamount($item) {
            $servtax_servcharge_amount = $item['TDC_ServiceCharges'] * ($item['TDC_ServiceTax'] / 100) ; 
					  
			$amnt = $item['totalAmnt'] + $servtax_servcharge_amount;
				
					  
			$amnt += $item['TDC_ServiceCharges'];
            return IND_money_format($amnt) . ".00";
            
            
        }

        function column_quantity($item) {
            return ceil($item['totalQty']);
        }

        function column_invoiceref($item) {
            //$href = "";
            return "<a href= '/wp-admin/admin.php?page=ClaimView&tdcid=$item[TDC_Id]' >" . $item['TDC_ReferenceNo'] . "</a>";
            //return $item['TDC_ReferenceNo'];
        }

        function column_arrears($item) {
            if($item['TDC_Arrears']) 
            echo 
            IND_money_format($item['TDC_Arrears']).'.00'; 
            else  
            echo '--';
        }

        function no_items() {
            _e('No requests found.', 'erp');
        }
        
        function column_invoice_status($item){
            return  approvals($item['TDC_Status']);
        }
        
        function column_invoice_date($item){
            return date('d-M-y',strtotime($item['TDC_Date']));
        }

        function column_cb($item) {
            return sprintf(
                    '<input type="checkbox" name="id[]" value="%s" />', $item['TDC_Id']
            );
        }

        function column_request($item) {
            return $item['cntReqs']; 
        }

        function get_columns() {
            $columns = array(
                'cb' => '<inaut type="checkbox" />', //Render a checkbox instead of text
                'invoiceref' => __('Reference No.', 'inovice_table_list'),
                'request' => __('Requests', 'inovice_table_list'),
                'quantity' => __('Quantity', 'inovice_table_list'),
                'totalamount' => __('Total Amount (Rs)	', 'inovice_table_list'),
                'paidamount' => __('Paid Amount(Rs)', 'inovice_table_list'),
                'arrears' => __('Arrears(Rs)', 'inovice_table_list'),
                'invoice_status' => __('Invoice Status', 'inovice_table_list'),
                'invoice_date' => __('Invoice Date', 'inovice_table_list'),
            );
            return $columns;
        }

        /**
         * [OPTIONAL] This method return columns that may be used to sort table
         * all strings in array - is column names
         * notice that true on name column means that its default sort
         *
         * @return array
         */
        function get_sortable_columns() {
            $sortable_columns = array(
                'invoiceref' => array('invoicere', true),
                'request' => array('Estimated Cost', true),
//            'quantity' => array('Reporting Manager Approval', false),
//            'totalamount' => array('Finance Approval', false),
//            'status' => array('Request Date', false),
//            'request_date' => array('Status', false),
            );
            return $sortable_columns;
        }

        function prepare_items() {
            $compid = $_SESSION['compid'];
            global $wpdb;
            global $query;
           // $table_name = 'travel_desk_claims'; // do not forget about tables prefix

            $per_page = 5; // constant, how much records will be shown per page

            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();

            // here we configure table headers, defined in our methods
            $this->_column_headers = array($columns, $hidden, $sortable);

            // [OPTIONAL] process bulk action if any
            $this->process_bulk_action();
            
            if (isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']) {
                $selReqstatus = $_REQUEST['filter_status'];
                $query.=" AND TDC_Status=$selReqstatus";
            }

            // will be used in pagination settings
            $total_items = count($wpdb->get_results("SELECT * FROM travel_desk_claims WHERE COM_Id='$compid'"));

            // prepare query params, as usual current page, order by and order direction
            $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
            $paged = $paged * $per_page;
            $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'TDC_Id';
            $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

            // [REQUIRED] define $items array
            // notice that last argument is ARRAY_A, so we will retrieve array
            if (!empty($_POST["s"])) {
                $search = trim($_POST["s"]);
                $query = "";
                $searchcol = array(
                    'TDC_ReferenceNo'
                );
                $i = 0;
                foreach ($searchcol as $col) {
                    if ($i == 0) {
                        $sqlterm = 'WHERE';
                    } else {
                        $sqlterm = 'OR';
                    }
                    if (!empty($_REQUEST["s"])) {
                        $query .= ' ' . $sqlterm . ' ' . $col . ' LIKE "' . $search . '"';
                    }
                    $i++;
                }
                $this->items = $wpdb->get_results($wpdb->prepare("SELECT
						  tdc.TDC_Id,
						  TDC_ReferenceNo,
						  TDC_PaidAmount,
						  TDC_Arrears,
						  TDC_Status,
						  TDC_Date,
						  TDC_ServiceCharges,
						  TDC_ServiceTax,
						  COUNT(DISTINCT tdcr.TDCR_Id) AS cntReqs,
						  SUM(tdcr.TDCR_Quantity) * COUNT(DISTINCT tdcr.TDCR_Id) / COUNT(*) AS totalQty,
						  SUM(tdcr.TDCR_Amount) * COUNT(DISTINCT tdcr.TDCR_Id) / COUNT(*) AS totalAmnt
						FROM
						  travel_desk_claims tdc
						INNER JOIN
						  travel_desk_claim_requests tdcr USING(TDC_Id)
						$query AND
						  COM_Id = '$compid' 
						GROUP BY
						  tdcr.TDC_Id AND  COM_Id='$compid' ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
            } else {
                $this->items = $wpdb->get_results($wpdb->prepare("SELECT
						  tdc.TDC_Id,
						  TDC_ReferenceNo,
						  TDC_PaidAmount,
						  TDC_Arrears,
						  TDC_Status,
						  TDC_Date,
						  TDC_ServiceCharges,
						  TDC_ServiceTax,
						  COUNT(DISTINCT tdcr.TDCR_Id) AS cntReqs,
						  SUM(tdcr.TDCR_Quantity) * COUNT(DISTINCT tdcr.TDCR_Id) / COUNT(*) AS totalQty,
						  SUM(tdcr.TDCR_Amount) * COUNT(DISTINCT tdcr.TDCR_Id) / COUNT(*) AS totalAmnt
						FROM
						  travel_desk_claims tdc
						INNER JOIN
						  travel_desk_claim_requests tdcr USING(TDC_Id)
						WHERE
						  COM_Id = '$compid'
						GROUP BY
						  tdcr.TDC_Id" . $query . " ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
            }
            // [REQUIRED] configure pagination
            $this->set_pagination_args(array(
                'total_items' => $total_items, // total items defined above
                'per_page' => $per_page, // per page constant defined at top of method
                'total_pages' => ceil($total_items / $per_page) // calculate pages count
            ));
        }

    }

    /**
     * Simple function that validates data and retrieve bool on success
     * and error message(s) on error
     *
     * @param $item
     * @return bool|string
     */
    function custom_table_example_validate_person($item) {
        $messages = array();

        if (empty($item['name']))
            $messages[] = __('Name is required', 'custom_table_example');
        if (!empty($item['email']) && !is_email($item['email']))
            $messages[] = __('E-Mail is in wrong format', 'custom_table_example');
        if (!ctype_digit($item['age']))
            $messages[] = __('Age in wrong format', 'custom_table_example');

        if (empty($messages))
            return true;
        return implode('<br />', $messages);
    }

    function custom_table_example_languages() {
        load_plugin_textdomain('custom_table_example', false, dirname(plugin_basename(__FILE__)));
    }

    add_action('init', 'custom_table_example_languages');
    