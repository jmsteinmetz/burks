<?php
include("../includes/configure.php"); 
include("../includes/functions.php");
$nm = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$_REQUEST['usrid']."'"));

$rew = "SELECT * FROM tbl_jobs WHERE 1=1 ";
if($_REQUEST['usrid'] != ""){
	$rew.= "and fuid = '".$_REQUEST['usrid']."'";
}
if($_REQUEST['job_st'] != none){
	$rew.= " and status = '".$_REQUEST['job_st']."'";
}
if($_REQUEST['fac'] != '')
{
	$rew.= " and facility = '".$_REQUEST['fac']."'";
}
if($_REQUEST['phy'] != none){
	$rew.= " and ref_physican = '".$_REQUEST['phy']."'";
}

$appt_startdate = $_REQUEST['sdate'];
$appt_enddate = $_REQUEST['edate'];

if ($appt_startdate == '')
{
	if ($appt_enddate != '')
	{
		$rew.=" and appt_full_date <= '" .date('Y-m-d', strtotime($appt_enddate)) . "'";
	}
}
else
{
	if ($appt_enddate == '')
	{
		$rew.=" and appt_full_date >= '" .date('Y-m-d', strtotime($appt_startdate)) . "'";
	}
	else
	{
		$rew.=" and appt_full_date BETWEEN '" .date('Y-m-d', strtotime($appt_startdate)) . "' and '" . date('Y-m-d', strtotime($appt_enddate)) . "'";
	}
}

$completed_startdate = $_REQUEST['csdate'];
$completed_enddate = $_REQUEST['cedate'];

if ($completed_startdate == '')
{
	if ($completed_enddate != '')
	{
		$rew.=" and completed_datetime <= '" .date('Y-m-d', strtotime($completed_enddate)) . "'";
	}
}
else
{
	if ($completed_enddate == '')
	{
		$rew.=" and completed_datetime >= '" .date('Y-m-d', strtotime($completed_startdate)) . "'";
	}
	else
	{
		$rew.=" and completed_datetime BETWEEN '" .date('Y-m-d', strtotime($completed_startdate)) . "' and '" . date('Y-m-d', strtotime($completed_enddate)) . "'";
	}
}


$query = mysql_query($rew);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $nm['provider']." Jobs Report";?></title>
</head>

<body style="margin:0;">
<div style="align:left;width:800px; margin:0;">
<table width="100%" >
	<tr>
		<td align="center" style="font-family:Arial;font-size:18px; font-weight:bold;" colspan='2'>Burks Medical Consulting - Client Report</td>
	</tr>
</table>
<table style="margin-left:10px;">
	<tr>
		<td>Provider: </td>
		<td>
		<?php 
		  if ($nm['provider'] == '')
		  {
			echo 'All Providers';
		  }
		  else
		  {
			echo $nm['provider'].", ( ".$nm['email']." )";  
		  }
		
		?>
		</td>
	</tr>
	<?php
		if ($_REQUEST['sdate'] != '')
		{
	?>
	<tr>
		<td>Appt Start Date: </td>
		<td><?php echo $_REQUEST['sdate']; ?></td>
	</tr>
	<?php
			}
			if ($_REQUEST['edate'] != '')
		{
	?>
	
	<tr>
		<td>Appt End Date: </td>
		<td><?php echo $_REQUEST['edate']; ?></td>
	</tr>
	<?php
			}
	?>
		<tr>
		<td >Completed Start Date: </td>
		<td >
		<?php 
		
			$completed_startdate = $_REQUEST['csdate'];
			
			if ($completed_startdate == '')
			{
				echo 'Not Specified - All Dates';
			}
			else
			{
				echo $completed_startdate;
			}
		?></td>
	</tr>
		<tr>
		<td >Completed End Date: </td>
		<td ><?php echo $_REQUEST['cedate']; ?></td>
	</tr>
	<tr>
		<td>Facility: </td>
		<td >
		<?php 
		if ($_REQUEST['fac'] == '')
		{
			echo 'All facilities';
		}
		else
		{
			echo $_REQUEST['fac'];
		}
		?>
		</td>
	</tr>
	<?php if($_REQUEST['phy'] != none){?>
	<tr>
		<td>Referring Physican: </td>
		<td><?php echo $_REQUEST['phy'];?></td>
	</tr>
	<?php
		}
	
	?>
	<tr>
		<td >RFA Count: </td>
		<td>
		<?php
			$no_of_records = mysql_num_rows ($query);
			echo $no_of_records;
		?>
		</td>
	</tr>
</table>
<table  width="100%" style="margin-top:25px;font-size:12px;">

            <tr style="background:#000000; color:#FFFFFF;">
				  <td>RFA</td>
                  <td nowrap>Appt Date</td>
				  <td>Status</td>
				  <td nowrap>Patient Name</td>
				  <td>Insurance</td>
                  <td>DOB</td>
				  <td nowrap>CPT Code</td>
				  <td nowrap>Auth #</td>
				  <td nowrap>Approved By</td>
                  <td>Facility</td>
				  <td nowrap>Expiration Date</td>
				  <td nowrap>Refer DR</td>
				  <td nowrap>Completed Date</td>
            </tr>
		<?php
			
					
					while($row = mysql_fetch_array($query))
				{
		
					$rw = 	mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$_REQUEST['usrid']."'"));

					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['id'];?></td>
                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;" nowrap>
						<?php 
							if($row['appt_month'] < 10){
								$mnth = "0".$row['appt_month'];
							}
							else{
								$mnth = $row['appt_month'];
							}
							
							if($row['appt_day'] < 10){
								$ddy = "0".$row['appt_day'];
							}
							else{
								$ddy = $row['appt_day'];
							}
							echo $mnth."-".$ddy."-".$row['appt_year'];
						?>
						</td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
						
						<?php
						
							$status = $row['status'];
							switch ($status) {
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
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['p_name'];?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['insurance_company'];?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['p_dob'];?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
						<?php 
						$yu = "select * from tbl_procedure where jid = '".$row['id']."'";
						 $yu_qry = mysql_query($yu);
						 	while($yu_qry_f = mysql_fetch_array($yu_qry)){
						 echo $yu_qry_f['cpt']."<br>";
						 }	
						?>
						</td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
						<?php 
						$yuu = "select * from tbl_procedure where jid = '".$row['id']."'";
						 $yuu_qry = mysql_query($yuu);
						 	while($yuu_qry_f = mysql_fetch_array($yuu_qry)){
						 echo $yuu_qry_f['aurthorize_no']."<br>";
						 }	
						?>
						</td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
						<?php 
						$yui = "select * from tbl_procedure where jid = '".$row['id']."'";
						 $yui_qry = mysql_query($yui);
						 	while($yui_qry_f = mysql_fetch_array($yui_qry)){
						 echo $yui_qry_f['approved']."<br>";
						 }	
						?>
						</td>
                        <td style="border:1px solid #9D9D9D;">  
                        <?php echo $row['facility'];?>
                        </td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
						<?php 
						$yuo = "select * from tbl_procedure where jid = '".$row['id']."'";
						 $yuo_qry = mysql_query($yuo);
						 	while($yuo_qry_f = mysql_fetch_array($yuo_qry)){
						 echo $yuo_qry_f['expiry_date']."<br>";
						 }	
						?>
						</td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['ref_physican'];?></td>

						<td style="border:1px solid #9D9D9D;" nowrap>
						
						<?php 
							$completed_datetime = $row['completed_datetime'];
							if (is_null($completed_datetime))
							{
								echo "--";
							}
							else
							{
								echo date('m-d-Y', strtotime($completed_datetime));
							}
						?>
						
						</td>
						
				

							
                    </tr>
					<?php }?>
                    
			
            </table>
	
</div>
</body>
</html>
