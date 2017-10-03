<?php
global $wpdb;
$compid = $_SESSION['compid'];
global $branch; 
?>
<div class="erp-employee-form wp-erp">
    <input type="hidden" value="" name="company[compid]" id="compid">
<!-- <input type="hidden" value="{{data.ADM_Id}}" name="company[adminid]" id="adminid">-->
    <!--div class="row">
    <?php //erp_html_form_label(__('Project Budget', 'erp'), 'project Budget', true); ?>
        <span class="field">
            <input value="{{data.PC_Budget}}" required name="company[txtProjectBudget]" id="txtProjectBudget" >
        </span>
    </div-->
    <div class="row">
        <li class="erp-hr-js-department" data-selected={{data.CC_Id}}>
            <?php $getcompany = get_costcenter_list();
                  $count = count($getcompany);
                  //$branch = "{{data.CC_Id}}";
                  ?>
           <label for="full-name">Costcenter  <span class="required">*</span></label>
           <select  id="selectcostcenter" name="company[txtCostcenter]" id="txtCostcenter" required value="{{data.CC_Location}}" class="erp-select2" tabindex="-1" aria-hidden="true">
           <option value="0">-Costcenter-</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getcompany[$i]->CC_Id; ?>"><?php echo $getcompany[$i]->CC_Location; ?></option>

               <?php } ?>
           </select>
          </li>
    </div>
    <div class="row">
    <input type="hidden" value="{{data.PC_Id}}" name="company[pcId]" id="pcId">
    <li class="erp-hr-js-department" data-selected={{data.DEP_Id}}>
        <?php $getdepartments = get_department_list(); 
              //print_r($getdepartments);
              $count = count($getdepartments);
              ?>
       <label for="selDep">Select Department  <span class="required">*</span></label>
       <select required id="selDep" name="company[selDep]"  class="erp-select2" tabindex="-1" aria-hidden="true" style="
margin-left: 10px;
width: 150px;
">
       <option value="">-Department-</option>
           <?php for($i=0; $i<$count; $i++){?>
           <option value="<?php echo $getdepartments[$i]->DEP_Id; ?>"><?php echo $getdepartments[$i]->DEP_Name; ?></option>

           <?php } ?>
       </select>
      </li>
    </div>
    <div class="row">
    <?php erp_html_form_label(__('Project Code', 'erp'), 'projectcode-title', true); ?>
        <span class="field">
            <input value="{{data.PC_Code}}"  required name="company[txtProjectCode]" id="txtProjectCode" >
        </span>
    </div>
    <div class="row">
    <?php erp_html_form_label(__('Project Name', 'erp'), 'projectcode-title', true); ?>
        <span class="field">
            <input value="{{data.PC_Name}}"  required name="company[txtProjectName]" id="txtProjectName" >
        </span>
    </div>
    <div class="row">
    <?php erp_html_form_label(__('Project Location', 'erp'), 'projectcode-title', true); ?>
        <span class="field">
            <input value="{{data.PC_Location}}"  required name="company[txtProjectLoc]" id="txtProjectLoc" >
        </span>
    </div>
     <div class="row">
        <?php erp_html_form_label( __( 'Project Description', 'erp' ), 'projectcode-desc' ); ?>
        <span class="field">
            <textarea name="company[txtProjectDesc]" id="txtProjectDesc" rows="2" cols="20" placeholder="<?php _e( 'Optional', 'erp' ); ?>">{{data.PC_Description}}</textarea>
        </span>
    </div>
<?php //wp_nonce_field( 'wp-erp-hr-employee-nonce' );   ?>
    <input type="hidden" name="action" id="erp-projectcode-action" value="projectbudget_create">
 <!--<input type="hidden" name="action" id="erp_company_projectcode_create" value="erp_company_projectcode_create">-->
</div>