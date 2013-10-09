<?php
session_start();

$_SESSION[super_admin] = "1";
include("header.php");
//admin_login_check();
include("col_left.php");

 
?>

<script>
function popUp(URL) {
//alert(URL);
day = new Date();
id = day.getTime();
var phy = document.frm_date.phy.value;
var usrid = document.frm_date.usrid.value;
var job_st = document.frm_date.job_st.value;
var fac = document.frm_date.fac.value;
var fdate1 = '20'+ document.frm_date.sy.value +'-'+ document.frm_date.sm.value +'-'+ document.frm_date.sd.value;
var fdate2 = '20'+ document.frm_date.ey.value +'-'+ document.frm_date.em.value +'-'+ document.frm_date.ed.value;
var URL = 'user_report_print.php?phy='+ phy +'&usrid='+ usrid +'&job_st='+ job_st +'&sdate='+ fdate1 +'&edate='+ fdate2 +'&fac='+ fac;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=550,height=600,left = 200,top = 200');");
}
function dd(){
	var sdd = document.getElementById('sd').value;
	var smm = document.getElementById('sm').value;
	var syy = document.getElementById('sy').value;
	var edd = document.getElementById('ed').value;
	var emm = document.getElementById('em').value;
	var eyy = document.getElementById('ey').value;
	alert("adsfa");
	var tmp = sdd+'-'+smm+'-'+syy;
	var tm = edd+'-'+emm+'-'+eyy;
	alert(tmp);
	
	document.getElementById('sdate').value = tmp;
	document.getElementById('edate').value = tm;
	return true;
	
	
}

</script>
          
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">User Reports</h1>
       
      </div>

      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
     
        <!-- Start Table -->
        <div class="grid_8" style="width:100%">
          <div class="box-header"> 
          				<a href="javascript:popUp('user_report_print.php?usrid=&sdate=--&phy=&edate=--&status=')">Print Report</a>
			            </div>
          <div class="box table" style="width:100%">
        <div style="width:950px; overflow:auto;">
        <table width="940" align="center" cellpadding="0" cellspacing="0" border="1">
        <tr>
        <td>
             <form name="frm_date" action="" method="post">
            <table width="940" align="center" cellpadding="0" cellspacing="0" border="1">
            	<tr>
                	<td>Provider:</td>
                    <td>Physician:</td>
                </tr>
                <tr>
                	<td><select name="usrid">
                  

<?php
				$query1 = mysql_query("select * from tbl_user WHERE type = 'FRONT_END' order by provider asc"); ?>
                <option value="">Select Provider</option>
                <?php
				while($row1 = mysql_fetch_array($query1))
				{?>
	
				  <option <?php if($_REQUEST['usrid'] == $row1['id']){?> selected="selected" <?php } ?> value="<?php echo $row1['id']; ?>"><?php echo $row1['provider'].", (".$row1['email'].")"; ?></option>
				  
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
                	<td>Start Date:</td>
                    <td>End Date:</td>
                </tr>
                <tr>
                	<td><select name="sm" id="sm">
							<?php for($i=1; $i<=12; $i++){?>
                    <option <?php if($_REQUEST['sm'] == $i){?> selected="selected" <?php }?> value="<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>">
                    <?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                    </option>
                    <?php }?>
						</select>
						<select name="sd" id="sd">
							<?php for($i=1; $i<=31; $i++){?>
							<option <?php if($_REQUEST['sd'] == $i){?> selected="selected" <?php }?> value="<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="sy" id="sy">
							<?php for($i=11; $i<=20; $i++){?>
							<option <?php if($_REQUEST['sy'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>">
							<?php echo "20".$i;?>
                            </option>
							<?php }?>
						</select></td>
                    <td><select name="em" id="em">
							<?php for($i=1; $i<=12; $i++){?>
							<option <?php if($_REQUEST['em'] == $i){?> selected="selected" <?php }?> value="<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="ed" id="ed">
							<?php for($i=1; $i<=31; $i++){?>
							<option <?php if($_REQUEST['ed'] == $i){?> selected="selected" <?php }?> value="<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="ey" id="ey">
							<?php for($i=11; $i<=20; $i++){?>
							<option <?php if($_REQUEST['ey'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php echo "20".$i;?></option>
							<?php }?>
						</select></td>
                </tr>
                
                <tr>
                	<td>Job Status:</td>
                    <td>Facilities:</td>
                </tr>
                
                <tr>
                	<td><select name="job_st">
							<option <?php if($_REQUEST['job_st'] == "none"){?> selected="selected" <?php }?> value="none">Select Status</option>
							<option <?php if($_REQUEST['job_st'] == "assigned"){?> selected="selected" <?php }?> value="assigned">Assigned</option>
							<option <?php if($_REQUEST['job_st'] == "complete"){?> selected="selected" <?php }?> value="complete">Completed</option>
							<option <?php if($_REQUEST['job_st'] == "post"){?> selected="selected" <?php }?> value="post">Submitted</option>
							<option <?php if($_REQUEST['job_st'] == "save"){?> selected="selected" <?php }?> value="save">Not Submitted</option>
							
						</select>
						<input type='text' name='moose' id='moose' value='<?php echo $_REQUEST['fac']; ?>' />
						</td>
                    <td><?php $rew1 = "SELECT DISTINCT(facility) FROM tbl_jobs where facility!='' order by facility";
						$fac = mysql_query($rew1);
			//echo $rew;
			?>
            <select name="fac" id="fac" style="width:100px;">
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
			<a href="testexport.php?moose=1">Export Query</a>
        </td>
        </tr>
        
        <tr>
        <td>
        	<table width="940" align="center" cellpadding="0" cellspacing="0" border="1">
            <tr class="box-header">
                  <td>Date of Appt</td>
				  <td>Status</td>
				  <td>Patient Name</td>
				  <td>Insurance</td>
                  <td>Date of Birth</td>
				  <td>CPT Code</td>
				  <td>Authorization #</td>
				  <td>Approved By</td>
                  <td>Facility</td>
				  <td>Expiration Date</td>
				  <td>Refer DR</td>
            </tr>
            
			<?php

			if(isset($_POST['submit'])){
				
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
				if($_REQUEST['sy'] != '')
				{
					$fdate1 = '20'.$_REQUEST['sy'].'-'.$_REQUEST['sm'].'-'.$_REQUEST['sd'];
					$fdate2 = '20'.$_REQUEST['ey'].'-'.$_REQUEST['em'].'-'.$_REQUEST['ed'];
					$rew.= " and appt_full_date BETWEEN '".$fdate1."' and '".$fdate2."'  ";
				}
					echo $rew;
					$query = mysql_query($rew);
					$no_of_records = mysql_num_rows ($query);
					echo "<BR />";
					echo $no_of_records;
					
				}
				else{
						
				}

				while($row = mysql_fetch_array($query))
				{	
					$rw = 	mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id = '".$_REQUEST['usrid']."'"));

?>
					
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">

                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
						<?php 
							if((int)$row['appt_month'] < 10){
								$mnth = "0".$row['appt_month'];
							}
							else{
								$mnth = $row['appt_month'];
							}
							
							if((int)$row['appt_day'] < 10){
								$ddy = "0".$row['appt_day'];
							}
							else{
								$ddy = $row['appt_day'];
							}
							echo $mnth."-".$ddy."-".$row['appt_year'];
						?>
						</td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo date('Y-m-d',$row['rfa']);?></td>
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

