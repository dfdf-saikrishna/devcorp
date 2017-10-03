<?php
namespace WeDevs\ERP\Company\Emails;

use WeDevs\ERP\Email;
use WeDevs\ERP\Framework\Traits\Hooker;

/**
 * Employee welcome
 */
class Approved_Leave_Request extends Email {

    use Hooker;

    function __construct() {
        $this->id             = 'approved-leave-request';
        $this->title          = __( 'Approved Leave Request', 'erp' );
        $this->description    = __( 'Approved leave request notification to employee.', 'erp' );

        $this->subject        = __( 'Your leave request has been approved', 'erp');
        $this->heading        = __( 'Leave Request Approved', 'erp');

        $this->find = [
            'full-name'    => '{employee_name}',
            'leave_type'   => '{leave_type}',
            'date_from'    => '{date_from}',
            'date_to'      => '{date_to}',
            'no_days'      => '{no_days}',
            'reason'       => '{reason}',
        ];

        $this->action( 'erp_admin_field_' . $this->id . '_help_texts', 'replace_keys' );

        parent::__construct();
    }

    function get_args() {
        return [
            'email_heading' => $this->heading,
            'email_body'    => wpautop( $this->get_option( 'body' ) ),
        ];
    }

    public function trigger( $requestcode, $et, $type, $employee=false ) {
    	global $wpdb;
	global $compid; 
	
	global $filename;
	
	global $empuserid;
	
	if($employee)$empuserid=$employee;
						
	$selempid=$selsql	=	$wpdb->get_row("SELECT re.EMP_Id FROM requests req, request_employee re WHERE re.EMP_Id", "REQ_Code='$requestcode' and req.REQ_Id=re.REQ_Id AND re.RE_Status=1 AND REQ_Active=1");
	
	
	$empdetails=$wpdb->get_row("SELECT * FROM employees emp, company com WHERE emp.EMP_Id='$selempid[EMP_Id]' AND emp.COM_Id=com.COM_Id");
	
	//echo 'Employee Code='.$empdetails[EMP_Code]; exit;

	
	switch($et)
	{
		
		case 1:
		$ettype="Pre Travel Expense Request";
		break;
		
		case 2:
		$ettype="Post Travel Expense Request";
		break;
		
		case 3:
		$ettype="General Expense Request";
		break;
		
		case 4:
		$ettype="Employee Group Travel Request";
		break;
		
		case 5:
		$ettype="Mileage Requests";
		break;
		
		case 6:
		$ettype="Utility Expense Requests";
		break;
		
	}
	
	
	$selrepmngrname	=	$wpdb->get_row("SELECT EMP_Name FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode' AND EMP_Status=1");
	
	$totAmount		=	$wpdb->query("SELECT SUM(rd.RD_Cost) AS total FROM requests req, request_details rd WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=rd.REQ_Id AND RD_Status=1 AND REQ_Active != 9 ");
	
	$reqDetails="<BR><table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-size:12px;font-weight: bold;\">
				  <tr>
					<th width=\"35%\" height=\"30\" align=\"left\" valign=\"middle\" >Request Code</th>
					<td colspan=\"6\">:</td>
					<td width=\"60%\" height=\"30\" align=\"left\" valign=\"middle\">".$requestcode."</td>
				  </tr>
				  <tr>
					<th width=\"35%\" height=\"30\" align=\"left\" valign=\"middle\" >Expense Type</th>
					<td colspan=\"6\">:</td>
					<td width=\"60%\" align=\"left\" valign=\"middle\">".$ettype."</td>
				  </tr>
				  <tr>
					<th width=\"35%\" height=\"30\" align=\"left\" valign=\"middle\" >Created By</th>
					<td colspan=\"6\">:</td>
					<td width=\"60%\" align=\"left\" valign=\"middle\">".$empdetails->EMP_Name.", ".$empdetails->EMP_Code."</td>
				  </tr>
				  <tr>
					<th width=\"35%\" height=\"30\" align=\"left\" valign=\"middle\" >Reporting To</th>
					<td colspan=\"6\">:</td>
					<td width=\"60%\" align=\"left\" valign=\"middle\">".$empdetails->EMP_Reprtnmngrcode.", ".$selrepmngrname->EMP_Name."</td>
				  </tr>
				  <tr>
					<th width=\"35%\" height=\"30\" align=\"left\" valign=\"middle\" >Total Amount (Rs)</th>
					<td colspan=\"6\">:</td>
					<td width=\"60%\" align=\"left\" valign=\"middle\">".IND_money_format($totAmount).".00"."</td>
				  </tr>
				</table>";
	
	
	switch($type)
	{
		
		case 1: //mail to accounts
		$mailsub	=	$ettype;
		$name		=	"To Finance";
		$text		=	"The requested employee is the reporting manager itself.<br>Approval waiting from the Finance.";
		$text.=$reqDetails;
		break;
		
		
		case 2: //mail to reporting manager
		$mailsub	=	$ettype;
		
		$repmngr	=	$wpdb->get_row("SELECT * FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode");
		$mailto		=	$repmngr->EMP_Email;
		$name		=	"Hi ".$repmngr->EMP_Name;
		$text		=	"<br>You have an expense request waiting for your approval.<br>";
		$text.=$reqDetails;
		break;
		
		
		case 3: //mail to employee
		$mailsub	=	"Reporting Manager Approved";
		                        
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request have been approved by your reporting manager & have been sent to finance for further verifications.";
		break;
		
		
		case 4: // mail to the finance 
		$mailsub	=	"Waiting for Finance approval";
		$name		=	"To Finance ";
		$text		=	"The above mentioned expense request has been approved by the reporting manager.<br>Awaiting approval from Finance.";
		$text.=$reqDetails;		
		break;
		
		
		case 5: // mail to employee
		$mailsub	=	"Reporting Manager Rejected";
		                        
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request have been rejected by your reporting manager.<br>Please revise your expense request & submit later.";
		break;
		
		
		case 6: // mail to the employee 
		$mailsub	=	"Finance Approved";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request has been approved by the Finance.<br>";
		
		if($et==1)
		$text.="You are allowed to make the journey.";		
		
		break;
		
		
		case 7: // mail to the employee 
		$mailsub	=	"Finance Rejected";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request has been rejected by the Finance.<br>	You may please revise your request.";		
		break;
		
		
		case 8: // mail to the employee 
		$mailsub	=	"Finance Approved";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request has been approved by the Finance.<br>";
		
		if($et==1)
		$text.="You are allowed to make the journey.";
			
		break;
		
		
		case 9: // mail to the employee 
		$mailsub	=	"Finance Approved";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text="The above mentioned expense request have been approved by Finance & have been sent to your reporting manager for further verification.";
		break;
		
		
		//--------------------------------CLAIMS
		
		case 10: // mail to accounts
		$mailsub	=	"Claim Submitted, Waiting For Approval";
		$name		=	"To Finance ";
		$text		=	"The requested employee is the reporting manager itself.<br>Approval waiting from Finance.";
		break;
		
		
		case 11: // mail to rep manager
		$mailsub	=	"Claim Submitted, Waiting For Approval";
		$repmngr	=	$wpdb->get_row("SELECT * FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode");
		$mailto		=	$repmngr->EMP_Email;
		$name		=	"Hi ".$repmngr->EMP_Name;
		$text		=	"The above mentioned expense requested has been submitted for claim. <br> Waiting for claim approval.";
		break;
		
		
		case 12: // mail to accounts
		$mailsub	=	"Claim Updated, Waiting For Approval";
		$name		=	"To Finance ";
		$text		=	"The requested employee is the reporting manager itself.<br>Approval waiting from finance.";
		break;
		
		
		case 13: // mail to rep manager
		$mailsub	=	"Claim Updated, Waiting For Approval";
		
		$repmngr	=	$wpdb->get_row("SELECT * FROM employees WHERE EMP_Code='$empdetails->EMP_Reprtnmngrcode");
		$mailto		=	$repmngr->EMP_Email;
		$name		=	"Hi ".$repmngr->EMP_Name;
		$text		=	"The above request has been updated for claim. <br> Waiting for claim approval.";
		break;
		
		
		case 14: // mail to accounts
		$mailsub	=	"Claim Approved By Reporting Manager";
		$name		=	"To Finance ";
		$text		=	"The request bills have been verified by the reporting manager and approved.<br>Approval waiting from Finance.";
		break;
		
		case 15: // mail to employee
		$mailsub	=	"Claim Approved By Reporting Manager";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request's claim have been approved by your reporting manager & have been sent to finance for further verifications.";
		break;
		
		
		case 16: // mail to employee
		$mailsub	=	"Claim Rejected By Reporting Manager";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request's claim have been rejected by your reporting manager.<br>Please revise your expense request's claim & submit later.";
		break;
		
		
		case 17: // mail to the employee 
		$mailsub	=	"Claim Approved By Finance";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request's claim has been approved by Finance.";		
		break;
		
		
		case 18: // mail to the employee 
		$mailsub	=	"Claim Rejected By Finance";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request's claim has been rejected by Finance.<br>You may please revise your request and submit later.";		
		break;
		//--------------------------------CLAIMS
		
		
		case 19: // mail to the employee (he is reporting manager himself)
		$mailsub	=	"Request Auto-Approved";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request's has been Auto-Approved.<br>";
		
		if($et==1)
		$text.="You are allowed to make the journey.";
		$text.=$reqDetails;
			
		break;
		
		
		case 20: //mail to finance
		$mailsub	=	$ettype;
		$name		=	"To Finance ";
		$text		=	"Expense request is waiting approval.";
		$text.=$reqDetails;
		break;
		
		
		case 21: // mail to finance
		$mailsub	=	$ettype;
		$name		=	"To Finance ";
		$text		=	"The above mentioned expense request is raised by the travel desk. Employee has put it for claim. Waiting for your approval";
		break;
		
		
		
		case 22: // mail to the employee 
		$mailsub	=	"Payment details updated by Finance";
		   
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		="The above mentioned expense request's payment details have been updated by the finance department. Please verify payment details";		
		break;
		
		case 23: // mail to the employee 
		$mailsub	=	"Payment details added by Finance";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request's payment details have been added by the finance department. Please verify payment details";		
		break;
		
		
		case 24: //mail to employee (travel desk raised & normal)
		$mailsub	=	"Reporting Manager Approved";
		
		$employee	=	$wpdb->get_row("SELECT * FROM requests req, request_employee re, employees emp WHERE req.REQ_Code='$requestcode' AND req.REQ_Id=re.REQ_Id AND re.EMP_Id=emp.EMP_Id AND RE_Status=1");
		$mailto		=	$employee->EMP_Email;
		$name		=	"Hi ".$employee->EMP_Name;
		$text		=	"The above mentioned expense request have been approved by your reporting manager. You can make your journey";
		break;
		
		case 25: //mail to employee (travel desk raised request)
		$mailsub	=	"Reporting Manager Approved";
		$name		=	"To Travel Desk";
		$text		=	"The above mentioned expense request have been approved by reporting manager. ";
		break;
		
	
	}
	
	
		
	$mail_sub=stripslashes($empdetails->COM_Name)." [ ".$mailsub." ]";

	
	
	$mail_header='<table  border="0" align="center" cellpadding="0" cellspacing="0"  style="color: #373737;font-family:segoe UI, Arial, Helvetica, sans-serif;">
					  <tr>
						<td height="10">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="34"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td width="3%"><img src="'.$GLOBALS['assetimgpath'].'BusinessSimple_01.gif" width="17" height="104"></td>
							  <td width="25%" background="'.$GLOBALS['assetimgpath'].'BusinessSimple_08.gif"><a href="'.$GLOBALS['domain'].'"><img src="'.$GLOBALS['assetimgpath'].'logo_invice.png" ></a></td>
							  <td width="68%" align="center" valign="middle" background="'.$GLOBALS['assetimgpath'].'BusinessSimple_08.gif" style="font-size:24px;color:#443A8F;padding-left:9px;background-repeat: repeat-x;line-height: 98px;height: 98px;"><img src="'.$GLOBALS['domain'].'admin/'.$empdetails->COM_Logo.'"></td>
							  <td width="4%"><img src="'.$GLOBALS['assetimgpath'].'BusinessSimple_03.gif" width="27" height="104"></td>
							</tr>
						  </table></td>
					  </tr>
					  <tr>
						<td height="1"></td>
					  </tr>
					  <tr>
						<td align="left" valign="top" bgcolor="#FAFAFA">&nbsp;</td>
					  </tr>
					  <tr>
    					<td align="left" valign="top">';
						
						
		$mail_body='<table width="700"  height="324" border="0" cellpadding="0" cellspacing="0" style=" border:1px; border-radius:25px;">
				<tr>
				  <td   colspan="3">&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" colspan="3" style="font-size:16px;font-weight: bold;" align="center"><u>'.$mailsub.'</u></td>
				</tr>
				<tr>
				  <td   colspan="3">&nbsp;</td>
				</tr>
				<tr>
				  <td  align="left" colspan="3" style="font-size:14px;font-weight: bold;" align="center"><u>Request Code: '.$requestcode.'</u></td>
				</tr>
				<tr>
				  <td   colspan="3">&nbsp;</td>
				</tr>
				<tr>
				  <td height="298" ></td>
				  <td valign="top" ><table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" >
					  <tr>
						<td width="84%" style="font-size:14px;letter-spacing:1px;"><p>'.$name.',<br>
						  </p></td>
						<td width="16%" style="font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="2" style="font-family:segoe UI, Arial, Helvetica, sans-serif;font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;"><p align="justify">'.$text.' </p>
						 </td>
					  </tr>
					  <tr>
						<td colspan="2" style="font-family:segoe UI, Arial, Helvetica, sans-serif;font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">&nbsp;</td>
					  </tr>
					  
					  <tr>
						<td colspan="2" style="font-family:segoe UI, Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">Click here to <a href="'.$GLOBALS['domain'].'" >Login</a> to your Profile</td>
					  </tr>
					  
					  <tr>
						<td colspan="2" style="font-family:segoe UI, Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">&nbsp;</td>
					  </tr>
					  
					
					  <tr>
						<td colspan="2">
							<p style="font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">Thank you,</p>
						  	<!--<p style="font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">&nbsp;</p>-->
						  	<p style="font-size:12px;line-height:14px;	letter-spacing:0.6px;padding-top: 5px;padding-bottom: 5px;">'.stripslashes($empdetails->COM_Name).'</p></td>
					  </tr>
					</table></td>
				  <td ></td>
				</tr>
			  </table>';
	
	
					
			
	
	$mail_mesg=$mail_header.$mail_body.$GLOBALS['mail_footer'];

	
	
	//echo $mail_mesg."<br>"; exit;
	
		//echo 'Mailto='.$mailto; exit;
	
	
	
	
	switch($type)
	{
		
		case 1:case 4: case 10: case 14: case 20: case 21: // MAIL TO THE FINANCE APPROVERS
			
			$selacc=$wpdb->get_results("SELECT * FROM employees WHERE COM_Id='$compid' AND EMP_AccountsApprover=1 AND EMP_Id != '$empuserid' AND EMP_Access=1");
			
			foreach($selacc as $rowsql){
			
				$mail_to	=	$rowsql->EMP_Email;
		
				//$mail_from	=	stripslashes($empdetails['COM_Name'])."<".$empdetails['COM_Email'].">";
				
				$mail_from	=	"CorpTnE <notification@corptne.com>";
			
				$headers  	= 	'MIME-Version: 1.0' . "\r\n";
			
				$headers 	.= 	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				$headers 	.= 	'From:'.$mail_from;
				
				//SendPHPMailer($mail_to, $toname=false, $mail_sub, $mail_mesg, $headers);
			        $this->send( $mail_to, $mail_sub, $mail_mesg, $headers, $this->get_attachments() );
				//mail($mail_to,$mail_sub,$mail_mesg,$headers);
			}
		
		break;
		
		
		case 25:
		
			
		        
			$selacc=$wpdb->get_results("SELECT TD_Email FROM travel_desk WHERE COM_Id='$compid' AND TD_Status=1");
			
			//echo $empdetails['COM_Name']; exit;
			
			foreach($selacc as $rowsql){
			
				$mail_to	=	$rowsql->TD_Email;
		
				$mail_from	=	"CorpTnE <notification@corptne.com>";
			
				$headers  	= 	'MIME-Version: 1.0' . "\r\n";
			
				$headers 	.= 	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				$headers 	.= 	'From:'.$mail_from;
				
				//SendPHPMailer($mail_to, $toname=false, $mail_sub, $mail_mesg, $headers);
				$this->send( $mail_to, $mail_sub, $mail_mesg, $headers, $this->get_attachments() );	
				//mail($mail_to,$mail_sub,$mail_mesg,$headers);
			}
		
		break;
		
		
		
		default:
		
			$mail_to	=	$mailto;
		
			$mail_from	=	"CorpTnE <notification@corptne.com>";
		
			$headers  	= 	'MIME-Version: 1.0' . "\r\n";
		
			$headers 	.= 	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			$headers 	.= 	'From:'.$mail_from;
			
			//SendPHPMailer($mail_to, $toname=false, $mail_sub, $mail_mesg, $headers);
			$this->send( $mail_to, $mail_sub, $mail_mesg, $headers, $this->get_attachments() );
			//mail($mail_to,$mail_sub,$mail_mesg,$headers);
		
			
		
		
	}
    
    }
        

}
