<?php
	
	emp_login_check();
	$jl = "SELECT * FROM tbl_jobs where  emp_id = '".$_SESSION['emp_id']."'";
	$jl_e = mysql_query($jl);
	
?>
<div style="float:left; width:100%; text-align:right;"><a href="index.php?p=doc" style="color:#585D92; font-weight:bold; text-decoration:none;">Forms &nbsp;&nbsp;&nbsp;</a><a href="index.php?p=emp_job" style="color:#585D92; font-weight:bold; text-decoration:none;">Jobs &nbsp;&nbsp;&nbsp;</a><a href="index.php?p=emp_account" style="color:#585D92; font-weight:bold; text-decoration:none;">My Account &nbsp;&nbsp;&nbsp;</a><a href="index.php?p=ecp" style="color:#585D92; font-weight:bold; text-decoration:none;">Change Password &nbsp;&nbsp;&nbsp;</a><a href="index.php?p=logout" style="color:#585D92; font-weight:bold; text-decoration:none;">Logout</a></div>
<table style="width:100%;">
	<tr style=" font-weight:bold; font-size:14px; color:#585D92;">
		<td>Patient Name</td><td>SSN</td><td>Status</td><td>Action</td>
	</tr>
	<?php while($jl_f = mysql_fetch_array($jl_e)){ ?>
	<tr>
		<td><?php echo stripslashes($jl_f['p_name']); ?></td><td><?php echo stripslashes($jl_f['p_ssn']); ?></td><td style="text-transform:capitalize;"><?php echo stripslashes($jl_f['status']); ?></td><td><?php if(stripslashes($jl_f['status']) == "assigned"){?><a href="index.php?p=emp_job_edit&jid=<?php echo  $jl_f['id'];?>">Edit</a><?php }?></td>
	</tr>
	<?php } ?>
</table>