<?php

namespace WeDevs\ERP\Employee;

use WeDevs\ERP\Framework\Traits\Ajax;
use WeDevs\ERP\Framework\Traits\Hooker;
use WeDevs\ERP\HRM\Models\Dependents;
use WeDevs\ERP\HRM\Models\Education;
use WeDevs\ERP\HRM\Models\Work_Experience;

/**
 * Ajax handler
 *
 * @package WP-ERP
 */
class Ajax_Handler {

    use Ajax;

use Hooker;

    /**
     * Bind all the ajax event for HRM
     *
     * @since 0.1
     *
     * @return void
     */
    public function __construct() {

        // PreTravelRequest
        $this->action('wp_ajax_send_pre_travel_request', 'send_pre_travel_request');
        $this->action('wp_ajax_send_prepost_edit', 'send_prepost_edit');
        $this->action('wp_ajax_send_prepost_save', 'send_prepost_save');
        $this->action('wp_ajax_send_pre_travel_request_edit', 'send_pre_travel_request_edit');
        $this->action('wp_ajax_save_pre_travel_request_edit', 'save_pre_travel_request_edit');
        $this->action('wp_ajax_pre-travel-request-delete', 'pre_travel_request_delete');
        $this->action('wp_ajax_request-delete', 'request_delete');
        $this->action('wp_ajax_send-emp-note', 'send_emp_note');
        $this->action('wp_ajax_get-exp-cat', 'get_exp_cat');
        $this->action('wp_ajax_get-mode', 'get_mode');
        $this->action('wp_ajax_approve-request', 'approve_request');
        $this->action('wp_ajax_reject-request-approver', 'reject_request_approver');
        $this->action('wp_ajax_reject-request-finance', 'reject_request_finance');
        $this->action('wp_ajax_approve-preclaim', 'approve_preclaim');
        $this->action('wp_ajax_reject-preclaim', 'reject_preclaim');
        $this->action('wp_ajax_approve-acclaim', 'approve_acclaim');
        $this->action('wp_ajax_reject-acclaim', 'reject_acclaim');
        $this->action('wp_ajax_get-operator', 'get_operator');
        $this->action('wp_ajax_flight-search-quote', 'flight_search_quote');
        $this->action('wp_ajax_bus-search-quote', 'bus_search_quote');
		$this->action('wp_ajax_get-save-status', 'get_save_status');

        $this->action('wp_ajax_get-quote', 'get_quote');
        $this->action('wp_ajax_get-quote-bus', 'get_quote_bus');
        $this->action('wp_ajax_auto-search-bus', 'auto_search_bus');
        $this->action('wp_ajax_auto-search-flight', 'auto_search_flight');
        $this->action('wp_ajax_auto-search-hotel', 'auto_search_hotel');
        $this->action('wp_ajax_get-seat-layout', 'get_seat_layout');

        // Other Requests
        $this->action('wp_ajax_get-mileage', 'get_mileage');
        $this->action('wp_ajax_get-file-extensions', 'get_file_extensions');
        $this->action('wp_ajax_delete-files', 'delete_files');
        $this->action('wp_ajax_get-mode-mileage', 'get_mode_mileage');
        $this->action('wp_ajax_get-mode-utility', 'get_mode_utility');
        $this->action('wp_ajax_get-mode-others', 'get_mode_others');
        $this->action('wp_ajax_get-mode-quote', 'get_mode_quote');
        $this->action('wp_ajax_get-fare-quote-flight', 'get_fare_quote_flight');
        $this->action('wp_ajax_booking-reserve', 'booking_reserve');
	$this->action('wp_ajax_get-others-details', 'get_others_details');
       

	// API
	$this->action('wp_ajax_utility-recharge', 'utility_recharge');

        // Department
        $this->action('wp_ajax_erp-hr-new-dept', 'department_create');
        $this->action('wp_ajax_erp-hr-del-dept', 'department_delete');
        $this->action('wp_ajax_erp-hr-get-dept', 'department_get');
        $this->action('wp_ajax_erp-hr-update-dept', 'department_create');

        // Designation
        $this->action('wp_ajax_erp-hr-new-desig', 'designation_create');
        $this->action('wp_ajax_erp-hr-get-desig', 'designation_get');
        $this->action('wp_ajax_erp-hr-update-desig', 'designation_create');
        $this->action('wp_ajax_erp-hr-del-desig', 'designation_delete');

        // Company Admin
        $this->action('wp_ajax_companyadmin_create', 'companyadmin_create');
        $this->action('wp_ajax_companyadmin_get', 'companyadmin_get');
        $this->action('wp_ajax_companyadmin-delete', 'companyadmin_remove');

        // Employee
        $this->action('wp_ajax_erp-hr-employee-new', 'employee_create');
        $this->action('wp_ajax_erp-hr-emp-get', 'company_get');
        $this->action('wp_ajax_erp-hr-companyview-get', 'companyview_get');
        $this->action('wp_ajax_erp-hr-emp-delete', 'employee_remove');
        $this->action('wp_ajax_erp-hr-emp-restore', 'employee_restore');
        $this->action('wp_ajax_erp-hr-emp-update-status', 'employee_update_employment');
        $this->action('wp_ajax_erp-hr-emp-update-comp', 'employee_update_compensation');
        $this->action('wp_ajax_erp-hr-emp-delete-history', 'employee_remove_history');
        $this->action('wp_ajax_erp-hr-emp-update-jobinfo', 'employee_update_job_info');
        $this->action('wp_ajax_erp-hr-empl-leave-history', 'get_employee_leave_history');
        $this->action('wp_ajax_erp-hr-employee-new-note', 'employee_add_note');
        $this->action('wp_ajax_erp-load-more-notes', 'employee_load_note');
        $this->action('wp_ajax_erp-delete-employee-note', 'employee_delete_note');
        $this->action('wp_ajax_erp-hr-emp-update-terminate-reason', 'employee_terminate');
        $this->action('wp_ajax_erp-hr-emp-activate', 'employee_termination_reactive');
        $this->action('wp_ajax_erp-hr-convert-wp-to-employee', 'employee_create_from_wp_user');
        $this->action('wp_ajax_erp_hr_check_user_exist', 'check_user');
        $this->action('wp_ajax_erp-hr-add-deligate', 'add_deligate');
        $this->action('wp_ajax_create-delegate', 'create_delegate');
        $this->action('wp_ajax_edit-delegate', 'edit_delegate');
		$this->action('wp_ajax_get-request-details', 'get_request_details');

        // Dashaboard
        $this->action('wp_ajax_erp_hr_announcement_mark_read', 'mark_read_announcement');
        $this->action('wp_ajax_erp_hr_announcement_view', 'view_announcement');

        // Performance
        $this->action('wp_ajax_erp-hr-emp-update-performance-reviews', 'employee_update_performance');
        $this->action('wp_ajax_erp-hr-emp-update-performance-comments', 'employee_update_performance');
        $this->action('wp_ajax_erp-hr-emp-update-performance-goals', 'employee_update_performance');
        $this->action('wp_ajax_erp-hr-emp-delete-performance', 'employee_delete_performance');

        // work experience
        $this->action('wp_ajax_erp-hr-create-work-exp', 'employee_work_experience_create');
        $this->action('wp_ajax_erp-hr-emp-delete-exp', 'employee_work_experience_delete');

        // education
        $this->action('wp_ajax_erp-hr-create-education', 'employee_education_create');
        $this->action('wp_ajax_erp-hr-emp-delete-education', 'employee_education_delete');

        // dependents
        $this->action('wp_ajax_erp-hr-create-dependent', 'employee_dependent_create');
        $this->action('wp_ajax_erp-hr-emp-delete-dependent', 'employee_dependent_delete');

        // leave policy
        $this->action('wp_ajax_erp-hr-leave-policy-create', 'leave_policy_create');
        $this->action('wp_ajax_erp-hr-leave-policy-delete', 'leave_policy_delete');
        $this->action('wp_ajax_erp-hr-leave-employee-assign-policies', 'leave_assign_employee_policy');
        $this->action('wp_ajax_erp-hr-leave-policies-availablity', 'leave_available_days');
        $this->action('wp_ajax_erp-hr-leave-req-new', 'leave_request');

        //leave holiday
        $this->action('wp_ajax_erp_hr_holiday_create', 'holiday_create');
        $this->action('wp_ajax_erp-hr-get-holiday', 'get_holiday');
        $this->action('wp_ajax_erp-hr-import-ical', 'import_ical');

        //leave entitlement
        $this->action('wp_ajax_erp-hr-leave-entitlement-delete', 'remove_entitlement');

        //leave rejected
        $this->action('wp_ajax_erp_hr_leave_reject', 'leave_reject');

        // script reload
        $this->action('wp_ajax_erp_hr_script_reload', 'employee_template_refresh');
        $this->action('wp_ajax_erp_hr_new_dept_tmp_reload', 'new_dept_tmp_reload');
        $this->action('wp_ajax_payment_details_create', 'payment_details_create');
        $this->action('wp_ajax_all_payment_details_create', 'all_payment_details_create');
        $this->action('wp_ajax_approve_finance_request', 'approve_finance_request');
        $this->action('wp_ajax_approve_finance_reject', 'approve_finance_reject');
        $this->action('wp_ajax_traveldesk_approve_request', 'traveldesk_approve_request');
        $this->action('wp_ajax_traveldesk_reject_request', 'traveldesk_reject_request');
        $this->action('wp_ajax_pretopost_submit_claims', 'pretopost_submit_claims');
        $this->action('wp_ajax_get-project-codes', 'get_project_codes');
        $this->action('wp_ajax_get-sub-grades', 'get_sub_grades');
        $this->action('wp_ajax_get-mode-name', 'get_mode_name');
        $this->action('wp_ajax_get-pricerange-bus', 'get_pricerange_bus');
    }
	
	public function get_request_details(){
		global $wpdb;
		$posted = array_map('strip_tags_deep', $_POST);
		$reqId = $posted['req_id'];
		$req_details = $wpdb->get_results("SELECT RD_Dateoftravel FROM request_details WHERE REQ_Id = '$reqId'");
		$curdate = strtotime(date('d-m-Y'));
		$status = false;
		for($i = 0; $i < count($req_details); $i++) {
			$mydate = strtotime($req_details[$i]->RD_Dateoftravel);
			if($curdate < $mydate)
			{
				$status = true;
			}
			else{
				$status = false;
			}
		}
		if($status){
			$response = array('status' => 'failure', 'message' => "Cannot Submit Claim Before Travel Date");
			$this->send_success($response);
		}
		else{
			$response = array('status' => 'success');
			$this->send_success($response);
		}
		
	}
	
	public function get_save_status(){
		global $wpdb;
		$posted = array_map('strip_tags_deep', $_POST);
		$reqId = $posted['req_id'];
		$response1 = array('status' => 'failure');
		$response2 = array('status' => 'success');
		if($status = $wpdb->get_row("SELECT * FROM save_status WHERE REQ_Id = '$reqId'"))
			$this->send_success($response1);
		else
			$this->send_success($response2);
	}

    public function get_others_details(){
        global $wpdb;
        $compid = $_SESSION['compid'];
        $selsql=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id=3 AND COM_Id IN (0, '$compid') AND MOD_Status=1");
        $this->send_success($selsql);
    }
    
    public function flight_search_quote(){
        global $wpdb;
    	$posted = array_map('strip_tags_deep', $_POST);
    	$selTimeSlots = $posted['selTimeSlots'];
    	$selAirlines = $posted['selAirlines'];
    	$sessionid = $posted['sessionid'];
    	if($selTimeSlots && ($selTimeSlots != "undefined")){
    	    $rowts	=	$wpdb->get_row("SELECT * FROM time_slots WHERE TS_Id=$selTimeSlots");
        }
    	$sql="SELECT DISTINCT(gqf.GQF_Id),FORMAT(GQF_Price, 0) AS GQF_Price, CMM_Id, GQF_MarkFare, GQF_MarkUpDown, GQF_ActualPrice, GQF_DepDate, GQF_AirlineCode, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_AirlineName, GQF_DepTIme, GQF_Duration, GQF_Stops,  GQF_ArrTime, GQF_TraceId, GQF_ResultIndex, GQF_TokenId, Return_Journey FROM get_quote_flight gqf, airlines air, time_slots ts WHERE GQF_SessId='$sessionid' AND ARL_Status=1 AND TS_Status=1";
		
		if($selAirlines)
		$sql.=" AND gqf.GQF_AirlineName LIKE '%$selAirlines%'";
		
		if($selTimeSlots)
		$sql.=" AND GQF_DepTIme ".$rowts->TS_Term;
		
		$response = $wpdb->get_results($sql);
		$depdate = $response[0]->GQF_DepDate;
		$depdate = array('depdate' => $depdate);
		$origin = $response[0]->GQF_Origin;
		$origin = array('origin' => $origin);
		$destination = $response[0]->GQF_Destination;
		$destination = array('destination' => $destination);
		$busNames = $wpdb->get_results("SELECT DISTINCT GQF_AirlineName,GQF_Price FROM get_quote_flight WHERE GQF_SessId='$sessionid' GROUP BY GQF_AirlineName");
        $busnames = array('flights' => $busNames);
		$response = array('response' => $response);
		$session = array('session' => $sessionid);
		
		$timeslot = array('timeslot' => $selTimeSlots);
		$airlines = array('airlines' => $selAirlines);
		
		$obj_merged = (object) array_merge((array) $busnames, (array) $response, (array) $session, (array) $depdate, (array) $origin, (array) $destination, (array) $timeslot, (array) $airlines);
        $this->send_success($obj_merged);
    }
    
    public function bus_search_quote(){
        global $wpdb;
    	$posted = array_map('strip_tags_deep', $_POST);
    	$selTimeSlots = $posted['selTimeSlots'];
    	$selAirlines = $posted['selAirlines'];
    	$sessionid = $posted['sessionid'];
    	if($selTimeSlots && ($selTimeSlots != "undefined")){
    	    $rowts	=	$wpdb->get_row("SELECT * FROM time_slots WHERE TS_Id=$selTimeSlots");
        }
    	$sql="SELECT DISTINCT(gqf.GQF_Id),FORMAT(GQF_Price, 0) AS GQF_Price, CMM_Id, GQF_MarkFare, GQF_MarkUpDown, GQF_ActualPrice, GQF_DepDate, GQF_AirlineCode, GQF_FlightNumber, GQF_Origin, GQF_Destination, GQF_AirlineName, GQF_DepTIme, GQF_Duration, GQF_Stops,  GQF_ArrTime, GQF_TraceId, GQF_ResultIndex, GQF_TokenId, Return_Journey FROM get_quote_flight gqf, airlines air, time_slots ts WHERE GQF_SessId='$sessionid' AND ARL_Status=1 AND TS_Status=1";
		
		if($selAirlines)
		$sql.=" AND gqf.GQF_AirlineName LIKE '%$selAirlines%'";
		
		if($selTimeSlots)
		$sql.=" AND GQF_DepTIme ".$rowts->TS_Term;
		
		$response = $wpdb->get_results($sql);
		$depdate = $response[0]->GQF_DepDate;
		$depdate = array('depdate' => $depdate);
		$origin = $response[0]->GQF_Origin;
		$origin = array('origin' => $origin);
		$destination = $response[0]->GQF_Destination;
		$destination = array('destination' => $destination);
		$busNames = $wpdb->get_results("SELECT DISTINCT GQF_AirlineName,GQF_Price FROM get_quote_flight WHERE GQF_SessId='$sessionid' GROUP BY GQF_AirlineName");
        $busnames = array('buses' => $busNames);
		$response = array('response' => $response);
		$session = array('session' => $sessionid);
		
		$timeslot = array('timeslot' => $selTimeSlots);
		$airlines = array('airlines' => $selAirlines);
		
		$obj_merged = (object) array_merge((array) $busnames, (array) $response, (array) $session, (array) $depdate, (array) $origin, (array) $destination, (array) $timeslot, (array) $airlines);
        $this->send_success($obj_merged);
    }
    
    public function get_pricerange_bus(){
        global $wpdb;
    	$posted = array_map('strip_tags_deep', $_POST);
    	$sessid = $posted['session'];
    	$selprice = $posted['selprice'];
    	$result = $wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid' AND GQF_Price<=$selprice");
    	$count = count($wpdb->get_results("SELECT * FROM get_quote_flight WHERE GQF_SessId='$sessid' AND GQF_Price<=$selprice"));
    	
    	$minPrice =	$posted['minprice'];
	$maxPrice =	$posted['maxprice'];
	$response = array('response' => $result);
	$countArray = array('count' => $count, 'minprice' => $minPrice, 'maxprice' => $maxPrice, 'session' => $sessid);
	$obj_merged = (object) array_merge((array) $countArray, (array) $response);
    	
    	$this->send_success($obj_merged);
    }
    
    public function get_operator(){
    	$posted = array_map('strip_tags_deep', $_POST);
    	$mobile=$posted['mobile'];
	$ch = curl_init();
	$timeout = 30; // set to zero for no timeout
	$myurl = "https://joloapi.com/api/findoperator.php?userid=estoor&key=174611741762437&mob=$mobile&type=json";
	curl_setopt ($ch, CURLOPT_URL, $myurl);
	curl_setopt ($ch, CURLOPT_HEADER, 0);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch);
	$curl_error = curl_errno($ch);
	curl_close($ch);
	
	//dump output of api if you want during test
	$this->send_success($file_contents);
    
    }
    
    public function utility_recharge(){
    	$posted = array_map('strip_tags_deep', $_POST);
    	//$this->send_success($posted);
    	// collecting details from html Form
	$mobile=$posted['mobile'];
	
	$optype = $posted['optype'];
	if(!($optype)){
	    $operator=$posted['operator'];
	}
	else{
		if($optype == "prepaid"){
			$operator=$posted['operator-prepaid'];
		}
		elseif($optype == "postpaid"){
			$operator=$posted['operator-postpaid'];
		}
	}
	$amount=$posted['amount'];
	//generating random unique orderid for your reference
	$uniqueorderid = substr(number_format(time() * rand(),0,'',''),0,10);
	//inserting above 4 values in database first
	//run your php query here to store values of user inputs in database
	//now run joloapi.com api link for recharge
	$ch = curl_init();
	$timeout = 100; // set to zero for no timeout
	$myHITurl =
	"http://joloapi.com/api/recharge.php?mode=0&userid=estoor&key=174611741762437&op
	erator=$operator&service=$mobile&amount=$amount&orderid=$uniqueorderid";
	$response = mobileApi($uniqueorderid,$mobile,$operator,$amount);
	$maindata = explode(",", $response);
	$this->send_success($maindata);die;
	
	$this->send_success($file_contents);
	echo"$file_contents";
	// lets extract data from output for display to user and for updating databse
	$maindata = explode(",", $file_contents);
	$countdatas = count($maindata);
	if($countdatas > 2)
	{
	//recharge is success
	$joloapiorderid = $maindata[0]; //it is joloapi.com generated order id
	$txnstatus = $maindata[1]; //it is status of recharge SUCCESS,FAILED
	$operator= $maindata[2]; //operator code
	$service= $maindata[3]; //mobile number
	$amount= $maindata[4]; //amount
	$mywebsiteorderid= $maindata[5]; //your website order id
	$errorcode= $maindata[6]; // api error code
	$operatorid= $maindata[7]; //original operator transaction id
	$myapibalance= $maindata[8]; //my joloapi.com remaining balance
	$myapiprofit= $maindata[9]; //my earning on this recharge
	$txntime= $maindata[10]; // recharge time
	}else{
	//recharge is failed
	$txnstatus = $maindata[0]; //it is status of recharge FAILED
	$errorcode= $maindata[1]; // api error code
	}
	//if curl request timeouts

	if($curl_error=='28'){
	//Request timeout, consider recharge status as pending/success
	$txnstatus = "PENDING";
	}
	//cases
	if($txnstatus=='SUCCESS'){
	//YOUR REST QUERY HERE
	}
	if($txnstatus=='PENDING'){
	//YOUR REST QUERY HERE
	}
	if($txnstatus=='FAILED'){
	//YOUR REST QUERY HERE
	}
	//display the result to customer
	echo"<br/><br/>joloapi order ID: $joloapiorderid";
	echo"<br/>";
	echo"Recharge Status: $txnstatus";
	echo"<br/>";
	echo"Operator: $operator";
	echo"<br/>";
	echo"Number: $service";
	echo"<br/>";
	
	echo"Amount: $amount";
	echo"<br/>";
	echo"MY order id: $mywebsiteorderid";
	echo"<br/>";
	echo"Operator Txn ID: $operatorid";
	echo"<br/>";
	echo"Error No.: $errorcode";
	echo"<br/>";
	
    }
    
    public function get_sub_grades(){
    	$posted = array_map('strip_tags_deep', $_POST);
    	$mode = $posted['mode'];
    	global $wpdb;
        $mydetails = myDetails();
        $selgrdLim = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE EG_Id='$mydetails->EG_Id' AND MOD_Id = '$mode'");
        //$modeResult = $wpdb->get_row("SELECT MOD_Name FROM mode WHERE MOD_Id = '$mode'");
        $this->send_success($selgrdLim);
    }
    
    public function get_mode_name(){
    	$posted = array_map('strip_tags_deep', $_POST);
    	$mode = $posted['mode'];
    	global $wpdb;
        $modeResult = $wpdb->get_row("SELECT MOD_Name FROM mode WHERE MOD_Id = '$mode'");
        $this->send_success($modeResult);
    }

    ///////////////////////////////////////////////////////////////
    ////////  UPDATE FOR CLAIM PRE TRAVEL REQUEST ///////////////////
    ///////////////////////////////////////////////////////////////
    public function pretopost_submit_claims() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);

        $date = $posted['txtDate'];

        $txtaExpdesc = $posted['txtaExpdesc'];

        $selExpcat = $posted['selExpcat'];

        $selModeofTransp = $posted['selModeofTransp'];

        $from = $posted['from'];

        $to = $posted['to'];

        $selStayDur = $posted['selStayDur'];

        $txtCost = $posted['txtCost'];

        $txtAcualCost = $posted['txtAcualCost'];

        $rdids = $posted['rdids'];

        $filename = $posted['filename'];

        $requestcode = $posted['requestcode'];

        $reqid = $posted['reqid'];

        $count = count($rdids);

        $cnt = $posted['actualRdids'];

        $hidrowno = $posted['hidrowno'];

        $etype = 2;


        // CONVERTING TO POST TRAVEL REQUEST 

        $ins = 0;

        $mydetails = myDetails();



        if ($ins) {

            if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
                $repmngrid = $empuserid;
                $repmngrstatus = 2;
                $repmngrapprvrdate = date('Y-m-d h:i:s');

                //notification mail to finance 

                $type = 10;
            } else {
                $repmngrid = 0;
                $repmngrstatus = 1;

                //notification mail to Reporting manager 

                $type = 11;
            }
        } else {

            if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
                $repmngrid = $empuserid;
                $repmngrstatus = 2;
                $repmngrapprvrdate = date('Y-m-d h:i:s');

                //notification mail to finance 

                $type = 12;
            } else {
                $repmngrid = 0;
                $repmngrstatus = 1;
                $repmngrapprvrdate = NULL;

                //notification mail to Reporting manager 

                $type = 13;
            }
        }


        //echo $requestcode.','. $etype.','. $type; exit;
        //---mail function---//
        //notify($requestcode, $etype, $type);
        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
           $approved_email->trigger( $requestcode, $etype, $type );
        }    
    
        $repmngrapprvrdate ? $repmngrapprvrdate = "'$repmngrapprvrdate'" : $repmngrapprvrdate = "NULL";


        if (count($txtAcualCost) == "" && $reqid == "") {
            header("location:$filename?msg=2&reqid=$reqid");
            exit;
        } else {

            // validating Total Cost part

            $validate = 0;

            for ($i = 0; $i < $count; $i++) {
                $cost = trim($txtAcualCost[$i]);

                if ($cost == 0 || $cost == "") {
                    $validate = 1; // some field have been not populated
                    break;
                }
            }

            //echo 'Validate='.$validate;

            if ($validate) {
                header("location:$filename?msg=2&reqid=$reqid");
                exit;
            }



            // validating  new records

            if ($hidrowno != $cnt) {

                for ($i = $cnt; $i < $hidrowno; $i++) {
                    $dateformat = $date[$i];


                    $desc = addslashes($txtaExpdesc[$i]);
                    $cost = trim($txtAcualCost[$i]);

                    // for files we have add +1 to the cnt so that we get the correct fields
                    $k = $i + 1;

                    $files = $_FILES['file' . $k]['name'];


                    $countbills = count($files);


                    if (dateformat == "" || $from[$i] == "" || $desc == "" || $cost == "" || $countbills == "") {

                        $validate = 1; // some field have been not populated
                        break;
                    }
                }

                if ($validate) {

                    header("location:$filename?msg=2&reqid=$reqid");
                    exit;
                }
            }



            // first add the already added request details to the pre travel claim cost and bills	


            for ($i = 0; $i < $count; $i++) {

                $rdid = $rdids[$i];

                if ($selActCost = $wpdb->get_row("SELECT * FROM pre_travel_actual_cost WHERE RD_Id='$rdid' AND PTAC_Status=1")) {

                    $wpdb->update('pre_travel_actual_cost', array('PTAC_Status' => '2', 'PTAC_UpdatedDate' => 'NOW()'), array('RD_Id' => $rdid));
                }

                $cost = trim($txtAcualCost[$i]);

                $wpdb->insert('pre_travel_actual_cost', array('RD_Id' => $rdid, 'PTC_Id' => $ptcid, 'PTAC_Cost' => $txtAcualCost[$i]));


                //file upload 
                $j = $i + 1;
                $files = $_FILES['file' . $j]['name'];
                $countbills = count($files);

                for ($f = 0; $f < $countbills; $f++) {

                    //Get the temp file path
                    $tmpFilePath = $_FILES['file' . $j]['tmp_name'][$f];

                    //echo $tmpFilePath."<br>"; 
                    //Make sure we have a filepath
                    if ($tmpFilePath != "") {
                        //Setup our new file path


                        $ext = substr(strrchr($files[$f], "."), 1); //echo $ext;
                        // generate a random new file name to avoid name conflict
                        // then save the image under the new file name

                        $ext = strtolower($ext);

                        $filePath = md5(rand() * time()) . "." . $ext;

                        $newFilePath = "company/upload/$compid/bills_tickets/";

                        $result = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);

                        //Upload the file into the temp dir
                        if ($result) {

                            $wpdb->insert('pre_travel_actual_bills', array('RD_Id' => $rdid, 'PTC_Id' => $ptcid, 'PTAB_Filename' => $filePath));
                        }
                    }
                }
            }



            // insert those newly added details if any 


            if ($hidrowno != $cnt) {

                for ($i = $cnt; $i < $hidrowno; $i++) {
                    $dateformat = $date[$i];

                    $dateformat = explode("/", $dateformat);
                    $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];


                    if ($to[$i] == "n/a")
                        $to[$i] = "NULL";
                    else
                        $to[$i] = "'" . $to[$i] . "'";

                    if ($selStayDur[$i] == "n/a")
                        $selStayDur[$i] = "NULL";
                    else
                        $selStayDur[$i] = "'" . $selStayDur[$i] . "'";


                    $desc = addslashes($txtaExpdesc[$i]);


                    //if($selreq[REQ_Type]==2 || $selreq[REQ_Type]==3)
                    $txtCost[$i] = $txtAcualCost[$i];


                    $wpdb->insert('request_details', array('RD_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i]));
                    $rdid = $wpdb->insert_id;


                    if ($rdid) {

                        // insert into pre travel claim Total Cost

                        $cost = trim($txtAcualCost[$i]);

                        $wpdb->insert('pre_travel_actual_cost', array('RD_Id' => $rdid, 'PTC_Id' => $ptcid, 'PTAC_Cost' => $txtAcualCost[$i]));

                        //echo 'Cnt='.$cnt; exit;
                        // for files we have add +1 to the cnt so that we get the correct fields
                        $k = $cnt + 1;

                        $files = $_FILES['file' . $k]['name'];


                        $countbills = count($files);


                        for ($f = 0; $f < $countbills; $f++) {
                            //Get the temp file path
                            $tmpFilePath = $_FILES['file' . $k]['tmp_name'][$f];

                            //Make sure we have a filepath
                            if ($tmpFilePath != "") {
                                //Setup our new file path


                                $ext = substr(strrchr($files[$f], "."), 1); //echo $ext;
                                // generate a random new file name to avoid name conflict
                                // then save the image under the new file name

                                $ext = strtolower($ext);



                                $filePath = md5(rand() * time()) . "." . $ext;

                                $newFilePath = "company/upload/$compid/bills_tickets/";

                                $result = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);

                                //Upload the file into the temp dir
                                if ($result) {
                                    $wpdb->insert('pre_travel_actual_bills', array('RD_Id' => $rdid, 'PTC_Id' => $ptcid, 'PTAB_Filename' => $filePath));
                                }
                            }
                        }
                    }
                } // end of for loop
            } // end of outer most if loop
            //IF THE EMPLOYEE HAS EDITED HIS RECORDS FOR CLAIM AGAIN IT SHOULD GO FOR REPORTING MANAGER APPRVL AND FINANCE APPROVAL
            update_query("pre_travel_claim", "PTC_Status=1, PTC_RepMngrEmpid='$repmngrid', PTC_RepMngrStatus='$repmngrstatus', PTC_RepMngrApprovedDate=$repmngrapprvrdate, PTC_RepMngrRejectedDate=NULL, PTC_FinanceEmpid=0, PTC_FinanceStatus=1, PTC_FinanceApprovedDate=NULL, PTC_FinanceRejectedDate=NULL", "REQ_Id='$reqid'", $filename);
            $wpdb->update('pre_travel_claim', array('PTC_Status' => '1', 'PTC_RepMngrEmpid' => $repmngrid, 'PTC_RepMngrStatus' => $repmngrstatus, 'PTC_RepMngrApprovedDate' => $repmngrapprvrdate, 'PTC_RepMngrRejectedDate' => NULL, 'PTC_FinanceEmpid' => '0', 'PTC_FinanceStatus' => '1', 'PTC_FinanceApprovedDate' => NULL, 'PTC_FinanceRejectedDate' => NULL), array('REQ_Id' => $reqid));


            header("location:$filename?msg=1&reqid=$reqid");
            exit;
        }
    }

    public function traveldesk_approve_request() {

        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $tdcid = $posted['tdcid'];
//$this->send_success($tdcid);
        $wpdb->update('travel_desk_claims', array('TDC_Level' => '2'), array('TDC_Id' => $tdcid));

        $response = array('status' => 'success', 'message' => "Claim approved successfully.");
        $this->send_success($response);
        exit;
    }

    public function traveldesk_reject_request() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $tdcid = $posted['tdcid'];

        $wpdb->update('travel_desk_claims', array('TDC_Level' => '3'), array('TDC_Id' => $tdcid));

        $response = array('status' => 'success', 'message' => "Claim rejected successfully.");
        $this->send_success($response);
        exit;
    }

    public function approve_finance_reject() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $reqid = $posted['reqid'];
        $empuserid = $_SESSION['empuserid'];
        $et = $posted['et'];
        $workflow = workflow();
        switch ($et) {
            case 1:
                $expPol = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $expPol = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $expPol = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $expPol = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $expPol = $workflow->COM_Utility_POL_Id;
                break;
        }


        switch ($expPol) {

            // emp --> rep mngr -->finance
            case 1:
            // emp --> finance  --> rep mngr
            case 2:
            //emp -->finance
            case 4:
                $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => '4', 'RS_EmpType' => '2'));


                $wpdb->update('requests', array('REQ_Status' => '3'), array('REQ_Id' => $reqid));

                break;
        }


        $selsql = $wpdb->get_row("SELECT REQ_Code FROM requests where REQ_Id='$reqid' AND REQ_Active=1");

        //mail to employee
        // notify($selsql['REQ_Code'], $selsql['RT_Id'], 7);
        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
           $approved_email->trigger( $selreq->REQ_Code, $selsql->RT_Id, 7 );
        }


        $response = array('status' => 'success', 'message' => "You have successfully Rejected this Expense Request ");
        $this->send_success($response);
        exit;
    }

    public function all_payment_details_create() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $reqid = $posted['reqid'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('y-m-d  h:i:s');
        $empuserid = $_SESSION['empuserid'];
        $selExpType = $posted['selExpenseType'];
        // $this->send_success($posted);die;

        $selPaymentMode = $posted['selPaymentMode'];
        $txtChequeNumber = trim($posted['txtChequeNumber']);
        $txtCqDate = trim($posted['txtCqDate']);
        //$this->send_success($posted);die;
        if ($txtCqDate)
            $txtCqDate = trim($txtCqDate);


        $txtBankBranch = trim($posted['txtBankBranch']);
        $txtaCshComments = trim(addslashes($posted['txtaCshComments']));

        $txtTransId = trim($posted['txtTransId']);
        $txtBankdetails = trim($posted['txtBankdetails']);

        $txtBBDate = trim($posted['txtBBDate']);

        if ($txtBBDate)
            $txtBBDate = trim($txtBBDate);

        $txtaOtherComments = trim(addslashes($posted['txtaOtherComments']));

        //echo $selExpType; exit;

        if ($selPaymentMode == "" && $txtChequeNumber == "" && $txtCqDate == "" && $txtBankBranch == "" && $txtaCshComments == "" && $txtTransId == "" && $txtBankdetails == "" && $txtBBDate == "" && $txtaOtherComments == "") {

            $response = array('status' => 'failure', 'message' => "<strong>OOps!</strong> You missed some fields. ");
            $this->send_success($response);
            exit;
        }
        $header = 0;

        switch ($selPaymentMode) {
            case 1:

                if ($txtChequeNumber == "" || $txtCqDate == "" || $txtBankBranch == "")
                    $header = 1;

                $txtaCshComments = NULL;
                $txtTransId = NULL;
                $txtBankdetails = NULL;
                $txtBBDate = NULL;
                $txtaOtherComments = NULL;
                break;

            case 2:

                $txtChequeNumber = NULL;
                $txtCqDate = NULL;
                $txtBankBranch = NULL;
                $txtTransId = NULL;
                $txtBankdetails = NULL;
                $txtBBDate = NULL;
                $txtaOtherComments = NULL;
                break;

            case 3:

                if ($txtTransId == "" || $txtBankdetails == "" || $txtBBDate == "")
                    $header = 1;

                $txtChequeNumber = NULL;
                $txtCqDate = NULL;
                $txtBankBranch = NULL;
                $txtaCshComments = NULL;
                $txtaOtherComments = NULL;
                break;

            case 4:

                if ($txtaOtherComments == "")
                    $header = 1;

                $txtChequeNumber = NULL;
                $txtCqDate = NULL;
                $txtBankBranch = NULL;
                $txtaCshComments = NULL;
                $txtTransId = NULL;
                $txtBankdetails = NULL;
                $txtBBDate = NULL;
                break;
        }
        if ($header) {

            $response = array('status' => 'failure', 'message' => "<strong>OOps!</strong> You missed some fields. ");
            $this->send_success($response);
            exit;
        } else {

            $txtChequeNumber ? $txtChequeNumber = "$txtChequeNumber" : $txtChequeNumber = "NULL";
            $txtCqDate ? $txtCqDate = "$txtCqDate" : $txtCqDate = "NULL";
            $txtBankBranch ? $txtBankBranch = "$txtBankBranch" : $txtBankBranch = "NULL";
            $txtaCshComments ? $txtaCshComments = "$txtaCshComments" : $txtaCshComments = "NULL";
            $txtTransId ? $txtTransId = "$txtTransId" : $txtTransId = "NULL";
            $txtBankdetails ? $txtBankdetails = "$txtBankdetails" : $txtBankdetails = "NULL";
            $txtBBDate ? $txtBBDate = "$txtBBDate" : $txtBBDate = "NULL";
            $txtaOtherComments ? $txtaOtherComments = "$txtaOtherComments" : $txtaOtherComments = "NULL";

            //echo $reqid; exit;

            $selreq = $wpdb->get_results("SELECT * FROM requests where REQ_Id='$reqid' AND COM_Id='$compid'");


            if ($selrow = $wpdb->get_results("SELECT * FROM payment_details where REQ_Id='$reqid' AND PD_Status=1")) {

                $wpdb->update('payment_details', array('PD_Status' => '2', 'PD_UpdatedByEmpid' => $empuserid, 'PD_UpdatedDate' => $date), array('REQ_Id' => $reqid));

                $wpdb->insert('payment_details', array('REQ_Id' => $reqid, 'PM_Id' => $selPaymentMode, 'PD_ChequeNumber' => $txtChequeNumber, 'PD_ChequeDate' => $txtCqDate, 'PD_ChequeIssuingbb' => $txtBankBranch, 'PD_CashPaymentDetails' => $txtaCshComments, 'PD_BTTransactionId' => $txtTransId, 'PD_BTBankDetails' => $txtBankdetails, 'PD_BTTransferDate' => $txtBBDate, 'PD_OthersPaymentDetails' => $txtaOtherComments, 'PD_AddedByEmpid' => $empuserid));

                $response = array('status' => 'success', 'message' => "Payment details updated successfully");
                $this->send_success($response);
                exit;

                // mail to travel desk
                if ($selreq['REQ_Type'] == 4) {

                    $actionButton = 6;

                    //require("travel-desk-claims-mailbody.php");
                    //travelBooking($mail_mesg, 4);
                    $approved_email = wperp()->emailer->get_email( 'New_Task_Assigned' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->travelBooking( $mail_mesg, 4 );
                        }
                } else {

                    if ($selreq['REQ_Type'] != 5) {

                        // mail to employee
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selreq->REQ_Code, 4, 31 );
                        }
                    }
                }
            } else {

                //$this->send_success($reqid);die;
                $wpdb->insert('payment_details', array('REQ_Id' => $reqid, 'PM_Id' => $selPaymentMode, 'PD_ChequeNumber' => $txtChequeNumber, 'PD_ChequeDate' => $txtCqDate, 'PD_ChequeIssuingbb' => $txtBankBranch, 'PD_CashPaymentDetails' => $txtaCshComments, 'PD_BTTransactionId' => $txtTransId, 'PD_BTBankDetails' => $txtBankdetails, 'PD_BTTransferDate' => $txtBBDate, 'PD_OthersPaymentDetails' => $txtaOtherComments, 'PD_AddedByEmpid' => $empuserid));

                //insert_query("payment_details", "REQ_Id, PM_Id, PD_ChequeNumber, PD_ChequeDate, PD_ChequeIssuingbb, PD_CashPaymentDetails, PD_BTTransactionId, PD_BTBankDetails, PD_BTTransferDate, PD_OthersPaymentDetails, PD_AddedByEmpid", "'$reqid', $selPaymentMode, $txtChequeNumber, $txtCqDate, $txtBankBranch, $txtaCshComments, $txtTransId, $txtBankdetails, $txtBBDate, $txtaOtherComments, '$empuserid'", $filename);
                $wpdb->update('requests', array('REQ_Claim' => '1', 'REQ_ClaimedEmpid' => $empuserid, 'REQ_ClaimDate' => $date), array('REQ_Id' => $reqid));

                // update_query("requests", "REQ_Claim='1', REQ_ClaimedEmpid='$empuserid', REQ_ClaimDate=NOW()", "REQ_Id='$reqid'", $filename);

                $response = array('status' => 'success', 'message' => "Payment details Added successfully");
                $this->send_success($response);
                exit;

                // mail to travel desk
                if ($selreq['REQ_Type'] == 4) {

                    //$actionButton = 7;
                    //require("travel-desk-claims-mailbody.php");
                    //travelBooking($mail_mesg, 5);
                    $approved_email = wperp()->emailer->get_email( 'New_Task_Assigned' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->travelBooking( $mail_mesg, 5 );
                        }
                } else {

                    if ($selreq['REQ_Type'] != 5) {

                        // mail to employee
                        //notify($selreq['REQ_Code'], 4, 23);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selreq->REQ_Code, 4, 23 );
                        }
                    }
                }
            }

            // updatin requests table request status 
            if ($selreq['REQ_Type'] == 4 || $selreq['REQ_Type'] == 2) {
                $wpdb->update('requests', array('REQ_Status' => '2'), array('REQ_Id' => $reqid));
                //update_query("requests", "REQ_Status=2", "REQ_Id='$reqid'", $filename);
            }
        }
    }

    public function payment_details_create() {
        global $wpdb;
        //$posted = array_map('strip_tags_deep', $_POST);

        $posted = array_map('strip_tags_deep', $_POST);
        $tdcid = $posted['tdcid'];

        $empuserid = $_SESSION['empuserid'];

        $selPaymentMode = $posted['selPaymentMode'];
        $reqid = $posted['reqid'];
        //$this->send_success($selPaymentMode);
        $txtChequeNumber = trim($posted['txtChequeNumber']);
        $txtCqDate = trim($posted['txtCqDate']);

        if ($txtCqDate)
            $txtCqDate = trim($txtCqDate);

        $txtBankBranch = trim($posted['txtBankBranch']);
        $txtaCshComments = trim(addslashes($posted['txtaCshComments']));
        $txtTransId = trim($posted['txtTransId']);
        $txtBankdetails = trim($posted['txtBankdetails']);

        $txtBBDate = trim($posted['txtBBDate']);

        if ($txtBBDate)
            $txtBBDate = trim($txtBBDate);

        $txtaOtherComments = trim(addslashes($posted['txtaOtherComments']));

        if ($selPaymentMode == "" && $txtChequeNumber == "" && $txtCqDate == "" && $txtBankBranch == "" && $txtaCshComments == "" && $txtTransId == "" && $txtBankdetails == "" && $txtBBDate == "" && $txtaOtherComments == "") {

            $response = array('status' => 'failure', 'message' => "<strong>OOps!</strong> You missed some fields. ");
            $this->send_success($response);
            exit;
        }

        $header = 0;
        //$this->send_success($selPaymentMode);
        switch ($selPaymentMode) {

            case 1:

                if ($txtChequeNumber == "" || $txtBankBranch == "")
                    $header = 1;
                // $this->send_success($txtCqDate);
                $txtaCshComments = NULL;
                $txtTransId = NULL;
                $txtBankdetails = NULL;
                $txtBBDate = NULL;
                $txtaOtherComments = NULL;
                break;

            case 2:

                $txtChequeNumber = NULL;
                $txtCqDate = NULL;
                $txtBankBranch = NULL;
                $txtTransId = NULL;
                $txtBankdetails = NULL;
                $txtBBDate = NULL;
                $txtaOtherComments = NULL;
                break;

            case 3:

                if ($txtTransId == "" || $txtBankdetails == "" || $txtBBDate == "")
                    $header = 1;

                $txtChequeNumber = NULL;
                $txtCqDate = NULL;
                $txtBankBranch = NULL;
                $txtaCshComments = NULL;
                $txtaOtherComments = NULL;
                break;

            case 4:

                if ($txtaOtherComments == "")
                    $header = 1;

                $txtChequeNumber = NULL;
                $txtCqDate = NULL;
                $txtBankBranch = NULL;
                $txtaCshComments = NULL;
                $txtTransId = NULL;
                $txtBankdetails = NULL;
                $txtBBDate = NULL;
                break;
        }

        if ($header) {
            $response = array('status' => 'failure', 'message' => "<strong>OOps!</strong> You missed some fields. ");
            $this->send_success($response);
            exit;
        } else {
            $txtChequeNumber ? $txtChequeNumber = "$txtChequeNumber" : $txtChequeNumber = "NULL";
            $txtCqDate ? $txtCqDate = "$txtCqDate" : $txtCqDate = "NULL";
            $txtBankBranch ? $txtBankBranch = "$txtBankBranch" : $txtBankBranch = "NULL";
            $txtaCshComments ? $txtaCshComments = "$txtaCshComments" : $txtaCshComments = "NULL";
            $txtTransId ? $txtTransId = "$txtTransId" : $txtTransId = "NULL";
            $txtBankdetails ? $txtBankdetails = "$txtBankdetails" : $txtBankdetails = "NULL";
            $txtBBDate ? $txtBBDate = "$txtBBDate" : $txtBBDate = "NULL";
            $txtaOtherComments ? $txtaOtherComments = "$txtaOtherComments" : $txtaOtherComments = "NULL";


            if ($selrow = $wpdb->get_results("SELECT * FROM travel_desk_claim_payments Where TDC_Id=$tdcid AND TDCP_Status=1")) {
                //$this->send_success($selrow);
                $wpdb->update('travel_desk_claim_payments', array('TDCP_Status' => 2, 'TDCP_UpdatedByEmpid' => $empuserid, 'TDCP_UpdatedDate' => 'NOW()'), array('TDC_Id' => $tdcid, 'TDCP_Status' => '1'));

                $wpdb->insert('travel_desk_claim_payments', array('TDC_Id' => $tdcid, 'PM_Id' => $selPaymentMode, 'TDCP_ChequeNumber' => $txtChequeNumber, 'TDCP_ChequeDate' => $txtCqDate, 'TDCP_ChequeIssuingbb' => $txtBankBranch, 'TDCP_CashPaymentDetails' => $txtaCshComments, 'TDCP_BTTransactionId' => $txtTransId, 'TDCP_BTBankDetails' => $txtBankdetails, 'TDCP_BTTransferDate' => $txtBBDate, 'TDCP_OthersPaymentDetails' => $txtaOtherComments, 'TDCP_AddedByEmpid' => $empuserid));

                $response = array('status' => 'success', 'message' => "Payment details updated successfully");
                $this->send_success($response);
                exit;
                // updated
                //travelDeskClaims($tdcid, 2);
                $approved_email = wperp()->emailer->get_email( 'New_Task_Assigned' );
                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   $approved_email->travelDeskClaims( $tdcid, 2 );
                }
            } else {
		$wpdb->update('requests', array('REQ_Claim' => '1', 'REQ_ClaimedEmpid' => $empuserid, 'REQ_ClaimDate' => $date), array('REQ_Id' => $reqid));

                $wpdb->insert('travel_desk_claim_payments', array('TDC_Id' => $tdcid, 'PM_Id' => $selPaymentMode, 'TDCP_ChequeNumber' => $txtChequeNumber, 'TDCP_ChequeDate' => $txtCqDate, 'TDCP_ChequeIssuingbb' => $txtBankBranch, 'TDCP_CashPaymentDetails' => $txtaCshComments, 'TDCP_BTTransactionId' => $txtTransId, 'TDCP_BTBankDetails' => $txtBankdetails, 'TDCP_BTTransferDate' => $txtBBDate, 'TDCP_OthersPaymentDetails' => $txtaOtherComments, 'TDCP_AddedByEmpid' => $empuserid));
		
                $wpdb->update('travel_desk_claims', array('TDC_Status' => 2), array('TDC_Status' => 1, 'TDC_Id' => $tdcid));
                $response = array('status' => 'success', 'message' => "Payment details added successfully");
                $this->send_success($response);
                exit;
                //$msg = 7;
                // first time inserted 
                //travelDeskClaims($tdcid, 1);
                $approved_email = wperp()->emailer->get_email( 'New_Task_Assigned' );
                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   $approved_email->travelDeskClaims( $tdcid, 1 );
                }
            }
        }
    }
    
    public function get_project_codes(){
    	global $wpdb;
    	$posted = array_map('strip_tags_deep', $_POST);
    	$ProjectCode = $posted['ProjectCode'];
    	$CostCenter = $posted['CostCenter'];
    	$result = $wpdb->get_results("SELECT * FROM project_code WHERE CC_Id = '$CostCenter' AND PC_Active=1");
    	//$costcenter_budget = $wpdb->get_row("SELECT PC_Budget FROM project_code WHERE CC_Id = '$CostCenter'");
    	//$reqId = $wpdb->get_row("SELECT REQ_Id FROM requests WHERE PC_Id = '$ProjectCode'");
    	//$project_budget = $wpdb->get_row("SELECT SUM(RD_Cost) as PC_Budget FROM request_details WHERE PC_Id = '$ProjectCode'");
    	//$project_budget = $project_budget->PC_Budget;
    	//$costcenter_budget = $costcenter_budget->PC_Budget;
    	//$dicrease = $costcenter_budget - $project_budget;
    	//$res = $dicrease/$costcenter_budget;
    	//$result = $res*100;
    	$this->send_success($result);
    }
    
    function create_delegate(){
        global $wpdb;
        $empuserid = $_SESSION['empuserid'];
        $compid = $_SESSION['compid'];
        $posted = array_map( 'strip_tags_deep', $_POST );
        
        $selRepmanagers		=	$posted['selRepmanagers'];
	
	$txtDelegatedatefrom	=	trim($posted['txtDelegatedatefrom']);
	
	//11/22/2014 - 11/22/2014
	
	$txtDelegatedateto	=	trim($posted['txtDelegatedateto']);
	
	$fromdate			=	date("Y-m-d", strtotime($txtDelegatedatefrom));
	
	$todate				=	date("Y-m-d", strtotime($txtDelegatedateto));
	
	$txtaDelcomments	=	trim(addslashes($posted['txtaDelcomments']));
	
	$curdate	= date('Y-m-d');
	
	$fromd	=	strtotime($fromdate);
	
	$curd	=	strtotime($curdate);
	
	//echo $fromd.'--'.$curd;exit;
	
	if($fromd < $curd)
	{
		//header("location:$filename?msg=5");exit;
                $response = array('status'=>'notice','message'=>"Please choose a day greater than today.");
                $this->send_success($response);
	}
		
	
	if($selRepmanagers=="" && $fromdate=="" && $todate=="" && $txtaDelcomments=="")
	{
		//header("location:$filename?msg=1");exit;
                $response = array('status'=>'failure','message'=>"<strong>OOps!</strong> Some fields went missing. Please enable javascript in your browser and try again");
                $this->send_success($response);
	}
	else
	{	
		if($seldupval=$wpdb->get_row("SELECT * FROM delegate WHERE DLG_FromEmpid='$empuserid' AND DLG_Status=1 AND DLG_Active=1"))
		{
			//header("location:$filename?msg=2");exit;
                        $response = array('status'=>'info','message'=>"You have already delegated.");
                        $this->send_success($response);
		}
		else
		{
			$wpdb->insert( 'delegate', array( 'COM_Id' => $compid, 'DLG_FromEmpid' => $empuserid, 'DLG_ToEmpid' => $selRepmanagers, 'DLG_Comments' => $txtaDelcomments, 'DLG_FromDate' => $fromdate, 'DLG_ToDate' => $todate ));
			
			//header("location:$filename?msg=3");exit;
                        $response = array('status'=>'success','message'=>"Delegate successfull.");
                        $this->send_success($response);
	
		}
	}
    }

    function edit_delegate() {
        global $wpdb;
        $empuserid = $_SESSION['empuserid'];
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);

        $dlgid = $posted['dlgid'];

        $selRepmanagers = $posted['selRepmanagers'];

        $txtDelegatedatefrom = trim($posted['txtDelegatedatefrom']);

        //11/22/2014 - 11/22/2014

        $txtDelegatedateto = trim($posted['txtDelegatedateto']);

        $fromdate = date("Y-m-d", strtotime($txtDelegatedatefrom));

        $todate = date("Y-m-d", strtotime($txtDelegatedateto));

        $txtaDelcomments = trim(addslashes($posted['txtaDelcomments']));

        $curdate = date('Y-m-d');

        $fromd = strtotime($fromdate);

        $curd = strtotime($curdate);

        //echo $fromd.'--'.$curd;exit;

        if ($fromd < $curd) {
            //header("location:$filename?msg=5");exit;
            $response = array('status' => 'notice', 'message' => "Please choose a day greater than today.");
            $this->send_success($response);
        }


        if ($selRepmanagers == "" && $fromdate == "" && $todate == "" && $txtaDelcomments == "") {
            //header("location:$filename?msg=1");exit;
            $response = array('status' => 'failure', 'message' => "<strong>OOps!</strong> Some fields went missing. Please enable javascript in your browser and try again");
            $this->send_success($response);
        } else {
            $wpdb->update('delegate', array('DLG_Active' => 2), array('DLG_Id' => $dlgid));

            $lastid = $wpdb->insert('delegate', array('COM_Id' => $compid, 'DLG_FromEmpid' => $empuserid, 'DLG_ToEmpid' => $selRepmanagers, 'DLG_Comments' => $txtaDelcomments, 'DLG_FromDate' => $fromdate, 'DLG_ToDate' => $todate));

            //header("location:$filename?msg=3");exit;
            $response = array('status' => 'success', 'message' => "Delegation updated successfully");
            $this->send_success($response);
        }
    }

    function delete_files() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $rfid = $posted['rfid'];
        if ($rfid) {
            $update = $wpdb->update('requests_files', array('RF_Status' => 9, 'RF_UpdatedDate' => "NOW()"), array('RF_Id' => $rfid, 'RF_Status' => 1));
            $this->send_success(1);
        } else {
            $this->send_success(0);
        }
    }

    function get_file_extensions() {
        global $wpdb;
        $rowsql = $wpdb->get_results("SELECT * FROM file_extensions");
        foreach ($rowsql as $values) {
            $fileextensions.= $values->FE_Name . ",";
        }
        $fileextensions = rtrim($fileextensions, ",");
        $fileextensions = explode(',', $fileextensions);
        $this->send_success($fileextensions);
    }

    function get_mileage() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $modeid = $posted['modeid'];
        if ($modeid && ($modeid == 31 || $modeid == 32) && is_numeric($modeid)) {
            //$this->send_success($modeid);
            $selamnt = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' AND MOD_Id='$modeid' AND MIL_Status=1 AND MIL_Active=1");
            $this->send_success($selamnt->MIL_Amount);
        }
    }

    function reject_request_finance() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);

        $empuserid = $_SESSION['empuserid'];
        $et = $posted['et'];

        $reqid = $posted['req_id'];
        $workflow = workflow();
        switch ($et) {
            case 1:
                $expPol = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $expPol = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $expPol = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $expPol = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $expPol = $workflow->COM_Utility_POL_Id;
                break;
        }


        switch ($expPol) {

            // emp --> rep mngr -->finance
            case 1:
            // emp --> finance  --> rep mngr
            case 2:
            //emp -->finance
            case 4:
                $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 4, 'RS_EmpType' => 2));

                $wpdb->update('requests', array('REQ_Status' => 3), array('REQ_Id' => $reqid));

                break;
        }


        $selsql = $wpdb->get_row("SELECT REQ_Code FROM requests WHERE REQ_Id='$reqid' AND REQ_Active=1");

        //mail to employee
        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 7);
        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
           $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 7);
        }

        $response = array('status' => 'success', 'message' => "Request Rejected Successfully");
        $this->send_success($response);
        //header("location:$filename?msg=6&reqid=$reqid");exit;
    }

    function reject_request_approver() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);

        //$empuserid = $_SESSION['empuserid'];
        $et = $posted['et'];

        $reqid = $posted['req_id'];

        $selsql = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.RE_Status=1");
        $empuserid = $selsql->EMP_Id;
        $workflow = workflow();

        switch ($et) {
            case 1:
                $expPol = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $expPol = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $expPol = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $expPol = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $expPol = $workflow->COM_Utility_POL_Id;
                break;
        }


        switch ($expPol) {

            // emp --> rep mngr -->finance
            case 1:
            // emp --> finance  --> rep mngr
            case 2:
            // emp --> rep mngr
            case 3:

                $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 4, 'RS_EmpType' => 1));

                $wpdb->update('requests', array('REQ_Status' => 3), array('REQ_Id' => $reqid));

                break;
        }

        //mail to employee
        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 7);
        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
           $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 7);
        }
//		if($_SESSION['delegate']){
//			
//			// checking if i'm the reporting manager
//			
//			$selemps=$wpdb->get_row("SELECT EMP_Reprtnmngrcode FROM employees WHERE EMP_Id='$empuserid'");
//			
//			if($selemps->EMP_Reprtnmngrcode != $emp_code) // if not then insert this action into db
//			{
//				$selrepmngid=select_query("employees", "EMP_Id", "EMP_Code='$selemps[EMP_Reprtnmngrcode]'", $filename);
//				
//				insert_query("delegate_actions", "COM_Id, DA_FromEmpid, DA_ToEmpid, REQ_Id, EMP_Id, DA_Actions", "'$compid', '$selrepmngid[EMP_Id]', '$empuserid', '$reqid', '$empid', 1", $filename);
//			}			
//		}
        $response = array('status' => 'success', 'message' => "Request Rejected Successfully");
        $this->send_success($response);
        //header("location:$filename?msg=6&reqid=$reqid");exit;
    }
    
    function approve_preclaim(){
    
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
    	$empuserid = $_SESSION['empuserid'];
    	$reqid = $posted['req_id'];
    	
    	
    	
    	
    	if($wpdb->query("UPDATE pre_travel_claim SET PTC_RepMngrEmpid = $empuserid,PTC_RepMngrStatus = 2,PTC_RepMngrApprovedDate = NOW(),PTC_RepMngrRejectedDate = NULL WHERE REQ_Id='$reqid'")){
    	
    	$selreq = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND RE_Status=1");
	
	$empid=$selreq->EMP_Id;
	
	
	//rep mngr appv claim
	
	//notify($selreq['REQ_Code'], 1, 14);
	$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
       $approved_email->trigger( $selreq->REQ_Code, 1, 14 );
    }
	
	// send mail to employee
	
	//notify($selreq['REQ_Code'], 1, 15);
	$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
       $approved_email->trigger( $selreq->REQ_Code, 1, 15 );
    }
	
	
	if($_SESSION['delegate']){
			
			// checking if i'm the reporting manager
			
			$selemps=$wpdb->get_row("SELECT EMP_Reprtnmngrcode FROM employees WHERE EMP_Id='$empuserid'");
			
			if($selemps->EMP_Reprtnmngrcode != $emp_code) // if not then insert this action into db
			{
			
				$selrepmngid=$wpdb->get_row("SELECT EMP_Id FROM employees WHERE EMP_Code='$selemps->EMP_Reprtnmngrcode'");
				
				$wpdb->insert('delegate_actions', array('COM_Id' => $compid, 'DA_FromEmpid' => $selrepmngid->EMP_Id, 'DA_ToEmpid' => $empuserid, 'REQ_Id' => $reqid, 'EMP_Id' => $empid, 'DA_Actions' => '1'));
				
			}			
		}
		
	
	//successfully approved this claim
	$response = array('status' => 'success', 'message' => "Request Approved Successfully");
        $this->send_success($response);
	
	}else{
	
	//some error has occured
	$response = array('status' => 'failure', 'message' => "Some Error occured");
        $this->send_success($response);
	
	}
    
    }
    
    function reject_preclaim() {
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
    	$empuserid = $_SESSION['empuserid'];
    	$reqid = $posted['req_id'];
    	
    	if($wpdb->query("UPDATE pre_travel_claim SET PTC_RepMngrEmpid = $empuserid,PTC_RepMngrStatus = 9,PTC_RepMngrApprovedDate = NULL,PTC_RepMngrRejectedDate = NOW() WHERE REQ_Id='$reqid'") ){
    	
	$selreq = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND RE_Status=1");
	
	$empid=$selreq->EMP_Id;
	
	//rep mngr rej claim
	
	//notify($selreq['REQ_Code'], 1, 16);
	$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
       $approved_email->trigger( $selreq->REQ_Code, 1, 16 );
    }
	
	if($_SESSION['delegate']){
			
			// checking if i'm the reporting manager
			
			$selemps=$wpdb->get_row("SELECT EMP_Reprtnmngrcode FROM employees WHERE EMP_Id='$empuserid'");
			
			if($selemps->EMP_Reprtnmngrcode != $emp_code) // if not then insert this action into db
			{
			
				$selrepmngid=$wpdb->get_row("SELECT EMP_Id FROM employees WHERE EMP_Code='$selemps->EMP_Reprtnmngrcode'");
				
				$wpdb->insert('delegate_actions', array('COM_Id' => $compid, 'DA_FromEmpid' => $selrepmngid->EMP_Id, 'DA_ToEmpid' => $empuserid, 'REQ_Id' => $reqid, 'EMP_Id' => $empid, 'DA_Actions' => '4'));
				
			}			
		}
	
	
	//successfully approved this claim
	$response = array('status' => 'success', 'message' => "Request Rejected Successfully");
        $this->send_success($response);
	
	}else{
	
	//some error has occured
	$response = array('status' => 'failure', 'message' => "Some Error occured");
        $this->send_success($response);
	
	}
    }
    
    function approve_acclaim(){
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
    	$reqid = $posted['req_id'];
    	$empid = $posted['emp_id'];
    	$empuserid = $_SESSION['empuserid'];
    	$selreq = $wpdb->get_row("SELECT * FROM requests WHERE REQ_Id='$reqid' AND COM_Id='$compid'");
    	
    	if($empid) //the request person is the reporting manager himself
	{
    	 
    	$wpdb->query("UPDATE pre_travel_claim SET PTC_Status=2,PTC_RepMngrEmpid = $empid,PTC_RepMngrStatus = 2,PTC_RepMngrApprovedDate = NOW(),PTC_RepMngrRejectedDate = NULL,PTC_FinanceEmpid=$empuserid, PTC_FinanceStatus=2, PTC_FinanceApprovedDate=NOW(), PTC_FinanceRejectedDate=NULL WHERE REQ_Id='$reqid'");
    	
    	}
	
	else
	{
		$wpdb->query("UPDATE pre_travel_claim SET PTC_Status=2,PTC_FinanceEmpid = $empuserid,PTC_FinanceStatus = 2,PTC_FinanceApprovedDate = NOW(),PTC_FinanceRejectedDate = NULL WHERE REQ_Id='$reqid'"); 
		
		
	}
		
	// mail to employee
	
	//notify($selreq['REQ_Code'], 1, 17);
	$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
       $approved_email->trigger( $selreq->REQ_Code, 1, 17 );
    }
	
	//successfully approved this claim
	$response = array('status' => 'success', 'message' => "Request Approved Successfully");
        $this->send_success($response);
	

    
    }
    
    function reject_acclaim() {
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
    	$reqid = $posted['req_id'];
    	$empid = $posted['emp_id'];
    	$empuserid = $_SESSION['empuserid'];
    	$selreq = $wpdb->get_row("SELECT * FROM requests WHERE REQ_Id='$reqid' AND COM_Id='$compid'");
    	
	
	if($wpdb->query("UPDATE pre_travel_claim SET PTC_FinanceEmpid = $empuserid,PTC_FinanceStatus = 9,PTC_FinanceApprovedDate = NULL,PTC_FinanceRejectedDate = NOW() WHERE REQ_Id='$reqid'")){
		
	//set the request rejected
	$wpdb->update('pre_travel_claim', array('PTC_Status' => 3), array('REQ_Id' => $reqid));
	
	// mail to employee
	
	//notify($selreq['REQ_Code'], 1, 18);
	$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
       $approved_email->trigger( $selreq->REQ_Code, 1, 18 );
    }
	
	$response = array('status' => 'success', 'message' => "Request Rejected Successfully");
        $this->send_success($response);
		
	}
	
    }

    function approve_request() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //$this->send_success($posted);return false;
        $empuserid = $_SESSION['empuserid'];
        $et = $posted['et'];
        if (isset($posted['req_id_table'])) {
            $reqid = $posted['req_id_table'];
        } else {
            $reqid = $posted['req_id'];
        }

        $request = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.RE_Status=1");
        //$empid = $request->EMP_Id;
        $rowpol = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
        $polId = $rowpol->POL_Id;
        $workflow = workflow();
		if($request->REQ_PreToPostStatus){
			$et = "1";
		}
        switch ($et) {
            case 1:
                //pre travel
                $expPol = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                //post travel
                $expPol = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                //other travel
                $expPol = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                //mileage
                $expPol = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                //utility
                $expPol = $workflow->COM_Utility_POL_Id;
                break;
        }
        switch ($expPol) {
            // emp --> rep mngr -->finance

            case 1:

                if ($polId == 5) {
                    $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 5));
                    // mail to employee
                    //notify($request['REQ_Code'], $request['RT_Id'], 3);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   	$approved_email->trigger( $request->REQ_Code, $request->RT_Id, 3 );
                    }
                    // mail to accounts
                    //notify($request['REQ_Code'], $request['RT_Id'], 4);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   	$approved_email->trigger( $request->REQ_Code, $request->RT_Id, 4 );
                    }
                    $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                    $this->send_success($response);
                } else {
                    $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 1));

                    // mail to employee
                    //notify($request['REQ_Code'], $request['RT_Id'], 3);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   	$approved_email->trigger( $request->REQ_Code, $request->RT_Id, 3 );
                    }
                    // mail to accounts
                    //notify($request['REQ_Code'], $request['RT_Id'], 4);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   	$approved_email->trigger( $request->REQ_Code, $request->RT_Id, 4 );
                    }
                }
                break;
            // emp --> finance --> rep mngr

            case 2:

                // check finance approval

                if ($rowfin = $wpdb->get_row("SELECT RS_Id FROM request_status WHERE REQ_Id='$reqid' and REQ_Status=2 and RS_EmpType=2 and RS_Status=1")) {
                    if ($polId == 5) {
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 5));
                    } else {
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 1));
                    }

                    if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Status=2, REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                    }

                    // mail to employee
                    //notify($request['REQ_Code'], $request['RT_Id'], 6);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                    if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   	$approved_email->trigger( $request->REQ_Code, $request->RT_Id, 6 );
                    }
                } else {

                    //header("location:$filename?msg=11&reqid=$reqid"); exit;
                }

                break;
            // emp --> rep mngr

            case 3:
                if ($polId == 5) {
					if (!$request->REQ_PreToPostStatus) {
                    $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 5));
					}
					else{
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'REQ_Status' => 2, 'EMP_Id' => $empuserid, 'RS_EmpType' => 5));
						$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
						break;
					}
                    //$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                    if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_PreToPostStatus=1, REQ_Status=2, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                    }
					break;
                    if ($request[REQ_Type] == 5) {

                        // mail to employee
                        //notify($request['REQ_Code'], $request['RT_Id'], 24, $empid);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 24, $empid);
	                }
                        // mail to travel desk
                        //notify($request['REQ_Code'], $request['RT_Id'], 25, $empid);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 25, $empid);
	                }
                    } else {

                        // mail to employee
                        //notify($request['REQ_Code'], $request['RT_Id'], 24);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 24 );
	                }
                    }
                } else {
                    $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 1));

                    $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                    if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_PreToPostStatus=1, REQ_Status=2, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                    }

                    if ($request->REQ_Type == 3) {

                        // mail to employee
                        //notify($request['REQ_Code'], $request['RT_Id'], 24, $empid);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 24, $empid);
	                }
                        // mail to travel desk
                        //notify($request['REQ_Code'], $request['RT_Id'], 25, $empid);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 25, $empid);
	                }
                    } else {

                        // mail to employee
                        //notify($request['REQ_Code'], $request['RT_Id'], 24);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 24);
	                }
                    }
                }

                break;
            // emp --> rep mngr
            case 4:
                if ($polId == 5) {
                    $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 5));
                    // mail to employee
                    //notify($request['REQ_Code'], $request['RT_Id'], 3);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 3);
	                }
                    // mail to accounts
                    //notify($request['REQ_Code'], $request['RT_Id'], 4);
                    $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
	                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
	                   $approved_email->trigger( $request->REQ_Code, $request->RT_Id, 4);
	                }
                }
                break;
        }
        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
        $this->send_success($response);
    }

    function get_seat_layout() {
        $posted = array_map('strip_tags_deep', $_POST);
        $response = getBusSeatLayout($posted);
        $this->send_success($response);
    }
    
    function get_quote() {
        $posted = array_map('strip_tags_deep', $_POST);
		$compid = $_SESSION['compid'];
		global $wpdb;
        //$this->send_success($posted);
        $itrn = $posted['iteration'];

        $exptype = $posted['mode'];

        $stay = $posted['stay'];
        
        $selection = $posted['selection'];
		
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$selection' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
		foreach($selrgquote as $rowrgquote){ 
			if($rowrgquote->RG_Pref==2)
				$bookingcost = $rowrgquote->GQF_Price;
		
		} 
        //$cmpdetails	= companyDet("COM_Flight, COM_Bus, COM_Hotel");

        $alert = 0;

        //switch ($exptype){
        //case 'Flight':
        //if(!$cmpdetails->COM_Flight){
        // $alert=1;}
        //break;
        //case 'Bus':
        //if(!$cmpdetails->COM_Bus){
        //$alert=1;}
        // break;
        //case 'Hotel':
        //if(!$cmpdetails->COM_Hotel){
        //$alert=1;}
        //break;
        //}
//        if($alert){
//
//	echo '<div class="alert alert-warning text-center">Get Quote Feature is not available. Please contact your Administrator for details.</div>';
//	echo '<div class=text-center style="color:green; font-size:10;"><i class="fa fa-info"></i> This feature enable you to get live quote for major Airlines, Bus and Hotel rates...</div>';
//	exit;
//        }

        $from = $posted['from'];

        if (strpos($from, ', ')) {

            $fromExpld = explode(", ", $from);

            $from = $fromExpld[1];
        }

        //echo 'From='.$from."<br>"; 

        if (!$from)
            $from = "BLR";

        $to = $posted['to'];

        if (strpos($to, ', ')) {

            $toExpld = explode(", ", $to);

            $to = $toExpld[1];
        }

        //echo 'To='.$to."<br>"; 

        if (!$to)
            $to = "DEL";

        $expdate = $posted['expdate'];

        if (!$expdate)
            $expdate = date("Y-m-d");

        //$fldname = $posted['fld'];

        $sessid = time();

        switch ($exptype) {

            case 'Flight':
				
                $resp = getFlight($posted, $exptype, $selection);
				$rowtl=$wpdb->get_row("Select * FROM tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
				if(!empty($rowtl)){
				  if($rowtl->TL_Percentage){
					$percentage = $rowtl->TL_Percentage;
					$cal = $bookingcost*$percentage/100;
					$perAmount = $bookingcost+$cal;
					//if($amnt>$perAmount){
						//header('Location: '.$_SERVER['REQUEST_URI'].'&status=tolerance');exit; 
					//}
					$tAmount = array('tAmount' => $perAmount);
					$result = array('quoteResult' => $resp);
					$quoteResult = (object) array_merge((array) $tAmount, (array) $result);
					
				}}
				else{
					$result = array('quoteResult' => $resp);
					$quoteResult = (object) array_merge((array) $tAmount, (array) $result);
				}
				$this->send_success($quoteResult);
                break;


            case 'Bus':
                //require("getBus.php");
                //$this->send_success("test");
                //function doIt($getBus) {
                //$quoteResult = getBus($posted,$exptype);                        
                //}
                //add_action(getBus($posted,$exptype), 'my_callback');
                $resp = getBus($posted, $exptype, $selection);
				$rowtl=$wpdb->get_row("Select * FROM tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
				if(!empty($rowtl)){
				  if($rowtl->TL_Percentage){
					$percentage = $rowtl->TL_Percentage;
					$cal = $bookingcost*$percentage/100;
					$perAmount = $bookingcost+$cal;
					//if($amnt>$perAmount){
						//header('Location: '.$_SERVER['REQUEST_URI'].'&status=tolerance');exit; 
					//}
					$tAmount = array('tAmount' => $perAmount);
					$result = array('quoteResult' => $resp);
					$quoteResult = (object) array_merge((array) $tAmount, (array) $result);
					
				}}
				else{
					$result = array('quoteResult' => $resp);
					$quoteResult = (object) array_merge((array) $tAmount, (array) $result);
				}
                $this->send_success($quoteResult);

                break;


            case 'Hotel':

                //require("getHotels.php");
		$quoteResult = getHotel($posted, $exptype, $selection);
                //$sessid='1441880731';

                break;
        }
        //function my_callback() {
        $this->send_success($quoteResult);
        //}
    }

    function auto_search_bus() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $searchTerm = $posted['q'];
        //get matched data from skills table
        $res = $wpdb->get_results("SELECT * FROM bus_locations WHERE Loc_Name LIKE '%" . $searchTerm . "%' ORDER BY Loc_Name ASC");
        foreach ($res as $results) {
            $data[] = $results->Loc_Name;
        }
        //return json data
        //$this->send_success(json_encode($data));
        $this->send_success($data);
    }

    function auto_search_flight() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $searchTerm = $posted['q'];
        //get matched data from skills table
        $res = $wpdb->get_results("SELECT cityName,cityCode FROM airports WHERE cityName LIKE '%" . $searchTerm . "%' ORDER BY cityName ASC");
        foreach ($res as $results) {
            $data[] = $results->cityName . ", " . $results->cityCode;
        }
        $this->send_success($data);
    }
    
    function auto_search_hotel() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $searchTerm = $posted['q'];
        $tablename = 'hotels_goibibo'; 
        //$url = "http://pp.goibibobusiness.com/api/hotels/b2b/get_city_list/";
        //$res = httpGet($url);
        //$res = json_decode($res, true);
        //$res = $res['data'];
        //print_r($res);die;
        //foreach ($res as $key => $value) {
             //$hotel_data = array(
	        //'HotelId' => $key,
	        //'cityName' => $value['city_name'],
	        //'countryName' => $value['country_name'],
	        //'countryCode' => $value['country_code'],
	     //);
	     //$hoteldata = $wpdb->insert($tablename, $hotel_data);        
	    //$data[] = $value['city_name'] . ", " . $value['country_name'] . "-" . $value['country_code'];
	//}
	//get matched data from skills table
        $res = $wpdb->get_results("SELECT cityName,countryName FROM $tablename WHERE cityName LIKE '%" . $searchTerm . "%' ORDER BY cityName ASC");
        foreach ($res as $results) {
            $data[] = $results->cityName . "-" . $results->countryName;
        }
        $this->send_success($data);
    }

    function approve_finance_request() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $et = $_POST['et'];
        $reqid = $_POST['reqid'];
        $travel = $_POST['travel'];
        $posted = array_map('strip_tags_deep', $_POST);
        $workflow = workflow();
        // $this->send_success($posted);die;
        $rowpol = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
        $polId = $rowpol->POL_Id;
		
        $selsql = $wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND req.COM_Id='$compid' AND RE_Status=1");
        $workflow = workflow();
        switch ($et) {
            case 1:
                //pre travel
                $expPol = $workflow->COM_Pretrv_POL_Id;
                break;
            case 2:
                //post travel
                $expPol = $workflow->COM_Posttrv_POL_Id;
                break;
            case 3:
                //other travel
                $expPol = $workflow->COM_Othertrv_POL_Id;
                break;
            case 5:
                //mileage
                $expPol = $workflow->COM_Mileage_POL_Id;
                break;
            case 6:
                //utility
                $expPol = $workflow->COM_Utility_POL_Id;
                break;
        }
        switch ($expPol) {
            // emp --> rep mngr -->finance

            case 1:
                if ($polId == 5) {
                    // check whether 2nd level mangr has approved it or not

                    if ($secLevmngr = $wpdb->get_row("SELECT RS_Id FROM request_status WHERE REQ_Id='$reqid' and REQ_Status=2 and RS_EmpType=5 and RS_Status=1")) {

                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
			if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Status=2, REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
			}

                        //mail to employee
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 6);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 6 );
                        }
                        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                        $this->send_success($response);
                    } else {

                        //header("location:$filename?msg=10&reqid=$reqid"); exit;
                    }
                } else {
                    // check whether rep mangr has approved it or not

                    if ($rowRepmngr = $wpdb->get_row("SELECT RS_Id FROM request_status WHERE REQ_Id='$reqid' and REQ_Status=2 and RS_EmpType=1 and RS_Status=1")) {

                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
			if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Status=2, REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
			}

                        //mail to employee
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 6);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 6 );
                        }
                        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                        $this->send_success($response);
                    } else {

                        //header("location:$filename?msg=10&reqid=$reqid"); exit;
                    }
                }
                break;



            // emp --> finance

            case 4:
                $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
		if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Status=2, REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
		}
                //mail to employee
                //notify($selsql['REQ_Code'], $selsql['RT_Id'], 6);
                $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                   $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 6 );
                }

                break;



            // emp --> finance --> rep mngr

            case 2:

                $empid = $selsql->EMP_Id;

                $empcode = $selsql->EMP_Code;

                if ($polId == 5) {
                    // select second level manager

                    $selrepmngrid = $wpdb->get_row("SELECT EMP_Id FROM employees WHERE EMP_Code='$selsql->EMP_Funcrepmngrcode'");
                    $secmngid = $selrepmngrid->EMP_Id;
                    if ($secmngid == $empid) {
                        //mail to employee
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 8);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 8 );
                        }
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 5));
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
			if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Status=2, REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                        }
                        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                        $this->send_success($response);
                    } else {
                        //mail to employee
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 9);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 9 );
                        }
                        // MAIL TO REPORTING MANAGER
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 2, $selsql[EMP_Id]);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 6, $selsql->EMP_Id );
                        }
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
                        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                        $this->send_success($response);
                    }
                } else {
                    // select reporting manager 
                    $selrepmngrid = $wpdb->get_row("SELECT EMP_Id FROM employees WHERE EMP_Code='$selsql->EMP_Reprtnmngrcode'");
                    $repmngid = $selrepmngrid->EMP_Id;
                    if ($repmngid == $empid) {
                        //mail to employee
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 8);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 8 );
                        }
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 1));
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
			if ($et == "1") {
                        //$wpdb->update('requests', array('REQ_Status' => 2, 'RT_Id' => 2, 'REQ_PreToPostStatus' => true), array('REQ_Id' => $reqid));
                        if ($selreq = $wpdb->get_row("SELECT REQ_PreToPostStatus, REQ_Type, REQ_Code FROM requests WHERE REQ_Id='$reqid'")) {
                            if (!$selreq->REQ_PreToPostStatus) {

                                if ($selreq->REQ_Type == 2 || $selreq->REQ_Type == 3) {


                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Active=1, REQ_Status=2, REQ_DraftUpdatedDate=NOW(), REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid' AND RT_Id=1 AND REQ_Type IN (2,3)");
                                } else {

                                    $wpdb->query("UPDATE requests SET RT_Id=2, REQ_Status=2, REQ_PreToPostStatus=1, REQ_PreToPostDate=NOW() WHERE REQ_Id='$reqid'");
                                }
                            }
                        }
                    } else {
                        $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
                        }
                        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                        $this->send_success($response);
                    } else {
                        //mail to employee
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 9);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $selsql->REQ_Code, $selsql->RT_Id, 9 );
                        }
                        // MAIL TO REPORTING MANAGER
                        //notify($selsql['REQ_Code'], $selsql['RT_Id'], 2, $selsql[EMP_Id]);
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2));
                        $response = array('status' => 'success', 'message' => "Request Approved Successfully");
                        $this->send_success($response);
                    }
                }
                break;
        }

        $response = array('status' => 'success', 'message' => "You have successfully Approved this  Expense Request");
        $this->send_success($response);
        exit;
    }
    
    function send_prepost_edit() {
    	
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //$this->send_success($posted);

        //$expenseLimit = $posted['expenseLimit'];

        $etype = $posted['ectype'];
		
		$file = $posted['file'];
		
        $expreqcode = genExpreqcode($etype);

        $date = $posted['txtDate'];

        $txtStartDate = $posted['txtStartDate'];

        $txtEndDate = $posted['txtEndDate'];

        $txtaExpdesc = $posted['txtaExpdesc'];

        $selExpcat = $posted['selExpcat'];

        $selModeofTransp = $posted['selModeofTransp'];

        $from = $posted['from'];

        $to = $posted['to'];

        //$hidrowno = $_POST['hidrowno'];

        $selStayDur = $posted['selStayDur'];
        
        $hotelcheckout = $posted['dateTohotel'];

        $txtdist = $posted['txtdist'];

        $txtCost = $posted['txtCost'];
	
	    $hidrowno = count($txtCost);
	
        $rdids = $_POST['rdids'];
		
		$freturn = $posted['flightReturn'];

        $reqid = $_POST['reqid'];
        
        $pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
        
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";

        //  QUOTATION 
        $sessionid				=	$posted['sessionid'];
        $hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
        $hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
        $selProjectCode			=	$posted['selProjectCode'];
        //$selProjectCode = "0";
        //$selCostCenter = "0";
        $selCostCenter			=	$posted['selCostCenter'];
	//print_r($posted);die;
        $textBillNo = $posted['textBillNo'];
        
        $otherexpenses = $posted['other_expenses'];
        $otherdescription = $posted['otherdescription'];
        $txtDateother = $posted['txtDateother']; 
	    $otherstatus = $posted['otherstatus'];
	    $ordid = $posted['ordid'];
	
        $count = count($rdids);

        $cnt = count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));

        $selreq = $wpdb->get_row("SELECT req.REQ_Code FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' and req.REQ_Id=re.REQ_Id AND RE_Status=1 AND REQ_Active=1 and re.EMP_Id='$empuserid'");

        $expreqcode = $selreq->REQ_Code;

        if ($etype == "" || $reqid == "" || $expreqcode == "") {
            $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
            $this->send_success($response);
        } else {

            $checked = false;
		
            for ($i = 0; $i < $count; $i++):

		$curdate = strtotime(date('d-m-Y'));
		$mydate = strtotime($date[$i]);
		/*if($curdate < $mydate)
		{
		    $response = array('status' => 'failure', 'message' => "Cannot Submit the Request Before Travel Date instead You can save and Submit Later");
                    $this->send_success($response);
		}*/
                //if ($date[$i] == "" || $txtaExpdesc[$i] == "" || $selExpcat[$i] == "" || $selModeofTransp[$i] == "" || $txtdist[$i] == "" || $textBillNo[$i] == "" || $txtCost[$i] == "" || $txtStartDate[$i] == "" || $txtEndDate[$i] == "") {
		if ($date[$i] == "" || $selExpcat[$i] == "" || $selModeofTransp[$i] == "" || $txtCost[$i] == "") {
                    $checked = true;

                    break;
                }
            endfor;
		


            if ($checked) {
                $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
                $this->send_success($response);
                
            }
        }
		
		// check for grade limit
		$expenseLimit = 0;
		if($etype==1)
		{		
		
			for($i=0;$i<$hidrowno;$i++)
			{		
				$returnValue=getGradeLimit($selModeofTransp[$i], $empuserid, $filename);
				$returnVal=explode("###",$returnValue);
				
				
				if($txtCost[$i] > $returnVal[0] && $returnVal[0]!=0){
					$expenseLimit = 1;
				}
				
			}
		}
		
        // updating project code if set 
          $selprocod=$wpdb->get_row("SELECT PC_Id, costCenter_Id FROM requests WHERE REQ_Id='$reqid'");

       if($selprocod->PC_Id != $selProjectCode){
       
           $wpdb->update('requests', array('PC_Id' => $selProjectCode), array('REQ_Id' => $reqid));
             //update_query("requests", "PC_Id='$selProjectCode'", "REQ_Id='$reqid'", $filename, 0);

		}

        if($selprocod->costCenter_Id != $selCostCenter){
        
                    $wpdb->update('requests', array('costCenter_Id' => $selCostCenter), array('REQ_Id' => $reqid));
                //update_query("requests", "CC_Id='$selCostCenter'", "REQ_Id='$reqid'", $filename, 0);

        }

        for ($i = 0; $i < $cnt; $i++) {
            if ($date[$i] == "n/a") {

                $dateformat = NULL;
            } else {

                $dateformat = $date[$i];
                $dateformat = explode("-", $dateformat);
                $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                //$this->send_success($dateformat);
            }


            if ($txtStartDate[$i] == "n/a") {

                $startdate = NULL;
            } else {

                $startdate = $txtStartDate[$i];
                $startdate = explode("-", $startdate);
                $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
            }

            if ($txtEndDate[$i] == "n/a") {

                $enddate = NULL;
            } else {

                $enddate = $txtEndDate[$i];
                $enddate = explode("-", $enddate);
                $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
            }



            if ($to[$i] == "n/a")
                $to[$i] = NULL;

            if ($selStayDur[$i] == "n/a")
                $selStayDur[$i] = NULL;

            if ($txtdist[$i] == "n/a")
                $txtdist[$i] = NULL;


            $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

            $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

            $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

            $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
			
			$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL"; 
            //$selStayDur=NULL;

            if ($etype == 5) {

                $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                $rate = $selmilrate->MIL_Amount;

                if ($rate && $txtdist[$i])
                    $txtCost[$i] = $rate * trim($txtdist[$i], "'");
            }
            
			$tmpFilePath = $file[$i];

	    if($hotelcheckout[$i]!="NULL"){
		    $hotelcheckout=$hotelcheckout[$i];
		    $hotelcheckout=explode("-",$hotelcheckout);
		    $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
	    }

            $rate = "NULL";


            $rdid = $rdids[$i];

            $desc = addslashes($txtaExpdesc[$i]);
			
			if($freturn[$i] != "NULL"){
			$freturndate=$freturn[$i];
			$freturndate=explode("-",$freturndate);
			$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
			}
			if($freturn[$i] != "NULL")
				$wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturndate, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
			else
			    $wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));

            if($selExpcat[$i] == "3"){
			$wpdb->update('requests_files', array('RF_Name'=>$tmpFilePath), array('RD_Id'=>$rdid));
            }
            // update get quote details
					
			$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
			$size = count($explodeValCount);
			
			if($size>1){
			   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
			   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
			   $hiddenPrefrdSelectedr = array_map(
					function (array $a){
						return implode(',', $a);
					},
					array_chunk(
						explode(',', $hiddenPrefrdSelected[$i]),
						1
					)
			   );
			   $hiddenAllPreferedr = array_map(
					function (array $a){
						return implode(',', $a);
					},
					array_chunk(
						explode(',', $hiddenAllPrefered[$i]),
						3
					)
				);
				//print_r($hiddenPrefrdSelected);
				//print_r($hiddenAllPrefered);die;
			   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
			   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
			   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
				//$countExpldVal	=	count($explodeVal);
				$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
				 
				if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
						//print_r($hiddenPrefrdSelected);
						
						foreach($explodeVal as $gqfid){
								
								$pref=1;
								if($gqfid==$hiddenPrefrdSelectedr[0])
								$pref=2;  
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
						}


				}else {
					//echo '2'; exit;
				$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
				
				}
				if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
						//print_r($hiddenPrefrdSelected);
						
						foreach($explodeValr as $gqfid){
								
								$pref=1;
								if($gqfid==$hiddenPrefrdSelectedr[1])
								$pref=2;  
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
						}


				}else {
					//echo '2'; exit;
				$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
				
				}
			}
			else{
				$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
			
				//$countExpldVal	=	count($explodeVal);
				
				//echo 'here='.$sessionid[$i]. '&&' .$hiddenPrefrdSelected[$i]. '&&' .$hiddenAllPrefered[$i]; exit;
				
				if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
					
					//echo '1'; exit;
					$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
					
					foreach($explodeVal as $gqfid){
					
						$pref=1;
						
						if($gqfid==$hiddenPrefrdSelected[$i])
						$pref=2;
						$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
						
						
					}
					
				
				} else {
					//echo '2'; exit;
				$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
				
				}
			}
				
		}
        
        // insert those newly added row details if any 
        if ($hidrowno != $cnt) {

            for ($i = $cnt; $i < $hidrowno; $i++) {
				
				if($selExpcat[$i] == "3" && $file[$i] == ""){
					$response = array('status' => 'failure', 'message' => "Please Upload Receipt for Other Expenses");
					$this->send_success($response);
				}

                //echo 'hidrow='.$hidrowno." cnt=".$cnt; exit;			

                if ($date[$i] == "n/a") {

                    $dateformat = NULL;
                } else {

                    $dateformat = $date[$i];
                    $dateformat = explode("-", $dateformat);
                    $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                }


                if ($txtStartDate[$i] == "n/a") {

                    $startdate = NULL;
                } else {

                    $startdate = $txtStartDate[$i];
                    $startdate = explode("-", $startdate);
                    $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
                }


                if ($txtEndDate[$i] == "n/a") {

                    $enddate = NULL;
                } else {

                    $enddate = $txtEndDate[$i];
                    $enddate = explode("-", $enddate);
                    $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
                }

                if ($to[$i] == "n/a")
                    $to[$i] = NULL;

                if ($selStayDur[$i] == "n/a")
                    $selStayDur[$i] = NULL;

                if ($txtdist[$i] == "n/a")
                    $txtdist[$i] = NULL;


                $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

                $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

                $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

                $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
				
				$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL"; 				


                $desc = addslashes($txtaExpdesc[$i]);


                $rate = 0;
                
                if($hotelcheckout[$i]!="NULL"){
		    $hotelcheckout=$hotelcheckout[$i];
		    $hotelcheckout=explode("-",$hotelcheckout);
		    $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
		}

                // select mileage rate

                if ($etype == 5) {

                    $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                    $rate = $selmilrate->MIL_Amount;

                    if ($rate && $txtdist[$i])
                        $txtCost[$i] = $rate * trim($txtdist[$i], "'");
                }
                $from[$i] ? $from[$i] = "" . $from[$i] . "" : $from[$i] = " ";
				if($freturn[$i] != "NULL"){
				$freturndate=$freturn[$i];
				$freturndate=explode("-",$freturndate);
				$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
				}
				if($freturn[$i] != "NULL")
					$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturndate, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]));
				else
					$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]));
                $rdid = $wpdb->insert_id;
                // GET QUOTATION 
                $explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
				$size = count($explodeValCount);
				if($size>1){
				   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
				   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
				   $hiddenPrefrdSelectedr = array_map(
						function (array $a){
							return implode(',', $a);
						},
						array_chunk(
							explode(',', $hiddenPrefrdSelected[$i]),
							1
						)
				   );
				   $hiddenAllPreferedr = array_map(
						function (array $a){
							return implode(',', $a);
						},
						array_chunk(
							explode(',', $hiddenAllPrefered[$i]),
							3
						)
					);
					//print_r($hiddenPrefrdSelected);
					//print_r($hiddenAllPrefered);die;
				   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
				   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
				   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
					//$countExpldVal	=	count($explodeVal);
					
					 
					if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
							//print_r($hiddenPrefrdSelected);
							foreach($explodeVal as $gqfid){
									
									$pref=1;
									if($gqfid==$hiddenPrefrdSelectedr[0])
									$pref=2;  
									$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
									
							}


					}
					if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
							//print_r($hiddenPrefrdSelected);
							foreach($explodeValr as $gqfid){
									
									$pref=1;
									if($gqfid==$hiddenPrefrdSelectedr[1])
									$pref=2;  
									$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
									
							}


					}
				}
				else{
		
				$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
//print_r($explodeVal);
				//$countExpldVal	=	count($explodeVal);
				//print_r($explodeVal);    
				if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
						//print_r($hiddenPrefrdSelected);
						foreach($explodeVal as $gqfid){
								
								$pref=1;
								if($gqfid==$hiddenPrefrdSelected[$i])
								$pref=2;  
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
						}


				}
				
				}
								$tmpFilePath = $file[$i];
						  
								if($selExpcat[$i] == "3"){
									$wpdb->insert('requests_files', array('RD_Id' => $rdid, 'RF_Name' => $tmpFilePath));
									$lastinsertid = $wpdb->insert_id;
								}
	
            //console.log($response); // end of for loop
        } // end of outer most if loop
        // update new details

        $wpdb->update('request_status', array('RS_Status' => '2'), array('REQ_Id' => $reqid));

        $wpdb->update('requests', array('REQ_Status' => '1'), array('REQ_Id' => $reqid));

        //echo 'reqtype='.$reqtype; exit;

        /* if($reqtype){ */
        $workflow = workflow();
        switch ($etype) {
            case 1:
                $polid = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $polid = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $polid = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $polid = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $polid = $workflow->COM_Utility_POL_Id;
                break;
        }

        // Retrieving my details
        $mydetails = myDetails();
		
        switch ($polid) {
            //-------- employee -->  rep mngr  -->  finance
            case 1:
				if ($expenseLimit > 0) {
					//-------- employee -->  2nd level manager  -->  finance
                   if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                    {
						$wpdb->update('requests', array('POL_Id' => '8'), array('REQ_Id' => $reqid));
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
				}
				else{
					if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
						//mail to accounts
						//notify($expreqcode, $etype, 1);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 1 );
						}
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
					} else {
						//mail to reporting manager
						//notify($expreqcode, $etype, 2);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 2 );
						}
					}
				}

                break;




            //  employee --> rep mngr 
            case 3:
				if ($expenseLimit > 0) {
					if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_Status' => '1'));

						$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						
						$wpdb->update('request_status', array('EMP_Id' => $empuserid, 'REQ_Status' => 3, 'RS_Status' => '1', 'RS_EmpType' => 3), array('REQ_Id' => $reqid));
					}
				}
				else{
					if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
						// mail to himself saying that he can make the journey
						//notify($expreqcode, $etype, 19);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 19 );
						}
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));

						$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
					} else {
						//mail to reporting manager
						//notify($expreqcode, $etype, 2);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 2 );
						}
						
					}
				}
				
                break;

            //--------- employee --> finance --> rep mngr
            case 2:
				if ($expenseLimit > 0) {
					$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
				}
				else{
					if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
						//mail to finance
						//notify($expreqcode, $etype, 1);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 1 );
						}
					} else {
						//mail to finance
						//notify($expreqcode, $etype, 20);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 20 );
						}
					}
				}
                break;


            //--------- employee  --> finance
            case 4:
				if ($expenseLimit > 0) {
					//-------- employee -->  2nd level manager  -->  finance
                    if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					
				}
				else{
					//mail to finance
					//notify($expreqcode, $etype, 20);
					$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 20 );
						}
				}

                break;
        }


        /* } */
	/*
        if ($etype == 2) {
            header("location:/wp-admin/admin.php?page=Post-travel-edit&reqid=$reqid&status=success&msg=You have successfully Updated Post Travel Request");
            exit;
        } else if ($etype == 5) {
            header("location:/wp-admin/admin.php?page=edit-mileage&reqid=$reqid&status=success&msg=You have successfully Mileage Request");
            exit;
        } else if ($etype == 6) {
            header("location:/wp-admin/admin.php?page=edit-utility&reqid=$reqid&status=success&msg=You have successfully Utility Request");
            exit;
        } else if ($etype == 3) {
            header("location:/wp-admin/admin.php?page=edit-others&reqid=$reqid&status=success&msg=You have successfully Updated Other Expenses Request");
            exit;
        }*/
		if($status = $wpdb->get_row("SELECT * FROM save_status WHERE REQ_Id = '$reqid'"))
			$wpdb->query( "DELETE FROM save_status WHERE REQ_Id IN($reqid)" );
        $response = array('status' => 'success', 'message' => "You have successfully update this Request");
        $this->send_success($response);
    }
	// Experimental Functioanlity
	
	$wpdb->update('request_status', array('RS_Status' => '2'), array('REQ_Id' => $reqid));

        $wpdb->update('requests', array('REQ_Status' => '1'), array('REQ_Id' => $reqid));

        //echo 'reqtype='.$reqtype; exit;

        /* if($reqtype){ */
        $workflow = workflow();
        switch ($etype) {
            case 1:
                $polid = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $polid = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $polid = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $polid = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $polid = $workflow->COM_Utility_POL_Id;
                break;
        }
        // Retrieving my details
        $mydetails = myDetails();
        switch ($polid) {
            //-------- employee -->  rep mngr  -->  finance
            case 1:
				if ($expenseLimit > 0) {
					//-------- employee -->  2nd level manager  -->  finance
                   if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                    {
						$wpdb->update('requests', array('POL_Id' => '8'), array('REQ_Id' => $reqid));
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
				}
				else{
					$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
				}

                break;




            //  employee --> rep mngr 
            case 3:
				if ($expenseLimit > 0) {
					if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_Status' => '1'));

						$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						
						$wpdb->update('request_status', array('EMP_Id' => $empuserid, 'REQ_Status' => 3, 'RS_Status' => '1', 'RS_EmpType' => 3), array('REQ_Id' => $reqid));
					}
				}
				else{
					//$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
				}
				
                break;

            //--------- employee --> finance --> rep mngr
            case 2:
				if ($expenseLimit > 0) {
					$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
				}
				else{
					$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
				}
                break;


            //--------- employee  --> finance
            case 4:
				if ($expenseLimit > 0) {
					//-------- employee -->  2nd level manager  -->  finance
                    if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					
				}
				else{
					$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
				}

                break;
        }
	
	// Experimental Functionality
	
	
		$wpdb->update('request_status', array('RS_Status' => '2'), array('REQ_Id' => $reqid));

        $wpdb->update('requests', array('REQ_Status' => '1'), array('REQ_Id' => $reqid));

        //echo 'reqtype='.$reqtype; exit;

        /* if($reqtype){ */
        $workflow = workflow();
        switch ($etype) {
            case 1:
                $polid = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $polid = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $polid = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $polid = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $polid = $workflow->COM_Utility_POL_Id;
                break;
        }

        // Retrieving my details
        $mydetails = myDetails();
		
        switch ($polid) {
            //-------- employee -->  rep mngr  -->  finance
            case 1:
				if ($expenseLimit > 0) {
					//-------- employee -->  2nd level manager  -->  finance
                   if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                    {
						$wpdb->update('requests', array('POL_Id' => '8'), array('REQ_Id' => $reqid));
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
				}
				else{
					if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
						//mail to accounts
						//notify($expreqcode, $etype, 1);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 1 );
						}
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
					} else {
						//mail to reporting manager
						//notify($expreqcode, $etype, 2);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 2 );
						}
					}
				}

                break;




            //  employee --> rep mngr 
            case 3:
				if ($expenseLimit > 0) {
					if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_Status' => '1'));

						$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						
						$wpdb->update('request_status', array('EMP_Id' => $empuserid, 'REQ_Status' => 3, 'RS_Status' => '1', 'RS_EmpType' => 3), array('REQ_Id' => $reqid));
					}
				}
				else{
					if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
						// mail to himself saying that he can make the journey
						//notify($expreqcode, $etype, 19);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 19 );
						}
						// insert into request_status
						$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));

						$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
					} else {
						//mail to reporting manager
						//notify($expreqcode, $etype, 2);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 2 );
						}
						
					}
				}
				
                break;

            //--------- employee --> finance --> rep mngr
            case 2:
				if ($expenseLimit > 0) {
					$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
				}
				else{
					if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
						//mail to finance
						//notify($expreqcode, $etype, 1);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 1 );
						}
					} else {
						//mail to finance
						//notify($expreqcode, $etype, 20);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 20 );
						}
					}
				}
                break;


            //--------- employee  --> finance
            case 4:
				if ($expenseLimit > 0) {
					//-------- employee -->  2nd level manager  -->  finance
                    if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					
				}
				else{
					//mail to finance
					//notify($expreqcode, $etype, 20);
					$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
		
						if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
						   $approved_email->trigger( $expreqcode, $etype, 20 );
						}
				}

                break;
        }
		if($status = $wpdb->get_row("SELECT * FROM save_status WHERE REQ_Id = '$reqid'"))
			$wpdb->query( "DELETE FROM save_status WHERE REQ_Id IN($reqid)" );
    	$response = array('status' => 'success', 'message' => "You have successfully update this Request");
        $this->send_success($response);
    
    }
    
    function send_prepost_save() {
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //$this->send_success($posted);
		//print_r($posted);die;
        //$expenseLimit = $posted['expenseLimit'];

        $etype = $posted['ectype'];
		$file = $posted['file'];
        $expreqcode = genExpreqcode($etype);

        $date = $posted['txtDate'];

        $txtStartDate = $posted['txtStartDate'];

        $txtEndDate = $posted['txtEndDate'];

        $txtaExpdesc = $posted['txtaExpdesc'];

        $selExpcat = $posted['selExpcat'];

        $selModeofTransp = $posted['selModeofTransp'];

        $from = $posted['from'];

        $to = $posted['to'];

        //$hidrowno = $_POST['hidrowno'];

        $selStayDur = $posted['selStayDur'];
        
        $hotelcheckout = $posted['dateTohotel'];

        $txtdist = $posted['txtdist'];

        $txtCost = $posted['txtCost'];
	
	    $hidrowno = count($txtCost);
	
        $rdids = $_POST['rdids'];
		
		$freturn = $posted['flightReturn'];

        $reqid = $_POST['reqid'];
        
        $pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
                
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                        
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";

        //  QUOTATION 
        $sessionid				=	$posted['sessionid'];
        $hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
        $hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
        $selProjectCode			=	$posted['selProjectCode'];
        //$selProjectCode = "0";
        //$selCostCenter = "0";
        $selCostCenter			=	$posted['selCostCenter'];
		//print_r($posted);
        $textBillNo = $posted['textBillNo'];
        $saveStatus = false;
        $otherexpenses = $posted['other_expenses'];
        $othercost = $posted['other_cost'];
        $otherdescription = $posted['otherdescription'];
        $txtDateother = $posted['txtDateother']; 
	    $otherstatus = $posted['otherstatus'];
	    $ordid = $posted['ordid'];
        $count = count($rdids);

        $cnt = count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));
		$reqstatusdetails = $wpdb->get_results("SELECT EC_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1");
		$countprevRequests = 0;
		foreach ($reqstatusdetails as $value){
			if($value->EC_Id == "1" || $value->EC_Id == "2"){
				$countprevRequests++;
			}
		}
        $selreq = $wpdb->get_row("SELECT req.REQ_Code FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' and req.REQ_Id=re.REQ_Id AND RE_Status=1 AND REQ_Active=1 and re.EMP_Id='$empuserid'");

        $expreqcode = $selreq->REQ_Code;
		
		//echo "addedrow->" . $hidrowno . "oldrow->" . $cnt;
		$countRequests = 0;
		for($i=0;$i<$hidrowno;$i++){
			if($selExpcat[$i] == "1" || $selExpcat[$i] == "2"){
				$countRequests++;
			}
		}
		if($countprevRequests != $countRequests){
			$saveStatus = true;
		}
		
        if ($etype == "" || $reqid == "" || $expreqcode == "") {
            $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
            $this->send_success($response);
        } else {

            $checked = false;

            for ($i = 0; $i < $count; $i++):


                //if ($date[$i] == "" || $txtaExpdesc[$i] == "" || $selExpcat[$i] == "" || $selModeofTransp[$i] == "" || $txtdist[$i] == "" || $textBillNo[$i] == "" || $txtCost[$i] == "" || $txtStartDate[$i] == "" || $txtEndDate[$i] == "") {
		if ($date[$i] == "" || $selExpcat[$i] == "" || $selModeofTransp[$i] == "" || $txtCost[$i] == "") {
                    $checked = true;

                    break;
                }
            endfor;



            if ($checked) {
                $response = array('status' => 'failure', 'message' => "Some fields went missing. Please try again");
                $this->send_success($response);
                
            }
        }
		
		// check for grade limit
		$expenseLimit = 0;
		if($etype==1)
		{		
		
			for($i=0;$i<$hidrowno;$i++)
			{		
				$returnValue=getGradeLimit($selModeofTransp[$i], $empuserid, $filename);
				$returnVal=explode("###",$returnValue);
				
				
				if($txtCost[$i] > $returnVal[0] && $returnVal[0]!=0){
					$expenseLimit = 1;
				}
				
			}
		}
		
        // updating project code if set 
          $selprocod=$wpdb->get_row("SELECT PC_Id, costCenter_Id FROM requests WHERE REQ_Id='$reqid'");

       if($selprocod->PC_Id != $selProjectCode){
       
           $wpdb->update('requests', array('PC_Id' => $selProjectCode), array('REQ_Id' => $reqid));
             //update_query("requests", "PC_Id='$selProjectCode'", "REQ_Id='$reqid'", $filename, 0);

     }

        if($selprocod->costCenter_Id != $selCostCenter){
        
                    $wpdb->update('requests', array('costCenter_Id' => $selCostCenter), array('REQ_Id' => $reqid));
                //update_query("requests", "CC_Id='$selCostCenter'", "REQ_Id='$reqid'", $filename, 0);

        }

        for ($i = 0; $i < $cnt; $i++) {
            if ($date[$i] == "n/a") {

                $dateformat = NULL;
            } else {

                $dateformat = $date[$i];
                $dateformat = explode("-", $dateformat);
                $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                //$this->send_success($dateformat);
            }


            if ($txtStartDate[$i] == "n/a") {

                $startdate = NULL;
            } else {

                $startdate = $txtStartDate[$i];
                $startdate = explode("-", $startdate);
                $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
            }

            if ($txtEndDate[$i] == "n/a") {

                $enddate = NULL;
            } else {

                $enddate = $txtEndDate[$i];
                $enddate = explode("-", $enddate);
                $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
            }



            if ($to[$i] == "n/a")
                $to[$i] = NULL;

            if ($selStayDur[$i] == "n/a")
                $selStayDur[$i] = NULL;

            if ($txtdist[$i] == "n/a")
                $txtdist[$i] = NULL;


            $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

            $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

            $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

            $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
			
			$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL"; 
            //$selStayDur=NULL;

            if ($etype == 5) {

                $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                $rate = $selmilrate->MIL_Amount;

                if ($rate && $txtdist[$i])
                    $txtCost[$i] = $rate * trim($txtdist[$i], "'");
            }
           
			$tmpFilePath = $file[$i];
                      
	    if($hotelcheckout[$i]!="NULL"){
		    $hotelcheckout=$hotelcheckout[$i];
			$hotelcheckout=explode("-",$hotelcheckout);	
			$hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
	    }

            $rate = "NULL";


            $rdid = $rdids[$i];

            $desc = addslashes($txtaExpdesc[$i]);
			
			if($freturn[$i] != "NULL"){
			$freturndate=$freturn[$i];
			$freturndate=explode("-",$freturndate);
			$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
			}
			if($freturn[$i] != "NULL")
			$wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturndate, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
			else
            $wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
            if($selExpcat[$i] == "3"){
				//$wpdb->insert('requests_files', array('RD_Id' => $rdid, 'RF_Name' => $tmpFilePath));
				$wpdb->update('requests_files', array('RF_Name'=>$tmpFilePath), array('RD_Id'=>$rdid));
				//$lastinsertid = $wpdb->insert_id;
			}
            
            // update get quote details
					
					$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                    $size = count($explodeValCount);
					
					if($size>1){
					   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
					   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
					   $hiddenPrefrdSelectedr = array_map(
							function (array $a){
								return implode(',', $a);
							},
							array_chunk(
								explode(',', $hiddenPrefrdSelected[$i]),
								1
							)
					   );
					   $hiddenAllPreferedr = array_map(
							function (array $a){
								return implode(',', $a);
							},
							array_chunk(
								explode(',', $hiddenAllPrefered[$i]),
								3
							)
						);
						//print_r($hiddenPrefrdSelected);
						//print_r($hiddenAllPrefered);die;
					   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
					   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
					   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
						//$countExpldVal	=	count($explodeVal);
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						 
						if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
								//print_r($hiddenPrefrdSelected);
								
								foreach($explodeVal as $gqfid){
										
										$pref=1;
										if($gqfid==$hiddenPrefrdSelectedr[0])
										$pref=2;  
										$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
										
								}


						}else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
						if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
								//print_r($hiddenPrefrdSelected);
								
								foreach($explodeValr as $gqfid){
										
										$pref=1;
										if($gqfid==$hiddenPrefrdSelectedr[1])
										$pref=2;  
										$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
										
								}


						}else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
					}
					else{
						$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
					
						//$countExpldVal	=	count($explodeVal);
						
						//echo 'here='.$sessionid[$i]. '&&' .$hiddenPrefrdSelected[$i]. '&&' .$hiddenAllPrefered[$i]; exit;
						
						if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
							
							//echo '1'; exit;
							$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
							
							foreach($explodeVal as $gqfid){
							
								$pref=1;
								
								if($gqfid==$hiddenPrefrdSelected[$i])
								$pref=2;
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
								
							}
							
						
						} else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
					}
				
				}
        // insert those newly added row details if any
        if ($hidrowno != $cnt) {
            for ($i = $cnt; $i < $hidrowno; $i++) {
				
				if($selExpcat[$i] == "3" && $file[$i] == ""){
					$response = array('status' => 'failure', 'message' => "Please Upload Receipt for Other Expenses");
					$this->send_success($response);
				}

                //echo 'hidrow='.$hidrowno." cnt=".$cnt; exit;			

                if ($date[$i] == "n/a") {

                    $dateformat = NULL;
                } else {

                    $dateformat = $date[$i];
                    $dateformat = explode("-", $dateformat);
                    $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                }


                if ($txtStartDate[$i] == "n/a") {

                    $startdate = NULL;
                } else {

                    $startdate = $txtStartDate[$i];
                    $startdate = explode("-", $startdate);
                    $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
                }


                if ($txtEndDate[$i] == "n/a") {

                    $enddate = NULL;
                } else {

                    $enddate = $txtEndDate[$i];
                    $enddate = explode("-", $enddate);
                    $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
                }

                if ($to[$i] == "n/a")
                    $to[$i] = NULL;

                if ($selStayDur[$i] == "n/a")
                    $selStayDur[$i] = NULL;

                if ($txtdist[$i] == "n/a")
                    $txtdist[$i] = NULL;


                $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

                $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

                $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

                $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
				
				$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL"; 


                $desc = addslashes($txtaExpdesc[$i]);


                $rate = 0;
                
                if($hotelcheckout[$i]!="NULL"){
		    $hotelcheckout=$hotelcheckout[$i];
		    $hotelcheckout=explode("-",$hotelcheckout);
		    $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
		}

                // select mileage rate

                if ($etype == 5) {

                    $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                    $rate = $selmilrate->MIL_Amount;

                    if ($rate && $txtdist[$i])
                        $txtCost[$i] = $rate * trim($txtdist[$i], "'");
                }
                $from[$i] ? $from[$i] = "" . $from[$i] . "" : $from[$i] = " ";
				if($freturn[$i] != "NULL"){
				$freturndate=$freturn[$i];
				$freturndate=explode("-",$freturndate);
				$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
				}
				if($freturn[$i] != "NULL")
				$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturndate, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]));
				else
                $wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]));
                $rdid = $wpdb->insert_id;
                // GET QUOTATION 
                $explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
				$size = count($explodeValCount);
				if($size>1){
				   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
				   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
				   $hiddenPrefrdSelectedr = array_map(
						function (array $a){
							return implode(',', $a);
						},
						array_chunk(
							explode(',', $hiddenPrefrdSelected[$i]),
							1
						)
				   );
				   $hiddenAllPreferedr = array_map(
						function (array $a){
							return implode(',', $a);
						},
						array_chunk(
							explode(',', $hiddenAllPrefered[$i]),
							3
						)
					);
					//print_r($hiddenPrefrdSelected);
					//print_r($hiddenAllPrefered);die;
				   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
				   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
				   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
					//$countExpldVal	=	count($explodeVal);
					
					 
					if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
							//print_r($hiddenPrefrdSelected);
							foreach($explodeVal as $gqfid){
									
									$pref=1;
									if($gqfid==$hiddenPrefrdSelectedr[0])
									$pref=2;  
									$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
									
							}


					}
					if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
							//print_r($hiddenPrefrdSelected);
							foreach($explodeValr as $gqfid){
									
									$pref=1;
									if($gqfid==$hiddenPrefrdSelectedr[1])
									$pref=2;  
									$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
									
							}


					}
				}
				else{
		
				$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
	//print_r($explodeVal);
				//$countExpldVal	=	count($explodeVal);
				//print_r($explodeVal);    
				if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
						//print_r($hiddenPrefrdSelected);
						foreach($explodeVal as $gqfid){
								
								$pref=1;
								if($gqfid==$hiddenPrefrdSelected[$i])
								$pref=2;  
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
						}


				}
				
				}
						$tmpFilePath = $file[$i];
                        
						if($selExpcat[$i] == "3"){
							$wpdb->insert('requests_files', array('RD_Id' => $rdid, 'RF_Name' => $tmpFilePath));
							$lastinsertid = $wpdb->insert_id;
						}
            //console.log($response); // end of for loop
        } // end of outer most if loop
		if ($expenseLimit > 0) {
		$wpdb->update('requests', array('Limit' => '1'), array('REQ_Id' => $reqid));
		}
		if($saveStatus){
			if(!$status = $wpdb->get_row("SELECT * FROM save_status WHERE REQ_Id = '$reqid'"))
			$wpdb->insert( 'save_status', array( 'REQ_Id' => $reqid, 'Status' => 1));
		}
        $response = array('status' => 'success', 'message' => "You have successfully Saved this Request");
        $this->send_success($response);
    }
	if($saveStatus){
		if(!$status = $wpdb->get_row("SELECT * FROM save_status WHERE REQ_Id = '$reqid'"))
		$wpdb->insert( 'save_status', array( 'REQ_Id' => $reqid, 'Status' => 1));
	}
    $response = array('status' => 'success', 'message' => "You have successfully Saved this Request");
    $this->send_success($response);
    
    
    }

    function send_pre_travel_request() {
        ob_end_clean();
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $expenseLimit = $posted['expenseLimit'];
 
        $etype = $posted['ectype'];

        $expreqcode = genExpreqcode($etype);

        $date = $posted['txtDate'];

        $txtStartDate = $posted['txtStartDate'];

        $txtEndDate = $posted['txtEndDate'];

        $txtaExpdesc = $posted['txtaExpdesc'];

        $selExpcat = $posted['selExpcat'];

        $selModeofTransp = $posted['selModeofTransp'];

        $from = $posted['from'];

        $to = $posted['to'];

        $selStayDur				=	$posted['selStayDur'];
        
        $hotelcheckout    			=       $posted['dateTohotel'];

        $txtdist = $posted['txtdist'];

        $txtCost = $posted['txtCost'];
        
        $freturn = $posted['flightReturn'];
        
        $pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
		
		$approval = false;

        //  QUOTATION 
        $sessionid				=	$posted['sessionid'];
        $hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
        $hiddenAllPrefered                    =	$posted['hiddenAllPrefered']; 

        $selProjectCode = $posted['selProjectCode'];
//        $selProjectCode                         =	"0";
//	$selCostCenter                          =	"0";
        $selCostCenter = $posted['selCostCenter'];
	$selProjectCode ? $selProjectCode = "" . $selProjectCode . "" : $selProjectCode = 0;
        $selCostCenter ? $selCostCenter = "" . $selCostCenter . "" : $selCostCenter= 0;
        $textBillNo = $posted['textBillNo'];
	//print_r($posted);die;
        $count = count($txtCost);
		
		$empgrades = $wpdb->get_row("SELECT EG_Id from employees WHERE EMP_Id = '$empuserid'");
		if($empgrades)
		{
			$autoApproval = $wpdb->get_row("SELECT EMP_Grade from employee_grades WHERE EG_Id = '$empgrades->EG_Id'");
			if($autoApproval->EMP_Grade>0)
				$approval = true;
		}
		
		
	    if(!$count){
	        $response = array('status' => 'failure', 'message' => "Some fields went missing");
            $this->send_success($response);
            exit;
	    }
	    
        if ($etype == "" || $expreqcode == "") {
            $response = array('status' => 'failure', 'message' => "Some fields went missing");
            $this->send_success($response);
            exit;
        } else {

            $checked = false;

            for ($i = 0; $i < $count; $i++) {
                if ($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]=="") {
                    $checked = true;
                    break;
                }
            }
            if ($checked) {
                $response = array('status' => 'notice', 'message' => "Some fields went missing");
                $this->send_success($response);
                exit;
            }
        }
        
        // check for grade limit
//	if($etype==1)
//	{		
//	
//            for($i=0;$i<$count;$i++)
//            {		
//
//                $returnValue=getGradeLimit($selModeofTransp[$i], $empuserid, $filename);
//
//                $returnVal=explode("###",$returnValue);
//
//
//                if($returnVal[0] != 0){
//
//                    if($selModeofTransp[$i]==5 || $selModeofTransp[$i]==6)
//                    $estCost	=	$txtCost[$i] / $selStayDur[$i];					
//
//
//                    if($estCost > $returnVal[0]){					
//
//                            //header("location:$filename?msg=4&mode=$returnVal[1]&amnt=$returnVal[0]");exit;
//
//
//                    }
//                }
//
//            }
//	}
        $workflow = workflow();
        switch ($etype) {
            case 1:
                //pre travel
                $polid = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                //post travel
                $polid = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                //other travel
                $polid = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                //mileage
                $polid = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                //utility
                $polid = $workflow->COM_Utility_POL_Id;
                break;
        }
        $setreqstatus = 0;

        // Retrieving my details
        $mydetails = myDetails();

        switch ($polid) {
            //-------- employee -->  rep mngr  -->  finance
            case 1:

                if ($expenseLimit > 0) {
                    //-------- employee -->  2nd level manager  -->  finance
                   if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                    {
                            
                            // insert into request
                            $wpdb->insert('requests', array('POL_Id' => 8,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter));
                            $reqid=$wpdb->insert_id;
                            // insert into request_status
                            $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));

                    }
                    else
                    {       
                    $wpdb->insert('requests', array('POL_Id' => 5, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                    $reqid = $wpdb->insert_id;
                    }
                } else {
                    if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {
                        // insert into request
                        $wpdb->insert('requests', array('POL_Id' => $polid, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;
                        // insert into request_status
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
                    } else {
                        $wpdb->insert('requests', array('POL_Id' => $polid, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;
						if($approval)
						{
							$wpdb->update('requests', array('REQ_Status' => '2','RT_Id' => '2','REQ_PreToPostStatus' => '1','REQ_PreToPostDate' => 'NOW()'), array('REQ_Id' => $reqid));
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2, 'RS_Status' => 1));
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 1));
						}	
                    }
                }
                break;




            //  employee --> rep mngr 
            case 3:

                if ($expenseLimit > 0) {
                    if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {

                        // insert into request
                        $wpdb->insert('requests', array('REQ_Status' => 1, 'POL_Id' => 5, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;

                        // insert into request_status
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
                        $setreqstatus = 1;
                    } else {
                        $wpdb->insert('requests', array('POL_Id' => 5, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 3, 'RS_EmpType' => 3));
						
                    }
                } else {

                    if ($mydetails->EMP_Code == $mydetails->EMP_Reprtnmngrcode) {

                        // insert into request

                        $wpdb->insert('requests', array('REQ_Status' => 2, 'POL_Id' => $polid, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;

                        // insert into request_status
                        //$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));


                        $setreqstatus = 1;
                    } else {
                        $wpdb->insert('requests', array('POL_Id' => $polid, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;
						if($approval)
						{
							$wpdb->update('requests', array('REQ_Status' => '2','RT_Id' => '2','REQ_PreToPostStatus' => '1','REQ_PreToPostDate' => 'NOW()'), array('REQ_Id' => $reqid));
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'REQ_Status' => 2, 'EMP_Id' => $empuserid, 'RS_EmpType' => 1));
						}
                    }
                }
                break;

            //--------- employee --> finance --> rep mngr
            case 2:
                if ($expenseLimit > 0) {

                    $wpdb->insert('requests', array('POL_Id' => 5, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                    $reqid = $wpdb->insert_id;
                } else {
                    $wpdb->insert('requests', array('POL_Id' => $polid, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                    $reqid = $wpdb->insert_id;
					if($approval)
						{
							$wpdb->update('requests', array('REQ_Status' => '2','RT_Id' => '2','REQ_PreToPostStatus' => '1','REQ_PreToPostDate' => 'NOW()'), array('REQ_Id' => $reqid));
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 2, 'RS_Status' => 1));
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_EmpType' => 1));
						}
                }
                break;


            //--------- employee  --> finance
            case 4:
                if ($expenseLimit > 0) {
                    //-------- employee -->  2nd level manager  -->  finance
                    if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {

                        // insert into request
                        $wpdb->insert('requests', array('POL_Id' => 5, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;

                        // insert into request_status
                        $wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
                    } else {
                        $wpdb->insert('requests', array('POL_Id' => 5, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                        $reqid = $wpdb->insert_id;
                    }
                } else {
                    $wpdb->insert('requests', array('POL_Id' => $polid, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'PC_Id' => $selProjectCode, 'costCenter_Id' => $selCostCenter));
                    $reqid = $wpdb->insert_id;
					if($approval)
						{
							$wpdb->update('requests', array('REQ_Status' => '2','RT_Id' => '2','REQ_PreToPostStatus' => '1','REQ_PreToPostDate' => 'NOW()'), array('REQ_Id' => $reqid));
						}
                }
                break;
        }
        if ($reqid) {
            // insert into request_employee
            $wpdb->insert('request_employee', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid));
            //$this->send_success("success");
        } else {

            $response = array('status' => 'failure', 'message' => "Something went wrong or Workflow not Assigned please try again");
            $this->send_success($response);
        }
        
        if ($reqid) {
            $rdid = 0;
            $explodeVal = 0;
            $countExpldVal = 0;

            //echo 'count='.$count; exit;
            
            for ($i = 0; $i < $count; $i++) {
                if ($date[$i] == "n/a") {

                    $dateformat = NULL;
                } else {

                    $dateformat = $date[$i];
                    $dateformat = explode("-", $dateformat);
                    $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                }


                if ($txtStartDate[$i] == "n/a") {

                    $startdate = NULL;
                } else {

                    $startdate = $txtStartDate[$i];
                    $startdate = explode("/", $startdate);
                    $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
                }

                if ($txtEndDate[$i] == "n/a") {

                    $enddate = NULL;
                } else {

                    $enddate = $txtEndDate[$i];
                    $enddate = explode("/", $enddate);
                    $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
                }



                if ($to[$i] == "n/a")
                    $to[$i] = NULL;

                if ($selStayDur[$i] == "n/a")
                    $selStayDur[$i] = NULL;

                if ($txtdist[$i] == "n/a")
                    $txtdist[$i] = NULL;


                $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

                $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

                $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

                $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
                
                $freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL";
                
                $pickup[$i] ? $pickup[$i] = "" . $pickup[$i] . "" : $pickup[$i] = "NULL";
                
                $dropoff[$i] ? $dropoff[$i] = "" . $dropoff[$i] . "" : $dropoff[$i] = "NULL";


                $desc = addslashes($txtaExpdesc[$i]);

                $rate = 0;

                // select mileage rate

                if ($etype == 5) {

                    $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                    $rate = $selmilrate->MIL_Amount;

                    if ($rate && $txtdist[$i])
                        $txtCost[$i] = $rate * trim($txtdist[$i], "'");
                }
                //$rate ? $rate="'".$rate."'" : $rate="NULL";
                if($hotelcheckout[$i]!="NULL"){
        		    $hotelcheckout=$hotelcheckout[$i];
        		    $hotelcheckout=explode("-",$hotelcheckout);
        		    $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
        		}	
    			if($freturn[$i] != "NULL"){
    		    $freturndate=$freturn[$i];
    		    $freturndate=explode("-",$freturndate);
    		    $freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
    		    }
                if($freturn[$i] != "NULL")
                $wpdb->insert('request_details', array('REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'pickup' => $pickup[$i], 'dropoff' => $dropoff[$i], 'RD_ReturnDate' => $freturndate, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i], 'PC_Id' => $selProjectCode));
                else
                $wpdb->insert('request_details', array('REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'pickup' => $pickup[$i], 'dropoff' => $dropoff[$i], 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i], 'PC_Id' => $selProjectCode));

                $rdid = $wpdb->insert_id;
		

                
                // FILES ATTACHMENT
//                        $j=$i+1;
//
//                        $files=$_FILES['file'.$j]['name'];
//
//                        $countbills=count($files);
//
//
//                        for($f=0;$f<$countbills;$f++)
//                        {			
//                                //Get the temp file path
//                          $tmpFilePath = $_FILES['file'.$j]['tmp_name'][$f];
//
//                          //Make sure we have a filepath
//                          if ($tmpFilePath != ""){
//                                //Setup our new file path
//
//
//                                $ext = substr(strrchr($files[$f], "."), 1); //echo $ext;
//                                // generate a random new file name to avoid name conflict
//                                // then save the image under the new file name
//
//                                $filePath = md5(rand() * time()).".".$ext;
//
//                                $newFilePath = "company/upload/$compid/bills_tickets/";
//
//                                $result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
//
//                                //Upload the file into the temp dir
//                                if($result) {
//
//                                  insert_query("requests_files","RD_Id,RF_Name","'$rdid','$filePath'",$filename);	
//
//                                }
//                          }
//                        }
                		// GET QUOTATION 
				if($etype == 1){
				    /*
                                $explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                                $size = count($explodeValCount);
                                if($size>1){
                                   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
                                   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
                                   $hiddenPrefrdSelected = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenPrefrdSelected[0]),
                                            1
                                        )
                                   );
                                   $hiddenAllPrefered = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenAllPrefered[0]),
                                            3
                                        )
                                    );
                                    //print_r($hiddenPrefrdSelected);
                                    //print_r($hiddenAllPrefered);die;
                                   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
                                   $explodeVal		=	explode(",", $hiddenAllPrefered[0]);
                                   $explodeValr		=	explode(",", $hiddenAllPrefered[1]);
                                    //$countExpldVal	=	count($explodeVal);
                                    
                                     
                                    if($sessionid[$i] && $hiddenPrefrdSelected[0] && $hiddenAllPrefered[0]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeVal as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelected[0])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                    if($sessionid[$i] && $hiddenPrefrdSelected[1] && $hiddenAllPrefered[1]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeValr as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelected[1])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                //}
                                //else{*/
								//getQuote Selection for Return
								$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                                $size = count($explodeValCount);
                                if($size>1){
                                   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
                                   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
                                   $hiddenPrefrdSelectedr = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenPrefrdSelected[$i]),
                                            1
                                        )
                                   );
                                   $hiddenAllPreferedr = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenAllPrefered[$i]),
                                            3
                                        )
                                    );
                                    //print_r($hiddenPrefrdSelected);
                                    //print_r($hiddenAllPrefered);die;
                                   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
                                   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
                                   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
                                    //$countExpldVal	=	count($explodeVal);
                                    
                                     
                                    if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeVal as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelectedr[0])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                    if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeValr as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelectedr[1])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                }
                                else{
                                    $explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
                                    //$countExpldVal	=	count($explodeVal);
                                    //print_r($explodeVal);    
                                    if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeVal as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelected[$i])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                }

                        }
            }
            //Mails
            switch ($polid)
			{
				//-------- employee -->  rep mngr  -->  finance
				case 1:
					if ($expenseLimit > 0) {
						if($mydetails->EMP_Code==$mydetails->EMP_Funcrepmngrcode)
						{
							
							//mail to accounts
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 31 );
			                                }
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 30 );
			                                }
						}
					}
					else{
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{
							
							//mail to accounts
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 1 );
			                                }
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 2 );
			                                }
						}	
					}
				break;
				
				
				
				
				//  employee --> rep mngr 
				case 3:
					if ($expenseLimit > 0) {
						if($mydetails->EMP_Code==$mydetails->EMP_Funcrepmngrcode)
						{					
							
							// mail to himself saying that he can make the journey
							//notify($expreqcode, $etype, 19);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 19 );
			                                }
							
							
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
							
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 30 );
			                                }
						}
					}
					else{		
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{					
							
							// mail to himself saying that he can make the journey
							//notify($expreqcode, $etype, 19);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 19 );
			                                }
							
							
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
							
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 2 );
			                                }
						}	
					}
				
				break;
				
				//--------- employee --> finance --> rep mngr
				case 2:
					if ($expenseLimit > 0) {
						if($mydetails->EMP_Code==$mydetails->EMP_Funcrepmngrcode)
						{
							//mail to finance
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	                                                
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 31 );
			                                }
							
						}
						else
						{
							//mail to finance
							//notify($expreqcode, $etype, 20);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 30 );
			                                }
						}
					}
					else{
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{
							//mail to finance
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	                                                
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 1 );
			                                }
							
						}
						else
						{
							//mail to finance
							//notify($expreqcode, $etype, 20);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 20 );
			                                }
						}
					}
				
				break;
				
				
				//--------- employee  --> finance
				case 4:	
					if ($expenseLimit > 0) {
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
		                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
		                                   $approved_email->trigger( $expreqcode, $etype, 30 );
		                                }
					}
					else{
						//mail to finance
						//notify($expreqcode, $etype, 20);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
		                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
		                                   $approved_email->trigger( $expreqcode, $etype, 20 );
		                                }
					}
				break;
				
				
			}
			if ($expenseLimit > 0) {
				$wpdb->update('requests', array('Limit' => '1'), array('REQ_Id' => $reqid));
			}
        }
        else {

            $response = array('status' => 'failure', 'message' => "Request Couldn\'t be added. Please try again");
            $this->send_success($response);
        }
		if($approval)
		{
			$response = array('status' => 'success', 'message' => "You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Your Request is Auto Approved..  ");
			$this->send_success($response);
		}
		else{
        $response = array('status' => 'success', 'message' => "You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Please wait for approval..  ");
        $this->send_success($response);
		}
    }
    
    function save_pre_travel_request_edit() {
    	ob_end_clean();
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //echo $posted['save'];
        //$this->send_success($posted);die;
		
        $expenseLimit = $posted['expenseLimit'];

        $etype = $posted['ectype'];

        $expreqcode = genExpreqcode($etype);

        $date = $posted['txtDate'];

        $txtStartDate = $posted['txtStartDate'];

        $txtEndDate = $posted['txtEndDate'];

        $txtaExpdesc = $posted['txtaExpdesc'];

        $selExpcat = $posted['selExpcat'];

        $selModeofTransp = $posted['selModeofTransp'];

        $from = $posted['from'];

        $to = $posted['to'];

        $selStayDur				=	$posted['selStayDur'];
        
        $hotelcheckout    			=       $posted['dateTohotel'];

        $txtdist = $posted['txtdist'];

        $txtCost = $posted['txtCost'];

        $rdids = $_POST['rdids'];

        $reqid = $_POST['reqid'];
        
        $pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
		
		$freturn = $posted['flightReturn'];
                
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                        
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
	
        //  QUOTATION 
        $sessionid				=	$posted['sessionid']; 
        $hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
        $hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
	
        $selProjectCode = $posted['selProjectCode'];

        $selCostCenter = $posted['selCostCenter'];

        $textBillNo = $posted['textBillNo'];
        
        $hidrowno = count($txtCost);
        
	    //print_r($posted);die;
        $count = count($rdids);
	
        $cnt = count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));

        $selreq = $wpdb->get_row("SELECT req.REQ_Code FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' and req.REQ_Id=re.REQ_Id AND RE_Status=1 AND REQ_Active=1 and re.EMP_Id='$empuserid'");

        $expreqcode = $selreq->REQ_Code;

        if ($etype == "" || $reqid == "" || $expreqcode == "") {
            $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
            $this->send_success($response);
        } else {

            $checked = false;

            for ($i = 0; $i < $count; $i++):


                if ($date[$i] == "" || $txtCost[$i] == "" || $selExpcat == "" || $selModeofTransp == "") {

                    $checked = true;

                    break;
                }

            endfor;



            if ($checked) {
                $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
                $this->send_success($response);
            }
        }

        // updating project code if set 

        $selprocod = $wpdb->get_row("SELECT PC_Id, costCenter_Id FROM requests WHERE REQ_Id='$reqid'");
	
        if ($selprocod->PC_Id != $selProjectCode) {
            $wpdb->update('requests', array('PC_Id' => $selProjectCode), array('REQ_Id' => $reqid));
        }

        if ($selprocod->costCenter_Id != $selCostCenter) {
            $wpdb->update('requests', array('costCenter_Id' => $selCostCenter), array('REQ_Id' => $reqid));
        }

        for ($i = 0; $i < $cnt; $i++) {
            if ($date[$i] == "n/a") {

                $dateformat = NULL;
            } else {

                $dateformat = $date[$i];
                $dateformat = explode("-", $dateformat);
                $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                //$this->send_success($dateformat);
            }


            if ($txtStartDate[$i] == "n/a") {

                $startdate = NULL;
            } else {

                $startdate = $txtStartDate[$i];
                $startdate = explode("-", $startdate);
                $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
            }

            if ($txtEndDate[$i] == "n/a") {

                $enddate = NULL;
            } else {

                $enddate = $txtEndDate[$i];
                $enddate = explode("-", $enddate);
                $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
            }



            if ($to[$i] == "n/a")
                $to[$i] = NULL;

            if ($selStayDur[$i] == "n/a")
                $selStayDur[$i] = NULL;

            if ($txtdist[$i] == "n/a")
                $txtdist[$i] = NULL;


            $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

            $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

            $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

            $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
			
			$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL"; 	


            if ($etype == 5) {

                $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                $rate = $selmilrate->MIL_Amount;

                if ($rate && $txtdist[$i])
                    $txtCost[$i] = $rate * trim($txtdist[$i], "'");
            }


            //$rate ? $rate="'".$rate."'" : $rate="NULL";	
	    if($hotelcheckout[$i]!="NULL"){
                        $hotelcheckout=$hotelcheckout[$i];
                        $hotelcheckout=explode("-",$hotelcheckout);
                        $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
            }

            $rdid = $rdids[$i];

            $desc = addslashes($txtaExpdesc[$i]);
			
			if($freturn[$i] != "NULL"){
			$freturndate=$freturn[$i];
			$freturndate=explode("-",$freturndate);
			$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
			}
			if($freturn[$i] != "NULL")
			$wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_ReturnDate' => $freturndate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
			else
            $wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
        
            if($etype==1){
					// update get quote details
					
					$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                    $size = count($explodeValCount);
					
					if($size>1){
					   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
					   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
					   $hiddenPrefrdSelectedr = array_map(
							function (array $a){
								return implode(',', $a);
							},
							array_chunk(
								explode(',', $hiddenPrefrdSelected[$i]),
								1
							)
					   );
					   $hiddenAllPreferedr = array_map(
							function (array $a){
								return implode(',', $a);
							},
							array_chunk(
								explode(',', $hiddenAllPrefered[$i]),
								3
							)
						);
						//print_r($hiddenPrefrdSelected);
						//print_r($hiddenAllPrefered);die;
					   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
					   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
					   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
						//$countExpldVal	=	count($explodeVal);
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						 
						if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
								//print_r($hiddenPrefrdSelected);
								
								foreach($explodeVal as $gqfid){
										
										$pref=1;
										if($gqfid==$hiddenPrefrdSelectedr[0])
										$pref=2;  
										$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
										
								}


						}else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
						if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
								//print_r($hiddenPrefrdSelected);
								
								foreach($explodeValr as $gqfid){
										
										$pref=1;
										if($gqfid==$hiddenPrefrdSelectedr[1])
										$pref=2;  
										$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
										
								}


						}else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
					}
					else{
						$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
					
						//$countExpldVal	=	count($explodeVal);
						
						//echo 'here='.$sessionid[$i]. '&&' .$hiddenPrefrdSelected[$i]. '&&' .$hiddenAllPrefered[$i]; exit;
						
						if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
							
							//echo '1'; exit;
							$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
							
							foreach($explodeVal as $gqfid){
							
								$pref=1;
								
								if($gqfid==$hiddenPrefrdSelected[$i])
								$pref=2;
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
								
							}
							
						
						} else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
					}
				}
            
        }
        // insert those newly added row details if any 
        if ($hidrowno != $cnt) {
			

            for ($i = $cnt; $i < $hidrowno; $i++) {

                //echo 'hidrow='.$hidrowno." cnt=".$cnt; exit;			

                if ($date[$i] == "n/a") {

                    $dateformat = NULL;
                } else {

                    $dateformat = $date[$i];
                    $dateformat = explode("-", $dateformat);
                    $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                }


                if ($txtStartDate[$i] == "n/a") {

                    $startdate = NULL;
                } else {

                    $startdate = $txtStartDate[$i];
                    $startdate = explode("/", $startdate);
                    $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
                }


                if ($txtEndDate[$i] == "n/a") {

                    $enddate = NULL;
                } else {

                    $enddate = $txtEndDate[$i];
                    $enddate = explode("/", $enddate);
                    $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
                }



                if ($to[$i] == "n/a")
                    $to[$i] = NULL;

                if ($selStayDur[$i] == "n/a")
                    $selStayDur[$i] = NULL;

                if ($txtdist[$i] == "n/a")
                    $txtdist[$i] = NULL;


                $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

                $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

                $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

                $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
				
				$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL"; 	


                $desc = addslashes($txtaExpdesc[$i]);


                $rate = 0;

                // select mileage rate

                if ($etype == 5) {

                    $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                    $rate = $selmilrate->MIL_Amount;

                    if ($rate && $txtdist[$i])
                        $txtCost[$i] = $rate * trim($txtdist[$i], "'");
                }
                
                if($hotelcheckout[$i]!="NULL"){
		    $hotelcheckout=$hotelcheckout[$i];
		    $hotelcheckout=explode("-",$hotelcheckout);
		    $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
		}


                //echo $rate; exit;
                //$rate ? $rate="'".$rate."'" : $rate="NULL";	
				if($freturn[$i] != "NULL"){
				$freturndate=$freturn[$i];
				$freturndate=explode("-",$freturndate);
				$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
				}
				if($freturn[$i] != "NULL")
				$wpdb->insert('request_details', array('REQ_Id' => $reqid,'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_ReturnDate' => $freturndate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]));
				else
                $wpdb->insert('request_details', array('REQ_Id' => $reqid,'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]));
                $rdid = $wpdb->insert_id;
                
                // GET QUOTATION
                        if($etype == 1){

								$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                                $size = count($explodeValCount);
                                if($size>1){
                                   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
                                   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
                                   $hiddenPrefrdSelectedr = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenPrefrdSelected[$i]),
                                            1
                                        )
                                   );
                                   $hiddenAllPreferedr = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenAllPrefered[$i]),
                                            3
                                        )
                                    );
                                    //print_r($hiddenPrefrdSelected);
                                    //print_r($hiddenAllPrefered);die;
                                   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
                                   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
                                   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
                                    //$countExpldVal	=	count($explodeVal);
                                    
                                     
                                    if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeVal as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelectedr[0])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                    if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeValr as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelectedr[1])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                }
								else{
						
                                $explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
  				//print_r($explodeVal);
                                //$countExpldVal	=	count($explodeVal);
                                //print_r($explodeVal);    
                                if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
                                        //print_r($hiddenPrefrdSelected);
                                        foreach($explodeVal as $gqfid){
                                                
                                                $pref=1;
                                                if($gqfid==$hiddenPrefrdSelected[$i])
                                                $pref=2;  
                                                $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                
                                        }


                                }
								
								}

                        }
                
            } // end of for loop
        } // end of outer most if loop
        // update new details

        $response = array('status' => 'success', 'message' => "You have successfully Saved this Request");
        $this->send_success($response);
    }

    function send_pre_travel_request_edit() {
        ob_end_clean();
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //echo $posted['save'];
        //$this->send_success($posted);die;

        $expenseLimit = $posted['expenseLimit'];

        $etype = $posted['ectype'];

        $expreqcode = genExpreqcode($etype);

        $date = $posted['txtDate'];

        $txtStartDate = $posted['txtStartDate'];

        $txtEndDate = $posted['txtEndDate'];

        $txtaExpdesc = $posted['txtaExpdesc'];

        $selExpcat = $posted['selExpcat'];

        $selModeofTransp = $posted['selModeofTransp'];

        $from = $posted['from'];

        $to = $posted['to'];

        $selStayDur				=	$posted['selStayDur'];
        
        $hotelcheckout    			=       $posted['dateTohotel'];

        $txtdist = $posted['txtdist'];

        $txtCost = $posted['txtCost'];

        $rdids = $_POST['rdids'];

        $reqid = $_POST['reqid'];
        
        $pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
		
		$freturn = $posted['flightReturn'];
                
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                        
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
	
        //  QUOTATION 
        $sessionid				=	$posted['sessionid']; 
        $hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
        $hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
	
        $selProjectCode = $posted['selProjectCode'];

        $selCostCenter = $posted['selCostCenter'];

        $textBillNo = $posted['textBillNo'];
        
        $hidrowno = count($txtCost);
        
	    //print_r($posted);die;
        $count = count($rdids);
	
        $cnt = count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));

        $selreq = $wpdb->get_row("SELECT req.REQ_Code FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' and req.REQ_Id=re.REQ_Id AND RE_Status=1 AND REQ_Active=1 and re.EMP_Id='$empuserid'");

        $expreqcode = $selreq->REQ_Code;

        if ($etype == "" || $reqid == "" || $expreqcode == "") {
            $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
            $this->send_success($response);
        } else {

            $checked = false;

            for ($i = 0; $i < $count; $i++):


                if ($date[$i] == "" || $txtCost[$i] == "" || $selExpcat == "" || $selModeofTransp == "") {

                    $checked = true;

                    break;
                }

            endfor;



            if ($checked) {
                $response = array('status' => 'failure', 'message' => "Some fields went missing. Please enable javascript in your browser and try again");
                $this->send_success($response);
            }
        }
		
		// check for grade limit
		$expenseLimit = 0;
		if($etype==1)
		{		
		
			for($i=0;$i<$hidrowno;$i++)
			{		
				$returnValue=getGradeLimit($selModeofTransp[$i], $empuserid, $filename);
				$returnVal=explode("###",$returnValue);
				
				
				if($txtCost[$i] > $returnVal[0] && $returnVal[0]!=0){
					$expenseLimit = 1;
				}
				
			}
		}
        // updating project code if set 

        $selprocod = $wpdb->get_row("SELECT PC_Id, costCenter_Id FROM requests WHERE REQ_Id='$reqid'");
	
        if ($selprocod->PC_Id != $selProjectCode) {
            $wpdb->update('requests', array('PC_Id' => $selProjectCode), array('REQ_Id' => $reqid));
        }

        if ($selprocod->costCenter_Id != $selCostCenter) {
            $wpdb->update('requests', array('costCenter_Id' => $selCostCenter), array('REQ_Id' => $reqid));
        }

        for ($i = 0; $i < $cnt; $i++) {
            if ($date[$i] == "n/a") {

                $dateformat = NULL;
            } else {

                $dateformat = $date[$i];
                $dateformat = explode("-", $dateformat);
                $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                //$this->send_success($dateformat);
            }


            if ($txtStartDate[$i] == "n/a") {

                $startdate = NULL;
            } else {

                $startdate = $txtStartDate[$i];
                $startdate = explode("-", $startdate);
                $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
            }

            if ($txtEndDate[$i] == "n/a") {

                $enddate = NULL;
            } else {

                $enddate = $txtEndDate[$i];
                $enddate = explode("-", $enddate);
                $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
            }



            if ($to[$i] == "n/a")
                $to[$i] = NULL;

            if ($selStayDur[$i] == "n/a")
                $selStayDur[$i] = NULL;

            if ($txtdist[$i] == "n/a")
                $txtdist[$i] = NULL;


            $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

            $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

            $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

            $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
			
			$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL";

            if ($etype == 5) {

                $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                $rate = $selmilrate->MIL_Amount;

                if ($rate && $txtdist[$i])
                    $txtCost[$i] = $rate * trim($txtdist[$i], "'");
            }


            //$rate ? $rate="'".$rate."'" : $rate="NULL";	
	    if($hotelcheckout[$i]!="NULL"){
                        $hotelcheckout=$hotelcheckout[$i];
                        $hotelcheckout=explode("-",$hotelcheckout);
                        $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
            }

            $rdid = $rdids[$i];

            $desc = addslashes($txtaExpdesc[$i]);
			
			if($freturn[$i] != "NULL"){
			$freturndate=$freturn[$i];
			$freturndate=explode("-",$freturndate);
			$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
			}
			if($freturn[$i] != "NULL")
			$wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_ReturnDate' => $freturndate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
			else
            $wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
        
            if($etype==1){
					// update get quote details
					
					$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                    $size = count($explodeValCount);
					
					if($size>1){
					   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
					   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
					   $hiddenPrefrdSelectedr = array_map(
							function (array $a){
								return implode(',', $a);
							},
							array_chunk(
								explode(',', $hiddenPrefrdSelected[$i]),
								1
							)
					   );
					   $hiddenAllPreferedr = array_map(
							function (array $a){
								return implode(',', $a);
							},
							array_chunk(
								explode(',', $hiddenAllPrefered[$i]),
								3
							)
						);
						//print_r($hiddenPrefrdSelected);
						//print_r($hiddenAllPrefered);die;
					   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
					   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
					   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
						//$countExpldVal	=	count($explodeVal);
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						 
						if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
								//print_r($hiddenPrefrdSelected);
								
								foreach($explodeVal as $gqfid){
										
										$pref=1;
										if($gqfid==$hiddenPrefrdSelectedr[0])
										$pref=2;  
										$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
										
								}


						}else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
						if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
								//print_r($hiddenPrefrdSelected);
								
								foreach($explodeValr as $gqfid){
										
										$pref=1;
										if($gqfid==$hiddenPrefrdSelectedr[1])
										$pref=2;  
										$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
										
								}


						}else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
					}
					else{
						$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
					
						//$countExpldVal	=	count($explodeVal);
						
						//echo 'here='.$sessionid[$i]. '&&' .$hiddenPrefrdSelected[$i]. '&&' .$hiddenAllPrefered[$i]; exit;
						
						if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
							
							//echo '1'; exit;
							$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
							
							foreach($explodeVal as $gqfid){
							
								$pref=1;
								
								if($gqfid==$hiddenPrefrdSelected[$i])
								$pref=2;
								$wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
								
								
							}
							
						
						} else {
							//echo '2'; exit;
						$wpdb->update( 'request_getquote', array( 'RG_Active' => '9', 'RG_RemovedDate' => 'NOW()' ), array( 'RD_Id' => $rdid,'RG_Active' => 1 ) );
						
						}
					}
				}
            
        }
        // insert those newly added row details if any 
        if ($hidrowno != $cnt) {
			

            for ($i = $cnt; $i < $hidrowno; $i++) {

                //echo 'hidrow='.$hidrowno." cnt=".$cnt; exit;			

                if ($date[$i] == "n/a") {

                    $dateformat = NULL;
                } else {

                    $dateformat = $date[$i];
                    $dateformat = explode("-", $dateformat);
                    $dateformat = $dateformat[2] . "-" . $dateformat[1] . "-" . $dateformat[0];
                }


                if ($txtStartDate[$i] == "n/a") {

                    $startdate = NULL;
                } else {

                    $startdate = $txtStartDate[$i];
                    $startdate = explode("/", $startdate);
                    $startdate = $startdate[2] . "-" . $startdate[1] . "-" . $startdate[0];
                }


                if ($txtEndDate[$i] == "n/a") {

                    $enddate = NULL;
                } else {

                    $enddate = $txtEndDate[$i];
                    $enddate = explode("/", $enddate);
                    $enddate = $enddate[2] . "-" . $enddate[1] . "-" . $enddate[0];
                }



                if ($to[$i] == "n/a")
                    $to[$i] = NULL;

                if ($selStayDur[$i] == "n/a")
                    $selStayDur[$i] = NULL;

                if ($txtdist[$i] == "n/a")
                    $txtdist[$i] = NULL;


                $to[$i] ? $to[$i] = "" . $to[$i] . "" : $to[$i] = "NULL";

                $selStayDur[$i] ? $selStayDur[$i] = "" . $selStayDur[$i] . "" : $selStayDur[$i] = "NULL";

                $txtdist[$i] ? $txtdist[$i] = "" . $txtdist[$i] . "" : $txtdist[$i] = "NULL";

                $textBillNo[$i] ? $textBillNo[$i] = "" . $textBillNo[$i] . "" : $textBillNo[$i] = "NULL";
				
				$freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL";

                $desc = addslashes($txtaExpdesc[$i]);


                $rate = 0;

                // select mileage rate

                if ($etype == 5) {

                    $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                    $rate = $selmilrate->MIL_Amount;

                    if ($rate && $txtdist[$i])
                        $txtCost[$i] = $rate * trim($txtdist[$i], "'");
                }
                
                if($hotelcheckout[$i]!="NULL"){
		    $hotelcheckout=$hotelcheckout[$i];
		    $hotelcheckout=explode("-",$hotelcheckout);
		    $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
		}
		
			if($freturn[$i] != "NULL"){
			$freturndate=$freturn[$i];
			$freturndate=explode("-",$freturndate);
			$freturndate=$freturndate[2]."-".$freturndate[1]."-".$freturndate[0];
			}
			if($freturn[$i] != "NULL")
			$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'pickup' => $pickup[$i], 'dropoff' => $dropoff[$i], 'RD_ReturnDate' => $freturndate, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i], 'PC_Id' => $selProjectCode));
			else
			$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'pickup' => $pickup[$i], 'dropoff' => $dropoff[$i], 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i], 'PC_Id' => $selProjectCode));

			$rdid = $wpdb->insert_id;
                
                // GET QUOTATION
                        if($etype == 1){

								$explodeValCount = explode(",", $hiddenPrefrdSelected[$i]);
                                $size = count($explodeValCount);
                                if($size>1){
                                   //$hiddenAllPrefered = array_slice($hiddenAllPrefered, 2);
                                   //$hiddenPrefrdSelected = array_chunk($hiddenPrefrdSelected, 2);
                                   $hiddenPrefrdSelectedr = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenPrefrdSelected[$i]),
                                            1
                                        )
                                   );
                                   $hiddenAllPreferedr = array_map(
                                        function (array $a){
                                            return implode(',', $a);
                                        },
                                        array_chunk(
                                            explode(',', $hiddenAllPrefered[$i]),
                                            3
                                        )
                                    );
                                    //print_r($hiddenPrefrdSelected);
                                    //print_r($hiddenAllPrefered);die;
                                   //array_push($q, array_slice($hiddenAllPrefered, 3,6));
                                   $explodeVal		=	explode(",", $hiddenAllPreferedr[0]);
                                   $explodeValr		=	explode(",", $hiddenAllPreferedr[1]);
                                    //$countExpldVal	=	count($explodeVal);
                                    
                                     
                                    if($sessionid[$i] && $hiddenPrefrdSelectedr[0] && $hiddenAllPreferedr[0]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeVal as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelectedr[0])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                    if($sessionid[$i] && $hiddenPrefrdSelectedr[1] && $hiddenAllPreferedr[1]){
                                            //print_r($hiddenPrefrdSelected);
                                            foreach($explodeValr as $gqfid){
                                                    
                                                    $pref=1;
                                                    if($gqfid==$hiddenPrefrdSelectedr[1])
                                                    $pref=2;  
                                                    $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                    
                                            }
    
    
                                    }
                                }
								else{
						
                                $explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
  				//print_r($explodeVal);
                                //$countExpldVal	=	count($explodeVal);
                                //print_r($explodeVal);    
                                if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
                                        //print_r($hiddenPrefrdSelected);
                                        foreach($explodeVal as $gqfid){
                                                
                                                $pref=1;
                                                if($gqfid==$hiddenPrefrdSelected[$i])
                                                $pref=2;  
                                                $wpdb->insert( 'request_getquote', array( 'RD_Id' => $rdid, 'RG_SessionId' => $sessionid[$i], 'GQF_Id' => $gqfid, 'RG_Pref' => $pref ));
                                                
                                        }


                                }
								
								}

                        }
                
            } // end of for loop
        } // end of outer most if loop
        // update new details
		
		// Experimental Functioanlity
		/*
		$wpdb->update('request_status', array('RS_Status' => '2'), array('REQ_Id' => $reqid));

			$wpdb->update('requests', array('REQ_Status' => '1'), array('REQ_Id' => $reqid));

			//echo 'reqtype='.$reqtype; exit;

			/* if($reqtype){ *//*
			$workflow = workflow();
			switch ($etype) {
				case 1:
					$polid = $workflow->COM_Pretrv_POL_Id;
					break;

				case 2:
					$polid = $workflow->COM_Posttrv_POL_Id;
					break;

				case 3:
					$polid = $workflow->COM_Othertrv_POL_Id;
					break;

				case 5:
					$polid = $workflow->COM_Mileage_POL_Id;
					break;

				case 6:
					$polid = $workflow->COM_Utility_POL_Id;
					break;
			}

			// Retrieving my details
			$mydetails = myDetails();
			switch ($polid) {
				//-------- employee -->  rep mngr  -->  finance
				case 1:
					if ($expenseLimit > 0) {
						//-------- employee -->  2nd level manager  -->  finance
					   if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
						{
							$wpdb->update('requests', array('POL_Id' => '8'), array('REQ_Id' => $reqid));
							// insert into request_status
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2));
						}
						else{
							$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						}
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
					}

					break;




				//  employee --> rep mngr 
				case 3:
					if ($expenseLimit > 0) {
						if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
							$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
							// insert into request_status
							$wpdb->insert('request_status', array('REQ_Id' => $reqid, 'EMP_Id' => $empuserid, 'REQ_Status' => 2, 'RS_Status' => '1'));

							$wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));
						}
						else{
							$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
							
							$wpdb->update('request_status', array('EMP_Id' => $empuserid, 'REQ_Status' => 3, 'RS_Status' => '1', 'RS_EmpType' => 3), array('REQ_Id' => $reqid));
						}
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
					}
					
					break;

				//--------- employee --> finance --> rep mngr
				case 2:
					if ($expenseLimit > 0) {
						$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
					}
					break;


				//--------- employee  --> finance
				case 4:
					if ($expenseLimit > 0) {
						//-------- employee -->  2nd level manager  -->  finance
						if ($mydetails->EMP_Code == $mydetails->EMP_Funcrepmngrcode) {
							$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						}
						else{
							$wpdb->update('requests', array('POL_Id' => '5'), array('REQ_Id' => $reqid));
						}
						
					}
					else{
						$wpdb->update('requests', array('POL_Id' => '1'), array('REQ_Id' => $reqid));
					}

					break;
			}
		*/
		// Experimental Functionality

        $wpdb->update('request_status', array('RS_Status' => '2'), array('REQ_Id' => $reqid));

        $wpdb->update('requests', array('REQ_Status' => '1'), array('REQ_Id' => $reqid));

        //echo 'reqtype='.$reqtype; exit;

        /* if($reqtype){ */
        $workflow = workflow();
        switch ($etype) {
            case 1:
                $polid = $workflow->COM_Pretrv_POL_Id;
                break;

            case 2:
                $polid = $workflow->COM_Posttrv_POL_Id;
                break;

            case 3:
                $polid = $workflow->COM_Othertrv_POL_Id;
                break;

            case 5:
                $polid = $workflow->COM_Mileage_POL_Id;
                break;

            case 6:
                $polid = $workflow->COM_Utility_POL_Id;
                break;
        }

        // Retrieving my details
        $mydetails = myDetails();

        //Mails
            switch ($polid)
			{
				//-------- employee -->  rep mngr  -->  finance
				case 1:
					if ($expenseLimit > 0) {
						if($mydetails->EMP_Code==$mydetails->EMP_Funcrepmngrcode)
						{
							
							//mail to accounts
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 31 );
			                                }
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 30 );
			                                }
						}
					}
					else{
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{
							
							//mail to accounts
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 1 );
			                                }
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 2 );
			                                }
						}	
					}
				break;
				
				
				
				
				//  employee --> rep mngr 
				case 3:
					if ($expenseLimit > 0) {
						if($mydetails->EMP_Code==$mydetails->EMP_Funcrepmngrcode)
						{					
							
							// mail to himself saying that he can make the journey
							//notify($expreqcode, $etype, 19);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 19 );
			                                }
							
							
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
							
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 30 );
			                                }
						}
					}
					else{		
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{					
							
							// mail to himself saying that he can make the journey
							//notify($expreqcode, $etype, 19);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 19 );
			                                }
							
							
						}
						else
						{					
							
							//mail to reporting manager
							//notify($expreqcode, $etype, 2);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
							
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 2 );
			                                }
						}	
					}
				
				break;
				
				//--------- employee --> finance --> rep mngr
				case 2:
					if ($expenseLimit > 0) {
						if($mydetails->EMP_Code==$mydetails->EMP_Funcrepmngrcode)
						{
							//mail to finance
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	                                                
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 31 );
			                                }
							
						}
						else
						{
							//mail to finance
							//notify($expreqcode, $etype, 20);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 30 );
			                                }
						}
					}
					else{
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{
							//mail to finance
							//notify($expreqcode, $etype, 1);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	                                                
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 1 );
			                                }
							
						}
						else
						{
							//mail to finance
							//notify($expreqcode, $etype, 20);
							$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
			                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
			                                   $approved_email->trigger( $expreqcode, $etype, 20 );
			                                }
						}
					}
				
				break;
				
				
				//--------- employee  --> finance
				case 4:	
					if ($expenseLimit > 0) {
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
		                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
		                                   $approved_email->trigger( $expreqcode, $etype, 30 );
		                                }
					}
					else{
						//mail to finance
						//notify($expreqcode, $etype, 20);
						$approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
		                                if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
		                                   $approved_email->trigger( $expreqcode, $etype, 20 );
		                                }
					}
				break;
				
				
			}
			if ($expenseLimit > 0) {
				$wpdb->update('requests', array('Limit' => '1'), array('REQ_Id' => $reqid));
			}

        $response = array('status' => 'success', 'message' => "You have successfully update this Request");
        $this->send_success($response);
    }
    
    function request_delete(){
        //$this->send_success("working");
    	global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);
	$et = $posted['et'];
        $reqid = $posted['req_id'];
        $wpdb->query("UPDATE requests req, request_employee re SET REQ_Active=9 WHERE req.REQ_Id='$reqid' AND re.EMP_Id='$empuserid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1");
        $wpdb->query("UPDATE request_details SET RD_Status=9 WHERE REQ_Id='$reqid' AND RD_Status=1");
	
	switch ($et){
	
		case 1:
		$filename="pretravel";
		break;
		
		case 2:
		$filename="posttravel";
		break;
		
		case 3:
		$filename="oters";
		break;
		
		case 5:
		$filename="mileage";
		break;
		
		case 6:
		$filename="utility";
		break;
		
	}
	
	$this->send_success($filename);
    }

    function pre_travel_request_delete() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_SESSION['empuserid'];
        $posted = array_map('strip_tags_deep', $_POST);

        $reqid = $posted['req_id'];

        $deleteRowbutton = $posted['id'];

        //$msg=0;
        //echo $reqid; exit;

        if ($selsql = $wpdb->get_row("SELECT req.REQ_Id FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empuserid' AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1")) {

            $wpdb->update('request_details', array('RD_Status' => 9), array('RD_Id' => $deleteRowbutton, 'REQ_Id' => $reqid, 'RD_Status' => 1));

            $response = array('status' => 'success', 'message' => "Request details deleted successfully");
            $this->send_success($response);
        } else {

            $response = array('status' => 'failure', 'message' => "Error in removing request details. Please try again.");
            $this->send_success($response);
        }
    }

    function send_emp_note() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $rn_status = $posted['rn_status'];
        $req_id = $posted['req_id'];
        $emp_id = $posted['emp_id'];
        $txtaNotes = $posted['txtaNotes'];
        $wpdb->insert('requests_notes', array('REQ_Id' => $req_id, 'RN_Notes' => $txtaNotes, 'EMP_Id' => $emp_id, 'RN_Status' => $rn_status));
        $response = array('status' => 'success', 'message' => "You have successfully added a note");
        $this->send_success($response);
    }

    function get_exp_cat() {
        global $wpdb;
        $selexpcat = $wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
        $this->send_success($selexpcat);
    }

    function get_mode() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $selmode = $wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
        $this->send_success($selmode);
    }

    function get_mode_mileage() {
        global $wpdb;
        $selmode = $wpdb->get_results("SELECT * FROM mode WHERE EC_Id=5 AND MOD_Status=1");
        $this->send_success($selmode);
    }

    function get_mode_utility() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $selmode = $wpdb->get_results("SELECT * FROM mode WHERE EC_Id=6 AND COM_Id IN (0, '$compid') AND MOD_Status=1");
        $this->send_success($selmode);
    }

    function get_mode_others() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $selmode = $wpdb->get_results("SELECT * FROM mode WHERE EC_Id=3 AND COM_Id IN (0, '$compid') AND MOD_Status=1");
        $this->send_success($selmode);
    }

    function get_mode_quote() {
        global $wpdb;
        $compid = $_SESSION['compid'];
        $selmode = $wpdb->get_results("SELECT * FROM mode WHERE COM_Id IN (0, '$compid') AND MOD_Status=1");
        $this->send_success($selmode);
    }
    function get_fare_quote_flight() {
        $posted = array_map('strip_tags_deep', $_POST);
        $TraceId = $posted['TraceId'];
        $ResultIndex = $posted['ResultIndex'];
        $TokenId = $posted['TokenId'];
        $url = "http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FareQuote/";
        $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $TokenId, "TraceId" => $TraceId, "ResultIndex" => $ResultIndex ];
    	$data = json_encode($data,true);
    	$response = httpPost($url,$data);
        $this->send_success($response);
    }
    
     function booking_reserve() {
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        //$this->send_success($posted);die;
        $transaction_data = array(
        'TraceId' => $posted['traceid'],
        'ResultIndex' => $posted['aresultindex'],
        'TokenId' => $posted['atokenid'],
        'Title' => $posted['display_namepp'],
        'FirstName' => $posted['emp_namepp'],
        'LastName' => $posted['emp_lastnamepp'],
        'PaxType' => $posted['emp_genderp'],
        'DateOfBirth' => $posted['emp_dateofbirth'],
        'Gender' => $posted['emp_genderp'],
        'PassportNo' => $posted['emp_passportnopp'], 
        'PassportExpiry' => $posted['emp_expirydatepp'],
        'AddressLine1' => $posted['emp_presentaddress'],
        'AddressLine2' => "",
        'City' => $posted['emp_cityp'],
        'CountryCode' => "IN",
        'CountryName' =>"India",
        'ContactNo' => $posted['phone'],
        'Email' => $posted['emp_email'],
        'FFAirline' =>"",
        'FFNumber' =>"",
        'BaseFare' => $posted['basefare'],
        'Tax' => $posted['tax'],
        'TransactionFee' => $posted['atransfee'],
        'YQTax' => $posted['yqtax'],
        'AdditionalTxnFeeOfrd' => $posted['atransfee'],
        'AdditionalTxnFeePub' => $posted['ataxfeepub'],
        'AirTransFee' => $posted['atransfee'],
        'MCode' => "",
        'MDescription' => "",
        'SCode' => "",
        'SDescription' => "",
        'Status' => "1",
        'Rdid' => $posted['rdid'],
        );
        $tablename = 'flight_transaction';
        $transactionData = $wpdb->insert($tablename, $transaction_data);
        $id = $wpdb->insert_id;
        $this->send_success($id);die;
        $url = "http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Book/";
        $data = [ "EndUserIp" => "182.71.129.241", "TokenId" => $TokenId, "TraceId" => $TraceId, "ResultIndex" => $ResultIndex, "Passengers" => [ ["Title" => $Title, "FirstName" => $FirstName, "LastName" => "LastName", "PaxType" => $PaxType, "DateOfBirth" => $DateOfBirth, "Gender" => $Gender, "PassportNo" => $PassportNo, "PassportExpiry" => $PassportExpiry, "AddressLine1" => $AddressLine1, "AddressLine2" => $AddressLine2, "City" => $City, "CountryCode" => $CountryCode, "CountryName" => $CountryName, "ContactNo" => $ContactNo, "Email" => $Email, "IsLeadPax" => "true", "FFAirline" => $FFAirline, "FFNumber" => $FFNumber, "Fare" => [ ["BaseFare" => $BaseFare, "Tax" => $Tax, "TransactionFee" => $TransactionFee, "YQTax" => $YQTax, "AdditionalTxnFeeOfrd" => $AdditionalTxnFeeOfrd, "AdditionalTxnFeePub" => $AdditionalTxnFeePub, "AirTransFee" => $AirTransFee] ] ] ] ];
    	$data = json_encode($data,true);
        //echo $data;die;
    	$response = httpPost($url,$data);
        $this->send_success($response);
    }

    function leave_reject() {
        $this->verify_nonce('wp-erp-hr-nonce');

        // Check permission
        if (!current_user_can('erp_leave_manage')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $request_id = isset($_POST['leave_request_id']) ? intval($_POST['leave_request_id']) : 0;
        $comments = isset($_POST['reason']) ? $_POST['reason'] : '';
        erp_hr_leave_request_update_status($request_id, 3);

        global $wpdb;

        $update = $wpdb->update($wpdb->prefix . 'erp_hr_leave_requests', array('comments' => $comments), array('id' => $request_id)
        );

        if ($update) {
            $this->send_success();
        }
    }

    /**
     * Remove Holiday
     *
     * @since 0.1
     *
     * @return json
     */
    function holiday_remove() {
        $this->verify_nonce('wp-erp-hr-nonce');

        // Check permission
        if (!current_user_can('erp_leave_manage')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $holiday = erp_hr_delete_holidays(array('id' => intval($_POST['id'])));
        $this->send_success();
    }

    /**
     * Get Holiday
     *
     * @since 0.1
     *
     * @return json
     */
    function get_holiday() {
        $this->verify_nonce('wp-erp-hr-nonce');

        $holiday = erp_hr_get_holidays([
            'id' => absint($_POST['id']),
            'number' => -1
        ]);

        $this->send_success(array('holiday' => $holiday));
    }

    /**
     * Import ICal files
     *
     * @since 0.1
     *
     * @return json
     */
    function import_ical() {
        $this->verify_nonce('wp-erp-hr-nonce');

        if (empty($_FILES['ics']['tmp_name'])) {
            $this->send_error(__('File upload error!', 'erp'));
        }

        /*
         * An iCal may contain events from previous and future years.
         * We'll import only events from current year
         */
        $first_day_of_year = strtotime(date('Y-01-01 00:00:00'));
        $last_day_of_year = strtotime(date('Y-12-31 23:59:59'));


        /*
         * We'll ignore duplicate entries with the same title and
         * start date in the foreach loop when inserting an entry
         */
        $holiday_model = new \WeDevs\ERP\HRM\Models\Leave_Holiday();

        // create the ical parser object
        $ical = new \ICal($_FILES['ics']['tmp_name']);
        $events = $ical->events();

        foreach ($events as $event) {
            $start = strtotime($event['DTSTART']);
            $end = strtotime($event['DTEND']);

            if (( $start >= $first_day_of_year ) && ( $end <= $last_day_of_year )) {
                $title = sanitize_text_field($event['SUMMARY']);
                $start = date('Y-m-d H:i:s', $start);
                $end = date('Y-m-d H:i:s', $end);
                $description = (!empty($event['DESCRIPTION']) ) ? $event['DESCRIPTION'] : $event['SUMMARY'];

                // check for duplicate entries
                $holiday = $holiday_model->where('title', '=', $title)
                        ->where('start', '=', $start);

                // insert only unique one
                if (!$holiday->count()) {
                    erp_hr_leave_insert_holiday(array(
                        'id' => 0,
                        'title' => $title,
                        'start' => $start,
                        'end' => $end,
                        'description' => sanitize_text_field($description),
                    ));
                }
            }
        }

        $this->send_success();
    }

    /**
     * Remove entitlement
     *
     * @since 0.1
     *
     * @return json
     */
    public function remove_entitlement() {
        $this->verify_nonce('wp-erp-hr-nonce');

        // Check permission
        if (!current_user_can('erp_leave_manage')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
        $policy_id = isset($_POST['policy_id']) ? intval($_POST['policy_id']) : 0;

        if ($id && $user_id && $policy_id) {
            erp_hr_delete_entitlement($id, $user_id, $policy_id);
            $this->send_success();
        } else {
            $this->send_error(__('Somthing wrong !', 'erp'));
        }
    }

    /**
     * Get employee template
     *
     * @since 0.1
     *
     * @return void
     */
    public function employee_template_refresh() {
        ob_start();
        include WPERP_HRM_JS_TMPL . '/new-employee.php';
        $this->send_success(array('content' => ob_get_clean()));
    }

    /**
     * Get department template
     *
     * @since 0.1
     *
     * @return void
     */
    public function new_dept_tmp_reload() {
        ob_start();
        include WPERP_HRM_JS_TMPL . '/new-dept.php';
        $this->send_success(array('content' => ob_get_clean()));
    }

    /**
     * Get a department
     *
     * @since 0.1
     *
     * @return void
     */
    public function department_get() {
        $this->verify_nonce('wp-erp-hr-nonce');

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id) {
            $department = new Department($id);
            $this->send_success($department);
        }

        $this->send_success(__('Something went wrong!', 'erp'));
    }

    /**
     * Create a new department
     *
     * @since 0.1
     *
     * @return void
     */
    public function department_create() {
        $this->verify_nonce('erp-new-dept');

        //check permission
        if (!current_user_can('erp_manage_department')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $title = isset($_POST['title']) ? trim(strip_tags($_POST['title'])) : '';
        $desc = isset($_POST['dept-desc']) ? trim(strip_tags($_POST['dept-desc'])) : '';
        $dept_id = isset($_POST['dept_id']) ? intval($_POST['dept_id']) : 0;
        $lead = isset($_POST['lead']) ? intval($_POST['lead']) : 0;
        $parent = isset($_POST['parent']) ? intval($_POST['parent']) : 0;

        // on update, ensure $parent != $dept_id
        if ($dept_id == $parent) {
            $parent = 0;
        }

        $dept_id = erp_hr_create_department(array(
            'id' => $dept_id,
            'title' => $title,
            'description' => $desc,
            'lead' => $lead,
            'parent' => $parent
        ));

        if (is_wp_error($dept_id)) {
            $this->send_error($dept_id->get_error_message());
        }

        $this->send_success(array(
            'id' => $dept_id,
            'title' => $title,
            'lead' => $lead,
            'parent' => $parent,
            'employee' => 0
        ));
    }

    /**
     * Delete a department
     *
     * @return void
     */
    public function department_delete() {
        $this->verify_nonce('wp-erp-hr-nonce');

        //check permission
        if (!current_user_can('erp_manage_department')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id) {
            $deleted = erp_hr_delete_department($id);

            if (is_wp_error($deleted)) {
                $this->send_error($deleted->get_error_message());
            }

            $this->send_success(__('Department has been deleted', 'erp'));
        }

        $this->send_error(__('Something went worng!', 'erp'));
    }

    /**
     * Create a new designnation
     *
     * @return void
     */
    function designation_create() {
        $this->verify_nonce('erp-new-desig');

        //check permission
        if (!current_user_can('erp_manage_designation')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $title = isset($_POST['title']) ? trim(strip_tags($_POST['title'])) : '';
        $desc = isset($_POST['desig-desc']) ? trim(strip_tags($_POST['desig-desc'])) : '';
        $desig_id = isset($_POST['desig_id']) ? intval($_POST['desig_id']) : 0;

        $desig_id = erp_hr_create_designation(array(
            'id' => $desig_id,
            'title' => $title,
            'description' => $desc
        ));

        if (is_wp_error($desig_id)) {
            $this->send_error($desig_id->get_error_message());
        }

        $this->send_success(array(
            'id' => $desig_id,
            'title' => $title,
            'employee' => 0
        ));
    }

    /**
     * Get a department
     *
     * @return void
     */
    public function designation_get() {
        $this->verify_nonce('wp-erp-hr-nonce');

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id) {
            $designation = new Designation($id);
            $this->send_success($designation);
        }

        $this->send_error(__('Something went wrong!', 'erp'));
    }

    /**
     * Delete a department
     *
     * @return void
     */
    public function designation_delete() {
        $this->verify_nonce('wp-erp-hr-nonce');

        //check permission
        if (!current_user_can('erp_manage_designation')) {
            $this->send_error(__('You do not have sufficient permissions to do this action', 'erp'));
        }

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id) {
            // @TODO: check permission
            $deleted = erp_hr_delete_designation($id);

            if (is_wp_error($deleted)) {
                $this->send_error($deleted->get_error_message());
            }

            $this->send_success(__('Designation has been deleted', 'erp'));
        }

        $this->send_error(__('Something went wrong!', 'erp'));
    }

    /**
     * Create/update an employee
     *
     * @return void
     */
    public function companyadmin_create() {
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );
        //$data = "sai";
        //$this->send_success( $data );
        //$this->verify_nonce( 'wp-erp-hr-employee-nonce' );

        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
//        $posted['type']       = 'customer';
        // Check permission for editing and adding new employee
//        if ( isset( $posted['user_id'] ) && $posted['user_id'] ) {
//            if ( ! current_user_can( 'erp_edit_employee', $posted['user_id'] ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        } else {
//            if ( ! current_user_can( 'erp_create_employee' ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        }

        $employee_id = companyadmin_create($posted);

//        if ( is_wp_error( $employee_id ) ) {
//            $this->send_error( $employee_id->get_error_message() );
//        }

        $employee = new Employee($employee_id);
        $data = $employee->to_array();
        $data['work']['joined'] = $employee->get_joined_date();
        $data['work']['type'] = $employee->get_type();
        $data['url'] = $employee->get_details_url();

        // user notification email
        //if ( isset( $posted['user_notification'] ) && $posted['user_notification'] == 'on' ) {
        $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
        $send_login = isset($posted['login_info']) ? true : false;

        if (is_a($emailer, '\WeDevs\ERP\Email')) {
            $emailer->trigger($employee_id, $send_login);
        }
        //}
        $data = $posted;
        $this->send_success($data);
    }

    public function companyadmin_get() {
        global $wpdb;
        //       $this->verify_nonce( 'wp-erp-hr-nonce' );

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        //    $user        = get_user_by( 'id', $employee_id );
        //     if ( ! $user ) {
        //          $this->send_error( __( 'Employee does not exists.', 'erp' ) );
        //     }
//       $employee = new Employee( $user );
//        $this->send_success( $employee->to_array() );
        $response = $wpdb->get_row("SELECT * FROM admin WHERE ADM_Id = $id");
        $this->send_success($response);
    }

    /**
     * Create/update an employee
     *
     * @return void
     */
    public function employee_create() {
        $this->verify_nonce('wp-erp-hr-employee-nonce');

        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']);
        unset($_POST['action']);

        $posted = array_map('strip_tags_deep', $_POST);
//        $posted['type']       = 'customer';
        // Check permission for editing and adding new employee
//        if ( isset( $posted['user_id'] ) && $posted['user_id'] ) {
//            if ( ! current_user_can( 'erp_edit_employee', $posted['user_id'] ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        } else {
//            if ( ! current_user_can( 'erp_create_employee' ) ) {
//                $this->send_error( __( 'You do not have sufficient permissions to do this action', 'erp' ) );
//            }
//        }

        $employee_id = company_create($posted);

//        if ( is_wp_error( $employee_id ) ) {
//            $this->send_error( $employee_id->get_error_message() );
//        }

        $employee = new Employee($employee_id);
        $data = $employee->to_array();
        $data['work']['joined'] = $employee->get_joined_date();
        $data['work']['type'] = $employee->get_type();
        $data['url'] = $employee->get_details_url();

        // user notification email
        //if ( isset( $posted['user_notification'] ) && $posted['user_notification'] == 'on' ) {
        $emailer = wperp()->emailer->get_email('New_Employee_Welcome');
        $send_login = isset($posted['login_info']) ? true : false;

        if (is_a($emailer, '\WeDevs\ERP\Email')) {
            $emailer->trigger($employee_id, $send_login);
        }
        //}
        //$data = $posted;
        $this->send_success($data);
    }

    /**
     * Get an employee for ajax
     *
     * @return void
     */
    public function company_get() {
        global $wpdb;
//        $this->verify_nonce( 'wp-erp-hr-nonce' );
//
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
//        $user        = get_user_by( 'id', $employee_id );
//
//        if ( ! $user ) {
//            $this->send_error( __( 'Employee does not exists.', 'erp' ) );
//        }
//
//        $employee = new Employee( $user );
        //$this->send_success( $employee->to_array() );
        $response = $wpdb->get_row("SELECT * FROM company WHERE COM_Id = $id");
        $this->send_success($response);
    }

}
