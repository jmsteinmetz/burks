<?php
include("../includes/configure.php"); 
include("../includes/functions.php");
$nm = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$_REQUEST['usrid']."'"));
if(isset($_REQUEST['submit'])){
?>
	<script>
		window.location = "tst_emp_email.php?email=<?php echo $_REQUEST['email_id'] ?>&usrid=<?php echo $_REQUEST['usrid']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>";
	</script>
<?php

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $nm['fname']." ".$nm['lname']." Time Sheet";?></title>
</head>

<body>
<div style="width:800px; margin:0 auto;">
<table width="100%"  align="center">
	<tr>
		<td align="center" style="font-size:18px; font-weight:bold;">Burks Medical Consulting</td>
	</tr>
	<tr>
		<td align="center" style="font-weight:bold; font-size:16;">
			Employee Time Report
		</td>
	</tr>
	<?php 
		$tmp_s = explode("-",$_REQUEST['sdate']);
		$sdate_disp = $tmp_s[0]."-".$tmp_s[1]."-".$tmp_s[2];
		$tmp_e = explode ("-",$_REQUEST['edate']);
		$edate_disp = $tmp_e[0]."-".$tmp_e[1]."-".$tmp_e[2];
		
		
	?>
	<tr>
		<td style=" border:1px solid;">Employee Name: </td>
		<td style=" border:1px solid;"><?php echo $nm['fname']." ".$nm['lname'];?></td>
	</tr>
	<tr>
		<td style=" border:1px solid;">Start Date: </td>
		<?php
		 if($tmp_s[2] < 10){
			$tmp_s[2] = "0".$tmp_s[2];
		}
			if($tmp_s[1] < 10){
				$tmp_s[1] = "0".$tmp_s[1];
				}
			if($tmp_e[1] < 10){
				$tmp_e[1] = "0".$tmp_e[1];
			}
			if($tmp_e[2] < 10){
				$tmp_e[2] = "0".$tmp_e[2];
			}
		?>
		<td style=" border:1px solid;"><?php echo  $tmp_s[1]."-".$tmp_s[2]."-20".$tmp_s[0];?></td>
	</tr>
	<tr>
		<td style=" border:1px solid;">End Date: </td>
		<td style=" border:1px solid;"><?php echo $tmp_e[1]."-".$tmp_e[2]."-20".$tmp_e[0];?></td>
	</tr>
</table>
<table  width="100%" style="margin-top:25px;">
	<tr style="background:#000000; color:#FFFFFF;">
		<td align="center">Login Date/Time</td>
		<td align="center">Logout Date/Time</td>
		<td align="center">Total Session Time</td>
	</tr>
	<?php
				$rew = "SELECT * FROM tbl_emp WHERE emp_id = '".$_REQUEST['usrid']."' and time_in BETWEEN '".$_REQUEST['sdate']."' and '".$_REQUEST['edate']."'";
				
				$query = mysql_query($rew);

			
			  $total_hours = 0;
			  $total_min = 0;
				while($row = mysql_fetch_array($query))
				{
					
					
///////////////////////////////////////////////////////////////
//$date1 = "2008-11-01 22:45:00"; 

//$date2 = "2009-12-04 13:44:01"; 

$diff = abs(strtotime($row['time_out']) - strtotime($row['time_in'])); 

$years   = floor($diff / (365*60*60*24)); 
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 


///////////////////////////////////////////////////////////					
					
					
					
					$rw = 	mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$_REQUEST['usrid']."'"));
//					print_r($rw);
					?>
                    <tr>

                       <td align="center"><?php echo $row['time_in']; ?></td>
						<td align="center"><?php echo $row['time_out']; ?></td>
                        <td align="center"><?php printf("%d days, %d hours, %d minutes\n, %d seconds\n", $days, $hours, $minuts, $seconds); ?></td>
							
                    </tr>
                    <?php
					$total_hours = $total_hours + $hours;
					$total_min = $total_min + $minuts;
					
				}
					
					$tmp_hrs = ($total_min*60)/3600;
					$tmp_hr = explode(".",$tmp_hrs);
					$tmp_hrs = $tmp_hr[0];
					//total hours
					$total_hours = $total_hours  + $tmp_hrs;
					
					if($tmp_hrs > 0){
					$total_min = ($total_min*60)-(3600*$tmp_hr[0]);
					$total_min =$total_min/60;
					}

				?>


                 <tr>
				 	<td colspan="3" align="right">
						<label><?php echo "Grand Total: ".$total_hours." hours ". $total_min." minutes ";?></label>
					</td>
				 </tr>
				 <tr>
				 	<td colspan="3" align="center">
						<form name="eml_rpt" action="" method="post">
						<input type="text" name="email_id" value="" />
						<input type="submit" name="submit" value="Send Email" />
						</form>
					</td>
				 </tr>               
            </table>
	
</div>
</body>
</html>
