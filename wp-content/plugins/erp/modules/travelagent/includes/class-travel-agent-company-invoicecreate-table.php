<?php
namespace WeDevs\ERP\Travelagent;


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
class Travel_Agent_Company_Invoicecreate_Table extends \WP_List_Table {
/**
* [REQUIRED] You must declare constructor and give some basic params
*/
function __construct() {
global $row;
global $supid;
global $status, $page;

parent::__construct(array(
'singular' => 'companyinvoicecreate',
'plural' => 'companyinvoicecreates',
));
}

	/**
     * [REQUIRED] this is how checkbox column renders
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['COM_Id']
        );
    }
	 /**
     * how to render column with view,
     * @return HTML
     */
	function column_clientname($item)
    {
		return sprintf('%s %s %s',
            '',
            '<a href="'.erp_company_url_invoice_create( $item['COM_Id']).'"><strong>' . $item['COM_Name'] . '</strong></a>',$this->row_actions($actions)
        );
    }
	/**
     *  Booking Request column with Count,
     * @return HTML
     */
	function column_Action($item){
        return '<a href="'.erp_company_url_invoice_create( $item['COM_Id']).'" id="create_invoice" class="add-new-h2">Create Invoice</a><a href="'.erp_company_url_invoice_view( $item['COM_Id']).'" id="invoice_view" class="add-new-h2">View Invoice</a>';
    }
	
    /**
     * [REQUIRED] This method return columns to display in table
     * @return array
     */
    function get_columns()
    {
        $columns = array(
            //'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'clientname' => __('Client Name', 'travelagentclient_table_list'),
            'Action' => __('Action', 'travelagentclient_table_list'),
			//'cancelreq' => __('New <br> Cancellation Requets', 'travelagentclient_table_list'),
			//'totbookingreq' => __('Total<br>Booking Requests', 'travelagentclient_table_list'),
			//'totcancelreq' => __('Total<br>Cancellation Requests', 'travelagentclient_table_list'),
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
    function get_sortable_columns()
    {
        $sortable_columns = array(
            'clientname' => __('Client Name',true),
            'Action' => __('Action',false),
			//'cancelreq' => __('New <br> Cancellation Requets',false),
			//'totbookingreq' => __('Total<br>Booking Requests',false),
			//'totcancelreq' => __('Total<br>Cancellation Requests',false),
        );
        return $sortable_columns;
    }

    /**
     * [REQUIRED] This is the most important method
     *
     * It will get rows from database and prepare them to be showed in table
     */
    function prepare_items()
    {
        global $wpdb;
		$supid = $_SESSION['supid'];
        $table_name = 'company'; // do not forget about tables prefix

        $per_page = 5; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = count($wpdb->get_results("SELECT * FROM $table_name WHERE SUP_Id='$supid' AND COM_Status=0"));
       // $total_items=count($total1_items);
        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $paged = $paged * $per_page;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'COM_Id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
		if(!empty($_POST["s"])) {
                $search = $_POST["s"];
			$query="";
			$searchcol= array(
			'COM_Name',
			);
			$i =0;
			foreach( $searchcol as $col) {
				if($i==0) {
					$sqlterm = 'WHERE';
				} else {
					$sqlterm = 'OR';
				}
				if(!empty($_REQUEST["s"])) {$query .=  ' '.$sqlterm.' '.$col.' LIKE "'.$search.'"';}
				$i++;
			}
			$this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ".$query." AND SUP_Id='$supid' AND COM_Status=0 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
		}
		else{
			$this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE SUP_Id='$supid' AND COM_Status=0 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
		}
        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }

}




