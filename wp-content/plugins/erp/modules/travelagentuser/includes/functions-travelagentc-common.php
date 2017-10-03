<?php
function travelagentclientrequestDetails($et){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $compid = $_SESSION['compid'];
    $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Type=2 AND RE_Status=1");
    echo '<div class="table-wrapper">';
    echo '<table class="table">';
    echo '<tr>';
    echo '<td width="20%">Request Id</td>';
    echo '<td width="5%">:</td>';
    echo '<td width="25%">'.$row->REQ_Code.'</td>';
   
    $repmngr_block='<td width="20%">Reporting Manager Approval</td>
					<td width="5%">:</td>
					<td width="25%">';
					
					
					
    $fin_block='<td width="20%">Finance Approval</td>
                            <td width="5%">:</td>
                            <td width="25%">';			

    $second_level_block='<td width="20%">Skip Level Manager Approval</td>
                            <td width="5%">:</td>
                            <td width="25%">';

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


            $second_level_block.='</td>';

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


            $repmngr_block.='</td>';


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


            $fin_block.='</td>';



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
    
    
  echo '</tr>';
  /*------SECOND ROW ------*/
  echo '<tr>';
     echo  '<td width="20%">Request Date</td>';
     echo '<td width="5%">:</td>';
     echo '<td width="25%">'.date("d-M-y (h:i a)",strtotime($row->REQ_Date)).'</td>';
     
     $repmngr_block='<td width="20%">Reporting Manager Approval</td>
                    <td width="5%">:</td>
                    <td width="25%">';
		
		
    $fin_block='<td width="20%">Finance Approval</td>
                <td width="5%">:</td>
                <td width="25%">';

    $fin_block_second='<td width="20%">Finance Approval</td>
                        <td width="5%">:</td>
                        <td width="25%">';

    $second_level_block_second='<td width="20%">2nd Level Manager Approval</td>
                                <td width="5%">:</td>
                                <td width="25%">';


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


            $repmngr_block.='</td>';
                            
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


            $second_level_block_second.='</td>';			

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

            $fin_block.='</td>';

                            
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

            $fin_block_second.='</td>';

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
     
  echo '</tr>';
echo '</table>';
echo '</div>';
}