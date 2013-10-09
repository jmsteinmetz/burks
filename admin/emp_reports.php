<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");

?>

<script>
	function usr(uid){
		window.location = "emp_reports.php?usrid="+uid;
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
          	Site Pages List 
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              

              <thead>
                <tr>
                  <td width="16%">
				  <select onChange="usr(this.value)">
				  <option value="">Select Name</option>
<?php
				$query1 = mysql_query("select * from tbl_user WHERE type = 'BACK_END'");
				while($row1 = mysql_fetch_array($query1))
				{?>
	
				  <option value="<?php echo $row1['id']; ?>"><?php echo $row1['fname']." ".$row1['lname']; ?></option>
				  
				  <?php }?>
				  </select>
				  </td>
				  

				  <td colspan="5" >
					&nbsp;
				</td>
				  	
                </tr>
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
			if(isset($_REQUEST['usrid'])){
				//echo "agagag";
				//exit;
				$rew = "SELECT * FROM tbl_emp WHERE emp_id = '".$_REQUEST['usrid']."'";
				
				$query = mysql_query($rew);

			}
			  
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

                        <td style="text-transform:capitalize;"><?php echo $rw['email']?></td>
						<td style="text-transform:capitalize;"><?php echo $rw['fname']?></td>
						<td style="text-transform:capitalize;"><?php echo $rw['lname']?></td>
						<td><?php echo $row['time_in']; ?></td>
						<td><?php echo $row['time_out']; ?></td>
                        <td><?php printf("%d days, %d hours, %d minuts\n, %d seconds\n", $days, $hours, $minuts, $seconds); ?></td>

                    </tr>
                    <?php
				}
				?>
                                
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