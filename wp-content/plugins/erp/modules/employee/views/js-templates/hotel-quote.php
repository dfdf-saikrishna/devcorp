<style>
html, body {
    width:100%;
    height: 100%;
}
#header {
    width: 100%;
    height: 20%;
    float: left;
    
}
#map {
    width: 80%;
    height: 80%;
    float: right;
    
}
#sidebar {
    background-color: #f6f9fc;
    border: 1px solid #d4dee5;
    border-radius: 4px 4px 0px 0px;
    margin-bottom: 5px;
    border-bottom-width: 3px;
    font-size: 12px;
    color: #333;
    padding: 10px 0px 0px 20px;
    width: 20%;
    height: 80%;
    float: left;
   
    height: 80%;
    float: left;
   
}
#toggle {
    /*width: 10%;
    height: 40%;
    margin-right: -3.5%;
    margin-top: 0.5%;
    float: right;
}
table thead {
    height: 40px;
    background-color: #f6f9fc;
    border: 1px solid #d4dee5;
    border-radius: 4px 4px 0px 0px;
    margin-bottom: 5px;
    border-bottom-width: 3px;
    font-size: 12px;
    color: #333;
    padding: 10px 0px 0px 20px;
}
*/
table tr {
    height: 40px;
    background-color: #f6f9fc;
    border: 1px solid #d4dee5;
    border-radius: 4px 4px 0px 0px;
    margin-bottom: 5px;
    border-bottom-width: 3px;
    font-size: 12px;
    color: #333;
    padding: 10px 0px 0px 20px;
}
#header{
background: #2b3244 !important;
}
.modifySearch .container .fromTo {
    display: inline-block;
    vertical-align: middle;
    width: 50%;
    border-right: 1px solid #182732;
}
.modifySearch .container .fromTo .labl {
    display: inline-block;
    vertical-align: middle;
    padding: 5px;
}
.modifySearch .container .fromTo .flightLogo {
    /*width: 13%;*/
}
.modifySearch .container .fromTo .labl.onw, .modifySearch .container .fromTo .labl.dest {
    /*width: 42%;*/
}
.modifySearch .container .datePax {
    display: inline-block;
    //vertical-align: middle;
    //width: 61%;
    padding-left: 5px;
}
.modifySearch .container .fromTo .labl .city {
    font-weight: 400;
    font-size: 14px;
    color: #ffffff;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    padding-bottom: 15px;
}
.modifySearch .container .datePax .labl .dateLabl .dt {
    font-weight: 400;
    font-size: 14px;
    color: #ffffff;
    margin:15px 32px 36px 16px;
}
.modifySearch{
}
.ui-slider .ui-slider-handle{
    width:24px !important; 
    height:24px !important; 
	border:none !important; 
	top: -8.1px !important;
    background:url(https://corptne.com/wp-content/plugins/erp/modules/employee/assets/css/searchSprite14.png?v=701466) no-repeat !important; overflow: hidden; 
	background-position: 0px -160px !important;
    position:absolute;
    top: -10px;
    border-style:none; 
}
.ui-slider-horizontal {
    height: .4em !important;
    margin-top: 1em !important;
	margin-bottom: 1em !important;
}
.ui-widget-header {
    background: #39444B !important;
}

.erp-modal .content-container{
position: absolute;
    //top: 17px!important;
    //right: -35px!important;
    bottom: 50px;
    //left: -19px!important;
    overflow: auto;
    padding:19px!important; 
    border-radius: 3px!important;
}
</style>
<link type='text/css' rel='stylesheet' href='https://corptne.com/wp-content/plugins/erp/modules/employee/assets/css/tuxedo.v783101.css' />
<link type='text/css' rel='stylesheet' href='https://corptne.com/wp-content/plugins/erp/modules/employee/assets/css/flights_v2.v783446.css' />
<link type='text/css' rel='stylesheet' href='https://corptne.com/wp-content/plugins/erp/modules/employee/assets/css/hotels_v2.v782701.css' />

<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="thead-inverse">
      <tr>
        <th><img src="https://corptne.com/wp-content/plugins/erp/modules/employee/assets/images/hotel.png" width="24"> Location :Chennai</th>
        <th><img src="https://corptne.com/wp-content/plugins/erp/modules/employee/assets/images/calendar.png"  width="24"> Check-In : 29-09-2017</th>
        <th><img src="https://corptne.com/wp-content/plugins/erp/modules/employee/assets/images/calendar.png"  width="24"> Check-Out: 29-09-2017</th>
      </tr>
    </thead>
    <tbody>
      <tr>
	  <!-- Sidebar start -->
        <td width="25%">
		<div class="theiaStickySidebar" style="padding-top: 1px; padding-bottom: 1px; position: static; top: 0px; left: 104.5px;padding-left:15px;"><div class="stickyFilters">
					<div class="glassShield" style="display:none;"></div>
					<a href="javascript:void(0)" id="closeFilter" class="closeFilter"><i class="close">&nbsp;</i></a>
					<p class="hCount" style="display: block;">
						<!--a style="display: block;" href="javascript:void(0)" class="resetLink fRight">Show all</a-->
						<strong class="resultsCount">{{data.count}}</strong> hotels
					</p>
					
					
					
					
<!-- FORM ENCLOSURE FOR FILTERS -->
<form class="filtersForm">
	<div class="commonFilters">
	
<div data-block-type="nearbyairports" class="block sideBlock closed   " style="display: none;">
	
	<h5>
		<i class="rArrow"></i>Nearby airports
		
	</h5>
	<div class="filterContent clearFix  ">

			<nav class="nearbyairports">
<ul class="list  ">
</ul>




</nav>






	</div>
</div>
<div data-block-type="price" class="block sideBlock opened">
	
	<h5>
		<i class="dArrow showhide"></i><span class="showhide">Price</span>
		
	</h5>
	<input type="hidden" id="minPrice" value="{{data.minprice}}">
	<input type="hidden" id="maxPrice" value="{{data.maxprice}}">
	<input type="hidden" id="session" value="{{data.session}}">
	<div class="filterContent clearFix  ">
		<p class="displayFilterValue clearFix">
			<span class="fLeft" id="upto">Upto <span class="INR" data-pr="12440">Rs.</span>{{data.maxprice}}</span>
			<span class="fRight"></span>
		</p>

		


			<div id="slider-range"></div>

		<p class="displayStaticRange clearFix">
			<span id="amountfrom"><span class="INR" data-pr="2927">Rs.</span>{{data.minprice}}</span>
			<span id="amountto" class="fRight"><span class="INR" data-pr="12440">Rs.</span>{{data.maxprice}}</span>
		</p>

		<input type="hidden" name="price" value="2927-12440">


			<p class="addOnFilter priceLockFilterAddon" style="display: none;">
				<label for="1_1_pricelock">
					<input type="checkbox" name="pricelock" id="1_1_pricelock" class="pricelock">
					Show flights only with Pricelock
				</label>
			</p>

	</div>
</div>

<!-- HOTEL RATING -->
<div data-block-type="starFilter" class="block sideBlock   smartFilters vertical opened">
	
	<a href="javascript:void(0);" class="showAll weak fRight" style="display: none">Show all</a>
	<h5>
		<i class="dArrow showhide"></i><span class="showhide">Star rating</span>
		
	</h5>
	<div class="filterContent clearFix  ">

			<nav class="starFilter">
<ul class="list clearFix inline hotelSmallList">
	<li>
					<input id="1_15" type="checkbox" name="hrating" class="filter" smartfilter="1" value="5">
		<label for="1_15">
					5 star
					<span class="starRating  s5" title="5 Star hotel"></span>
					<span class="fRight weak truncate star5">{{data.hotelstar.five}}</span>

				
				
					
		</label>
	</li>
	<li>
					<input id="1_14" type="checkbox" name="hrating" class="filter" smartfilter="1" value="4">
		<label for="1_14">
					4 star
					<span class="starRating  s4" title="4 Star hotel"></span>
					<span class="fRight weak truncate star4">{{data.hotelstar.four}}</span>

				
				
					
		</label>
	</li>
	<li>
					<input id="1_13" type="checkbox" name="hrating" class="filter" smartfilter="1" value="3">
		<label for="1_13">
					3 star
					<span class="starRating  s3" title="3 Star hotel"></span>
					<span class="fRight weak truncate star3">{{data.hotelstar.three}}</span>

				
				
					
		</label>
	</li>
	<li>
					<input id="1_12" type="checkbox" name="hrating" class="filter" smartfilter="1" value="2">
		<label for="1_12">
					2 star
					<span class="starRating  s2" title="2 Star hotel"></span>
					<span class="fRight weak truncate star2">{{data.hotelstar.two}}</span>

				
				
					
		</label>
	</li>
	<li>
					<input id="1_11" type="checkbox" name="hrating" class="filter" smartfilter="1" value="1">
		<label for="1_11">
					1 star
					<span class="starRating  s1" title="1 Star hotel"></span>
					<span class="fRight weak truncate star1">{{data.hotelstar.one}}</span>

				
				
					
		</label>
	</li>
	<li>
					<input id="1_10" type="checkbox" name="hrating" class="filter" smartfilter="1" value="1">
		<label for="1_10">
					0 star
					<span class="starRating" title="0 Star hotel"></span>
					<span class="fRight weak truncate">{{data.hotelstar.zero}}</span>

				
				
					
		</label>
	</li>
</ul>




</nav>






	</div>
</div>
<!-- TRAVELLER RATING -->
<!--div data-block-type="taStarRating" class="block sideBlock   smartFilters vertical opened">
	
	<h5>
		<i class="dArrow"></i>Traveller rating
		
	</h5>
	<div class="filterContent clearFix  ">

			<nav class="taStarRating">
<ul class="list clearFix inline hotelSmallList">
	<li>
					<input id="1_15-5" type="checkbox" name="taStarRating" smartfilter="1" value="5-5">
		<label for="1_15-5">
					Top rated
					
					  <span class="fRight weak truncate tar5">6</span>
					  <span class="taRating  t5"></span>
					

				
				
					
		</label>
	</li>
	<li>
					<input id="1_14.5-5" type="checkbox" name="taStarRating" smartfilter="1" value="4.5-5">
		<label for="1_14.5-5">
					4.5 and More
					
					  <span class="fRight weak truncate tar45">46</span>
					  <span class="taRating  t45"></span>
					

				
				
					
		</label>
	</li>
	<li>
					<input id="1_14-5" type="checkbox" name="taStarRating" smartfilter="1" value="4-5">
		<label for="1_14-5">
					4 and More
					
					  <span class="fRight weak truncate tar4">119</span>
					  <span class="taRating  t4"></span>
					

				
				
					
		</label>
	</li>
	<li>
					<input id="1_13.5-5" type="checkbox" name="taStarRating" smartfilter="1" value="3.5-5">
		<label for="1_13.5-5">
					3.5 and More
					
					  <span class="fRight weak truncate tar35">212</span>
					  <span class="taRating  t35"></span>
					

				
				
					
		</label>
	</li>
</ul>




</nav>






	</div>
</div-->

<!-- HOTEL TYPE -->
<div data-block-type="propertyType" class="block sideBlock   smartFilters vertical opened">
	
	<a href="javascript:void(0);" class="showAll weak fRight" style="display: none">Show all</a>
	<h5>
		<i class="dArrow showhide"></i><span class="showhide">Property types</span>
		
	</h5>
	<div class="filterContent clearFix  ">

			<nav class="propertyType">
<ul class="list  ">
	<li>
					<input id="1_1BH" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Villa">
		<label for="1_1BH">
					<small class="fRight">{{data.hoteltype.Villa}}</small>

			<span class="span span18 truncate">

				
				Villa
			</span>

		</label>
	</li>
	<li>
					<input id="1_1CTR" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Guest House">
		<label for="1_1CTR">
					<small class="fRight">{{data.hoteltype.GuestHouse}}</small>

			<span class="span span18 truncate">

				
				Guest House
			</span>

		</label>
	</li>
	<li>
					<input id="1_1GH" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Homestay">
		<label for="1_1GH">
					<small class="fRight">{{data.hoteltype.Homestay}}</small>

			<span class="span span18 truncate">

				
				Homestay
			</span>

		</label>
	</li>
	<li>
					<input id="1_1HH" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Hotel">
		<label for="1_1HH">
					<small class="fRight">{{data.hoteltype.Hotel}}</small>

			<span class="span span18 truncate">

				
				Hotel
			</span>

		</label>
	</li>
	<li>
					<input id="1_1NOCAT" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Resort">
		<label for="1_1NOCAT">
					<small class="fRight">{{data.hoteltype.Resort}}</small>

			<span class="span span18 truncate">

				
				Resort
			</span>

		</label>
	</li>
	<li>
					<input id="1_1RS" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Bungalow">
		<label for="1_1RS">
					<small class="fRight">{{data.hoteltype.Bungalow}}</small>

			<span class="span span18 truncate">

				
				Bungalow
			</span>

		</label>
	</li>
	<li>
					<input id="1_1SA" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Service Apartment">
		<label for="1_1SA">
					<small class="fRight">{{data.hoteltype.ServiceApartment}}</small>

			<span class="span span18 truncate">

				
				Service Apartment
			</span>

		</label>
	</li>
	<li>
					<input id="1_1SP" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Lodge">
		<label for="1_1SP">
					<small class="fRight">{{data.hoteltype.Lodge}}</small>

			<span class="span span18 truncate">

				
				Lodge
			</span>

		</label>
	</li>
	<li>
					<input id="1_1C" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="Cottage">
		<label for="1_1C">
					<small class="fRight">{{data.hoteltype.Cottage}}</small>

			<span class="span span18 truncate">

				
				Cottage
			</span>

		</label>
	</li>
	<li>
					<input id="1_1BnB" type="checkbox" data-flt="propertyType" class="filter" name="propertyType" smartfilter="1" value="BnB">
		<label for="1_1BnB">
					<small class="fRight">{{data.hoteltype.BnB}}</small>

			<span class="span span18 truncate">

				
				BnB
			</span>

		</label>
	</li>
</ul>




</nav>






	</div>
</div>

	</div>
</div>

</form>

</div>
		</td>
		<!-- sidebar end-->
        <td colspan="2">
<div class="table-responsive">
<table id="hotelquote" class="wp-list-table widefat striped admins" align="center">
<thead align="center" class="cf thead-inverse">
<tr>
<th colspan="2" width="30%" style="text-align:center;"><strong> Hotel Name</strong></th>
<!--th style="color:#000000;"><strong>Place</strong></th>
<th style="color:#000000;"><strong>Available</strong></th-->
<th	style="text-align:center;"><strong>PRICE</strong></th>
<th style="text-align: center;"><strong>Rating</strong></th>
<th style="text-align:center;"><strong>PREFERED</strong></th>
<th style="text-align: center;"><strong>Select</strong></th>
</tr>
</thead>
<tbody align="center">
<# _.each( data.response, function(res, index) { #>

<tr data-price="{{res.GQF_Price}}" data-type="{{res.GQF_AirlineCode}}">
<td><div style="width:100px;"><img  src="{{res.GQF_FlightNumber}}"</img><div></td>
<!--td data-title="BUS" style="padding-left:20px;text-align:center;">{{res.GQF_AirlineName}}</td>
<td data-title="BUS" style="padding-left:20px;text-align:center;">{{res.location}}</td-->                                                   
<td data-title="BUS" style="padding-left:20px;text-align:center;"><b>{{res.GQF_Stops}}</b></td>
<td data-title="BUS" style="padding-left:20px;text-align:center;"><b>{{res.GQF_Price}}</b></td>
<td data-title="BUS" style="padding-left:20px;text-align:center;"><b>{{res.hotelrating}}</b><span> Star</span></td>
<td data-title="Open" style="text-align:center;"><input type="radio" name="prefered" value="{{res.GQF_Id}},{{res.GQF_Price}}"></td>                                               
<td data-title="PREFERED"><input name="cbGqfid[]" style="margin-left: 20px;" id="cbGqfid[]" type="checkbox" value="{{res.GQF_Id}}" hotellogo="{{res.GQF_FlightNumber}}" hotelName="{{res.GQF_AirlineName}}" hotelarr="" hotelprice="{{res.GQF_Price}}" hotelId="{{res.GQF_Id}}" class="checkbox"></td>
<td style="display:none;" data-title="hotel" class="text-left" id="quote_price" style="padding-left:20px;">{{res.GQF_AirlineCode}}</td>
<td style="display:none;" data-title="hotel" class="text-left">{{res.location}}</td>
<td style="display:none;" data-title="hotel" class="text-left">{{res.GQF_AirlineName}}</td>
<td style="display:none;" data-title="hotel" class="text-left">{{res.amenities}}</td>
<td style="display:none;" data-title="hotel" class="text-left">{{res.hotelrating}}</td>
<td style="display:none;" data-title="hotel" class="text-left">{{res.hoteltype}}</td>
</tr>


<# }) #>
<div class="noresult" style="display:none;margin-top: 10%;text-align: center;float: center;width: 100%;">

<img src="http://corptne.com/wp-content/plugins/erp/modules/employee/assets/images/hotel.png" width="24" > <span> No results found </span>

</div>
</table>
</div>
		</td>
      </tr>
    </tbody>
  </table>
</div>

<div id="header">

<!--div class="col-md-3"><input type="button" class="button button-primary" data-name="show" value="Filter" id="toggle"></div-->
<div class="modifySearch">

		
			<!--div class="fromTo">
				<div class="labl onw">
					<!--div class="city hotelfrom"><span class="code">HYD</span> Hyderabad</div>
					<!--div class="hotelfrom">Hyderabad</div>
				</div>
				<div class="labl flightLogo">
				
					<div class="onwFltLogo"> <img src="http://corptne.com/wp-content/plugins/erp/modules/employee/assets/images/hotel.png" width="24"> </div>
				
				</div>
				<div class="labl dest">
					<div class="city hotelto"><span class="code">MAA</span> <br/>Chennai</div>
					<!--div class="hotelto">Chennai</div>
				</div>
			
			</div-->
			<!--div class="datePax">
				<div class="labl u_width61">
					
					
					<div class="dateLabl"><span class="calIcon"><img src="http://corptne.com/wp-content/plugins/erp/modules/employee/assets/images/calendar.png" style="
    margin-top: -10px;
    width: 22px;
"> </span><!--
				>
					
					</div>
					
				</div>
				
			</div-->
		

	
	</div>
</div>
</div>



    
</div>
<div id="map">




</div>
<div id="sidebar">





</div>
</div>
</div>
<script>
var $ = jQuery.noConflict();
$(document).ready(function () {
		    var selPrice;
		    var minPrice = $('#minPrice').val();
		    var maxPrice = $('#maxPrice').val();
		    var session = $('#session').val();
		    $(document).on("click", "#toggle", function(){
		        if ($(this).data('name') == 'show') {
		            $("#sidebar").animate({
		                width: '0%'
		            }).hide()
		            $("#map").animate({
		                width: '100%'
		            });
		            $(this).data('name', 'hide')
		        } else {
		            $("#sidebar").animate({
		                width: '20%'
		            }).show()
		            $("#map").animate({
		                width: '80%'
		            });
		            $(this).data('name', 'show')
		        }
		    });
		    $( "#slider-range" ).slider({
			  range: "min",
			  value: parseFloat(maxPrice),
			  min: parseFloat(minPrice),
			  max: parseFloat(maxPrice),
			  slide: function( event, ui ) {
				$( "#upto" ).html('Upto <span class="INR" data-pr="'+$( "#slider-range" ).slider( "values", 1 )+'">Rs.</span>'+$( "#slider-range" ).slider( "values", 1 ));
			  
			  selPrice = $( "#slider-range" ).slider( "values", 1 );	
			  //Filteration Code
		      		var hrating = $("input[name='hrating']:checked").map(function() {
			        return this.value;
			    	}).get();
			    	var propertyType = $("input[name='propertyType']:checked").map(function() {
			        return this.value;
			    	}).get();
			    	var amenity = $("input[name='amenity']:checked").map(function() {
			        return this.value;
			    	}).get();
			    	
				$("#hotelquote").find("tbody tr").hide();

    				if(hrating.length!=0 && propertyType.length!=0 && amenity.length!=0){
	    				$.each( hrating, function(index1, char1){
					    $.each( propertyType, function(index2, char2){
					        $.each( amenity, function(index3, char3){
					
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "')):has(td:nth-child(14):contains('" + char2 + "')):has(td:nth-child(12):contains('" + char3 + "'))").show();
					            
					
					        });
					    });
					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })

	       				    .hide();
    				}
    				
    				else if(hrating.length!=0 && propertyType.length!=0){
	    				$.each( hrating, function(index1, char1){					    
					        $.each( propertyType, function(index3, char3){
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "')):has(td:nth-child(14):contains('" + char3 + "'))").show();
					            
					   
					        });
					    
					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })
	       				    .hide();
    				}
    				
    				else if(hrating.length!=0 && amenity.length!=0){
	    				$.each( hrating, function(index1, char1){					    
					        $.each( amenity, function(index3, char3){
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "')):has(td:nth-child(12):contains('" + char3 + "'))").show();
					            
					   
					        });
					    
					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })
	       				    .hide();
    				}
    				
    				else if(propertyType.length!=0 && amenity.length!=0){
	    				$.each( propertyType, function(index1, char1){					    
					        $.each( amenity, function(index3, char3){
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(14):contains('" + char1 + "')):has(td:nth-child(12):contains('" + char3 + "'))").show();
					            
					   
					        });
					    
					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })
	       				    .hide();
    				}
    				
    				else if(hrating.length!=0){
	    				$.each( hrating, function(index1, char1){					    

					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "'))").show();

					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })
	       				    .hide();
    				}
    				
    				else if(amenity.length!=0){
	    				$.each( amenity, function(index1, char1){					    

					            $("#hotelquote").find('tr').filter(":has(td:nth-child(12):contains('" + char1 + "'))").show();

					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })
	       				    .hide();
    				}
    				
    				else if(propertyType.length!=0){
	    				$.each( propertyType, function(index1, char1){					    

					            $("#hotelquote").find('tr').filter(":has(td:nth-child(14):contains('" + char1 + "'))").show();

					})
					//Filter Price
	       				var c= selPrice;
	    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  
					    
					  //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return false;
					      }
					      if(c=="all"){
					          return false;
					      }
					        return true;
					    })
	       				    .hide();
    				}
    			
       				 else{
       				 	var c= selPrice;
    			  
					   //get all trs from tbody
					  var trs = $("#hotelquote").find("tbody tr");
					  trs.hide();
					    
					    //Filter all trs from tbody
					  trs.filter(function (i, v) {
					      if ($(this).data("price") <= c) {
					          return true;
					      }
					      if(c=="all"){
					          return true;
					      }
					        return false;
					    })
					  //just show the row if it fits the criteria
					    .show();
       				 }

                            // var results = $('tr:visible').length-8;
			    $('.resultsCount').html($('tr:visible').length-8);
                            
                            
			  /*
			  wp.ajax.send('get-pricerange-hotel', {
                            data: {
                                session: session,
                                selprice: selPrice,
                                minprice: minPrice,
                                maxprice: maxPrice,
                                
                            },
                            success: function (response) {
                                console.log(response);
                            	var html = wp.template('hotel-get-quote')(response);
                            	$('.content').html(html);
                            },
                            error: function (response) {
                            	console.log(response);
                            },
	                  });
			  */
			  
			   //var response = $( "#slider-range" ).slider( "values", 1 );
			   //var html = wp.template('hotel-get-quote')(response);
                           //$('.content').html(html);
			 
			  		
			  }
			});
			$( "#upto" ).html('Upto <span class="INR" data-pr="'+$( "#slider-range" ).slider( "values", 1 )+'">Rs.</span>'+$( "#slider-range" ).slider( "values", 1 ));
			$( "#amountfrom" ).html('<span class="INR" data-pr="'+$( "#slider-range" ).slider( "values", 1 )+'">Rs.</span>'+minPrice);
			$( "#amountto" ).html('<span class="INR" data-pr="'+$( "#slider-range" ).slider( "values", 1 )+'">Rs.</span>'+maxPrice);
			
			$(document).on("click", ".showhide", function(){
			  if ($(this).parent().parent().hasClass("opened")) {
				  $(this).parent().parent().removeClass("opened");
				  $(this).parent().parent().addClass("closed");
				  $(this).parent().find("i").toggleClass("dArrow rArrow");
			  }
			  else if ($(this).parent().parent().hasClass("closed")) {
				  $(this).parent().parent().removeClass("closed");
				  $(this).parent().parent().addClass("opened");
				  $(this).parent().find("i").toggleClass("rArrow dArrow");
			  }
			});
			//hotel-type
			/*
			$("input[name='hotelType']").change(function() {
			    var checkedValues = $("input[name='hotelType']:checked").map(function() {
			        return this.value;
			    }).get();
			    $("#hotelquote").find("tbody tr").hide();
			    for (var i = 0; i < checkedValues.length; i++) {
			        console.log(checkedValues);
			        $("#hotelquote").find("tbody tr td:contains('" + checkedValues[i] + "')").parent("tr").show();
			    }
			     
			});
			$("input[name='hotels']").change(function() {
			    var checkedValues = $("input[name='hotels']:checked").map(function() {
			        return this.value;
			    }).get();
			    $("#hotelquote").find("tbody tr").hide();
			    for (var i = 0; i < checkedValues.length; i++) {
			        $("#hotelquote").find("tbody tr td:contains('" + checkedValues[i] + "')").parent("tr").show();
			    }
			    
			});
			$("input[name='timeslot']").change(function() {
			    var checkedValues = $("input[name='timeslot']:checked").map(function() {
			        return this.value;
			    }).get();
			    $("#hotelquote").find("tbody tr").hide();
			    
			    for (var i = 0; i < checkedValues.length; i++) {
			        $("#hotelquote").find("tbody tr td:contains('" + checkedValues[i] + "')").parent("tr").show();  
			    }
			    
			});*/
			
			
			$(".filter").change(function() {
				//Filteration Code
				var hrating = $("input[name='hrating']:checked").map(function() {
			        return this.value;
			    	}).get();
			    	var propertyType = $("input[name='propertyType']:checked").map(function() {
			        return this.value;
			    	}).get();
			    	var amenity = $("input[name='amenity']:checked").map(function() {
			        return this.value;
			    	}).get();
			    	
				$("#hotelquote").find("tbody tr").hide();
    				if(hrating.length!=0 && propertyType.length!=0 && amenity.length!=0){
	    				$.each( hrating, function(index1, char1){
					    $.each( propertyType, function(index2, char2){
					        $.each( amenity, function(index3, char3){
							
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "')):has(td:nth-child(14):contains('" + char2 + "')):has(td:nth-child(12):contains('" + char3 + "'))").show();
					            
					
					        });
					    });
					})
					
    				}
    				
    				else if(hrating.length!=0 && propertyType.length!=0){
	    				$.each( hrating, function(index1, char1){					    
					        $.each( propertyType, function(index3, char3){
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "')):has(td:nth-child(14):contains('" + char3 + "'))").show();
					            
					   
					        });
					    
					})
					
    				}
    				
    				else if(hrating.length!=0 && amenity.length!=0){
	    				$.each( hrating, function(index1, char1){					    
					        $.each( amenity, function(index3, char3){
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "')):has(td:nth-child(12):contains('" + char3 + "'))").show();
					            
					   
					        });
					    
					})
					
    				}
    				
    				else if(propertyType.length!=0 && amenity.length!=0){
	    				$.each( propertyType, function(index1, char1){					    
					        $.each( amenity, function(index3, char3){
					            //var combination = char1 + char2 + char3; // Will give you "aaa", then "aab", then "aac"...
					            
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(14):contains('" + char1 + "')):has(td:nth-child(12):contains('" + char3 + "'))").show();
					            
					   
					        });
					    
					})
					
    				}
    				
    				else if(hrating.length!=0){
	    				$.each( hrating, function(index1, char1){					    
					            $("#hotelquote").find('tr').filter(":has(td:nth-child(13):contains('" + char1 + "'))").show();

					})
					
    				}
    				
    				else if(amenity.length!=0){
	    				$.each( amenity, function(index1, char1){					    

					            $("#hotelquote").find('tr').filter(":has(td:nth-child(12):contains('" + char1 + "'))").show();

					})
					
    				}
    				
    				else if(propertyType.length!=0){
	    				$.each( propertyType, function(index1, char1){					    

					            $("#hotelquote").find('tr').filter(":has(td:nth-child(14):contains('" + char1 + "'))").show();

					})
					
    				}
    				
       				//Filter Price
       				if(selPrice){
       				var c= selPrice;
    			  
				   //get all trs from tbody
				  var trs = $("#hotelquote").find("tbody tr");
				  
				    
				  //Filter all trs from tbody
				  trs.filter(function (i, v) {
				      if ($(this).data("price") <= c) {
				          return false;
				      }
				      if(c=="all"){
				          return false;
				      }
				        return true;
				    })
       				    .hide();
       				  }
			    	$('.resultsCount').html($('tr:visible').length-8);
			});
		

	}); 
</script>