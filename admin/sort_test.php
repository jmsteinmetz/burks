<?php
session_start();

include("header.php");
admin_login_check();
include("../includes/pagination.php"); 
include("col_left.php");
if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	$msg_type='success';
}
?>
    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">JOB Management (Completed Jobs)</h1>
       
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
        <?php 
	   		if(isset($_REQUEST[message]) or $message) 
			{
				?>
				<div class="notification <?php echo $msg_type?><?php echo $_REQUEST[msg_type]?>" style="width:200px">
				<?php echo $message?><?php echo $_REQUEST[message]?>
				</div>
				<?php 
			} 
		?>
        
        <!-- Start Table -->
        <div class="grid_8" style="width:100%">
          <div class="box-header"> 
          	Jobs List 
            <br />
            <form name="frm_srt" action="" method="post">
            	<select name="srt_opt">
                <option <?php if($_REQUEST['srt_opt'] == 'rfa'){?> selected="selected" <?php }?> value="rfa">RFA</option>
                <option <?php if($_REQUEST['srt_opt'] == 'p_name'){?> selected="selected" <?php }?> value="p_name">Patient Name</option>
                <option <?php if($_REQUEST['srt_opt'] == 'facility'){?> selected="selected" <?php }?> value="facility">Facility</option>
                <option <?php if($_REQUEST['srt_opt'] == 'status'){?> selected="selected" <?php }?> value="status">Status</option>
                </select>
                <select name="srt_typ">
                	<option <?php if($_REQUEST['srt_typ'] == 'asc'){?> selected="selected" <?php }?> value="asc">Ascending</option>
                    <option <?php if($_REQUEST['srt_typ'] == 'desc'){?> selected="selected" <?php }?> value="desc">Descending</option>
                </select>
                <input type="submit" value="Sort" name="submit" style="cursor:pointer;" />
            </form>
              <div style="float:right"><a href="#"></a></div>
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
				  <td width="14%">RFA</td>
				  <td width="11%">Date of Service </td>
                  <td width="16%">Patient Name</td>
				  <td width="16%">Facility</td>				  
				  <td width="16%">Insurance</td>
				  <td width="16%">Procedures</td>
				  <td width="16%">Assigned To</td>

				  <td>Status</td>				  

                  <td width="9%">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
			  	if(isset($_REQUEST['submit']) && ($_REQUEST['submit'] == 'Sort')){
				$srt_qry = "select * from tbl_jobs where status = 'post' or status = 'assigned' order by ".$_REQUEST['srt_opt']." ".$_REQUEST['srt_typ'];	
				}
				else{
				$srt_qry = "select * from tbl_jobs where status = 'post' or status = 'assigned' order by id desc";
				}
//				$srt_qry = $srt_qry
				//echo $srt_qry;
$test = new MyPagina;
// create query
$test->sql = $srt_qry;
$result = $test->get_page_result(); // result set
$num_rows = $test->get_page_num_rows(); // number of records in result set 
$nav_links = $test->navigation(" | ", "currentStyle"); // the navigation links (define a CSS class selector for the current link)
$nav_info = $test->page_info("to"); // information about the number of records on page ("to" is the text between the number)
$simple_nav_links = $test->back_forward_link(false); // the navigation with only the back and forward links, use true to use images
$total_recs = $test->get_total_rows(); // the total number of records	
$showing = $test->page_info();
	
//$result = mysql_query($sql);
//$num_rows = mysql_num_rows($result);
while($res = mysql_fetch_assoc($result))					   
{
 $row[] = $res;					 
}
				
				$query = mysql_query($srt_qry);
				for($i=0;$i<$num_rows;$i++)
				//while($row = mysql_fetch_array($query))
				{
					$en = "SELECT * from tbl_user where id = '".$row[$i]['emp_id']."'";
					$en_e = mysql_query($en);
					$en_f = mysql_fetch_array($en_e);
					$en_name = $en_f['fname']." ".$en_f['lname'];
					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">
                        <td style="border:1px solid #9D9D9D;"><?php echo $row[$i]['rfa'];?></td>
						<?php 
							if($row[$i]['appt_month'] < 10){
								$mnth = "0".$row[$i]['appt_month'];
							}
							else{
								$mnth = $row[$i]['appt_month'];
							}
							
							if($row[$i]['appt_day'] < 10){
								$ddy = "0".$row[$i]['appt_day'];
							}
							else{
								$ddy = $row[$i]['appt_day'];
							}
						?>
						<td style="border:1px solid #9D9D9D;"><?php echo $mnth."-".$ddy."-".$row[$i]['appt_year'];?></td>
						
						<td style="border:1px solid #9D9D9D;"><?php echo $row[$i]['p_name'];?></td>
						<td style="border:1px solid #9D9D9D;"><?php echo $row[$i]['facility'];?></td>
                        <td style="border:1px solid #9D9D9D;"><?php echo $row[$i]['insurance_company'];?></td>
						 <td style="border:1px solid #9D9D9D;"><?php 
						 	$yu = "select * from tbl_procedure where jid = '".$row[$i]['id']."'";
						 $yu_qry = mysql_query($yu);
						 	while($yu_qry_f = mysql_fetch_array($yu_qry)){
						 echo $yu_qry_f['p_procedure']."<br>";
						 }?>
						 </td>
						<td style="border:1px solid #9D9D9D;"><?php echo $en_name;?></td>
						<td style="border:1px solid #9D9D9D;"><?php if($row[$i]['status'] == "post"){echo "Submitted";} else if($row[$i]['status'] == "assigned"){echo "Assigned";} else if($row[$i]['status'] == "complete"){echo "Completed";}?></td>
						<?php if($row[$i]['status'] == "post"){ ?>
                        <td style="border:1px solid #9D9D9D;">
                        	<a href="form_view.php?jid=<?php echo $row[$i]['id']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
							<a href="job_assign_emp.php?id=<?php echo $row[$i]['id']?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a>
							
							</td>
							<?php } if($row[$i]['status'] == "assigned"){ echo "<td style='border: 1px solid #9D9D9D;'>";?>
							
							<a href="form_view.php?jid=<?php echo $row[$i]['id']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
							<a href="job_assign_emp.php?id=<?php echo $row[$i]['id']?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a>

							<?php echo "</td>"; ?>

							
							<?php } if($row[$i]['status'] == "complete"){ echo "<td style='border: 1px solid #9D9D9D;'>";?>
							
							<a href="form_view.php?jid=<?php echo $row[$i]['id']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
							<a href="job_assign_emp.php?id=<?php echo $row[$i]['id']?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a>
							<?php echo "</td>"; 
							}
							?>
                    </tr>
                    <?php 
				}
				
				                if(!$num_rows){?>
                <tr>
                <td colspan="9" class="noRecordFound" align="center" valign="middle">
                  No Records Available
                  </td>
                </tr>
                <?php }?>
                  <tr>
                    <td align="center" colspan="9" class="mainText" ><?=$nav_links?></td>
                  </tr>
                  <tr>
                    <td align="center" colspan="9" class="mainText" ><?=$showing?></td>
                  </tr>

				
                                
              </tbody>
            </table>
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