<div class="dept-form-wrap">
    <div class="row">
        <?php erp_html_form_label( __( 'Mobile Number', 'erp' ), 'dept-title', true ); ?>

        <span class="field">
            <input type="text" id="dept-title" name="mobile" value="" required="required" maxlength="10">
        </span>
    </div>
    
    <div class="row">
        <?php erp_html_form_label( __( 'Enter Amount', 'erp' ), 'dept-title', true ); ?>

        <span class="field">
            <input type="text" id="dept-title" name="amount" value="" required="required" maxlength="1000">
        </span>
    </div>
    
    <div class="row">
    <label><input type="radio" name="optype" value="prepaid"> Prepaid</label>
    <label><input type="radio" name="optype" value="postpaid"> Postpaid</label>
    <input type="hidden" id="optype" name="optype">
    </div>
    
    <!-- Prepaid -->
    <div class="row prepaid box" style="display:none;">
        <?php erp_html_form_label( __( 'Select Operator', 'erp' ), 'dept-desc' ); ?>

        <span class="field">
           <select name="operator-prepaid">
		 <option value="0">Choose</option>
		 <option value="ATD">AIRTEL</option>
		 <option value="BSD">BSNL</option>
		 <option value="IDXD">IDEA (B2B) </option>
		 <option value="IDYD">IDEA (B2C) </option>
		 <option value="VFD">VODAFONE</option>
		 <option value="RLD">RELIANCE CDMA</option>
		 <option value="UND">UNINOR</option>
		 <option value="MSD">MTS</option>
		 <option value="ALD">AIRCEL</option>
		 <option value="TID">TATA INDICOM (CDMA)</option>
		 <option value="MTDD">MTNL DELHI</option>
		 <option value="MTMD">MTNL MUMBAI </option>
		 <option value="VDD">VIDEOCON</option>
	    </select>
        </span>
    </div>
    
    <!-- PostPaid -->
    <div class="row postpaid box" style="display:none;">
        <?php erp_html_form_label( __( 'Select Operator', 'erp' ), 'dept-desc' ); ?>

        <span class="field">
           <select name="operator-postpaid">
		 <option value="0">Choose</option>
		 <option value="APOS">AIRTEL</option>
		 <option value="BPOS">BSNL</option>
		 <option value="IPOS">IDEA</option>
		 <option value="VPOS">VODAFONE</option>
		 <option value="RGPOS">RELIANCE GSM</option>
		 <option value="RCPOS">RELIANCE CDMA</option>
		 <option value="DGPOS">TATA DOCOMO GSM</option>
		 <option value="DCPOS">TATA INDICOM (CDMA)</option>
		 <option value="CPOS">AIRCEL</option>
	    </select>
        </span>
    </div>

    

    <?php wp_nonce_field( 'erp-new-dept' ); ?>
    <input type="hidden" name="action" id="utility-recharge" value="utility-recharge">
</div>