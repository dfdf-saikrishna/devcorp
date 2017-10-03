<?php
global $wpdb;
$compid = $_SESSION['compid'];
$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re Where req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND re.RE_Status=1 AND req.REQ_Active=1");
$empid = $row->EMP_Id;
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
$repmngname = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND COM_Id='$compid'");
?>
<?php 

if(!$finace){
?>

<div style="margin-top:60px;">
            <table class="wp-list-table widefat striped admins">
              <tr>
                <td width="20%">Employee Code</td>
                <td width="5%">:</td>
                <td width="25%"><?php echo $empdetails->EMP_Code?> (<?php echo $empdetails->EG_Name?>)</td>
                <td width="20%">Company Name</td>
                <td width="5%">:</td>
                <td width="25%"><?php echo stripslashes($empdetails->COM_Name); ?></td>
              </tr>
              <tr>
                <td width="20%">Employee Name</td>
                <td width="5%">:</td>
                <td width="25%"><?php echo $empdetails->EMP_Name; ?></td>
                <td width="20%">Reporting Manager Code</td>
                <td width="5%">:</td>
                <td width="25%"><?php echo $empdetails->EMP_Reprtnmngrcode; ?></td>
              </tr>
              <tr>
                <td>Employee Designation </td>
                <td>:</td>
                <td><?php echo $empdetails->DES_Name; ?></td>
                <td>Reporting Manager Name</td>
                <td>:</td>
                <td><?php if($repmngname)echo $repmngname->EMP_Name;?></td>
              </tr>
              <tr>
                <td width="20%">Employee Department</td>
                <td width="5%">:</td>
                <td width="25%"><?php echo $empdetails->DEP_Name; ?></td>
                <?PHP 

                    $q=NULL;

                    if(!$showProCode){
                          $pc=" AND PC_Status IN (1)";
                          $cc=" AND CC_Status IN (1)";
                    }else{
                        $pc = "";
                        $cc = "";
                    }

                    $selexpcatpc=$wpdb->get_results("SELECT * FROM project_code WHERE COM_Id='$compid' AND PC_Active=1 $pc");

                    if(count($selexpcatpc)){

                          if($showProCode){
                            ?>
                <td width="20%" style="color:#C66300;">Project Code</td>
                <td width="5%">:</td>
                <td width="25%"><?php 
                    
                    if($row->PC_Id){

                            if($rowpcname=$wpdb->get_row("SELECT PC_Code, PC_Name FROM project_code WHERE COM_Id='$compid' AND PC_Id=$row->PC_Id AND PC_Active=1")){

                                   echo $rowpcname->PC_Code.' -- '.$rowpcname->PC_Name;


                            } 

                    }  else {

                          echo 'None';

                    }
                    ?></td>
                <?php

                          } else {

                          ?>
                <td width="20%" style="color:#C66300;">Project Code</td>
                <td width="5%">:</td>
                <td width="25%"><select name="selProjectCode" id="selProjectCode" class="">
                    <option value="">None</option>
                    <?php 

                                            foreach($selexpcatpc as $rowexpcat)
                                            {
                                            ?>
                    <option value="<?php echo $rowexpcat->PC_Id?>" <?php if($row){if($row->PC_Id==$rowexpcat->PC_Id) echo 'selected="selected"';}else{echo "";} ?>><?php echo $rowexpcat->PC_Code." -- ".$rowexpcat->PC_Name; ?></option>
                    <?php } ?>
                  </select>
                </td>
                <?php	

                          }


                    ?>
                <?php }  else { ?>
                <td colspan="3">&nbsp;</td>
                <?php } ?>
              </tr>
              <tr>
                <td colspan="3">&nbsp;</td>
                <?PHP 
                
                    $selexpcatpc=$wpdb->get_results("SELECT * FROM cost_center WHERE COM_Id='$compid' AND CC_Active=1 $cc");

                    if(count($selexpcatpc)){

                          if($showProCode){

                                                  ?>
                <td width="20%" style="color:#C66300;">Cost Center</td>
                <td width="5%">:</td>
                <td width="25%"><?php 
                    if($row->CC_Id){

                            if($rowpcname=$wpdb->get_row("SELECT CC_Code, CC_Name FROM cost_center WHERE COM_Id='$compid' AND CC_Id=$row->CC_Id AND CC_Active=1")){

                                   echo $rowpcname->CC_Code.' -- '.$rowpcname->CC_Name;


                            } 
                    }  else {

                          echo 'None';

                    }
                    ?></td>
                <?php

                          } else {
                          
                          ?>
                <td width="20%" style="color:#C66300;">Cost Center</td>
                <td width="5%">:</td>
                <td width="25%"><select name="selCostCenter" id="selCostCenter" class="">
                    <option value="">None</option>
                    <?php 

                                            foreach($selexpcatpc as $rowexpcat)
                                            {
                                            ?>
                    <option value="<?php echo $rowexpcat->CC_Id?>" <?php if($row){if($row->CC_Id==$rowexpcat->CC_Id) echo 'selected="selected"';}else{echo "";} ?>><?php echo $rowexpcat->CC_Code." -- ".$rowexpcat->CC_Name; ?></option>
                    <?php } ?>
                  </select>
                </td>
                <?php	

                          }


                    ?>
                <?php }  else { ?>
                <td colspan="3">&nbsp;</td>
                <?php } ?>
            </tr>
            </table>
            </div>
<?php } else { ?>
<div class="row">
   
  <?php 
	
	 $q=NULL;
	  
	  if(!$showProCode){
	  	$pc=" AND PC_Status IN (1)";
		$cc=" AND CC_Status IN (1)";
	  }
	  
	  $selexpcat=$wpdb->get_results("SELECT * FROM  project_code where COM_Id='$compid' AND PC_Active=1 $pc");
	  
	  if(count($selexpcat)){
		
		if($showProCode){
	?>
  <div class="col-lg-6">
   Project Code: 
      
      <b>  <?php 
	  
	  if($row['PC_Id']){
	  
		  if($rowpcname=$wpdb->get_results("SELECT * FROM  project_code", "PC_Code, PC_Name", "COM_Id='$compid' AND PC_Id=$row[PC_Id] AND PC_Active=1", $filename, 0)){
		  
			 echo $rowpcname['PC_Code'].' -- '.$rowpcname['PC_Name'];
		  
		  
		  } 
		  
	  }  else {
	  
	  	echo 'None';
	  
	  }
	  ?>
      </b>
      
  </div>
  <?php } else { ?>
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Project Code:</label>
      <div class="col-lg-6">
        <select name="selProjectCode" id="selProjectCode" class="form-control">
          <option value="">None</option>
          <?php 
				  
				  foreach($selexpcat as $rowexpcat)
				  {
				  ?>
          <option value="<?php echo $rowexpcat['PC_Id']?>" <?php if($row[PC_Id]==$rowexpcat['PC_Id']) echo 'selected="selected"'; ?>><?php echo $rowexpcat['PC_Code']." -- ".$rowexpcat['PC_Name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php }  else { ?>
  <div class="col-lg-4">&nbsp;</div>
  <?php } ?>
  <?PHP 
	  
	  $selexpcat=$wpdb->get_results("SELECT * FROM  cost_center where COM_Id='$compid' AND CC_Active=1 $cc");
	  
	  if(count($selexpcat)){
		
		if($showProCode){
							
	?>
  <div class="col-lg-6">
  Cost Center:
  <b>
        <?php 
	  if($row['CC_Id']){
	  
		  if($rowpcname=$wpdb->get_results("SELECT CC_Code, CC_Name FROM  cost_center where COM_Id='$compid' AND CC_Id='$row->CC_Id' AND CC_Active=1")){
		  
			 echo $rowpcname['CC_Code'].' -- '.$rowpcname['CC_Name'];
		  
		  
		  } 
	  }  else {
	  
	  	echo 'None';
	  
	  }
	  ?>
     </b>
  </div>
  <?php } else { ?>
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Cost Center:</label>
      <div class="col-lg-6">
        <select name="selCostCenter" id="selCostCenter" class="form-control">
          <option value="">None</option>
          <?php 
				  
				  foreach($selexpcat as $rowexpcat)
				  {
				  ?>
          <option value="<?php echo $rowexpcat['CC_Id']?>" <?php if($row['CC_Id']==$rowexpcat['CC_Id']) echo 'selected="selected"'; ?>><?php echo $rowexpcat['CC_Code']." -- ".$rowexpcat['CC_Name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php }  else { ?>
  <div class="col-lg-4">&nbsp;</div>
  <?php } ?>
</div>
<!--div col lg 12 ends here -->
<?php
}?>
