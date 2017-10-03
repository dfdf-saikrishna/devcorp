<form id="flight_form" name="flight_form" action="#" method="post">
<?php if($_GET['refundable'] == 'false') 
{
?>
<div class="update-nag notice">
    <p>THIS FLIGHT TICKETS ARE NON REFUNDABLE</p>
</div>
<?php } ?>
<style>
.col-md-2, .col-md-4
{margin-bottom:10px;}
.form-group
{margin-bottom:5px;}

</style>

<div style="display:none" id="failure" align="center" class="notice notice-error is-dismissible">
	<p id="p-failure"></p>
</div>

<h3>Flight Booking</h3>
		
		<input type="hidden" value="<?php echo $_GET['traceid']; ?>" id="traceid" name="traceid">
		<input type="hidden" value="<?php echo $_GET['basefare']; ?>" id="basefare" name="basefare">
		<input type="hidden" value="<?php echo $_GET['tax']; ?>" id="tax" name="tax">
		<input type="hidden" value="<?php echo $_GET['taxbreakup']; ?>" id="taxbreakup" name="taxbreakup">
		<input type="hidden" value="<?php echo $_GET['yqtax']; ?>" id="yqtax" name="yqtax">
		<input type="hidden" value="<?php echo $_GET['ataxfeepub']; ?>" id="ataxfeepub" name="ataxfeepub">
		<input type="hidden" value="<?php echo $_GET['atransfee']; ?>" id="atransfee" name="atransfee">
		<input type="hidden" value="<?php echo $_GET['resultindex']; ?>" id="aresultindex" name="aresultindex">
		<input type="hidden" value="<?php echo $_GET['tokenid']; ?>" id="atokenid" name="atokenid">
		<input type="hidden" value="<?php echo $_GET['rdid']; ?>" id="rdid" name="rdid">
                <?php 
                global $wpdb;
                $compid = $_SESSION['compid'];
           	$empid = $_SESSION['empuserid'];
                $passport = $wpdb->get_row("SELECT * FROM passport_detials WHERE EMP_Id = '$empid'"); ?>
				
				<div class="col-md-12">
				
					<div class="col-md-9">
					
					<div class="panel panel-default">
    <div class="panel-heading">Employee Details</div>
    <div class="panel-body">
		
					<form class="form-horizontal">
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
	<div class="col-md-6">:  Rs. <?php echo $_GET['basefare']; ?></div>
	<div class="col-md-6">Tax</div>
	<div class="col-md-6">: Rs. <?php echo $_GET['tax']; ?></div>
	<div class="col-md-6">Total</div>
	<div class="col-md-6">: Rs. <?php echo $_GET['tax']+$_GET['basefare']; ?></div>
	</div>
  </div>
				
					</div>
				</div>
            
                
 