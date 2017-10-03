<?php
$cmpid	=	$_REQUEST['id'];
$comrow = companyUserDetails("COM_Name", $cmpid);
?>
<div class="wrap erp-companyinvoice" id="wp-erp">

<h2><?php echo $comrow->COM_Name; ?> - Invoices</h2>

	<?php
        $companyinvoice_table = new \WeDevs\ERP\Travelagent\Travel_Agent_Company_Invoice_Table();
        $companyinvoice_table->prepare_items();
        $message = '';
            if ('delete' === $companyinvoice_table->current_action()) {
                $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
            }
                ?>

     <div class="list-table-wrap erp-hr-employees-wrap">
        <div class="list-table-inner erp-hr-employees-wrap-inner">
            <?php echo $message;?>
			<form method="post">
			  <input type="hidden" name="page" value="my_list_test" />
			  <?php $companyinvoice_table->search_box('Search', 'search_id'); ?>
			</form>
			
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $companyinvoice_table->display() ?>
            </form>

        </div>
        </div>

</div>

