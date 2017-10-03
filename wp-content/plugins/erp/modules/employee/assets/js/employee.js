/* jshint devel:true */
/* global wpErpHr */
/* global wp */

;
(function ($) {
    'use strict';
    var WeDevs_CRP_EMP = {
        /**
         * Initialize the events
         *
         * @return {void}
         */
        initialize: function () {
            // Travel Requests
            $('.pre-travel-request').on('click', '#clear', this.travelRequest.reset);
            $('.pre-travel-request').on('click', '#clearpost', this.travelRequest.resetPost);
            $('.pre-travel-request').on('click', '#clear1', this.travelRequest.resetedit);
            $('body').on('submit', '#prepost_request_edit_form', this.travelRequest.pretopostedit);
            $('.pre-travel-request').on('submit', '#request_form', this.travelRequest.create);
            $('.pre-travel-request').on('submit', '#request_edit_form', this.travelRequest.edit);
            $('body').on('click', '#update-prepost-travel-request', this.travelRequest.editValuePrepost);
            $('body').on('click', '#save-prepost-travel-request', this.travelRequest.saveValuePrepost);
            $('.pre-travel-request').on('click', '#save-pre-travel-request', this.travelRequest.saveValue);
            $('.pre-travel-request').on('click', '#submit-pre-travel-request', this.travelRequest.editValue);
            $('.pre-travel-request').on('click', '#deleteRowbutton', this.travelRequest.delete);
            $('body').on('click', '#deleteRequest', this.travelRequest.deleteRequest);
            $('body').on('click', '#post-emp-chat', this.travelRequest.createChatMsg);
            $('body').on('click', 'span#add-row-pretravel-edit', this.travelRequest.addRowEdit);
            $('body').on('click', '#add-row-pretravel', this.travelRequest.addRowFlight);
            $('body').on('click', '#add-row-bus', this.travelRequest.addRowBus);
            $('body').on('click', '#add-row-hotel', this.travelRequest.addRowHotel);
            $('body').on('click', '#add-row-car', this.travelRequest.addRowCar);
			$('body').on('click', '#add-row-pretravel-prepost', this.travelRequest.addRowFlightprepost);
            $('body').on('click', '#add-row-bus-prepost', this.travelRequest.addRowBusprepost);
            $('body').on('click', '#add-row-hotel-prepost', this.travelRequest.addRowHotelprepost);
            $('body').on('click', '#add-row-car-prepost', this.travelRequest.addRowCarprepost);
            $('body').on('click', 'span#add-row-posttravel', this.travelRequest.addRowPost);
            $('body').on('click', 'span#add-row-mileage', this.travelRequest.addRowMileage);
            $('body').on('click', 'span#add-row-utility', this.travelRequest.addRowUtility);
            $('body').on('click', '#add-row-others', this.travelRequest.addRowOthers);
			$('body').on('click', '#add-row-others-d', this.travelRequest.addRowOthersD);
			$('body').on('click', '#add-row-others-prepost', this.travelRequest.addRowOthersprepost);
            $('body').on('click', 'span#add-row-posttravel-edit', this.travelRequest.addRowPostEdit);
            $('body').on('click', 'span#add-row-mileage-edit', this.travelRequest.addRowMileageEdit);
            $('body').on('click', 'span#add-row-utility-edit', this.travelRequest.addRowUtilityEdit);
            $('body').on('click', 'span#add-row-others-edit', this.travelRequest.addRowOthersEdit);
            $('body').on('click', '#remove-row-flight', this.travelRequest.removeRowFlight);
            $('body').on('click', '#remove-row-bus', this.travelRequest.removeRowBus);
			$('body').on('click', '#remove-row-others', this.travelRequest.removeRowOthers);
            $('body').on('click', '#remove-row-hotel', this.travelRequest.removeRowHotel);
            $('body').on('click', '#remove-row-car', this.travelRequest.removeRowCar);
            $('body').on('click', 'span#remove-row-posttravel', this.travelRequest.removeRowPost);
            $('body').on('click', 'span#remove-row-mileage', this.travelRequest.removeRowMileage);
            $('body').on('click', 'span#remove-row-utility', this.travelRequest.removeRowUtility);
            $('body').on('click', 'span#remove-row-otherss', this.travelRequest.removeRowOtherss);
            $('body').on('click', '#approveAccClaim', this.travelRequest.approveAccClaim);
            $('body').on('click', '#rejectAccClaim', this.travelRequest.rejectAccClaim);
            $('body').on('click', '#approveClaim', this.travelRequest.approveClaim);
            $('body').on('click', '#rejectClaim', this.travelRequest.rejectClaim);
            $('body').on('click', 'a#subApprove', this.travelRequest.subApprove);
            $('body').on('click', '#rejectApprover', this.travelRequest.rejectApprover);
            $('body').on('click', '#rejectFinance', this.travelRequest.rejectFinance);
			$('body').on('click', '.submitcliam', this.travelRequest.submitcliam);

            //Booking
            $('body').on('click', '#bookTickets', this.booking.tickets);
            $('body').on('click', '#buttonSelfbooking', this.booking.selfBooking);
            $('body').on('click', '#cancelTickets', this.booking.cancelBooking);
            $('body').on('click', '#busBooking', this.booking.busBooking);
            $('body').on('click', '#flightBooking', this.booking.flightBooking);
            $('body').on('submit', '#seat_layout', this.booking.busEnterDetails);
            $('body').on('submit', '#flight_form', this.booking.reserve);
            $('body').on('submit', '#bus_form', this.booking.reservebus);
            
            //Api
            $('body').on('click', '#recharge', this.mobile.rechargeD);
            //$('body').on('click', '#recharge', this.mobile.recharge);
            //$('body').on('click', 'input[type="radio"]', this.mobile.operatorType);
            
            //Delegate
            $('body').on('submit', '#addDelegate', this.delegate.create);
            $('body').on('submit', '#updDelegate', this.delegate.edit);
            // handle postbox toggle
            $('body').on('click', 'div.handlediv', this.handleToggle);
            // Dasboard Overview
            $('ul.erp-dashboard-announcement').on('click', 'a.mark-read', this.dashboard.markAnnouncementRead);
            $('ul.erp-dashboard-announcement').on('click', 'a.view-full', this.dashboard.viewAnnouncement);
            $('ul.erp-dashboard-announcement').on('click', '.announcement-title a', this.dashboard.viewAnnouncementTitle);
            // Department
            $('body').on('click', 'a#erp-new-dept', this.department.create);
            $('.erp-hr-depts').on('click', 'a.submitdelete', this.department.remove);
            $('.erp-hr-depts').on('click', 'span.edit a', this.department.edit);
            // Designation
            $('body').on('click', 'a#erp-new-designation', this.designation.create);
            $('.erp-hr-designation').on('click', 'a.submitdelete', this.designation.remove);
            $('.erp-hr-designation').on('click', 'span.edit a', this.designation.edit);
            // Company Admin
            $('body').on('click', 'a#companyadmin-new', this.companyAdmin.create);
            $('.erp-hr-companyadmin').on('click', 'span.edit a', this.companyAdmin.edit);
            //$('.erp-hr-companyadmin').on('click', 'span.delete a', this.companyAdmin.remove);
            // Trigger
            $('body').on('erp-hr-after-new-dept', this.department.afterNew);
            $('body').on('erp-hr-after-new-desig', this.designation.afterNew);
            $('body').on('click', '#accTdClaimed', this.payment.create);
            $('body').on('click', '#buttontdclaimApproval', this.payment.buttontdclaimApproval);
            $('body').on('click', '#buttontdclaimRejection', this.payment.buttontdclaimRejection);
            $('body').on('click', '#buttontdclaimApproval', this.payment.approve);
            $('body').on('click', '#buttontdclaimRejection', this.payment.rejection);
            $('body').on('click', '#buttonedit', this.payment.buttonedit);
            $('body').on('click', '#resetupdateform', this.payment.resetupdateform);
            $('body').on('click', '#detailscancelid', this.payment.detailscancelid);
            $('body').on('change', '#selPaymentMode', this.payment.change);
            $('body').on('click', '#submitApprove', this.financerequests.approve);
            $('body').on('click', '#submitReject', this.financerequests.rejection);
            $('body').on('click', '#buttonClaimed', this.alltravelpayments.create);

	

            // Custom Actions   
            $('body').on('click', '.getQuoteBus', this.request.getQuoteBus);
            $('body').on('click', '.getQuoteBusD', this.request.getQuoteBusD);
            $('body').on('click', '.getQuoteFlight', this.request.getQuoteFlight);
            $('body').on('click', '.getQuoteFlightD', this.request.getQuoteFlightD);
            $('body').on('click', '.getQuoteHotel', this.request.getQuoteHotel);
            $('body').on('click', '#buttonSelectFlight', this.request.getQuoteSearch);
            $('body').on('change', '.selModeofTransp', this.request.modeChange);
            //$( 'body' ).on( 'click', '#view_seats', this.request.seats );
	    //$('body').on('change', '#selProjectCode', this.request.getBudget);
	    $('body').on('change', '#selCostCenter', this.request.getProjectCodes);
	    
	    $('body').on('click', '#buttonShowFlight', this.request.searchFlight);
	    $('body').on('click', '#buttonShowBus', this.request.searchBus);
        $('body').on('change', '#selAirlines', this.request.changeAirline);
        $('body').on('change', '#selTimeSlots', this.request.changeTimeslot);

            this.initTipTip();
            // this.employee.addWorkExperience();
        },
        initTipTip: function () {
            $('.erp-tips').tipTip({
                defaultPosition: "top",
                fadeIn: 100,
                fadeOut: 100
            });
        },
        initDateField: function () {
            $('.erp-date-field').datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '-100:+0',
            });
        },
        mobile: {
        	rechargeD: function (e) {
        	var selection = $(this).val();
        	if(selected == "mobile"){
        	var mobilenum = '';
        	var amountm = '';
        	var operatorm = '';
        	var circlem = '';
        	}
        	if(selected == "datacard"){
        	var datano = '';
        	var amountd = '';
        	var operatord = '';
        	}
        	if(selected == "postpaid"){
        	var mobilep = '';
        	var amountp = '';
        	var operatorp = '';
        	}
        
        	},
        	operatorType: function (e) {
        	var inputValue = $(this).attr("value");
	        var targetBox = $("." + inputValue);
	        $(".box").not(targetBox).hide();
	        $(targetBox).show();
	        $("#optype").val(inputValue);
        	},
        	recharge: function (e) {
        	var row = $(this).attr("row");
                var selected = $('#selModeofTransp' + row).val();
                if(selected == "8"){
	        	$.erpPopup({
	                    title: wpErpHr.popup.Recharge,
	                    button: wpErpHr.popup.Recharge,
	                    id: 'erp-recharge',
	                    content: wp.template('erp-recharge')().trim(),
	                    extraClass: 'smaller',
	                    onReady: function () {
	                        var modal = this;
	                        //$('header', modal).after($('<div class="loader"></div>').show());
	                        
	                    },
	                    onSubmit: function (modal) {
	                        wp.ajax.send({
	                            data: this.serialize(),
	                            success: function (response) {
	                                console.log(response)
	                                $('#textBillNo'+row).val(response[5]);
	                                $('#txtCost'+row).val(response[4]);
	                                WeDevs_CRP_EMP.department.reload();
	                                WeDevs_CRP_EMP.department.tempReload();
	                                modal.closeModal();
	                            },
	                            error: function (error) {
	                                modal.showError(error);
	                            }
	                        });
	                    }
	                });
                }
                else if(selected == "14"){
	        	$.erpPopup({
	                    title: wpErpHr.popup.DataCard,
	                    button: wpErpHr.popup.Recharge,
	                    id: 'erp-datacard',
	                    content: wp.template('erp-datacard')().trim(),
	                    extraClass: 'smaller',
	                    onReady: function () {
	                        var modal = this;
	                        //$('header', modal).after($('<div class="loader"></div>').show());
	                        
	                    },
	                    onSubmit: function (modal) {
	                        wp.ajax.send({
	                            data: this.serialize(),
	                            success: function (response) {
	                                console.log(response)
	                                $('#textBillNo'+row).val(response[5]);
	                                $('#txtCost'+row).val(response[4]);
	                                WeDevs_CRP_EMP.department.reload();
	                                WeDevs_CRP_EMP.department.tempReload();
	                                modal.closeModal();
	                            },
	                            error: function (error) {
	                                modal.showError(error);
	                            }
	                        });
	                    }
	                });
                }
                else{
                	alert("Please Select Recharge Type");
                }
        	
        	},
        },
        alltravelpayments: {
            buttonedit: function (e) {
                e.preventDefault();
                $('#detailsformid').css('display', 'none');
                $('#updateformid').css('display', 'block');
            },
            detailscancelid: function (e) {
                e.preventDefault();
                $('#detailsformid').css('display', 'block');
                $('#updateformid').css('display', 'none');
            },
            create: function (e) {
                e.preventDefault();
                var paymnt_mode = $('#selPaymentMode').val();

                switch (paymnt_mode) {

                    case '1':

                        var chq_no = $('#txtChequeNumber').val();
                        var chq_dt = $('#txtCqDate').val();
                        var chq_bb = $('#txtBankBranch').val();
			
                        if (chq_no == "") {
                            alert("Please enter cheque number.");
                            $('#txtChequeNumber').focus();
                            return false;
                        }

                        if (chq_dt == "") {
                            alert("Please enter cheque date.");
                            $('#txtCqDate').focus();
                            return false;
                        }

                        if (chq_bb == "") {
                            alert("Please enter issuing bank/branch.");
                            $('#txtBankBranch').focus();
                            return false;
                        }


                        break;

                        //-----------------------------------------

                    case '2':

                        var cash_c = $('#txtaCshComments').val();

                        if (cash_c == "") {
                            alert("Please enter payment details.");
                            $('#txtChequeNumber').focus();
                            return false;
                        }

                        break;

                        //-----------------------------------------


                    case '3':

                        var bt_transid = $('#txtTransId').val();
                        var bt_bankdet = $('#txtBankdetails').val();
                        var bt_date = $('#txtBBDate').val();

                        if (bt_transid == "") {
                            alert("Please enter transaction id.");
                            $('#txtTransId').focus();
                            return false;
                        }

                        if (bt_bankdet == "") {
                            alert("Please enter bank details.");
                            $('#txtBankdetails').focus();
                            return false;
                        }

                        if (bt_date == "") {
                            alert("Please enter transaction date.");
                            $('#txtBBDate').focus();
                            return false;
                        }

                        break;


                        //-----------------------------------------

                    case '4':

                        var other_c = $('#txtaOtherComments').val();

                        if (other_c == "") {
                            alert("Please enter payment details.");
                            $('#txtaOtherComments').focus();
                            return false;
                        }

                        break;

                }
                wp.ajax.send('all_payment_details_create', {
                    data: {
                        txtChequeNumber: $('#txtChequeNumber').val(),
                        reqid: $('#reqid').val(),
                        txtCqDate: $('#txtCqDate').val(),
                        txtBankBranch: $('#txtBankBranch').val(),
                        selPaymentMode: $('#selPaymentMode').val(),
                        selExpenseType: $('#selExpenseType').val(),
                        txtaCshComments: $('#txtaCshComments').val(),
                        txtTransId: $('#txtTransId').val(),
                        txtBankdetails: $('#txtBankdetails').val(),
                        txtBBDate: $('#txtBBDate').val(),
                        txtaOtherComments: $('#txtaOtherComments').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        //WeDevs_ERP_EMPLOYEE.payment.reload();
                        switch (resp.status) {
                            case 'success':
                                $('body').load(window.location.href + '#detailsformid');
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }


                    },
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
        },
        request: {
            
            changeAirline: function(){
                //console.log($(this).val());
                $('#cAirline').val($(this).val());
            },
            
            changeTimeslot: function(){
                //console.log($(this).val());
                $('#ctimeslot').val($(this).val());
            },
            searchBus: function(){
                var selTimeSlots = $('#ctimeslot').val();
            	var selAirlines = $('#cAirline').val();
            	var sessionid = $('#sessionid').val();
            	$('header').after($('<div class="bus-loader"></div>').show());
            	wp.ajax.send('bus-search-quote', {
	                    data: {
	                        selTimeSlots: selTimeSlots,
	                        selAirlines: selAirlines,
	                        sessionid: sessionid,
	                    },
	                    success: function (resp) {
	                        $('.bus-loader').remove();
	                        console.log(resp);
	                        var dateData, dateObject, dateReadable;
                            var trvDate = resp.depdate;
                            var DateChanged = trvDate.split("-");
                            var newDate = DateChanged[1] + '-' + DateChanged[2] + '-' + DateChanged[0].toString().substring(2);
                            dateData = newDate; //For example
                            dateObject = new Date(Date.parse(dateData));
                            dateReadable = dateObject.toDateString();
                            
	                        var html = wp.template('bus-get-quote')(resp);
                            $('.content').html(html);
                            $('span[data-selected]').each(function () {
                                var self = $(this),
                                        selected = self.data('selected');
                                if (selected !== '') {
                                    self.find('select').val(selected).trigger('change');
                                }
                            });
                            $('.dt').html(dateReadable);
                            $('.busfrom').html(resp.origin);
                            $('.busto').html(resp.destination);
                            //$('.flight-loader', modal).remove();
	                    },
	                    error: function (error) {
	                        console.log(error);
	                    }
	               });
            },
            searchFlight: function(){
                var selTimeSlots = $('#ctimeslot').val();
            	var selAirlines = $('#cAirline').val();
            	var sessionid = $('#sessionid').val();
            	$('header').after($('<div class="flight-loader"></div>').show());
            	wp.ajax.send('flight-search-quote', {
	                    data: {
	                        selTimeSlots: selTimeSlots,
	                        selAirlines: selAirlines,
	                        sessionid: sessionid,
	                    },
	                    success: function (resp) {
	                        $('.flight-loader').remove();
	                        console.log(resp);
	                        var dateData, dateObject, dateReadable;
                            var trvDate = resp.depdate;
                            var DateChanged = trvDate.split("-");
                            var newDate = DateChanged[1] + '-' + DateChanged[2] + '-' + DateChanged[0].toString().substring(2);
                            dateData = newDate; //For example
                            dateObject = new Date(Date.parse(dateData));
                            dateReadable = dateObject.toDateString();
                            
	                        var html = wp.template('flight-get-quote')(resp);
                            $('.content').html(html);
                            $('span[data-selected]').each(function () {
                                var self = $(this),
                                        selected = self.data('selected');
                                if (selected !== '') {
                                    self.find('select').val(selected).trigger('change');
                                }
                            });
                            $('.dt').html(dateReadable);
                            $('.flightfrom').html(resp.origin);
                            $('.flightto').html(resp.destination);
                            //$('.flight-loader', modal).remove();
	                    },
	                    error: function (error) {
	                        console.log(error);
	                    } 
	               });
            },
        
            getProjectCodes: function(){
            	var ProjectCode = $('#selProjectCode').val();
            	var CostCenter = $('#selCostCenter').val();
            	var optionsCat = '';
            	if(CostCenter){
            		wp.ajax.send('get-project-codes', {
	                    data: {
	                        ProjectCode: ProjectCode,
	                        CostCenter: CostCenter,
	                    },
	                    success: function (resp) {
	                        console.log(resp);
	                        $.each(resp, function (index, value) {
                                    //console.log(value);
                                    optionsCat += '<option value="' + value.PC_Id + '">' + value.PC_Code + ' -- ' + value.PC_Name + '</option>';
                                });
                                $('#selProjectCode').html('<option value="">Select</option>' + optionsCat);
	                    },
	                    error: function (error) {
	                        console.log(error);
	                    }
	               });
            	
            	}
            
            },
            getTime: function (totMin) {

                var timestring = "";
                var oneDay = 24 * 60;
                var noOfDays = Math.floor(totMin / oneDay);
                var time = totMin % oneDay;
                var hours = Math.floor(time / 60);
                var minutes = Math.floor(time % 60);
                if (minutes < 10)
                {
                    minutes = '0' + minutes;
                }

                if (hours % 12 == 0)
                {
                    timestring += "00";
                } else
                {
                    timestring += hours % 12;
                }
                timestring += ":";
                timestring += minutes;

                if (hours < 12)
                {
                    timestring += " AM";
                } else {
                    timestring += " PM";
                }

                return timestring;
            },
            getTimeGroup: function (totMin, totMax) {

                var timestringmin = "";
                var oneDay = 24 * 60;
                var time = totMin % oneDay;
                var hours = Math.floor(time / 60);
                //console.log("from"+hours);
                if (hours < 6) {
                    timestringmin = "0 - 6 AM";
                }
                if (hours < 12) {
                    timestringmin = "6 AM - 12 PM";
                }
                if (hours < 18) {
                    timestringmin = "12 PM - 6 PM";
                }
                if (hours < 24) {
                    timestringmin = "6 PM - 12 AM";
                }
                return timestringmin;

            },
            modeChange: function () {
                //var row = $('#rowCount').val();
                var row = $(this).attr("row");
                var selected = $('#selModeofTransp' + row).val();
                //alert(selected);
                // mode = flight
                if (selected == 1) {
                    $('#from' + row).removeClass();
                    $('#from' + row).addClass('flight');
                    $('#to' + row).removeClass();
                    $('#to' + row).addClass('flight');
                    $('#from' + row).val('');
                    $('#to' + row).val('');
                    $('#getQuote' + row).removeClass('getQuote');
                    $('#getQuote' + row).removeClass('getQuoteBus');
                    $('#getQuote' + row).removeClass('getQuoteHotel');
                    $('#getQuote' + row).addClass('getQuoteFlight');
                }
                // mode = bus
                else if (selected == 2) {
                    $('#from' + row).removeClass();
                    $('#from' + row).addClass('bus');
                    $('#to' + row).removeClass();
                    $('#to' + row).addClass('bus');
                    $('#from' + row).val('');
                    $('#to' + row).val('');
                    $('#getQuote' + row).removeClass('getQuote');
                    $('#getQuote' + row).removeClass('getQuoteFlight');
                    $('#getQuote' + row).removeClass('getQuoteHotel');
                    $('#getQuote' + row).addClass('getQuoteBus');
                }
                else if (selected == 5) {
                    $('#getQuote' + row).removeClass('getQuote');
                    $('#getQuote' + row).removeClass('getQuoteFlight');
                    $('#getQuote' + row).removeClass('getQuoteBus');
                    $('#getQuote' + row).addClass('getQuoteHotel');
                }
                else {
                    $('#from' + row).removeClass();
                    $('#to' + row).removeClass();
                }
            },
            getQuoteHotel: function (e) {
            	e.preventDefault();
                var i = $(this).val();
		
                var modeval = document.getElementById('selModeofTransph' + i).value;
		
                //var trvFrom = document.getElementById('dateFrom' + i).value;

                var trvTo = document.getElementById('hotelDateto' + i).value;
                
                var trvDate = document.getElementById('hotelDatefrom' + i).value;
                
                var city = document.getElementById('fromhotel' + i).value;
		
                //var stay = $('input[type="radio"][name="selStayDurhotel"]:checked').val();
                
                //console.log(stay);return false;
            	
            	if (!modeval) {
                    alert('Please select expense category properly.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }
                
                if (!city) {
                    alert('Please enter City.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }
                
                if (!trvTo) {
                    alert('Please enter Checkoutdate.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }

                if (!trvDate) {
                    alert('Please enter date of Stay.');
                    document.getElementById('to' + i).focus();
                    return false;
                }
                modeval = parseInt(modeval);
                var switchMode = modeval - 1;
                switch (switchMode)
                {
                    case switchMode:
                        wp.ajax.send('get-mode-quote', {
                            success: function (mode) {
                                var modetext = mode[switchMode].MOD_Name;
                                $.erpPopup({
                                    title: wpErpHr.popup.get_quote,
                                    //button: wpErpCompany.popup.update,
                                    id: 'get_quote',
                                    extraClass: 'fullPage',
                                    onReady: function () {
                                        var modal = this;
                                        $('header', modal).after($('<div class="hotel-loader"></div>').show());
                                        wp.ajax.send('get-quote', {
                                            data: {
                                                mode: modetext,                                                
                                                trvDate: trvDate,
                                                trvTo: trvTo,
                                                city: city,
                                                iteration: i,
                                            },
                                            success: function (response) {
                                                console.log(response);
                                                /*var content = '';
                                                var resp = jQuery.parseJSON(response);
                                                var obj = resp;
                                                content += '<div class="row">';
                                                content += '<div class="col-lg-12">';
                                                content += '<h2>' + trvDate + ' - <span class="text-primary">' + city + '</span></h2>';
                                                content += '</div>';
                                                content += '<table style="margin-bottom: 20px;">';
                                                content += '<thead >';
                                                content += '<tr height="30">';
                                                content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Property:</label><div><select class="form-control" name="selProperty" id="selProperty"><option value="">All</option><option value="Holiday">Holiday</option><option value="Budget">Budget</option><option value="Business">Business</option><option value="Luxury">Luxury</option>';
                                                content += '</select></div></div></strong></th>'
                                                content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">Hotel Type :</label><div><select class="form-control" name="hotelType" id="hotelType"><option value="">All</option><option value="Villa">Villa</option><option value="Guest House">Guest House</option><option value="Homestay">Homestay</option><option value="Hotel">Hotel</option><option value="Resort">Resort</option><option value="Bungalow">Bungalow</option><option value="Service Apartment">Service Apartment</option><option value="Lodge">Lodge</option><option value="Cottage">Cottage</option><option value="BnB">BnB</option></select></div></div></strong></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Amenities:</label><div><select class="form-control" name="amenities" id="amenities"><option value="">All</option><option value="Front desk">Front desk</option><option value="Free Internet">Free Internet</option><option value="Laundry Service">Laundry Service</option><option value="Restaurant/Coffee Shop">Restaurant/Coffee Shop</option><option value="Laundry Service">Laundry Service</option><option value="Business Services">Business Services</option><option value="Health-Spa">Health-Spa</option><option value="Swimming Pool">Swimming Pool</option><option value="Internet">Internet</option><option value="Parking Facility">Parking Facility</option><option value="Indoor Entertainment">Indoor Entertainment</option><option value="Room Service">Room Service</option><option value="Spa">Spa</option><option value="Travel Assistance">Travel Assistance</option><option value="Outdoor Activities">Outdoor Activities</option></select></div></div></strong></th>';
                                                content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '</div>';

                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th bgcolor="#00b5e5" style="text-align:center;color:#000000;"></th>'; 
                                                content += '<th bgcolor="#00b5e5" style="text-align:center;color:#000000;"><strong> Hotel Name</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align:center;color:#000000;"><strong>Place</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align:center;color:#000000;"><strong>Available</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>Rating</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align:center;color:#000000;"><strong>PREFERED</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong><i class="fa fa-check"></i></strong></th>';
                                                content += ' </tr>';
                                                content += '</thead>';
                                                content += '<tbody id="fbody" align="center">';
                                                $.each(obj, function (key, value) {
                                                    
                                                    content += '<tr>';
                                                    content += '<td><div style="width:45px;"><img style="width: 80px;height: 50px;" src="' + value.GQF_FlightNumber + '"></img><div></td>';
                                                    content += '<td data-title="BUS" style="padding-left:20px;text-align:center;">' + value.GQF_AirlineName + '</td>';
                                                    content += '<td data-title="BUS" style="padding-left:20px;text-align:center;">' + value.location + '</td>';
                                                    
                                                    content += '<td data-title="BUS" style="padding-left:20px;text-align:center;"><b>' + value.GQF_Stops+ '</b></td>';
                                                    content += '<td data-title="BUS" style="padding-left:20px;text-align:center;"><b>' + value.GQF_Price+ '</b></td>';
                                                    content += '<td data-title="BUS" style="padding-left:20px;text-align:center;"><b>' + value.hotelrating+ '</b><span> Star</span></td>';
                                                    content += '<td style="display:none;">'+ value.GQF_FlightNumber +'</td>'
                                                    content += '<td style="display:none;">'+ value.GQF_Id +'</td>'
                                                    content += '<td data-title="Open" style="text-align:center;"><input type="radio" name="prefered" value=' + value.GQF_Id + ',' + value.GQF_Price + '></td>';
                                                    content += '<td data-title="PREFERED" style="text-align:center;"><input name="cbGqfid[]" style="margin-left: 20px; id="cbGqfid[]" type="checkbox" value="' + value.GQF_Id + '" class="checkbox"></td>';
							
                                              
                                                    content += '</tr>';

                                                });
                                                content += '</tbody>';
                                                content += '</table>';*/
                                                var html = wp.template('hotel-get-quote')(response);
                                                $('.content', modal).html(html);
                                                $('.dt').html(trvDate);
                                                //$('.hotelfrom').html(trvFrom);
                                                //$('.hotelto').html(trvTo);
                                                $('.hotel-loader', modal).remove();
                                            },
                                            error: function (error) {
                                                alert("error");
                                                console.log(error);
                                                modal.enableButton();
                                                modal.showError(error);
                                            },
                                        });
                                    },
                                    onSubmit: function (modal) {
                                        var allVals = [];
                                        $('input[name="cbGqfid[]"]:checked').each(function () {
                                            allVals.push($(this).val());
                                        });
                                        if(allVals.length<3 || allVals.length>3){
                                        alert("please Check only 3 options");
                                        $('.erp-loader').remove();
                                        return false;
                                        }
                                        var myRadio = $('input[name=prefered]');
                                        var checkedValue = myRadio.filter(':checked').val();            
                                        var quote_price = checkedValue.split(',')[1];
                                        //var quote_totalprice = stay*quote_price;
                                        //alert(quote_totalprice);
                                        var prefrdselected = checkedValue.split(',')[0];
                                        

                                        if ( $('.hotel'+i).length ) {
											$(".erase" + i).val('');
											$("#hiddenPrefrdSelectedhotel"+i).val('');
											$("#hiddenAllPreferedhotel"+i).val('');
											var resultObj = $("#hiddenPrefrdSelectedhotel"+i);
											var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
											resultObj .val( stringToAppend + prefrdselected );
											
											var resultObj = $("#hiddenAllPreferedhotel"+i);
											var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
											resultObj .val( stringToAppend + allVals );
										}
										else{
										var resultObj = $("#hiddenPrefrdSelectedhotel"+i);
										var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
										resultObj .val( stringToAppend + prefrdselected );
										
										var resultObj = $("#hiddenAllPreferedhotel"+i);
										var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
										resultObj .val( stringToAppend + allVals );
										}

										//$('#hiddenPrefrdSelected1').val(prefrdselected);
										//$('#hiddenAllPrefered1').val(allVals);
										//alert(quote_price);
										$('#hoteltxtCost' + i).val(quote_price);
										var req_type = $('#req_type').val();
										
										valCostPre(quote_price,i,modeval);
										
										var crows = $( '#selected_quote' ).children(".quote-row-hotel").length;
										//console.log($('.hotel'+i).length);
										if ( $('.hotel'+i).length ) {
											$('#quoteContenthotel'+i).html('<div class="container-fluid pgbg hotel'+i+'"> <div class="row myrow" > <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-hospital-o" aria-hidden="true" ></i><span class="gclr 22fnt"> Hotel </span></div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-to1">'+city+' </span></span> </div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date">'+trvDate+' </span> </div> </div><div class="row hotel-content'+i+'" style="background-color:#fff;" ></div></div>');
											$("input[name='cbGqfid[]']:checked").each(function () {
												if (prefrdselected == $(this).attr("hotelId")) {
												$('.hotel-content'+i+'').append('<div class="col-sm-2 col-md-1 bghlt col-xs-4 quote-image3 imgsty" ><img style="width: 100%; padding-top: 5px; height:100%; padding-bottom:5px;" alt="spicejet" src="' + $(this).attr("hotellogo") + '"></div><div class="col-sm-2 col-md-3 pt10 imgsty bghlt col-xs-8" ><span class="splane quote-name3">'+$(this).attr("hotelName")+'</span> <br> <span class="splane quote-dep3"> CheckIn: '+trvDate+'- CheckOut: '+trvTo+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("hotelprice")+'</span></span></div>');
									
												}
												else{
												$('.hotel-content'+i+'').append('<div class="col-sm-2 col-md-1 col-xs-4 quote-image3 imgsty" ><img style="width: 100%; padding-top: 5px; height:100%; padding-bottom:5px;" alt="spicejet" src="' + $(this).attr("hotellogo") + '" ></div><div class="col-sm-2 col-md-3 pt10 imgsty col-xs-8" ><span class="splane quote-name3">'+$(this).attr("hotelName")+'</span> <br> <span class="splane quote-dep3"> CheckIn: '+trvDate+'- CheckOut: '+trvTo+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("hotelprice")+'</span></span></div>');
												}
													
											});
											
										}
										else{
											$('#selected_quote').append('<div id="quoteContenthotel'+i+'" class="quote-row-hotel"><div class="container-fluid pgbg hotel'+i+'"> <div class="row myrow" > <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-hospital-o" aria-hidden="true" ></i><span class="gclr 22fnt"> Hotel </span></div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-to1">'+city+' </span></span> </div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date">'+trvDate+' </span> </div> </div><div class="row hotel-content'+i+'" style="background-color:#fff;" >');
											$('#selected_quote').append('</div></div>');
											$("input[name='cbGqfid[]']:checked").each(function () {
												if (prefrdselected == $(this).attr("hotelId")) {
												$('.hotel-content'+i+'').append('<div class="col-sm-2 col-md-1 bghlt col-xs-4 quote-image3 imgsty" ><img style="width: 100%; padding-top: 5px; height:100%; padding-bottom:5px;" alt="spicejet" src="' + $(this).attr("hotellogo") + '" ></div><div class="col-sm-2 col-md-3 pt10 imgsty bghlt col-xs-8" ><span class="splane quote-name3">'+$(this).attr("hotelName")+'</span> <br> <span class="splane quote-dep3"> CheckIn: '+trvDate+'- CheckOut: '+trvTo+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("hotelprice")+'</span></span></div>');

												}
												else{
												$('.hotel-content'+i+'').append('<div class="col-sm-2 col-md-1 col-xs-4 quote-image3 imgsty" ><img style="width: 100%; padding-top: 5px; height:100%; padding-bottom:5px;" alt="spicejet" src="' + $(this).attr("hotellogo") + '" ></div><div class="col-sm-2 col-md-3 pt10 imgsty col-xs-8" ><span class="splane quote-name3">'+$(this).attr("hotelName")+'</span> <br> <span class="splane quote-dep3"> CheckIn: '+trvDate+'- CheckOut: '+trvTo+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("hotelprice")+'</span></span></div>');
												}
													
											});
										}
                                        modal.enableButton();
                                        modal.closeModal();
                                    },
                                });
                            }
                        });
                        //break;
                }
            
            },
            getQuoteFlightD: function (e) {
                e.preventDefault();
                var i = $(this).val();
                var adultCount = document.getElementById('adult' + i).value;
                var children = document.getElementById('children' + i).value;
                var infants = document.getElementById('infants' + i).value;
                var trvDate = document.getElementById('txtDate' + i).value;
                var desc = document.getElementById('txtaExpdesc' + i).value;
                if (trvDate) {
                    var trvDate = trvDate.split("/").reverse().join("-");
                }

                var modeval = document.getElementById('selModeofTransp' + i).value;

                var trvFrom = document.getElementById('from' + i).value;

                var trvTo = document.getElementById('to' + i).value;

                //var stay		=document.getElementById('selStayDur'+i).value;

                var fld = 'txtCost' + i;

                var ImageUrl = document.getElementById('ImageUrl').value;
                if (!modeval) {
                    alert('Please select expense category properly.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }

                if (!trvDate) {
                    alert('Please enter date.');
                    document.getElementById('txtDate' + i).focus();
                    return false;
                }
                
                if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc' + i).focus();
                    return false;
                }

                if (!trvFrom) {
                    alert('Please enter place properly.');
                    document.getElementById('from' + i).focus();
                    return false;
                }

                if (!trvTo) {
                    alert('Please enter place properly.');
                    document.getElementById('to' + i).focus();
                    return false;
                }
                modeval = parseInt(modeval);
                var switchMode = modeval - 1;
                switch (switchMode)
                {
                    case switchMode:
                        wp.ajax.send('get-mode-quote', {
                            success: function (mode) {
                                var modetext = mode[switchMode].MOD_Name;
                                $.erpPopup({
                                    title: wpErpHr.popup.get_quote,
                                    button: 'Cancel',
                                    id: 'get_quote',
                                    extraClass: 'fullPage',
                                    onReady: function () {
                                        var modal = this;
                                        $('header', modal).after($('<div class="loader"></div>').show());
                                        wp.ajax.send('get-quote', {
                                            data: {
                                                expdate: trvDate,
                                                mode: modetext,
                                                from: trvFrom,
                                                to: trvTo,
                                                fld: fld,
                                                iteration: i,
                                                adultCount: adultCount,
                                                infants: infants,
                                                children: children,
                                            },
                                            success: function (response) {
                                                //console.log(response);
                                                

                                                var html = wp.template('flight-booking-quote')(response);
                                                $('.content', modal).html(html);
                                                $('.dt').html(trvDate);
                                                $('.flightfrom').html(trvFrom);
                                                $('.flightto').html(trvTo);
                                                $('.loader', modal).remove();
                                            },
                                            error: function (error) {
                                                alert("error");
                                                console.log(error);
                                                modal.enableButton();
                                                modal.showError(error);
                                            },
                                        });
                                    },
                                    onSubmit: function (modal) {
                                        modal.enableButton();
                            		modal.closeModal();
                                    },
                                });
                            }
                        });
                        //break;
                }
            },
            getQuoteFlight: function (e) {
                e.preventDefault();
                var i = $(this).val();
                var adultCount = document.getElementById('adult' + i).value;
                var children = document.getElementById('children' + i).value;
                var infants = document.getElementById('infants' + i).value;
                var trvDate = document.getElementById('flightDatefrom' + i).value;
                var desc = document.getElementById('txtaExpdesc' + i).value;
                var dateData, dateObject, dateReadable;
                
                var DateChanged = trvDate.split("-");
                var newDate = DateChanged[1] + '-' + DateChanged[0] + '-' + DateChanged[2].toString().substring(2);
                dateData = newDate; //For example
                
                dateObject = new Date(Date.parse(dateData));
                
                dateReadable = dateObject.toDateString();
                
                if (trvDate) {
                    var trvDate = trvDate.split("/").reverse().join("-");
                }

                var modeval = document.getElementById('selModeofTransp' + i).value;

                var trvFrom = document.getElementById('fromflight' + i).value;

                var trvTo = document.getElementById('toflight' + i).value;
                
                var returnF = document.getElementById('flightDatereturn' + i).value;
                
                if (returnF) {
                    var returnF = returnF.split("/").reverse().join("-");
                }

                //var stay		=document.getElementById('selStayDur'+i).value;

                var fld = 'txtCost' + i;

                var ImageUrl = document.getElementById('ImageUrl').value;
                if (!modeval) {
                    alert('Please select expense category properly.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }

                if (!trvDate) {
                    alert('Please enter date.');
                    document.getElementById('txtDate' + i).focus();
                    return false;
                }
                
                if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc' + i).focus();
                    return false;
                }

                if (!trvFrom) {
                    alert('Please enter place properly.');
                    document.getElementById('from' + i).focus();
                    return false;
                }

                if (!trvTo) {
                    alert('Please enter place properly.');
                    document.getElementById('to' + i).focus();
                    return false;
                }
                modeval = parseInt(modeval);
                var switchMode = modeval - 1;
                switch (switchMode)
                {
                    case switchMode:
                        wp.ajax.send('get-mode-quote', {
                            success: function (mode) {
                                var modetext = mode[switchMode].MOD_Name;
                                $.erpPopup({
                                    title: wpErpHr.popup.get_quote,
                                    //button: wpErpCompany.popup.update,
                                    id: 'get_quote',
                                    extraClass: 'fullPage',
                                    onReady: function () {
                                        var modal = this;
                                        $('header', modal).after($('<div class="flight-loader"></div>').show());
                                        wp.ajax.send('get-quote', {
                                            data: {
                                                expdate: trvDate,
                                                returnF: returnF,
                                                mode: modetext,
                                                from: trvFrom,
                                                to: trvTo,
                                                fld: fld,
                                                iteration: i,
                                                adultCount: adultCount,
                                                infants: infants,
                                                children: children,
                                            },
                                            success: function (response) {
                                                console.log(response);
                                                var content = '';
                                                //var resp = jQuery.parseJSON(response);
                                                //var obj = resp;
                                                content += '<div class="row">';
                                                content += '<div class="col-lg-12">';
                                                content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                content += '</div>';
                                                //content += '<table style="margin-bottom: 20px;">';
                                                //content += '<thead >';
                                                //content += '<tr height="30">';
                                                //content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                //content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                //content += '</select></div></div></strong></th>'
                                                //content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                //content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                //content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                //content += '</tr>';
                                                //content += '</thead>';
                                                content += '</div>';

                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Flight </strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Duration</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                //content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>Offer PRICE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>PREFERED</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong><i class="fa fa-check"></i></strong></th>';
                                                content += ' </tr>';
                                                content += '</thead>';
                                                content += '<tbody id="fbody" align="center">';
                                                /*
                                                $.each(obj, function (key, value) {
                                                    
                                                    content += '<tr>';
                                                    content += '<td><img style="width: 30px;" src="' + ImageUrl + '/images/AirlineLogo/' + value.GQF_AirlineCode + '.gif"></img></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + value.GQF_DepTIme + '</b></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + value.GQF_ArrTime + '</b></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + value.GQF_Duration + '</b><span>minuts</span></td>';
                                                    //content += '<td data-title="BUS" class="text-left" id="quote_publishedprice" style="padding-left:20px;"><b>' + value.GQF_ActualPrice+ '</b></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + value.GQF_Price + '</b></td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_id" style="padding-left:20px;"><b>' + value.GQF_Id + '</b></td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_id" style="padding-left:20px;">' + value.GQF_AirlineCode + '</td>';
                                                    content += '<td data-title="Open"><input type="radio" name="prefered" value=' + value.GQF_Id + ',' + value.GQF_Price + '></td>';
                                                    content += '<td data-title="PREFERED"><input name="cbGqfid[]" style="margin-left: 20px; id="cbGqfid[]" type="checkbox" value="' + value.GQF_Id + '" class="checkbox"></td>';

                                              
                                                    content += '</tr>';

                                                });
                                                content += '</tbody>';
                                                content += '</table>';
                                                */
                                                
                                                if(returnF){
                                                var html = wp.template('flight-get-quote-return')(response);
                                                $('.content', modal).html(html);
                                                $('.dtr').html(returnF);
                                                $('.dt').html(dateReadable);
                                                $('.flightfrom').html(trvFrom);
                                                $('.flightto').html(trvTo);
                                                $('.flight-loader', modal).remove();
                                                }
                                                else
                                                {
                                                var html = wp.template('flight-get-quote')(response);
                                                $('.content', modal).html(html);
                                                $('.dt').html(dateReadable);
                                                $('.flightfrom').html(trvFrom);
                                                $('.flightto').html(trvTo);
                                                $('.flight-loader', modal).remove();
                                                }
                                            },
                                            error: function (error) {
                                                alert("error");
                                                console.log(error);
                                                modal.enableButton();
                                                modal.showError(error);
                                            },
                                        });
                                    },
                                    onSubmit: function (modal) {
                                        $("#txtCost"+i).prop("readonly",true);
                                        var allVals = [];
                                        $('input[name="cbGqfid[]"]:checked').each(function () {
                                            allVals.push($(this).val());
                                        });
                                        var myRadioReturn = $('input[name=preferedreturn]');
                                        var checkedValueReturn = myRadioReturn.filter(':checked').val();
                                        if(checkedValueReturn)
                                        var prefrdselectedReturn = checkedValueReturn.split(',')[0];
                                        var Return = $('#return').val();
                                       
                                        var myRadio = $('input[name=prefered]');
										var myRadioReturn = $('input[name=preferedreturn]');
										var checkedValueReturn = myRadioReturn.filter(':checked').val();
                                        var checkedValue = myRadio.filter(':checked').val();            
                                        var quote_price = checkedValue.split(',')[1] + checkedValue.split(',')[2];
                                        if(Return){
                                            var return_price = checkedValueReturn.split(',')[1] + checkedValueReturn.split(',')[2];
                                            quote_price = parseInt(quote_price)+parseInt(return_price);
                                        }
                                        var prefrdselected = checkedValue.split(',')[0];
										
										//Validations
										if(Return){
											//Additional Validation
											if ($.inArray(prefrdselectedReturn, allVals) == -1)
											{
											  alert("Sorry you are allowed to select prefered option only from 3 selected options");
											  $('.erp-loader').remove();
											  return false;
											}
											
											if ($.inArray(prefrdselected, allVals) == -1)
											{
											  alert("Sorry you are allowed to select prefered option only from 3 selected options");
											  $('.erp-loader').remove();
											  return false;
											}
											
											if(allVals.length<6 || allVals.length>6){
											alert("please Check only 6 options");
											$('.erp-loader').remove();
											return false;
											}
                                        }
                                        else{
                                            //Additional Validation
											if ($.inArray(prefrdselected, allVals) == -1)
											{
											  alert("Sorry you are allowed to select prefered option only from 3 selected options");
											  $('.erp-loader').remove();
											  return false;
											}
											
                                            if(allVals.length<3 || allVals.length>3){
                                            alert("please Check only 3 options");
                                            $('.erp-loader').remove();
                                            return false;
                                            }
                                        }
										
										
										
										
                                        if ( $('.flight'+i).length ) {
                                        	$(".erase" + i).val('');
                                        	$("#hiddenPrefrdSelectedflight"+i).val('');
                                        	$("#hiddenAllPreferedflight"+i).val('');
                                        	var resultObj = $("#hiddenPrefrdSelectedflight"+i);
	                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
	                                        resultObj .val( stringToAppend + prefrdselected );
	                                        
	                                        var resultObj = $("#hiddenAllPreferedflight"+i);
	                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
	                                        resultObj .val( stringToAppend + allVals );
                                        }
                                        else{
                                        var resultObj = $("#hiddenPrefrdSelectedflight"+i);
                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                                        resultObj .val( stringToAppend + prefrdselected );
                                        if(Return){
                                            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                                            resultObj .val( stringToAppend + prefrdselectedReturn );
                                        }
                                        var resultObj = $("#hiddenAllPreferedflight"+i);
                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                                        resultObj .val( stringToAppend + allVals );
                                        }

                                        //$('#hiddenPrefrdSelected1').val(prefrdselected);
                                        //$('#hiddenAllPrefered1').val(allVals);
                                        //alert(quote_price);
                                        $('#txtCost' + i).val(quote_price);
                                        var req_type = $('#req_type').val();
                                        if(req_type == 'group'){
                                            calcTotalCost();
                                        }
                                        else{
                                        valCostPre(quote_price,i,modeval);
                                        }
                                        var crows = $( '#selected_quote' ).children(".quote-row-flight").length;
										console.log($('.flight'+i).length);
                                    	if ( $('.flight'+i).length ) {
                                    		$('#quoteContentflight'+i).html('<div class="container-fluid pgbg flight'+i+'"> <div class="row myrow" > <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">Flight </span></div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from"> '+trvFrom+'</span><span class="quote-to1"> - '+trvTo+' </span></span> </div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date">'+trvDate+' </span> </div> </div><div class="row flight-content'+i+'" style="background-color:#fff;" ></div></div>');
                                    		$("input[name='cbGqfid[]']:checked").each(function () {
                                    			if (prefrdselected == $(this).attr("flightId") || prefrdselectedReturn == $(this).attr("flightId")) {
                                    			$('.flight-content'+i+'').append('<div class="col-sm-2 col-md-2 bghlt col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/AirlineLogo/'+$(this).attr("flightlogo")+'.gif" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 imgsty bghlt col-xs-6" ><span class="splane quote-name3">'+$(this).attr("flightName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("flightdep")+'- Arr: '+$(this).attr("flightarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("flightprice")+'</span></span></div>');
                                    
                                    			}
                                    			else{
                                    			$('.flight-content'+i+'').append('<div class="col-sm-2 col-md-2 col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/AirlineLogo/'+$(this).attr("flightlogo")+'.gif" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 imgsty col-xs-6" ><span class="splane quote-name3">'+$(this).attr("flightName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("flightdep")+'- Arr: '+$(this).attr("flightarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("flightprice")+'</span></span></div>');
                                    			}
                                    				
                                    		});
                                    		
                                    	}
                                    	else{
											$('#selected_quote').append('<div id="quoteContentflight'+i+'" class="quote-row-flight"><div class="container-fluid pgbg flight'+i+'"> <div class="row myrow" > <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">Flight </span></div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from"> '+trvFrom+'</span><span class="quote-to1"> - '+trvTo+' </span></span> </div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date">'+trvDate+' </span> </div> </div><div class="row flight-content'+i+'" style="background-color:#fff;" >');
											$('#selected_quote').append('</div></div>');
											$("input[name='cbGqfid[]']:checked").each(function () {
												if (prefrdselected == $(this).attr("flightId") || prefrdselectedReturn == $(this).attr("flightId")) {
												$('.flight-content'+i+'').append('<div class="col-sm-2 col-md-2 bghlt col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/AirlineLogo/'+$(this).attr("flightlogo")+'.gif" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 imgsty bghlt col-xs-6" ><span class="splane quote-name3">'+$(this).attr("flightName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("flightdep")+'- Arr: '+$(this).attr("flightarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("flightprice")+'</span></span></div>');
								
												}
												else{
												$('.flight-content'+i+'').append('<div class="col-sm-2 col-md-2 col-xs-6 quote-image3 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/AirlineLogo/'+$(this).attr("flightlogo")+'.gif" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 imgsty col-xs-6" ><span class="splane quote-name3">'+$(this).attr("flightName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("flightdep")+'- Arr: '+$(this).attr("flightarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("flightprice")+'</span></span></div>');
												}
													
											});
                                    	}
                                        modal.enableButton();
                                        modal.closeModal();
                                    },
                                });
                            }
                        });
                        //break;
                }
            },
            getQuoteBusD: function (e) {
                e.preventDefault();
                var i = $(this).val();

                var trvDate = document.getElementById('txtDate' + i).value;

                if (trvDate) {
                    var trvDate = trvDate.split("/").reverse().join("-");
                }
                
                var modeval = document.getElementById('selModeofTransp' + i).value;
   
                var trvFrom = document.getElementById('frombus' + i).value;
        
                var trvTo = document.getElementById('tobus' + i).value;
             
                //var stay		=document.getElementById('selStayDur'+i).value;

                var fld = 'txtCost' + i;
                
                var ImageUrl = document.getElementById('ImageUrl').value;

                if (!modeval) {
                    alert('Please select expense category properly.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }

                if (!trvDate) {
                    alert('Please enter date.');
                    document.getElementById('txtDate' + i).focus();
                    return false;
                }

                if (!trvFrom) {
                    alert('Please enter place properly.');
                    document.getElementById('from' + i).focus();
                    return false;
                }

                if (!trvTo) {
                    alert('Please enter place properly.');
                    document.getElementById('to' + i).focus();
                    return false;
                }

                modeval = parseInt(modeval);
                var switchMode = modeval - 1;
                switch (switchMode)
                {
                    case switchMode:
                        wp.ajax.send('get-mode-quote', {
                            success: function (mode) {
                                console.log(mode);
                                var modetext = mode[switchMode].MOD_Name;
                                console.log(modetext);
                                $.erpPopup({
                                    title: wpErpHr.popup.get_quote,
                                    button: 'Cancel',
                                    id: 'get_quote',
                                    extraClass: 'fullPage',
                                    onReady: function () {
                                        var modal = this;
                                        $('header', modal).after($('<div class="bus-loader"></div>').show());
                                        wp.ajax.send('get-quote', {
                                            data: {
                                                expdate: trvDate,
                                                mode: modetext,
                                                from: trvFrom,
                                                to: trvTo,
                                                fld: fld,
                                                iteration: i,
                                            },
                                            success: function (response) {
                                                //console.log(response);
                                                
                                                console.log(response);
                                            
                                                var html = wp.template('bus-booking-quote')(response);
                                                $('.content', modal).html(html);
                                                $('.dt').html(trvDate);
                                                $('.busImage').html('<img src="' + ImageUrl + '/images/bus.png"></img>');
                                                $('.busfrom').html(trvFrom);
                                                $('.busto').html(trvTo);
                                                $('.bus-loader', modal).remove();
                                            },
                                            error: function (response) {
                                            	console.log(response);
                                                console.log("fail");
                                                return false;
                                                console.log('fail');
                                                //console.log(response);
                                                var content = '';
                                                //var resp = jQuery.parseJSON(response);
                                                //var obj = resp.data;
                                                /*console.log(obj);
                                                
                                                
  
                                                content += '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
                                                content += '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
						content += '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
                                                content += '<div class="panel-group">';
						content +=   '<div class="panel panel-default">';
						content +=     '<div class="panel-heading">';
						content +=       '<h4 class="panel-title">';
						content +=         '<a data-toggle="collapse" href="#collapse1">Filter</a>';
						content +=       '</h4>';
						content +=     '</div>';
						content +=    '<div id="collapse1" class="panel-collapse collapse">';
					        content +=      '<div class="panel-body">';
			                  
					        content +=      '		<div class="fl" style="width:16%">';
						content +=      '		   <div class="filter-header filter-bustype">';
						content +=      '		      BUS TYPES';
						content +=      '		   </div>';
						content +=      '		   <ul>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Sleeper" title="AC Sleeper">AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Sleeper" title="Non-AC Sleeper">Non-AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Seater" title="AC Seater">AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Seater" title="Non-AC Seater">Non-AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Cab" data-type="onward">';
						content +=      '		         <label for="busType_Cab" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Cab" title="Cab">Cab</label>';
						content +=      '		      </li>';
						content +=      '		   </ul>';
						content +=      '		</div></div>';
					
					        content +=      '		<div class="fl" style="width:16%">';
						content +=      '		   <div class="filter-header filter-bustype">';
						content +=      '		      BUS TYPES';
						content +=      '		   </div>';
						content +=      '		   <ul>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Sleeper" title="AC Sleeper">AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Sleeper" title="Non-AC Sleeper">Non-AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Seater" title="AC Seater">AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Seater" title="Non-AC Seater">Non-AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Cab" data-type="onward">';
						content +=      '		         <label for="busType_Cab" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Cab" title="Cab">Cab</label>';
						content +=      '		      </li>';
						content +=      '		   </ul>';
						content +=      '		</div></div>';
					
						content +=    '</div>';
						content += '</div>';
						content += '</div>';
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
						content += '<div style="margin-top:60px" id="grade-limit" class="postbox leads-actions closed">';
						content += '<div class="handlediv" title="Click to toggle"><br></div>';
						content += '<h3 class="hndle" style="text-align:center"><span>Filter Options</span></h3>';
						content += '<div class="inside">';
						content += '<div class="row">';
                                                content += '<div class="col-lg-12">';
                                                content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                content += '</div>';
                                                content += '<table style="margin-bottom: 20px;">';
                                                content += '<thead >';
                                                content += '<tr height="30">';
                                                content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                $.each(JSON.parse(obj), function (key, value) {
                                                    content += '<option value=' + value.GQF_AirlineName + '>' + value.GQF_AirlineName + '</option>';
                                                });
                                                content += '</select></div></div></strong></th>'
                                                content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '</table>';
                                                content += '</div>';
						content += '</div>';
						content += '</div>';
						content += '</div>';
                                                

                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Bus </strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Available</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>PREFERED</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong><i class="fa fa-check"></i></strong></th>';
                                                content += ' </tr>';
                                                content += '</thead>';
                                                content += '<tbody id="fbody" align="center">';
                                                $.each(JSON.parse(obj), function (key, value) {
                                                    content += '<tr>';
                                                    content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_DepTIme) + '</b><br>' + trvFrom + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_Stops + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_id" style="padding-left:20px;"><b>' + value.GQF_Id + '</b></td>';
                                                    content += '<td data-title="Open"><input type="radio" name="prefered" value=' + value.GQF_Id + ',' + value.GQF_Price + '></td>';
                                                    content += '<td data-title="PREFERED"><input name="cbGqfid[]" style="margin-left: 20px; id="cbGqfid[]" type="checkbox" value="' + value.GQF_Id + '" class="checkbox"></td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                    content += '</tr>';

                                                });
                                                content += '</tbody>';
                                                content += '</table>';
                                                //$('.content', modal).html(content);
                                                */
                                                ///var resp = jQuery.parseJSON(response);
                                                //var obj = resp.data;
                                                //var html = wp.template('bus-get-quote')(obj);
                                                console.log(response);
                                                console.log("testerr");
                                		//$('.content', modal).html(html);
                                                $('.bus-loader', modal).remove();
                                            },
                                            
                                        });
                                    },
                                    onSubmit: function (modal) {
                                       
		                            modal.enableButton();
		                            modal.closeModal();
		                    },
                                });
                            }
                        });

                }


            },
            getQuoteBus: function (e) {
                e.preventDefault();
                var i = $(this).val();

                var trvDate = document.getElementById('busDatefrom' + i).value;

                if (trvDate) {
                    var trvDate = trvDate.split("/").reverse().join("-");
                }
                
                var modeval = document.getElementById('busselModeofTransp' + i).value;
   
                var trvFrom = document.getElementById('frombus' + i).value;
        
                var trvTo = document.getElementById('tobus' + i).value;
                
                var desc = document.getElementById('bustxtaExpdesc' + i).value;
             
                //var stay		=document.getElementById('selStayDur'+i).value;
                var DateChanged = trvDate.split("-");
                var newDate = DateChanged[1] + '-' + DateChanged[0] + '-' + DateChanged[2].toString().substring(2);
                var dateData = newDate; //For example
                
                var dateObject = new Date(Date.parse(dateData));
                
                var dateReadable = dateObject.toDateString();

                var fld = 'txtCost' + i;
                
                var ImageUrl = document.getElementById('ImageUrl').value;

                if (!modeval) {
                    alert('Please select expense category properly.');
                    document.getElementById('selModeofTransp' + i).focus();
                    return false;
                }

                if (!trvDate) {
                    alert('Please enter date.');
                    document.getElementById('txtDate' + i).focus();
                    return false;
                }
                
                if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc' + i).focus();
                    return false;
                }

                if (!trvFrom) {
                    alert('Please enter place properly.');
                    document.getElementById('from' + i).focus();
                    return false;
                }

                if (!trvTo) {
                    alert('Please enter place properly.');
                    document.getElementById('to' + i).focus();
                    return false;
                }

                modeval = parseInt(modeval);
                var switchMode = modeval - 1;
                switch (switchMode)
                {
                    case switchMode:
                        wp.ajax.send('get-mode-quote', {
                            success: function (mode) {
                                console.log(mode);
                                var modetext = mode[switchMode].MOD_Name;
                                console.log(modetext);
                                $.erpPopup({
                                    title: wpErpHr.popup.get_quote,
                                    //button: wpErpCompany.popup.update,
                                    id: 'get_quote',
                                    extraClass: 'fullPage',
                                    onReady: function () {
                                        var modal = this;
                                        $('header', modal).after($('<div class="bus-loader"></div>').show());
                                        wp.ajax.send('get-quote', {
                                            data: {
                                                expdate: trvDate,
                                                mode: modetext,
                                                from: trvFrom,
                                                to: trvTo,
                                                fld: fld,
                                                iteration: i,
                                            },
                                            success: function (response) {
                                                //console.log(response);
                                                //console.log("success");
                                                //return false;
                                                /*console.log(response);
                                                var content = '';
                                                var obj = jQuery.parseJSON(response);
                                                content += '<div class="row">';
                                                content += '<div class="col-lg-12">';
                                                content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                content += '</div>';
                                                content += '<table style="margin-bottom: 20px;">';
                                                content += '<thead >';
                                                content += '<tr height="30">';
                                                content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                $.each(obj, function (key, value) {
                                                    content += '<option value=' + value.GQF_AirlineName + '>' + value.GQF_AirlineName + '</option>';
                                                });
                                                content += '</select></div></div></strong></th>'
                                                content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '</div>';

                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Bus </strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Available</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>PREFERED</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong><i class="fa fa-check"></i></strong></th>';
                                                content += ' </tr>';
                                                content += '</thead>';
                                                content += '<tbody id="fbody" align="center">';
                                                $.each(obj, function (key, value) {
                                                    content += '<tr>';
                                                    content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_DepTIme) + '</b><br>' + trvFrom + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_Stops + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                    content += '<td data-title="Open"><input type="radio" name="prefered" value=' + value.GQF_Id + ',' + value.GQF_Price + '></td>';
                                                    content += '<td data-title="PREFERED"><input name="cbGqfid[]" style="margin-left: 20px; id="cbGqfid[]" type="checkbox" value="' + value.GQF_Id + '" class="checkbox"></td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                    content += '</tr>';

                                                });
                                                content += '</tbody>';
                                                content += '</table>';
                                                */
                                                //console.log(response);
                                                var html = wp.template('bus-get-quote')(response);
                                                $('.content', modal).html(html);
                                                $('.dt').html(dateReadable);
                                                $('.busImage').html('<img src="' + ImageUrl + '/images/bus.png"></img>');
                                                $('.busfrom').html(trvFrom);
                                                $('.busto').html(trvTo);
                                                $('.bus-loader', modal).remove();
                                            },
                                            error: function (response) {
                                            	console.log(response);
                                                console.log("fail");
                                                return false;
                                                console.log('fail');
                                                //console.log(response);
                                                var content = '';
                                                //var resp = jQuery.parseJSON(response);
                                                //var obj = resp.data;
                                                /*console.log(obj);
                                                
                                                
  
                                                content += '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
                                                content += '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
						content += '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
                                                content += '<div class="panel-group">';
						content +=   '<div class="panel panel-default">';
						content +=     '<div class="panel-heading">';
						content +=       '<h4 class="panel-title">';
						content +=         '<a data-toggle="collapse" href="#collapse1">Filter</a>';
						content +=       '</h4>';
						content +=     '</div>';
						content +=    '<div id="collapse1" class="panel-collapse collapse">';
					        content +=      '<div class="panel-body">';
			                  
					        content +=      '		<div class="fl" style="width:16%">';
						content +=      '		   <div class="filter-header filter-bustype">';
						content +=      '		      BUS TYPES';
						content +=      '		   </div>';
						content +=      '		   <ul>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Sleeper" title="AC Sleeper">AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Sleeper" title="Non-AC Sleeper">Non-AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Seater" title="AC Seater">AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Seater" title="Non-AC Seater">Non-AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Cab" data-type="onward">';
						content +=      '		         <label for="busType_Cab" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Cab" title="Cab">Cab</label>';
						content +=      '		      </li>';
						content +=      '		   </ul>';
						content +=      '		</div></div>';
					
					        content +=      '		<div class="fl" style="width:16%">';
						content +=      '		   <div class="filter-header filter-bustype">';
						content +=      '		      BUS TYPES';
						content +=      '		   </div>';
						content +=      '		   <ul>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Sleeper" title="AC Sleeper">AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Sleeper" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Sleeper" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Sleeper" title="Non-AC Sleeper">Non-AC Sleeper</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_AC-Seater" title="AC Seater">AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Non-AC-Seater" data-type="onward">';
						content +=      '		         <label for="busType_Non-AC-Seater" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Non-AC-Seater" title="Non-AC Seater">Non-AC Seater</label>';
						content +=      '		      </li>';
						content +=      '		      <li class="checkbox">';
						content +=      '		         <input type="checkbox" id="busType_Cab" data-type="onward">';
						content +=      '		         <label for="busType_Cab" class="custom-checkbox"></label>';
						content +=      '		         <label for="busType_Cab" title="Cab">Cab</label>';
						content +=      '		      </li>';
						content +=      '		   </ul>';
						content +=      '		</div></div>';
					
						content +=    '</div>';
						content += '</div>';
						content += '</div>';
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
						content += '<div style="margin-top:60px" id="grade-limit" class="postbox leads-actions closed">';
						content += '<div class="handlediv" title="Click to toggle"><br></div>';
						content += '<h3 class="hndle" style="text-align:center"><span>Filter Options</span></h3>';
						content += '<div class="inside">';
						content += '<div class="row">';
                                                content += '<div class="col-lg-12">';
                                                content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                content += '</div>';
                                                content += '<table style="margin-bottom: 20px;">';
                                                content += '<thead >';
                                                content += '<tr height="30">';
                                                content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                $.each(JSON.parse(obj), function (key, value) {
                                                    content += '<option value=' + value.GQF_AirlineName + '>' + value.GQF_AirlineName + '</option>';
                                                });
                                                content += '</select></div></div></strong></th>'
                                                content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '</table>';
                                                content += '</div>';
						content += '</div>';
						content += '</div>';
						content += '</div>';
                                                

                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Bus </strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Available</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>PREFERED</strong></th>';
                                                content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong><i class="fa fa-check"></i></strong></th>';
                                                content += ' </tr>';
                                                content += '</thead>';
                                                content += '<tbody id="fbody" align="center">';
                                                $.each(JSON.parse(obj), function (key, value) {
                                                    content += '<tr>';
                                                    content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_DepTIme) + '</b><br>' + trvFrom + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_Stops + '</td>';
                                                    content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_id" style="padding-left:20px;"><b>' + value.GQF_Id + '</b></td>';
                                                    content += '<td data-title="Open"><input type="radio" name="prefered" value=' + value.GQF_Id + ',' + value.GQF_Price + '></td>';
                                                    content += '<td data-title="PREFERED"><input name="cbGqfid[]" style="margin-left: 20px; id="cbGqfid[]" type="checkbox" value="' + value.GQF_Id + '" class="checkbox"></td>';
                                                    content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                    content += '</tr>';

                                                });
                                                content += '</tbody>';
                                                content += '</table>';
                                                //$('.content', modal).html(content);
                                                */
                                                ///var resp = jQuery.parseJSON(response);
                                                //var obj = resp.data;
                                                //var html = wp.template('bus-get-quote')(obj);
                                                console.log(response);
                                                console.log("testerr");
                                		//$('.content', modal).html(html);
                                                $('.bus-loader', modal).remove();
                                            },
                                        });
                                    },
                                    onSubmit: function (modal) {
                                        $("#bustxtCost"+i).prop("readonly",true);
                                        var allVals = [];
                                        $('input[name="cbGqfid[]"]:checked').each(function () {
                                            allVals.push($(this).val());
                                        });
                                        if(allVals.length<3 || allVals.length>3){
                                        alert("please Check only 3 options");
                                        $('.erp-loader').remove();
                                        return false;
                                        }
                                        
                                        
                                        var myRadio = $('input[name=prefered]');
                                        var checkedValue = myRadio.filter(':checked').val();
                                        //var quote_price = checkedValue;
                                        var quote_price = checkedValue.split(',')[1];
                                        //console.log(quote_price);
                                        var prefrdselected = checkedValue.split(',')[0];
                                        if($.inArray( prefrdselected, allVals ) == -1){
                                        	alert("please select prefered item within the checked items");
                                        	$('.erp-loader').remove();
                                        	return false;
                                        }
                                        //var prefrdselected = quote_price;
                                        if ( $('.bus'+i).length ) {
                                        	//$(".erase3").val('');
                                        	$("#hiddenPrefrdSelectedbus"+i).val('');
                                        	$("#hiddenAllPreferedbus"+i).val('');
                                        	var resultObj = $("#hiddenPrefrdSelectedbus"+i);
	                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
	                                        resultObj .val( stringToAppend + prefrdselected );
	                                        
	                                        var resultObj = $("#hiddenAllPreferedbus"+i);
	                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
	                                        resultObj .val( stringToAppend + allVals );
                                        }
                                        else{
                                        var resultObj = $("#hiddenPrefrdSelectedbus"+i);
                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                                        resultObj .val( stringToAppend + prefrdselected );
                                        
                                        var resultObj = $("#hiddenAllPreferedbus"+i);
                                        var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                                        resultObj .val( stringToAppend + allVals );
                                        }

                                        //$('#hiddenPrefrdSelected1').val(prefrdselected);
                                        //$('#hiddenAllPrefered1').val(allVals);
                                        $('#bustxtCost' + i).val(quote_price);
                                        //console.log(i);
                                        var req_type = $('#req_type').val();
                                        if(req_type == 'group'){
                                            calcTotalCost();
                                        }
                                        else{
                                        valCostPre(quote_price,i,modeval);
                                        } 
                                        
                                        //var crows = $( '#selected_quote' ).children(".quote-row-bus").length;
                                        if($('.bus'+i).length){
                                            $('#quoteContentbus'+i).html('<div class="container-fluid pgbg bus'+i+'"> <div class="row myrow" > <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div> <div class="col-sm-4 col-xs-4 col-md-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from"> '+trvFrom+'</span><span class="quote-to1"> - '+trvTo+' </span></span> </div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date">'+trvDate+' </span> </div> </div><div class="row bus-content'+i+'" style="background-color:#fff;" ></div></div>');
                                            $("input[name='cbGqfid[]']:checked").each(function () {
                                                if (prefrdselected == $(this).attr("busId")) {
                                                $('.bus-content'+i+'').append('<div class="bghlt col-sm-2 col-md-2 pt15 pb15 col-xs-6 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/quote-bus.png" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 bghlt col-xs-6 imgsty" ><span class="splane quote-name3">'+$(this).attr("busName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("busdep")+'- Arr: '+$(this).attr("busarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("busprice")+'</span></span></div>');
                                                }
                                                else{
                                                $('.bus-content'+i+'').append('<div class="col-sm-2 col-md-2 pt15 pb15 col-xs-6 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/quote-bus.png" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 col-xs-6 imgsty" ><span class="splane quote-name3">'+$(this).attr("busName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("busdep")+'- Arr: '+$(this).attr("busarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("busprice")+'</span></span></div>');
                                                }
                                                    
                                            });
                                            
                                        }
                                        else{
                                                $('#selected_quote').append('<div id="quoteContentbus'+i+'" class="quote-row-bus"><div class="container-fluid pgbg bus'+i+'"> <div class="row myrow" > <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from"> '+trvFrom+'</span><span class="quote-to1"> - '+trvTo+' </span></span> </div> <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date">'+trvDate+' </span> </div> </div><div class="row bus-content'+i+'" style="background-color:#fff;" >');
                                                $('#selected_quote').append('</div></div>');
                                                $("input[name='cbGqfid[]']:checked").each(function () {
                                                    if (prefrdselected == $(this).attr("busId")) {
                                                    $('.bus-content'+i+'').append('<div class="bghlt col-sm-2 col-md-2 pt15 pb15  col-xs-6 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/quote-bus.png" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 bghlt col-xs-6 imgsty" ><span class="splane quote-name3">'+$(this).attr("busName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("busdep")+'- Arr: '+$(this).attr("busarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("busprice")+'</span></span></div>');
                                                    }
                                                    else{
                                                    $('.bus-content'+i+'').append('<div class="col-sm-2 col-md-2 pt15 pb15  col-xs-6 imgsty" ><img alt="spicejet" src="' + ImageUrl + '/images/quote-bus.png" class="img-responsive"></div><div class="col-sm-2 col-md-2 pt10 col-xs-6 imgsty" ><span class="splane quote-name3">'+$(this).attr("busName")+'</span> <br> <span class="splane quote-dep3"> Dep: '+$(this).attr("busdep")+'- Arr: '+$(this).attr("busarr")+' </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3">'+$(this).attr("busprice")+'</span></span></div>');
                                                    }
                                                        
                                                });
                                        }
                                        
                                        modal.enableButton();
                                        modal.closeModal();
                                    },
                                });
                            }
                        });

                }


            },
            getQuoteSearch: function (e) {
                e.preventDefault();

                var arlid = $('#selBuses').val();
                var tsid = $('#selTimeSlots').val();
                var ac = $('#selac').val();

                console.log(arlid);
                console.log(tsid);
                console.log(ac);


                var jo = $("#fbody").find("tr");
                if (arlid == "" && tsid == "" && ac == "") {
                    jo.show();
                    return;
                }
                //hide all the rows
                jo.hide();
                if (arlid && tsid && ac) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + arlid + "')") && $t.is(":contains('" + tsid + "')") && $t.is(":contains('" + ac + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
                if (arlid && tsid) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + arlid + "')") && $t.is(":contains('" + tsid + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
                if (arlid && ac) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + arlid + "')") && $t.is(":contains('" + ac + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
                if (tsid && ac) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + tsid + "')") && $t.is(":contains('" + ac + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
                if (arlid) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + arlid + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
                if (tsid) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + tsid + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
                if (ac) {
                    //Recusively filter the jquery object to get results.
                    jo.filter(function (i, v) {
                        var $t = $(this);
                        //for (var d = 0; d < arlid.length; ++d) {
                        if ($t.is(":contains('" + ac + "')")) {
                            return true;
                        }
                        //}
                        return false;
                    })
                            //show the rows that match.
                            .show();
                }
            },
        },
        /**
         * Handle postbox toggle effect
         *
         * @param  {object} e
         *
         * @return {void}
         */
        handleToggle: function (e) {
            e.preventDefault();
            var self = $(this),
                    postboxDiv = self.closest('.postbox');
            if (postboxDiv.hasClass('closed')) {
                postboxDiv.removeClass('closed');
            } else {
                postboxDiv.addClass('closed');
            }
        },
        reloadPage: function () {
            $('.erp-area-left').load(window.location.href + ' #erp-area-left-inner', function () {
                $('.select2').select2();
            });
        },
        financerequests: {
            approve: function (e) {
                e.preventDefault();
                wp.ajax.send('approve_finance_request', {
                    data: {
                        et: $('#et').val(),
                        empid: $('#empid').val(),
                        reqid: $('#reqid').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.financeactions');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                //alert(reqid);

            },
            rejection: function (e) {
                e.preventDefault();
                wp.ajax.send('approve_finance_reject', {
                    data: {
                        et: $('#et').val(),
                        empid: $('#empid').val(),
                        reqid: $('#reqid').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        //$('body').load(window.location.href + '.financeactions');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                //alert(reqid);

            },
        },
        payment: {
            reload: function () {
                $('.erp-employee-payment-wrap').load(window.location.href + ' .erp-employee-payment-wrap-inner');
            },
            approve: function (e) {
                e.preventDefault();
                wp.ajax.send('traveldesk_approve_request', {
                    data: {
                        //et: $('#et').val(),
                        //empid: $('#empid').val(),
                        reqid: $('#reqid').val(),
                        tdcid: $('#tdcid').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_CRP_EMP.payment.reload();
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                location.reload();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                //alert(reqid);

            },
            rejection: function (e) {
                e.preventDefault();
                wp.ajax.send('traveldesk_reject_request', {
                    data: {
                        // et: $('#et').val(),
                        //empid: $('#empid').val(),
                        reqid: $('#reqid').val(),
                        tdcid: $('#tdcid').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_CRP_EMP.payment.reload();
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                //alert(reqid);

            },
            buttontdclaimApproval: function (e) {
                e.preventDefault();
                if (confirm("Sure to approve this claim ?"))
                    return true;
                else
                    return false;
            },
            buttontdclaimRejection: function (e) {
                e.preventDefault();
                if (confirm("Sure to reject this claim ?"))
                    return true;
                else
                    return false;
            },
            buttonedit: function (e) {
                //alert('fdjf');
                e.preventDefault();
                $('#detailsformid').css('display', 'none');
                $('#updateformid').css('display', 'block');
            },
            resetupdateform: function (e) {
                e.preventDefault();
                $('#updateformid').css('display', 'none');
                $('#detailsformid').css('display', 'block');
            },
            detailscancelid: function (e) {
                e.preventDefault();
                $('#detailsformid').css('display', 'block');
                $('#updateformid').css('display', 'none');
            },
            create: function (e) {
                e.preventDefault();
                var paymnt_mode = $('#selPaymentMode').val();
                if (paymnt_mode == "") {

                    alert("Please select payment mode.");
                    $('#selPaymentMode').focus();
                    return false;
                }
                switch (paymnt_mode) {

                    case '1':
                        
                        var chq_no = $('#txtChequeNumber').val();
                        var chq_dt = $('#txtCqDate').val();
                        var chq_bb = $('#txtBankBranch').val();
                        if (chq_no == "") {
                            alert("Please enter cheque number.");
                            $('#txtChequeNumber').focus();
                            return false;
                        }

                        if (chq_dt == "") {
                            alert("Please enter cheque date.");
                            $('#txtCqDate').focus();
                            return false;
                        }
                        if (chq_bb == "") {
                            alert("Please enter issuing bank/branch.");
                            $('#txtBankBranch').focus();
                            return false;
                        }

                        break;
                        //-----------------------------------------

                    case '2':

                        var cash_c = $('#txtaCshComments').val();
                        if (cash_c == "") {
                            alert("Please enter payment details.");
                            $('#txtChequeNumber').focus();
                            return false;
                        }
                        break;
                        //-----------------------------------------

                    case '3':

                        var bt_transid = $('#txtTransId').val();
                        var bt_bankdet = $('#txtBankdetails').val();
                        var bt_date = $('#txtBBDate').val();
                        if (bt_transid == "") {
                            alert("Please enter transaction id.");
                            $('#txtTransId').focus();
                            return false;
                        }

                        if (bt_bankdet == "") {
                            alert("Please enter bank details.");
                            $('#txtBankdetails').focus();
                            return false;
                        }

                        if (bt_date == "") {
                            alert("Please enter transaction date.");
                            $('#txtBBDate').focus();
                            return false;
                        }

                        break;
                        //-----------------------------------------

                    case '4':

                        var other_c = $('#txtaOtherComments').val();
                        if (other_c == "") {
                            alert("Please enter payment details.");
                            $('#txtaOtherComments').focus();
                            return false;
                        }

                        break;
                }
                wp.ajax.send('payment_details_create', {
                    data: {
                        txtChequeNumber: $('#txtChequeNumber').val(),
                        tdcid: $('#tdcid').val(),
                        reqid: $('#reqid').val(),
                        txtCqDate: $('#txtCqDate').val(),
                        txtBankBranch: $('#txtBankBranch').val(),
                        selPaymentMode: $('#selPaymentMode').val(),
                        txtaCshComments: $('#txtaCshComments').val(),
                        txtTransId: $('#txtTransId').val(),
                        txtBankdetails: $('#txtBankdetails').val(),
                        txtBBDate: $('#txtBBDate').val(),
                        txtaOtherComments: $('#txtaOtherComments').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '#paymentdetailsreload');
                        // $("#paymentdetailsreload").load();
                        // WeDevs_CRP_EMP.payment.reload();
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }


                    },
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
            change: function (e) {
                e.preventDefault();
                //alert('testing');
                //alert(this.value);
                var val = this.value;
                switch (val) {

                    case '1':
                        $('#chequeid').css("display","block");
                        $('#cashid').css("display","none");
                        $('#banktransferid').css("display","none");
                        $('#othersid').css("display","none");
                        
                        $('.chequeid').css("display","block");
                        $('.cashid').css("display","none");
                        $('.banktransferid').css("display","none");
                        $('.othersid').css("display","none");
                        break;
                    case '2':
                        $('#cashid').css("display","block");
                        $('#chequeid').css("display","none");
                        $('#banktransferid').css("display","none");
                        $('#othersid').css("display","none");
                        
                        $('.cashid').css("display","block");
                        $('.chequeid').css("display","none");
                        $('.banktransferid').css("display","none");
                        $('.othersid').css("display","none");
                        break;
                    case '3':
                        $('#banktransferid').css("display","block");
                        $('#chequeid').css("display","none");
                        $('#cashid').css("display","none");
                        $('#othersid').css("display","none");
                        
                        $('.banktransferid').css("display","block");
                        $('.chequeid').css("display","none");
                        $('.cashid').css("display","none");
                        $('.othersid').css("display","none");
                        break;
                    case '4':
                        $('#othersid').css("display","block");
                        $('#chequeid').css("display","none");
                        $('#cashid').css("display","none");
                        $('#banktransferid').css("display","none");
                        
                        $('.othersid').css("display","block");
                        $('.chequeid').css("display","none");
                        $('.cashid').css("display","none");
                        $('.banktransferid').css("display","none");
                        break;
                    default:
                        $('#fieldsContainr').html('---');
                }
            },
        },
        delegate: {
            create: function (e) {
                e.preventDefault();
                wp.ajax.send('create-delegate', {
                    data: $(this).serialize(),
                    success: function (resp) {
                        console.log("success");
                        console.log(resp);
                        $('.erp-loader').hide();
                        $('#submit-pre-travel-request').removeClass('disabled');
                        switch (resp.status) {
                            case 'info':
                                $('#p-info').html(resp.message);
                                $('#info').show();
                                $("#info").delay(5000).slideUp(200);
                                break;
                            case 'notice':
                                $('#p-notice').html(resp.message);
                                $('#notice').show();
                                $("#notice").delay(5000).slideUp(200);
                                break;
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
            },
            edit: function (e) {
                e.preventDefault();
                wp.ajax.send('edit-delegate', {
                    data: $(this).serialize(),
                    success: function (resp) {
                        console.log("success");
                        console.log(resp);
                        $('.erp-loader').hide();
                        $('#submit-pre-travel-request').removeClass('disabled');
                        switch (resp.status) {
                            case 'info':
                                $('#p-info').html(resp.message);
                                $('#info').show();
                                $("#info").delay(5000).slideUp(200);
                                break;
                            case 'notice':
                                $('#p-notice').html(resp.message);
                                $('#notice').show();
                                $("#notice").delay(5000).slideUp(200);
                                break;
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
            },
        },
        booking: {
	    busEnterDetails: function(e){ 
	    e.preventDefault(); 
	    var data = $(this).serialize();
	    //console.log(data);return false;
	    window.location.replace("admin.php?page=generateForm&"+data);
            return false;
            },
            reserve: function(e){
            e.preventDefault();
            var data = $(this).serialize();
            wp.ajax.send('booking-reserve', {
                    data: $(this).serialize(),
                    success: function (resp) {
                        //console.log("success");
                         //console.log(resp);
                         //var obj = jQuery.parseJSON( resp );
                         //if(obj.Response.Error.ErrorCode>0){
                         	
                         	//$('#p-failure').html(obj.Response.Error.ErrorMessage);
                                //$('#failure').show();
                                //$("#failure").delay(5000).slideUp(200);
                                //window.location.replace("admin.php?page=flight-payment&"+data);
                                //return false;
                         //}
                         //else{
                         
                         
                         window.location.replace("admin.php?page=flight-payment&"+data+"&Tid="+resp);
                         return false;
                         //}
                         
                        switch (resp.status) {
                            case 'info':
                                $('#p-info').html(resp.message);
                                $('#info').show();
                                $("#info").delay(5000).slideUp(200);
                                break;
                            case 'notice':
                                $('#p-notice').html(resp.message);
                                $('#notice').show();
                                $("#notice").delay(5000).slideUp(200);
                                break;
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                location.replace("admin.php?page=TravelExpense&tab=My_Pre_Travel_Expenses");
                                
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        // console.log("failure");
                        console.log(error);
                    }
                });
            
            },
            reservebus: function(e){
            e.preventDefault();
            var data = $(this).serialize();
            window.location.replace("admin.php?page=bus-payment&"+data);
            
            },
            busBooking: function(e){
                e.preventDefault();
                var i = $('input[name="rdid[]"]:checked').val();
                if(!(i))
		i="3";
                var trvDate = document.getElementById('txtDate' + i).value;

                if (trvDate) {
                    var trvDate = trvDate.split("/").reverse().join("-");
                }

                //var modeval = document.getElementById('selModeofTransp' + i).value;

                var trvFrom = document.getElementById('from' + i).value;
                var trvTo = document.getElementById('to' + i).value;
                var busId = $('#busBooking').val();
                window.location.replace("admin.php?page=seatlayout&source="+trvFrom+"&destination="+trvTo+"&traveldate="+trvDate+"&busid="+busId+"&rdid="+i+"");
                return false;
                wp.ajax.send('get-seat-layout', {
                     data: {
                        id: busId,
                        expdate: trvDate,
                        from: trvFrom,
                        to: trvTo,
                    },
                    success: function (response) {
                        console.log(response);
                        var content = "";
                        
                        
                        $('.content-container').html(content);
                    },
                    error: function (response) {
                        console.log(response);
                        var content = response;
                        $('.content-container').html(content);
                    },
                });
                
                
            },

            flightBooking: function(e){
                //alert("test");
                e.preventDefault();
                var i = $('input[name="rdid[]"]:checked').val();
		if(!(i))
		i="1";
                var trvDate = document.getElementById('txtDate' + i).value;
		
                if (trvDate) {
                    var trvDate = trvDate.split("/").reverse().join("-");
                }

                //var modeval = document.getElementById('selModeofTransp' + i).value;

                var trvFrom = document.getElementById('from' + i).value;
                var trvTo = document.getElementById('to' + i).value;
                //var busId = $('#flightBooking').val();
                var TraceId = $(this).attr('traceid');
                var ResultIndex = $(this).attr('resultindex');
                var TokenId = $(this).attr('tokenid');
                
                //window.location.replace("admin.php?page=flight&source="+trvFrom+"&destination="+trvTo+"&traveldate="+trvDate+"&busid="+busId+"&rdid="+i+"");
                //return true;
                wp.ajax.send('get-fare-quote-flight', {
                     data: {
                        TraceId: TraceId,
                        ResultIndex: ResultIndex,
                        TokenId: TokenId,
                    },
                    success: function (response) {
                        console.log(response);
                    	var obj = $.parseJSON( response );
                        //console.log(obj.Response.IsPriceChanged);
                        var priceChange = obj.Response.IsPriceChanged;
                        var traceId = obj.Response.TraceId;
                        var BaseFare = obj.Response.Results.Fare.BaseFare;
                        var Tax = obj.Response.Results.Fare.Tax;
                        var ResultIndex = obj.Response.Results.ResultIndex;
                        var refundable = obj.Response.Results.IsRefundable;
                        
                        //var TaxBreakup = obj.Response.Results.Fare.TaxBreakup['TransactionFee'];
                        var TaxBreakup = "0";
                        var YQTax = obj.Response.Results.Fare.YQTax;
                        var AdditionalTxnFeePub = obj.Response.Results.Fare.AdditionalTxnFeePub;
                        var AirTransFee = "0";
                        window.location.replace("admin.php?page=generateFlightForm&pricechange="+priceChange+"&traceid="+traceId+"&resultindex="+ResultIndex+"&tokenid="+TokenId+"&basefare="+BaseFare+"&tax="+Tax+"&taxbreakup="+TaxBreakup+"&yqtax="+YQTax+"&ataxfeepub="+AdditionalTxnFeePub+"&atransfee="+AirTransFee+"&refundable="+refundable+"&rdid="+i+"");
                        return false;
                        var content = "";
                        
                        
                        $('.content-container').html(content);
                    },
                    error: function (response) {
                        console.log(response);
                        var content = response;
                        $('.content-container').html(content);
                    },
                });
                
                
            },

            selfBooking: function () {
                var atLeastOneIsChecked = $('input[name="rdid[]"]:checked').length > 0;
                var checked = $('input[name="rdid[]"]:checked').length > 1;
                if (!atLeastOneIsChecked)
                {
                    alert("Please check atlease one ticket to set as self book.");
                    return false;
                } 
                else if(checked)
                {
                    alert("You can check only one ticket for self booking.");
                    return false;
                }
                else {
					var selection = $('input[name="rdid[]"]:checked').val(); 
                    if (confirm("If these details have been sent to traveldesk for booking & not yet cancelled, then tickets will be automatically cancelled and these details will be duplicated & updated with Self Booking.Are you Sure to book ticket Yourself")) {
             var i = $('input[name="rdid[]"]:checked').val();
                        var trvDate = document.getElementById('txtDate' + i).value;

                        if (trvDate) {
                            var trvDate = trvDate.split("/").reverse().join("-");
                        }

                        var modeval = document.getElementById('selModeofTransp' + i).value;

                        var trvFrom = document.getElementById('from' + i).value;

                        var trvTo = document.getElementById('to' + i).value;

                        //var stay		=document.getElementById('selStayDur'+i).value;

                        var fld = 'txtCost' + i;
						
						var DateChanged = trvDate.split("-");
						var newDate = DateChanged[1] + '-' + DateChanged[0] + '-' + DateChanged[2].toString().substring(2);
						var dateData = newDate; //For example
						
						var dateObject = new Date(Date.parse(dateData));
						
						var dateReadable = dateObject.toDateString();
						
                        var ImageUrl = document.getElementById('ImageUrl').value;
                        console.log(trvDate,",",modeval,",",trvFrom,",",trvTo,",",fld);
                        modeval = parseInt(modeval);
                       	//var selection = $('#selected').val(); 
                        console.log(modeval);
                        if (modeval==1) 
						{
                                                  //console.log("hhgfgf");
                                                  var i = $('input[name="rdid[]"]:checked').val();
                        var trvDate = document.getElementById('txtDate' + i).value;

                        if (trvDate) {
                            var trvDate = trvDate.split("/").reverse().join("-");
                        }

                        var modeval = document.getElementById('selModeofTransp' + i).value;

                        var trvFrom = document.getElementById('from' + i).value;

                        var trvTo = document.getElementById('to' + i).value;

                        //var stay		=document.getElementById('selStayDur'+i).value;

                        var fld = 'txtCost' + i;
                        var ImageUrl = document.getElementById('ImageUrl').value;
                        console.log(trvDate,",",modeval,",",trvFrom,",",trvTo,",",fld);
                        modeval = parseInt(modeval);
                        var switchMode = modeval - 1;
                        switch (switchMode)
                        {
                            case switchMode:
                                wp.ajax.send('get-mode-quote', {
                                    success: function (mode) {
                                        console.log(mode);
                                        var modetext = mode[switchMode].MOD_Name;
                                        console.log(modetext);
                                        $.erpPopup({
                                            title: wpErpHr.popup.get_quote,
                                            button: 'Cancel',
                                            id: 'get_quote',
                                            extraClass: 'fullPage',
                                            onReady: function () {
                                                var modal = this;
                                                $('.content', modal).html('');
                                                $('header', modal).after($('<div class="flight-loader"></div>').show());
                                                wp.ajax.send('get-quote', {
                                                    data: {
                                                        expdate: trvDate,
                                                        mode: modetext,
                                                        from: trvFrom,
                                                        to: trvTo,
                                                        fld: fld,
                                                        iteration: i,
                                                        selection: selection,
                                                    },
                                                    success: function (response) {
                                                        //alert("hhgf");
                                                        /*var content = '';
                                                        var obj = jQuery.parseJSON(response);
							console.log(obj);
                                                        content += '<div class="row">';
                                                        content += '<div class="col-lg-12">';
                                                        content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                        
                                                        content += '<table class="wp-list-table widefat striped admins selfbooking" align="center">';
                                                        content += '<thead align="center" class="cf">';
                                                        content += '<tr>';
                                                        content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Flight </strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                        
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>Booking</strong></th>';
                                                        content += ' </tr>';
                                                        content += '</thead>';
                                                        content += '<tbody id="fbody" align="center">';
                                                  
                                                        $.each(obj, function (key, value) {
                                                            
                                                            content += '<tr>';
                                                            content += '<td><img src="' + ImageUrl + '/images/flight.png"></img></td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + value.GQF_DepTIme + '</b><br>' + trvFrom + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + value.GQF_ArrTime + '</b><br>' + trvTo + '</td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            
                                                            content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                            content += '<td data-title="BUS"><button type = "submit" class="button button-primary" id="flightBooking" value="' + value.GQF_Uid + '" resultindex="' + value.GQF_ResultIndex + '" traceid="' + value.GQF_TraceId+ '" tokenid="' + value.GQF_TokenId+ '">Select</button></td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                            content += '</tr>';
							    
                                                        });
                                                        content += '</tbody>';
                                                        content += '</table>';*/
                                                        
                                                        var html = wp.template('flight-booking-quote')(response);
	                                                $('.content', modal).html(html);
	                                                $('.dt').html(trvDate);
	                                                $('.flightfrom').html(trvFrom);
	                                                $('.flightto').html(trvTo);
	                                                $('.flight-loader', modal).remove();
                                                    },
                                                    error: function (response) {
                                                        
                                                        var content = '';
                                                        var resp = jQuery.parseJSON(response);
                                                	var obj = resp.data;
	
                                                        content += '<div class="row">';
                                                        content += '<div class="col-lg-12">';
                                                        content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                        content += '</div>';
                                                        content += '<table style="margin-bottom: 20px;">';
                                                        content += '<thead >';
                                                        content += '<tr height="30">';
                                                        content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                        content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                        $.each(JSON.parse(obj), function (key, value) {
                                                            content += '<option value=' + value.GQF_AirlineName + '>' + value.GQF_AirlineName + '</option>';
                                                        });
                                                        content += '</select></div></div></strong></th>'
                                                        content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                        content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                        content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                        content += '</tr>';
                                                        content += '</thead>';
                                                        content += '</div>';

                                                        content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                        content += '<thead align="center" class="cf">';
                                                        content += '<tr>';
                                                        content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Bus </strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Available</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>Booking</strong></th>';
                                                        content += ' </tr>';
                                                        content += '</thead>';
                                                        content += '<tbody id="fbody" align="center">';
                                                        $.each(JSON.parse(obj), function (key, value) {
                                                            content += '<tr>';
                                                            content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_DepTIme) + '</b><br>' + trvFrom + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_Stops + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                            content += '<td data-title="BUS"><button type = "button" class="button-primary" id="flightBooking" value="' + value.GQF_Uid + '">Select</button></td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                            content += '</tr>';

                                                        });
                                                        content += '</tbody>';
                                                        content += '</table>';
                                                        
                                                        $('.content', modal).html(content);
                                                        $('.loader', modal).remove();
                                                    },
                                                });
                                            },
                                            onSubmit: function (modal) {
                                                //console.log("submit");
                                               // var myRadio = $('input[name=prefered]');
                                               // var checkedValue = myRadio.filter(':checked').val();
                                               // var quote_price = checkedValue;
                                               // $('#txtCost' + i).val(quote_price);
                                               // var content = '';
                                               // content += '<div class="badge-wrap badge-aqua">';
                                               // content += '<table class="wp-list-table widefat striped admins">';
                                               /* content += '<thead>';
                                                content += '<tr>';
                                                content += '<th colspan="2">Bus</th>';
                                                content += '<th>' + trvDate + '</th>';
                                                content += '<th>' + trvFrom + ' to ' + trvTo + '</th>';
                                                content += '<th></th>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '</table>';
                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th style="text-align:center;color:#000000;"></th>';
                                                content += '<th style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                content += '<th style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                content += '<th style="color:#000000;"><strong>Available</strong></th>';
                                                content += '<th style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '<tbody align="center">';
                                                $("input[name='cbGqfid[]']:checked").each(function () {
                                                    content += '<tr>';
                                                    if (checkedValue == $(this).closest("tr").find('td:eq(6)').text()) {
                                                        content += '<td style="background:#0073aa;color:white"><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(1)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(2)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(3)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(4)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(5)').text() + '</td>';
                                                        content += '</tr>';
                                                    } else {
                                                        content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(1)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(2)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(3)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(4)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(5)').text() + '</td>';
                                                    }
                                                });
                                                content += '</tbody>';
                                                content += '</table>';
                                                content += '</div>';
                                                $('#selected_quote').append(content);*/
                                                modal.enableButton();
                                                modal.closeModal();
                                            },
                                        });
                                    }
                                });
						}
                                                  

						}
                                           else
						 {
                        var i = $('input[name="rdid[]"]:checked').val();
                        var trvDate = document.getElementById('txtDate' + i).value;

                        if (trvDate) {
                            var trvDate = trvDate.split("/").reverse().join("-");
                        }

                        var modeval = document.getElementById('selModeofTransp' + i).value;

                        var trvFrom = document.getElementById('from' + i).value;

                        var trvTo = document.getElementById('to' + i).value;

                        //var stay		=document.getElementById('selStayDur'+i).value;

                        var fld = 'txtCost' + i;
                        var ImageUrl = document.getElementById('ImageUrl').value;
                        console.log(trvDate,",",modeval,",",trvFrom,",",trvTo,",",fld);
                        modeval = parseInt(modeval);
                        var switchMode = modeval - 1;
                        switch (switchMode)
                        {
                            case switchMode:
                                wp.ajax.send('get-mode-quote', {
                                    success: function (mode) {
                                        console.log(mode);
                                        var modetext = mode[switchMode].MOD_Name;
                                        console.log(modetext);
                                        $.erpPopup({
                                            title: wpErpHr.popup.get_quote,
                                            button: 'Cancel',
                                            id: 'get_quote',
                                            extraClass: 'fullPage',
                                            onReady: function () {
                                                var modal = this;
                                                $('.content', modal).html('');
                                                $('header', modal).after($('<div class="bus-loader"></div>').show());
                                                wp.ajax.send('get-quote', {
                                                    data: {
                                                        expdate: trvDate,
                                                        mode: modetext,
                                                        from: trvFrom,
                                                        to: trvTo,
                                                        fld: fld,
                                                        iteration: i,
                                                        selection: selection,
                                                    },
                                                    success: function (response) {
                                                        /*var content = '';
                                                        var obj = jQuery.parseJSON(response);
	
                                                        content += '<div class="row">';
                                                        content += '<div class="col-lg-12">';
                                                        content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                        content += '</div>';
                                                        content += '<table style="margin-bottom: 20px;">';
                                                        content += '<thead >';
                                                        content += '<tr height="30">';
                                                        content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                        content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                        $.each(obj, function (key, value) {
                                                            content += '<option value=' + value.GQF_AirlineName + '>' + value.GQF_AirlineName + '</option>';
                                                        });
                                                        content += '</select></div></div></strong></th>'
                                                        content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                        content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                        content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                        content += '</tr>';
                                                        content += '</thead>';
                                                        content += '</div>';

                                                        content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                        content += '<thead align="center" class="cf">';
                                                        content += '<tr>';
                                                        content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Bus </strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Available</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>Booking</strong></th>';
                                                        content += ' </tr>';
                                                        content += '</thead>';
                                                        content += '<tbody id="fbody" align="center">';
                                                        $.each(obj, function (key, value) {
                                                            content += '<tr>';
                                                            content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_DepTIme) + '</b><br>' + trvFrom + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_Stops + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                            content += '<td data-title="BUS"><button type = "submit" class="button-primary" id="flightbooking" value="' + value.GQF_Uid + '">Select</button></td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                            content += '</tr>';

                                                        });
                                                        content += '</tbody>';
                                                        content += '</table>';*/
                                                        
                                                        var html = wp.template('bus-booking-quote')(response);
	                                                $('.content', modal).html(html);
	                                                $('.dt').html(dateReadable);
													$('.busImage').html('<img src="' + ImageUrl + '/images/bus.png"></img>');
													$('.busfrom').html(trvFrom);
													$('.busto').html(trvTo);
	                                                $('.bus-loader', modal).remove();
                                                    },
                                                    error: function (response) {
                                                        /*var content = '';
                                                        var resp = jQuery.parseJSON(response);
                                                	var obj = resp.data;
	
                                                        content += '<div class="row">';
                                                        content += '<div class="col-lg-12">';
                                                        content += '<h2>' + trvFrom + ' to ' + trvTo + ' - <span class="text-primary">' + trvDate + '</span></h2>';
                                                        content += '</div>';
                                                        content += '<table style="margin-bottom: 20px;">';
                                                        content += '<thead >';
                                                        content += '<tr height="30">';
                                                        content += '<th  width="30%" style="color:#000;"><label class="control-label">Filter by: </label></th>';
                                                        content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Buses:</label><div><select class="form-control" name="selBuses" id="selBuses"><option value="">All</option>';
                                                        $.each(JSON.parse(obj), function (key, value) {
                                                            content += '<option value=' + value.GQF_AirlineName + '>' + value.GQF_AirlineName + '</option>';
                                                        });
                                                        content += '</select></div></div></strong></th>'
                                                        content += '<th  style="color:#000;"><strong><div class="form-group"><label class="control-label">A/c or Non A/c :</label><div><select class="form-control" name="selac" id="selac"><option value="">All</option><option value="true">A/c</option><option value="false">Non A/C</option></select></div></div></strong></th>';
                                                        content += '<th style="color:#000;"><strong><div class="form-group"><label class="control-label">Departure Time:</label><div><select class="form-control" name="selTimeSlots" id="selTimeSlots"><option value="">All</option><option value="0 - 6 AM">0 - 6 AM</option><option value="6 AM - 12 PM">6 AM - 12 PM</option><option value="12 PM - 6 PM">12 PM - 6 PM</option><option value="6 PM - 12 AM">6 PM - 12 AM</option></select></div></div></strong></th>';
                                                        content += ' <td data-title="Open"><button class="button-primary" type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" value="7559,1431" style="margin-top:15px;">Show</button></td>';
                                                        content += '</tr>';
                                                        content += '</thead>';
                                                        content += '</div>';

                                                        content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                        content += '<thead align="center" class="cf">';
                                                        content += '<tr>';
                                                        content += '<th colspan="2" bgcolor="#00b5e5" width="30%" style="text-align:center;color:#000000;"><strong> Bus </strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="color:#000000;"><strong>Available</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                        content += '<th bgcolor="#00b5e5" style="text-align: center;color:#000000;"><strong>Booking</strong></th>';
                                                        content += ' </tr>';
                                                        content += '</thead>';
                                                        content += '<tbody id="fbody" align="center">';
                                                        $.each(JSON.parse(obj), function (key, value) {
                                                            content += '<tr>';
                                                            content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_AirlineName + '<br> - ' + value.GQF_FlightNumber + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_DepTIme) + '</b><br>' + trvFrom + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTime(value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" style="padding-left:20px;"><b>' + WeDevs_CRP_EMP.request.getTimeGroup(value.GQF_DepTIme, value.GQF_ArrTime) + '</b><br>' + trvTo + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" style="padding-left:20px;">' + value.GQF_Stops + '</td>';
                                                            content += '<td data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.GQF_Price + '</td>';
                                                            content += '<td data-title="BUS"><button type = "button" class="button-primary" id="busBooking" value="' + value.GQF_Uid + '">Select</button></td>';
                                                            content += '<td style="display:none;" data-title="BUS" class="text-left" id="quote_price" style="padding-left:20px;">' + value.AC + '</td>';
                                                            content += '</tr>';

                                                        });
                                                        content += '</tbody>';
                                                        content += '</table>';*/
                                                        
                                                        $('.content', modal).html(content);
                                                        $('.loader', modal).remove();
                                                    },
                                                });
                                            },
                                            onSubmit: function (modal) {
                                                //console.log("submit");
                                               // var myRadio = $('input[name=prefered]');
                                               // var checkedValue = myRadio.filter(':checked').val();
                                               // var quote_price = checkedValue;
                                               // $('#txtCost' + i).val(quote_price);
                                               // var content = '';
                                               // content += '<div class="badge-wrap badge-aqua">';
                                               // content += '<table class="wp-list-table widefat striped admins">';
                                                /*content += '<thead>';
                                                content += '<tr>';
                                                content += '<th colspan="2">Bus</th>';
                                                content += '<th>' + trvDate + '</th>';
                                                content += '<th>' + trvFrom + ' to ' + trvTo + '</th>';
                                                content += '<th></th>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '</table>';
                                                content += '<table class="wp-list-table widefat striped admins" align="center">';
                                                content += '<thead align="center" class="cf">';
                                                content += '<tr>';
                                                content += '<th style="text-align:center;color:#000000;"></th>';
                                                content += '<th style="color:#000000;"><strong>DEPARTURE</strong></th>';
                                                content += '<th style="color:#000000;"><strong>ARRIVAL</strong></th>';
                                                content += '<th style="color:#000000;"><strong>Available</strong></th>';
                                                content += '<th style="text-align: center;color:#000000;"><strong>PRICE</strong></th>';
                                                content += '</tr>';
                                                content += '</thead>';
                                                content += '<tbody align="center">';
                                                $("input[name='cbGqfid[]']:checked").each(function () {
                                                    content += '<tr>';
                                                    if (checkedValue == $(this).closest("tr").find('td:eq(6)').text()) {
                                                        content += '<td style="background:#0073aa;color:white"><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(1)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(2)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(3)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(4)').text() + '</td>';
                                                        content += '<td style="background:#0073aa;color:white">' + $(this).closest("tr").find('td:eq(5)').text() + '</td>';
                                                        content += '</tr>';
                                                    } else {
                                                        content += '<td><img src="' + ImageUrl + '/images/bus.png"></img></td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(1)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(2)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(3)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(4)').text() + '</td>';
                                                        content += '<td>' + $(this).closest("tr").find('td:eq(5)').text() + '</td>';
                                                    }
                                                });
                                                content += '</tbody>';
                                                content += '</table>';
                                                content += '</div>';
                                                $('#selected_quote').append(content);*/
                                                modal.enableButton();
                                                modal.closeModal();
                                            },
                                        });
                                    }
                                });
						}
						 }
                       
                        
                    } else {
                        return false;
                    }
                   

                }
            },
            tickets: function () {
                var atLeastOneIsChecked = $('input[name="rdid[]"]:checked').length > 0;
                if (!atLeastOneIsChecked)
                {
                    alert("Please check atlease one ticket to book.");
                    return false;
                }
                if (confirm("Are you sure want the travel desk to book the tickets ?"))
                    return true;
                else
                    return false;
            },
            cancelBooking: function () {
                var atLeastOneIsChecked = $('input[name="rdid[]"]:checked').length > 0;
                if (!atLeastOneIsChecked)
                {
                    alert("Please check atlease one ticket to cancel");
                    return false;
                } else
                {
                    var rdids = [];
                    $("input[name='rdid[]']:checked").each(function () {
                        rdids.push($(this).val());
                    });
                }


                if (confirm("Are you sure to cancel these tickets"))
                    return true;
                else
                    return false;
            }
        },
        travelRequest: {
			
			submitcliam: function (e) {
				e.preventDefault();
				var reqId = $("#reqid").val();
				wp.ajax.send('get-request-details', {
                    data: {
                        req_id: reqId,
                    },
                    success: function (resp) {
                        switch (resp.status) {
                            case 'success':  
                                //$('#p-success').html(resp.message);
                                //$('#success').show();
                                //location.reload();
                                location.replace("admin.php?page=Submit+Claim&reqid="+reqId);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
								return false;
                                break;
                        }
                    },
                    error: function (error) {
                        // console.log("failure");
                        console.log(error);
                    }
                });
			},
            reset: function () {
                //console.log("test");
                if (confirm("Are you sure to reset ?"))
                {
                $('#request_form')[0].reset();
				$('#selected_quote').html("");
				$('.flight').val("");
				$('.bus').val("");
                $('.bus3').hide();
                $('.flight1').hide();
                $("#txtCost1").prop("readonly",false);
                $("#txtCost3").prop("readonly",false);
                }
            },
            resetPost: function(){
                if (confirm("Are you sure to reset ?"))
                {
                $('#post-travel-req-form')[0].reset();
                $('.bus3').hide();
                $('.flight1').hide();
                $("#txtCost1").prop("readonly",false);
                $("#txtCost3").prop("readonly",false);
                }
            },
            
            resetedit: function () {
                console.log("test");
                $('#request_edit_form')[0].reset();
                $('#selected_quote').html('');
            }, 
	        saveValuePrepost: function (){
               $('#send_prepost_edit').val('send_prepost_save');
            },
            editValuePrepost: function (){
               $('#send_prepost_edit').val('send_prepost_edit');
            },
            saveValue: function (){
               $('#send_pre_travel_request_edit').val('save_pre_travel_request_edit');
            },
            editValue: function (){
               $('#send_pre_travel_request_edit').val('send_pre_travel_request_edit');
            },
            prepareUpload: function(event){
                var files;
            	files = event.target.files;
            	console.log(files);
            },
            pretopostedit: function(e){
                e.preventDefault();
                $('.erp-loader').show();
                //$('#submit-pre-travel-request').addClass('disabled');
                var flight = $('.flightcost').val();
              	var hotel = $('.hotelcost').val();
              	var bus = $('.buscost').val();
              	var car = $('.carcost').val();
				var others = $('.otherscost').val();
              	if(!flight){
              	$('.flightcat').val('');
              	$('.flightmode').val('');
				$('.datetohotelf').val('');
				$('.selStayDurf').val('');
              	}
              	if(!hotel){
              	$('.hotelcat').val('');
              	$('.hotelmode').val('');
				$('.datetohotelh').val('');
				$('.selStayDurh').val('');
              	}
              	if(!bus){
              	$('.buscat').val('');
              	$('.busmode').val('');
				$('.datetohotelb').val('');
				$('.selStayDurb').val('');
              	}
              	if(!car){
              	$('.carcat').val('');
              	$('.carmode').val('');
				$('.datetohotelc').val('');
				$('.selStayDurc').val('');
              	}
				if(!others){
              	$('.otherscat').val('');
              	$('.othersmode').val('');
				$('.fileclearo').val('');
              	}
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
              	wp.ajax.send('send_prepost_edit', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        // console.log(resp);
                        $('.erp-loader').hide();
                       
                        //$('#submit-pre-travel-request').removeClass('disabled');
                        switch (resp.status) {
                            case 'info':
                                $('#p-info').html(resp.message);
                                $('#info').show();
                                $("#info").delay(5000).slideUp(200);
                                break;
                            case 'notice':
                                $('#p-notice').html(resp.message);
                                $('#notice').show();
                                $("#notice").delay(5000).slideUp(200);
                                break;
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                //location.reload();
                                location.replace("admin.php?page=View-My-Requests&selReqstatus=2");
                                
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        // console.log("failure");
                        console.log(error);
                    }
                });
            
            },
            approveClaim: function(e){
            e.preventDefault();
                var self = $(this);
                wp.ajax.send('approve-preclaim', {
                    data: {
                        req_id: $('#req_id').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            rejectClaim: function (e) {
            	e.preventDefault();
                var self = $(this);
                wp.ajax.send('reject-preclaim', {
                    data: {
                        req_id: $('#req_id').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            approveAccClaim: function(e){
            e.preventDefault();
                var self = $(this);
                wp.ajax.send('approve-acclaim', {
                    data: {
                        req_id: $('#req_id').val(),
                        emp_id: $('#empid').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            rejectAccClaim: function (e) {
            	e.preventDefault();
                var self = $(this);
                wp.ajax.send('reject-acclaim', {
                    data: {
                        req_id: $('#req_id').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            subApprove: function (e) {
                e.preventDefault();
                var self = $(this);
                wp.ajax.send('approve-request', {
                    data: {
                        et: $('#et').val(),
                        empid: $('#emp_id').val(),
                        req_id: $('#req_id').val(),
                        req_id_table: self.data('id'),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                //alert(reqid);
            },
            rejectApprover: function (e) {
                e.preventDefault();
                var self = $(this);
                wp.ajax.send('reject-request-approver', {
                    data: {
                        et: $('#et').val(),
                        empid: $('#emp_id').val(),
                        req_id: $('#req_id').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            rejectFinance: function (e) {
                e.preventDefault();
                var self = $(this);
                wp.ajax.send('reject-request-finance', {
                    data: {
                        et: $('#et').val(),
                        empid: $('#emp_id').val(),
                        req_id: $('#req_id').val(),
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('body').load(window.location.href + '.refresh_status');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowEdit: function () {
                var optionsCat;
                var optionsMode;
                wp.ajax.send('get-exp-cat', {
                    success: function (category) {
                        wp.ajax.send('get-mode', {
                            success: function (mode) {

                                $.each(category, function (index, value) {
                                    //console.log(value);
                                    optionsCat += '<option value="' + value.EC_Id + '">' + value.EC_Name + '</option>';
                                });
                                $.each(mode, function (index, value) {
                                    //console.log(value);
                                    optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                                });
                                var rowCount = $('#table-pre-travel tr').length;
                                $('#hidrowno').val(rowCount);
                                $('#removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-default"><span id="remove-row-pretravel" class="dashicons dashicons-dismiss red"></span></a>');
                                $('#table-pre-travel tr').last().after('<tr>\n\
                                <td data-title="Date"><input style="width:120px!important;" name="txtDate[]" id="txtDate' + rowCount + '" class="pretraveldate" placeholder="dd/mm/yyyy" autocomplete="off"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /></td>\n\
                                <td data-title="Description"><textarea  style="width:100px!important;"name="txtaExpdesc[]" id="txtaExpdesc' + rowCount + '" class="" autocomplete="off"></textarea><input type="text" class="" name="txtdist[]" id="txtdist' + rowCount + '" autocomplete="off" style="display:none;" value="n/a"/><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="" style="width:105px; display:none;" value="n/a"/></td>\n\
                                <td data-title="Category"><select style="width: 100px!important;" name="selExpcat[]" onchange="javascript:getMotPreTravel(this.value,' + rowCount + ')" id="selExpcat' + rowCount + '" class=""><option value="">Select</option>' + optionsCat + '\n\
                                <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select style="width: 100px!important;" name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '" class="selModeofTransp"><option value="">Select</option>' + optionsMode + '\n\
                                <td data-title="Place"><span id="city' + rowCount + 'container"><input  name="from[]" id="from' + rowCount + '" type="text" placeholder="From" class=""><input  name="to[]" id="to1" type="text" placeholder="To" class=""></span></td>\n\
                                <td data-title="Estimated Cost" ><div id="quotefieldsid"><input type="hidden" name="sessionid[]" value="' + $.now() + '" id="sessionid' + rowCount + '"/><input type="hidden" style="width: 100px!important;  name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelected' + rowCount + '"/><input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPrefered' + rowCount + '"/></div><span id="cost' + rowCount + 'container"><input type="text" class="" name="txtCost[]" required style="width: 100px!important;" id="txtCost' + rowCount + '" onkeyup="valPreCost(this.value,' + rowCount + ');" onchange="valPreCost(this.value,' + rowCount + ');" autocomplete="off"/></br><span class="red" id="show-exceed' + rowCount + '"></span></td>\n\
                                <td data-title="Get Quote"><button type="button" name="getQuote" id="getQuote' + rowCount + '" value="' + rowCount + '" class="button button-primary getQuote">Get Quote</button></td>\n\
                                <td><button type="button" value="" class="button button-default" name="deleteRowbutton" id="deleteRowbutton" title="delete row"><i class="fa fa-trash-o"></i></button></td></tr>');
                                $('.pretraveldate').datepicker({
                                    dateFormat: "dd-mm-yy",
                                    minDate: 0,
                                });
                                j('#rowCount').val(rowCount);
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    },
                    error: function (error) { 
                        console.log(error);
                    }
                });
            },
            addRowFlight: function (e) {
                e.preventDefault();
                var rowCount = $(".flight-rows").children(".row").length;
                var rowCount = rowCount+1;
                var d = new Date();
                $('#hidrowno').val(rowCount);
                $('#flightrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-flight" type="submit">Remove -</button>');
                $('.flight-rows').append('<div class="row delf' + rowCount + '" style="margin:10px 0;"> <div class="row"> <div class="col-md-12"> <div class="radio-toolbar"><input type="radio" id="radio' + rowCount + '" name="radios' + rowCount + '" field="' + rowCount + '" checked class="hide-roundtrip"><label for="radio' + rowCount + '">Oneway</label><input type="radio" id="radio-' + rowCount + '" name="radios' + rowCount + '" field="' + rowCount + '" class="roundtrip"><label for="radio-' + rowCount + '">Roundtrip</label></div> </div> </div><span> <div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"><input type="text" placeholder="From" name="from[]" class="form-control fromflight" field="' + rowCount + '" id="fromflight' + rowCount + '" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><label for="from" class="fa fa-plane" rel="tooltip" title="from"></label></div> </div> </div> <div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <input type="text" name="to[]" value="" id="toflight' + rowCount + '" field="' + rowCount + '" class="form-control toflight" placeholder="To" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span> <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label> </div> </div> </div> <div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate flightDatefrom" name="txtDate[]" id="flightDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="dd/mm/yyyy"><input type="hidden" name="flightReturn[]" class="hidereturnflight' + rowCount + '" value="NULL"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div><div class="icon-addon addon-md return' + rowCount + '" style="display:none;"><input class="form-control pretravel flightDatereturn" name="flightReturn[]" id="flightDatereturn' + rowCount + '" type="text" value="" placeholder="dd/mm/yyyy"><label for="email" class="fa fa-refresh" rel="tooltip" title="email"></label></div></div></div> <div class="col-md-1 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <select class="form-control" id="adult' + rowCount + '" name="adult"> <option>1</option> <option>2</option> <option>3</option> <option>4</option> </select> <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label> </div> </div> </div> <div id="quotefieldsid' + rowCount + '"> <input type="hidden" name="sessionid[]" value="' + d.getTime() + '" id="sessionidflight' + rowCount + '"/> <input type="hidden" name="hiddenPrefrdSelected[]" class="flight" id="hiddenPrefrdSelectedflight' + rowCount + '"/> <input type="hidden" name="hiddenAllPrefered[]" class="flight" id="hiddenAllPreferedflight' + rowCount + '"/> </div><input type="hidden" id="children' + rowCount + '" name="children[]" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants[]" value="0"><input type="hidden" name="selStayDur[]" value=""> <input type="hidden" name="selExpcat[]" id="selExpcat' + rowCount + '" value="1"> <input type="hidden" name="selModeofTransp[]" id="selModeofTransp' + rowCount + '" value="1"> <div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="txtaExpdesc' + rowCount + '" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div> <div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"><input class="form-control exceed-flight' + rowCount + '" name="txtCost[]" id="txtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',1);" onchange="valCostPre(this.value,' + rowCount + ',1);" type="text" placeholder="Total Cost"></span><span class="red" id="show-exceed-flight' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div> </div> </div> <div class="col-md-1 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary getQuoteFlight" id="getQuote' + rowCount + '" name="getQuote" value="' + rowCount + '">Search</button></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('#rowCount').val(rowCount);
            },
            addRowBus: function (e) {
                e.preventDefault();
                var rowCount = $(".bus-rows").children(".row").length;
                var rowCount = rowCount+1;
                var d = new Date();
                $('#hidrowno').val(rowCount);
                $('#busrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-bus" type="submit">Remove -</button>');
                $('.bus-rows').append('<div class="row delb' + rowCount + '" style="margin:10px 0;"><div class="row" style="margin:10px 0;"><span> <div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="text" placeholder="From" class="form-control frombus" id="frombus' + rowCount + '" name="from[]" field="' + rowCount + '"><label for="from" class="fa fa-bus" rel="tooltip" title="from"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input type="text" name="to[]" value="" id="tobus' + rowCount + '" class="form-control tobus" placeholder="To" field="' + rowCount + '"> <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label> </div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate busDatefrom" name="txtDate[]" id="busDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="dd/mm/yyyy"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <select class="form-control" id="adult' + rowCount + '" name="adult" disabled=""><option>1</option><option>2</option><option>3</option><option>4</option> </select> <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label> </div></div></div><div id="quotefieldsid' + rowCount + '"> <input type="hidden" name="sessionid[]" value="' + d.getTime() + '" id="sessionidbus' + rowCount + '"/> <input type="hidden" name="hiddenPrefrdSelected[]" class="bus" id="hiddenPrefrdSelectedbus' + rowCount + '"/> <input type="hidden" name="hiddenAllPrefered[]" class="bus" id="hiddenAllPreferedbus' + rowCount + '"/> </div><input type="hidden" id="children' + rowCount + '" name="children" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants" value="0"><input type="hidden" name="selStayDur[]" value=""> <input type="hidden" name="selExpcat[]" id="busselExpcat' + rowCount + '" value="1"> <input type="hidden" name="selModeofTransp[]" id="busselModeofTransp' + rowCount + '" value="2"><div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="bustxtaExpdesc' + rowCount + '" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-bus1" name="txtCost[]" id="bustxtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',2);" onchange="valCostPre(this.value,' + rowCount + ',2);" type="text" placeholder="Total Cost"></span><span class="red" id="show-exceed-bus' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary getQuoteBus" id="getQuote" name="getQuote" value="' + rowCount + '">Search</button></div></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('#rowCount').val(rowCount);
            },
            addRowHotel: function (e) {
                e.preventDefault();
                var rowCount = $(".hotel-rows").children(".row").length;
                var rowCount = rowCount+1;
				var d = new Date();
                $('#hidrowno').val(rowCount);
                $('#hotelrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-hotel" type="submit">Remove -</button>');
                $('.hotel-rows').append('<div class="row delh' + rowCount + '" style="margin:10px 0;"><div class="row" style="margin:10px 0;"><span><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="text" placeholder="Address" class="form-control fromhotel" id="fromhotel' + rowCount + '" name="from[]" field="' + rowCount + '"><label for="from" class="fa fa-h-square" rel="tooltip" title="from"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input class="form-control off pretraveldate hotelDatefrom" name="txtDate[]" id="hotelDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Check In"> <label for="from" class="fa fa-calendar" rel="tooltip" title="from"></label> </div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate hotelDateto" name="dateTohotel[]" id="hotelDateto' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Check Out"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <div id="stayDays' + rowCount + '" class="form-control">0 </div> </div></div></div><div id="quotefieldsid' + rowCount + '"> <input type="hidden" name="sessionid[]" value="' + d.getTime() + '" id="sessionidhotel' + rowCount + '"/> <input type="hidden" name="hiddenPrefrdSelected[]" class="hotel" id="hiddenPrefrdSelectedhotel' + rowCount + '"/> <input type="hidden" name="hiddenAllPrefered[]" class="hotel" id="hiddenAllPreferedhotel' + rowCount + '"/> </div><input type="hidden" id="children' + rowCount + '" name="children" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants" value="0"><input type="hidden" name="selStayDur[]" id="stay' + rowCount + '"> <input type ="hidden" class="hotelcat" name="selExpcat[]" id="busselExpcat' + rowCount + '" value="2"> <input type ="hidden" class="hotelmode" name="selModeofTransp[]" id="busselModeofTransp' + rowCount + '" value="5"><div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="bustxtaExpdesc' + rowCount + '" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-hotel' + rowCount + ' hotelcost" name="txtCost[]" id="bustxtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',5);" onchange="valCostPre(this.value,' + rowCount + ',5);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-hotel' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"></span><button type="button" class="btn btn-primary" id="getQuote" name="getQuote" value="1">Search</button></div></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('#rowCount').val(rowCount);
            },
            addRowCar: function (e) {
                e.preventDefault();
                var rowCount = $(".car-rows").children(".row").length;
                var rowCount = rowCount+1;
                $('#hidrowno').val(rowCount);
                $('#carrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-car" type="submit">Remove -</button>');
                $('.car-rows').append('<div class="row delc' + rowCount + '" style="margin:10px 0;"><div class="row" style="margin:10px 0;"><span><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="text" placeholder="Pickup From" class="form-control fromcar" id="fromcar' + rowCount + '" name="from[]" field="' + rowCount + '"><label for="from" class="fa fa-car" rel="tooltip" title="from"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input class="form-control off pretraveldate carDatefrom" name="txtDate[]" id="carDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Pickup Date"> <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label> </div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off time-pick carpicktime" name="pickup[]" id="carpicktime' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Pickup Time"><label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate carDateto" name="dateTohotel[]" id="carDateto' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Drop-off Date"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off time-pick cardroptime" name="dropoff[]" id="cardroptime' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Drop-off Time"><label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label></div></div></div><input type="hidden" id="children' + rowCount + '" name="children" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants" value="0"><input type="hidden" name="selStayDur[]" value=""> <input type ="hidden" class="carcat" name="selExpcat[]" id="busselExpcat' + rowCount + '" value="1"> <input type ="hidden" class="carmode" name="selModeofTransp[]" id="busselModeofTransp' + rowCount + '" value="3"><div class="col-md-3 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="cartxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-car1 carcost" name="txtCost[]" id="cartxtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',3);" onchange="valCostPre(this.value,' + rowCount + ',3);" type="text" placeholder="Total Cost"></span><span class="red" id="show-exceed-car' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary btn-block" id="getQuote" name="getQuote" value="1" disabled>Search</button></div></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('.time-pick').timepicker({ 
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '10',
                maxTime: '6:00pm',
                defaultTime: '11',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
                });
                $('#rowCount').val(rowCount);
            },
			addRowFlightprepost: function (e) {
                e.preventDefault();
                var rowCount = $(".flight-rows").children(".row").length;
                var rowCount = rowCount+1;
                var d = new Date();
                $('#hidrowno').val(rowCount);
                $('#flightrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-flight" type="submit">Remove -</button>');
                $('.flight-rows').append('<div class="row delf' + rowCount + '" style="margin:10px 0;"> <div class="row"> <div class="col-md-12"> <div class="radio-toolbar"><input type="radio" id="radio' + rowCount + '" name="radios' + rowCount + '" field="' + rowCount + '" checked class="hide-roundtrip"><label for="radio' + rowCount + '">Oneway</label><input type="radio" id="radio-' + rowCount + '" name="radios' + rowCount + '" field="' + rowCount + '" class="roundtrip"><label for="radio-' + rowCount + '">Roundtrip</label></div> </div> </div> <div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"><input type="text" placeholder="From" name="from[]" class="form-control fromflight" field="' + rowCount + '" id="fromflight' + rowCount + '" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><label for="from" class="fa fa-plane" rel="tooltip" title="from"></label></div> </div> </div> <div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <input type="text" name="to[]" value="" id="toflight' + rowCount + '" field="' + rowCount + '" class="form-control toflight" placeholder="To" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span> <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label> </div> </div> </div> <div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate flightDatefrom" name="txtDate[]" id="flightDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="dd/mm/yyyy"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div><div class="icon-addon addon-md return' + rowCount + '" style="display:none;"><input class="form-control pretravel flightDatereturn" name="flightReturn[]" id="flightDatereturn' + rowCount + '" type="text" value="" placeholder="dd/mm/yyyy"><label for="email" class="fa fa-refresh" rel="tooltip" title="email"></label></div></div></div> <div class="col-md-1 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <select class="form-control" id="adult' + rowCount + '" name="adult"> <option>1</option> <option>2</option> <option>3</option> <option>4</option> </select> <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label> </div> </div> </div> <div id="quotefieldsid' + rowCount + '"><input type="hidden" multiple="true" name="file[]" value="temp" class="fileclearf"><input type="hidden" name="sessionid[]" value="' + d.getTime() + '" id="sessionidflight' + rowCount + '"/> <input type="hidden" name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelectedflight' + rowCount + '"/> <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPreferedflight' + rowCount + '"/> </div><input type="hidden" id="children' + rowCount + '" name="children[]" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants[]" value="0"><input type="hidden" name="selStayDur[]" value=""> <input type="hidden" name="selExpcat[]" id="selExpcat' + rowCount + '" value="1"> <input type="hidden" name="selModeofTransp[]" id="selModeofTransp' + rowCount + '" value="1"> <div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="txtaExpdesc' + rowCount + '" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div> <div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"><input class="form-control exceed-flight' + rowCount + '" name="txtCost[]" id="txtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',1);" onchange="valCostPre(this.value,' + rowCount + ',1);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-flight' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div> </div> </div> <div class="col-md-1 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary getQuoteFlight" id="getQuote' + rowCount + '" name="getQuote" value="' + rowCount + '">Search</button></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('#rowCount').val(rowCount);
            },
            addRowBusprepost: function (e) {
                e.preventDefault();
                var rowCount = $(".bus-rows").children(".row").length;
                var rowCount = rowCount+1;
                var d = new Date();
                $('#hidrowno').val(rowCount);
                $('#busrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-bus" type="submit">Remove -</button>');
                $('.bus-rows').append('<div class="row delb' + rowCount + '" style="margin:10px 0;"><div class="row" style="margin:10px 0;"> <div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="text" placeholder="From" class="form-control frombus" id="frombus' + rowCount + '" name="from[]" field="' + rowCount + '"><label for="from" class="fa fa-bus" rel="tooltip" title="from"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input type="text" name="to[]" value="" id="tobus' + rowCount + '" class="form-control tobus" placeholder="To" field="' + rowCount + '"> <label for="from" class="fa fa-map-marker" rel="tooltip" title="from"></label> </div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate busDatefrom" name="txtDate[]" id="busDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="dd/mm/yyyy"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <select class="form-control" id="adult' + rowCount + '" name="adult" disabled=""><option>1</option><option>2</option><option>3</option><option>4</option> </select> <label for="adult1" class="fa fa-users" rel="tooltip" title="date"></label> </div></div></div><div id="quotefieldsid' + rowCount + '"><input type="hidden" multiple="true" name="file[]" value="temp" class="fileclearb"><input type="hidden" name="sessionid[]" value="' + d.getTime() + '" id="sessionidbus' + rowCount + '"/> <input type="hidden" name="hiddenPrefrdSelected[]" id="hiddenPrefrdSelectedbus' + rowCount + '"/> <input type="hidden" name="hiddenAllPrefered[]" id="hiddenAllPreferedbus' + rowCount + '"/> </div><input type="hidden" id="children' + rowCount + '" name="children" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants" value="0"><input type="hidden" name="selStayDur[]" value=""> <input type="hidden" name="selExpcat[]" id="busselExpcat' + rowCount + '" value="1"> <input type="hidden" name="selModeofTransp[]" id="busselModeofTransp' + rowCount + '" value="2"><div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="bustxtaExpdesc' + rowCount + '" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-bus1" name="txtCost[]" id="bustxtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',2);" onchange="valCostPre(this.value,' + rowCount + ',2);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-bus' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary getQuoteBus" id="getQuote" name="getQuote" value="' + rowCount + '">Search</button></div></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('#rowCount').val(rowCount);
            },
            addRowHotelprepost: function (e) {
                e.preventDefault();
                var rowCount = $(".hotel-rows").children(".row").length;
                var rowCount = rowCount+1;
                $('#hidrowno').val(rowCount);
                $('#hotelrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-hotel" type="submit">Remove -</button>');
                $('.hotel-rows').append('<div class="row delh' + rowCount + '" style="margin:10px 0;"><div class="row" style="margin:10px 0;"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="text" placeholder="Address" class="form-control fromhotel" id="fromhotel' + rowCount + '" name="from[]" field="' + rowCount + '"><label for="from" class="fa fa-h-square" rel="tooltip" title="from"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input class="form-control off pretraveldate hotelDatefrom" name="txtDate[]" id="hotelDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Check In"> <label for="from" class="fa fa-calendar" rel="tooltip" title="from"></label> </div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate hotelDateto" name="dateTohotel[]" id="hotelDateto' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Check Out"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"> <div class="form-group"> <div class="icon-addon addon-md"> <div id="stayDays' + rowCount + '" class="form-control">0 </div> </div></div></div><input type="hidden" multiple="true" name="file[]" value="temp" class="fileclearh"><input type="hidden" id="children' + rowCount + '" name="children" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants" value="0"><input type="hidden" name="selStayDur[]" id="stay' + rowCount + '"> <input type ="hidden" class="hotelcat" name="selExpcat[]" id="busselExpcat' + rowCount + '" value="2"> <input type ="hidden" class="hotelmode" name="selModeofTransp[]" id="busselModeofTransp' + rowCount + '" value="5"><div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="bustxtaExpdesc' + rowCount + '" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-hotel' + rowCount + ' hotelcost" name="txtCost[]" id="bustxtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',5);" onchange="valCostPre(this.value,' + rowCount + ',5);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-hotel' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary" id="getQuote" name="getQuote" value="' + rowCount + '" disabled>Search</button></div></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('#rowCount').val(rowCount);
            },
            addRowCarprepost: function (e) {
                e.preventDefault();
                var rowCount = $(".car-rows").children(".row").length;
                var rowCount = rowCount+1;
                $('#hidrowno').val(rowCount);
                $('#carrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-car" type="submit">Remove -</button>');
                $('.car-rows').append('<div class="row delc' + rowCount + '" style="margin:10px 0;"><div class="row" style="margin:10px 0;"><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="text" placeholder="Pickup From" class="form-control fromcar" id="fromcar' + rowCount + '" name="from[]" field="' + rowCount + '"><label for="from" class="fa fa-car" rel="tooltip" title="from"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input class="form-control off pretraveldate carDatefrom" name="txtDate[]" id="carDatefrom' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Pickup Date"> <label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label> </div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off time-pick carpicktime" name="pickup[]" id="carpicktime' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Pickup Time"><label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off pretraveldate carDateto" name="dateTohotel[]" id="carDateto' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Drop-off Date"><label for="email" class="fa fa-calendar" rel="tooltip" title="email"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control off time-pick cardroptime" name="dropoff[]" id="cardroptime' + rowCount + '" field="' + rowCount + '" type="text" placeholder="Drop-off Time"><label for="email" class="fa fa-clock-o" rel="tooltip" title="email"></label></div></div></div><input type="hidden" multiple="true" name="file[]" value="temp" class="fileclearc"><input type="hidden" id="children' + rowCount + '" name="children" value="0"><input type="hidden" id="infants' + rowCount + '" name="infants" value="0"><input type="hidden" name="selStayDur[]" value=""> <input type ="hidden" class="carcat" name="selExpcat[]" id="busselExpcat' + rowCount + '" value="1"> <input type ="hidden" class="carmode" name="selModeofTransp[]" id="busselModeofTransp' + rowCount + '" value="3"><div class="col-md-3 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="cartxtaExpdesc1" class="form-control" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-car' + rowCount + ' carcost" name="txtCost[]" id="cartxtCost' + rowCount + '" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',3);" onchange="valCostPre(this.value,' + rowCount + ',3);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-car' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary btn-block" id="getQuote" name="getQuote" value="1" disabled>Search</button></div></div></div>');
                $('.pretraveldate').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                });
                $('.time-pick').timepicker({ 
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '10',
                maxTime: '6:00pm',
                defaultTime: '11',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
                });
                $('#rowCount').val(rowCount);
            },
            addRowPost: function () {
                var optionsCat;
                var optionsMode;
                wp.ajax.send('get-exp-cat', {
                    success: function (category) {
                        wp.ajax.send('get-mode', {
                            success: function (mode) {

                                $.each(category, function (index, value) {
                                    //console.log(value);
                                    optionsCat += '<option value="' + value.EC_Id + '">' + value.EC_Name + '</option>';
                                });
                                $.each(mode, function (index, value) {
                                    //console.log(value);
                                    optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                                });
                                var rowCount = $('#table-pre-travel tr').length;
                                $('#hidrowno').val(rowCount);
                                $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-posttravel">Remove -</span></a>');
                                $('#table-pre-travel tr').last().after('<tr>\n\
                                <td data-title="Date"><input name="txtDate[]" id="txtDate' + rowCount + '" class="posttraveldate form-control" placeholder="dd/mm/yyyy" autocomplete="off"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="" style="display:none;" value="n/a"/><input type="text" class="" name="txtdist[]" id="txtdist' + rowCount + '" autocomplete="off" style="display:none;" value="n/a"/></td>\n\
                                <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1" class="form-control" id="txtaExpdesc' + rowCount + '" class="" autocomplete="off"></textarea></td>\n\
                                <td data-title="Category"><select name="selExpcat[]" class="form-control" onchange="javascript:getMotPosttravel(this.value,' + rowCount + ')" id="selExpcat' + rowCount + '" class=""><option value="">Select</option>' + optionsCat + '\n\
                                <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select class="form-control" name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '"><option value="">Select</option>' + optionsMode + '\n\
                                <td data-title="Place"><span id="city' + rowCount + 'container"><input class="form-control" name="from[]" id="from' + rowCount + '" type="text" placeholder="From"><input class="form-control" name="to[]" id="to1" type="text" placeholder="To"></td>\n\
                                <td data-title="Estimated Cost"><input type="text" class="form-control" name="txtCost[]" id="txtCost' + rowCount + '" onkeyup="valPreCost(this.value,' + rowCount + ');" onchange="valPreCost(this.value,' + rowCount + ');" autocomplete="off"/></br><span class="red" id="show-exceed' + rowCount + '"></span></td>\n\
                                <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true"></td>\n\</tr>');
                                $('.posttraveldate').datepicker({
                                    dateFormat: "dd-mm-yy",
                                    maxDate: 'today',
                                });
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowMileage: function () {
                var optionsCat;
                var optionsMode;
                wp.ajax.send('get-mode-mileage', {
                    success: function (mode) {
                        $.each(mode, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                        var rowCount = $('#table-mileage-travel tr').length;
                        $('#hidrowno').val(rowCount);
                        $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-mileage">Remove -</span></a>');
                        $('#table-mileage-travel tr').last().after('<tr>\n\
                                <td data-title="Date"><input name="txtDate[]" id="txtDate' + rowCount + '" class="posttraveldate form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="" style="display:none;" value="n/a"/></td>\n\
                                <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1" id="txtaExpdesc' + rowCount + '" class="form-control SmallInput" autocomplete="off"></textarea><select name="selExpcat[]" id="selExpcat' + rowCount + '" class="" style="display:none;"><option value="5">select</option></td>\n\
                                <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '\n\
                                <td data-title="City/Location"><span id="city' + rowCount + 'container"><input name="from[]" id="from' + rowCount + '" type="text" placeholder="From" class="form-control SmallInput"  autocomplete="off"><input  name="to[]" id="to' + rowCount + '" type="text" placeholder="To" class="form-control SmallInput" autocomplete="off"></span><select name="selStayDur[]" class="form-control SmallInput" style="display:none;"><option value="n/a">Select</option>\n\
                                <td data-title="Distance (in km)"><input type="text" class="form-control SmallInput" name="txtdist[]"  id="txtdist' + rowCount + '" onkeyup="return mileageAmount(this.value, ' + rowCount + ');" autocomplete="off"/></td>\n\
                                <td data-title="Total Cost"> <input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" readonly="readonly"  autocomplete="off"/></td>\n\
                                <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" style="width:150px;" multiple="true" onchange="Validate(this.id);"></td></tr>');
                        $('.posttraveldate').datepicker({
                            dateFormat: "dd-mm-yy",
                            maxDate: 'today',
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowUtility: function () {
                var optionsMode;
                wp.ajax.send('get-mode-utility', {
                    success: function (mode) {
                        $.each(mode, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                        var rowCount = $('#table-utility-travel tr').length;
                        $('#hidrowno').val(rowCount);
                        $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-utility">Remove -</span></a>');
                        $('#table-utility-travel tr').last().after('<tr>\n\
                        <td data-title="Start Date" class="scrollmsg"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="erp-leave-date-field form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off"/><input name="txtDate[]" id="txtDate' + rowCount + '" class="form-control SmallInput" placeholder="dd/mm/yyyy" style="display:none;" value="n/a"/></td>\n\
                        <td data-title="End Date" class="scrollmsg"><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="erp-leave-date-field form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off"/></td>\n\
                        <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1"  id="txtaExpdesc' + rowCount + '" class="form-control SmallInput" autocomplete="off"></textarea><select name="selExpcat[]" id="selExpcat' + rowCount + '" class="form-control SmallInput" style="display:none;"><option value="6">select</option></select></td>\n\
                        <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select name="selModeofTransp[]" style="width:110px;" id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '</td>\n\
                        <td data-title="Bill Number"><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="form-control SmallInput"/></td>\n\
                        <td data-title="Bill Amount (Rs)"><span id="city1container"><input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" onkeyup="valCost(this.value);" autocomplete="off"/><input  name="from[]" id="from' + rowCount + '" type="text" style="display:none;" value="n/a" placeholder="From" class=""  autocomplete="off"><input  name="to[]" id="to' + rowCount + '" type="text" placeholder="To" class="" value="n/a" style="display:none;"  autocomplete="off"><select name="selStayDur[]" class="" style="display:none;"><option value="n/a">Select</option></select><input type="text" class="" name="txtdist[]"  id="txtdist' + rowCount + '" style="display:none;width:110px;" value="n/a" autocomplete="off" /></span> </td>\n\
                        <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true"></td>\n\</tr>');
                        $('.erp-leave-date-field').datepicker({
                            dateFormat: "dd-mm-yy",
                            changeMonth: true,
                            changeYear: true
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowOthers: function (e) {
                e.preventDefault();
                var optionsMode;
                var rowCount = $(".others-rows").children(".row").length;
                var rowCount = rowCount+1;
                $('#hidrowno').val(rowCount);
                //var d = new Date();
                wp.ajax.send('get-others-details', {
                	success: function (response) {
                		$.each(response, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                         $('#othersrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-others" type="submit">Remove -</button>');
                        $('.others-rows').append('<div class="row delo' + rowCount + '" style="margin:10px 0;"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input class="form-control off pretraveldate" name="txtDate[]" id="txtDate' + rowCount + '" field="' + rowCount + '" value="" type="text" placeholder="dd-mm-yyyy"> <label for="email" class="fa fa-calendar" rel="tooltip" title="date"></label> </div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type ="hidden" class="othercat" name="selExpcat[]" field="' + rowCount + '" id="busselExpcat' + rowCount + '" value="3"><select name="selModeofTransp[]" id="selModeofTransp' + rowCount + '" field="' + rowCount + '" class="form-control"> <option value="">Select</option>' + optionsMode + ' </select><label for="from" class="fa fa-cutlery" rel="tooltip" title="Expenses"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="txtaExpdesc' + rowCount + '" class="form-control" field="' + rowCount + '" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-others' + rowCount + '" name="txtCost[]" id="txtCost' + rowCount + '" field="' + rowCount + '" value="" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',4);" onchange="valCostPre(this.value,' + rowCount + ',4);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-others' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="hidden" multiple="true" name="file[]" id="otherfiler' + rowCount + '" field="' + rowCount + '" class="regular-text" /><input type="button" style="margin-left: 18px;" field="' + rowCount + '" class="btn btn-primary otherfile" value="Upload Ticket" id="uploadimage"/>&nbsp;&nbsp;<span id="otherupload' + rowCount + '" style="display:none;"><b>File Selected</b></span></div></div></div></div> </div>');
                        $('.pretraveldate').datepicker({
                            dateFormat: "dd-mm-yy",
                            minDate: 0,
                        });
                        $('#rowCount').val(rowCount);
                	},
                	error: function (error) {
                		console.log(error);
                	}
                });
            },
			addRowOthersD: function () {
                var optionsMode;
                wp.ajax.send('get-mode-others', {
                    success: function (mode) {
                        $.each(mode, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                        var rowCount = $('#table-others-travel tr').length;
                        $('#hidrowno').val(rowCount);
                        $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-otherss">Remove -</span></a>');
                        $('#table-others-travel tr').last().after('<tr>\n\
                        <td data-title="Date" class="scrollmsg"><input name="txtDate[]" class="form-control SmallInput" id="txtDate' + rowCount + '" class="posttraveldate" placeholder="dd/mm/yyyy"  /><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="" style="display:none;" value="n/a"/></td>\n\
                        <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1" id="txtaExpdesc' + rowCount + '" class="form-control SmallInput"></textarea><select name="selExpcat[]" id="selExpcat' + rowCount + '" class="form-control SmallInput" style="display:none;"><option value="3">select</option></select></td>\n\
                        <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select style="width: 100px!important;" name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '</td>\n\
                        <td data-title="Total Cost"><input  name="from[]" id="city' + rowCount + '" type="text" placeholder="From" class="form-control SmallInput" value="n/a" style="display:none;"><input  name="to[]" id="city' + rowCount + '" type="text" placeholder="To" class="form-control SmallInput" value="n/a" style="display:none;"><select name="selStayDur[]" class="form-control SmallInput" style="display:none;"><option value="n/a">Select</option></select><input type="text" class="form-control SmallInput" name="txtdist[]"  id="txtdist' + rowCount + '" style="display:none;" value="n/a" autocomplete="off" /><input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" onkeyup="valPreCost(this.value,' + rowCount + ');" onchange="valPreCost(this.value,' + rowCount + ');" autocomplete="off"/></br><span class="red" id="show-exceed' + rowCount + '"></span></td>\n\
                        <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true"></td>\n\</tr>');
                        $('.posttraveldate').datepicker({
                            dateFormat: "dd-mm-yy",
                            changeMonth: true,
                            changeYear: true
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
			addRowOthersprepost: function (e) {
                e.preventDefault();
                var optionsMode;
                var rowCount = $(".others-rows").children(".row").length;
                var rowCount = rowCount+1;
                $('#hidrowno').val(rowCount);
                //var d = new Date();
                wp.ajax.send('get-others-details', {
                	success: function (response) {
                		$.each(response, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                         $('#othersrbtncontainer').html('<button class="btn btn-danger btn-sm" id="remove-row-others" type="submit">Remove -</button>');
                        $('.others-rows').append('<div class="row delo' + rowCount + '" style="margin:10px 0;"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"> <input class="form-control off pretraveldate" name="txtDate[]" id="txtDate' + rowCount + '" field="' + rowCount + '" value="" type="text" placeholder="dd-mm-yyyy"> <label for="email" class="fa fa-calendar" rel="tooltip" title="date"></label> </div></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type ="hidden" class="othercat" name="selExpcat[]" field="' + rowCount + '" id="busselExpcat' + rowCount + '" value="3"><select name="selModeofTransp[]" id="selModeofTransp' + rowCount + '" field="' + rowCount + '" class="form-control"> <option value="">Select</option>' + optionsMode + ' </select><label for="from" class="fa fa-cutlery" rel="tooltip" title="Expenses"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><textarea name="txtaExpdesc[]" id="txtaExpdesc' + rowCount + '" class="form-control" field="' + rowCount + '" autocomplete="off" rows="1" cols="18" placeholder="Expense Description"></textarea></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input class="form-control exceed-others' + rowCount + '" name="txtCost[]" id="txtCost' + rowCount + '" field="' + rowCount + '" value="" autocomplete="off" onkeyup="valCostPre(this.value,' + rowCount + ',4);" onchange="valCostPre(this.value,' + rowCount + ',4);" type="text" placeholder="Total Cost"><span class="red" id="show-exceed-others' + rowCount + '"></span><label for="total" class="fa fa-inr" rel="tooltip" title="total"></label></div></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><div class="icon-addon addon-md"><input type="hidden" multiple="true" name="file[]" id="otherfiler' + rowCount + '" field="' + rowCount + '" class="regular-text" /><input type="button" style="margin-left: 18px;" field="' + rowCount + '" class="btn btn-primary otherfile" value="Upload Ticket" id="uploadimage"/>&nbsp;&nbsp;<span id="otherupload' + rowCount + '" style="display:none;"><b>File Selected</b></span></div></div></div></div> </div>');
                        $('.pretraveldate').datepicker({
                            dateFormat: "dd-mm-yy",
                            minDate: 0,
                        });
                        $('#rowCount').val(rowCount);
                	},
                	error: function (error) {
                		console.log(error);
                	}
                });
            },
            addRowPostEdit: function () {
                var optionsCat;
                var optionsMode;
                wp.ajax.send('get-exp-cat', {
                    success: function (category) {
                        wp.ajax.send('get-mode', {
                            success: function (mode) {

                                $.each(category, function (index, value) {
                                    //console.log(value);
                                    optionsCat += '<option value="' + value.EC_Id + '">' + value.EC_Name + '</option>';
                                });
                                $.each(mode, function (index, value) {
                                    //console.log(value);
                                    optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                                });
                                var rowCount = $('#table-pre-travel tr').length;
                                $('#hidrowno').val(rowCount);
                                $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-posttravel">Remove -</span></a>');
                                $('#table-pre-travel tr').last().after('<tr>\n\
                                <td data-title="Date"><input name="txtDate[]" id="txtDate' + rowCount + '" class="posttraveldate form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="" style="display:none;" value="n/a"/><input type="text" class="" name="txtdist[]" id="txtdist' + rowCount + '" autocomplete="off" style="display:none;" value="n/a"/></td>\n\
                                <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1" id="txtaExpdesc' + rowCount + '" class="form-control SmallInput" autocomplete="off"></textarea></td><input type="hidden" value="n/a" name="selStayDur[]" id="selStayDur' + rowCount + '">\n\
                                <td data-title="Category"><select name="selExpcat[]" onchange="javascript:getMotPosttravel(this.value,' + rowCount + ')" id="selExpcat' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsCat + '\n\
                                <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '\n\
                                <td data-title="Place"><span id="city' + rowCount + 'container"><input  name="from[]" id="from' + rowCount + '" type="text" placeholder="From" class="form-control SmallInput"><input  name="to[]" id="to1" type="text" placeholder="To" class="form-control SmallInput"></td>\n\
                                <td data-title="Estimated Cost"><input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" onkeyup="valPreCost(this.value,' + rowCount + ');" onchange="valPreCost(this.value,' + rowCount + ');" autocomplete="off"/></br><span class="red" id="show-exceed' + rowCount + '"></span></td>\n\
                                <td><input type="file" style="width:150px;" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true"></td>\n\
                                <td><button type="button" value="" class="button button-default" name="deleteRowbutton" id="deleteRowbutton" title="delete row"><i class="fa fa-trash-o"></i></button></td></tr>');
                                $('.posttraveldate').datepicker({
                                    dateFormat: "dd-mm-yy",
                                    maxDate: 'today',
                                });
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowMileageEdit: function () {
                var optionsCat;
                var optionsMode;
                wp.ajax.send('get-mode-mileage', {
                    success: function (mode) {
                        $.each(mode, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                        var rowCount = $('#table-mileage-travel tr').length;
                        $('#hidrowno').val(rowCount);
                        $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-mileage">Remove -</span></a>');
                        $('#table-mileage-travel tr').last().after('<tr>\n\
                                <td data-title="Date"><input name="txtDate[]" id="txtDate' + rowCount + '" class="posttraveldate form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="" style="display:none;" value="n/a"/></td>\n\
                                <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1" id="txtaExpdesc' + rowCount + '" class="form-control SmallInput" autocomplete="off"></textarea><select name="selExpcat[]" id="selExpcat' + rowCount + '" class="form-control SmallInput" style="display:none;"><option value="5">select</option></td>\n\
                                <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '\n\
                                <td data-title="City/Location"><span id="city' + rowCount + 'container"><input  name="from[]" id="from' + rowCount + '" type="text" placeholder="From" class="form-control SmallInput"  autocomplete="off"><input  name="to[]" id="to' + rowCount + '" type="text" placeholder="To" class="form-control SmallInput"  autocomplete="off"></span><select name="selStayDur[]" class="form-control SmallInput" style="display:none;"><option value="n/a">Select</option>\n\
                                <td data-title="Distance (in km)"><input type="text" class="form-control SmallInput" name="txtdist[]"  id="txtdist' + rowCount + '" onkeyup="return mileageAmount(this.value, ' + rowCount + ');" autocomplete="off"/></td>\n\
                                <td data-title="Total Cost"> <input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" readonly="readonly"  autocomplete="off"/></td>\n\
                                <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true"></td>\n\
                                <td><button type="button" value="" class="button button-default" name="deleteRowbutton" id="deleteRowbutton" title="delete row"><i class="fa fa-trash-o"></i></button></td></tr>');
                        $('.posttraveldate').datepicker({
                            dateFormat: "dd-mm-yy",
                            maxDate: 'today',
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowUtilityEdit: function () {
                var optionsMode;
                wp.ajax.send('get-mode-utility', {
                    success: function (mode) {
                        $.each(mode, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                        var rowCount = $('#table-utility-travel tr').length;
                        $('#hidrowno').val(rowCount);
                        $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-utility">Remove -</span></a>');
                        $('#table-utility-travel tr').last().after('<tr>\n\
                        <td data-title="Start Date" class="scrollmsg"><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="erp-leave-date-field form-control SmallInput" style="width:101px;" placeholder="dd/mm/yyyy" autocomplete="off"/><input name="txtDate[]" id="txtDate' + rowCount + '" class="form-control SmallInput" placeholder="dd/mm/yyyy" style="display:none;" value="n/a"/></td>\n\
                        <td data-title="End Date" class="scrollmsg"><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="erp-leave-date-field form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off"/></td>\n\
                        <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1"  id="txtaExpdesc' + rowCount + '" class="form-control SmallInput" autocomplete="off"></textarea><select name="selExpcat[]" id="selExpcat' + rowCount + '" class="form-control SmallInput" style="display:none;"><option value="6">select</option></select></td>\n\
                        <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select name="selModeofTransp[]" id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '</td>\n\
                        <td data-title="Bill Number"><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="form-control SmallInput"/></td>\n\
                        <td data-title="Bill Amount (Rs)"><span id="city1container"><input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" onkeyup="valCost(this.value);" autocomplete="off"/><input  name="from[]" id="from' + rowCount + '" type="text" style="display:none;" value="n/a" placeholder="From" class=""  autocomplete="off"><input  name="to[]" id="to' + rowCount + '" type="text" placeholder="To" class="" value="n/a" style="display:none;"  autocomplete="off"><select name="selStayDur[]" class="" style="display:none;"><option value="n/a">Select</option></select><input type="text" class="" name="txtdist[]"  id="txtdist' + rowCount + '" style="display:none;width:110px;" value="n/a" autocomplete="off" /></span> </td>\n\
                        <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true" onchange="Validate(this.id);"></td>\n\
                        <td><button type="submit" class="button button-default" name="deleteRowbutton" disabled><i class="fa fa-trash-o"></i></button></td></tr>');
                        $('.erp-leave-date-field').datepicker({
                            dateFormat: "dd-mm-yy",
                            changeMonth: true,
                            changeYear: true
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addRowOthersEdit: function () {
                var optionsMode;
                wp.ajax.send('get-mode-others', {
                    success: function (mode) {
                        $.each(mode, function (index, value) {
                            //console.log(value);
                            optionsMode += '<option value="' + value.MOD_Id + '">' + value.MOD_Name + '</option>';
                        });
                        var rowCount = $('#table-others-travel tr').length;
                        $('#hidrowno').val(rowCount);
                        $('.removebuttoncontainer').html('<a title="Delete Rows" class="btn btn-danger btn-sm"><span id="remove-row-otherss">Remove -</span></a>');
                        $('#table-others-travel tr').last().after('<tr>\n\
                        <td data-title="Date" class="scrollmsg"><input name="txtDate[]" id="txtDate' + rowCount + '" class="posttraveldate form-control SmallInput" placeholder="dd/mm/yyyy"  /><input name="txtStartDate[]" id="txtStartDate' + rowCount + '" class="form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate' + rowCount + '" class="form-control SmallInput" placeholder="dd/mm/yyyy" autocomplete="off" style="display:none;" value="n/a" /><input type="text" name="textBillNo[]" id="textBillNo' + rowCount + '" autocomplete="off"  class="form-control SmallInput" style="display:none;" value="n/a"/></td>\n\
                        <td data-title="Description"><textarea name="txtaExpdesc[]" rows="1" id="txtaExpdesc' + rowCount + '" class="form-control SmallInput"></textarea><select name="selExpcat[]" id="selExpcat' + rowCount + '" class="form-control SmallInput" style="display:none;"><option value="3">select</option></select></td>\n\
                        <td data-title="Category"><span id="modeoftr' + rowCount + 'acontent"><select name="selModeofTransp[]"  id="selModeofTransp' + rowCount + '" class="form-control SmallInput"><option value="">Select</option>' + optionsMode + '</td>\n\
                        <td data-title="Total Cost"><input  name="from[]" id="city' + rowCount + '" type="text" placeholder="From" class="form-control SmallInput" value="n/a" style="display:none;"><input  name="to[]" id="city' + rowCount + '" type="text" placeholder="To" class="form-control SmallInput" value="n/a" style="display:none;"><select name="selStayDur[]" class="form-control SmallInput" style="display:none;"><option value="n/a">Select</option></select><input type="text" class="" name="txtdist[]"  id="txtdist' + rowCount + '" style="display:none;" value="n/a" autocomplete="off" /><input type="text" class="form-control SmallInput" name="txtCost[]" id="txtCost' + rowCount + '" onkeyup="valCost(this.value);" autocomplete="off"/></td>\n\
                        <td><input type="file" name="file' + rowCount + '[]" id="file' + rowCount + '[]" multiple="true" onchange="Validate(this.id);"></td>\n\
                        <td><button type="submit" class="button button-default" name="deleteRowbutton" disabled><i class="fa fa-trash-o"></i></button></td></tr>');
                        $('.posttraveldate').datepicker({
                            dateFormat: "dd-mm-yy",
                            changeMonth: true,
                            changeYear: true
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            removeRowFlight: function (e) {
                e.preventDefault();
                var rowCount = $(".flight-rows").children(".row").length;
                var i = rowCount;
                //$('#selected_quote').find('#quoteContent'+i+'').html('');
                $('.delf'+i+'').remove();
                if (rowCount == 2) {
                    $('#flightrbtncontainer').html('');
                }
                /*
                if (rowCount == 3) {
                    $('#table-pre-travel tr:last').remove();
                    $('#removebuttoncontainer').html('');
                } else if (rowCount > 2) {
                    $('#table-pre-travel tr:last').remove();
                }
                j('#rowCount').val(rowCount - 1);*/
            },
            removeRowBus: function (e) {
                e.preventDefault();
                var rowCount = $(".bus-rows").children(".row").length;
                var i = rowCount;
                //$('#selected_quote').find('#quoteContent'+i+'').html('');
                $('.delb'+i+'').remove();
                if (rowCount == 2) {
                    $('#busrbtncontainer').html('');
                }
            },
            removeRowHotel: function (e) {
                e.preventDefault();
                var rowCount = $(".hotel-rows").children(".row").length;
                var i = rowCount;
                //$('#selected_quote').find('#quoteContent'+i+'').html('');
                $('.delh'+i+'').remove();
                if (rowCount == 2) {
                    $('#hotelrbtncontainer').html('');
                }
            },
            removeRowCar: function (e) {
                e.preventDefault();
                var rowCount = $(".car-rows").children(".row").length;
                var i = rowCount;
                //$('#selected_quote').find('#quoteContent'+i+'').html('');
                $('.delc'+i+'').remove();
                if (rowCount == 2) {
                    $('#carrbtncontainer').html('');
                }
            },
            
            removeRowPost: function () {
                var rowCount = $('#table-pre-travel tr').length;
                if (rowCount == 3) {
                    $('#table-pre-travel tr:last').remove();
                    $('.removebuttoncontainer').html('');
                } else if (rowCount > 2) {
                    $('#table-pre-travel tr:last').remove();
                }

            },
            removeRowMileage: function () {
                var rowCount = $('#table-mileage-travel tr').length;
                if (rowCount == 3) {
                    $('#table-mileage-travel tr:last').remove();
                    $('.removebuttoncontainer').html('');
                } else if (rowCount > 2) {
                    $('#table-mileage-travel tr:last').remove();
                }

            },
            removeRowUtility: function () {
                var rowCount = $('#table-utility-travel tr').length;
                if (rowCount == 3) {
                    $('#table-utility-travel tr:last').remove();
                    $('.removebuttoncontainer').html('');
                } else if (rowCount > 2) {
                    $('#table-utility-travel tr:last').remove();
                }

            },
            removeRowOthers: function (e) {
                e.preventDefault();
                var rowCount = $(".others-rows").children(".row").length;
                var i = rowCount;
                $('.delo'+i+'').remove();
                if (rowCount == 2) {
                    $('#othersrbtncontainer').html('');
                }
            },
			removeRowOtherss: function (e) {
                var rowCount = $('#table-others-travel tr').length;
                if (rowCount == 3) {
                    $('#table-others-travel tr:last').remove();
                    $('.removebuttoncontainer').html('');
                } else if (rowCount > 2) {
                    $('#table-others-travel tr:last').remove();
                }
            },
            createChatMsg: function (e) {
                e.preventDefault();
                $('.erp-note-loader').show();
                wp.ajax.send('send-emp-note', {
                    data: {
                        rn_status: $('#rn_status').val(),
                        req_id: $('#req_id').val(),
                        emp_id: $('#emp_id').val(),
                        txtaNotes: $('#txtaNotes').val()
                    },
                    success: function (resp) {
                        $('.erp-note-loader').hide();
                        switch (resp.status) {
                            case 'success':
                                $('body').load(window.location.href + '.refresh_status');
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            create: function (e) {
                e.preventDefault();

                $('.erp-loader').show();
				$('.disableSubmit').addClass('disabled');
                var flight = $('.flightcost').val();
              	var hotel = $('.hotelcost').val();
              	var bus = $('.buscost').val();
              	var car = $('.carcost').val();
              	if(!flight){
              	$('.flightcat').val('');
              	$('.flightmode').val('');
				$('.dateTohotelflight').val('');
              	}
              	if(!hotel){
              	$('.hotelcat').val('');
              	$('.hotelmode').val('');
              	}
              	if(!bus){
              	$('.buscat').val('');
              	$('.busmode').val('');
				$('.dateTohotelbus').val('');
              	}
              	if(!car){
              	$('.carcat').val('');
              	$('.carmode').val('');
				$('.dateTohotelcar').val('');
              	}
              	/*
              	var flight = $('#txtCost1').val();
              	var hotel = $('#txtCost2').val();
              	var bus = $('#txtCost3').val();
              	var car = $('#txtCost4').val();
              	
              	if(!flight){
              	$('#selExpcat1').val('');
              	$('#selModeofTransp1').val('');
              	}
              	else{
              	    var trvDate = document.getElementById('txtDate1').value;
    
                    var trvFrom = document.getElementById('from1').value;
    
                    var trvTo = document.getElementById('to1').value;
                    
                    var desc = document.getElementById('txtaExpdesc1').value;
                    
                    if (!trvDate) {
                        alert('Please enter date.');
                        document.getElementById('txtDate1').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from1').focus();
                        return false;
                    }
                    
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc1').focus();
                    return false;
                    }
    
                    if (!trvTo) {
                        alert('Please enter place properly.');
                        document.getElementById('to1').focus();
                        return false;
                    }
              	}
              	if(!hotel){
              	$('#selExpcat2').val('');
              	$('#selModeofTransp2').val('');
              	}
              	else{
              	    var checkin = document.getElementById('txtDatehotel2').value;
              	    
              	    var checkout = document.getElementById('dateTohotel2').value;
    
                    var trvFrom = document.getElementById('fromhotel2').value;
                    
                    var desc = document.getElementById('txtaExpdesc2').value;
                    
                    if (!checkin) {
                        alert('Please enter checkin date.');
                        document.getElementById('txtDatehotel2').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from2').focus();
                        return false;
                    }
                    
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc2').focus();
                    return false;
                    }
                    
                    if (!checkout) {
                    alert('Please enter Checkout Date.');
                    document.getElementById('dateTohotel2').focus();
                    return false;
                    }
              	    
              	}
              	if(!bus){
              	$('#selExpcat3').val('');
              	$('#selModeofTransp3').val('');
              	}
              	else{
              	    var trvDate = document.getElementById('txtDate3').value;
    
                    var trvFrom = document.getElementById('frombus3').value;
    
                    var trvTo = document.getElementById('tobus3').value;
                    
                    var desc = document.getElementById('txtaExpdesc3').value;
                    
                    if (!trvDate) {
                        alert('Please enter date.');
                        document.getElementById('txtDate3').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from3').focus();
                        return false;
                    }
                    
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc3').focus();
                    return false;
                    }
    
                    if (!trvTo) {
                        alert('Please enter place properly.');
                        document.getElementById('tobus3').focus();
                        return false;
                    }
              	}
              	if(!car){
              	$('#selExpcat4').val('');
              	$('#selModeofTransp4').val('');
              	}
              	else{
              	    var checkin = document.getElementById('txtcarDate4').value;
              	    
              	    var checkout = document.getElementById('txtcarDateto4').value;
    
                    var trvFrom = document.getElementById('carcity4').value;
                    
                    var desc = document.getElementById('txtaExpdesc4').value;
                    
                    if (!checkin) {
                        alert('Please enter checkin date.');
                        document.getElementById('txtDatehotel2').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from2').focus();
                        return false;
                    }
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc2').focus();
                    return false;
                    }
                    if (!checkout) {
                    alert('Please enter Checkout Date.');
                    document.getElementById('dateTohotel2').focus();
                    return false;
                    }
              	    
              	}*/
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
                wp.ajax.send('send_pre_travel_request', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        // console.log(resp);
                        $('.erp-loader').hide();

                        switch (resp.status) {
                            case 'info':
                                $('#p-info').html(resp.message);
                                $('#info').show();
                                $("#info").delay(5000).slideUp(200);
								$('.disableSubmit').removeClass('disabled');
                                break;
                            case 'notice':
                                $('#p-notice').html(resp.message);
                                $('#notice').show();
                                $("#notice").delay(5000).slideUp(200);
								$('.disableSubmit').removeClass('disabled');
                                break;
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                location.replace("admin.php?page=TravelExpense");
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
								$('.disableSubmit').removeClass('disabled');
                                break;
                        }
                    },
                    error: function (error) {
                        // console.log("failure");
                        console.log(error);
                    }
                });
            },
            edit: function (e) {
                e.preventDefault();
                $('.erp-loader').show();
                $('#submit-pre-travel-request').addClass('disabled');
                var flight = $('.flightcost').val();
              	var hotel = $('.hotelcost').val();
              	var bus = $('.buscost').val();
              	var car = $('.carcost').val();
              	if(!flight){
              	$('.flightcat').val('');
              	$('.flightmode').val('');
				$('.datetohotelf').val('');
				$('.selStayDurf').val('');
				$('.dateTohotelflight').val('');
              	}
              	if(!hotel){
              	$('.hotelcat').val('');
              	$('.hotelmode').val('');
				$('.datetohotelh').val('');
				$('.selStayDurh').val('');
              	}
              	if(!bus){
              	$('.buscat').val('');
              	$('.busmode').val('');
				$('.datetohotelb').val('');
				$('.selStayDurb').val('');
				$('.dateTohotelbus').val('');
              	}
              	if(!car){
              	$('.carcat').val('');
              	$('.carmode').val('');
				$('.datetohotelc').val('');
				$('.selStayDurc').val('');
				$('.dateTohotelcar').val('');
              	}
                /*
                var flight = $('#txtCost1').val();
              	var hotel = $('#txtCost2').val();
              	var bus = $('#txtCost3').val();
              	var car = $('#txtCost4').val();
              	
              	if(!flight){
              	$('#selExpcat1').val('');
              	$('#selModeofTransp1').val('');
              	}
              	else{
              	    var trvDate = document.getElementById('txtDate1').value;
    
                    var trvFrom = document.getElementById('from1').value;
    
                    var trvTo = document.getElementById('to1').value;
                    
                    var desc = document.getElementById('txtaExpdesc1').value;
                    
                    if (!trvDate) {
                        alert('Please enter date.');
                        document.getElementById('txtDate1').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from1').focus();
                        return false;
                    }
                    
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc1').focus();
                    return false;
                    }
    
                    if (!trvTo) {
                        alert('Please enter place properly.');
                        document.getElementById('to1').focus();
                        return false;
                    }
              	}
              	if(!hotel){
              	$('#selExpcat2').val('');
              	$('#selModeofTransp2').val('');
              	}
              	else{
              	    var checkin = document.getElementById('txtDatehotel2').value;
              	    
              	    var checkout = document.getElementById('dateTohotel2').value;
    
                    var trvFrom = document.getElementById('fromhotel2').value;
                    
                    var desc = document.getElementById('txtaExpdesc2').value;
                    
                    if (!checkin) {
                        alert('Please enter checkin date.');
                        document.getElementById('txtDatehotel2').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from2').focus();
                        return false;
                    }
                    
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc2').focus();
                    return false;
                    }
                    
                    if (!checkout) {
                    alert('Please enter Checkout Date.');
                    document.getElementById('dateTohotel2').focus();
                    return false;
                    }
              	    
              	}
              	if(!bus){
              	$('#selExpcat3').val('');
              	$('#selModeofTransp3').val('');
              	}
              	else{
              	    var trvDate = document.getElementById('txtDate3').value;
    
                    var trvFrom = document.getElementById('frombus3').value;
    
                    var trvTo = document.getElementById('tobus3').value;
                    
                    var desc = document.getElementById('txtaExpdesc3').value;
                    
                    if (!trvDate) {
                        alert('Please enter date.');
                        document.getElementById('txtDate3').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from3').focus();
                        return false;
                    }
                    
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc3').focus();
                    return false;
                    }
    
                    if (!trvTo) {
                        alert('Please enter place properly.');
                        document.getElementById('tobus3').focus();
                        return false;
                    }
              	}
              	if(!car){
              	$('#selExpcat4').val('');
              	$('#selModeofTransp4').val('');
              	}
              	else{
              	    var checkin = document.getElementById('txtcarDate4').value;
              	    
              	    var checkout = document.getElementById('txtcarDateto4').value;
    
                    var trvFrom = document.getElementById('carcity4').value;
                    
                    var desc = document.getElementById('txtaExpdesc4').value;
                    
                    if (!checkin) {
                        alert('Please enter checkin date.');
                        document.getElementById('txtDatehotel2').focus();
                        return false;
                    }
    
                    if (!trvFrom) {
                        alert('Please enter place properly.');
                        document.getElementById('from2').focus();
                        return false;
                    }
                    if (!desc) {
                    alert('Please enter Expense Description.');
                    document.getElementById('txtaExpdesc2').focus();
                    return false;
                    }
                    if (!checkout) {
                    alert('Please enter Checkout Date.');
                    document.getElementById('dateTohotel2').focus();
                    return false;
                    }
              	    
              	}*/
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
                wp.ajax.send('send_pre_travel_edit_request', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        console.log(resp);
                        $('.erp-loader').hide();
                        $('#submit-pre-travel-request_edit').removeClass('disabled');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                //$( 'body' ).load( window.location.href + '.pre-travel-request' );
                                location.replace("admin.php?page=TravelExpense");
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
            },
            deleteRequest: function(e){
                if (confirm("Are you sure want to delete this travel expense request ?")){
                e.preventDefault();
            	wp.ajax.send('request-delete', {
                    data: {
                        et: $('#et').val(),
                        req_id: $('#reqid').val(),
                    },
                    success: function (resp) {
                        //console.log("success");
                        //console.log(resp);
                        $('.erp-loader').hide();
                        $('#submit-pre-travel-request_edit').removeClass('disabled');
                        switch (resp) {
                            case 'pretravel':
                                $('#p-success').html("Request Deleted Successfully");
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                location.replace('admin.php?page=TravelExpense&tab=My_Pre_Travel_Expenses');
                                break;
                            case 'posttravel':
                                $('#p-success').html("Request Deleted Successfully");
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                location.replace('admin.php?page=TravelExpense&tab=My_Post_Travel_Expenses');
                                break;
                            case 'oters':
                                $('#p-success').html("Request Deleted Successfully");
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                location.replace('admin.php?page=GeneralExpense&tab=Other_Requests_List');
                                break;
                            case 'mileage':
                                $('#p-success').html("Request Deleted Successfully");
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                location.replace('admin.php?page=mileage-utility');
                                break;
                            case 'utility':
                                $('#p-success').html("Request Deleted Successfully");
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                location.replace('admin.php?page=mileage-utility');
                                break;    
                                
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
                }
            },
            delete: function () {
                wp.ajax.send('pre-travel-request-delete', {
                    data: {
                        id: $(this).attr("value"),
                        req_id: $('#reqid').val(),
                    },
                    success: function (resp) {
                        //console.log("success");
                        //console.log(resp);
                        $('.erp-loader').hide();
                        $('#submit-pre-travel-request_edit').removeClass('disabled');
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#success').show();
                                $("#success").delay(5000).slideUp(200);
                                //$( 'body' ).load( window.location.href + '.pre-travel-request' );
                                location.reload()
                                break;
                            case 'failure':
                                $('#p-failure').html(resp.message);
                                $('#failure').show();
                                $("#failure").delay(5000).slideUp(200);
                                break;
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
            },
        },
        dashboard: {
            markAnnouncementRead: function (e) {
                e.preventDefault();
                var self = $(this);
                if (!self.closest('li').hasClass('unread')) {
                    return;
                }

                wp.ajax.send('erp_hr_announcement_mark_read', {
                    data: {
                        id: self.data('row_id'),
                        _wpnonce: wpErpHr.nonce
                    },
                    success: function (res) {
                        self.closest('li').removeClass('unread');
                        self.addClass('erp-hide');
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
            },
            viewAnnouncementTitle: function (e) {
                e.preventDefault();
                var self = $(this).closest('li').find('a.view-full');
                wp.ajax.send('erp_hr_announcement_view', {
                    data: {
                        id: self.data('row_id'),
                        _wpnonce: wpErpHr.nonce
                    },
                    success: function (res) {
                        $.erpPopup({
                            title: res.title,
                            button: '',
                            id: 'erp-hr-announcement',
                            content: '<p>' + res.content + '</p>',
                            extraClass: 'midium',
                        });
                        self.closest('li').removeClass('unread');
                        self.siblings('.mark-read').addClass('erp-hide');
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
            },
            viewAnnouncement: function (e) {
                e.preventDefault();
                var self = $(this);
                wp.ajax.send('erp_hr_announcement_view', {
                    data: {
                        id: self.data('row_id'),
                        _wpnonce: wpErpHr.nonce
                    },
                    success: function (res) {
                        $.erpPopup({
                            title: res.title,
                            button: '',
                            id: 'erp-hr-announcement',
                            content: '<p>' + res.content + '</p>',
                            extraClass: 'midium',
                        });
                        self.closest('li').removeClass('unread');
                        self.siblings('.mark-read').addClass('erp-hide');
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
            }
        },
        department: {
            /**
             * After create new department
             *
             * @return {void}
             */
            afterNew: function (e, res) {
                var selectdrop = $('.erp-hr-dept-drop-down');
                wperp.scriptReload('erp_hr_script_reload', 'tmpl-erp-new-employee');
                selectdrop.append('<option selected="selected" value="' + res.id + '">' + res.title + '</option>');
                selectdrop.select2().select2("val", res.id);
            },
            /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function () {
                $('#erp-dept-table-wrap').load(window.location.href + ' #erp-dept-table-wrap');
            },
            /**
             * Template reload after insert, edit, delete
             *
             * @return {void}
             */
            tempReload: function () {
                wperp.scriptReload('erp_hr_new_dept_tmp_reload', 'tmpl-erp-new-dept');
            },
            /**
             * Create new department
             *
             * @param  {event}
             */
            create: function (e) {
                e.preventDefault();
                var self = $(this),
                        is_single = self.data('single');
                $.erpPopup({
                    title: wpErpHr.popup.dept_title,
                    button: wpErpHr.popup.dept_submit,
                    id: 'erp-hr-new-department',
                    content: wperp.template('erp-new-dept')().trim(),
                    extraClass: 'smaller',
                    onSubmit: function (modal) {
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (res) {
                                WeDevs_CRP_EMP.department.reload();
                                if (is_single != '1') {
                                    $('body').trigger('erp-hr-after-new-dept', [res]);
                                } else {
                                    WeDevs_CRP_EMP.department.tempReload();
                                }

                                modal.closeModal();
                            },
                            error: function (error) {
                                modal.showError(error);
                            }
                        });
                    }
                }); //popup
            },
            /**
             * Edit a department in popup
             *
             * @param  {event}
             */
            edit: function (e) {
                e.preventDefault();
                var self = $(this);
                $.erpPopup({
                    title: wpErpHr.popup.dept_update,
                    button: wpErpHr.popup.dept_update,
                    id: 'erp-hr-new-department',
                    content: wp.template('erp-new-dept')().trim(),
                    extraClass: 'smaller',
                    onReady: function () {
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('erp-hr-get-dept', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpHr.nonce
                            },
                            success: function (response) {
                                $('.loader', modal).remove();
                                $('#dept-title', modal).val(response.name);
                                $('#dept-desc', modal).val(response.data.description);
                                $('#dept-parent', modal).val(response.data.parent);
                                $('#dept-lead', modal).val(response.data.lead);
                                $('#dept-id', modal).val(response.id);
                                $('#dept-action', modal).val('erp-hr-update-dept');
                                // disable current one
                                $('#dept-parent option[value="' + self.data('id') + '"]', modal).attr('disabled', 'disabled');
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function () {
                                WeDevs_CRP_EMP.department.reload();
                                WeDevs_CRP_EMP.department.tempReload();
                                modal.closeModal();
                            },
                            error: function (error) {
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            /**
             * Delete a department
             *
             * @param  {event}
             */
            remove: function (e) {
                e.preventDefault();
                var self = $(this);
                if (confirm(wpErpHr.delConfirmDept)) {
                    wp.ajax.send('erp-hr-del-dept', {
                        data: {
                            '_wpnonce': wpErpHr.nonce,
                            id: self.data('id')
                        },
                        success: function () {
                            self.closest('tr').fadeOut('fast', function () {
                                $(this).remove();
                                WeDevs_CRP_EMP.department.tempReload();
                            });
                        },
                        error: function (response) {
                            alert(response);
                        }
                    });
                }
            },
        },
        companyAdmin: {
            reload: function () {
                $('.erp-hr-employees-wrap').load(window.location.href + ' .erp-hr-employees-wrap-inner');
            },
            /**
             * Create a new employee modal
             *
             * @param  {event}
             */
            create: function (e) {
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }

                if (typeof wpErpHr.employee_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpHr.popup.company_title,
                    button: wpErpHr.popup.employee_create,
                    id: "erp-new-companyadmin-popup",
                    content: wperp.template('companyadmin-create')(wpErpHr.employee_empty).trim(),
                    //content: '<h1>sss</h1>',
                    onReady: function () {
                        WeDevs_CRP_EMP.initDateField();
                        $('.select2').select2();
                        WeDevs_CRP_EMP.employee.select2Action('erp-hrm-select2');
                        WeDevs_CRP_EMP.employee.select2AddMoreContent();
                        $('#user_notification').on('click', function () {
                            if ($(this).is(':checked')) {
                                $('.show-if-notification').show();
                            } else {
                                $('.show-if-notification').hide();
                            }
                        });
                    },
                    /**
                     * Handle the onsubmit function
                     *
                     * @param  {modal}
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('companyadmin_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_CRP_EMP.employee.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function (error) {
                                modal.enableButton();
                                $('.erp-modal-backdrop, .erp-modal').find('.erp-loader').addClass('erp-hide');
                                modal.showError(error);
                                console.log(error);
                            }
                        });
                    }
                });
            },
            edit: function (e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpHr.popup.employee_update,
                    button: wpErpHr.popup.employee_update,
                    id: 'erp-employee-edit',
                    onReady: function () {
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('companyadmin_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpHr.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('companyadmin-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                WeDevs_CRP_EMP.initDateField();
                                $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                            selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                });
                                // disable current one
                                $('#work_reporting_to option[value="' + response.id + '"]', modal).attr('disabled', 'disabled');
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_CRP_EMP.employee.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function (error) {
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            remove: function (e) {
                e.preventDefault();
                var self = $(this);
                if (confirm(wpErpHr.delConfirmEmployee)) {
                    wp.ajax.send('companyadmin-delete', {
                        data: {
                            _wpnonce: wpErpHr.nonce,
                            id: self.data('id'),
                            hard: self.data('hard')

                        },
                        success: function () {
                            alert("delete");
                            self.closest('tr').fadeOut('fast', function () {
                                $(this).remove();
                                WeDevs_CRP_EMP.companyAdmin.reload();
                            });
                        },
                        error: function (response) {
                            alert(response);
                        }
                    });
                }
            },
        },
        designation: {
            /**
             * After create new desination
             *
             * @return {void}
             */
            afterNew: function (e, res) {
                var selectdrop = $('.erp-hr-desi-drop-down');
                wperp.scriptReload('erp_hr_script_reload', 'tmpl-erp-new-employee');
                selectdrop.append('<option selected="selected" value="' + res.id + '">' + res.title + '</option>');
                WeDevs_CRP_EMP.employee.select2AddMoreActive('erp-hr-desi-drop-down');
                selectdrop.select2("val", res.id);
            },
            /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function () {
                $('.erp-hr-designation').load(window.location.href + ' .erp-hr-designation');
            },
            /**
             * Create designation
             *
             * @param  {event}
             *
             * @return {void}
             */
            create: function (e) {
                e.preventDefault();
                var is_single = $(this).data('single');
                $.erpPopup({
                    title: wpErpHr.popup.desig_title,
                    button: wpErpHr.popup.desig_submit,
                    id: 'erp-hr-new-designation',
                    content: wp.template('erp-new-desig')().trim(),
                    extraClass: 'smaller',
                    onSubmit: function (modal) {
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (res) {
                                WeDevs_CRP_EMP.designation.reload();
                                if (is_single != '1') {
                                    $('body').trigger('erp-hr-after-new-desig', [res]);
                                }
                                modal.closeModal();
                            },
                            error: function (error) {
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            /**
             * Edit a department in popup
             *
             * @param  {event}
             */
            edit: function (e) {
                e.preventDefault();
                var self = $(this);
                $.erpPopup({
                    title: wpErpHr.popup.desig_update,
                    button: wpErpHr.popup.desig_update,
                    content: wp.template('erp-new-desig')().trim(),
                    id: 'erp-hr-new-designation',
                    extraClass: 'smaller',
                    onReady: function () {
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('erp-hr-get-desig', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpHr.nonce
                            },
                            success: function (response) {
                                $('.loader', modal).remove();
                                $('#desig-title', modal).val(response.name);
                                $('#desig-desc', modal).val(response.data.description);
                                $('#desig-id', modal).val(response.id);
                                $('#desig-action', modal).val('erp-hr-update-desig');
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function () {
                                WeDevs_CRP_EMP.designation.reload();
                                modal.closeModal();
                            },
                            error: function (error) {
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            /**
             * Delete a department
             *
             * @param  {event}
             */
            remove: function (e) {
                e.preventDefault();
                var self = $(this);
                if (confirm(wpErpHr.delConfirmDept)) {
                    wp.ajax.send('erp-hr-del-desig', {
                        data: {
                            '_wpnonce': wpErpHr.nonce,
                            id: self.data('id')
                        },
                        success: function () {
                            self.closest('tr').fadeOut('fast', function () {
                                $(this).remove();
                            });
                        },
                        error: function (response) {
                            alert(response);
                        }
                    });
                }
            },
        },
    };

    $(function () {
        WeDevs_CRP_EMP.initialize();
    });
})(jQuery);
