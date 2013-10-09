<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");
	$sddd = $_REQUEST['sy']."-".$_REQUEST['sm'].'-'.$_REQUEST['sd'];
				$eddd = $_REQUEST['ey']."-".$_REQUEST['em'].'-'.$_REQUEST['ed'];
?>
<script>
function popUp(URL) {
//alert(URL);
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,width=550,height=600,left = 200,top = 200');");
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
 

    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Employee Reports</h1>
       
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
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
		?>
        
        <!-- Start Table -->
        <div class="grid_8" style="width:100%">
          <div class="box-header"> 
          	<?php if(isset($_REQUEST)){?>
			<a href="javascript:popUp('employee_report_print.php?usrid=<?php echo $_REQUEST['usrid'];?>&sdate=<?php echo $sddd;?>&edate=<?php echo $eddd;?>')">Print Report</a>
			<?php }?>
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              

              <thead>
			  <form name="frm_date" action="" method="post">
                <tr>
                  <td width="16%">
				  <select name="usrid">

<?php
				$query1 = mysql_query("select * from tbl_user WHERE type = 'BACK_END'");
				while($row1 = mysql_fetch_array($query1))
				{?>
	
				  <option <?php if($_REQUEST['usrid'] == $row1['id']){?> selected="selected" <?php }?> value="<?php echo $row1['id']; ?>"><?php echo $row1['fname']." ".$row1['lname']; ?></option>
				  
				  <?php }?>
				  </select>
				  </td>
				  

				  <td colspan="2" >
				  	
				  		<label>Start Date: </label>
						<select name="sm" id="sm">
							<?php for($i=1; $i<=12; $i++){?>
							<option <?php if($_REQUEST['sm'] == $i){?> selected="selected" <?php }?>  value="<?php echo $i;?>"><?php if($i < 10){echo "0".$i;} else{ echo $i;}?></option>
							<?php }?>
						</select>
						<select name="sd" id="sd">
							<?php for($i=1; $i<=31; $i++){?>
							<option <?php if($_REQUEST['sd'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php if($i < 10){echo "0".$i;} else{ echo $i;}?></option>
							<?php }?>
						</select>
						<select name="sy" id="sy">
							<?php for($i=11; $i<=20; $i++){?>
							<option <?php if($_REQUEST['sy'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php echo "20".$i;?></option>
							<?php }?>
						</select>

					</td>
					<td colspan="3">
						<label>End Date:  </label>
						<select name="em" id="em">
							<?php for($i=1; $i<=12; $i++){?>
							<option <?php if($_REQUEST['em'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php if($i < 10){echo "0".$i;} else{ echo $i;}?></option>
							<?php }?>
						</select>
						<select name="ed" id="ed">
							<?php for($i=1; $i<=31; $i++){?>
							<option <?php if($_REQUEST['ed'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>">
							<?php if($i < 10){echo "0".$i;} else{ echo $i;}?></option>
							<?php }?>
						</select>
						<select name="ey" id="ey">
							<?php for($i=11; $i<=20; $i++){?>
							<option <?php if($_REQUEST['ey'] == $i){?> selected="selected" <?php }?> value="<?php echo $i;?>"><?php echo "20".$i;?></option>
							<?php }?>
						</select>
						
						<input name="sdate" type="hidden" value="" />
						<input name="edate" type="hidden" value="" />
						
						<input type="hidden" name="frm_dat" value="123">
						
						<input type="submit" value="Submit" name="submit">

				</td>
				  	
                </tr>
				</form>
              </thead>
			  <thead>
                <tr>
                  <td width="16%">Username</td>
				  <td width="16%">First Name</td>
				  <td width="16%">Last Name</td>
                  <td width="16%">Start time</td>
				  <td width="16">End Time</td>
				  <td  width="16%">Total Time</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
/*			  echo '<pre>';
			  print_r($_REQUEST);
			  echo '</pre>';
*/			if(isset($_REQUEST)){
				
/*			  echo '<pre>';
			  print_r($_REQUEST);
			  echo '</pre>';
*/			
			$rew = "SELECT * FROM tbl_emp WHERE emp_id = '".$_REQUEST['usrid']."' and time_in BETWEEN '".$sddd."' and '".$eddd."'";
				
				$query = mysql_query($rew);

			}
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
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">

                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $rw['email']?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $rw['fname']?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $rw['lname']?></td>
						<td style="border:1px solid #9D9D9D;"><?php echo $row['time_in']; ?></td>
						<td style="border:1px solid #9D9D9D;"><?php echo $row['time_out']; ?></td>
                        <td style="border:1px solid #9D9D9D;"><?php printf("%d days, %d hours, %d minutes\n, %d seconds\n", $days, $hours, $minuts, $seconds); ?></td>
							
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
				 	<td align="right" colspan="6" style="border:1px solid #9D9D9D;">
						<label style="text-align:right;"><?php echo "Grand Total:   ".$total_hours." hours ". $total_min." minutes ";?></label>
					</td>
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