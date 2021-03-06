<?php
namespace WeDevs\ERP\Travelagent;

/**
 * Employee Class
 */
class Travelagentbankdetails {

    /**
     * array for lazy loading data from ERP table
     *
     * @see __get function for this
     * @var array
     */
    private $erp_rows = array(
        
    );

  
    /**
     * Magic method to get item data values
     *
     * @param  string
     *
     * @return string
     */
    public function __get( $key ) {

        // lazy loading
        // if we are requesting any data from ERP table,
        // only then query to get those row
        if ( in_array( $key, $this->erp_rows ) ) {
            $this->erp = $this->get_erp_row();
        }

        if ( isset( $this->erp->$key ) ) {
            return stripslashes( $this->erp->$key );
        }

        if ( isset( $this->user->$key ) ) {
            return stripslashes( $this->user->$key );
        }
    }

    /**
     * Get the user info as an array
     *
     * @return array
     */
    public function to_array() {
	$supid = $_SESSION['supid']; 
	$defaults = array(
		'TDBA_Fullname' =>'',
		'TDBA_AccountNumber' =>'',
		'TDBA_BankIfscCode' =>'',
		'TDBA_BankName' =>'',
		'TDBA_BranchName' =>'',
		'TDBA_Type' =>'',
		'SUP_Id'=>$supid,
    );
        return apply_filters( 'erp_hr_get_travelagentbankdetails_fields', $defaults, $this->id, $this->user );
        //return $defaults;
    }
  
}
