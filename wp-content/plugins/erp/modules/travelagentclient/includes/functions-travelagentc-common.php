<?php
function travelagentuserrequestDetails($et){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $supid = $_SESSION['supid'];
    $row=$wpdb->get_row("SELECT * FROM requests req, request_employee re, assign_company ac WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND req.COM_Id=ac.COM_Id AND ac.SUP_Id = $supid AND AC_Status = 1 AND AC_Active = 1 AND REQ_Type=2 AND RE_Status=1");
    $compid = $row->COM_Id;
    echo '<div class="table-wrapper">';
    echo '<table class="table">';
    echo '<tr>';
    echo '<td width="20%">Request Id</td>';
    echo '<td width="5%">:</td>';
    echo '<td width="25%">'.$row->REQ_Code.'</td>';
 
  echo '</tr>';
  /*------SECOND ROW ------*/
  echo '<tr>';
     echo  '<td width="20%">Request Date</td>';
     echo '<td width="5%">:</td>';
     echo '<td width="25%">'.date("d-M-y (h:i a)",strtotime($row->REQ_Date)).'</td>';
  echo '</tr>';
echo '</table>';
echo '</div>';
}
function travelagentclientrequestDetails($et){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $compid = $_SESSION['compid'];
    $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Type=2 AND RE_Status=1");
    echo '<div class="table-wrapper">';
    echo '<table class="table">';
    echo '<tr>';
    echo '<td width="20%">Request Id</td>';
    echo '<td width="5%">:</td>';
    echo '<td width="25%">'.$row->REQ_Code.'</td>';
 
  echo '</tr>';
  /*------SECOND ROW ------*/
  echo '<tr>';
     echo  '<td width="20%">Request Date</td>';
     echo '<td width="5%">:</td>';
     echo '<td width="25%">'.date("d-M-y (h:i a)",strtotime($row->REQ_Date)).'</td>';
  echo '</tr>';
echo '</table>';
echo '</div>';
}
function travelagentclientgrouprequestDetails($et){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $compid = $_SESSION['compid'];
    $row = $wpdb->get_row("SELECT * FROM requests req, request_employee re WHERE req.REQ_Id='$reqid' AND req.REQ_Id=re.REQ_Id AND COM_Id='$compid' AND REQ_Type=4 AND RE_Status=1");
    echo '<div class="table-wrapper">';
    echo '<table class="table">';
    echo '<tr>';
    echo '<td width="20%">Request Id</td>';
    echo '<td width="5%">:</td>';
    echo '<td width="25%">'.$row->REQ_Code.'</td>';
 
  echo '</tr>';
  /*------SECOND ROW ------*/
  echo '<tr>';
     echo  '<td width="20%">Request Date</td>';
     echo '<td width="5%">:</td>';
     echo '<td width="25%">'.date("d-M-y (h:i a)",strtotime($row->REQ_Date)).'</td>';
  echo '</tr>';
echo '</table>';
echo '</div>';
}
function travelagentusergrouprequestDetails($et){
    global $wpdb;
    $reqid  =   $_GET['reqid'];
    $supid = $_SESSION['supid'];
    $row=$wpdb->get_row("SELECT * FROM requests req, assign_company ac WHERE REQ_Id='$reqid' AND ac.SUP_Id = $supid AND req.COM_Id = ac.COM_Id AND AC_Status = 1 AND AC_Active = 1 AND REQ_Active=1 AND REQ_Type=4");
    $compid = $row->COM_Id;
    echo '<div class="table-wrapper">';
    echo '<table class="table">';
    echo '<tr>';
    echo '<td width="20%">Request Id</td>';
    echo '<td width="5%">:</td>';
    echo '<td width="25%">'.$row->REQ_Code.'</td>';
 
  echo '</tr>';
  /*------SECOND ROW ------*/
  echo '<tr>';
     echo  '<td width="20%">Request Date</td>';
     echo '<td width="5%">:</td>';
     echo '<td width="25%">'.date("d-M-y (h:i a)",strtotime($row->REQ_Date)).'</td>';
  echo '</tr>';
echo '</table>';
echo '</div>';
}