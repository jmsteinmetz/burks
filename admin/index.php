<?php
session_start();

include("header.php");

admin_login_check();
//	print_r($_SESSION);
include("col_left.php");

if(isset($_REQUEST[act]) and $_REQUEST[act]=='del')
{
//	mysql_query("delete from tbl_news where id=$_REQUEST[id]");
	$message = 'Record deleted successfully.';
	$msg_type='success';
}
?>
    <!-- Star Page Content  -->
    
     
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Welcome to Burks Medical Consulting Admin Panel</h1>
       
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      
      <!-- End Page Wrapper --> 
    </div>
    <!-- End Page Content  --> 
    
<?php include("footer.php"); ?>