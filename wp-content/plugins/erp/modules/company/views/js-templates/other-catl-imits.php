<?php
global $wpdb;
$compid = $_SESSION['compid'];
?>
<div class="erp-employee-form">
    <fieldset class="no-border">
     
        <input type="hidden" value="{{data.COM_Id}}" name="company[compid]" id="compid">
        <input type="hidden" value="{{data.EG_Id}}" name="company[egId]" id="egId">
        <input type="hidden" value="{{data.GL_Id}}" name="company[glId]" id="glId">
        <div class="row">
            <?php erp_html_form_label(__('Halt', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Halt}}" placeholder="00.00" required name="company[txtHalt]" id="txtHalt" >
                <input value="{{data.GL_Halt_Percent}}" placeholder="0" required name="company[txtHaltpercent]" id="txtHaltpercent" > %
            </span>
        </div>
         <div class="row">
            <?php erp_html_form_label(__('Boarding', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Boarding}}" placeholder="00.00" required name="company[txtBoarding]" id="txtBoarding" >
                <input value="{{data.GL_Boarding_Percent}}" placeholder="0" required name="company[txtBoardingpercent]" id="txtBoardingpercent" > %
            </span>
        </div>
        
        <div class="row">
            <?php erp_html_form_label(__('Others', 'erp'), 'grades-title', true); ?>
            <span class="field">
                <input value="{{data.GL_Other_Te_Others}}" placeholder="00.00" required name="company[txtOthers]" id="txtOthers" >
                <input value="{{data.GL_Other_Te_Others_Percent}}" placeholder="0" required name="company[txtOtherspercent]" id="txtOtherspercent" > %
            </span>
        </div>
        <?php
        global $wpdb;
        $selmodes = $wpdb->get_results("SELECT * FROM mode Where EC_Id=4 AND COM_Id IN (0, $compid) AND MOD_Status=1 AND MOD_Id NOT IN (1,2,3,4,5,6,7,8,9,15,10,11,12,13)");
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
    <input type="hidden" name="action" id="erp-gradelimit-action" value="gradelimitothers_get">
</div>