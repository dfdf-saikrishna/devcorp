<?php
global $wpdb;
$compid = $_SESSION['compid'];
global $branch; 
?>
<div class="erp-employee-form"> 
    <div id="failure" style="display:none" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>
    <div id="success" style="display:none" class="notice notice-success is-dismissible">
        <p id="p-success"></p>
    </div>
    <input type="hidden" value="" name="company[compid]" id="compid">
    <legend>Cost Center Budget - <span id="costCenterBudget" class="red">{{data.cc_Budget}}</span> Available Budget - <span id="availableBudget" class="red">{{data.cc_Budget}}</span></legend>
    <fieldset class="no-border">
    <ol class="form-fields">
         <li class="erp-hr-js-department" data-selected={{data.CC_Id}}>
            <?php $getcompany = get_costcenter_list();
                  $count = count($getcompany);
                  //$branch = "{{data.CC_Id}}";
                  ?>
           <label for="full-name">Costcenter  <span class="required">*</span></label>
           <select  id="selectcostcenter" name="company[txtCostcenter]" id="txtCostcenter"  value="{{data.CC_Location}}" class="erp-hrm-select2" tabindex="-1" aria-hidden="true">
           <option value="0">-Select Costcenter-</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getcompany[$i]->CC_Id; ?>"><?php echo $getcompany[$i]->CC_Location; ?></option>

               <?php } ?>
           </select>
          </li>
	</ol>
	</fieldset>
<!-- <input type="hidden" value="{{data.ADM_Id}}" name="company[adminid]" id="adminid">-->
    <!--div class="row">
    <?php //erp_html_form_label(__('Project Budget', 'erp'), 'project Budget', true); ?>
        <span class="field">
            <input value="{{data.PC_Budget}}" required name="company[txtProjectBudget]" id="txtProjectBudget" >
        </span>
    </div-->
    
    <fieldset>
    <legend>Project Details <span class="required">*</span></legend>
    <ol class="form-fields two-col">
    <!--li>
    
    
    <label for=""><?php erp_html_form_label(__('Code', 'erp'), 'projectcode-title', false); ?></label>
       
    <input value="{{data.PC_Code}}"  required name="company[txtProjectCode]" id="txtProjectCode" >
    </li>
    <li>
    <label for=""><?php erp_html_form_label(__('Name', 'erp'), 'projectcode-title', false); ?></label>
      
    <input value="{{data.PC_Name}}"  required name="company[txtProjectName]" id="txtProjectName" >
    </li>
    <li>
    <label for=""><?php erp_html_form_label(__('Location', 'erp'), 'projectcode-title', false); ?></label>
      
    <input value="{{data.PC_Location}}"  required name="company[txtProjectLoc]" id="txtProjectLoc" >
    </li>
    <li>
    <label for=""><?php erp_html_form_label( __( 'Description', 'erp' ), 'projectcode-desc' ); ?></label>

    <textarea name="company[txtProjectDesc]" id="txtProjectDesc" rows="2" cols="20" placeholder="<?php _e( 'Optional', 'erp' ); ?>">{{data.PC_Description}}</textarea>
        
    </li-->
    <!--ol class="form-fields"-->
	 <li class="erp-hr-js-department" data-project={{data.PC_Id}}>
	    <?php $getcompany = get_projectcodes_list();
	          $count = count($getcompany);
	          ?>
	   <label for="comname">ProjectCode</label>
	   <select  id="selectCompany" name="company[projectCode]" id="projectCode" class="" tabindex="-1" aria-hidden="true">
	   <option value="0">-SELECT Projectcode-</option>
	       <?php for($i=0; $i<$count; $i++){?>
	       <option value="<?php echo $getcompany[$i]->PC_Id; ?>"><?php echo $getcompany[$i]->PC_Code; ?></option>
	
	       <?php } ?>
	   </select>
	  </li>
	<!--/ol-->
	<li>
	<input type="hidden" value="{{data.PC_Id}}" name="company[pcId]" id="pcId">
    <label for=""><?php erp_html_form_label(__('Budget', 'erp'), 'project Budget', false); ?></label>
    <input value="{{data.PC_Budget}}" placeholder="00.00" required name="company[txtProjectBudget]" id="txtProjectBudget" >
    <input type="hidden" value="{{data.CC_Id}}" name="company[ccId]" id="ccId">
    </li>
    </ol>
    </fieldset>
    <fieldset>
    <legend>Project Category Budgets <span class="required">*</span></legend>
    <ol class="form-fields two-col">
    <li>
    <label for=""><?php erp_html_form_label(__('Travel', 'erp'), 'travelcategory-title', false); ?></label>
            <input value="{{data.Travel_Category}}" placeholder="00.00" required name="company[txtCategorytravel]" id="txtCategoryCode" >
    </li>
    <li>
    <label for=""><?php erp_html_form_label(__('Accomodation', 'erp'), 'projectcode-title', false); ?></label>
        
            <input value="{{data.Milage_Category}}" placeholder="00.00" required name="company[txtCategorymileage]" id="txtCategorymileage" >
    </li>
    <li>
    <label for=""><?php erp_html_form_label(__('General', 'erp'), 'projectcode-title', false); ?></label>
        
            <input value="{{data.Utility_Category}}" placeholder="00.00" required name="company[txtCategoryutility]" id="txtProjectLoc" >
    </li>
    <li>
    <label for=""><?php erp_html_form_label(__('Others', 'erp'), 'projectcode-title', false); ?></label>
        
            <input value="{{data.Others_Category}}" placeholder="00.00" required name="company[txtCategoryothers]" id="txtProjectLoc" >
    </li>
    </ol>
    </fieldset>
<?php //wp_nonce_field( 'wp-erp-hr-employee-nonce' );   ?>
    <input type="hidden" name="action" id="erp-projectcode-action" value="projectcode_create">
 <!--<input type="hidden" name="action" id="erp_company_projectcode_create" value="erp_company_projectcode_create">-->
</div>