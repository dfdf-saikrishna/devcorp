/**
* Author: LimpidThemes
* Version: 1.0
* Description: Javascript file for the theme
* Date: 20-07-2015
**/

/**********************************************************
		BEGIN: PRELOADER
**********************************************************/
$(window).load(function() {
	"use strict";
	$("#loader").fadeOut("slow");
});

/**********************************************************
		BEGIN: OWL CAROUSELS
**********************************************************/
jQuery(document).ready(function($) {
   "use strict";
    if(jQuery().owlCarousel) { 
		/* BLOG POST CAROUSEL */
		if (jQuery("#post-list").length){
			jQuery("#post-list").owlCarousel({
				loop:true,
				margin:30,
				responsiveClass:true,
				autoplay:false,
				autoplayTimeout:5000,
				navigation:false,
				stopOnHover:true,
				responsive:{
					0:{
						items:1,
						loop:true
					},
					600:{
						items:2,
						loop:true
					},
					1000:{
						items:4,
						loop:true
					}
				}
			});	
		}
		
		/* HOMEPAGE OFFER SLIDER */
		if (jQuery("#offer1").length){
			jQuery("#offer1").owlCarousel({
				loop:true,
				responsiveClass:true,
				autoplay:true,
				autoplayTimeout:5000,
				navigation:false,
				stopOnHover:true,
				responsive:{
					1000:{
						items:1,
						loop:true
					}
				}
			});	
		}
		
		/* index-4.html FLIGHT OFFER SLIDER */
		if (jQuery("#flightoffer").length){
			jQuery("#flightoffer").owlCarousel({
				loop:true,
				responsiveClass:true,
				autoplay:false,
				autoplayTimeout:5000,
				navigation:false,
				stopOnHover:true,
				responsive:{
					0:{
						items:1,
						loop:true
					}
				}
			});	
		}
		
		/* ABOUT US PAGE PRTNERS SLIDER */
		if (jQuery("#partner").length){
			jQuery("#partner").owlCarousel({
				loop:true,
				margin:20,
				responsiveClass:true,
				autoplay:true,
				autoplayTimeout:5000,
				navigation:false,
				stopOnHover:true,
				responsive:{
					0:{
						items:1,
						loop:true
					},
					600:{
						items:2,
						loop:true
					},
					1000:{
						items:4,
						loop:true
					}
				}
			});	
		}
		
		/* LAST MINUTE DEALS SLIDER */
		
		if (jQuery("#lastminute").length){
			jQuery("#lastminute").owlCarousel({
				loop:true,
				responsiveClass:true,
				margin:30,
				autoplay:false,
				autoplayTimeout:5000,
				navigation:false,
				stopOnHover:true,
				responsive:{
					0:{
						items:1,
						loop:true
					},
					600:{
						items:2,
						loop:true
					},
					1000:{
						items:4,
						loop:true
					}
				}
			});
		}
		if (jQuery("#review-customer").length){
			jQuery("#review-customer").owlCarousel({
				loop:true,
				margin: 10,
				responsiveClass:true,
				autoplay:true,
				autoplayTimeout:5000,
				navigation:false,
				stopOnHover:true,
				responsive:{
					0:{
						items:1,
						loop:true
					},
					600:{
						items:1,
						loop:true
					},
					1000:{
						items:1,
						loop:true
					}
				}
			});
		}
		if (jQuery("#lowest-fare").length){
			jQuery("#lowest-fare").owlCarousel({
				loop:true,
				margin:10,
				responsiveClass:true,
				autoplay:true,
				autoplayTimeout:5000,
				navigation:true,
				stopOnHover:true,
				responsive:{
					0:{
						items:2,
						loop:true,
						navText:["<i class='fa fa-chevron-left owl-navigation-icon-blue'>","<i class='fa fa-chevron-right owl-navigation-icon-blue'>"],
						nav:true
					},
					600:{
						items:3,
						loop:true,
						navText:["<i class='fa fa-chevron-left owl-navigation-icon-blue'>","<i class='fa fa-chevron-right owl-navigation-icon-blue'>"],
						nav:true
					},
					1000:{
						items:5,
						loop:true,
						navText:["<i class='fa fa-chevron-left owl-navigation-icon-blue'>","<i class='fa fa-chevron-right owl-navigation-icon-blue'>"],
						nav:true
					}
				}
			});
		}
	}
});


/***************************************************************
		BEGIN: VARIOUS DATEPICKER & SPINNER INITIALIZATION
***************************************************************/


       



$(function() {
		"use strict";
		new WOW().init();
		$( "#departure_date" ).datepicker({ minDate: -0, maxDate: "+12M" });
		$( "#return_date" ).datepicker({ minDate: -0, maxDate: "+12M" });
		
		$( "#departure_date_int" ).datepicker({ minDate: -0, maxDate: "+12M" });
		$( "#return_date_int" ).datepicker({ minDate: -0, maxDate: "+12M" });
		
		
		$( "#check_out" ).datepicker({ minDate: -0, maxDate: "+3M" });
		$( "#check_in" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#check_out_int" ).datepicker({ minDate: -0, maxDate: "+12M" });
		$( "#check_in_int" ).datepicker({ minDate: -0, maxDate: "+12M" });
		
		$( "#package_start" ).datepicker({ minDate: -0, maxDate: "+12M" });
		$( "#car_start" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#bus_start" ).datepicker({ minDate: -0, maxDate: "+6M" });
		
		$( "#bus_end" ).datepicker({ minDate: -0, maxDate: "+6M" });
		
		$( "#car_end" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#car_local" ).datepicker({ minDate: -0, maxDate: "+3M" });
		$( "#car_transfer" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#car_hotel" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#car_railway" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#cruise_start" ).datepicker({ minDate: -0, maxDate: "+3M" });
		$( "#cruise_end" ).datepicker({ minDate: -0, maxDate: "+3M" });
		$( "#bus_start" ).datepicker({ minDate: -0, maxDate: "+3M" });
		$( "#bus_end" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#homestays_start" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		$( "#homestays_end" ).datepicker({ minDate: -0, maxDate: "+3M" });
		
		
		$( "#adult_count" ).spinner({
			min: 1,
			max:9
		});
		$( "#child_count" ).spinner( {
			min: 1
		});
		
		$( "#infant_count" ).spinner( {
			min: 1
		});
		
		
		$( "#adult_count_int" ).spinner({
			min: 1,
			max:9
		});
		$( "#child_count_int" ).spinner( {
			min: 1
		});
		
		$( "#infant_count_int" ).spinner( {
			min: 1
		});
		
	/////////////////////////////////////////////////////////////////////////////////////
	
	
	$( "#packages_adult" ).spinner( {
			min: 2,
			max: 7
		});
		$( "#packages_child" ).spinner( {
			min: 0,
			max: 4
		});
		
		
//////////////////////////////////////////////////////////////////////		
		
		$( "#hotel_adult_count" ).spinner( {
			min: 1,
			max: 4
		});
		
		
		
		$( "#home_adult_count" ).spinner( {
			min: 1,
			max: 4
		});
		
		$( "#hotel_adult_count2" ).spinner( {
			min: 1,
			max: 4
		});
		
		$( "#hotel_adult_count3" ).spinner( {
			min: 1,
			max: 4
		});
		
		$( "#hotel_adult_count4" ).spinner( {
			min: 1,
			max: 4
		});
		
		
		
		
/////////////////////////////////////////////////////////////////////////		
		
		
		$( "#hotel_child_count" ).spinner( {
			min: 0,
			max: 2
		});
		
		$( "#home_child_count" ).spinner( {
			min: 0,
			max: 2
		});
		
		$( "#hotel_child_count2" ).spinner( {
			min: 0,
			max: 2
		});
		
		$( "#hotel_child_count3" ).spinner( {
			min: 0,
			max: 2
		});
		
		$( "#hotel_child_count4" ).spinner( {
			min: 0,
			max: 2
		});
		
		
		
		
///////////////////////////////////////////////////////////////////////////		
		
		$( "#room_count" ).spinner( {
			min: 1,
			max: 4
		});
		
		$( "#room_count_home" ).spinner( {
			min: 1,
			max: 4
		});
		
		
		
		$('.selectpicker').selectpicker({
			style: 'custom-select-button'
		});
});





$(document).ready(function(){
	
	var p_amount=$('#p_amount').val()
	
	//var dd='';
	$(".fa-plus").click(function(){		
		//
		
		
		//$("#chage").removeAttr("disabled");
		
		
		//$('#chage').prop('disabled', false);
		
	//$(".fa-plus, #hotel_adult_count").click(function(e) {
        
		var romms=$('.room-count').val()	
		
		
		
		//alert(tot)
		
		
		$('#pp_'+romms).fadeIn(100);
/////////////////////////////////////////////////
 var childage1=$('#hotel_child_count').val(); 
 
 var childage2=$('#hotel_child_count2').val(); 
 
 var childage3=$('#hotel_child_count3').val(); 
 
 var childage4=$('#hotel_child_count4').val(); 
 
		
		$('#chf_'+childage1).fadeIn(100);
		
		$('#chs_'+childage2).fadeIn(100);
		
		$('#cht_'+childage3).fadeIn(100);
		
		$('#chfth_'+childage4).fadeIn(100);

  //alert(childage1)		

});



$(".fa-minus").click(function(){
	//$(".fa-plus, #hotel_adult_count").click(function(e) {
        
		var romms=parseFloat($('.room-count').val())+1		
		
		
		
		var childage1=parseFloat($('#hotel_child_count').val())+1;
		
		var childage2=parseFloat($('#hotel_child_count2').val())+1; 
 
 var childage3=parseFloat($('#hotel_child_count3').val())+1; 
 
 var childage4=parseFloat($('#hotel_child_count4').val())+1;
		
		
		$('#pp_'+romms).fadeOut(100);
		
		$('#chf_'+childage1).fadeOut(100);
		
	$('#chs_'+childage2).fadeOut(100);
		
		$('#cht_'+childage3).fadeOut(100);
		
		$('#chfth_'+childage4).fadeOut(100);
		

});

});


$(document).ready(function(){
	
	var p_amount=$('#p_amount').val()
	
	//var dd='';
	$(".fa-plus").click(function(){
		
var pkg_adult=parseFloat($('.pkg-adlt-count').val()) + parseFloat($('.pkg-chld-count').val())
		
		//alert(pkg_adult)
		
		//var id=$(this).attr('id')
		
		//alert(pkg_adult+p_amount)
		
		
		//var tot=Math.round(pkg_adult * p_amount);
		
		document.getElementById("dom_package_fare").innerHTML ='Total ₹ &nbsp;'+Math.round(pkg_adult * p_amount);
		document.getElementById("dom_packages_fare").value =Math.round(pkg_adult * p_amount);


});

$(".fa-minus").click(function(){
	
	var pkg_adult=parseFloat($('.pkg-adlt-count').val()) + parseFloat($('.pkg-chld-count').val())
		
		document.getElementById("dom_package_fare").innerHTML ='Total ₹ &nbsp;'+Math.round(pkg_adult * p_amount);
		
		document.getElementById("dom_packages_fare").value =Math.round(pkg_adult * p_amount);
	
	
	});

});




$(document).ready(function(e) {
$('#int').click(function(e) {
            
			$('.domestic').fadeOut(100);
			
			$('.international').slideDown(800);
			
			
        });
		
		$('#dom').click(function(e) {
            
			$('.domestic').slideDown(800);
			
			$('.international').fadeOut(100);
			
			
        });
		
		
		
		$('#int_hotel').click(function(e) {
            
			$('.domestic_hotel').fadeOut(100);
			
			$('.international_hotel').slideDown(800);
			
			
        });
		
		$('#dom_hotel').click(function(e) {
            
			$('.domestic_hotel').slideDown(800);
			
			$('.international_hotel').fadeOut(100);
			
			
        });
		
		
		$('#out_car').click(function(e) {
            
			
			
			$('#local').fadeOut(100);
			
			$('#transfer').fadeOut(100);		
			$('#outstation').slideDown(800);
			
			
        });
		
		$('#local_car').click(function(e) {
            
			$('#outstation').fadeOut(100);
			
			$('#transfer').fadeOut(100);
				
			$('#local').slideDown(800);
			
        });
		
		$('#transfer_car').click(function(e) {
            
			$('#outstation').fadeOut(100);
			
			$('#local').fadeOut(100);
			
			$('#transfer').slideDown(800);	
			
			
        });
		
		
		
		
		
		
    });





$(document).ready(function(e) {
    
	$('#inlineRadio2').click(function(){
		
		$('#date').fadeIn(100);
		
		$('#rdate').fadeIn(100);
		
		document.getElementById("return_date").disabled=false;
		
		
		
	
	});
	
	
	$('#inlineRadio1').click(function(){
		
		
		document.getElementById("return_date").disabled=true;
		
		
		$('#date').fadeOut(1000);
		
		$('#rdate').fadeOut(100);
		
	});
	
	
	$('#inlineRadio4').click(function(){
		
		$('#date').fadeIn(100);
		
		document.getElementById("return_date_int").disabled=false;
		
	});
	
	
	$('#inlineRadio3').click(function(){
		
		
		document.getElementById("return_date_int").disabled=true;
		
		$('#date').fadeOut(1000);
		
		
		
	
	});
	
	
	$('#inlineRadio5').click(function(){
		
		
		document.getElementById("car_end").disabled=true;		
	
		
	});
	
	$('#inlineRadio6').click(function(){
		
		
		document.getElementById("car_end").disabled=false;		
	
		
	});
	
	
	
	
});



/**********************************************************************
		BEGIN: VIEW SWITCHER 
***********************************************************************/
$(document).ready(function () {  
	"use strict";     
	$('.view-switcher a').on('click',function(e) {
		if ($(this).hasClass('switchgrid')) {
			$('.switchable > div').removeClass('hotel-list-view').addClass('product-grid-view');     
		}
		else if($(this).hasClass('switchlist')) {
			$('.switchable > div').removeClass('product-grid-view').addClass('hotel-list-view');       
		}
	});
});
/**********************************************************************
		BEGIN: STYLESHEET SWITCHER 
***********************************************************************/
$('#color-switcher ul li').on('click', function(){
	"use strict";	
    var path = $(this).data('path');
    $('#select-style').attr('href', path);
});

$('#stoggle').on('click', function(){
	"use strict";	
	var effect;
	var direction;
	var duration;
	effect = 'slide';
	duration = 400;
    $('#color-switcher').toggle(effect, duration);
});
/**********************************************************************
		MOBILE SECTION RECHARGES BILL PAYMENT 
***********************************************************************/

 