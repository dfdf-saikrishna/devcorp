<?php
global $wpdb;
?>
<header class="panel-heading sm" data-color="theme-inverse">
    <h4>Claim Status</h4>
</header>
<br />
<?php
if ($selptc = $wpdb->get_row("SELECT * FROM pre_travel_claim Where REQ_Id='$reqid'")) {
    ?>
    <div class="table-responsive">
        <table class="wp-list-table widefat striped admins">
            <tbody>
                <tr>
                    <td width="20%">&nbsp;&nbsp;Reporting Manager Approval</td>
                    <td width="5%" align="center">:</td>
                    <td width="25%"><?php
                        echo $approvals = approvals($selptc->PTC_RepMngrStatus);

                        if ($selptc->PTC_RepMngrStatus == 2) {
                            echo " on " . date('d/M/y', strtotime($selptc->PTC_RepMngrApprovedDate));
                        } else if ($selptc->PTC_RepMngrStatus == 9) {
                            echo " on " . date('d/M/y', strtotime($selptc->PTC_RepMngrRejectedDate));
                        }
                        ?></td>
                    <td width="20%">&nbsp;&nbsp;Finance Approval</td>
                    <td width="5%" align="center">:</td>
                    <td width="25%"><?php
                    echo
                    $approvals = approvals($selptc->PTC_FinanceStatus);

                    if ($selptc->PTC_FinanceStatus == 2) {
                        echo " on " . date('d/M/y', strtotime($selptc->PTC_FinanceApprovedDate));
                    } else if ($selptc->PTC_FinanceStatus == 9) {
                        echo " on " . date('d/M/y', strtotime($selptc->PTC_FinanceRejectedDate));
                    }
                        ?></td>
                </tr>
                <tr>
                    <td >&nbsp;&nbsp;Reporting Manager Name</td>
                    <td align="center">:</td>
                    <td><?php
                    if ($selptc->PTC_RepMngrStatus == 2) {
                        $repmnname = $wpdb->get_row("SELECT EMP_Name FROM employees Where EMP_Id='$selptc->PTC_RepMngrEmpid'");

                        echo $repmnname->EMP_Name;
                    } else {
                        echo '<span class="label label-default">N/A</span>';
                    }
                        ?></td>
                    <td>&nbsp;&nbsp;Finance Manager Name</td>
                    <td align="center">:</td>
                    <td ><?php
                        if ($selptc->PTC_FinanceStatus == 2) {
                            $repmnname = $wpdb->get_row("SELECT EMP_Name FROM employees Where  EMP_Id='$selptc->PTC_FinanceEmpid'");

                            echo $repmnname->EMP_Name;
                        } else {
                            echo '<span class="label label-default">N/A</span>';
                        }
                        ?></td>
                </tr>
            </tbody>
        </table>
    </div>
                        <?php
                    } else {
                        ?>
    <div class="text-center"><span class="status-4">Bills Not Uploaded</span></div>
                        <?php
                    }
                    ?>
<p style="border-bottom:thin dashed #000000;">&nbsp;</p>
