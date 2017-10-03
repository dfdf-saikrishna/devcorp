<?php
require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req.php';
global $wpdb;
global $showProCode;
global $empuserid;
$compid = $_SESSION['compid'];
$allemps=$wpdb->get_results("SELECT EMP_Id, EMP_Code, EMP_Name FROM employees WHERE COM_Id='$compid' AND EMP_Status=1 ORDER BY EMP_Name ASC");
if(isset($_REQUEST['selEmployees'])){
    $empuserid = $_REQUEST['selEmployees'];
    $empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
    $repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
    $selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
    $selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
}
?>
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="iconpicker-css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/fontawesome-iconpicker.css" type="text/css" media="all">
<link rel="stylesheet" id="icomoon.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type='text/javascript' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    #my_centered_buttons { text-align: center; width:100%;}
    /* Quote */
   .eicon
   {
   text-align:center;
   color:#0096A8 !important;
   font-size:20px;
   }
   .ired{
   color: red !important;
   }
   
   .img-responsive{
   	padding-top:15px;
   	width:35%;
   }
   .esthead
   {font-size:15px; letter-spacing:-0.28px;color:#000;padding:10px;}
   .wbg{background-color:#fff;}
   .pt15{padding-top:15px;}
   .pb15{padding-bottom:15px;}
  
   
   .18fnt {font-size:18px;}
   .22fnt {font-size:22px;}
   
   .c1a{color;#1A1A1A;}
   /* Quote */	
</style>
<div class="wrap erp travel-desk-request request" id="wp-erp">

    <div class="erp-single-container">
            <div class="postbox">
                
                <div class="inside">
                    <h2><?php _e( 'Individual Employee Request [ With Approval ]', 'traveldesk' ); ?></h2>
                    <code>CREATE Request without approvals</code>
                    <hr />
                    <div style="text-align: center">
                        
                      <select id="select_emp_withappr" class="erp-select2">
                          <option value="0">Select Employee</option>
                      <?php foreach($allemps as $value){?>
                      <option value="<?php echo $value->EMP_Id;?>" <?php echo ($empuserid==$value->EMP_Id) ? 'selected="selected"' : ''; ?>><?php echo $value->EMP_Code." - ".$value->EMP_Name; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                </div>
            </div>
          <?php if(isset($_REQUEST['selEmployees'])){?>    
          <div class="postbox testpost" id="emp_details">
                
              <div class="inside">
              <form id="traveldesk_request" name="traveldesk_request" action="#" method="post" enctype="multipart/form-data">
                <?php
                $row=0;
                require WPERP_TRAVELDESK_VIEWS."/employee-details.php";
                ?>
       
              <!-- Messages -->
              <div style="display:none" id="failure" class="notice notice-error is-dismissible">
              <p id="p-failure"></p>
              </div>

              <div style="display:none" id="notice" class="notice notice-warning is-dismissible">
                  <p id="p-notice"></p>
              </div>

              <div style="display:none" id="success" class="notice notice-success is-dismissible">
                  <p id="p-success"></p>
              </div>

              <div style="display:none" id="info" class="notice notice-info is-dismissible">
                  <p id="p-info"></p>
              </div>
              
              <div class="table-wrapper">
               <!--tabs-->
               <div class="">
                   
                   <div class="panel with-nav-tabs panel-success">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#flight" data-toggle="tab"><i class="fa fa-plane"></i> <span class="hidden-sm hidden-xs"> &nbsp; Flight</span></a></li>
                            <li><a href="#bus" data-toggle="tab"><i class="fa fa-bus"></i> <span class="hidden-sm hidden-xs"> &nbsp; Bus</span></a></li>
                            <li><a href="#hotel" data-toggle="tab"><i class="fa fa-fa fa-hospital-o"></i> <span class="hidden-sm hidden-xs"> &nbsp; Hotel</span></a></li>
                            <li><a href="#car" data-toggle="tab"><i class="fa fa-bus"></i> <span class="hidden-sm hidden-xs"> &nbsp; Car</span></a></li>
                        </ul>
                </div>
                <div class="panel-body search-tabs-bg">
                    <div class="tab-content">
                        <!-- Flight Content -->
                        <div class="tab-pane fade in active" id="flight">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="radio-toolbar">
                                     
                                      <input type="radio" id="radio1" name="radios1" field="1" checked class="hide-roundtrip">
                                       <label for="radio1">Oneway</label>
                                      
                                     <input type="radio" id="radio-1" name="radios1" field="1" class="roundtrip">
                                      <label for="radio-1">Roundtrip</label>
                                      
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="flight-rows">
                            <div class="row" style="margin:10px 0;">
                                
                        
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="From" class="form-control fromflight" id="fromflight1" name="from[]" field="1">
                                        <label for="from" class="fa fa-plane" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input type="text" name="to[]" value="" id="toflight1" class="form-control toflight" placeholder="To" field="1">
                                     <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate flightDatefrom" name="txtDate[]" id="flightDatefrom1" field="1" type="text" placeholder="dd/mm/yyyy">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                        <div class="icon-addon addon-md return1" style="display:none;">
                                            <input class="form-control pretravel flightDatereturn" name="flightReturn[]" id="flightDatereturn1" type="text" value="" placeholder="dd/mm/yyyy">
                                            <label for="email" class="fa fa-refresh" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                       <div class="icon-addon addon-md">
                                          <select class="form-control" id="adult1" name="adult">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                          </select>
                                          <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label>
                                      </div>
                                    </div>


                                </div>
                                <div id="quotefieldsid1">
                                     <input type="hidden" name="sessionid[]" value="<?php echo time();?>" id="sessionidflight1"/>
                                     <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelectedflight1"/>
                                     <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPreferedflight1"/>
                                 </div>
                                <input type="hidden" id="children1" name="children" value="0">
                                <input type="hidden" id="infants1" name="infants" value="0">
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="flightcat" name="selExpcat[]" id="selExpcat1" value="1">
                                 <input type ="hidden" class="flightmode" name="selModeofTransp[]" id="selModeofTransp1" value="1">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="txtaExpdesc1" class="form-control" autocomplete="off" rows="2" cols="18" placeholder="Expense Description"></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-flight1 flightcost" name="txtCost[]" id="txtCost1" autocomplete="off" onkeyup="valCostPre(this.value,1,1);" onchange="valCostPre(this.value,1);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-flight1"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary getQuoteFlight" id="getQuote1" name="getQuote" value="1">Search</button>
                                </div>
                                
                            </div>
                            </div>
                                
                                <!-- Add or Remove Rows -->
                                <div class="col-md-12 pull-right bdr_tb">
                                   <button class="btn btn-success btn-sm" id="add-row-pretravel">Add +</button>
                                   <span id="flightrbtncontainer"></span>
                                </div>
                                
                        </div>
                        <!-- Flight Content End -->
                        
                        <!-- Bus Content -->
                        <div class="tab-pane fade" id="bus">
                            <div class="bus-rows">
                            <div class="row" style="margin:10px 0;">
                                
                        
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="From" class="form-control frombus" id="frombus1" name="from[]" field="1">
                                        <label for="from" class="fa fa-bus" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                    <!--div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <input type="text" name="from[]" id="from1" value="" class="flight form-control st-location-name required" placeholder="City or Origin">
                                    </div-->
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input type="text" name="to[]" value="" id="tobus1" class="form-control tobus" placeholder="To" field="1">
                                     <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate busDatefrom" name="txtDate[]" id="busDatefrom1" field="1" type="text" placeholder="dd/mm/yyyy">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
            
                                    <!--div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control off pretraveldate" name="txtDate[]" id="txtDate1" type="text" placeholder="dd/mm/yyyy">
                                    <input style="display:none;" id="txtDateto1" class="form-control pretravel off return" name="flightReturn[]" type="text" value="" placeholder="dd/mm/yyyy">
                                    </div-->
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                       <div class="icon-addon addon-md">
                                          <select class="form-control" id="adult1" name="adult" disabled>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                          </select>
                                          <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label>
                                      </div>
                                    </div>


                                </div>
                                <div id="quotefieldsid1">
                                     <input type="hidden" name="sessionid[]" value="<?php echo time();?>" id="sessionidbus1"/>
                                     <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelectedbus1"/>
                                     <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPreferedbus1"/>
                                 </div>
                                <input type="hidden" id="children1" name="children" value="0">
                                <input type="hidden" id="infants1" name="infants" value="0">
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="buscat" name="selExpcat[]" id="busselExpcat1" value="1">
                                 <input type ="hidden" class="busmode" name="selModeofTransp[]" id="busselModeofTransp1" value="2">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="bustxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-bus1 buscost" name="txtCost[]" id="bustxtCost1" autocomplete="off" onkeyup="valCostPre(this.value,1,2);" onchange="valCostPre(this.value,1);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-bus1"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary getQuoteBus" id="getQuote" name="getQuote" value="1">Search</button>
                                </div>
                                
                            </div>
                            </div>
                                
                                <!-- Add or Remove Rows -->
                                <div class="col-md-12 pull-right bdr_tb">
                                   <button class="btn btn-success btn-sm" id="add-row-bus">Add +</button>
                                   <span id="busrbtncontainer"></span>
                                </div>
                        </div>
                        <!-- Bus Content End -->
                        
                        <!-- hotel  Content -->
                        <div class="tab-pane fade" id="hotel">
                            <div class="hotel-rows">
                            <div class="row" style="margin:10px 0;">
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="Address" class="form-control fromhotel" id="fromhotel1" name="from[]" field="1">
                                        <label for="from" class="fa fa-h-square" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input class="form-control off pretraveldate hotelDatefrom" name="txtDate[]" id="hotelDatefrom1" field="1" type="text" placeholder="Check In">
                                     <label for="from" class="fa fa-calendar" rel="tooltip" title="from"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate hotelDateto" name="dateTohotel[]" id="hotelDateto1" field="1" type="text" placeholder="Check Out">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                       <div class="icon-addon addon-md">
                                          <div id="stayDays" class="form-control">0 </div>
                                      </div>
                                    </div>
                                </div>
                                <input type="hidden" id="children1" name="children" value="0">
                                <input type="hidden" id="infants1" name="infants" value="0">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" name="selStayDur[]" id="stay1">
                                 <input type ="hidden" class="hotelcat" name="selExpcat[]" id="busselExpcat1" value="2">
                                 <input type ="hidden" class="hotelmode" name="selModeofTransp[]" id="busselModeofTransp1" value="5">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="bustxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-bus1 hotelcost" name="txtCost[]" id="bustxtCost1" autocomplete="off" onkeyup="valCostPre(this.value,2,5);" onchange="valCostPre(this.value,2,5);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-bus1"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary" id="getQuote" name="getQuote" value="1" disabled>Search</button> 
                                </div>
                                
                            </div>
                            </div>
                                
                                <!-- Add or Remove Rows -->
                                <div class="col-md-12 pull-right bdr_tb">
                                   <button class="btn btn-success btn-sm" id="add-row-hotel">Add +</button>
                                   <span id="hotelrbtncontainer"></span>
                                </div>
                        </div>
                        <!-- Hotel Content End-->
                        
                        <!-- Car Content -->
                        <div class="tab-pane fade" id="car">
                            <div class="car-rows">
                            <div class="row" style="margin:10px 0;">
                                
                        
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="Pickup From" class="form-control fromcar" id="fromcar1" name="from[]" field="1">
                                        <label for="from" class="fa fa-car" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input class="form-control off pretraveldate carDatefrom" name="txtDate[]" id="carDatefrom1" field="1" type="text" placeholder="Pickup Date">
                                     <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off time-pick carpicktime" name="pickup[]" id="carpicktime1" field="1" type="text" placeholder="Pickup Time">
                                            <label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate carDateto" name="dateTohotel[]" id="carDateto1" field="1" type="text" placeholder="Drop-off Date">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off time-pick cardroptime" name="dropoff[]" id="cardroptime1" field="1" type="text" placeholder="Drop-off Time">
                                            <label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" id="children1" name="children" value="0">
                                <input type="hidden" id="infants1" name="infants" value="0">
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="carcat" name="selExpcat[]" id="busselExpcat1" value="1">
                                 <input type ="hidden" class="carmode" name="selModeofTransp[]" id="busselModeofTransp1" value="3">
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="cartxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-bus1 carcost" name="txtCost[]" id="cartxtCost1" autocomplete="off" onkeyup="valCostPre(this.value,1,3);" onchange="valCostPre(this.value,1,3);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-bus1"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary btn-block" id="getQuote" name="getQuote" value="1" disabled>Search</button>
                                </div>
                                
                            </div>
                            </div>
                                
                                <!-- Add or Remove Rows -->
                                <div class="col-md-12 col-xs-12 col-sm-12 pull-right bdr_tb">
                                   <button class="btn btn-success btn-sm" id="add-row-car">Add +</button>
                                   <span id="carrbtncontainer"></span>
                                </div>
                        </div>
                        <!-- car Content End -->
                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12 pull-right" style="margin-left: -1%;">
                                <div class="form-group">
                                    <div class="icon-addon addon-md">
                                    <input class="form-control" readonly id="totaltable" autocomplete="off" type="text" placeholder="Grand Total"></label><span class="red" id="show-exceed3">
                                   <label for="totaltable" class="fa fa-inr" rel="tooltip" title="grand total"></label>
                                   </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
         <!-- Estimated Cost -->

         <input type="hidden" value="1" name="ectype" id="ectype"/>
	 <input type="hidden" value="0" name="expenseLimit" id="expenseLimit"/>
	 <input type="hidden" value="1" name="hiddenDraft" id="hiddenDraft"  />
	 <input type="hidden" value="<?php echo $empuserid; ?>" name="hiddenEmp" id="hiddenEmp" />
	 <input type="hidden" value="2" name="addnewrequest" id="addnewrequest" />
	 <input type="hidden" name="action" id="traveldesk_request_create" value="traveldesk_request_create">
	 <input type="hidden" name="ImageUrl" id="ImageUrl" value="<?php echo WPERP_EMPLOYEE_ASSETS;?>">
         <span id="totaltable"></span>
         </div>
         <!--buttons-->
         <div class="container-fluid create-btn-tab">
            <div class="col-md-12" style="text-align:center;">
               <button class="btn btn-success btn-md" id="submit-traveldesk-request" type="submit">Submit</button>
               <button class="btn btn-warning btn-md" type="submit" id="cleartraveldesk">Reset&nbsp;</button>
               <button class="btn btn-info btn-md" onclick="javascript:window.history.back();">&nbsp;Back&nbsp;</button>
            </div>
         </div>
         <!--buttons-->
         <!-- selected quote -->
         <div id="selected_quote" style="background: #F9F9F9!important;" class="badge-container"></div>
         </form>
         <!-- selected quote -->
                <div style="margin-top:60px" id="grade-limit" class="postbox leads-actions closed">
                    <div class="handlediv" title="<?php _e( 'Click to toggle', 'erp' ); ?>"><br></div>
                    <h3 class="hndle"><span><?php _e( 'Grade Limits', 'erp' ); ?></span></h3>
                    <div class="inside">
                       <!-- Grade Limits -->
                       <?php _e(gradeLimits($empuserid));?>
                    </div>
                </div><!-- .postbox -->
              
        </div><?php } ?>
        </div>
    </div>
</div>
<!--script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script-->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/js/quote/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />