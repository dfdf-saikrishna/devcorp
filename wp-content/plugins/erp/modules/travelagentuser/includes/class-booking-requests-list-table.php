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
class Booking_Requests_List_Table extends \WP_List_Table
{
    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'travelagentclient',
            'plural' => 'travelagentclients',
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
	function column_request_code($item)
    {
        $href="/wp-admin/admin.php?page=request-details&reqid=".$item['REQ_Id'];
						
		
        switch($item['REQ_Active']){
						
			case 1:	
				$reqcode = $item['REQ_Code'];								
			break;
			
			case 9:
				$reqcode = '<i title="Removed Request">'.$item['REQ_Code'].'</i>';
			break;

		}
		return '<a href="'.$href.'">' . $reqcode . '</a>';
    }
	/**
     *  Booking Request column with Count,
     * @return HTML
     */
	function column_total_cost($item){
        global $wpdb;
        $totalcost = $wpdb->get_row("SELECT SUM(RD_Cost) AS total FROM request_details WHERE REQ_Id=$item[REQ_Id] AND RD_Status='1'");
        return $this->IND_money_format($totalcost->total) . ".00";
    }
    
    function IND_money_format($money) {
            $len = strlen($money);
            $m = '';
            $money = strrev($money);
            for ($i = 0; $i < $len; $i++) {
                if (( $i == 3 || ($i > 3 && ($i - 1) % 2 == 0) ) && $i != $len) {
                    $m .=',';
                }
                $m .=$money[$i];
            }
            return strrev($m);
        }
	
	function column_req_date($item){
	    return date('d-M-Y',strtotime($item['REQ_Date']));
    }
	
	function column_action_button($item){
	            return "<a href='/wp-admin/admin.php?page=request-Edit&reqid=$item[REQ_Id]'><button type='button' value='".$item[REQ_Id]."' class='button button-default' name='deleteRowbutton' id='editRowbutton' title='Edit'><i class='dashicons dashicons-edit'></i></button></a><a href='/wp-admin/admin.php?page=Edit-Appr-Request&reqid=$item[REQ_Id]'><button type='button' value='".$item[REQ_Id]."' class='button button-default' name='deleteRowbutton' id='editRowbutton' title='Edit'><i class='dashicons dashicons-trash'></i></button></a>";
    }
	
	function column_totcancelreq($item){
        global $wpdb;
        return sprintf('%s %s %s',
            '',
            '<a href="'.erp_travelagent_requestview( $item['COM_Id'],4).'"><strong>' . getCountRequests(4, $item['COM_Id']) . '</strong></a>',''
        );
    }
    /**
     * [REQUIRED] This method return columns to display in table
     * @return array
     */
    function get_columns()
    {
        $columns = array(
            //'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'request_code' => __('Request Code', 'travelagentclient_table_list'),
            'total_cost' => __('Total Cost', 'travelagentclient_table_list'),
			'req_date' => __('Request Date', 'travelagentclient_table_list'),
			'action_button' => __('Action', 'travelagentclient_table_list'),
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
            'request_code' => __('Request Code',true),
			'total_cost' => __('Total Cost',true),
			'req_date' => __('Request Date',true),
			'action_button' => __('Action',false),
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
		$compid = $_SESSION['compid'];
        $table_name = 'requests'; // do not forget about tables prefix

        $per_page = 5; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = count($wpdb->get_results("SELECT * FROM requests WHERE COM_Id='$compid' AND REQ_Type = 2"));
       // $total_items=count($total1_items);
        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged'])) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'REQ_Id';
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
			$this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ".$query." AND COM_Id='$compid' AND REQ_Type = 2 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
		}
		else{
			$this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE COM_Id='$compid' AND REQ_Type = 2 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
		}
        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }
}