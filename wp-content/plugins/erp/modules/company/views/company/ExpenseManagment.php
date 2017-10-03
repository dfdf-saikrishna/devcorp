<?php
global $wpdb;
$compid = $_SESSION['compid'];
$flag = 0;
if ($selpol = $wpdb->get_row("SELECT * FROM travel_expense_policy_doc WHERE COM_Id='$compid' AND TEPD_Status=1")) {

    $flag = 1;
} else {
    $flag = 0;
}
?>
	
<div  class="postbox filter-top" style="width:98% !important;">
    <div class="inside emp-import">
        <?php if (isset($_GET['error'])) { ?>
            <div id="failure" class="notice notice-error is-dismissible">
                <p id="p-failure">Please Upload PDF File</p>
            </div>
        <?php } ?>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'failure') { ?>
            <div id="failure" class="notice notice-error is-dismissible">
                <p id="p-failure">File uploading error. Please choose a appropriate file (.pdf)</p>
            </div>
        <?php } else if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
            <div id="success" class="notice notice-success is-dismissible">
                <p id="p-success"> Uploaded successfully.</p>
            </div>
        <?php } ?>
        <form method="post" action="admin.php?page=expensemenu" enctype="multipart/form-data" id="import_pdf">
            <div clas="row">
                <div class="col-md-4">
                    <label for="type"><?php _e('Upload Company Expense Policy Document', 'crp'); ?> <span class="required">*</span></label>
                </div>
                
                <div class="col-md-2">
                    <div id="fileDiv">
                                    <?php
                                    if (!empty($selpol)) {
                                        if (!empty($selpol->TEPD_Filename)) {
                                            if ($selpol->TEPD_Filename) {
                                                ?>     
                                                <a href='javascript:upload()'><img src="<?php echo WPERP_COMPANY_ASSETS ?>/img/pdf-doc.png" width="32px" title="click to upload new document" /> </a>
                                            <?php }
                                            ?>
                                            <input type="hidden" name="csv_file" id="csv_file" />
                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <a  href="javascript:upload();">Upload Now</a>

                                <?php } ?>
                                </div>
                                <?php if (!empty($selpol)) { ?>
                                    <input type="hidden" name="oldfile" id="oldfile" value="<?php echo $selpol->TEPD_Filename; ?>" />
                            <?php } ?>
                </div>
                
                <div class="col-md-4">
                    <?php if ($flag) { ?>
                                <div class="form-group">
                                    <?php erp_html_form_label(__('Download Company Expense Policy Document', 'erp'), 'expense-title', true); ?>
                                    <!--<label class="control-label"</label>-->
                                    <?php $fileurl = "/erp/modules/company/upload/" . $compid . '/' .$selpol->TEPD_Filename;
                                    ?>

                                    <div> <a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download="policy" >download file</a> </div>
                                </div>
<?php } ?>
                </div>
                
                <div class="col-md-2">
                     <span class="erp-loader" style="margin-left:67px;margin-top: 4px;display:none"></span>
                <input type="submit" name="crp_import_pdf" id="crp_import_pdf" class="btn btn-primary btn-block" value="Submit">
                </div>
                
            </div>
            
        </form>
    </div>
</div>
<script>
    var bkp;
    function upload()
    {
        bkp = document.getElementById('fileDiv').innerHTML;

        document.getElementById('fileDiv').innerHTML = "<input type='file' name='csv_file' id='csv_file' onchange='Validate(this.id);'  />&nbsp;<a href='javascript:cancelImg()'>Cancel</a>";
    }
    function cancelImg()
    {
        document.getElementById('fileDiv').innerHTML = bkp;
    }

    var type = 1;
</script>