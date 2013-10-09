<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	//mysql_query("delete from tbl_admin where admin_id='".$_REQUEST[aid]."'");
	//$message = 'User deleted successfully.';
	//$msg_type='success';
}
?>

 

    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Site User Management</h1>
       
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
        <?php 
	   		if(isset($_REQUEST[message]) or $message) 
			{
				?>
				<div class="notification <?php echo $_REQUEST[msg_type]; echo $msg_type;?>" style="width:200px">
				<?php echo $_REQUEST[message]; echo $message;?>
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
                  <td width="25%">Username</td>
				  <td width="25%">Email</td>
				  <td width="25%">Status</td>
                  <td width="25%">Roll(s)</td>
				  <td  width="25%">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
			  
				$query = mysql_query("select * from tbl_admin");
				while($row = mysql_fetch_array($query))
				{
					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">

                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['username']?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['email']?></td>
						<td style="border:1px solid #9D9D9D; border:1px solid #9D9D9D;"><?php if($row['status'] == "0"){ echo "NOT ACTIVE";} else if($row['status'] == "1"){echo "ACTIVE";}?></td>
						<td style="border:1px solid #9D9D9D; border:1px solid #9D9D9D;"><?php if($row['content_manager'] == "1"){echo "Content Manager <br>";}  if($row['job_manager'] == "1"){echo "Job Manager<br>";} if($row['user_manager'] == "1"){echo "User Manager<br>";} if($row['super_admin'] == "1"){echo "Super Administrator<br>";} ?></td>
                        <td style="border:1px solid #9D9D9D;">
                        	<a href="admin_add.php?aid=<?php echo $row['admin_id']?>" title="Edit User"><img src="./img/icons/small/page_edit.png" border="0" /></a> 
                           <a href="admin.php?aid=<?php echo $row['admin_id']?>&act=del" title="Delete User" onClick="return confirm('Are you sure you want to delete this User?');"><img src="./img/icons/small/page_delete.png" border="0" /></a></td>

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