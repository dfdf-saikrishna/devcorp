<?php
$compid = $_SESSION['compid'];
global $wpdb;
$dep=$_POST['depId'];
$selected_status=$_POST['filter_status'];
$grade=$_POST['egId'];
?>
<div class="wrap erp-hr-company" id="wp-erp">
<div class="page-header">
	
	<h1>Booking Requests</h1>

	

	
		
	<div class="page-header-actions">
		<a id="erp-companyemployee-new" class="btn btn-primary">
			Add Request		</a>
	</div><!-- /.page-header-actions -->
</div>

	<ol class="breadcrumb">
    
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=company-dashboard">Dashboard</a>
		</li>
	
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=menu">Booking Requests</a>
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
            <?php
            submit_button(__('Filter Requests'), 'button button button-primary', '', false);
            ?>
			</div>
            </div>
		
            </div>
            </div>
	    </form>
	


    <!--h2>
        <?php
        //_e( 'Employee', 'erp' );

        if ( current_user_can( 'companyadmin' ) ) {
            ?>
                <a href="#" id="erp-companyemployee-new" class="add-new-h2"><?php _e( 'Add New', 'erp' ); ?></a>
            <?php
        }
        ?>
    </h2-->
    <!-- Messages -->
    <div style="display:none" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
    </div>
    <div style="display:none" id="success" class="notice notice-success is-dismissible">
        <p id="p-success"></p>
    </div>
        <?php
    	$selected_status = ( isset($_GET['filter_status']) ) ? $_GET['filter_status'] : 0;
        $dep = ( isset($_GET['depId']) ) ? $_GET['depId'] : '';
        $grade = ( isset($_GET['egId']) ) ? $_GET['egId'] : '';
        ?>
        
    
    
	<?php
        $employee_table = new \WeDevs\ERP\Travelagentclient\Booking_Requests_List_Table();
        $employee_table->prepare_items();
        $message = '';
            if ('delete' === $employee_table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
                ?>
     <div class="list-table-wrap erp-hr-employees-wrap">
        
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
			<!--form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php //$employee_table->search_box('Search Employee', 'search_id'); ?>
			</form-->
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $employee_table->display() ?>
            </form>

        </div>
        </div>

</div>

