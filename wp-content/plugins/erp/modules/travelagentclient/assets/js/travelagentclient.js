/* jshint devel:true */
/* global wpErpCr */
/* global wp */

;(function($) {
    'use strict';
    var WeDevs_ERP_TRAVELAGENTCLIENT = {

        /**
         * Initialize the events
         *
         * @return {void}
         */
        initialize: function() {
            $('body').on('submit', '#bookingRequest', this.travelagentclient.bookingRequest);
            $('body').on('submit', '#updateBookingRequest', this.travelagentclient.bookingRequestUpdate);
            $( 'body' ).on( 'submit', '#GroupRequest', this.travelagentclient.groupRequest );
            $( 'body' ).on( 'submit', '#group_request_edit_form', this.travelagentclient.groupRequestEdit );
            $( 'body' ).on( 'click', '#buttonFindEmployee', this.travelagentclient.findEmployee );
            $( 'body' ).on( 'click', '#deleteRequesttuser', this.travelagentclient.delRequest );
            $( 'body' ).on( 'click', '#deleteGroupRequesttuser', this.travelagentclient.delGroupRequest );
            $('body').on('click', '#accTcClaimed', this.payment.create);
            $('body').on('change', '#selPaymentModetc', this.payment.change);
            /*
			$( '.erp-hr-travelagentuser' ).on( 'click', 'a#erp-travelagentuser-new', this.travelagentUser.create );
            $( '.erp-hr-travelagentuser' ).on( 'click', 'span.edit a', this.travelagentUser.edit );
			$( '.erp-travelagentclient' ).on( 'click', 'a#erp-travelagentclient-new', this.travelagentClient.create );
			$('.erp-travelagentclient').on('click', 'span.edit a', this.travelagentClient.edit);
			$('body').on('click', 'a#client-photo ', this.travelagentClient.setPhoto);
            $( '.erp-invoice-management' ).on( 'change', '#Companyinvoice', this.travelagentInvoice.view );
			$( '.erp-travelagentbankdetails' ).on( 'click', 'a#erp-travelagentbankdetails-new', this.travelagentBankdetails.create );
			$( '.erp-travelagentbankdetails' ).on( 'click', 'span.edit a', this.travelagentBankdetails.edit );
			$( '.companyinvoicearrow' ).on( 'click', '', this.travelagentcompanyinvoicearw.view);
			$('body').on('click', '#rise_invoice', this.travelagentRiseinvoice.riseInvoice);
			$('body').on('submit', '#invoiceForm', this.travelagentClaims.sendclaims);*/
			
			this.initTipTip();

        },

        initTipTip: function() {
            $( '.erp-tips' ).tipTip( {
                defaultPosition: "top",
                fadeIn: 100,
                fadeOut: 100
            } );
        },
        
        payment: {
            
            change: function(){
                var val=this.value;
	
            	switch (val){
            		
            		case '1':
            			$('#chequeid').show();
            			$('#cashid').hide();
            			$('#banktransferid').hide();
            			$('#othersid').hide();
            			$('#txtAmnt').val(null);
            			$('#amountDiv').show();
            		break;
            		
            		case '2':
            			$('#cashid').show();
            			$('#chequeid').hide();
            			$('#banktransferid').hide();
            			$('#othersid').hide();
            			$('#txtAmnt').val(null);
            			$('#amountDiv').show();
            		break;
            		
            		case '3':
            			$('#banktransferid').show();
            			$('#chequeid').hide();
            			$('#cashid').hide();
            			$('#othersid').hide();
            			$('#txtAmnt').val(null);
            			$('#amountDiv').show();
            		break;
            		
            		case '4':
            			$('#othersid').show();
            			$('#chequeid').hide();
            			$('#cashid').hide();
            			$('#banktransferid').hide();
            			$('#txtAmnt').val(null);
            			$('#amountDiv').show();
            		break;
            		
            		default:
            		//$('#fieldsContainr').html('---');
            		$('#chequeid').hide(500);
            		$('#cashid').hide(500);
            		$('#banktransferid').hide(500);
            		$('#othersid').hide(500);
            		$('#txtAmnt').val(null);
            		$('#amountDiv').hide(500);
            		
            		//chequeid cashid banktransferid othersid
            		
            	}
            },
            
            create: function (e) {
                e.preventDefault();
                var paymnt_mode = $('#selPaymentModetc').val();
                if (paymnt_mode == "") {

                    alert("Please select payment mode.");
                    $('#selPaymentModetc').focus();
                    return false;
                }
                switch (paymnt_mode) {

                    case '1':

                        var chq_no = $('#txtChequeNumber').val();
                        var chq_dt = $('#txtCqDate').val();
                        var chq_bb = $('#txtBankBranch').val();
                        var txtAmnt = $('#txtAmnt').val();
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
                        if (txtAmnt == "") {
                            alert("Please enter transaction Amount.");
                            $('#txtAmnt').focus();
                            return false;
                        }

                        break;
                        //-----------------------------------------

                    case '2':

                        var cash_c = $('#txtaCshComments').val();
                        var txtAmnt = $('#txtAmnt').val();
                        if (cash_c == "") {
                            alert("Please enter payment details.");
                            $('#txtChequeNumber').focus();
                            return false;
                        }
                        if (txtAmnt == "") {
                            alert("Please enter transaction Amount.");
                            $('#txtAmnt').focus();
                            return false;
                        }
                        break;
                        //-----------------------------------------

                    case '3':

                        var bt_transid = $('#txtTransId').val();
                        var bt_bankdet = $('#txtBankdetails').val();
                        var bt_date = $('#txtBBDate').val();
                        var txtAmnt = $('#txtAmnt').val();
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
                        
                        if (txtAmnt == "") {
                            alert("Please enter transaction Amount.");
                            $('#txtAmnt').focus();
                            return false;
                        }

                        break;
                        //-----------------------------------------

                    case '4':

                        var other_c = $('#txtaOtherComments').val();
                        var txtAmnt = $('#txtAmnt').val();
                        if (other_c == "") {
                            alert("Please enter payment details.");
                            $('#txtaOtherComments').focus();
                            return false;
                        }
                        if (txtAmnt == "") {
                            alert("Please enter transaction Amount.");
                            $('#txtAmnt').focus();
                            return false;
                        }

                        break;
                }
                wp.ajax.send('payment_details_create_tc', {
                    data: {
                        txtChequeNumber: $('#txtChequeNumber').val(),
                        tdcid: $('#tdcid').val(),
                        reqid: $('#reqid').val(),
                        txtCqDate: $('#txtCqDate').val(),
                        txtBankBranch: $('#txtBankBranch').val(),
                        selPaymentMode: $('#selPaymentModetc').val(),
                        txtaCshComments: $('#txtaCshComments').val(),
                        txtTransId: $('#txtTransId').val(),
                        txtBankdetails: $('#txtBankdetails').val(),
                        txtBBDate: $('#txtBBDate').val(),
                        txtaOtherComments: $('#txtaOtherComments').val(),
                        txtAmnt: $('#txtAmnt').val(),
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
            
        },
        
        travelagentclient: {
            reload: function () {
                //$('.erp-companyinvoicecreate-wrap').load(window.location.href + ' .erp-companyinvoicecreate-wrap-inner');
            },
            delRequest: function(e){
                var reqid = $(this).val();
                if(confirm("Sure to remove request?")){
	                
            		wp.ajax.send('request-delete-user', {
                    data: {
                        req_id: reqid,
                    },
                    success: function (resp) {
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#message').show();
                                $("#message").delay(5000).slideUp(200);
                                location.reload();
                                break;
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
            	
            	} else {
            		
            		return false;
            	}
            },
            delGroupRequest: function(e){
                var reqid = $(this).val();
                if(confirm("Sure to remove request?")){
	                
            		wp.ajax.send('group-request-delete-user', {
                    data: {
                        req_id: reqid,
                    },
                    success: function (resp) {
                        switch (resp.status) {
                            case 'success':
                                $('#p-success').html(resp.message);
                                $('#message').show();
                                $("#message").delay(5000).slideUp(200);
                                location.reload();
                                break;
                        }
                    },
                    error: function (error) {
                        console.log("failure");
                        console.log(error);
                    }
                });
            	
            	} else {
            		
            		return false;
            	}
            },
            groupRequest: function(e){
                e.preventDefault();
                $('.erp-loader').show();
                $('#submit-pre-travel-request').addClass('disabled');
              	
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
              	    
              	}
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
              	wp.ajax.send('group_request_create', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        //console.log(resp);return false;
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
                                location.replace("admin.php?page=group-requests");
                                
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
            bookingRequestUpdate: function(e){
                e.preventDefault();
                $('.erp-loader').show();
                $('#submit-pre-travel-request').addClass('disabled');
              	
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
              	    
              	}
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
              	wp.ajax.send('update-booking-request', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        //console.log(resp);return false;
                        $('.erp-loader').hide();
                       
                        $('#updateBookingRequest').removeClass('disabled');
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
                                location.replace("admin.php?page=booking-requests");
                                
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
            groupRequestEdit: function(e){
                e.preventDefault();
                $('.erp-loader').show();
                $('#submit-pre-travel-request').addClass('disabled');
              	
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
              	    
              	}
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
              	wp.ajax.send('update-booking-request', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        //console.log(resp);return false;
                        $('.erp-loader').hide();
                       
                        $('#updateBookingRequest').removeClass('disabled');
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
                                location.replace("admin.php?page=group-requests");
                                
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
            bookingRequest: function(e){
                e.preventDefault();
                $('.erp-loader').show();
                $('#submit-pre-travel-request').addClass('disabled');
              	
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
              	    
              	}
              	var formData = $(this).find(":input")
                .filter(function(index, element) {
                    return $(element).val() != "";
                })
                .serialize();
              	wp.ajax.send('booking_request_create', {
                    data: formData,
                    success: function (resp) {
                        //console.log("success");
                        //console.log(resp);return false;
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
                                location.replace("admin.php?page=booking-requests");
                                
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
			findEmployee: function (e) {
                var empcode = $.trim($("#empcode").val());
	
	
            	var radTrvPlan = $('input[name=radTrvPlan]:checked').val();
            	
            	//alert(radTrvPlan);
            		
            	//formData = $("#empform").serialize();
            	
            	if(empcode==""){
            		$("#empcode").val('');
            		$("#empcode").focus();
            		return false;
            	}
            	
            	    wp.ajax.send( 'get-emp-details', {
                        data: { 
                            txtEmpCode : empcode, 
                            trvPlan : radTrvPlan, 
                        },
                        success: function(result) {
                           switch(result.status){
				
            				case 1:
            					
            					$('.newEmp').each(function(){
            						$(this).val('');
            					});
            					
            					$(".newEmp").attr("disabled", "disabled");
            					
            					$("#employeeDetailsNew").hide(500);
            					
            					$("#employeeName").html(result.response.empname);
            					$("#employeeEmail").html(result.response.empemail);
            					$("#employeeMobile").html(result.response.empmobile);
            					$("#employeeDob").html(result.response.dob);
            					$("#employeeGender").html(result.response.gender);
            					$("#employeeMealPrf").html(result.response.empmealprf);
            					
            					
            					$("#employeedetails").show(500);
            					
            					$(".visaclass").attr("disabled", "disabled");
            					
            					$(".pptclass").attr("disabled", "disabled");
            					
            					//alert(radTrvPlan)
            					
            					
            					if(radTrvPlan=='international'){
            						
            							var pspstats = result.passportstatus;
            							
            							//alert(pspstats)
            							
            							if(pspstats == '1'){
            								
            								
            								var uri = $("#url").val();
            								
            								if(result.passportresponse.psprtfrontview != ""){
            									
            									var htmlContent = '<a class="btn-link" download href="'+result.passportresponse.psprtfrontview+'");>view/download</a>';
            									
            								} else {
            									
            									htmlContent = '<span class="label label-default">N/A</span>';
            								}
            								
            								
            								$("#empPassportFrontView").html(htmlContent);
            								
            								
            								if(result.passportresponse.psprtbackview != ""){
            									
            									var htmlContent = 	'<a class="btn-link" download href="'+result.passportresponse.psprtbackview+'");>view/download</a>';
            									
            								} else {
            									
            									htmlContent = '<span class="label label-default">N/A</span>';
            									
            								}
            								
            								$("#empPassportBackView").html(htmlContent);
            			
            								
            									
            									$("#empPassportNo").html(result.passportresponse.passno);
            									$("#empIssuedCountry").html(result.passportresponse.issudcntry);
            									$("#empIssuedPlace").html(result.passportresponse.issudplc);
            									$("#empIssuedDate").html(result.passportresponse.issuddate);
            									$("#empExpiryDate").html(result.passportresponse.expirydate);
            									
            									$("#empPassprtDetailsNew").hide(500);
            									
            									$("#empPassportDetails").show(500);
            									
            								
            								
            							} else if(pspstats == '2'){
            								
            								$(".pptclass").removeAttr("disabled");
            									
            								$("#empPassprtDetailsNew").show(500);
            								
            							}
            							
            							
            							$(".visaclass").removeAttr("disabled");
            							
            							$("#empVisaDetailsNew").show(500);
            						
            					}
            										
            					
            	
            					$("#expenseTable").show(500);
            					
            				break;
            				
            				case 2:
            				
            					$(".newEmp").removeAttr("disabled");
            					
            					$("#employeeDetailsNew").show(500);
            					
            					$("#employeedetails").hide(500);
            	
            					$("#expenseTable").show(500);
            					
            					
            					if(radTrvPlan  == 'domestic'){
            						
            						 
            						
            							$(".visaclass").attr("disabled", "disabled");
            					
            							$(".pptclass").attr("disabled", "disabled");
            							
            							$("#empPassprtDetailsNew").hide(500);
            							
            							$("#empVisaDetailsNew").hide(500);
            							
            							
            					} else if(radTrvPlan == 'international') {
            							
            							$(".visaclass").removeAttr("disabled");
            					
            							$(".pptclass").removeAttr("disabled");
            							
            							$("#empPassprtDetailsNew").show(500);
            							
            							$("#empVisaDetailsNew").show(500);
            										 
            						
            					}
            					
            					
            				break;
            				
            			
            			}
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
            },
        },

		 travelagentRiseinvoice: {
            reload: function () {
                $('.erp-companyinvoicecreate-wrap').load(window.location.href + ' .erp-companyinvoicecreate-wrap-inner');
            },
			riseInvoice: function (e) {
                e.preventDefault();
				var cmpid = $('#filter_cmp').val();
				//alert(cmpid);
                var values = new Array();
                $.each($("input[name='reqid[]']:checked"), function () {
                    values.push($(this).val());
                });
                if(values!=""){
					window.location.replace("/wp-admin/admin.php?page=RiseInvoice&action=view&cmpid=" + cmpid +"&id=" + values);
					}

            },
        },
		
		travelagentClaims:{
			
			/* Reload the department area
             *
             * @return {void}
             */
            reload: function() {
                $( '.erp-companyinvoicecreate-wrap' ).load( window.location.href + ' .erp-companyinvoicecreate-wrap-inner' );
            }, 
			
			  /**
             * Create a new employee modal
             *
             * @param  {event}
             */
             sendclaims: function(e) {
				 e.preventDefault();
					/**
                     * Handle the onsubmit function
                     *
                     * @param  {modal}
                     */
                        wp.ajax.send( 'travelagentclaims_create', {
                            data: $(this).serialize(),
                            success: function(response) {
                                console.log(response);
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentClaims.reload();
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                   
            },	 
		},
		
	travelagentUser: {
                
			 /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function() {
                $( '.erp-hr-travelagentuser-wrap' ).load( window.location.href + ' .erp-hr-travelagentuser-wrap-inner' );
            },
			
            /**
             * Create a new employee modal
             *
             * @param  {event}
             */
            create: function(e) {
                //alert("test");
                if ( typeof e !== 'undefined' ) {
                    //e.preventDefault();
                }

                if ( typeof wpErpTa.travelagentuser_empty === 'undefined' ) {
                    //return;
                }
                $.erpPopup({
                    title: wpErpTa.popup.travelagentuser_title,
                    button: wpErpTa.popup.travelagentuser_create,
                    id: "erp-new-travelagentuser-popup",
					//content:"<h1>Test</h1>",
                   content: wperp.template('travelagentuser-create')( wpErpTa.travelagentuser_empty ).trim(),
                    /**
                     * Handle the onsubmit function
                     *
                     * @param  {modal}
                     */
                    onSubmit: function(modal) {
                        $( 'button[type=submit]', '.erp-modal' ).attr( 'disabled', 'disabled' );
                        wp.ajax.send( 'travelagentuser_create', {
                            data: this.serialize(),
                            success: function(response) {
								console.log("response");
                                console.log(response);
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentUser.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function(error) {
                                modal.enableButton();
				$('.erp-modal-backdrop, .erp-modal' ).find( '.erp-loader' ).addClass('erp-hide');
                                modal.showError(error);
                                console.log(error);
                            }
                        });
                    }
                });
            },
			edit: function(e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpTa.popup.travelagentuser_update,
                    button: wpErpTa.popup.update,
                    id: 'erp-employee-edit',
                    onReady: function() {
                        var modal = this;

                        $( 'header', modal).after( $('<div class="loader"></div>').show() );

                        wp.ajax.send( 'travelagentuser_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpTa.nonce
                            },
                            success: function(response) {
								console.log("response");
                                console.log(response);
                              var html = wp.template('travelagentuser-create')( response );
                                $( '.content', modal ).html( html );
                                $( '.loader', modal).remove();
                                // disable current one
                                }
                        });
                    },
                    onSubmit: function(modal) {
                        modal.disableButton();

                        wp.ajax.send( {
                            data: this.serialize(),
                            success: function(response) {
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentUser.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function(error) {
                                modal.enableButton();
                                modal.showError( error );
                            }
                        });
                    }
                });
            },
        },
		
	travelagentClient: {
                
			 /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function() {
                $( '.erp-travelagentclient-wrap' ).load( window.location.href + ' .erp-travelagentclient-wrap-inner' );
            },
			
			/**
             * Set photo popup
             *
             * @param {event}
             */
            setPhoto: function (e) {
                e.preventDefault();
                e.stopPropagation();
                //console.log("inside1");
                var frame;

                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: wpErpTa.emp_upload_photo,
                    button: {text: wpErpTa.emp_set_photo}
                });

                frame.on('select', function () {
                    var selection = frame.state().get('selection');

                    selection.map(function (attachment) {
                        attachment = attachment.toJSON();

                        var html = '<img src="' + attachment.url + '" alt="" />';
                        html += '<input type="hidden" id="emp-photo-id" name="travelagentclient[photo_id]" value="' + attachment.id + '" />';
                        html += '<a href="#" class="erp-remove-photo">&times;</a>';
                        //console.log("inside2");
                        $('.photo-container', '.erp-employee-form').html(html);
                    });
                });

                frame.open();
            },
            /**
             * Remove an employees avatar
             *
             * @param  {event}
             */
            removePhoto: function (e) {
                e.preventDefault();

                var html = '<a href="#" id="erp-set-emp-photo" class="button button-small">' + wpErpTa.emp_upload_photo + '</a>';
                html += '<input type="hidden" name="travelagentclient[photo_id]" id="emp-photo-id" value="0">';

                $('.photo-container', '.erp-employee-form').html(html);
            },
            /**
             * Create a new employee modal
             *
             * @param  {event}
             */
            create: function(e) {
                //alert("test");
                if ( typeof e !== 'undefined' ) {
                    //e.preventDefault();
                }

                if ( typeof wpErpTa.travelagentclient_empty === 'undefined' ) {
                    //return;
                }
                $.erpPopup({
                    title: wpErpTa.popup.travelagentclient_title,
                    button: wpErpTa.popup.travelagentclient_create,
                    id: "erp-new-travelagentclient-popup",
					//content:"<h1>Test</h1>",
                   content: wperp.template('travelagentclient-create')( wpErpTa.travelagentclient_empty ).trim(),
                    /**
                     * Handle the onsubmit function
                     *
                     * @param  {modal}
                     */
                    onSubmit: function(modal) {
						//alert("sdfsdfsf");
                        $( 'button[type=submit]', '.erp-modal' ).attr( 'disabled', 'disabled' );
                        wp.ajax.send( 'travelagentclient_create', {
                            data: this.serialize(),
                            success: function(response) {
			                console.log("response");
                                console.log(response);
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentClient.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function(error) {
                                modal.enableButton();
				$('.erp-modal-backdrop, .erp-modal' ).find( '.erp-loader' ).addClass('erp-hide');
                                modal.showError(error);
                                console.log(error);
                            }
                        });
                    },
                    onReady: function(modal) {
                        $('.erp-select2').select2({
                        }).change(function(event) {
                        });
                    },
                });
            },
			edit: function(e) {
                e.preventDefault();
                var self = $(this);
                
                $.erpPopup({
                    title: wpErpTa.popup.travelagentclient_update,
                    button: wpErpTa.popup.update,
                    id: 'erp-travelagentbankdetails-edit',
                    onReady: function() {
                        var modal = this;
                        $( 'header', modal).after( $('<div class="loader"></div>').show() );
                        wp.ajax.send('travelagentclient_get', {
                            data: {
                                id: self.data('id'),
                               // _wpnonce: wpErpTa.nonce
                            },
                            success: function(response) {
                                console.log(response);
                              var html = wp.template('travelagentclient-create')( response );
                                $( '.content', modal ).html( html );
                                $( '.loader', modal).remove();
                                // disable current one
                                }
                        });
                    },
                    onSubmit: function(modal) {
                        modal.disableButton();

                        wp.ajax.send({
                            data: this.serialize(),
                            success: function(response) {
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentClient.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function(error) {
                                modal.enableButton();
                                modal.showError( error );
								console.log(error);
                            }
                        });
                    }
                });
            },
        },	
		travelagentInvoice: {
			 /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function() {
                $( '.erp-hr-employees-wrap' ).load( window.location.href + ' .erp-hr-employees-wrap-inner' );
            },
			
            /**
             * Create a new employee modal
             *
             * @param  {event}
             */
			view: function(e) {
                e.preventDefault();
                var self = $(this);
				var Companyinvoice = $('#Companyinvoice').val();
				var tabkey = $('#key').val();
				//alert(Companyinvoice);
                 wp.ajax.send( 'companyinvoice_view', {
                             data: {
                                id: Companyinvoice,
                                //_wpnonce: wpErpCompany.nonce
                            }, 
                            success: function(response) {
                                console.log(response);
								$('#invoiceview').show();
								//$('#EMP_Name').html(response.EMP_Name);
								}
                        });
                    
            },
			
		},
			
	travelagentBankdetails: {
                
			 /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function() {
                $( '.erp-travelagentbankdetails-wrap' ).load( window.location.href + ' .erp-travelagentbankdetails-wrap-inner' );
            },
			
            /**
             * Create a new employee modal
             *
             * @param  {event}
             */
            create: function(e) {
                if ( typeof e !== 'undefined' ) {
                    //e.preventDefault();
                }

                if ( typeof wpErpTa.travelagentbankdetails_empty === 'undefined' ) {
                    //return;
                }
                $.erpPopup({
                    title: wpErpTa.popup.travelagentbankdetails_title,
                    button: wpErpTa.popup.travelagentbankdetails_create,
                    id: "erp-new-travelagentbankdetails-popup",
					//content:"<h1>Test</h1>",
                   content: wperp.template('travelagentbankdetails-create')( wpErpTa.travelagentbankdetails_empty ).trim(),
                    /**
                     * Handle the onsubmit function
                     *
                     * @param  {modal}
                     */
                    onSubmit: function(modal) {
                        $( 'button[type=submit]', '.erp-modal' ).attr( 'disabled', 'disabled' );
                        wp.ajax.send( 'travelagentbankdetails_create', {
                            data: this.serialize(),
                            success: function(response) {
                                //console.log(response);
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentBankdetails.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function(error) {
                                modal.enableButton();
				$('.erp-modal-backdrop, .erp-modal' ).find( '.erp-loader' ).addClass('erp-hide');
                                modal.showError(error);
                                console.log(error);
                            }
                        });
                    }
                });
            },
			edit: function(e) {
                e.preventDefault();
                var self = $(this);
                
                $.erpPopup({
                    title: wpErpTa.popup.travelagentbankdetails_update,
                    button: wpErpTa.popup.update,
                    id: 'erp-travelagentbankdetails-edit',
                    onReady: function() {
                        var modal = this;
                        $( 'header', modal).after( $('<div class="loader"></div>').show() );
                        wp.ajax.send('travelagentbankdetails_get', {
                            data: {
                                id: self.data('id'),
                               // _wpnonce: wpErpTa.nonce
                            },
                            success: function(response) {
                                //console.log(response);
                              var html = wp.template('travelagentbankdetails-create')( response );
                                $( '.content', modal ).html( html );
                                $( '.loader', modal).remove();
                                // disable current one
                                }
                        });
                    },
                    onSubmit: function(modal) {
                        modal.disableButton();

                        wp.ajax.send({
                            data: this.serialize(),
                            success: function(response) {
                                WeDevs_ERP_TRAVELAGENTCLIENT.travelagentBankdetails.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function(error) {
                                modal.enableButton();
                                modal.showError( error );
								console.log(error);
                            }
                        });
                    }
                });
            },
        },
	
		
		travelagentcompanyinvoicearw:{
			
			view: function(e) {
					 var self = $(this);
					 var id = self.data('id')
					 //var state = $('.hide-table' + id).attr('class').split(' ')[1];
					 var state = $('.hide-table' + id).hasClass( "collapse" );
					 var caret = $(this).find(".collapse-caret");
					 if(state){
						 $('.hide-table' + id).removeClass('collapse');
						 $('.hide-table' + id).removeClass('init-invoice');
						 $('.hide-table' + id).slideDown();
						 caret.removeClass("fa-angle-down").addClass( "fa-angle-up" );
					 }
					 else{
					 //$(".hide-table").not($(this)).hide('slow');
					 //$(this).closest('tr').hide('slow');
					 $('.hide-table' + id).addClass('collapse');
					 $('.hide-table' + id).addClass('init-invoice');
					 $('.hide-table' + id).slideUp();
					 caret.removeClass("fa-angle-up").addClass( "fa-angle-down" );
					 //$(this).find('.hide-table').hide();
					 }
                },
			
		},
		
	
    };

	
	
    $(function() {
        WeDevs_ERP_TRAVELAGENTCLIENT.initialize();
    });
})(jQuery);
