<?php

function erp_company_url_single_categorybudget($pcId) {

    $url = admin_url('admin.php?page=categorybudget=view&id=' . $pcId);

    return apply_filters('erp_company_url_single_categorybudget', $url, $pcId);
}

function get_categorybudget_list(){
	global $wpdb;
        $compid = $_SESSION['compid'];
	$companylist = $wpdb->get_results( "SELECT CC_Id, CC_Location FROM cost_center WHERE CC_Status=1 ORDER BY CC_Location ASC");
	return $companylist;
}

function get_projectcodes_list(){
	global $wpdb;
        $compid = $_SESSION['compid'];
	$companylist = $wpdb->get_results( "SELECT PC_Id, Costcenter_Branch,PC_Code,PC_Name FROM  project_code WHERE COM_Id=$compid AND PC_Status = '1' AND PC_Active = '1'");
	return $companylist;
}

function categorybudget_create($args = array()) {
    global $wpdb;
    $compid = $_SESSION['compid'];
  
    $defaults = array(
        //'user_email'      => '',
        'Categorybudgets' => array(
            'compid' => $compid,
            'pcId',
            'txtCategorytravel' => '',
            'txtCategorymileage'  => '',
            'txtCategoryutility' => '',
           
        )
    );
    $posted = array_map('strip_tags_deep', $args);
    $posted = array_map('trim_deep', $posted);
    $data = erp_parse_args_recursive($posted, $defaults);
    $user_id = $data['company']['pcId'];
    $update = false;
    if ($user_id) {
        $update = true;
        $company_data['CB_Id'] = $user_id;
    }
    $company_data = array(
        'COM_Id' => $compid,
        //'PC_Id' => $data['company']['pcId'],
        'Travel_Category' => $data['company']['txtCategorytravel'],
        'Costcenter_Branch' => $data['company']['txtCostcenter'],
        'Milage_Category' => $data['company']['txtCategorymileage'],
        'Utility_Category' => $data['company']['txtCategoryutility'],
       
    );
    if ($update) {
        $tablename = "project_code";
        $company_data['PC_Id'] = $user_id;
        $wpdb->update($tablename, $company_data, array('PC_Id' => $user_id));
    } else {
        $tablename = "project_code";
        $wpdb->insert($tablename, $company_data);
        return $company_data;
    }
}
