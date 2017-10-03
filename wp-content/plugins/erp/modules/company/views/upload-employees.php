<div class="postbox" style="
    width: 98% !important;margin-top: 20px;
">

    <div class="inside emp-import filter-top">
        <?php if (isset($_GET['error'])) { ?>
            <div id="failure" class="notice notice-error is-dismissible">
                <p id="p-failure">Please Upload Excel File</p>
            </div>
        <?php } ?>
        <form method="post" action="admin.php?page=Upload-Employees" enctype="multipart/form-data" id="import_form">

            <table class="form-table" border="0" cellpaddin="0" cellspacing="0">
                <tbody>

                    <tr>
                        <td>
                            <label for="type"><?php _e('Excel File', 'crp'); ?> <span class="required">*</span></label>
                        </td>
                        <td>
                            <input type="file" name="csv_file" id="csv_file" class="btn btn-default btn-block" />
                            <p class="description"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php _e('Upload a Excel file.', 'crp'); ?></p>
                        </td>
                        <td>
                            <input type="checkbox" name="employee_notification" checked> Send Notification Emails <i class="fa fa-envelope" aria-hidden="true"></i>
                        </td>
                        <td>
                            <p id="download_sample_wrap">
                                <input type="hidden" value="" />
                                <?php
                                $fileurl="/erp/modules/company/upload/file_format.xls";
                                ?>
                                <a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download><i class="fa fa-download" aria-hidden="true"></i> Download Sample Excel</a>
                            </p>
                        </td>
                        <td>
                            <p class="submit">
                <span class="erp-loader" style="margin-left:67px;margin-top: 4px;display:none"></span>
                <input type="submit" name="crp_import_excel" id="crp_import_excel" class="btn btn-primary btn-block" value="Upload">
            </p>
                        </td>
                    </tr>
                </tbody>
		

                <tbody id="fields_container" style="display: none;">

                </tbody>
            </table>

            
        </form>
    </div><!-- .inside -->
</div><!-- .postbox -->

<?php ?>
<div class="box panel-widget-style wrap erp-company-upload" id="wp-erp" style="margin-bottom:20px;">
    <?php
    global $wpdb;
    $table = new WeDevs\ERP\Company\Upload_List_Table();
    $table->prepare_items();
    ?>
    <div class="list-table-wrap erp-company-departments-wrap">
        <div class="list-table-inner erp-company-departments-wrap-inner">
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
    </div>
</div>

