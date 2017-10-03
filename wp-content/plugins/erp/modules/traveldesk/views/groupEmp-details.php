<?php
global $wpdb;
$compid = $_SESSION['compid'];
//$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re Where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1");
//$empid = $row->EMP_Id;
$empid = $row->EMP_Id;
if(!$empid)
$empid = $_GET['selEmployees'];
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
?>
<table class="wp-list-table widefat striped admins">
              <tr>
              <div class="travel-req">	
                
                <?PHP 
                
                    $selexpcatpc=$wpdb->get_results("SELECT * FROM cost_center WHERE COM_Id='$compid' AND CC_Active=1 AND CC_Status=1 $cc");

                    if(count($selexpcatpc)){

                          if($showProCode){

                    ?>
                <td width="20%" style="color:#C66300;">Cost Center</td>
               
                <td width="25%"><?php 
                    if($row->costCenter_Id){

                            if($rowpcname=$wpdb->get_row("SELECT CC_Code, CC_Name FROM cost_center WHERE COM_Id='$compid' AND CC_Id=$row->costCenter_Id AND CC_Active=1")){

                                   echo $rowpcname->CC_Code.' -- '.$rowpcname->CC_Name;


                            } 
                    }  else {

                          echo 'None';

                    }
                    ?></td>
                <?php

                          } else {
                          $ccId = $wpdb->get_row("SELECT CC_Id FROM employees WHERE EMP_Id='$empid'");
                          ?>
                <div class="col-md-6">
					 <label>Select Cost Center</label>
					 <select id="selCostCenter" name="selCostCenter" class="form-control selectpicker input-medium" required>
						<option value="">None</option>
					<?php 
											foreach($selexpcatpc as $rowexpcat)
											{
											?>
					<option value="<?php echo $rowexpcat->CC_Id?>" <?php if($row){if($row->costCenter_Id==$rowexpcat->CC_Id) echo 'selected="selected"';}elseif($rowexpcat->CC_Id==$ccId->CC_Id){ echo 'selected="selected"';}else{echo "";} ?>><?php echo $rowexpcat->CC_Code." -- ".$rowexpcat->CC_Name; ?></option>
					<?php } ?>
					</select>
				 </div>
                <?php	

                          }


                    ?>
                <?php }  else { ?>
                <!--td colspan="3">&nbsp;</td-->
                <?php } ?>
                
                <?PHP 

                    $q=NULL;

                    if(!$showProCode){
                          $pc=" AND PC_Status IN (1)";
                          $cc=" AND CC_Status IN (1)";
                    }else{
                        $pc = "";
                        $cc = "";
                    }
		    $ccId = $wpdb->get_row("SELECT CC_Id FROM employees WHERE EMP_Id='$empid'");
		    if($ccId->CC_Id){
		            if(!$row->PC_Id)
                    $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND CC_Id = '$ccId->CC_Id' AND PC_Active=1 $pc");
                    if($row->PC_Id)
                    $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND PC_Active=1 $pc");
		    }
                    else{
                    $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND PC_Active=1 $pc");
                    }
                    //if(count($selexpcatpc)){
                          if($showProCode){
                              if(count($selexpcatpc)){
                            ?>
                <td width="20%" style="color:#C66300;">Project Code</td>
          
                <td width="25%"><?php 
                    
                    if($row->PC_Id){

                            if($rowpcname=$wpdb->get_row("SELECT PC_Code, PC_Name FROM project_code WHERE COM_Id='$compid' AND PC_Id=$row->PC_Id AND PC_Active=1")){

                                   echo $rowpcname->PC_Code.' -- '.$rowpcname->PC_Name;


                            } 

                    }  else {

                          echo 'None';

                    }
                    }
                    ?></td>
                <?php

                          } else {
                          ?>
                <div class="col-md-6">
					 <label>Select Project Code</label>
					 <select class="form-control selectpicker input-medium" id="selProjectCode" name="selProjectCode" required> 
						<option value="">None</option>
						<?php
						if($row->PC_Id){
						    $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND PC_Active=1 $pc");
						}
						else if($rowexpcat->CC_Id){
						    $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND PC_Active=1 AND CC_Id = '$rowexpcat->CC_Id' $pc");
						}
						else{
                        $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND PC_Active=1 $pc");
						}
						foreach($selexpcatpc as $rowexpcat)
						{
						?>
						<option value="<?php echo $rowexpcat->PC_Id?>" <?php if($row){if($row->PC_Id==$rowexpcat->PC_Id) echo 'selected="selected"';}else{echo "";} ?>><?php echo $rowexpcat->PC_Code." -- ".$rowexpcat->PC_Name; ?></option>
						<?php } ?>
					</select>
				</div>
                <?php	

                          }


                    ?>
                <?php 
                        
                    //}  
                
                //else { 
                if(!(count($selexpcatpc))){?>
                <!--td colspan="3">&nbsp;</td-->
                <?php } ?>
              </tr>
			  </div>
              
              
              
            </table>
            </div>