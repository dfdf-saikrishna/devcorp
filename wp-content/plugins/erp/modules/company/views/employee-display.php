<style>
.col-md-3
{
	padding:10px;
}
</style>
<?php
global $wpdb;
$empid = $_GET['empid'];
$compid = $_SESSION['compid'];
$rowcomp = $wpdb->get_row("SELECT * FROM employees emp, admin adm, department dep, designation des, employee_grades eg WHERE emp.COM_Id='$compid' AND emp.EMP_Id='$empid' AND emp.ADM_Id=adm.ADM_Id AND emp.EG_Id=eg.EG_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id"); 
//print_r($rowcomp);die;
?>
<div class="wrap">
    <div class="inside">
        <h2><?php echo $rowcomp->EMP_Name . "'s" . " " . profile; ?></h2>
		
		<div class="row filter-top">
		<div class="col-md-12 profi">
			<div class="col-md-3 col-sm-12" style="border-right:1px dotted #cacaca; margin-bottom:20px; ">
			<?php
                        if ($rowcomp->EMP_Photo)
                            $src = '' . $rowcomp->EMP_Photo . ' " class="avatar avatar-150 photo" height="150" width="150"';
                        else
                            $src =  'http://1.gravatar.com/avatar/1f0dcc45b196508af2d8e491f1807782?s=150&d=mm&r=g" class="avatar avatar-150 photo"height="220" width="220"';
                        //echo $src;
                        ?>
			<img src="<?php echo $src; ?>"> <br >	
			<div class="row" style="padding:10px;">
			<div class="col-md-6">Added by: </div>
			<div class="col-md-6"><?php echo $rowcomp->ADM_Name; ?></div>
			<div class="col-md-6">Added on: </div>
			<div class="col-md-6"><?php echo date('d-M-Y', strtotime($rowcomp->EMP_Regdate)); ?></div>
			</div>
			</div>
			<div class="col-md-9 col-sm-12">
			<legend><h4>Employee Details</h4></legend>
				<h3><?php //echo $rowcomp->EMP_Name; ?></h3>
				<div class="col-md-3"><strong>Employee Code: </strong></div><div class="col-md-3"><?php echo $rowcomp->EMP_Code; ?></div>
				<div class="col-md-3"><strong>Grade: </strong></div><div class="col-md-3"><?php echo $rowcomp->EG_Name; ?></div>
				<div class="col-md-3"><strong>Department: </strong></div><div class="col-md-3"><?php echo $rowcomp->DEP_Name; ?></div>
				<div class="col-md-3"><strong>Designation: </strong></div><div class="col-md-3"><?php echo $rowcomp->DES_Name; ?></div>
				<div class="col-md-3"><strong>Employee Email: </strong> </div><div class="col-md-3"><?php echo $rowcomp->EMP_Email; ?></div>
				<div class="col-md-3"><strong>Employee Mobile: </strong></div><div class="col-md-3"><?php echo $rowcomp->EMP_Phonenumber; ?></div>
				<div class="col-md-3"><strong>Employee Phone: </strong></div><div class="col-md-3"><?php echo $rowcomp->EMP_Phonenumber2; ?></div><br><br>
				<div class="col-md-12"><legend><h4>Employee Manager Details</h4></legend></div>
				

				<div class="col-md-3"><strong>Reporting Manager Code: </strong></div><div class="col-md-3"><?php echo $rowcomp->EMP_Reprtnmngrcode; ?></div>
				
				<?php
					$code = $rowcomp->EMP_Reprtnmngrcode;
					if ($rowsql = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$code'")) {
				?>
				<div class="col-md-3"><strong>Reporting Manager Name: </strong></div><div class="col-md-3"><?php echo $rowsql->EMP_Name; ?></div>
				<?php } ?>
				<div class="col-md-3"><strong>Functional Reporting Manager Code: </strong></div><div class="col-md-3"><?php echo $rowcomp->EMP_Funcrepmngrcode; ?></div>
				<?php
					$code = $rowcomp->EMP_Funcrepmngrcode;
					if ($rowsql = $wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$code'")) {
				?>
				<div class="col-md-3"><strong>Functional Reporting Manager Name: </strong></div><div class="col-md-3"><?php echo $rowsql->EMP_Name; ?></div>
				<?php } ?>
			
			</div>
			</div>
		</div>
        </div>
    </form>


    <!-- //content-->
    </div>

