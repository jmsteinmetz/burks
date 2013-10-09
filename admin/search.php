<?php
session_start();

include("header.php");
admin_login_check();
include("../includes/pagination.php"); 
include("col_left.php");
if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	mysql_query("delete from tbl_new where id='".$_REQUEST[id]."'");
	$message = 'Record deleted successfully.';
	$msg_type='success';
}
?>
    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">JOB Management</h1>
       
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
            <table>
            <tr>
	            <td>
                <label>Submit Start Date</label>
                </td>
                <td>
   						<select name="sm" id="em">
							<?php for($i=1; $i<=12; $i++){?>
							<option <?php if($_REQUEST['sm'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="sd" id="ed">
							<?php for($i=1; $i<=31; $i++){?>
							<option <?php if($_REQUEST['sd'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="sy" id="ey">
							<?php for($i=11; $i<=20; $i++){?>
							<option <?php if($_REQUEST['sy'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php echo "20".$i;?></option>
							<?php }?>
						</select>
                 </td>
             </tr>
             <tr>
             	<td>
					<label>Submit End Date</label>
            	</td>
		
        		<td>
                		<select name="em" id="em">
							<?php for($i=1; $i<=12; $i++){?>
							<option <?php if($_REQUEST['em'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="ed" id="ed">
							<?php for($i=1; $i<=31; $i++){?>
							<option <?php if($_REQUEST['ed'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?>
                            </option>
							<?php }?>
						</select>
						<select name="ey" id="ey">
							<?php for($i=11; $i<=20; $i++){?>
							<option <?php if($_REQUEST['ey'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php echo "20".$i;?></option>
							<?php }?>
						</select>
                  </td>
              </tr>
              <tr>
				<td> 
                     <label>RFA</label>
                </td>
                <td>
                        <input type="text" value="<?php echo $_REQUEST['rfa_val']?>" name="rfa_val">
                </td>
               </tr>
               <tr>
               	<td colspan="2">
                       <input type="submit" value="Search" name="submit">
                </td>
				</tr>
            </table>
            </form>
              <div style="float:right"><a href="#"></a></div>
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
				  <td width="14%">RFA <br />Submitted Date/Time</td>
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
	$sddd = $_REQUEST['sy']."-".$_REQUEST['sm'].'-'.$_REQUEST['sd'];
				$eddd = $_REQUEST['ey']."-".$_REQUEST['em'].'-'.$_REQUEST['ed'];
		
			 // print_r($_REQUEST);
			  	if(isset($_REQUEST['submit']) && ($_REQUEST['submit'] == 'Search')){
				$srt_qry = "select * from tbl_jobs where rfa BETWEEN '".strtotime($sddd)."' and '".strtotime($eddd)."' order by id desc";	
				}
			  	if(isset($_REQUEST['submit']) && ($_REQUEST['rfa_val'] != '')){
				$srt_qry = "select * from tbl_jobs where id = '".$_REQUEST['rfa_val']."'";	
				}
				
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
				for($i=0;$i<$num_rows;$i++){
				
					$en = "SELECT * from tbl_user where id = '".$row[$i]['emp_id']."'";
					$en_e = mysql_query($en);
					$en_f = mysql_fetch_array($en_e);
					$en_name = $en_f['fname']." ".$en_f['lname'];
					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">
                        <td style="border:1px solid #9D9D9D;"><?php echo $row[$i]['id'];?><br /><?php echo date("m-d-Y H:m:i",$row[$i]['rfa']);?></td>
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

							if($row[$i]['appt_hrs'] < 10){
								$hhrs = "0".$row[$i]['appt_hrs'];
							}
							else{
								$hhrs = $row[$i]['appt_hrs'];
							}
							
							if($row[$i]['appt_min'] < 10){
								$mmin = "0".$row[$i]['appt_min'];
							}
							else{
								$mmin = $row[$i]['appt_min'];
							}

						?>
						<td style="border:1px solid #9D9D9D;"><?php echo $mnth."-".$ddy."-".$row[$i]['appt_year']." ".$hhrs."hrs : ".$mmin."min";?></td>
						
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