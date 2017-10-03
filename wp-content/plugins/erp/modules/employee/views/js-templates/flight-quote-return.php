<link href="<?php echo WPERP_EMPLOYEE_ASSETS;?>/css/bus/bus.css" rel="stylesheet" media="screen">

<div class="site-sortableper">

<div class="clearfix"></div>

<div class="row">
	<div class="container-fluid">
		<!-- START: FILTER AREA -->
		<div class="row">
        <div class="col-sm-6">
<div class="sortbar" data-reactid="4">
    <div id="headerSort" class="sort clearfix" data-reactid="5">
        <a class="rate-btn desc hide " data-sortby="dur" data-dir="1" data-reactid="6">
            <!-- react-text: 7 -->Duration
            <!-- /react-text --><i class="hide icon icon-up-arrow" data-reactid="8"></i></a>
        <a class="rate-btn desc city" data-sortby="rating" data-dir="1" data-reactid="9">
            <!-- react-text: 10 --><span class="flightfrom"></span> - <span class="flightto"></span></br>(<span class="dt" style="font-size:12px;"></span>)
            <!-- /react-text --><i class=" icon icon-up-arrow" data-reactid="11"></i></a>
        <a class="dp-btn  " data-sortby="dm" data-dir="1" data-reactid="12">
            <!-- react-text: 13 -->Dep Time
            <!-- /react-text --><i class="fa fa-arrow-down1" id="dep_s" data-reactid="14"></i></a>
        <a class="price-btn  " data-sortby="lowestPrice" data-dir="1" data-reactid="15">
            <!-- react-text: 16 -->Price
            <!-- /react-text --><i class="fa fa-arrow-down" id="price_s" data-reactid="17"></i></a>
    </div><span class="float-line hide" data-reactid="18" style="width: 33.3333%;"></span></div>
<div id="fixed-menu">
<ul class="bus-list sortable">
<# _.each( data.quoteResult.response, function(res, index) { #>
    <# if ( res.Return_Journey=="0" ) { #>
    <div id="parent" data-sort="{{res.GQF_Price}}">
    <li class="ripple bus-item box">
        <div class="hide">
            <div class="first-col first-col-icon">
                <div class="bus-icon icon-3804"></div>
            </div>
        </div>
        <a>
            <div class="hide"><span class="hide"><span class="redeals-icon"></span>
                <!-- react-text: 214 -->RED DEALS
                <!-- /react-text -->
                </span><span class="offer"></span>
                <div class="">
                    <div class=" curr-price">
                        <div class="">
                            <div class="hide">from</div><span class="">INR </span><span class="price">{{res.GQF_Price}}</span></div>
                    </div>
                </div>
            </div>
            <div class="main-bus-item clearfix">
                <div class="col-bus">
                    <div class=" col-bus-1 fl tracking-container"><span class=" icon icon-tracking tracking-icon "><img style="width:50px;" src="<?php echo WPERP_EMPLOYEE_ASSETS;?>/images/AirlineLogo/{{res.GQF_AirlineCode}}.gif"></img></span></div>
                    <div class="col-bus-2 fr">
                        <div class="top-row time-block">
                            <!-- react-text: 228 -->{{res.GQF_DepTIme}}
                            <!-- /react-text -->
                            <!-- react-text: 229 -->-
                            <!-- /react-text --><span class="arrivalTime1">{{res.GQF_ArrTime}}</span><span class="dur-span"><!-- react-text: 232 -->(<!-- /react-text --><!-- react-text: 233 -->{{res.GQF_Duration}} minutes<!-- /react-text --><!-- react-text: 234 -->)<!-- /react-text --></span></div>
                        <div class="mid-row  tvs dotdot">{{res.GQF_AirlineName}} - {{res.GQF_FlightNumber}} </div>
                        <!--<div class="mid-row dotdot bustype">{{res.GQF_FlightNumber}}</div-->
                    </div>
                </div>
                <div class="col-fare fr">
                    <div class="top-row curr-price">
                        <div class="">
                            <div class="hide">from</div><span class="">INR </span><span class="">{{res.GQF_Price}}</span></div>
                    </div>
                    <div class="hide">
                        <div class="curr-price clearfix">
                            <div class="hide">
                                <div class="hide">from</div><span class="">INR </span>
                                <!-- react-text: 248 -->{{res.GQF_Price}}
                                <!-- /react-text -->
                            </div>
                        </div>
                    </div>
                    <!--<div class="mid-row seats-row">
                        <!-- react-text: 250 -->{{res.GQF_Stops}}
                        <!-- /react-text -->
                        <!-- react-text: 251 -->
                        <!-- /react-text --><!--<span>Seat(s)</span></div>-->
                    <div class="bot-row">
                        <div class="rating-sortableper hide">
                            <div class="hide no-ratings">No ratings</div>
                            <div class=" star-container "><span class="icon icon-star2 star-background"></span><span class="icon icon-star2 star-foreground" style="width: 92%;"></span></div>
                        </div>
                        <div class="rating-badge">
				<span class="badge-span green-badge1">
					<input type="radio" name="prefered" style="margin-top: -3px;" value={{res.GQF_Id}},{{res.GQF_Price}}>
					<span>Prefered</span>
				</span>
				<span class="badge-span yellow-badge1">
					<input name="cbGqfid[]" style="margin-top:0px;" id="cbGqfid[]" type="checkbox" flightId="{{res.GQF_Id}}" flightprice="{{res.GQF_Price}}" flightdep="{{res.GQF_DepTIme}}" flightarr="{{res.GQF_ArrTime}}" flightName="{{res.GQF_AirlineName}}" flightlogo="{{res.GQF_AirlineCode}}" value="{{res.GQF_Id}}" class="checkbox">
					<span>Select</span>
				</span>
			</div>
			<div class="hide no-ratings hide">No ratings</div>
                    </div><span class="mid-row fr tracking-container hide "><!-- react-text: 266 --> <!-- /react-text --><span class=" icon icon-tracking tracking-icon"></span>
                    <!-- react-text: 268 -->Live Tracking
                    <!-- /react-text -->
                    </span>
                </div>
            </div>
            <div class="pastTrip hide"><span class="icon icon-history"></span>
                <!-- react-text: 271 -->You have booked this bus in the past
                <!-- /react-text -->
            </div>
            <div class="ZCaFe hide"><span class="icon icon-zcf"></span><span class="zcf-text">Free Cancellation</span><span><!-- react-text: 276 --> till <!-- /react-text --></span></div>
        </a>
    </li>
    </div>
    <# } #>
<# }) #>    
</ul>
</div>


</div>
<!--test roundtrip -->

<div class="col-sm-6">
<div class="sortbar" data-reactid="4">
    <div id="headerSort" class="sort clearfix" data-reactid="5">
        <a class="rate-btn desc hide " data-sortby="dur" data-dir="1" data-reactid="6">
            <!-- react-text: 7 -->Duration
            <!-- /react-text --><i class="hide icon icon-up-arrow" data-reactid="8"></i></a>
        <a class="rate-btn desc city" data-sortby="rating" data-dir="1" data-reactid="9">
            <!-- react-text: 10 --><span class="flightto"></span> - <span class="flightfrom"></span></br>(<span class="dtr" style="font-size:12px;"></span>)
            <!-- /react-text --><i class=" icon icon-up-arrow" data-reactid="11"></i></a>
        <a class="dp-btn  " data-sortby="dm" data-dir="1" data-reactid="12">
            <!-- react-text: 13 -->Dep Time
            <!-- /react-text --><i class="fa fa-arrow-down1" id="dep_s" data-reactid="14"></i></a>
        <a class="price-btn  " data-sortby="lowestPrice" data-dir="1" data-reactid="15">
            <!-- react-text: 16 -->Price
            <!-- /react-text --><i class="fa fa-arrow-down" id="price_s" data-reactid="17"></i></a>
    </div><span class="float-line hide" data-reactid="18" style="width: 33.3333%;"></span></div>
<div id="fixed-menu">
<ul class="bus-list sortable">
<# _.each( data.quoteResult.response, function(res, index) { #>
    <# if ( res.Return_Journey=="1" ) { #>
    <div id="parent" data-sort="{{res.GQF_Price}}">
    <input type="hidden" id="return" value="true">
    <li class="ripple bus-item box">
        <div class="hide">
            <div class="first-col first-col-icon">
                <div class="bus-icon icon-3804"></div>
            </div>
        </div>
        <a>
            <div class="hide"><span class="hide"><span class="redeals-icon"></span>
                <!-- react-text: 214 -->RED DEALS
                <!-- /react-text -->
                </span><span class="offer"></span>
                <div class="">
                    <div class=" curr-price">
                        <div class="">
                            <div class="hide">from</div><span class="">INR </span><span class="price">{{res.GQF_Price}}</span></div>
                    </div>
                </div>
            </div>
            <div class="main-bus-item clearfix">
                <div class="col-bus">
                    <div class=" col-bus-1 fl tracking-container"><span class=" icon icon-tracking tracking-icon "><img style="width:50px;" src="<?php echo WPERP_EMPLOYEE_ASSETS;?>/images/AirlineLogo/{{res.GQF_AirlineCode}}.gif"></img></span></div>
                    <div class="col-bus-2 fr">
                        <div class="top-row time-block">
                            <!-- react-text: 228 -->{{res.GQF_DepTIme}}
                            <!-- /react-text -->
                            <!-- react-text: 229 -->-
                            <!-- /react-text --><span class="arrivalTime1">{{res.GQF_ArrTime}}</span><span class="dur-span"><!-- react-text: 232 -->(<!-- /react-text --><!-- react-text: 233 -->{{res.GQF_Duration}} minutes<!-- /react-text --><!-- react-text: 234 -->)<!-- /react-text --></span></div>
                        <div class="mid-row  tvs dotdot">{{res.GQF_AirlineName}} - {{res.GQF_FlightNumber}} </div>
                        <!--<div class="mid-row dotdot bustype">{{res.GQF_FlightNumber}}</div-->
                    </div>
                </div>
                <div class="col-fare fr">
                    <div class="top-row curr-price">
                        <div class="">
                            <div class="hide">from</div><span class="">INR </span><span class="">{{res.GQF_Price}}</span></div>
                    </div>
                    <div class="hide">
                        <div class="curr-price clearfix">
                            <div class="hide">
                                <div class="hide">from</div><span class="">INR </span>
                                <!-- react-text: 248 -->{{res.GQF_Price}}
                                <!-- /react-text -->
                            </div>
                        </div>
                    </div>
                    <!--<div class="mid-row seats-row">
                        <!-- react-text: 250 -->{{res.GQF_Stops}}
                        <!-- /react-text -->
                        <!-- react-text: 251 -->
                        <!-- /react-text --><!--<span>Seat(s)</span></div>-->
                    <div class="bot-row">
                        <div class="rating-sortableper hide">
                            <div class="hide no-ratings">No ratings</div>
                            <div class=" star-container "><span class="icon icon-star2 star-background"></span><span class="icon icon-star2 star-foreground" style="width: 92%;"></span></div>
                        </div>
                        <div class="rating-badge">
				<span class="badge-span green-badge1">
					<input type="radio" name="preferedreturn" style="margin-top: -3px;" value={{res.GQF_Id}},{{res.GQF_Price}}>
					<span>Prefered</span>
				</span>
				<span class="badge-span yellow-badge1">
					<input name="cbGqfid[]" style="margin-top:0px;" id="cbGqfid[]" type="checkbox" flightId="{{res.GQF_Id}}" flightprice="{{res.GQF_Price}}" flightdep="{{res.GQF_DepTIme}}" flightarr="{{res.GQF_ArrTime}}" flightName="{{res.GQF_AirlineName}}" flightlogo="{{res.GQF_AirlineCode}}" value="{{res.GQF_Id}}" class="checkbox">
					<span>Select</span>
				</span>
			</div>
			<div class="hide no-ratings hide">No ratings</div>
                    </div><span class="mid-row fr tracking-container hide "><!-- react-text: 266 --> <!-- /react-text --><span class=" icon icon-tracking tracking-icon"></span>
                    <!-- react-text: 268 -->Live Tracking
                    <!-- /react-text -->
                    </span>
                </div>
            </div>
            <div class="pastTrip hide"><span class="icon icon-history"></span>
                <!-- react-text: 271 -->You have booked this bus in the past
                <!-- /react-text -->
            </div>
            <div class="ZCaFe hide"><span class="icon icon-zcf"></span><span class="zcf-text">Free Cancellation</span><span><!-- react-text: 276 --> till <!-- /react-text --></span></div>
        </a>
    </li>
    </div>
    <# } #>
<# }) #>    
</ul>
</div>


</div>

<!--test roundtrip -->
</div>

<script>
var $ = jQuery.noConflict();
$(function(){

var alpha = [];
var number = [];
	    
$('.box').each(function(){
      
      var alphaArr = [];
      var numArr = [];
      var depArr = [];
      
      /*alphaArr.push($('h1', this).text());
      alphaArr.push($(this));
      alpha.push(alphaArr);
      alpha.sort();*/
	  
      numArr.push($('.price', this).text());
      numArr.push($(this));
      number.push(numArr);
      number.sort();
      
      depArr.push($('.arrivalTime', this).text());
      depArr.push(depArr);
      depArr.push($(this));
      depArr.push(depArr);
      depArr.sort();
    })
    
    
    
    $('#alphBnt').on('click', function(){
      $('.box').remove();
      for(var i=0; i<alpha.length; i++){
        $('.sortable').append(alpha[i][1]);
      }
    })
    
    var ascending = false;
    $('.price-btn').on('click', function(){
      /*$('.box').remove();
      for(var i=0; i<number.length; i++){
        $('.sortable').append(number[i][1]);
      } */
      var sorted = $('.box').sort(function(a,b){
        return (ascending ==
               (convertToNumber($(a).find('.price').html()) < 
	                convertToNumber($(b).find('.price').html()))) ? 1 : -1;
	    });
	    ascending = ascending ? false : true;
	    if(!($(this).hasClass('active-sort'))){
	    $(this).addClass("active-sort");
	    }
	    var classname = $('#price_s').attr('class').split(' ')[1];
	    if(classname == 'fa-arrow-down'){
	    	$('#price_s').removeClass('fa-arrow-down').addClass('fa-arrow-up');
	    }
	    else if(classname == 'fa-arrow-up'){
	    	$('#price_s').removeClass('fa-arrow-up').addClass('fa-arrow-down');
	    }
	    $('.sortable').html(sorted);     
    })
    
    
    $('.dp-btn').on('click', function(){
      /*$('.box').remove();
      for(var i=0; i<number.length; i++){
        $('.sortable').append(number[i][1]);
      }*/
      //var value = $('.arrivalTime').html();    
      //var test = convertToNumber(value);
      //console.log(test);
      var sorted = $('.box').sort(function(a,b){
	return (ascending ==
	       (convertToNumber($(a).find('.arrivalTime').html()) < 
	                convertToNumber($(b).find('.arrivalTime').html()))) ? 1 : -1;
	    });
	    ascending = ascending ? false : true;
	    if(!($(this).hasClass('active-sort'))){
	    $(this).addClass("active-sort");
	    }
	    var classname = $('#dep_s').attr('class').split(' ')[1];
	    if(classname == 'fa-arrow-down'){
	    	$('#dep_s').removeClass('fa-arrow-down').addClass('fa-arrow-up');
	    }
	    else if(classname == 'fa-arrow-up'){
	    	$('#dep_s').removeClass('fa-arrow-up').addClass('fa-arrow-down');
	    }
	
	    $('.sortable').html(sorted);  
    })
	var convertToNumber = function(value){
	     return parseFloat(value.replace(':',''));
	}
  })


</script>
