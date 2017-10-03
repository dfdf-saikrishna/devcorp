<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function traveldesk_request_without_appr() {
	
	if(isset($_POST['addnewRequest']))
{
	global $wpdb;
    global $type;
	$etype				=	$_POST['ectype'];
	 if(isset($_POST['hiddenEmp']))
        $empuserid = $_POST['hiddenEmp'];
	   
        
	if(isset($_POST['hiddenDraft']))
    $hiddenDraft                            =	$_POST['hiddenDraft'];

	$selEmployees		=	$_POST['selEmployees'];
	$expreqcode			=	genExpreqcode(4); // 4 is for creating requests with TRA
	$date				=	$_POST['txtDate'];
	$txtaExpdesc		=	$_POST['txtaExpdesc'];
	$selExpcat			=	$_POST['selExpcat'];
	$selModeofTransp	=	$_POST['selModeofTransp'];
	$from				=	$_POST['from'];
	$to					=	$_POST['to'];
	$selStayDur			=	$_POST['selStayDur'];
	$txtCost			=	$_POST['txtCost'];
	$addnewRequest		=	'3';
	
	//  QUOTATION 
	
	//$sessionid				=	$_POST['sessionid'];
	
	//$hiddenPrefrdSelected	=	$_POST['hiddenPrefrdSelected'];
	
	//$hiddenAllPrefered		=	$_POST['hiddenAllPrefered'];
	
	$selProjectCode			=	$_POST['selProjectCode'];
	
	$selCostCenter			=	$_POST['selCostCenter'];
        $selProjectCode ? $selProjectCode = "" . $selProjectCode . "" : $selProjectCode = 0;
        $selCostCenter ? $selCostCenter = "" . $selCostCenter . "" : $selCostCenter= 0;
	$count=count($txtCost);
	
//$posted = array_map( 'strip_tags_deep', $_POST );
	//print_r($posted); 
	//echo $addnewRequest; die;
		
	/*if(!is_numeric($addnewRequest) || ($addnewRequest > 3)){
		$response = array('status'=>'failure','message'=>"Some fields went missing");
		//header("location:$filename?msg=2");
		exit;
	}*/
	
	$checkFilesUpld=0;
	
	if($addnewRequest==1 || $addnewRequest==3)
	$checkFilesUpld=1;
	
	if($addnewRequest==3){
	
		$selEmployees	=	$_POST['selEmployees'];
		$selEmployees	=	count($selEmployees);

	}
	
	
	/*if($etype=="" || $expreqcode=="" || $selEmployees==""){
	$response = array('status'=>'failure','message'=>"Some fields went missing");
		//header("location:$filename?msg=2");exit;
	
	} else {
		 
		$checked=false;
		
		for($i=0;$i<$count;$i++){
			
			$j=$i+1;
			
			if($checkFilesUpld){
			
				if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]=="" || count($_FILES['file'.$j]['name'])==""){
			
					$checked=true;
					
					break;
				
				}
			
			
			} else {
			
				if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]==""){
			
					$checked=true;
					break;
				
				}			
			
			}			
			
		
		}
		
		
		if($checked){
			$response = array('status'=>'failure','message'=>"Some fields went missing");
			//header("location:$filename?msg=2");exit;
		}
		
		
	}*/
		
		
		
		
		// check for grade limit
	
		/*if($addnewRequest !=3 )
		{
			for($i=0;$i<$count;$i++)
			{		
				
				if($selExpcat[$i]==1 || $selExpcat[$i]==2 || $selExpcat[$i]==5){
				
					$returnValue=getGradeLimit($selModeofTransp[$i], $selEmployees);
										
					$returnVal=explode("###",$returnValue);
					
					
					if($returnVal[0] != 0){
			
						if($selModeofTransp[$i]==5 || $selModeofTransp[$i]==6)
						$estCost	=	$txtCost[$i] / $selStayDur[$i];					
											
														
						if($estCost > $returnVal[0]){					
							
							header("location:$filename?msg=4&mode=$returnVal[1]&amnt=$returnVal[0]");exit;
							
							
						}
					}
				
				}
				
				
			} // end of for loop
		}*/
		
	
		global $wpdb;
		$compid = $_SESSION['compid'];
		//if($comp=select_query("company", "COM_Pretrv_POL_Id", "COM_Id='$compid'", $filename)){
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
			
			$polid=$comp->COM_Pretrv_POL_Id;;		
			
			if($addnewRequest==2){
				
				// Retrieving employee details
				$mydetails=myDetails($selEmployees);
				
				$type=0;
				
				
				switch ($polid)
				{
					//-------- employee -->  rep mngr  -->  finance
					
					case 1:
						
						if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
						{
							global $wpdb;
							
							// insert into request
							//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', $reqtype",$filename);
							
							//$req_emp=1;
							
							// insert into request_status
							//insert_query("request_status","REQ_Id, EMP_Id, REQ_Status","'$reqid', '$mydetails[EMP_Id]', 2",$filename);
							$wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id;
                            // insert into request_status
                            $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));
                            $type=1;
							
						}
						else
						{
							global $wpdb;
							//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', $reqtype",$filename);
							
							//$req_emp=1;
							 $wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id; 
							$type=2;
							
							
							
							
							
						}	
					
					break;
					
					
					
					
					//  employee --> rep mngr 
					case 3:
						
						if($mydetails->EMP_Code==$mydetails->EMP_Funcreprtnmngrcode)
						{
							//echo $mydetails->EMP_Code; die;
							global $wpdb;
							// insert into request
							//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', $reqtype",$filename);
							
							//$req_emp=1;
							
							// insert into request_status
							//insert_query("request_status","REQ_Id, EMP_Id, REQ_Status","'$reqid', '$empuserid', 2",$filename);
							
							$wpdb->insert('requests', array('REQ_Status' => 2,'POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                                $reqid=$wpdb->insert_id; 

                                // insert into request_status
                                $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 2));
                                $setreqstatus=1;
                                $type=3;
						}
						else
						{
							global $wpdb;
							//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', $reqtype",$filename);
							 $wpdb->insert('requests', array('POL_Id' => 5,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            $reqid=$wpdb->insert_id;
                            $wpdb->insert('request_status', array('REQ_Id' => $reqid,'EMP_Id' => $empuserid,'REQ_Status' => 3,'RS_EmpType' => 3));
                            $type=4;
							
						}	
					
					
					break;
					
					
					
					//--------- employee --> finance --> rep mngr
					case 2:
											
						if($mydetails->EMP_Code==$mydetails->EMP_Reprtnmngrcode)
						{
						
							$type=5;
							
							
						}
						else
						{
							$type=6;
						
							
						}
						global $wpdb;
						//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', $reqtype",$filename);
						$wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            
						//$req_emp=1;
						
					
					break;
					
					
					//--------- employee  --> finance
					case 4:							
						global $wpdb;
						//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', $reqtype",$filename);
						$wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Type' => $reqtype));
                            
						$type=7;
						
						
						
					
					break;
					
					
				}
				
				
				if($setreqstatus)
				//$update	=	update_query("requests", "REQ_Status=2", "REQ_Id='$reqid'",$filename);
				 $wpdb->update('requests', array('REQ_Status' => 2), array('REQ_Id' => $reqid));

				
			
			} else {
				if($reqtype==2)
				$reqactive=1;
				else
				$reqactive=2;

				//$reqid=insert_query("requests","POL_Id, REQ_Code, COM_Id, RT_Id, PC_Id, costCenter_Id,  REQ_Status, REQ_Active, REQ_Type","'$polid', '$expreqcode', '$compid', '$etype', '$selProjectCode', '$selCostCenter', '$reqstatus', $reqactive, $reqtype",$filename); 
			$wpdb->insert('requests', array('POL_Id' => $polid,'REQ_Code' => $expreqcode,'COM_Id' => $compid,'RT_Id' => $etype,'PC_Id' => $selProjectCode,'costCenter_Id' => $selCostCenter,'REQ_Status' => $reqstatus,'REQ_Active' => $reqactive,'REQ_Type' => $reqtype));
            $reqid=$wpdb->insert_id;
			}
			if($reqid){
				if($reqtype==4){
				
					$selEmployees	=	$_POST['selEmployees'];
					
					//echo 'Emps='.join(",",$selEmployees); exit;
					
					foreach($selEmployees as $value){
					
						// insert into request_employee	
						//insert_query("request_employee", "REQ_Id, EMP_Id", "'$reqid', '$value'", $filename);
						$wpdb->insert('request_employee', array('REQ_Id' => $reqid,'EMP_Id' => $value));
                         
						// mail to employee required or not
					
					}
					
				
				} else {
				
					// insert into request_employee	
					//insert_query("request_employee", "REQ_Id, EMP_Id", "'$reqid', '$selEmployees'", $filename);
					
					$wpdb->insert('request_employee', array('REQ_Id' => $reqid,'EMP_Id' => $selEmployees));
                    
					// mail to employee required or not
				
				}
			
			} else {
			
				//header("location:$filename?msg=2");exit;
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			
			}
		} else {
		
			//header("location:$filename?msg=2");exit;
			header('Location: '.$_SERVER['REQUEST_URI']);exit; 
		}				
		if($reqid)
		{
		
			for($i=0;$i<$count;$i++)
			{		
				$dateformat=$date[$i];
				$dateformat=explode("-",$dateformat);
				$dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];
				
				($from[$i]=="n/a") ? $from[$i]="NULL" : $from[$i]="".$from[$i]."";
				
				($to[$i]=="n/a") ? $to[$i]="NULL" : $to[$i]="".$to[$i]."";
				
				($selStayDur[$i]=="n/a") ? $selStayDur[$i]="NULL" : $selStayDur[$i]="".$selStayDur[$i]."";	
				
				
				
				$desc	=	addslashes($txtaExpdesc[$i]);
				
				
				//$rdid=insert_query("request_details","REQ_Id, RD_Dateoftravel, RD_Description, EC_Id, MOD_Id, RD_Cityfrom, RD_Cityto, SD_Id, RD_Cost, RD_Type","'$reqid', '$dateformat', '$desc', '$selExpcat[$i]', '$selModeofTransp[$i]', $from[$i], $to[$i], $selStayDur[$i], '$txtCost[$i]', 2",$filename);
				$wpdb->insert('request_details', array('REQ_Id' => $reqid,'RD_Dateoftravel' => $dateformat,'RD_Description' => $desc,'EC_Id' => $selExpcat[$i],'MOD_Id' => $selModeofTransp[$i],'RD_Cityfrom' => $from[$i],'RD_Cityto' => $to[$i],'SD_Id' => $selStayDur[$i],'RD_Cost' => $txtCost[$i],'RD_Type' => 2));
                 $rdid = $wpdb->insert_id;

				// GET  QUOTE
				
			/*	if($addnewRequest==2){
				
					$explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
					
					//$countExpldVal	=	count($explodeVal);
					
					
					if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
					
						
						foreach($explodeVal as $gqfid){
						
							$pref=1;
							
							if($gqfid==$hiddenPrefrdSelected[$i])
							$pref=2;
							
							insert_query("request_getquote", "RD_Id, RG_SessionId, GQF_Id, RG_Pref", "$rdid, '$sessionid[$i]', $gqfid, $pref", $filename);	
							
						}
						
					
					}
				
				}*/
				
				
				
				if($addnewRequest==1 || $addnewRequest==3){
				
					// insert into booking status
					//$bsid=insert_query("booking_status", "RD_Id, BS_Status, BS_TicketAmnt, BA_Id, BA_ActionDate", "'$rdid', 1, '$txtCost[$i]', 2, NOW()", $filename);
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
										
							$newFilePath = WPERP_COMPANY_PATH . "/upload/$compid/bills_tickets/";
										
							$result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
							
							//echo 'count='.$result;exit;
									
							//Upload the file into the temp dir
							if($result){
							
								if($addnewRequest==2){
								
									// insert into request files
									//insert_query("requests_files","RD_Id,RF_Name","'$rdid','$filePath'",$filename);	
								   $wpdb->insert('requests_files', array('RD_Id' => $rdid,'RF_Name' => $filePath));

								} else {
								
									// insert into bs documents.							
									//insert_query("booking_documents","BS_Id, BD_Filename","'$bsid','$filePath'",$filename);	
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
				
				break;
				
				
				case 2:
				
				//mail to reporting manager
				//notify($expreqcode, $etype, 2);
				
				break;
				
				
				case 3:
				
				// mail to himself saying that he can make the journey
				//notify($expreqcode, $etype, 19, $mydetails['EMP_Id']);
				
				break;
				
				case 4:
				
				//mail to reporting manager
				//notify($expreqcode, $etype, 2, $mydetails['EMP_Id']);
				
				break;
				
				
				case 5:
				
				//mail to finance
				//notify($expreqcode, $etype, 1, $mydetails['EMP_Id']);
				
				break;
				
				
				case 6:
				
				//mail to finance
				//notify($expreqcode, $etype, 20, $mydetails['EMP_Id']);
				
				break;
				
				
				case 7:
				
				//mail to finance
				//notify($expreqcode, $etype, 20, $mydetails['EMP_Id']);
				
				break;
			
			}
						
			
		
		} else {
		 $response = array('status'=>'failure','message'=>"Request Couldn\'t be added. Please try again");
              
			//header("location:$filename?msg=7");exit;
		
		}
		 header("location:/wp-admin/admin.php?page=Group-Request&reqid=$reqid&status=success");exit;    
	
		 $response = array('status'=>'success','message'=>"You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Please wait for approval..  ");
       	
		//header("location:$filename?msg=1&reqid=$expreqcode");exit;		
}
    if ( isset( $_POST['submit-traveldesk-request_withoutappr'] ) ) {
        
        global $wpdb;
        global $type;
        $compid = $_SESSION['compid'];
        if(isset($_POST['hiddenEmp']))
        $empuserid = $_POST['hiddenEmp'];
        $posted = array_map( 'strip_tags_deep', $_POST );
        //print_r($posted);die;
        $expenseLimit                           = 	$posted['expenseLimit'];
        //if(isset($_POST['hiddenEmp']))
        $selEmployees                           =	$_POST['hiddenEmp'];
        if(isset($_POST['hiddenDraft']))
        $hiddenDraft                            =	$_POST['hiddenDraft'];

	$etype					=	$posted['ectype'];
        
	$addnewRequest                          =	$_POST['addnewrequest'];
        
	$expreqcode				=	genExpreqcode(4); // 4 is for creating requests with TRA
		
	$date					=	$posted['txtDate'];
	if(isset($_POST['txtStartDate']))
	$txtStartDate                           =	$posted['txtStartDate'];
	if(isset($_POST['txtEndDate']))
	$txtEndDate				=	$posted['txtEndDate'];
	
	$txtaExpdesc                            =	$posted['txtaExpdesc'];
	
	$selExpcat				=	$posted['selExpcat'];
	
	$selModeofTransp                        =	$posted['selModeofTransp'];
	
	$from					=	$posted['from'];
	
	$to					=	$posted['to'];
	
	//$selStayDur				=	$posted['selStayDur'];
	//$txtdist				=	$posted['txtdist'];
	
	$txtCost				=	$posted['txtCost'];
	
	
	//  QUOTATION 
	
	//$sessionid				=	$posted['sessionid'];
	
	//$hiddenPrefrdSelected                 =	$posted['hiddenPrefrdSelected'];
	
	//$hiddenAllPrefered                    =	$posted['hiddenAllPrefered'];
	
	$selProjectCode                         =	$posted['selProjectCode'];

	$selCostCenter                          =	$posted['selCostCenter'];
	if(isset($_POST['textBillNo']))
	$textBillNo				=	$posted['textBillNo'];
	//$expenseLimit                           =       "0";
	
	$count=count($txtCost);
       
        if($etype=="" || $expreqcode==""){
		$response = array('status'=>'failure','message'=>"Some fields went missing");
                //$this->send_success($response);
                exit;
	
	} else {
	
		$checked=false;
		
		for($i=0;$i<$count;$i++){
						
//			if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtdist[$i]=="" || $textBillNo[$i]=="" || $txtCost[$i]=="" || $txtStartDate[$i]=="" || $txtEndDate[$i]==""){
//                                
//				$checked=true;
//				break;
//			
//			}
                        
		
		}
                if($checked){
                        $response = array('status'=>'notice','message'=>"Some fields went missing");
                        //$this->send_success($response);
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
                            $reqid=$wpdb->insert_id;
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
            //$this->send_success("2");
            header('Location: '.$_SERVER['REQUEST_URI']);exit; 

    }

    } else {

            //header("location:$filename?msg=2");exit;
            //$this->send_success("2");
            header('Location: '.$_SERVER['REQUEST_URI']);exit; 
    }

    if($reqid)
        {

                for($i=0;$i<$count;$i++)
                {		
                        $dateformat=$date[$i];
                        $dateformat=explode("-",$dateformat);
                        $dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];

                        ($from[$i]=="n/a") ? $from[$i]="NULL" : $from[$i]="".$from[$i]."";

                        ($to[$i]=="n/a") ? $to[$i]="NULL" : $to[$i]="".$to[$i]."";

                        //($selStayDur[$i]=="n/a") ? $selStayDur[$i]="NULL" : $selStayDur[$i]="'".$selStayDur[$i]."'";	
                        $selStayDur[$i]="";


                        $desc	=	addslashes($txtaExpdesc[$i]);
                        
                        //commented by me
                        $wpdb->insert('request_details', array('REQ_Id' => $reqid,'RD_Dateoftravel' => $dateformat,'RD_Description' => $desc,'EC_Id' => $selExpcat[$i],'MOD_Id' => $selModeofTransp[$i],'RD_Cityfrom' => $from[$i],'RD_Cityto' => $to[$i],'SD_Id' => $selStayDur[$i],'RD_Cost' => $txtCost[$i],'RD_Type' => 2));
                        $rdid = $wpdb->insert_id;


                        // GET  QUOTE

//                        if($addnewRequest==2){
//
//                                $explodeVal		=	explode(",", $hiddenAllPrefered[$i]);
//
//                                //$countExpldVal	=	count($explodeVal);
//
//
//                                if($sessionid[$i] && $hiddenPrefrdSelected[$i] && $hiddenAllPrefered[$i]){
//
//
//                                        foreach($explodeVal as $gqfid){
//
//                                                $pref=1;
//
//                                                if($gqfid==$hiddenPrefrdSelected[$i])
//                                                $pref=2;
//                                                $wpdb->insert('request_getquote', array('RD_Id' => $rdid,'RG_SessionId' => $sessionid[$i],'GQF_Id' => $gqfid,'RG_Pref' => $pref));
//
//                                        }
//
//                                }
//
//                        }



                        if($addnewRequest==1 || $addnewRequest==3){

                                // insert into booking status
                                // commented by me
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

                                                //$newFilePath = "../company/upload/$compid/bills_tickets/";
                                                $newFilePath = WPERP_TRAVELDESK_PATH . "/upload/$compid/bills_tickets/";
                                                if (!file_exists($newFilePath)) {
                                                    wp_mkdir_p($newFilePath);
                                                }
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

                        break;


                        case 2:

                        //mail to reporting manager
                        //notify($expreqcode, $etype, 2);

                        break;


                        case 3:

                        // mail to himself saying that he can make the journey
                        //notify($expreqcode, $etype, 19, $mydetails['EMP_Id']);

                        break;

                        case 4:

                        //mail to reporting manager
                        //notify($expreqcode, $etype, 2, $mydetails['EMP_Id']);

                        break;


                        case 5:

                        //mail to finance
                        //notify($expreqcode, $etype, 1, $mydetails['EMP_Id']);

                        break;


                        case 6:

                        //mail to finance
                        //notify($expreqcode, $etype, 20, $mydetails['EMP_Id']);

                        break;


                        case 7:

                        //mail to finance
                        //notify($expreqcode, $etype, 20, $mydetails['EMP_Id']);

                        break;

                }



        } else {

                //header("location:$filename?msg=7");exit;
                $response = array('status'=>'failure','message'=>"Request Couldn\'t be added. Please try again");
                //$this->send_success($response);

        }


        header("location:/wp-admin/admin.php?page=Group-Request&reqid=$reqid&status=success");exit;    
	//$this->send_success("1");	
			
        $response = array('status'=>'success','message'=>"You have successfully added a Pre Travel Expense Request  <br> Your Request Code: $expreqcode <br> Please wait for approval..  ");
        //$this->send_success($response);
        
    }
   
    if ( isset( $_POST['update-traveldesk-request_withoutappr'] ) ) {
        global $wpdb;
        $compid                 =	$_SESSION['compid'];
        $etype				=	$_POST['ectype'];
	$date				=	$_POST['txtDate'];
	$txtaExpdesc		=	$_POST['txtaExpdesc'];
	$selExpcat			=	$_POST['selExpcat'];
	$selModeofTransp	=	$_POST['selModeofTransp'];
	$from				=	$_POST['from'];
	$to					=	$_POST['to'];
	$selStayDur			=	$_POST['selStayDur'];
	$txtCost			=	$_POST['txtCost'];
	$reqid				=	$_POST['reqid'];
	$rdids				=	$_POST['rdids'];
	$selEmployees		=	$_POST['selEmployees'];
	$updateRequest		=	$_POST['updateRequest'];
	
	//  QUOTATION 
	
	//$sessionid                      =	$_POST['sessionid'];
	
	//$hiddenPrefrdSelected           =	$_POST['hiddenPrefrdSelected'];
	
	//$hiddenAllPrefered		=	$_POST['hiddenAllPrefered'];
	
	$selProjectCode			=	$_POST['selProjectCode'];
	
	$selCostCenter			=	$_POST['selCostCenter'];
	
	//$filename=$_POST['filename'];

	$count=count($rdids);
		
	
	$cnt=count($wpdb->get_results("SELECT RD_Id FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1"));
	
	$hidrowno	=	$_POST['hidrowno']; 
	
	//echo 'hidrow='.$hidrowno." cnt=".$cnt; exit;
	$txtTotalCost = $_POST['txtTotalCost'];
	//echo 'Count='.$cnt; exit;
	
	if($reqid=="" || count($rdids)=="" || $selEmployees==""){
	
		$response = array('status'=>'failure','message'=>"Some fields went missing. Please enable javascript in your browser and try again");
                $this->send_success($response);
	
	} else {
	
		$checked=false;
		
		for($i=0;$i<$count;$i++){
			$j=$i+1;
			if($date[$i]=="" || $txtaExpdesc[$i]=="" || $selExpcat[$i]=="" || $selModeofTransp[$i]=="" || $txtCost[$i]==""){
		
				$checked=true;
				
				break;
			
			}
			
			
		
		}
		
		
		if($checked){
			//$response = array('status'=>'failure','message'=>"Some fields went missing. Please enable javascript in your browser and try again");
                       header('Location: '.$_SERVER['REQUEST_URI']);exit; 
		}
		
		
	}
	
		if($updateRequest==5){
		
	
			date_default_timezone_set("Asia/Calcutta");
			
			$time=date('Y-m-d h:i:s');
                        

			$wpdb->update( 'request_employee', array( 'RE_Status' => 2, 'RE_UpdatedDate' => $time ), array( 'REQ_Id' => $reqid ));
			
			
			foreach($selEmployees as $emps){
                            
				$wpdb->insert( 'request_employee', array( 'REQ_Id' => $reqid, 'EMP_Id' => $emps ));
				
			}
		
		}
		
		
		
		// updating project code if set 
                
		$selprocod=$wpdb->get_row("SELECT PC_Id, costCenter_Id FROM requests WHERE REQ_Id='$reqid'");
		
		if($selprocod->PC_Id != $selProjectCode){
                        
			$wpdb->update( 'requests', array( 'PC_Id' => 2 ), array( 'REQ_Id' => $reqid ));
		
		}
		
		if($selprocod->costCenter_Id != $selCostCenter){
                        
			$wpdb->update( 'requests', array( 'costCenter_Id' => $selCostCenter ), array( 'REQ_Id' => $reqid ));
		
		}
		
		
	
		for($i=0;$i<$cnt;$i++)
		{		
			$dateformat=$date[$i];
			$dateformat=explode("-",$dateformat);
			$dateformat=$dateformat[2]."-".$dateformat[1]."-".$dateformat[0];
			
			if($from[$i]=="n/a")
			$from[$i]=NULL;
			
			
			if($to[$i]=="n/a")
			$to[$i]=NULL;
			
			if($selStayDur[$i]=="n/a")
			$selStayDur[$i]=NULL;
		
			$rdid=$rdids[$i];	
			
			$desc	=	addslashes($txtaExpdesc[$i]);
			
			$wpdb->update('request_details', array('RD_Dateoftravel' => $dateformat,'RD_Description' => $desc,'EC_Id' => $selExpcat[$i],'MOD_Id' => $selModeofTransp[$i],'RD_Cityfrom' => $from[$i],'RD_Cityto' => $to[$i],'SD_Id' => $selStayDur[$i],'RD_Cost' => $txtCost[$i],'RD_TotalCost' => $txtTotalCost[$i]), array( 'RD_Id' => $rdid ));
			
			//echo $updateRequest; exit;
			
			if($updateRequest !=2){
			
				// UPDATE BOOKINGS STATUS AMOUNT
				$wpdb->update('booking_status', array('BS_TicketAmnt' => $txtCost[$i]), array( 'RD_Id' => $rdid ));
				
				
				$selero=$wpdb->get_row("SELECT BS_Id FROM booking_status WHERE RD_Id='$rdid' AND BS_Active=1");
				
				$bsid=$selero->BS_Id;
			
			}
			
			//file upload 
                        $j=$i+1;	
                        $files=$_FILES['file'.$j]['name'];
                        $countbills=count($files);

                        for($f=0; $f<$countbills; $f++)
                        {			

                                //Get the temp file path
                          $tmpFilePath = $_FILES['file'.$j]['tmp_name'][$f];

                          //echo $tmpFilePath."<br>"; 

                          //Make sure we have a filepath
                          if ($tmpFilePath != ""){
                                //Setup our new file path

                                $newFilePath = WPERP_COMPANY_PATH . "/upload/$compid/bills_tickets/";
                                if (!file_exists($newFilePath)) {
                                    wp_mkdir_p($newFilePath);
                                }

                                $ext = substr(strrchr($files[$f], "."), 1); //echo $ext;
                                // generate a random new file name to avoid name conflict
                                // then save the image under the new file name

                                $filePath = md5(rand() * time()).".".$ext;

                                $newFilePath = WPERP_COMPANY_PATH . "/upload/$compid/bills_tickets/";
                                if (!file_exists($newFilePath)) {
                                    wp_mkdir_p($newFilePath);
                                }

                                $result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);

                                //Upload the file into the temp dir
                                if($result) {
                                  $lastinsertid=$wpdb->insert( 'requests_files', array( 'RD_Id' => $rdid, 'RF_Name' => $filePath ));
                                }
                          }
                        }
		
		
		}
		
		
		
		// insert those newly added details if any 
		
		
		if($hidrowno != $cnt){
		
	
			for($i=$cnt;$i<$hidrowno;$i++)
			{		
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
				
				
				
				$wpdb->insert('request_details', array('REQ_Id' => $reqid,'RD_Dateoftravel' => $dateformat,'RD_Description' => $desc,'EC_Id' => $selExpcat[$i],'MOD_Id' => $selModeofTransp[$i],'RD_Cityfrom' => $from[$i],'RD_Cityto' => $to[$i],'SD_Id' => $selStayDur[$i],'RD_Cost' => $txtCost[$i],'RD_TotalCost' => $txtTotalCost[$i],'RD_Type' => 2));
				$rdid=$wpdb->insert_id;
				
				
				if($rdid){
				
					if($updateRequest != 2){
				
						// insert into booking status
                                                
						$wpdb->insert('booking_status', array('RD_Id' => $reqid,'BS_Status' => 1,'BS_TicketAmnt' => $txtCost[$i],'BA_Id' => 2,'BA_ActionDate' => 'NOW()'));
                                                $bsid=$wpdb->insert_id;
					}
					
					// for files we have add +1 to the cnt so that we get the correct fields
					$k=$cnt+1;
					
					$files=$_FILES['file'.$k]['name'];
					
					
					$countbills=count($files);
					
					
					for($f=0;$f<$countbills;$f++)
					{			
						//Get the temp file path
					  $tmpFilePath = $_FILES['file'.$k]['tmp_name'][$f];
					
					  //Make sure we have a filepath
					  if ($tmpFilePath != ""){
						//Setup our new file path
						
						
						$ext = substr(strrchr($files[$f], "."), 1); //echo $ext;
						// generate a random new file name to avoid name conflict
						// then save the image under the new file name
						
						$ext	=	strtolower($ext);
						
						
										
						$filePath = md5(rand() * time()).".".$ext;
										
						$newFilePath = WPERP_COMPANY_PATH . "/upload/$compid/bills_tickets/";
                                                if (!file_exists($newFilePath)) {
                                                    wp_mkdir_p($newFilePath);
                                                }
										
						$result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
									
						//Upload the file into the temp dir
						if($result) {
                                                  
                                                  $lastinsertid=$wpdb->insert( 'requests_files', array( 'RD_Id' => $rdid, 'RF_Name' => $filePath ));  
						  
						  if($updateRequest==2){
								
								// insert into request files
                                                                $wpdb->insert( 'requests_files', array( 'RD_Id' => $rdid, 'RF_Name' => $filePath )); 
							
							} else {
							
								// insert into request files
								//insert_query("requests_files","RD_Id,RF_Name","'$rdid','$filePath'",$filename);	
							
								// insert into bs documents.
                                                                $wpdb->insert( 'booking_documents', array( 'BS_Id' => $bsid, 'BD_Filename' => $filePath )); 
							
							}
					
						}
					  }
					}				
							
				} // if rdid condition
				
				
					
			} // end of for loop
		
		
	} // end of outer most if loop
		
		
		
		
		// those requests with approval type, when the request is updated, update their approval status
		
		if($updateRequest==2){
		
			// update new details		
			
			$wpdb->update('request_status', array( 'RS_Status' => '2','RS_UpdatedDate' => 'NOW()' ), array( 'REQ_Id' => $reqid,'RS_Status' => 1 ));
			
			$wpdb->update('requests', array( 'RS_Status' => '1'), array( 'REQ_Id' => $reqid,'RS_Status!' => 1 ));
		
		}
			
		$response = array('status'=>'success','message'=>"You have successfully update this Request");
                header("location:/wp-admin/admin.php?page=Edit-Group-Request&reqid=$reqid&status=success");exit;	
    }
    
    
    
    
    if ( isset( $_POST['buttonUpdateStatusCanc'] ) ) {
        global $wpdb;
        $tduserid			=	$_SESSION['tdid'];
		$compid				=	$_SESSION['compid'];


if(!$tduserid){
	
}
//header("location:../index.php?login=1");
//include_once("../function.php");

$filename=basename($_SERVER['PHP_SELF']);

$workflow=compPolicy($compid); //COMPANY WORKFLOW(ID)

//Url="update-booking-status.php?bookingStatusVal="+bookingActionval+"&cancellnAmnt="+cncllntAmnt;

//echo 2; exit;

date_default_timezone_set("Asia/calcutta");

$time=date('Y-m-d h:i:s');

$iteration			=	$_POST['buttonUpdateStatusCanc'];

$imdir= COMPANY_UPLOADS . '/'. $compid ."/bills_tickets/";

$cancStatusVal		=	$_POST['selCancActions'.$iteration];
$canAmnt			=	$_POST['txtCanAmount'.$iteration];
$rdid1				=	$_POST['rdid1'.$iteration];
$type1				=	$_POST['type1'.$iteration];


//echo $iteration.", ".$cancStatusVal.", ".$canAmnt.", ".$rdid1.", ".$type1.", ".$imagename1; exit;


// type 1 booking status

$fileUpload=0;

if($type1==1){

	if($bookingStatusVal && $rdid)
	{		
		
		if($bookingStatusVal==2){
			
			$selsql=$wpdb->get_results("Select * FROM file_extensions");
			
			$a=array();
			
			foreach($selsql as $filext){
				
				$fileTypes=str_replace(".","",$filext->FE_Name);
				
				$fileTypes='"'.$fileTypes.'"';
				
				array_push($a,$fileTypes);
			}
			
			$countbills=count($_FILES['fileattach'.$iteration]['name']);
			
			
			for($f=0;$f<$countbills;$f++)
			{
				$imagename			=	$_FILES['fileattach'.$iteration]['name'][$f];
				$imsize				=	$_FILES['fileattach'.$iteration]['size'][$f];				
				
				$extension 		= 	end(explode('.', strtolower($imagename)));
			
				$extension='"'.$extension.'"';
						
				$matchExtns=in_array($extension,$a);
						
				if(!$matchExtns){
					echo 3; // bad file uploaded 
					exit;
				}
				
				if($imsize>2097152){
					echo 6; // bad file uploaded 
					exit;
				}
				
			
			}
			
		
		
			if($iteration=="" || $bookingStatusVal=="" || $amnt=="" || $rdid=="" || $type==""){
			
				echo 4; exit; // oops some fields missing
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			}
			
			
			$fileUpload=1;
			
		
		}	else	{
		
			$fileUpload=0;
		
			if($iteration=="" || $bookingStatusVal=="" || $rdid=="" || $type==""){
		
				//echo 4; exit; // oops some fields missing
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			}
			
			$amnt=NULL;
		
		}
		
		
		$amnt ? $amnt='"'.$amnt.'"' : $amnt="NULL";
		
		
						
		if($update=$wpdb->update("booking_status", array('BA_Id'=>$bookingStatusVal, 'BS_TicketAmnt'=>$amnt, 'BA_ActionDate'=>$time),array('RD_Id'=>$rdid, 'BS_Status'=>'1','BS_Active'=>'1')))
		{
			
			$getResult=$wpdb->get_row("Select * FROM booking_status WHERE RD_Id='$rdid' AND BS_Status=1 AND BS_Active=1");

			if($fileUpload){
				
				for($f=0;$f<$countbills;$f++)
				{			
					//Get the temp file path
				  $tmpFilePath = $_FILES['fileattach'.$iteration]['tmp_name'][$f];
				  
				  $imagename			=	$_FILES['fileattach'.$iteration]['name'][$f];
				
				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
					//Setup our new file path
					
					
					$ext = substr(strrchr($imagename, "."), 1); //echo $ext;
					// generate a random new file name to avoid name conflict
					// then save the image under the new file name
									
					$filePath = md5(rand() * time()).".".$ext;
									
					$newFilePath = COMPANY_UPLOADS . '/'. $compid ."/bills_tickets/";
					
					//echo 'Result='.$newFilePath; exit;
									
					$result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
					
					//echo 'Result='.$result; exit;
								
					//Upload the file into the temp dir
					if($result) {
					  // insert into bs documents.							
						$wpdb->insert("booking_documents",array('BS_Id'=>$getResult->BS_Id, 'BD_Filename'=>$filePath));
				
					} else {
					
						//echo 5; // error in uploading file
						header('Location: '.$_SERVER['REQUEST_URI']);exit; 
						exit;
					
					}
				  }
				}
				
			
			}
			
			
			//echo '<b>Request date: </b>'.date('d-M-y (h:i a)', strtotime($getResult['BS_Date']))."<br>";
			//echo '----------------------------------<br>';
			
			//echo bookingStatus($bookingStatusVal);
			
			
			$doc=NULL;
			
			if($fileUpload){
			
				$seldocs=select_all("booking_documents", "*", "BS_Id='$getResult[BS_Id]'", $filename, 0);
				
				$f=1;
					
				foreach($seldocs as $docs){
				
					$doc.='<b>Uploaded File no. '.$f.': </b> <a href="download-file.php?file='.$imdir.$docs['BD_Filename'].'" class="btn btn-link">download</a><br>';
					
					$f++;
				}
			
			}
						
			
			switch ($bookingStatusVal)
			{
				case 2:
					//echo '<br>';
					$amnt=str_replace('"','',$amnt);
					$amnt=IND_money_format($amnt);
					//echo '<b>Booked Amnt:</b> '.$amnt.'</span><br>';
					//echo $doc;
					//echo '<b>Booked Date: </b>'.date('d-M-y (h:i a)', strtotime($time));
				break;
				
				case 3:
					//echo '<br>';
					//echo '<b>Failed Date: </b>'.date('d-M-y (h:i a)', strtotime($time));
				break;
								
				
			}
			
			
			travelDeskToEmpNotify($rdid, $bookingStatusVal);
									
			// send mail to employee that ticket is booked or failed to book
		}
		else
		{
			//echo 2;
		}
		
		
		
		
	}
	else
	{
		//echo 2;
	}

} 



// cancellation status


if($type1==2){
	
		
	if($cancStatusVal && $rdid1)
	{
				
		if($cancStatusVal==4 || $cancStatusVal==6){
			
			$selsql=$wpdb->get_results("Select * FROM file_extensions");
			
			$a=array();
			
			foreach($selsql as $filext){
				
				$fileTypes=str_replace(".","",$filext->FE_Name);
				
				$fileTypes='"'.$fileTypes.'"';
				
				array_push($a,$fileTypes);
			}
			
			$countbills=count($_FILES['fileCanAttach'.$iteration]['name']);
			
			
			for($f=0;$f<$countbills;$f++)
			{
				$imagename			=	$_FILES['fileCanAttach'.$iteration]['name'][$f];
				$imsize				=	$_FILES['fileCanAttach'.$iteration]['size'][$f];				
				
				$extension 		= 	end(explode('.', strtolower($imagename)));
				//$extension='"'.$extension[1].'"';
				$extension='"'. $extension .'"';
						//print_r($a);
				$matchExtns=in_array($extension,$a);
					//print_r($matchExtns);	
				if(!$matchExtns){
					//echo 3; // bad file uploaded 
					header('Location: '.$_SERVER['REQUEST_URI']);exit; 
				}
				
				if($imsize>2097152){
					//echo 6; // bad file uploaded 
					header('Location: '.$_SERVER['REQUEST_URI']);exit; 
				}
				
			
			}
			
		
		
			if($iteration=="" || $cancStatusVal=="" || $canAmnt=="" || $rdid1=="" || $type1==""){
			
				//echo 4; exit; // oops some fields missing
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			}
			
			$fileUpload=1;
		
		}	else	{
		
			
		
			if($iteration=="" || $cancStatusVal=="" || $rdid1=="" || $type1==""){
		
				//echo 4; exit; // oops some fields missing
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			}
			
			$canAmnt=NULL;
			
			$fileUpload=0;
			
		
		}
		
		$canAmnt ? $canAmnt=''.$canAmnt.'' : $canAmnt="NULL";
		
		$update=NULL;
		$lastId=NULL;
		
		//echo $cancStatusVal." - ".$rdid1;exit;
		
		if($cancStatusVal==4 || $cancStatusVal==5){
			
			$update=$wpdb->update("booking_status", array('BA_Id'=>$cancStatusVal, 'BS_CancellationAmnt'=>$canAmnt, 'BA_ActionDate'=>$time),array('RD_Id'=>$rdid1, 'BS_Status'=>'3','BS_Active'=>'1'));
			
		} else if($cancStatusVal==6 || $cancStatusVal==7) {
			
			$wpdb->insert("booking_status", array('RD_Id'=>$rdid1, 'BS_Status'=>'3', 'BS_CancellationAmnt'=>$canAmnt, 'BA_Id'=>$cancStatusVal, 'BA_ActionDate'=>'NOW()'));
			$lastId= $wpdb->insert_id;
		}
				
		
						
		if($update || $lastId)
		{
			if($update)
			$getResult=$wpdb->get_row("Select * FROM booking_status WHERE RD_Id='$rdid1' AND BS_Status=3 AND BS_Active=1");
			
			
			if($lastId)
			$getResult=$wpdb->get_row("Select * FROM booking_status WHERE BS_Id=$lastId");		
			
			$countbills=count($_FILES['fileCanAttach'.$iteration]['name']);
			//echo $countbills;die;
			if($fileUpload){
			
				for($f=0;$f<$countbills;$f++)
				{			
					//Get the temp file path
				  $tmpFilePath 	= 	$_FILES['fileCanAttach'.$iteration]['tmp_name'][$f];
				  
				  $imagename	=	$_FILES['fileCanAttach'.$iteration]['name'][$f];
				
				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
					//Setup our new file path
					
					
					$ext = substr(strrchr($imagename, "."), 1); //echo $ext;
					// generate a random new file name to avoid name conflict
					// then save the image under the new file name
									
					$filePath = md5(rand() * time()).".".$ext;
									
					$newFilePath = COMPANY_UPLOADS . '/'. $compid ."/bills_tickets/";
									
					$result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
								
					//Upload the file into the temp dir
					if($result) {					  
					  
					  // insert into bs documents.							
						$wpdb->insert("booking_documents",array('BS_Id'=>$getResult->BS_Id, 'BD_Filename'=>$filePath));
				
					} else {
					
						//echo 5; // error in uploading file
						header('Location: '.$_SERVER['REQUEST_URI']);exit; 
					
					}
				  }
				}
			
			
			}
			
			
			//echo '<b>Request date: </b>'.date('d-M-y (h:i a)', strtotime($getResult->BS_Date))."<br>";
			//echo '----------------------------------<br>';
			
			//echo bookingStatus($cancStatusVal);	
			
			
			$doc=NULL;
			
			if($fileUpload){
			
				$seldocs=$wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='$getResult->BS_Id'");
													
				$f=1;
					
				foreach($seldocs as $docs){
				
					$doc.='<b>Uploaded File no. '.$f.': </b> <a href="download-file.php?file='.$imdir.$docs->BD_Filename .'" class="btn btn-link">download</a><br>';
					
					$f++;
				}
			
			}
			
			switch ($cancStatusVal)
			{
				case 4: case 6:
					//echo '<br>';
					$canAmnt=str_replace('"','',$canAmnt);
					$amnt=IND_money_format($canAmnt);
					//echo '<b>Cancelled Amnt:</b> '.$amnt.'</span><br>';
					//echo $doc;
					//echo '<b>Cancelled Date: </b>'.date('d-M-y (h:i a)', strtotime($time));
					 header('Location: '.$_SERVER['REQUEST_URI']);exit; 
				break;
				
				case 5: case 7:
					//echo '<br>';
					//echo '<b>Cancelled Date: </b>'.date('d-M-y (h:i a)', strtotime($time));
					 header('Location: '.$_SERVER['REQUEST_URI']);exit; 
				break;
								
				
			}
			 header("location:/wp-admin/admin.php?page=traveldesk-dashboard&status=success");exit;    
	
			
			//travelDeskToEmpNotify($rdid1, $cancStatusVal);
									
			// send mail to employee that ticket is cancelled with or withour cancellation charges.
		}
		else
		{
			//echo 2; exit;
			header('Location: '.$_SERVER['REQUEST_URI']);exit; 
		}
		
		
		
		
	}
	else
	{
		//echo 2; exit;
		header('Location: '.$_SERVER['REQUEST_URI']);exit; 
	}

}
}

if ( isset( $_POST['claimsSubmitsss'] ) ) {
		//print_r($_FILES);die;
	$tduserid	= $_POST['tdid'];
	$compid 	= $_POST['cmpid'];
	
	$invoiceNo			=	genExpreqcodeinv();
	
	$reqids				=	$_POST['reqids'];
	
	$totalAmount		=	trim($_POST['totalAmount']);
	
	//echo $totalAmount; exit;
	
	$txtInvoiceNo		=	trim($_POST['txtInvoiceNo']);
	
	$txtaRemarks		=	trim(addslashes($_POST['txtaRemarks']));
	
	$txtServiceTax		=	trim($_POST['txtServiceTax']);
	
	$txtServiceChrgs	=	trim($_POST['txtServiceChrgs'])*($_POST['hiddenTickets']);
	
	$quantity			=	$_POST['hiddenTickets'];
	
	
	$txtAccno			=	$_POST['txtAccNo'];
	
	//if($txtServiceTax)
	//$txtServiceTaxamnt=$totalAmount * ($txtServiceTax / 100);
	
	if($txtServiceTax && $txtServiceChrgs)
	$txtServiceTaxamnt=$txtServiceChrgs * ($txtServiceTax / 100);
	
	
	$totalAmount+=$txtServiceTaxamnt;
		
	if($txtServiceTax && $txtServiceChrgs)
	$totalAmount=$totalAmount + $txtServiceChrgs;
	
	$totalAmount=abs($totalAmount);
	
	
	//echo $totalAmount; exit;
	
	//echo 'Req'.$reqids; exit;
	
	$imagename	=$_FILES['fileattach']['name'];
	$imtype		=$_FILES['fileattach']['type'];
	$imsize		=$_FILES['fileattach']['size'];
	$tmpname 	=$_FILES['fileattach']['tmp_name'];
	
	//echo 'imtype='.$imtype;//exit;
	
	$photoAllowed=0;
	
	/*if($imagename)
	{
	
		$allowedExts 		= 	array("doc", "docx", "pdf"); 
		$allowedMimeTypes 	= 	array("application/msword", 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf');
		$extension 			= 	substr(strrchr($imagename, "."), 1);
		$extension 			= 	strtolower($extension);
		$matchExtns			=	in_array($extension,$allowedExts);
		
		//echo $matchExtns;exit;
		
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
	
	}*/
	
	
	//echo $photoAllowed; exit;
	
	/*if($photoAllowed)
	{ 
		$response = array('status'=>'failure','message'=>"Wrong file type uploaded.");
		exit;
	}*/
	
	
	
	if($reqids=="" || $totalAmount==""){
		$response = array('status'=>'failure','message'=>"OOPs !! Some fields went missing. Please try again.");
		exit;
	
	} else {	
	
			 $tmpFilePath = $_FILES['fileattach']['tmp_name'];
				//Make sure we have a filepath
                          if ($tmpFilePath != ""){
                                //Setup our new file path


                                $ext = substr(strrchr($imagename, "."), 1); 
                                // generate a random new file name to avoid name conflict
                                // then save the image under the new file name

                                $filePath = md5(rand() * time()).".".$ext;
							 //$compid = $_POST['compid'];
                               $newFilePath = WPERP_COMPANY_PATH . "/upload/$compid/bills_tickets/"; 

                                if (!file_exists($newFilePath)) {
                                    wp_mkdir_p($newFilePath);
                                }

                                move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
                          }
		/*$imdir		=	"../company/upload/$compid/bills_tickets/";
			
		$ext 		= 	substr(strrchr($imagename, "."), 1);
		
		$imagePath 	= 	md5(rand() * time()) . ".$ext";
		
		move_uploaded_file($tmpname, $imdir . $imagePath);*/ 
		
		
		
		//$impath="upload/$compid/";
		
		$filepath = str_replace($newFilePath,"",$filePath);
		$data = array('TD_Id'=>$tduserid, 'COM_Id'=>$compid, 'TDC_ReferenceNo'=>$invoiceNo, 'TDC_Quantity'=>$quantity, 'TDC_Amount'=>$totalAmount, 'TDC_ServiceTax'=>$txtServiceTax, 'TDC_ServiceCharges'=>$txtServiceChrgs, 'TDC_InvoiceNo'=>$txtInvoiceNo, 'TDBA_Id'=>$txtAccno, 'TDC_Filename'=>$filePath, 'TDC_Remarks'=>$txtaRemarks);
		
		global $wpdb;		
		 $insert = $wpdb->insert("travel_desk_claims", array('TD_Id'=>$tduserid, 'COM_Id'=>$compid, 'TDC_ReferenceNo'=>$invoiceNo, 'TDC_Quantity'=>$quantity, 'TDC_Amount'=>$totalAmount, 'TDC_ServiceTax'=>$txtServiceTax, 'TDC_ServiceCharges'=>$txtServiceChrgs, 'TDC_InvoiceNo'=>$txtInvoiceNo, 'TDBA_Id'=>$txtAccno, 'TDC_Filename'=>$filePath, 'TDC_Remarks'=>$txtaRemarks));

		$insertid = $wpdb->insert_id;
		
		if($insertid){
		
		
			$reqidarry	=	explode(",", $reqids);	
			
			
			$totalcosts=0;
			
			foreach($reqidarry as $vals){
						
				
				$getvals = $wpdb->get_results("SELECT DISTINCT (rd.RD_Id) FROM request_details rd, booking_status bs WHERE rd.REQ_Id=$vals AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3)  AND BS_Active=1 AND RD_Status=1");
				
				$totalcosts=0;
									
				foreach ($getvals as $values) {
				
					
					$countAll=count($wpdb->get_results("SELECT BS_Id FROM booking_status WHERE RD_Id='$values->RD_Id' AND BS_Active=1"));
																		
					if($countAll==2){
					
						if($rowcn=$wpdb->get_row("SELECT BA_Id, BS_CancellationAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=3 AND BS_Active=1")){
						
							if($rowcn->BA_Id==4 || $rowcn->BA_Id==6){
								
								$totalcosts	+=	$rowcn->BS_CancellationAmnt;
							
							}
						
						} else {
						
							$rowbk=$wpdb->get_row("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
							
							$totalcosts	+=	$rowbk->BS_TicketAmnt;
						
						}
						
						
					} else {
					
						$rowbk=$wpdb->get_row("SELECT BS_TicketAmnt FROM booking_status WHERE RD_Id='$values->RD_Id' and BS_Status=1 AND BS_Active=1");
						$totalcosts	+=	$rowbk->BS_TicketAmnt;
					
					}
					
																	
					
				}
				
				$qty	=	count($getvals);
			
				$wpdb->insert("travel_desk_claim_requests", array('TDC_Id'=>$insertid, 'REQ_Id'=>$vals, 'TDCR_Quantity'=>$qty, 'TDCR_Amount'=>$totalcosts));
				
			}
			// finance approvers notification
			//Wrong file type uploaded. 
			header("location:/wp-admin/admin.php?page=claims");
//window.location.replace("/wp-admin/admin.php?page=claims");
			exit;
		
			
		
		} else {
		$response = array('status'=>'failure','message'=>"Error !! Please try again or contact your administrator.");
			//header("location:$filename?msg=3&reqids=$reqids");
			exit;
		
			
		
		}
	
	
	}
}


  if(isset($_POST['buttonUpdateStatus'])){
           //echo $_POST['buttonUpdateStatus'];die;
        global $wpdb;    
		$tduserid			=	$_SESSION['tdid'];
		 $compid				=	$_SESSION['compid'];

if(!$tduserid){
    $response = '';
    header('Location: '.$_SERVER['REQUEST_URI']);exit; 
}
//header("location:../index.php?login=1");
//include_once("../function.php");

$workflow=compPolicy($compid); //COMPANY WORKFLOW(ID)

date_default_timezone_set("Asia/calcutta");

$time=date('Y-m-d h:i:s');

$iteration			=	$_POST['buttonUpdateStatus'];
$bookingStatusVal	=	$_POST['selBookingActions'.$iteration];
$amnt				=	$_POST['txtAmount'.$iteration];
$bookingcost		=   $_POST['bookingcost'.$iteration];
$rdid				=	$_POST['rdid'.$iteration];
$type				=	$_POST['type'.$iteration];
$comp_id            =	$_POST['cmpid'.$iteration];
if($comp_id)
$compid = $comp_id;

//check request date
$rddetails = $wpdb->get_row("SELECT * FROM request_details WHERE RD_Id IN ($rdid)");
$curdate = strtotime(date('d-m-Y'));
$mydate = strtotime($rddetails->RD_Dateoftravel);
if($curdate > $mydate)
{
	header('Location: '.$_SERVER['REQUEST_URI'].'&status=date');exit; 
}
$imdir= COMPANY_UPLOADS . '/'. $compid ."/bills_tickets/";

//$cancStatusVal		=	$_POST['selCancActions'.$iteration];
//$canAmnt			=	$_POST['txtCanAmount'.$iteration];
//$rdid1				=	$_POST['rdid1'.$iteration];
//$type1				=	$_POST['type1'.$iteration];


//echo $iteration.", ".$cancStatusVal.", ".$canAmnt.", ".$rdid1.", ".$type1.", ".$imagename1; exit;
//Traveldesk check tolerance limits
$rowtl=$wpdb->get_row("Select * FROM tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
if(!empty($rowtl)){
  if($rowtl->TL_Percentage){
	$percentage = $rowtl->TL_Percentage;
	$cal = $bookingcost*$percentage/100;
	$perAmount = $bookingcost+$cal;
	if($amnt>$perAmount){
		header('Location: '.$_SERVER['REQUEST_URI'].'&status=tolerance');exit; 
	}
	
}}


// type 1 booking status

$fileUpload=0;

if($type==1){

	if($bookingStatusVal && $rdid)
	{		
		
		if($bookingStatusVal==2){
			global $wpdb;
                        
			$selsql=$wpdb->get_results("SELECT * FROM file_extensions");
			
			$a=array();
			
			foreach($selsql as $filext){
				
				$fileTypes=str_replace(".","",$filext->FE_Name);
				
				$fileTypes='"'.$fileTypes.'"';
				
				array_push($a,$fileTypes);
			}
		      
			$countbills=count($_FILES['fileattach'.$iteration]['name']);
		
			
			for($f=0;$f<$countbills;$f++)
			{
				$imagename			=	$_FILES['fileattach'.$iteration]['name'][$f];
				$imsize				=	$_FILES['fileattach'.$iteration]['size'][$f];				

				$extension 		= 	explode('.', strtolower($imagename));
                   
				$extension='"'.$extension[1].'"';
				
				$matchExtns=in_array($extension,$a);
                             
				if(!$matchExtns){
					//echo 3; // bad file uploaded 
					header('Location: '.$_SERVER['REQUEST_URI']);exit; 
				}
				
				if($imsize>2097152){
					//echo 6; // bad file uploaded 
					header('Location: '.$_SERVER['REQUEST_URI']);exit; 
				}
				
			
			}
			
			if($iteration=="" || $bookingStatusVal=="" || $amnt=="" || $rdid=="" || $type==""){
			
				//echo 4; exit; // oops some fields missing
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			
			}
			
			
			$fileUpload=1;
			
		
		}	else	{
		
			$fileUpload=0;
		
			if($iteration=="" || $bookingStatusVal=="" || $rdid=="" || $type==""){
		
				//echo 4; exit; // oops some fields missing
				header('Location: '.$_SERVER['REQUEST_URI']);exit; 
			
			}
			
			$amnt=NULL;
		
		}
		
		$amnt ? $amnt=''.$amnt.'' : $amnt="NULL";
		
		if($update=$wpdb->update("booking_status", array('BA_Id'=>$bookingStatusVal, 'BS_TicketAmnt'=>$amnt, 'BA_ActionDate'=>$time), array('RD_Id'=>$rdid ,'BS_Status'=>'1', 'BS_Active'=>'1')))
		{
			
			$getResult=$wpdb->get_row("select * FROM booking_status Where RD_Id=$rdid AND BS_Status=1 AND BS_Active=1");
						
			if($fileUpload){
				
				for($f=0;$f<$countbills;$f++)
				{			
				 //Get the temp file path
				  $tmpFilePath = $_FILES['fileattach'.$iteration]['tmp_name'][$f];
				  
				  $imagename			=	$_FILES['fileattach'.$iteration]['name'][$f];
				  
				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
					//Setup our new file path
					
					
					$ext = substr(strrchr($imagename, "."), 1); //echo $ext;
					// generate a random new file name to avoid name conflict
					// then save the image under the new file name
									
					$filePath = md5(rand() * time()).".".$ext;
									
					//$newFilePath = "../company/upload/$compid/bills_tickets/";
					 $newFilePath = COMPANY_UPLOADS . '/'. $compid ."/bills_tickets/";

					//echo 'Result='.$newFilePath; exit;
									
					$result    = move_uploaded_file($tmpFilePath, $newFilePath . $filePath);
					
					//echo 'Result='.$result; exit;
								
					//Upload the file into the temp dir
					if($result) {
					  // insert into bs documents.
						$wpdb->insert("booking_documents",array('BS_Id'=>$getResult->BS_Id,'BD_Filename'=>$filePath));
					} else {
					
						//echo 5; // error in uploading file
						header('Location: '.$_SERVER['REQUEST_URI']);exit; 
					
					}
				  }
				}
				
			
			}
			
			
			$res = '<b>Request date: </b>'.date('d-M-y (h:i a)', strtotime($getResult->BS_Date))."<br>";
			$res.= '----------------------------------<br>';
			
			$res.= bookingStatus($bookingStatusVal);
			
			
			$doc=NULL;
			
			if($fileUpload){
			
				$seldocs=$wpdb->get_results("select * FROM booking_documents Where BS_Id='$getResult->BS_Id'");
				
				$f=1;
					
				foreach($seldocs as $docs){
				
					$doc.='<b>Uploaded File no. '.$f.': </b> <a href="'. $imdir . $docs->BD_Filename .'" class="btn btn-link">download</a><br>';
					
					$f++;
				}
			
			}
						
			
			switch ($bookingStatusVal)
			{
				case 2:
					$res.= '<br>';
					$amnt=str_replace('"','',$amnt);
					$amnt=IND_money_format($amnt);
					$res.= '<b>Booked Amnt:</b> '.$amnt.'</span><br>';
					$res.= $doc;
					$res.= '<b>Booked Date: </b>'.date('d-M-y (h:i a)', strtotime($time));
				break;
				
				case 3:
					$res.= '<br>';
					$res.= '<b>Failed Date: </b>'.date('d-M-y (h:i a)', strtotime($time));
					header('Location: '.$_SERVER['REQUEST_URI'].'&status=failure');exit; 
				break;
								
				
			}
			 header('Location: '.$_SERVER['REQUEST_URI'].'&status=success');exit; 
			 //header("location:/wp-admin/admin.php?page=traveldesk-dashboard&status=success");exit;    
	
		
			//travelDeskToEmpNotify($rdid, $bookingStatusVal);
									
			// send mail to employee that ticket is booked or failed to book
		}
		else
		{
			//echo 2;
			header('Location: '.$_SERVER['REQUEST_URI']);exit; 
		}
		
		
		
		
	}
	else
	{
		//echo 2;
		header('Location: '.$_SERVER['REQUEST_URI']);exit; 
	}

}
        }
}