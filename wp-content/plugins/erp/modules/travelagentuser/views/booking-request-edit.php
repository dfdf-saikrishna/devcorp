 <?php
   	global $showProCode;
	global $totalcost;
	$checkeddefaultf = 'checked="checked"';
	$stylef = 'style="display: none;"';
	$etEdit = 1;
	require_once WPERP_EMPLOYEE_PATH . '/includes/functions-pre-travel-req.php';
	global $wpdb;
	$compid = $_SESSION['compid'];
	$reqid = $_GET['reqid'];	
	$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
	$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
    $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Type=2 AND RE_Status=1");
    $empid=$row->EMP_Id;
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
<link rel="stylesheet" id="weather-icons.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/weather-icons.min.css" type="text/css" media="all">
<!--link rel="stylesheet" id="fontawesome-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/font-awesome.css" type="text/css" media="all"-->
<link rel="stylesheet" id="styles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/styles(1).css" type="text/css" media="all">
<link rel="stylesheet" id="mystyles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/mystyles.css" type="text/css" media="all">
<link rel="stylesheet" id="default-style-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/style(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom2css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom2.css" type="text/css" media="all">
<link rel="stylesheet" id="user.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/user.css" type="text/css" media="all">
<link rel="stylesheet" id="custom-responsive-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom-responsive.css" type="text/css" media="all">
<link rel="stylesheet" id="st-select.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/st-select.css" type="text/css" media="all">
<link rel="stylesheet" id="roboto-font-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/css" type="text/css" media="all">
<link rel="stylesheet" id="icomoon-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<div class="postbox">
   <div class="inside">
      <div class="wrap pre-travel-request erp request" id="wp-erp">
         <h2><?php _e( 'Booking Request Edit', 'employee' ); ?></h2>
         <!--<code class="description">ADD Request</code>-->
         <form id="request_edit_form" name="request_edit_form" action="#" method="post">
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
            <?php
               //$row=0;
               require_once WPERP_TRAVELAGENT_CLIENT_VIEWS . '/employee-details.php'; 
               ?>
            <div class="table-wrapper">
            <?php
            $rdidarry=array();
            $selrequest=$wpdb->get_results("SELECT * FROM request_details WHERE REQ_Id='$reqid' AND RD_Status=1 ORDER BY RD_Dateoftravel ASC");
	         foreach($selrequest as $rowrequest)
		 {
		 $totalcost+=$rowrequest->RD_Cost;
		 $classes=null;
	               switch($rowrequest->MOD_Id)
	               {
	                       case 1:
	                       $forigin = $rowrequest->RD_Cityfrom;
	                       $fdestination = $rowrequest->RD_Cityto;
	                       $fdeparture = $rowrequest->RD_Dateoftravel;
	                       $fdescription = $rowrequest->RD_Description;
	                       $fdelete = '<a href="#" value="'.$rowrequest->RD_Id.'" name="deleteRowbutton" id="deleteRowbutton" title="delete request"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
	                       if($fdeparture)
	                       $fdeparture = date('d-m-Y',strtotime($fdeparture));
	                       else
	                       $fdeparture = '';
	                       $fcost = $rowrequest->RD_Cost;
	                       $rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rowrequest->RD_Id' AND rd.MOD_Id=mo.MOD_Id");
	                       if($rowRdDetails->MOD_Name=="Flight")
	                           $fstatus = "readonly";
	                       else
	                           $fstatus = "";
	                       $freturn = $rowrequest->RD_ReturnDate;
	                       if($freturn){
	                           $stylef = 'style="display: block;"';
	                           $checkedf = 'checked="checked"';
	                           $freturn = date('d-m-Y',strtotime($freturn));
	                           $checkeddefaultf = "";
	                       }
	                       else{
	                           $stylef = 'style="display: none;"';
	                           $checkedf = '';
	                           $checkeddefaultf = 'checked="checked"';
	                           $freturn = '';
	                       }
	                       //$fhidden = '<input type="hidden" name="sessionid[]" value="'.time().'" id="sessionid1"/><input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected1"/><input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered1"/>';
	                       break;
	
	                       case 2:
	                       $borigin = $rowrequest->RD_Cityfrom;
	                       $bdestination = $rowrequest->RD_Cityto;
	                       $bdeparture = $rowrequest->RD_Dateoftravel;
	                       $bdescription = $rowrequest->RD_Description;
	                       $bdelete = '<a href="#" value="'.$rowrequest->RD_Id.'" name="deleteRowbutton" id="deleteRowbutton" title="delete request"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
	                       if($bdeparture)
	                       $bdeparture = date('d-m-Y',strtotime($bdeparture));
	                       else
	                       $bdeparture = '';
	                       $bcost = $rowrequest->RD_Cost;
	                       $rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rowrequest->RD_Id' AND rd.MOD_Id=mo.MOD_Id");
	                       if($rowRdDetails->MOD_Name=="Bus")
	                           $bstatus = "readonly";
	                       else
	                           $bstatus = "";
	                       //$bhidden = '<input type="hidden" name="sessionid[]" value="'.time().'" id="sessionid3"/><input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected3"/><input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered3"/>';
	                       break;
	
	                       case 5:
	                       $horigin = $rowrequest->RD_Cityfrom;
	                       $hdestination = $rowrequest->RD_Cityto;
	                       $hdeparture = $rowrequest->RD_Dateoftravel;
	                       $hdescription = $rowrequest->RD_Description;
	                       $harrival = $rowrequest->RD_EndDate;
	                       $hstay = $rowrequest->SD_Id;
	                       $hdelete = '<a href="#" value="'.$rowrequest->RD_Id.'" name="deleteRowbutton" id="deleteRowbutton" title="delete request"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
	                       if($hdeparture)
	                       $hdeparture = date('d-m-Y',strtotime($hdeparture));
	                       else
	                       $hdeparture = '';
	                       if($harrival)
	                       $harrival = date('d-m-Y',strtotime($harrival));
	                       else
	                       $harrival = '';	                       
	                       $hcost = $rowrequest->RD_Cost;
	                       //$hhidden = '<input type="hidden" name="sessionid[]" value="'.time().'" id="sessionid2"/><input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected2"/><input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered2"/>';
	                       break;
	
	                       default:
	                       $classes= 'class=""';
	                       $button_class = 'class="button button-primary getQuote';
	                      
	                       
	
	               }
	               array_push($rdidarry, $rowrequest->RD_Id);
	               ?>
	               <input type="hidden" value="<?php echo $rowrequest->RD_Id; ?>" name="rdids[]"/>
		 <?php
		 }
		 if(count($rdidarry)<=1){
		 	$fdelete = '';
		 	$bdelete = '';
		 }         
            ?>
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
                              <li>
                                 <a href="/#tab-rental3" data-toggle="tab"><i class="fa fa-money"></i>
                                 <span>Others</span></a>
                              </li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane fade active in" id="tab-activities0">
         
         <div class="row">
         <div class="col">
         <div class="checkbox col-xs-12 col-sm-2 hide-roundtrip">
         <label class="radio-inline active"><input type="radio" name="journeytypef" value="oneway" <?php echo $checkeddefaultf; ?>>One Way</label>
         </div>
         <div class="checkbox col-xs-12 col-sm-2 roundtrip">
         <label class="radio-inline"><input type="radio" name="journeytypef" value="roundtrip" <?php echo $checkedf; ?>>Round Trip</label>
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
         <input autocomplete="off" type="text" name="from[]" id="from1" value="<?php echo $forigin; ?>" class="flight form-control st-location-name required" placeholder="City or Origin">
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
         <input autocomplete="off" type="text" name="to[]" value="<?php echo $fdestination; ?>" id="to1" class="flight form-control st-location-name required" placeholder="City or Destination">	
         <div class="option-wrapper"></div>
         </div>
         </div>
         </div>
		 <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group-md form-group-icon-left">
         <label for="field-st-checkin">Departure</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input class="form-control off pretraveldate" name="txtDate[]" value="<?php echo $fdeparture; ?>" id="txtDate1" type="text" placeholder="dd/mm/yyyy">
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
         
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 return-date" <?php echo $stylef; ?>>
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group-md form-group-icon-left">
         <label for="txtDateto1">Return</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDateto1" class="form-control pretravel off" name="return-flight" type="text" value="<?php echo $freturn; ?>" placeholder="dd/mm/yyyy">
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
         <textarea name="txtaExpdesc[]" id="txtaExpdesc1" class="" autocomplete="off"><?php echo $fdescription; ?></textarea>
         </div>
         </div>
         <input type ="hidden" name="selExpcat[]" id="selExpcat1" value="1">
         <input type ="hidden" name="selModeofTransp[]" id="selModeofTransp1" value="1"></span>
         <button class="btn btn-primary btn-lg getQuoteFlight" id="getQuote1" name="getQuote" value="1" type="submit">Search for Flights</button>
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
         <input autocomplete="off" type="text" name="from[]" id="frombus3" value="<?php echo $borigin; ?>" class="bus form-control st-location-name required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div></div>
         <div class="col">
         <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12 ">
         <div class="form-group form-group-md form-group-icon-left">
         <label for="field-st-address">Destination</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input autocomplete="off" type="text" name="to[]" id="tobus3" value="<?php echo $bdestination; ?>" class="bus form-control st-location-name required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div></div></div>               </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group-md form-group-icon-left">
         <label for="field-st-checkin">Departure</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDate3" class="form-control pretraveldate off" name="txtDate[]" type="text" placeholder="dd/mm/yyyy" value="<?php echo $bdeparture; ?>">
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
         <textarea name="txtaExpdesc[]" id="txtaExpdesc3" class="" autocomplete="off"><?php echo $bdescription; ?></textarea>
         </div>
         </div>
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
         <input type="text" id="fromhotel2" name="from[]" value="<?php echo $horigin;?>" class="hotel form-control st-location-name  required" placeholder="City or Destination">
         <div class="option-wrapper"></div>
         </div>
         </div>                    </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group- form-group-icon-left">
         <label for="field-hotel-checkin">Check In</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="txtDatehotel2" name="txtDate[]" placeholder="dd/mm/yyyy" class="form-control pretraveldate checkin_hotel off" value="<?php echo $hdeparture;?>" name="start" type="text">
         </div>
         </div>
         <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
         <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group- form-group-icon-left">
         <label for="field-hotel-checkout">Check Out</label>
         <i class="fa fa-calendar input-icon input-icon-highlight"></i>
         <input id="dateTohotel2" name="dateTohotel[]" placeholder="dd/mm/yyyy" class="form-control pretraveldate off checkout_hotel" value="<?php echo $harrival;?>" name="end" type="text">
         </div>                    </div>
         <div class=" col-md-2 col-lg-2 col-sm-12 col-xs-12 form-group form-group- form-group-select-plus">
         <label for="field-hotel-room-num">Description</label>
         <textarea name="txtaExpdesc[]" id="txtaExpdesc2" class="" autocomplete="off"><?php echo $hdescription; ?></textarea>
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
                 <input type="radio"><span id="stayDays"><?php echo $hstay; ?></span></label>
             </div>
         </div>
 	 </div>
         <input type="hidden" name="selStayDur[]" value="<?php echo $hstay;?>" id="stay2">
         <input type ="hidden" name="selExpcat[]" id="selExpcat2" value="2">
         <input type ="hidden" name="selModeofTransp[]" id="selModeofTransp2" value="5"></span>
         <button class="btn btn-primary btn-lg getQuoteHotel" name="getQuote" value="2" id="getQuote2" type="submit">Search for Hotels</button>
         
         </div>
         <div class="tab-pane fade " id="tab-cars1">
         
         <div class="row">
         <div class="">
         <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-car-dropoff">Pick Up From</label>
         <i class="fa fa-map-marker input-icon"></i>
         <div class="st-select-wrapper">
         <input data-children="location_id_drop_off" data-clear="clear" autocomplete="off" type="text" name="pick-up" value="" class="form-control st-location-name required" placeholder="City or Destination ">
         <div class="option-wrapper"></div>
         </div>
         </div>
         <div class="same_location form-group form-group- form-group-icon-left">
         <!-- <label  for="required_dropoff"> -->
         <input style="display:none;" checked="" type="checkbox" name="required_dropoff" value="required_dropoff" id="" class="required-field">
         <!-- </label> -->
         <a href="javascript:void(0)" id="required_dropoff" class="required-field change_same_location" data-change="Same Location">Different Location</a>
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
         <input id="field-car-pickup-date" placeholder="dd/mm/yyyy" value="" class="form-control pick-up-date off" name="pick-up-date" type="text">
         </div>
         </div>
         <div class="col-md-6">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-car-pickup-time">Pick-up Time</label>
         <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
         <input id="field-car-pickup-time" name="pick-up-time" class="time-pick form-control off" value="" type="text">
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
         <input id="field-st-dropoff-date" placeholder="dd/mm/yyyy" value="" class="form-control drop-off-date off" name="drop-off-date" type="text">
         </div>
         </div>
         <div class="col-md-6">
         <div class="form-group form-group- form-group-icon-left">
         <label for="field-st-dropoff-time">Drop-off Time</label>
         <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
         <input id="field-st-dropoff-time" name="drop-off-time" class="time-pick form-control off" value="" type="text">
         </div>
         </div>
         </div>                    </div>
         </div>
         </div>
         <button class="btn btn-primary btn-lg" type="submit">Search for Cars</button>
        
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
         <td  class=""><label><input class="" style="width: 80%;margin-right: 8%;" value="<?php echo $fcost; ?>" <?php echo $fstatus; ?> name="txtCost[]" id="txtCost1" autocomplete="off" onkeyup="valCostPre(this.value,1,1);" onchange="valCostPre(this.value,1);" type="text" placeholder="0"><?php echo $fdelete; ?></label><span class="red" id="show-exceed1"></span></td></tr>
         <tr><td  class="text-center"><label ><i class="fa fa-bus eicon exceed3" aria-hidden="true"></i></label></td>
         <td  class=""><label><input class="" style="width: 80%;margin-right: 8%;" name="txtCost[]" value="<?php echo $bcost; ?>" <?php echo $bstatus; ?> id="txtCost3" autocomplete="off" onkeyup="valCostPre(this.value,3,2);" onchange="valCostPre(this.value,3);" type="text" placeholder="0"><?php echo $bdelete; ?></label><span class="red" id="show-exceed3"></span></td></tr>
         <tr><td  class="text-center"><label ><i class="fa fa-hospital-o eicon exceed2" aria-hidden="true"></i></label></td>
         <td  class=""><label><input class="" style="width: 80%;margin-right: 8%;" name="txtCost[]" value="<?php echo $hcost; ?>" id="txtCost2" autocomplete="off" onkeyup="valCostPre(this.value,2,5);" onchange="valCostPre(this.value,2);" type="text" placeholder="0"><?php echo $hdelete; ?></label><span class="red" id="show-exceed2"></span></td></tr>
         <tr><td  class="text-center"><label ><i class="fa fa-car eicon exceed4" aria-hidden="true"></i></label></td>
         <td  class=""><label><input type="textbox" placeholder="0" style="width: 80%;margin-right: 8%;"></label></td></tr>
         <tr><td class="text-center"><label ><i class="eicon" >=</i></label></td>
         <td  class=""><label><input type="textbox" placeholder="0" style="width: 80%;margin-right: 8%;" value="<?php echo $totalcost; ?>" id="totaltable"></label></td></tr>
         </table>
       
         </div>
     	 </div>
         </div>
         <!-- Estimated Cost -->
         
         
         <input type="hidden" value="1" name="ectype" id="ectype"/>
         <input type="hidden" value="0" name="expenseLimit" id="expenseLimit"/>
         <input type="hidden" name="rowCount" id="rowCount" value="1">
         <input type="hidden" name="ImageUrl" id="ImageUrl" value="<?php echo WPERP_EMPLOYEE_ASSETS;?>">
         <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"/>
         <input type="hidden" value="<?php echo $empid ?>" name="selEmployees" id="selEmployees" />
         <input type="hidden" value="2" name="updateRequest" id="updateRequest" />
         <input type="hidden" name="radTrvPlan" value="<?php echo $row->REQ_Method; ?>"  />
         <input type="hidden" name="action" id="update-booking-request" value="update-booking-request">
         <div id="quotefieldsid">
        	<input type="hidden" name="sessionid[]" value="<?php echo time(); ?>" class="erase1" id="sessionid1"/>
        	<input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected1" class="erase1"/>
        	<input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered1" class="erase1"/>
         </div>
         </span>
         <span id="totaltable"></span>
         </div>
         <!-- Quote Details -->
         
         <?php
            $a=1;
            global $bus;
            global $flight;
            global $class;
	    foreach($rdidarry as $rdid){	
	    $selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	    if(count($selrgquote)){
				 
	 	$gqfid=array();
		
		 $hiddenAllPrefered=0; $sessionid=0; $hiddenPrefrdSelected=0;
            foreach($selrgquote as $values){
						
						$sessionid=$values->RG_SessionId;
						
						array_push($gqfid, $values->GQF_Id);
						
						if($values->RG_Pref==2)
						$hiddenPrefrdSelected=$values->GQF_Id;
					
					}
					
					
					$hiddenAllPrefered=join(",", $gqfid);
					if (($values->GQF_AirlineCode == 'true') || ($values->GQF_AirlineCode == 'false')) { // 100% of time
					$bus = true;
					//$class = 'class="erase3"';
					}
					else{
					$flight = true;
					$class = '';
					}
				  ?>
                <input type="hidden" name="sessionid[]" id="sessionid<?php echo $a; ?>" <?php echo $class;?> value="<?php echo $sessionid; ?>"/>
                <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected<?php echo $a; ?>" <?php echo $class;?> value="<?php echo $hiddenPrefrdSelected; ?>"/>
                <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered<?php echo $a; ?>" <?php echo $class;?> value="<?php echo $hiddenAllPrefered; ?>"/>
		<?php 
		}
		$a++;
		} ?>
		
         <div id="quotefieldsid">
        	<input type="hidden" name="sessionid[]" value="<?php echo time(); ?>" id="sessionid3" class="erase3"/>
        	<input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected3" class="erase3"/>
        	<input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered3" class="erase3"/>
         </div>
         <!-- Quote Details -->
         <!--buttons-->
         <div class="container">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
               <button class="btn btn-primary btn-lg" value="Update" name="update" id="updateBookingRequest" type="submit">Update</button>
               <button type="submit" class="btn btn-primary btn-lg" value="Save" name="save" id="save-pre-travel-request" type="submit">Save</button>
               <button class="btn btn-primary btn-lg" type="submit">&nbsp;Back&nbsp;</button>
            </div>
            <div class="col-sm-3"></div>
         </div>
         <!--buttons-->
         <!-- selected quote -->
         <div id="selected_quote" style="margin-top:30px;">
         <?php foreach($rdidarry as $rdid){	?>
            
            
            <?php	
		//echo 'Rdid='.$rdid;
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	
			if(count($selrgquote)){			
	                                        
				if($rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")){

	    ?>

            <?php if($rowRdDetails->MOD_Name=="Flight") { ?>	
            <div class="container pgbg flight1">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo date('d-m-Y',strtotime($rowRdDetails->RD_Dateoftravel));?><?php if($freturn){echo  " " ."|" . " " .  $freturn; }?></span>  </div>
               </div>
               <br><br>
               <div class="row flight-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/AirlineLogo/'.$rowrgquote->GQF_AirlineCode.'.gif ';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
               ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3">Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    <?php if($rowRdDetails->MOD_Name=="Hotel") { ?>	
            <div class="container pgbg hotel">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-hospital-o planefa " aria-hidden="true" ></i><span class="gclr 22fnt">HOTELS</span> </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"> BLR - MAA </span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15"><i class="fa fa-calendar mapfa" aria-hidden="true"></i><span class="18fnt">12 , Apr 2017 </span>  </div>
               </div>
               <br><br>
               <div class="row hotel-content2" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3">Spice jet</span> <br> <span class="splane quote-dep3"> Dep.12.45 AM </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">2000</span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    <?php if($rowRdDetails->MOD_Name=="Bus") { ?>
            <div class="container pgbg bus3">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo $rowRdDetails->RD_Dateoftravel;?> </span>  </div>
               </div>
               <br><br>
               <div class="row bus-content3" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/quote-bus.png';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
               ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3"> Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    
 	    <?php } ?>
 	    
 	    
 	    <?php } ?>
 	    
	    <?php } ?>
	    </div>
	    <!-- NewQuote -->
            <div class="container pgbg flight1" style="display:none;">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 pt15 pb15" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> BLR</span><span class="quote-to1"> - MAA </span></span></div>
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
	    <!-- NewQuote -->
	    </div>
         <!-- selected quote -->
         </form>
         <!-- .postbox -->
      </div>
   </div>
</div>
</div>
</div>
<!--script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script-->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
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
</script>