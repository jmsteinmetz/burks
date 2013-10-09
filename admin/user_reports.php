<?php
session_start();
// AAravind (2013.08.09) : The line below basically allowed this page to be publicly viewable. Changed it to call admin_login_check() method - which is implemented in header.php. So we have to include this before calling the method
// $_SESSION[super_admin] = "1";
include("header.php");
admin_login_check();
include("col_left.php");

?>

<script>
function popUp(URL) {

day = new Date();
id = day.getTime();
var phy = document.frm_date.phy.value;
var usrid = document.frm_date.usrid.value;
var job_st = document.frm_date.job_st.value;
var fac = document.frm_date.fac.value;
var fdate1 = document.frm_date.appt_startdate.value;
var fdate2 = document.frm_date.appt_enddate.value;
var completed_startdate = document.frm_date.completed_startdate.value;
var completed_enddate = document.frm_date.completed_enddate.value;
var URL = 'user_report_print.php?phy='+ phy +'&usrid='+ usrid +'&job_st='+ job_st +'&sdate='+ fdate1 +'&edate='+ fdate2 +'&fac='+ fac + '&csdate=' + completed_startdate + '&cedate=' + completed_enddate;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600;left = 200,top = 200');");
}

</script>
 

<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Client Report</h1>
       
      </div>

      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
                
        <!-- Start Table -->
        <div class="grid_8" style="width:100%;min-width:500px;">
			<div class="box-header"> 
				<table width="100%">
				<tr>
				<td>
					<a href="javascript:popUp('user_report_print.php?usrid=&sdate=--&phy=&edate=--&status=')">Print Report</a>
				</td>
				<td style="horizontal-align:right">
					<a  href="
					<?php
						$href = "?";
						if($_REQUEST['usrid'] != ""){
							$href.= "usrid=".$_REQUEST['usrid'];
						}
						
						if($_REQUEST['job_st'] != 'none'){
							if ($href != "?")
							{
								$href.= "&";
							}
							$href.= "job_st=".$_REQUEST['job_st'];
						}
						
						if($_REQUEST['fac'] != '')
						{
							if ($href != "?")
							{
								$href.= "&";
							}
								$href.= "fac=".$_REQUEST['fac'];
						}
						
						if($_REQUEST['phy'] != '')
						{
							if ($href != "?")
							{
								$href.= "&";
							}
								$href.= "phy=".$_REQUEST['phy'];
						}
						
						if($_REQUEST['appt_startdate'] != '')
						{
							if ($href != "?")
							{
								$href.= "&";
							}
								$href.= "sdate=".$_REQUEST['appt_startdate'];
						}
						
						if($_REQUEST['appt_enddate'] != '')
						{
							if ($href != "?")
							{
								$href.= "&";
							}
								$href.= "edate=".$_REQUEST['appt_enddate'];
						}
			
						if($_REQUEST['completed_startdate'] != '')
						{
							if ($href != "?")
							{
								$href.= "&";
							}
								$href.= "csdate=".$_REQUEST['completed_startdate'];
						}
						
						if($_REQUEST['completed_enddate'] != '')
						{
							if ($href != "?")
							{
								$href.= "&";
							}
								$href.= "cedate=".$_REQUEST['completed_enddate'];
						}
				
						$href = "testexport.php" . $href;
						
						echo $href;
					
					?>
					" >Export Report</a>
				</td>
				</tr>
				</table>
			
          				
			</div>
						
          <div class="box table" style="width:100%">
        <div style="overflow:auto;">
        <table cellpadding="0" cellspacing="0" border="1">
        <tr>
        <td>
             <form name="frm_date" action="" method="post">
			 
			
			
            <table width="940" align="left" cellpadding="0" cellspacing="0" border="1">
            	<tr>
                	<td>Provider:</td>
                    <td>Physician:</td>
                </tr>
                <tr>
                	<td>
						<select name="usrid" style="width:400px">
                  
						<?php
						$query1 = mysql_query("select id, provider, email from tbl_user WHERE type = 'FRONT_END' and status = 'ACTIVE' order by email"); 
						?>
						
                <option value="">Select Provider</option>
                <?php
				while($row1 = mysql_fetch_array($query1))
                {?>
	
				  <option <?php if($_REQUEST['usrid'] == $row1['id']){?> selected="selected" <?php } ?> value="<?php echo $row1['id']; ?>"><?php echo $row1['email'].", (".$row1['provider'].")"; ?></option>
				  
				  <?php }?>
				  </select></td>
                    <td><select name="phy">
					<option <?php if($_REQUEST['phy'] == "none"){?> selected="selected" <?php } ?> value="none">Select Physican</option>
					<?php $iop = mysql_query("SELECT DISTINCT ref_physican FROM tbl_jobs ORDER BY ref_physican");
						while($iop_f = mysql_fetch_array($iop)){
						
					?>
					<option <?php if($_REQUEST['phy'] == $iop_f['ref_physican']){?> selected="selected" <?php } ?> value="<?php echo $iop_f['ref_physican'];?>"><?php echo $iop_f['ref_physican'];?></option>
					<?php }?>
					</select></td>
                </tr>
				<tr>
				<td>Appt Start Date:</td>
				<td>Appt End Date:</td>
				</tr>
				<tr>
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
				<td>Submitted Start Date:</td>
				<td>Submitted End Date:</td>
				</tr>
				<tr>
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
				<td>Completed Start Date:</td>
				<td>Completed End Date:</td>
				</tr>
                <tr>
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
		</td>
                </tr>
				
                <tr>
                	<td>Job Status:</td>
                    <td>Facility:</td>
                </tr>
                
                <tr>
                	<td>
						<select name="job_st">
							<option <?php if($_REQUEST['job_st'] == "none"){?> selected="selected" <?php }?> value="none">Select Status</option>
							<option <?php if($_REQUEST['job_st'] == "assigned"){?> selected="selected" <?php }?> value="assigned">Assigned</option>
							<option <?php if($_REQUEST['job_st'] == "complete"){?> selected="selected" <?php }?> value="complete">Completed</option>
							<option <?php if($_REQUEST['job_st'] == "post"){?> selected="selected" <?php }?> value="post">Submitted</option>
							<option <?php if($_REQUEST['job_st'] == "save"){?> selected="selected" <?php }?> value="save">Not Submitted</option>
						</select>
					</td>
                    <td>
					<?php 
						$rew1 = "SELECT DISTINCT(facility) FROM tbl_jobs where facility !='' order by facility";
						$fac = mysql_query($rew1);
					?>
            <select name="fac" id="fac" style="width:400px;">
            <option value="">Select Facility</option>
            <?php
				while($facil = mysql_fetch_array($fac))
				{
					?>
                    <option value="<?php echo $facil['facility']; ?>" <?php if($_REQUEST['fac']==$facil['facility']){ ?> selected="selected" <?php } ?>><?php echo $facil['facility']; ?></option>
                    <?php } ?>
                    </select></td>
                </tr>
                
                
                <tr>
                <td>&nbsp;</td>
                <td align="right"><input name="sdate" type="hidden" value="" />
						<input name="edate" type="hidden" value="" />
						
						<input type="hidden" name="frm_dat" value="123">
						
						<input type="submit" value="Search" name="submit"></td>
                </tr>
                
                
            </table>
            </form>
        </td>
        </tr>
        
        <tr>
        <td>
		
		<?php

			if(isset($_POST['submit'])){
							
			$rew = "SELECT job.*, DATE(FROM_UNIXTIME(job.rfa)) as submitted_datetime, usr.email as provider_email FROM tbl_jobs as job left outer join tbl_user as usr on (usr.id = job.fuid) WHERE 1=1 ";
				if($_REQUEST['usrid'] != ""){
					$rew.= "and job.fuid = '".$_REQUEST['usrid']."'";
				}
				if($_REQUEST['job_st'] != none){
					$rew.= " and job.status = '".$_REQUEST['job_st']."'";
				}
				if($_REQUEST['fac'] != '')
				{
					$rew.= " and job.facility = '".$_REQUEST['fac']."'";
					}
				if($_REQUEST['phy'] != none){
					$rew.= " and job.ref_physican = '".$_REQUEST['phy']."'";
				}
			
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
				else{
					

					
				}
			?>
			<BR>Total Results: <?php 
			$no_of_records = mysql_num_rows ($query);
			echo $no_of_records; ?>
			<BR />
        	<table  align="left" cellpadding="0" cellspacing="0" border="1">
			
            <tr class="box-header" style="font-size:8pt">
				<td>RFA</td>
                <td>Subm Date</td>
				<td>Appt Date</td>
				<td>Comp Date</td>
				<td>Status</td>
				  <td>Patient Name</td>
				  <td>Insurance</td>
                  <td>DOB</td>
				  <td>CPT Code</td>
				  <td>Auth #</td>
				  <td>Approved By</td>
                  <td>Facility</td>
				  <td>Expiration Date</td>
				  <td>Refer DR</td>
				  <td>Provider</td>
				  
            </tr>
             
			<?php
				while($row = mysql_fetch_array($query))
				{
					
					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['id'];?></td>
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

						<td style="text-transform:capitalize; border:1px solid #9D9D9D;" nowrap>
						
						
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
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['provider_email'];?></td>

                    </tr>
					<?php }?>
            </table>
        </td>
        </tr>
        </table>
		
		
        </div>
          </div>
        </div> 
        <!-- End Table --> 
        <!-- Start Formatting -->
        
        
        <br class="cl" />

        <!-- End Formatting --> 
        <!-- Start Forms --><!-- Start Forms --> 
        <!-- Start Notifcations --><br class="cl" />
        <!-- End Notifcations --> 
                <!-- Start Layout Example --><br class="cl" />
        <!-- End Layout Example --> 
        
        <!-- End Grid --> 
      </div>
      <!-- End Page Wrapper --> 
    </div>
    <!-- End Page Content  --> 
    
<?php include("footer.php"); ?>
