<?php
global $wpdb;
$compid = $_SESSION['compid'];
//$gradeid = $_GET['egid'];
$allcat = ( isset($_GET['allcat']) ) ? $_GET['allcat'] : '';
$grades = ( isset($_GET['grades']) ) ? $_GET['grades'] : '';
global $query;
global $query2;
global $cat;
global $grades;
?>

<div class="postbox testpost">
    <div class="inside filter-top">
    <?php
    if(isset($_GET['grades'])){
    	$grades = $_GET['grades'];
    	$query.=" AND EG_Id='$_GET[grades]'";
    }
    else{
    	$query = '';
    	$grades = '';
    }
    if(isset($_GET['allcat'])){
    	$cat = $_GET['allcat'];
    	$query2.=" AND EC_Id='$_GET[allcat]'";
    }
    else{
    	$query2 = '';
    	$cat = '';
    }
    $selcom = $wpdb->get_results("SELECT * From employee_grades Where COM_Id='$compid' AND EG_Status=1 $query ORDER BY EG_Id DESC");
    if ($selcom) {
        ?>
        <div class="inside" >
            <form method="post" name="formlimits" id="formlimits">
                <div class="row">
                    <div class="col-md-5">
                        <select  class="form-control" data-size="5" data-live-search="true" name="grades" id="grades">
                    <option value=""> Grades </option>
                    <?php
                    $seldrop = $wpdb->get_results("SELECT * From employee_grades Where COM_Id='$compid' AND EG_Status=1 ORDER BY EG_Id DESC");
                    foreach ($seldrop as $value) {
                        ?>
                        <option value="<?php echo $value->EG_Id ?>" <?php echo ($grades == $value->EG_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->EG_Name ?></option>
                    <?php } ?>
                </select>
                    </div>
                    
                    <div class="col-md-5">
                        <select  class="form-control" data-size="5" data-live-search="true" name="allcat" id="allcat">
                    <option value="all">All Expense Categories </option>
                    
                    <?php
                    $selmodes = $wpdb->get_results("SELECT * FROM expense_category where EC_Id IN (1,2,3,4)");
                    foreach ($selmodes as $value) {
                        ?>
                        <option value="<?php echo $value->EC_Id ?>" <?php echo ($allcat == $value->EC_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->EC_Name ?></option>
                    <?php } ?>
                </select>
                    </div>
                    
                    <div class="col-md-2">
                         <input type="submit" class="btn btn-primary btn-block sam" value="Search" id="gradessearch"/>
                    </div>
                    
                </div>
            <div style="text-align:center">
                
                
              
            </div></div></div>
                </form>
            <div class="list-table-wrap erp-company-gradecat-wrap" style="font-size: 13px;">
                <div class="list-table-inner erp-company-gradecat-wrap-inner postbox testpost">
                   
                   <?php if($cat == '1' || $cat == 'all'){ ?>
                    <table  class="wp-list-table widefat striped admins" style="margin-bottom: 15px;" >
                        
                        <thead>
                            <h3 class="inside" style="margin:0px 0px 0px -5px;font-size: 1.1em !important;"><?php _e('Travel Category Limits', 'erp'); ?> </h3>
                            <tr>
                                <th width="">Sl.No.</th>
                                <th width="">Grade</th>
                                <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=1 AND COM_Id IN (0, $compid) AND MOD_Status=1");
                                foreach ($selmodes as $value) {
                                    ?>
                                    <th width=""><?php echo $value->MOD_Name; ?></th>
                                <?php } ?>
                            </tr>                                                        
                        </thead>
                        <tbody align="">
                            <?php
                            $i = 1;
                            foreach ($selcom as $rowcom) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td> <?php echo $rowcom->EG_Name; ?>&nbsp;<br/> <a href="#" id="gradelimitadd" data-id="<?php echo $rowcom->EG_Id ?>" title="Edit Grade Limits">Edit</a></td>
                                    <?php
                                    $egid = $rowcom->EG_Id;
                                    //echo $egid;
                                    if ($rowsum = $wpdb->get_row("SELECT * FROM  grade_limits where EG_Id='$egid' AND GL_Status=1")) {
                                        ?>
                                        <td><?php echo $rowsum->GL_Flight ? IND_money_format($rowsum->GL_Flight) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_Bus ? IND_money_format($rowsum->GL_Bus) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_Car ? IND_money_format($rowsum->GL_Car) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_Others_Travels ? IND_money_format($rowsum->GL_Others_Travels) : 0; ?></td> 
 <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=1 AND COM_Id='$compid' AND MOD_Status=1");
                                foreach ($selmodes as $value) { 
                                $subGradeLimits = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE MOD_Id = $value->MOD_Id AND EG_Id = $egid");
                                ?>
                                    <td width=""><?php echo $subGradeLimits->Limit_Amount; ?></td>
<?php } ?>

                                    <?php } ?>
 
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                      
                    </table></div>
                    <?php }
                     
                    if($cat == '2' || $cat == 'all'){?>
                    <div class="list-table-inner erp-company-gradecat-wrap-inner postbox testpost">
                    <table  class="wp-list-table widefat striped admins" style="margin-bottom: 15px;" >
                        <h3 class="inside" style="margin:0px 0px 0px -5px;font-size: 1.1em !important;"><?php _e('Accommodation Category Limits', 'erp'); ?> </h3>
                        <thead>
                            <tr>
                                <th width="">Sl.No.</th>
                                <th width="">Grade</th>
                                <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=2 AND COM_Id IN (0, $compid) AND MOD_Status=1");
                                foreach ($selmodes as $value) {
                                    ?>
                                    <th width=""><?php echo $value->MOD_Name; ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody align="">
                            <?php
                            $i = 1;
                            foreach ($selcom as $rowcom) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td> <?php echo $rowcom->EG_Name; ?> &nbsp;<br/><a href="#" id="gradelimitstay" data-id="<?php echo $rowcom->EG_Id ?>" title="Edit Grade Limits">Edit</a></td>
                                    <?php
                                    $egid = $rowcom->EG_Id;
                                    //echo $egid;
                                    if ($rowsum = $wpdb->get_row("SELECT * FROM  grade_limits where EG_Id='$egid' AND GL_Status=1")) {
                                        ?>
                                        <td ><?php echo $rowsum->GL_Hotel ? IND_money_format($rowsum->GL_Hotel) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_Self ? IND_money_format($rowsum->GL_Self) : 0; ?></td>
 <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=2 AND COM_Id='$compid' AND MOD_Status=1");
                                foreach ($selmodes as $value) { 
                                $subGradeLimits = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE MOD_Id = $value->MOD_Id AND EG_Id = $egid");
                                ?>
                                    <td width=""><?php echo $subGradeLimits->Limit_Amount; ?></td>
<?php } ?>
                                    <?php } ?>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table></div>
                    <?php } 
                    if($cat == '3' || $cat == 'all'){?>
                    <div class="list-table-inner erp-company-gradecat-wrap-inner postbox testpost">
                     <table  class="wp-list-table widefat striped admins" style="margin-bottom: 15px;" >
                        <h3 class="inside" style="margin:0px 0px 0px -5px;font-size: 1.1em !important;"><?php _e('General Category Limits', 'erp'); ?> </h3>
                        <thead>
                            <tr>
                                <th width="">Sl.No.</th>
                                <th width="">Grade</th>
                                <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=3 AND COM_Id IN (0, $compid) AND MOD_Status=1");
                                //print_r($selmodes);
                                foreach ($selmodes as $value) {
                                    ?>
                                    <th width=""><?php echo $value->MOD_Name; ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody align="">
                            <?php
                            $i = 1;
                            foreach ($selcom as $rowcom) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td> <?php echo $rowcom->EG_Name; ?>&nbsp;<br/> <a href="#" id="gradelimitgeneral" data-id="<?php echo $rowcom->EG_Id ?>" title="Edit Grade Limits">Edit</a></td>
                                    <?php
                                    $egid = $rowcom->EG_Id;
                                    //echo $egid;
                                    if ($rowsum = $wpdb->get_row("SELECT * FROM  grade_limits where EG_Id='$egid' AND GL_Status=1")) {
                                        ?>
                                        <td ><?php echo $rowsum->GL_Local_Conveyance ? IND_money_format($rowsum->GL_Local_Conveyance) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_ClientMeeting ? IND_money_format($rowsum->GL_ClientMeeting) : 0; ?></td>
                                         <td ><?php echo $rowsum->GL_Others_Other_te ? IND_money_format($rowsum->GL_Others_Other_te) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_Marketing ? IND_money_format($rowsum->GL_Marketing) : 0; ?></td>
 <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=3 AND COM_Id='$compid' AND MOD_Status=1");
                                foreach ($selmodes as $value) { 
                                $subGradeLimits = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE MOD_Id = $value->MOD_Id AND EG_Id = $egid");
                                ?>
                                    <td width=""><?php echo $subGradeLimits->Limit_Amount; ?></td>
<?php } ?>
                                    <?php } ?>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table></div>
                    <?php } 
                    if($cat == '4' || $cat == 'all'){ ?>
                    <div class="list-table-inner erp-company-gradecat-wrap-inner postbox testpost">
                     <table  class="wp-list-table widefat striped admins" style="margin-bottom: 15px;" >
                        <h3 class="inside" style="margin:0px 0px 0px -5px;font-size: 1.1em !important;"><?php _e('Other Category Limits', 'erp'); ?> </h3>
                        <thead>
                            <tr>
                                <th width="">Sl.No.</th>
                                <th width="">Grade</th>
                                <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=4 AND COM_Id IN (0, $compid) AND MOD_Status=1");
                                 //print_r($selmodes);
                                foreach ($selmodes as $value) {
                                    ?>
                                    <th width=""><?php echo $value->MOD_Name; ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody align="">
                            <?php
                            $i = 1;
                            foreach ($selcom as $rowcom) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td> <?php echo $rowcom->EG_Name; ?>&nbsp;<br/> <a href="#" id="gradelimitother" data-id="<?php echo $rowcom->EG_Id ?>" title="Edit Grade Limits">Edit</a></td>
                                    <?php
                                    $egid = $rowcom->EG_Id;
                                    //echo $egid;
                                    if ($rowsum = $wpdb->get_row("SELECT * FROM  grade_limits where EG_Id='$egid' AND GL_Status=1")) {
                                        ?>
                                        <td width=""><?php echo $rowsum->GL_Halt ? IND_money_format($rowsum->GL_Halt) : 0; ?></td>
                                        <td><?php echo $rowsum->GL_Boarding ? IND_money_format($rowsum->GL_Boarding) : 0; ?></td>
                                         <td ><?php echo $rowsum->GL_Other_Te_Others ? IND_money_format($rowsum->GL_Other_Te_Others) : 0; ?></td>
 <?php
                                $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=4 AND COM_Id='$compid' AND MOD_Status=1");
                                foreach ($selmodes as $value) { 
                                $subGradeLimits = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE MOD_Id = $value->MOD_Id AND EG_Id = $egid");
                                ?>
                                    <td width=""><?php echo $subGradeLimits->Limit_Amount; ?></td>
<?php } ?>
                                    <?php } ?>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table></div>
                    <?php } ?>
                </div></div>
        </div>
    <?php } ?>
</div>
