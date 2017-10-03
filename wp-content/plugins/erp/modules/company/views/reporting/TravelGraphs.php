<?php
global $wpdb;
$compid = $_SESSION['compid'];
$selpol = $wpdb->get_results("SELECT * FROM mode WHERE EC_Id=1 AND COM_Id IN (0, '$compid') AND MOD_Status=1 ORDER BY MOD_Id ASC");
//print_r($selpol);
?>
<div class="company-headcount" id="wp-erp">
    <h3><?php _e('Compare Travel Spends across Departments (All categories)', 'company'); ?></h3>
    <form method="get">
    <div class="col-md-12">
        <input type="hidden" value="{{data.COM_Id}}" name="company[compid]" id="compid">
    <input type="hidden" value="{{data.DEP_Id}}" name="company[depId]" id="depId">
    </div>
    <div class="filter-top">
        <div class="col-md-3">
            <select name="departments" id="departments" class="form-control">
                            <option value="volvo">All Travels</option>
                            <?php
                            foreach ($selpol as $value) {
                                ?>
                                <option value="<?php echo $value->MOD_Id ?>" <?php ($value->MOD_Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->MOD_Name; ?></option>
                            <?php } ?>
                        </select>
        </div>
        
        <div class="col-md-3">
            <select name="birthdayYear" class="form-control">
                            <?php
                            $currY = date('Y');
                            ?>
                            <option value="2013"<?php echo $currY == '2013' ? 'selected="selected"' : ''; ?>>Year:</option>
                            <?php
                            for ($i = date('Y'); $i > 2010; $i--) {
                                $selected = '';
                                if ($currY == $i)
                                    $selected = ' selected="selected"';
                                print('<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n");
                            }
                            ?>

                        </select>
        </div>
        
        <div class="col-md-4">
             <select name="signup_birth_month" id="signup_birth_month" class="form-control">
                            <option value="">Select Month</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
                                echo "<option value=\"" . $month_name . "\">" . $month_name . "</option>";
                            }
                            ?>
                        </select>
        </div>
        
        <div class="col-md-2">
            <a href="#" id="graphs-update" class="btn btn-primary btn-block">Show Reports</a>
        </div>
    </div>
    </form>
    
</div>
<div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">

        <!-- main content -->
        <div id="post-body-content">

            <div class="meta-box-sortables ui-sortable">

                <div class="postbox">

                    <div class="handlediv" title="Click to toggle"><br></div>
                    <!-- Toggle -->

<!--                    <h2 class="hndle"><span><?php _e('Department Wise Graphs', 'erp'); ?></span>
                    </h2>-->

                    <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'All Travels', 'Flight', 'Bus'],
           ['2013', 1030, 540, 350],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
        ]);

        var options = {
          chart: {
            title: 'Compare Travel Spends across Departments ',
            subtitle: 'All Travels, and Flight,Bus',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" class="box panel-widget-style" style="width: 900px; height: 500px;"></div>
  </body>
</html>
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
