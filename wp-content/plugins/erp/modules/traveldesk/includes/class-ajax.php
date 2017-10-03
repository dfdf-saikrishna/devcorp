<?php
namespace WeDevs\ERP\Traveldesk;

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
        
        //Travel Desk
        $this->action( 'wp_ajax_traveldesk_request_create', 'traveldesk_request_create' );
        $this->action( 'wp_ajax_traveldesk_request_edit', 'traveldesk_request_edit' );
	$this->action( 'wp_ajax_traveldeskbankdetails_create', 'traveldeskbankdetails_create' );
        $this->action( 'wp_ajax_traveldeskbankdetails_get', 'traveldeskbankdetails_get' );
	$this->action( 'wp_ajax_traveldeskclaims_create', 'traveldeskclaims_create' );
	$this->action( 'wp_ajax_traveldeskclaims_update', 'traveldeskclaims_update' );
        $this->action( 'wp_ajax_group-req-claim', 'group_req_claim' );
        $this->action( 'wp_ajax_accounts-travel-desk-notes', 'accounts_travel_desk_notes' );
    }
    

function accounts_travel_desk_notes(){
        global $wpdb;
		
		$compid		=$_SESSION['compid'];
        $posted = array_map( 'strip_tags_deep', $_POST );
		$txtaNotes	=	addslashes($posted['txtaNotes']);
		$tdcid	=	$posted['tdcid'];
		$tduserid = $_SESSION['tdid'];
		date_default_timezone_set("Asia/Kolkata");
        $wpdb->insert('travel_desk_claims_notes', array('TDC_Id'=>$tdcid, 'User_id'=>$tduserid, 'TDCN_Text'=>$txtaNotes, 'TDCN_Type'=>'1',));
        $response = array('status'=>'success','message'=>"You have successfully added a note");
        $this->send_success($response);
    }

    public function group_req_claim(){
        global $wpdb;
        $posted = array_map( 'strip_tags_deep', $_POST );
        $reqid = $posted['id'];
        if($reqid){
                
		$wpdb->update( 'requests', array( 'RT_Id' => 2, 'REQ_Active' => 1, 'REQ_DraftUpdatedDate' => 'NOW()', 'REQ_PreToPostStatus' => 1, 'REQ_PreToPostDate' => 'NOW()' ), array( 'REQ_Id' => $reqid ));
		
		$response = array('status'=>'success','message'=>"You have successfully updated this request for submit claims");
                $this->send_success($response);
	
	} else {
	
		$response = array('status'=>'failure','message'=>"<b>OOps!</b> Error !! Please try again. ");
                $this->send_success($response);
	
	}
        
    }
	
    public function traveldeskclaims_create() {
		
		global $wpdb;
        $posted               = array_map( 'strip_tags_deep', $_POST );
		$this->send_success($_FILES);
      //$traveldeskclaims_id  = traveldeskclaims_create( $posted );
       // $data = $posted;
        //$this->send_success( $data );
		$invoiceNo			=	genExpreqcode();
	$reqids				=	$posted['reqids'];
	$totalAmount		=	trim($posted['totalAmount']);
	//echo $totalAmount; exit;
	$txtInvoiceNo		=	trim($posted['txtInvoiceNo']);
	$txtaRemarks		=	trim(addslashes($posted['txtaRemarks']));
	$txtServiceTax		=	trim($posted['txtServiceTax']);
	$txtServiceChrgs	=	trim($posted['txtServiceChrgs'])*($posted['hiddenTickets']);
	$quantity			=	$posted['hiddenTickets'];
	$txtAccno			=	$posted['txtAccNo'];
	if($txtServiceTax && $txtServiceChrgs){
	$txtServiceTaxamnt=$txtServiceChrgs * ($txtServiceTax / 100);
	$totalAmount+=$txtServiceTaxamnt;
	}
	if($txtServiceTax && $txtServiceChrgs){
	$totalAmount=$totalAmount + $txtServiceChrgs;
	$totalAmount=abs($totalAmount);	
	}
	$this->send_success($_FILES);
	die;
	$imagename	=$_FILES['fileattach']['name'];
	$imtype		=$_FILES['fileattach']['type'];
	$imsize		=$_FILES['fileattach']['size'];
	$tmpname 	=$_FILES['fileattach']['tmp_name'];
	//echo 'imtype='.$imtype; die;
	$photoAllowed=0;
	if($imagename)
	{
		echo "asdasd";
		$allowedExts 		= 	array("doc", "docx", "pdf"); 
		$allowedMimeTypes 	= 	array("application/msword", 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf');
		$extension 			= 	end(explode('.', $imagename));
		$extension 			= 	strtolower($extension);
		$matchExtns			=	in_array($extension,$allowedExts);
		if($matchExtns)
		{
			if ( in_array( $imtype, $allowedMimeTypes ) )
			$photoAllowed=0;
			else
			$photoAllowed=1;
		}
		else
		{
			$photoAllowed=1;			
		}
	}
	if($photoAllowed)
	{
		$response = array('status'=>'failure','message'=>"Wrong file type uploaded.");
        exit;
		
	}
	if($reqids=="" || $totalAmount==""){
		$response = array('status'=>'failure','message'=>"OOPs !! Some fields went missing. Please try again.");
        exit;
	} else {

	$tmpFilePath = $_FILES['fileattach']['tmp_name'];
 //Make sure we have a filepath
                          if ($tmpFilePath != ""){
                                //Setup our new file path


                                $ext = substr(strrchr($imagename, "."), 1); //echo $ext;
                                // generate a random new file name to avoid name conflict
                                // then save the image under the new file name

                                $filePath = md5(rand() * time()).".".$ext;
							 $compid = $_SESSION['compid'];
                                $newFilePath = WPERP_COMPANY_PATH . "/upload/$compid/bills_tickets/";
							 
                                if (!file_exists($newFilePath)) {
                                    wp_mkdir_p($newFilePath);
                                }

                                move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
                          }
	$tduserid = $_SESSION['tdid'];
	$compid = $_SESSION['compid'];
	$traveldeskclaims_data = array(
        'TD_Id' => $tduserid,
		'COM_Id'=> $compid,
		'TDC_ReferenceNo'=>$invoiceNo,
		'TDC_Quantity'=>$quantity,
		'TDC_Amount'=>$totalAmount,
		'TDC_ServiceTax'=>$txtServiceTax,
		'TDC_ServiceCharges'=>$txtServiceChrgs,
		'TDC_InvoiceNo'=>$txtInvoiceNo,
		'TDBA_Id'=>$txtAccno,
		'TDC_Filename'=>$filePath,
		'TDC_Remarks'=>$txtaRemarks
    );
   /* $tablename = "travel_desk_claims";
    $wpdb->insert( $tablename, $traveldeskclaims_data);
	$insertid = $wpdb->insert_id;
	if(!empty($insertid)){
	$reqidarry	=	explode(",", $posted['reqids']);	
			
			
			$totalcosts=0;
			
			foreach($reqidarry as $vals){
						
				
				$getvals = $wpdb->get_results("SELECT DISTINCT (rd.RD_Id) FROM request_details rd, booking_status bs WHERE rd.REQ_Id=$vals AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3)  AND BS_Active=1 AND RD_Status=1");
				
				$totalcosts=0;
									
				foreach ($getvals as $values) {
				
					
					$countAll=count($wpdb->get_results("SELECT BS_Id FROM booking_status WHERE RD_Id='$values->RD_Id' AND BS_Active=1"));
									
																		
					if($countAll==2){
					
						if($rowcn=$wpdb->get_results("SELECT BA_Id, BS_CancellationAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=3 AND BS_Active=1")){
						
							if($rowcn[0]->BA_Id==4 || $rowcn[0]->BA_Id==6){
								
								$totalcosts	+=	$rowcn[0]->BS_CancellationAmnt;
							
							}
						
						} else {
						
							$rowbk=$wpdb->get_results("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
							
							$totalcosts	+=	$rowbk[0]->BS_TicketAmnt;
						
						}
						
						
					} else {
					
						$rowbk=$wpdb->get_results("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
						
						$totalcosts	+=	$rowbk[0]->BS_TicketAmnt;
					
					}
				}
				
				$qty	=	count($getvals);
			
			$travel_desk_claim_requests_data = array(
			'TDC_Id' => $insertid,
			'REQ_Id' => $vals,
			'TDCR_Quantity'   => $qty,
			'TDCR_Amount'  => $totalcosts,
			);
         $wpdb->insert("travel_desk_claim_requests",$travel_desk_claim_requests_data);	
			}	
			$response = array('status'=>'failure','message'=>"Wrong file type uploaded.");
			exit;
		} else {
			$response = array('status'=>'failure','message'=>"Error !! Please try again or contact your administrator.");
        exit;
		}*/
	}
		
		
		
		
		
    }
	
    public function traveldeskclaims_update() {
        $posted               = array_map( 'strip_tags_deep', $_POST );
        $traveldeskclaimsupdate_id  = traveldeskclaims_update( $posted );
        $data = $posted;
        $this->send_success( $data );
    }
	/*** Create/update an travelagentbankdetails */

    public function traveldeskbankdetails_create() {
        $posted               = array_map( 'strip_tags_deep', $_POST );
        $traveldeskbankdetails_id  = traveldeskbankdetails_create( $posted );
        $data = $posted;
        $this->send_success( $data );
    }
    
    public function traveldeskbankdetails_get() {
        global $wpdb;
        $id = $_REQUEST['id']; 
        $response = $wpdb->get_row("SELECT * FROM travel_desk_bank_account WHERE TDBA_Id = '$id' AND TDBA_Status=1");
        $this->send_success( $response );
    }
    
    function traveldesk_request_edit(){

    ob_end_clean();
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_POST['hiddenEmp'];
        $posted = array_map( 'strip_tags_deep', $_POST );
        
        $expenseLimit                           = 	$posted['expenseLimit'];
        
        $selEmployees                           =	$_POST['hiddenEmp'];
        
        $hiddenDraft                            =	$_POST['hiddenDraft'];

	$etype					=	$posted['ectype'];
        
	$addnewRequest                          =	$_POST['addnewrequest'];
        
	$expreqcode				=	genExpreqcode(4); // 4 is for creating requests with TRA
		
	$date					=	$posted['txtDate'];
	
	$txtStartDate                           =	$posted['txtStartDate'];
	
	$txtEndDate				=	$posted['txtEndDate'];
	
	$txtaExpdesc                            =	$posted['txtaExpdesc'];
	
	$selExpcat				=	$posted['selExpcat'];
	
	$selModeofTransp                        =	$posted['selModeofTransp'];
	
	$from					=	$posted['from'];
	
	$to					=	$posted['to'];
	
	//$hidrowno 				= 	$posted['hidrowno'];
	
	$selStayDur				=	$posted['selStayDur'];
	
	$txtdist				=	$posted['txtdist'];
	
	$txtCost				=	$posted['txtCost'];
	
	$pickup = $posted['pickup'];
        
    $dropoff = $posted['dropoff'];
            
    $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                    
    $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
	
	$hidrowno 				= 	count($txtCost);
	//  QUOTATION 
	
	$sessionid				=	$posted['sessionid'];
	
	$hotelcheckout    			=       $posted['dateTohotel'];
	
	$hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
	
	$hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
	
	$selProjectCode                         =       $posted['selProjectCode'];
        
        $selCostCenter                          =       $posted['selCostCenter'];
        
	$selProjectCode ? $selProjectCode = "" . $selProjectCode . "" : $selProjectCode = 0;
	
        $selCostCenter ? $selCostCenter = "" . $selCostCenter . "" : $selCostCenter= 0;
	
	$textBillNo				=	$posted['textBillNo'];
	//$expenseLimit                           =       "0";
	
	$reqid = $_POST['reqid'];
	$rdids = $_POST['rdids'];
	$count=count($txtCost);
	
	$cnt = count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));

        if($etype=="" || $expreqcode==""){
		$response = array('status'=>'failure','message'=>"Some fields went missing");
                //$this->send_success($response);
                exit;
	
	} else {
	
		$checked=false;
		
		for($i=0;$i<$count;$i++){
			//$txtaExpdesc[$i]=="" || 			
			if($date[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]==""){
				$checked=true;
				break;
			
			}
                        
		
		}
                if($checked){
                        $response = array('status'=>'notice','message'=>"Some fields went missing");
                        $this->send_success($response);
			exit;
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


            if ($etype == 5) {

                $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                $rate = $selmilrate->MIL_Amount;

                if ($rate && $txtdist[$i])
                    $txtCost[$i] = $rate * trim($txtdist[$i], "'");
            }
            
            if($hotelcheckout){
	        $hotelcheckout=$hotelcheckout[$i];
	        $hotelcheckout=explode("-",$hotelcheckout);
	        $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
	    }


            //$rate ? $rate="'".$rate."'" : $rate="NULL";	


            $rdid = $rdids[$i];

            $desc = addslashes($txtaExpdesc[$i]);
	    
            $wpdb->update('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i]), array('RD_Id' => $rdid));
        
            if($etype==1){
					// update get quote details
										
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


                $desc = addslashes($txtaExpdesc[$i]);


                $rate = 0;

                // select mileage rate

                if ($etype == 5) {

                    $selmilrate = $wpdb->get_row("SELECT MIL_Amount FROM mileage WHERE COM_Id='$compid' and MOD_Id='$selModeofTransp[$i]' and MIL_Status='1' and MIL_Active=1");

                    $rate = $selmilrate->MIL_Amount;

                    if ($rate && $txtdist[$i])
                        $txtCost[$i] = $rate * trim($txtdist[$i], "'");
                }

		if($hotelcheckout){
                        $hotelcheckout=$hotelcheckout[$i];
                        $hotelcheckout=explode("-",$hotelcheckout);
                        $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
                }
                //echo $rate; exit;
                //$rate ? $rate="'".$rate."'" : $rate="NULL";	

                $wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Distance' => $txtdist[$i], 'RD_Rate' => $rate, 'RD_BillNumber' => $textBillNo[$i], 'RD_Cost' => $txtCost[$i], 'RD_Type' => '2'));
                $rdid = $wpdb->insert_id;
                
                // GET QUOTATION
                        if($etype == 1){				
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
                
            } // end of for loop
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


        $response = array('status' => 'success', 'message' => "You have successfully update this Request");
        $this->send_success($response);
       
    }
    
        function traveldesk_request_create(){
        ob_end_clean();
        global $wpdb;
        $compid = $_SESSION['compid'];
        $empuserid = $_POST['hiddenEmp'];
        $posted = array_map( 'strip_tags_deep', $_POST );
        
        $expenseLimit                           = 	$posted['expenseLimit'];
        
        $selEmployees                           =	$_POST['hiddenEmp'];
        
        $hiddenDraft                            =	$_POST['hiddenDraft'];

	$etype					=	$posted['ectype'];
        
	$addnewRequest                          =	$_POST['addnewrequest'];
        
	$expreqcode				=	genExpreqcode(4); // 4 is for creating requests with TRA
		
	$date					=	$posted['txtDate'];
	
	$txtStartDate                           =	$posted['txtStartDate'];
	
	$txtEndDate				=	$posted['txtEndDate'];
	
	$txtaExpdesc                            =	$posted['txtaExpdesc'];
	
	$selExpcat				=	$posted['selExpcat'];
	
	$selModeofTransp                        =	$posted['selModeofTransp'];
	
	$from					=	$posted['from'];
	
	$to					=	$posted['to'];
	
	$selStayDur				=	$posted['selStayDur'];
	
	$txtdist				=	$posted['txtdist'];
	
	$txtCost				=	$posted['txtCost'];
	
	$hotelcheckout    			=       $posted['dateTohotel'];
	
	$pickup = $posted['pickup'];
        
    $dropoff = $posted['dropoff'];
            
    $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                    
    $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
	
	//  QUOTATION 
	
	$sessionid				=	$posted['sessionid'];
	
	$hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
	
	$hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
	
	$selProjectCode                         =       $posted['selProjectCode'];
        
        $selCostCenter                          =       $posted['selCostCenter'];
        
	$selProjectCode ? $selProjectCode = "" . $selProjectCode . "" : $selProjectCode = 0;
	
        $selCostCenter ? $selCostCenter = "" . $selCostCenter . "" : $selCostCenter= 0;
	
	$textBillNo				=	$posted['textBillNo'];
	//$expenseLimit                           =       "0";
	$count=count($txtCost);
	//print_r($posted);die;
        if($etype=="" || $expreqcode==""){
		$response = array('status'=>'failure','message'=>"Some fields went missing");
                //$this->send_success($response);
                exit;
	
	} else {
	
		$checked=false;
		
		for($i=0;$i<$count;$i++){
			//$txtaExpdesc[$i]=="" || 				
			if($date[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]==""){
				$checked=true;
				break;
			
			}
                        
		
		}
                if($checked){
                        $response = array('status'=>'notice','message'=>"Some fields went missing");
                        $this->send_success($response);
			exit;
		}
                
        }
     
        //$this->send_success("here");
        if($comp=$wpdb->get_row("SELECT COM_Pretrv_POL_Id FROM company WHERE COM_Id='$compid'")){

        switch ($addnewRequest){
                
                // individual without approval
                case 1:
                $reqtype=2; $reqstatus=2;
                break;

                // individual with approval
                case 2:
                $reqtype=3;
                break;

                // group request
                case 3:
                $reqtype=4; $reqstatus=2;
                break;

        }
        
        $polid=$comp->COM_Pretrv_POL_Id;
        
        if($addnewRequest==2){
				
        // Retrieving employee details
        $mydetails=myDetails($selEmployees);

        $type=0;
	
        switch ($polid)
        {
            
                //-------- employee -->  rep mngr  -->  finance
                case 1:
                   
                if($expenseLimit > 0){
                            $wpdb->insert('requests', array('POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id;
                            $type=2;
                }
                else{
                    if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                    {
                            // insert into request
                            $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id;
                            // insert into request_status
                            $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));
                            $type=1;
                    }
                    else
                    {
                            $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id; 
                            $type=2;
                    }       
                }
                break;
                



                //  employee --> rep mngr 
                case 3:
                    
                if($expenseLimit > 0){
                        if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                        {

                                // insert into request
                                $wpdb->insert('requests', array('REQ_Status' => 2,'POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                                $reqid=$wpdb->insert_id; 
				
                                // insert into request_status
                                $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));
                                $setreqstatus=1;
                                $type=3;

                        }
                        else
                        {
                            $wpdb->insert('requests', array('POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id;
                            $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 3,'RS_EmpType' => 3));
                            $type=4;
                        }
                }
                else{
                        
                        if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
                        {

                                // insert into request
                                
                                $wpdb->insert('requests', array('REQ_Status' => 2,'POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                                $reqid=$wpdb->insert_id; 

                                // insert into request_status
                                $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));


                                $setreqstatus=1;
                                $type=3;

                        }
                        else
                        {
                            $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid = $wpdb->insert_id;
                            $type=4;    
                        }	

                }
                break;

                //--------- employee --> finance --> rep mngr
                case 2:
                if($expenseLimit > 0){
                        
                        $wpdb->insert('requests', array('POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                        $reqid=$wpdb->insert_id;
                        $type=6;
                }   
                else{
                        $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                        $reqid=$wpdb->insert_id;
                        $type=6;
                }
                break;


                //--------- employee  --> finance
                case 4:
                if($expenseLimit > 0){
                   //-------- employee -->  2nd level manager  -->  finance
                   if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
                    {

                            // insert into request
                            $wpdb->insert('requests', array('POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id;                           

                            // insert into request_status
                            $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));
                            $type=7;
                    }
                    else
                    {
                        $wpdb->insert('requests', array('POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));   
                        $reqid=$wpdb->insert_id;
                        $type=7;
                    }
                }
                else{
                        $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                        $reqid=$wpdb->insert_id;
                        $type=7;
                }				
                break;

        }


        if($setreqstatus)
        $wpdb->insert('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));

        }else {
			
                if($reqtype==2)
                $reqactive=1;
                else
                $reqactive=2;

                $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Status' => $reqstatus,'REQ_Active' => $reqactive,'REQ_Type' => $reqtype));
                $reqid=$wpdb->insert_id;
		
        }
        if($reqid){
			
            if($reqtype==4){

                    $selEmployees	=	$_POST['selEmployees'];

                    //echo 'Emps='.join(",",$selEmployees); exit;

                    foreach($selEmployees as $value){

                            // insert into request_employee
                            $wpdb->insert('request_employee', array('REQ_Id' => $reqid,'EMP_Id' => $value));
                            
                            // mail to employee required or not

                    }


            } else {

                    // insert into request_employee
                    $wpdb->insert('request_employee', array('REQ_Id' => $reqid,'EMP_Id' => $selEmployees));
                    
                    // mail to employee required or not

            }

    } else {

            //header("location:$filename?msg=2");exit;
            $this->send_success("2");

    }

    } else {

            //header("location:$filename?msg=2");exit;
            $this->send_success("2");
    }

    if($reqid)
        {

                for($i=0;$i<$count;$i++)
                {		
                        $dateformat=$date[$i];
                        $dateformat=explode("-",$dateformat);
                        $dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];
                        
                        if($hotelcheckout){
                        $hotelcheckout=$hotelcheckout[$i];
                        $hotelcheckout=explode("-",$hotelcheckout);
                        $hotelcheckout=$hotelcheckout[2]."-".$hotelcheckout[1]."-".$hotelcheckout[0];
                        }

                        ($from[$i]=="n/a") ? $from[$i]="NULL" : $from[$i]="".$from[$i]."";

                        ($to[$i]=="n/a") ? $to[$i]="NULL" : $to[$i]="".$to[$i]."";

                        ($selStayDur[$i]=="n/a") ? $selStayDur[$i]="NULL" : $selStayDur[$i]="".$selStayDur[$i]."";	



                        $desc	=	addslashes($txtaExpdesc[$i]);
			
                        $wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff,'RD_Dateoftravel' => $dateformat,'RD_Description' => $desc,'EC_Id' => $selExpcat[$i],'MOD_Id' => $selModeofTransp[$i],'RD_Cityfrom' => $from[$i],'RD_Cityto' => $to[$i],'SD_Id' => $selStayDur[$i],'RD_Cost' => $txtCost[$i],'RD_EndDate' => $hotelcheckout,'RD_Type' => 2));
                        $rdid = $wpdb->insert_id;


                        // GET  QUOTE
			
			if($etype == 1){				
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



                        if($addnewRequest==1 || $addnewRequest==3){

                                // insert into booking status
                                $wpdb->insert('booking_status', array('RD_Id' => $rdid,'BS_Status' => 1,'BS_TicketAmnt' => $txtCost[$i],'BA_Id' => 2,'BA_ActionDate' => "NOW()"));
                                $bsid = $wpdb->insert_id;


                                $j=$i+1;
                                $files=$_FILES['file'.$j]['name'];
                                $countbills=count($files);




                                for($f=0;$f<$countbills;$f++)
                                {			
                                        //Get the temp file path
                                        $tmpFilePath = $_FILES['file'.$j]['tmp_name'][$f];



                                        //Make sure we have a filepath
                                        if ($tmpFilePath != ""){						

                                                $ext = substr(strrchr($files[$f], "."), 1); //echo $ext;
                                                // generate a random new file name to avoid name conflict
                                                // then save the image under the new file name

                                                $filePath = md5(rand() * time()).".".$ext;

                                                $newFilePath = "../company/upload/$compid/bills_tickets/";

                                                $result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);

                                                //echo 'count='.$result;exit;

                                                //Upload the file into the temp dir
                                                if($result){

                                                        if($addnewRequest==2){

                                                                // insert into request files
                                                                $wpdb->insert('requests_files', array('RD_Id' => $rdid,'RF_Name' => $filePath));

                                                        } else {

                                                                // insert into bs documents.	
                                                                $wpdb->insert('booking_documents', array('BS_Id' => $bsid,'BD_Filename' => $filePath));

                                                        }





                                                }
                                        }
                                }

                        }



                }


                switch ($type){

                        case 1:

                        //mail to accounts
                        //notify($expreqcode, $etype, 1);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 1 );
                        }

                        break;


                        case 2:

                        //mail to reporting manager
                        //notify($expreqcode, $etype, 2);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 2 );
                        }

                        break;


                        case 3:

                        // mail to himself saying that he can make the journey
                        //notify($expreqcode, $etype, 19, $mydetails['EMP_Id']);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 19, $mydetails->EMP_Id );
                        }

                        break;

                        case 4:

                        //mail to reporting manager
                        //notify($expreqcode, $etype, 2, $mydetails['EMP_Id']);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 2, $mydetails->EMP_Id );
                        }

                        break;


                        case 5:

                        //mail to finance
                        //notify($expreqcode, $etype, 1, $mydetails['EMP_Id']);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 1, $mydetails->EMP_Id );
                        }

                        break;


                        case 6:

                        //mail to finance
                        //notify($expreqcode, $etype, 20, $mydetails['EMP_Id']);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 20, $mydetails->EMP_Id );
                        }

                        break;


                        case 7:

                        //mail to finance
                        //notify($expreqcode, $etype, 20, $mydetails['EMP_Id']);
                        $approved_email = wperp()->emailer->get_email( 'Approved_Leave_Request' );
	
                        if ( is_a( $approved_email, '\WeDevs\ERP\Email') ) {
                           $approved_email->trigger( $expreqcode, $etype, 20, $mydetails->EMP_Id );
                        }

                        break;

                }



        } else {

                //header("location:$filename?msg=7");exit;
                $response = array('status'=>'failure','message'=>"Request Couldn\'t be added. Please try again");
                $this->send_success($response);

        }


        //header("location:$filename?msg=1&reqid=$expreqcode");exit;    
	//$this->send_success("1");	
			
        $response = array('status'=>'success','message'=>"You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Please wait for approval..  ");
        $this->send_success($response);
        
    }
}
