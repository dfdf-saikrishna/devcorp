/* jshint devel:true */
/* global wpErpHr */
/* global wp */
;
(function ($) {
    'use strict';
    var WeDevs_ERP_COMPANY = {
        /**
         * Initialize the events
         *
         * @return {void}
         */
        initialize: function () {
            //alert("sdasdadas");
            // Import Excel
            $('body').on('click', '#crp_import_excel', this.Emp.import);
            $('body').on('click', '#crp_import_pdf', this.gradelimitsupload.download);
            // Dasboard Overview

            $('ul.erp-dashboard-announcement').on('click', 'a.mark-read', this.dashboard.markAnnouncementRead);
            $('ul.erp-dashboard-announcement').on('click', 'a.view-full', this.dashboard.viewAnnouncement);
            $('ul.erp-dashboard-announcement').on('click', '.announcement-title a', this.dashboard.viewAnnouncementTitle);
//            $('.erp-hr-company').on('click', 'a#erp-companyemployee-new', this.companyEmployee.create);
//            $('.erp-hr-company').on('change', '#selectEmployee', this.companyEmployee.view);
//            //$( '.erp-hr-company' ).on( 'click', '#employeesubmit', this.companyEmployee.view );
//            $('.erp-hr-company').on('click', 'span.edit a', this.companyEmployee.edit);
//            //$('body').on('click', 'a#company-emp-photo ', this.companyEmployee.setPhoto);
//            //$( '.erp-hr-company' ).on( 'click', 'a.submitdelete', this.companyEmployee.remove );
//            $('.erp-hr-company').on('click', 'a#erp-employee-print', this.companyEmployee.printData);

	     $('body').on('click', '.subcats', this.subcategorychange.edit);

            //Mileage
            //$('body').on('click', 'a#erp-new-mileage', this.mileage.create);
            $('.erp-company-mileage').on('click', 'a#erp-new-mileage', this.mileage.create);
            $('.erp-company-mileage').on('click', 'span.edit a', this.mileage.edit);
            //Grades
            $('.erp-company-grades').on('click', 'a#erp-new-grades', this.grades.create);
            $('.erp-company-grades').on('click', 'span.edit a', this.grades.edit);
            //Designation
            $('body').on('click', 'a#erp-new-designations', this.designations.create);
            $('.erp-company-designations').on('click', 'span.edit a', this.designations.edit);
            //Departments
            $('.erp-company-departments').on('click', 'a#erp-new-departments', this.departments.create);
            $('.erp-company-departments').on('click', 'span.edit a', this.departments.edit);
            //cost center
            $('.erp-company-costcenter').on('click', 'a#erp-new-costcenter', this.costcenter.create);
            $('.erp-company-costcenter').on('click', 'span.edit a', this.costcenter.edit);
            $('body').on('change', '#selectcostcenter', this.costcenter.getProjectCodes);
            //Project Code
            $('.erp-company-projectcode').on('click', 'a#erp-new-projectcode', this.projectcode.create);
            $('.erp-company-projectcode').on('click', 'span.edit a', this.projectcode.edit);
            $('body').on('change', '#selectcostcenter', this.projectcode.change);
            $('.erp-company-projectbudget').on('click', 'a#erp-projectcode-budget', this.projectcode.budget);
            $('.erp-company-projectbudget').on('click', 'span.edit a', this.projectcode.editbudget);
            $('.erp-company-categorybudget').on('click', 'a#erp-new-categorybudget', this.categorybudget.create);
            $('.erp-company-categorybudget').on('click', 'span.edit a', this.categorybudget.edit);
            $('.erp-hr-company').on('click', 'a#erp-companyemployee-new', this.companyEmployee.create);
            $('.erp-hr-company').on('change', '#selectEmployee', this.companyEmployee.view);
            //$( '.erp-hr-company' ).on( 'click', '#employeesubmit', this.companyEmployee.view );
            $('.erp-hr-company').on('click', 'span.edit a', this.companyEmployee.edit);
            $('body').on('click', 'a#company-emp-photo ', this.companyEmployee.setPhoto);
            $('body').on('click', '.erp-remove-photo', this.companyEmployee.removePhoto);
            $('.erp-hr-company').on('click', 'a#erp-employee-print', this.companyEmployee.printData);
            $('body').on('click', '#allow_access', this.companyEmployee.allowAccess);
            $('body').on('click', '#remove_access', this.companyEmployee.removeAccess);
            // Workflow
            $('.workflow-update').on('click', '#selPreTrvPol-update', this.workflow.PreTrvPol);
            $('.workflow-update').on('click', '#selPostTrvPol-update', this.workflow.PostTrvPol);
            $('.workflow-update').on('click', '#selGenExpReq-update', this.workflow.GenExpReq);
            $('.workflow-update').on('click', '#selMileageReq-update', this.workflow.MileageReq);
            $('.workflow-update').on('click', '#selUtilityReq-update', this.workflow.UtilityReq);
            // Finance Approver
            $('body').on('change', '#select-finance-approver', this.finance.setAmount);
            $('body').on('click', '#submit_app_limit', this.finance.subAmount);
            $('body').on('click', '#remove_finance', this.finance.removieFinance);
            $('body').on('click', '#set_finance', this.finance.setFinance);
            // Company Admin
            $('body').on('click', 'a#companyadmin-new', this.companyAdmin.create);
            $('.erp-hr-companyadmin').on('click', 'span.edit a', this.companyAdmin.edit);
            //$('.erp-hr-companyadmin').on('click', 'span.delete a', this.companyAdmin.remove);
            $('.erp-company-traveldesk').on('click', 'a#erp-new-traveldesk', this.traveldesk.create);
            $('.erp-company-traveldesk').on('click', 'span.edit a', this.traveldesk.edit);
            //$('.invoice').on('click', '', this.traveldeskclaims.view);
            //employee grade limits edit
            // $('body').on('click', 'span.edit a', this.gradelimits.create);
            $('.erp-company-gradelimits').on('click', 'span.edit a', this.gradelimits.edit);
            $('body').on('click', '#submitToleranceLimits', this.traveldesklimits.update);
            $('body').on('click', '#gradelimitadd', this.catgrade.savetravel);
            $('body').on('click', '#gradelimitstay', this.catgrade.savestay);
            $('body').on('click', '#gradelimitgeneral', this.catgrade.savegeneral);
            $('body').on('click', '#gradelimitother', this.catgrade.saveother);
            $('body').on('submit', '#formlimits', this.catgrade.values);
            $('.erp-company-gradelimits').on('click', '#gradelimitadd', this.catgradepercent.editvalues);
            $('body').on('click', '#send_notification', this.notifications.send);
            $('body').on('click', '#ckbCheckAll', this.notifications.checkAll);
            
            $('body').on('input', '#txtflightpercent', this.catgrade.percent); 
            $('body').on('input', '#txtBuspercent', this.catgrade.percent);
            $('body').on('input', '#txtCarpercent', this.catgrade.percent);
            $('body').on('input', '#txtOthers1percent', this.catgrade.percent); 

            $('.erp-company-subcategory').on('click', 'a#erp-new-subcategory', this.subcategory.create);
            $('.erp-company-subcategory').on('click', 'span.edit a', this.subcategory.edit);
            //$('body').on('click', '#formlimits', this.catgrade.values);
            $('body').on('change', '#costcenter-details', this.graphs.costcenter); 
			$('body').on('submit', '#auto_approval', this.workflow.autoApproval); 

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
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: '-100:+0',
            });
        },
        reloadPage: function () {
            $('.erp-area-left').load(window.location.href + ' #erp-area-left-inner', function () {
                $('.select2').select2();
            });
        },
        Emp: {
            import: function () {
                $('.erp-loader').show();
                $('#crp_import_excel').addClass('disabled');
            }
        },
        gradelimitsupload: {
            download: function () {
                $('.erp-loader').show();
                $('#crp_import_pdf').addClass('disabled');
            }
        },
        //  *****************************
        //         subcategory add
        //   *****************************

	catgradepercent:{
	editvalues: function(e){
	alert("fg");
	 var j = jQuery.noConflict();
	    j(document).ready(function() {
	        //var txtflight = j('#txtflight');
	      
	            alert(j('#txtflight').val());
	     
	    });
	},
	},
	
	subcategorychange:{
	edit: function(e){
	e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-subcategory-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('subcats-edit')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('subcats_edit', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('subcats-edit')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                            }
                        });
	
		     },
		     onSubmit: function (modal) {
                        modal.disableButton();
                        var modename = $('#modName').val();
                        var modeid = $('#modId').val();
                        wp.ajax.send('subcats_update', {
                            data: {
                                modename: modename,
                                modeid: modeid,
                            },
                            success: function (response) {
                                switch (response.status) {
                                    case 'Success':
                                        $('#p-success').html(response.message);
                                        $('#success').show();
                                        modal.enableButton();
                                        modal.closeModal();
                                        $('.erp-company-subcategory-wrap').load(window.location.href + ' .erp-company-subcategory-wrap-inner');
                                        break;
                                    case 'Failure':
                                        $('#p-failure').html(response.message);
                                        $('#failure').show();
                                         modal.enableButton();
                                        break;
                                }
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
		});
	},	
	
	},
	
	graphs:{
	costcenter: function(){
	wp.ajax.send('get-costcenter-details', {
            data: {
                costcenter: $(this).val(),
            },
            success: function (response) {
            	
                console.log(response);
		var data = new google.visualization.DataTable(response);
		
	        var options = {
	          title: 'Cost Center Projects'
	        };
	
	        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	
	        chart.draw(data, options);
                
            },
            error: function (error) {
                console.log(error);
                console.log("error");
            }
        });
	
        
      
	
	
	},
	
	},
	notifications:{
		checkAll: function(){
		    if($(this).is(":checked")) {
	                $('.checkAll').each(function(){
	                    $(this).prop("checked",true);
	                });
	            }
	            else{
	                $('.checkAll').each(function(){
	                    $(this).prop("checked",false);
	                });
	            }   	
		},
		send: function(e){
		    var fuId = $(this).attr("fuId");
		    $.erpPopup({
                    title: 'Employee List',
                    button: 'Send Notification',
                    id: 'emp-notification',
                    onReady: function () {
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
			wp.ajax.send('empnotify-list', {
                            data: {
                                fuId: fuId,
                            },
                            success: function (response) {
                                console.log(response);
                                var html = '<table class="wp-list-table widefat fixed striped costcenters" style="width:100%"><tr><th><input type="checkbox" id="ckbCheckAll" /> Select</th><th>Name</th><th>UserName</th><th>Email</th></tr>';
                                $.each(response, function(i, item) {
                                html +='<div style="display:none" id="failure" class="notice notice-error is-dismissible"><p id="p-failure"></p></div><div style="display:none" id="success" class="notice notice-success is-dismissible"><p id="p-success"></p></div>';
                                html += '<tr><td><input type="checkbox" class="checkAll" value="'+item.ID+'" name="chkemp[]"></td><td>'+item.EMP_Name+'</td><td>'+item.EMP_Username+'</td><td>'+item.EMP_Email+'</td></tr>';
                                });
                                html += '</table>';
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                //modal.enableButton();
                                //modal.closeModal();
                            },
                            error: function (error) {
                                modal.enableButton();
                                $('.erp-modal-backdrop, .erp-modal').find('.erp-loader').addClass('erp-hide');
                                modal.showError(error);
                                console.log(error);
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        var values = new Array();
                        $.each($("input[name='chkemp[]']:checked"), function () {
	                    values.push($(this).val());
	                });
	                console.log(values);
                        wp.ajax.send('empnotify-send', {
                            data: {
                                select: values,
                            },
                            success: function (response) {
                                switch (response.status) {
                                    case 'Success':
                                        $('#p-success').html(response.message);
                                        $('#success').show();
                                        modal.enableButton();
                                        modal.closeModal();
                                        $('.erp-company-departments-wrap-inner').load(window.location.href + ' .costcenters');
                                        break;
                                    case 'Failure':
                                        $('#p-failure').html(response.message);
                                        $('#failure').show();
                                         modal.enableButton();
                                        break;
                                }
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
                
		
		},
	},

        subcategory: {
            reload: function () {
                $('.erp-company-subcategory-wrap').load(window.location.href + ' .erp-company-subcategory-wrap-inner');
            },
            /**
             mileage limits   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.subcategory_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.add,
                    button: wpErpCompany.popup.mileage_submit,
                    id: "erp-new-subcategory-popup",
                    extraClass: 'smaller',
                    content: wperp.template('add-sub-category')(wpErpCompany.subcategory_empty).trim(),
                    //content: '<h1>Test</h1>',
                    onReady: function () {
                        // WeDevs_ERP_COMPANY.initDateField();
                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('subcategory_create', {
                            data: this.serialize(),
                            success: function (response) {
                               // alert('testing');
                                console.log(response);
                                WeDevs_ERP_COMPANY.subcategory.reload();
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
                    title: wpErpCompany.popup.edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-subcategory-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('subcategory-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('subcategory_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('add-sub-category')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                WeDevs_ERP_COMPANY.initDateField();
                                $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                            selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                });
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.subcategory.reload();
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
        },
        catgrade: {
        
             percent: function (e) {
 	    var flightpervalue = parseInt($('#txtflightpercent').val());
 	    var buspervalue = parseInt($('#txtBuspercent').val());
 	    var carpervalue = parseInt($('#txtCarpercent').val());
 	    var otherspervalue = parseInt($('#txtOthers1percent').val());
            	if(flightpervalue > 100){
            		$('#limitcheck').val("Threshold % should not cross 100");
            		$('#txtflightpercent').val("");
            	}else if(buspervalue > 100){
            		$('#limitcheck').val("Threshold % should not cross 100");
            		$('#txtBuspercent').val("");
            	}else if(carpervalue > 100){
            		$('#limitcheck').val("Threshold % should not cross 100");
            		$('#txtCarpercent').val("");
            	}else if(otherspervalue > 100){
            		$('#limitcheck').val("Threshold % should not cross 100");
            		$('#txtOthers1percent').val("");
            	}
            },
 	   
            reload: function () {
                $('.erp-company-gradecat-wrap').load(window.location.href + ' .erp-company-gradecat-wrap-inner');
            },
            savetravel: function (e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.gradelimits_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-gradecat-edit',
                    //extraClass: 'smaller',
                    //content:'<h1>test</h1>',
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('gradelimitscat-get', {
                            data: {
                                id: self.data('id'),
                            },
                            success: function (response) {
                                //alert("response");
                                console.log(response);
                                var html = wp.template('grade-cat-limits')(response);
                                //var css = wp.template('grade-cat-limits2')(response);
                                $('.content', modal).html(html);
                                //$('.content', modal).html(css);
                                $('.loader', modal).remove();
                                //console.log(response);
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
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.catgrade.reload();
                                modal.enableButton();
                                modal.closeModal();
                                location.reload();
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            savestay: function (e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.gradelimits_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-gradecat-edit',
                    //extraClass: 'smaller',
                    //content:'<h1>test</h1>',
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('gradelimitsaccomadation_get', {
                            data: {
                                id: self.data('id'),
                            },
                            success: function (response) {
                                //alert("response");
                                console.log(response);
                                var html = wp.template('accomdation-grade-limits')(response);
                                //var css = wp.template('grade-cat-limits2')(response);
                                $('.content', modal).html(html);
                                //$('.content', modal).html(css);
                                $('.loader', modal).remove();
                                //console.log(response);
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
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.catgrade.reload();
                                modal.enableButton();
                                modal.closeModal();
                                location.reload();
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            savegeneral: function (e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.gradelimits_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-gradecat-edit',
                    //extraClass: 'smaller',
                    //content:'<h1>test</h1>',
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('gradelimitgeneral_get', {
                            data: {
                                id: self.data('id'),
                            },
                            success: function (response) {
                                //alert("response");
                                console.log(response);
                                var html = wp.template('General-cat-limits')(response);
                                $('.content', modal).html(html);
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
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.catgrade.reload();
                                modal.enableButton();
                                modal.closeModal();
                                location.reload();
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            saveother: function (e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.gradelimits_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-gradecat-edit',
                    //extraClass: 'smaller',
                    //content:'<h1>test</h1>',
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('gradelimitothers_get', {
                            data: {
                                id: self.data('id'),
                            },
                            success: function (response) {
                                //alert("response");
                                console.log(response);
                                var html = wp.template('other-catl-imits')(response);
                                $('.content', modal).html(html);
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
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.catgrade.reload();
                                modal.enableButton();
                                modal.closeModal();
                                location.reload();
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
            values: function (e) {
                e.preventDefault();
                var allcat = $('#allcat').val();
                //alert(allcat);
                var grades = $('#grades').val();
                if(grades == ""){
                    alert("Please Select Atleast One Grade");
                    return false;
                }
                //alert(grades);
                if (grades != "" || allcat != "") {
                    //alert(grades);
                    window.location.replace("/wp-admin/admin.php?page=gradelimitcat&allcat=" + allcat + "&grades=" + grades);
                }
            },
        },

        traveldesklimits: {
            reload: function () {
                $('.erp-company-traveldesklimits-wrap').load(window.location.href + ' .erp-company-traveldesklimits-wrap-inner');
            },
            update: function (e) {
                //alert('jkjk');
                wp.ajax.send('tolerance_limit_amount', {
                    data: {
                        txtLimitPercentage: $('#txtLimitPercentage').val(),
                        tlId: $('#tlId').val(),
                    },
                    //alert())
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_ERP_COMPANY.traveldesklimits.reload();
                        
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
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
        },
        //  *****************************
        //         gradelimits add
        //   *****************************
        gradelimits: {
            reload: function () {
                $('.erp-company-gradelimits-wrap').load(window.location.href + ' .erp-company-gradelimits-wrap-inner');
            },
            edit: function (e) {
                e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.gradelimits_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-gradelimits-edit',
                    //extraClass: 'smaller',
                    //content:'<h1>test</h1>',
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('gradelimits_get', {
                            data: {
                                id: self.data('id'),
                            },
                            success: function (response) {
                                //alert(response);
                                //console.log(response);
                                var html = wp.template('grade-limits')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                //console.log(response);
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.gradelimits.reload();
                                modal.enableButton();
                                modal.closeModal();
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
        },
        //  *****************************
        //         costcenter add
        //   *****************************
        costcenter: {
            reload: function () {
                $('.erp-company-costcenter-wrap').load(window.location.href + ' .erp-company-costcenter-wrap-inner');
            },
            
            getProjectCodes: function(){
            	var CostCenter = $('#selectcostcenter').val();
            	var optionsCat = '';
            	if(CostCenter){
            		wp.ajax.send('get-project-codes', {
	                    data: {
	                        CostCenter: CostCenter,
	                    },
	                    success: function (resp) {
	                        $.each(resp, function (index, value) {
                                    //console.log(value);
                                    optionsCat += '<option value="' + value.PC_Id + '">' + value.PC_Code + ' -- ' + value.PC_Name + '</option>';
                                });
                                $('#selectCompany').html('<option value="">Select</option>' + optionsCat);
	                    },
	                    error: function (error) {
	                        console.log(error);
	                    }
	               });
            	
            	}
            
            },
            
            /**
             project code   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.costcenter_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.costcenter_title,
                    button: wpErpCompany.popup.costcenter_submit,
                    id: "erp-new-costcenter-popup",
                    extraClass: 'smaller',
                    content: wperp.template('costcenter-create')(wpErpCompany.costcenter_empty).trim(),
                    //content: '<h1>Test</h1>',
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('costcenter_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                $('.erp-company-costcenters-wrap').load(window.location.href + ' .erp-company-costcenters-wrap-inner');
                                //WeDevs_ERP_COMPANY.costcenter.reload();
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
                    title: wpErpCompany.popup.costcenter_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-costcenter-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('costcenter-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('costcenter_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.costcenter.reload();
                                var html = wp.template('costcenter-create')(response);
                                $('.content', modal).html(html);

                                $('.loader', modal).remove();
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.costcenter.reload();
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
        },
        //  *****************************
        //         projectcode add
        //   *****************************
        projectcode: {
            reload: function () {
                $('.erp-company-projectcode-wrap').load(window.location.href + ' .erp-company-projectcode-wrap-inner');
            },
            intToFormat: function(nStr) {
            	nStr += '';
		     var x = nStr.split('.');
		     var x1 = x[0];
		     var x2 = x.length > 1 ? '.' + x[1] : '';
		     var rgx = /(\d+)(\d{3})/;
		     var z = 0;
		     var len = String(x1).length;
		     var num = parseInt((len/2)-1);
		 
		      while (rgx.test(x1))
		      {
		        if(z > 0)
		        {
		          x1 = x1.replace(rgx, '$1' + ',' + '$2');
		        }
		        else
		        {
		          x1 = x1.replace(rgx, '$1' + ',' + '$2');
		          rgx = /(\d+)(\d{2})/;
		        }
		        z++;
		        num--;
		        if(num == 0)
		        {
		          break;
		        }
		      }
		     return x1 + x2;
            },
            change: function () {
                 //console.log($(this).val());return false;
                 var ccid=$(this).val();
                 var optionsCat="";
                 wp.ajax.send('projectcode_change', {
                            data: {
                                id: ccid,
                               
                            },
                            success: function (response) {
                             //console.log(response);
                             var total_budget = WeDevs_ERP_COMPANY.projectcode.intToFormat(response.total_budget);
                             var remaining_budget = WeDevs_ERP_COMPANY.projectcode.intToFormat(response.remaining_budget);                               
                             $('#costCenterBudget').html(total_budget);
                             $('#availableBudget').html(remaining_budget);
                            }
                        });
               
            },
            budget: function(e){
            	if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.projectcode_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.projectcode_title, 
                    button: wpErpCompany.popup.projectcode_submit,
                    id: "erp-new-projectcode-popup",
                    extraClass: 'smaller',
                    content: wperp.template('add-project-budget')(wpErpCompany.projectbudget_empty).trim(),
                    //content: '<h1>Test</h1>',
//                    onReady: function () {
//                        WeDevs_ERP_COMPANY.initDateField();
//                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('projectbudget_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                
                                WeDevs_ERP_COMPANY.projectcode.reload();
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
                    },
                    onReady: function(modal) {
                        $('.erp-select2').select2({
                        }).change(function(event) {
                        });
                    },
                });
            
            },
            editbudget: function(e){
            	e.preventDefault();
                var self = $(this);
                //alert("edit");
                $.erpPopup({
                    title: wpErpCompany.popup.projectcode_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-projectbudget-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('add-project-budget')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('projectbudget_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('add-project-budget')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
//                                WeDevs_ERP_COMPANY.initDateField();
				  $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                    selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                });
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.projectcode.reload();
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
            /**
             project code   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.projectcode_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.projectbudget_title,
                    button: wpErpCompany.popup.projectcode_submit,
                    id: "erp-new-projectcode-popup",
                    //extraClass: 'smaller',
                    content: wperp.template('project-create')(wpErpCompany.projectcode_empty).trim(),
                    //content: '<h1>Test</h1>',
//                    onReady: function () {
//                        WeDevs_ERP_COMPANY.initDateField();
//                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('projectcode_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                switch (response.status) {
                                    case 'Success':
                                        $('#p-success').html(response.message);
                                        $('#success').show();
                                        $("#success").delay(5000).slideUp(200);
                                        WeDevs_ERP_COMPANY.projectcode.reload();
	                                modal.enableButton();
	                                modal.closeModal();
                                        break;
                                    case 'Failure':
                                        $('#p-failure').html(response.message);
                                        $('#failure').show();
                                        $("#failure").delay(5000).slideUp(200);
                                        WeDevs_ERP_COMPANY.projectcode.reload();
	                                modal.enableButton();
                                        break;
                                }

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
                    title: wpErpCompany.popup.projectbudget_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-projectcode-edit',
                    //extraClass: 'smaller',
                    //content: wperp.template('projectcode-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('projectcode_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('project-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
//                                WeDevs_ERP_COMPANY.initDateField();
				                    $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                    selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                    });
                                    setTimeout(function() {
                                    $('li[data-project]', modal).each(function () {
                                    var self = $(this),
                                    selected = self.data('project');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                    });
                                    }, 1000)
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.projectcode.reload();
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
        },

       //  *****************************
        //         category budget add
        //   *****************************
        categorybudget: {
            reload: function () {
                $('.erp-company-categorybudget-wrap').load(window.location.href + ' .erp-company-categorybudget-wrap-inner');
            },
            /**
             categorybudget code   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.categorybudget_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.categorybudget_title,
                    button: wpErpCompany.popup.categorybudget_submit,
                    id: "erp-new-categorybudget-popup",
                    extraClass: 'smaller',
                    content: wperp.template('categorybudget-create')(wpErpCompany.categorybudget_empty).trim(),
                    //content: '<h1>Test</h1>',
//                    onReady: function () {
//                        WeDevs_ERP_COMPANY.initDateField();
//                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('categorybudget_create', {
                            data: this.serialize(),
                            success: function (response) {
                                //alert(response);
                               if(response=='Budget limits exceeded')
                               {
                                //alert("Budget limits exceeded");
                                modal.enableButton();
                                modal.showError(response);
                                $('.loader', modal).remove();
                               }else
                       {
                                console.log(response);
                                alert("Budget added successfully");
                                WeDevs_ERP_COMPANY.categorybudget.reload();
                                modal.enableButton();
                                modal.closeModal();
                        }
                               
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
                    title: wpErpCompany.popup.projectcode_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-projectcode-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('projectcode-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('projectcode_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('project-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
//                                WeDevs_ERP_COMPANY.initDateField();
//
//                                $('li[data-selected]', modal).each(function () {
//                                    var self = $(this),
//                                            selected = self.data('selected');
//
//                                    if (selected !== '') {
//                                        self.find('select').val(selected).trigger('change');
//                                    }
//                                });
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.projectcode.reload();
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
        },


        //  *****************************
        //        Department add
        //   *****************************
        departments: {
            reload: function () {
                $('.erp-company-departments-wrap').load(window.location.href + ' .erp-company-departments-wrap-inner');
            },
            /**
             finance limits   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.departments_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.departments_title,
                    button: wpErpCompany.popup.departments_submit,
                    id: "erp-new-departments-popup",
                    extraClass: 'smaller',
                    content: wperp.template('department-create')(wpErpCompany.departments_empty).trim(),
                    //content: '<h1>Test</h1>',
//                    onReady: function () {
//                        WeDevs_ERP_COMPANY.initDateField();
//                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('departments_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.departments.reload();
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
                    title: wpErpCompany.popup.departments_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-departments-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('departments-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('departments_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('department-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                WeDevs_ERP_COMPANY.initDateField();
                                $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                            selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                });
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.departments.reload();
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
        },
        //  *****************************
        //         Desination add
        //   *****************************
        designations: {
            reload: function () {
                $('.erp-company-designations-wrap').load(window.location.href + ' .erp-company-designations-wrap-inner');
            },
            /**
             finance limits   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.designation_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.designation_title,
                    button: wpErpCompany.popup.designation_submit,
                    id: "erp-new-designations-popup",
                    extraClass: 'smaller',
                    content: wperp.template('designation-create')(wpErpCompany.designation_empty).trim(),
                    //content: '<h1>Test</h1>',
//                    onReady: function () {
//                        WeDevs_ERP_COMPANY.initDateField();
//                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('designation_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.designations.reload();
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
                    title: wpErpCompany.popup.designation_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-designations-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('desgination-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('designation_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('designation-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.designations.reload();
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
        },
        //  *****************************
        //         Grades add
        //   *****************************
        grades: {
            reload: function () {
                $('.erp-company-grades-wrap').load(window.location.href + ' .erp-company-grades-wrap-inner');
            },
            /**
             finance limits   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.grades_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.gardes_title,
                    button: wpErpCompany.popup.gardes_submit,
                    id: "erp-new-grades-popup",
                    extraClass: 'smaller',
                    content: wperp.template('grades-create')(wpErpCompany.grades_empty).trim(),
//                    //content: '<h1>Test</h1>',
//                    onReady: function () {
//                        WeDevs_ERP_COMPANY.initDateField();
//                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('grades_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.grades.reload();
                                switch (response.status) {
                                    case 'info':
                                        $('#p-info').html(response.message);
                                        $('#info').show();
                                        $("#info").delay(5000).slideUp(200);
                                        break;
                                    case 'notice':
                                        $('#p-notice').html(response.message);
                                        $('#notice').show();
                                        $("#notice").delay(5000).slideUp(200);
                                        break;
                                    case 'success':
                                        $('#p-success').html(response.message);
                                        $('#success').show();
                                        $("#success").delay(5000).slideUp(200);
                                        break;
                                    case 'failure':
                                        $('#p-failure').html(response.message);
                                        $('#failure').show();
                                        $("#failure").delay(5000).slideUp(200);
                                        break;
                                }

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
                    title: wpErpCompany.popup.gardes_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-grades-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('grades-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('grades_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('grades-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.grades.reload();
                                modal.enableButton();
                                modal.closeModal();
                            },
                            error: function (error) {
                                console.log(error);
                                modal.enableButton();
                                modal.showError(error);
                            }
                        });
                    }
                });
            },
        },
        //  *****************************
        //        Travel Desk
        //   *****************************
        traveldesk: {
            reload: function () {
                $('.erp-company-traveldesk-wrap').load(window.location.href + ' .erp-company-traveldesk-wrap-inner');
            },
            /**
             finance limits   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.traveldesk_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.traveldesk_title,
                    button: wpErpCompany.popup.traveldesk_submit,
                    id: "erp-new-traveldesk-popup",
                    extraClass: 'smaller',
                    content: wperp.template('traveldesk-create')(wpErpCompany.traveldesk_empty).trim(),
                    //content: '<h1>Test</h1>',
                    onReady: function () {
                        WeDevs_ERP_COMPANY.initDateField();
                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('traveldesk_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.traveldesk.reload();
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
                    title: wpErpCompany.popup.traveldesk_edit,
                    button: wpErpCompany.popup.update,
                    id: 'erp-traveldesk-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('traveldesk-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('traveldesk_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('traveldesk-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        //alert('dfhvg');
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.traveldesk.reload();
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
        },
        //  *****************************
        //         Mileage add
        //   *****************************
        mileage: {
            reload: function () {
                $('.erp-company-mileage-wrap').load(window.location.href + ' .erp-company-mileage-wrap-inner');
            },
            /**
             mileage limits   modal
             */
            create: function (e) {
                //alert('test');
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }
                if (typeof wpErpCompany.mileage_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.mileage_title,
                    button: wpErpCompany.popup.mileage_submit,
                    id: "erp-new-mileage-popup",
                    extraClass: 'smaller',
                    content: wperp.template('mileage-create')(wpErpCompany.mileage_empty).trim(),
                    //content: '<h1>Test</h1>',
                    onReady: function () {
                        WeDevs_ERP_COMPANY.initDateField();
                    },
                    /**
                     * Handle the onsubmit function
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('mileage_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                WeDevs_ERP_COMPANY.mileage.reload();
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
                    title: wpErpCompany.popup.mileage_edit,
                    button: wpErpCompany.popup.mileage_update,
                    id: 'erp-mileage-edit',
                    extraClass: 'smaller',
                    //content: wperp.template('mileage-create')().trim(),
                    onReady: function () {
                        //alert('dfhdvj');
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('mileage_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('mileage-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                WeDevs_ERP_COMPANY.initDateField();
                                $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                            selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                });
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.mileage.reload();
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
        },
        workflow: {
			autoApproval: function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				wp.ajax.send('auto_approval', {
                    data: data,
                    success: function (resp) {
						console.log(resp);
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
                        // console.log("failure");
                        console.log(error);
                    }
                });
			},
			
            PreTrvPol: function () {

                wp.ajax.send('save-PreTrvPol', {
                    data: {
                        select: $('#selPreTrvPol').val()
                    },
                    success: function (resp) {
                        console.log(resp);
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
                        $('#p-failure').html("Something went wrong Please try again");
                        $('#failure').show();
                        $("#failure").delay(5000).slideUp(200);
                        return;
                    }

                });
            },
            PostTrvPol: function () {

                wp.ajax.send('save-PostTrvPol', {
                    data: {
                        select: $('#selPostTrvPol').val()
                    },
                    success: function (resp) {
                        console.log(resp);
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
                        $('#p-failure').html("Something went wrong Please try again");
                        $('#failure').show();
                        $("#failure").delay(5000).slideUp(200);
                        return;
                    }

                });
            },
            GenExpReq: function () {

                wp.ajax.send('save-GenExpReq', {
                    data: {
                        select: $('#selGenExpReq').val()
                    },
                    success: function (resp) {
                        console.log(resp);
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
                        $('#p-failure').html("Something went wrong Please try again");
                        $('#failure').show();
                        $("#failure").delay(5000).slideUp(200);
                        return;
                    }

                });
            },
            MileageReq: function () {

                wp.ajax.send('save-MileageReq', {
                    data: {
                        select: $('#selMileageReq').val()
                    },
                    success: function (resp) {
                        console.log(resp);
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
                        $('#p-failure').html("Something went wrong Please try again");
                        $('#failure').show();
                        $("#failure").delay(5000).slideUp(200);
                        return;
                    }

                });
            },
            UtilityReq: function () {

                wp.ajax.send('save-UtilityReq', {
                    data: {
                        select: $('#selUtilityReq').val()
                    },
                    success: function (resp) {
                        console.log(resp);
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
                        $('#p-failure').html("Something went wrong Please try again");
                        $('#failure').show();
                        $("#failure").delay(5000).slideUp(200);
                        return;
                    }

                });
            }
        },
        finance: {
            reload: function () {
                $('.erp-hr-employees-wrap').load(window.location.href + ' .erp-hr-employees-wrap-inner');
            },
            setAmount: function (e) {
                var select = $('#select-finance-approver').val();
                wp.ajax.send('get-limit-amount', {
                    data: {
                        employee_id: select
                    },
                    success: function (resp) {
                        //console.log( resp );
                        if (resp) {
                            $('#approvers_limit').show().fadeIn();
                            $('#limit_amount').val(resp.APL_LimitAmount);
                            $('#aplId').val(resp.APL_Id);
                        } else {
                            if (select == "0") {
                                $('#approvers_limit').hide().fadeOut();
                            } else {
                                $('#limit_amount').val('');
                                $('#approvers_limit').show().fadeIn();
                            }

                        }
                        //leavetypewrap.html( resp ).hide().fadeIn();
                        //leaveWrap.find( 'input[type="text"], textarea').removeAttr('disabled');
                    },
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
            subAmount: function (e) {
                wp.ajax.send('set-limit-amount', {
                    data: {
                        limit_amount: $('#limit_amount').val(),
                        aplId: $('#aplId').val(),
                        empid: $('#select-finance-approver').val()
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_ERP_COMPANY.finance.reload();
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
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
            setFinance: function () {
                var values = new Array();
                $.each($("input[name='id[]']:checked"), function () {
                    values.push($(this).val());
                });
                wp.ajax.send('set-finance-approver', {
                    data: {
                        select: values,
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_ERP_COMPANY.finance.reload();
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
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
            removieFinance: function (e) {
                var values = new Array();
                $.each($("input[name='id[]']:checked"), function () {
                    values.push($(this).val());
                });
                wp.ajax.send('remove-finance-approver', {
                    data: {
                        select: values,
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_ERP_COMPANY.finance.reload();
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
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            }
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
                                WeDevs_ERP_COMPANY.department.reload();
                                if (is_single != '1') {
                                    $('body').trigger('erp-hr-after-new-dept', [res]);
                                } else {
                                    WeDevs_ERP_COMPANY.department.tempReload();
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
                                WeDevs_ERP_COMPANY.department.reload();
                                WeDevs_ERP_COMPANY.department.tempReload();
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
                                WeDevs_ERP_COMPANY.department.tempReload();
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
                        WeDevs_ERP_COMPANY.initDateField();
                        $('.select2').select2();
                        WeDevs_ERP_COMPANY.employee.select2Action('erp-hrm-select2');
                        WeDevs_ERP_COMPANY.employee.select2AddMoreContent();
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
                                WeDevs_ERP_COMPANY.employee.reload();
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
                                WeDevs_ERP_COMPANY.initDateField();
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
                                WeDevs_ERP_COMPANY.employee.reload();
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
                                WeDevs_ERP_COMPANY.companyAdmin.reload();
                            });
                        },
                        error: function (response) {
                            alert(response);
                        }
                    });
                }
            },
        },
        companyEmployee: {
            /**
             * Reload the department area
             *
             * @return {void}
             */
            reload: function () {
                $('.erp-hr-employees-wrap').load(window.location.href + ' .erp-hr-employees-wrap-inner');
            },
            allowAccess: function () {
                var values = new Array();
                $.each($("input[name='id[]']:checked"), function () {
                    values.push($(this).val());
                });
                wp.ajax.send('allow-access', {
                    data: {
                        select: values,
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_ERP_COMPANY.finance.reload();
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
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
            removeAccess: function () {
                var values = new Array();
                $.each($("input[name='id[]']:checked"), function () {
                    values.push($(this).val());
                });
                wp.ajax.send('block-access', {
                    data: {
                        select: values,
                    },
                    success: function (resp) {
                        console.log(resp);
                        WeDevs_ERP_COMPANY.finance.reload();
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
                    error: function (resp) {
                        //leavetypewrap.html( wpErpHr.empty_entitlement_text ).hide().fadeIn();
                        console.log(resp);
                    }
                });
            },
            /**
             * Set photo popup
             *
             * @param {event}
             */
            setPhoto: function (e) {
                e.preventDefault();
                e.stopPropagation();
                console.log("inside1");
                var frame;
                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: wpErpCompany.emp_upload_photo,
                    button: {text: wpErpCompany.emp_set_photo}
                });
                frame.on('select', function () {
                    var selection = frame.state().get('selection');
                    selection.map(function (attachment) {
                        attachment = attachment.toJSON();
                        var html = '<img src="' + attachment.url + '" alt="" />';
                        html += '<input type="hidden" id="emp-photo-id" name="companyemployee[photo_id]" value="' + attachment.id + '" />';
                        html += '<a href="#" class="erp-remove-photo">&times;</a>';
                        console.log("inside2");
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
                var html = '<a href="#" id="erp-set-emp-photo" class="button button-small">' + wpErpCompany.emp_upload_photo + '</a>';
                html += '<input type="hidden" name="companyemployee[photo_id]" id="emp-photo-id" value="0">';
                $('.photo-container', '.erp-employee-form').html(html);
            },
            /**
             * Create a new employee modal
             *
             * @param  {event}
             */
            create: function (e) {
                //alert("test");
                if (typeof e !== 'undefined') {
                    //e.preventDefault();
                }

                if (typeof wpErpCompany.companyemployee_empty === 'undefined') {
                    //return;
                }
                $.erpPopup({
                    title: wpErpCompany.popup.companyemployee_title,
                    button: wpErpCompany.popup.companyemployee_create,
                    id: "erp-new-companyemployee-popup",
                    content: wperp.template('companyemployee-create')(wpErpCompany.companyemployee_empty).trim(),
                    /**
                     * Handle the onsubmit function
                     *
                     * @param  {modal}
                     */
                    onSubmit: function (modal) {
                        $('button[type=submit]', '.erp-modal').attr('disabled', 'disabled');
                        wp.ajax.send('companyemployee_create', {
                            data: this.serialize(),
                            success: function (response) {
                                console.log(response);
                                if(response == "User email already Exists")
                                {
                                alert(response);
                                modal.enableButton();
                                return false;
                                }
                                WeDevs_ERP_COMPANY.companyEmployee.reload();
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
                    },
					onReady: function(modal) {
                        $('.erp-select2').select2({
                        }).change(function(event) {
                        });
                    },
                });
            },
            edit: function (e) {
                e.preventDefault();
                var self = $(this);
                $.erpPopup({
                    title: wpErpCompany.popup.companyemployee_update,
                    button: wpErpCompany.popup.companyemployee_update,
                    id: 'erp-companyemployee-edit',
                    onReady: function () {
                        var modal = this;
                        $('header', modal).after($('<div class="loader"></div>').show());
                        wp.ajax.send('companyemployee_get', {
                            data: {
                                id: self.data('id'),
                                _wpnonce: wpErpCompany.nonce
                            },
                            success: function (response) {
                                console.log(response);
                                var html = wp.template('companyemployee-create')(response);
                                $('.content', modal).html(html);
                                $('.loader', modal).remove();
                                WeDevs_ERP_COMPANY.initDateField();
                                $('li[data-selected]', modal).each(function () {
                                    var self = $(this),
                                            selected = self.data('selected');
                                    if (selected !== '') {
                                        self.find('select').val(selected).trigger('change');
                                    }
                                });
                                // disable current one
                                $('#work_reporting_to option[value="' + response.id + '"]', modal).attr('disabled', 'disabled');
								// Initialize select
								$('.erp-select2').select2({
								}).change(function(event) {
								});
                            }
                        });
                    },
                    onSubmit: function (modal) {
                        modal.disableButton();
                        wp.ajax.send({
                            data: this.serialize(),
                            success: function (response) {
                                WeDevs_ERP_COMPANY.companyEmployee.reload();
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
            view: function (e) {
                e.preventDefault();
                var self = $(this);
                var selectEmployee = $('#selectEmployee').val();
                var profilemanage = $('#profilemanage').val();
                //alert(profilemanage);
                var tabkey = $('#key').val();
                //alert(selectEmployee);
                wp.ajax.send('companyemployee_view', {
                    data: {
                        id: selectEmployee,
                        val: profilemanage,
                        //_wpnonce: wpErpCompany.nonce
                    },
                    success: function (response) {
                        console.log(response);
                        //var html = wp.template('companyemployee-view')( response );
                        if (selectEmployee == '0') {
                            $('#employeeview').hide();
                        } else {
                            $('#employeeview').show();
                        }
                        if (response.EMP_Photo == "") {
                            $('#EMP_Photo').html('<img alt="" src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" srcset="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-150 photo" height="150" width="150">');
                        } else {
                            $('#EMP_Photo').html('<img src="' + response.EMP_Photo + '" height="150" width="150">');
                        }
                        $('#EMP_Name').html(response.EMP_Name);
                        $('#EMP_Id').html(response.EMP_Id);
                        $('#EMP_Id').val(response.EMP_Id);
                        $('#EMP_Code').html(response.EMP_Code);
                        $('#EMP_Email').html(response.EMP_Email);
                    }
                });
            },
            remove: function (e) {
                e.preventDefault();
                var self = $(this);
                if (confirm(wpErpCompany.delConfirmEmployee)) {
                    wp.ajax.send('companyemployee-delete', {
                        data: {
                            _wpnonce: wpErpCompany.nonce,
                            id: self.data('id'),
                            hard: self.data('hard')

                        },
                        success: function () {
                            alert("delete");
                            self.closest('tr').fadeOut('fast', function () {
                                $(this).remove();
                                WeDevs_ERP_COMPANY.companyEmployee.reload();
                            });
                        },
                        error: function (response) {
                            alert(response);
                        }
                    });
                }
            },
            printData: function (e) {
                e.preventDefault();
                window.print();
            },
        },
    };
    $(function () {
        WeDevs_ERP_COMPANY.initialize();
    });
})(jQuery);


