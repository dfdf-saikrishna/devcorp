<?php
namespace WeDevs\ERP\Travelagentuser;

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

    }
    
    public function update_booking_request(){
        global $wpdb;
        $compid = $_SESSION['compid'];
        $posted = array_map('strip_tags_deep', $_POST);

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
    				$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturn, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i], 'RD_TotalCost' => $txtTotalCost[$i]));
    				else
    				$wpdb->insert('request_details', array('REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i], 'RD_TotalCost' => $txtTotalCost[$i]));

    				$rdid = $wpdb->insert_id;
    				$this->send_success($rdid);
    				
    				
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
    		
    			//$_SESSION['msg'] = 1;		
    			echo "1";
    		//header("location:$filename?reqid=$reqid");
    		exit;	
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
    	
    	$dateInput = explode('/', $txtDob);
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
						
						$wpdb->insert('request_details', array('RD_Type'=> '2','REQ_Id' => $reqid, 'RD_Dateoftravel' => $dateformat, 'RD_ReturnDate' => $freturn, 'RD_StartDate' => $startdate, 'RD_EndDate' => $hotelcheckout, 'RD_Description' => $desc, 'EC_Id' => $selExpcat[$i], 'MOD_Id' => $selModeofTransp[$i], 'RD_Cityfrom' => $from[$i], 'RD_Cityto' => $to[$i], 'SD_Id' => $selStayDur[$i], 'RD_Cost' => $txtCost[$i]));
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
					
					echo "success";
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
				echo "2";die;
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
