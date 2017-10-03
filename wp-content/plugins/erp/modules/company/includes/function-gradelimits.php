<?php

function gradelimits_create($posted) {
    global $wpdb;
    $compid = $_SESSION['compid'];
    $adminid = $_SESSION['adminid'];
    $glID = $posted['company']['glId'];
    $egId = $posted['company']['egId'];
    $company_data = array(
        'COM_Id' => $compid,
        // 'ADM_Id'=>$data['company']['adminid'],
        'GL_Flight' => $posted['company']['txtflight'],
        'GL_Bus' => $posted['company']['txtBus'],
        'GL_Car' => $posted['company']['txtCar'],
        'GL_Others_Travels' => $posted['company']['txtOthers1'],
        'GL_Hotel' => $posted['company']['txtHotel'],
        'GL_Self' => $posted['company']['txtSelf'],
        'GL_Halt' => $posted['company']['txtHalt'],
        'GL_Boarding' => $posted['company']['txtBoarding'],
        'GL_Other_Te_Others' => $posted['company']['txtOthers'],
        'GL_Local_Conveyance' => $posted['company']['txtLocal'],
        'GL_Mobile' => $posted['company']['txtMobile'],
        'GL_ClientMeeting' => $posted['company']['txtClient'],
        'GL_Others_Other_te' => $posted['company']['txtOthers'],
        'GL_DataCard' => $posted['company']['txtData'],
        'GL_Marketing' => $posted['company']['txtMarketing'],
        'GL_Twowheeler' => $posted['company']['txtTwo'],
        'GL_Fourwheeler' => $posted['company']['txtFour'],
        'GL_Internet' => $posted['company']['txtInternet'],
        'GL_Flight_Percent' => $posted['company']['txtflightpercent'],
        'GL_Bus_Percent' => $posted['company']['txtBuspercent'],
        'GL_Car_Percent' => $posted['company']['txtCarpercent'],
        'GL_Others_Travels_Percent' => $posted['company']['txtOthers1percent'],
        'GL_Hotel_Percent' => $posted['company']['txtHotelpercent'],
        'GL_Self_Percent' => $posted['company']['txtSelfpercent'],
        'GL_Halt_Percent' => $posted['company']['txtHaltpercent'],
        'GL_Boarding_Percent' => $posted['company']['txtBoardingpercent'],
        'GL_Other_Te_Others_Percent' => $posted['company']['txtOtherspercent'],
        'GL_Local_Conveyance_Percent' => $posted['company']['txtLocalpercent'],
        'GL_ClientMeeting_Percent' => $posted['company']['txtClientpercent'],
        'GL_Others_Other_te_Percent' => $posted['company']['txtOtherspercent'],
        'GL_Marketing_Percent' => $posted['company']['txtMarketingpercent'],
    );
        $tablename = "grade_limits";
      
        $company_data['EG_Id'] = $egId;
        $wpdb->update($tablename, $company_data, array('EG_Id' => $egId));
        
        $tablemode = "sub_category_limit";
        $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=1 AND COM_Id IN (0, $compid) AND MOD_Status=1 AND MOD_Id NOT IN (1,2,3,4)");
        foreach ($selmodes as $value) {
        	$modename = str_replace(' ', '_', $value->MOD_Name);
        	$mode_data = array(
        	'Limit_Amount' => $posted[$modename.$value->MOD_Id],
        	'Tolerance' => $posted["percent_".$modename.$value->MOD_Id],
        	'MOD_Id' => $value->MOD_Id,
        	'EG_Id' => $egId 
        	);
        	if($subGradeLimits = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE MOD_Id = $value->MOD_Id AND EG_Id = $egId")){
        	$mode_data = array(
        	'Limit_Amount' => $posted[$modename.$value->MOD_Id],
        	'Tolerance' => $posted["percent_".$modename.$value->MOD_Id],
        	);
        	$wpdb->update($tablemode, $mode_data, array('MOD_Id' => $value->MOD_Id, 'EG_Id' => $egId));
        	}
        	else{
		$mode_data = array(
        	'Limit_Amount' => $posted[$modename.$value->MOD_Id],
        	'Tolerance' => $posted["percent_".$modename.$value->MOD_Id],
        	'MOD_Id' => $value->MOD_Id,
        	'EG_Id' => $egId 
        	);
        	$wpdb->insert($tablemode, $mode_data);
        	}
        }
        return "success";

}
