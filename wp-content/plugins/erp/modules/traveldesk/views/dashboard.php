<?php
 require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req-dropdown.php';
global $wpdb;
    $compid = $_SESSION['compid'];
        $emp_total = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=1 AND bs.BA_Id=1 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        $emp_approved = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=3 AND bs.BA_Id=1 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        $emp_pending = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=1 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        $emp_rejected = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND bs.BS_Status=3 AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 ORDER BY bs.BS_Id DESC"));
        
        $count_total = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Active !=9 AND REQ_Type IN (2,3,4)"));
        $count_approved = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Status=2 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)"));
        $count_pending = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Status=1 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)"));
        $count_rejected = count($wpdb->get_results("SELECT REQ_Id FROM requests WHERE COM_Id='$compid' AND REQ_Status=3 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)"));
        $txtSrch	=	$_REQUEST['txtSrch'];
?>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">

 
 <link rel="stylesheet" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/styles2.css" />

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php

global $wpdb;
    $filename="";
    $compid = $_SESSION['compid'];
    //echo $compid;die;
    $empID = $_SESSION['empuserid'];
    $emp_code=$_SESSION['emp_code'];  
    // Retrieving my details
    $mydetails=myDetails();

    $approver='0';
    // checking approver(y/n)
    if($selrow=isApprover()){
        //print_r($selrow);die;
    $approver=1;

    $delegate=0;

    if($cnt=ihvdelegated(1)){
            $delegate=1;
    }
    $_SESSION['delegate']=NULL;

    if($cnt=ihvdelegated(2)){

            if(!$_SESSION['delegate'])
            $_SESSION['delegate']=time();


            foreach($cnt as  $value){

                    $empcodes.="'".$value->EMP_Code."'".",";
            }

            $empcodes=rtrim($empcodes,",");		

    }}
    if($approver){
	//checking that whether i'm the approver of my requests
	$myselfApprvr=0;
        $empcode=$mydetails->EMP_Code;
        $rprmgr=$mydetails->EMP_Reprtnmngrcode;
        
	if($empcode==$rprmgr){
		$myselfApprvr=1;
	}
    }
        $count_total = count_query("requests req, request_employee re", "DISTINCT (req.REQ_Id)", "WHERE req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empID' AND RE_Status=1 AND  REQ_Active != 9 AND REQ_Type != 5", $filename, 0);
        $count_approved = count_query("requests req, request_employee re", "DISTINCT (req.REQ_Id)", "WHERE req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empID' AND RE_Status=1 AND REQ_Status=2 AND REQ_Active != 9 AND REQ_Type != 5",$filename);
        $count_pending = count_query("requests req, request_employee re", "DISTINCT (req.REQ_Id)", "WHERE req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empID' AND RE_Status=1 AND REQ_Status=1 AND REQ_Active != 9 AND REQ_Type != 5",$filename,$filename);
        $count_rejected = count_query("requests req, request_employee re", "DISTINCT (req.REQ_Id)", "WHERE req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empID' AND RE_Status=1 AND REQ_Status=3 AND REQ_Active != 9 AND REQ_Type != 5",$filename);
        
        $approver_total=0;
        $approver_approved=0;
        $approver_pending=0;
        $approver_rejected=0;
          if($approver && !$delegate)
	      {
	        	if($_SESSION['delegate'])
                {
                        $approver_total=count_query("employees emp, requests req, request_employee re","DISTINCT (req.REQ_Id)","WHERE emp.EMP_Reprtnmngrcode IN ($empcodes) AND emp.EMP_Id != '$empuserid' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Active != 9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);

                        $approver_approved=count_query("employees emp, requests req, request_employee re","DISTINCT (req.REQ_Id)","WHERE emp.EMP_Reprtnmngrcode IN ($empcodes) AND emp.EMP_Id != '$empuserid' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id  AND req.REQ_Status=2 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename); 

                        $approver_pending=count_query("employees emp, requests req, request_employee re","DISTINCT (req.REQ_Id)","WHERE emp.EMP_Reprtnmngrcode IN ($empcodes) AND emp.EMP_Id != '$empuserid' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=1 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);  

                        $approver_rejected=count_query("employees emp, requests req, request_employee re","DISTINCT (req.REQ_Id)","WHERE emp.EMP_Reprtnmngrcode IN ($empcodes) AND emp.EMP_Id != '$empuserid' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=3 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);  
                }
            $rprcode=$selrow->EMP_Reprtnmngrcode;
            $frprcode=$selrow->EMP_Funcrepmngrcode;
            $approver_total+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);
            $approver_approved+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=2 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename); 
            $approver_pending+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=1 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);  
            $approver_rejected+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=3 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);  
         }
     
?>
<!--h3 class="tile-font">Dashboard</h3-->

<div class="wrap erp hrm-dashboard" >
    
	<!--div class="news">
	    <?php //echo do_shortcode('[horizontal-scrolling group="GROUP1"]'); ?>
	</div-->

            
<main id="main" class="site-main">
                    <div class="main-inner" >
                                    <div id="pl-52"><div class="panel-grid" id="pg-52-0"><div class="panel-grid-cell" id="pgc-52-0-0"><div class="so-panel widget widget_overview panel-first-child panel-last-child" id="panel-52-0-0-0"><div class="box panel-widget-style">
<!-- Service block  -->
    <!-- block 1 -->
    <div class="col-md-3">
    <div class="cards">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/departure.png" alt="Washed Out"-->
        <h3>Approval Request</h3>

        <div class="flex">
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Request-With-Approval" class="btn btn-success btn-sm">Create request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=View-Edit-appRequest" class="btn btn-warning btn-sm">Overview</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 1 -->
    
     <!-- block 2 -->
    <div class="col-md-3">
    <div class="cards">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/post-travel.png" alt="Washed Out"-->
        <h3>Group Request</h3>
        
       <div class="flex">
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Create-Request" class="btn btn-success btn-sm">Create request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Group-Request" class="btn btn-warning btn-sm">Overview</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 2 -->
    
     <!-- block 3 -->
    <div class="col-md-3">
    <div class="cards">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/utility.png" alt="Washed Out"-->
        <h3>Claims</h3>
        
        <div class="flex">
         <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"> <a href="/wp-admin/admin.php?page=claims" class="btn btn-success btn-sm">View Claims</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Bankdetails" class="btn btn-warning btn-sm">Bank Details</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 3 -->
    
     <!-- block 4 -->
    <div class="col-md-3">
    <div class="cards">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/general.png" alt="Washed Out"-->
        <h3>Company Expense Policy</h3>
        
        <div class="flex">
          <div class="col-md-6 col-md-6 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Download_Company_Expense_Policy" class="btn btn-success btn-sm">Download</a></div>
          
        </div>
        
        </div>
    <!-- block 4 -->
    </div>
  </div>
</div>
<!-- Service block End -->
<!-- Expenses Tab Start -->
<div class="container-fluid">
    <div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading" style="padding: 0px; padding-top: 5px; padding-left: 5px;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#my" data-toggle="tab"><i class="fa fa-user"></i> Employee's Booking / Cancellation Requests</a></li>
                            <li><a href="#myteam" data-toggle="tab"><i class="fa fa-users"></i> Travel Desk Expense Requests</a></li>
                        </ul>
                </div>
                <?php
                    $payment_pending = count($wpdb->get_results("SELECT DISTINCT req.REQ_Id FROM employees emp, requests req, request_employee re, request_status rs, payment_details pd WHERE re.EMP_Id='$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1 AND re.REQ_Id = rs.REQ_Id AND pd.REQ_Id != rs.REQ_Id AND rs.REQ_Status = '2' AND rs.RS_EmpType = '1'"));
                ?>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="my">
                         <!-- Block 1 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=requestview&selFilter=1"><?php echo $emp_total ?></a></h4>
                                <p>Pending Requests</p>
                            </div>
                        </div>
                        <!-- Block 1 -->
                        
                        <!-- Block 2 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="approve_req">
                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=requestview&selFilter=2"><?php echo $emp_approved ?></a></h4>
                                <p>Pending Cancellation Requests</p>
                            </div>
                        </div>
                        <!-- Block 2 -->
                        
                        <!-- Block 3 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending_req">
                                   <i class="fa fa-inr" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=requestview&selFilter=3"><?php echo $emp_pending ?></a></h4>
                                <p>All Booking Requests</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        
                        <!-- Block 4 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="total">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=requestview&selFilter=4"><?php echo $emp_rejected; ?></a></h4>
                                <p>All Cancellation Requests</p>
                            </div>
                        </div>
                        <!-- Block 4 -->
                        </div>
                        <?php
                            $claims_pending = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_RepMngrStatus = '1'"));
                            $claims_approved = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_RepMngrStatus = '2'"));
                            $claims_rejected = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_RepMngrStatus = '9'"));
                        ?>
                        <div class="tab-pane fade" id="myteam">
                        <!-- Block 1 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=tdeskrequestview&selReqstatus=1"><?php echo $count_pending?></a></h4>
                                <p>Pending Requests</p>
                            </div>
                        </div>
                        <!-- Block 1 -->
                        
                        <!-- Block 2 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="approve_req">
                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=tdeskrequestview&selReqstatus=2"><?php echo $count_approved; ?></a></h4>
                                <p>Approved</p>
                            </div>
                        </div>
                        <!-- Block 2 -->
                        
                        <!-- Block 3 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending_req">
                                   <i class="fa fa-inr" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=tdeskrequestview&selReqstatus=3"><?php echo $count_rejected; ?></a></h4>
                                <p>Rejected</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        
                        <!-- Block 4 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="total">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=tdeskrequestview"><?php echo $count_total;?></a></h4>
                                <p>Total Requests</p>
                            </div>
                        </div>
                        <!-- Block 4 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
	</div>
</div>
</main>
<?php 
	echo '<br>';
	$rowtl=$wpdb->get_row("Select * FROM tolerance_limits WHERE COM_Id='$compid' AND TL_Status=1 AND TL_Active=1");
	if(!empty($rowtl)){
	if($rowtl->TL_Percentage){
	echo ' <div class="alert alert-warning"><i><b>Note: </b>Tolerance Limit '.$rowtl->TL_Percentage .'%. Please dont exceed the tolerance limit for booking tickets amounts. </i></div>';
	}}
?>
<?php
$message = '';
if(isset($_GET['status'])){
    if($_GET['status'] == 'success'){
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Booked Successfully', 'companies_table_list')) . '</p></div>';
    }
	if($_GET['status'] == 'failure'){
        $message = '<div class="error below-h2" id="message"><p>' . sprintf(__('Failed to Book', 'companies_table_list')) . '</p></div>';
    }
	if($_GET['status'] == 'tolerance'){
        $message = '<div class="error below-h2" id="message"><p>' . sprintf(__('Tolerance Limit exceeds Please try Again', 'companies_table_list')) . '</p></div>';
    }
	if($_GET['status'] == 'date'){
        $message = '<div class="error below-h2" id="message"><p>' . sprintf(__('Failed to Book Elapsed Travel Date', 'companies_table_list')) . '</p></div>';
    }
}
?>
<?php echo $message;?>
<h2>Ticket Booking / Cancellation Requests</h2>
<div class="postbox">
                <div class="inside">
				
<div class="filter-top">
	<form method="POST" action="#">
		<div class="row">
			<div class="col-md-3 col-xs-12 col-sm-12 ">
				<a href="#" id="traveldeskrise_invoice" class="btn btn-primary btn-block">Raise Invoice</a>
			</div>
			<div class="col-md-3 col-xs-12 col-sm-12"> &nbsp;</div>
			<div class="col-md-5 col-xs-12 col-sm-12">
				<input type="text" class="form-control" value="<?php echo $txtSrch;?>" name="txtSrch" placeholder="Search Request">
			</div>
			<div class="col-md-1 col-xs-12 col-sm-12 pull-right">
				<input type="submit" class="btn btn-primary btn-block " value="Filter">
			</div>
		</div>	
	</form>
</div>
        
                <!-- HTML TABLE -->
                          <div class="panel-group">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr height="35">
                    <th width="10%" style="text-align:left;">Sl.no. </th>
                    <th width="5%" style="text-align:left; padding-left:5px;">&nbsp;</th>
                    <th width="15%" style="text-align:left; padding-left:5px;">Request Code</th>
                    <th width="15%" style="text-align:left; padding-left:5px;">Request Type</th>
                    <th width="17%" >Quantity</th>
                    <th>Date</th>
                    <th width="15%" style="text-align:left;">Quote Amount (Rs)</th>
                    <th width="5%" style="text-align:left; padding-left:5px;">&nbsp;</th>
                  </tr>
                </thead>
              </table>
              </div>
            <?php
			    
			    if($txtSrch)
			    {
			    $txtSrch = trim($txtSrch);    
				$selcom =" AND (req.REQ_Code LIKE '%$txtSrch%')";
			    }
				else
				{
				$selcom ="";
				}
				$i=1; $j = 1;
				$selsql = $wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$compid' AND req.REQ_Id=rd.REQ_Id"
        . " AND bs.BS_Status IN (1,3) AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1".$selcom." ORDER BY bs.BS_Id DESC LIMIT 0, 10");
				foreach ($selsql as $rowsql) {
				
				
				
				
					?>
            <?php	
								
							
				$getvals = $wpdb->get_results("SELECT DISTINCT (rd.RD_Id),rd.*,bs.* FROM request_details rd, booking_status bs WHERE rd.REQ_Id=$rowsql->REQ_Id AND rd.RD_Id=bs.RD_Id AND bs.BS_Status IN (1,3) AND BS_Active=1 AND RD_Status=1");	
				$void=0; $icon=0; $onclick=NULL;

				foreach ($getvals as $values) {
				
					if($values->BS_Status != 3)
					$totalcosts+=$values->RD_Cost;									

					$rdids.=$values->RD_Id . ",";							
					if($values->BA_Id==1)
					$void += 1;
					
				}
				
				//echo 'totalcost='.$totalcosts."<br>";

				$rdids = rtrim($rdids, ",");

				if (!$rdids)
				$rdids = "'" . "'";
				
				if($void){
				
					$void='onclick="alert(\'Selected request is not closed. Please close it and then select for claim.\'); return false;"';
				
				} else {
				    
					$selclmreqid=$wpdb->get_row("SELECT REQ_Id, TDC_Status FROM travel_desk_claims tdc, travel_desk_claim_requests tdcr WHERE tdc.COM_Id='$compid' and tdc.TDC_Id=tdcr.TDC_Id AND tdcr.REQ_Id=$rowsql->REQ_Id");
		
					//echo 'count='.count($selclmreqid)."<br>";
					
					if(count($selclmreqid) != "0"){
						$onclick='onclick="alert(\'Selected request is already sent for claims. Please select another request.\'); return false;"';
						$icon=1;
					}
							
					if($selclmreqid->TDC_Status==2)
					$icon=2;
					
					
					//echo 'tdc status='.$selclmreqid[TDC_Status]."<br>";
					
				
				} 
				

                         
						 
						switch ($rowsql->REQ_Type){
						
							case 1:
							$href='/wp-admin/admin.php?page=view-booking-req';
							//$href='view-booking-req';
							$type='<span style="font-size:10px;">[E]</span>';
							$title="Employee Request";
							break;
							
							case 2:
							$href='/wp-admin/admin.php?page=View-Request';
							$type='<span style="font-size:10px;">[W/A]</span>';
							$title="Without Approval";
							break;
							
							case 3:
							$href='/wp-admin/admin.php?page=View-Appr-Request';
							$type='<span style="font-size:10px;">[AR]</span>';
							$title="Approval Required";
							break;
						
							case 4:
							$href='/wp-admin/admin.php?page=Group-Request-Details';
							$type='<span style="font-size:10px;">[G]</span>';
							$title="Group Request Without Approval";
							break;
							
							
						
						}
						
                                                            ?>
            <div class="panel panel-shadow">
              <header class="panel-heading" style="padding:0 10px">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr title="<?php echo $title; ?>">
                      <td  width="10%"><?php echo $i; ?>. </td>
                      <td width="5%"><input type="checkbox" name="reqid[]" value="<?php echo $rowsql->REQ_Id?>" <?php if($void) echo $void; if($onclick) echo $onclick;  ?> /></td>
                      <td  width="15%" title="<?php if($icon==1) echo 'sent for claims'; else if($icon==2) echo 'claimed'; ?>"><a href="<?php echo $href; ?>&reqid=<?php echo $rowsql->REQ_Id; ?>"><?php echo $rowsql->REQ_Code; ?></a>
                        <?php if($icon==1) echo '<i class="fa fa-thumbs-o-up"></i>'; else if($icon==2) echo '<i class="fa fa-thumbs-up"></i>'; ?></td>
                      <td width="15%" style=" padding-left:25px;"><?php echo $type;?></td>
                      <td width="10%" style="text-align:center;"><?php if($void) echo '<span class="status-1">'.count($getvals).'</span>'; else echo '<span class="status-2">'.count($getvals).'</span>';  ?></td>
                      <td width="25%" style="text-align:center; padding-left:30px;"><?php  echo date('d-M-Y', strtotime($rowsql->REQ_Date)) ?></td>
                      <td width="20%" style="text-align:center;"><?php echo IND_money_format($totalcosts). ".00"; $totalcosts = NULL ; ?></td>
                      <td><a data-toggle="collapse" href="#collapse<?php echo $i; ?>"><i class="collapse-caret fa fa-angle-down" style="font-size: 18px; border-radius:50%; background: #0073aa; padding: 1px 5px; color: #fff;"></i> </a> </td>
                    </tr>
                  </table>
                </div>
              </header>
              <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                <!--div class="panel-body"-->
                <div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="font-size:11px;">
                      <thead class="thead-inverse">
                        <tr>
                          <th width="10%">Date</th>
                          <th width="12%">Expense Description</th>
                          <th width="12%" colspan="2">Expense Category</th>
                          <th width="10%">Place</th>
                          <th width="10%">Estimated Cost</th>
                          <th width="20%">Booking Status</th>
                          <th width="20%">Cancellation Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
						$rddetails = $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mo WHERE REQ_Id='$rowsql->REQ_Id' AND rd.RD_Id IN ($rdids) AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mo.MOD_Id AND RD_Status=1 ORDER BY RD_Id ASC");


						$rdids = "";



						foreach ($rddetails as $rowsql) {
                                                            ?>
                        <tr>
                          <td align="center"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?></td>
                          <td><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                          <td><?php echo $rowsql->EC_Name; ?></td>
                          <td><?php echo $rowsql->MOD_Name; ?></td>
                          <td><?php if ($rowsql->EC_Id == 1) { ?>
                            <b>From:</b> <?php echo $rowsql->RD_Cityfrom; ?><br />
                            <b>To:</b> <?php echo $rowsql->RD_Cityto; ?>
                            <?php } else { ?>
                            <b>Loc:</b> <?php echo $rowsql->RD_Cityfrom; ?>
                            <?php                                       
                                                                        if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'")) {
                                                                            echo '<br>Stay :' . $rowsd->SD_Name;
                                                                        }
                                                                        ?>
                            <?php } ?></td>
                          <td align="right"><?php echo IND_money_format($rowsql->RD_Cost) . ".00"; ?></td>
                          <!----- BOOKING STATUS STATUS ------>
                          <td><?php
                          
			$selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");



			if ($selrdbs->RD_Id) {
                                                                        ?>
                            <form method="post" id="bookingForm<?php echo $j; ?>" name="bookingForm<?php echo $j; ?>" enctype="multipart/form-data">
                              <input type="hidden" name="rdid<?php echo $j; ?>" id="rdid<?php echo $j; ?>" value="<?php echo $rowsql->RD_Id ?>" />
                              <input type="hidden" name="type<?php echo $j; ?>" id="type" value="1" />
                              <div id="bookingStatusContainer<?php echo $j; ?>">
							  <input type="hidden" name="bookingcost<?php echo $j; ?>" id="bookingcost" value="<?php echo $rowsql->RD_Cost; ?>" />
                                <?php
				if ($selrdbs->RD_Id) {

					echo ($selrdbs->BA_Id == 1) ? bookingStatus($selrdbs->BA_Id) . "<br>" : '';

					echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";

					echo '----------------------------------<br>';

					$query = "BA_Id IN (2,3)";
				}

				if ($selrdbs->BA_Id == 2 || $selrdbs->BA_Id == 3) {
                    echo bookingStatus($selrdbs->BA_Id);
					//echo 'baid='.$selrdbs['BA_Id'];

					$imdir= WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";
							

					$doc = NULL;

					if ($selrdbs->BA_Id == 2) {

						$seldocs = $wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='". $selrdbs->BS_Id ."'");

						$f = 1;

						foreach ($seldocs as $docs) {

							$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link" download>download</a><br>';

							$f++;
						}
					}



					switch ($selrdbs->BA_Id) {

						case 2:
							echo '<br>';
							echo '<b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
							echo $doc;
							echo '<b>Booked Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
							break;

						case 3:
							echo '<br>';
							echo '<strong>Failed Date</strong>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
							break;
					}
				} else if ($selrdbs->BA_Id == 1) {
                                                                                    ?>
                                <div class="col-sm-8" id="imgareaid<?php echo $j; ?>"></div>
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                  <div class="form-group">
                                    <div>
                                      <select name="selBookingActions<?php echo $j; ?>" id="selBookingActions<?php echo $j; ?>" class="form-control" onchange="showHideBookingcustom(<?php echo $j; ?>, this.value)" >
                                        <option value="">Select</option>
                                        <?php
											$ba = $wpdb->get_results("Select * FROM booking_actions WHERE $query");

											foreach ($ba as $barows) {
                                                                                                        ?>
                                        <option value="<?php echo $barows->BA_Id; ?>"><?php echo $barows->BA_Name; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                               
                                <div class="col-sm-12 col-xs-12 col-md-12" style="display:none;" id="amntDiv<?php echo $j; ?>">
                                  <div class="form-group">
                                      <input type="text" class="form-control"  name="txtAmount<?php echo $j; ?>" onkeyup="return checkCost(this.id)"  id="txtAmount<?php echo $j; ?>" />
                                  </div>
                                </div>
                               
                                <div  class="col-sm-12 col-xs-12 col-md-12" id="ticketUploaddiv<?php echo $j; ?>" style="display:none;">
                                 
                                    <input type="file" multiple="true" class="fileattach" name="fileattach<?php echo $j; ?>[]" id="fileattach<?php echo $j; ?>[]" onchange="return Validate(this.id);">
                                      <!-- //fileinput-->
                      
                                </div>
                               
                                <div class="col-sm-6 col-xs-6">
                                  
                                      <button name="buttonUpdateStatus" id="buttonUpdateStatus<?php echo $j; ?>" value="<?php echo $j; ?>" style="display:none;" type="submit" class="btn btn-success btn-sm btn-block">Update</button>
                                  
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                 
                                      <button name="buttonCancel" id="buttonCancel<?php echo $j; ?>" value="<?php echo $j; ?>" style="display:none;" onclick="cancelBookingstat(this.value)" type="button" class="btn btn-danger btn-sm btn-block">Cancel</button>
                                   
                                </div>
								<br>
                                <?Php
                                                                                }
                                                                                ?>
                              </div>
                            </form>
                            <?php
                                                                    } else {

                                                                        echo bookingStatus(NULL);
                                                                    }
                                                                    ?>
                          </td>
                          <!----- CANCELLATION STATUS ------>
                          <td><?php
									if ($selrdcs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='". $rowsql->RD_Id ."' AND BS_Status=3 AND BS_Active=1")) {
										?>
                            <form method="post" id="cancellationForm<?php echo $j; ?>" name="cancellationForm<?php echo $j; ?>" enctype="multipart/form-data">
                              <input type="hidden" name="rdid1<?php echo $j; ?>" id="rdid1<?php echo $j; ?>" value="<?php echo $rowsql->RD_Id ?>" />
                              <input type="hidden" name="type1<?php echo $j; ?>" id="type1" value="2" />
                              <div id="cancelStatusContainer<?php echo $j; ?>">
                                <?php
						if ($selrdcs->RD_Id) {

							echo ($selrdcs->BA_Id == 1) ? bookingStatus($selrdcs->BA_Id) . "<br>" : '';

							echo '<b title="cancellation request date">Request Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdcs->BS_Date)) . "<br>";

							echo '----------------------------------<br>';

							$query = "BA_Id IN (4,5)";
						}
						
						//echo 'Baid='.$selrdcs['BA_Id']; 			


						if ($selrdcs->BA_Id == 4 || $selrdcs->BA_Id == 5 || $selrdcs->BA_Id == 6 || $selrdcs->BA_Id == 7) {

							$cancellationstatus = bookingStatus($selrdcs->BA_Id);
							echo $cancellationstatus;

							$doc = NULL;

							if ($selrdcs->BA_Id == 4 || $selrdcs->BA_Id == 6) {

								$seldocs = $wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='$selrdcs->BS_Id'");

								$f = 1;
							$imdir= WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$compid/bills_tickets/";
								
								foreach ($seldocs as $docs) {
								
                                   
									$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" download="file_name" class="btn btn-link">download</a><br>';

									$f++;
								}
							}


							switch ($selrdcs->BA_Id) {

								case 4: case 6:
									echo '<br><b>Cancellation Amnt</b>: ' . IND_money_format($selrdcs->BS_CancellationAmnt) . '.00<br>';
									echo $doc;
									echo '<b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;

								case 5: case 7:
									echo '<br><b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;
							}
																					
																					
																					
                      } else if ($selrdcs->BA_Id == 1) {
                                                                                    ?>
                                <div class="col-sm-12" id="imgareaid2<?php echo $j; ?>"></div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <div>
                                      <select name="selCancActions<?php echo $j; ?>" id="selCancActions<?php echo $j; ?>" class="form-control" onChange="showHideCanc(<?php echo $j; ?>, this.value)">
                                        <option value="">Select</option>
                                        <?php
                                                                                                    $ba = $wpdb->get_results("Select * FROM booking_actions WHERE $query");

                                                                                                    foreach ($ba as $barows) {
                                                                                                        ?>
                                        <option value="<?php echo $barows->BA_Id; ?>"><?php echo $barows->BA_Name; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-8" id="cancAmntDiv<?php echo $j; ?>" style="display:none;">
                                  <div class="form-group">
                                    <div>
                                      <input type="text" class="form-control"  name="txtCanAmount<?php echo $j; ?>" onKeyUp="return checkCost(this.id)"  id="txtCanAmount<?php echo $j; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-8" id="ticketCancDiv<?php echo $j; ?>" style="display:none;">
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="fileCanAttach<?php echo $j; ?>[]" id="fileCanAttach<?php echo $j; ?>[]" multiple="true" onchange="return Validate(this.id);">
                                      <!-- //fileinput-->
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <div>
                                      <button name="buttonUpdateStatusCanc" id="buttonUpdateStatusCanc<?php echo $j; ?>" value="<?php echo $j; ?>" style="display:none; width:75px; height:20px; padding-bottom:20px;" type="submit" class="btn btn-link">Update</button>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <div>
                                      <button name="buttonCancelCanc" id="buttonCancelCanc<?php echo $j; ?>" style="display:none; width:75px; height:20px; padding-bottom:20px;" onClick="cancelCancstat(<?php echo $j; ?>)" type="button" class="btn btn-link">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                                <?Php
                                                                                }
                                                                                ?>
                              </div>
                            </form>
                            <?php
                                                                    } else {
                                                                        echo bookingStatus(NULL);
                                                                    }
                                                                    ?>
                          </td>
                        </tr>
                        <?php
                                                            $j++;
                                                        }
                                                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- //panel-body -->
              </div>
              <!-- //panel-collapse -->
            </div>
            <?php
                                    $i++;
                                }

                                //mysqli_free_result($ressql); 
                                ?>
            <!-- //panel -->
          </div>
                
                <!-- HTML TABLE -->
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                </div>
                <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
				<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
  

</script>
     
</body>
            </div>
        </div>
    </div>
</div>