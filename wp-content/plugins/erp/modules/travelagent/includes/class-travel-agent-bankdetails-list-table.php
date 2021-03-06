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
class Travel_Agent_Bankdetails_List_Table extends \WP_List_Table
{
    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'travelagentbankdetail',
            'plural' => 'travelagentbankdetails',
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
            $item['TDBA_Id']
        );
    }
	 /**
     * how to render column with view,
     * @return HTML
     */
	function column_AccHoldersName($item)
    {
		$actions = array(
            'edit' => sprintf('<a href="?page=BankM" data-id=%s>%s</a>', $item['TDBA_Id'], __('Edit', 'travelagentbankdetail_table_list')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['TDBA_Id'], __('Delete', 'travelagentbankdetail_table_list')),
        );
		return sprintf('%s %s %s',
            '',
            '<strong>' . $item['TDBA_Fullname'] . '</strong>',$this->row_actions($actions)
        );
    }
	/**
     *  Booking Request column with Count,
     * @return HTML
     */
	function column_AccountNumber($item){
        
        $TDBA_AccountNumber = $item['TDBA_AccountNumber'];
		return $TDBA_AccountNumber;
    }
	
	function column_BankName($item){
        
        $TDBA_BankName = $item['TDBA_BankName'];
		return $TDBA_BankName;
    }
	
	function column_BranchName($item){
        
        $TDBA_BranchName = $item['TDBA_BranchName'];
		return $TDBA_BranchName;
    }
	
	function column_BankIFSCCode($item){
        
        $TDBA_BankIfscCode = $item['TDBA_BankIfscCode'];
		return $TDBA_BankIfscCode;
    }
	function column_AddedDate($item){
        
        $TDBA_Date = date('d-M-Y h:i:s a',strtotime($item['TDBA_Date']));
		return $TDBA_Date;
    }
    /**
     * [REQUIRED] This method return columns to display in table
     * @return array
     */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'AccHoldersName' => __('Acc Holders Name', 'travelagentbankdetail_table_list'),
            'AccountNumber' => __('Account Number', 'travelagentbankdetail_table_list'),
			'BankName' => __('Bank Name', 'travelagentbankdetail_table_list'),
			'BranchName' => __('Branch Name', 'travelagentbankdetail_table_list'),
			'BankIFSCCode' => __('Bank IFSC Code', 'travelagentbankdetail_table_list'),
			'AddedDate' => __('Added Date', 'travelagentbankdetail_table_list'),
			
        );
        return $columns;
    }

    /**
     * [OPTIONAL] Return array of bult actions if has any
     *
     * @return array
     */
    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
     * [OPTIONAL] This method processes bulk actions
     * it can be outside of class
     * it can not use wp_redirect coz there is output already
     * in this example we are processing delete action
     * message about successful deletion will be shown on page in next part
     */
    function process_bulk_action()
    {
        global $wpdb;
        //$table_name = $wpdb->prefix . 'user'; // do not forget about tables prefix
        //$table_name = "superadmin";
        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

        if (!empty($ids)) {
		$supid = $_SESSION['supid'];
		$row = $wpdb->get_results("SELECT * FROM travel_desk_bank_account WHERE SUP_Id = '$supid' AND TDBA_Id IN($ids) AND TDBA_Status = 1 AND TDBA_Type = 2 ORDER BY TDBA_Id DESC");
		if(empty($row)){
			$wpdb->query("");
		}else{
	$wpdb->query("UPDATE travel_desk_bank_account SET TDBA_Status=9, TDBA_DeletedDate=NOW() WHERE TDBA_Id IN($ids)");           
		}  
        }
        }
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
            'AccHoldersName' => __('Acc Holders Name',true),
            'AccountNumber' => __('Account Number',true),
			'BankName' => __('Bank Name',true),
			'BranchName' => __('Branch Name',true),
			'BankIFSCCode' => __('Bank IFSC Code',true),
			'AddedDate' => __('Added Date',true),
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
        $table_name = 'travel_desk_bank_account'; // do not forget about tables prefix

        $per_page = 5; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = count($wpdb->get_results("SELECT * FROM $table_name WHERE SUP_Id = $supid AND TDBA_Status = 1 AND TDBA_Type = 2"));

		//$total_items = count($total_items1);
        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $paged = $paged * $per_page;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'TDBA_Id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
		if(!empty($_POST["s"])) {
                $search = $_POST["s"];
			$query="";
			$searchcol= array(
			'TDBA_Fullname',
			'TDBA_BranchName',
			'TDBA_BankIfscCode',
			'TDBA_BankName',
			'TDBA_AccountNumber'
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
			$this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ".$query." AND SUP_Id = $supid AND TDBA_Status = 1 AND TDBA_Type = 2 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
		}
		else{
			$this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE SUP_Id = $supid AND TDBA_Status = 1 AND TDBA_Type = 2 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
		}
        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }
}