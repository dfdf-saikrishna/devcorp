<?php
function traveldeskclaims_create( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'traveldeskclaims'        => array(
						'hiddenTickets'=>'',
						'reqids'=>'',
						'totalAmount'=>'',
						'txtAccNo'=>'',
						'txtInvoiceNo'=>'',
						'txtServiceChrgs'=>'',
						'txtServiceTax'=>'',
						'txtaRemarks'=>'',
						'fileattach'=>'',
						'quantity'=>'',
						'invoiceNo' => '',
						'cmpid'=>'',
						)
    );

    $posted = array_map( 'strip_tags_deep', $args );
	
    $posted = array_map( 'trim_deep', $posted );
	$data   = erp_parse_args_recursive( $posted, $defaults );
	$reqid = $_GET['id'];
    if ( is_wp_error( $reqid ) ) {
        return $reqid;
    }
	$invoiceNo			=	genExpreqcodeinv();
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
	echo $imagename	=$_FILES['fileattach']['name'];
	$imtype		=$_FILES['fileattach']['type'];
	$imsize		=$_FILES['fileattach']['size'];
	$tmpname 	=$_FILES['fileattach']['tmp_name'];
	echo 'imtype='.$imtype; die;
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

/*////////////////////////////////////
		 GENERATE REQUEST IDS 
///////////////////////////////////*/

function genExpreqcodeinv(){
        global $wpdb;
	$compid = $_SESSION['compid'];
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

if ( isset( $_POST['buttoneditclaim'] ) ) {
	 $tdcid				=	$_POST['tdcid'];
		
	 $totalAmount		=	trim($_POST['totalAmount']);
		
	 $txtaRemarks		=	trim(addslashes($_POST['txtaRemarks']));
	
	 $txtServiceTax		=	trim($_POST['txtServiceTax']);
	
	 $txtServiceChrgs	=	trim($_POST['txtServiceChrgs'])*($_POST['hiddenTickets']);
	
	 $quantity			=	$_POST['hiddenTickets'];
	
	 $txtAccno			=	$_POST['txtAccNo'];
	
	 $tduserid =$_SESSION['tdid'];

	if($txtServiceTax && $txtServiceChrgs)
	$txtServiceTaxamnt=$txtServiceChrgs * ($txtServiceTax / 100);
	
	
	$totalAmount+=$txtServiceTaxamnt;
		
	if($txtServiceTax && $txtServiceChrgs)
	$totalAmount=$totalAmount + $txtServiceChrgs;
	
	 $totalAmount=abs($totalAmount);
	
	/*$imagename	=$_FILES['fileattach']['name'];
	$imtype		=$_FILES['fileattach']['type'];
	$imsize		=$_FILES['fileattach']['size'];
	$tmpname 	=$_FILES['fileattach']['tmp_name'];*/
	
	//echo 'imtype='.$imtype;//exit;
	
	$photoAllowed=0;
	
	/*if($imagename)
	{
	
		$allowedExts 		= 	array("doc", "docx", "pdf"); 
		$allowedMimeTypes 	= 	array("application/msword", 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf');
		$extension 			= 	end(explode('.', $imagename));
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
	
	}
	
	
	//echo $photoAllowed; exit;
	
	if($photoAllowed)
	{
		header("location:$filename?msg=1&reqids=$reqids");
		exit;
	}*/
	
	
	
	if($tdcid=="" || $totalAmount==""){
		
		$response = array('status'=>'failure','message'=>"OOPs !! Some fields went missing. Please try again.");
		exit;
	
	} else {	
	
	if(!empty($_FILES['fileattach']['name'])){
		$imagename =$_FILES['fileattach']['name'];
		if($imagename)
		{
		$tmpFilePath = $_FILES['fileattach']['tmp_name'];
				//Make sure we have a filepath
                          if ($tmpFilePath != ""){
                                //Setup our new file path


                                $ext = substr(strrchr($imagename, "."), 1); 
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
		} } else {
			$filePath=$_POST['oldimg'];
		}
		
		
		//$impath="upload/$compid/";
		
		//$filepath = str_replace($impath,"",$imagePath);
		
		global $wpdb;
		
		if($insertid	= $wpdb->update("travel_desk_claims", array('TD_Id'=>$tduserid, 'TDC_Amount'=>$totalAmount, 'TDC_ServiceTax'=>$txtServiceTax, 'TDC_ServiceCharges'=>$txtServiceChrgs, 'TDBA_Id'=>$txtAccno, 'TDC_Filename'=>$filePath, 'TDC_Remarks'=>$txtaRemarks, 'TDC_Level'=>'1'), array('TDC_Id'=>$tdcid))){
					
			
			//header("location:travel-desk-claims.php?msg=1&tdcid=$tdcid");
			header("location:/wp-admin/admin.php?page=claims");
			exit;
		
			
		
		} else {	
		$compid=$_SESSION['compid'];
			header("location:/wp-admin/admin.php?page=ViewClaims&action=view&tdcid=". $tdcid ."&cmpid=". $compid);		
			//header("location:$filename?msg=2&tdcid=$tdcid");
			exit;
		
			
		
		}
	
	
	}

}

/*
 * [erp_hr_url_single_companyview description]
 *
 * @param  int  company id
 *
 * @return string  url of the companyview details page
 */
 
function erp_travel_desk_claim_details_view($tdcid,$cmpid) {	
    $url = admin_url( 'admin.php?page=ViewClaims&action=view&tdcid=' . $tdcid.'&cmpid='.$cmpid);

    return apply_filters( 'erp_invoicedetails_url_single_view', $url, $tdcid,$cmpid);
}
?>
