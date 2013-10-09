<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	mysql_query("delete from tbl_content where content_id='".$_REQUEST[id]."'");
	$message = 'Page deleted successfully.';
	$msg_type='success';
}
?>

 

    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Site Pages Management</h1>
       
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
                  <td width="20%">Title</td>
                  <td width="9%">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
			  
				$query = mysql_query("select * from tbl_content");
				while($row = mysql_fetch_array($query))
				{
					?>
                    <tr onmouseover="this.bgColor='F5F1F1'" onmouseout="this.bgColor='ffffff'">

                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row['title']?></td>
                        <td style="border:1px solid #9D9D9D;">
                        	<a href="contents_edit.php?content_id=<?php echo $row['content_id']?>" title="Edit Content"><img src="./img/icons/small/page_edit.png" border="0" /></a> 
                           <a href="contents.php?id=<?php echo $row['content_id']?>&act=del" title="Delete Page" onclick="return confirm('Are you sure you want to delete this Page?');"><img src="./img/icons/small/page_delete.png" border="0" /></a></td>

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