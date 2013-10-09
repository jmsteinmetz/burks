<?php
session_start();
$_SESSION[super_admin] = "1";
include("header.php");
include("col_left.php");

$user = $_REQUEST['user'];
$completed_startdate = $_REQUEST['csdate'];
$completed_enddate = $_REQUEST['cedate'];
$rfas = $_REQUEST['rfas'];
$uid = $_REQUEST['uid'];

?>

<script>
function popUp(URL) {

day = new Date();
id = day.getTime();

var url = unescape(window.location);
var test = url.substr(url.indexOf("?"),url.length);

var phy = '';
var job_st = 'complete';
var fac = '';
var fdate1 = '';
var fdate2 = '';
var completed_startdate = test.substr(test.indexOf("csdate=")+7,10);
var completed_enddate = test.substr(test.indexOf("cedate=")+7,10);
var usrid = test.substr(test.length-3,3);

var URL = 'end_of_month_print_single.php?phy='+ phy +'&usrid='+ usrid +'&job_st='+ job_st +'&sdate='+ fdate1 +'&edate='+ fdate2 +'&fac='+ fac + '&csdate=' + completed_startdate + '&cedate=' + completed_enddate;;

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600;left = 200,top = 200');");
}

</script>
 

<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">End of Month Client Report</h1>
       
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
					<a href="javascript:popUp('end_of_month_print_single.php?usrid=&sdate=--&phy=&edate=--&status=')">Print</a>
				</td>
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
					" >Export</a>
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
                	<td>Provider: <?php echo ' '.$user;?></td>
                </tr>
                <tr>
                			
                </tr>
				
               <tr>
				<td>Completed Start Date: <?php echo ' '.$completed_startdate;?></td>
                </tr>
                <tr>
                	

				<td>Completed End Date: <?php echo ' '.$completed_enddate;?></td>
		</tr>
                <tr>
                	
				
                
                	<td>Job Status: <?php echo ' completed';?></td>
                    
                </tr>
                
                              
                
                <tr>
                <td>&nbsp;</td>
                <td align="right"><input name="sdate" type="hidden" value="" />
						<input name="edate" type="hidden" value="" />
						
						<input type="hidden" name="frm_dat" value="123">
						
	                </tr>
                
                
            </table>
            </form>
        </td>
        </tr>
        
        <tr>
        <td>
		
		<?php

			
							
			$rew = "SELECT job.* FROM tbl_jobs as job WHERE ";

				$rew.= " job.fuid = '".$uid."'";
				
				$rew.= " and job.status = 'complete'";
				
				$rew.=" and job.completed_datetime >= '" .$completed_startdate. "' and job.completed_datetime < date_add('" .$completed_enddate. "',interval 1 day)";

                                /*$rew.=" order by usr.email,usr.id";*/
				
                                $query = mysql_query($rew);
					
				
			?>
			<BR>Total Results: <?php echo $rfas; ?>
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