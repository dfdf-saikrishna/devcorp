<?php 
global $wpdb;
$empdetails = $wpdb->get_row("SELECT * FROM employees emp, company com, personal_information pi WHERE emp.EMP_Id='$empid' AND emp.COM_Id=com.COM_Id AND emp.EMP_Id=pi.EMP_Id and PI_Status =1");

			  ?>

<div class="table-responsive">
  <table class="table table-hover" style="width:50%">
    <thead>
      <tr>
        <th colspan="6" style="text-align:left">Employee Details</th>
      </tr>
    </thead>
    <tr>
      <td width="20%">Company Name</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo stripslashes($empdetails->COM_Name); ?></td>
    </tr>
    <tr>
      <td width="20%">Employee Code</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo $empdetails->EMP_Code; ?></td>
    </tr>
    <tr>
      <td width="20%">Employee Name</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo $empdetails->EMP_Name; ?></td>
    </tr>
    <tr>
      <td width="20%">Gender</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo $empdetails->PI_Gender; ?></td>
    </tr>
    <tr>
      <td width="20%">Date of Birth</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo date('d-m-Y', strtotime($empdetails->PI_DateofBirth)); ?></td>
    </tr>
    <tr>
      <td width="20%">Employee Email</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo $empdetails->EMP_Email; ?></td>
    </tr>
    <tr>
      <td width="20%">Employee Mobile</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo $empdetails->EMP_Phonenumber; ?></td>
    </tr>
    <tr>
      <td width="20%">Meal Preference</td>
      <td width="5%">:</td>
      <td width="25%"><?php echo $empdetails->PI_MealPreference; ?></td>
    </tr>
  </table>
  <?php 
  
  
  //echo 'req='.$row['REQ_Method'];
  
  if($row->REQ_Method == 'international'){ 
  
    $psprtrow = $wpdb->get_row("SELECT PAS_ImageFrontView as psprtfrontview, PAS_ImageBackView as psprtbackview, PAS_Passportno as passno, PAS_IssuedCountry as issudcntry, PAS_IssuedPlace as issudplc, PAS_IssuedDate as issuddate, PAS_ExpiryDate as expirydate FROM employees emp LEFT JOIN  passport_detials pd ON emp.EMP_Id = pd.EMP_Id AND EMP_Status = 1 AND PAS_Status = 1 WHERE emp.EMP_Id = $row[EMP_Id] AND emp.COM_Id = $compid");
  
  	
  ?>
  <table class="table" style="width:50%;">
    <thead>
      <tr>
        <th colspan="3" style="text-align:left">Employee Passport Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td width="20%">Passport Front View</td>
        <td width="5%">:</td>
        <td width="25%"><a class="btn-link" href="download-file.php?file=<?php echo "../company/upload/$compid/photographs/".$psprtrow->psprtfrontview; ?>"><?php echo 'view/download'; ?></a></td>
      </tr>
      <tr>
        <td width="20%">Passport Back View</td>
        <td width="5%">:</td>
        <td width="25%"><a class="btn-link" href="download-file.php?file=<?php echo "../company/upload/$compid/photographs/".$psprtrow->psprtbackview; ?>"><?php echo 'view/download'; ?></a></td>
      </tr>
      <tr>
        <td width="20%">Passport Number</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $psprtrow->passno ?></td>
      </tr>
      <tr>
        <td width="20%">Issued Country</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $psprtrow->issudcntry ?></td>
      </tr>
      <tr>
        <td width="20%">Issued Place</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $psprtrow->issudplc ?></td>
      </tr>
      <tr>
        <td width="20%">Issued Date</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo str_replace("/", "-", $psprtrow->issuddate); ?></td>
      </tr>
      <tr>
        <td width="20%">Expiry Date</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo date('d-m-Y', strtotime($psprtrow->expirydate)); ?></td>
      </tr>
    </tbody>
  </table>
  <?php 
  
  $visarow=$wpdb->get_row("SELECT * FROM visa_details WHERE VD_Id = $row->VD_Id");
  
  
  
  
  ?>
  <table class="table" style="width:50%;">
    <thead>
      <tr>
        <th colspan="3" style="text-align:left">Employee Visa Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td width="20%">Visa Document</td>
        <td width="5%">:</td>
        <td width="25%"><a class="btn-link" href="download-file.php?file=<?php echo "../company/upload/$compid/photographs/".$visarow->VD_Document; ?>"><?php echo 'view/download'; ?></a></td>
      </tr>
      <tr>
        <td width="20%">Visa Number</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $visarow->VD_VisaNumber ?></td>
      </tr>
      <tr>
        <td width="20%">Issued Country</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $visarow->VD_Country ?></td>
      </tr>
      <tr>
        <td width="20%">Issued Place</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $visarow->VD_IssueAt ?></td>
      </tr>
      <tr>
        <td width="20%">Visa Type</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $visarow->VD_Typeofvisa ?></td>
      </tr>
      <tr>
        <td width="20%">No. Of Entries</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo $visarow->VD_NoofEntries ?></td>
      </tr>
      <tr>
        <td width="20%">Issued Date</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo str_replace("/", "-", $visarow->VD_DateofIssue); ?></td>
      </tr>
      <tr>
        <td width="20%">Expiry Date</td>
        <td width="5%">:</td>
        <td width="25%"><?php echo date('d-m-Y', strtotime($visarow->VD_DateofExpiry)); ?></td>
      </tr>
    </tbody>
  </table>
  <?php
  
  } 
  
  
  ?>
</div>