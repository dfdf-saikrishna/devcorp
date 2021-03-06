<?php
global $wpdb;
global $showProCode;
global $delgtd_empcodes;
$compid = $_SESSION['compid'];
$empuserid = $_SESSION['empuserid'];
$mydetails=myDetails();
$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com, department dep, designation des, employee_grades eg WHERE emp.EMP_Id='$empuserid' AND emp.COM_Id=com.COM_Id AND emp.DEP_Id=dep.DEP_Id AND emp.DES_Id=des.DES_Id AND emp.EG_Id=eg.EG_Id");
?>
<form class="form-horizontal" method="post" id="addDelegate" name="addDelegate">
<div class="postbox">
    <div class="inside">
        <div class="wrap pre-travel-request erp" id="wp-erp">
        
	<ol class="breadcrumb">
    
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=employee">Dashboard</a>
		</li>
	
		<li class="breadcrumb-item">
			<a href="http://corptne.com/wp-admin/admin.php?page=create-delegate">Create Delegate</a>
		</li>
	
	</ol>
            <h2><?php _e( 'Create Delegate', 'employee' ); ?></h2>
            <?php
                $row=0;
                require WPERP_EMPLOYEE_VIEWS."/employee-details.php";
            ?>
        </div>
    </div>
</div>
<div class="wrap erp erp-hr-leave-request-new erp-hr-leave-reqs-wrap">
<div class="postbox">
    
        <?php 
				
        // checking for those who has already been delegated to someone else
        
        $seldelempids=$wpdb->get_row("SELECT EMP_Code FROM delegate delg, employees emp WHERE delg.COM_Id=$compid AND delg.DLG_Status=1 AND delg.DLG_Active=1 AND delg.DLG_FromEmpid=emp.EMP_Id");
        //$resdelempids=$respol=mysqli_query($con, $seldelempids);


        //print_r($seldelempids);
        //while($seldelempids){

                $delgtd_empcodes.="$seldelempids->EMP_Code".",";

        //}

        $delgtd_empcodes=rtrim($delgtd_empcodes,",");

        //echo 'Delegated Emp='.$delgtd_empcodes;

            
        $selpol="COM_Id='$compid' AND EMP_Status=1 AND EMP_Access=1 AND EMP_Reprtnmngrcode != '$mydetails->EMP_Code'";

        if($delgtd_empcodes)
        $selpol.=" AND EMP_Reprtnmngrcode NOT IN ($delgtd_empcodes)";

        $selpol.=" ORDER BY EMP_Reprtnmngrcode ASC";


        // checkin if i'm not a acc approvr
        $query=NULL;
        if(!$mydetails->EMP_AccountsApprover)
        $query=" AND EMP_AccountsApprover != 1";

                
        $selsql=$wpdb->get_results("SELECT DISTINCT(EMP_Reprtnmngrcode) FROM employees WHERE $selpol");
     
        ?>
        <h3 class="hndle"><?php _e( 'Add Delegate', 'employee' ); ?></h3>
        <div class="inside">
        <!-- Messages -->
        <div style="display:none" id="failure" class="notice notice-error is-dismissible">
        <p id="p-failure"></p>
        </div>

        <div style="display:none" id="notice" class="notice notice-warning is-dismissible">
            <p id="p-notice"></p>
        </div>

        <div style="display:none" id="success" class="notice notice-success is-dismissible">
            <p id="p-success"></p>
        </div>

        <div style="display:none" id="info" class="notice notice-info is-dismissible">
            <p id="p-info"></p>
        </div>
        <div class="row">
        <label>Reporting Managers :</label>
        <select required="true" class="" name="selRepmanagers" id="selRepmanagers" data-size="10" data-live-search="true">
            <option value="">Select</option>
            <?php 

                          foreach($selsql as $rowpol)
                          {
                                
                                if($repmngr_details=$wpdb->get_row("SELECT EMP_Id, EMP_Code, EMP_Name FROM employees WHERE EMP_Code='$rowpol->EMP_Reprtnmngrcode' AND COM_Id='$compid' $query")){
                          ?>
            <option value="<?php echo $repmngr_details->EMP_Id?>" ><?php echo $repmngr_details->EMP_Code."---".$repmngr_details->EMP_Name;?></option>
            <?php }  } ?>
       </select>
       </div>
       <div class="row two-col">
       <input type="hidden" name="action" id="action" value="create-delegate">
       <div class="cols">
           <label>From</label>
           <input type="text" class="" name="txtDelegatedatefrom" id="dateFrom" onClick="this.readOnly=true" parsley-required="true"/>
       </div>
       <div class="cols last">
           <label>To</label>
           <input type="text" class="" name="txtDelegatedateto" id="dateTo" onClick="this.readOnly=true" parsley-required="true"/>
       </div>
       </div>
       <div class="row">
           <label>Comments</label>
           <textarea class="" name="txtaDelcomments" id="txtaDelcomments" data-separator=' of ' data-pre-text='You have ' data-post-text=' chars remaining'></textarea>
       </div>
            <p class="submit">
            <input name="submit" id="submit" class="button button-primary" value="Add Delegate" type="submit">
            </p>
       </form>
    </div>
</div>
</div>
<script>
var j = jQuery.noConflict();
j( function() {
    var dateFormat = "mm/dd/yy",
      from = j( "#dateFrom" )
        .datepicker({
          defaultDate: "d",
          dateFormat: "mm/dd/yy",
          minDate: "d",
          changeMonth: true,
          numberOfMonths: 2
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = j( "#dateTo" ).datepicker({
        defaultDate: "+1w",
        dateFormat: "mm/dd/yy",
        changeMonth: true,
        numberOfMonths: 2
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = j.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
</script>
