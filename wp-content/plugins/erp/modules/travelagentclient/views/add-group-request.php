<?php
   global $wpdb;
   require_once WPERP_TRAVELAGENT_CLIENT_VIEWS . '/group-booking-js.php';
   $compid = $_SESSION['compid'];
   $selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
   $selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
   ?>
<style type="text/css">
   #my_centered_buttons { text-align: center; width:100%; margin-top:60px; }
   .quicktags, .search{
   background: none !important;
   }
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
   .pgbg{
   background-color:#F8F8F8;
   }
   .img-responsive{
   	padding-top:25px;
   }
   .esthead
   {font-size:15px; letter-spacing:-0.28px;color:#000;padding:10px;}
   .wbg{background-color:#fff;}
   .pt15{padding-top:15px;}
   .pb15{padding-bottom:15px;}
   .bghlt{background:rgba(155,154,155,0.35);border 0 solid rgba(150,150,150,0.39);}
   .planefa{font-size:28px !important; margin-right:5px; color:#0096A8;}
   .mapfa {font-size:24px !important; margin-right:5px;}
   .18fnt {font-size:18px;}
   .22fnt {font-size:22px;}
   .gclr { color:#0096A8;}
   .splane{font-size:11px;color;#4A4A4A;}
   .c1a{color;#1A1A1A;}
   @media screen and (min-width: 780px) {
   //.pgbg{margin-top:12px;}
   .myrow {
   height:20px;
   }
   .imgsty{ height:96px !important;}
   }
   @media screen and (min-width: 100px)
   {
   .imgsty{ height:96px !important;}
   }
   /* Quote */	
</style>
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="iconpicker-css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/fontawesome-iconpicker.css" type="text/css" media="all">
<link rel="stylesheet" id="icomoon.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<link rel="stylesheet" id="styles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/styles(1).css" type="text/css" media="all">
<link rel="stylesheet" id="default-style-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/style(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom2css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom2.css" type="text/css" media="all">
<link rel="stylesheet" id="custom-responsive-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom-responsive.css" type="text/css" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" id="icomoon-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<div class="postbox">
   <div class="inside">
      <div class="wrap pre-travel-request erp request" id="wp-erp">
         <h2><?php _e( 'Group Request', 'employee' ); ?></h2>
         <!--<code class="description">ADD Request</code>-->
            <!-- Messages -->
            <div style="display:none" id="failure" align="center" class="notice notice-error is-dismissible">
               <p id="p-failure"></p>
            </div>
            <div style="display:none" id="notice" align="center" class="notice notice-warning is-dismissible">
               <p id="p-notice"></p>
            </div>
            <div style="display:none" id="success" align="center" class="notice notice-success is-dismissible">
               <p id="p-success"></p>
            </div>
            <div style="display:none" id="info" align="center" class="notice notice-info is-dismissible">
               <p id="p-info"></p>
            </div>
            
            <!-- Employee Details -->
            <form role="form"s id="GroupRequest" name="GroupRequest" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" value="1" name="empcount" id="empcount"  />
            <input type="hidden" value="1" name="fields" id="fields" />
            <input type="hidden" value="group" name="req_type" id="req_type" />
            <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 col-lg-2" for="email">&nbsp;&nbsp;Travel Plan:</label>
                <div class="col-sm-4 col-lg-3">
                  <input type="radio" name="radTrvPlan" class="travelplanGrpTrv" id="radTrvPlan" value="domestic" checked="checked">
                  Domestic
                  <input type="radio" name="radTrvPlan" class="travelplanGrpTrv" id="radTrvPlan" value="international" >
                  International </div>
              </div>
              <div class="col-lg-12" id="employeeDiv1">
              <div class="form-group">
                <label class="col-sm-2 col-lg-2" for="email">&nbsp;&nbsp;Employee Code:</label>
                <div class="col-sm-4 col-lg-3">
                  <input type="text" class="form-control grpempcode" onkeyup="clearForm(1)" name="txtGrpEmpCode1" id="txtGrpEmpCode1" maxlength="30" required>
                  <small class="text-danger">Please dont add employee prefix</small> </div>
                <div class="col-sm-4 col-lg-3">
                  <button type="button" name="buttonGrpFindEmployee1" id="buttonGrpFindEmployee1" onclick="findDetails(1)" value="1" class="btn btn-primary">Find Details</button>
                </div>
              </div>
              <div id="employeedetails1" style="display:none;">
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
                          <td id="employeeName1" width=""></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td width="5%">:</td>
                          <td id="employeeEmail1"></td>
                        </tr>
                        <tr>
                          <td>Mobile</td>
                          <td width="5%">:</td>
                          <td id="employeeMobile1"></td>
                        </tr>
                        <tr>
                          <td>DOB</td>
                          <td width="5%">:</td>
                          <td id="employeeDob1"></td>
                        </tr>
                        <tr>
                          <td>Gender</td>
                          <td width="5%">:</td>
                          <td id="employeeGender1"></td>
                        </tr>
                        <tr>
                          <td>Meal Preference</td>
                          <td width="5%">:</td>
                          <td id="employeeMealPrf1"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="employeeDetailsNew1" style="display:none;" >
                <div class="form-group">
                  <label class="control-label col-sm-2" >Employee Name:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control newEmp1" id="txtEmpName1" name="txtEmpName1" maxlength="50" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Email:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control newEmp1" id="txtEmail1" name="txtEmail1" parsley-type="email" maxlength="50" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Mobile:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control newEmp1" id="txtMobile1" name="txtMobile1" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >DOB:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control erp-ncorp-date-field newEmp1" id="txtDob1" name="txtDob1" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Gender:</label>
                  <div class="col-lg-6">
                    <input type="radio"   id="radGender1" name="radGender1"  value="male" checked="checked">
                    Male
                    <input type="radio"   id="radGender1" name="radGender1"  value="female" >
                    Female </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Meal Preference:</label>
                  <div class="col-lg-6">
                    <input type="radio"   id="radMealPrf1" name="radMealPrf1"  value="vegetarian" checked="checked">
                    vegetarian
                    <input type="radio"   id="radMealPrf1" name="radMealPrf1"  value="non-vegetarian" >
                    non-vegetarian </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>
              <div id="empPassportDetails1" style="display:none;">
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
                          <td id="empPassportFrontView1" width=""></td>
                        </tr>
						<tr>
                          <td width="30%">Passport Back View</td>
                          <td width="5%">:</td>
                          <td id="empPassportBackView1" width=""></td>
                        </tr>
                        <tr>
                          <td width="30%">Passport Number</td>
                          <td width="5%">:</td>
                          <td id="empPassportNo1" width=""></td>
                        </tr>
                        <tr>
                          <td>Issued Country</td>
                          <td width="5%">:</td>
                          <td id="empIssuedCountry1"></td>
                        </tr>
                        <tr>
                          <td>Issued Place</td>
                          <td width="5%">:</td>
                          <td id="empIssuedPlace1"></td>
                        </tr>
                        <tr>
                          <td>Issued Date</td>
                          <td width="5%">:</td>
                          <td id="empIssuedDate1"></td>
                        </tr>
                        <tr>
                          <td>Expiry Date</td>
                          <td width="5%">:</td>
                          <td id="empExpiryDate1"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="empPassprtDetailsNew1" style="display:none;">
                <div class="page-header col-lg-6">
                  <h3>Employee's Passport Details</h3>
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
    		                <input type='button' class="passport_front_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
    		                <span class="description"><?php _e( 'Upload Front View of Your Passport', 'textdomain' ); ?></span>
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
							<input type='button' class="passport_back_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
							<span class="description"><?php _e( 'Upload Back View of Your Passport', 'textdomain' ); ?></span>
							</div>
    					</div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Passport No.</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtPassportno1" id="txtPassportno1" class="form-control pptclass1" required maxlength="30"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" title="Issued Country">Issued Country</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtIssuedCountry1" id="txtIssuedCountry1" class="form-control pptclass1" required maxlength="30"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Issued Place</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtIssuedplc1" id="txtIssuedplc1" class="form-control pptclass1" required maxlength="30"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Issued Date</label>
                  <div class="col-lg-4">
                    <input type="text" readonly="readonly" name="txtIssuedDAte1" id="txtIssuedDAte1" class="form-control erp-ncorp-date-field pptclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Expiry Date</label>
                  <div class="col-lg-4">
                    <input name="txtExpiryDate1" id="txtExpiryDate1" readonly="readonly" required class="form-control pretraveldate expirydate pptclass newEmp1"  />
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>
              <div id="empVisaDetailsNew1" style="display:none;">
                <div class="page-header col-lg-6">
                  <h3>Employee's Visa Details</h3>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Visa Document</label>
                  <div class="col-lg-4">
                  <div class="visa_img"></div><br />
                  <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="hidden" name="fileComplogo" id="fileComplogo" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="visa_document button-primary button" value="<?php _e( 'Upload Document', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Document of Your visa', 'textdomain' ); ?></span>
                </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Visa Number</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtVisa1" id="txtVisa1" class="form-control visaclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Country</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtCountry1" id="txtCountry1" class="form-control visaclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Issued At</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtIssuedAt1" id="txtIssuedAt1" class="form-control visaclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Type of Visa</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtTypeofvisa1" id="txtTypeofvisa1" class="form-control visaclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">No. of Entries</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtNoofEntries1" id="txtNoofEntries1" class="form-control visaclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Date of Issue</label>
                  <div class="col-lg-4">
                    <input type="text" readonly="true" name="txtDateofIssue1" id="txtDateofIssue1" class="form-control erp-ncorp-date-field visaclass1" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Expiry Date</label>
                  <div class="col-lg-4">
                    <input type="text" name="txtDateofExpiry1" id="txtDateofExpiry1" class=" form-control pretraveldate visaclass1" readonly="true" required onkeydown="return false;"/>
                  </div>
                </div>
              </div>
                <div class="clearfix"></div>
                <p>&nbsp;</p>
                <div class="col-lg-6 text-right" id="addmore1" style="display:none;">
                  <button class="btn btn-palevioletred" type="button" name="addmorebutton1" id="addmorebutton1" value="1" onclick="addmore(1)">+ Add More</button>
                </div>
                </div>
                </div>
              <div class="clearfix"></div>
              <p>&nbsp;</p>
            
            <!-- Employee Details -->
            <div id="requestTable" style="display:none">
            <div class="table-wrapper">
               <!--tabs-->
               <div class="container">
                  <div class="row">
                     <div class="search-tabs search-tabs-bg search-tabs-abs mt50 col-sm-8 col-md-8  no-boder-search ">
                        <div class="tabbable">
                           <ul class="nav nav-tabs" id="myTab">
                              <li class="active">
                                 <a href="/#tab-activities0" data-toggle="tab"><i class="fa fa fa-plane"></i>
                                 <span>Flights</span></a>
                              </li>
                              <li>
                                 <a href="/#tab-tour2" data-toggle="tab"><i class="fa fa-bus"></i>
                                 <span>Buses</span></a>
                              </li>
                              <li>
                                 <a href="/#tab-hotel4" data-toggle="tab"><i class="fa fa-building-o"></i>
                                 <span>Hotels</span></a>
                              </li>
                              <li>
                                 <a href="/#tab-cars1" data-toggle="tab"><i class="fa fa-flag-o"></i>
                                 <span>Cars</span></a>
                              </li>
                              <!--li>
                                 <a href="/#tab-rental3" data-toggle="tab"><i class="fa fa-money"></i>
                                 <span>Others</span></a>
                              </li-->
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane fade active in" id="tab-activities0">
         
         <div class="row">
         <div class="col">
         <div class="checkbox col-xs-12 col-sm-2 hide-roundtrip">
         <label class="radio-inline active"><input type="radio" name="journeytypef" value="oneway" checked="checked">One Way</label>
         </div>
         <div class="checkbox col-xs-12 col-sm-2 roundtrip">
         <label class="radio-inline"><input type="radio" name="journeytypef" value="roundtrip">Round Trip</label>
         </div>
         <div class="checkbox col-xs-12 col-sm-2 hide-roundtrip show-controls">
         <label class="radio-inline"><input type="radio" name="journeytypef" value="multicity">Multicity</label>
         </div>
         </div></div>
         <div class="row"><span>
         <div class="col">
         <div class="add-row">
         <div class=" col-md-4 col-lg-4 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <label for="field-st-address">Origin</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="from[]" id="from1" value="" class="flight form-control st-location-name required" placeholder="City or Origin">
         <div class="option-wrapper"></div>
         </div>
         </div>
         </div>
         <div class="col">
         <div class=" col-md-4 col-lg-4 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <label for="field-st-address">Destination</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="to[]" value="" id="to1" class="flight form-control st-location-name required" placeholder="City or Destination">	
         <div class="option-wrapper"></div>
         </div>
         </div>
         </div>
		 <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group-md form-group-icon-left">
         <label for="field-st-checkin">Departure</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input class="form-control off pretraveldate" name="txtDate[]" id="txtDate1" type="text" placeholder="dd/mm/yyyy">
         </div>
         </div>
         <!-- multicity -->
         <div class="controls" style="display:none">
         <div class="voca">
         <div class=" col-md-4 col-lg-4 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="location_name" value="" class="form-control st-location-name required" placeholder="City or Origin">
         <div class="option-wrapper"></div>
         </div>
         </div>
         </div>
         <div class=" col-md-4 col-lg-4 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="location_name" value="" class="form-control st-location-name required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div>
         </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group-md form-group-icon-left">
         <!--label for="field-st-checkin">Departure</label-->
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input class="form-control off pretraveldate" name="txtDate[]" id="txtDate1" type="text" placeholder="dd/mm/yyyy">
         </div>
         </div>
         <div class=" col-md-1 col-lg-1 col-sm-12 col-xs-12 ">
         <button type="button" class="btn btn-primary fa fa-plus mr10 btn-add" >
         </div>
         </button>
         </div>
         </div>  
         </div>
         <!-- multicity -->
         </div>
         </div> 
         
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 return-date" style="display: none;">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group-md form-group-icon-left">
         <label for="txtDateto1">Return</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDateto1" class="form-control pretravel off" name="flightReturn" type="text" value="" placeholder="dd/mm/yyyy">
         </div>                
         </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Adult</label>
         <div class="btn-group btn-group-select-num  hidden" data-toggle="buttons">
         <label class="btn btn-primary">
         <input type="radio" value="1" name="adult">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2" name="adult">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3" name="adult">3</label>
         <label class="btn btn-primary  active">
         <input type="radio" value="4" name="adult">3+</label>
         </div>
         <select id="adult1" class="form-control" name="adult">
         <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Children</label>
         <div class="btn-group btn-group-select-num  hidden" data-toggle="buttons">
         <label class="btn btn-primary">
         <input type="radio" value="0" name="children">0</label>
         <label class="btn btn-primary">
         <input type="radio" value="1" name="children">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2" name="children">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3" name="children">3</label>
         <label class="btn btn-primary  active">
         <input type="radio" value="4" name="children">3+</label>
         </div>
         <select id="children1" class="form-control" name="children">
         <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Infant</label>
         <div class="btn-group btn-group-select-num  hidden" data-toggle="buttons">
         <label class="btn btn-primary">
         <input type="radio" value="0" name="infants">0</label>
         <label class="btn btn-primary">
         <input type="radio" value="1" name="infants">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2" name="infants">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3" name="infants">3</label>
         <label class="btn btn-primary  active">
         <input type="radio" value="4" name="infants">3+</label>
         </div>
         <select id="infants1" class="form-control" name="infants">
         <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Description</label>
         <textarea name="txtaExpdesc[]" id="txtaExpdesc1" class="" autocomplete="off"></textarea>
         </div>
         </div>
         <input type="hidden" name="selStayDur[]" value="">
         <input type ="hidden" name="selExpcat[]" id="selExpcat1" value="1">
         <input type ="hidden" name="selModeofTransp[]" id="selModeofTransp1" value="1"></span>
         <button class="btn btn-primary btn-lg getQuoteFlight" id="getQuote1" name="getQuote" value="1" type="submit">Search for Flights</button>
         </form>
         </div>
         <div class="tab-pane fade " id="tab-tour2">
         
         <div class="row">
         <div class="col">
         <div class="checkbox col-xs-12 col-sm-2 hide-roundtrip">
         <label class="radio-inline active"><input type="radio" name="journeytypeb" value="oneway" checked="">One Way</label>
         </div>
         <div class="checkbox col-xs-12 col-sm-2 roundtrip">
         <label class="radio-inline"><input type="radio" name="journeytypeb" value="roundtrip">Round Trip</label>
         </div>
         </div></div>
         <div class="row"><span>
         <div class="col">
         <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <label for="field-st-address">Origin</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="from[]" id="frombus3" value="" class="bus form-control st-location-name required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div></div>
         <div class="col">
         <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <label for="field-st-address">Destination</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="to[]" id="tobus3" value="" class="bus form-control st-location-name required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div></div></div>               </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group-md form-group-icon-left">
         <label for="field-st-checkin">Departure</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDate3" class="form-control pretraveldate off" name="txtDate[]" type="text" placeholder="dd/mm/yyyy" value="">
         </div>
         </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 return-date" style="display:none;">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group-md form-group-icon-left">
         <label for="field-st-checkout">Return</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDatebusto3" class="form-control off" name="end" type="text" value="" placeholder="dd/mm/yyyy">
         </div>                </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Description</label>
         <textarea name="txtaExpdesc[]" id="txtaExpdesc3" class="" autocomplete="off"></textarea>
         </div>
         </div>
         <input type="hidden" name="selStayDur[]" value="">
         <input type ="hidden" name="selExpcat[]" id="selExpcat3" value="1">
         <input type ="hidden" name="selModeofTransp[]" id="selModeofTransp3" value="2"></span>
         <button class="btn btn-primary btn-lg getQuoteBus" id="getQuote3" name="getQuote" value="3" type="submit">Search for Bus</button>
         
         </div>
         <div class="tab-pane fade" id="tab-hotel4">
         
         <div class="row"><span>
         <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-hotel-location">Address</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input type="text" id="fromhotel2" name="from[]" class="hotel form-control st-location-name  required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group- form-group-icon-left">
         <label for="field-hotel-checkin">Check In</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDatehotel2" name="txtDate[]" placeholder="dd/mm/yyyy" class="form-control pretraveldate checkin_hotel off" value="" name="start" type="text">
         </div>
         </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group- form-group-icon-left">
         <label for="field-hotel-checkout">Check Out</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="dateTohotel2" name="dateTohotel[]" placeholder="dd/mm/yyyy" class="form-control pretraveldate off checkout_hotel" value="" name="end" type="text">
         </div>                    </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Description</label>
         <textarea name="txtaExpdesc[]" id="txtaExpdesc2" class="" autocomplete="off"></textarea>
         </div>
         </div>
 	 <div class="row">

 	 <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Room(s)</label>
         <div class="btn-group btn-group-select-num " data-toggle="buttons">
         <label class="btn btn-primary active">
         <input type="radio" value="1" name="options">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2" name="options">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3" name="options">3</label>
         <label class="btn btn-primary ">
         <input type="radio" value="4" name="options">3+</label>
         </div>
         <select id="field-hotel-room-num" class="form-control hidden " name="room_num_search">
         <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-select-plus">
         <label for="field-hotel-adult">Adult</label>
         <div class="btn-group btn-group-select-num " data-toggle="buttons">
         <label class="btn btn-primary active">
         <input type="radio" value="1">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3">3</label>
         <label class="btn btn-primary ">
         <input type="radio" value="4">3+</label>
         </div>
         <select id="field-hotel-adult" class="form-control hidden" name="adult_number">
         <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
             <label for="field-hotel-adult">No of Days</label>
             <div class="btn-group btn-group-select-num " data-toggle="buttons">
                 <label class="btn btn-primary active">
                 <input type="radio"><span id="stayDays">0</span></label>
             </div>
         </div>
 	 </div>
         <input type="hidden" name="selStayDur[]" id="stay2">
         <input type ="hidden" name="selExpcat[]" id="selExpcat2" value="2">
         <input type ="hidden" name="selModeofTransp[]" id="selModeofTransp2" value="5"></span>
         <button class="btn btn-primary btn-lg getQuoteHotel" name="getQuote" value="2" id="getQuote2" type="submit">Search for Hotels</button>
         
         </div>
         <div class="tab-pane fade " id="tab-cars1">
         
         <div class="row"><span>
         <div class="">
         <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-car-dropoff">Pick Up From</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input data-children="location_id_drop_off" data-clear="clear" type="text" name="from[]" value="" class="car form-control required" id="carcity4" placeholder="City or Destination ">
         <div class="option-wrapper"></div>
         </div>
         </div>
         <div class="same_location form-group form-group- form-group-icon-left">
         <!-- <label  for="required_dropoff"> -->
         <input style="display:none;" checked="" type="checkbox" name="required_dropoff" value="required_dropoff" id="" class="required-field">
         <!-- </label> -->
         <!--a href="javascript:void(0)" id="required_dropoff" class="required-field change_same_location" data-change="Same Location">Different Location</a-->
         </div>
         <div class="form-drop-off field-hidden">
         <div class=" form-group form-group- form-group-icon-left">
         <label for="field-car-pickup"> Drop Off To</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input data-parent="location_id_pick_up" data-clear="clear" autocomplete="off" type="text" name="drop-off" value="" class="form-control st-location-name" placeholder=" City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div>
         </div>
         </div>
         <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12 ">
         <div class="row">
         <div class="col-md-6">
         <div class="form-group form-group- form-group-icon-left" data-date-format="dd/mm/yyyy">
         <label for="field-car-pickup-date">Pick-up Date </label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input placeholder="dd/mm/yyyy" value="" class="form-control pretraveldate off" id="txtcarDate4" name="txtDate[]" type="text">
         </div>
         </div>
         <div class="col-md-6">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-car-pickup-time">Pick-up Time</label>
         <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
         <input id="field-car-pickup-time" name="pickup" class="time-pick form-control off" value="" type="text">
         </div>
         </div>
         </div>
         </div>
         <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12 ">
         <div class="row">
         <div class="col-md-6">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-st-dropoff-date">Drop-off Date </label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input placeholder="dd/mm/yyyy" value="" class="form-control pretraveldate off" id="txtcarDateto4" name="dateTohotel[]" type="text">
         </div>
         </div>
         <div class="col-md-6">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-st-dropoff-time">Drop-off Time</label>
         <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
         <input id="field-st-dropoff-time" name="dropoff" class="time-pick form-control off" value="" type="text">
         </div>
         </div>
         </div>                    </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Description</label>
         <textarea name="txtaExpdesc[]" id="txtaExpdesc4" class="" autocomplete="off"></textarea>
         </div>
         </div>
         </div>
         <input type ="hidden" name="selExpcat[]" id="selExpcat4" value="1">
         <input type ="hidden" name="selModeofTransp[]" id="selModeofTransp4" value="3">
         </span>
         <button class="btn btn-primary btn-lg" type="submit" disabled>Search for Cars</button>
        
         </div>
         
         <div class="tab-pane fade " id="tab-rental3">
         
         <div class="row">
         <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-rental-locationid">Where are you going?</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input type="text" name="location_name" value="" id="from3" name="from[]" class="hotel form-control st-location-name required" placeholder="City or Destination">
         <select id="field-rental-locationid" name="location_id" class="st-location-id st-hidden" placeholder="City or Destination" tabindex="-1">
         <div class="option-wrapper"></div>
         </div>
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group- form-group-icon-left">
         <label for="field-rental-checkin">Check in</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="field-rental-checkin" placeholder="dd/mm/yyyy" class="form-control checkin_rental off" value="" name="start" type="text">
         </div>
         </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group- form-group-icon-left">
         <label for="field-rental-checkout">Check out</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="field-rental-checkout" placeholder="dd/mm/yyyy" class="form-control off checkout_rental" value="" name="end" type="text">
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-select-plus">
         <label for="field-rental-room-num">Room(s)</label>
         <div class="btn-group btn-group-select-num " data-toggle="buttons">
         <label class="btn btn-primary active">
         <input type="radio" value="1" name="options">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2" name="options">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3" name="options">3</label>
         <label class="btn btn-primary ">
         <input type="radio" value="4" name="options">3+</label>
         </div>
         <select id="field-rental-room-num" class="form-control hidden " name="room_num_search">
         <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-select-plus">
         <label for="field-rental-adult">Adults</label>
         <div class="btn-group btn-group-select-num " data-toggle="buttons">
         <label class="btn btn-primary active">
         <input type="radio" value="1">1</label>
         <label class="btn btn-primary ">
         <input type="radio" value="2">2</label>
         <label class="btn btn-primary ">
         <input type="radio" value="3">3</label>
         <label class="btn btn-primary ">
         <input type="radio" value="4">3+</label>
         </div>
         <select id="field-rental-adult" class="form-control hidden" name="adult_number">
         <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>    </select>
         </div>                    </div>
         </div>
         <button class="btn btn-primary btn-lg" type="submit">Search for rental</button>
    
         </div>        
         </div>
         </div>
         </div>
		 </div>
         <!--tabs -->
         <!-- Estimated Cost -->
         </br>
         </br>
         
         <div class="col-sm-3 col-md-3">
         <div class="pgbg">
         <h5 class="esthead" ><strong>Estimated Cost</strong></h5>
         <table class="table borderless" border="0" >
         <tr>
         <td width=20% class="text-center"><label ><i class="fa fa-plane eicon exceed1" aria-hidden="true"></i></label></td>
         <td  class="text-center"><label><input class="" name="txtCost[]" id="txtCost1" autocomplete="off" onkeyup="calcTotalCost()" onchange="calcTotalCost()" type="text" placeholder="0"></label><span class="red" id="show-exceed1"></span></td></tr>
         <tr><td  class="text-center"><label ><i class="fa fa-bus eicon exceed3" aria-hidden="true"></i></label></td>
         <td  class="text-center"><label><input class="" name="txtCost[]" id="txtCost3" autocomplete="off" onkeyup="calcTotalCost()" onchange="calcTotalCost()" type="text" placeholder="0"></label><span class="red" id="show-exceed3"></span></td></tr>
         <tr><td  class="text-center"><label ><i class="fa fa-hospital-o eicon exceed2" aria-hidden="true"></i></label></td>
         <td  class="text-center"><label><input class="" name="txtCost[]" id="txtCost2" autocomplete="off" onkeyup="calcTotalCost()" onchange="calcTotalCost()" type="text" placeholder="0"></label><span class="red" id="show-exceed2"></span></td></tr>
         <tr><td  class="text-center"><label ><i class="fa fa-car eicon exceed4" aria-hidden="true"></i></label></td>
         <td  class="text-center"><label><input type="textbox" name="txtCost[]" id="txtCost4" autocomplete="off" onkeyup="valCostPre(this.value,4,3);" onchange="valCostPre(this.value,4,3);" placeholder="0"></label></td></tr>
         <tr><td class="text-center"><label ><i class="eicon" >=</i></label></td>
         <td  class="text-center"><label><input type="textbox" placeholder="0" name="txtTotalCost[]" id="txtTotalCost" readonly="true"></label></td></tr>
         </table>
       
         </div>
     	 </div>
         </div>
         <!-- Estimated Cost -->
         
         
         <input type="hidden" value="1" name="ectype" id="ectype"/>
         <input type="hidden" value="0" name="expenseLimit" id="expenseLimit"/>
         <input type="hidden" name="rowCount" id="rowCount" value="1">
         <input type="hidden" name="ImageUrl" id="ImageUrl" value="<?php echo WPERP_EMPLOYEE_ASSETS;?>">
         <input type="hidden" name="action" id="group_request_create" value="group_request_create">
         <div id="quotefieldsid">
         <input type="hidden" name="sessionid[]" value="<?php echo time();?>" id="sessionid1"/>
         <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected1"/>
         <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered1"/>
         <input type="hidden" name="sessionid[]" value="<?php echo time();?>" id="sessionid2"/>
         <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected2"/>
         <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered2"/>
         <input type="hidden" name="sessionid[]" value="<?php echo time();?>" id="sessionid3"/>
         <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected3"/>
         <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered3"/>
         <input type="hidden" name="addnewGroupRequest" id="addnewGroupRequest" value="3">
         </div>
         </span>
         <span id="totaltable"></span>
         </div>
         <!--buttons-->
         <div class="container">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
               <button class="btn btn-primary btn-lg" type="submit" name="addGroupRequest" id="addGroupRequest">Submit</button>
               <button class="btn btn-primary btn-lg" type="submit" id="clear">Reset&nbsp;</button>
               <button class="btn btn-primary btn-lg" type="submit">&nbsp;Back&nbsp;</button>
            </div>
            <div class="col-sm-3"></div>
         </div>
         </div>
         <!--buttons-->
         <!-- selected quote -->
         <div style="margin-top:70px;">
            <div class="container pgbg flight1" style="display:none;">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> BLR</span><span class="quote-to1"> - MAA </span></span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1">12 , Apr 2017 </span>  </div>
               </div>
               <br><br>
               <div class="row flight-content1" style="background-color:#fff;" >
                  <!--div class="col-sm-2 col-md-2 bghlt col-xs-6 quote-image3" ><img alt="spicejet" src="" class="img-responsive imgsty"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 bghlt col-xs-6" ><span class="splane quote-name3">Spice jet</span> <br> <span class="splane quote-dep3"> Dep.12.45 AM </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">2000</span></span></div-->
               </div>
            </div>
            <div class="container pgbg hotel" style="display:none;" >
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-hospital-o planefa " aria-hidden="true" ></i><span class="gclr 22fnt">HOTELS</span> </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"> BLR - MAA </span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15"><i class="fa fa-calendar mapfa" aria-hidden="true"></i><span class="18fnt">12 , Apr 2017 </span>  </div>
               </div>
               <br><br>
               <div class="row" style="background-color:#fff;" >
                  <div class="col-sm-2 col-md-2 bghlt col-xs-6" ><img alt="spicejet" src="" class="img-responsive imgsty"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 bghlt col-xs-6" ><span class="splane">Spice jet</span> <br> <span class="splane"> Dep.12.45 AM </span><br><span class="22fnt c1a">&#8377;2000</span></div>
                  <div class="col-sm-2 col-md-2 col-xs-6"><img alt="indigo" src="" class="img-responsive imgsty"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 col-xs-6" ><span class="splane">Indigo</span> <br> <span class="splane"> Dep.2.00 AM </span><br><span class="22fnt c1a">&#8377;3000</span></div>
                  <div class="col-sm-2 col-md-2 col-xs-6"><img alt="jet" src="" class="img-responsive imgsty"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 col-xs-6" ><span class="splane">Jet Airways</span> <br> <span class="splane"> Dep.3.00 AM </span><br><span class="22fnt c1a">&#8377;4000</span></div>
               </div>
            </div>
            <div class="container pgbg bus3" style="display:none;">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from3"> BLR</span><span class="quote-to3"> - MAA </span></span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date3">12 , Apr 2017 </span>  </div>
               </div>
               <br><br>
               <div class="row bus-content3" style="background-color:#fff;" >
                  <!--div class="col-sm-2 col-md-2 bghlt col-xs-6 quote-image3" ><img alt="spicejet" src="" class="img-responsive imgsty"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 bghlt col-xs-6" ><span class="splane quote-name3">Spice jet</span> <br> <span class="splane quote-dep3"> Dep.12.45 AM </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">2000</span></span></div-->
               </div>
	    </div>
         </div>
         </form>
         <!-- .postbox -->
      </div>
   </div>
</div>
</div>
</div>
<!--script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script-->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/js/quote/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<script>
   var j = jQuery.noConflict();
   //j( function() {
   j("body").on('keyup change click', function () {
      //var row = j('#rowCount').val();
      //alert(row);
     j( "#from1" ).autocomplete({
       source: function( request, response ) {
          var className =  j( "#from1" ).attr('class').split(' ')[0];
          
          if(className == 'flight'){
             
             wp.ajax.send('auto-search-flight', {
                 data: {
                   q: request.term,
                 },
                 success: function (data) {
                     //console.log(data);
                     response( data );
                 },
                 error: function (error) {
                     alert(error);
                     console.log(error);
                 },
             });
          }
          
       },
       select: function (event, ui) {
		var inputs = j(this).closest('span').find(':input');
	  	inputs.eq( inputs.index(this)+ 1 ).focus();
	},
     });
     
     
     
     j( "#fromhotel2" ).autocomplete({
       source: function( request, response ) {
       	 var hotelClass = j( "#fromhotel2" ).attr('class').split(' ')[0];
          if(hotelClass == 'hotel'){
             wp.ajax.send('auto-search-hotel', {
                 data: {
                   q: request.term,
                 },
                 success: function (data) {
                     console.log(data);
                     response( data );
                 },
                 error: function (error) {
                     alert(error);
                     console.log(error);
                 },
             });
          }
       },
       select: function (event, ui) {
		var inputs = j(this).closest('span').find(':input');
	  	inputs.eq( inputs.index(this)+ 1 ).focus();
	},
     });
     
     j( "#frombus3" ).autocomplete({
       source: function( request, response ) {
       	 var className = j( "#frombus3" ).attr('class').split(' ')[0];
          if(className == 'bus'){
             wp.ajax.send('auto-search-bus', {
                 data: {
                   q: request.term,
                 },
                 success: function (data) {
                     //console.log(data);
                     response( data );
                 },
                 error: function (error) {
                     alert(error);
                     console.log(error);
                 },
             });
          }
       },
       select: function (event, ui) {
		var inputs = j(this).closest('span').find(':input');
	  	inputs.eq( inputs.index(this)+ 1 ).focus();
	},
     });
     
    j( "#carcity4" ).autocomplete({
     source: function( request, response ) {
       	 var className = j( "#carcity4" ).attr('class').split(' ')[0];
          if(className == 'car'){
             wp.ajax.send('auto-search-bus', {
                 data: {
                   q: request.term,
                 },
                 success: function (data) {
                     //console.log(data);
                     response( data );
                 },
                 error: function (error) {
                     alert(error);
                     console.log(error);
                 },
             });
          }
       },
       select: function (event, ui) {
		var inputs = j(this).closest('span').find(':input');
	  	inputs.eq( inputs.index(this)+ 1 ).focus();
	},
    }); 
     
     
     j( "#to1" ).autocomplete({
       source: function( request, response ) {
          var className =  j( "#to1" ).attr('class').split(' ')[0];
           if(className == 'flight'){
             wp.ajax.send('auto-search-flight', {
                 data: {
                   q: request.term,
                 },
                 success: function (data) {
                     //console.log(data);
                     response( data );
                 },
                 error: function (error) {
                     alert(error);
                     console.log(error);
                 },
             });
           }
       },
       select: function (event, ui) {
		var inputs = j(this).closest('span').find(':input');
	  	inputs.eq( inputs.index(this)+ 1 ).focus();
	},
     });
     
     
     
     
     j( "#tobus3" ).autocomplete({
       source: function( request, response ) {
          var className =  j( "#tobus3" ).attr('class').split(' ')[0];
          //alert(className);
          
          if(className == 'bus'){
             wp.ajax.send('auto-search-bus', {
                 data: {
                   q: request.term,
                 },
                 success: function (data) {
                     //console.log(data);
                     response( data );
                 },
                 error: function (error) {
                     alert(error);
                     console.log(error);
                 },
             });
           }
       },
       select: function (event, ui) {
		var inputs = j(this).closest('span').find(':input');
	  	inputs.eq( inputs.index(this)+ 1 ).focus();
	},
     });
     
     
     
     
   });
   
   j( function() {
     var dateFormat = "dd-mm-yy",
       from = j( "#txtDatehotel2" )
         .datepicker({
           defaultDate: "d",
           dateFormat: "dd-mm-yy",
           minDate: "d",
           changeMonth: true,
           numberOfMonths: 1
         })
         .on( "change", function() {
           to.datepicker( "option", "minDate", getDate( this ) );
         }),
       to = j( "#dateTohotel2" ).datepicker({
         defaultDate: "+1w",
         dateFormat: "dd-mm-yy",
         changeMonth: true,
         numberOfMonths: 1
       })
       .on( "change", function() {
         from.datepicker( "option", "maxDate", getDate( this ) );
         calculate();
       });
   
     function getDate( element ) {
       var date;
       try {
         date = j.datepicker.parseDate( dateFormat, element.value );
       } catch( error ) {
         date = null;
       }
   	
       return date;
     }
     function calculate() {
	    var d1 = j('#txtDatehotel2').datepicker('getDate');
	    var d2 = j('#dateTohotel2').datepicker('getDate');
	    var oneDay = 24*60*60*1000;
	    var diff = 0;
	    if (d1 && d2) {
	  
	      diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
	    }
	    j('#stay2').val(diff);
	    j('#stayDays').html(diff);
	    //$('.minim').val(d1);
     }
   } );
   
   j( function() {
     var dateFormat = "dd-mm-yy",
       from = j( "#txtcarDate4" )
         .datepicker({
           defaultDate: "d",
           dateFormat: "dd-mm-yy",
           minDate: "d",
           changeMonth: true,
           numberOfMonths: 1
         })
         .on( "change", function() {
           to.datepicker( "option", "minDate", getDate( this ) );
         }),
       to = j( "#txtcarDateto4" ).datepicker({
         defaultDate: "+1w",
         dateFormat: "dd-mm-yy",
         changeMonth: true,
         numberOfMonths: 1
       })
       .on( "change", function() {
         from.datepicker( "option", "maxDate", getDate( this ) );
       });
   
     function getDate( element ) {
       var date;
       try {
         date = j.datepicker.parseDate( dateFormat, element.value );
       } catch( error ) {
         date = null;
       }
   
       return date;
     }
   } );
   
   j( function() {
     var dateFormat = "dd-mm-yy",
       from = j( "#txtDate1" )
         .datepicker({
           defaultDate: "d",
           dateFormat: "dd-mm-yy",
           minDate: "d",
           changeMonth: true,
           numberOfMonths: 1
         })
         .on( "change", function() {
           to.datepicker( "option", "minDate", getDate( this ) );
         }),
       to = j( "#txtDateto1" ).datepicker({
         defaultDate: "+1w",
         dateFormat: "dd-mm-yy",
         changeMonth: true,
         numberOfMonths: 1
       })
       .on( "change", function() {
         from.datepicker( "option", "maxDate", getDate( this ) );
       });
   
     function getDate( element ) {
       var date;
       try {
         date = j.datepicker.parseDate( dateFormat, element.value );
       } catch( error ) {
         date = null;
       }
   
       return date;
     }
   } );
   j( function() {
     var dateFormat = "dd-mm-yy",
       from = j( "#txtDate3" )
         .datepicker({
           defaultDate: "d",
           dateFormat: "dd-mm-yy",
           minDate: "d",
           changeMonth: true,
           numberOfMonths: 1
         })
         .on( "change", function() {
           to.datepicker( "option", "minDate", getDate( this ) );
         }),
       to = j( "#txtDatebusto3" ).datepicker({
         defaultDate: "+1w",
         dateFormat: "dd-mm-yy",
         changeMonth: true,
         numberOfMonths: 1
       })
       .on( "change", function() {
         from.datepicker( "option", "maxDate", getDate( this ) );
       });
   
     function getDate( element ) {
       var date;
       try {
         date = j.datepicker.parseDate( dateFormat, element.value );
       } catch( error ) {
         date = null;
       }
   
       return date;
     }
   } );
</script>
<script type="text/javascript" src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/js/quote/bootstrap.js"></script>
<script>
   var j = jQuery.noConflict();
   j( document ).ready(function(){
      	   /*var fligtCost = document.getElementById('txtCost1').value;
	   var hotelCost = document.getElementById('txtCost2').value;
	   var busCost = document.getElementById('txtCost3').value;
	   if(fligtCost)
	   valCostPre(fligtCost,1,1);
	   if(hotelCost)
	   valCostPre(hotelCost,2,5);
	   if(busCost)
	   valCostPre(busCost,3,2);*/
   
     j('.roundtrip').click(function(){
     j('.return-date').show();
     j('.controls').hide();
     });
     j('.hide-roundtrip').click(function(){
     j('.return-date').hide();
     j('.controls').hide();
     });
     j('.show-controls').click(function(){
     j('.return-date').hide();
     j('.controls').show();
     });
   
   });
   j(function()
   {

       j(document).on('click', '.btn-add', function(e)
       {
           e.preventDefault();
   
           var controlForm = $('.controls'),
               currentEntry = $(this).parents('.voca:first'),
               newEntry = $(currentEntry.clone()).appendTo(controlForm);
   
           newEntry.find('input').val('');
           controlForm.find('.btn-add:not(:last)')
               .removeClass('btn-default').addClass('btn-danger')
               .removeClass('btn-add').addClass('btn-remove').removeClass('fa-plus').addClass('fa-minus').removeClass('btn-primary');
   
       }).on('click', '.btn-remove', function(e)
       {
   		j(this).parents('.voca:first').remove();
   
   		e.preventDefault();
   		return false;
   	});
   	
   	j("input").change(function() {
	  var inputs = j(this).closest('span').find(':input');
	  inputs.eq( inputs.index(this)+ 1 ).focus();
	});
   });
   jQuery(document).ready(function($){
		// Uploading files
		var file_frame;
		 
		  $('.passport_front_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    //if ( file_frame ) {
		      //file_frame.open();
		      //return;
		    //}
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#empPassportFrontViewer').val(attachment.url);
		      $('.passport_front_img').html('<img src="'+attachment.url+'" style="width:150px;">');
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  
		  $('.passport_back_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#empPassportBackViewer').val(attachment.url);
		      $('.passport_back_img').html('<img src="'+attachment.url+'" style="width:150px;">');
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  $('.visa_document').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#fileComplogo').val(attachment.url);
		      $('.visa_img').html('<a href="'+attachment.url+'" download><i class="fa fa-download fa-3x"></i></a>');
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		});
</script>

<script>
    var j = jQuery.noConflict();
    function findDetails(n){							   
	
	var empcode = j.trim(j("#txtGrpEmpCode"+n).val());
	
	
	var radTrvPlan = j('input[name=radTrvPlan]:checked').val();
	
	var empCnt = j("#empcount").val();
	
	
	var edit = j("#grpedit").val();
	
	if(edit == 1) { 
		
		radTrvPlan = j("#trvpln").val();
	}
	
	//alert(radTrvPlan);
	
	if(radTrvPlan == "" || (radTrvPlan != 'domestic' && radTrvPlan != 'international')){
		//alert(0)
		return false;
		
	}
	
	
	if(empCnt >= 2){
		
		j("#requestTable").show(500);	
	} else {
		j("#requestTable").hide(500);
		}

	
		
	//formData = $("#empform").serialize();
	
	if(empcode==""){
		j("#txtGrpEmpCode"+n).val('');
		j("#txtGrpEmpCode"+n).focus();
		return false;
	}
	
	
	var empArr = [];
			
	breakOut = false;
	
	j(".grpempcode").each(function() {
		
		var empCd = j(this).val();
		
		empCd = empCd.toLowerCase();
		
		var a = empArr.indexOf(empCd);
		
		if(a == '-1')
		empArr.push(empCd);
		else{
			 breakOut = true;
			 return false;
		}				
	
	});
	
	
	if(breakOut){
	
		alert('Duplicate Employee Codes Not Allowed');
		
		return false;
	
	}
	
	
	
	    wp.ajax.send( 'get-emp-details', {
        data: { 
            txtEmpCode : empcode, 
            trvPlan : radTrvPlan, 
        },
		success: function(result){
			
			
			
			
			
			//alert(result)
			
			//alert(JSON.stringify(result));
			
			switch(result.status){
				
				case 1:
					
					j('.newEmp'+n).each(function(){
						j(this).val('');
					});
					
					j(".newEmp"+n).attr("disabled", "disabled");
					
					j("#employeeDetailsNew"+n).hide(500);
					
					j("#employeeName"+n).html(result.response.empname);
					j("#employeeEmail"+n).html(result.response.empemail);
					j("#employeeMobile"+n).html(result.response.empmobile);
					j("#employeeDob"+n).html(result.response.dob);
					j("#employeeGender"+n).html(result.response.gender);
					j("#employeeMealPrf"+n).html(result.response.empmealprf);
					
					
					j("#employeedetails"+n).show(500);
					
					
					j(".visaclass"+n).attr("disabled", "disabled");
					
					j(".pptclass"+n).attr("disabled", "disabled");
					
					if(radTrvPlan=='international'){
						
							var pspstats = result.passportstatus;
							
							//alert(pspstats)
							
							if(pspstats == '1'){
								
								
								var uri = j("#url").val();
								
								if(result.passportresponse.psprtfrontview != ""){
									
									var htmlContent = '<a class="btn-link" href="download-file.php?file='+uri+result.passportresponse.psprtfrontview+'");>view/download</a>';
									
								} else {
									
									htmlContent = '<span class="label label-default">N/A</span>';
								}
								
								
								j("#empPassportFrontView"+n).html(htmlContent);
								
								
								if(result.passportresponse.psprtbackview != ""){
									
									var htmlContent = 	'<a class="btn-link" href="download-file.php?file='+uri+result.passportresponse.psprtbackview+'");>view/download</a>';
									
								} else {
									
									htmlContent = '<span class="label label-default">N/A</span>';
									
								}
								
								j("#empPassportBackView"+n).html(htmlContent);
			
								
									
									j("#empPassportNo"+n).html(result.passportresponse.passno);
									j("#empIssuedCountry"+n).html(result.passportresponse.issudcntry);
									j("#empIssuedPlace"+n).html(result.passportresponse.issudplc);
									j("#empIssuedDate"+n).html(result.passportresponse.issuddate);
									j("#empExpiryDate"+n).html(result.passportresponse.expirydate);
									
									j("#empPassprtDetailsNew"+n).hide(500);
									
									j("#empPassportDetails"+n).show(500);
									
								
								
							} else if(pspstats == '2'){
								
								j(".pptclass"+n).removeAttr("disabled");
									
								j("#empPassprtDetailsNew"+n).show(500);
								
							}
							
							
							j(".visaclass"+n).removeAttr("disabled");
							
							j("#empVisaDetailsNew"+n).show(500);
						
					}
	
					//j("#expenseTable").show(500);
				break;
				
				case 2:
					j(".newEmp"+n).removeAttr("disabled");
					
					j("#employeeDetailsNew"+n).show(500);
					
					j("#employeedetails"+n).hide(500);
					
					
					
					if(radTrvPlan  == 'domestic'){
						
							j(".visaclass"+n).attr("disabled", "disabled");
					
							j(".pptclass"+n).attr("disabled", "disabled");
							
							j("#empPassprtDetailsNew"+n).hide(500);
							
							j("#empVisaDetailsNew"+n).hide(500);
							
							
					} else if(radTrvPlan == 'international') {
							
							j(".visaclass"+n).removeAttr("disabled");
					
							j(".pptclass"+n).removeAttr("disabled");
							
							j("#empPassprtDetailsNew"+n).show(500);
							
							j("#empVisaDetailsNew"+n).show(500);
										 
						
					}
					
					
					
	
					//j("#expenseTable").show(500);
				break;
			
			}
			
			 j("#addmore"+n).show(500);
			 
		
			 j( '.erp-leave-date-field' ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true
             });
            
             j( '.erp-profile-date-field' ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "1950:2017",
             });
            
             j( '.erp-ncorp-date-field' ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "1950:2017",
             });
			
			
			
			
		}
	});
}
function addmore(n){
	
	
	j("#addmorebutton"+n).fadeOut(300, function() { j(this).remove(); });
	
	var itr = parseInt(n) + 1;

	j("#empcount").val(itr);
	
	wp.ajax.send( 'add-more-employees', {
            data: { 
                itr : itr, 
            },
			success: function(result){
        		j(result).insertAfter("#employeeDiv"+n);
    		}
	});
	
	
	var fieldval = j("#fields").val();
	
	if(fieldval)
	j("#fields").val(fieldval + ',' +itr);
	else
	j("#fields").val(itr + ',');
	
	valGroupRequestCost();
	
	//alert('sdf')
	
	j( '.erp-leave-date-field' ).datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true
    });
    
    j( '.erp-profile-date-field' ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:2017",
    });
    
    j( '.erp-ncorp-date-field' ).datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:2017",
    });
	
	
	

}
// group booking Total Cost

function valGroupRequestCost(){


	//alert('ok');
	
	var chks=document.getElementsByName('txtCost[]');
	
	for(var i=0;i<chks.length;i++)
	{
		var costcont=chks[i].value.trim();
		
		reg=/[^0-9]/;
		if(reg.test(costcont)){              
			chks[i].value="";
			alert("Only Numbers Allowed here");
			chks[i].focus();
			return false;
		} else {
			
			//var cnt	=	$("#selEmployees :selected").length;
			
			var cnt = j("#empcount").val();
			
			if(cnt && chks[i].value)
			document.getElementById("txtTotalCost"+(i+1)).value	=	chks[i].value * cnt;
			
			getGrpBookingTotal();
			
		}
		
	}
	
	
	


}
function getGrpBookingTotal()
{
	
	//alert("ok");
	
	var chks=document.getElementsByName('txtTotalCost[]');
	
	var totalcost=0;
	
	for(var i=0;i<chks.length;i++)
	{		
		costotint=parseInt(chks[i].value.trim());		
		
		if(costotint){
		totalcost+=costotint;
		}
		
	}
	
	
	totalcost=indianRupeeFormat(totalcost);
	
	
	if(totalcost!=0 && totalcost!=""){
		
		document.getElementById('totaltable').innerHTML='<div class="table-responsive"><table class="table table-hover" style=" font-weight:bold;"><tr ><td align="right" width="85%">Total Cost</td><td align="right" width="5%">:</td><td align="right" width="10%">Rs '+totalcost+'.00</td></tr></table></div>';
		}else{
		document.getElementById('totaltable').innerHTML='';
		}	
		
}
function indianRupeeFormat(x){
	
	x=x.toString();
	var lastThree = x.substring(x.length-3);
	var otherNumbers = x.substring(0,x.length-3);
	if(otherNumbers != '')
		lastThree = ',' + lastThree;
	var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
	
	//res=parseInt(res);
	
	return res;

}
function clearForm(n){
	
	j('.newEmp'+n).each(function(){
		j(this).val('');
	});
	
	
	
	j("#employeedetails"+n).hide(500);
	
	j("#employeeDetailsNew"+n).hide(500);
	
	
	j("#empPassportDetails"+n).hide(500);
	
	j("#empPassprtDetailsNew"+n).hide(500);
	
	j("#empVisaDetailsNew"+n).hide(500);

	
	
	j("#requestTable").hide(500);
	
	
}
</script>

