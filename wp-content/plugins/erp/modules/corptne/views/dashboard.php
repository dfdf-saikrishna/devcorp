<?php 

$filename="";
$empcount=count_query("company","COM_Id","WHERE COM_Status=0",$filename,0);
	
$totalMasterAdmin=count_query("superadmin","SUP_Id","WHERE SUP_Type = 2 AND SUP_Status=1",$filename);
				  
$accgadmins=count_query("superadmin","SUP_Id","WHERE SUP_Status=1 AND SUP_Id = 2 AND SUP_Access=1",$filename);

?>
<div class="wrap erp hrm-dashboard">
    <h2><?php _e( 'Dashboard', 'superadmin' ); ?></h2>
	    <div class="erp-single-container">

        <!--div class="erp-area-left"-->
                <div class="badge-container">
                    <div class="badge-wrap badge-green">
                        <div class="badge-inner">
                            <h3><a href="#"><?php echo $empcount?></a></h3>
                            <p style="color: #000">TOTAL <b>COMPANIES</b></p>
                        </div>

<!--                        <div class="badge-footer wp-ui-highlight">
                            <a href="">View Companies</a>
                        </div>-->
                    </div><!-- .badge-wrap -->	
					<div class="badge-wrap badge-aqua">
						<div class="badge-inner">
                            <h3><a href="#" ><?php echo $totalMasterAdmin?></a> <span > / </span> <a href="#"><?php echo $accgadmins?></a></h3>
							<p style="color: #000;">TOTAL <b>MASTER ADMINS</b> / TOTAL <b>ACCESS GUARANTEED ADMINS</b></p>
						</div>
					</div><!-- .badge-wrap -->
                </div><!-- .badge-container -->


        <!--/div--><!-- .erp-area-left -->

        <!--div class="erp-area-right">
		
        </div-->
        <?php
        //require '/../includes/class_table_view.php';

            global $wpdb;

            $table = new WeDevs\ERP\Corptne\Superadmin_List_Table();
            $table->prepare_items();

            $message = '';
            if ('delete' === $table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'custom_table_example'), count($_REQUEST['id'])) . '</p></div>';
            }
            ?>
        <div class="wrap">

            <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
            <!--<h2><?php _e('Persons', 'custom_table_example')?> <a href="#" id="erp-employee-new" class="add-new-h2"><?php _e( 'Add New', 'erp' ); ?></a>
            </h2>-->
			
            <?php echo $message;?>
			<form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php //$table->search_box('search', 'search_id'); ?>
			</form>
			
            <form id="persons-table" method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php //$table->display() ?>
            </form>

        </div>	
    </div>
    
</div>
