<?php
require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req.php';
global $wpdb;
global $empuserid;
global $showProCode;
global $totalcost;
$compid = $_SESSION['compid'];
$reqid	=$_GET['reqid'];
$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Claim IS NULL and req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active != 9 AND REQ_Type=3 AND RE_Status=1");
$empuserid = $row->EMP_Id;
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
$selsql=$wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mot WHERE rd.REQ_Id=$row->REQ_Id AND rd.RD_Type=2 AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mot.MOD_Id AND rd.RD_Status=1 ORDER BY rd.RD_Dateoftravel ASC");
$selexpcat=$wpdb->get_results("SELECT * FROM expense_category WHERE EC_Id IN (1,2,4)");
$selmode=$wpdb->get_results("SELECT * FROM mode WHERE EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");

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
<div class="wrap erp travel-desk-request request">

    <div class="erp-single-container">
            
          <div class="postbox" id="emp_details">
              <form id="traveldesk_request_edit" name="traveldesk_request_edit" action="#" method="post" enctype="multipart/form-data">  
              <div class="inside">
                <h2><?php _e( 'Individual Employee Request [ with approval ] Edit', 'traveldesk' ); ?></h2>
                <?php
                require WPERP_TRAVELDESK_VIEWS."/employee-details.php";
                ?>
       		<div style="margin-top:60px;">
                <!-- Request Details -->
                <?php _e(requestDetails(1)); ?>
              </div>
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
              <div style="margin-top:60px;">
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
	                       
	                       case 3:
	                       $corigin = $rowrequest->RD_Cityfrom;
	                       $cpickup = $rowrequest->pickup;
	                       $cdropoff = $rowrequest->dropoff;
	                       $cdescription = $rowrequest->RD_Description;
	                       $cdatefrom = date('d-m-Y',strtotime($rowrequest->RD_Dateoftravel));
	                       $cdateto = date('d-m-Y',strtotime($rowrequest->RD_EndDate));
	                       $cdelete = '<a href="#" value="'.$rowrequest->RD_Id.'" name="deleteRowbutton" id="deleteRowbutton" title="delete request"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
	                       $ccost = $rowrequest->RD_Cost;
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
                            <div class="flight-rows">
                            <?php
                            $row = 1;
                            if($fstatus){ 
                            foreach($selrequest as $rowrequest)
		                    {
		                    if($rowrequest->MOD_Id == "1"){
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="radio-toolbar">
                                    <?php
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
            	                       }
            	                       else{
            	                           $stylef = 'style="display: none;"';
            	                           $checkedf = '';
            	                           $checkeddefaultf = 'checked="checked"';
            	                           $freturn = '';
            	                       }
            	                       ?>
                                      <input type="radio" id="radio<?php echo $row; ?>" name="radios<?php echo $row; ?>" field="<?php echo $row; ?>" <?php echo $checkeddefaultf;?> class="hide-roundtrip">
                                       <label for="radio<?php echo $row; ?>">Oneway</label>
                                      
                                     <input type="radio" id="radio-<?php echo $row; ?>" name="radios<?php echo $row; ?>" field="<?php echo $row; ?>" <?php echo $checkedf;?> class="roundtrip">
                                      <label for="radio-<?php echo $row; ?>">Roundtrip</label>
                                      
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin:10px 0;">
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="From" class="form-control fromflight" id="fromflight<?php echo $row; ?>" value="<?php echo $rowrequest->RD_Cityfrom; ?>" name="from[]" field="<?php echo $row; ?>">
                                        <label for="from" class="fa fa-plane" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input type="text" name="to[]" id="toflight<?php echo $row; ?>" class="form-control toflight" value="<?php echo $rowrequest->RD_Cityto; ?>" placeholder="To" field="<?php echo $row; ?>">
                                     <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate flightDatefrom" name="txtDate[]" value="<?php echo date('d-m-Y',strtotime($fdeparture)); ?>" id="flightDatefrom<?php echo $row; ?>" field="<?php echo $row; ?>" type="text" placeholder="dd/mm/yyyy">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                        <div class="icon-addon addon-md return<?php echo $row; ?>" <?php echo $stylef; ?>>
                                            <input class="form-control pretravel flightDatereturn" name="flightReturn[]" id="flightDatereturn<?php echo $row; ?>" type="text" value="<?php echo $rowrequest->RD_ReturnDate; ?>" placeholder="dd/mm/yyyy">
                                            <label for="email" class="fa fa-refresh" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                       <div class="icon-addon addon-md">
                                          <select class="form-control" id="adult<?php echo $row; ?>" name="adult">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                          </select>
                                          <label for="adult<?php echo $row; ?>" class="fa fa-users" rel="tooltip" title="date"></label>
                                      </div>
                                    </div>


                                </div>
                                <?php
                                $rdid = $rowrequest->RD_Id;
                                $hiddenPrefrdSelectedflight = 0; 
                                $sessionidflight = time();
                                $hiddenAllPreferedflight = 0;
                                $selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
                                if(count($selrgquote)){
                        	 	$gqfidflight=array();
                                foreach($selrgquote as $values){
                                    
        						    array_push($gqfidflight, $values->GQF_Id);
        						    $hiddenPrefrdSelectedflight=$values->GQF_Id;
        						    $sessionidflight=$values->RG_SessionId;
        						    $hiddenAllPreferedflight=join(",", $gqfidflight);
        					
        					    } } ?>
                                <input type="hidden" name="sessionid[]" id="sessionidflight<?php echo $row; ?>" value="<?php echo $sessionidflight; ?>"/>
                                <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelectedflight<?php echo $row; ?>" value="<?php echo $hiddenPrefrdSelectedflight; ?>"/>
                                <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPreferedflight<?php echo $row; ?>" value="<?php echo $hiddenAllPreferedflight; ?>"/>
                                
                                <input type="hidden" id="children<?php echo $row; ?>" name="children" value="0">
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" id="infants<?php echo $row; ?>" name="infants" value="0">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="flightcat" name="selExpcat[]" id="selExpcat<?php echo $row; ?>" value="1">
                                 <input type ="hidden" class="flightmode" name="selModeofTransp[]" id="selModeofTransp<?php echo $row; ?>" value="1">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="txtaExpdesc<?php echo $row; ?>" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"><?php echo $rowrequest->RD_Description;?></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-flight<?php echo $row; ?> flightcost" name="txtCost[]" id="txtCost<?php echo $row; ?>" <?php echo $fstatus; ?> value="<?php echo $rowrequest->RD_Cost; ?>" autocomplete="off" onkeyup="valCostPre(this.value,<?php echo $row; ?>,1);" onchange="valCostPre(this.value,1);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-flight<?php echo $row; ?>"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                
                                    <?php if($row>1){ ?>
                                    <div class="col-md-1 col-sm-12 col-xs-12" style="padding-left: 5px; padding-right: 0px;">
                                    <button type="button" class="btn btn-primary getQuoteFlight" id="getQuote<?php echo $row; ?>" name="getQuote" value="<?php echo $row; ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger"  id="deleteRowbutton" value="<?php echo $rowrequest->RD_Id; ?>" name="deleteRowbutton" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                    <?php } else{ ?>
                                    <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary getQuoteFlight" id="getQuote<?php echo $row; ?>" name="getQuote" value="1">Search</button>
                                    </div>
                                    <?php } ?>
                                
                                
                            </div>
                            <?php $row++; }}} else{ ?>
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
                                        <input class="form-control exceed-flight<?php echo $row; ?> flightcost" name="txtCost[]" id="txtCost1" autocomplete="off" onkeyup="valCostPre(this.value,<?php echo $row; ?>,1);" onchange="valCostPre(this.value,<?php echo $row; ?>,1);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-flight<?php echo $row; ?>"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary getQuoteFlight" id="getQuote1" name="getQuote" value="1">Search</button>
                                </div>
                                
                            </div>
                            <?php } ?>
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
                            <?php 
                            $row = 1;
                            if($bstatus){ 
                            foreach($selrequest as $rowrequest)
		                    {
		                    if($rowrequest->MOD_Id == "2"){
                            ?>
                            <div class="row" style="margin:10px 0;">
                            <?php
                            if($bdeparture)
    	                       $bdeparture = date('d-m-Y',strtotime($bdeparture));
    	                       else
    	                       $bdeparture = '';
    	                       $rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rowrequest->RD_Id' AND rd.MOD_Id=mo.MOD_Id");
    	                    if($rowRdDetails->MOD_Name=="Bus")
	                           $bstatus = "readonly";
	                        else
	                           $bstatus = "";
                            ?>
                            
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="From" class="form-control frombus" value="<?php echo $rowrequest->RD_Cityfrom; ?>" id="frombus<?php echo $row; ?>" name="from[]" field="<?php echo $row; ?>">
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
                                     <input type="text" name="to[]" id="tobus<?php echo $row; ?>" class="form-control tobus" value="<?php echo $rowrequest->RD_Cityto; ?>" placeholder="To" field="<?php echo $row; ?>">
                                     <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate busDatefrom" name="txtDate[]" value="<?php echo $bdeparture; ?>" id="busDatefrom<?php echo $row; ?>" field="<?php echo $row; ?>" type="text" placeholder="dd/mm/yyyy">
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
                                          <select class="form-control" id="adult<?php echo $row; ?>" name="adult" disabled>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                          </select>
                                          <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label>
                                      </div>
                                    </div>


                                </div>
                                <?php
                                $rdid = $rowrequest->RD_Id;
                                $hiddenPrefrdSelectedbus = 0; 
                                $sessionidbus = time();
                                $hiddenAllPreferedbus = 0;
                                $selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
                                if(count($selrgquote)){
                        	 	$gqfidbus=array();
                                foreach($selrgquote as $values){
        						    array_push($gqfidbus, $values->GQF_Id);
        						    $hiddenPrefrdSelectedbus=$values->GQF_Id;
        						    $sessionidbus=$values->RG_SessionId;
        						    $hiddenAllPreferedbus=join(",", $gqfidbus);
                        		}}
                                ?>
                                <input type="hidden" name="sessionid[]" id="sessionidbus<?php echo $row; ?>" value="<?php echo $sessionidbus; ?>"/>
                                <input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelectedbus<?php echo $row; ?>" value="<?php echo $hiddenPrefrdSelectedbus; ?>"/>
                                <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPreferedbus<?php echo $row; ?>" value="<?php echo $hiddenAllPreferedbus; ?>"/>
                        
                                <input type="hidden" id="children<?php echo $row; ?>" name="children" value="0">
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" id="infants<?php echo $row; ?>" name="infants" value="0">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="buscat" name="selExpcat[]" id="busselExpcat<?php echo $row; ?>" value="1">
                                 <input type ="hidden" class="busmode" name="selModeofTransp[]" id="busselModeofTransp<?php echo $row; ?>" value="2">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="bustxtaExpdesc<?php echo $row; ?>" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"><?php echo $rowrequest->RD_Description; ?></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-bus1 buscost" <?php echo $bstatus; ?> name="txtCost[]" value="<?php echo $rowrequest->RD_Cost;?>" id="bustxtCost<?php echo $row; ?>" autocomplete="off" onkeyup="valCostPre(this.value,<?php echo $row; ?>,2);" onchange="valCostPre(this.value,<?php echo $row; ?>,2);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-bus<?php echo $row; ?>"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                
                                    <?php if($row>1){ ?>
                                    <div class="col-md-1 col-sm-12 col-xs-12" style="padding-left: 5px; padding-right: 0px;">
                                    <button type="button" class="btn btn-primary getQuoteBus" id="getQuote" name="getQuote" value="<?php echo $row; ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger"  id="deleteRowbutton" value="<?php echo $rowrequest->RD_Id; ?>" name="deleteRowbutton" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                    <?php } else{ ?>
                                    <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary getQuoteBus" id="getQuote" name="getQuote" value="<?php echo $row; ?>">Search</button>
                                    </div>
                                    <?php } ?>
                                
                                
                            </div>
                            <?php $row++; } } } else{ ?>
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
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" id="infants1" name="infants" value="0">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="buscat" name="selExpcat[]" id="busselExpcat1" value="1">
                                 <input type ="hidden" class="busmode" name="selModeofTransp[]" id="busselModeofTransp1" value="2">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="bustxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-bus<?php echo $row; ?> buscost" name="txtCost[]" id="bustxtCost1" autocomplete="off" onkeyup="valCostPre(this.value,1,2);" onchange="valCostPre(this.value,1);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-bus<?php echo $row; ?>"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary getQuoteBus" id="getQuote" name="getQuote" value="1">Search</button>
                                </div>
                                
                            </div>
                            <?php } ?>
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
                            <?php 
                            $row = 1;
                            if($hstatus){ 
                            foreach($selrequest as $rowrequest)
		                    {
		                    if($rowrequest->MOD_Id == "5"){
		                    $rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rowrequest->RD_Id' AND rd.MOD_Id=mo.MOD_Id");
		                    if($rowRdDetails->MOD_Name=="Hotel")
	                           $hstatus = "readonly";
	                        else
	                           $hstatus = "";
	                        if($hdeparture)
    	                       $hdeparture = date('d-m-Y',strtotime($hdeparture));
    	                       else
    	                       $hdeparture = '';
    	                       if($harrival)
    	                       $harrival = date('d-m-Y',strtotime($harrival));
    	                       else
    	                       $harrival = '';	
                            ?>
                            <div class="row" style="margin:10px 0;">
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="Address" class="form-control fromhote<?php echo $row; ?>" value="<?php echo $rowrequest->RD_Cityfrom;?>" id="fromhotel<?php echo $row; ?>" name="from[]" field="<?php echo $row; ?>">
                                        <label for="from" class="fa fa-h-square" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input class="form-control off pretraveldate hotelDatefrom" name="txtDate[]" value="<?php echo date('d-m-Y',strtotime($hdeparture));?>" id="hotelDatefrom<?php echo $row; ?>" field="<?php echo $row; ?>" type="text" placeholder="Check In">
                                     <label for="from" class="fa fa-calendar" rel="tooltip" title="from"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate hotelDateto" name="dateTohotel[]" value="<?php echo date('d-m-Y',strtotime($harrival));?>" id="hotelDateto<?php echo $row; ?>" field="<?php echo $row; ?>" type="text" placeholder="Check Out">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                       <div class="icon-addon addon-md">
                                          <div id="stayDays" class="form-control"><?php echo $rowrequest->SD_Id; ?></div>
                                      </div>
                                    </div>
                                </div>
                                <input type="hidden" id="children<?php echo $row; ?>" name="children" value="0">
                                <input type="hidden" id="infants<?php echo $row; ?>" name="infants" value="0">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" name="selStayDur[]" id="stay<?php echo $row; ?>">
                                 <input type ="hidden" class="hotelcat" name="selExpcat[]" id="busselExpcat<?php echo $row; ?>" value="2">
                                 <input type ="hidden" class="hotelmode" name="selModeofTransp[]" id="busselModeofTransp<?php echo $row; ?>" value="5">
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="bustxtaExpdesc<?php echo $row; ?>" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"><?php echo $rowrequest->RD_Description;?></textarea>
                                </div>
                                
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-hotel<?php echo $row; ?> hotelcost" <?php echo $hstatus;?> name="txtCost[]" value="<?php echo $rowrequest->RD_Cost;?>" id="bustxtCost<?php echo $row; ?>" autocomplete="off" onkeyup="valCostPre(this.value,<?php echo $row; ?>,5);" onchange="valCostPre(this.value,<?php echo $row; ?>,5);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-hotel<?php echo $row; ?>"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                
                                    <?php if($row>1){ ?>
                                    <div class="col-md-1 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary" id="getQuote" name="getQuote" value="<?php echo $row; ?>" disabled><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger"  id="deleteRowbutton" value="<?php echo $rowrequest->RD_Id; ?>" name="deleteRowbutton" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                    <?php } else{ ?>
                                    <div class="col-md-1 col-sm-12 col-xs-12" style="padding-left: 5px; padding-right: 0px;">
                                    <button type="button" class="btn btn-primary" id="getQuote" name="getQuote" value="<?php echo $row; ?>" disabled>Search</button>
                                    </div>
                                    <?php } ?>
                                
                                
                            </div>
                            <?php $row++; } } } else{ ?>
                            
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
                            
                            <?php } ?>
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
                            <?php 
                            $row = 1;
                            if($cstatus){ 
                            foreach($selrequest as $rowrequest)
		                    {
		                    if($rowrequest->MOD_Id == "3"){
		                         $rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rowrequest->RD_Id' AND rd.MOD_Id=mo.MOD_Id");
		                         if($rowRdDetails->MOD_Name=="Car")
    	                           $cstatus = "readonly";
    	                         else
    	                           $cstatus = "";   
                            ?>
                            <div class="row" style="margin:10px 0;">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input type="text" placeholder="Pickup From" class="form-control fromcar" value="<?php echo $rowrequest->RD_Cityfrom; ?>" id="fromcar<?php echo $row; ?>" name="from[]" field="<?php echo $row; ?>">
                                        <label for="from" class="fa fa-car" rel="tooltip" title="from"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                     <input class="form-control off pretraveldate carDatefrom" name="txtDate[]" id="carDatefrom<?php echo $row; ?>" value="<?php echo date('d-m-Y',strtotime($rowrequest->RD_Dateoftravel)); ?>" field="<?php echo $row; ?>" type="text" placeholder="Pickup Date">
                                     <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                     </div>
                                </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off time-pick carpicktime" name="pickup[]" id="carpicktime1" value="<?php echo $rowrequest->pickup; ?>" field="1" type="text" placeholder="Pickup Time">
                                            <label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off pretraveldate carDateto" name="dateTohotel[]" value="<?php echo date('d-m-Y',strtotime($rowrequest->RD_EndDate)); ?>" id="carDateto<?php echo $row; ?>" field="<?php echo $row; ?>" type="text" placeholder="Drop-off Date">
                                            <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                            <input class="form-control off time-pick cardroptime" name="dropoff[]" value="<?php echo $rowrequest->dropoff; ?>" id="cardroptime<?php echo $row; ?>" field="<?php echo $row; ?>" type="text" placeholder="Drop-off Time">
                                            <label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="children<?php echo $row; ?>" name="children" value="0">
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" id="infants<?php echo $row; ?>" name="infants" value="0">
                                <input type="hidden" name="selStayDur[]" value="">
                                 <input type ="hidden" class="carcat" name="selExpcat[]" id="busselExpcat<?php echo $row; ?>" value="1">
                                 <input type ="hidden" class="carmode" name="selModeofTransp[]" id="busselModeofTransp<?php echo $row; ?>" value="3">
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <textarea name="txtaExpdesc[]" id="cartxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"><?php echo $rowrequest->RD_Description; ?></textarea>
                                </div>
                                
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-md">
                                        <input class="form-control exceed-car<?php echo $row; ?> carcost" name="txtCost[]" <?php echo $cstatus; ?> value="<?php echo $rowrequest->RD_Cost; ?>" id="cartxtCost<?php echo $row; ?>" autocomplete="off" onkeyup="valCostPre(this.value,<?php echo $row; ?>,3);" onchange="valCostPre(this.value,<?php echo $row; ?>,3);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-car<?php echo $row; ?>"></span>
                                        <label for="total" class="fa fa-inr" rel="tooltip" title="total"></label>
                                        </div>
                                </div>
                                </div>
                                
                                
                                    <?php if($row>1){ ?>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="padding-left: 5px; padding-right: 0px;">
                                    <button type="button" class="btn btn-primary btn-block" id="getQuote" name="getQuote" value="<?php echo $row; ?>" disabled><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger"  id="deleteRowbutton" value="<?php echo $rowrequest->RD_Id; ?>" name="deleteRowbutton" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                    <?php } else{ ?>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-primary btn-block" id="getQuote" name="getQuote" value="<?php echo $row; ?>" disabled>Search</button>
                                    </div>
                                    <?php } ?>
                                
                                
                            </div>
                            <?php $row++; } } } else { ?>
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
                                <input type="hidden" name="dateTohotel[]" value="">
                                <input type="hidden" name="flightReturn[]" value="">
                                <input type="hidden" id="infants1" name="infants" value="0">
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
                            <?php } ?>
                            </div>
                                
                                <!-- Add or Remove Rows -->
                                <div class="col-md-12 pull-right bdr_tb">
                                   <button class="btn btn-success btn-sm" id="add-row-car">Add +</button>
                                   <span id="carrbtncontainer"></span>
                                </div>
                        </div>
                        <!-- car Content End -->
                        <div class="row">
                            <div class="col-md-3 col-md-push-9" style="margin-left: -1%;">
                                <div class="form-group">
                                    <div class="icon-addon addon-md">
                                    <input class="form-control" readonly id="totaltable" autocomplete="off" type="text" value="<?php echo $totalcost; ?>" placeholder="Grand Total"></label><span class="red" id="show-exceed3">
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
	<input type="hidden" value="1" name="addnewrequest" id="addnewrequest" />
	<input type="hidden" value="<?php echo $reqid; ?>" name="reqid" />
	<input type="hidden" name="rowCount" id="rowCount" value="<?php echo $rows; ?>">
	<input type="hidden" value="<?php echo $empuserid ?>" name="selEmployees" id="selEmployees" />
	<input type="hidden" name="action" id="traveldesk_request_edit" value="traveldesk_request_edit">
	<input type="hidden" name="ImageUrl" id="ImageUrl" value="<?php echo WPERP_EMPLOYEE_ASSETS;?>">
         <div id="quotefieldsid">
        	<input type="hidden" name="sessionid[]" value="<?php echo time(); ?>" class="erase1" id="sessionid1"/>
        	<input type="hidden"  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected1" class="erase1"/>
        	<input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered1" class="erase1"/>
         </div>
         </span>
         <span id="totaltable"></span>
         </div>
         <!--buttons--> 
         <div class="container-fluid create-btn-tab">
            <div class="col-md-12" style="text-align:center;">
               <button class="btn btn-success btn-md" value="Update" name="submit" id="submit-pre-travel-request" type="submit">Submit</button>
               <button class="btn btn-warning btn-md" name="reset" id="reset">Reset</button>
            </div>
         </div>
         <!--buttons-->
         <!-- selected quote -->
         <div id="selected_quote" style="margin-top:30px;">
         <?php 
         $qrow = 1;
         foreach($rdidarry as $rdid){	?>
        <?php	
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	
		if(count($selrgquote)){			
	                                        
		if($rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")){

	    ?>
	    
	        <?php if($rowRdDetails->MOD_Name=="Flight") { ?>
            <div id="quoteContentflight<?php echo $qrow; ?>" class="quote-row-flight">
            <div class="container-fluid pgbg flight<?php echo $qrow; ?>">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span></div>
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo date('d-m-Y',strtotime($rowRdDetails->RD_Dateoftravel));?><?php if($freturn){echo  " " ."|" . " " .  $freturn; }?></span>  </div>
               </div>
               
               <div class="row flight-content<?php echo $qrow; ?>" style="background-color:#fff;" >
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
 	    </div>
 	    <?php $qrow++; } ?>
 	    <?php } ?>
 	    <?php } ?>
	    <?php } ?>
 	    
 	    <?php 
         $qrow = 1;
         foreach($rdidarry as $rdid){	?>
        <?php	
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	
		if(count($selrgquote)){			
	                                        
		if($rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")){

	    ?>
 	    <?php if($rowRdDetails->MOD_Name=="Hotel") { ?>
 	    <div id="quoteContenthotel<?php echo $qrow; ?>" class="quote-row-hotel">
            <div class="container-fluid pgbg hotel">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-hospital-o planefa " aria-hidden="true" ></i><span class="gclr 22fnt">HOTELS</span> </div>
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"> BLR - MAA </span>  </div>
                  <div class="col-sm-4 col-md-4 pt10"><i class="fa fa-calendar mapfa" aria-hidden="true"></i><span class="18fnt">12 , Apr 2017 </span>  </div>
               </div>
               <div class="row hotel-content2" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ ?>
                  <div class="col-sm-2 col-md-2 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-2 pt15 pb15 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3">Spice jet</span> <br> <span class="splane quote-dep3"> Dep.12.45 AM </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">2000</span></span></div>
               <?php } ?>
               </div>
            </div>
 	    </div>
 	    <?php $qrow++; } ?>
 	    <?php } ?>
 	    <?php } ?>
	    <?php } ?>
 	    <?php 
         $qrow = 1;
         foreach($rdidarry as $rdid){	?>
        <?php	
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	
		if(count($selrgquote)){			
	                                        
		if($rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")){

	    ?>
 	    <?php if($rowRdDetails->MOD_Name=="Bus") { ?>
 	    <div id="quoteContentbus<?php echo $qrow; ?>" class="quote-row-bus">
            <div class="container-fluid pgbg bus<?php echo $qrow; ?>">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div>
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo $rowRdDetails->RD_Dateoftravel;?> </span>  </div>
               </div>
               <div class="row bus-content<?php echo $qrow; ?>" style="background-color:#fff;" >
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
 	    </div>
 	    <?php $qrow++; } ?>
 	    <?php } ?>
 	    <?php } ?>
	    <?php } ?>
	     
	    </div>
	    </div>
         <!-- selected quote -->
         </form>
                </div>
                </div><!-- .postbox -->

              
        </div>
        </div>
<div style="margin-top:20px" id="grade-limit" class="postbox leads-actions closed">
                    <div class="handlediv" title="<?php _e( 'Click to toggle', 'erp' ); ?>"><br></div>
                    <h3 class="hndle"><span><?php _e( 'Grade Limits', 'erp' ); ?></span></h3>
                    <div class="inside">
                       <!-- Grade Limits -->
                       <?php _e(gradeLimits($empuserid));?>
                    </div>
    </div>
</div>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/js/quote/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
