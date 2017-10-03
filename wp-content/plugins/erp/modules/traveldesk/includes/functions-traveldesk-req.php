<?php
ob_start();
?>
<script>
    function valPreCost(costval,row)
    {
	//alert('ok');return false;
	var chks=document.getElementsByName('txtCost[]');
	
	for(var i=0;i<chks.length;i++)
	{
		var costcont=chks[i].value.trim();
		
		reg=/[^0-9]/;
		if(reg.test(costcont)){  
		
			chks[i].value="";
			alert("Only Numbers Allowed here");
			chks[i].focus();
			document.getElementById('show-exceed'+row).innerHTML='';
			return false;
			
		} else {
				
			//alert('fine');
						
			var selmode=document.getElementsByName('selModeofTransp[]');
			//console.log(selmode);
			var currntModVal=selmode[i].value;
			//console.log(currntModVal);
			currntModVal=parseInt(currntModVal);
		        if(currntModVal>15){
		        //alert("test"+currntModVal);
		        //var ModLimitVal=getSubGradeLimitAmount(currntModVal);
		        
		        wp.ajax.send( 'get-sub-grades', {
                            data: {
                                mode : currntModVal,
                            },
                            success: function(resp) {
	                                console.log(resp);
	                      		var ModLimitVal_0=parseInt(resp.Limit_Amount);
					var ModLimitVal_3=parseInt(resp.Tolerance);
					
					wp.ajax.send( 'get-mode-name', {
	                                data: {
	                                mode : currntModVal,
	                                },
	                                success: function(resp) {
					var ModLimitVal_1=resp.MOD_Name;
					var gradePercentage = (ModLimitVal_3 / 100) * ModLimitVal_0;			
				if(ModLimitVal_0!=0){
					
					var hotel=0;
					
					if(currntModVal==5 || currntModVal==6){
						
						var stayDur		=	document.getElementsByName('selStayDur[]');
						
						var stayDurNos          =	parseInt(stayDur[i].value);
	
						hotel=1;
						
						if(hotel)
						costcont		=	parseInt(chks[i].value)*stayDurNos;
						else
						costcont		=	parseInt(chks[i].value)/stayDurNos;
					
					}
					//console.log(chks[i].value);
					//console.log(costcont +'>'+ModLimitVal_0);
					percentcal = ModLimitVal_0 + gradePercentage;
					//console.log(costcont +'>'+percentcal);
					if(costcont > percentcal){
						
						if(hotel){
						document.getElementById('show-exceed'+row).innerHTML="Your "+ModLimitVal_1+" expense limit is upto "+ModLimitVal_0+" on per day basis.";
						document.getElementById("expenseLimit").value = "1";
						//alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis.");
						}
						else{
	                                        document.getElementById('show-exceed'+row).innerHTML="Your "+ModLimitVal_1+" expense limit is upto "+ModLimitVal_0;
	                                        document.getElementById("expenseLimit").value = "1";
	                                        var myclass = document.getElementById("grade-limit").classList;
	                                         if (myclass.contains("closed")) {
	                                            myclass.remove("closed");
	                                         }
	
						//alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0);
	                                        }
						//$('#expenseLimit').val("1");
	                                        //chks[i].value="";
						getTotal(hotel,stayDurNos);
						//$("#field"+(i+1)).html(null);
						//chks[i].focus();
						return false;
				
					}else{
						//alert('ok');
	                                        document.getElementById('show-exceed'+row).innerHTML='';
	                                        document.getElementById("expenseLimit").value = "0";
						getTotal(hotel,stayDurNos);
					}
				
				} else {
					getTotal(hotel,stayDurNos);
				}
				},
				 error: function(error) {
                                	console.log( error );
                            	 }
                            	 });
                            },
                            error: function(error) {
                                console.log( error );
                            }
                        });
		        
		        
		        
		        }
		        else{
				var ModLimitVal=getGradeLimitAmount(currntModVal);
				var ModLimitVal_0=parseInt(ModLimitVal[0]);
				var ModLimitVal_3=parseInt(ModLimitVal[2]);
				var ModLimitVal_1=ModLimitVal[1];
				
				//console.log(ModLimitVal);
				
				//alert(ModLimitVal_0);
				var gradePercentage = (ModLimitVal_3 / 100) * ModLimitVal_0;			
				if(ModLimitVal_0!=0){
					
					var hotel=0;
					
					if(currntModVal==5 || currntModVal==6){
						
						var stayDur		=	document.getElementsByName('selStayDur[]');
						
						var stayDurNos          =	parseInt(stayDur[i].value);
	
						hotel=1;
						
						if(hotel)
						costcont		=	parseInt(chks[i].value)*stayDurNos;
						else
						costcont		=	parseInt(chks[i].value)/stayDurNos;
					
					}
					//console.log(chks[i].value);
					//console.log(costcont +'>'+ModLimitVal_0);
					percentcal = ModLimitVal_0 + gradePercentage;
					//console.log(costcont +'>'+percentcal);
					if(costcont > percentcal){
						
						if(hotel)
						document.getElementById('show-exceed'+row).innerHTML="Your "+ModLimitVal_1+" expense limit is upto "+ModLimitVal_0+" on per day basis.";
						//alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis.");
						else{
	                                        document.getElementById('show-exceed'+row).innerHTML="Your "+ModLimitVal_1+" expense limit is upto "+ModLimitVal_0;
	                                        document.getElementById("expenseLimit").value = "1";
	                                        var myclass = document.getElementById("grade-limit").classList;
	                                         if (myclass.contains("closed")) {
	                                            myclass.remove("closed");
	                                         }
	
						//alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0);
	                                        }
						//$('#expenseLimit').val("1");
	                                        //chks[i].value="";
						getTotal(hotel,stayDurNos);
						//$("#field"+(i+1)).html(null);
						//chks[i].focus();
						//return false;
				
					}else{
						//alert('ok');
	                                        document.getElementById('show-exceed'+row).innerHTML='';
	                                        document.getElementById("expenseLimit").value = "0";
						getTotal(hotel,stayDurNos);
					}
				
				} else {
					getTotal(hotel,stayDurNos);
				}
			}	
			
		}
	}
	
	
}

function valCostPre(costval,row,mode)
    {
    	var $ = jQuery.noConflict();
	
		costcont = costval;
		reg=/[^0-9]/;
		if(reg.test(costval)){  
		
			costval.value="";
			alert("Only Numbers Allowed here");
			$('txtCost'+row).focus();
			return false;
			
		} else {
			
			var currntModVal=mode
			currntModVal=parseInt(currntModVal);
			
				var ModLimitVal=getGradeLimitAmount(currntModVal);
				var ModLimitVal_0=parseInt(ModLimitVal[0]);
				var ModLimitVal_3=parseInt(ModLimitVal[2]);
				var ModLimitVal_1=ModLimitVal[1];
				
				
				var gradePercentage = (ModLimitVal_3 / 100) * ModLimitVal_0;			
				if(ModLimitVal_0!=0){
					stayDurNos = 1;
					var hotel=0;
					
					if(currntModVal==5 || currntModVal==6){
						
						var stayDur		=	document.getElementById('stay2');
						
						var stayDurNos          =	parseInt(stayDur.value);
	
						hotel=1;
				
						//if(hotel)
						//costcont		=	parseInt(costcont)*stayDurNos;
						//else
						//costcont		=	parseInt(costcont)/stayDurNos;
					
					}
					//console.log(chks[i].value);
					//console.log(costcont +'>'+ModLimitVal_0);
					percentcal = ModLimitVal_0 + gradePercentage;
					if(hotel)
					percentcal = percentcal*stayDurNos;
					//console.log(costcont +'>'+percentcal);
					if(costcont > percentcal){
						
						if(hotel){
						//document.getElementById('show-exceed'+row).innerHTML="Your "+ModLimitVal_1+" expense limit is upto "+ModLimitVal_0+" on per day basis.";
						//alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis.");
						$('.exceed'+row).attr('title', "Your "+ModLimitVal[1]+" expense limit is "+ModLimitVal_0+" on per day basis.");
						$('.exceed'+row).addClass('ired');
						$('.exceed'+row).tooltip('show');
						}
						else{
	                                        //document.getElementById('show-exceed'+row).innerHTML="Your "+ModLimitVal_1+" expense limit is upto "+ModLimitVal_0;                  
	                                        $('.exceed'+row).attr('title', "Your "+ModLimitVal_1+" expense limit is "+ModLimitVal_0 );
	                                        $('.exceed'+row).addClass('ired');
	                                        $('.exceed'+row).tooltip('show');         	
	                                        document.getElementById("expenseLimit").value = "1";
	                                        var myclass = document.getElementById("grade-limit").classList;
	                                         if (myclass.contains("closed")) {
	                                            myclass.remove("closed");
	                                         }

	                                        }
			
	                                        
						getTotal(hotel,stayDurNos);
				
					}else{
						//alert('ok');
						$('.exceed'+row).attr('title', "");
						$('.exceed'+row).attr('data-original-title', "");
						$('.exceed'+row).removeClass('ired');
						$('.exceed'+row).tooltip('hide');
	                                        //document.getElementById('show-exceed'+row).innerHTML='';
	                                        document.getElementById("expenseLimit").value = "0";
						getTotal(hotel,stayDurNos);
					}
				
				} else {
					getTotal(hotel,stayDurNos);
				}
			
			
		}
		row = row+1;
	
}

function getGradeLimitAmount(mode)
{
	var ModLimitVal;
	var _mode;
	switch (mode)
	{
		<?php 
		global $wpdb;
                //$mydetails = myDetails(empId);
                
                 $compid = $_SESSION['compid'];
                 if(isset($_REQUEST['selEmployees'])){
                 $empid = $_REQUEST['selEmployees'];
                 }else{
                     $reqid = $_REQUEST['reqid'];
                     $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Claim IS NULL and req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active != 9 AND REQ_Type=3 AND RE_Status=1");
                     $empid = $row->EMP_Id;
                 }
                 
                $mydetails=$wpdb->get_row("SELECT * FROM employees WHERE EMP_Id='$empid' AND COM_Id='$compid' AND EMP_Status=1");
                $selgrdLim=$wpdb->get_row("SELECT * FROM grade_limits WHERE EG_Id='$mydetails->EG_Id' AND GL_Status=1");
                if($selgrdLim){
                $selgrdLim = json_decode(json_encode($selgrdLim), True);
                $selgrdLim = array_values($selgrdLim);
                $selall = $wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE COM_Id = 0 and MOD_Status=1 ORDER BY MOD_Id ASC");
		$i=0;
		foreach($selall as $row):
		
			 $k=$i+4;
			 $s=$i+26;
		?>
		case <?php echo $row->MOD_Id ?>:
		_mode='<?php echo $row->MOD_Name ?>';
		ModLimitVal='<?php echo $selgrdLim[$k]; ?>';
		ModPercentage='<?php echo $selgrdLim[$s]; ?>';
		break;
		<?php $i++; endforeach; ?>
		<?php } ?>
		default:
		_mode='0';
		ModLimitVal="0";
		ModPercentage="0";
	}
		
		return [ModLimitVal , _mode, ModPercentage];
}

function getTotal(hotel,currntDur)
{
	var chks=document.getElementsByName('txtCost[]');
	//alert(chks);
	var totalcost=0;
	
	for(var i=0;i<chks.length;i++)
	{		
		costotint=parseInt(chks[i].value.trim());		
		//costotint=costotint*currntDur;
		if(costotint){
		totalcost+=costotint;
		}
		
	}
	
	totalcost=indianRupeeFormat(totalcost);

	//alert(totalcost);
	
	if(totalcost!=0 && totalcost!=""){
		if(hotel){
		//totalcost = totalcost.split(',').join('');
		//totalcost = totalcost*currntDur;
		}
		//document.getElementById('totaltable').innerHTML='<table class="wp-list-table widefat striped admins" style="font-weight:bold;"><tr ><td align="right" width="85%">Total Amount</td><td align="center" width="5%">:</td><td align="right" width="10%">'+totalcost+'.00</td></tr></table>';
		document.getElementById('totaltable').value = totalcost;
		
	} else {
		
		document.getElementById('totaltable').value='';
                //document.getElementById('show-exceed').innerHTML='';
		
	}	
		
}

function indianRupeeFormat(x){
	
	x=x.toString();
	var lastThree = x.substring(x.length-3);
	var otherNumbers = x.substring(0,x.length-3);
	if(otherNumbers != '')
		lastThree = ',' + lastThree;
	var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
	
	//res=parseInt(res);
	
	return res;

}

function mileageAmount(val, iteration){
	
	var j = jQuery.noConflict();
	var modeval	=	j("#selModeofTransp"+iteration).val();
	
	if(val=="")
	j("#txtCost"+iteration).val(null);
	
	if(modeval==""){
		
		j("#txtdist"+iteration).val(null);
		j("#txtCost"+iteration).val(null);
		alert("Please select expense category first.");
		return false;
		
	} else if(modeval && val) {
		
		result=null;
		
		switch(modeval){
			
			case '31':
			result=j("#hiddenTwowheeler").val();
			break;
			
			case '32':
			result=j("#hiddenFourwheeler").val();
			break;
			
		}
				
		var mileamount=parseFloat(result) * val;
			
		//alert(mileamount);
		
		mileamount	=	parseInt(parseFloat(mileamount));
		
		j("#txtCost"+iteration).val(mileamount);
	
	}
	
}
// mileage calculation


function getAmount(val, iteration){
	var j = jQuery.noConflict();
	if(val){
	
		var distnce=j("#txtdist"+iteration).val();
		
		if(distnce){
		
			//var Url="getMileage.php?modeid="+val;
                        
                        wp.ajax.send( 'get-mileage', {
                            data: {
                                modeid : val,
                            },
                            success: function(resp) {
                                console.log(resp);
                                var mileamount=parseFloat(resp) * distnce;
                                
				mileamount	=	parseInt(parseFloat(mileamount));
				
				j("#txtCost"+iteration).val(mileamount);

                            },
                            error: function(error) {
                                console.log( error );
                            }
                        });
		}
		
	} else {
		
		j("#txtdist"+iteration).val(null);
		j("#txtCost"+iteration).val(null);
	}
	
}
function setFromTo(modeval, rownumber){
	var j = jQuery.noConflict();								
	
	var cityCont	=	"#city"+rownumber+"container";
	
	var from		=	"from"+rownumber;
	
	var to			=	"to"+rownumber;
	
	var costIt		=	"txtdist"+rownumber;
	
	var txtcost		=	"txtCost"+rownumber;
	
	//alert(cityCont)
	
		
	var htmlCont='<input type="text" class="form-control" name="txtCost[]" id="'+txtcost+'" onkeyup="valCost(this.value);" autocomplete="off" style="width:110px;"/><input  name="from[]" id="'+from+'" type="text" placeholder="From" class="form-control" style="width:130px; display:none;" value="n/a" ><input name="to[]" id="'+to+'" type="text" placeholder="To" class="form-control" style="width:130px; display:none;" value="n/a"><input type="text" class="form-control" name="txtdist[]" id="'+costIt+'" autocomplete="off" style="display:none;" value="n/a"/><select name="selStayDur[]" class="form-control" style="display:none;"><option value="n/a">Select</option></select>';


	//j(cityCont).html(htmlCont);
									
}
function valCost(costval)
{
		//alert();
        var j = jQuery.noConflict();        
	if(costval.length>=1){
		
		var chks=document.getElementsByName('txtCost[]');
		
		for(var i=0;i<chks.length;i++)
		{
			var costcont=chks[i].value.trim();
			
			reg=/[^0-9]/;
			if(reg.test(costcont)){              
			chks[i].value="";
				alert("Only Numbers Allowed here");
				chks[i].focus;
				return false;
			}               
			else
			{
				
						
				var selmode=document.getElementsByName('selModeofTransp[]');
				
				var currntModVal=selmode[i].value;
				
				currntModVal=parseInt(currntModVal);
				
				//alert(currntModVal);
				
				var ModLimitVal=getGradeLimitAmount(currntModVal);
				
				//alert(ModLimitVal);
				
				var ModLimitVal_0=parseInt(ModLimitVal[0]);
				
				//alert(ModLimitVal_0);			
				
				if(ModLimitVal_0!=0){
					
					var hotel=0;
					
					if(currntModVal==5 || currntModVal==6){
					
						var stayDur		=	document.getElementsByName('selStayDur[]');
						
						var stayDurNos	=	parseInt(stayDur[i].value);
					
						costcont		=	parseInt(costcont)/stayDurNos;
						
						hotel=1;
					
					}
					
					//alert(estCost +'>'+ ModLimitVal_0);
				
					if(costcont > ModLimitVal_0){
						
						if(hotel){
						
							var limitval="Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis";
						
						} else {
							
							var limitval="Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0;
							
						}
						j('#info').show();
                                                j('#p-info').html(limitval);
//						j("#sms").val(limitval);
//						
//						var nclick=j(this), data=nclick.data();
//						data.verticalEdge=data.vertical || 'right';
//						data.horizontalEdge=data.horizontal  || 'top';
//						j.notific8(j("#sms").val(), data);
						
						getTotal();
						//chks[i].value="";
						//chks[i].focus();
						return false;
				
					} else {
						//alert('ok');
                                                j('#info').hide();
						getTotal();
					}
				
				} else {
					getTotal();
				}
			}
		}
	
	} else {
	
		getTotal();
	 
	}
}
function getMotPreTravel(n,rownumber)
{
	//alert(n);
	<?php 
        global $wpdb;
        $compid =  $_SESSION['compid'];
        ?>
	var smotid		=	'selModeofTransp'+rownumber;
	var selfromIt           =	"from"+rownumber;
	var seltoIt		=	"to"+rownumber;
	var	stayDur		=	"selStayDur"+rownumber;	
	
	var costIt		=	"txtdist"+rownumber;
		
	if(n==1)
	{
                var row = document.getElementById('rowCount').value;
		content='<select name="selModeofTransp[]" style="width: 100px!important;" id="'+smotid+'" onchange="chkCost(this.value, '+rownumber+');enbDisGetQuote(this.value,'+rownumber+');emptyQuote('+rownumber+');setFromTo(this.value, '+rownumber+');" class="selModeofTransp" row="'+rownumber+'"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE EC_Id=1 AND COM_Id IN (0, '$compid') AND MOD_Status=1"); foreach($selsql as $rowsql){ ?><option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option><?php } ?></select>';

		
		citycontent='<input  name="from[]"  autocomplete="off" id="'+selfromIt+'" type="text" placeholder="From" class=""><input name="to[]" id="'+seltoIt+'" type="text" placeholder="To" class="form-control"  autocomplete="off"><select name="selStayDur[]" id="'+stayDur+'" class="form-control" style="display:none;"><option value="n/a">Select</option></select>';
		
		
	}
	else if(n==2)
	{
				
		content='<select name="selModeofTransp[]" style="width: 100px!important;" id="'+smotid+'"  onchange="chkCost(this.value, '+rownumber+');enbDisGetQuote(this.value,'+rownumber+');emptyQuote('+rownumber+');setFromTo(this.value, '+rownumber+');" class="selModeofTransp" row="'+rownumber+'"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE EC_Id=2 AND COM_Id IN (0, '$compid') AND MOD_Status=1"); foreach($selsql as $rowsql){ ?><option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option><?php } ?></select>';
		
		
		citycontent='<input autocomplete="off" name="from[]" id="'+selfromIt+'" type="text" placeholder="Location" class=""><input  name="to[]" id="'+seltoIt+'" type="text" placeholder="To" class="form-control" value="n/a" style="display:none;"><select name="selStayDur[]" id="'+stayDur+'" class="form-control"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT SD_Id, SD_Name FROM stay_duration"); foreach($selsql as $rowsql){?><option value="<?php echo $rowsql->SD_Id;?>"><?php echo $rowsql->SD_Name;?></option><?php } ?></select>';
		
		
		
		//alert(citycontent);
		
	} else if(n==4){
	
		<?php if(!$etEdit){?>
		document.getElementById('getQuote'+rownumber).disabled=true;
		<?php } ?>
		
		content='<select name="selModeofTransp[]" style="width: 100px!important;" id="'+smotid+'" onchange="chkCost(this.value, '+rownumber+'); emptyQuote('+rownumber+');" class="selModeofTransp" style="width:110px;"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE EC_Id=4 AND COM_Id IN (0, '$compid') AND MOD_Status=1"); foreach($selsql as $rowsql){ ?><option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option><?php } ?></select>';
		
		
			
		citycontent='<input autocomplete="off" name="from[]" id="'+selfromIt+'" type="text" placeholder="Location" class=""><input  name="to[]" id="'+seltoIt+'" type="text" placeholder="To" class="form-control" value="n/a" style="display:none;"><select name="selStayDur[]" id="'+stayDur+'" class="form-control" style="display:none;"><option value="n/a">Select</option></select>';
	
	
	}
	
	
	
	
	if(n){
	
		modeoftranporid="modeoftr"+rownumber+"acontent";
		cityfromtoid="city"+rownumber+"container";
		
		//alert(modeoftranporid);
		
		document.getElementById(modeoftranporid).innerHTML=content;
		document.getElementById(cityfromtoid).innerHTML=citycontent;
	}
	
	var j = jQuery.noConflict();
	//j("#field"+rownumber).html(null);
	
	//j("#sessionid"+rownumber).val(null);
	//j("#hiddenPrefrdSelected"+rownumber).val(null);
	//j("#hiddenAllPrefered"+rownumber).val(null);
	  
	//j("#txtCost"+rownumber).val(null);
	  
	
}
function getMotPosttravel(n,rownumber)
{
	
	//alert(n+","+rownumber);
	
	var selfromIt	="from"+rownumber;
	var seltoIt		="to"+rownumber;		
	var	stayDur		="selStayDur"+rownumber;
	var costIt		="txtdist"+rownumber;
	
	if(n==1)
	{		
		content='<select name="selModeofTransp[]" style="width: 100px!important;"  class="selModeofTransp" id="selModeofTransp'+rownumber+'" onchange="setFromTo(this.value, '+rownumber+');"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE EC_Id=1 AND COM_Id IN (0, '$compid') AND MOD_Status=1"); foreach($selsql as $rowsql){ ?><option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option><?php } ?></select>';
		
		
		
		citycontent='<input  name="from[]" id="'+selfromIt+'" type="text" placeholder="From" autocomplete="off"><input  name="to[]" id="'+seltoIt+'" type="text" placeholder="To" autocomplete="off"><select name="selStayDur[]" id="'+stayDur+'" style="display:none;"><option value="n/a">Select</option></select>';		
		
	}
	else if(n==2)
	{
		
		
		content='<select name="selModeofTransp[]" style="width: 100px!important;" onchange="chkCostPost(this.value, '+rownumber+');"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE EC_Id=2 AND COM_Id IN (0, '$compid') AND MOD_Status=1"); foreach($selsql as $rowsql){ ?><option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option><?php } ?></select>';		
		
		citycontent='<input  name="from[]" id="'+selfromIt+'" type="text" placeholder="Location" autocomplete="off"><input  name="to[]" id="'+seltoIt+'" type="text" placeholder="To" value="n/a" style="display:none;"><select name="selStayDur[]" id="'+stayDur+'" onchange="chkNDPost(this.value, '+rownumber+');"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT SD_Id, SD_Name FROM stay_duration"); foreach($selsql as $rowsql){?><option value="<?php echo $rowsql->SD_Id;?>"><?php echo $rowsql->SD_Name;?></option><?php } ?></select>';
		
		
		
	}
	else if(n==4)
	{
		content='<select name="selModeofTransp[]" style="width: 100px!important;"><option value="">Select</option><?php $selsql=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE EC_Id=4 AND COM_Id IN (0, '$compid') AND MOD_Status=1"); foreach($selsql as $rowsql){ ?><option value="<?php echo $rowsql->MOD_Id; ?>"><?php echo $rowsql->MOD_Name; ?></option><?php } ?></select>';
		
		
		citycontent='<input  name="from[]" id="'+selfromIt+'" type="text" placeholder="Location" autocomplete="off"><input  name="to[]" id="'+seltoIt+'" type="text" style="display:none;" placeholder="To" value="n/a"><select name="selStayDur[]" id="'+stayDur+'" style="display:none;"><option value="n/a">Select</option></select>';	
	
	}
	
	if(n){
	
		modeoftranporid="modeoftr"+rownumber+"acontent"
		cityfromtoid="city"+rownumber+"container";
		
		//alert(cityfromtoid);
		
		document.getElementById(modeoftranporid).innerHTML=content;
		document.getElementById(cityfromtoid).innerHTML=citycontent;
		
	}
}
function chkCost(modeValue, rowno)
{
	
	//alert("Mode="+modeValue+" rows="+rowno);
	
	var rowno=rowno-1;
	
	var chks=document.getElementsByName('txtCost[]'); 
	
	if(chks[rowno].value){
	
	var currntModVal=parseInt(modeValue);
	
	var ModLimitVal=getGradeLimitAmount(currntModVal);
	
	var ModLimitVal_0=parseInt(ModLimitVal[0]);
	
	//alert(ModLimitVal_0);
	
	///alert(chks[rowno].value);
	
	if(ModLimitVal_0!=0){
	
		if(currntModVal==5 || currntModVal==6){
					
			var stayDur		=	document.getElementsByName('selStayDur[]');
			
			var stayDurNos	=	parseInt(stayDur[rowno].value);
		
			var estCost		=	parseInt(chks[rowno].value)/stayDurNos;
		
		}
	
		if(estCost	>	ModLimitVal_0){
			
			alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis.");
	
			chks[rowno].value="";
			chks[rowno].focus();
			return false;
		
		}
	
	}
		
	}
	
}
function enbDisGetQuote(modevals,i)
{
	//alert(modevals+'--'+i);
	var j = jQuery.noConflict();
	if(modevals==5){
	   j("#from"+i).addClass('hotel');
	   //j("#hotel"+i).html('<input name="txtStartDate[]" id="dateFrom'+i+'" class="" placeholder="Stay From" autocomplete="off"/><input name="txtEndDate[]" id="dateTo'+i+'" class="" placeholder="Stay To" autocomplete="off"/>');
	   
	   j( function() {
	    var dateFormat = "M dd, yy",
	      from = j( "#dateFrom"+i )
	        .datepicker({
	          defaultDate: "+1w",
	          dateFormat: 'M dd, yy',
	          changeMonth: true,
	          numberOfMonths: 2
	        })
	        .on( "change", function() {
	          to.datepicker( "option", "minDate", getDate( this ) );
	        }),
	      to = j( "#dateTo"+i ).datepicker({
	        defaultDate: "+1w",
	        dateFormat: 'M dd, yy',
	        changeMonth: true,
	        numberOfMonths: 2
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
	}
	else{
	   j("#from"+i).removeClass('hotel');
	   //j("#hotel"+i).html('<input  name="txtDate[]" id="txtDate'+i+'" class="pretraveldate" placeholder="dd/mm/yyyy" autocomplete="off"/><input name="txtStartDate[]" id="txtStartDate'+i+'" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" /><input name="txtEndDate[]" id="txtEndDate'+i+'" class="" placeholder="dd/mm/yyyy" autocomplete="off" style="width:105px; display:none;" value="n/a" />');
	   j('.pretraveldate').datepicker({
	            dateFormat: "dd-mm-yy",
	            minDate: 0,
	   });
	}
	
	if(modevals==1 || modevals==2 || modevals==5){
	
		document.getElementById('getQuote'+i).disabled=false;
	
	}else{
	
		document.getElementById('getQuote'+i).disabled=true;
	}
	
	
}
function emptyQuote(iter){

	//alert(iter);
        var j = jQuery.noConflict();
	//j("#field"+iter).html(null);
	
	//j("#sessionid"+iter).val(null);
	//j("#hiddenPrefrdSelected"+iter).val(null);
	//j("#hiddenAllPrefered"+iter).val(null);
	
	
	j("#txtCost"+iter).val(null);

}
function checkDeletRow()
{
	if(confirm("Are you sure want to delete this request details"))
	{
		return true;
	}
	else
	{
		return false;
	}
	
}
function chkCostPost(modeValue, rowno)
{
	
	//alert("Mode="+modeValue+" rows="+rowno);
	
	var rowno=rowno-1;
	
	var chks=document.getElementsByName('txtCost[]'); 
	
	if(chks[rowno].value){
	
		var currntModVal=parseInt(modeValue);
		
		var ModLimitVal=getGradeLimitAmount(currntModVal);
		
		var ModLimitVal_0=parseInt(ModLimitVal[0]);
		
		//alert(ModLimitVal_0);
		
		///alert(chks[rowno].value);
		
		if(ModLimitVal_0!=0){
		
			if(currntModVal==5 || currntModVal==6){
						
				var stayDur		=	document.getElementsByName('selStayDur[]');
				
				var stayDurNos	=	parseInt(stayDur[rowno].value);
			
				var estCost		=	parseInt(chks[rowno].value)/stayDurNos;
			
			}
		
			if(estCost	>	ModLimitVal_0){
				
				
				var limitval="Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis";
						
				$("#sms").val(limitval);
				
				var nclick=$(this), data=nclick.data();
				data.verticalEdge=data.vertical || 'right';
				data.horizontalEdge=data.horizontal  || 'top';
				$.notific8($("#sms").val(), data)	;
				
				/*alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis.");
		
				chks[rowno].value="";
				chks[rowno].focus();*/
				return false;
			
			}
		
		}
		
	}
	
}
// on changing the stay duration check the grade limit amount

function chkNDPost(stayDurNos, rowno)
{
	
	//alert("Mode="+modeValue+" rows="+rowno);
	
	var rowno=rowno-1;
	
	var chks		=	document.getElementsByName('txtCost[]'); 
	
	var selexpcat	=	document.getElementsByName('selExpcat[]'); 
	
	var modeval		=	document.getElementsByName('selModeofTransp[]');
	
	if(chks[rowno].value){
	
		var currntModVal=parseInt(modeval[rowno].value.trim());
		
		//alert('Mode Val='+currntModVal);
		
		var ModLimitVal=getGradeLimitAmount(currntModVal);
		
		var ModLimitVal_0=parseInt(ModLimitVal[0]);
		
		//alert('mode limit 0th='+ModLimitVal_0);
		
		//alert('Cost='+chks[rowno].value);
		
		if(ModLimitVal_0!=0){
		
			if(currntModVal==5 || currntModVal==6)
			var estCost		=	parseInt(chks[rowno].value) / parseInt(stayDurNos);
			
			//alert('Estimated Cost='+estCost);
		
			if(estCost	>	ModLimitVal_0){
				
				var limitval="Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis";
						
				$("#sms").val(limitval);
				
				var nclick=$(this), data=nclick.data();
				data.verticalEdge=data.vertical || 'right';
				data.horizontalEdge=data.horizontal  || 'top';
				$.notific8($("#sms").val(), data)	;
				
				/*alert("Your "+ModLimitVal[1]+" expense limit is upto "+ModLimitVal_0+" on per day basis.");
		
				chks[rowno].value="";
				chks[rowno].focus();*/
				return false;
			
			}
		
		}
		
	}
	
}
function delFile(rfid,spanid){

//alert(rfid);
        var j = jQuery.noConflict();
	if(confirm("Are you sure want to delete this file"))
	{
		var filename=j('#filename').val();
		
		//alert(filename);
		
		//var Url="delRequestfiles.php";
		//Url=Url+"&rfid="+rfid;
		
                wp.ajax.send( 'delete-files', {
                    data: {
                        rfid : rfid,
                    },
                    success: function(msg) {
                        if(msg==1)
                         {
                                 j("#"+spanid).html("<font color='red'>file deleted</font>");
                                 j("#"+spanid).fadeOut(3000);
                         }else{
                                 alert("file could not be deleted. please contact your admin.");
                         }
                       
                    },
                    error: function(error) {
                        console.log( error );
                    }
                });
                
	}
	else
	{
		return false;
	}

}
function Validate(flname) {
	
	//alert(flname);
	
	var files = document.getElementById(flname).files;
	
	var flag=0;
       
        wp.ajax.send( 'get-file-extensions', {
            data: {},
            success: function(resp) {
                //console.log(resp);
                var _validFileExtensions = resp;
                for (var i = 0; i < files.length; i++)
                {		
		
		fileName=files[i].name;
		
		//alert(fileName);
		
		fileSplit=fileName.split(".");
				
		var blnValid = false;

		for (var j = 0; j < _validFileExtensions.length; j++) 
		{
						
			var sCurExtension = _validFileExtensions[j];
			
			filena="."+fileSplit[1].toLowerCase();
			
			
			if ( filena== sCurExtension.toLowerCase()) 
			{
				blnValid = true;
				sFileName=fileName;
				break;
			}
			else
			{
				sFileName=fileName;
			}
			
	
		}
			
			if (blnValid==false) {
				alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
				flag=1;
				document.getElementById(flname).value="";
				document.getElementById(flname).focus();
				return flag;
				break;
			}
		
		
	
                }

                return flag;
            },
            error: function(error) {
                console.log( error );
            }
        });
}
</script>


