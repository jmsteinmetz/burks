<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	mysql_query("delete from emp_app where id='".$_REQUEST[id]."'");
	$message = 'Page deleted successfully.';
	$msg_type='success';
}
?>

 

    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Employment Request Management</h1>
       
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
          	Resume  
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td width="20%">Name</td>
                  <td width="9%">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
			  
				$query = mysql_query("select * from emp_app");
				while($row = mysql_fetch_array($query))
				{
					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">

                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['app_name']?></td>
                        <td style=" border:1px solid #9D9D9D;">
						<a href="../images/emp_app_form.php?emp_frm_id=<?php echo $row['id']?>" title="View Resume"><img src="./img/icons/small/page.png" border="0" /></a>
                           <a href="resume.php?id=<?php echo $row['id']?>&act=del" title="Delete Resume" onClick="return confirm('Are you sure you want to delete this Resume?');"><img src="./img/icons/small/page_delete.png" border="0" /></a></td>

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