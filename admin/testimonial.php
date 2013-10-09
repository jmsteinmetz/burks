<?php
session_start();

include("header.php");
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	mysql_query("delete from tbl_testimonials where t_id='".$_REQUEST['id']."'");
	$message = 'Record deleted successfully.';
	$msg_type='success';
}
?>
    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Testimonials Management</h1>
       
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
          	Testimonial's List 
              <div style="float:right"><a href="testimonial_add.php">Add Testimonial</a></div>
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td width="10%">Title</td>
				  <td width="40%">Testimonial</td>				  
                  <td width="10%">Date Created</td>
                  <td width="9%">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
			  	$q = "select * from tbl_testimonials order by date_created desc";
				$query = mysql_query($q);
				
				while($row = mysql_fetch_array($query))
				{
/*					print_r($row);
					exit;
*/					?>
                    <tr onmouseover="this.bgColor='F5F1F1'" onmouseout="this.bgColor='ffffff'">
                        <td style="border:1px solid #9D9D9D;"><?php echo substr($row['title'], 0, 100);?></td>
                        <td style="border:1px solid #9D9D9D;"><?php echo substr($row['testimonial'], 0, 100);?></td>
						<td style="border:1px solid #9D9D9D;"><?php echo  date("Y-m-d H:i A",strtotime($row['date_created']))?></td>
                        <td style="border:1px solid #9D9D9D;">
                        	<a href="testimonial_edit.php?id=<?php echo $row[t_id]?>" title="Edit "><img src="./img/icons/small/page_edit.png" border="0" /></a> 
                            <a href="testimonial.php?id=<?php echo $row[t_id]?>&act=del" title="Delete " onclick="return confirm('Are you sure you want to delete this testimonial?');"><img src="./img/icons/small/page_delete.png" border="0" /></a></td>
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