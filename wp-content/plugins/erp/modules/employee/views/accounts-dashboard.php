<link rel="stylesheet" href="segments.css" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="iconpicker-css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/fontawesome-iconpicker.css" type="text/css" media="all">
<link rel="stylesheet" id="icomoon.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<link rel="stylesheet" id="weather-icons.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/weather-icons.min.css" type="text/css" media="all">
<!--link rel="stylesheet" id="fontawesome-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/font-awesome.css" type="text/css" media="all"-->
<!--link rel="stylesheet" id="styles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/styles(1).css" type="text/css" media="all"-->
<link rel="stylesheet" id="mystyles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/mystyles.css" type="text/css" media="all">
<link rel="stylesheet" id="default-style-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/style(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom2css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom2.css" type="text/css" media="all">
<link rel="stylesheet" id="user.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/user.css" type="text/css" media="all">
<link rel="stylesheet" id="custom-responsive-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom-responsive.css" type="text/css" media="all">
<link rel="stylesheet" id="st-select.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/st-select.css" type="text/css" media="all">
 
 <link rel="stylesheet" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/styles2.css" />

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php
    global $wpdb;
    $compid = $_SESSION['compid'];
    $mydetails=myDetails();
    $empid=$mydetails->EMP_Id;
        //Eployee Travel Request
        $count_total=count($wpdb->get_results("SELECT DISTINCT (req.REQ_Id) FROM requests req, request_employee re WHERE COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND REQ_Active != 9 AND re.RE_Status=1"));
	$count_total = isset( $count_total ) ? $count_total : 0;
        $count_approved=count($wpdb->get_results("SELECT DISTINCT (req.REQ_Id) FROM requests req, request_employee re WHERE COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND REQ_Status=2 AND REQ_Active != 9 AND re.RE_Status=1")); 
	$count_approved = isset( $count_approved ) ? $count_approved : 0;
        $count_pending=count($wpdb->get_results("SELECT DISTINCT (req.REQ_Id) FROM requests req, request_employee re WHERE COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND REQ_Status=1 AND REQ_Active != 9 AND re.RE_Status=1")); 
	$count_pending = isset( $count_pending ) ? $count_pending : 0;
        $count_rejected=count($wpdb->get_results("SELECT DISTINCT (req.REQ_Id) FROM requests req, request_employee re WHERE COM_Id='$compid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id != '$empid' AND REQ_Status=3 AND REQ_Active != 9 AND re.RE_Status=1"));  
	$count_rejected = isset( $count_rejected ) ? $count_rejected : 0;
        //Travel Desk
        $cnttdc		=count($wpdb->get_results("SELECT TDC_Id FROM travel_desk_claims WHERE COM_Id='$compid'"));
        $cnttdc = isset( $cnttdc ) ? $cnttdc : 0;
        $cntpendng	=count($wpdb->get_results("SELECT TDC_Id FROM travel_desk_claims WHERE COM_Id='$compid' AND TDC_Status=1"));
        $cntpendng = isset( $cntpendng ) ? $cntpendng : 0;
        $cntapprvd	=count($wpdb->get_results("SELECT TDC_Id FROM travel_desk_claims WHERE COM_Id='$compid' AND TDC_Status=2"));
        $cntapprvd = isset( $cntapprvd ) ? $cntapprvd : 0;
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
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/departure.png" alt="Washed Out">
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
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/post-travel.png" alt="Washed Out">
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
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/utility.png" alt="Washed Out">
        <h3>Utility / Mileage</h3>
        
        <div class="flex">
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=mileage-utility" class="btn btn-success btn-sm">Create Request</a></div>
          <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6"><a href="/wp-admin/admin.php?page=mileage-utility" class="btn btn-warning btn-sm">View Request</a></div>
        </div>
        
        </div>
    </div>
    <!-- block 3 -->
    
     <!-- block 4 -->
    <div class="col-md-3">
    <div class="cards">
      <img src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/images/general.png" alt="Washed Out">
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
                            <li class="active"><a href="#my" data-toggle="tab"><i class="fa fa-user"></i>  Employee's Travel & Expense Request</a></li>
                            <li><a href="#myteam" data-toggle="tab"><i class="fa fa-users"></i> Travel Desk Claims</a></li>
                            <li><a href="#claims" data-toggle="tab"><i class="fa fa-file-text"></i> Employee Claims</a></li>
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
                                <h4><a href="/wp-admin/admin.php?page=View-All-Accounts-Requests&selReqstatus=1"><?php echo $count_pending?></a></h4>
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
                                <h4><a href="admin.php?page=View-All-Accounts-Requests&amp;selReqstatus=2"><?php echo $count_approved?></a></h4>
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
                                <h4><a href="admin.php?page=View-All-Accounts-Requests&amp;selReqstatus=3"><?php echo $count_rejected ?></a></h4>
                                <p>Rejected Requests</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        
                        <!-- Block 4 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="total">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=View-All-Accounts-Requests"><?php echo $count_total; ?></a></h4>
                                <p>Total Requests</p>
                            </div>
                        </div>
                        <!-- Block 4 -->
                        </div>
                        <div class="tab-pane fade" id="myteam">
                        <!-- Block 1 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=TravelClaims&amp;filter_status=1"><?php echo $cntpendng; ?></a></h4>
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
                                <h4><a href="admin.php?page=TravelClaims&amp;filter_status=2"><?php echo $cntapprvd; ?></a></h4>
                                <p>Approve Requests</p>
                            </div>
                        </div>
                        <!-- Block 2 -->
                        
                        <!-- Block 3 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending_req">
                                   <i class="fa fa-inr" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=TravelClaims"><?php echo $cnttdc; ?></a></h4>
                                <p>Total Requests</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        </div>
                        <?php
                            $claims_pending = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_FinanceStatus = '1'"));
                            $claims_approved = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_FinanceStatus = '2'"));
                            $claims_rejected = count($wpdb->get_results("SELECT PTC_Id FROM pre_travel_claim WHERE PTC_FinanceStatus = '9'"));
                            
                        ?>
                        <div class="tab-pane fade" id="claims">
                        <!-- Block 1 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                                <h4><a href="/wp-admin/admin.php?page=view-account-claim-requests&selReqstatus=1"><?php echo $claims_pending; ?></a></h4>
                                <p>Pending Claims</p>
                            </div>
                        </div>
                        <!-- Block 1 -->
                        <!-- Block 2 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="approve_req">
                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=view-account-claim-requests&selReqstatus=2"><?php echo $claims_approved; ?></a></h4>
                                <p>Approved Claims</p>
                            </div>
                        </div>
                        <!-- Block 2 -->
                        
                        <!-- Block 3 -->
                        <div class="col-md-3">
                            <div class="md-content_body">
                                <div class="pending_req">
                                   <i class="fa fa-inr" aria-hidden="true"></i>
                                </div>
                                <h4><a href="admin.php?page=view-account-claim-requests&selReqstatus=9"><?php echo $claims_rejected; ?></a></h4>
                                <p>Rejected Claims</p>
                            </div>
                        </div>
                        <!-- Block 3 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
	</div>
</div>
</main>





