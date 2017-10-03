<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="iconpicker-css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/fontawesome-iconpicker.css" type="text/css" media="all">
<link rel="stylesheet" id="icomoon.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<link rel="stylesheet" id="default-style-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/style(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom2css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom2.css" type="text/css" media="all">
<link rel="stylesheet" id="custom-responsive-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom-responsive.css" type="text/css" media="all">
 
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
        //$count_total = count_query("requests req, request_employee re", "DISTINCT (req.REQ_Id)", "WHERE req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empID' AND RE_Status=1 AND  REQ_Active != 9 AND REQ_Type != 5", $filename, 0);
        $count_total = count_query("requests req, request_employee re", "DISTINCT (req.REQ_Id)", "WHERE req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empID' AND REQ_Claim=1 AND RE_Status=1 AND  REQ_Active != 9 AND REQ_Type != 5", $filename, 0);
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
    
	<div class="news">
	    <?php echo do_shortcode('[horizontal-scrolling group="GROUP1"]'); ?>
	</div>

            
<main id="main" class="site-main">
                    <div class="main-inner" >
                                    <div id="pl-52"><div class="panel-grid" id="pg-52-0"><div class="panel-grid-cell" id="pgc-52-0-0"><div class="so-panel widget widget_overview panel-first-child panel-last-child" id="panel-52-0-0-0"><div class="box panel-widget-style">
<!-- Service block  -->
    <!-- block 1 -->
    <div class="col-md-3">
    <div class="cards">
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/departure.png" alt="Pre Travel">
        <h3>Pre Travel</h3>
        
        <div class="flex">
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Pre-travel" class="btn btn-success btn-sm">Create Request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=TravelExpense&tab=My_Pre_Travel_Expenses" class="btn btn-warning btn-sm">View Request</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 1 -->
    
     <!-- block 2 -->
    <div class="col-md-3">
    <div class="cards">
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/post-travel.png" alt="Post Travel">
        <h3>Post Travel</h3>
        
       <div class="flex">
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=Post-travel" class="btn btn-success btn-sm">Create Request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=TravelExpense&tab=My_Post_Travel_Expenses" class="btn btn-warning btn-sm">View Request</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 2 -->
    
     <!-- block 3 -->
    <div class="col-md-3">
    <div class="cards">
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/utility.png" alt="Utility / Mileage">
        <h3>Utility / Mileage</h3>
        
        <div class="flex">
         <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"> <a href="/wp-admin/admin.php?page=mileage-utility" class="btn btn-success btn-sm">Create Request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=mileage-utility" class="btn btn-warning btn-sm">View Request</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 3 -->
    
     <!-- block 4 -->
    <div class="col-md-3">
    <div class="cards">
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/general.png" alt="General Expenses">
        <h3>General Expenses</h3>
        
        <div class="flex">
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=create-others" class="btn btn-success btn-sm">Create Request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=general-expense-list" class="btn btn-warning btn-sm">View Request</a></div>
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
                            <li class="active"><a href="#my" data-toggle="tab"><i class="fa fa-user"></i> My Expenses</a></li>
                            <li><a href="#myteam" data-toggle="tab"><i class="fa fa-users"></i> My Team Expenses</a></li>
                        </ul>
                </div>
                <?php
                    //$payment_pending = count($wpdb->get_results("SELECT DISTINCT req.REQ_Id FROM employees emp, requests req, request_employee re, request_status rs, payment_details pd WHERE re.EMP_Id='$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1 AND re.REQ_Id = rs.REQ_Id AND pd.REQ_Id != rs.REQ_Id AND rs.REQ_Status = '2' AND rs.RS_EmpType = '1'"));
                    $payment_pending = count($wpdb->get_results("SELECT DISTINCT (req.REQ_Id) AS reqids, req.* FROM employees emp, requests req, request_employee re, request_details rd, request_status rs WHERE re.EMP_Id='$empID' AND rd.REQ_Id = req.REQ_Id AND rd.RD_Dateoftravel <= CURDATE() AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1 AND re.REQ_Id = rs.REQ_Id AND rs.REQ_Status = '2' AND rs.RS_EmpType = '1'"));

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
                                <h4><a href="/wp-admin/admin.php?page=View-My-Requests&selReqstatus=1"><?php echo $count_pending?></a></h4>
                                <p>Pending for Approval</p>
                            </div>
                        </div>
                        <!-- Block 1 -->
                        
                        <!-- Block 2 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="approve_req">
                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-My-Requests&selReqstatus=2"><?php echo $count_approved?></a></h4>
                                <p>Approved Request</p>
                            </div>
                        </div>
                        <!-- Block 2 -->
                        
                        <!-- Block 3 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending_req">
                                   <i class="fa fa-inr" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-payment-Requests"><?php echo $payment_pending ?></a></h4>
                                <p>Submit claims</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        
                        <!-- Block 4 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="total">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-My-Requests&claimstatus=claimed"><?php echo $count_total; ?></a></h4>
                                <p>Approved Claims</p>
                            </div>
                        </div>
                        <!-- Block 4 -->
                        </div>
                        <?php
						if($approver){
							$claims_pending = count($wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_employee re, employees emp, pre_travel_claim ptc WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND emp.COM_Id='$compid' AND ptc.PTC_RepMngrStatus=1 AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND emp.EMP_Status=1 AND emp.EMP_Access=1 AND re.RE_Status=1 AND req.REQ_Active !=9 AND ptc.REQ_Id = req.REQ_Id"));  
                            //$claims_pending = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_RepMngrStatus = '1'"));
                            $claims_approved = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_RepMngrStatus = '2'"));
                            $claims_rejected = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_RepMngrStatus = '9'"));
                        }
						else{
							$claims_pending = 0;
						}
						?>
                        <div class="tab-pane fade" id="myteam">
                        <!-- Block 1 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-Emp-Requests&selReqstatus=1"><?php echo $approver_pending?></a></h4>
                                <p>Pending for Approval</p>
                            </div>
                        </div>
                        <!-- Block 1 -->
                        
                        <!-- Block 2 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="approve_req">
                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-claim-Requests&selReqstatus=1"><?php echo $claims_pending; ?></a></h4>
                                <p>Approve Claims</p>
                            </div>
                        </div>
                        <!-- Block 2 -->
                        
                        <!-- Block 3 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending_req">
                                   <i class="fa fa-inr" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-Emp-Requests&selReqstatus=3"><?php echo $claims_rejected; ?></a></h4>
                                <p>Rejected Claims</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        
                        <!-- Block 4 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="total">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=View-Emp-Requests"><?php echo $approver_total;?></a></h4>
                                <p>My Team Expenses</p>
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