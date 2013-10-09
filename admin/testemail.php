<?php


$from = "generalmail@burksmedicalconsulting.com";
	$headers =  "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $from = "Burks Medical Consulting".' < '.$from.' >';
    $headers .= "From: $from \r\n";
    $headers .= "Reply-To: $from \r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= "Message-ID: <". time() .rand(1,1000). "@".$_SERVER['SERVER_NAME'].">". "\r\n";
    $headers .= "<br>X-Mailer: PHP \r\n";
	$message = "
<html>
<body>
<table width='100%'>
  <tr>
    <td>Dear James Davidson,</td>
  <tr/>
  <tr>
    <td> The following job has been completed, details are below. </td>
  </tr>
  <tr>
	<td>&nbsp;</td>
</tr>
  <tr>
    <td><lable><b>Patient Name:</b> </lable> <u>".$p_name."</u></td>
  </tr>
  <tr>
    <td><lable><b>Patient Date of Birth:</b> </lable> <u>".$dob."</u></td>
  <tr/>
  <tr>
    <td><lable><b>Refering Doctor's Name:</b> </lable> <u>".$ref_physician."</u></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
</tr>
  <tr>
    <td><label><b>Procedures</b></label></td>
  </tr>
  
  <tr>
  	<td>
		<table border='1' width='100%'>
			<tr>
				<td><b>Sr.</b></td>
				<td><b>Procedure</b></td>
				<td><b>CPT Code</b></td>
				<td><b>Authorization Number</b></td>
				<td><b>Expiration Date</b></td>
			</tr>".$bnm."
		</table>
	</td>
  </tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>Best Regards,</td>
</tr>
<tr>
	<td>BMC Online Support Team</td>
</tr>
</table>
</body>
</html>		";

$message = wordwrap($message, 70);
	
	if (mail('jamesclaytondavidson@gmail.com', 'Job(s) Completed', $message,$headers))
	{
		echo "I mailed it.";
	}


?>