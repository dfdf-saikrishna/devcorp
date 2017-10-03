<!--link rel="stylesheet" href="segments.css" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"-->
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
   .search-tabs{
    background: #FFF;   
   }
   .widefat td, .widefat th {
    //line-height: 376%;
    }
    #poststuff{
        background:none !important;
    }
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

    <!-- MetisMenu CSS -->
    <link href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" id="icomoon-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
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
            $approver_total+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename,0);
            $approver_approved+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=2 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename); 
            $approver_pending+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=1 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);  
            $approver_rejected+=count_query("employees emp, requests req, request_employee re","DISTINCT req.REQ_Id","WHERE emp.EMP_Reprtnmngrcode='$rprcode' AND emp.EMP_Id != '$empID' AND req.REQ_Id=re.REQ_Id AND emp.EMP_Id=re.EMP_Id AND req.REQ_Status=3 AND req.REQ_Active !=9 AND re.RE_Status=1 AND emp.EMP_Status=1 AND emp.EMP_Access=1",$filename);  
         }              
   $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'My_Expense_request';
if(isset($_GET['tab'])) $active_tab = $_GET['tab']; 
     
?>
<div class="wrap erp hrm-dashboard">

    <h2>Reports</h2>
    
    
	<?php echo do_shortcode('[horizontal-scrolling group="GROUP1"]'); ?><br>
<style type="text/css">
		
		
		ul.tab {
		    list-style-type: none;
		    margin: 0;
		    overflow:hidden;
			padding-top:9px;
			padding-bottom:0;
		    //background-color: #fff;
		
			line-height: inherit;
		
		}
		ul.tab:after{
			 position: absolute;
		  content: "";
		  width: 100%;
		  bottom: 0;
		  left: 0;
		    z-index: 1;
			  
		}
		
		/* Float the list items side by side */
		ul.tab li {float: left;}
		
		/* Style the links inside the list items */
		ul.tab li a {
		    display: inline-block;
		    color: black;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		    transition: 0.3s;
		   font-size:17px;
			  
				
		
		}
		li a:focus, .active{
		   
		   //background-color:#fff;
		}
		.show{
			background-color:#ddd;
		}
		
		/* Change background color of links on hover */
		
		.inactive{
			background-color:#ddd;
		}
		
		
		/* Style the tab content */
		.tabcontent {
		    display: none;
		    padding: 6px 12px;
		    border-top: none;
			
		}
		
		 select#wgmstr {
    max-width: 50px;
    min-width: 50px;
    width: 50px !important;
}
		.tab.active {
		    display:block;
			  
		}
		 a.active{
			 //background: #FFFFFF !important;
		     border-bottom:3px solid #0096A8 !important;
			 color:#0096A8 !important;
			 
		 }
		</style>   
		
	


     
<div class="container" style="
    background-color: #fff;
">
<div class="row">
<div class="col-sm-5 col-md-5 col-xs-10">
<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    var j = jQuery.noConflict();
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          
          ['Total Reimbursements', 3],
          ['Total Claims', 1],
        ]);

        // Set chart options
        var options = {'title':'Self','legend':'bottom',
		colors: ['#0095A9' , '#FFBA00'],
		
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	  
	  
	  j(window).resize(function(){
	  	drawChart();
	  	drawChart1();
	});
	 
    </script>
  

  
    <!--Div that will hold the pie chart-->
    <div id="chart_wrap">
    <div id="chart_div"></div>
</div>
  



</div>

<div class="col-sm-5 col-md-5 col-xs-10">
<!--Load the AJAX API-->
    <!--script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script-->
    <script type="text/javascript">
      var j = jQuery.noConflict();
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
    
	  google.charts.setOnLoadCallback(drawChart1);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart1() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          
          ['Total Reimbursements', 3],
          ['Total Claims', 1],
        ]);

        // Set chart options
        var options = {'title':'Team','legend':'bottom',
		colors: ['#0095A9' , '#FFBA00'],
		 
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }
	 
	   j(window).resize(function(){
	  	drawChart();
	  	drawChart1();
	});
	  
    </script>
  

  
    <!--Div that will hold the pie chart-->
   <div id="chart_wrap">
    <div id="chart_div1"></div>
</div>
  



</div>


</div>
<div>
<style>

#chart_div , #chart_div1{
         width:80%;
    min-height:450px;
    }

@media screen and (max-width: 320px) {
    #chart_div , #chart_div1{
         width:180px !important;
    min-height:150px;
    }
}

</style>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo WPERP_EMPLOYEE_ASSETS ?>/js/quote/bootstrap.js"></script>
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
		var inputs = $(this).closest('span').find(':input');
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
		var inputs = $(this).closest('span').find(':input');
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
		var inputs = $(this).closest('span').find(':input');
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
		var inputs = $(this).closest('span').find(':input');
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
		var inputs = $(this).closest('span').find(':input');
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
   var $ = jQuery.noConflict();
   $( document ).ready(function(){
      	   /*var fligtCost = document.getElementById('txtCost1').value;
	   var hotelCost = document.getElementById('txtCost2').value;
	   var busCost = document.getElementById('txtCost3').value;
	   if(fligtCost)
	   valCostPre(fligtCost,1,1);
	   if(hotelCost)
	   valCostPre(hotelCost,2,5);
	   if(busCost)
	   valCostPre(busCost,3,2);*/
   
     $('.roundtrip').click(function(){
     $('.return-date').show();
     $('.controls').hide();
     });
     $('.hide-roundtrip').click(function(){
     $('.return-date').hide();
     $('.controls').hide();
     });
     $('.show-controls').click(function(){
     $('.return-date').hide();
     $('.controls').show();
     });
     $('.mobile').click(function(){
     $('#mobile').show();
     $('#datacard').hide();
     $('#postpaid').hide();
     });
     $('.datacard').click(function(){
     $('#mobile').hide();
     $('#datacard').show();
     $('#postpaid').hide();
     });
     $('.postpaid').click(function(){
     $('#mobile').hide();
     $('#datacard').hide();
     $('#postpaid').show();
     });
     
     $("#mobilenum").on('input', function () {
	var mobNum = $("#mobilenum").val();
	wp.ajax.send('get-operator', {
	        data:({mobile:mobNum}),
	        success:function(result){
	        var obj = jQuery.parseJSON(result);
	        var operator = obj.operator_code;
	        var circle = obj.circle_code;
	if(operator == 28){
	opt = "AT"
	}else if(operator == 1){
	opt = "AL"
	}else if(operator == 3){
	opt = "BS"
	}else if(operator == 22){
	opt = "VF"
	}else if(operator == 17){
	opt = "TD"
	}else if(operator == 18){
	opt = "TI"
	}else if(operator == 13){
	opt = "RG"
	}else if(operator == 12){
	opt = "RL"
	}else if(operator == 10){
	opt = "MS"
	}else if(operator == 19){
	opt = "UN"
	}else if(operator == 5){
	opt = "VD"
	}else if(operator == 6){
	opt = "MTM"
	}else if(operator == 20){
	opt = "MTD"
	}else if(operator == 0){
	opt = ""
	}else if(operator == 8){
	opt = "IDX"
	}else if(operator == 17){
	opt = "T24"
	}else if(operator == 18){
	opt = "VC"
	}
	$('#operator').val(opt);  
	$('#circle').val(circle);   
	//$("#viewplans").prop('disabled',false); 
	}
	});    
	});
	
	$("#post-mobile").on('input', function () {
	var mobNum = $("#post-mobile").val();
	wp.ajax.send('get-operator', {
        type:"POST",
        data:({mobile:mobNum}),
        success:function(result){
        var obj = jQuery.parseJSON(result);
        var operator = obj.operator_code;
	if(operator == 28){
	opt = "AT"
	}else if(operator == 1){
	opt = "AL"
	}else if(operator == 3){
	opt = "BS"
	}else if(operator == 22){
	opt = "VF"
	}else if(operator == 17){
	opt = "TD"
	}else if(operator == 18){
	opt = "TI"
	}else if(operator == 13){
	opt = "RG"
	}else if(operator == 12){
	opt = "RL"
	}else if(operator == 10){
	opt = "MS"
	}else if(operator == 19){
	opt = "UN"
	}else if(operator == 5){
	opt = "VD"
	}else if(operator == 6){
	opt = "MTM"
	}else if(operator == 20){
	opt = "MTD"
	}else if(operator == 0){
	opt = ""
	}else if(operator == 8){
	opt = "IDX"
	}else if(operator == 17){
	opt = "T24"
	}else if(operator == 18){
	opt = "VC"
	}
	$('#post-operator').val(opt);     
	}
	}); 
	});
	
	/*
	
	
	$("#recharge-mobile").on('click', function () {
	var mobNum = $("#mobile").val();
	var amount = $("#amount").val();
	var operator = $("#operator").val();
	var rdirect = '/payment/PayUMoney_form.php';
	$.redirect(rdirect, {mobile:mobNum,amount:amount,operator:operator}); 
	});
	
	
	*/
   
   });
   $(function()
   {

       $(document).on('click', '.btn-add', function(e)
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
   		$(this).parents('.voca:first').remove();
   
   		e.preventDefault();
   		return false;
   	});
   	
   	$("input").change(function() {
	  var inputs = $(this).closest('span').find(':input');
	  inputs.eq( inputs.index(this)+ 1 ).focus();
	});
   });
</script>