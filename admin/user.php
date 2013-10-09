<?php
session_start();

include("header.php");
admin_login_check();
include("../includes/pagination.php"); 
include("col_left.php");

if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
	//mysql_query("delete from tbl_user where id='".$_REQUEST[id]."'");
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
          	User List 
            </div>
          <div class="box table" style="width:100%">
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td width="16%">Username</td>
				  <td width="16%">First Name</td>
				  <td width="16%">Last Name</td>
                  <td width="16%">Status</td>
				  <td width="16">User Type</td>
				  <td  width="16%">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
			 $srt_qry = "select * from tbl_user WHERE type = 'FRONT_END' order by email asc";

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
	

while($res = mysql_fetch_assoc($result))					   
{
 $row[] = $res;				 
}
				

				for($i=0;$i<$num_rows;$i++)
				{
					?>
                    <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">

                        <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row[$i]['email']?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row[$i]['fname']?></td>
						<td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php echo $row[$i]['lname']?></td>
						<td style="border:1px solid #9D9D9D;"><?php if($row[$i]['status'] == "NOT_ACTIVE"){ echo "NOT ACTIVE";} else if($row[$i]['status'] == "ACTIVE"){echo "ACTIVE";} else if($row[$i]['status'] == "SUSPENDED"){echo "SUSPENDED";}?></td>
						<td style="border:1px solid #9D9D9D;"><?php if($row[$i]['type'] == "FRONT_END"){echo "Client";} else if($row[$i]['type'] == "BACK_END"){echo "Employee";} ?></td>
                        <td style="border:1px solid #9D9D9D;">
                        	<a href="user_edit.php?id=<?php echo $row[$i]['id']?>" title="Edit User"><img src="./img/icons/small/page_edit.png" border="0" /></a> 
                           <a href="user.php?id=<?php echo $row[$i]['id']?>&act=del" title="Delete User" onClick="return confirm('Are you sure you want to delete this User?');"><img src="./img/icons/small/page_delete.png" border="0" /></a></td>

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