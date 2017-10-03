<div class="wrap erp-traveldesk">
<?php
	global $wpdb;
	$txtReqid = ( isset($_REQUEST['txtReqid']) ) ? $_REQUEST['txtReqid'] : '';
	$reqtype = ( isset($_REQUEST['reqtype']) ) ? $_REQUEST['reqtype'] : 0;
	$selReqstatus	= ( isset($_REQUEST['selReqstatus']) ) ? $_REQUEST['selReqstatus'] : '';
?>
<ol class="breadcrumb">
    
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=traveldesk-dashboard">Travel Desk Expense Requests</a>
		</li>
	</ol>
	<div class="workforce-filter-wrapper">
	<div class="workforce-filter">
	<div class="workforce-filter-title">
		
            <form method="POST" action="#">
            <div class="workforce-filter-form-inner">
            		<div id="filter-keyword-wrapper" class="form-group text">
            		
            		<input type="text" name="s" placeholder="Request Code">
            		</div>
			<div id="filter-keyword-wrapper" class="form-group text">
            <select class="form-control" name="reqtype" id="reqtype">
                  <option value="">All</option>
                  <?php 
				  $selsql=$wpdb->get_results("SELECT * FROM td_request_type");
				  
				  foreach($selsql as $rowsql){
					  print_r($rowsql);
				  ?>
                  <option value="<?php echo $rowsql->TRT_Id; ?>" <?php if($reqtype==$rowsql->TRT_Id) echo 'selected="selected"';?> ><?php echo $rowsql->TRT_Name; ?></option>
                  <?php } ?>
                </select>
			</div>
			<div id="filter-keyword-wrapper" class="form-group text">
           
            <select class="form-control" name="selReqstatus" id="selReqstatus">
                  <option value="">All</option>
                  <option value="2" <?php if($selReqstatus==2) echo 'selected="selected"';?> >Approved</option>
                  <option value="1" <?php if($selReqstatus==1) echo 'selected="selected"';?>>Pending</option>
                  <option value="3" <?php if($selReqstatus==3) echo 'selected="selected"';?>>Rejected</option>
                </select>
		    </div>
			<!--div id="filter-keyword-wrapper" class="form-group text">
          
            <select name="filter_status" id="filter_status">
                <option value="">- Status -</option>
                <option value="2" <?php if ($selected_status == 1) echo 'selected="selected"'; ?> >Allowed</option>
                <option value="1" <?php if ($selected_status == 2) echo 'selected="selected"'; ?> >Blocked</option>
            </select>
			</div-->
			<div id="filter-keyword-wrapper" class="form-group text">
            <?php
            submit_button(__('Filter'), 'button button button-primary', '', false);
            ?>
			</div>
            </div>
		</div>
            </div>
            </form>
	<h2>
        <?php
        _e( 'All Requests', 'erp' );
		//$compid = $_SESSION['compid'];
        ?>
    </h2>
		<?php
			global $wpdb;
			
            $table = new WeDevs\ERP\Traveldesk\Travel_Desk_Request_List_Table();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'custom_table_example'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
       <div class="list-table-wrap erp-traveldesk-wrap">
        <div class="list-table-inner erp-traveldesk-wrap-inner">
            <?php echo $message;?>
			<form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php //$table->search_box('Search', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>
</div>
