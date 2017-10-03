<?php   
global $wpdb;
 require_once WPERP_TRAVELDESK_PATH . '/includes/functions-traveldesk-req-dropdown.php';
$cmpid 	= $_GET['id'];
$type = $_POST['filter_status'];
$search = $_POST['s'];
//$type = $_REQUEST['selFilter'];

$comrow = companyUserDetails("COM_Name", $cmpid);

?>
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<div class="wrap erp-travelagentclient">
    
    
    
    
    <div class="page-header">
	
	<h1><?php _e( 'All Ticket Booking / Cancellation Requests - ' . $comrow->COM_Name, 'erp' );?></h1>

    </div>

	<ol class="breadcrumb">
    
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=travelagent-user-dashboard">Dashboard</a>
		</li>
	
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=requestview">Booking Requests</a>
		</li>
	
	</ol>
	
	<div class="workforce-filter-wrapper">
	<div class="workforce-filter">
	<div class="workforce-filter-title">
		
            <form method="POST" action="#">
            <div class="workforce-filter-form-inner">
            		<div id="filter-keyword-wrapper" class="form-group text">
            		
            		<input type="text" value="<?php echo $search; ?>" name="s" placeholder="Request Code">
            		</div>
			
			
			<div id="filter-keyword-wrapper" class="form-group text">
          
            <select name="filter_status" id="filter_status">
                <option value="">All</option>
                <option value="1" <?php if ($type == 1) echo 'selected="selected"'; ?> >Pending Booking Requests</option>
                <option value="2" <?php if ($type == 2) echo 'selected="selected"'; ?>>Pending Cancellation Requests</option>
                <option value="3" <?php if ($type == 3) echo 'selected="selected"'; ?>>All Booking Requests</option>
                <option value="4" <?php if ($type == 4) echo 'selected="selected"'; ?>>All Cancellation Requests</option>
            </select>
			</div>
			<div id="filter-keyword-wrapper" class="form-group text">
            <?php
            submit_button(__('Filter Requests'), 'button button button-primary', '', false);
            ?>
			</div>
            </div>
		
            </div>
                <div class="text-warning">**<b>Important Note</b>: <i>Group Booking Requests couldn't be Canceled after Booking. So Group Booking update can be done just a day before the trip.</i></div>
            </div>
	    </form>
    
		<?php
			global $wpdb;
			
            $table = new WeDevs\ERP\Travelagentuser\Travel_Agent_Request_List_Table();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'custom_table_example'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
       <div class="list-table-wrap erp-travelagentclient-wrap">
        <div class="list-table-inner erp-travelagentclient-wrap-inner">
            <?php echo $message;?>
			<form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php //$table->search_box('Search', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php //$table->display() ?>
            </form>

        </div>
        </div>
        <!-- Table Requests -->
        
        <div class="">
            <?php 
			
		  echo '<br>';
		  
		  $row=$wpdb->get_row("SELECT * FROM tolerance_limits WHERE COM_Id='$cmpid' AND TL_Status=1 AND TL_Active=1");
		  
		  if($row->TL_Percentage)
		  echo ' <div class="alert alert-warning"><i><b>Note: </b>Tolerance Limit '.$row->TL_Percentage.'%. Please dont exceed the tolerance limit for booking tickets amounts. </i></div><br />';
					
	switch ($type) {

		case 1:
			$q = 'AND bs.BS_Status=1 AND bs.BA_Id=1';
			break;
	
		case 2:
			$q = 'AND bs.BS_Status=3 AND bs.BA_Id=1';
			break;
	
		case 3:
			$q = 'AND bs.BS_Status=1';
			break;
	
		case 4:
			$q = 'AND bs.BS_Status=3';
			break;
	}
    
    if($search)
    $q .= " AND (req.REQ_Code LIKE '%$search%')";

$selsql = $wpdb->get_results("SELECT DISTINCT(req.REQ_Id), req.* FROM requests req, request_details rd, booking_status bs WHERE req.COM_Id='$cmpid' $q AND "
        . "req.REQ_Id=rd.REQ_Id AND bs.BS_Status IN (1,3) AND rd.RD_Id=bs.RD_Id AND BS_Active=1 ORDER BY req.REQ_Id DESC");
        $i = 1;

    ?>
			<div class="postbox">
            <div class="inside">
			
			<p>&nbsp;</p>
            
            <div class="panel-group">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr height="35">
                      <th width="10%" style="text-align:left;">Sl.no. </th>
                      
                      <th width="15%" style="text-align:left; padding-left:5px;">Request Code</th>
                      <th width="15%" style="text-align:left; padding-left:5px;">Employee No.s</th>
                      <th width="10%" style="text-align:left;">Quantity</th>
                      <th width="25%" >Date</th>
                      <th width="20%" style="text-align:left;">Quote Amount (Rs)</th>
                      <th width="10%" style="text-align:left; padding-left:5px;">&nbsp;</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <?php
                                $j = 1;

                                foreach ($selsql as $rowsql) {
								
									//ECHO $rowsql['REQ_Type'].'<BR>';
									
									
									$void=0; $icon=0; $onclick=NULL;
									
									
									switch($rowsql->REQ_Active){
						
										case 1:	
											$reqcode = $rowsql->REQ_Code;								
										break;
										
										case 9:
											$reqcode = '<i title="Removed Request">'.$rowsql->REQ_Code.'</i>';
										break;
										
									
									}
									
									
									
									$selsql = "
									
										SELECT 
										
										  GROUP_CONCAT(DISTINCT CONVERT(rd.RD_Id,
										  CHAR(8))) AS rdids,
										  COUNT(DISTINCT rd.RD_Id) AS rdCnt,
										  COUNT(DISTINCT RE_Id) AS empCnt,
										   
										  ((SUM(rd.RD_Cost)*COUNT(DISTINCT rd.RD_Id))/COUNT(*)) as rdcost,
										  SUM(rd.RD_TotalCost)*count(DISTINCT rd.RD_Id)/count(*) as rdGrpcost,
										   
										  GROUP_CONCAT(DISTINCT CONVERT(bs.BA_Id,
										  CHAR(8))) AS baids
										  
										FROM
										
										requests req
										LEFT JOIN
										  request_details rd ON req.REQ_Id = rd.REQ_Id
										LEFT JOIN
										  request_employee re ON req.REQ_Id = re.REQ_Id
										LEFT JOIN
										  booking_status bs ON rd.RD_Id = bs.RD_Id
										
										WHERE
										req.REQ_Id = '$rowsql->REQ_Id' AND bs.BS_Status IN(1,3) AND BS_Active = 1 AND rd.RD_Status = 1
										GROUP BY
										  req.REQ_Id
										
									";
									
									//echo $selsql.'<br>';
									
									//$getvals = rawSelectQuery($selsql, $filename, $show = false);
								
									$getvals = $wpdb->get_row($selsql);
									
									$reqtype = $rowsql->REQ_Type;
									
									$alertBadge = 0;
								
									switch ($rowsql->REQ_Type){
							
										
										case 2:
										
											$href='admin.php?page=RequestDetails';
											$type='<span style="font-size:10px;" title="Booking Request">[E]</span>';
											$title="Employee Request";
											
											$totalcosts = IND_money_format(floor($getvals->rdcost)). ".00"; 
																		
										break;
										
										
									
										case 4:
										
											$href='admin.php?page=RequestDetails';
											$type='<span style="font-size:10px;" title="Group Booking Request">[G]</span>';
											$title="Group Request";
											
											$totalcosts = IND_money_format(floor($getvals->rdGrpcost)). ".00"; 
											
										break;
										
										
									
									}
									
						$badge = $icon = $onclick = null; 			 
									
						if( in_array(1, explode(",", $getvals->baids)) )
						$badge = '<span class="status-1">'.$getvals->rdCnt.'</span>'; 
						else
						$badge = '<span class="status-2">'.$getvals->rdCnt.'</span>'; 
								
                                    ?>
              <div class="panel panel-shadow">
                <header class="panel-heading" style="padding:0 10px">
                  <div class="table-responsive">
                    
                    <table class="table table-hover">
                      <tr>
                        <td  width="10%"><?php echo $i; ?>. </td>
                       
                        <td  width="15%" title="<?php if($icon==1) echo 'sent for claims'; else if($icon==2) echo 'claimed'; ?>"><a href="<?php echo $href; ?>&reqid=<?php echo $rowsql->REQ_Id; ?>"><?php echo $reqcode; ?></a> 
						<?php echo $type;  ?>
                          <?php 
						  
						  if($icon==1) 
						  echo '<i class="fa fa-thumbs-o-up"></i>'; 
						  else if($icon==2) 
						  echo '<i class="fa fa-thumbs-up"></i>'; 
						  
						  ?></td>
                        <td width="15%" style=" padding-left:25px;"><?php echo $getvals->empCnt ?></td>
                        <td width="10%" style="text-align:left;"><?php  echo $badge;  ?></td>
                        <td width="25%" style="text-align:center; padding-left:30px;"><?php  echo date('d-M-Y', strtotime($rowsql->REQ_Date)) ?></td>
                        <td width="20%" style="text-align:center;"><?php echo $totalcosts; ?></td>
                        <td><a data-toggle="collapse" href="#collapse<?php echo $i; ?>"><i class="collapse-caret fa fa-angle-down"></i> </a> </td>
                      </tr>
                    </table>
                  </div>
                </header>
				<?php 
				if($getvals->rdids){
				?>
				
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                  <!--div class="panel-body"-->
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover" style="font-size:11px;">
                        <thead>
                          <tr>
                            <th width="10%">Date</th>
                            <th width="20%">Expense<br />
                              Description</th>
                            <th width="10%" colspan="2">Expense <br />
                              Category</th>
                            <th width="10%">Place</th>
                            <th width="10%">Estimated <br />
                              Cost</th>
                            <th width="20%">Booking Status</th>
                            <th  width="20%">Cancellation <br />
                              Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
							$rddetails =  $wpdb->get_results("SELECT * FROM request_details rd, expense_category ec, mode mo WHERE REQ_Id='$rowsql->REQ_Id' AND rd.EC_Id=ec.EC_Id AND rd.MOD_Id=mo.MOD_Id ORDER BY RD_Id ASC");
                           
							$rdids = "";



							foreach ($rddetails as $rowsql) {
							
							
								?>
                          <tr>
                            <td align="center"><?php echo date('d-M-Y', strtotime($rowsql->RD_Dateoftravel)); ?><br />
							
							<?php 
								
								if($rowsql->RD_Status == 9){
								
									echo removedByClient();
								}
							
							?>
							</td>
                            <td ><div style="height:40px; overflow-y:auto;"><?php echo stripslashes($rowsql->RD_Description); ?></div></td>
                            <td width="5%"><?php echo $rowsql->EC_Name; ?></td>
                            <td width="5%"><?php echo $rowsql->MOD_Name; ?></td>
                            <td><?php if ($rowsql->EC_Id == 1) { ?>
                              <b>From:</b> <?php echo $rowsql->RD_Cityfrom; ?><br />
                              <b>To:</b> <?php echo $rowsql->RD_Cityto; ?>
                              <?php } else { ?>
                              <b>Loc:</b> <?php echo $rowsql->RD_Cityfrom; ?>
                              <?php
								if ($rowsd = $wpdb->get_row("SELECT SD_Name FROM stay_duration WHERE SD_Id='$rowsql->SD_Id'")) {
									echo '<br>Stay :' . $rowsd->SD_Name;
								}
								?>
                              <?php } ?></td>
							  
							  
							  
                            <td align="center">
							
							<?php 
							  
							  $rdcost = null;
							  
							  
							  //echo $reqtype;
							  	
								switch($reqtype){
								
									case 2:
										echo  IND_money_format($rowsql->RD_Cost);
									break;
									
									case 4:
										echo 'Unit Cost - '.IND_money_format($rowsql->RD_Cost) . '<br>'; 
										echo 'Total Cost - '.IND_money_format($rowsql->RD_TotalCost);
										
									break;
									
									
								
								}
							  
							  ?>
							  
							
							
							</td>
                            <!----- BOOKING STATUS STATUS ------>
                            <td><?php
                                    $imdir= WPERP_COMPANY_DOWNLOADS . "/erp/modules/company/upload/$cmpid/bills_tickets/";
                                    $selrdbs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='$rowsql->RD_Id' AND BS_Status=1 AND BS_Active=1");    
                                    
									if ($selrdbs->RD_Id) {
									
									
									switch($selrdbs->BA_Id){
									
									
										case 1: {
										
									
											echo ($selrdbs->BA_Id == 1) ? bookingStatus($selrdbs->BA_Id) . "<br>" : '';
		
											echo '<b>Request date: </b>' . date('d-M-y (h:i a)', strtotime($selrdbs->BS_Date)) . "<br>";
				
											echo '----------------------------------<br>';
				
											$query = "BA_Id IN (2,3)";
										
										
										break;
										
										}
										
										
										
										case 2: case 3: {
										
											
											echo bookingStatus($selrdbs->BA_Id);
				
				
											switch ($selrdbs->BA_Id) {
				
												case 2:{
													
													$doc = NULL;  // getting documents uploaded.
													
													$seldocs = $wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='". $selrdbs->BS_Id ."'");
				
													$f = 1;
					
													foreach ($seldocs as $docs) {
					
														$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" class="btn btn-link" download>download</a><br>';
					
														$f++;
													}
												
													echo '<br>';
													echo '<b>Booked Amnt:</b> ' . IND_money_format($selrdbs->BS_TicketAmnt) . '.00</span><br>';
													echo $doc;
													echo '<b>Booked Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
													
													break;
													}
													
				
												case 3:{
													echo '<br>';
													echo '<strong>Failed Date</strong>: ' . date('d-M-y (h:i a)', strtotime($selrdbs->BA_ActionDate));
													break;
													}
											}
										
										break;
										}
										
									
									}
                                                                        
								  
						 
								} else {

									echo bookingStatus(NULL);
								}
								?>
									    
                                    
                            </td>
                            <!----- CANCELLATION STATUS ------>
                            <td><?php
                                $selrdcs = $wpdb->get_row("SELECT * FROM booking_status WHERE RD_Id='". $rowsql->RD_Id ."' AND BS_Status=3 AND BS_Active=1");
                                if ($selrdcs->RD_Id) {
		
									echo ($selrdcs->BA_Id == 1) ? bookingStatus($selrdcs->BA_Id) . "<br>" : '';
		
									echo '<b title="cancellation request date">Request Date: </b>' . date('d-M-y (h:i a)', strtotime($selrdcs->BS_Date)) . "<br>";
		
									echo '----------------------------------<br>';
		
									$query = "BA_Id IN (4,5)";
								}

							    echo bookingStatus($selrdcs->BA_Id);
							    switch ($selrdcs->BA_Id) {

								case 4: case 6:
									
									$doc = NULL;
								
									$seldocs = $wpdb->get_results("Select * FROM booking_documents WHERE BS_Id='$selrdcs->BS_Id'");
	
									$f = 1;
	
									foreach ($seldocs as $docs) {
	
										$doc.='<b>Uploaded File no. ' . $f . ': </b> <a href="' . $imdir . $docs->BD_Filename . '" download="file_name" class="btn btn-link">download</a><br>';
	
										$f++;
									}
									
									echo '<br><b>Cancellation Amnt</b>: ' . IND_money_format($selrdcs->BS_CancellationAmnt) . '.00<br>';
									echo $doc;
									echo '<b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;

								case 5: case 7:
									echo '<br><b>Cancellation Date</b>: ' . date('d-M-y (h:i a)', strtotime($selrdcs->BA_ActionDate));
									break;
							}
											
                                                                               
                            ?>
                            </td>
                          </tr>
                          <?php
							$j++;
						}
						?>
                        </tbody>
                      </table>
                    </div>
                  <!--/div-->
                  <!-- //panel-body -->
                </div>
                <!-- //panel-collapse -->
				
				<?php } ?>
				
              </div>
              <?php
                                    $i++;
                                }

                                //mysqli_free_result($ressql); 
                                ?>
              <!-- //panel -->
            </div>

          </div>
        </div></div>
        <!-- Table Requests -->
</div>
