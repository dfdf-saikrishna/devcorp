<?php

namespace WeDevs\ERP\Company;

//define( 'WP_DEBUG', true );
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
class TravelDesk_List_Table extends \WP_List_Table {

    private $page_status;
    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct() {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'traveldesk',
            'plural' => 'traveldesk',
        ));
    }

    function column_units($item) {
        $units = $item['TD_Username'];
        return $units;
    }
    function column_email($item) {
        $units = $item['TD_Email'];
        return $units;
    }
    function column_Added_Date($item) {
        $date = date('d/M/Y h:i a', strtotime($item['TD_Addeddate']));
        return $date;
    }

    function column_name($item) {
        $actions = array(
            'edit' => sprintf('<a href="?page=Mileage" data-id=%s">%s</a>', $item['TD_Id'], __('Edit', 'traveldesk_table_list')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['TD_Id'], __('Delete', 'traveldesk_table_list')),
        );
            return sprintf('%s %s', $item['TD_Username'], $this->row_actions($actions)
        );
    }
    function column_cb($item) {
        return sprintf(
                '<input type="checkbox" name="id[]" value="%s" />', $item['TD_Id']
        );
    }

    function no_items() {
        _e('No requests found.', 'erp');
    }

    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'name' => __('User Name', 'traveldesk_table_list'),
            'email' => __('User Email', 'traveldesk_table_list'),
            //'amount' => __('Amount (Rs)', 'traveldesk_table_list'),
            //'status' => __('Status', 'traveldesk_table_list'),
            'Added_Date' => __('Added On', 'traveldesk_table_list'),
            //'Closed_Date' => __('Closed Date', 'traveldesk_table_list'),
        );
        return $columns;
        //return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
                'name' => array('User Name', true),
                //'Company Logo' => array('company_logo', false),
                // 'num' => array('Sl.No', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        global $wpdb;
        //$table_name = $wpdb->prefix . 'user'; // do not forget about tables prefix
        $table_name = "travel_desk";
        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids))
                $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE TD_Id IN($ids)");
            }
        }
    }

    /**
     * [REQUIRED] This is the most important method
     *
     * It will get rows from database and prepare them to be showed in table
     */
    function prepare_items() {
        global $wpdb;
        //$table_name = 'mileage'; // do not forget about tables prefix
        $compid = $_SESSION['compid'];
        $per_page = 5; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();
        
        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $paged = $paged * $per_page;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'TD_Username';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';
       
        $total_items = count($wpdb->get_results("SELECT * FROM travel_desk WHERE COM_Id='$compid' AND TD_Status=1"));
        //print_r($total_items);die;
       $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM travel_desk WHERE COM_Id='$compid' AND TD_Status=1 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
      //print_r($test);die;
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

/**
 * Do not forget about translating your plugin, use __('english string', 'your_uniq_plugin_name') to retrieve translated string
 * and _e('english string', 'your_uniq_plugin_name') to echo it
 * in this example plugin your_uniq_plugin_name == custom_table_example
 *
 * to create translation file, use poedit FileNew catalog...
 * Fill name of project, add "." to path (ENSURE that it was added - must be in list)
 * and on last tab add "__" and "_e"
 *
 * Name your file like this: [my_plugin]-[ru_RU].po
 *
 * http://codex.wordpress.org/Writing_a_Plugin#Internationalizing_Your_Plugin
 * http://codex.wordpress.org/I18n_for_WordPress_Developers
 */
function custom_table_example_languages() {
    load_plugin_textdomain('custom_table_example', false, dirname(plugin_basename(__FILE__)));
}

add_action('init', 'custom_table_example_languages');
