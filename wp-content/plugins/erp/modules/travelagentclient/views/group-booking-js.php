<script>
var j = jQuery.noConflict();
function calcTotalCost(){

	var empCnt = j("#empcount").val();
	var flight = parseInt(j("#txtCost1").val());
	var hotel = parseInt(j("#txtCost2").val());
	var bus = parseInt(j("#txtCost3").val());
	if(!flight)
	flight = 0;
	if(!hotel)
	hotel = 0;
	if(!bus)
	bus = 0;
	var unitCost = flight+hotel+bus;
	console.log(unitCost);
	j("#txtTotalCost").val(empCnt * unitCost);

}



function checkDisabled(elementid){

	var isDisabled = j(elementid).is(':disabled');
	
    if (isDisabled) {
        return 1;
    } else {
		return 0;
    }
}

// mobile number validation

function is_mobile_valid(string_or_number){
            var mobile=string_or_number;
            if(mobile.length!=10){
                return false;

            }
            intRegex = /[0-9 -()+]+j/;
            is_mobile=true;
            for ( var i=0; i < 10; i++) {
                if(intRegex.test(mobile[i]))
                     { 
                     continue;
                     }
                    else{
                        is_mobile=false;
                        break;
                    }
                 }
            return is_mobile;

}

// email validation

function validateEmail(jemail) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?j/;
  return emailReg.test( jemail );
}



/**
* TRAVEL EXPENSE VALIDATION
*
*/

function validateGrpReq(n)
{
  	var flag=0;
	
	
	j(".customAlert").remove();
	
	 var data = 'md-scale';
	
  	var dates		=	document.getElementsByName('txtDate[]');
	var expdesc		=	document.getElementsByName('txtaExpdesc[]');
	var expcat		=	document.getElementsByName('selExpcat[]');
	var mode		=	document.getElementsByName('selModeofTransp[]');
  	var from		=	document.getElementsByName('from[]');
	var to  		=	document.getElementsByName('to[]');
	var selStayDur 	=	document.getElementsByName('selStayDur[]');
	var ecost		=	document.getElementsByName('txtCost[]');	 
	var tcost		=	document.getElementsByName('txtTotalCost[]');
	
	 
	var rowmax		=	document.getElementById('hidrowno').value;
	
	
	
	var emps		=	document.getElementById("addnewRequest").value;	
	
	
	n = parseInt(n);
	
	switch(n){
		
		case 3:
			var radTrvPlan 	= j('input[name=radTrvPlan]:checked').val();
		break;
		
		case 5:
			var radTrvPlan 	= j('#trvpln').val();
		break;
	
	}
	
	//alert(radTrvPlan)
	
			
		// checking for duplicate employee code
		
			
	breakOut = false;
	
	j(".grpempcode").each(function() {
		
		var empCd = j.trim(j(this).val());
		
		//alert(empCd)
		
		if(empCd == ""){
			//alert(1)
			breakOut = true;
			 return false;
			
		} 
	
	});
	
	
	//alert(0); 
	if(breakOut){
	
		//alert(3)
	
		j("#notfcContent").html('Employee Codes Not Filled Properly');
		
		j("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show');
		
		return false;
	}
			//return false;
			
			var empArr = [];
			
			breakOut = false;
			
			j(".grpempcode").each(function() {
				
				var empCd = j.trim(j(this).val());
				
				if(empCd){
				
					empCd = empCd.toLowerCase();
					
					var a = empArr.indexOf(empCd);
					
					if(a == '-1')
					empArr.push(empCd);
					else{
						 breakOut = true;
						 return false;
					}
				
				}	
			
			});
			
			
			if(breakOut){
			
				
				j("#notfcContent").html('Duplicate Employee Codes Not Allowed');
				
				j("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show');				
				
				return false;
			
			}
		
		
		var count = j("#empcount").val();
			
		if(count < 2){
		
			j("#notfcContent").html("Minimum two employees should be allocated for a Group Request");
	
			j("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show');		
			 
			
			j("#selEmployees").focus();
			
			return false;
		
		}
		
		
		
		var nooffields = j("#fields").val();
	
	
		if(nooffields){
	
			//alert(nooffields);
			
			var nooffields = nooffields.replace(/^,|,j/g,'');
		
		
			var nooffieldsarry = nooffields.split(",");
			
			
			
			
			for(var i = 0; i< nooffieldsarry.length; i++){
				
				//alert(nooffieldsarry[0])
				
				// txtEmail1 txtMobile1 txtDob1  
				
				
				
				var nameid 		= "#txtEmpName"+nooffieldsarry[i];
							
				var emailid		= "#txtEmail"+nooffieldsarry[i];
				
				var mobileid	= "#txtMobile"+nooffieldsarry[i];
				
				var dobid		= "#txtDob"+nooffieldsarry[i];
				
				
				var empname 	= j.trim(j(nameid).val());
				
				var empemail 	= j.trim(j(emailid).val());
				
				var empmobile 	= j.trim(j(mobileid).val());
				
				var empdob 		= j.trim(j(dobid).val());
				
				
				//alert(empname)
				
				/*if(!checkDisabled(nameid))
				alert(1)
				else
				alert(2)*/
				
				
				//test = checkDisabled(nameid);
				
				//alert(test)
				
				if(empname == "" && !checkDisabled(nameid)){
							
							//alert(5465)	
					  
					j("<label class='text-danger customAlert'>Please enter employee name</label>").insertAfter(nameid);
					
					j(nameid).focus();
						
					return false;
					
				}
				//alert(22)	
				
				if(empemail == "" && !checkDisabled(emailid)){
					//alert(991)
					
					j("<label class='text-danger customAlert'>Please enter email id.</label>").insertAfter(emailid);
					
					j(emailid).focus();
					
					return false;
					
				} else if(empemail) {
				
				
					if( !validateEmail(empemail)) {
					//alert(992)
						j("<label class='text-danger customAlert'>Please enter a valid email id.</label>").insertAfter(emailid);
						
						j(emailid).focus();
						
						return false;
					
					}
				
				}
				
				
				if(empmobile == "" && !checkDisabled(mobileid)){
				
					//alert(993)
					
					j("<label class='text-danger customAlert'>Please enter mobile number.</label>").insertAfter(mobileid);
					
					j(mobileid).focus();
					
					return false;
					
					
				} else if(empmobile) {
				
				
					if(!is_mobile_valid(empmobile)){
					//alert(994)
						j("<label class='text-danger customAlert'>Please enter valid mobile number. Only 10 Digits.</label>").insertAfter(mobileid);
						
						j(mobileid).focus();
						
						return false;
					}
				
				}
				
				
				if(empdob == "" && !checkDisabled(dobid)){
				//alert(99)
					
					j("<label class='text-danger customAlert'>Please enter date of birth.</label>").insertAfter(dobid);
					
					j(dobid).focus();
					
					return false;
					
				}
				
				
				// if international trip validate passport and visa details
				
				//fileFrontView1 fileBackView1 txtPassportno1  txtIssuedCountry1 txtIssuedplc1 txtIssuedDAte1 txtExpiryDate1
				
				//fileComplogo1 txtVisa1 txtCountry1 txtIssuedAt1  txtTypeofvisa1  txtNoofEntries1 txtDateofIssue1 txtDateofExpiry1
				
				//alert(radTrvPlan)
				//alert(111)
				if(radTrvPlan == 'international'){
				
				
					
					// passport  details
					
					
					var psprtfrntviewid 		= "#fileFrontView"+nooffieldsarry[i];
							
					var psprtbckviewid			= "#fileBackView"+nooffieldsarry[i];
					
					var psprtnoid				= "#txtPassportno"+nooffieldsarry[i];
					
					var issdcntryid				= "#txtIssuedCountry"+nooffieldsarry[i];
					
					var psprtissdplcid 			= "#txtIssuedplc"+nooffieldsarry[i];
							
					var psprtissddateid			= "#txtIssuedDAte"+nooffieldsarry[i];
					
					var psprtnoexpdateid		= "#txtExpiryDate"+nooffieldsarry[i];
									
					
					
					var psprtfrntview 	= j.trim(j(psprtfrntviewid).val());
					
					var psprtbckview 	= j.trim(j(psprtbckviewid).val());
					
					var psprtno 		= j.trim(j(psprtnoid).val());
					
					var issdcntry 		= j.trim(j(issdcntryid).val());
					
					var psprtissdplc 	= j.trim(j(psprtissdplcid).val());
					
					var psprtissddate 	= j.trim(j(psprtissddateid).val());
					
					var psprtnoexpdate 	= j.trim(j(psprtnoexpdateid).val());
					
					
					
									
					if(psprtfrntview == "" && !checkDisabled(psprtfrntviewid)){
				
						
						j("<label class='text-danger customAlert'>Please upload passport front side page.</label>").insertAfter(psprtfrntviewid);	
						
						j(psprtfrntviewid).focus();
						
						return false;
						
					}
					
				if(psprtbckview == "" && !checkDisabled(psprtbckviewid)){
						
						
						j("<label class='text-danger customAlert'>Please upload passport back side page.</label>").insertAfter(psprtfrntviewid);
						
						j(psprtbckviewid).focus();
						
						return false;
						
					}
				if(psprtno == "" && !checkDisabled(psprtnoid)){
					
						
						j("<label class='text-danger customAlert'>Please enter passport number</label>").insertAfter(psprtnoid);
						
						j(psprtnoid).focus();
						
						return false;
						
					}
				if(issdcntry == "" && !checkDisabled(issdcntryid)){
				
				
							
						
						j("<label class='text-danger customAlert'>lease enter issued country.</label>").insertAfter(issdcntryid);
						
						j(issdcntryid).focus();
						
						return false;
						
					}
				if(psprtissdplc == "" && !checkDisabled(psprtissdplcid)){
				
				
						
						
						j("<label class='text-danger customAlert'>Please enter passport issued place.</label>").insertAfter(psprtissdplcid);	
						
						j(psprtissdplcid).focus();
						
						return false;
						
					}
				if(psprtissddate == "" && !checkDisabled(psprtissddateid)){
				
				
						
						
						j("<label class='text-danger customAlert'>Please enter passport issued date.</label>").insertAfter(psprtissddateid);	
						
						j(psprtissddateid).focus();
						
						return false;
						
					}
				if(psprtnoexpdate == "" && !checkDisabled(psprtnoexpdateid)){
				
				
						
						
						j("<label class='text-danger customAlert'>Please enter passport expiry date</label>").insertAfter(psprtnoexpdateid);	
						
						j(psprtnoexpdateid).focus();
						
						return false;
						
					}
				
				
				
				
					// visa details
					
					//fileComplogo1 txtVisa1 txtCountry1 txtIssuedAt1  txtTypeofvisa1  txtNoofEntries1 txtDateofIssue1 txtDateofExpiry1
					
					
					var visadocumentid 			= "#fileComplogo"+nooffieldsarry[i];
							
					var visanoid				= "#txtVisa"+nooffieldsarry[i];
					
					var visacntryid				= "#txtCountry"+nooffieldsarry[i];
					
					var visaissdid				= "#txtIssuedAt"+nooffieldsarry[i];
					
					var visatypeid 				= "#txtTypeofvisa"+nooffieldsarry[i];
							
					var visanoofentriesid		= "#txtNoofEntries"+nooffieldsarry[i];
					
					var visadateofissueid		= "#txtDateofIssue"+nooffieldsarry[i];
					
					var visadateofexpiryid		= "#txtDateofExpiry"+nooffieldsarry[i];
					
					
																										 
					
					
					var visadocument 		= j.trim(j(visadocumentid).val());
					
					var visano 				= j.trim(j(visanoid).val());
					
					var visacntry 			= j.trim(j(visacntryid).val());
					
					var visaissd 			= j.trim(j(visaissdid).val());
					
					var visatype 			= j.trim(j(visatypeid).val());
					
					var visanoofentries 	= j.trim(j(visanoofentriesid).val());
					
					var visadateofissue 	= j.trim(j(visadateofissueid).val());
					
					var visadateofexpiry 	= j.trim(j(visadateofexpiryid).val());
					
					
															
					
									
					if(visadocument == "" && !checkDisabled(visadocumentid)){
				
				
								
						
						j("<label class='text-danger customAlert'>Please upload visa document.</label>").insertAfter(visadocumentid);
						
						j(visadocumentid).focus();
						
						return false;
						
					}
					
				if(visano == "" && !checkDisabled(visanoid)){
				
				
						
						
						j("<label class='text-danger customAlert'>Please enter visa no.</label>").insertAfter(visanoid);	
						
						j(visanoid).focus();
						
						return false;
						
					}
				if(visacntry == "" && !checkDisabled(visacntryid)){
				
				
							
						
						j("<label class='text-danger customAlert'>Please enter visa country.</label>").insertAfter(visacntryid);
						
						j(visacntryid).focus();
						
						return false;
						
					}
					
										 
					
				if(visatype == "" && !checkDisabled(visatypeid)){
				
				
							
						
						j("<label class='text-danger customAlert'>Please enter visa type.</label>").insertAfter(visatypeid);
						
						j(visatypeid).focus();
						
						return false;
						
					}
				if(visanoofentries == "" && !checkDisabled(visanoofentriesid)){
				
				
						 
						
						j("<label class='text-danger customAlert'>Please enter visa no. of entries.</label>").insertAfter(visanoofentriesid);
						
						j(visanoofentriesid).focus();
						
						return false;
						
					}
				if(visadateofissue == "" && !checkDisabled(visadateofissue)){
				
				
						 
						
						j("<label class='text-danger customAlert'>Please enter visa issued date.</label>").insertAfter(visadateofissue);	
						
						j(visadateofissue).focus();
						
						return false;
						
					}
				if(visadateofexpiry == "" && !checkDisabled(visadateofexpiryid)){
				
						
						j("<label class='text-danger customAlert'>Please enter visa expiry date</label>").insertAfter(visadateofexpiryid);
						
						
						j(visadateofexpiryid).focus();
						
						return false;
						
					}
						
				
				
				
					
				} // international if condition
				
			
			}
		
		
		}
	 
	
	//alert(1)
	
	for(w=0;w<rowmax;w++){

		//dates----------------
			
		
		if(flag==0){
			
			if(dates[w].value.trim()=="")
			{
				alert("Please enter date");
				dates[w].focus();
				flag=1;
				return false;
			}
			else if (isDate(dates[w].value.trim())==false)
			{
				
				dates[w].focus();
				flag=1;
				return false;
			}
			else
			{
				if(n==1){
				
					traveldate=dates[w].value.trim();
					
					retvalue=chkTrvDate(n,traveldate);
					
					 
					if(retvalue==2){				
						alert("Please choose a date greater than / equal to current date");
						flag=1;
						dates[w].focus();
						return false;
					}
				
				
				}		
				
			}
		}
		
	
		
		//expense desc---------------------
		
		if(flag==0){
			if(expdesc[w].value.trim()=="")
			{
				alert("Please enter expense description");
				expdesc[w].focus();
				flag=1;
				return false;
			}
		}  
		
		//expense category-------------
		if(flag==0){
			if(expcat[w].value=="")
			{
				alert("Please enter expense category properly");
				expcat[w].focus();
				flag=1;
				return false;
			}
		}
		
		//mode----------------------
		if(flag==0){
			if(mode[w].value=="")
			{
				alert("Please enter expense category properly");
				mode[w].focus();
				flag=1;
				return false;
			}
		}
		
		//from-----------------
		if(flag==0){
			if(from[w].value.trim()=="")
			{
				alert("Please enter place properly");
				from[w].focus();
				flag=1;
				return false;
			}
		}
		
		//stay duration--------------
		if(flag==0){
			if(selStayDur[w].value.trim()=="")
			{
				alert("Please enter stay durations.");
				selStayDur[w].focus();
				flag=1;
				return false;
			}
		}
		
		
		//to--------------------
		if(flag==0){
			if(to[w].value.trim()=="")
			{
				alert("Please enter place properly");
				to[w].focus();
				flag=1;
				return false;
			}
		}
		
		//cost-------------------------
		
		if(flag==0){
			
			if(ecost[w].value.trim()=="" || ecost[w].value.trim()==0)
			{
				alert("Please enter Cost");
				ecost[w].focus();
				flag=1;
				return false;
			}
		
		
		}
		
		
		// total cost ----------------
		
		
		
		if(flag==0){
			
			if(txtTotalCost[w].value.trim()=="" || txtTotalCost[w].value.trim()==0)
			{
				alert("Please enter Total Cost");
				txtTotalCost[w].focus();
				flag=1;
				return false;
			}
		
		
		}
	

	
	
	} // end of for loop 
  	
	
	
	if(flag==0)
	return true;
	else 
	return false;
			 
}

function removeRowfrmTab()
{
	
		var tbl = document.getElementById('table1');
		var lastRow = tbl.rows.length;
		
		var dataRows=lastRow - 1;
		
		var spanField	=	"#field"+dataRows;
		
		var sessField	=	"#sessionid"+dataRows;
		
		var prefrdField	=	"#hiddenFlightSelected"+dataRows;
		
		var allPrefrd	=	"#hiddenAllPrefered"+dataRows;
		
		//alert(spanField)
		
		j(spanField).remove();
		
		j(sessField).remove();
		
		j(prefrdField).remove();
		
		j(allPrefrd).remove();
		
		
		document.getElementById('hidrowno').value=dataRows - 1;
		
			
		if (lastRow > 2) 
		tbl.deleteRow(dataRows);
		
		
		if(lastRow==3){
			document.getElementById('removebuttoncontainer').innerHTML="";
		}
		
		
		valGroupRequestCost();
	
}
 
j("#selEmployees").on("change", function(){
	
	
	var el = document.getElementsByTagName('select')[0];
  		
		//alert(getSelectValues(el));
		
		var returnVal=getSelectValues(el);
		
		//alert(returnVal.join(",   "));
		
		retrnValJn=returnVal.join(",   ");
		
		j("#txtaemployees").val("");
		
		j("#txtaemployees").val(retrnValJn);
		
		valGroupRequestCost();
		
		getGrpBookingTotal();		

});


function emptyQuote(iter){

	//alert(iter);

	j("#field"+iter).html(null);
	
	j("#sessionid"+iter).val(null);
	j("#hiddenPrefrdSelected"+iter).val(null);
	j("#hiddenAllPrefered"+iter).val(null);
	
	
	j("#txtCost"+iter).val(null);
	
	 j("#txtTotalCost"+iter).val(null);

}


j('.destroyQuotes').click(function(){
	
	var no_of_rows=j("#hidrowno").val();
	
	//alert(no_of_rows);
	
	
	for(i=1; i<=no_of_rows; i++){
		
		j("#field"+i).html(null);
	
		j("#sessionid"+i).val(null);
		j("#hiddenPrefrdSelected"+i).val(null);
		j("#hiddenAllPrefered"+i).val(null);
		
		
		j("#txtCost"+i).val(null);
		
		 j("#txtTotalCost"+i).val(null);
	
	}
	
	j("#totaltable").html(null);
	

});

</script>