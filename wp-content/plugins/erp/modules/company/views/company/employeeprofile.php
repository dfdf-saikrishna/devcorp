<?php
global $wpdb;
$compid = $_SESSION['compid'];

$selEmployee = ( isset($_POST['employee_id']) ) ? $_POST['employee_id'] : '';
//echo $selEmployee;
$profilemanage = ( isset($_POST['profilemanage']) ) ? $_POST['profilemanage'] : '';

//$selEmployee = $_REQUEST['selEmployee'];
//echo $selEmployee;
//$profilemanage = $_REQUEST['profilemanage'];

$imdir = COMPANY_UPLOADS . '/'.$compid . '/photographs/';
$allemps = $wpdb->get_results("SELECT * FROM employees Where COM_Id='$compid' AND EMP_Status=1");
//print_r($allemps);
?>

    <form class="form-horizontal" method="POST" id="filter" name="filter" action="" data-collabel="3" data-alignlabel="left" parsley-validate enctype="multipart/form-data">
        <div class="wrap erp erp-company-employees erp-hr-company">

    <div class="erp-single-container erp-company-employees-wrap" id="erp-single-container-wrap">
        <div class="erp-area-left full-width erp-company-employees-wrap-inner">
            <div id="erp-area-left-inner">
                <div class="filter-top">
                    <div class="inside">
                        
                                <div class="col-md-5">
                                    <select id="selectEmployee" required name="employee_id" value="<?php echo $employeeview->EMP_Id; ?>" class="form-control erp-select2" tabindex="-1" aria-hidden="true">
                                    <option value="0">Search</option>
                                    <?php foreach ($allemps as $allemp) { ?>
                                        <option <?php if ($selEmployee == $allemp->EMP_Id) echo 'selected="selected"'; ?> value="<?php echo $allemp->EMP_Id; ?>"><?php echo $allemp->EMP_Code . " (" . $allemp->EMP_Name . ")"; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                
                                <div class="col-md-5">
                                    <select name="profilemanage" id="profilemanage" class="form-control erp-select2">
                                    <option value="-1">All</option>
                                    <option value="1" <?php if ($profilemanage == 1) echo 'selected="selected"'; ?> >Profile Details</option>
                                    <option value="2" <?php if ($profilemanage == 2) echo 'selected="selected"'; ?>>Family Members</option>
                                    <option value="3" <?php if ($profilemanage == 3) echo 'selected="selected"'; ?> >Driving License</option>
                                    <option value="4" <?php if ($profilemanage == 4) echo 'selected="selected"'; ?>>Bank Account Details</option>
                                    <option value="5" <?php if ($profilemanage == 5) echo 'selected="selected"'; ?>>Passport Details</option>
                                    <option value="6" <?php if ($profilemanage == 6) echo 'selected="selected"'; ?> >Visa Details</option>
                                    <option value="7" <?php if ($profilemanage == 7) echo 'selected="selected"'; ?>>Frequent Flying Details</option>
                                    <option value="8" <?php if ($profilemanage == 8) echo 'selected="selected"'; ?>>Medical Information</option>
                                </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <button type="submit" name="employeesubmit" id="employeesubmit" class="btn btn-primary btn-block">Submit</button>    
                                </div>
                    </div></div>
    </form>
    </br>
    <div class="box panel-widget-style leads-actions testpost" id="employeeview">
    <div class="inside">
    <?php
    /* -------------------------
      PERSONAL INFORMATION
      /------------------------- */
    if (($selEmployee && ($profilemanage == 1)) || ($selEmployee && ($profilemanage == -1))) {
        if ($resultd_details = $wpdb->get_results("SELECT * FRom personal_information pi, state st, city ci Where EMP_Id='$selEmployee' AND PI_Status=1 AND pi.STA_Id=st.STA_Id AND pi.city_id=ci.city_id")) {
            //print_r($resultd_details);die;
            ?>
			<div class="table-wrapper box panel-widget-style">
                 <h4 style="text-align:center">PERSONAL INFORMATION</h4>
                <table class="wp-list-table12 widefat striped admins">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>My Personal Email-Id</th>
                            <th>Meal Prefered</th>
                            <th>Present Address</th>
                            <th>State</th>
                            <th>City</th>
							<th>Pincode</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                
                                <td><?php echo $resultd_details[0]->PI_Gender ?></td>
                                <td><?php echo $resultd_details[0]->PI_DateofBirth ?></td>
                                <td><?php echo $resultd_details[0]->PI_Email ?></td>
                                <td><?php echo $resultd_details[0]->PI_MealPreference ?></td>
                                <td><?php echo $resultd_details[0]->PI_CurrentAddress ?></td>
                                <td><?php echo $resultd_details[0]->STA_Name ?></td>
								<td><?php echo $resultd_details[0]->city_name ?></td>
								<td><?php echo $resultd_details[0]->PI_Pincode ?></td>
								
                            </tr>

                    </tbody>
                </table>
            </div>
			</div></div>
            <?php
        } else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?PHP
    /* -------------------------
      FAMILY MEMBERS
      /------------------------- */

    if (($selEmployee && ($profilemanage == 2)) || ($selEmployee && ($profilemanage == -1))) {
        //echo 'sdfi';

        if ($family = $wpdb->get_results("SELECT * FRom  family_members Where EMP_Id='$selEmployee' AND FM_Status=1")) {
            ?>
           
            <br>
            <div class="table-wrapper box panel-widget-style">
                 <h4 style="text-align:center">FAMILY MEMBERS</h4>
                <table class="wp-list-table12 widefat striped admins">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Sl.No.</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Relation</th>
                            <th>Age</th>
                            <th>Contact No</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($family as $value) {
                            ?>
                            <tr>
                                <td><?php
                                    echo $i;
                                    $i++;
                                    ?></td>
                                <td><?php echo $value->FM_Name; ?></td>
                                <td><?php echo $value->FM_Gender; ?></td>
                                <td><?php echo $value->FM_Relation; ?></td>
                                <td><?php echo $value->FM_Age; ?></td>
                                <td><?php echo $value->FM_Contact; ?></td>
                                <td><?php echo date('d-M, Y', strtotime($value->FM_Date)); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
        } else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?pHP
    /* -------------------------
      DRIVING LICENSE
      /------------------------- */

    if (($selEmployee && ($profilemanage == 3)) || ($selEmployee && ($profilemanage == -1))) {

        if ($drv_lic = $wpdb->get_results("SELECT * FRom  driving_license where EMP_Id='$selEmployee' AND DL_Status=1")) {
            ?>
           
            <div id="viewDetails" class="postbox testpost">
                <table class="wp-list-table12 widefat striped admins">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Front View</th>
                            <th>Back View</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                            <tr>
                                <td>
								<?php
								if ($drv_lic[0]->DL_ImageFrontView)
									echo '<img src="' . $imdir . $drv_lic[0]->DL_ImageFrontView . '" width="100" height="100" />';
								else
									echo '<img src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" />';
								?>
								</td>
								<td>
								<?php
								if ($drv_lic[0]->DL_ImageBackView)
									echo '<img src="' . $imdir . $drv_lic[0]->DL_ImageBackView . '" width="100" height="100" />';
								else
									echo '<img src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" />';
								?>
								</td>
                    </tbody>
                </table>
				
				<table class="wp-list-table12 widefat striped admins">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Name</th>
                            <th>Son/Wife/Daughter of</th>
                            <th>Date of Birth</th>
							<th>Driving License Number</th>
							<th>Issued Country</th>
							<th>Issued Place</th>
							<th>Issued Date</th>
							<th>Expiry Date</th>
							
                        </tr>
                    </thead>
                    <tbody>
						<tr>
						<td><?php echo $drv_lic[0]->DL_Firstname ?></td>
						<td><?php echo $drv_lic[0]->DL_CareOf ?></td>
						<td><?php echo $drv_lic[0]->DL_Dateofbirth ?></td>
						<td><?php echo $drv_lic[0]->DL_DLno ?></td>
						<td><?php echo $drv_lic[0]->DL_IssuedCountry ?></td>
						<td><?php echo $drv_lic[0]->DL_IssuedPlace ?></td>
						<td><?php echo $drv_lic[0]->DL_IssuedDate ?></td>
						<td><?php echo $drv_lic[0]->DL_ExpiryDate ?></td>
						<tr>
                               
                    </tbody>
                </table>
            </div>
            <?Php
        }else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?pHP
    /* -------------------------
      BANK ACCOUNT DETAILS
      /------------------------- */


    if (($selEmployee && ($profilemanage == 4)) || ($selEmployee && ($profilemanage == -1))) {

        if ($family = $wpdb->get_results("SELECT * FRom  bank_account_details Where EMP_Id='$selEmployee' AND BAD_Status=1 ORDER BY BAD_Id DESC")) {
            ?>
            
            <br>
            <div class="table-wrapper postbox testpost" style="text-align:center">
                <h4 style="text-align:center">BANK ACCOUNT DETAILS</h4>
                <table class="wp-list-table12 widefat striped admins">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Sl.No.</th>
                            <th>Image</th>
                            <th>Account No.</th>
                            <th>Bank Name <br />
                                Branch Name</th>
                            <th>IFSC Code</th>
                            <th>Place</th>
                            <th>Account Type</th>
                            <th>Issued Date</th>
                            <th>Nominee Name</th>
                            <th>Nominee Relation</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
                        $i = 1;
                        foreach ($family as $value) {
                            ?>
                            <tr>
                                <td><?php
                                    echo $i;
                                    $i++;
                                    ?></td>
                        <td>File <span class="tooltip-area"><a href="<?php echo $imdir . $value->BAD_ImageFrontView; ?>" download="file-name" title="download"><i class="fa fa-download" ></i></a></span></td>
                        <td><?php echo $value->BAD_AccountNumber; ?></td>
                        <td><?php echo $value->BAD_BankName; ?><br />
                            <?php echo $value->BAD_BranchName; ?></td>
                        <td><?php echo $value->BAD_BankIfscCode; ?></td>
                        <td><?php echo $value->BAD_IssuedAt . ", " . $value->BAD_State . ",<br> " . $value->BAD_Country; ?></td>
                        <td><?php echo $value->BAD_AccountType; ?></td>
                        <td><?php echo $value->BAD_DateofIssue; ?></td>
                        <td><?php echo $value->BAD_NomineeName; ?></td>
                        <td><?php echo $value->BAD_NomineeRelation; ?></td>
                        <td><?php echo date('d-M, Y', strtotime($value->BAD_Date)) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <br/>
            <br/>
            <?Php
        } else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?PHP
    /* -------------------------
      PASSPORT DETAILS
      /------------------------- */


    if (($selEmployee && ($profilemanage == 5)) || ($selEmployee && ($profilemanage == -1))) {

        if ($passport = $wpdb->get_results("SELECT * FRom passport_detials Where EMP_Id='$selEmployee' AND PAS_Status=1")) {
            ?>
            
            <div id="viewDetails" class="postbox testpost">
                <h4 style="text-align:center">PASSPORT DETAILS </h4>
                <div class="col-sm-4 h4" style="text-align:center"> Front &amp; Back View :</div>
                <div class="col-sm-5 h4"  style="text-align:center">
                    <?php
                    if ($passport[0]->PAS_ImageFrontView)
                        echo '<img src="'.$passport[0]->PAS_ImageFrontView.'" width="100" height="100" />';
                    else
                        echo '<img src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" />';
                    ?>
                    <?php
                    if ($passport[0]->PAS_ImageBackView)
                        echo '<img src="'. $passport[0]->PAS_ImageBackView .'" width="100" height="100" />';
                    else
                        echo '<img src="http://1.gravatar.com/avatar/19227018b81eea78a037d9d4719f68cd?s=32&amp;d=mm&amp;r=g" />';
                    ?>
                </div>
                <div class="clearfix"></div>
                <br />
                <div style="text-align:center">First Name : <?php echo $passport[0]->PAS_Firstname ?></div>
                <br />
                <div style="text-align:center">Last Name : <?php echo $passport[0]->PAS_Lastname ?></div>
                <br />
                <div style="text-align:center">Date of Birth :<?php echo date('d/M/Y', strtotime($passport[0]->PAS_Dateofbirth)); ?></div>
                <br />
                <div style="text-align:center">Passport Number: <?php echo $passport[0]->PAS_Passportno ?></div>
                <br />
                <div style="text-align:center">Issued Country : <?php echo $passport[0]->PAS_IssuedCountry ?></div>
                <br />
                <div style="text-align:center">Issued Place : <?php echo $passport[0]->PAS_IssuedPlace ?></div><br />
                <div style="text-align:center">Issued Date : <?php echo $passport[0]->PAS_IssuedDate ?></div>
                <br />
                <div style="text-align:center">Expiry Date : <?php echo $passport[0]->PAS_ExpiryDate ?></div>
                <br />
            </div>
            <?Php
        }else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?PHP
    /* -------------------------
      VISA DETAILS
      /------------------------- */


    if (($selEmployee && ($profilemanage == 6)) || ($selEmployee && ($profilemanage == -1))) {

        if ($family = $wpdb->get_results("SELECT * FRom  visa_details where EMP_Id='$selEmployee' AND VD_Status=1 ORDER BY VD_Id DESC")) {
            ?>
          </br>
          
              <div class="table-wrapper postbox testpost" style="text-align:center">
                    <h4 style="text-align:center">VISA DETAILS</h4>
                <table class="wp-list-table12 widefat striped admins">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Visa Doc.</th>
                            <th>Visa No.</th>
                            <th>Country</th>
                            <th>Issued At</th>
                            <th>Type of Visa</th>
                            <th>No. of Entries</th>
                            <th>Date of Issue</th>
                            <th>Date of Expiry</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
                        $i = 1;
                        foreach ($family as $value) {
                            ?>
                            <tr>
                                <td><?php
                                    echo $i;
                                    $i++;
                                    ?></td>
                                <td>File <span class="tooltip-area"><a href="<?php echo $value->VD_Document; ?>" download="file-name" title="download"><i class="fa fa-download" ></i></a></span></td>
                                <td><?php echo $value->VD_VisaNumber; ?></td>
                                <td><?php echo $value->VD_Country; ?></td>
                                <td><?php echo $value->VD_IssueAt; ?></td>
                                <td><?php echo $value->VD_Typeofvisa; ?></td>
                                <td><?php echo $value->VD_NoofEntries; ?></td>
                                <td><?php echo $value->VD_DateofIssue; ?></td>
                                <td><?php echo $value->VD_DateofExpiry; ?></td>
                                <td><?php echo date('d-M, Y', strtotime($value->VD_Date)); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?Php
        } else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?pHP
    /* -------------------------
      FREQUENT FLYING  DETAILS
      /------------------------- */


    if (($selEmployee && ($profilemanage == 7)) || ($selEmployee && ($profilemanage == -1))) {

        if ($family = $wpdb->get_results("SELECT * FRom  frequent_flyers Where EMP_Id='$selEmployee' AND FF_Status=1 ORDER BY FF_Id DESC")) {
            ?>
            
            <br />
            <div class="table-wrapper postbox testpost">
                <h4 style="text-align:center">FREQUENT FLYER DETAILS</h4>
                <table class="wp-list-table12 widefat striped admins">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Airline</th>
                            <th>Program </th>
                            <th>Frequent Flyer No.</th>
                            <th>Card Type</th>
                            <th>Issued Date</th>
                            <th>Expiry Date</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
                        $i = 1;
                        foreach ($family as $value) {
                            ?>
                            <tr>
                                <td><?php
                                    echo $i;
                                    $i++;
                                    ?></td>
                                <td><?php echo $value->FF_Airline; ?></td>
                                <td><?php echo $value->FF_Program; ?></td>
                                <td><?php echo $value->FF_FrequentFlyerNumber; ?></td>
                                <td><?php echo $value->FF_CardType; ?></td>
                                <td><?php echo $value->FF_DateofIssue; ?></td>
                                <td><?php echo $value->FF_DateofExpiry; ?></td>
                                <td><?php echo date('d-M, Y', strtotime($value->FF_Date)) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?Php
        } else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
    <?php
    /* -------------------------
      MEDICAL INFORMATION
      /------------------------- */

    if (($selEmployee && ($profilemanage == 8)) || ($selEmployee && ($profilemanage == -1))) {

        if ($med_info = $wpdb->get_results("SELECT * FRom  medical_information where EMP_Id='$selEmployee' AND MI_Status=1")) {
            ?>
            <!--<header class="panel-heading sm" data-color="theme-inverse">-->
            
            <br />

            <div id="viewDetails" class="postbox testpost" style="text-align:center">
                <h4 style="text-align:center">MEDICAL INFORMATION</h4>
                <?php if ($med_info[0]->MI_Document) { ?>
                    <div class="col-sm-4 h4"> Download Medical Document :
                    <span class="tooltip-area"> <a href="<?php echo $med_info[0]->MI_Document; ?>" download="file-name"  title="download file"><i class="fa fa-download" ></i> </a> </span> </div>
                    <br />
                <?php } ?>
                <br />
                <div style="text-align:center">Height : <?php echo $med_info[0]->MI_Height ?></div>
                <br />
                <div style="text-align:center">Weight : <?php echo $med_info[0]->MI_Weight ?></div>
                <br />
                <div style="text-align:center">Blood Group : <?php echo $med_info[0]->MI_BloodGroup ?></div>
                <br />
                <div style="text-align:center">Illness [If Any] : &nbsp;&nbsp;<?php echo $med_info[0]->MI_Illness ? $med_info[0]->MI_Illness : 'NIL'; ?></div>
                <br />
                <div style="text-align:center">Gadgets [If Any]: &nbsp;&nbsp;<?php echo $med_info[0]->MI_Gadgets ? $med_info[0]->MI_Gadgets : 'NIL'; ?></div>
                <br />
                <div style="text-align:center">Genetical Disease [If Any] : &nbsp;&nbsp;<?php echo $med_info[0]->MI_GeneticAbnormalities ? $med_info[0]->MI_GeneticAbnormalities : 'NIL'; ?></div>
                <br />
                <div style="text-align:center"> Allergy to Drugs [If Any]: &nbsp;&nbsp; <?php echo $med_info[0]->MI_DrugAllergies ? $med_info[0]->MI_DrugAllergies : 'NIL'; ?></div>
                <BR/>
                <div style="text-align:center">Emergency Contact No. :  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $med_info[0]->MI_EmergencyContactName ?></div>
                <br />
                <div style="text-align:center">Emergency Contact Person :  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $med_info[0]->MI_EmergencyContactNo ?></div>
                <br />
                <br />
            </div>
            <?Php
        } else {

            echo ' <div style="text-align:center;margin: 11px 10px 10px 30px;font-size:30px;"><div class="alert alert-warning">No Records Found</div></div>';
        }
    }
    ?>
</section>
</div>
</div>

