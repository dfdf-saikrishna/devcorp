<div class="dept-form-wrap">
    <div class="row">
        <?php erp_html_form_label( __( 'Enter Mobile Number', 'erp' ), 'dept-title', true ); ?>

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
        <?php erp_html_form_label( __( 'Select Operator', 'erp' ), 'dept-desc' ); ?>

        <span class="field">
           <select name="operator">
		 <option value="0">Choose</option>
		 <option value="AT">Airtel</option>
		 <option value="AL">Aircel</option>
		 <option value="BS">BSNL</option>
		 <option value="BSS">BSNL Special</option>
		 <option value="IDX">Idea</option>
		 <option value="VF">Vodafone</option>
		 <option value="TD">Docomo GSM</option>
		 <option value="TDS">Docomo GSM Special</option>
		 <option value="TI">Docomo CDMA (Indicom)</option>
		 <option value="RG">Reliance GSM</option>
		 <option value="RL">Reliance CDMA</option>
		 <option value="MS">MTS</option>
		 <option value="UN">Uninor</option>
		 <option value="UNS">Uninor Special</option>
		 <option value="VD">Videocon</option>
		 <option value="VDS">Videocon Special</option>
		 <option value="MTM">MTNL Mumbai</option>
		 <option value="MTMS">MTNL Mumbai Special</option>
		 <option value="MTD">MTNL Delhi</option>
		 <option value="MTDS">MTNL Delhi Special</option>
		 <option value="VG">Virgin GSM</option>
		 <option value="VGS">Virgin GSM Special</option>
		 <option value="VC">Virgin CDMA</option>
		 <option value="T24">T24</option>
		 <option value="T24S">T24 Special</option>
	    </select>
        </span>
    </div>

    

    <?php wp_nonce_field( 'erp-new-dept' ); ?>
    <input type="hidden" name="action" id="utility-recharge" value="utility-recharge">
</div>