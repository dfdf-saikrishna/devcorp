<?php
namespace WeDevs\ERP\Travelagentclient;

use WeDevs\ERP\Framework\Traits\Ajax;
use WeDevs\ERP\Framework\Traits\Hooker;

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
        
        // Travel Agent Client Create
        $this->action( 'wp_ajax_get-emp-details', 'get_emp_details' );
        $this->action( 'wp_ajax_booking_request_create', 'booking_request_create' );
        $this->action( 'wp_ajax_update-booking-request', 'update_booking_request' );
        $this->action( 'wp_ajax_add-more-employees', 'add_more_employees' );
        $this->action( 'wp_ajax_group_request_create', 'group_request_create' );
        
		// Travel Agent User Create
        $this->action( 'wp_ajax_travelagentuser_create', 'travelagentuser_create' );
		$this->action( 'wp_ajax_travelagentuser_get', 'travelagentuser_get' );
		
		// Travel Agent Client Create
		$this->action( 'wp_ajax_travelagentclient_create', 'travelagentclient_create' );
		$this->action( 'wp_ajax_travelagentclient_get', 'travelagentclient_get' );
		
		$this->action( 'wp_ajax_companyinvoice_view', 'companyinvoice_view' );
		
		$this->action( 'wp_ajax_travelagentbankdetails_create', 'travelagentbankdetails_create' );
		$this->action( 'wp_ajax_travelagentbankdetails_get', 'travelagentbankdetails_get' );
		$this->action( 'wp_ajax_travelagentclaims_create', 'travelagentclaims_create' );
		
		$this->action( 'wp_ajax_request-delete-user', 'request_delete_user' );
		$this->action( 'wp_ajax_group-request-delete-user', 'group_request_delete_user' );
		
		$this->action('wp_ajax_payment_details_create_tc', 'payment_details_create_tc');

    }
    
    public function payment_details_create_tc() {
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
        
        $txtAmnt    =	$_POST['txtAmnt'];

        $txtBBDate = trim($posted['txtBBDate']);

        if ($txtBBDate)
            $txtBBDate = trim($txtBBDate);

        $txtaOtherComments = trim(addslashes($posted['txtaOtherComments']));

        if ($selPaymentMode == "" && $txtChequeNumber == "" && $txtCqDate == "" && $txtBankBranch == "" && $txtaCshComments == "" && $txtTransId == "" && $txtBankdetails == "" && $txtBBDate == "" && $txtaOtherComments == "" && $txtAmnt) {

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

            $selsql = "SELECT TDC_Amount, TDC_PaidAmount FROM travel_desk_claims WHERE TDC_Id='$tdcid'";
		    $rowsql = $wpdb->get_row($selsql);
		    
		    $bal_amnt = null;
					
    		$bal_amnt = $rowsql->TDC_Amount - ($rowsql->TDC_PaidAmount + $txtAmnt);
    		//echo "original" . $txtAmnt;
    		//echo "calc" . $bal_amnt;die;
    		
    		if($bal_amnt)
    		$tdcstatus = 1;
    		else
    		$tdcstatus = 2;

		    $wpdb->insert('travel_desk_claim_payments', array('TDC_Id' => $tdcid, 'PM_Id' => $selPaymentMode, 'TDCP_ChequeNumber' => $txtChequeNumber, 'TDCP_ChequeDate' => $txtCqDate, 'TDCP_ChequeIssuingbb' => $txtBankBranch, 'TDCP_CashPaymentDetails' => $txtaCshComments, 'TDCP_BTTransactionId' => $txtTransId, 'TDCP_BTBankDetails' => $txtBankdetails, 'TDCP_BTTransferDate' => $txtBBDate, 'TDCP_OthersPaymentDetails' => $txtaOtherComments, 'TDCP_Amount' => $txtAmnt));
		
		    
            $wpdb->update('travel_desk_claims', array('TDC_Status' => $tdcstatus, 'TDC_PaidAmount' => $txtAmnt, 'TDC_Arrears' => $bal_amnt), array('TDC_Id' => $tdcid, 'TDC_Status' => '1'));
            
            
            if($tdcstatus == 2){
		
		
			$selsql = "select GROUP_CONCAT(REQ_Id) AS reqids from travel_desk_claim_requests where TDC_Id = $tdcid ";
			
			$rowsql = $wpdb->get_row($selsql);
			
			
			
			// update those request to claimed
			
			
			if(!empty($rowsql)){
				
				$selsql = "update requests set REQ_Claim = 1, REQ_ClaimDate = '$curdatetime' where REQ_Id IN ($rowsql->reqids) ";
				
				$wpdb->get_row($selsql);
				
			}
		
		}
		
		
		
		// first time inserted 
		//travelDeskClaims($tdcid, 3, 1);
            
            $response = array('status' => 'success', 'message' => "Payment details added successfully");
            $this->send_success($response);
    
        }
    }
    
    public function request_delete_user(){
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $reqid = $posted['req_id'];
        $compid	= $_SESSION['compid'];
	
	if(!$reqid){
	    $response = array('status' => 'failure', 'message' => "Something went wrong.");
        $this->send_success($response);
		exit;
	
	} else {
	
		
		// checking whether its the appropriate request of that company
		
		$row=$wpdb->get_row("SELECT COUNT(req.REQ_Id) AS reqCnt, req.REQ_Code AS reqcode FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Type IN (2,4) AND RE_Status=1 AND REQ_Claim IS NULL");

		if(!$row->reqCnt){
		
			$response = array('status' => 'failure', 'message' => "Something went wrong.");
            $this->send_success($response);
			exit;
		
		} else {
		
			/* select all request details, then find out which ticket hasn't sent for cancellation. if any non cancelled tickets
			 found send them for cancellation*/
			 
			 
			 // select request details
			 
			 $selsql = "SELECT RD_Id FROM request_details WHERE REQ_Id = $reqid";
			 $ressql = $wpdb->get_results($selsql);
			 
			 
			
			 
			 foreach($ressql as $rowsql){
			 
			 
			 	$selbs = "SELECT COUNT(BS_Id) AS cntBsid FROM booking_status WHERE RD_Id = $rowsql->RD_Id AND BS_Status = 3";
				
				$rowbs = $wpdb->get_row($selbs);
				
				
				if($rowbs->cntBsid < 1){
			 		
					// insert into booking status for cancellation
				     $wpdb->insert( 'booking_status', array( 'RD_Id' => $rowsql->RD_Id, 'BS_Status' => '3', 'BA_Id' => '1' ) );

				}
				
				
			 }

			$wpdb->update('requests', array('REQ_Active' => '9', REQ_RemovedDate => $curdatetime), array('REQ_Id' => $reqid));
			$wpdb->query($query);		
			$return = $wpdb->insert_id;
			
			
			
			if($return){
				
				
				//$msg = 2;
					
				//sent mail to travel agent user that a request have been canceled by non corptne user, so that you can cancel the un canceled tickets
				
				//$reqcode = $row->reqcode;
				
				//requestCancellation($reqcode, $compid);
				 
				
			} else {
				
				//$msg = 3;
				
			}
			
			
			
			//$_SESSION['msg'] = $msg;
			
			//header("location:$filename");
			$response = array('status' => 'success', 'message' => "Request Deleted Successfully.");
            $this->send_success($response);
            exit;
			
			
		
		}
		
		
	
	}
    }
    
    public function group_request_delete_user(){
        global $wpdb;
        $posted = array_map('strip_tags_deep', $_POST);
        $reqid = $posted['req_id'];
        $compid	= $_SESSION['compid'];
	
	if(!$reqid){
	    $response = array('status' => 'failure', 'message' => "Something went wrong.");
        $this->send_success($response);
		exit;
	
	} else {
	
		
		// checking whether its the appropriate request of that company
		
		$row=$wpdb->get_row("SELECT COUNT(req.REQ_Id) AS reqCnt, req.REQ_Code AS reqcode FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Type IN (2,4) AND RE_Status=1 AND REQ_Claim IS NULL");

		if(!$row->reqCnt){
		
			$response = array('status' => 'failure', 'message' => "Something went wrong.");
            $this->send_success($response);
			exit;
		
		} else {
		
			/* select all request details, then find out which ticket hasn't sent for cancellation. if any non cancelled tickets
			 found send them for cancellation*/
			 
			 
			 // select request details
			 
			 $selsql = "SELECT RD_Id FROM request_details WHERE REQ_Id = $reqid";
			 $ressql = $wpdb->get_results($selsql);
			 
			 
			
			 
			 foreach($ressql as $rowsql){
			 
			 
			 	$selbs = "SELECT COUNT(BS_Id) AS cntBsid FROM booking_status WHERE RD_Id = $rowsql->RD_Id AND BS_Status = 3";
				
				$rowbs = $wpdb->get_row($selbs);
				
				
				if($rowbs->cntBsid < 1){
			 		
					// insert into booking status for cancellation
				     $wpdb->insert( 'booking_status', array( 'RD_Id' => $rowsql->RD_Id, 'BS_Status' => '3', 'BA_Id' => '1' ) );

				}
				
				
			 }

			$wpdb->update('requests', array('REQ_Active' => '9', REQ_RemovedDate => $curdatetime), array('REQ_Id' => $reqid));
			$wpdb->query($query);		
			$return = $wpdb->insert_id;
			
			
			
			if($return){
				
				
				//$msg = 2;
					
				//sent mail to travel agent user that a request have been canceled by non corptne user, so that you can cancel the un canceled tickets
				
				//$reqcode = $row->reqcode;
				
				//requestCancellation($reqcode, $compid);
				 
				
			} else {
				
				//$msg = 3;
				
			}
			
			
			
			//$_SESSION['msg'] = $msg;
			
			//header("location:$filename");
			$response = array('status' => 'success', 'message' => "Group Request Deleted Successfully.");
            $this->send_success($response);
            exit;
			
			
		
		}
		
		
	
	}
    }
    
    public function add_more_employees(){
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        $itr = $posted['itr'];
        $content = '<div class="col-lg-12" id="employeeDiv'.$itr.'"><div class="form-group">
                <label class="col-sm-2 col-lg-2" for="email">&nbsp;&nbsp;Employee Code:</label>
                <div class="col-sm-4 col-lg-3">
                  <input type="text" class="form-control grpempcode" onkeyup="clearForm('.$itr.')" name="txtGrpEmpCode'.$itr.'" id="txtGrpEmpCode'.$itr.'" maxlength="30" required>
                  <small class="text-danger">Please dont add employee prefix</small> </div>
                <div class="col-sm-4 col-lg-3">
                  <button type="button" name="buttonGrpFindEmployee'.$itr.'" id="buttonGrpFindEmployee'.$itr.'" onclick="findDetails('.$itr.')" value="'.$itr.'" class="btn btn-primary">Find Details</button>
                </div>
              </div>
              <div id="employeedetails'.$itr.'" style="display:none;">
                <div class="col-lg-8">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="3" style="text-align:left">Employee Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td width="30%">Employee Name</td>
                          <td width="5%">:</td>
                          <td id="employeeName'.$itr.'" width=""></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td width="5%">:</td>
                          <td id="employeeEmail'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>Mobile</td>
                          <td width="5%">:</td>
                          <td id="employeeMobile'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>DOB</td>
                          <td width="5%">:</td>
                          <td id="employeeDob'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>Gender</td>
                          <td width="5%">:</td>
                          <td id="employeeGender'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>Meal Preference</td>
                          <td width="5%">:</td>
                          <td id="employeeMealPrf'.$itr.'"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="employeeDetailsNew'.$itr.'" style="display:none;" >
                <div class="form-group">
                  <label class="control-label col-sm-2" >Employee Name:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control newEmp'.$itr.'" id="txtEmpName'.$itr.'" name="txtEmpName'.$itr.'" maxlength="50" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Email:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control newEmp'.$itr.'" id="txtEmail'.$itr.'" name="txtEmail'.$itr.'" parsley-type="email" maxlength="50" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Mobile:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control newEmp'.$itr.'" id="txtMobile'.$itr.'" name="txtMobile'.$itr.'" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >DOB:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control erp-ncorp-date-field newEmp'.$itr.'" id="txtDob'.$itr.'" name="txtDob'.$itr.'" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Gender:</label>
                  <div class="col-lg-6">
                    <input type="radio"   id="radGender'.$itr.'" name="radGender'.$itr.'"  value="male" checked="checked">
                    Male
                    <input type="radio"   id="radGender'.$itr.'" name="radGender'.$itr.'"  value="female" >
                    Female </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Meal Preference:</label>
                  <div class="col-lg-6">
                    <input type="radio"   id="radMealPrf'.$itr.'" name="radMealPrf'.$itr.'"  value="vegetarian" checked="checked">
                    vegetarian
                    <input type="radio"   id="radMealPrf'.$itr.'" name="radMealPrf'.$itr.'"  value="non-vegetarian" >
                    non-vegetarian </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>
              <div id="empPassportDetails'.$itr.'" style="display:none;">
                <div class="col-lg-8">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="3" style="text-align:left">Employee Passport Details</th>
                        </tr>
                      </thead>
                      <tbody>
					    <tr>
                          <td width="30%">Passport Front View</td>
                          <td width="5%">:</td>
                          <td id="empPassportFrontView'.$itr.'" width=""></td>
                        </tr>
						<tr>
                          <td width="30%">Passport Back View</td>
                          <td width="5%">:</td>
                          <td id="empPassportBackView'.$itr.'" width=""></td>
                        </tr>
                        <tr>
                          <td width="30%">Passport Number</td>
                          <td width="5%">:</td>
                          <td id="empPassportNo'.$itr.'" width=""></td>
                        </tr>
                        <tr>
                          <td>Issued Country</td>
                          <td width="5%">:</td>
                          <td id="empIssuedCountry'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>Issued Place</td>
                          <td width="5%">:</td>
                          <td id="empIssuedPlace'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>Issued Date</td>
                          <td width="5%">:</td>
                          <td id="empIssuedDate'.$itr.'"></td>
                        </tr>
                        <tr>
                          <td>Expiry Date</td>
                          <td width="5%">:</td>
                          <td id="empExpiryDate'.$itr.'"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="empPassprtDetailsNew'.$itr.'" style="display:none;">
                <div class="page-header col-lg-6">
                  <h3>Employees Passport Details</h3>
                </div>
                <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Front View</label>
                        <div class="col-lg-4">
                            <?php //echo $rowcomp->EMP_Code; ?>
                            <!-- Outputs the image after save -->
    		                <div class="passport_front_img"></div><br />
    		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
    		                <input type="hidden" name="passport_front_image" id="empPassportFrontViewer" class="regular-text" />
    		                <!-- Outputs the save button -->
    		                <input type="button" class="passport_front_image button-primary button" value="Upload Image" id="uploadimage"/><br />
    		                <span class="description">Upload Back View of Your Passport></span>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-sm-2">Back View</label>
                        <div class="col-lg-4">
								<?php //echo $rowcomp->EG_Name; ?>
								 <!-- Outputs the image after save -->
							<div class="passport_back_img"></div><br />
							<!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
							<input type="hidden" name="passport_back_image" id="empPassportBackViewer" class="regular-text" />
							<!-- Outputs the save button -->
							<input type="button" class="passport_back_image button-primary button" value="Upload Image" id="uploadimage"/><br />
							<span class="description">Upload Back View of Your Passport</span>
							</div>
    					</div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Passport No.</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtPassportno'.$itr.'" id="txtPassportno'.$itr.'" class="form-control pptclass'.$itr.'" required="true" maxlength="30"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" title="Issued Country">Issued Country</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtIssuedCountry'.$itr.'" id="txtIssuedCountry'.$itr.'" class="form-control pptclass'.$itr.'" required="true" maxlength="30"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Issued Place</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtIssuedplc'.$itr.'" id="txtIssuedplc'.$itr.'" class="form-control pptclass'.$itr.'" required="true" maxlength="30"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Issued Date</label>
                  <div class="col-lg-4">
                    <input type="text" readonly="readonly" name="txtIssuedDAte'.$itr.'" id="txtIssuedDAte'.$itr.'" class="form-control erp-ncorp-date-field pptclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Expiry Date</label>
                  <div class="col-lg-4">
                    <input name="txtExpiryDate'.$itr.'" id="txtExpiryDate'.$itr.'" readonly="readonly" required="true" class="form-control pretraveldate expirydate pptclass'.$itr.'"  />
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>
              <div id="empVisaDetailsNew'.$itr.'" style="display:none;">
                <div class="page-header col-lg-6">
                  <h3>Employees Visa Details</h3>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Visa Document</label>
                  <div class="col-lg-4">
                  <div class="visa_img"></div><br />
                  <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="hidden" name="fileComplogo" id="fileComplogo" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type="button" class="visa_document button-primary button" value="Upload Document" id="uploadimage"/><br />
		                <span class="description">Upload Document of Your visa</span>
                </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Visa Number</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtVisa'.$itr.'" id="txtVisa'.$itr.'" class="form-control visaclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Country</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtCountry'.$itr.'" id="txtCountry'.$itr.'" class="form-control visaclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Issued At</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtIssuedAt'.$itr.'" id="txtIssuedAt'.$itr.'" class="form-control visaclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Type of Visa</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtTypeofvisa'.$itr.'" id="txtTypeofvisa'.$itr.'" class="form-control visaclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">No. of Entries</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtNoofEntries'.$itr.'" id="txtNoofEntries'.$itr.'" class="form-control visaclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Date of Issue</label>
                  <div class="col-lg-4">
                    <input type="text" readonly="true" name="txtDateofIssue'.$itr.'" id="txtDateofIssue'.$itr.'" class="form-control erp-ncorp-date-field visaclass'.$itr.'" required="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Expiry Date</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtDateofExpiry'.$itr.'" id="txtDateofExpiry'.$itr.'" class=" form-control pretraveldate visaclass'.$itr.'" readonly="true" required="true" onkeydown="return false;"/>
                  </div>
                </div>
              </div>
                <div class="clearfix"></div>
                <p>&nbsp;</p>
                <div class="col-lg-6 text-right" id="addmore'.$itr.'" style="display:none;">
                  <button class="btn btn-palevioletred" type="button" name="addmorebutton'.$itr.'" id="addmorebutton'.$itr.'" value="'.$itr.'" onclick="addmore('.$itr.')">+ Add More</button>
                </div>
                </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>';
              $this->send_success($content);
    }
    
    public function group_request_create(){
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //$this->send_success($posted);die;
        $etype				=	$posted['ectype'];
    	$selEmployees		=	$posted['hiddenEmp'];
    	$hiddenDraft		=	$posted['hiddenDraft'];
    	$expreqcode			=	genExpreqcode(1); 
    	$date				=	$posted['txtDate'];
    	$txtaExpdesc		=	$posted['txtaExpdesc'];
    	$selExpcat			=	$posted['selExpcat'];
    	$selModeofTransp	=	$posted['selModeofTransp'];
    	$from				=	$posted['from'];
    	$to					=	$posted['to'];
    	$selStayDur			=	$posted['selStayDur'];
    	$txtCost			=	$posted['txtCost'];
    	
    	$txtTotalCost		=	$posted['txtTotalCost'];
    	
    	
    	$addnewGroupRequest		=	$posted['addnewGroupRequest'];
    	
    	
    	 
    	
    	//  QUOTATION 
    	
    	$sessionid				=	$posted['sessionid'];
    	
    	$hiddenPrefrdSelected	=	$posted['hiddenPrefrdSelected'];
    	
    	$hiddenAllPrefered		=	$posted['hiddenAllPrefered'];
    	
    	/*$selProjectCode			=	$_POST['selProjectCode'];
    	
    	$selCostCenter			=	$_POST['selCostCenter'];*/
    	
    	
    	$radTrvPlan			=	$posted['radTrvPlan'];
    	
    	
    	$filename			=	$posted['filename'];
    	
    	$pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
                
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                        
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
    	
    	$count=count($txtCost);
    	
    	
    	
    	if(!is_numeric($addnewGroupRequest) || ($addnewGroupRequest != 3)){
    		
    		$_SESSION['msg'] = 1;
    		echo "failure 1";
    		//header("location:$filename");
    		exit;
    	}
    	
    	
    		
    	
    	// company prefix
    	
    	$getPrefix=$wpdb->get_row("SELECT COM_Prefix FROM company WHERE COM_Id='$compid'");
    			
    	$prefix=$getPrefix->COM_Prefix;
    	
    	
    	
    	// get employees 
    	
    	$fields = $posted['fields'];
    	
    
    	
    	
    	if($etype=="" || $expreqcode==""){
    			
    		$_SESSION['msg'] = 2;
    		echo "failure 2";
    		//header("location:$filename");
    		exit;
    		
    	
    	} else {
    	 
    	
    		$checked=false;
    		
    		for($i=0;$i<$count;$i++){
    			
    			$j=$i+1;
    			
    			if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]=="" || $txtTotalCost[$i]==""){
    			
    				$checked=true;
    				
    				break;
    			
    			}			
    			
    		
    		}
    		
    		//echo 'checked='.$checked; exit;
    		
    		
    		if($checked){
    		
    			$_SESSION['msg'] = 2;
    			//echo "failure 2";
    			//header("location:$filename");
    			//exit;
    		}
    		
    		
    		
    		// employee validation
    		
    		//echo $fields; exit;
    		
    		$fields = explode(",", $fields);
    
    	
    		$emparray =  $piid = $pasid  =  $vdid  =  array();
    		
    		
    		//$imdir="../company/upload/$compid/photographs/";
    		
    		
    		foreach($fields as $vals){
    		
    			
    			$txtGrpEmpCode		=	$posted['txtGrpEmpCode'.$vals];
    			
    			
    			$selsql = "
    			
    				SELECT
    				  emp.EMP_Id AS empid,
    				  EMP_Name AS empname,
    				  EMP_Phonenumber AS empmobile,
    				  PI_Id AS piid,
    				  PI_Gender AS gender,
    				  EMP_Email AS empemail,
    				  PI_DateofBirth AS dob,
    				  PI_MealPreference AS empmealprf
    				FROM
    				  employees emp,
    				  personal_information pi
    				WHERE
    				  EMP_Code = '$txtGrpEmpCode' AND emp.EMP_Id = pi.EMP_Id AND EMP_Status = 1 AND PI_Status = 1 AND emp.COM_Id = '$compid'
    			
    			";
    			
    			//echo $selsql; exit;
    			
    			
    		    $result = $wpdb->get_row($selsql);
    	 
    	 
    	 
    			
    			if(empty($result)){
    				
    					
    				//$pwd	=	generateRandomString();
    				
    				//$password=md5($pwd);
    				
    				
    		
    				$txtEmpName			=	$posted['txtEmpName'.$vals];
    				
    				$txtEmail			=	$posted['txtEmail'.$vals];
    				
    				$txtMobile			=	$posted['txtMobile'.$vals];
    				
    				$txtDob				=	$posted['txtDob'.$vals];
    				
    				$radGender			=	$posted['radGender'.$vals];
    				
    				$radMealPrf			=	$posted['radMealPrf'.$vals];
    				
    				
    				$dateInput = explode('-', $txtDob);
    				
    				$txtDob = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
    				
    		
    				
    				if($txtGrpEmpCode &&  $txtEmail &&  $txtEmpName &&  $txtMobile && $txtDob){
    				
    					
    					$prefix=null;
    		
                		$getPrefix=$wpdb->get_row("SELECT COM_Prefix FROM company WHERE COM_Id='$compid'");
                			
                		$prefix=$getPrefix->COM_Prefix;
                		
                		$empUsername	=	$prefix."-".$empcode;
    					
    					
    					$password=wp_generate_password(12);
            			$userdata = array(
                            'user_login'   => $empUsername,
                            'user_email'   => $txtEmail,
                            'first_name'   => $txtEmpName,
                            'display_name' => $txtEmpName,     
                        );
                        $userdata['user_pass'] = $password;
                        $userdata['role'] = 'employee';   
                        if($user_id  = wp_insert_user( $userdata )){
            			$employee_data = array(
                	        'COM_Id' => $compid,
                	        'EMP_Code' => $txtGrpEmpCode,
                	        'EMP_Email' => $txtEmail,
                	        'EMP_Username' => $empUsername,
                	        'user_id' => $user_id,
                	        'EMP_Name' => $txtEmpName,
                	        'EMP_Phonenumber' => $txtMobile,
                	        'Added_Mode' => '2',
                	    );     
            			$wpdb->insert('employees', $employee_data);
                        }
            			$newempuserid = $wpdb->insert_id; 
    				
    				
    					
    					
    					// INSERT INTO PERSONAL DETAILS
    					
    					if($newempuserid){
    						
    						$personalinfo_data = array(
                	        'EMP_Id' => $newempuserid,
                	        'PI_Gender' => $radGender,
                	        'PI_MealPreference' => $radMealPrf,
                	        'PI_DateofBirth' => $txtDob,
                	        );     
            			    $wpdb->insert('personal_information', $personalinfo_data);
            			    $piid = $wpdb->insert_id;
    					
    				
    					} else {
    					
    						//$_SESSION['msg'] = 2;
    						echo "2 employee creation fail";
    						//header("location:$filename");
    						exit;
    					
    					}
    					
    					
    					
    					
    				
    				} else {
    				
    					//$_SESSION['msg'] = 2;
    				    echo "2 fail";
    					//header("location:$filename");
    					exit;
    				
    				}
    			
    			
    			} else {
    			
    				$newempuserid = $result->empid;
    				
    				$pid = $result->piid;
    			
    			}
    			
    			
    			
    			
    			// adding employee codes to array to be inserted in request employee table
    			
    			$emparray[] = $newempuserid;
    			
    			//echo 'sdf='.$piid;exit;
    			
    			if($pid)
    			$piid[] = $pid;
    			
    			
    			if($radTrvPlan == 'international'){
    				
    				// passport details
    				
    				
    				$selsql = "
    						
    						SELECT
    						  PAS_Id,
    						  PAS_Passportno AS passno,
    						  PAS_IssuedCountry AS issudcntry,
    						  PAS_IssuedPlace AS issudplc,
    						  PAS_IssuedDate AS issuddate,
    						  PAS_ExpiryDate AS expirydate
    						FROM
    						  employees emp,
    						  passport_detials pd
    						WHERE
    						  EMP_Code = '$txtGrpEmpCode' AND emp.COM_Id = '$compid' AND emp.EMP_Id = pd.EMP_Id AND EMP_Status = 1 AND PAS_Status = 1
    					";
    				
    				
    					$psprtresult = $wpdb->get_row($selsql);
    					
    			
    			
    					if(empty($psprtresult)){
    														
    						
    						// passport details
    
    
    						$txtPassportno		=	$posted['txtPassportno'.$vals];
    						
    						$txtIssuedCountry	=	$posted['txtIssuedCountry'.$vals];
    						
    						$txtIssuedplc		=	$posted['txtIssuedplc'.$vals];
    						
    						$txtIssuedDAte		=	$posted['txtIssuedDAte'.$vals];
    						
    						$txtExpiryDate		=	$posted['txtExpiryDate'.$vals];
    						
    						$txtExpiryDate			=	implode("-", array_reverse(explode("/", $txtExpiryDate)));
    						
    						$imagePath1 = $posted['passport_front_image'.$vals];
    	                    $imagePath2 = $posted['passport_back_image'.$vals];
    	                    
    						$imagePath1 ? $imagePath1="'".$imagePath1."'" : $imagePath1="NULL";
    						
    						$imagePath2 ? $imagePath2="'".$imagePath2."'" : $imagePath2="NULL";
    						
    						
    						
    						
    						// passport details
        					$passport_data = array(
                	        'EMP_Id' => $newempuserid,
                	        'PAS_ImageFrontView' => $imagePath1,
                	        'PAS_ImageBackView' => $imagePath2,
                	        'PAS_Firstname' => $txtName,
                	        'PAS_Lastname' => $txtLastname,
                	        'PAS_Dateofbirth' => $txtDateofBirth,
                	        'PAS_Passportno' => $txtPassportno,
                	        'PAS_IssuedCountry' => $txtIssuedCountry,
                	        'PAS_IssuedPlace' => $txtIssuedplc,
                	        'PAS_IssuedDate' => $txtIssuedDAte,
                	        'PAS_ExpiryDate' => $txtExpiryDate,
                	        );     
            			    $wpdb->insert('passport_detials', $passport_data);
            			    $pasid[] = $wpdb->insert_id;
    					
    					} else {
    					
    						$pasid[] = $psprtresult->PAS_Id;
    					
    					}
    					
    					
    					
    					// visa details
    
    
    					$txtVisa			=	$posted['txtVisa'.$vals];
    					
    					$txtCountry			=	$posted['txtCountry'.$vals];
    					
    					$txtIssuedAt		=	$posted['txtIssuedAt'.$vals];	
    					
    					$txtTypeofvisa		=	$posted['txtTypeofvisa'.$vals];
    						
    					$txtNoofEntries		=	$posted['txtNoofEntries'.$vals];
    					
    					$txtDateofIssue		=	$posted['txtDateofIssue'.$vals];
    					
    					$txtDateofExpiry	=	$posted['txtDateofExpiry'.$vals];
    					
    					$txtDateofExpiry	=	str_replace("/", "", $txtDateofExpiry);
    					
    					
    					
    					$d	=	substr($txtDateofExpiry, 0, 2);
    					$m	=	substr($txtDateofExpiry, 2, 2);
    					$y	=	substr($txtDateofExpiry, 4, 4);
    					
    					$txtDateofExpiry	=	$y."-".$m."-".$d; 
    					
    					$imagePath3 = $posted['fileComplogo'.$vals];
    					
    					
    					$imagePath3 ? $imagePath3="'".$imagePath3."'" : $imagePath3="NULL";
    					
    					
    					
    					
    					$visa_data = array(
            	        'EMP_Id' => $newempuserid,
            	        'VD_Document' => $imagePath3,
            	        'VD_VisaNumber' => $txtVisa,
            	        'VD_Country' => $txtCountry,
            	        'VD_IssueAt' => $txtIssuedAt,
            	        'VD_Typeofvisa' => $txtTypeofvisa,
            	        'VD_NoofEntries' => $txtNoofEntries,
            	        'VD_DateofIssue' => $txtDateofIssue,
            	        'VD_DateofExpiry' => $txtDateofExpiry,
            	        );     
        			    $wpdb->insert('visa_details', $visa_data);
        			    $vdid[] = $wpdb->insert_id;
    				
    				    
    			
    			
    				}
    			
    			
    		
    		} // end of for loop
    		
    		//print_r($emparray); exit;
    		
    		// if employee validation fails exit
    		
    		if(empty($emparray)){
    			
    			//$_SESSION['msg'] = 2;
    			echo "empty array 2";
    			//header("location:$filename");
    			exit;
    		
    		}
    		
    		
    	
    		
    	
    	
    			$reqstatus=2; // AUTO APPROVED STATUS
    
    			$reqtype=4;  // group travel request
    			
    			
    			
    		
    		 	// insert into request
    			
    			$wpdb->insert('requests', array('REQ_Status' => 2, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'REQ_Type' => $reqtype, 'REQ_Method' => $radTrvPlan));
                $reqid = $wpdb->insert_id;
    			
    			$booking_rdids = array();
    			
    			
    			//print_r($vdid); exit;
    			
    			
    			if($reqid){
    			
    				
    				// insert into request_employee	
    			
    				$k = 0;
    				
    				
    				//print_r($vdid); exit;
    				
    				
    				foreach($emparray as $emp){
    				
    					if($radTrvPlan == 'international') // if international boarding add the visa details
    					$vdids = $vdid[$k];
    					else
    					$vdids = 0;
    					$wpdb->insert('request_employee', array('REQ_Id' => $reqid, 'EMP_Id' => $emp, 'VD_Id' => $vdids));
    					$lid = $wpdb->insert_id;
    					
    					$k++;
    					
    				}
    				
    				//exit;
    				
    			
    					
    					
    					// ADD REQUEST DETAILS
    					
    					 
    					
    					for($i=0; $i<$count;$i++)
    					{	
    					    $freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL";
    						$dateformat=$date[$i];
    						$dateformat=explode("-",$dateformat);
    						$dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];

    						($from[$i]=="n/a") ? $from[$i]="NULL" : $from[$i]="".$from[$i]."";
    						
    						($to[$i]=="n/a") ? $to[$i]="NULL" : $to[$i]="".$to[$i]."";
    						
    						($selStayDur[$i]=="n/a") ? $selStayDur[$i]="NULL" : $selStayDur[$i]="".$selStayDur[$i]."";
    						
    						
    						//echo 'sssssssss-'.$selStayDur[$i]; exit;	
    						
    						
    						$desc	=	addslashes($txtaExpdesc[$i]);
    						
    						if($freturn[$i] != "NULL"){
                		    $freturn=$freturn[$i];
                		    $freturn=explode("-",$freturn);
                		    $freturn=$freturn[2]."-".$freturn[1]."-".$freturn[0];
                		    }
    						if($freturn[$i] != "NULL")
    						$wpdb->insert('request_details', array('RD_Type'=> '2', 'pickup' => $pickup, 'dropoff' => $dropoff, 'REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturn, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i], 'RD_TotalCost' => $txtTotalCost[$i]));
                            else
                            $wpdb->insert('request_details', array('RD_Type'=> '2', 'pickup' => $pickup, 'dropoff' => $dropoff, 'REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i], 'RD_TotalCost' => $txtTotalCost[$i]));
                            
                            $rdid = $wpdb->insert_id;
    						
    						// insert a new booking request 
    							
    						$wpdb->insert('booking_status', array('RD_Id'=> $rdid,'BS_Status' => '1', 'BA_Id' => '1'));	
    						
    						
    						$booking_rdids[]=$rdid;
    					
    					
    						
    						
    						// GET  QUOTE
    						
    						 
    						
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
    					
    					
    					// raise booking request
    					
    					
    					$rdids=join(",", $booking_rdids);
    				
    					$actionButton=1;
    					
    					$grpReq = 1;
    					
    					
    					
    					//require("book-now-details.php");
    					
    					//echo $message_body; exit;
    					
    					//travelBooking($message_body, 1, 2);
    					
    					//$_SESSION['msg'] = 1;
    					$response = array('status' => 'success', 'message' => "You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Please wait for approval..  ");
                        $this->send_success($response);
    					
    			
    			} else {
    			
    				$response = array('status' => 'failure', 'message' => "Request Couldn\'t be added. Please try again");
                    $this->send_success($response);
    			
    			}
    			
    				
    			
    		}
    }
    
    public function update_booking_request(){
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //print_r($posted);die;
        $etype				=	$posted['ectype'];
    	$date				=	$posted['txtDate'];
    	$txtaExpdesc		=	$posted['txtaExpdesc'];
    	$selExpcat			=	$posted['selExpcat'];
    	$selModeofTransp	=	$posted['selModeofTransp'];
    	$from				=	$posted['from'];
    	$to					=	$posted['to'];
    	$selStayDur			=	$posted['selStayDur'];
    	$txtCost			=	$posted['txtCost'];
    	$reqid				=	$posted['reqid'];
    	$rdids				=	$posted['rdids'];
    	$selEmployees		=	$posted['selEmployees'];
    	$updateRequest		=	$posted['updateRequest'];
    	
    	//  QUOTATION 
    	
    	$sessionid				=	$posted['sessionid'];
    	
    	$hiddenPrefrdSelected	=	$posted['hiddenPrefrdSelected'];
    	
    	$hiddenAllPrefered		=	$posted['hiddenAllPrefered'];
    	
    	/*$selProjectCode			=	$_POST['selProjectCode'];
    	
    	$selCostCenter			=	$_POST['selCostCenter'];*/
    	
    	$pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
                
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                        
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
    	
    	$count=count($rdids);
    	
    	
    	$radTrvPlan			=	$posted['radTrvPlan'];
    	
    	$cnt = count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));
    	
    	$hidrowno	=	count($txtCost); 
    	
    	$freturn = $posted['flightReturn'];
    	
    	// get employees 
    	
    	$fields = $posted['fields'];
    		
    	
    	$txtTotalCost = $posted['txtTotalCost'];
    	
    	
    	$grpReq = null;
    	
    	$newrow = ($hidrowno - $cnt);
    	//$newrow = $hidrowno;
    	
    	if($reqid=="" || count($rdids)=="" || ($radTrvPlan != 'domestic' && $radTrvPlan != 'international')){
    		
    		$_SESSION['msg'] = 2;
    		
    		//header("location:$filename?reqid=$reqid");exit;
    	
    	} else {
    			
    		$checked=false;
    	
    		if($updateRequest==2){
    		
    			//echo $cnt; exit;
    			
    			
    			
    			for($i=0;$i<$newrow;$i++){
    				
    				$j=$i+1;
    				
    				
    				if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]==""){
    			
    					$checked=true;
    					
    					break;
    				
    				}
    				
    				
    			
    			}
    		
    		} else if($updateRequest == 5){
    		
    			
    			for($i=0;$i<$newrow;$i++){
    			
    				$j=$i+1;
    				
    				if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]=="" || $txtTotalCost[$i]==""){
    				
    					$checked=true;
    					
    					break;
    				
    				}			
    				
    			
    			}
    			
    			
    		
    		}
    		
    		
    		if($checked){
    		
    			//$_SESSION['msg'] = 2;
    			//header("location:$filename?reqid=$reqid");
    			//exit;
    			
    		}
    		
    		
    	}
    		
    		
    		//echo $fields; exit;
    		
    		
    		if($fields)
    		$fields = explode(",", rtrim($fields, ","));
    		
    		//print_r($fields); exit;
     
    		
    		if($updateRequest==5 && (!empty($fields))){
    		
    			//update_query("request_employee", "RE_Status=2, RE_UpdatedDate='$curdate'", "REQ_Id='$reqid' AND RE_Status=1", $filename);
    			
    			
    			
    			$emparray =  $piid = $pasid  =  $vdid  =  array();
    			
    			
    			$getPrefix=$wpdb->get_row("SELECT COM_Prefix FROM company WHERE COM_Id='$compid'");
    									
    			$prefix=$getPrefix->COM_Prefix;
    							
    							
    			
    			//$imdir="../company/upload/$compid/photographs/";		
    			
    			
    			//print_r($fields); exit;		
    		
    		
    			foreach($fields as $vals){
    						
    				
    					$txtGrpEmpCode		=	$_POST['txtGrpEmpCode'.$vals];
    					
    										
    					
    					$selsql = "
    		
    						SELECT
    						  emp.EMP_Id AS empid,
    						  EMP_Name AS empname,
    						  EMP_Phonenumber AS empmobile,
    						  PI_Id AS piid,
    						  PI_Gender AS gender,
    						  EMP_Email AS empemail,
    						  PI_DateofBirth AS dob,
    						  PI_MealPreference AS empmealprf
    						FROM
    						  employees emp
    						INNER JOIN
    						  personal_information ON emp.EMP_Id = personal_information.EMP_Id 
    						WHERE
    						  EMP_Code = '$txtGrpEmpCode'
    						  AND EMP_Status = 1 AND PI_Status = 1 AND emp.COM_Id = '$compid'
    					
    					";
    					
    					//echo $selsql; exit;
    					
    					
    					$result = $wpdb->get_row($selsql);
    			
    					
    					
    					
    					
    			 
    					
    					if(count($result) < 1){
    						
    							
    						$pwd	=	generateRandomString();
    						
    						$password = md5($pwd);
    						
    						
    				
    						$txtEmpName			=	$posted['txtEmpName'.$vals];
    						
    						$txtEmail			=	$posted['txtEmail'.$vals];
    						
    						$txtMobile			=	$posted['txtMobile'.$vals];
    						
    						$txtDob				=	$posted['txtDob'.$vals];
    						
    						$radGender			=	$posted['radGender'.$vals];
    						
    						$radMealPrf			=	$posted['radMealPrf'.$vals];
    						
    						
    						$dateInput = explode('/', $txtDob);
    						$txtDob = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
    						
    						
    						
    						
    						// company prefix
    							
    						$empUsername	=	$prefix."-".$txtGrpEmpCode;
    							
    						
    						
    						//echo $txtGrpEmpCode .'&&'.  $txtEmail .'&&'.  $empUsername .'&&'.  $txtEmpName .'&&'.  $txtMobile .'&&'. $txtDob; exit;
    				
    						
    						if($txtGrpEmpCode &&  $txtEmail &&  $empUsername &&  $txtEmpName &&  $txtMobile && $txtDob){
    						    
    						    $wpdb->insert('employees', array('COM_Id' => $compid, 'EMP_Code' => $txtGrpEmpCode, 'EMP_Email' => $txtEmail, 'EMP_Username' => $empUsername, 'EMP_Password' => $password, 'EMP_Name' => $txtEmpName, 'EMP_Phonenumber' => $txtMobile, 'Added_Mode' => '2'));
                                $newempuserid = $wpdb->insert_id;
    						
    							// INSERT INTO PERSONAL DETAILS
    							
    							if($newempuserid){
    								$wpdb->insert('personal_information', array('EMP_Id' => $newempuserid, 'PI_Gender' => $radGender, 'PI_MealPreference' => $radMealPrf, 'PI_DateofBirth' => $txtDob));

    							} else {
    					
    								//$_SESSION['msg'] = 3;
    								echo "3";
    								//header("location:$filename?reqid=$reqid");
    								exit;
    							
    							}
    							
    						
    						} else {
    							
    							$_SESSION['msg'] = 5;
    				            echo "5";
    							//header("location:$filename?reqid=$reqid");
    							exit;
    						
    						}
    					
    					
    					} else {
    					
    						$newempuserid = $result->empid;
    						
    						$pid = $result->piid;
    					
    					}
    					
    					// adding employee codes to array to be inserted in request employee table
    					
    					$emparray[] = $newempuserid;
    					
    					
    					if($pid)
    						$piid[] = $pid;
    						
    						
    						if($radTrvPlan == 'international'){
    				
    							// passport details
    							
    							
    							$selsql = "
    									
    									SELECT
    									  PAS_Id,
    									  PAS_Passportno AS passno,
    									  PAS_IssuedCountry AS issudcntry,
    									  PAS_IssuedPlace AS issudplc,
    									  PAS_IssuedDate AS issuddate,
    									  PAS_ExpiryDate AS expirydate
    									FROM
    									  employees emp,
    									  passport_detials pd
    									WHERE
    									  EMP_Code = '$txtGrpEmpCode' AND emp.COM_Id = '$compid' AND emp.EMP_Id = pd.EMP_Id AND EMP_Status = 1 AND PAS_Status = 1
    								";
    							
    							    
    								$psprtresult = $wpdb->get_row("$selsql");
    								
    						
    						
    								if(empty($psprtresult)){
    																	
    									
    									// passport details
    			
    			
    									$txtPassportno		=	$posted['txtPassportno'.$vals];
    									
    									$txtIssuedCountry	=	$posted['txtIssuedCountry'.$vals];
    									
    									$txtIssuedplc		=	$posted['txtIssuedplc'.$vals];
    									
    									$txtIssuedDAte		=	$posted['txtIssuedDAte'.$vals];
    									
    									$txtExpiryDate		=	$posted['txtExpiryDate'.$vals];
    									
    									$txtExpiryDate			=	implode("-", array_reverse(explode("-", $txtExpiryDate)));
    									
    									
    									
    									
    									/*
    									$imagename	=	$_FILES['fileFrontView'.$vals]['name'];
    									$imtype		=	$_FILES['fileFrontView'.$vals]['type'];
    									$imsize		=	$_FILES['fileFrontView'.$vals]['size'];
    									$tmpname 	= 	$_FILES['fileFrontView'.$vals]['tmp_name'];
    									
    									
    									
    								
    									
    									
    									
    									
    									if($imagename)
    									{
    										$ext = substr(strrchr($imagename, "."), 1);
    										
    										$imagePath = $imdir.md5(rand() * time()) . ".$ext";
    										
    										$imgsuccess = createThumbnail($tmpname, $imagePath, 600);
    										
    										$imagePath=$imdir.$imgsuccess;
    												
    										$imagePath1 = str_replace($imdir,"",$imagePath);
    			
    										
    									}
    									
    									
    									
    									$imagename	=	$_FILES['fileBackView'.$vals]['name'];
    									$imtype		=	$_FILES['fileBackView'.$vals]['type'];
    									$imsize		=	$_FILES['fileBackView'.$vals]['size'];
    									$tmpname 	= 	$_FILES['fileBackView'.$vals]['tmp_name'];
    									
    									
    									if($imagename)
    									{
    										$ext = substr(strrchr($imagename, "."), 1);
    										
    										$imagePath = $imdir.md5(rand() * time()) . ".$ext";
    										
    										$imgsuccess = createThumbnail($tmpname, $imagePath, 600);
    										
    										$imagePath=$imdir.$imgsuccess;
    												
    										$imagePath2 = str_replace($imdir,"",$imagePath);
    										
    										
    									}
    									*/
    									$imagePath1 = $posted['passport_front_image'];
    	                                $imagePath2 = $posted['passport_back_image'];
    									$imagePath1 ? $imagePath1="'".$imagePath1."'" : $imagePath1="NULL";
    									
    									$imagePath2 ? $imagePath2="'".$imagePath2."'" : $imagePath2="NULL";
    									
    									
    									// passport details
                    					$passport_data = array(
                            	        'EMP_Id' => $newempuserid,
                            	        'PAS_ImageFrontView' => $imagePath1,
                            	        'PAS_ImageBackView' => $imagePath2,
                            	        'PAS_Firstname' => $txtName,
                            	        'PAS_Lastname' => $txtLastname,
                            	        'PAS_Dateofbirth' => $txtDateofBirth,
                            	        'PAS_Passportno' => $txtPassportno,
                            	        'PAS_IssuedCountry' => $txtIssuedCountry,
                            	        'PAS_IssuedPlace' => $txtIssuedplc,
                            	        'PAS_IssuedDate' => $txtIssuedDAte,
                            	        'PAS_ExpiryDate' => $txtExpiryDate,
                            	        );     
                        			    $wpdb->insert('passport_detials', $passport_data);
                        			    $pasid[] = $wpdb->insert_id;
    									
    								
    								} else {
    								
    									$pasid[] = $psprtresult->PAS_Id;
    								
    								}
    								
    								
    								
    								// visa details
    			
    			
    								$txtVisa			=	$posted['txtVisa'.$vals];
    								
    								$txtCountry			=	$posted['txtCountry'.$vals];
    								
    								$txtIssuedAt		=	$posted['txtIssuedAt'.$vals];	
    								
    								$txtTypeofvisa		=	$posted['txtTypeofvisa'.$vals];
    									
    								$txtNoofEntries		=	$posted['txtNoofEntries'.$vals];
    								
    								$txtDateofIssue		=	$posted['txtDateofIssue'.$vals];
    								
    								$txtDateofExpiry	=	$posted['txtDateofExpiry'.$vals];
    								
    								$txtDateofExpiry	=	str_replace("-", "", $txtDateofExpiry);
    								
    								
    								
    								$d	=	substr($txtDateofExpiry, 0, 2);
    								$m	=	substr($txtDateofExpiry, 2, 2);
    								$y	=	substr($txtDateofExpiry, 4, 4);
    								
    								$txtDateofExpiry	=	$y."-".$m."-".$d; 
    								
    								/*
    								$imagename	=	$_FILES['fileComplogo'.$vals]['name'];
    								$imtype		=	$_FILES['fileComplogo'.$vals]['type'];
    								$imsize		=	$_FILES['fileComplogo'.$vals]['size'];
    								$tmpname 	=	$_FILES['fileComplogo'.$vals]['tmp_name'];
    								
    								
    								if($imagename)
    								{
    								
    									$allowedExts = array("pdf"); 
    									$allowedMimeTypes = array( 
    										  'application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf'
    										);
    										
    									$extension = end(explode('.', $imagename));
    									$extension = strtolower($extension);
    									$matchExtns=in_array($extension,$allowedExts);
    									
    									$photoAllowed=0;
    									
    									
    									
    									if($matchExtns && in_array( $imtype, $allowedMimeTypes ))
    									{
    											  
    										$photoAllowed=1;
    										
    										$ext = substr(strrchr($imagename, "."), 1);
    									
    										$imagePath = md5(rand() * time()) . ".$ext";
    										
    										//echo $imdir.$imagePath; exit;
    										
    										move_uploaded_file($tmpname, $imdir . $imagePath); 
    													
    										$imagePath3 = str_replace($imdir,"",$imagePath);
    														
    										
    									}
    									
    									
    								}
    								*/
    								$imagePath3 = $posted['fileComplogo'];
    								$imagePath3 ? $imagePath3="'".$imagePath3."'" : $imagePath3="NULL";
    								
    								
    								$visa_data = array(
                        	        'EMP_Id' => $newempuserid,
                        	        'VD_Document' => $imagePath3,
                        	        'VD_VisaNumber' => $txtVisa,
                        	        'VD_Country' => $txtCountry,
                        	        'VD_IssueAt' => $txtIssuedAt,
                        	        'VD_Typeofvisa' => $txtTypeofvisa,
                        	        'VD_NoofEntries' => $txtNoofEntries,
                        	        'VD_DateofIssue' => $txtDateofIssue,
                        	        'VD_DateofExpiry' => $txtDateofExpiry,
                        	        );     
                    			    $wpdb->insert('visa_details', $visa_data);
                    			    $vdid[] = $wpdb->insert_id;
    								
    								
    							} // if internation condition
    				
    				
    				
    				
    			
    			} // end of for loop
    					
    			
    			//print_r($emparray); exit;
    			
    			// if employee validation fails exit
    			
    			
    			if(empty($emparray)){
    				 
    				$_SESSION['msg'] = 5;
    				echo "5last";
    				//header("location:$filename?reqid=$reqid");
    				exit;
    			
    			} 
    			
    			
    		
    				
    				
    				// insert into request_employee	
    				
    				
    				if(!empty($emparray)){
    
    					$k = 0;
    					
    					foreach($emparray as $emp){
    					
    						if($radTrvPlan == 'international') // if international boarding add the visa details
    						$vdids = $vdid[$k];
    						else
    						$vdids = 0;
    						$wpdb->insert('request_employee', array('REQ_Id' => $reqid, 'EMP_Id' => $emp, 'VD_Id' => $vdids));
    						
    						$k++;
    						
    					}
    				
    				}
    			
    		
    		
    		}
    		
    		
    		$booking_rdids = array();
    		
    		 
    		//echo $updateRequest; exit;
    		
    		if($updateRequest == '5'){
    		
    		    
    			$rowreq=$wpdb->get_row("SELECT COUNT(RE_Id) AS cntEmp FROM request_employee WHERE REQ_Id='$reqid' AND RE_Status = 1");
    			
    			$empCnt = $rowreq->cntEmp;
    			
    			//echo $empCnt; exit;
    		
    		
    			for($i = 0; $i < $cnt; $i++)
    			{
    			
    				$wpdb->update('request_details', array('RD_TotalCost'=>RD_Cost * $empCnt), array('RD_Id'=>$rdids[$i]));
		
    				$booking_rdids[] = $rdids[$i];	
    			
    			
    			}
    			
    		
    		}
    		
    	
    		
    		//echo $hidrowno .'!='. $cnt; exit;
    		
    		
    		if($hidrowno != $cnt){

    			for($i = 0; $i < $newrow; $i++)
    			{
    			    $freturn[$i] ? $freturn[$i] = "" . $freturn[$i] . "" : $freturn[$i] = "NULL";
    				$dateformat=$date[$i];
    					
    				$dateformat=explode("-",$dateformat);
    				$dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];
    				
    				if($from[$i]=="n/a")
    				$from[$i]=NULL;
    				
    				
    				if($to[$i]=="n/a")
    				$to[$i]=NULL;
    				
    				if($selStayDur[$i]=="n/a")
    				$selStayDur[$i]=NULL;
    				
    						
    				$desc	=	addslashes($txtaExpdesc[$i]);
    				if($freturn[$i] != "NULL"){
        		    $freturn=$freturn[$i];
        		    $freturn=explode("-",$freturn);
        		    $freturn=$freturn[2]."-".$freturn[1]."-".$freturn[0];
        		    }
        		    if(!$txtTotalCost[$i])
        		    $txtTotalCost[$i] = "null";
        		   
        		    if($freturn[$i] != "NULL")
    				$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturn, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i], 'RD_TotalCost' => $txtTotalCost[$i]));
    				else
    				$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'pickup' => $pickup, 'dropoff' => $dropoff, 'RD_Dateoftravel' => $dateformat, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i], 'RD_TotalCost' => $txtTotalCost[$i]));

    				$rdid = $wpdb->insert_id;//echo $rdid;die;
    				//$this->send_success($rdid);
    				
    				
    				// GET QUOTATION
    				
    				$booking_rdids[] = $rdid; 
    				
    				
    				    
    					
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
    			
    				switch($updateRequest){
    					
    					case 2:
    						$bookingcost = $txtCost[$i];
    					break;
    					
    					case 5:
    						$bookingcost = $txtTotalCost[$i];
    						$grpReq = 1;
    					break;
    				
    				}
    				
    				
    				
    				
    				// insert into booking status
    				$wpdb->insert( 'booking_status', array( 'RD_Id' => $rdid, 'BS_Status' => '1', 'BA_Id' => '1'));
    				//$bsid=insert_query("booking_status", "RD_Id, BS_Status, BS_TicketAmnt, BA_Id, BA_ActionDate", "'$rdid', 1, '$bookingcost', 1, '$curdatetime'", $filename);
    				
    				
    				
    				
    				
    					
    			} // end of for loop
    		
    		
    	} // end of outer if loop
    	
    	
    		// if any edit occured send a mail to travel agent user saying edit has occured
    		
    		
    			//print_r($booking_rdids);exit;
    	
    	
    			$rdids=join(",", $booking_rdids);
    						
    			if($rdids){
    			
    				$actionButton = 1;
    				
    				$editaction = 1;
    				
    				//require("book-now-details.php");
    				
    				//echo $message_body; exit;
    				
    				//travelBooking($message_body, 1, 2);
    			
    			}
    		
    			$response = array('status' => 'success', 'message' => "You have successfully update this Request");
                $this->send_success($response);
    }
    
    public function booking_request_create(){
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        //$this->send_success($posted);die;
        $etype				=	$posted['ectype'];
    	$selEmployees		=	$posted['hiddenEmp'];
    	$hiddenDraft		=	$posted['hiddenDraft'];
    	$expreqcode			=	genExpreqcode(1); 
    	$date				=	$posted['txtDate'];
    	$txtaExpdesc		=	$posted['txtaExpdesc'];
    	$selExpcat			=	$posted['selExpcat'];
    	$selModeofTransp	=	$posted['selModeofTransp'];
    	$from				=	$posted['from'];
    	$to					=	$posted['to'];
    	$selStayDur			=	$posted['selStayDur'];
    	$txtCost			=	$posted['txtCost'];
    	$addnewRequest		=	$posted['addnewRequesttype'];
    	
    	//  QUOTATION 
    	
    	$sessionid				=	$posted['sessionid'];
    	
    	$hiddenPrefrdSelected	=	$posted['hiddenPrefrdSelected'];
    	
    	$hiddenAllPrefered		=	$posted['hiddenAllPrefered'];
    	
    	$selProjectCode			=	$posted['selProjectCode'];
    	
    	$selCostCenter			=	$posted['selCostCenter'];
    	
    	$pickup = $posted['pickup'];
        
        $dropoff = $posted['dropoff'];
                
        $pickup ? $pickup = "" . $pickup . "" : $pickup = "NULL";
                        
        $dropoff ? $dropoff = "" . $dropoff . "" : $dropoff = "NULL";
    	
    	
    	$filename			=	$posted['filename'];
    	
    	
    	$count=count($txtCost);
    	
    	     
    	// basic details
    	
    	
    	
    	
    	$radTrvPlan			=	$posted['radTrvPlan'];
    	
    	$txtEmpName			=	$posted['txtEmpName'];
    	
    	$txtEmail			=	$posted['txtEmail'];
    	
    	$txtMobile			=	$posted['txtMobile'];
    	
    	$txtDob				=	$posted['txtDob'];
    	
    	$radGender			=	$posted['radGender'];
    	
    	$radMealPrf			=	$posted['radMealPrf'];
    	
    	$empcode		 	= 	trim($posted['empcode']);
    	
    	$dateInput = explode('-', $txtDob);
    	$txtDob = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
    	
    	
    	
    	
    	
    	// passport details
    	
    	
    	$txtPassportno		=	$posted['txtPassportno'];
    	
    	$txtIssuedCountry	=	$posted['txtIssuedCountry'];
    	
    	$txtIssuedplc		=	$posted['txtIssuedplc'];
    	
    	$txtIssuedDAte		=	$posted['txtIssuedDAte'];
    	
    	$txtExpiryDate		=	$posted['txtExpiryDate'];
    	
    	$txtExpiryDate			=	implode("-", array_reverse(explode("/", $txtExpiryDate)));
    	
    	
    	
    	/*$fileFrontViewoldfile		=	$_POST['fileFrontViewoldfile'];
    	
    	$fileBackViewoldfile		=	$_POST['fileBackViewoldfile'];*/
    	
    	/*
    	$imagename	=	$_FILES['fileFrontView']['name'];
    	$imtype		=	$_FILES['fileFrontView']['type'];
    	$imsize		=	$_FILES['fileFrontView']['size'];
    	$tmpname 	= 	$_FILES['fileFrontView']['tmp_name'];
    	
    	
    	
    
    	$imdir="../company/upload/$compid/photographs/";
    	
    	if($imagename)
    	{
    		$ext = substr(strrchr($imagename, "."), 1);
    		
    		$imagePath = $imdir.md5(rand() * time()) . ".$ext";
    		$imgsuccess = createThumbnail($tmpname, $imagePath, 600);
    		
    		$imagePath=$imdir.$imgsuccess;
    				
    		$imagePath1 = str_replace($imdir,"",$imagePath);
    		
    	}	
    	
    	
    	
    	$imagename	=	$_FILES['fileBackView']['name'];
    	$imtype		=	$_FILES['fileBackView']['type'];
    	$imsize		=	$_FILES['fileBackView']['size'];
    	$tmpname 	= 	$_FILES['fileBackView']['tmp_name'];
    	
    	
    	if($imagename)
    	{
    		$ext = substr(strrchr($imagename, "."), 1);
    		
    		$imagePath = $imdir.md5(rand() * time()) . ".$ext";
    		
    		$imgsuccess = createThumbnail($tmpname, $imagePath, 600);
    		
    		$imagePath=$imdir.$imgsuccess;
    				
    		$imagePath2 = str_replace($imdir,"",$imagePath);
    		
    	}
    	*/
    	$imagePath1 = $posted['passport_front_image'];
    	$imagePath2 = $posted['passport_back_image'];
    	$imagePath1 ? $imagePath1="'".$imagePath1."'" : $imagePath1="NULL";
    	
    	$imagePath2 ? $imagePath2="'".$imagePath2."'" : $imagePath2="NULL";
    	
    	
    	
    	
    
    	
    		
    		
    		
    	if(!is_numeric($addnewRequest) || ($addnewRequest > 3)){
    		
    		//$_SESSION['msg'] = 2;
    		//header("location:$filename");
    		echo "addnewRequest";
    		exit;
    	}
    	
    	
    	
    	if($etype=="" || $expreqcode=="" || $empcode==""){
    			
    		
    		//$_SESSION['msg'] = 2;
    		//header("location:$filename");
    		exit;
    	
    	} else {
    	
    		// add employee details
    				
    		$vdid = "null";
    		
    		
    		//echo 'sdfdsss';exit;
    		
    		
    		
    			
    		$selsql = "
    		
    			SELECT
    			  emp.EMP_Id AS empid,
    			  EMP_Name AS empname,
    			  EMP_Phonenumber AS empmobile,
    			  PI_Id AS piid,
    			  PI_Gender AS gender,
    			  EMP_Email AS empemail,
    			  PI_DateofBirth AS dob,
    			  PI_MealPreference AS empmealprf
    			FROM
    			  employees emp,
    			  personal_information pi
    			WHERE
    			  EMP_Code = '$empcode' AND emp.EMP_Id = pi.EMP_Id AND EMP_Status = 1 AND PI_Status = 1 AND emp.COM_Id = '$compid'
    		
    		";
    		
    		//echo $selsql; exit;
    		
    		
    		$result = $wpdb->get_row($selsql);
    		
    		//if(empty($result)) echo '1'; else echo '2'; exit;
    		
    		
    		$prefix=null;
    		
    		$getPrefix=$wpdb->get_row("SELECT COM_Prefix FROM company WHERE COM_Id='$compid'");
    			
    		$prefix=$getPrefix->COM_Prefix;
    		
    		$empUsername	=	$prefix."-".$empcode;
     
     		
    		
    		//echo count($result); exit;
     
     		
    		if(empty($result)){
    		
    	        $password=wp_generate_password(12);
    			$userdata = array(
                    'user_login'   => $empUsername,
                    'user_email'   => $txtEmail,
                    'first_name'   => $txtEmpName,
                    'display_name' => $txtEmpName,     
                );
                $userdata['user_pass'] = $password;
                $userdata['role'] = 'employee';   
                if($user_id  = wp_insert_user( $userdata )){
    			$employee_data = array(
        	        'COM_Id' => $compid,
        	        'EMP_Code' => $empcode,
        	        'EMP_Email' => $txtEmail,
        	        'EMP_Username' => $empUsername,
        	        'user_id' => $user_id,
        	        'EMP_Name' => $txtEmpName,
        	        'EMP_Phonenumber' => $txtMobile,
        	        'Added_Mode' => '2',
        	    );     
    			$wpdb->insert('employees', $employee_data);
                }
    			$newempuserid = $wpdb->insert_id;
    			
    			// INSERT INTO PERSONAL DETAILS
    			
    			if($newempuserid){
    			    
    			    $personalinfo_data = array(
        	        'EMP_Id' => $newempuserid,
        	        'PI_Gender' => $radGender,
        	        'PI_MealPreference' => $radMealPrf,
        	        'PI_DateofBirth' => $txtDob,
        	        );     
    			    $wpdb->insert('personal_information', $personalinfo_data);
    			    $piid = $wpdb->insert_id;
    				
    			} else {
    				
    				//$_SESSION['msg'] = 2;
    				
    				//header("location:$filename");
    				exit;
    			
    			}
    			
    		
    		} else {
    		
    				$newempuserid = $result->empid;
    				
    				$piid = $result->piid;
    				
    			
    		
    		}
    		
    		
    		
    		if($radTrvPlan == 'international'){
    			
    				// passport details
    				
    				
    				$selsql = "SELECT PAS_Id, PAS_Passportno as passno, PAS_IssuedCountry as issudcntry, PAS_IssuedPlace as issudplc, PAS_IssuedDate as issuddate, PAS_ExpiryDate as expirydate FROM passport_detials WHERE EMP_Id='$newempuserid' AND PAS_Status = 1";
    				
    				
    				$psprtresult = $wpdb->get_row($selsql);
    				
    		
    		
    				if(empty($psprtresult)){
    				
    				
    					// passport details
    					$passport_data = array(
            	        'EMP_Id' => $newempuserid,
            	        'PAS_ImageFrontView' => $imagePath1,
            	        'PAS_ImageBackView' => $imagePath2,
            	        'PAS_Firstname' => $txtName,
            	        'PAS_Lastname' => $txtLastname,
            	        'PAS_Dateofbirth' => $txtDateofBirth,
            	        'PAS_Passportno' => $txtPassportno,
            	        'PAS_IssuedCountry' => $txtIssuedCountry,
            	        'PAS_IssuedPlace' => $txtIssuedplc,
            	        'PAS_IssuedDate' => $txtIssuedDAte,
            	        'PAS_ExpiryDate' => $txtExpiryDate,
            	        );     
        			    $wpdb->insert('passport_detials', $passport_data);
        			    $pasid = $wpdb->insert_id;
    					
    				} else {
    				
    					$pasid = $psprtresult->PAS_Id;
    				
    				}
    				
    				// insert visa details
    	
    	
    				$txtVisa			=	$posted['txtVisa'];
    				
    				$txtCountry			=	$posted['txtCountry'];
    				
    				$txtIssuedAt		=	$posted['txtIssuedAt'];	
    				
    				$txtTypeofvisa		=	$posted['txtTypeofvisa'];
    					
    				$txtNoofEntries		=	$posted['txtNoofEntries'];
    				
    				$txtDateofIssue		=	$posted['txtDateofIssue'];
    				
    				$txtDateofExpiry	=	$posted['txtDateofExpiry'];
    				
    				$txtDateofExpiry	=	str_replace("/", "", $txtDateofExpiry);
    				
    				
    				
    				$d	=	substr($txtDateofExpiry, 0, 2);
    				$m	=	substr($txtDateofExpiry, 2, 2);
    				$y	=	substr($txtDateofExpiry, 4, 4);
    				
    				$txtDateofExpiry	=	$y."-".$m."-".$d; 
    				
    				$imagePath3 = $posted['fileComplogo'];
    				
    				$imagePath3 ? $imagePath3="'".$imagePath3."'" : $imagePath3="NULL";
    				
    				$visa_data = array(
            	        'EMP_Id' => $newempuserid,
            	        'VD_Document' => $imagePath3,
            	        'VD_VisaNumber' => $txtVisa,
            	        'VD_Country' => $txtCountry,
            	        'VD_IssueAt' => $txtIssuedAt,
            	        'VD_Typeofvisa' => $txtTypeofvisa,
            	        'VD_NoofEntries' => $txtNoofEntries,
            	        'VD_DateofIssue' => $txtDateofIssue,
            	        'VD_DateofExpiry' => $txtDateofExpiry,
            	        );     
        			    $wpdb->insert('visa_details', $visa_data);
        			    $vdid = $wpdb->insert_id;
      
    		}
     
    	
    		$checked=false;
    		
    		for($i=0;$i<$count;$i++){
    			
    			$j=$i+1;
    			
    			if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]==""){
    			
    				$checked=true;
    				
    				break;
    			
    			}			
    			
    		
    		}
    		
    		//echo 'checked='.$checked; exit;
    		
    		
    		if($checked){
    			//$_SESSION['msg'] = 2;
    			//header("location:$filename");exit;
    		}
		
		
	}
	
	if($newempuserid){
	
			$reqstatus=2; // AUTO APPROVED STATUS
			
			$reqtype=2;  // travel desk created request without approval
		
		 // insert into request
		    
		    $wpdb->insert('requests', array('REQ_Status' => 2, 'REQ_Code' => $expreqcode, 'COM_Id' => $compid, 'RT_Id' => $etype, 'REQ_Type' => $reqtype, 'REQ_Method' => $radTrvPlan));
            $reqid = $wpdb->insert_id;
		    
			$booking_rdids = array();
			
			if($reqid){
			
				// insert into request_employee
				    
				    $wpdb->insert('request_employee', array('REQ_Id' => $reqid, 'EMP_Id' => $newempuserid, 'VD_Id' => $vdid));
					
					for($i=0;$i<$count;$i++)
					{		
						$dateformat=$date[$i];
						$dateformat=explode("-",$dateformat);
						$dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];
						
						($from[$i]=="n/a") ? $from[$i]="NULL" : $from[$i]="".$from[$i]."";
						
						($to[$i]=="n/a") ? $to[$i]="NULL" : $to[$i]="".$to[$i]."";
						
						($selStayDur[$i]=="n/a") ? $selStayDur[$i]="NULL" : $selStayDur[$i]="'".$selStayDur[$i]."'";	
						
						
						$desc	=	addslashes($txtaExpdesc[$i]);
						
						$wpdb->insert('request_details', array('RD_Type'=> '2', 'pickup' => $pickup, 'dropoff' => $dropoff, 'REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturn, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i]));
                        $rdid = $wpdb->insert_id;
                      
					
						// insert a new booking request 
						$wpdb->insert('booking_status', array('RD_Id'=> $rdid,'BS_Status' => '1', 'BA_Id' => '1'));	
						
						
						$booking_rdids[]=$rdid;
					
					
						
						
						// GET  QUOTE
						
						if($addnewRequest==2){
						
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
					
					$response = array('status' => 'success', 'message' => "You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Please wait for approval..  ");
                    $this->send_success($response);
					//echo $pasid.'-'.$vdid; exit;
					
					
					// raise booking request
					
					
					//$rdids=join(",", $booking_rdids);
				
					//$actionButton=1;
					
					
					//require("book-now-details.php");
					
					
					//echo $message_body; exit;
					
					
					//travelBooking($message_body, 1, 2);
					
					
					//echo $filename; exit;
					
					
					//$_SESSION['msg'] = 1;
					
					//header("location:$filename?reqid=$expreqcode");exit;	
					
			
			} else {
				
				//$_SESSION['msg'] = 2;
				$response = array('status' => 'failure', 'message' => "Request Couldn\'t be added. Please try again");
                $this->send_success($response);
				//header("location:$filename");exit;
			
			}
			
			
		} else {
			
			//$_SESSION['msg'] = 7;
			echo "7";die;
			//header("location:$filename");
			exit;
		
		}
    }
    
    public function get_emp_details(){
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);
        // get employee basic details
        $txtEmpCode = $posted['txtEmpCode'];
        $trvPlan = $posted['trvPlan'];
        $selsql = "
		
			SELECT
			  emp.EMP_Id AS empid,
			  EMP_Name AS empname,
			  EMP_Phonenumber AS empmobile,
			  PI_Gender AS gender,
			  EMP_Email AS empemail,
			  PI_DateofBirth AS dob,
			  PI_MealPreference AS empmealprf
			FROM
			  employees emp,
			  personal_information pi
			WHERE
			  emp.EMP_Id = pi.EMP_Id AND
			  EMP_Code = '$txtEmpCode' AND EMP_Status = 1 AND PI_Status = 1 AND emp.COM_Id = '$compid'
		
		";
		$result = $wpdb->get_row($selsql);

		if(count($result) > 0){

        	$return['status'] = 1;
        	
        	$return['response'] = $result;
        	
        	
        	// get passport details 
        	
        	if($trvPlan == 'international'){
        	
        		
        		
        		$selsql = "SELECT PAS_ImageFrontView as psprtfrontview, PAS_ImageBackView as psprtbackview, PAS_Passportno as passno, PAS_IssuedCountry as issudcntry, PAS_IssuedPlace as issudplc, PAS_IssuedDate as issuddate, PAS_ExpiryDate as expirydate FROM employees emp, passport_detials pd WHERE EMP_Code='$txtEmpCode' AND emp.COM_Id = '$compid' AND emp.EMP_Id = pd.EMP_Id AND EMP_Status = 1 AND PAS_Status = 1";
        		
        		
        		$result = $wpdb->get_row($selsql);
        		
        		
        		//echo count($result); exit;
        		
        		
        		
        		if(count($result) > 0){
        		
        			$return['passportstatus'] 	= 1;
        	
        			$return['passportresponse'] = $result;
        		
        		} else {
        			
        			$return['passportstatus'] = 2;
        		
        		}
        		
        	
        	}
        	
        	
        } else {
        
        	$return['status'] = 2;	
        
        }

        $this->send_success($return); 
    }
	
	 public function rise_invoice() {
        global $wpdb;
         $supid = $_SESSION['supid']; 
		 $cmpid = '52';
        $posted = array_map('strip_tags_deep', $_POST);
        $data = $posted;
        $array = $data['select'];
        foreach ($array as $value) {
          //$response = $wpdb->get_results("SELECT tdc.TDC_Id FROM travel_desk_claims tdc, travel_desk_claim_requests tdcr WHERE
	 // tdc.SUP_Id = '$supid' AND tdc.COM_Id = '$cmpid' AND tdcr.REQ_Id IN ($value) AND tdc.TDC_Id = tdcr.TDC_Id AND TDCR_Status = 1"); 
		 $response = $wpdb->get_row("SELECT TDBA_Id, TDBA_AccountNumber FROM travel_desk_bank_account WHERE SUP_Id = '$supid' AND  TDBA_Status=1 AND TDBA_Type = 2");
	      $this->send_success($response);
        }
    }
	
	
/*** Create/update an travelagentuser */

    public function travelagentuser_create() {
        unset( $_POST['_wp_http_referer'] );
        unset( $_POST['_wpnonce'] );
        unset( $_POST['action'] );
//alert($posted);
        $posted               = array_map( 'strip_tags_deep', $_POST );
        $travelagentuser_id  = travelagentuser_create( $posted );
        // user notification email
            $emailer    = wperp()->emailer->get_email( 'New_Employee_Welcome' );
            $send_login = isset( $posted['login_info'] ) ? true : false;

            if ( is_a( $emailer, '\WeDevs\ERP\Email') ) {
                $emailer->trigger( $travelagentuser_id, $send_login );
            }

        $data = $posted;
        $this->send_success( $data );
    }
	
	public function travelagentuser_get() {
        global $wpdb;
        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;
		$supid = $_SESSION['supid']; 
        $response = $wpdb->get_row("SELECT * FROM superadmin WHERE SUP_Id='$id' AND SUP_Status=1 AND SUP_Type=4 AND SUP_Refid='$supid'");
        $this->send_success( $response );
    }
	
	public function travelagentclaims_create() {
		
        $posted               = array_map( 'strip_tags_deep', $_POST );
        $travelagentclaims_id  = travelagentclaims_create( $posted );
        $data = $posted;
        $this->send_success( $data );
    }
	/*** Create/update an travelagentclient */

    public function travelagentclient_create() {
        unset( $_POST['_wp_http_referer'] );
        unset( $_POST['_wpnonce'] );
        unset( $_POST['action'] );
        $posted               = array_map( 'strip_tags_deep', $_POST );
        $travelagentclient_id  = travelagentclient_create( $posted );
        // user notification email
             $emailer    = wperp()->emailer->get_email( 'New_Employee_Welcome' );
            $send_login = isset( $posted['login_info'] ) ? true : false;

            if ( is_a( $emailer, '\WeDevs\ERP\Email') ) {
                $emailer->trigger( $travelagentclient_id, $send_login );
            } 

        //$data = $posted;
        $this->send_success( $travelagentclient_id );
    }
	
	public function travelagentclient_get() {
		// $this->send_success( "sfsdf" ); 
        global $wpdb;
         $id = $_REQUEST['id'];
		 $supid = $_SESSION['supid']; 
        $response = $wpdb->get_row("SELECT * FROM company WHERE COM_Id = '$id' AND COM_Status=0 AND SUP_Id='$supid'");
        $this->send_success( $response ); 
    }
	
	/*** Create/update an travelagentbankdetails */

    public function travelagentbankdetails_create() {
        unset( $_POST['_wp_http_referer'] );
        unset( $_POST['_wpnonce'] );
        unset( $_POST['action'] );
//alert($posted);
        $posted               = array_map( 'strip_tags_deep', $_POST );
        $travelagentbankdetails_id  = travelagentbankdetails_create( $posted );
        $data = $posted;
        $this->send_success( $data );
    }
	
	public function travelagentbankdetails_get() {
        global $wpdb;
        $id = $_REQUEST['id'];
		$supid = $_SESSION['supid']; 
        $response = $wpdb->get_row("SELECT * FROM travel_desk_bank_account WHERE TDBA_Id = '$id' AND SUP_Id='$supid' AND TDBA_Status=1");
        $this->send_success( $response );
    }
	
	  /**
     * Gets the leave dates
     *
     * Returns the date list between the start and end date of the
     * two dates
     *
     * @since 0.1
     *
     * @return void
     */
    public function companyinvoice_view() {
		//$this->send_success( "teststsfd" );
		global $wpdb;
       // $this->verify_nonce( 'wp-erp-hr-nonce' );
	   $posted = array_map( 'strip_tags_deep', $_POST );
	   $id = $posted['id'];
      
		$response = $wpdb->get_results("SELECT tdc.TDC_Id,TDC_ReferenceNo,TDC_PaidAmount,TDC_Arrears,TDC_Status,TDC_Date,TDC_ServiceCharges,TDC_ServiceTax,COUNT(DISTINCT tdcr.TDCR_Id) AS cntReqs,
SUM(tdcr.TDCR_Quantity) * COUNT(DISTINCT tdcr.TDCR_Id) / COUNT(*) AS totalQty,SUM(tdcr.TDCR_Amount) * COUNT(DISTINCT tdcr.TDCR_Id) / COUNT(*) AS totalAmnt FROM  travel_desk_claims tdc INNER JOIN travel_desk_claim_requests tdcr USING(TDC_Id) WHERE COM_Id = '$id' GROUP BY tdcr.TDC_Id ORDER BY TDC_Id DESC");			
		$this->send_success($response);
        //$this->send_success( array( 'id' => $id));
    }
}
