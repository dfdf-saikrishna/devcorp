<?php 

//ini_set("display_errors",1);
//ini_set("display_startup_errors",1);
//error_reporting(-1);
error_reporting(0);
session_start();
$tduserid		=	$_SESSION['ncorptneuserid'];
$TD_Username	=	$_SESSION['ncorptneusername'];
$compid			=	$_SESSION['compid'];
$sessionid		=	$_SESSION['ncorptneSessionid'];
$id				=	$_GET['id'];
$app			=	$_SESSION['app'];

$itr			=	$_GET['itr'];


if(!$tduserid)die('plum');


require("../function.php");
?>

<div class="clearfix"></div>
<p>&nbsp;</p>
<div class="col-lg-12" id="employeeDiv<?php echo $itr; ?>">
  <div class="form-group">
    <label class="control-label col-sm-2 col-lg-2" for="email">Employee Code:</label>
    <div class="col-sm-4 col-lg-3">
      <input type="text" class="form-control grpempcode" onkeyup="clearForm(<?php echo $itr; ?>)"  name="txtGrpEmpCode<?php echo $itr; ?>" id="txtGrpEmpCode<?php echo $itr; ?>" maxlength="30" >
      <small class="text-danger">*Please dont add employee prefix</small> </div>
    <div class="col-sm-4 col-lg-3">
      <button type="button" name="buttonGrpFindEmployee<?php echo $itr; ?>" id="buttonGrpFindEmployee<?php echo $itr; ?>" onclick="findDetails(<?php echo $itr; ?>)" value="<?php echo $itr; ?>" class="btn btn-primary">Find Details</button>
	  
	  <?php if($itr > 2) { ?>
    <button class="btn btn-danger" type="button" name="removeButton<?php echo $itr; ?>" id="removeButton<?php echo $itr; ?>" value="<?php echo $itr; ?>" onclick="removeFunc(<?php echo $itr; ?>)">- Remove </button>
    <?php }?>
	  
    </div>
  </div>
  <div class="clearfix"></div>
  <p>&nbsp;</p>
  <div id="employeedetails<?php echo $itr; ?>" style="display:none;">
    <div class="col-lg-8">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th colspan="3" style="text-align:left">Employee Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="30%">Employee Name</td>
              <td width="5%">:</td>
              <td id="employeeName<?php echo $itr; ?>" width=""></td>
            </tr>
            <tr>
              <td>Email</td>
              <td width="5%">:</td>
              <td id="employeeEmail<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>Mobile</td>
              <td width="5%">:</td>
              <td id="employeeMobile<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>DOB</td>
              <td width="5%">:</td>
              <td id="employeeDob<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>Gender</td>
              <td width="5%">:</td>
              <td id="employeeGender<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>Meal Preference</td>
              <td width="5%">:</td>
              <td id="employeeMealPrf<?php echo $itr; ?>"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <p>&nbsp;</p>
  <div id="employeeDetailsNew<?php echo $itr; ?>" style="display:none;" >
    <div class="form-group">
      <label class="control-label col-sm-2" >Employee Name:</label>
      <div class="col-lg-6">
        <input type="text" class="form-control newEmp<?php echo $itr; ?>" id="txtEmpName<?php echo $itr; ?>" name="txtEmpName<?php echo $itr; ?>"  maxlength="50">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Email:</label>
      <div class="col-lg-6">
        <input type="text" class="form-control newEmp<?php echo $itr; ?>" id="txtEmail<?php echo $itr; ?>" name="txtEmail<?php echo $itr; ?>"    maxlength="50">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Mobile:</label>
      <div class="col-lg-6">
        <input type="text" class="form-control newEmp<?php echo $itr; ?>" id="txtMobile<?php echo $itr; ?>" name="txtMobile<?php echo $itr; ?>"  >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >DOB:</label>
      <div class="col-lg-6">
        <input type="text" class="form-control dob newEmp<?php echo $itr; ?>" id="txtDob<?php echo $itr; ?>" name="txtDob<?php echo $itr; ?>"  >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Gender:</label>
      <div class="col-lg-6">
        <input type="radio"   id="radGender<?php echo $itr; ?>" name="radGender<?php echo $itr; ?>" value="male" checked="checked">
        Male
        <input type="radio"   id="radGender<?php echo $itr; ?>" name="radGender<?php echo $itr; ?>" value="female" >
        Female </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Meal Preference:</label>
      <div class="col-lg-6">
        <input type="radio"   id="radMealPrf<?php echo $itr; ?>" name="radMealPrf<?php echo $itr; ?>" value="vegetarian" checked="checked">
        vegetarian
        <input type="radio"   id="radMealPrf<?php echo $itr; ?>" name="radMealPrf<?php echo $itr; ?>" value="non-vegetarian" >
        non-vegetarian </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <p>&nbsp;</p>
  <div id="empPassportDetails<?php echo $itr; ?>" style="display:none;">
    <div class="col-lg-8">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th colspan="3" style="text-align:left">Employee Passport Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="30%">Passport Front View</td>
              <td width="5%">:</td>
              <td id="empPassportFrontView<?php echo $itr; ?>" width=""></td>
            </tr>
            <tr>
              <td width="30%">Passport Back View</td>
              <td width="5%">:</td>
              <td id="empPassportBackView<?php echo $itr; ?>" width=""></td>
            </tr>
            <tr>
              <td width="30%">Passport Number</td>
              <td width="5%">:</td>
              <td id="empPassportNo<?php echo $itr; ?>" width=""></td>
            </tr>
            <tr>
              <td>Issued Country</td>
              <td width="5%">:</td>
              <td id="empIssuedCountry<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>Issued Place</td>
              <td width="5%">:</td>
              <td id="empIssuedPlace<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>Issued Date</td>
              <td width="5%">:</td>
              <td id="empIssuedDate<?php echo $itr; ?>"></td>
            </tr>
            <tr>
              <td>Expiry Date</td>
              <td width="5%">:</td>
              <td id="empExpiryDate<?php echo $itr; ?>"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <p>&nbsp;</p>
  <div id="empPassprtDetailsNew<?php echo $itr; ?>" style="display:none;">
    <div class="page-header col-lg-6">
      <h3>Employee's Passport Details</h3>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Front View</label>
      <div>
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
          <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Select image </span><span class="fileinput-exists">Change</span>
            <input type="file" name="fileFrontView<?php echo $itr; ?>" class="pptclass<?php echo $itr; ?>" id="fileFrontView<?php echo $itr; ?>" onchange="checkFileUpload(this.id, 1)">
            </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
        </div>
        <!-- //fileinput-->
        <?php 
						
						$fileexts=select_all("file_extensions", "*", "FE_Type=1", $filename, 0);
						
						$fe = null;
						
						foreach($fileexts as $value)
						$fe.=$value['FE_Name'].",";
						
						$fe=rtrim($fe,",");
						?>
        <span class="help-block"><a>Only <?php echo $fe; ?> file types allowed, upto 2mb size</a><i class="fa fa-info"></i></span> </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Back View</label>
      <div>
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
          <div> <span class="btn btn-default btn-file"> <span class="fileinput-new">Select image </span><span class="fileinput-exists">Change</span>
            <input type="file" name="fileBackView<?php echo $itr; ?>" class="pptclass<?php echo $itr; ?>" id="fileBackView<?php echo $itr; ?>" onchange="checkFileUpload(this.id, 1)">
            </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
        </div>
        <!-- //fileinput-->
        <span class="help-block"><a>Only <?php echo $fe; ?> file types allowed, upto 2mb size</a><i class="fa fa-info"></i></span> </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Passport No.</label>
      <div class="col-lg-6">
        <input type="text" name="txtPassportno<?php echo $itr; ?>" id="txtPassportno<?php echo $itr; ?>" class="form-control pptclass<?php echo $itr; ?>"  maxlength="30"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2"  title="Issued Country">Issued Country</label>
      <div class="col-lg-6">
        <input type="text" name="txtIssuedCountry<?php echo $itr; ?>" id="txtIssuedCountry<?php echo $itr; ?>" class="form-control pptclass<?php echo $itr; ?>"  maxlength="30"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Issued Place</label>
      <div class="col-lg-6">
        <input type="text" name="txtIssuedplc<?php echo $itr; ?>" id="txtIssuedplc<?php echo $itr; ?>" class="form-control pptclass<?php echo $itr; ?>"  maxlength="30"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Issued Date</label>
      <div class="col-lg-6">
        <input type="text" readonly="readonly" name="txtIssuedDAte<?php echo $itr; ?>" id="txtIssuedDAte<?php echo $itr; ?>" class="form-control issueddate pptclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Expiry Date</label>
      <div class="col-lg-6">
        <input name="txtExpiryDate<?php echo $itr; ?>" id="txtExpiryDate<?php echo $itr; ?>" readonly="readonly"  class="form-control expirydate pptclass<?php echo $itr; ?>"  />
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <p>&nbsp;</p>
  <div id="empVisaDetailsNew<?php echo $itr; ?>" style="display:none;">
    <div class="page-header col-lg-6">
      <h3>Employee's Visa Details</h3>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Visa Document</label>
      <div>
        <div id="fileDiv">
          <div>
            <div class="fileinput fileinput-new" data-provides="fileinput"> <span class="btn btn-default btn-file"> <span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
              <input type="file" name="fileComplogo<?php echo $itr; ?>" class="visaclass<?php echo $itr; ?>" id="fileComplogo<?php echo $itr; ?>" onchange="checkFileUpload(this.id, 'pdfOnly')" >
              </span> <span class="fileinput-filename"></span> <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a> </div>
            <!-- //fileinput-->
            <?php 
						
						$fileexts=select_all("file_extensions", "*", "FE_Id=12", $filename, 0);
						
						$fe = null;
						
						foreach($fileexts as $value)
						$fe.=$value['FE_Name'].",";
						
						$fe=rtrim($fe,",");
						?>
            <span class="help-block"><a>Only <?php echo $fe; ?> file types allowed, upto 2mb size</a><i class="fa fa-info"></i></span> </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Visa Number</label>
      <div class="col-lg-6">
        <input type="text" name="txtVisa<?php echo $itr; ?>" id="txtVisa<?php echo $itr; ?>" class="form-control visaclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Country</label>
      <div class="col-lg-6">
        <input type="text" name="txtCountry<?php echo $itr; ?>" id="txtCountry<?php echo $itr; ?>" class="form-control visaclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Issued At</label>
      <div class="col-lg-6">
        <input type="text" name="txtIssuedAt<?php echo $itr; ?>" id="txtIssuedAt<?php echo $itr; ?>" class="form-control visaclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Type of Visa</label>
      <div class="col-lg-6">
        <input type="text" name="txtTypeofvisa<?php echo $itr; ?>" id="txtTypeofvisa<?php echo $itr; ?>" class="form-control visaclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >No. of Entries</label>
      <div class="col-lg-6">
        <input type="text" name="txtNoofEntries<?php echo $itr; ?>" id="txtNoofEntries<?php echo $itr; ?>" class="form-control visaclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Date of Issue</label>
      <div class="col-lg-6">
        <input type="text" readonly="true" name="txtDateofIssue<?php echo $itr; ?>" id="txtDateofIssue<?php echo $itr; ?>" class="form-control issueddate visaclass<?php echo $itr; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Expiry Date</label>
      <div class="col-lg-6">
        <input type="text" name="txtDateofExpiry<?php echo $itr; ?>" id="txtDateofExpiry<?php echo $itr; ?>" class=" form-control expirydate visaclass<?php echo $itr; ?>" readonly="true"  onkeydown="return false;"/>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <p>&nbsp;</p>
  <div class="col-lg-6 text-right" id="addmore<?php echo $itr; ?>" style="display:none;">
    <button class="btn btn-palevioletred" type="button" name="addmorebutton<?php echo $itr; ?>" id="addmorebutton<?php echo $itr; ?>" value="<?php echo $itr; ?>" onclick="addmore(<?php echo $itr; ?>)">+ Add More</button>
    
  </div>
</div>
<div class="clearfix"></div>
<p>&nbsp;</p>
