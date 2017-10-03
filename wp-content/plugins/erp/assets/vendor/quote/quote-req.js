var j = jQuery.noConflict();
   j('body').on('keyup change click', '.fromflight', function() {
    var field =  j( this ).attr('field');
    //console.log(field);
     j( "#fromflight"+field ).autocomplete({
    			
               source: function( request, response ) {
                  
                  
                     
                     wp.ajax.send('auto-search-flight', {
                         data: {
                           q: request.term,
                         },
                         async: true,
                         success: function (data) {
                             //console.log(data);
                             response( data );
                         },
                         error: function (error) {
                             alert(error);
                             console.log(error);
                         },
                     });
                  
               },
               select: function (event, ui) {
        		var inputs = j(this).closest('span').find(':input');
        	  	inputs.eq( inputs.index(this)+ 1 ).focus();
        	},
        });
   });
   
   j('body').on('keyup change click', '.toflight', function() {
    var field =  j( this ).attr('field');
    //console.log(field);
     j( "#toflight"+field ).autocomplete({
    			
               source: function( request, response ) {
                  
                  
                     
                     wp.ajax.send('auto-search-flight', {
                         data: {
                           q: request.term,
                         },
                         async: true,
                         success: function (data) {
                             //console.log(data);
                             response( data );
                         },
                         error: function (error) {
                             alert(error);
                             console.log(error);
                         },
                     });
                  
               },
               select: function (event, ui) {
        		var inputs = j(this).closest('span').find(':input');
        	  	inputs.eq( inputs.index(this)+ 1 ).focus();
        	},
        });
   });
   
   //Bus City autopop
   j('body').on('keyup change click', '.frombus', function() {
    var field =  j( this ).attr('field');
    //console.log(field);
     j( "#frombus"+field ).autocomplete({
    			
               source: function( request, response ) {
                  
                  
                     
                     wp.ajax.send('auto-search-bus', {
                         data: {
                           q: request.term,
                         },
                         async: true,
                         success: function (data) {
                             //console.log(data);
                             response( data );
                         },
                         error: function (error) {
                             alert(error);
                             console.log(error);
                         },
                     });
                  
               },
               select: function (event, ui) {
        		var inputs = j(this).closest('span').find(':input');
        	  	inputs.eq( inputs.index(this)+ 1 ).focus();
        	},
        });
   });
   
   //Car City autopop
   j('body').on('keyup change click', '.fromcar', function() {
    var field =  j( this ).attr('field');
    //console.log(field);
     j( "#fromcar"+field ).autocomplete({
    			
               source: function( request, response ) {
                  
                  
                     
                     wp.ajax.send('auto-search-bus', {
                         data: {
                           q: request.term,
                         },
                         async: true,
                         success: function (data) {
                             //console.log(data);
                             response( data );
                         },
                         error: function (error) {
                             alert(error);
                             console.log(error);
                         },
                     });
                  
               },
               select: function (event, ui) {
        		var inputs = j(this).closest('span').find(':input');
        	  	inputs.eq( inputs.index(this)+ 1 ).focus();
        	},
        });
   });
   
   //Hotel City autopop
   j('body').on('keyup change click', '.fromhotel', function() {
    var field =  j( this ).attr('field');
    //console.log(field);
     j( "#fromhotel"+field ).autocomplete({
    			
               source: function( request, response ) {
                  
                  
                     
                     wp.ajax.send('auto-search-hotel', {
                         data: {
                           q: request.term,
                         },
                         async: true,
                         success: function (data) {
                             //console.log(data);
                             response( data );
                         },
                         error: function (error) {
                             alert(error);
                             console.log(error);
                         },
                     });
                  
               },
               select: function (event, ui) {
        		var inputs = j(this).closest('span').find(':input');
        	  	inputs.eq( inputs.index(this)+ 1 ).focus();
        	},
        });
   });
   
   j('body').on('keyup change click', '.tobus', function() {
    var field =  j( this ).attr('field');
    //console.log(field);
     j( "#tobus"+field ).autocomplete({
    			
               source: function( request, response ) {
                  
                  
                     
                     wp.ajax.send('auto-search-bus', {
                         data: {
                           q: request.term,
                         },
                         async: true,
                         success: function (data) {
                             //console.log(data);
                             response( data );
                         },
                         error: function (error) {
                             alert(error);
                             console.log(error);
                         },
                     });
                  
               },
               select: function (event, ui) {
        		var inputs = j(this).closest('span').find(':input');
        	  	inputs.eq( inputs.index(this)+ 1 ).focus();
        	},
        });
   });
   
   
   j('body').on('keyup change click', '.hotelDateto', function() {
       var field =  j( this ).attr('field');
       
       j( function() {
         var dateFormat = "dd-mm-yy",
           from = j( "#hotelDatefrom"+field )
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
           to = j( "#hotelDateto"+field ).datepicker({
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
    	    var d1 = j('#hotelDatefrom'+field).datepicker('getDate');
    	    var d2 = j('#hotelDateto'+field).datepicker('getDate');
    	    var oneDay = 24*60*60*1000;
    	    var diff = 0;
    	    if (d1 && d2) {
    	  
    	      diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
    	    }
    	    j('#stay'+field).val(diff);
    	    j('#stayDays'+field).html(diff);
    	    //$('.minim').val(d1);
         }
       } );
   });
   
   j('body').on('keyup change click', '.hotelDatefrom', function() {
       var field =  j( this ).attr('field');
       
       j( function() {
         var dateFormat = "dd-mm-yy",
           from = j( "#hotelDatefrom"+field )
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
           to = j( "#hotelDateto"+field ).datepicker({
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
    	    var d1 = j('#hotelDatefrom'+field).datepicker('getDate');
    	    var d2 = j('#hotelDateto'+field).datepicker('getDate');
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
   });
   
   j('body').on('keyup change click', '.carDatefrom', function() {
       var field =  j( this ).attr('field');
       
       j( function() {
         var dateFormat = "dd-mm-yy",
           from = j( "#carDatefrom"+field )
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
           to = j( "#carDateto"+field ).datepicker({
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
   });
   j('body').on('keyup change click', '.carDateto', function() {
       var field =  j( this ).attr('field');
       
       j( function() {
         var dateFormat = "dd-mm-yy",
           from = j( "#carDatefrom"+field )
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
           to = j( "#carDateto"+field ).datepicker({
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
   });
   
   j('body').on('keyup change click', '.flightDatefrom', function() {
       var field =  j( this ).attr('field');
       
       j( function() {
         var dateFormat = "dd-mm-yy",
           from = j( "#flightDatefrom"+field )
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
           to = j( "#flightDatereturn"+field ).datepicker({
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
   });
   j('body').on('keyup change click', '.flightDatereturn', function() {
       var field =  j( this ).attr('field');
       
       j( function() {
         var dateFormat = "dd-mm-yy",
           from = j( "#flightDatefrom"+field )
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
           to = j( "#flightDatereturn"+field ).datepicker({
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
   });
   j( document ).ready(function(){
     j('body').on('click', '.roundtrip', function() {
     var i =  j( this ).attr('field');
	 j('.hidereturnflight'+i).prop('disabled', true);
     j('.return'+i).show();
     });
     j('body').on('click', '.hide-roundtrip', function() {
     var i =  j( this ).attr('field');
	 j('.hidereturnflight'+i).prop('disabled', false);
     j('.return'+i).hide();
   });
   j('body').on('change', 'input', function() {
	  var inputs = j(this).closest('span').find(':input');
	  inputs.eq( inputs.index(this)+ 1 ).focus();
	});
   });