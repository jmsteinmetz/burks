<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");

$query = null;

?>
 
<div id="page-content"> 
	
	<div id="page-header">
		<h1 style="width:500px">Employee Work Report</h1>
	</div>
      
	<div class="container_12"> 
        
		<?php    
		if(isset($_REQUEST[message]) or $message) 
		{
		?>
			<div class="notification <?php echo $_REQUEST[msg_type]?>" style="width:200px">
			<?php echo $_REQUEST[message]?>
			</div>
		<?php 
		} 
	
		if(isset($_REQUEST))
		{
            $ispostbackcheck = $_REQUEST['postbackcheck'];
			
			if ($ispostbackcheck == "true")
			{
						
				$rew = "SELECT DATE(FROM_UNIXTIME(job.rfa)) as submitted_datetime, job.* FROM tbl_jobs as job WHERE emp_id = '".$_REQUEST['usrid']."'";
					
				$sub_startdate = $_REQUEST['sub_startdate'];
				$sub_enddate = $_REQUEST['sub_enddate'];	
				if ($sub_startdate == '')
				{
					if ($sub_enddate != '')
					{
					$rew.=" and DATE(FROM_UNIXTIME(job.rfa)) <= '" .date('Y-m-d', strtotime($sub_enddate)) . "'";
					}
				}
				else
				{
					if ($sub_enddate == '')
					{
					$rew.=" and DATE(FROM_UNIXTIME(job.rfa)) >= '" .date('Y-m-d', strtotime($sub_startdate)) . "'";
					}
					else
					{
					$rew.=" and DATE(FROM_UNIXTIME(job.rfa)) BETWEEN '" .date('Y-m-d', strtotime($sub_startdate)) . "' and '" . date('Y-m-d', strtotime($sub_enddate)) . "'";
					}
				}
				
				$appt_startdate = $_REQUEST['appt_startdate'];
				$appt_enddate = $_REQUEST['appt_enddate'];
				if ($appt_startdate == '')
				{
					if ($appt_enddate != '')
					{
					$rew.=" and job.appt_full_date <= '" .date('Y-m-d', strtotime($appt_enddate)) . "'";
					}
				}
				else
				{
					if ($appt_enddate == '')
					{
					$rew.=" and job.appt_full_date >= '" .date('Y-m-d', strtotime($appt_startdate)) . "'";
					}
					else
					{
					$rew.=" and job.appt_full_date BETWEEN '" .date('Y-m-d', strtotime($appt_startdate)) . "' and '" . date('Y-m-d', strtotime($appt_enddate)) . "'";
					}
				}
					
				$completed_startdate = $_REQUEST['completed_startdate'];
				$completed_enddate = $_REQUEST['completed_enddate'];
				if ($completed_startdate == '')
				{
					if ($completed_enddate != '')
					{
					$rew.=" and job.completed_datetime <= '" .date('Y-m-d', strtotime($completed_enddate)) . "'";
					}
				}
				else
				{
					if ($completed_enddate == '')
					{
					$rew.=" and job.completed_datetime >= '" .date('Y-m-d', strtotime($completed_startdate)) . "'";
					}
					else
					{
					$rew.=" and job.completed_datetime BETWEEN '" .date('Y-m-d', strtotime($completed_startdate)) . "' and '" . date('Y-m-d', strtotime($completed_enddate)) . "'";
					}
				}
				
				$query = mysql_query($rew);
			}	
		}
		?>

		<div class="grid_8" style="width:100%">
			<div class="box table" style="width:100%">
		
				<form method="post">
				<input type="hidden" name="postbackcheck" value="true">
					<table>
					<tr>
						<td>
							<select name="usrid">

							<?php
							$query1 = mysql_query("select * from tbl_user WHERE type = 'BACK_END' ORDER BY fname");
							while($row1 = mysql_fetch_array($query1))
							{?>
			
								<option <?php if($_REQUEST['usrid'] == $row1['id']){?> selected="selected" <?php }?> value="<?php echo $row1['id']; ?>"><?php echo $row1['fname']." ".$row1['lname']; ?></option>

							<?php }?>
							</select>
						</td>
						<td>Submitted Start Date:</td>
						<td>
							<script>
							$(function() {
								$( "#sub_startdate" ).datepicker({
									changeMonth: true,
									changeYear: true,
									showButtonPanel: true
								});
							});
							</script>
							<input id="sub_startdate" name="sub_startdate" type="text" value="<?php echo $_REQUEST['sub_startdate']; ?>">	
						</td>
						<td>Submitted End Date:</td>
						<td>
							<script>
							$(function() {
								$( "#sub_enddate" ).datepicker({
									changeMonth: true,
									changeYear: true,
									showButtonPanel: true
								});
							});
							</script>
							<input id="sub_enddate" name="sub_enddate" type="text" value="<?php echo $_REQUEST['sub_enddate']; ?>">	
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Appt Start Date:</td>
						<td>
							<script>
							$(function() {
								$( "#appt_startdate" ).datepicker({
									changeMonth: true,
									changeYear: true,
									showButtonPanel: true
								});
							});
							</script>
							<input id="appt_startdate" name="appt_startdate" type="text" value="<?php echo $_REQUEST['appt_startdate']; ?>">	
						</td>
						<td>Appt End Date:</td>
						<td>
							<script>
							$(function() {
								$( "#appt_enddate" ).datepicker({
									changeMonth: true,
									changeYear: true,
									showButtonPanel: true
								});
							});
							</script>
							<input id="appt_enddate" name="appt_enddate" type="text" value="<?php echo $_REQUEST['appt_enddate']; ?>">	
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Completed Start Date:</td>
						<td>
							<script>
							$(function() {
								$( "#completed_startdate" ).datepicker({
									changeMonth: true,
									changeYear: true,
									showButtonPanel: true
								});
							});
							</script>
							<input id="completed_startdate" name="completed_startdate" type="text" value="<?php echo $_REQUEST['completed_startdate']; ?>">
						</td>
						<td>Completed End Date:</td>
						<td>
							<script>
							$(function() {
								$( "#completed_enddate" ).datepicker({
									changeMonth: true,
									changeYear: true,
									showButtonPanel: true
								});
							});
							</script>
							<input id="completed_enddate" name="completed_enddate" type="text" value="<?php echo $_REQUEST['completed_enddate']; ?>">
							&nbsp;&nbsp;<input type="submit" value="Submit" name="submit">	
						</td>
					</tr>
					</table>
				</form>
		
				<div style="margin:5px">
				<BR>Total Results: <?php 
				$no_of_records = mysql_num_rows ($query);
				echo $no_of_records; ?>
				</div>

				<table align="left" width="100%">
				<thead>
				<tr>
					<td style="border-left:1px solid #9D9D9D;">RFA</td>
					<td>Subm Date</td>
					<td>Appt Date</td>
					<td>Comp Date</td>
					<td>Patient Name</td>
					<td>Facility</td>				  
					<td>Insurance</td>
					<td>Procedures</td>
					<td>Status</td>				  
					<td style="border-right:1px solid #9D9D9D;">Action</td>
				</tr>
				</thead>

				<tbody>
					  
				<?php

				   
					while($row = mysql_fetch_array($query))
					{
					  ?>
								<tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">
								<td style="border:1px solid #9D9D9D;width:10px"><?php echo $row['id'] ?></td>
								<td style="border:1px solid #9D9D9D;" nowrap>
								<?php 
									$submitted_datetime = $row['submitted_datetime'];
									if (is_null($submitted_datetime))
									{
										echo "--";
									}
									else
									{
										echo date('m-d-Y', strtotime($submitted_datetime));
									}
								?>
								</td>
								<td style="border:1px solid #9D9D9D;" nowrap><?php 
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
								<td style="border:1px solid #9D9D9D;"><?php echo $row['p_name'];?></td>
								<td style="border:1px solid #9D9D9D;"><?php echo $row['facility'];?></td>
								<td style="border:1px solid #9D9D9D;"><?php echo $row['insurance_company'];?></td>
								 <td style="border:1px solid #9D9D9D;"><?php 
								 $yu = "select * from tbl_procedure where jid = '".$row['id']."'";
								 $yu_qry = mysql_query($yu);
								 while($yu_qry_f = mysql_fetch_array($yu_qry)){
									echo $yu_qry_f['p_procedure']."<br>";
								 }?>
		</td>

								<td style="border:1px solid #9D9D9D;"><?php if($row['status'] == "post"){echo "Submitted";} else if($row['status'] == "assigned"){echo "Assigned";} else if($row['status'] == "complete"){echo "Completed";}?></td>
								<?php if($row['status'] == "post"){ ?>
			<td style="border:1px solid #9D9D9D;">
									<a href="form_view.php?jid=<?php echo $row['id']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
									<a href="job_assign_emp.php?id=<?php echo $row['id']?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a>
									<a href="job_assign.php?id=<?php echo $row['id']?>&act=del" title="Delete Job" onClick="return confirm('Are you sure you want to delete this Job?');"><img src="./img/icons/small/page_delete.png" border="0" /></a>
									</td>
									<?php } if($row['status'] == "assigned"){ echo "<td style='border: 1px solid #9D9D9D;'>";?>

									<a href="form_view.php?jid=<?php echo $row['id']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
									<a href="job_assign_emp.php?id=<?php echo $row['id']?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a>
									<a href="job_assign.php?id=<?php echo $row['id']?>&act=del" title="Delete Job" onClick="return confirm('Are you sure you want to delete this Job?');"><img src="./img/icons/small/page_delete.png" border="0" /></a>

									<?php echo "</td>"; ?>


									<?php } if($row['status'] == "complete"){ echo "<td style='border: 1px solid #9D9D9D;'>";?>

									<a href="form_view.php?jid=<?php echo $row['id']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
									<a href="job_assign_emp.php?id=<?php echo $row['id']?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a>
									<?php echo "</td>"; 
								}
								?>
		</tr>
							<?php
						   }

						   ?>

										
				</tbody>
				</table>
			</div>
        </div> 
		<br class="cl" />
        <br class="cl" />
        <br class="cl" />
	</div>
</div>
    
<?php include("footer.php"); ?>