<?php

function erp_company_url_single_projectcode($pcId) {

    $url = admin_url('admin.php?page=projectcode=view&id=' . $pcId);

    return apply_filters('erp_company_url_single_projectcode', $url, $pcId);
}

function get_costcenter_list(){
	global $wpdb;
        $compid = $_SESSION['compid'];
	$companylist = $wpdb->get_results( "SELECT COM_Id,CC_Id,CC_Location FROM cost_center WHERE COM_Id='$compid'AND CC_Status=1 ORDER BY CC_Location ASC");
	return $companylist;
}

function projectcode_create($args = array()) {
    global $wpdb;
    $compid = $_SESSION['compid'];
    $data = array_map('strip_tags_deep', $_POST);

    $ccId = $data['company']['txtCostcenter'];
   
    $pcId = $data['company']['txtCostcenter'];
    //$ccId = $data['company']['ccId'];
    
    $PC_Budget = $data['company']['txtProjectBudget'];
    
    $cc_Data = $wpdb->get_row("SELECT CC_Location,CC_Budget FROM cost_center WHERE CC_Id = '$ccId' AND COM_Id='$compid'");
    
    $totalsum = $wpdb->get_row("SELECT SUM(PC_Budget) as total FROM project_code WHERE CC_Id = '$ccId' AND COM_Id='$compid' AND PC_Status='1' AND PC_Active='1'");
   
    $totalsum = $totalsum->total;
    $total=$totalsum+$PC_Budget;
    $ccBudget = $cc_Data->CC_Budget;
    $projectId = $data['company']['projectCode'];
    $pcBudget = $wpdb->get_row("SELECT PC_Budget FROM project_code WHERE PC_Id = '$projectId' AND COM_Id='$compid'"); 
    if($pcBudget){
    	$total = $total - $pcBudget->PC_Budget;
    }
    //echo $total . "," . $ccBudget;die;
    if($total>$ccBudget){
        echo "Budget Limit Exceededs Cost Center Budget";die;
        $response = array('status' => 'Failure', 'message' => "Budget Limit Exceeds Cost Center Budget");
        return $response;die;
    }
    else{
	    $update = "false";
	    $pcCode = $wpdb->get_results("SELECT PC_Code,PC_Id FROM project_code WHERE CC_Id = '$ccId' AND COM_Id='$compid'");
	    $exPcCode = $data['company']['txtProjectCode'];
	    $company_data = array(
	        'COM_Id' => $compid,
	        'CC_Id' => $ccId,
	        'Costcenter_Branch' => $cc_Data->CC_Location,
	        'PC_Budget' => $data['company']['txtProjectBudget'],
	    );
	        $tablename = "project_code";
	        if($data['company']['pcId']){
	        $wpdb->update($tablename, $company_data, array('PC_Id' => $data['company']['pcId']));
	        $pcid = $data['company']['pcId']; 
	        }
	        else{
	                $projectId = $data['company']['projectCode']; 
		        $pcCode = $wpdb->get_row("SELECT * FROM project_code WHERE PC_Id = '$projectId' AND COM_Id='$compid'");
		        if($pcCode->PC_Budget != 0)
		        {
		        echo "Project Budget Already Defined for this Cost Center";die;
		        //$wpdb->update($tablename, $company_data, array('PC_Id' => $data['company']['projectCode']));
		        $pcid = $data['company']['projectCode'];
		        }
		        else if($pcCode){
		        $pcid = $data['company']['projectCode'];
		        $wpdb->update($tablename, $company_data, array('PC_Id' => $pcid));
		        }
		        else{
		        $wpdb->insert($tablename, $company_data);
		        $pcid = $wpdb->insert_id;
		        }
	        }
	        $cctravel = $data['company']['txtCategorytravel'];
	        $ccmileage = $data['company']['txtCategorymileage'];
	        $ccutility = $data['company']['txtCategoryutility'];
	        $ccother = $data['company']['txtCategoryothers'];
	        $pcBudget = $wpdb->get_row("SELECT PC_Budget FROM project_code WHERE PC_Id = '$pcid' AND COM_Id='$compid'");
	        $ccId = $wpdb->get_row("SELECT CC_Id,cc_Budget FROM project_code WHERE PC_Id = '$pcid' AND COM_Id='$compid'");
	        $totalccbudget= $ccId->cc_Budget;
	        $total=$cctravel+$ccmileage+$ccutility+$ccother;
	        $totalpcbudget= $pcBudget->PC_Budget;
	        //$this->send_success($totalpcbudget);die;
	        //echo $total . "," . $totalpcbudget;die;
	        if($total>$totalpcbudget) 
	        {
	        echo "Budget Limit Exceededs Project Budget";die;
	        //$response = array('status' => 'Failure', 'message' => "Budget Limit Exceededs Project Budget");
        	//return $response;
	        }
	        else 
	        {
	        	$tablename = 'Categorybudgets';
		        $category_data = array(
		        'COM_Id' => $compid,
		        'CB_Active' => '1',
		        'PC_Budget' => $totalpcbudget,
		        'CC_Id' => $ccId->CC_Id,
		        'PC_Id' => $pcid,
		        'Travel_Category' => $data['company']['txtCategorytravel'],
		        //'Project_code' => $data['company']['txtprojectcode'],
		        'Milage_Category' => $data['company']['txtCategorymileage'],
		        'Utility_Category' => $data['company']['txtCategoryutility'],
		        'Others_Category' => $data['company']['txtCategoryothers'],
		        );
	                $projectId = $data['company']['pcId'];
	                $query = $wpdb->get_row("SELECT PC_Id FROM Categorybudgets WHERE PC_Id = '$projectId'");
		        if($query){
		        $categorybudgetrdata = $wpdb->update($tablename, $category_data, array('PC_Id' => $data['company']['pcId']));
		        }
		        else{
		        $categorybudgetrdata = $wpdb->insert($tablename, $category_data);
		        }
		        
	       }
	        $response = array('status' => 'Success', 'message' => "Project Code Added Successfully");
        	return $response;;

	}
}

function pbudget_create($args = array()) {
    global $wpdb;
    $compid = $_SESSION['compid'];
    $data = array_map('strip_tags_deep', $_POST);
	    $company_data = array(
	        'COM_Id' => $compid,
	        'CC_Id' => $data['company']['txtCostcenter'],
	        'DEP_Id' => $data['company']['selDep'],
	        //'PC_Id' => $data['company']['pcId'],
	        'PC_Code' => $data['company']['txtProjectCode'],
	        //'Costcenter_Branch' => $cc_Data->CC_Location,
	        'PC_Name' => $data['company']['txtProjectName'],
	        'PC_Location' => $data['company']['txtProjectLoc'],
	        'PC_Description'=> $data['company']['txtProjectDesc'],
	    );
	    $update_data = array(
	        'PC_Status' => '2',
	    );
	    if ($data['company']['pcId']) {
	        $tablename = "project_code";
	        $wpdb->update($tablename, $company_data, array('PC_Id' => $data['company']['pcId']));
	    } else {
	        $tablename = "project_code";
	        $wpdb->insert($tablename, $company_data);
	        return $company_data;
	    }

}