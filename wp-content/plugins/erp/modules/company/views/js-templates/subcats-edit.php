<?php
global $wpdb;
$compid = $_SESSION['compid'];
?>
<!-- Messages -->
<div style="display:none" id="failure" class="notice notice-error is-dismissible">
    <p id="p-failure"></p>
</div>

<div style="display:none" id="notice" class="notice notice-warning is-dismissible">
    <p id="p-notice"></p>
</div>

<div style="display:none" id="success" class="notice notice-success is-dismissible">
    <p id="p-success"></p>
</div>

<div style="display:none" id="info" class="notice notice-info is-dismissible">
    <p id="p-info"></p>
</div>
<div class="erp-employee-form">
    <div class="row">
        <?php erp_html_form_label(__('Mode Name', 'erp'), 'mode-name', true); ?>
        <span class="field">
            <input value="{{data.MOD_Name}}" required name="modName" id="modName" >
        </span>
    </div>
    

    <?php //wp_nonce_field( 'wp-erp-hr-employee-nonce' );   ?>
    <input type="hidden" name="modId" id="modId" value="{{data.MOD_Id}}">
    <input type="hidden" name="action" id="subcats_update" value="subcats_update">
 <!--<input type="hidden" name="action" id="erp_company_costcenter_create" value="erp_company_costcenter_create">-->
</div>