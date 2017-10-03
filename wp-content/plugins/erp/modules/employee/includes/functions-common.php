<?php
/**
 * [erp_hr_employee_single_tab_permission description]
 *
 * @return void
 */
//EMPLOYEE DETAILS
function ihvdelegated($n){

        $empuserid = $_SESSION['empuserid'];
	$curdate=date('Y-m-d');
        global $wpdb;
        
	if($n==1){
            
		$seldeleg=$wpdb->get_results("SELECT * FROM delegate WHERE DLG_FromEmpid='$empuserid' AND DLG_ToDate > '$curdate' AND DLG_Status=1 AND DLG_Active=1");
		
	} else if($n==2) {
			
		$seldeleg=$wpdb->get_results("SELECT * FROM delegate delg, employees emp WHERE delg.DLG_ToEmpid='$empuserid' AND delg.DLG_FromEmpid = emp.EMP_Id AND DLG_ToDate > '$curdate' AND DLG_Status=1 AND DLG_Active=1");
	}
	return $seldeleg;
	
}
//EMPLOYEE DETAILS

function isApprover()
{
    
    global $wpdb;
    $empuserid = $_SESSION['empuserid'];
    $compid = $_SESSION['compid'];
	
	$mydetails	= myDetails();
        //print_r( $mydetails);die;
        $rcode=$mydetails->EMP_Code;
       // print_r($rcode);die;
	$selrow=$wpdb->get_row("SELECT * FROM employees WHERE EMP_Reprtnmngrcode='$rcode' OR EMP_Funcrepmngrcode='$rcode' AND EMP_Status=1");
        //print_r( $selrow);die;
	return $selrow;

}

function myDetails($empid=NULL)
{
    global $wpdb;
    if(isset($_SESSION['empuserid']))
    $empuserid = $_SESSION['empuserid'];
    //echo $empuserid;die;
    $compid = $_SESSION['compid'];
	
	if(!$empid)
	$empid=$empuserid;
	
	$mydetails=$wpdb->get_row("SELECT * FROM employees WHERE EMP_Id='$empid' AND COM_Id='$compid' AND EMP_Status=1");
	
	return $mydetails;
}

//INDIAN MONEY FORMAT

function IND_money_format($money){
    $len = strlen($money);
    $m = '';
    $money = strrev($money);
    for($i=0;$i<$len;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
            $m .=',';
        }
        $m .=$money[$i];
    }
    return strrev($m);
}

function gradeLimits($empuserid){
    
        global $wpdb;
        $mydetails = myDetails($empuserid);
        if($selgrdLim=$wpdb->get_row("SELECT * FROM grade_limits WHERE EG_Id='$mydetails->EG_Id' AND GL_Status=1")){
			$selgrdLim = json_decode(json_encode($selgrdLim), True);
			//print_r($selgrdLim);
			$selgrdLim=array_values($selgrdLim);
			//print_r($selgrdLim);

		
			echo '<table id="expenseLimitId" class="wp-list-table widefat fixed striped admins">';
			echo '<tr>';


				//echo '<h4>Expense limits:</h4>';

				 
				$i=0;

				$selmod=$wpdb->get_results("SELECT MOD_Name FROM mode WHERE COM_Id = 0");

				$i = $gradelimitm = $totalLimitAmnt = 0;

				foreach($selmod as $rowmod){

						$k=$i+4;

						if($selgrdLim[$k]){

			
				  echo '<td>';
					  echo $rowmod->MOD_Name . "Expense Limit - <span class='oval-1'>";
					  echo $selgrdLim[$k] ? IND_money_format($selgrdLim[$k]).".00" : "No Limit</span>";
					 
							$gradelimitm++;
							$totalLimitAmnt += $selgrdLim[$k]; 

						}	

						if($gradelimitm%4==0)
						echo '<tr>';

						$i++; 	
				} 
					
						echo '</td>';
						echo '</table>';
				
				if($totalLimitAmnt < 1) echo '<script>document.getElementById("expenseLimitId").style.display = "none";</script>';
		}
        
}
function tdclaimapprovals($string){
	global $getapprov; 
switch($string)
{
	
	case 1:
	$getapprov='<span class="status-1">Pending</span>';
	break;
	
	case 2:
	$getapprov='<span class="status-2">Approved</span>';
	break;
	
	case 3:
	$getapprov='<span class="status-4">Rejected</span>';
	break;
	
	case 4:
	$getapprov='<span class="status-3">&nbsp;&nbsp;&nbsp;N/A&nbsp;&nbsp;&nbsp;</span>';
	break;

}

return $getapprov;
}

function approvals($string){
	global $getapprov;
	switch($string)
	{
		case 1:
		$getapprov='<span class="status-1">Pending</span>';
		break;

		case 2:
		$getapprov='<span class="status-2">Approved</span>';
		break;
		
		case 5:
		$getapprov='<span class="status-3">&nbsp;&nbsp;&nbsp;N/A&nbsp;&nbsp;&nbsp;</span>';
		break;
			
		case 4:
		$getapprov='<span class="status-4">Rejected</span>';
		break;
			
		case 9:
		$getapprov='<span class="status-4">Rejected</span>';
		break;
	}

	return $getapprov;


}

/*//////////////////////////////////////////////////
               BOOKING STATUS        
///////////////////////////////////////////////////*/

function bookingStatus($status){

switch($status)
{
	case 1:
	$getapprov='<span class="status-1">Pending</span>';
	break;
	
	case 2:
	$getapprov='<span class="status-2">Booked</span>';
	break;
	
	case 3:
	$getapprov='<span class="status-4">Failed</span>';
	break;
	
	case 4:
	$getapprov='<span class="label label-info">Employee Request Cancelled <br>(Cancellation charges applicable)</span>';
	break;
	
	case 5:
	$getapprov='<span class="label label-info">Employee Request Cancelled <br>(No cancellation charges)</span>';
	break;
	
	case 6:
	$getapprov='<span class="label label-info">Travel Desk Cancelled <br>(Cancellation charges applicable)</span>';
	break;
	
	case 7:
	$getapprov='<span class="label label-info">Travel Desk Cancelled <br>(No Cancellation charges)</span>';
	break;
	
	case 8:
	$getapprov='<span class="status-2">Self Booking</span>';
	break;
	
	case 9:
	$getapprov='<span class="status-4">Cancelled</span>';
	break;
	
	
	default:
	$getapprov='<span class="status-3">&nbsp;&nbsp;&nbsp;N/A&nbsp;&nbsp;&nbsp;</span>';
	
}

return $getapprov;


}

/*////////////////////////////////////
		 GENERATE REQUEST IDS 
///////////////////////////////////*/

function genExpreqcode($n, $f=false){
        global $wpdb;
	$compid = $_SESSION['compid'];
	
	switch ($n){
		
		case 1:
		$tnetype="PRE";
		break;
		
		case 2:
		$tnetype="POS";
		break;
		
		case 3:
		$tnetype="GEN";
		break;
		
		case 4:
		$tnetype="TRA";
		break;
		
		case 5:
		$tnetype="MIL";
		break;
		
		case 6:
		$tnetype="UTL";
		break;		
	
	}
	
	if($f)
	$tnetype="F".$tnetype;
	

	$m=date('m');
	$y=date('y');
	
	$code=$wpdb->get_row("SELECT * FROM code");
	
	
	if($tnetype)	
	$requestcode=$tnetype.$compid.$m.$y.$code->code;
	else
	$requestcode=$compid.$m.$y.$code->code;
	$wpdb->query("UPDATE code SET code=$code->code+1");
	return $requestcode;

}

/////////////////////////////////////////////
//          Grade Limit amount 
/////////////////////////////////////////////

function getGradeLimit($modeid, $empuserid, $filename)
{
		global $wpdb;
        $empuserid = $_SESSION['empuserid'];
	if($selgrmlimit=$wpdb->get_row("SELECT gl.* FROM employees emp, grade_limits gl WHERE emp.EMP_Id='$empuserid' AND emp.EG_Id=gl.EG_Id AND gl.GL_Status=1 ORDER BY gl.GL_Id ASC"))
	{
		$selgrmlimit = json_decode(json_encode($selgrmlimit), True);
		$selgrdLim=array_values($selgrmlimit);
		if($modeid)
		{
                        
			$selall=$wpdb->get_results("SELECT MOD_Id, MOD_Name FROM mode WHERE COM_Id = 0 and MOD_Status=1 ORDER BY MOD_Id ASC");
			
			$k=4;
		
			foreach($selall as $row):

				if ($modeid==$row->MOD_Id){
					$mode=$row->MOD_Name;
					$ModLimitVal=$selgrdLim[$k] ? $selgrdLim[$k] : 0;
				}
				$k=$k+1;
			endforeach;
			
		}
		
	}
	   
	$returnval=$ModLimitVal."###".$mode;
		
		return $returnval;

}
function workflow(){
    global $wpdb;
    $compid = $_SESSION['compid'];
    $workflow = $wpdb->get_row("SELECT COM_Pretrv_POL_Id, COM_Posttrv_POL_Id, COM_Othertrv_POL_Id, COM_Mileage_POL_Id, COM_Utility_POL_Id FROM company WHERE COM_Id='$compid'");
    return $workflow;
}
function requestDetails($et){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $compid = $_SESSION['compid'];
    $row = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
    echo '<div class="container-fluid requestdetails">';
	echo '<div class="row fon12">';
	echo '<div class="col-md-5">';
    //echo '<div class="col-md-3 col-sm-12 col-xs-12">';
	echo '<div class="col-md-3 col-sm-6 col-xs-6">';
    echo 'Request ID ' ;
    echo '</div>';
	echo '<div class="col-md-3 col-sm-6	 col-xs-6">';
    echo ': <span class="blue_text">'.$row->REQ_Code. '</span>' ;
    echo '</div>';
    //echo '</div>';
	//echo '<div class="col-md-3 col-sm-12 col-xs-12">';
	echo '<div class="col-md-3 col-sm-6 col-xs-6">';
	echo 'Request Date ';
    echo '</div>';
	echo '<div class="col-md-3 col-sm-6 col-xs-6">';
	echo ': <span class="blue_text">'.date("d-M-y",strtotime($row->REQ_Date)).'</span>';
    echo '</div>';
    echo '</div>';
	echo '<div class="col-md-7">';
    //echo '<div class="col-md-2 col-sm-12 col-xs-12" style="text-align:right">';
    //echo 'Approval Status - ';
    //echo '</div>';
    //echo '<table class="table">';
    //echo '<tr>';
    //echo '<td width="20%">Request Id</td>';
    //echo '<td width="5%">:</td>';
    //echo '<td width="25%">'.$row->REQ_Code.'</td>';
   
    $repmngr_block='<div class="col-md-1 col-sm-6 col-xs-6">Manager </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';				
					
					
    $fin_block='<div class="col-md-1 col-sm-6 col-xs-6 ">Finance </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';			

    $second_level_block='<div class="col-md-3 col-sm-6 col-xs-6">Skip Level Manager </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';	

    $null_block='<td width="20%">&nbsp;</td>
                        <td width="5%">&nbsp;</td>
                        <td width="25%">&nbsp;</td>';


    if($row->REQ_Type==2 || $row->REQ_Type==4){

            echo $null_block;

    }
    else {

            $secMngrRow=0;
                                
            if($selsecStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=5 AND RS_Status=1"))
            {
                    $secMngrRow=1;

                    $approvals=approvals($selsecStatus->REQ_Status);

                    $second_level_block .=$approvals;

                    $rsdate=" on ".date('d-M, y',strtotime($selsecStatus->RS_Date));

                    $second_level_block.=$rsdate;
            }
            else
            {
                    $approvals=approvals(1);

                    $second_level_block.=$approvals;
            }


            //$second_level_block.='</div>';

            $repMngrRow=0;
                                
            if($selMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=1 AND RS_Status=1"))
            {

                    $repMngrRow=1;

                    $approvals=approvals($selMngrStatus->REQ_Status);

                    $repmngr_block.=$approvals;

                    $rsdate=" on ".date('d-M, y',strtotime($selMngrStatus->RS_Date));

                    $repmngr_block.=$rsdate;
            }
            else
            {
                    $approvals=approvals(1);

                    $repmngr_block.=$approvals;
            }


            //$repmngr_block.='</div>';


    //echo 'RepManagerrow='.$repMngrRow;



            $finRow=0;
                            
            if($selFinance=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=2  AND RS_Status=1"))
            {
                    $finRow=1;

                    $approvals=approvals($selFinance->REQ_Status);

                    $fin_block.=$approvals;

                    $rsdate=" on ".date('d-M, y',strtotime($selFinance->RS_Date));

                    $fin_block.=$rsdate;

            }
            else
            {
                    $approvals=approvals(1);

                    $fin_block.=$approvals;
            }


            //$fin_block.='</div>';



            $workflow = workflow();
            switch ($et)
            {
                    case 1:
                    $expPol=$workflow->COM_Pretrv_POL_Id;
                    break;

                    case 2:
                    $expPol=$workflow->COM_Posttrv_POL_Id;
                    break;

                    case 3:
                    $expPol=$workflow->COM_Othertrv_POL_Id;
                    break;

                    case 5:
                    $expPol=$workflow->COM_Mileage_POL_Id;
                    break;

                    case 6:
                    $expPol=$workflow->COM_Utility_POL_Id;
                    break;
            }


            $polId = "";
            if($row->POL_Id == 5)
            $pol = $expPol;
            else
            $pol = $row->POL_Id;

            switch ($pol){

                    // e --> r --> f  //e --> r 
                    case 1 : case 3:
                    if($row->POL_Id==5 || $row->POL_Id==6){
                    echo $second_level_block;
                    $polId = $row->POL_Id;
                    }
                    else{
                    echo $repmngr_block;
                    }
                    break;
                    //e --> f
                    case 2:
                    echo $fin_block;
                    break;
                    // e--> f --> r    
                    case 4:
                    if($row->POL_Id==5){
                    echo $second_level_block;
                    $polId = $row->POL_Id;
                    }
                    else{
                    echo $fin_block;
                    break;
                    }

            }


    }
    
    
 // echo '</tr>';
  /*------SECOND ROW ------*/
  //echo '<tr>';
     //echo  '<td width="20%">Request Date</td>';
     //echo '<td width="5%">:</td>';
     //echo '<td width="25%">'.date("d-M-y (h:i a)",strtotime($row->REQ_Date)).'</td>';
     
    $repmngr_block='</div><div class="col-md-1 col-sm-6 col-xs-6">Manager </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';
		
    $fin_block='</div><div class="col-md-1 col-sm-6 col-xs-6">Finance </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';

    $fin_block_second='</div><div class="col-md-1 col-sm-6 col-xs-6">Finance </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';

    $second_level_block_second='</div><div class="col-md-3 col-sm-6 col-xs-6">Skip Level Manager </div><div class="col-md-3 col-sm-6 col-xs-6"> : ';


    if($row->REQ_Type==2 || $row->REQ_Type==4){

            echo $null_block;

    } else {

            if($finRow && $selFinance->REQ_Status==2)
            {

                    if($repMngrRow)
                    {

                            $approvals=approvals($selMngrStatus->REQ_Status);

                            $repmngr_block.=$approvals;


                            $rsdate=" on ".date('d-M, y',strtotime($selMngrStatus->RS_Date));

                            $repmngr_block.=$rsdate;

                    }
                    else
                    {


                            $approvals=approvals(1);

                            $repmngr_block.=$approvals;
                    }
            }
            else
            {
                    if($row->POL_Id == 5)
	            $pol = $expPol;
	            else
	            $pol = $row->POL_Id;
	
	            switch ($pol){
                        case 2:
                            $approvals=approvals(1);
                    }
                    //$approvals=approvals(5);

                    $repmngr_block.=$approvals;
            }


            $repmngr_block.='</div>';
                            
            $secMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=5 AND RS_Status=1");
            if($finRow && $selFinance->REQ_Status==2)
            {

                    if($secMngrRow)
                    {

                            $approvals=approvals($secMngrStatus->REQ_Status);

                            $second_level_block_second.=$approvals;


                            $rsdate=" on ".date('d-M, y',strtotime($secMngrStatus->RS_Date));

                            $second_level_block_second.=$rsdate;

                    }
                    else
                    {


                            $approvals=approvals(1);

                            $second_level_block_second.=$approvals;
                    }
            }
            else
            {
                    if($row->POL_Id == 5)
	            $pol = $expPol;
	            else
	            $pol = $row->POL_Id;
	
	            switch ($pol){
                        case 2:
                            $approvals=approvals(1);
                    }
                    //$approvals=approvals(5);

                    $second_level_block_second.=$approvals;
            }


            //$second_level_block_second.='</div>';			

            if($repMngrRow && $selMngrStatus->REQ_Status==2)
            {
                    if($finRow)
                    {
                            $approvals=approvals($selFinance->REQ_Status);

                            $fin_block.=$approvals;

                            $rsdate=" on ".date('d-M, y',strtotime($selFinance->RS_Date));

                            $fin_block.=$rsdate;

                    }
                    else
                    {
                            $approvals=approvals(1);

                            $fin_block.=$approvals;
                    }
            }
            else
            {
                    if($row->POL_Id == 5)
	            $pol = $expPol;
	            else
	            $pol = $row->POL_Id;
	
	            switch ($pol){
                        case 1:
                            $approvals=approvals(1);
                    }
                    //$approvals=approvals(5);

                    $fin_block.=$approvals;
            }

            $fin_block.='</div>';

                            
            $secMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=5 AND RS_Status=1");

            if($secMngrRow && $secMngrStatus->REQ_Status==2)
            {
                    if($finRow)
                    {
                            $approvals=approvals($selFinance->REQ_Status);

                            $fin_block_second.=$approvals;

                            $rsdate=" on ".date('d-M, y',strtotime($selFinance->RS_Date));

                            $fin_block_second.=$rsdate;

                    }
                    else
                    {
                            $approvals=approvals(1);

                            $fin_block_second.=$approvals;
                    }
            }
            else
            {
			if($row->POL_Id == 5)
		        $pol = $expPol;
		        else
		        $pol = $row->POL_Id;
		
		        switch ($pol){
                        case 1:
                            $approvals=approvals(1);
                    }
                    //$approvals=approvals(5);

                    $fin_block_second.=$approvals;
            }

            $fin_block_second.='</div>';

            if($row->POL_Id == 5)
            $pol = $expPol;
            else
            $pol = $row->POL_Id;

            switch ($pol){

                    // e --> r --> f
                    case 1:
                    if($row->POL_Id==5){
                    echo $fin_block_second;
                    }
                    else{
                    echo $fin_block;
                    }
                    break;

                    // e --> f --> r
                    case 2:
                    if($row->POL_Id==5){
                    echo $second_level_block_second;
                    $polId = $row->POL_Id;
                    }
                    else{
                    echo $repmngr_block;
                    }
                    break;

                    // e --> r   
                    case 3: 
                    echo $null_block;
                    break;

                    // e --> f
                    case 4:
                    if($row->POL_Id==5){
                    echo $fin_block_second;
                    }
                    else{
                    echo $null_block;
                    }
                    break;

            }

    }
     
  //echo '</tr>';
//echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
}
function Actions($et,$budget = NULL){
    $mydetails = myDetails();
    $emp_code=$mydetails->EMP_Code;
    global $empcodes;
    $empcodes.="".$emp_code."".","; 
    //deligate
    $approver='0';
    // checking approver(y/n)
    if($selrow=isApprover()){
       
    $delegate=0;

    if($cnt=ihvdelegated(1)){
            $delegate=1;
    }
    $_SESSION['delegate']=NULL;

    if($cnt=ihvdelegated(2)){

            if(!$_SESSION['delegate'])
            $_SESSION['delegate']=time();


            foreach($cnt as  $value){

                    $empcodes.="".$value->EMP_Code."".",";
            }
	    
            //$empcodes=rtrim($empcodes,",");		
	    //$empcodes = explode(",",$empcodes);
    }}
    $empcodes = explode(",",$empcodes);
    //deligate
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $empuserid = $_SESSION['empuserid'];
    $compid = $_SESSION['compid'];
    //echo $compid
    $row = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
	
    $actionButtons='<br />
        <div id="my_centered_buttons">
        <a href="" id="subApprove" class="btn btn-success">Approve</a> 
        <button type="button" name="reject" id="rejectApprover" class="btn btn-danger">Reject</button>
        <button type="button" name="back" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
        </div>';
    $approver = isApprover();
    if($approver)
    {       
            $rowpol = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");
            $notmyreq=0;

            if($selreqs=$wpdb->get_row("SELECT EMP_Id FROM requests req, request_employee re WHERE req.REQ_Id=re.REQ_Id AND EMP_Id='$empuserid' AND req.REQ_Id='$reqid'")){

                    $notmyreq=1;

            }
            
            $workflow = workflow();
            switch ($et)
            {
                    case 1:
                    $expPol=$workflow->COM_Pretrv_POL_Id;
                    break;

                    case 2:
                    $expPol=$workflow->COM_Posttrv_POL_Id;
                    break;

                    case 3:
                    $expPol=$workflow->COM_Othertrv_POL_Id;
                    break;

                    case 5:
                    $expPol=$workflow->COM_Mileage_POL_Id;
                    break;

                    case 6:
                    $expPol=$workflow->COM_Utility_POL_Id;
                    break;
            }
            
            if(!($budget=="100")){
            switch ($expPol)
            {
                    // employee --> rep manager --> finance
                    
                    case 1:
                            
                            //if its not my request
                            if(!$notmyreq)
                            {
                                if($rowpol->POL_Id=="5"){
                                    if(!(in_array("$row->EMP_Reprtnmngrcode", $empcodes)) || ($row->EMP_Id==$empuserid)) 
                                    {
					if($result!='100')
                                        echo $actionButtons;

                                    }
                                }
                                //if its not my request and approval is waiting from rep manager

                                else if(!$selMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=1 AND RS_Status=1")) 
                                {
                                    if($row->EMP_Funcrepmngrcode == $row->EMP_Reprtnmngrcode)
                                    {
                                    	echo $actionButtons;
                                    }
                                    else if(!($row->EMP_Funcrepmngrcode == $emp_code))
                                        echo $actionButtons;

                                }

                            }

                    break;



                    // employee --> finance --> rep manager

                    case 2:


                    //if its not my request
                    if(!$notmyreq)
                    {

                            // check for finance approval
                             
                            if($selFinStat=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND REQ_Status=2 AND RS_EmpType=2 AND RS_Status=1")){
                                    if($rowpol->POL_Id=="5"){
                                        if(!(in_array("$row->EMP_Reprtnmngrcode", $empcodes)) || ($row->EMP_Id==$empuserid)){
                                            if(!$selsecstatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND REQ_Status=2 AND RS_EmpType=5 AND RS_Status=1"))
                                            echo $actionButtons; 
                                        }
                                    }
                                    //if its not my request and finance has apprvd & waiting for my approval

                                    else if(!$selMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=1 AND RS_Status=1")){

                                            echo $actionButtons;

                                    }

                            }



                    }

                    break;

                    // employee -- > approver
                    case 3:

                            //if its not my request
                            if(!$notmyreq)
                            {
                            
                                    if($rowpol->POL_Id=="5" || $rowpol->POL_Id=="6"){
                                        if(!(in_array("$row->EMP_Reprtnmngrcode", $empcodes)) || ($row->EMP_Id==$empuserid)){
                                            if(!$selsecstatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND REQ_Status=2 AND RS_EmpType=5 AND RS_Status=1"))
                                            echo $actionButtons;

                                        }
                                    }
                                    //if its not my request and approval is waiting from rep manager
                                    else if(!$selMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=1 AND RS_Status=1")){
                                        if(!(in_array("$row->EMP_Reprtnmngrcode", $empcodes)) || ($row->EMP_Id==$empuserid)){}
                                        else{
                                            echo $actionButtons;
                                        }
                                    }

                            }

                    break;

                    // employee --> finance

                    case 4:

                            //if its not my request
                            if(!$notmyreq)
                            {
                                if($rowpol->POL_Id=="5"){
                                    if(!(in_array("$row->EMP_Reprtnmngrcode", $empcodes)) || ($row->EMP_Id==$empuserid)) 
                                    {
                                        if(!$selsecstatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND REQ_Status=2 AND RS_EmpType=5 AND RS_Status=1"))
                                        echo $actionButtons;

                                    }
                                }

                            }

                    break;

                    // Second Level Manager Request
                    case 5:

                            //if its not my request
                            if(!$notmyreq)
                            {
                                    //if its not my request and approval is waiting from rep manager
                                    if(!(in_array("$row->EMP_Reprtnmngrcode", $empcodes)) || ($row->EMP_Id==$empuserid)) 
                                    {

                                            echo $actionButtons;

                                    }

                            }

                    break;


            }


    }
    }
    if($row->EMP_Id==$empuserid)
    {
            $editActbuttons='<br />
            <div id="my_centered_buttons">
                <a href="/wp-admin/admin.php?page=Pre-travel-edit&reqid='.$reqid.'" class="btn btn-success">EDIT</a> 
              
                <button type="button" name="reset" id="deleteRequest" class="btn btn-danger">Delete</button>
              
                <button type="button" name="reset" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
            </div>';
            $editActbuttonspost='<br />
            <div id="my_centered_buttons">
                <a href="/wp-admin/admin.php?page=Post-travel-edit&reqid='.$reqid.'" class="btn btn-success">EDIT</a> 
               
                <button type="button" name="reset" id="deleteRequest" class="btn btn-danger">Delete</button>
               
                <button type="button" name="reset" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
            </div>';
            $editActbuttonsmileage='<br />
            <div id="my_centered_buttons">
                <a href="/wp-admin/admin.php?page=edit-mileage&reqid='.$reqid.'" class="btn btn-success">EDIT</a> 
              
                <button type="button" name="reset" id="deleteRequest" class="btn btn-danger">Delete</button>
              
                <button type="button" name="reset" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
            </div>';
            $editActbuttonsutility='<br />
            <div id="my_centered_buttons">
                <a href="/wp-admin/admin.php?page=edit-utility&reqid='.$reqid.'" class="btn btn-success">EDIT</a> 
              
                <button type="button" name="reset" id="deleteRequest" class="btn btn-danger">Delete</button>
               
                <button type="button" name="reset" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
            </div>';
            $editActbuttonsothers='<br />
            <div id="my_centered_buttons">
                <a href="/wp-admin/admin.php?page=edit-others&reqid='.$reqid.'" class="btn btn-success">EDIT</a> 
               
                <button type="button" name="reset" id="deleteRequest" class="btn btn-danger">Delete</button>
              
                <button type="button" name="reset" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
            </div>';


            // checking if the any details in this request has gone for booking tickets, then disable the 

            $sel = $wpdb->get_row("SELECT DISTINCT(req.REQ_Id) AS totalRequests FROM requests req, request_details rd, booking_status bs WHERE COM_Id='$compid' AND req.REQ_Id='$reqid' AND req.REQ_Id=rd.REQ_Id AND rd.RD_Id=bs.RD_Id AND REQ_Active !=9 AND RD_Status=1 AND BS_Active=1 LIMIT 1");

            $cntSel	=	count($sel);

            if($cntSel){

                     $editActbuttons='<br />
                    <div id="my_centered_buttons">
                        <a href="/wp-admin/admin.php?page=Pre-travel-edit&reqid='.$reqid.'" class="btn btn-primary">EDIT</a> 
                       
                        <button type="button" name="reset" id="deleteRequest" class="btn btn-danger">Delete</button>
                        
                        <button type="button" name="reset" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
                    </div>';

            }


            // if approved 
            if($row->REQ_Status==2){
                    if($row->REQ_PreToPostStatus==true)
                    $edit=1;
                    else
                    $edit=0;    

            } else {

                    // if pending , if rejected
                    if($row->REQ_Status==1 ||$row->REQ_Status==3)
                    $edit=1;

            }


            if($et==1)
            {

                    if($selclaim=$wpdb->get_row("SELECT * FROM pre_travel_claim WHERE REQ_Id='$reqid'"))
                    $edit=0;
                    else
                    $edit=1;

            }

            if($edit)
            {
                switch($et){
                    
                    case 1:
						if($row->REQ_PreToPostStatus)
						echo $editActbuttonspost;
						else
                        echo $editActbuttons;
                        break;
                    case 2:
                        echo $editActbuttonspost;
                        break;
                    case 3:
                        echo $editActbuttonsothers;
                        break;
                    case 5:
                        echo $editActbuttonsmileage;
                        break;
                    case 6:
                        echo $editActbuttonsutility;
                        break;
                }
                    
            }

        }
}
    
function FinanceActions($et,$totalcost){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $empuserid = $_SESSION['empuserid'];
    $compid = $_SESSION['compid'];
    $row = $wpdb->get_row("SELECT * FROM requests req, employees emp, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND emp.COM_Id='$compid' AND req.REQ_Active IN (1,2) AND RE_Status=1");

    $actionButtons='<br />
        <div id="my_centered_buttons">
        <a href="" id="submitApprove" class="btn btn-primary">Approve</a> 
      
        <button type="button" name="reject" id="rejectFinance" class="btn btn-danger">Reject</button>
       
        <button type="button" name="back" id="reset" onClick="window.history.back();" class="btn btn-warning">Back</button>
        </div>';
    $approver = isApprover();
    
    
    $limitFlag	= '<div id="notice" class="notice notice-warning is-dismissible"><p id="p-notice">Sorry. Total expense cost exceeded your approval limit.</p></div>';

    // checking reporting manager has approved ?
	
	$repMngrApprvd=0;
	
	if($selMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=1 AND REQ_Status=2 AND RS_Status=1"))
	$repMngrApprvd=1;
	
        // checking second level manager has approved ?
	
	$secMngrApprvd=0;
	
	if($selsecMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=5 AND REQ_Status=2 AND RS_Status=1"))
	$secMngrApprvd=1;
	
	// checking finance has approved ?
	
	$finApprvd=0;
	
	if($selMngrStatus=$wpdb->get_row("SELECT * FROM request_status WHERE REQ_Id='$reqid' AND RS_EmpType=2 AND REQ_Status IN (2,4) AND RS_Status=1"))
	$finApprvd=1;
	
	
	// finance approval limit
	
	$limit=0;
	
	//echo 'Total Cost='.$totalcost;
                                
	if($selfinlimit	=	$wpdb->get_row("SELECT APL_LimitAmount FROM approval_limit WHERE EMP_Id=$empuserid AND APL_Status=1 AND APL_Status IS NOT NULL AND APL_Active=1")){
	
		$limit_amnt	=	$selfinlimit->APL_LimitAmount;
		
		if($limit_amnt <= $totalcost)
		$limit=1;
	
	}
        $workflow = workflow();
        switch ($et)
        {
                case 1:
                $expPol=$workflow->COM_Pretrv_POL_Id;
                break;

                case 2:
                $expPol=$workflow->COM_Posttrv_POL_Id;
                break;

                case 3:
                $expPol=$workflow->COM_Othertrv_POL_Id;
                break;

                case 5:
                $expPol=$workflow->COM_Mileage_POL_Id;
                break;

                case 6:
                $expPol=$workflow->COM_Utility_POL_Id;
                break;
        }
        $mydetails = myDetails();
        $emp_code=$mydetails->EMP_Code;
        switch ($expPol)
        {
            // employee --> rep manager --> finance
		
		case 1:
	
                        //if its not my request and approval is waiting from sec manager
			if($secMngrApprvd) 
			{
			
				if(!$finApprvd){
				
					if(!$limit)
					echo $actionButtons;
					else
					echo $limitFlag;
				
				}
				
			
			}
			//if its not my request and approval is waiting from rep manager
			else if($repMngrApprvd) 
			{
			
				if(!$finApprvd){
				
					if(!$limit)
					echo $actionButtons;
					else
					echo $limitFlag;
				
				}
				
			
			}
		
			
		break;
		
		
		
		// employee --> finance --> rep manager
		
		case 2:
                    if(!$limit)
                    echo $actionButtons;
                    else
                    echo $limitFlag;
                break;
		// employee -- > finance
		case 4:
                    //if($secMngrApprvd) 
                    //{
			if(!$finApprvd){
				
				if(!$limit)
				echo $actionButtons;
				else
				echo $limitFlag;
				
			}
                    //}
//                    else if(!$secMngrApprvd){
//                        if(!$finApprvd){
//				
//				if(!$limit)
//				echo $actionButtons;
//				else
//				echo $limitFlag;
//				
//			}
//                    }
		
		break;
        }

}
function chat_box($rn_status,$reqtype){
      global $wpdb;
      $compid = $_SESSION['compid'];
            $reqid = $_REQUEST['reqid'];
                  $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Claim IS NULL and req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active != 9 AND REQ_Type='$reqtype' AND RE_Status=1");

      //$empuserid = $_SESSION['empuserid'];
      if(isset($_SESSION['empuserid'])){
        $empuserid = $_SESSION['empuserid'];
        }else{
            $compid = $_SESSION['compid'];
            $reqid = $_REQUEST['reqid'];
            $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Claim IS NULL and req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Active != 9 AND REQ_Type='$reqtype' AND RE_Status=1");
            $empuserid = $row->EMP_Id;
        }
      $reqid = $_GET['reqid'];
      global $date;
      global $content;
      global $image;
      global $author;
      echo '<div class="note-tab-wrap erp-grid-container">';
      echo '<h3>Send Notes</h3>';

      echo '<form action="" class="note-form row" method="post">';    
      if($selsql=$wpdb->get_results("SELECT * FROM requests_notes WHERE REQ_Id='$reqid' ORDER BY RN_Id ASC")){
      //print_r($selsql);die;
      
	  foreach($selsql as $rowsql){
	  
	  
	  
		  switch ($rowsql->RN_Status)
		  {
			case 3:
				
				$date = date('d/m/y h:i a', strtotime($rowsql->RN_Date));
                                $author = "<b>Travel Desk: </b>";   
				$content = stripslashes($rowsql->RN_Notes);
                                $image = '<img alt="" src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" srcset="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32">';
				
			break;
			
			
			case 2:
                                $date = date('d/m/y h:i a', strtotime($rowsql->RN_Date));
                                $author = "<b>Finance: </b>";
				$content = stripslashes($rowsql->RN_Notes);
				$image = '<img alt="" src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" srcset="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32">';
			break;
			
			
			default:
                            
			if($rowemp=$wpdb->get_row("SELECT * FROM employees WHERE EMP_Id=$rowsql->EMP_Id")){
				
				$there=0;
                                
				if($rowempdet=$wpdb->get_results("SELECT * FROM employees WHERE EMP_Reprtnmngrcode='$rowemp->EMP_Code'"))
				{
					$there=1;
                                        if($row)
					if($row->EMP_Id==$rowsql->EMP_Id)
					$there=0;
					
				}
				$date = date('d/m/y h:i a', strtotime($rowsql->RN_Date));
                                $author = "<b>$rowemp->EMP_Code</b>";
				$content = stripslashes($rowsql->RN_Notes);
				$image = get_avatar( $rowemp->EMP_Email, 64 );
				}
			} // switch case 
		
	

        echo '<ul class="erp-list notes-list">';
                echo '<li>';
                    echo '<div class="avatar-wrap">';
                        echo $image;
                   echo '</div>';
                   echo '<div class="note-wrap">';
                    echo     '<div class="by">';
                         echo    '<a href="#" class="author">'.$author.'</a>';
                          echo   '<span class="date">'.$date.'</span>';
                      echo  '</div>';
                        echo '<div class="note-body">';
                              echo $content; 
                        echo '</div>';         
                    echo '</div>';
                echo '</li>';    
           echo ' </ul>';
        }// for each loop

    }
    
        erp_html_form_input( array(
            'name'        => 'note',
            'required'    => true,
            'placeholder' => __( 'Add a note...', 'erp' ),
            'type'        => 'textarea',
            'id'          => 'txtaNotes',
            'custom_attr' => array( 'rows' => 3, 'cols' => 30 )
        ) ); 

        echo '<input type="hidden" id="rn_status" name="rn_status" value="'.$rn_status.'">';
        echo '<input type="hidden" id="req_id" name="req_id" value="'.$reqid.'">';
        echo '<input type="hidden" id="emp_id" name="emp_id" value="'.$empuserid.'">';
        echo '<input type="submit" name="post-emp-chat" id="post-emp-chat" class="btn btn-primary pull-right" value="Send Note">' ;
        echo '<span class="erp-loader erp-note-loader"></span>';
    echo '</form>';
    
echo '</div>';
}
/*////////////////////////////////////////////////////
              GET COMPANY POLICY TYPE       
////////////////////////////////////////////////////*/

function compPolicy($compid){

    global $wpdb;
    $selpolicy=$wpdb->get_row("SELECT COM_Pretrv_POL_Id, COM_Posttrv_POL_Id, COM_Othertrv_POL_Id, COM_Mileage_POL_Id, COM_Utility_POL_Id FROM company WHERE COM_Id='$compid'");
	
    return $selpolicy;

}
/** 
*  Function:   convert_number 
*
*  Description: 
*  Converts a given integer (in range [0..1T-1], inclusive) into 
*  alphabetical format ("one", "two", etc.)
*
*  @int
*
*  @return string
*
*/ 
function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
}
