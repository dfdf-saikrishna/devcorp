<?php  
global $wpdb;
$compid = $_SESSION['compid'];
$rowpol = $wpdb->get_results("SELECT * FROM policy");
$workflow = $wpdb->get_row("SELECT COM_Pretrv_POL_Id, COM_Posttrv_POL_Id, COM_Othertrv_POL_Id, COM_Mileage_POL_Id, COM_Utility_POL_Id FROM company WHERE COM_Id='$compid'");


?>
<div class="postbox">
    <div class="inside">
	 <!-- Messages -->
	<div style="display:none" id="failure" class="notice notice-error is-dismissible">
		<p id="p-failure"></p>
	</div>
	<div style="display:none" id="success" class="notice notice-success is-dismissible">
		<p id="p-success"></p>
	</div>
	<h2><?php _e( 'Select Grades for Auto Approval', 'crp' ); ?></h2>
		<div class="filter-top">
			<?php
            $selsql=$wpdb->get_results("SELECT * From employee_grades Where COM_Id='$compid' AND EG_Status=1 AND EMP_Grade=1");
			  
            $temp_array=array();


            $c=0;
            foreach($selsql as $values){

                  $temp_array[]=$values->EG_Id;

                  $c++;

            }
            $empCount = count($selsql);
			?>
			<form method="post" action="#" enctype="multipart/form-data" id="auto_approval" name="auto_approval">
			<table class="form-table">
                <tbody id="fields_container" class="emp-grades">
				
				
				<tr>
                            <!--label for="type"><?php _e( 'Grades', 'crp' ); ?></label-->
                        <td width="auto">
							<select  class="form-control erp-select2" data-size="5" data-live-search="true" multiple name="grades[]" id="grades">
							<?php
							$seldrop = $wpdb->get_results("SELECT * From employee_grades Where COM_Id='$compid' AND EG_Status=1 ORDER BY EG_Id DESC");
							foreach ($seldrop as $value) {
								?>
								<option value="<?php echo $value->EG_Id ?>"  <?php echo (in_array($value->EG_Id,$temp_array)) ? 'selected="selected"' : ''; ?>><?php echo $value->EG_Name ?></option>
							<?php } ?>
							</select>
                            
                        </td>
						<input type="hidden" name="action" id="auto_approval" value="auto_approval">
						<td width="100">
						<input type="submit" value="Submit" class="btn btn-primary">
						</td>
                    </tr>
	
				</tbody>
			</table>	
			</form>
		</div>
	
	
	
	
	
        <h2><?php _e( 'Company Expense Request Workflow', 'crp' ); ?></h2>
       
        <form method="post" action="#" enctype="multipart/form-data" id="workflow_update" name="workflow_update">

            <table class="form-table">
                <tbody id="fields_container" class="workflow-update">
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Pre Travel Request', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selPreTrvPol" id="selPreTrvPol">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($rowpol as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->POL_Id?>" <?php echo ($workflow->COM_Pretrv_POL_Id==$value->POL_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->POL_Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="selPreTrvPol-update" class="btn btn-primary">Update</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Post Travel Request', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selPostTrvPol" id="selPostTrvPol">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($rowpol as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->POL_Id?>" <?php echo ($workflow->COM_Posttrv_POL_Id==$value->POL_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->POL_Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="selPostTrvPol-update" class="btn btn-primary">Update</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'General Expense Request', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selGenExpReq" id="selGenExpReq">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($rowpol as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->POL_Id?>" <?php echo ($workflow->COM_Othertrv_POL_Id==$value->POL_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->POL_Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="selGenExpReq-update" class="btn btn-primary">Update</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Mileage Requests', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selMileageReq" id="selMileageReq">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($rowpol as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>               
                                <option value="<?php echo $value->POL_Id?>" <?php echo ($workflow->COM_Mileage_POL_Id==$value->POL_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->POL_Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="selMileageReq-update" class="btn btn-primary">Update</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Utility Requests', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selUtilityReq" id="selUtilityReq">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($rowpol as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->POL_Id?>" <?php echo ($workflow->COM_Utility_POL_Id==$value->POL_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->POL_Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="selUtilityReq-update" class="btn btn-primary">Update</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
			
		
    </div><!-- .inside -->
</div><!-- .postbox -->

