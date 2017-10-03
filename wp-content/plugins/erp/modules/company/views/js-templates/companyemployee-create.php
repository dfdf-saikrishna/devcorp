<div class="erp-employee-form">
	<legend>Upload Employee Photo</legend>
    <fieldset class="no-border">
	<ol class="form-fields">
            <li>
                <!--label for="full-name">Upload EMP Photo</label-->
                <div class="photo-container">
                    <input name="companyemployee[photo_id]" id="emp-photo-id" value="{{data.Emp_photoId}}" type="hidden">
                        <# if ( data.EMP_Photo ) { #>
                        <img src="{{ data.EMP_Photo }}" alt="" />
                        <a href="#" class="erp-remove-photo">&times;</a>
                        <# } else { #>
                            <a href="#" id="company-emp-photo" class="button button-small" style="
    width: 150px;
">Select File</a>
                        <# } #>
                    
                </div>
            </li>
        </ol>
		</fieldset>
		<legend>Employee Profile Details</legend>
		<fieldset class="no-border">
        <ol class="form-fields two-col">
                            <li>
                    <label for="txtCompname">Employee Name </label>
                    <input required  value="{{data.EMP_Name}}"  name="companyemployee[txtEmpname]" id="txtEmpname" type="text"><input type="hidden" name="companyemployee[user_id]" value="{{data.user_id}}"></li>
                        <li>
                <label for="txtEmpcode">Employee Code </label><input required  value="{{data.EMP_Code}}" name="companyemployee[txtEmpcode]" id="txtEmpcode"  type="text"></li>

        
         <li class="erp-hr-js-department" data-selected={{data.EG_Id}}>
            <?php $getgrades = get_grade_list(); 
                  //print_r($getgrades);
                  $count = count($getgrades);
                  ?>
           <label for="grade">Grade</label>
           <select class="erp-select2" required id="selGrade" name="companyemployee[selGrade]"  tabindex="-1" aria-hidden="true">
           <option value="">Select</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getgrades[$i]->EG_Id; ?>"><?php echo $getgrades[$i]->EG_Name; ?></option>

               <?php } ?>
           </select>
          </li>
		   <li class="erp-hr-js-department" data-selected={{data.DEP_Id}}>
            <?php $getdepartments = get_department_list(); 
                  //print_r($getdepartments);
                  $count = count($getdepartments);
                  ?>
           <label for="selDep">Department</label>
           <select required id="selDep" name="companyemployee[selDep]" class="erp-select2" tabindex="-1" aria-hidden="true">
           <option value="">Select</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getdepartments[$i]->DEP_Id; ?>"><?php echo $getdepartments[$i]->DEP_Name; ?></option>

               <?php } ?>
           </select>
          </li>
	
         <li class="erp-hr-js-department" data-selected={{data.DES_Id}}>
            <?php $getdesignations = get_designation_list(); 
                  //print_r($getdesignations);
                  $count = count($getdesignations);
                  ?>
           <label for="selDes">Designation</label>
           <select  required id="selDes" name="companyemployee[selDes]" class="erp-select2"  tabindex="-1" aria-hidden="true">
           <option value="">Select</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getdesignations[$i]->DES_Id; ?>"><?php echo $getdesignations[$i]->DES_Name; ?></option>

               <?php } ?>
           </select>
          </li>
	
            <li><label for="txtempemail">Email </label><input required value="{{data.EMP_Email}}" name="companyemployee[txtempemail]" id="txtempemail"  type="email"></li>         
            <li><label for="txtempmob">Mobile No.</label><input  required name="companyemployee[txtempmob]" value="{{data.EMP_Phonenumber}}" id="txtempmob"  type="number"></li>
			<li><label for="txtemplandline">Landline No.</label><input required name="companyemployee[txtemplandline]" value="{{data.EMP_Phonenumber2}}" id="txtemplandline" type="number"></li>
       
         <li class="erp-hr-js-department" data-selected={{data.EMP_Reprtnmngrcode}}>
            <?php $getrepm = get_repm_list(); 
                  $count = count($getrepm);
                  ?>
           <label for="grade">Reporting Manager Code</label>
           <select id="txtRepmngrcode" name="companyemployee[txtRepmngrcode]" class="erp-select2" tabindex="-1" aria-hidden="true">
           <option value="">Select</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getrepm[$i]->EMP_Code; ?>"><?php echo $getrepm[$i]->EMP_Code ."---". $getrepm[$i]->EMP_Name; ?></option>

               <?php } ?>
           </select>
          </li>
		  <li class="erp-hr-js-department" data-selected={{data.EMP_Funcrepmngrcode}}>
            <?php $getfrepm = get_frepm_list(); 
                  $count = count($getfrepm);
                  ?>
           <label for="RFM">Reporting Functional Manager Code</label>
           <select id="txtRepfuncmngrcode" name="companyemployee[txtRepfuncmngrcode]" class="erp-select2" tabindex="-1" aria-hidden="true">
           <option value="">Select</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getfrepm[$i]->EMP_Code; ?>"><?php echo $getfrepm[$i]->EMP_Code ."---". $getfrepm[$i]->EMP_Name; ?></option>

               <?php } ?>
           </select>
          </li>
	</ol>
        </fieldset>
   
       
        <?php wp_nonce_field( 'wp-erp-hr-employee-nonce' ); ?>
        <input type="hidden" name="action" id="companyemployee_create" value="companyemployee_create">
</div>