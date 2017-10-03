<!--<h1> GET QUOTE BUS </h1>-->
<div class="erp-employee-form">
<!--    <fieldset class="no-border">
 <ol class="form-fields two-col">
                            <li>
                    <label for="txtCompname">Company Name <span class="required">*</span></label><input required value="" name="company[txtCompname]" id="txtCompname" type="text"></li>
                        <li>
                <label for="txtEmpCodePrefx">Employee Username Prefix <span class="required">*</span></label><input required value="" name="company[txtEmpCodePrefx]" id="erp-hr-user-email"  type="text"></li>
                          <li>
                    <label for="txtCompname">Company Name <span class="required">*</span></label><input required value="" name="company[txtCompname]" id="txtCompname" type="text"></li>
                        <li>
                <label for="txtEmpCodePrefx">Employee Username Prefix <span class="required">*</span></label><input required value="" name="company[txtEmpCodePrefx]" id="erp-hr-user-email"  type="text"></li>

        </ol>
</fieldset>-->

<div id="md-ajax" class="modal fade modal-overflow in" tabindex="-1" aria-hidden="false" style="display: block; margin-top: 0px;">
               
                <div class="modal-body">

<div class="row">
  <div class="col-lg-12">
    <h2>
      Hyderabad to Bangalore - <span class="text-primary">Sun, 01 January 2017</span></h2>
  </div>
</div>
<div class="clearfix"></div>
<p>&nbsp;</p>
<div class="col-lg-12">
  <div class="col-lg-2"></div>
  <div class="col-lg-2">
    <div class="form-group">
      <label class="control-label">Filter by: </label>
    </div>
  </div>
      <div class="col-sm-3">
    <div class="form-group">
      <label class="control-label">Buses:</label>
      <div>
        <select class="form-control" name="selAirlines" id="selAirlines">
          <option value="">All</option>
                    <option>Aeon connect</option>
                  </select>
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
      <label class="control-label">A/c or Non A/c:</label>
      <div>
        <select class="form-control" name="selac" id="selac">
          <option value="">All</option>
         
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
      <label class="control-label">Departure Time</label>
      <div>
        <select class="form-control" name="selTimeSlots" id="selTimeSlots">
          <option value="">All</option>
                    <option value="1">0 - 6 AM</option>
                   
                  </select>
      </div>
    </div>
  </div>
      <div class="col-sm-1">
    <div class="form-group">
      <div>
        <button type="button" name="buttonShow" id="buttonShow" class="btn btn-theme">Show</button>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<p>&nbsp;</p>
<div class="row align_center" id="showtextid"> </div>
<p>&nbsp;</p>
<div id="loadingGif" style="display:none;" class="text-center"><img src="http://kahaa.ooo//images/loading.gif"> Loading...
  <p>&nbsp;</p>
</div>
<!--<p class="hidden-xs visible-stb"> <span class="light_gray ng-scope ng-binding">Showing 118 of 118 flights | </span> <a class="ng-scope">Show all flights</a> </p>-->
<p class="hidden-xs visible-stb text-center alert-warning"><em> <span class="light_gray ng-scope ng-binding">Please check 3 records as your options and select 1 record as your preferred choice. </span>
  <!--<a class="ng-scope">Show all flights</a>-->
  </em></p>
<br>
<div id="ajaxContainer">
  <div id="no-more-tables">
        <table class="table table-bordered table-striped table-hover table-condensed cf">
      <thead class="cf">
        <tr height="30">
          <th bgcolor="#00b5e5" width="30%" style="color:#000000;"><strong>
            Bus            </strong></th>
          <th bgcolor="#00b5e5" style="color:#000000;"><strong>DEPARTURE</strong></th>
          <th bgcolor="#00b5e5" style="color:#000000;"><strong>ARRIVAL</strong></th>
          <th bgcolor="#00b5e5" style="color:#000000;"><strong>
            Available            </strong></th>
          <th bgcolor="#00b5e5" style="color:#000000;"><strong>PRICE</strong></th>
          <th bgcolor="#00b5e5" style="color:#000000;"><strong>PREFERED</strong></th>
          <th bgcolor="#00b5e5" style="color:#000000;"><strong><i class="fa fa-check"></i></strong></th>
        </tr>
      </thead>
      <tbody align="center">
        <tr>
          <td data-title="BUS" class="text-left" style="padding-left:20px;"><span class="logo LM_bus pull-left"></span>&nbsp;&nbsp;&nbsp; Aeon Connect Sabarimala Special<br>
             - Scania AC Multi Axle Semi Sleeper(2+2)</td>
          <td data-title="DEPARTURE"><span class="block time RobotoRegular ng-binding">03:15 pm</span> <span class="city_name">Hyderabad</span></td>
          <td data-title="ARRIVAL"><span class="block time RobotoRegular ng-binding">11:00 pm</span> <span class="city_name">Bangalore</span></td>
          <td data-title="Seats"><span class="block time RobotoRegular ng-binding"></span> <span class="city_name text-center">
            0 Seats            </span></td>
          <td data-title="PRICE"><p class="price_info RobotoRegular ng-binding"><span class="INR">Rs.</span> 1,431</p></td>
          <td data-title="Open"><button type="button" name="buttonSelectFlight" id="buttonSelectFlight" class="btn btn-theme-inverse takeValid" onclick="validate(this.value)" value="7559,1431">Select</button></td>
          <td data-title="PREFERED"><input name="cbGqfid[]" id="cbGqfid[]" type="checkbox" value="7559" class="checkbox"></td>
        </tr>
                
        <input type="hidden" value="113" name="hiddenCounter" id="hiddenCounter">        <tr>
          <td colspan="7" height="5"></td>
        </tr>
      </tbody>
    </table>
          </div>
</div>
<span style="color:white;">Process Time: 2.15560913086</span></div>
              </div>
</div>
</div>