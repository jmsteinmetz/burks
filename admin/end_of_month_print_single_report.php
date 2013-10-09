<?php
include("../includes/configure.php"); 
include("../includes/functions.php");

$starting_id = $_REQUEST['id'];

$q1 = "SELECT * from eom_tbl where id = '".$starting_id."'";
$eom = mysql_query($q1);
$client_count = mysql_num_rows ($eom);

while($eomrow = mysql_fetch_array($eom))
{
$nm = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$eomrow['uid']."'"));
 
$rew = "SELECT job.*, proc.cpt, proc.aurthorize_no,proc.approved, proc.expiry_date FROM tbl_jobs as job inner join tbl_procedure as proc on (proc.jid = job.id) WHERE ";

	$rew.= "job.fuid = '".$eomrow['uid']."'";

	$rew.= " and job.status = 'complete'";

$completed_startdate = $_REQUEST['csdate'];
$completed_startdate = date('Y-m-d',strtotime($completed_startdate));
$completed_enddate = $_REQUEST['cedate'];
$completed_enddate = date('Y-m-d',strtotime($completed_enddate));

        $rew.=" and job.completed_datetime >= '" .$completed_startdate. "' and job.completed_datetime < date_add('" .$completed_enddate. "',interval 1 day) order by job.id";

$query = mysql_query($rew);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style media="print" type="text/css">

@media all {
 .page-break { display: none; }
}

@media print {
 .page-break { display: block; page-break-before: always; }
 table { page-break-inside: auto; page-break-after: auto; }
 tr { page-break-before: auto; page-break-inside: avoid; page-break-after: auto; }
 td { page-break-inside: avoid; page-break-after: auto; }
 thead { display: table-header-group; }
 tfoot { display: table-footer-group; }
 @page {
 size: 8.5in 10.5in;
 margin-left: .25in;
 margin-right: .25in;
 margin-top: .25in;
 margin-bottom: 0
 }
}

</style>
<title><?php echo $nm['provider']." Jobs Report";?></title>
</head>

<body style="margin:0;">
<div class="page-break"></div>
<div style="align:left;width:900px; margin:0px;">
<table width="100%" >
	<tr>
		<td align="center" style="font-family:Arial;font-size:18px; font-weight:bold;" colspan='2'>Burks Medical Consulting - End of Month Client Report</td>
	</tr>
</table>
<table style="margin-left:10px">
	<tr>
		<td>Provider: </td>
		<td><?php echo $nm['fname']." ".$nm['lname']." ( ".$nm['email']." )";?></td>
	</tr>
	<tr>
		<td >Start Date: </td>
		<td ><?php echo $_REQUEST['csdate']; ?></td>
	
		<td >End Date: </td>
		<td ><?php echo $_REQUEST['cedate']; ?></td>
	</tr>
	<tr>
		<td>Facility: </td>
		<td ><?php 
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
	
		<td >RFA Count: </td>
		<td><?php echo $eomrow['rfas'];?></td>
	</tr>
</table>

		<?php
			
					$cid = 0; /* current job id */
                                        $rc = -1; /* row count */
                                        $f1 = array(); /* job id */
                                        $f2 = array(); /* appt date */
                                        $f3 = array(); /* patient name */
                                        $f4 = array(); /* ins company */
                                        $f5 = array(); /* patient dob */
                                        $f6 = array(); /* cpt */
                                        $f7 = array(); /* authorization */
                                        $f8 = array(); /* approved */
                                        $f9 = array(); /* facility */
                                        $f10 = array(); /* expiration date */
                                        $f11 = array(); /* ref physician */
                                        $f12 = array(); /* completed date */
                                        
					while($row = mysql_fetch_array($query))
				{

                                        $test = $row['id'];
                                        if ($test != $cid) {
                                          $rc++;
                                          $cid = $test;
                                          $f1[$rc] = $test;
                                          $rflag = 0;
                                          }
                                         else {
                                          $rflag = 1;
                                          }

                                         $test = $row['appt_month'];
                                         if($test < 10){
					   $mnth = '0'.$test;
                                           }
                                         else {
                                           $mnth = $test;
                                           }

                                         $test = $row['appt_day'];
                                         if($test < 10){
					   $ddy = '0'.$test;
                                           }
                                         else {
                                           $ddy = $test;
                                           }
                                         $f2[$rc] = $mnth.'-'.$ddy.'-'.$row['appt_year'];
                                         
                                         $f3[$rc] = $row['p_name'];
                                         $f4[$rc] = $row['insurance_company'];

                                         $dob = $row['p_dob'];
                                         $f5[$rc] =date('m-d-Y', strtotime($dob));

                                        if ($rflag == 0) {
                                          $cpt = str_replace('/',' ',$row['cpt']);
                                          }
                                        else {
                                          $cpt.= '<br>'.str_replace('/',' ',$row['cpt']);
                                          }
                                        $f6[$rc] = $cpt;

                                        if ($rflag == 0) {
                                          $auth = $row['aurthorize_no'];
                                          }
                                        else {
                                          $auth.= '<br>'.$row['aurthorize_no'];
                                          }
                                        $f7[$rc] = $auth;

                                        if ($rflag == 0) {
                                          $appr = str_replace('/',' ',$row['approved']);
                                          }
                                        else {
                                          $appr.= '<br>'.str_replace('/',' ',$row['approved']);
                                          }
                                        $f8[$rc] = $appr;

                                        $f9[$rc] = $row['facility'];

                                        if ($rflag == 0) {
                                          $exp = date('m-d-Y', strtotime($row['expiry_date']));
                                          }
                                        else {
                                          $exp.= '<br>'.date('m-d-Y', strtotime($row['expiry_date']));
                                          }
                                        $f10[$rc] = $exp;

                                        $f11[$rc] = $row['ref_physican'];

                                        $cdate = $row['completed_datetime'];
                                        $f12[$rc] = date('m-d-Y', strtotime($cdate));

				}
                          ?>
<table  width="100%" style="table-layout:fixed;font-size:12px">
            <tbody>
            <tr style="background:#000000; color:#FFFFFF;">
				  <td height="20px" width="35px" nowrap>RFA</td>
                                  <td width="60px" nowrap>Appt Date</td>
				  <td width="50px"> Status</td>
				  <td width="140px" nowrap>Patient Name</td>
				  <td width="90px" nowrap>Insurance Carrier</td>
                                  <td width="60px" nowrap>Pat DOB</td>
				  <td width="35px" nowrap>CPT</td>
				  <td width="210px" nowrap>Authorization Number or Current Status</td>
				  <td width="65px" nowrap>Approved</td>
                                  <td width="65px" nowrap>Facility Nm</td>
				  <td width="60px" nowrap>Exp Date</td>
				  <td width="100px" nowrap>Referring Physician</td>
				  <td width="60px" nowrap>Comp Date</td>
            </tr>



		<?php

                        for ($i = 0; $i <= $rc; $i++)
                        {

                ?>

                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'" style="page-break_inside: avoid;page-break-after: auto">
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                        <?php echo $f1[$i];?></td>
                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;" nowrap>
			<?php echo $f2[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
			<?php echo "Complete";?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                        <?php echo $f3[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                        <?php echo $f4[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;" nowrap>
                        <?php echo $f5[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
			<?php echo $f6[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
			<?php echo $f7[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
			<?php echo $f8[$i];?></td>
			<td style="border:1px solid #9D9D9D;">  
                        <?php echo $f9[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;" nowrap>
			<?php echo $f10[$i];?></td>
			<td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                        <?php echo $f11[$i];?></td>
			<td style="border:1px solid #9D9D9D;" nowrap>
			<?php echo $f12[$i];?></td>
							
                    </tr>
                    </tbody>                  

         		<?php }?>
  			
            </table>
	
</div>
</body>
</html>

<?php } ?>