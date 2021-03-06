<style>
tr:first-child td{
	background: #f3f3f3;
	box-shadow: 1px 2px 1px #888888;
}
</style>
<div class="row">
  <div class="col-lg-12">
    <h3>
      <span class="busfrom"></span> to <span class="busto"></span> - <span class="text-primary dt"></span></h3>
    
  </div>
</div>
<!--div class="col-lg-12">
  <div class="col-lg-2"></div>
  <div class="col-lg-2">
    <div class="form-group">
      <label class="control-label">Filter by: </label>
    </div>
  </div>
    <div class="col-sm-3">
    <div class="form-group">
      <label class="control-label">Buses</label>
      <div>
        <input type="hidden" value="{{data.session}}" id="sessionid">
        <input type="hidden" id="cAirline">
        <input type="hidden" id="ctimeslot">
        <span data-selected="{{data.airlines}}">
        <select class="form-control" name="selAirlines" id="selAirlines">
            <option value="">All</option>
            <# _.each( data.buses, function(res, index) { #>
            <option value="{{res.GQF_AirlineName}}">{{res.GQF_AirlineName}}</option>
            <# }) #> 
          </select>
        </span>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label class="control-label">Departure Time</label>
      <div>
        <span data-selected="{{data.timeslot}}">
        <select class="form-control" name="selTimeSlots" id="selTimeSlots">
          <option value="">All</option>
                    <option value="1">0 - 6 AM</option>
                    <option value="2">6 AM - 12 PM</option>
                    <option value="3">12 PM - 6 PM</option>
                    <option value="4">6 PM - 12 AM</option>
                  </select>
        </span>
      </div>
    </div>
  </div>
        <div class="col-sm-1">
    <div class="form-group">
      <label class="control-label">&nbsp;</label>
      <div>
        <button type="button" name="buttonShowBus" id="buttonShowBus" class="button">Show</button>
      </div>
    </div>
  </div>
</div-->
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table">
 <thead class="thead-inverse">
   <tr>
     <th>Buses</th>
     <th>DEPARTURE</th>
     <th>ARRIVAL</th>
     <th>AVAILABLE</th>
     <th>PRICE</th>
     <th>Book</th>

   </tr>
 </thead>
 <tbody>
   <# _.each( data.quoteResult.response, function(res, index) { #>
    <# if ( res.GQF_Stops != '0' ) { #>
   <tr>
     <td><span class="logo LSG_sm pull-left"><img style="width:30px;" src="<?php echo WPERP_EMPLOYEE_ASSETS;?>/images/bus.png"></img></span>&nbsp;&nbsp;&nbsp;{{res.GQF_AirlineName}} </br> &nbsp;&nbsp;&nbsp;{{res.GQF_FlightNumber}}</td>
     <td><span class="time">{{res.GQF_DepTIme}}</span></br><span class="city_name flightfrom"></span></td>
     <td style="width: 12%;"><span class="time">{{res.GQF_ArrTime}}</span></br><span class="city_name flightto"></span></td>
     <td><span class="time">{{res.GQF_Stops}}</span> </br> <span class="city_name">Seat(s)</span></td>
     <td style="width: 12%;"><span class="price_info">Rs. {{res.GQF_Price}}</span></td>
	 <# if ( data.tAmount < res.GQF_Price ) { #>
     <td style="text-align: center;" title="Bokking Amount Exceeds Tolerance Limit"><button type = "button" class="button-primary" id="busBooking" value="{{res.GQF_Uid}}" disabled>Book</button></td>
	 <# } else { #>
	 <td style="text-align: center;"><button type = "button" class="button-primary" id="busBooking" value="{{res.GQF_Uid}}">Book</button></td>
	 <# } #>
   </tr>
    <# } #>
   <# }) #>    
 </tbody>
</table>
</div>
</div>
</div>