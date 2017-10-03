<?php  
global $wpdb;
$compid = $_SESSION['compid'];
$busAPI = $wpdb->get_results("SELECT * FROM bus_API");
$flightAPI = $wpdb->get_results("SELECT * FROM flight_API");
$hotelAPI = $wpdb->get_results("SELECT * FROM hotel_API");
$busAPISelect = $wpdb->get_row("SELECT Id FROM bus_API WHERE Status=1");
$flightAPISelect = $wpdb->get_row("SELECT Id FROM flight_API WHERE Status=1");
$hotelAPISelect = $wpdb->get_row("SELECT Id FROM hotel_API WHERE Status=1");


?>
<div class="postbox">
    <div class="inside">
        <h2><?php _e( 'Select Prefered API', 'crp' ); ?></h2>
        <!-- Messages -->
        <div style="display:none" id="failure" class="notice notice-error is-dismissible">
            <p id="p-failure"></p>
        </div>
        <div style="display:none" id="success" class="notice notice-success is-dismissible">
            <p id="p-success"></p>
        </div>
        <form method="post" action="#" enctype="multipart/form-data" id="api_update" class="api_update" name="api_update">

            <table class="form-table">
                <tbody id="fields_container" class="workflow-update">
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Bus API', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selBus" id="selBus">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($busAPI as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->Id?>" <?php echo ($busAPISelect->Id==$value->Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="busAPI-update" class="primary button button-primary">Update</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Flight API', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selFlight" id="selFlight">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($flightAPI as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->Id?>" <?php echo ($flightAPISelect->Id==$value->Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="flightAPI-update" class="primary button button-primary">Update</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="type"><?php _e( 'Hotel API', 'crp' ); ?> <span class="required">*</span></label>
                        </th>
                        <td>
                            <select name="selHotel" id="selHotel">
                                <option value="volvo">-Select-</option>
                                <?php
                                foreach($hotelAPI as $value)
				                {?>
				<?php 
				if($value->POL_Id == 5){
				?>
				
				<?php
				} else {
				?>
                                <option value="<?php echo $value->Id?>" <?php echo ($hotelAPISelect->Id==$value->Id) ? 'selected="selected"' : ''; ?> ><?php echo $value->Type;?></option>
                                <?php
				}
				?> 
                                <?php } ?>
                            </select>
                            <a href="#" id="hotelAPI-update" class="primary button button-primary">Update</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div><!-- .inside -->
</div><!-- .postbox -->

