<?php
global $wpdb;

$compid = $_SESSION['compid'];

?>

<div class="erp-employee-form">
    <fieldset class="no-border">

        <input type="hidden" value="{{data.COM_Id}}" name="company[compid]" id="compid">
        <input type="hidden" value="{{data.EG_Id}}" name="company[egId]" id="egId">
        <input type="hidden" value="{{data.GL_Id}}" name="company[glId]" id="glId">
        <input type="hidden" value="{{data.CC_Id}}" name="company[ccId]" id="ccId">
        <p id="limitcheck" style="color:red";></p>
        <div class="row" >
            <?php erp_html_form_label(__('Flight', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Flight}}" placeholder="00.00"  required name="company[txtflight]" id="txtflight" >
                <input value="{{data.GL_Flight_Percent}}" placeholder="0" required name="company[txtflightpercent]" id="txtflightpercent" > %            

            </span>
        </div>
        <div class="row">
            <?php erp_html_form_label(__('Bus', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Bus}}" placeholder="00.00"  required name="company[txtBus]" id="txtBus" >
                <input value="{{data.GL_Bus_Percent}}" placeholder="0" required name="company[txtBuspercent]" id="txtBuspercent" > %
            </span>
        </div>
        <div class="row">
            <?php erp_html_form_label(__('Car', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Car}}" placeholder="00.00"  required name="company[txtCar]" id="txtCar" >
                <input value="{{data.GL_Car_Percent}}" placeholder="0" required name="company[txtCarpercent]" id="txtCarpercent" >%
               
            </span>
        </div>
        <div class="row">
            <?php erp_html_form_label(__('Others (Travel)', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Others_Travels}}" placeholder="00.00"  required name="company[txtOthers1]" id="txtOthers1" >
                <input value="{{data.GL_Others_Travels_Percent}}" placeholder="0" required name="company[txtOthers1percent]" id="txtOthers1percent" > %
            </span>
        </div>
        
        <?php
        global $wpdb;
        $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=1 AND COM_Id IN (0, $compid) AND MOD_Status=1 AND MOD_Id NOT IN (1,2,3,4)");
        $egId = $_GET[grades];
        foreach ($selmodes as $value) {
        ?>
    	<div class="row">
    	<?php
    	erp_html_form_label(__($value->MOD_Name, 'erp'), 'grades-title', true);
    	$subGradeLimits = $wpdb->get_row("SELECT * FROM sub_category_limit WHERE MOD_Id = $value->MOD_Id AND EG_Id = $egId");
        ?>
        <span class="field">
	        <input value="<?php echo $subGradeLimits->Limit_Amount; ?>" placeholder="00.00" required name="<?php echo $value->MOD_Name.$value->MOD_Id; ?>" id="<?php echo $value->MOD_Name; ?>" >
	        <input value="<?php echo $subGradeLimits->Tolerance; ?>" placeholder="0" required name="<?php echo "percent_".$value->MOD_Name.$value->MOD_Id; ?>" id="<?php echo "percent_".$value->MOD_Name; ?>" > %
    	</span>
    	</div>
    	<?php } ?>
        
    </fieldset>
    <?php //wp_nonce_field( 'wp-erp-hr-employee-nonce' );   ?>
    <input type="hidden" name="action" id="erp-gradelimit-action" value="gradelimits_get">
   
 <!--<input type="hidden" name="action" id="erp_company_mileage_create" value="erp_company_mileage_create">-->
</div>

