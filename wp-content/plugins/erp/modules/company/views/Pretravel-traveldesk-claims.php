<?php
ob_start();
//require("header.php");
//require("config.php");
//$msg	=$_GET['msg;
$reqid = $_GET['reqid'];
//$godown	=$_GET['godown'];

$et = 1;

$showProCode = 1;

$go = 0;

$row = $wpdb->get_row("SELECT * FROM requests req, request_employee re where req.REQ_Id='$reqid' AND RT_Id IN (1,2) AND req.REQ_Id=re.REQ_Id AND re.EMP_Id='$empuserid' AND REQ_Active != 9 AND re.RE_Status=1");

if (!$row->REQ_Id) {

    $go = 1;
} else {

    if ($row->REQ_Claim) {

        $go = 1;
    }
}
$imdir = "/erp/modules/upload/" . $compid . "/bills_tickets/";

//$imdir = "company/upload/$compid/bills_tickets/";
?>

<div id="main">
    <li class="active">Pre Travel Expense Submit Claim</li>
    <!-- //breadcrumb-->
    <div id="content">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading sm" data-color="theme-inverse">
                        <h3>Post Travel Expense Submit Claim</h3>
                        <label class="color">Upload &amp; Add <strong> Bills &amp; Total Cost </strong></label>
                    </header>
                    <form class="form-horizontal" method="post" id="formUpdatePretrvRequest" name="formUpdatePretrvRequest" action="" data-collabel="3" data-alignlabel="left" parsley-validate enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $row->REQ_Code; ?>" name="requestcode" id="requestcode"  />
                        <input type="hidden" value="1" name="ectype"/>
                        <input type="hidden" value="<?php echo $reqid; ?>" name="reqid" id="reqid"/>
                        <div class="panel-body">

                            <?php
                            $approver = isApprover();
                            if ($approver) {

                                //echo 'sdfsdfsdf1';

                                require WPERP_COMPANY_PATH . '/includes/employee-details.php';
                                echo '<br>';
                            } else {

                                require WPERP_COMPANY_PATH . '/includes/my-details.php';
                                echo '<br>';
                            }

                            require WPERP_COMPANY_PATH . '/includes/employee-request-details.php';
                            echo '<br>';

                            require WPERP_COMPANY_PATH . '/includes/claim-status.php';
                            echo '<br><br>';
                            ?>
                            <div id="no-more-tables">
                                <table class="wp-list-table widefat striped admins" id="table1" style="font-size:11px;">
                                    <thead class="cf">
                                        <tr>
                                            <th>Date</th>
                                            <th >Expense Description</th>
                                            <th  >Expense <br/>Category</th>
                                            <th>Place</th>
                                            <th >Estimated Cost</th>
                                            <th>Booking Status</th>
                                            <th >Total Cost</th>
                                            <th >Upload Bills</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $selRdids = $wpdb->get_row("SELECT * FROM request_details", "RD_Id, MOD_Id", "REQ_Id='$reqid' AND RD_Status=1");

                                        $cnt = 0;

                                        foreach ($selRdids as $rdid) {

                                            // check whether its gone for booking & and is pending, if its pending or given for cancellation this shouldn't arrive here
                                            // check for booking

                                            if (in_array($rdid->MOD_Id, array(1, 2, 5))) {

                                                if ($selbs = $wpdb->get_row("SELECT BS_Id, BA_Id FROM booking_status where BS_Status=1 AND RD_Id='$rdid->RD_Id' AND BS_Active=1")) {

                                                    if ($selbs->BA_Id == 2) {

                                                        if (!$selbscn = $wpdb->get_row("SELECT BS_Id FROM booking_status where BS_Status=3 AND RD_Id='$rdid->RD_Id' AND BS_Active=1")) {

                                                            $bRdids.=$rdid->RD_Id . ",";

                                                            $cnt++; // for posting data 
                                                        }
                                                    } else {

                                                        $bRdids.=$rdid->RD_Id . ",";

                                                        $cnt++; // for posting data 
                                                    }
                                                } else {

                                                    $bRdids.=$rdid->RD_Id . ",";

                                                    $cnt++; // for posting data 
                                                } // end of if else loop
                                            } else {

                                                $bRdids.=$rdid->RD_Id . ",";

                                                $cnt++; // for posting data 
                                            } // end of if else loop
                                        } // end of for loop


                                        $bRdids = rtrim($bRdids, ",");
//echo 'Rdids='.$rdids; exit;
                                        $selrequest = $wpdb->get_row("SELECT * FROM request_details where REQ_Id='$reqid' AND RD_Id IN ($bRdids) AND RD_Status=1");

                                        echo '<input type="hidden" name="actualRdids" value="' . $cnt . '"  />';

                                        $rows = 1;

                                        foreach ($selrequest as $rowrequest) {
                                            ?>
                                            <tr>
                                                <td data-title="Date" class="scrollmsg"><input type="hidden" value="<?php echo $rowrequest->RD_Id; ?>" name="rdids[]"/>
                                                    <input name="txtDate[]" id="txtDate1" class="form-control dateobjec" placeholder="dd/mm/yyyy" autocomplete="off" value="<?php
                                                    if ($rowrequest->RD_Dateoftravel == "0000-00-00 00:00:00")
                                                        echo "";
                                                    else
                                                        echo date('d/m/Y', strtotime($rowrequest->RD_Dateoftravel));
                                                    ?>" style="width:101px;" readonly="readonly"/>
                                                </td>
                                                <td data-title="Description"><textarea cols="2" rows="1" name="txtaExpdesc[]" id="txtaExpdesc<?php echo $rows; ?>" class="form-control" autocomplete="off" readonly="readonly"><?php echo stripslashes($rowrequest->RD_Description) ?></textarea></td>
                                                <td data-title="Category"><input type="hidden" name="selExpcat[]" id="selExpcat<?php echo $rows; ?>" value="<?php echo $rowrequest->EC_Id; ?>">
                                                    <select class="form-control"  style="width:101px;" disabled="disabled">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $selexpcat = $wpdb->get_row("SELECT * FROM expense_category where EC_Id IN (1,2,4)");

                                                        foreach ($selexpcat as $rowexpcat) {
                                                            ?>
                                                            <option value="<?php echo $rowexpcat->EC_Id ?>" <?php if ($rowexpcat->EC_Id == $rowrequest->EC_Id) echo 'selected="selected"'; ?>><?php echo $rowexpcat->EC_Name; ?></option>
                                                        <?php } ?>
                                                    </select></td>
                                                <td data-title="Category"><input type="hidden" name="selModeofTransp[]" id="selModeofTransp<?php echo $rows; ?>" value="<?php echo $rowrequest->MOD_Id; ?>">
                                                    <select  class="form-control" disabled="disabled" style="width:101px;">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $selsql = $wpdb->get_row("SELECT * FROM mode where EC_Id='$rowrequest->EC_Id' AND COM_Id IN (0, '$compid') AND MOD_Status=1");

                                                        foreach ($selsql as $rowsql) {
                                                            ?>
                                                            <option value="<?php echo $rowsql->MOD_Id; ?>" <?php if ($rowsql->MOD_Id == $rowrequest->MOD_Id) echo 'selected="selected"'; ?>><?php echo $rowsql->MOD_Name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td data-title="Place"><input  name="from[]" id="from<?php echo $rows; ?>" type="text" <?php if ($rowrequest->EC_Id == 2) { ?>placeholder="Location"<?php } else { ?> placeholder="From" <?php } ?> class="form-control" value="<?php echo $rowrequest->RD_Cityfrom ?>" style="width:100px;" readonly="readonly">
                                                    <input  name="to[]" id="to<?php echo $rows; ?>" type="text" placeholder="To" class="form-control" readonly="readonly" <?php
                                                    if ($rowrequest->EC_Id != 1) {
                                                        echo 'value="n/a" style="display:none;"';
                                                    } else {
                                                        echo 'value="' . $rowrequest->RD_Cityto . '"';
                                                    }
                                                    ?>  autocomplete="off" style="width:100px;">
                                                            <?php
                                                            //echo $rowrequest->EC_Id;
                                                            if ($rowrequest->EC_Id == 1 || $rowrequest->EC_Id == 4) {
                                                                ?>
                                                        <select name="selStayDur[]" id="selStayDur<?php echo $rows; ?>" class="form-control" style="display:none;">
                                                            <option value="n/a">Select</option>
                                                        </select>
                                                        <?php
                                                    } else if ($rowrequest->EC_Id == 2) {

                                                        //echo $rowrequest->SD_Id;
                                                        ?>
                                                        <input type="hidden" name="selStayDur[]" id="selStayDur<?php echo $rows; ?>" value="<?php echo $rowrequest->SD_Id; ?>"  />
                                                        <select class="form-control" style="width:100px;" disabled="disabled">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $selsql = $wpdb->get_row("SELECT * FROM stay_duration where ");

                                                            foreach ($selsql as $rowsql) {
                                                                ?>
                                                                <option value="<?php echo $rowsql->SD_Id; ?>" <?php if ($rowrequest->SD_Id == $rowsql->SD_Id) echo 'selected="selected"'; ?> ><?php echo $rowsql->SD_Name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                </td>
                                                <td data-title="Estimated Cost"><?php if ($rowrequest->RD_Cost) { ?>
                                                        <input type="text" class="form-control" name="txtCost[]" id="txtCost<?php echo $rows; ?>" value="<?php echo $rowrequest->RD_Cost; ?>" style="width:75px;" readonly="readonly"/>
                                                    <?php } else { ?>
                                                        <span class="label label-default">N/A</span>
                                                        <input type="hidden" class="form-control" name="txtCost[]" id="txtCost<?php echo $rows; ?>" value="n/a"/>
                                                    <?php } ?>
                                                </td>
                                                <?php
                                                $readOnly = 0;
                                                $bookedAmnt = 0;
                                                $bills = NULL;

                                                if (in_array($rowrequest->MOD_Id, array(1, 2, 5))) {

                                                    // BOOKING STATUS

                                                    if ($selbs = $wpdb->get_row("SELECT BS_Id, BA_Id, BS_TicketAmnt FROM booking_status where RD_Id='$rowrequest->RD_Id' AND BS_Status=1 AND BS_Active=1")) {


                                                        if ($selbs->BA_Id == 2) {

                                                            $bookedAmnt = $selbs->BS_TicketAmnt;

                                                            $seldocs = $wpdb->get_row("SELECT * FROM booking_documents where BS_Id='$selbs->BS_Id]'");

                                                            $doc = NULL;

                                                            $f = 1;

                                                            foreach ($seldocs as $docs) {

                                                                $doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . WPERP_COMPANY_DOWNLOADS . $imdir . $docs->BD_Filename . '" download = "Billtickets" >download</a><br>';

                                                                $f++;
                                                            }


                                                            $bills = $selbs->BD_Filename;

                                                            $readOnly = 1;
                                                        } else {

                                                            $readOnly = 0;
                                                        }
                                                    } else {

                                                        $readOnly = 0;
                                                    }
                                                }
                                                ?>
                                                <td align="left" data-title="Booking Status"><?php
                                                    if ($readOnly) {

                                                        echo '<u>Booked by Travel Desk</u><br><br>';

                                                        echo '<b>Booked Amnt: </b>' . IND_money_format($bookedAmnt) . '.00<br />';

                                                        echo $doc;
                                                    } else {

                                                        echo bookingStatus();
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                                $gActcost = $wpdb->get_row("SELECT * FROM pre_travel_actual_cost where RD_Id='$rowrequest->RD_Id' AND PTAC_Status=1");

                                                $cst = $gActcost->PTAC_Cost;

                                                $value = NULL;

                                                if (!$cst) {

                                                    $actualCost = $bookedAmnt;
                                                } else if ($cst) {

                                                    $actualCost = $cst;
                                                }

                                                $bookedAmnt ? $totalPaytotd+=$bookedAmnt : '';

                                                // Total Cost

                                                $totalActCost+=$actualCost;
                                                ?>
                                                <td data-title="Total Cost"><input type="text"  class="form-control" name="txtAcualCost[]" id="txtAcualCost[]" autocomplete="off"  onkeyup="actualAmnt(this.value, '<?php echo $rows; ?>'); return valActualCost(this.value);" style="width:75px;" value="<?php echo $actualCost ? $actualCost : ''; ?>" <?php if ($readOnly) echo 'readonly="readonly"'; ?>  />
                                                    <?php echo (!$bookedAmnt) ? '<input type="hidden" name="actualAmount[]" id="actualAmount' . $rows . '" value="' . $cst . '"  />' : ''; ?> </td>
                                                <?php
                                                //if(!$rowrequest->RD_Duplicate)
                                                $totEstCost+=$rowrequest->RD_Cost;
                                                ?>
                                                <td align="left" data-title="Upload Bills"><?php
                                                    $selsql = $wpdb->get_row("SELECT * FROM pre_travel_actual_bills where RD_Id='$rowrequest->RD_Id' AND PTAB_Status=1");

                                                    $j = 1;

                                                    $rowup = count($selsql);

                                                    foreach ($selsql as $rowuplfiles) {

                                                        $temp = explode(".", $rowuplfiles->PTAB_Filename);
                                                        $ext = end($temp);

                                                        $fileurl = "company/upload/" . $compid . "/bills_tickets/" . $rowuplfiles->PTAB_Filename;
                                                        ?>
                                                        <span id="reqfilesid<?php echo $j . $rows; ?>"><?php echo $j . ") "; ?><a href="<?php echo WPERP_COMPANY_DOWNLOADS ?><?php echo $fileurl; ?>" download="billtickets"><?php echo 'file' . $j . "." . $ext; ?></a> &nbsp; <a onclick="return delPretrvbills(<?php echo $rowuplfiles->PTAB_Id; ?>, 'reqfilesid<?php echo $j . $rows; ?>')" onmouseover="this.style.cursor = 'pointer'"><i class="fa fa-times" title="delete"></i></a> </span> <br />
                                                        <?php
                                                        $j++;
                                                    }
                                                    ?>
                                                    <input type='file' name='file<?php echo $rows; ?>[]' id="file<?php echo $rows; ?>[]" style="width:120px;" multiple="true" onchange="Validate(this.id);">
                                                    <input type="hidden" value="<?php echo $rowup; ?>" name="filevalidation[]" id="filevalidation<?php echo $rows; ?>" />
                                                </td>
                                            </tr>
                                            <?php
                                            $rows++;
                                        }
                                        ?>

                                    </tbody>

                                </table>
                            </div>

                            <input type="hidden" id="hidrowno" name="hidrowno" value="<?php echo $rows - 1; ?>" />
                            <input type="hidden" name="totrows" id="totrows" value="<?php echo $rows - 1; ?>" />


                            <?php
                            if (!$row->REQ_Claim) {
                                ?>
                                <div class="col-sm-12" align="right">
                                    <div class="form-group"> <a title="Add Rows" class="btn btn-default" href="javascript:addRowSubmitClaim();"><i class="fa fa-plus"></i></a> <span id="removebuttoncontainer"> </span> </div>
                                </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table class="wp-list-table widefat striped admins">
                                    <tr height="30">
                                        <td align="right" width="85%">Total Estimated Cost</td>
                                        <td align="center" width="5%">:</td>
                                        <td align="right" width="10%"><?php echo IND_money_format($totEstCost) . ".00"; ?></td>
                                    </tr>
                                    <tr height="30">
                                        <td align="right" width="85%">Total Cost</td>
                                        <td align="center" width="5%">:</td>
                                        <td align="right" width="10%"><span id="totalactcostid"><?php echo IND_money_format($totalActCost) . ".00"; ?></span></td>
                                    </tr>
                                    <!--<tr height="30">
                                      <td align="right" width="85%">Payable to Travel Desk</td>
                                      <td align="center" width="5%">:</td>
                                      <td align="right" width="10%"><?php echo $totalPaytotd ? IND_money_format($totalPaytotd) . ".00" : 'NIL'; ?></td>
                                    </tr>-->
                                </table>
                            </div>
                            <?php
                            $claimAmnt = abs($totalActCost - $totalPaytotd);
                            ?>
                            <span id="totaltable">
                                <?php if ($claimAmnt) { ?>
                                    <table class="wp-list-table widefat striped admins">
                                        <tr>
                                            <td align="right" width="85%">Claim Amount (Rs)</td>
                                            <td align="center" width="5%">:</td>
                                            <td align="right" width="10%"><?php echo IND_money_format($claimAmnt) . ".00"; ?></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </span> <br />
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button type="submit" name="submitUpdPretrvReq" id="submitUpdPretrvReq" class="button button-primary" onclick="return validateUpdatePretrvReq()">Submit</button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button type="button" name="goback" onclick="javascript:window.history.back();" class="buton">Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <!-- //content > row > col-lg-8 -->
        <!-- //content > row > col-lg-4 -->
        <!-- //content > row-->
    </div>
    <!-- //content-->
</div>
<script>

    function addRowSubmitClaim()
    {

        var tbl = document.getElementById('table1');

        //document.getElementById('table1').style.display='table';

        var lastRow = tbl.rows.length;

        var hidrowvalue = parseInt(document.getElementById('hidrowno').value);

        document.getElementById('hidrowno').value = hidrowvalue + 1;

        // alert(lastRow);
        //return false;

        // if there's no header row in the table, then iteration = lastRow + 1
        var iteration = document.getElementById('hidrowno').value;
        var row = tbl.insertRow(lastRow);

        //DATE OF TRAVEL
        var dt = row.insertCell(0);
        $(dt).attr("data-title", "Date");
        $(dt).attr("class", "scrollmsg");
        var dtIt = "txtDate" + iteration;
        dt.innerHTML = '<input type="text" name="txtDate[]" id="' + dtIt + '" placeholder="dd/mm/yyyy" class="dateobjec form-control" style="width:101px;"/>';

        $('.dateobjec').datepicker({
            format: 'dd/mm/yyyy',
            startDate: "-30d",
            endDate: "+0d",
            orientation: "top auto",
            autoclose: true,
            todayHighlight: true
        });

        // EXPENSE DESCRIPTION
        var expdesc = row.insertCell(1);
        $(expdesc).attr("data-title", "Description");
        var expdescIt = "txtaExpdesc" + iteration;
        expdesc.innerHTML = '<textarea name="txtaExpdesc[]"  cols="2" rows="1" id="' + expdescIt + '" class="form-control" autocomplete="off"></textarea>';



        // EXPENSE CATEGORY
        var expcat = row.insertCell(2);
        $(expcat).attr("data-title", "Category");
        var expcatIt = "selExpcat" + iteration;

        func = "javascript:getMotPosttravel(this.value," + iteration + ")";
        expcat.innerHTML = '<select name="selExpcat[]" id="' + expcatIt + '" class="form-control" onchange="' + func + '" style="width:101px;"><option value="">Select</option><?php $selsql = select_all("expense_category", "*", "EC_Id IN (1,2,4)");
                                foreach ($selsql as $rowsql) { ?><option value="<?php echo $rowsql['EC_Id'] ?>"><?php echo $rowsql['EC_Name']; ?></option><?php } ?></select>';



        //MODE OF TRANSPORT
        var mot = row.insertCell(3);
        $(mot).attr("data-title", "Category");
        var motIt = "selModeofTransp" + iteration;


        mot.innerHTML = '<span id="modeoftr' + iteration + 'acontent"><select name="selModeofTransp[]" id="' + motIt + '" class="form-control" style="width:101px;"><option value="">Select</option><?php $selsql = select_all("mode", "*", "EC_Id IN (1,2,4) AND COM_Id IN (0, '$compid') AND MOD_Status=1");
                                foreach ($selsql as $rowsql) { ?><option value="<?php echo $rowsql['MOD_Id']; ?>"><?php echo $rowsql['MOD_Name']; ?></option><?php } ?></select></span>';


        //LOCATION
        var loc = row.insertCell(4);
        $(loc).attr("data-title", "Place");
        var selfromIt = "from" + iteration;
        var seltoIt = "to" + iteration;
        var spanid = 'city' + iteration + 'container';

        loc.innerHTML = '<span id="' + spanid + '"><input  name="from[]" id="' + selfromIt + '" type="text" placeholder="From" class="form-control"  autocomplete="off" style="width:100px;"><input  name="to[]" id="' + seltoIt + '" type="text" placeholder="To" class="form-control"  autocomplete="off" style="width:100px;"></span>';


        // estimated cost
        var n_a = row.insertCell(5);
        $(n_a).attr("data-title", "Estimated Cost");
        var n_aIt = "txtCost" + iteration;
        n_a.innerHTML = '<input type="text" class="form-control" name="txtCost[]" id="' + n_aIt + '" value="n/a" style="display:none;"/><span class="label label-default">N/A</span>';



        // booking status
        var n_a = row.insertCell(6);
        $(n_a).attr("data-title", "Booking Status");
        n_a.innerHTML = '<?php echo bookingStatus(); ?>';



        //COST
        var cost = row.insertCell(7);
        $(cost).attr("data-title", "Total Cost");
        // var costIt="txtAcualCost"+iteration;
        cost.innerHTML = '<input type="text" class="form-control" name="txtAcualCost[]" id="txtAcualCost[]" autocomplete="off"  onkeyup="actualAmnt(this.value, ' + iteration + '); return valActualCost(this.value);" autocomplete="off" style="width:75px;"/><input type="hidden" name="actualAmount[]" id="actualAmount' + iteration + '"  />';


        //FILE UPLOAD
        var fileup = row.insertCell(8);
        $(fileup).attr("data-title", "Upload Bills");
        var fileIt = "file" + iteration;
        //alert(fileIt);
        var filevalidIt = 'filevalidation' + iteration;
        fileup.innerHTML = '<input type="file" name="' + fileIt + '[]" id="' + fileIt + '[]" multiple="true" onchange="Validate(this.id);" style="width:120px;"><input type="hidden" name="filevalidation[]" id="' + filevalidIt + '" value="0" />';




        document.getElementById('removebuttoncontainer').innerHTML = '<a href="javascript:removeRowFromTableEdit();" title="Remove row" class="btn btn-default"><i class="fa fa-minus"></i></a>';

    }


    function getMotPosttravel(n, rownumber)
    {

        //alert(n+","+rownumber);

        var selfromIt = "from" + rownumber;
        var seltoIt = "to" + rownumber;
        var stayDur = "selStayDur" + rownumber;

        if (n == 1)
        {
            content = '<select name="selModeofTransp[]"  class="form-control" style="width:101px;"><option value="">Select</option><?php $selsql = select_all("mode", "*", "EC_Id=1 AND COM_Id IN (0, '$compid') AND MOD_Status=1");
                                foreach ($selsql as $rowsql) { ?><option value="<?php echo $rowsql['MOD_Id']; ?>"><?php echo $rowsql['MOD_Name']; ?></option><?php } ?></select>';

            citycontent = '<input  name="from[]" id="' + selfromIt + '" type="text" placeholder="From" class="form-control"  autocomplete="off" style="width:100px;"><input  name="to[]" id="' + seltoIt + '" type="text" placeholder="To" class="form-control"  autocomplete="off" style="width:100px;"><select name="selStayDur[]" id="' + stayDur + '" class="form-control" style="width:100px;display:none;"><option value="n/a">Select</option></select>';

        } else if (n == 2)
        {


            content = '<select name="selModeofTransp[]" class="form-control" style="width:101px;"><option value="">Select</option><?php $selsql = select_all("mode", "*", "EC_Id=2 AND COM_Id IN (0, '$compid') AND MOD_Status=1");
                                foreach ($selsql as $rowsql) { ?><option value="<?php echo $rowsql['MOD_Id']; ?>"><?php echo $rowsql['MOD_Name']; ?></option><?php } ?></select>';

            citycontent = '<input  name="from[]" id="' + selfromIt + '" type="text" placeholder="Location" class="form-control"  autocomplete="off" style="width:100px;"><input  name="to[]" id="' + seltoIt + '" type="text" style="display:none;" placeholder="To" class="form-control" value="n/a"><select name="selStayDur[]" id="' + stayDur + '" class="form-control" style="width:100px;"><option value="">Select</option><?php $selsql = select_all("stay_duration", "*", "");
                                foreach ($selsql as $rowsql) { ?><option value="<?php echo $rowsql['SD_Id']; ?>"><?php echo $rowsql['SD_Name']; ?></option><?php } ?></select>';



        } else if (n == 4)
        {
            content = '<select name="selModeofTransp[]" class="form-control" style="width:101px;"><option value="">Select</option><?php $selsql = select_all("mode", "*", "EC_Id=4 AND COM_Id IN (0, '$compid') AND MOD_Status=1");
                                foreach ($selsql as $rowsql) { ?><option value="<?php echo $rowsql['MOD_Id']; ?>"><?php echo $rowsql['MOD_Name']; ?></option><?php } ?></select>';


            citycontent = '<input  name="from[]" id="' + selfromIt + '" type="text" placeholder="Location" class="form-control"  autocomplete="off" style="width:100px;"><input  name="to[]" id="' + seltoIt + '" type="text" style="display:none;" placeholder="To" class="form-control" value="n/a"><select name="selStayDur[]" id="' + stayDur + '" class="form-control" style="width:100px; display:none;"><option value="n/a">Select</option></select>';

        }

        if (n) {

            modeoftranporid = "modeoftr" + rownumber + "acontent"
            cityfromtoid = "city" + rownumber + "container";

            //alert(citycontent);

            document.getElementById(modeoftranporid).innerHTML = content;
            document.getElementById(cityfromtoid).innerHTML = citycontent;

        }
    }




//PRE TRAVEL AFTER APPROVAL

    function valActualCost(costval)
    {

        if (costval.length >= 1) {
            var chks = document.getElementsByName('txtAcualCost[]');

            for (var i = 0; i < chks.length; i++)
            {
                var costcont = chks[i].value;

                reg = /[^0-9]/;
                if (reg.test(costcont)) {
                    chks[i].value = "";
                    alert("Only Numbers Allowed here");
                    chks[i].focus;
                    return false;
                } else {
                    getTotalActualCost();
                }
            }
        } else {

            getTotalActualCost();
        }

    }





    function getTotalActualCost()
    {

        var chks = document.getElementsByName('actualAmount[]');

        var actcost = document.getElementsByName('txtAcualCost[]');

        var totalcost = 0;

        for (var i = 0; i < chks.length; i++)
        {
            costotint = parseInt(chks[i].value.trim());

            if (costotint) {

                totalcost = totalcost + costotint;

                //alert(totalcost);
            }


        }

        totalcost = indianRupeeFormat(totalcost);



        // total act cost

        var totalactcost = 0;

        for (var i = 0; i < actcost.length; i++)
        {
            costotint = parseInt(actcost[i].value.trim());

            if (costotint) {

                totalactcost = totalactcost + costotint;

                //alert(totalcost);
            }


        }

        totalactcost = indianRupeeFormat(totalactcost);


        if (totalcost) {

            document.getElementById('totaltable').innerHTML = '<div class="table-responsive"><table class="table table-hover" style="font-weight:bold;"><tr><td align="right" width="85%">Claim Amount (Rs)</td><td width="5%" align="center">:</td><td align="right" width="10%"> ' + totalcost + '.00</td></tr></table></div>';


            document.getElementById('totalactcostid').innerHTML = totalactcost + '.00';



        } else {
            document.getElementById('totaltable').innerHTML = '';
        }
    }



    function actualAmnt(actamnt, iteration) {


        $("#actualAmount" + iteration).val(actamnt);

        //alert($("#actualAmount"+iteration).val());
    }



    function validateUpdatePretrvReq()
    {

        flag = 0;

        rowmax = document.getElementById('hidrowno').value;

        //alert("rowsss="+rowmax);

        var dates = document.getElementsByName('txtDate[]');
        var expdesc = document.getElementsByName('txtaExpdesc[]');
        var expcat = document.getElementsByName('selExpcat[]');
        var mode = document.getElementsByName('selModeofTransp[]');
        var from = document.getElementsByName('from[]');
        var to = document.getElementsByName('to[]');
        var selStayDur = document.getElementsByName('selStayDur[]');
        var ecost = document.getElementsByName('txtCost[]');
        var acost = document.getElementsByName('txtAcualCost[]');
        var fileValid = document.getElementsByName('filevalidation[]');



        //alert("rows="+rowmax);//return false;

        for (w = 0; w < rowmax; w++) {



            //dates----------------

            if (flag == 0) {

                if (dates[w].value.trim() == "")
                {
                    alert("Please enter date");
                    dates[w].focus();
                    flag = 1;
                    return false;
                } else if (isDate(dates[w].value.trim()) == false)
                {
                    dates[w].focus();
                    flag = 1;
                    return false;
                } else
                {

                    var traveldate = dates[w].value.trim();

                    var retvalue = chkTrvDate(2, traveldate);


                    if (retvalue == 2) {
                        alert("The entered date is greater than the current date");
                        flag = 1;
                        dates[w].focus();
                        return false;
                    }



                }
            }

            //expense desc---------------------

            if (flag == 0) {
                if (expdesc[w].value.trim() == "")
                {
                    alert("Please enter expense description");
                    expdesc[w].focus();
                    flag = 1;
                    return false;
                }
            }

            //expense category-------------
            if (flag == 0) {
                if (expcat[w].value == "")
                {
                    alert("Please enter expense category properly");
                    expcat[w].focus();
                    flag = 1;
                    return false;
                }
            }

            //mode----------------------
            if (flag == 0) {
                if (mode[w].value == "")
                {
                    alert("Please enter expense category properly");
                    mode[w].focus();
                    flag = 1;
                    return false;
                }
            }

            //from-----------------
            if (flag == 0) {
                if (from[w].value.trim() == "")
                {
                    alert("Please enter place properly");
                    from[w].focus();
                    flag = 1;
                    return false;
                }
            }

            //stay duration--------------
            if (flag == 0) {

                if (selStayDur[w].value.trim() == "")
                {
                    alert("Please enter stay durations.");
                    selStayDur[w].focus();
                    flag = 1;
                    return false;
                }
            }


            //to--------------------
            if (flag == 0) {
                if (to[w].value.trim() == "")
                {
                    alert("Please enter place properly");
                    to[w].focus();
                    flag = 1;
                    return false;
                }
            }

            // estimated cost-------------------------

            if (flag == 0) {

                if (ecost[w].value.trim() == "" || ecost[w].value.trim() == 0)
                {
                    alert("Please enter Cost");
                    ecost[w].focus();
                    flag = 1;
                    return false;
                }


            }


            // actual cost-------------------------

            if (flag == 0) {

                //alert(acost[w].value.trim());

                if (acost[w].value.trim() == "" || acost[w].value.trim() == 0)
                {
                    alert("Please enter Actual Cost");
                    acost[w].focus();
                    flag = 1;
                    return false;
                }


            }




            //bills----------------------

            /*if(flag==0)
             {
             
             
             var m=w+1;
             
             flname='file'+m+'[]';				
             
             var files 		= document.getElementById(flname).files;
             
             var filesLength	= files.length;
             
             //alert(filesLength)
             
             if((fileValid[w].value=="" && filesLength=="") || (fileValid[w].value=="0" && filesLength=="0")){
             
             alert("Please upload bills");
             document.getElementById(flname).focus();
             return false;
             
             
             }else if((fileValid[w].value=="" && filesLength) || (fileValid[w].value=="0" && filesLength)){
             
             flag=Validate(flname);
             
             if(flag)
             {
             document.getElementById(flname).focus();
             return false;
             }
             }		
             
             }*/

        } // end of for loop



        if (flag == 0)
            return true;
        else
            return false;

    }


</script>
