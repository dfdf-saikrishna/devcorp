<?php

namespace WeDevs\ERP\Employee;

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
class Travel_Requests_List extends \WP_List_Table {

    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct() {
        global $compid;
        global $status, $page;

        parent::__construct(array(
            'singular' => 'admin',
            'plural' => 'admins',
        ));
    }

    /**
     * Render extra filtering option in
     * top of the table
     *
     * @since 0.1
     *
     * @param  string $which
     *
     * @return void
     */
    function extra_tablenav($which) {
        $compid = $_SESSION['compid'];
        global $wpdb;
        if ($which != 'top') {
            return;
        }

        $selected_request = ( isset($_GET['filter_request']) ) ? $_GET['filter_request'] : 0;
        $selected_status = ( isset($_GET['filter_status']) ) ? $_GET['filter_status'] : 0;
        $emp = ( isset($_GET['filter_emp']) ) ? $_GET['filter_emp'] : '';
        ?>
        <div class="alignleft actions">

            <label class="screen-reader-text" for="new_role"><?php _e('Filter by Designation', 'erp') ?></label>
            <select name="filter_request" id="filter_request">
                <option value="">- All -</option>
                <?php
                $selsql = $wpdb->get_results("SELECT * From request_type");
                foreach ($selsql as $rowsql) {
                    ?>
                    <option value="<?php echo $rowsql->RT_Id; ?>" <?php if ($selected_request == $rowsql->RT_Id) echo 'selected="selected"'; ?> ><?php echo $rowsql->RT_Name; ?></option>
                <?php } ?>
            </select>

            <label class="screen-reader-text" for="new_role"><?php _e('Filter by Designation', 'erp') ?></label>
            <select name="filter_status" id="filter_status">
                <option value="">- All -</option>
                <option value="2" <?php if ($selected_status == 2) echo 'selected="selected"'; ?> >Approved</option>
                <option value="1" <?php if ($selected_status == 1) echo 'selected="selected"'; ?> >Pending</option>
                <option value="3" <?php if ($selected_status == 3) echo 'selected="selected"'; ?> >Rejected</option>
            </select>

            <label class="screen-reader-text" for="new_role"><?php _e('Filter by Designation', 'erp') ?></label>
            <select name="filter_emp" id="filter_emp">
                <option value="">- All -</option>
                <?php
                $selsql = $wpdb->get_results("SELECT EMP_Id, EMP_Code, EMP_Name From employees WHERE EMP_Status=1 AND COM_Id=$compid");
                foreach ($selsql as $rowemp) {
                    ?>
                    <option value="<?php echo $rowemp->EMP_Id; ?>" <?php if ($emp == $rowemp->EMP_Id) echo 'selected="selected"'; ?> ><?php echo $rowemp->EMP_Code . " - " . $rowemp->EMP_Name; ?></option>
                <?php } ?>
            </select>
            <?php
            submit_button(__('Search'), 'button', 'filter_employee', false);
            echo '</div>';
            //}
        }

        function column_default($item, $column_name) {
            
        }

        function column_request_code($item) {
            //return "request_code";die;
            global $type;
            global $href;
            switch ($item['RT_Id']) {
                case 1:
                    $href = "admin.php?page=View-Accounts-Request&reqid=" . $item['REQ_Id'];
                    break;

                case 2:
                    $href = "admin.php?page=View-Post-Accounts-Request&reqid=" . $item['REQ_Id'];
                    break;

                case 3:
                    $href = "admin.php?page=View-Others-Accounts-Request&reqid=" . $item['REQ_Id'];
                    break;

                case 5:
                    $href = "admin.php?page=View-Mileage-Accounts-Request&reqid=" . $item['REQ_Id'];
                    break;

                case 6:
                    $href = "admin.php?page=View-Utility-Accounts-Request&reqid=" . $item['REQ_Id'];
                    break;
            }
            switch ($item['REQ_Type']) {

                case 1:
                    $type = '<span style="font-size:10px;">[E]</span>';
                    $title = "Employee Request";
                    break;

                case 2:
                    $type = '<span style="font-size:10px;">[W/A]</span>';
                    $title = "Without Approval";
                    break;

                case 3:
                    $type = '<span style="font-size:10px;">[AR]</span>';
                    $title = "Approval Required";
                    break;

                case 4:
                    $type = '<span style="font-size:10px;">[G]</span>';
                    $title = "Group Request Without Approval";
                    break;


                case 5:
                    $type = '<span style="font-size:10px;">[F]</span>';
                    $title = "Finance Expense";
                    break;
            }

            return "<a href='$href?reqid=$item[REQ_Id]'>$item[REQ_Code]</a>&nbsp;$type";
        }

        function column_total_cost($item) {
            global $wpdb;
            global $totalcost;
            $cls = NULL;

            if ($item['REQ_PreToPostStatus']) {

                if ($item['REQ_Type'] == 4) {

                    $totalcost = $wpdb->get_row("SELECT SUM(RD_Cost) AS total  FROM request_details WHERE REQ_Id='$item[REQ_Id]'");

                    print_r($totalcost);
                    die;
                } else {

                    $totalcost = $wpdb->get_row("SELECT SUM(ptac.PTAC_Cost)  AS total  FROM requests req, pre_travel_claim ptc, pre_travel_actual_cost ptac WHERE req.REQ_Id=$item[REQ_Id] AND req.REQ_Id=ptc.REQ_Id AND ptc.PTC_Id=ptac.PTC_Id AND ptac.PTAC_Status=1");
                    $selptc = $wpdb->get_results("SELECT * FROM pre_travel_claim WHERE REQ_Id='$item[REQ_Id]'");
                    $status1 = $selptc['0']->PTC_RepMngrStatus;
                    $status = $selptc['0']->PTC_FinanceStatus;
                    // emp --> rep mangr --> finance
                    if (($status1 == 2) && ($status == 1))
                        $cls = 'class="boldfont"';
                }
            } else {

                switch ($item['POL_Id']) {
                    // emp --> rep mangr --> finance
                    case 1:
                        if ($sel_apprv_actn = $wpdb->get_row("SELECT REQ_Status FROM  request_status WHERE REQ_Id='$item[REQ_Id]' AND RS_EmpType=1 AND REQ_Status=2 AND RS_Status=1")) {
                            if (!$acc_apprv_actn = $wpdb->get_row("SELECT REQ_Status FROM request_status WHERE REQ_Id='$item[REQ_Id]' AND RS_EmpType=2 AND RS_Status=1"))
                                $cls = 'class="boldfont"';
                        }
                        break;

                    case 2:// emp --> finance --> rep mangr
                    case 4:// emp --> finance 

                        if (!$acc_apprv_actn = $wpdb->get_row("SELECT REQ_Status FROM request_status WHERE REQ_Id='$item[REQ_Id]' AND RS_EmpType=2 AND RS_Status=1"))
                            $cls = 'class="boldfont"';

                        break;
                }

                $totalcost = $wpdb->get_row("SELECT SUM(RD_Cost) AS total FROM request_details WHERE REQ_Id=$item[REQ_Id] AND RD_Status=1");
            }

            return IND_money_format($totalcost->total) . ".00";
        }

        function column_rep_manager_code($item) {
            global $wpdb;
            global $approvals;

            if ($item['REQ_Type'] == 2 || $item['REQ_Type'] == 4) {

                $approvals = approvals(5);
            } else {

                // reporting manager status

                if ($item['POL_Id'] != 4) {

                    if ($repmngrStatus = $wpdb->get_row("SELECT REQ_Status FROM request_status WHERE REQ_Id='$item[REQ_Id]' AND RS_Status=1 AND RS_EmpType=1")) {
                        $approvals = approvals($repmngrStatus->REQ_Status);
                    } else {
                        $approvals = approvals(1);
                    }
                } else {

                    $approvals = approvals(5);
                }
            }
            return $approvals;
        }

        function column_finance_approval($item) {
            global $wpdb;
            global $approvals;
            if ($item['REQ_Type'] == 2 || $item['REQ_Type'] == 4) {
                $approvals = approvals(5);
            } else {

                // reporting manager status

                if ($item['POL_Id'] != 3) {

                    if ($repmngrStatus = $wpdb->get_row("SELECT REQ_Status FROM request_status WHERE REQ_Id='$item[REQ_Id]' AND RS_Status=1 AND RS_EmpType=2")) {
                        $approvals = approvals($repmngrStatus->REQ_Status);
                    } else {
                        $approvals = approvals(1);
                    }
                } else {

                    $approvals = approvals(5);
                }
            }
            return $approvals;
        }

        function column_request_date($item) {
            return date('d-M-y', strtotime($item['REQ_Date']));
        }

        function column_claim_status($item) {
            global $wpdb;
            global $claimdata;
            $claimdata = '<span class="status-2" title="Claimed on: ' . date("d/M/y", strtotime($item["REQ_ClaimDate"])) . '">Claimed</span>';

            // if its group request only finance approval required for claim

            if ($item['REQ_Claim']) {

                echo $claimdata;
            } else {

                if ($item['REQ_Type'] == 4) {

                    if ($item['REQ_PreToPostStatus'])
                        return $this->tdclaimapprovals(1);
                    else
                        return $this->tdclaimapprovals(5);
                } else {


                    if ($item['REQ_PreToPostStatus']) {
                        if ($selptc = $wpdb->get_row("SELECT PTC_Status FROM pre_travel_claim WHERE REQ_Id='$item[REQ_Id]'"))
                            return $this->tdclaimapprovals($selptc->PTC_Status);
                    }else {

                        if ($item['REQ_Status'] == 2)
                            return $this->tdclaimapprovals(1);
                        else
                            return $this->tdclaimapprovals(5);
                    }
                }
            }
        }

        function tdclaimapprovals($string) {
            global $getapprov;
            switch ($string) {

                case 1:
                    $getapprov = '<span class="status-1">Pending</span>';
                    break;

                case 2:
                    $getapprov = '<span class="status-2">Approved</span>';
                    break;

                case 3:
                    $getapprov = '<span class="status-4">Rejected</span>';
                    break;

                case 4:
                    $getapprov = '<span class="status-3">&nbsp;&nbsp;&nbsp;N/A&nbsp;&nbsp;&nbsp;</span>';
                    break;
            }

            return $getapprov;
        }

        function approvals($string) {
            global $getapprov;
            switch ($string) {
                case 1:
                    $getapprov = '<span class="status-1">Pending</span>';
                    break;

                case 2:
                    $getapprov = '<span class="status-2">Settled</span>';
                    break;

                case 5:
                    $getapprov = '<span class="status-3">&nbsp;&nbsp;&nbsp;N/A&nbsp;&nbsp;&nbsp;</span>';
                    break;

                case 4:
                    $getapprov = '<span class="status-4">Rejected</span>';
                    break;

                case 9:
                    $getapprov = '<span class="status-4">Rejected</span>';
                    break;
            }

            return $getapprov;
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

        /**
         * [REQUIRED] This method return columns to display in table
         * you can skip columns that you do not want to show
         * like content, or description
         *
         * @return array
         */
        function get_columns() {
            $columns = array(
                'request_code' => __('Request Code', 'expense_table_list'),
                'total_cost' => __('Total Cost', 'expense_table_list'),
                'rep_manager_code' => __('Reporting Manager Approval', 'expense_table_list'),
                'finance_approval' => __('Finance Approval', 'expense_table_list'),
                'request_date' => __('Request Date', 'expense_table_list'),
                'claim_status' => __('Claim Status', 'expense_table_list'),
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
                'request_code' => array('Request Code', true),
                'total_cost' => array('Total Cost', true),
                'rep_manager_code' => array('Reporting Manager Approval', true),
                'finance_approval' => array('Finance Approval', true),
                'request_date' => array('Request Date', true),
                'claim_status' => array('Claim Status', true)
            );
            return $sortable_columns;
        }

        function prepare_items() {
            $compid = $_SESSION['compid'];
            global $wpdb;
            global $query;
            $mydetails = myDetails();
            $empid = $mydetails->EMP_Id;
            $table_name = 'requests'; // do not forget about tables prefix

            $per_page = 5; // constant, how much records will be shown per page

            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();

            // here we configure table headers, defined in our methods
            $this->_column_headers = array($columns, $hidden, $sortable);

            // [OPTIONAL] process bulk action if any
            $this->process_bulk_action();
            // filter expense type
            if (isset($_REQUEST['filter_request']) && $_REQUEST['filter_request']) {
                $selExpenseType = $_REQUEST['filter_request'];
                if ($selExpenseType == 4) {
                    $query.=" AND req.REQ_Type IN (2, 3, 4)";
                } else {
                    $query.=" AND req.RT_Id=$selExpenseType";
                }
            }
            // filter status
            if (isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']) {
                $selReqstatus = $_REQUEST['filter_status'];
                $query.=" AND req.REQ_Status=$selReqstatus";
            }
            // filter employee		
            if (isset($_REQUEST['filter_emp']) && $_REQUEST['filter_emp']) {
                $empid = $_REQUEST['filter_emp'];
                $query.=" AND re.EMP_Id=$empid";
            }

            // will be used in pagination settings
            //$total_items = $wpdb->get_var("SELECT COUNT(COM_Id) FROM $table_name");
            // prepare query params, as usual current page, order by and order direction
            $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
            $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'req.REQ_Id';
            $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

            // [REQUIRED] define $items array
            // notice that last argument is ARRAY_A, so we will retrieve array
            if (!empty($_POST["s"])) {
                $query = "";
                $search = trim($_POST["s"]);
                $searchcol = array(
                    'REQ_Code'
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
                $total_items = $wpdb->get_var("SELECT COUNT(REQ_Code) FROM $table_name" . $query);

                $this->items = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT(req.REQ_Id), req.* FROM $table_name req, request_employee re" . $query . "AND req.COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND req.REQ_Active !=9 AND RE_Status=1 ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
            } else {
                $total_items = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM $table_name req, request_employee re  WHERE req.COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND req.REQ_Active !=9 AND RE_Status=1 " . $query));

                $this->items = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT(req.REQ_Id), req.* FROM $table_name req, request_employee re  WHERE req.COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND req.REQ_Active !=9 AND RE_Status=1 " . $query . " ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);
            }
            // [REQUIRED] configure pagination
            $this->set_pagination_args(array(
                'total_items' => $total_items, // total items defined above
                'per_page' => $per_page, // per page constant defined at top of method
                'total_pages' => ceil($total_items / $per_page) // calculate pages count
            ));
        }

    }

//}

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
        //if(!empty($item['age']) && !absint(intval($item['age'])))  $messages[] = __('Age can not be less than zero');
        //if(!empty($item['age']) && !preg_match('/[0-9]+/', $item['age'])) $messages[] = __('Age must be number');
        //...

        if (empty($messages))
            return true;
        return implode('<br />', $messages);
    }

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
    