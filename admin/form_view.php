<?php
session_start();

function getcurrentpath()
{   
	$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://"; 
	if ($_SERVER["SERVER_PORT"] != "80") 
	{ 
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
	}  
	else  
	{ 
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
	} 
	return $pageURL; 
}

if(isset($_REQUEST['refresh']))
{
	header("Location: " . getcurrentpath());
}

include("../classes/completionemail.php");

include("header.php");
admin_login_check();
include("col_left.php");


if(isset($_REQUEST['resend_notification']))
{
	$completionemail = new completionemail();
	$completionemail->jobid = $_REQUEST['jid'];
	$completionemail->send();
	$message = "Completion Notification Resent.";
}
	
$form_qry = "SELECT * FROM tbl_form WHERE jid = '".$_REQUEST['jid']."'";
$form_qry_e = mysql_query($form_qry);
 
if(isset($_REQUEST['submit'])){
	$ref_physician	=	addslashes($_REQUEST['ref_physican']);
	$address	=	addslashes($_REQUEST['address']);
	$office_phone	=	addslashes($_REQUEST['office_phone']);
	$tax_id	=	addslashes($_REQUEST['tax_id']);
	$pcp_name	=	addslashes($_REQUEST['pcp_name']);
	$contact	=	addslashes($_REQUEST['contact']);
	$fax	=	addslashes($_REQUEST['fax']);
	$npi	=	addslashes($_REQUEST['npi']);
	$clinical_notes	=	addslashes($_REQUEST['ref_notes']);
	$insurance_company	=	addslashes($_REQUEST['insurance_company']);
	$insurance_plan	=	addslashes($_REQUEST['insurance_phone']);
	$insurance_id	=	addslashes($_REQUEST['insurance_id']);
	$group	=	addslashes($_REQUEST['group_no']);
	$insurance_phone	=	addslashes($_REQUEST['insurance_phone']);
	$date_off_appt	=	addslashes($_REQUEST['date_off_appt']);
	$appt_time	=	addslashes($_REQUEST['ins_time']);
	$facility	=	addslashes($_REQUEST['facility']);
	$status	=	"assigned";
	$p_name	=	addslashes($_REQUEST['p_name']);
	$p_hm	=	addslashes($_REQUEST['p_hm']);
	$p_cl	=	addslashes($_REQUEST['p_cl']);
	$p_ssn	=	addslashes($_REQUEST['p_ssn']);
	$p_cpt	=	addslashes($_REQUEST['cpt']);
	$p_icd	=	addslashes($_REQUEST['icd']);
	$p_wk	=	addslashes($_REQUEST['p_wk']);
	$dob	=	addslashes($_REQUEST['p_dob']);
	$p_procedure	=	addslashes($_REQUEST['p_procedure']);
	$p_diagnosis	=	addslashes($_REQUEST['diagnosis']);
	$main_day	=	"1";
	$main_month =	"1";
	$main_year	=	"1";
	$authorize_no	=	addslashes($_REQUEST['aurthorize_no']);
	$effective_date =	addslashes($_REQUEST['effective_date']);
	$expiry_date	=	addslashes($_REQUEST['expiry_date']);
	$approved =	addslashes($_REQUEST['approved']);
	$job_notes = addslashes($_REQUEST['job_notes']);
	$ins_comp_2 = addslashes(trim($_REQUEST['ins_comp_2']));
	$ins_phone_2 = addslashes(trim($_REQUEST['ins_phone_2']));
	$ins_id_2 = addslashes(trim($_REQUEST['ins_id_2']));
	$ins_plan_2 = addslashes(trim($_REQUEST['ins_plan_2']));
	$ins_group_2 = addslashes(trim($_REQUEST['ins_group_2']));
							
	$w = "UPDATE  tbl_jobs set
				ref_physican			='".$ref_physician."',
				address					='".$address."',
				office_phone			='".$office_phone."',
				tax_id					='".$tax_id."',
				pcp_name				='".$pcp_name."',
				contact					='".$contact."',
				fax						='".$fax."',
				npi						='".$npi."',
				insurance_company		='".$insurance_company."',
				insurance_plan			='".$insurance_plan."',
				insurance_id			='".$insurance_id."',
				group_no					='".$group."',
				insurance_phone			='".$insurance_phone."',
				date_off_appt			='".$date_off_appt."',
				appt_time				='".$appt_time."',
				facility				='".$facility."',
				p_name					='".$p_name."',
				p_hm					='".$p_hm."',
				p_cl					='".$p_cl."',
				p_ssn					='".$p_ssn."',
				p_cpt					='".$p_cpt."',
				p_icd					='".$p_icd."',
				p_wk					='".$p_wk."',
				p_dob						='".$dob."',
				job_notes 				= '".$job_notes."',
				p_procedure				='".$p_pro."',
				p_diagnosis				='".$p_diagnosis."',
				aurthorize_no = 	'".$authorize_no."',
				effective_date = 	'".$effective_date."',
				ins_comp_2				='".$ins_comp_2."',
				ins_plan_2				='".$ins_plan_2."',
				ins_phone_2				='".$ins_phone_2."',
				ins_id_2				='".$ins_id_2."',
				ins_group_2				='".$ins_group_2."',
				expiry_date = 	'".$expiry_date."',
				approved = 	'".$approved."',
				main_day				='".$main_day."',
				main_month				='".$main_month."',
				main_year				='".$main_year."'
				WHERE id = '" . $_REQUEST['jid'] . "'";

				$w_e = mysql_query($w);
			
				$re = "SELECT id FROM tbl_jobs order by id desc limit 1";
				$re_e = mysql_query($re);
				$re_f = mysql_fetch_array($re_e);
			
				$poi = "DELETE FROM tbl_procedure WHERE jid = '".$_REQUEST['jid']."'";
				mysql_query($poi);
			
				$ar_cnt = $_REQUEST['cpt'];

				$authorize_no	=	addslashes($_REQUEST['aurthorize_no']);
				$effective_date =	addslashes($_REQUEST['effective_date']);
				$expiry_date	=	addslashes($_REQUEST['expiry_date']);
				$approved =	addslashes($_REQUEST['approved']);


				$ma = count($ar_cnt);
					for($i=0; $i < $ma; $i ++ ){
				
				$po = "INSERT INTO tbl_procedure set
				jid			='".$_REQUEST['jid']."',
				p_procedure	='".$_REQUEST['p_procedure'][$i]."',
				cpt			='".$_REQUEST['cpt'][$i]."',
				icd			='".$_REQUEST['icd'][$i]."',
				aurthorize_no			='".$_REQUEST['aurthorize_no'][$i]."',
				effective_date			='".$_REQUEST['effective_date'][$i]."',
				expiry_date			='".$_REQUEST['expiry_date'][$i]."',
				approved			='".$_REQUEST['approved'][$i]."',
				diagnosis	='".$_REQUEST['diagnosis'][$i]."'";
				mysql_query($po);
						}

		}
		if(isset($_REQUEST['submit_save']) && $_REQUEST['submit_save'] == "Post"){

		
				$ref_physician	=	addslashes($_REQUEST['ref_physican']);
				$address	=	addslashes($_REQUEST['address']);
				$office_phone	=	addslashes($_REQUEST['office_phone']);
				$tax_id	=	addslashes($_REQUEST['tax_id']);
				$pcp_name	=	addslashes($_REQUEST['pcp_name']);
				$contact	=	addslashes($_REQUEST['contact']);
				$fax	=	addslashes($_REQUEST['fax']);
				$npi	=	addslashes($_REQUEST['npi']);
				$clinical_notes	=	addslashes($_REQUEST['ref_notes']);
				$insurance_company	=	addslashes($_REQUEST['insurance_company']);
				$insurance_plan	=	addslashes($_REQUEST['insurance_phone']);
				$insurance_id	=	addslashes($_REQUEST['insurance_id']);
				$group	=	addslashes($_REQUEST['group_no']);
				$insurance_phone	=	addslashes($_REQUEST['insurance_phone']);
				$date_off_appt	=	addslashes($_REQUEST['date_off_appt']);
				$appt_time	=	addslashes($_REQUEST['ins_time']);
				$facility	=	addslashes($_REQUEST['facility']);
				$status	=	"complete";
				$p_name	=	addslashes($_REQUEST['p_name']);
				$p_hm	=	addslashes($_REQUEST['p_hm']);
				$p_cl	=	addslashes($_REQUEST['p_cl']);
				$p_ssn	=	addslashes($_REQUEST['p_ssn']);
				$p_cpt	=	addslashes($_REQUEST['cpt']);
				$p_icd	=	addslashes($_REQUEST['icd']);
				$p_wk	=	addslashes($_REQUEST['p_wk']);
				$dob	=	addslashes($_REQUEST['p_dob']);
				$p_procedure	=	addslashes($_REQUEST['p_procedure']);
				$p_diagnosis	=	addslashes($_REQUEST['diagnosis']);
				$main_day	=	"1";
				$main_month =	"1";
				$main_year	=	"1";
				$authorize_no	=	addslashes($_REQUEST['aurthorize_no']);
				$effective_date =	addslashes($_REQUEST['effective_date']);
				$expiry_date	=	addslashes($_REQUEST['expiry_date']);
				$approved =	addslashes($_REQUEST['approved']);
				$job_notes = addslashes($_REQUEST['job_notes']);
				
				$ins_comp_2 = addslashes(trim($_REQUEST['ins_comp_2']));

				$ins_phone_2 = addslashes(trim($_REQUEST['ins_phone_2']));

				$ins_id_2 = addslashes(trim($_REQUEST['ins_id_2']));

				$ins_plan_2 = addslashes(trim($_REQUEST['ins_plan_2']));

				$ins_group_2 = addslashes(trim($_REQUEST['ins_group_2']));
							
				 $w = "UPDATE  tbl_jobs set
				ref_physican			='".$ref_physician."',
				address					='".$address."',
				office_phone			='".$office_phone."',
				tax_id					='".$tax_id."',
				pcp_name				='".$pcp_name."',
				contact					='".$contact."',
				fax						='".$fax."',
				npi						='".$npi."',
				insurance_company		='".$insurance_company."',
				insurance_plan			='".$insurance_plan."',
				insurance_id			='".$insurance_id."',
				group_no					='".$group."',
				insurance_phone			='".$insurance_phone."',
				date_off_appt			='".$date_off_appt."',
				appt_time				='".$appt_time."',
				facility				='".$facility."',
				status					='".$status."',
				p_name					='".$p_name."',
				p_hm					='".$p_hm."',
				p_cl					='".$p_cl."',
				p_ssn					='".$p_ssn."',
				p_cpt					='".$p_cpt."',
				p_icd					='".$p_icd."',
				p_wk					='".$p_wk."',
				p_dob						='".$dob."',
				job_notes 				= '".$job_notes."',
				ins_comp_2				='".$ins_comp_2."',
				ins_plan_2				='".$ins_plan_2."',
				ins_phone_2				='".$ins_phone_2."',
				ins_id_2				='".$ins_id_2."',
				ins_group_2				='".$ins_group."',
				p_procedure				='".$p_pro."',
				p_diagnosis				='".$p_diagnosis."',
				aurthorize_no = 	'".$authorize_no."',
				effective_date = 	'".$effective_date."',
				expiry_date = 	'".$expiry_date."',
				approved = 	'".$approved."',
				main_day				='".$main_day."',
				main_month				='".$main_month."',
				main_year				='".$main_year."'
				WHERE id = '".$_REQUEST['jid']."'";

				$w_e = mysql_query($w);
			
				$re = "SELECT id FROM tbl_jobs order by id desc limit 1";
				$re_e = mysql_query($re);
				$re_f = mysql_fetch_array($re_e);
			
				$poi = "DELETE FROM tbl_procedure WHERE jid = '".$_REQUEST['jid']."'";
				mysql_query($poi);
			
				$ar_cnt = $_REQUEST['cpt'];
			
				$ma = count($ar_cnt);
					for($i=0; $i < $ma; $i ++ ){
				
				$po = "INSERT INTO tbl_procedure set
				jid			='".$_REQUEST['jid']."',
				p_procedure	='".$_REQUEST['p_procedure'][$i]."',
				cpt			='".$_REQUEST['cpt'][$i]."',
				icd			='".$_REQUEST['icd'][$i]."',
				aurthorize_no			='".$_REQUEST['aurthorize_no'][$i]."',
				effective_date			='".$_REQUEST['effective_date'][$i]."',
				expiry_date			='".$_REQUEST['expiry_date'][$i]."',
				approved			='".$_REQUEST['approved'][$i]."',
				diagnosis	='".$_REQUEST['diagnosis'][$i]."'";
				mysql_query($po);
	}
	
	$completionemail = new completionemail();
	$completionemail->jobid = $_REQUEST['jid'];
	$completionemail->send();
}

	$s = "SELECT * FROM tbl_jobs WHERE id = '".$_REQUEST['jid']."'";
	$s_e = mysql_query($s);
	$s_f = mysql_fetch_array($s_e);
        
	
	$sSubmitted = "SELECT fname,lname FROM tbl_user WHERE id = '".$s_f['fuid']."'";
	$qrySubmitted = mysql_query($sSubmitted);
	$rowSubmitted = mysql_fetch_array($qrySubmitted);
	
	$sSubmittedUser = $rowSubmitted['fname'] . " " . $rowSubmitted['lname'];

?>

<script>
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=550,height=600,left = 200,top = 200');");
}
// End -->
function add_feed()
{
	var div1 = document.createElement('div');

	// Get template data
	div1.innerHTML = document.getElementById('rep').innerHTML;

	// append to our form, so that template data
	//become part of form
	document.getElementById('pres').appendChild(div1);
	

}
</script>
<style>
	.read_only{
	color:#333333;
	}
	a.button, .list a.button {
		text-decoration: none;
		color: #FFF;
		display: inline-block;
		padding: 5px 10px 7px 10px;
		background: #3F9CFF;
		-webkit-border-radius: 10px 10px 10px 10px;
		-moz-border-radius: 10px 10px 10px 10px;
		-khtml-border-radius: 10px 10px 10px 10px;
		border-radius: 10px 10px 10px 10px;
		font-size:11px;
		font-family:Verdana
	}
	input.button, .list input.button {
		text-decoration: none;
		color: #FFF;
		display: inline-block;
		padding: 5px 10px 7px 10px;
		background: #3F9CFF;
		-webkit-border-radius: 10px 10px 10px 10px;
		-moz-border-radius: 10px 10px 10px 10px;
		-khtml-border-radius: 10px 10px 10px 10px;
		border-radius: 10px 10px 10px 10px;
		font-size:11px;
		font-family:Verdana;
		border-style:none;
	
	}
</style>

    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 

		<div id="page-header">
		<h1>Job Detail</h1>
		</div>

		<?php if($message or isset($_REQUEST[message])) 
		{
		?>
			<div class="notification error" style="width:200px">
			<?php echo $message?><?php echo $_REQUEST[message]?>
			</div>
		<?php 
		} 
		?>

		<div class="container_12"> 
        
<div class="grid_12">

	<form action="" id="contacts-form" method="post" name="add_job">
	
	<div class="box-header" align="right" > 
		<input type="submit"  name="refresh" value="Refresh" class="button" />&nbsp;
		<input type="submit"  name="resend_notification" value="Resend Notification" class="button" />
	</div>
          
	<div class="box table">
	
	<table cellspacing="0" cellpadding="4" border="0" >
	<tr>
		<td width="1px" nowrap>RFA #:</td>
		<td><?php echo $s_f['id']; ?>
		</td>
	</tr>
	<tr>
		<td width="1px" nowrap>Status:</td>
		<td>
		<?php
			$status = $s_f['status'];
			switch ($status) 
			{
				case "post":
					echo "Submitted";
					break;
				case "save": 
					echo "Not Submitted";
					break;
				case "assigned":
					echo "Assigned";
					break;
				case "complete":
					echo "Completed";
					break;
				default:
					echo $status;
					break;
			}
		?>
		</td>
	</tr>
	<tr>
		<td width="1px" nowrap>Submitted Date:</td>
		<td>
		<?php echo date("F-d-Y H:i:s", $s_f['rfa']);?>
		</td>
	</tr>
	<tr>
		<td width="1px" nowrap>Submitted By:</td>
		<td>
			<?php echo $sSubmittedUser; ?>
		</td>
	</tr>
	</table>
	
	<table width="100%" style="margin-top:10px">
	<tr>
		<td>
		<div style="font-family:Arial;font-weight:bold;color:#777777;font-size:14px;" >Referring Physician Information</div>
		</td>
		<td width="15px">&nbsp;</td>
		<td>
		<div style="font-family:Arial;font-weight:bold;color:#777777;font-size:14px;" >Scheduling Information</div>
		</td>
	</tr>
	<tr>
		<td valign="top" style="vertical-align:top">
			<div style="border:1px; border-color:#dce3f2; border-style:solid; background-color:#f6f9fe; padding:5px;">		
			<table cellpadding="4" cellspacing="4">
			<tr>
			<td nowrap >Is the Job Urgent?</td>
			<td valign="top"><?php echo $s_f['urgent'];?>
			</td>
			</tr>
			<tr>
			<td nowrap>Referring Physician:</td>
			<td ><input type="text" value="<?php echo $s_f['ref_physican'];?>" name="ref_physican" width="300px" /></td>
			</tr>
					<tr>

						<td >Address:</td>
						<td valign="top" align="left"><input type="text" value="<?php echo $s_f['address'];?>" name="address" /></td>
					</tr>	
			<tr>

										<td valign="top" align="right" width="20%">Office Phone:</td>
										<td valign="top" align="left"><input type="text" value="<?php echo $s_f['office_phone'];?>" name="office_phone" /></td>
									</tr>	
				<tr>
					<td valign="top" align="right" width="20%">Tax ID#:</td>
					<td valign="top" align="left"><input type="text" value="<?php echo $s_f['tax_id'];?>" name="tax_id" /></td>
				</tr>		
				<tr>
					<td valign="top">PCP's Name:</td>
					<td>
						<input type="text" value="<?php echo $s_f['pcp_name'];?>" name="pcp_name" />
						<br>(Only Applicable if Secure Horizon Patient)
					</td>
				</tr>
				<tr>
					<td nowrap>Clinical Notes Attached:</td>
					<td><?php if($s_f['clinical'] != ""){ $str = $s_f['clinical']; ?><a style="text-decoration:none; color:#blue;" href="../images/gallery/clinical/cl_<?php echo $str; ?>">Clinical Notes<?php }?></a></td>
				</tr>
				<tr>

					        <td valign="top" align="right" width="20%">Fax#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['fax'];?>" name="fax" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">NPI#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['npi'];?>" name="npi" /></span></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Forms Attached:</td>
					        <td valign="top" align="left">
								<?php
								if(mysql_num_rows($form_qry_e) > 0){
								?>
								<a href="javascript:popUp('../pages/forms/ATT00019_admin.php?frm_id=<?php echo $_REQUEST['jid'];?>&jid=<?php echo $_REQUEST['jid'];?>')" style="text-decoration:none;">ATT00019 </a>
								<?php }?>
							</td>
						</tr>
			</table>
			</div>
		</td>
		<td width="15px">&nbsp;</td>
		<td valign="top">
		<div style="border:1px; border-color:#dce3f2; border-style:solid; background-color:#f6f9fe; padding:5px;">	
		<table>
			<tr>
				<td valign="top" align="right" width="20%">Date of Appt:</td>
				<td valign="top" align="left"><input maxlength="2" type="text" value="<?php echo $s_f['appt_month'];?>" name="appt_month" style="width:30px" />-<input type="text" maxlength="2" style="width:30px" value="<?php echo $s_f['appt_day'];?>" name="appt_day" />-<input maxlength="4" type="text" value="<?php echo $s_f['appt_year']?>" name="appt_year" style="width:30px" /></td>
			</tr>
			<tr>
				<td valign="top" align="right" width="20%">Facility:</td>
				<td valign="top" align="left"><input type="text" value="<?php echo $s_f['facility'];?>" name="facility" /></td>
			</tr>	
				<tr>

					        <td valign="top" align="right" width="20%">Appt Day:</td>
					        <td valign="top" align="left">
							<?php if($s_f['sch_day'] == "mon"){echo "Monday";}
										  	else if($s_f['sch_day'] == "tue"){echo "Tuesday";}
											else if($s_f['sch_day'] == "wed"){echo "Wednesday";}
											else if($s_f['sch_day'] == "thu"){echo "Thursday";}
											else if($s_f['sch_day'] == "fri"){echo "Friday";}
											else if($s_f['sch_day'] == "sat"){echo "Saturday";}
											else if($s_f['sch_day'] == "sun"){echo "Sunday";}
										  
										   ?>
							</td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Appt Time:</td>
					        <td valign="top" align="left"><input type="text" style="width:30px" value="<?php echo $s_f['appt_hrs'];?>" maxlength="2" name="appt_hrs" />-<input type="text" value="<?php echo $s_f['appt_min'];?>" maxlength="2" style="width:30px" name="appt_min" /></td>
						</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="font-family:Arial;font-weight:bold;color:#777777;font-size:14px;" >Patient Information</div>
		</td>
		<td width="15px">&nbsp;</td>
		<td>
		<div style="font-family:Arial;font-weight:bold;color:#777777;font-size:14px;" >Insurance Information (If Medicaid please indicate which plan)</div>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<table>
			<tr>
					        <td valign="top" align="right" width="20%">Name:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['p_name'];?>" name="p_name" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Home#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['p_hm'];?>" name="p_hm" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Cell#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['p_cl'];?>" name="p_cl" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">SSN:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['p_ssn'];?>" name="p_ssn" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Work#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['p_wk'];?>" name="p_wk" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">DOB:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['p_dob'];?>" name="p_dob" /></td>
						</tr>
						<tr>
							<td valign="top" align="right" width="20%">Notes:</td>
					        <td valign="top" align="left"><textarea name="job_notes"><?php echo $s_f['job_notes'];?></textarea></td>
						</tr>
			</table>
		</td>
		<td width="15px">&nbsp;</td>
		<td valign="top">
		<table>
			<tr>
				<td valign="top" align="right" width="20%">Insurance Plan:</td>
				<td valign="top" align="left"><input type="text" value="<?php echo $s_f['insurance_plan'];?>" name="insurance_plan" /></td>
			</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Group#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['group_no'];?>" name="group_no" /></td>
						</tr>

						<tr>

					        <td valign="top" align="right" width="20%">Secondary Insurance Plan:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['ins_plan_2'];?>" name="ins_plan_2" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Secondary Group#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['ins_group_2'];?>" name="ins_group_2" /></td>
						</tr>
                        
						<tr>

					        <td valign="top" align="right" width="20%">Insurance Card:</td>
					        <td valign="top" align="left"><?php if($s_f['ins_card'] != ""){?><a style="text-decoration:none; color:#333333;" href="../images/gallery/insurance/ins_<?php echo $s_f['ins_card']; ?>">Insurance Card<?php }?></a></td>
						</tr>
					
						<tr>

					        <td valign="top" align="right" width="20%">Insurance Co:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['insurance_company'];?>" name="insurance_company" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Insurance Phone#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['insurance_phone'];?>" name="insurance_phone" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Insurance ID#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['insurance_id'];?>" name="insurance_id" /></td>
						</tr>
						


						<tr>

					        <td valign="top" align="right" width="20%">Secondary Insurance Co:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['ins_comp_2'];?>" name="ins_comp_2" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Secondary Insurance Phone#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['ins_phone_2'];?>" name="ins_phone_2" /></td>
						</tr>
						<tr>

					        <td valign="top" align="right" width="20%">Secondary Insurance ID#:</td>
					        <td valign="top" align="left"><input type="text" value="<?php echo $s_f['ins_id_2'];?>" name="ins_id_2" /></td>
						</tr>
						
						</table>
		</td>
	</tr>
	</table>
	

	<table>

						<tr>

					        <td valign="top" align="right" width="20%"><b>Procedures</b></td>
					        <td valign="top" align="left">&nbsp;</td>
						</tr>
                        <tr>
                        <td colspan="2">
                        <div>
                        	<table id="pres">
                            <tr>
                            <td>
							<?php $jj = "SELECT * FROM tbl_procedure where jid = '".$_REQUEST['jid']."'";
									$jj_e = mysql_query($jj);
									while($jj_f = mysql_fetch_array($jj_e)){
									?>
                                    <div>
                                    <table>
									
                                    <tr>
					  		   
                                          <td  valign="top" align="right" width="20%">CPT#</td><td  valign="top" align="left"><input type="text" value="<?php echo $jj_f['cpt'];?>" name="cpt[]" /></td>
                           			</tr>
									<tr>
						                  <td  valign="top" align="right" width="20%">ICD-9 Code:</td><td  valign="top" align="left"><input type="text" value="<?php echo $jj_f['icd'];?>" name="icd[]" /></td>
                                    </tr>  
									<tr>
										<td  valign="top" align="right" width="20%">Procedure:</td><td  valign="top" align="left"><input type="text" value="<?php echo $jj_f['p_procedure'];?>" name="p_procedure[]" /></td>
									</tr>
									<tr>
										 <td  valign="top" align="right" width="20%">Diagnosis:</td><td  valign="top" align="left"><input type="text" value="<?php echo $jj_f['diagnosis'];?>" name="diagnosis[]" /></td>
									</tr>
									
						
									<tr>
			
										<td valign="top" align="right" width="20%">Authorization#</td>
										<td valign="top" align="left"><input type="text" value="<?php echo $jj_f['aurthorize_no'];?>" name="aurthorize_no[]" /></td>
									</tr>
									<tr>
			
										<td valign="top" align="right" width="20%">Effective Date:</td>
										<td valign="top" align="left"><input type="text" value="<?php echo $jj_f['effective_date'];?>" name="effective_date[]" /></td>
									</tr>
									<tr>
			
										<td valign="top" align="right" width="20%">Approved:</td>
										<td valign="top" align="left"><input type="text" value="<?php echo $jj_f['approved'];?>" name="approved[]" /></td>
									</tr>
									<tr>
			
										<td valign="top" align="right" width="20%">Expiry Date:</td>
										<td valign="top" align="left"><input type="text" value="<?php echo $jj_f['expiry_date'];?>" name="expiry_date[]" /></td>
									</tr>
									
                                		</table>
                                        </div>
						   <?php } ?>
                           </td>
                           </tr>
                           
                           </table>
                           </div>
							<div>
                           <tr>
                           	<td>
                            	<p id="addnew">
								<a href="javascript:add_feed()">Add New Procedure</a>
							</p>
                            </td>
                           </tr>
                           </div>
                           </td>
                          </tr>
                     
						
						<tr>
							<td><input type="submit"  name="submit_save" value="Post" />
					   		<input type="submit" name="submit" value="Save" /></td>
							
						
						</tr>
                       </table>
	
	</form>

           
          </div>
        </div>
        
        
        </div>

        <br class="cl">
        <br class="cl">
        <br class="cl">
 
 

    </div>
    
<div style="display:none;" id="rep">
	<div>
		<table>
			<tr>
	   
				  <td  valign="top" align="right" width="20%">CPT#</td><td  valign="top" align="left"><input type="text" value="" name="cpt[]" /></td>
			</tr>
			<tr>
				  <td  valign="top" align="right" width="20%">ICD-9 Code:</td><td  valign="top" align="left"><input type="text" value="" name="icd[]" /></td>
			</tr>  
			<tr>
				<td  valign="top" align="right" width="20%">Procedure:</td><td  valign="top" align="left"><input type="text" value="" name="p_procedure[]" /></td>
			</tr>
			<tr>
				 <td  valign="top" align="right" width="20%">Diagnosis:</td><td  valign="top" align="left"><input type="text" value="" name="diagnosis[]" /></td>
			</tr>
			<tr>

				<td valign="top" align="right" width="20%">Authorization#</td>
				<td valign="top" align="left"><input type="text" value="" name="aurthorize_no[]" /></td>
			</tr>
			<tr>

				<td valign="top" align="right" width="20%">Effective Date:</td>
				<td valign="top" align="left"><input type="text" value="" name="effective_date[]" /></td>
			</tr>
			<tr>

				<td valign="top" align="right" width="20%">Approved:</td>
				<td valign="top" align="left"><input type="text" value="" name="approved[]" /></td>
			</tr>
			<tr>

				<td valign="top" align="right" width="20%">Expiry Date:</td>
				<td valign="top" align="left"><input type="text" value="" name="expiry_date[]" /></td>
			</tr>
			</table>
	 </div>
</div>
    
    


<?php include("footer.php")?>