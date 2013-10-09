<?php
include("../includes/configure.php"); 
include("../includes/functions.php");
$nm = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$_REQUEST['usrid']."'"));

		$tmp_s = explode("-",$_REQUEST['sdate']);
		$sdate_disp = $tmp_s[0]."-".$tmp_s[1]."-".$tmp_s[2];
		$tmp_e = explode ("-",$_REQUEST['edate']);
		$edate_disp = $tmp_e[0]."-".$tmp_e[1]."-".$tmp_e[2];
$a = "11111";
$bdy = '';


$bdy = '<div style="width:800px; margin:0 auto;">
	<table width="100%"  align="center">
	<tr>
		<td align="center" style="font-size:18px; font-weight:bold;">Burks Medical Consulting</td>
	</tr>
		<tr>
		<td align="center" style="font-weight:bold; font-size:16;">
			Employee Time Report
		</td>
	</tr>
<tr>
		<td style=" border:1px solid;">Employee Name: </td>
		<td style=" border:1px solid;">'.$nm['fname'].' '.$nm['lname'].'</td>
</tr>
	<tr>
		<td style=" border:1px solid;">Start Date: </td>
		<td style=" border:1px solid;">'.$sdate_disp.'</td>
	</tr>
	<tr>
		<td style=" border:1px solid;">End Date: </td>
		<td style=" border:1px solid;">'.$edate_disp.'</td>
	</tr>
</table>
<table  width="100%" style="margin-top:25px;">
	<tr style="background:#000000; color:#FFFFFF;">
		<td align="center">Login Date/Time</td>
		<td align="center">Logout Date/Time</td>
		<td align="center">Total Session Time</td>
	</tr>';
				$rew = "SELECT * FROM tbl_emp WHERE emp_id = '".$_REQUEST['usrid']."' and time_in BETWEEN '".$_REQUEST['sdate']."' and '".$_REQUEST['edate']."'";
				
				$query = mysql_query($rew);

			
			  $total_hours = 0;
			  $total_min = 0;
				$whl = '';
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
					$whl .='
                    <tr>

                       <td align="center">'.$row['time_in'].'</td>
						<td align="center">'.$row['time_out'].'</td>
                        <td align="center">'.$months.' Months '.$days.' Days '.$hours.':'.$minuts.':'.$seconds.'</td>
							
                    </tr>';
					$total_hours = $total_hours + $hours;
					$total_min = $total_min + $minuts;


}
					$bdy .= $whl;
					$tmp_hrs = ($total_min*60)/3600;
					$tmp_hr = explode(".",$tmp_hrs);
					$tmp_hrs = $tmp_hr[0];
					//total hours
					$total_hours = $total_hours  + $tmp_hrs;
					
					if($tmp_hrs > 0){
					$total_min = ($total_min*60)-(3600*$tmp_hr[0]);
					$total_min =$total_min/60;
					}

				


                $bdy .= '<tr>
				 	<td colspan="3" align="right">
						<label>Grand Total:'.$total_hours.' hours '.$total_min.' minuts </label>
					</td>
				 </tr>               
            </table>
	
</div>';

echo $bdy;
$from = "generalmail@burksmedicalconsulting.com";
	$headers =  "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $from = "Burks Medical Consulting".' < '.$from.' >';
    $headers .= "From: $from \r\n";
    $headers .= "Reply-To: $from \r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= "Message-ID: <". time() .rand(1,1000). "@".$_SERVER['SERVER_NAME'].">". "\r\n";
    $headers .= "<br>X-Mailer: PHP \r\n";
		$to = $_REQUEST['email'];
		$sub = "Time Sheet Report";

		if(mail($to,$sub,$bdy,$headers)){
			//echo "email sent";
		}
		else{
			//echo "email not sent";
		}

?>
<div align="center">
	<input name="close" value="Close" type="button" onclick="window.close()" />
</div>