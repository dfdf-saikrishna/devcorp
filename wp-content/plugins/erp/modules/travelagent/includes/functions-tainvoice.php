<?php
/*////////////////////////////////////
		 GENERATE REQUEST IDS 
///////////////////////////////////*/

function genExpreqcodeinvta($compid){
        global $wpdb;
	//$compid = $_SESSION['compid'];
	//if($f)
	//$tnetype="F".$tnetype;
	

	$m=date('m');
	$y=date('y');
	
	$code=$wpdb->get_row("SELECT * FROM code");
	
	
	//if($tnetype)	
	$requestcode=$compid.$m.$y.$code->code;
	$wpdb->query("UPDATE code SET code=$code->code+1");
	return $requestcode;

}


if ( isset( $_POST['claimsSubmit'] ) ) {
		//print_r($_FILES);

	$supid = $_POST['supid'];
	$compid 	= $_POST['cmpid'];
	
	$invoiceNo			=	'INV'.genExpreqcodeinvta($compid);
	
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
		
		global $wpdb;		
		 $insert = $wpdb->insert("travel_desk_claims", array('SUP_Id'=>$supid, 'COM_Id'=>$compid, 'TDC_ReferenceNo'=>$invoiceNo, 'TDC_Quantity'=>$quantity, 'TDC_Amount'=>$totalAmount, 'TDC_ServiceTax'=>$txtServiceTax, 'TDC_ServiceCharges'=>$txtServiceChrgs, 'TDC_InvoiceNo'=>$txtInvoiceNo, 'TDBA_Id'=>$txtAccno, 'TDC_Filename'=>$filePath, 'TDC_Remarks'=>$txtaRemarks, 'TDC_Type'=>'2', 'TDC_Level'=>'2'));

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
			header("location:/wp-admin/admin.php?page=createinvoice&action=view&id=".$compid);
//window.location.replace("/wp-admin/admin.php?page=claims");
			exit;
		
			
		
		} else {
		$response = array('status'=>'failure','message'=>"Error !! Please try again or contact your administrator.");
			header("location:$filename?msg=3&reqids=$reqids");
			exit;
		
			
		
		}
	
	
	}
}