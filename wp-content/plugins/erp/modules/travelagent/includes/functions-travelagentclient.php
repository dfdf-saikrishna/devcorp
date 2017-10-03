<?php
//use WeDevs\ERP\Corptne\includes\Models\Employeelist;
/**
 * Delete an employee if removed from WordPress usre table
 *
 * @param  int  the user id
 *
 * @return void
 */
function travelagentclient_create( $args = array() ) {
     global $wpdb;
    $defaults = array(
        'travelagentclient'        => array(
			'photo_id'        => 0,
            'user_id'         => 0,
            'txtCompname' => '',
			'txtEmpCodePrefx' => '',
			'txtCompemail' => '',
			'txtCompmob' => '',
			'txtComplandline' => '',
			'txtaCompaddr' => '',
			'txtCompoloc' => '',
			'txtCompcity' => '',
			'txtCompstate' => '',
			'txtCompcntp1name' => '',
			'txtCompcntp1email' => '',
			'txtCompcntp1mob' => '',
			'txtCompcntp2name' => '',
			'txtCompcntp2email' => '',
			'txtCompcntp2mob' => '',
			'txtSalespersname' => '',
			'txtSalesperemail' => '',
			'txtSalespercontno' => '',
			'txtadescdeal' => '',
			'selCT' => '',
        ),
		'assign_company'=> array(
		 'user_id'         => 0,
		 'selTrvAgntUser' => '',
		),
		'company_markups_markdowns'=> array(
			 'user_id'         => 0,
			 'selFlightTerms' => '',
			'radioFlightMarkStatus' => '',
			'txtFlightMarkFare' => '',
			'selBusTerms' => '',
			'radioBusMarkStatus' => '',
			'txtBusMarkFare' => '',
			'selHotelTerms' => '',
			'radioHotelMarkStatus' => '',
			'txtHotelMarkFare' => '',
		),
		'traveldesk'=> array(
		 'user_id'         => 0,
		 'txtComTrvDeskUsername' => '',
		)
    );

    $posted = array_map( 'strip_tags_deep', $args );
    $posted = array_map( 'trim_deep', $posted );
    $data   = erp_parse_args_recursive( $posted, $defaults );
	$avatar_url = wp_get_attachment_url( $data['travelagentclient']['photo_id'] );
    // attempt to create the user
    $userdata = array(
        'user_login'   => $data['traveldesk']['txtComTrvDeskUsername'],
        'user_email'   => $data['travelagentclient']['txtCompemail'],
        'first_name'   => $data['traveldesk']['txtComTrvDeskUsername'],
        'last_name'    => $data['traveldesk']['txtComTrvDeskUsername'],
        'user_url'     => $data['traveldesk']['user_url'],
        'display_name' => $data['traveldesk']['txtComTrvDeskUsername'],
        );

    // if user id exists, do an update
	$cmpid = $data['travelagentclient']['COM_Id'];
    //$user_id = isset( $data['traveldesk']['user_id'] ) ? intval( $data['traveldesk']['user_id'] ) : 0;
    $update  = false;

	 if ( $cmpid ) {
        $update = true;
		$travelagentclient_data['COM_Id'] = $cmpid;
    } else {
        // when creating a new user, assign role and passwords
        $userdata['user_pass'] = wp_generate_password( 12 );
        $userdata['role'] = 'travelagentclient';
    }

    $userdata = apply_filters( 'erp_hr_travelagentclient_args', $userdata );
    if ( is_wp_error( $user_id ) ) {
        return $user_id;
    }
	$supid = $_SESSION['supid'];
	$travelagentclient_data = array(
        'COM_Name' =>$data['travelagentclient']['txtCompname'],
		'COM_Prefix' =>$data['travelagentclient']['txtEmpCodePrefx'],
		'COM_Email' =>$data['travelagentclient']['txtCompemail'],
		'COM_Mobile' =>$data['travelagentclient']['txtCompmob'],
		'COM_Landline' =>$data['travelagentclient'][ 'txtComplandline'],
		'COM_Address' =>$data['travelagentclient']['txtaCompaddr'],
		'COM_Location' =>$data['travelagentclient']['txtCompoloc'],
		'COM_City' =>$data['travelagentclient']['txtCompcity'],
		'COM_State' =>$data['travelagentclient']['txtCompstate'],
		'COM_Cp1username' =>$data['travelagentclient']['txtCompcntp1name'],
		'COM_Cp1email' =>$data['travelagentclient']['txtCompcntp1email'],
		'COM_Cp1mobile' =>$data['travelagentclient']['txtCompcntp1mob'],
		'COM_Cp2username' =>$data['travelagentclient']['txtCompcntp2name'],
		'COM_Cp2email' =>$data['travelagentclient']['txtCompcntp2email'],
		'COM_Cp2mobile' =>$data['travelagentclient']['txtCompcntp2mob'],
		'COM_Spname' =>$data['travelagentclient']['txtSalespersname'],
		'COM_Spemail' =>$data['travelagentclient']['txtSalesperemail'],
		'COM_Spcontactno' =>$data['travelagentclient']['txtSalespercontno'],
		'COM_Descdeal' =>$data['travelagentclient']['txtadescdeal'],
		'SUP_Id'=>$supid,
		'CT_Id' =>$data['travelagentclient']['selCT'],
		'COM_Flight'=>'1',
		'COM_Bus'=>'1',
		'COM_Hotel'=>'1',
		'COM_PhotoId'=>$data['travelagentclient']['photo_id'],
		'COM_Logo' => $avatar_url,
    );
	$clientassigncompany_data = array(
	//$selTrvAgntUser = $data['assign_company']['selTrvAgntUser'],
	//foreach ($selTrvAgntUser as $key => $user) {
			'SUP_Id' =>$supid,
			//}
	);
	$traveldesk_data = array(
		'TD_Username' =>$data['traveldesk']['txtComTrvDeskUsername'],
		'TD_Email' =>$data['travelagentclient']['txtSalesperemail'],
		'TD_Addedby'=>'',
		'TD_Type'=>'2',
		'SUP_Id'=>$supid,
		);
		
    if($update){
       $tablename = "company";
	   $travelagentclient_data['COM_Id'] = $cmpid;
       $wpdb->update( $tablename,$travelagentclient_data,array( 'COM_Id' => $cmpid ));
    }
    else{
    $user_email = $userdata['user_email'];
	if($wpdb->get_results("SELECT * FROM wp_users WHERE user_email = '$user_email'")){
	
	return "User email already Exists";
	
	}else{
    //print_r($posted);
    //print_r($userdata);die;
    $user_id  = wp_insert_user( $userdata );
	$tablename = "company";
	$travelagentclient_data['user_id'] = $user_id;
	$wpdb->insert( $tablename, $travelagentclient_data);
	$cmpid = $wpdb->insert_id;
	
	if($cmpid){
	$selTrvAgntUser = $posted['selTrvAgntUser'];    
    foreach ($selTrvAgntUser as $user) {

            $iUser_data = array(
        		'SUP_Id' =>$user,
        		'COM_Id' =>$cmpid,
    		);
        
            $wpdb->insert( 'assign_company', $iUser_data);
            
            // mail to travel agent user

            //travelAgentUserAssignRe($user, $newcmpid, 1); // 1 - assign, 2- re assign
    }
	$clientassigncompany_data['COM_Id'] = $cmpid;	
	//$wpdb->insert( 'assign_company', $clientassigncompany_data);	
	$traveldesk_data['user_id'] = $user_id;
	$traveldesk_data['COM_Id'] = $cmpid;
	$wpdb->insert( 'travel_desk', $traveldesk_data);
	
	$clientcompanymarksup_data = array(
		// insert flight mark ups	
		//if (isset($data['company_markups_markdowns']['selFlightTerms']) && isset($data['company_markups_markdowns']['txtFlightMarkFare'])) {	
		array(
		'MOD_Id'=>'1',
		'MC_Id'=>$data['company_markups_markdowns']['selFlightTerms'],
		'CMM_MarkFare' =>$data['company_markups_markdowns']['txtFlightMarkFare'],
		'CMM_MarkStatus'=>$data['company_markups_markdowns']['radioFlightMarkStatus'],
		'CMM_Fromdate'=> 'NOW()',
		'COM_Id' => $cmpid,
		),
        array(
		//}
		// insert bus mark ups
		//if ($data['company_markups_markdowns']['selBusTerms'] && $data['company_markups_markdowns']['txtBusMarkFare']) {
		'MOD_Id'=>'2',
		'MC_Id'=>$data['company_markups_markdowns']['selBusTerms'],
		'CMM_MarkFare' =>$data['company_markups_markdowns']['txtBusMarkFare'],
		'CMM_MarkStatus'=>$data['company_markups_markdowns']['radioBusMarkStatus'],
		'CMM_Fromdate'=> 'NOW()',	
		'COM_Id' => $cmpid,
		),
        array(
		//}			
		 // insert hotel mark upds
		//if(!empty($selHotelTerms && $txtHotelMarkFare)) {
		'MOD_Id'=>'5',
		'MC_Id'=>$data['company_markups_markdowns']['selHotelTerms'],
		'CMM_MarkFare' =>$data['company_markups_markdowns']['txtHotelMarkFare'],
		'CMM_MarkStatus'=>$data['company_markups_markdowns']['radioHotelMarkStatus'],
		'CMM_Fromdate'=> 'NOW()',	
		'COM_Id' => $cmpid,
		//}
		)
		);
    foreach( $clientcompanymarksup_data as $row )
    {
	$wpdb->insert( 'company_markups_markdowns', $row);
    }
	
	 // send username and password to the company email address

            //travelDeskLoginDetails($newcmpid, $txtCompemail, $txtComTrvDeskUsername, $txtComTrvDeskPwd);


            // mail to contact person 1
            //mailtoContactperson($newcmpid, $txtCompcntp1name, $txtCompcntp1email);


            //if ($txtCompcntp2name && $txtCompcntp2email) {

                // mail to contact person 2
                //mailtoContactperson($newcmpid, $txtCompcntp2name, $txtCompcntp2email);
            //}


            // generate folders and files for the company
            
            
            $newFilePath = WPERP_COMPANY_PATH . "/upload/$cmpid/";
                        if (!file_exists($newFilePath)) {
                            wp_mkdir_p($newFilePath);
                        }
            $newFilePath = WPERP_COMPANY_PATH . "/upload/$cmpid/photographs/";
                        if (!file_exists($newFilePath)) {
                            wp_mkdir_p($newFilePath);
                        }
            $newFilePath = WPERP_COMPANY_PATH . "/upload/$cmpid/bills_tickets/";
                        if (!file_exists($newFilePath)) {
                            wp_mkdir_p($newFilePath);
                        }


            $folderName = 'TNE' . rand(1111, 9999) . sprintf("%04d", $newcmpid);
            
            $newFilePath = WPERP_COMPANY_PATH . "/upload/tally-files/$folderName/";
                        if (!file_exists($newFilePath)) {
                            wp_mkdir_p($newFilePath);
                        }


            // mail to corptne team
            //mailtoCorptne($supid, $newcmpid);
	
	
	
	return $user_id;
	}
    }
    }
    
}	
function get_markupdown_list(){
	global $wpdb;
	$markupdownlist = $wpdb->get_results( "SELECT * FROM markupdown_category");
	return $markupdownlist;
	}	

function get_bankaccount_list(){
	global $wpdb;
	$supid = $_SESSION['supid']; 
	$bankaccountlist = $wpdb->get_results("SELECT * FROM travel_desk_bank_account WHERE SUP_Id = $supid AND TDBA_Type = 2 AND TDBA_Status = 1");
	return $bankaccountlist;
	}

function get_allocation_list(){
	global $wpdb;
	$supid = $_SESSION['supid']; 
	$allocationlist = $wpdb->get_results("SELECT  sup.SUP_Id, sup.SUP_Name, sup.SUP_Username FROM superadmin sup WHERE
					  sup.SUP_Refid = $supid AND SUP_Status = 1 AND SUP_Type = 4 AND SUP_Access = 1 ORDER BY SUP_Name");
	return $allocationlist;
	}	
	
/*
 * [erp_company_url_single_clientview description]
 *
 * @param  int  company id
 *
 * @return string  url of the companyview details page
 */
function erp_company_url_single_clientview($com_id) {

    $url = admin_url( 'admin.php?page=Clientview&action=view&id=' . $com_id);

    return apply_filters( 'erp_company_url_single_clientview', $url, $com_id );
}

function erp_company_url_invoice_create($com_id) {

    $url = admin_url( 'admin.php?page=invoicecreate&action=view&id=' . $com_id);

    return apply_filters( 'erp_company_url_single_clientview', $url, $com_id );
}

/*
 * [erp_company_url_single_clientview description]
 *
 * @param  int  company id
 *
 * @return string  url of the companyview details page
 */
function erp_travelagent_requestview($com_id,$selFilter) {

    $url = admin_url( 'admin.php?page=requestview&action=view&id=' . $com_id .'&selFilter='.$selFilter);

    return apply_filters( 'erp_travelagent_requestview', $url, $com_id,$selFilter);
}