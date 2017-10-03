<?php

// MY COMPANY DETAILS

function companyUserDetails($column="*", $compid=false)
{
    global $wpdb;
	global $empuserid; 
	
	if(!$compid) global $compid; 
	
    $companyDetails = $wpdb->get_row("SELECT " . $column . " FROM company WHERE COM_Id='$compid' AND COM_Status=0");

	return $companyDetails;
}
