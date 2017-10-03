<link rel="stylesheet" href="segments.css" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" id="bootstrap.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="iconpicker-css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/fontawesome-iconpicker.css" type="text/css" media="all">
<link rel="stylesheet" id="icomoon.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/icomoon.css" type="text/css" media="all">
<link rel="stylesheet" id="weather-icons.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/weather-icons.min.css" type="text/css" media="all">
<!--link rel="stylesheet" id="fontawesome-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/font-awesome.css" type="text/css" media="all"-->
<!--link rel="stylesheet" id="styles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/styles(1).css" type="text/css" media="all"-->
<link rel="stylesheet" id="mystyles.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/mystyles.css" type="text/css" media="all">
<link rel="stylesheet" id="default-style-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/style(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom(1).css" type="text/css" media="all">
<link rel="stylesheet" id="custom2css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom2.css" type="text/css" media="all">
<link rel="stylesheet" id="user.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/user.css" type="text/css" media="all">
<link rel="stylesheet" id="custom-responsive-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/custom-responsive.css" type="text/css" media="all">
<link rel="stylesheet" id="st-select.css-css" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/quote/st-select.css" type="text/css" media="all">
 
 <link rel="stylesheet" href="<?php echo WPERP_EMPLOYEE_ASSETS ?>/css/styles2.css" />

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="wrap">
<div id="icon-options-general" class="icon32"></div>
	
<!--h2> General Expenses </h2-->

<style type="text/css">
		
		
		ul.tab {
		    list-style-type: none;
		    margin: 0;
		    overflow:hidden;
			padding-top:9px;
			padding-bottom:0;
		    //background-color: #fff;
		
			line-height: inherit;
		
		}
		ul.tab:after{
			 position: absolute;
		  content: "";
		  width: 100%;
		  bottom: 0;
		  left: 0;
		    z-index: 1;
			  
		}
		
		/* Float the list items side by side */
		ul.tab li {float: left;}
		
		/* Style the links inside the list items */
		ul.tab li a {
		    display: inline-block;
		    color: black;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		    transition: 0.3s;
		   font-size:17px;
			  
				
		
		}
		li a:focus, .active{
		   
		   //background-color:#fff;
		}
		.show{
			background-color:#ddd;
		}
		
		/* Change background color of links on hover */
		
		.inactive{
			background-color:#ddd;
		}
		
		
		/* Style the tab content */
		.tabcontent {
		    display: none;
		    padding: 6px 12px;
		    border-top: none;
			
		}
		
		 select#wgmstr {
    max-width: 50px;
    min-width: 50px;
    width: 50px !important;
}
		.tab.active {
		    display:block;
			  
		}
		 a.active{
			 //background: #FFFFFF !important;
		     border-bottom:3px solid #0096A8 !important;
			 color:#0096A8 !important;
			 
		 }
		</style>   
		
		<script>
		  function travel(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		   }
		   function employee(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontente");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinkse");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		   }
	        </script>
	        
	        <!-- Expenses Tab Start -->
<div class="container-fluid">
    <div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading" style="padding: 0px; padding-top: 5px; padding-left: 5px;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#my" data-toggle="tab"><i class="fa fa-car"></i> Mileage</a></li>
                            <li><a href="#myteam" data-toggle="tab"><i class="fa fa-cutlery"></i> Utility</a></li>
                            <!--li class="active"><a href="#other" data-toggle="tab"><i class="fa fa-money"></i> General Expense</a></li-->
                        </ul>
                </div>
              
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="my">
                         <!-- Block 1 -->
                        <div id="Pretravel" class="box panel-widget-style tabcontente tab active" style="margin-bottom: 10px;">
              
				<div class="postbox">
                <div class="inside">
				 <?php
				global $wpdb;

				$table = new WeDevs\ERP\Employee\Mileage_Requests_List();
				$table->prepare_items();

				$message = '';
				if ('delete' === $table->current_action()) {
					$message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
				}
				?>
				<div class="row">
				<div class="col-md-2 col-sm-12 col-xs-12">
				<a href="/wp-admin/admin.php?page=create-mileage" class="btn btn-success btn-block <?php echo $active_tab == 'Pre-travel' ? 'nav-tab-active' : ''; ?>"><?php _e('Create New', 'Pre-travel'); ?></a>
				</div>
				<div class="col-md-3 col-xs-12 pull-right">
					<form method="post">
					  <input type="hidden" name="page" value="Requests" />
					  <?php //$table->search_box('Search', 'search_id'); ?>
					  
					  <div class="input-group">
						   <input type="search" id="search_id-search-input" placeholder="Request Code" name="sm" value="<?php echo $_REQUEST['sm'] ?>" class="form-control">
						   <span class="input-group-btn">
								<input type="submit" id="search-submit" class="btn btn-default" value="Search">
						   </span>
					  </div>
					 
					</form>
				</div>
				</div>
        
       
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

                    </div>
                </div>
                </div>
            </div>
	</div>
                        </div>
                       
                        <div class="tab-pane fade" id="myteam">
                        <div id="Submit" class="box panel-widget-style tabcontente tab active tabcontente tab">
              
		<div class="postbox">
		<div class="inside">
		<?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Employee\Utility_Requests_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
					<a href="/wp-admin/admin.php?page=create-utility" class="btn btn-success btn-block <?php echo $active_tab == 'Pre-travel' ? 'nav-tab-active' : ''; ?>"><?php _e('Create New', 'Pre-travel'); ?></a>
					</div>
					<div class="col-md-3 col-xs-12 pull-right">
						<form method="post">
						  <input type="hidden" name="page" value="Requests" />
						  <?php //$table->search_box('Search', 'search_id'); ?>
						  
						  <div class="input-group">
							   <input type="search" id="search_id-search-input" placeholder="Request Code" name="s" value="<?php echo $_REQUEST['s'] ?>" class="form-control">
							   <span class="input-group-btn">
									<input type="submit" id="search-submit" class="btn btn-default" value="Search">
							   </span>
						  </div>
						 
						</form>
					</div>
				</div>
       
        
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

                    </div>
                </div>
                </div>
            </div> 
	</div>
                        </div>
                        
                        <div class="tab-pane fade" id="other">
                        <div id="Submit" class="box panel-widget-style tabcontente tab active tabcontente tab">
              
	<div class="postbox">
                <div class="inside">
<h2 class="nav-tab-wrapper" style="
    width: 20% !important;
    padding: 0px;
    width: -4%;
    border: none;
    margin-bottom:-32px;
"><a href="/wp-admin/admin.php?page=create-others" class="btn btn-success <?php echo $active_tab == 'Pre-travel' ? 'nav-tab-active' : ''; ?>"><?php _e('Create New', 'Pre-travel'); ?></a></h2>
        
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Employee\Others_Requests_List();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'companies_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
            <?php //$table->views(); ?>
			<form method="post">
			  <input type="hidden" name="page" value="Requests" />
			  <?php $table->search_box('Search Request Code', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

                    </div>
                </div>
                </div>
            </div>  
	</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
	</div>
</div>
	        
	    
				

