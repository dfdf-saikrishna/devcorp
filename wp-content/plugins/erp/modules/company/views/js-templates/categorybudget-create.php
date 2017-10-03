<?php
global $wpdb;
$getcompany = get_categorybudget_list(); 
$getprojects = get_projectcodes_list(); 
//print_r($getcompany);
?>
<div class="erp-employee-form">
   <!-- <div class="row">
    <ol class="form-fields">
         
         <li class="erp-hr-js-department" data-selected=<?php echo $compid; ?>>
            <?php 
                  //print_r($getcompany);
                  $count = count($getcompany);
                  ?>
           
           <label for="comname">Select Costcenter</label>
           <select id="selectcostcenter" name="company[txtCostcenter]" id="txtCostcenter"  value="" class="" tabindex="-1" aria-hidden="true">
           <option value="0">-SELECT CostCenter-</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getcompany[$i]->CC_Id; ?>"><?php echo $getcompany[$i]->CC_Location; ?></option>

               <?php } ?>
           </select>

          </li>
       
	</ol>
</div>-->

    <div class="row">
    <ol class="form-fields">
         
         <li class="erp-hr-js-department" data-selected=<?php echo $compid; ?>>
            <?php 
                // print_r($getcompany);
                $count = count($getprojects);
                  ?>
           
           <label for="comname">Select Project</label>
           <select id="selectProjectcode" name="company[txtprojectcode]" id="txtprojectcode"  value="" class="" tabindex="-1" aria-hidden="true">
           <option value="0">-SELECT Project-</option>
               <?php for($i=0; $i<$count; $i++){?>
               <option value="<?php echo $getprojects[$i]->PC_Id; ?>"><?php echo $getprojects[$i]->PC_Code;?></option>

               <?php } ?>
           </select>

          </li>
       
	</ol>
</div>
    <div class="row">
    <?php erp_html_form_label(__('Travel Category', 'erp'), 'travelcategory-title', true); ?>
        <span class="field">
            <input value=""  required name="company[txtCategorytravel]" id="txtCategoryCode" >
        </span>
    </div>
    <div class="row">
    <?php erp_html_form_label(__('Mileage Category', 'erp'), 'projectcode-title', true); ?>
        <span class="field">
            <input value=""  required name="company[txtCategorymileage]" id="txtCategorymileage" >
        </span>
    </div>
    <div class="row">
    <?php erp_html_form_label(__('Utility Category', 'erp'), 'projectcode-title', true); ?>
        <span class="field">
            <input value=""  required name="company[txtCategoryutility]" id="txtProjectLoc" >
        </span>
    </div>
  <div class="row">
    <?php erp_html_form_label(__('Others Category', 'erp'), 'projectcode-title', true); ?>
        <span class="field">
            <input value=""  required name="company[txtCategoryothers]" id="txtProjectLoc" >
        </span>
    </div>
   
     
<?php //wp_nonce_field( 'wp-erp-hr-employee-nonce' );   ?>
    <input type="hidden" name="action" id="erp-categorybudget-action" value="categorybudget_create">
 <!--<input type="hidden" name="action" id="erp_company_projectcode_create" value="erp_company_projectcode_create">-->
</div>