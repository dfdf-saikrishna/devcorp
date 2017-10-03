<html>
<head>

    <link rel="stylesheet" href="css/generateForm.css" />
<style>
.col-md-2, .col-md-4
{margin-bottom:10px;}
.form-group
{margin-bottom:5px;}

</style>
</head>
<body>

<?php/*
    include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthStore.php';

    include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/library/OAuthRequester.php';

    include_once WPERP_EMPLOYEE_PATH . '/includes/BUS/SSAPICaller.php';
     
echo "<form method='GET' action='block_req.php' name='form4' onSubmit=''>";
echo "<h3>CUSTOMER INFORMATION</h3>";    
    $chosenbusid=$_GET['chosenbus'];
$sourceid=$_GET['chosensource'];
$destinationid=$_GET['chosendestination'];
$boardingpointid=$_GET['boardingpointsList'];
$checkbox_no=sizeof($_GET['chkchk']);
$boardingpointid=$_GET['boardingpointsList'];
$seatschosen=$_GET['seatnames'];



for ($i=0; $i <$checkbox_no ; $i++) 
{ 
	echo "Title:<select name='Title".$i."' class='input2' >
                    <option value='-1'>-- select --</option>
                    <option value='Mr'>Mr.</option>
                    <option value='Mrs'>Mrs.</option>
                    <option value='Ms'>Ms.</option>
                </select>&nbsp&nbsp";
	echo " Name".($i+1).":<input type='text' name='fname".$i."' class='input2'>&nbsp&nbsp&nbsp&nbsp<tab align=right>Gender".($i+1).":<input type='radio' name='sex".$i."' class='input2' value='male'>Male<input type='radio' name='sex".$i."' value='female'>Female &nbsp&nbsp&nbsp&nbsp ";
	echo "&nbsp&nbsp&nbsp&nbspAge".($i+1).":<input type='text' name='age".$i."' class='input2'><br>";

}
    
echo "<hr>";    
 
echo "<h4 align='left'>Contact Details</h4>";
echo "<label for='mobile'>Mobile No.:</label><input type='text' name='mobile'class='input2'><br>";

echo "<label for='email_id'>Email id:</label><input type=text' name='email_id' class='input2'><br>";
echo "<label for='address'>Address:</label><textarea name='address' class='input2'></textarea><br>";
echo "<label for='id_no'>Id-no.:</label><input type='text' name='id_no' class='input2'><br>";
echo "<label for='id_proof'>ID Proof Type:</label><select name='id_proof' class='input2'>
                    <option value='-1'>-- select --</option>
                    <option value='Pan Card'>Pan Card</option>
                    <option value='Driving Licence'>Driving Licence</option>
                    <option value='Voting Card'>Voting Card</option>
                    <option value='Aadhar Card'>Aadhar Card</option>
                </select><br>";

echo "<input type='hidden' name='chosensource' class='btnclass' value='".$sourceid."'/>";
echo "<input type='hidden' name='chosendestination' class='btnclass' value='".$destinationid."'/>";      
echo "<input type='hidden' name='chosenbus' class='btnclass' value='".$chosenbusid."' /></td>";
echo "<input type='hidden' name='boardingpointsList' class='btnclass' value='".$boardingpointid."' /></td>";
echo "<input type='hidden' name='chkchk' class='btnclass' value='".$checkbox_no."' /></td>";
echo "<input type='hidden' name='seatnames' class='btnclass' value='".$seatschosen."' /></td>";


echo "<label>&nbsp;</label><input type='submit' value='SUBMIT' class='submit'>";*/
    
    ?>
<h3>Bus Booking</h3>


		
		
                <?php 
                global $wpdb;
                $compid = $_SESSION['compid'];
           	$empid = $_SESSION['empuserid'];
           	$rdid = $_GET['rdid'];
                $passport = $wpdb->get_row("SELECT * FROM passport_detials WHERE EMP_Id = '$empid'"); ?>
                
               <div class="col-md-12">
				
					<div class="col-md-9">
					
					<div class="panel panel-default">
    <div class="panel-heading">Employee Details</div>
    <div class="panel-body">
		
	<form id="bus_form" name="bus_form" action="#" method="post">
<fieldset>

<!-- Form Name -->

<!-- Text input-->
<div class="form-group">
  <div class="col-md-2"><label class=" control-label" for="textinput">First Name</label> </div> 
  <?php 
	$firstnamearray=explode(' ', $passport->PAS_Firstname);
	$firstname = $firstnamearray[1];
	$gender = $firstnamearray[0];
  ?>
  <div class="col-md-4">
  <div class="input-group">
    <select name="display_namepp" id="display_namepp" class="form-control">
					<option value="Mr" <?php if($gender=="Mr.") echo 'selected="selected"'; ?>>Mr.</option>
					<option value="Mrs" <?php if($gender=="Mrs.") echo 'selected="selected"'; ?>>Mrs.</option>
				</select>
    <span class="input-group-addon"></span>
    <input type="text" name="emp_namepp" id="emp_namepp" value="<?php echo $firstname;?>" value="<?php echo $firstname;?>" class="form-control input-md">
</div>
  
  </div>
  
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Last Name</label>  
  <div class="col-md-4">
  <input type="text" name="emp_lastnamepp" id="emp_lastnamepp" value="<?php echo $passport->PAS_Lastname;?>"  class="form-control input-md">
    
  </div>
</div>




<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Passport No</label>  
  <div class="col-md-4">
  <input type="text" name="emp_passportnopp" id="emp_passportnopp" value="<?php echo $passport->PAS_Passportno;?>" class="form-control input-md">
    
  </div>
</div>

<div class="form-group">
<div class="col-md-2"><label class="control-label" for="textinput">Expiry Date </label>  </div>
  <div class="col-md-4">
  <input id="textinput" name="emp_expirydatepp" type="text" value="<?php echo $passport->PAS_ExpiryDate;?>" class="form-control input-md erp-profile-date-field">
    </div>
  </div>
  
  
 

<?php $personal=$wpdb->get_row("SELECT * FROM personal_information WHERE EMP_Id='$empid'");?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Gender</label>  
  <div class="col-md-4">
  <label class="radio-inline">
      <input type="radio" name="emp_genderp" value="1"<?php if (!$personal->PI_Gender) echo 'checked="checked"'; else { if ($personal->PI_Gender=='male') echo 'checked="checked"' ;   } ?>>Male
    </label>
	<label class="radio-inline">
      <input type="radio" name="emp_genderp" value="2"<?php echo ($personal->PI_Gender=='female') ? 'checked="checked"' : ''; ?>>Female
    </label>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Address</label>  
  <div class="col-md-4">
  <input type="text" name="emp_presentaddress" id="emp_presentaddress" value="<?php echo $personal->PI_CurrentAddress;?>" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Date of Birth</label>  
  <div class="col-md-4">
  <input type="text" name="emp_dateofbirth" id="emp_dateofbirth" value="<?php echo $personal->PI_DateofBirth;?>" class="form-control input-md erp-profile-date-field">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">State</label>  
  <div class="col-md-4">
 <select name="emp_statep" id="emp_statep" class="erp-select2">
						   
						   <option value="">Select </option>
							<?php 
							$selstate=$wpdb->get_results("SELECT * FROM state");
							
							foreach($selstate as $value){
							?>
							<option value="<?php echo $value->STA_Id ?>" <?php echo ($personal->STA_Id==$value->STA_Id) ? 'selected="selected"' : '';  ?> ><?php echo $value->STA_Name ?></option>
							<?php } ?>
						   
						   </select>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">City</label>  
  <div class="col-md-4">
  <select name="emp_cityp" id="emp_cityp" class="erp-select2 input-md">
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
    
  </div>
</div>

 <?php
                $rowcomp = $wpdb->get_row("SELECT * FROM employees emp, admin adm, department dep, designation des, employee_grades eg WHERE emp.COM_Id='$compid' AND emp.EMP_Id='$empid' AND emp.ADM_Id=adm.ADM_Id AND emp.EG_Id=eg.EG_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id");
                ?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Contact</label>  
  <div class="col-md-4">
  <input type="text" name="phone" id="phone" value="<?php echo $rowcomp->EMP_Phonenumber; ?>" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Email</label>  
  <div class="col-md-4">
 <input  type="text" name="emp_email" id="emp_email" value="<?php echo $rowcomp->EMP_Email; ?>"  class="form-control input-md">
  </div>
</div>

<!-- Text input-->

<input type="hidden" name="action" id="booking-reserve" value="booking-reserve">

<!-- Button -->
<div class="form-group">
  <label class="col-md-6 control-label" for="singlebutton"></label>
  <div class="col-md-6 pull-right">
   <input type="submit" name="submit" id="submit-flight-form" class="btn btn-primary">
  </div>
</div>

</fieldset>
</form>
	</div>
  </div>
					</div>
					
					
					<div class="col-md-3">
					<div class="panel panel-default">
    <div class="panel-heading">Fare Details</div>
    <div class="panel-body">
	<div class="col-md-6">BaseFare</div>
	<div class="col-md-6">:  Rs. 600</div>
	<div class="col-md-6">Tax</div>
	<div class="col-md-6">: Rs. 50</div>
	<div class="col-md-6">Total</div>
	<div class="col-md-6">: Rs. 650</div>
	</div>
  </div>
				
					</div>
				</div>




 </body>
 </html>