<link rel="stylesheet"  href="<?php echo WPERP_COMPANY_ASSETS ?>/css/widgets.css" type="text/css" media="all">
<?php
global $wpdb;
$compid = $_SESSION['compid'];
$empcount = count($wpdb->get_results("SELECT * FROM employees WHERE EMP_Status=1 AND COM_Id='$compid'"));
$finance = count($wpdb->get_results("SELECT * FROM employees WHERE EMP_AccountsApprover=1 AND EMP_Access=1 AND EMP_Status=1 AND COM_Id='$compid'"));
$accgadmins = count($wpdb->get_results("SELECT * FROM travel_desk WHERE TD_Status=1 AND COM_Id='$compid'"));

$count_total = count($wpdb->get_results("SELECT REQ_Id FROM  requests WHERE COM_Id='$compid' AND REQ_Active != 9"));
$count_approved = count($wpdb->get_results("SELECT REQ_Id FROM  requests WHERE COM_Id='$compid' AND REQ_Status=2 AND REQ_Active != 9"));
$count_pending = count($wpdb->get_results("SELECT REQ_Id FROM  requests WHERE COM_Id='$compid' AND REQ_Status=1 AND REQ_Active != 9"));
$count_rejected = count($wpdb->get_results("SELECT REQ_Id FROM  requests WHERE COM_Id='$compid' AND REQ_Status=3 AND REQ_Active != 9"));
// print_r($count_total);die;
?>
<div class="hidden-sm hidden-md hidden-lg"><h2>Dashboard</h2></div>
<div class="wrap erp hrm-dashboard">

     <?php
        global $wpdb;

        $table = new WeDevs\ERP\Company\Company_List_Table();
        $table->prepare_items();

        $message = '';
        if ('delete' === $table->current_action()) {
            $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
        }
        ?>
       

</div>


<!-- grids start -->
<!--<div style="width: 100%;">
<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 10px 20px;"><img src="/wp-content/plugins/erp/assets/images/emp.png" style="margin-top:10%;width:30%;height:20%;float:left;"><div style="font-size: 14px;font-weight:bold;text-align:top;color:#4A4A4A;width:70%;float:left;margin-top:inherit;">Employee Management</div><a href="/wp-admin/admin.php?page=Des" style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.9vw;margin-top: 15%;">Designation</a><a href="/wp-admin/admin.php?page=Dep" style="display: block;color: #6C6B6B;margin: auto;text-align: right;font-size: 0.8vw;">Department</a><a href="/wp-admin/admin.php?page=delegation" style="color: #6C6B6B;display: block;margin: auto;text-align: right;font-size: 0.8vw;">Deligations</a><a href="/wp-admin/admin.php?page=Grades" style="color: #6C6B6B;display: block;margin: auto;text-align: right;font-size: 0.8vw;">Grades</a></div>

<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding:19px 20px;"><img src="/wp-content/plugins/erp/assets/images/empmanage.png" style="margin-top:10%;width:30%;height:20%;float:left;"><div style="font-size: 14px;font-weight:bold;color:#4A4A4A;width:70%;float:left;text-align:right;">Employee Profile</div><div style="display: block;text-align:right;margin: auto;color:#0096A8;font-size: 0.9vw;margin-top:11%;"><a href="/wp-admin/admin.php?page=menu">Add</a>/<a href="/wp-admin/admin.php?page=Upload-Employees"> Upload</a></div><a href="/wp-admin/admin.php?page=Profile" style="display: block;color: #6C6B6B;margin: auto;text-align:right;font-size: 0.8vw;">View Profiles</a><br></div>

<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding:10px 20px;"><img src="/wp-content/plugins/erp/assets/images/menu_fiannceapprovers.png" style="margin-top:10%;width:30%;height:20%;float:left;"><div style="font-weight:bold;font-size: 14px;color:#4A4A4A;width:70%;float:left;text-align:right;margin-top:inherit;">Finance Approvers</div><a href="/wp-admin/admin.php?page=finance" style="display: block;margin: auto;font-size: 0.9vw;color:#0096A8;text-align:right;margin-top:15%;">View Finance</a><a href="/wp-admin/admin.php?page" style="display: block;margin: auto;font-size: 0.8vw;color:#6C6B6B;text-align:right;">Approvers</a><a href="/wp-admin/admin.php?page=Limits" style="display: block;margin: auto;font-size: 0.8vw;text-align:right;color:#6C6B6B;">Define Approvers</a><a href="/wp-admin/admin.php?page=Limits" style="display: block;margin: auto;font-size: 0.8vw;text-align:right;color:#6C6B6B;">Limits(Set/Edit)</a></div>

<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 10px 20px;clear: both;"><img src="/wp-content/plugins/erp/assets/images/menu_expensemanagement.png" style="margin-top:10%;width:30%;height:20%;float:left;"><div style="float:left;font-size: 14px;color:#4A4A4A;font-weight: bold;width:70%;text-align:right;margin-top:inherit;">Expense Management</div><a href="/wp-admin/admin.php?page=gradelimitcat" style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.9vw;margin-top:20%;">Define Grade Limits</a>
<a href="/wp-admin/admin.php?page=addcat" style="display: block;color:#6C6B6B;margin: auto;font-size: 0.8vw;text-align:right;">Custom Expense Category</a>
<a href="/wp-admin/admin.php?page=categeory" style="color:#6C6B6B;display: block;margin: auto;font-size: 0.8vw;text-align:right;">Expense Category</a>
<a href="/wp-admin/admin.php?page=Mileage" style="color:#6C6B6B;display: block;margin: auto;font-size: 0.8vw;text-align:right;">Mileage</a></div>


<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 26px 20px;"><img src="/wp-content/plugins/erp/assets/images/menu_worflow.png" style="margin-top:inherit;width:30%;height:20%;float:left;"><div style="font-size: 14px;color:#4A4A4A;font-weight: bold;width:70%;float:left;text-align:right;">Work Flow</div><a href="/wp-admin/admin.php?page=WorkFlow" style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.9vw;margin-top:15%;">Define Work Flow</a></div>

<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 23px 20px;"><img src="/wp-content/plugins/erp/assets/images/menu_traveldesk.png" style="margin-top:inherit;width:30%;height:20%;float:left;"><div style="font-size: 14px;text-align:right;color:#4A4A4A;font-weight: bold;width:70%;float:left;">Travel Desk</div><a href="/wp-admin/admin.php?page=Travel" style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.9vw;margin-top:15%;">Add/Update Request</a><a href="/wp-admin/admin.php?page=Invoice" style="display: block;color:#6C6B6B;margin: auto;text-align:right;font-size: 0.8vw;">View Invoices</a><a href="/wp-admin/admin.php?page=Tolerance" style="display: block;margin: auto;color:#6C6B6B;text-align:right;font-size: 0.8vw;">Tolerance Limits</a></div>

<div class="ss" style="width: 20%;clear: both;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding:16px 20px;"><img src="/wp-content/plugins/erp/assets/images/menu_expenserequests.png" style="margin-top:inherit;width:30%;height:20%;float:left;"><div style="font-size: 14px;color:#4A4A4A;text-align:right;font-weight: bold;width:70%;float:right;">Expense Requests</div><a href="/wp-admin/admin.php?page=Expense-Requests" style="display: block;margin: auto;color:#0096A8;text-align:right;font-size: 0.9vw;margin-top:19%;">View Requests</a><a href="/wp-admin/admin.php?page=Expense-Requests" style="display: block;margin: auto;color:#6C6B6B;text-align:right;font-size: 0.8              vw;">Requests</a></div>

<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 25px 20px;text-align: top;"><img src="/wp-content/plugins/erp/assets/images/menu_budgetcontrols.png" style="margin-top:inherit;width:30%;height:20%;float:left;"><div style="font-size: 14px;color:#4A4A4A;text-align: right;font-weight: bold;width:70%;float:right;/* clear: both; */">Budget Control</div><a href="/wp-admin/admin.php?page=Budget" style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.8vw;margin-top: 19%;">Add Budget Control</a><a href="/wp-admin/admin.php?page=Center" style="display: block;color:#6C6B6B;margin: auto;text-align:right;font-size: 0.7vw;">Cost Center</a></div>

<div class="ss" style="width: 20%;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 16px  20px;"><img src="/wp-content/plugins/erp/assets/images/menu_reports.png" style="margin-top:inherit;width:30%;height:20%;float:left;"><div style="font-size: 14px;color:#4A4A4A;text-align:right;font-weight: bold;width:70%;float:right;margin-top:inherit;">Graphs Reports</div><a href="/wp-admin/admin.php?page=Graphs" style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.9vw;margin-top:20%;">Graphs</a><a href="/wp-admin/admin.php?page=Employeewise" style="display: block;color:#6C6B6B;margin: auto;text-align:right;font-size: 0.8vw;">Employee Wise</a><a href="/wp-admin/admin.php?page=Tracker" style="display: block;margin: auto;color:#6C6B6B;text-align:right;font-size: 0.8vw;">Travel Spend Tracker</a></div>

<div class="ss" style="width: 20%;clear: both;height:30%;background-color:#F6F5F5;margin:10px;float:left;border-radius: 12px !important;padding: 11px 20px;"><img src="/wp-content/plugins/erp/assets/images/request-status.png" style="margin-top:inherit;width:30%;height:20%;float:left;"><div style="font-size: 14px;color:#4A4A4A;text-align:right;font-weight: bold;width:70%;float:right;margin-top:inherit;">Request Status</div><div style="margin:auto;"></div><div style="display: block;margin: auto;text-align:right;color:#0096A8;font-size: 0.9vw;margin-top:20%;">Total Requests : <a href="admin.php?page=Expense-Requests" style="text-align:right;">10</a></div>
<div style="display: block;margin: auto;text-align:right;font-size: 0.8vw;">Approved : <a href="admin.php?page=Expense-Requests&amp;filter_status=2"> 0</a></div>
<div style="display: block;margin: auto;text-align:right;font-size: 0.8vw;">Pending : <a href="admin.php?page=Expense-Requests&amp;filter_status=1">10</a></div>
<div style="display: block;margin: auto;text-align:right;font-size: 0.8vw;">Rejected : <a href="admin.php?page=Expense-Requests&amp;filter_status=3">0</a></div></div></div>
</div>-->
<style>
    
    .flex{
   height: 123px;

    }
    
    
</style>

<div class="container-fluid">
<div class="widget-wrapper col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<section class="widget widget-xs widget-xs-a">
					<a href="admin.php?page=Expense-Requests">
					<div class="widget-inner">
    					<div class="chart-container">
        					<i class="fa fa-bar-chart" style="font-size:40px; color:#fff;" aria-hidden="true"></i>
    					</div>
    					<div class="info-container">
        					<h3 class="title"><span class="figure"><?php echo $count_total;?></span><span class="note">Total Requests</span></h3>
    					</div>
					</div>
					</a>
				</section>
			</div>
			
			
<div class="widget-wrapper col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<section class="widget widget-xs widget-xs-b">
				<a href="admin.php?page=Expense-Requests&amp;filter_status=2">
					<div class="widget-inner">
    					<div class="chart-container">
        					<i class="fa fa-check-circle" style="font-size:44px; color:#fff;" aria-hidden="true"></i>
    					</div>
    					<div class="info-container">
        					<h3 class="title"><span class="figure"><?php echo $count_approved;?></span><span class="note">Approved Requests</span></h3>
    					</div>
					</div>
					</a>
				</section>
			</div>
			
<div class="widget-wrapper col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<section class="widget widget-xs widget-xs-d">
				<a href="admin.php?page=Expense-Requests&amp;filter_status=1">
					<div class="widget-inner">
    					<div class="icon-container">
        					<i class="fa fa-exclamation-triangle" style="font-size:40px; color:#fff;" aria-hidden="true"></i>
    					</div>
    					<div class="info-container">
        					<h3 class="title"><span class="figure"><?php echo $count_pending;?></span><span class="note">Pending Requests</span></h3>
    					</div>
					</div>
					</a>
				</section>
			</div>
			

<div class="widget-wrapper col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<section class="widget widget-xs widget-xs-c">
				<a href="admin.php?page=Expense-Requests&amp;filter_status=3">
					<div class="widget-inner">
    					<div class="icon-container">
        					<i class="fa fa-times-circle" style="font-size:44px; color:#fff;" aria-hidden="true"></i>
    					</div>
    					<div class="info-container">
        					<h3 class="title"><span class="figure"><?php echo $count_rejected;?></span><span class="note">Rejected Requests</span></h3>
    					</div>
					</div>
					</a>
				</section>
			</div>
</div>



<main id="main" class="site-main">
                    <div class="main-inner" >
                    <div id="pl-52"><div class="panel-grid" id="pg-52-0"><div class="panel-grid-cell" id="pgc-52-0-0"><div class="so-panel widget widget_overview panel-first-child panel-last-child" id="panel-52-0-0-0"><div class="box panel-widget-style">
<!-- Service block  -->
    <!-- block 1 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/departure.png" alt="Washed Out"-->
       <h3>Employee Management</h3>
        
        <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<div style="float:left"><img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_empprof.png" style="float: left; padding-right: 20px;"></div>
						<div style="float:right">
						<ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=Des" >Designation</a></strong>
								
							</li>

							<li>
								<strong><a href="/wp-admin/admin.php?page=Dep" >Department</a></strong>
								
							</li>
                         <li>   
                           <strong> <a href="/wp-admin/admin.php?page=delegation" >Deligations</a></strong></li>
                            
                         <li>  <strong> <a  href="/wp-admin/admin.php?page=Grades" >Grades</a></strong></li>
						</ul></div>
					</div>
        </div>
        
        </div>
    </div>
    <!-- block 1 -->
    
     <!-- block 2 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/post-travel.png" alt="Washed Out"-->
       <h3>Employee Profile</h3>
        
      <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
						<div style="float:left"><img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_empmang.png" style="float: left; padding-right: 20px;"></div>
						
						
						<div style="float:right"><ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=menu">Add</a>&nbsp;/<a href="/wp-admin/admin.php?page=Upload-Employees"> Upload</a></strong>
								
							</li>

							<li>
								<strong><a href="/wp-admin/admin.php?page=Profile" >View Profiles</a></strong>
								
							</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            
						</ul></div>
					</div>
        </div>
        
        </div>
    </div>
    <!-- block 2 -->
    
     <!-- block 3 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/utility.png" alt="Washed Out"-->
        <h3>Finance Approvers</h3>
        <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<div style="float:left"><img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_finapprov.png" style="float: left; padding-right: 20px;"></div>					
						
						
					<div style="margin-top: -68px;margin-right: -12px;/* margin-top: -71px; */float:right;"><ul class="dash">
							<li><strong><a href="/wp-admin/admin.php?page=finance" >View Finance</a></strong></li>
							<li><strong><a href="/wp-admin/admin.php?page" >Approvers</a></strong></li>
                          <li> <strong> <a  href="/wp-admin/admin.php?page=Limits" >Define Approvers</a></strong></li>
                        <li> <strong>   <a  href="/wp-admin/admin.php?page=Limits" >Limits(Set/Edit)</a></strong></li>
                            
						</ul></div>
					</div>
        </div>
        </div>
    </div>
    <!-- block 3 -->
    
     <!-- block 4 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/general.png" alt="Washed Out"-->
       <h3>Expense Management</h3>
        <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<div style="float:left"><img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_expcat.png" style="float: left; padding-right: 20px;"></div>
						
						
						<div style="margin-top: -68px;margin-right: -25px;/* margin-top: -71px; */float:right;"><ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=gradelimitcat" >Define Grade Limits</a></strong>
								
							</li>

							<li>
								<strong><a href="/wp-admin/admin.php?page=addcat" >Add Category</a></strong>
								
							</li>
                          <li> <strong> <a  href="/wp-admin/admin.php?page=categeory" >Expense Category</a></strong></li>
                            
                         <li> <strong>  <a  href="/wp-admin/admin.php?page=Mileage">Mileage</a></strong></li>
                            
						</ul></div>
					</div>
        </div>
        
        </div>
    <!-- block 4 -->
    </div>
  </div>
</div>

                    <div class="main-inner" >
                    <div id="pl-52"><div class="panel-grid" id="pg-52-0"><div class="panel-grid-cell" id="pgc-52-0-0"><div class="so-panel widget widget_overview panel-first-child panel-last-child" id="panel-52-0-0-0"><div class="box panel-widget-style">
<!-- Service block  -->
    <!-- block 1 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/departure.png" alt="Washed Out"-->
      <h3>Work Flow</h3>
        
       <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_wflow.png" style="float: left; padding-right: 20px;">                                    
						
						
					<ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=Approval-Workflow" >Define Work Flow</a></strong>
								
							</li>
 
                            <li>&nbsp;</li>  <li>&nbsp;</li>
                            <li>&nbsp;</li>
							
						</ul>
					</div>
        </div>
        
        </div>
    </div>
    <!-- block 1 -->
    
     <!-- block 2 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/post-travel.png" alt="Washed Out"-->
       <h3>Travel Desk</h3>
     <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<div style="float:left"><img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_posttravel.png" style="float: left; padding-right: 20px;"></div>						
						
					<div style="margin-top: -68px;margin-right: -25px;/* margin-top: -71px; */float:right;"><ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=Travel"  >Add/Update Request</a></strong>
								
							</li>

							<li>
								<strong><a href="/wp-admin/admin.php?page=Invoice" >View Invoices</a></strong>
								
							</li>
                            
                            <li><strong><a href="/wp-admin/admin.php?page=Tolerance"  >Tolerance Limits</a></strong></li>
                             
                            <li>&nbsp;</li>
						</ul></div>
					</div>
        </div>
        
        </div>
    </div>
    <!-- block 2 -->
    
     <!-- block 3 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/utility.png" alt="Washed Out"-->
      <h3>Expense Requests</h3>
        
        <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_pretravel.png" style="float: left; padding-right: 20px;">						
						
						
					<ul class="dash">
							<li><strong><a href="/wp-admin/admin.php?page=Expense-Requests" >View Requests</a></strong></li>
							<li><strong><a href="/wp-admin/admin.php?page=Expense-Requests" >Requests</a></strong>
							</li>
                            <li>&nbsp;</li>
						</ul>
					</div>
        </div>
        
        </div>
    </div>
    <!-- block 3 -->
    
     <!-- block 4 -->
    <div class="col-md-3">
    <div class="cardsc">
      <!--img src="<?php //echo WPERP_EMPLOYEE_ASSETS ?>/images/general.png" alt="Washed Out"-->
      <h3>Budget Control</h3>
        
        <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_bcontrol.png" style="float: left; padding-right: 20px;">						
						
					<ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=Budget" >Add Budget Control</a></strong>
								
							</li>

							<li>
								<strong><a href="/wp-admin/admin.php?page=Center" >Cost Center</a></strong>
								
							</li>
                        
                              <li>&nbsp;</li>
                            <li>&nbsp;</li>
						</ul>
					</div>
        </div>
        
        </div>
    <!-- block 4 -->
    </div>
  </div>
</div>


                    <div class="main-inner" >
                    <div id="pl-52"><div class="panel-grid" id="pg-52-0"><div class="panel-grid-cell" id="pgc-52-0-0"><div class="so-panel widget widget_overview panel-first-child panel-last-child" id="panel-52-0-0-0"><div class="box panel-widget-style">
<!-- Service block  -->
    <!-- block 1 -->
    <!--div class="col-md-12">
    <div class="cardsc">
      
       <h3>Graphs Reports</h3>
        
       <div class="flex">
          <div class="overview-item-content" style="width: 180px;">
					<div style="float:left;"><img class="overview-invoices" src="/wp-content/plugins/erp/assets/images/dashboard_graph.png" style="float: left; padding-right: 20px;">	</div>					
						
					<div style="margin-top: -68px;margin-right: -33px;/* margin-top: -71px; */float:right;"><ul class="dash">
							<li>
								<strong><a href="/wp-admin/admin.php?page=Graphs" >Graphs</a></strong>
								
							</li>
                            
                            <li><strong><a href="/wp-admin/admin.php?page=Employeewise" >Employee Wise</a></strong></li>
                            
                            <li><strong><a href="/wp-admin/admin.php?page=Tracker" >Travel Spend Tracker</a></strong></li>
  
                            <li>&nbsp;</li>
							
						</ul>	</div>
					</div>
        </div>
        
        </div>
    </div-->
    <!-- block 1 -->
    
     
    
    
    </div>
  </div>
</div>



</main>

<!-- Service block End -->







