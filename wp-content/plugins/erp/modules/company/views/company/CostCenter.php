<?php ?>
<div class="wrap erp-company-costcenter" id="wp-erp">
<div class="page-header">
	
	<h1>Cost Center</h1>

	

	
		
	<div class="page-header-actions">
		<a href="#" id="erp-new-costcenter" class="btn btn-primary" data-single="1">
			Add Cost Center		</a>
	</div><!-- /.page-header-actions -->
</div>

    <!--<h2>DashBoard</h2>-->
    <!--h2><?php _e('Cost Center', 'company'); ?>
        <a href="#" id="erp-new-costcenter" class="add-new-h2" data-single="1"><?php _e(' Add Cost Center', 'erp'); ?></a></h2-->

    <?php
    global $wpdb;
    $table = new WeDevs\ERP\Company\CostCenter_List_Table();
    $table->prepare_items();
    
    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p style="text-align:center;">' . sprintf(__('CostCenter closed Successfully', 'employee_table_list'), count($_REQUEST['id'])) . '</p></div>';
    }
        ?>
        <div class="box panel-widget-style list-table-wrap erp-company-costcenters-wrap">
        <div class="list-table-inner erp-company-costcenters-wrap-inner">
        <?php echo $message;?>
            <form method="GET">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                <?php $table->display() ?>
            </form>

        </div>
        </div>
</div>


<!-- Graphical Representation for CostCenter -->
<?php
global $wpdb;
$compid = $_SESSION['compid'];
$selpol = $wpdb->get_results("SELECT CC_Id,CC_Code,CC_Name From cost_center WHERE COM_Id = $compid");

?>
<div class="company-headcount" id="wp-erp">
    <div class="wrap erp-hr-company" id="wp-erp">
    <h2><?php _e('Cost Center Details', 'company'); ?></h2>
    <input type="hidden" value="{{data.COM_Id}}" name="company[compid]" id="compid">
    <input type="hidden" value="{{data.DEP_Id}}" name="company[depId]" id="depId">
</div>
    <form method="get">
        <table class="form-table box panel-widget-style">
            <tbody id="fields_container" class="reports-graphs">
                <tr>
                    <td>
                        <select name="costcenter-details" id="costcenter-details" class="erp-select2">
                            <option value="volvo">Select CostCenter</option>
                            <?php
                            foreach ($selpol as $value) {
                                ?>
                                <option value="<?php echo $value->CC_Id ?>"><?php echo $value->CC_Name; ?>---<?php echo $value->CC_Code; ?></option>
                            <?php } ?>
                        </select>
                        <a href="#" id="graphs-update" class="primary button button-primary">Show</a>
                    </td>
                </tr>
            </tbody>
        </table> </form>
</div>
<!--<div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">

         main content 
        <div id="post-body-content">

            <div class="meta-box-sortables ui-sortable">

                <div class="postbox">

                    <div class="handlediv" title="Click to toggle"><br></div>
                     Toggle 

-->                    <h2 class="hndle"><span><?php _e('CostCenter Wise', 'erp'); ?></span>
</h2>

<!--<div class="inside">-->

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      //google.charts.setOnLoadCallback(drawChart);

      
    </script>
</head>
<body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>

</div>
<!-- .inside -->

</div>
<!-- .postbox -->

</div>
<!-- .meta-box-sortables .ui-sortable -->

</div>
</div>
<!-- #postbox-container-1 .postbox-container -->

</div>
<!-- #post-body .metabox-holder .columns-2 -->

<br class="clear">
</div>