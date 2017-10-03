<?php
$compid = $_SESSION['compid'];
?>
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<style>
    .bg-warning {
    background-color: #ffcc33 !important;
    color: white !important;
    }
    .bg-theme {
    background-color: #f35958 !important;
    color: white !important;
    }
    .bg-success {
    background-color: #2ecc71 !important;
    color: white !important;
    }
</style>
<div class="wrap erp hrm-dashboard">

    <h3>Dashboard</h3>	  
    <div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
    <!--div class="badge-wrap badge-aqua box panel-widget-style"-->

<div id="main">
  <div id="content">
      <div class="">   
      <section class="panel">
        <div class="panel-body">
          <div class="col-md-6">
             
             
            <ul class="list-group">
              <li class="list-group-item">
                <h4><strong>Employee's Booking / Cancellation Requests</strong></h4>
              </li>
              <li class="list-group-item" title="Pending Booking Request" ><span class="badge bg-warning" ><?php echo getCountRequests(1, $compid); ?></span> Pending Booking Requests</li>
              <li class="list-group-item" title="Pending Cancellation Request"  ><span class="badge bg-theme"><?php echo getCountRequests(2, $compid); ?></span> Pending Cancellation Requests</li>
              <li class="list-group-item" title="All Booking Request" ><span class="badge bg-success"><?php echo getCountRequests(3, $compid); ?></span> All Booking Requests</li>
              <li class="list-group-item" title="All Cancellation Request" ><span class="badge bg-success"><?php echo getCountRequests(4, $compid); ?></span> All Cancellation Requests</li>
            </ul>
          </div>
          <?php /*?><?PHP $count_total = count_query("requests", "REQ_Id", "WHERE COM_Id='$compid' AND REQ_Active !=9 AND REQ_Type IN (2,3,4)", $filename); ?>
          <?PHP $count_approved = count_query("requests", "REQ_Id", "WHERE COM_Id='$compid' AND REQ_Status=2 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)", $filename); ?>
          <?php $count_pending = count_query("requests", "REQ_Id", "WHERE COM_Id='$compid' AND REQ_Status=1 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)", $filename); ?>
          <?php $count_rejected = count_query("requests", "REQ_Id", "WHERE COM_Id='$compid' AND REQ_Status=3 AND REQ_Active!=9  AND REQ_Type IN (2,3,4)", $filename); ?>
          <div class="col-md-6">
            <ul class="list-group">
              <li class="list-group-item">
                <h4><strong>TRAVEL DESK EXPENSE REQUESTS</strong></h4>
              </li>
              <li class="list-group-item" <?php if ($count_pending) { ?>onclick="window.location.href='travel-desk-request-listing.php?selReqstatus=1'" <?php } ?>  title="Pending"><span class="badge bg-warning"><?php echo $count_pending; ?></span> Pending Requests</li>
              <li class="list-group-item" <?php if ($count_approved) { ?> onclick="window.location.href='travel-desk-request-listing.php?selReqstatus=2'" style="cursor:pointer;"<?php } ?>  title="Approved"><span class="badge bg-success"><?php echo $count_approved; ?></span> Approved</li>
              <li class="list-group-item" <?php if ($count_rejected) { ?> onclick="window.location.href='travel-desk-request-listing.php?selReqstatus=3'" style="cursor:pointer;" <?php } ?>  title="rejected"><span class="badge bg-danger"><?php echo $count_rejected; ?></span> Rejected</li>
              <li class="list-group-item" <?php if ($count_total) { ?> onclick="window.location.href='travel-desk-request-listing.php'" style="cursor:pointer;"<?php } ?> title="Total Requests" ><span class="badge bg-primary"><?php echo $count_total; ?></span> Total Requests</li>
            </ul>
          </div><?php */?>
        </div>
      </section>
     
    </ </div>
  <!-- //content-->
</div>
<!-- //main-->		
    </div>
    </div>
    </div>
</div>								
