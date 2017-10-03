//  ====================================================================
//	Theme Name: Ganpathi - Responsive Landing Page Template
//	Theme URI: http://themeforest.net/user/responsiveexperts
//	Description: This javascript file is using as a settings file. This file includes the sub scripts for the javascripts used in this template.
//	Version: 1.0
//	Author: Responsive Experts
//	Author URI: http://themeforest.net/user/responsiveexperts
//	Tags:
//  ====================================================================

//	TABLE OF CONTENTS
//	---------------------------
//	 01. Preloader
//	 02. Scroll To Top
//   03. Adding fixed position to header
//	 04. Menu Toggle
//   05 Banner Slider JS
//	 06. Easy Tab
//	 07. Responsive Carousel
//	 08. Animations
//   09. Image Popup
//   10. FAQ Toggle

//  ====================================================================


(function() {
	"use strict";
	
	// --------------------- 01 Preloader ---------------------
	// --------------------------------------------------------

	$(window).load(function() {
	$("#loader").fadeOut();
	$("#mask").delay(100).fadeOut("slow");
	});
	
	// ------------------- 02 Scroll To Top -------------------
	// --------------------------------------------------------
	
	$(function() {
		$('a[href*=#]:not([href=#])').click(function() {
			$('.navbar-nav li a').parent().removeClass('active');
			$(this).parent().addClass('active');
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
	
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
			
		});
	});
	
	// ---------- 03 Adding fixed position to header ---------- 
	// --------------------------------------------------------
	
	$(document).scroll(function() {
	if ($(document).scrollTop() >= 1) {
	  $('.header-area').addClass('navbar-fixed-top');
	} else {
	  $('.header-area').removeClass('navbar-fixed-top');
	}
	});
	
	// -------------------- 04 Menu Toggle --------------------
	// --------------------------------------------------------
	
	$( ".toggle-ico" ).click(function() {
		$( ".navigation-area" ).toggle();
	});
	
	// --------------------- 05 Banner Slider JS ---------------------
	// ---------------------------------------------------------------
	
	$('.banner-slider').flexslider({
		animation: "fade",
		start: function(slider){
		  $('body').removeClass('loading');
		}
	});
	
	// --------------------- 06 Easy Tab ----------------------
	// --------------------------------------------------------
	
	$(document).ready( function() {
		$('#tab-container').easytabs({
			updateHash: false
		});
	});
	
	// ------------------- 07 Responsive Carousel --------------------
	// ---------------------------------------------------------------

	jQuery(document).ready(function($){
		$('.crsl-items').carousel({ visible: 4, itemMinWidth:100, itemMargin: 20 });
	});
	
	// -------------------- 08 Animations ---------------------
	// --------------------------------------------------------

	$('.animated').appear(function() {
		var elem = $(this);
		var animation = elem.data('animation');
		if ( !elem.hasClass('visible') ) {
			var animationDelay = elem.data('animation-delay');
			if ( animationDelay ) {
				setTimeout(function(){
					elem.addClass( animation + " visible" );
				}, animationDelay);
			} else {
				elem.addClass( animation + " visible" );
			}
		}
	});
	
	// -------------------- 09 Image Popup --------------------
	// --------------------------------------------------------
	
	$('.crsl-item').magnificPopup({
	  delegate: 'a', // child items selector, by clicking on it popup will open
	  type: 'image'
	  // other options
	});
	
	// -------------------- 10 FAQ Toggle --------------------
	// --------------------------------------------------------
	
	$(document).ready(function($) {
		$('.faq-toggle').find('.acc-head').click(function(){
		
			if($(this).hasClass('active') == false) 
			{
				$('.acc-head').removeClass('active');
				$(this).addClass('active');
			} else {
				$('.acc-head').removeClass('active');
			}
			//Expand or collapse this panel
			$(this).next().slideToggle('1000');
			
			//Hide the other panels
			$(".acc-cont").not($(this).next()).slideUp('1000');
		
		});
	});

})(jQuery);


