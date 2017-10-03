<?php
global $wpdb;
?>
<header class="panel-heading sm" data-color="theme-inverse">
    <h4 id="my_centered_buttons">Claim Status</h4>
</header>
<?php
if ($selptc = $wpdb->get_row("SELECT * FROM pre_travel_claim Where REQ_Id='$reqid'")) {
    ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <td width="25%">&nbsp;&nbsp;Reporting Manager Approval</td>
                    <td width="25%"><?php
                        echo $approvals = approvals($selptc->PTC_RepMngrStatus);

                        if ($selptc->PTC_RepMngrStatus == 2) {
                            echo " on " . date('d/M/y', strtotime($selptc->PTC_RepMngrApprovedDate));
                        } else if ($selptc->PTC_RepMngrStatus == 9) {
                            echo " on " . date('d/M/y', strtotime($selptc->PTC_RepMngrRejectedDate));
                        }
                        ?></td>
                    <td width="25%">&nbsp;&nbsp;Finance Approval</td>
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
                    <td><?php
                    if ($selptc->PTC_RepMngrStatus == 2) {
                        $repmnname = $wpdb->get_row("SELECT EMP_Name FROM employees Where EMP_Id='$selptc->PTC_RepMngrEmpid'");
                        echo $repmnname->EMP_Name;
                    } else {
                        echo '<span class="label label-default">N/A</span>';
                    }
                        ?></td>
                    <td>&nbsp;&nbsp;Finance Manager Name</td>
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
    <!--div class="text-center" id="my_centered_buttons"><span class="label label-warning">Bills Not Uploaded</span></div-->
                        <?php
                    }
                    ?>
<p style="border-bottom:thin dashed #000000;">&nbsp;</p>
