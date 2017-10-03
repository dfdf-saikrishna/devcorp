<?php
        /**
	 * Show Extra Profile Fields
	 */
        function my_show_extra_profile_fields( $user ) {                 
            global $wpdb;
            $compid = $_SESSION['compid'];
            $empid = $_SESSION['empuserid'];
            $rowcomp = $wpdb->get_row("SELECT * FROM employees emp, admin adm, department dep, designation des, employee_grades eg WHERE emp.COM_Id='$compid' AND emp.EMP_Id='$empid' AND emp.ADM_Id=adm.ADM_Id AND emp.EG_Id=eg.EG_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id");
           
           
	    if( current_user_can( 'employee' ) || current_user_can( 'finance' )){
            ?>
            <style type="text/css">
		
		
		ul.tab {
		    list-style-type: none;
		    margin: 0;
		    overflow:hidden;
			padding-top:9px;
			padding-bottom:0;
		    //background-color: #fff;
		
			line-height: inherit;
		
		}
		ul.tab:after{
			 position: absolute;
		  content: "";
		  width: 100%;
		  bottom: 0;
		  left: 0;
		    z-index: 1;
			  
		}
		
		/* Float the list items side by side */
		ul.tab li {float: left;}
		
		/* Style the links inside the list items */
		ul.tab li a {
		    display: inline-block;
		    color: black;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		    transition: 0.3s;
		   font-size:17px;
			  
				
		
		}
		li a:focus, .active{
		   
		   //background-color:#fff;
		}
		.show{
			background-color:#ddd;
		}
		
		/* Change background color of links on hover */
		
		.inactive{
			background-color:#ddd;
		}
		
		
		/* Style the tab content */
		.tabcontent {
		    display: none;
		    padding: 6px 12px;
		    border-top: none;
			
		}
		
		 select#wgmstr {
    max-width: 50px;
    min-width: 50px;
    width: 50px !important;
}
		.tab.active {
		    display:block;
			  
		}
		 a.active{
			 //background: #FFFFFF !important;
		     border-bottom:3px solid #0096A8 !important;
			 color:#0096A8 !important;
			 
		 }
		</style>   
		
		<script>
		  function travel(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		   }
		   function employee(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontente");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinkse");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		   }
	        </script>
               
	       
                <ul class="tab">
	            <li><a href="javascript:void(0)" class="tablinkse active" onclick="employee(event, 'Personal')"><b>Personal information</b></a></li>
	            <li><a href="javascript:void(0)" class="tablinkse" onclick="employee(event, 'Family')"><b>Family Members</b></a></li>
	            <!--li><a href="javascript:void(0)" class="tablinkse" onclick="employee(event, 'Medical')"><b>Medical Information</b></a></li>
	            <li><a href="javascript:void(0)" class="tablinkse" onclick="employee(event, 'Bank')"><b>Bank Details</b></a></li-->
	             <li><a href="javascript:void(0)" class="tablinkse" onclick="employee(event, 'Profile')"><b>Employee profile </b></a></li>
	             <li><a href="javascript:void(0)" class="tablinkse" onclick="employee(event, 'Travel')"><b>Travel Documents</b></a></li>
                	        </ul>
	        <div id="Personal" class="tabcontente tab active">
              
				
			<?php $personal=$wpdb->get_row("SELECT * FROM personal_information WHERE EMP_Id='$empid'");?>
			
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Gender</label></th>
                        <td>
                            <input type="radio" name="emp_genderp" value="male"<?php if (!$personal->PI_Gender) echo 'checked="checked"'; else { if ($personal->PI_Gender=='male') echo 'checked="checked"' ;   } ?>>Male 
                            <input type="radio" name="emp_genderp" value="female"<?php echo ($personal->PI_Gender=='female') ? 'checked="checked"' : ''; ?>> Female

                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Present Address</label></th>
                        <td>
                            <input type="text" name="emp_presentaddress" id="emp_presentaddress" value="<?php echo $personal->PI_CurrentAddress;?>" class="regular-text">
                        </td>
                </tr>
                
                 <tr>
                        <th><label for="paypal_account">Phone</label></th>

                        <td>
                            <input type="text" name="phone" id="phone" value="<?php echo $rowcomp->EMP_Phonenumber; ?>" class="regular-text" /><br />
                            <span class="description">Please enter your Phone Number.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="paypal_account">Landline</label></th>

                        <td>
                            <input type="text" name="phone2" id="phone2" value="<?php echo $rowcomp->EMP_Phonenumber2; ?>" class="regular-text" /><br />
                            <span class="description">Please enter your Landline Number.</span>
                        </td>
                    </tr>
                <tr>
                        <th><label for="birth-date-day">Date of Birth</label></th>
                        <td>
                            <input type="text" name="emp_dateofbirth" id="emp_dateofbirth" value="<?php echo $personal->PI_DateofBirth;?>" class="regular-text  erp-profile-date-field">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">State</label></th>
                        <td>
                           <select name="emp_statep" id="emp_statep" class="erp-select2">
						   
						   <option value="">Select </option>
							<?php 
							$selstate=$wpdb->get_results("SELECT * FROM state");
							
							foreach($selstate as $value){
							?>
							<option value="<?php echo $value->STA_Id ?>" <?php echo ($personal->STA_Id==$value->STA_Id) ? 'selected="selected"' : '';  ?> ><?php echo $value->STA_Name ?></option>
							<?php } ?>
						   
						   </select>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">City</label></th>
                        <td>
                            <select name="emp_cityp" id="emp_cityp" class="erp-select2">
							 <option>Select</option>
							  <?php 
							  //if($personal->STA_Id){
								  
							  $selcity=$wpdb->get_results("SELECT city_id, city_name FROM city");
							  
							  foreach($selcity as $value){
							  
							  ?>
							  <option value="<?php echo $value->city_id ?>" <?php echo ($personal->city_id==$value->city_id) ? 'selected="selected"' : '';  ?>><?php echo $value->city_name ?></option>
							  <?php
							  
							  }
							  
							  //}
							  
							  ?>
							</select>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">My Personal Email</label></th>
                        <td>
                             <input type="text" name="emp_mypesonalemail" id="emp_mypesonalemail" value="<?php echo $personal->PI_Email;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Meal Preference</label></th>
                        <td>
                            <input type="radio" name="emp_mealpreference" value="vegetarian"<?php if (!$personal->PI_MealPreference) echo 'checked="checked"'; else { if ($personal->PI_MealPreference=='vegetarian') echo 'checked="checked"' ;   } ?>>Vegetarian
                            <input type="radio" name="emp_mealpreference" value="non-vegetarian"<?php echo ($personal->PI_MealPreference=='non-vegetarian') ? 'checked="checked"' : ''; ?>>Non-Vegetarian
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Pincode</label></th>
                        <td>
                             <input type="text" name="emp_pincode" id="emp_pincode" value="<?php echo $personal->PI_Pincode;?>" class="regular-text">
                        </td>
                </tr>
                </table>   
				</div>
				<div id="Family" class="tabcontente" style="display:none;">
				
				 <?php $family=$wpdb->get_row("SELECT * FROM family_members WHERE EMP_Id='$empid'");?>
				 <table class="form-table">
					<tr>
                        <th><label for="birth-date-day">Name</label></th>
                        <td>
                             <input type="text" name="emp_namefamily" id="emp_namefamily" value="<?php echo $family->FM_Name;?>" class="regular-text">
                        </td>
                </tr>
				<tr>
                        <th><label for="birth-date-day">Gender</label></th>
                        <td>
                            <input type="radio" name="emp_gender" value="male"<?php if (!$family->FM_Gender) echo 'checked="checked"'; else { if ($family->FM_Gender=='male') echo 'checked="checked"' ;   } ?>>Male 
                            <input type="radio" name="emp_gender" value="female"<?php echo ($family->FM_Gender=='female') ? 'checked="checked"' : ''; ?>> Female

                        </td>
                </tr>
				<tr>
                        <th><label for="birth-date-day">Relation</label></th>
                        <td>
                            <input type="text" name="emp_nameralation" id="emp_namerelation" value="<?php echo $family->FM_Relation;?>" class="regular-text">

                        </td>
                </tr>
				<tr>
                        <th><label for="birth-date-day">Age</label></th>
                        <td>
                           <select name="emp_Age" id="emp_Age">
						   <option value="">Select</option>
							<?php
							for($i=1; $i<101; $i++){
							?>
							<option <?php echo ($family->FM_Age==$i) ? 'selected="selected"' : ''; ?> ><?php echo $i; ?></option>
							<?php }?>
						   
						   </select>

                        </td>
                </tr>
				<tr>
                        <th><label for="birth-date-day">Contact Number</label></th>
                        <td>
                              <input type="text" name="emp_namecontact" id="emp_namecontact" value="<?php echo $family->FM_Contact;?>" class="regular-text">
                        </td>
                </tr>
				 
				 </table>
				 </div>
			<div id="Medical" class="tabcontente" style="display:none;">
               
<?php $medical = $wpdb->get_row("SELECT * FROM medical_information WHERE EMP_Id = '$empid'"); ?>
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Medical Document [If Any]
Select file</label></th>
                        <td>
                            <?php //echo $rowcomp->EMP_Code; ?>
                            <?php
                            if($medical->MI_Document) {
                            ?>                                
                                <a href="<?php echo esc_url_raw( $medical->MI_Document); ?>" download="Medical Document"><input type='button' class="button-primary button" value="<?php _e( 'Download Document', 'textdomain' ); ?>"/></a>
							<br />
				<?php } ?>		
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="medical_document" id="medical_document" value="<?php echo esc_url_raw( $medical->MI_Document ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="medical_document button-primary button" value="<?php _e( 'Upload Document', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Document of Your medical', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Height</label></th>
                        <td>
                            <input type="text" name="emp_height" id="emp_height" value="<?php echo $medical->MI_Height;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Weight</label></th>
                        <td>
                            <input type="text" name="emp_weight" id="emp_weight" value="<?php echo $medical->MI_Weight;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Blood Group</label></th>
                        <td>
                            <input type="text" name="emp_bloodgroup" id="emp_bloodgroup" value="<?php echo $medical->MI_BloodGroup;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Illness [If Any]</label></th>
                        <td>
                            <input type="text" name="emp_illness" id="emp_illness" value="<?php echo $medical->MI_Illness;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Gadgets</label></th>
                        <td>
                            <input type="text" name="emp_gadgets" id="emp_gadgets" value="<?php echo $medical->MI_Gadgets;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Genetic Diseases [If Any]</label></th>
                        <td>
                            <input type="text" name="emp_geneticdiseases" id="emp_geneticdiseases" value="<?php echo $medical->MI_GeneticAbnormalities;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Allergy to Drugs [If Any]</label></th>
                        <td>
                            <input type="text" name="emp_allerytodrugs" id="emp_allerytodrugs" value="<?php echo $medical->MI_DrugAllergies;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Emergency Contact No</label></th>
                        <td>
                            <input type="text" name="emp_emergencyno" id="emp_emergencyno" value="<?php echo $medical->MI_EmergencyContactNo;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Emergency Contact Person</label></th>
                        <td>
                            <input type="text" name="emp_emergencycontactperson" id="emp_emergencycontactperson" value="<?php echo $medical->MI_EmergencyContactName;?>" class="regular-text">
                        </td>
                </tr>
                </table>
		</div>		
                 <div id="Bank" class="tabcontente" style="display:none;">
               
<?php $bank = $wpdb->get_row("SELECT * FROM bank_account_details WHERE EMP_Id = '$empid'"); ?>
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Upload / Change Passbook Image</label></th>
                        <td>
                            <?php //echo $rowcomp->EMP_Code; ?>
							 <img src="<?php echo esc_url( $bank->BAD_ImageFrontView ); ?>" style="width:150px;"><br />
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="bank_passbook_image" id="bank_passbook_image" value="<?php echo esc_url_raw( $bank->BAD_ImageFrontView ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="bank_passbook_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Passbook of Your bank', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Full Name</label></th>
                        <td>
                           <input type="text" name="emp_fullname" id="emp_fullname" value="<?php echo $bank->BAD_Fullname;?>" class="regular-text">
                        </td>
                </tr>
				<tr>
                        <th><label for="birth-date-day">Account Number</label></th>
                        <td>
                           <input type="text" name="emp_accountnumber" id="emp_accountnumber" value="<?php echo $bank->BAD_AccountNumber;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Bank Name</label></th>
                        <td>
                           <input type="text" name="emp_bankname" id="emp_bankname" value="<?php echo $bank->BAD_BankName;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Branch Name</label></th>
                        <td>
                            <input type="text" name="emp_branchname" id="emp_branchname" value="<?php echo $bank->BAD_BranchName;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Bank IFSC Code</label></th>
                        <td>
                            <input type="text" name="emp_bankifsccode" id="emp_bankifsccode" value="<?php echo $bank->BAD_BankIfscCode;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Country</label></th>
                        <td>
                            <input type="text" name="emp_countrybank" id="emp_countrybank" value="<?php echo $bank->BAD_Country;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">State</label></th>
                        <td>
                            <input type="text" name="emp_state" id="emp_state" value="<?php echo $bank->BAD_State;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued At</label></th>
                        <td>
                            <input type="text" name="emp_issuedatbank" id="emp_issuedatbank" value="<?php echo $bank->BAD_IssuedAt;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Account Type</label></th>
                        <td>
                            <input type="text" name="emp_accounttype" id="emp_accounttype" value="<?php echo $bank->BAD_AccountType;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Date</label></th>
                        <td>
                            <input type="text" name="emp_issueddatebank" id="emp_issueddatebank" value="<?php echo $bank->BAD_DateofIssue;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Nominee Name</label></th>
                        <td>
                            <input type="text" name="emp_nomineename" id="emp_nomineename" value="<?php echo $bank->BAD_NomineeName;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Nominee Relation to me</label></th>
                        <td>
                            <input type="text" name="emp_nomineerelation" id="emp_nomineerelation" value="<?php echo $bank->BAD_NomineeRelation;?>" class="regular-text">
                        </td>
                </tr>
                </table>
                </div>
                 <div id="Profile" class="tabcontente" style="display:none;">
               

           <table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Employee Code</label></th>
                        <td>
                            <?php echo $rowcomp->EMP_Code; ?>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Grade</label></th>
                        <td>
                            <?php echo $rowcomp->EG_Name; ?>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Department</label></th>
                        <td>
                            <?php echo $rowcomp->DEP_Name; ?>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Designation</label></th>
                        <td>
                            <?php echo $rowcomp->DES_Name; ?>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Reporting Manager Code</label></th>
                        <td>
                            <?php echo $rowcomp->EMP_Reprtnmngrcode; ?>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Reporting Manager Name</label></th>
                        <td>
                        <?php 
                        $code = $rowcomp->EMP_Reprtnmngrcode;
                        if ($rowsql = $wpdb->get_results("SELECT EMP_Name FROM employees WHERE EMP_Code='$code'")) {
                        ?>
                         <?php echo $rowcomp->EMP_Name; ?>
                        <?php } ?>
                        </td>
                        </tr>
                        <tr>
                        <th><label for="birth-date-day">Reporting Functional Manager Code</label></th>
                        <td>
                            <?php echo $rowcomp->EMP_Funcrepmngrcode; ?>
                        </td>
                        </tr>
                        <tr>
                        <th><label for="birth-date-day">Reporting Functional Manager Name</label></th>
                        <td>
                        <?php 
                        $code = $rowcomp->EMP_Funcrepmngrcode;
                        if ($rowsql = $wpdb->get_results("SELECT EMP_Name FROM employees WHERE EMP_Code='$code'")) {
                        ?>
                         <?php echo $rowcomp->EMP_Name; ?>
                        <?php } ?>
                        </td>
                        </tr>
                        </table></div>
                <div id="Travel" class="tabcontente" style="display:none;">
               
                <ul class="tab">
	            <li><a href="javascript:void(0)" class="tablinks active" onclick="travel(event, 'passport')">Passport</a></li>
	            <li><a href="javascript:void(0)" class="tablinks" onclick="travel(event, 'visa')">Visa</a></li>
	            <li><a href="javascript:void(0)" class="tablinks" onclick="travel(event, 'frequent')">Frequent Flyeres</a></li>
	            <li><a href="javascript:void(0)" class="tablinks" onclick="travel(event, 'driving')">Driving License</a></li>
	        </ul>
	        <div id="passport" class="tabcontent tab active">
               
                <script>
		jQuery(document).ready(function($){
		// Uploading files
		var file_frame;
		 
		  $('.passport_front_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#passport_front_image').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  
		  $('.passport_back_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#passport_back_image').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		   $('.drivinglicense_front_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#drivinglicense_front_image').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  $('.drivinglicense_back_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#drivinglicense_back_image').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  $('.visa_document').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#visa_document').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  $('.bank_passbook_image').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#bank_passbook_image').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		  $('.medical_document').on('click', function( event ){
		 
		    event.preventDefault();
		 
		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		 
		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: $( this ).data( 'uploader_title' ),
		      button: {
		        text: $( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });
		 
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      $('#medical_document').val(attachment.url);
		 
		      // Do something with attachment.id and/or attachment.url here
		    });
		 
		    // Finally, open the modal
		    file_frame.open();
		  });
		});
		</script>
		<?php $passport = $wpdb->get_row("SELECT * FROM passport_detials WHERE EMP_Id = '$empid'"); ?>
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Front View</label></th>
                        <td>
                            <?php //echo $rowcomp->EMP_Code; ?>
                            <!-- Outputs the image after save -->
		                <img src="<?php echo esc_url( $passport->PAS_ImageFrontView ); ?>" style="width:150px;"><br />
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="passport_front_image" id="passport_front_image" value="<?php echo esc_url_raw( $passport->PAS_ImageFrontView ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="passport_front_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Front View of Your Passport', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Back View</label></th>
                        <td>
                            <?php //echo $rowcomp->EG_Name; ?>
                             <!-- Outputs the image after save -->
		                <img src="<?php echo esc_url( $passport->PAS_ImageBackView ); ?>" style="width:150px;"><br />
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="passport_back_image" id="passport_back_image" value="<?php echo esc_url_raw( $passport->PAS_ImageBackView ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="passport_back_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Back View of Your Passport', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Name</label></th>
						<?php 
						$firstnamearray=explode(' ', $passport->PAS_Firstname);
						$firstname = $firstnamearray[1];
						$gender = $firstnamearray[0];
						?>
                        <td>
                           <select name="display_namepp" id="display_namepp" style="width: 50px !important; min-width: 50px; max-width: 50px;">">
					<option value="Mr." <?php if($gender=="Mr.") echo 'selected="selected"'; ?>>Mr.</option>
					<option value="Mrs." <?php if($gender=="Mrs.") echo 'selected="selected"'; ?>>Mrs.</option>
				</select>
				
				<input type="text" name="emp_namepp" id="emp_namepp" value="<?php echo $firstname;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Last Name</label></th>
                        <td>
                           <input type="text" name="emp_lastnamepp" id="emp_lastnamepp" value="<?php echo $passport->PAS_Lastname;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Date of Birth</label></th>
                        <td>
                            <input type="text" name="emp_dateofbirthpp" id="emp_dateofbirthpp" value="<?php echo $passport->PAS_Dateofbirth;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Passport No.</label></th>
                        <td>
                            <input type="text" name="emp_passportnopp" id="emp_passportnopp" value="<?php echo $passport->PAS_Passportno;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Country</label></th>
                        <td>
                           <input type="text" name="emp_countrypp" id="emp_countrypp" value="<?php echo $passport->PAS_IssuedCountry;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Place</label></th>
                        <td>
                             <input type="text" name="emp_placepp" id="emp_placepp" value="<?php echo $passport->PAS_IssuedPlace;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Date</label></th>
                        <td>
                             <input type="text" name="emp_issueddatepp" id="emp_issueddatepp" value="<?php echo $passport->PAS_IssuedDate;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
            
                <tr>
                        <th><label for="birth-date-day">Expiry Date</label></th>
                        <td>
                              <input type="text" name="emp_expirydatepp" id="emp_expirydatepp" value="<?php echo $passport->PAS_ExpiryDate;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                </table>
                </div>
                <div id="visa" class="tabcontent">
               
<?php $visa = $wpdb->get_row("SELECT * FROM visa_details WHERE EMP_Id = '$empid'"); ?>
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Visa Document</label></th>
                        <td>
                            <?php //echo $rowcomp->EMP_Code; 
                            if($visa->VD_Document) {
                            ?>                                
                                <a href="<?php echo esc_url_raw( $visa->VD_Document ); ?>" download="Visa Document"><input type='button' class="button-primary button" value="<?php _e( 'Download Document', 'textdomain' ); ?>"/></a>
							<br />
				<?php } ?>
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="visa_document" id="visa_document" value="<?php echo esc_url_raw( $visa->VD_Document ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="visa_document button-primary button" value="<?php _e( 'Upload Document', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Document of Your visa', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Download Visa Details</label></th>
                        <td>
                            <?php echo $rowcomp->EG_Name; ?>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Visa Number</label></th>
                        <td>
                             <input type="text" name="emp_visanumber" id="emp_visanumber" value="<?php echo $visa->VD_VisaNumber;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Country</label></th>
                        <td>
                            <input type="text" name="emp_country" id="emp_country" value="<?php echo $visa->VD_Country;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued At</label></th>
                        <td>
                            <input type="text" name="emp_issuedat" id="emp_issuedat" value="<?php echo $visa->VD_IssueAt;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Type of Visa</label></th>
                        <td>
                            <input type="text" name="emp_typeofvisa" id="emp_typeofvisa" value="<?php echo $visa->VD_Typeofvisa;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">No. of Entries</label></th>
                        <td>
                            <input type="text" name="emp_noofentries" id="emp_noofentries" value="<?php echo $visa->VD_NoofEntries;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Date of Issue</label></th>
                        <td>
                         <input type="text" name="emp_dateofissuevisa" id="emp_dateofissuevisa" value="<?php echo $visa->VD_DateofIssue;?>" class="regular-text erp-profile-date-field">
                      
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Expiry Date</label></th>
                        <td>
                             <input type="text" name="emp_expirydatevisa" id="emp_expirydatevisa" value="<?php echo $visa->VD_DateofExpiry;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                </table>  
                </div>
                <div id="frequent" class="tabcontent">
              
			<?php $frequent=$wpdb->get_row("SELECT * FROM frequent_flyers WHERE EMP_Id='$empid'");?>
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Airline</label></th>
                        <td>
                            <input type="text" name="emp_airlinefly" id="emp_airlinefly" value="<?php echo $frequent->FF_Airline;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Program</label></th>
                        <td>
                            <input type="text" name="emp_programfly" id="emp_programfly" value="<?php echo $frequent->FF_Program;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Frequent Flyer No.</label></th>
                        <td>
                            <input type="text" name="emp_flyernofly" id="emp_flyernofly" value="<?php echo $frequent->FF_FrequentFlyerNumber;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Card Type</label></th>
                        <td>
                           <input type="text" name="emp_cardtypefly" id="emp_cardtypefly" value="<?php echo $frequent->FF_CardType;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Date</label></th>
                        <td>
                            <input type="text" name="emp_issueddatefre" id="emp_issueddatefre" value="<?php echo $frequent->FF_DateofIssue;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Expiry Date</label></th>
                        <td>
                            <input type="text" name="emp_expirydatefre" id="emp_expirydatefre" value="<?php echo $frequent->FF_DateofExpiry;?>" class="regular-text pretraveldate">
                        </td>
                </tr>
                </table> 
                </div>
                <div id="driving" class="tabcontent">
               
           <?php $driving = $wpdb->get_row("SELECT * FROM driving_license WHERE EMP_Id = '$empid'"); ?>
           	<table class="form-table">
                <tr>
                        <th><label for="birth-date-day">Front View</label></th>
                        <td>
                            <?php //echo $rowcomp->EMP_Code; ?>
							<img src="<?php echo esc_url( $driving->DL_ImageFrontView ); ?>" style="width:150px;"><br />
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="drivinglicense_front_image" id="drivinglicense_front_image" value="<?php echo esc_url_raw( $driving->DL_ImageFrontView ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="drivinglicense_front_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Front View of Your Drivinglicense', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Back View</label></th>
                        <td>
                            <?php //echo $rowcomp->EG_Name; ?>
							<img src="<?php echo esc_url( $driving->DL_ImageBackView ); ?>" style="width:150px;"><br />
		                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
		                <input type="text" name="drivinglicense_back_image" id="drivinglicense_back_image" value="<?php echo esc_url_raw( $driving->DL_ImageBackView ); ?>" class="regular-text" />
		                <!-- Outputs the save button -->
		                <input type='button' class="drivinglicense_back_image button-primary button" value="<?php _e( 'Upload Image', 'textdomain' ); ?>" id="uploadimage"/><br />
		                <span class="description"><?php _e( 'Upload Back View of Your Drivinglicense', 'textdomain' ); ?></span>
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Name</label></th>
                        <td>
                            <input type="text" name="emp_dname" id="emp_dname" value="<?php echo $driving->DL_Firstname;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">S/W/D of</label></th>
						<?php 
						$firstnamearray1=explode(' ', $driving->DL_CareOf);
						$firstname1 = $firstnamearray1[1];
						$sex= $firstnamearray1[0];
						?>
                        <td>
                            <select name="emp_swdof" id="emp_swdof"  style="width: 50px !important; min-width: 50px; max-width: 50px;">
					<option value="S/O" <?php if($sex=="S/O") echo 'selected="selected"'; ?>>S/O</option>
					<option value="W/O" <?php if($sex=="W/O") echo 'selected="selected"'; ?>>W/O</option>
					<option value="D/O" <?php if($sex=="D/O") echo 'selected="selected"'; ?>>D/O</option>
					
				</select>
				<input type="text" name="emp_swdofname" id="emp_swdofname" value="<?php echo $firstname1 ;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Date of Birth</label></th>
                        <td>
                            <input type="text" name="emp_birthdate" id="emp_birthdate" value="<?php echo $driving->DL_Dateofbirth;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Driving License No.</label></th>
                        <td>
                           <input type="text" name="emp_drivinglicenseno" id="emp_drivinglicenseno" value="<?php echo $driving->DL_DLno;?>" class="regular-text">
                        </td>
                </tr>
                
                <tr>
                        <th><label for="birth-date-day">Issued Country</label></th>
                        <td>
                            <input type="text" name="emp_issuedcountryd" id="emp_issuedcountryd" value="<?php echo $driving->DL_IssuedCountry;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Place</label></th>
                        <td>
                           <input type="text" name="emp_issuedplaced" id="emp_issuedplaced" value="<?php echo $driving->DL_IssuedPlace;?>" class="regular-text">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Issued Date</label></th>
                        <td>
                            <input type="text" name="emp_issueddated" id="emp_issueddated" value="<?php echo $driving->DL_IssuedDate;?>" class="regular-text erp-profile-date-field">
                        </td>
                </tr>
                <tr>
                        <th><label for="birth-date-day">Expiry Date</label></th>
                        <td>
                          <input type="text" name="emp_expirydated" id="emp_expirydated" value="<?php echo $driving->DL_ExpiryDate;?>" class="regular-text pretraveldate">
                        </td>
                </tr>
                </table>      
		</div>
		</div>
                


        <?php }
        }
        /**
        * Add new fields above 'Update' button.
        *
        * @param WP_User $user User object.
        */
       function additional_profile_fields( $user ) {
           if( current_user_can( 'employee' ) || current_user_can( 'finance' )){
           global $wpdb;
           $compid = $_SESSION['compid'];
           $empid = $_SESSION['empuserid'];
           $rowcomp = $wpdb->get_row("SELECT * FROM employees emp, admin adm, department dep, designation des, employee_grades eg WHERE emp.COM_Id='$compid' AND emp.EMP_Id='$empid' AND emp.ADM_Id=adm.ADM_Id AND emp.EG_Id=eg.EG_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id");
           ?>
        
          
                        <?php
                        }
                    }
                    /**
                    * Save Custom Profile Fields
                    */
                    function my_save_extra_profile_fields( $user_id ) {
                        global $wpdb;
                        $compid = $_SESSION['compid'];
                        $empid = $_SESSION['empuserid'];
                        $rowcomp = $wpdb->get_row("SELECT * FROM employees emp, admin adm, department dep, designation des, employee_grades eg WHERE emp.COM_Id='$compid' AND emp.EMP_Id='$empid' AND emp.ADM_Id=adm.ADM_Id AND emp.EG_Id=eg.EG_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id");
                        if( current_user_can( 'employee' ) || current_user_can( 'finance' )){
                    

							/* Copy and paste this line for additional fields. Make sure to change 'paypal_account' to the field ID. */
							$wpdb->update( 'employees', array( 'EMP_Phonenumber' => $_POST['phone'], 'EMP_Phonenumber2' => $_POST['phone2']), array( 'EMP_Id' => $rowcomp->EMP_Id ));
							//update_user_meta( $user_id, 'phone', $_POST['phone'] );
							
							$emp_bank_details = $wpdb->get_row("SELECT * FROM bank_account_details WHERE EMP_Id = '$empid'");
							if($emp_bank_details)
							{
								$tablename = 'bank_account_details';
								$Bank_details_update = array(
									'BAD_Fullname' => $_POST['emp_fullname'],
									'BAD_AccountNumber' => $_POST['emp_accountnumber'],
									'BAD_BankIfscCode' => $_POST['emp_bankifsccode'],
									'BAD_BankName' => $_POST['emp_bankname'],
									'BAD_BranchName' => $_POST['emp_branchname'],
									'BAD_Country'=> $_POST['emp_countrybank'],
									'BAD_State'=> $_POST['emp_state'],
									'BAD_IssuedAt'=> $_POST['emp_issuedatbank'],
									'BAD_AccountType'=> $_POST['emp_accounttype'],
									'BAD_DateofIssue'=> $_POST['emp_issueddatebank'],
									'BAD_NomineeName'=> $_POST['emp_nomineename'],
									'BAD_NomineeRelation'=> $_POST['emp_nomineerelation'],
									'BAD_ImageFrontView'=> $_POST['bank_passbook_image'],
									'BAD_Status'=> "1",
									'BAD_UpdatedDate'=> "NOW()",
								);
								$wpdb->update($tablename, $Bank_details_update, array('EMP_Id' => $empid));
							}
							else{
								$tablename = 'bank_account_details';
								$Bank_details_insert = array(
									'EMP_Id' => $empid,
									'BAD_Fullname' => $_POST['emp_fullname'],
									'BAD_AccountNumber' => $_POST['emp_accountnumber'],
									'BAD_BankIfscCode' => $_POST['emp_bankifsccode'],
									'BAD_BankName' => $_POST['emp_bankname'],
									'BAD_BranchName' => $_POST['emp_branchname'],
									'BAD_Country'=> $_POST['emp_countrybank'],
									'BAD_State'=> $_POST['emp_state'],
									'BAD_IssuedAt'=> $_POST['emp_issuedatbank'],
									'BAD_AccountType'=> $_POST['emp_accounttype'],
									'BAD_DateofIssue'=> $_POST['emp_issueddatebank'],
									'BAD_NomineeName'=> $_POST['emp_nomineename'],
									'BAD_NomineeRelation'=> $_POST['emp_nomineerelation'],
									'BAD_ImageFrontView'=> $_POST['bank_passbook_image'],
									'BAD_Status'=> "1",
									'BAD_Date'=> "NOW()",
								);
								$wpdb->insert($tablename, $Bank_details_insert);
							}
							$frequent_flyers_details = $wpdb->get_row("SELECT * FROM frequent_flyers WHERE EMP_Id = '$empid'");
							if($frequent_flyers_details){
								
								$tablename = 'frequent_flyers';
								$frequent_flyers_update = array(
									'FF_Airline' => $_POST['emp_airlinefly'],
									'FF_Program' => $_POST['emp_programfly'],
									'FF_FrequentFlyerNumber' => $_POST['emp_flyernofly'],
									'FF_CardType' => $_POST['emp_cardtypefly'],
									'FF_DateofIssue' => $_POST['emp_issueddatefre'],
									'FF_DateofExpiry'=> $_POST['emp_expirydatefre'],
									'FF_Status'=> "1",
									'FF_UpdatedDate'=> "NOW()",
								);
								$wpdb->update($tablename, $frequent_flyers_update, array('EMP_Id' => $empid));
							}else{
								
								$tablename = 'frequent_flyers';
								$frequent_flyers_insert = array(
								    'EMP_Id' => $empid,
									'FF_Airline' => $_POST['emp_airlinefly'],
									'FF_Program' => $_POST['emp_programfly'],
									'FF_FrequentFlyerNumber' => $_POST['emp_flyernofly'],
									'FF_CardType' => $_POST['emp_cardtypefly'],
									'FF_DateofIssue' => $_POST['emp_issueddatefre'],
									'FF_DateofExpiry'=> $_POST['emp_expirydatefre'],
									'FF_Status'=> "1",
									'FF_Date'=> "NOW()",
								);
									$wpdb->insert($tablename, $frequent_flyers_insert);
							}
							
							$driving_license_details = $wpdb->get_row("SELECT * FROM driving_license WHERE EMP_Id = '$empid'");
							if($driving_license_details){
								$tablename='driving_license';
								$driving_license_update=array(
									'DL_Firstname' => $_POST['emp_dname'],
									'DL_CareOf' => $_POST['emp_swdof'] ." ". $_POST['emp_swdofname'],
									'DL_Dateofbirth' => $_POST['emp_birthdate'],
									'DL_DLno'=> $_POST['emp_drivinglicenseno'],
									'DL_IssuedCountry'=> $_POST['emp_issuedcountryd'],
									'DL_IssuedPlace'=> $_POST['emp_issuedplaced'],
									'DL_IssuedDate'=> $_POST['emp_issueddated'],
									'DL_ExpiryDate'=> $_POST['emp_expirydated'],
									'DL_ImageFrontView'=>$_POST['drivinglicense_front_image'],
									'DL_ImageBackView'=>$_POST['drivinglicense_back_image'],
									'DL_Status'=> "1",
									'DL_UpdatedDate'=> "NOW()",
								);
								$wpdb->update($tablename, $driving_license_update, array('EMP_Id' => $empid));
								
							}else{
								$tablename='driving_license';
								$driving_license_insert=array(
								    'EMP_id'=> $empid,
									'DL_Firstname' => $_POST['emp_dname'],
									'DL_CareOf' => $_POST['emp_swdof'] ." ". $_POST['emp_swdofname'],
									'DL_Dateofbirth' => $_POST['emp_birthdate'],
									'DL_DLno'=> $_POST['emp_drivinglicenseno'],
									'DL_IssuedCountry'=> $_POST['emp_issuedcountryd'],
									'DL_IssuedPlace'=> $_POST['emp_issuedplaced'],
									'DL_IssuedDate'=> $_POST['emp_issueddated'],
									'DL_ExpiryDate'=> $_POST['emp_expirydated'],
									'DL_ImageFrontView'=>$_POST['drivinglicense_front_image'],
									'DL_ImageBackView'=>$_POST['drivinglicense_back_image'],
									'DL_Status'=> "1",
									'DL_Date'=> "NOW()",
								);
								$wpdb->insert($tablename, $driving_license_insert);
							}
							
							$personal_information_details = $wpdb->get_row("SELECT * FROM personal_information WHERE EMP_Id = '$empid'");
							if($personal_information_details){
								$tablename='personal_information';
								$personal_information_update=array(
								    'PI_Gender' => $_POST['emp_genderp'],
									'PI_Email' => $_POST['emp_mypesonalemail'],
									'PI_CurrentAddress' => $_POST['emp_presentaddress'],
									'PI_MealPreference'=> $_POST['emp_mealpreference'],
									'PI_DateofBirth'=> $_POST['emp_dateofbirth'],
									'STA_Id'=> $_POST['emp_statep'],
									'city_id'=> $_POST['emp_cityp'],
									'PI_Pincode'=> $_POST['emp_pincode'],
									'PI_Status'=> "1",
									'PI_UpdatedDate'=> "NOW()",
								);
								$wpdb->update($tablename, $personal_information_update,array('EMP_id'=>$empid));
								
							}else{
								$tablename='personal_information';
								$personal_information_insert=array(
								     'EMP_id'=> $empid,
								    'PI_Gender' => $_POST['emp_genderp'],
									'PI_Email' => $_POST['emp_mypesonalemail'],
									'PI_CurrentAddress' => $_POST['emp_presentaddress'],
									'PI_MealPreference'=> $_POST['emp_mealpreference'],
									'PI_DateofBirth'=> $_POST['emp_dateofbirth'],
									'STA_Id'=> $_POST['emp_statep'],
									'city_id'=> $_POST['emp_cityp'],
									'PI_Pincode'=> $_POST['emp_pincode'],
									'PI_Status'=> "1",
									'PI_Date'=> "NOW()",
								);
									$wpdb->insert($tablename, $personal_information_insert);
							}
							
							$medical_information_details = $wpdb->get_row("SELECT * FROM medical_information WHERE EMP_Id = '$empid'");
							if($medical_information_details){
								$tablename='medical_information';
								$medical_information_update=array(
								    'MI_Height' => $_POST['emp_height'],
									'MI_Weight' => $_POST['emp_weight'],
									'MI_BloodGroup' => $_POST['emp_bloodgroup'],
									'MI_Illness' => $_POST['emp_illness'],
									'MI_Gadgets' => $_POST['emp_gadgets'],
									'MI_GeneticAbnormalities'=> $_POST['emp_geneticdiseases'],
									'MI_DrugAllergies' => $_POST['emp_allerytodrugs'],
									'MI_EmergencyContactName' => $_POST['emp_emergencycontactperson'],
									'MI_EmergencyContactNo' => $_POST['emp_emergencyno'],
									'MI_Document'=>$_POST['medical_document'],
									'MI_Status'=> "1",
									'MI_UpdatedDate'=> "NOW()",
								);
								$wpdb->update($tablename,$medical_information_update,array('EMP_id'=>$empid));
							}else{
								$tablename='medical_information';
								$medical_information_insert=array(
								    'EMP_id'=> $empid,
								    'MI_Height' => $_POST['emp_height'],
									'MI_Weight' => $_POST['emp_weight'],
									'MI_BloodGroup' => $_POST['emp_bloodgroup'],
									'MI_Illness' => $_POST['emp_illness'],
									'MI_Gadgets' => $_POST['emp_gadgets'],
									'MI_GeneticAbnormalities'=> $_POST['emp_geneticdiseases'],
									'MI_DrugAllergies' => $_POST['emp_allerytodrugs'],
									'MI_EmergencyContactName' => $_POST['emp_emergencycontactperson'],
									'MI_EmergencyContactNo' => $_POST['emp_emergencyno'],
									'MI_Document'=>$_POST['medical_document'],
									'MI_Status'=> "1",
									'MI_Date'=> "NOW()",
								);
								$wpdb->insert($tablename,$medical_information_insert);
							}
							
							$passport_detials_details = $wpdb->get_row("SELECT * FROM passport_detials WHERE EMP_Id = '$empid'");
							
							if($passport_detials_details){
		
								$tablename='passport_detials';
								
								$passport_detials_update=array(
								    'PAS_Firstname' => $_POST['display_namepp'] ." ". $_POST['emp_namepp'],
									'PAS_Lastname' => $_POST['emp_lastnamepp'],
									'PAS_Dateofbirth' => $_POST['emp_dateofbirthpp'],
									'PAS_Passportno' => $_POST['emp_passportnopp'],
									'PAS_IssuedCountry' => $_POST['emp_countrypp'],
									'PAS_IssuedPlace'=> $_POST['emp_placepp'],
									'PAS_IssuedDate' => $_POST['emp_issueddatepp'],
									'PAS_ExpiryDate' => $_POST['emp_expirydatepp'],
									'PAS_ImageFrontView' => $_POST['passport_front_image'],
									'PAS_ImageBackView' => $_POST['passport_back_image'],
									'PAS_Status'=> "1",
									'PAS_UpdatedDate'=> "NOW()",
								);
								
								$wpdb->update($tablename,$passport_detials_update,array('EMP_id'=>$empid));
							}else{
								$tablename='passport_detials';
								$passport_detials_insert=array(
								    'EMP_id'=> $empid,
								    'PAS_Firstname' => $_POST['display_namepp'] ." ". $_POST['emp_namepp'],
									'PAS_Lastname' => $_POST['emp_lastnamepp'],
									'PAS_Dateofbirth' => $_POST['emp_dateofbirthpp'],
									'PAS_Passportno' => $_POST['emp_passportnopp'],
									'PAS_IssuedCountry' => $_POST['emp_countrypp'],
									'PAS_IssuedPlace'=> $_POST['emp_placepp'],
									'PAS_IssuedDate' => $_POST['emp_issueddatepp'],
									'PAS_ExpiryDate' => $_POST['emp_expirydatepp'],
									'PAS_ImageFrontView' => $_POST['passport_front_image'],
									'PAS_ImageBackView' => $_POST['passport_back_image'],
									'PAS_Status'=> "1",
									'PAS_Date'=> "NOW()",
								);
								$wpdb->insert($tablename,$passport_detials_insert);
							}
							$emp_visa_details=$wpdb->get_row("SELECT * FROM visa_details WHERE EMP_Id='$empid'");
							if($emp_visa_details){
								$tablename='visa_details';
								$visa_details_update=array(
								    'VD_VisaNumber' => $_POST['emp_visanumber'],
									'VD_Country' => $_POST['emp_country'],
									'VD_IssueAt' => $_POST['emp_issuedat'],
									'VD_Typeofvisa' => $_POST['emp_typeofvisa'],
									'VD_NoofEntries' => $_POST['emp_noofentries'],
									'VD_DateofIssue'=> $_POST['emp_dateofissuevisa'],
									'VD_DateofExpiry' => $_POST['emp_expirydatevisa'],
									'VD_Document' => $_POST['visa_document'],
									'VD_Status'=> "1",
									'VD_UpdatedDate'=> "NOW()",
								);
								
								$wpdb->update($tablename,$visa_details_update,array('EMP_id'=>$empid));
							}else{
								$tablename='visa_details';
								$visa_details_insert=array(
									'EMP_id'=>$empid,
								    'VD_VisaNumber' => $_POST['emp_visanumber'],
									'VD_Country' => $_POST['emp_country'],
									'VD_IssueAt' => $_POST['emp_issuedat'],
									'VD_Typeofvisa' => $_POST['emp_typeofvisa'],
									'VD_NoofEntries' => $_POST['emp_noofentries'],
									'VD_DateofIssue'=> $_POST['emp_dateofissuevisa'],
									'VD_DateofExpiry' => $_POST['emp_expirydatevisa'],
										'VD_Document' => $_POST['visa_document'],
									'VD_Status'=> "1",
									'VD_Date'=> "NOW()",
								);
								$wpdb->insert($tablename,$visa_details_insert);
							}
							$family_member_details=$wpdb->get_row("SELECT * FROM family_members WHERE EMP_Id='$empid'");
							if($family_member_details){
								$tablename='family_members';
								$family_member_update=array(
								    'FM_Name' => $_POST['emp_namefamily'],
									'FM_Gender' => $_POST['emp_gender'],
									'FM_Age' => $_POST['emp_Age'],
									'FM_Contact' => $_POST['emp_namecontact'],
									'FM_Relation' => $_POST['emp_nameralation'],
									'FM_Status'=> "1",
									'FM_UpdatedDate'=> "NOW()",
								);
								$wpdb->update($tablename,$family_member_update,array('EMP_id'=>$empid));
							}else{
								$tablename='family_members';
								$family_member_insert=array(
									'EMP_id'=>$empid,
								    'FM_Name' => $_POST['emp_namefamily'],
									'FM_Gender' => $_POST['emp_gender'],
									'FM_Age' => $_POST['emp_Age'],
									'FM_Contact' => $_POST['emp_namecontact'],
									'FM_Relation' => $_POST['emp_nameralation'],
									'FM_Status'=> "1",
									'FM_Date'=> "NOW()",
								);
								$wpdb->insert($tablename,$family_member_insert);
							}
                        }
                    }
?>