<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Update')
{

	$a = "update tbl_user set
					fname='".addslashes($_REQUEST['fname'])."',
					lname='".addslashes($_REQUEST['lname'])."',
					email='".addslashes($_REQUEST['email'])."',
					state='".addslashes($_REQUEST['state'])."',
					zip='".addslashes($_REQUEST['zip'])."',
					status='".addslashes($_REQUEST['status'])."',
					multi_email='".addslashes($_REQUEST['multi_email'])."',
					password='".addslashes($_REQUEST['password'])."'
					where id=$_REQUEST[id]";

	mysql_query($a);
	if($_REQUEST['status'] == 'ACTIVE' ){
	
		$from = "generalmail@burksmedicalconsulting.com";
	$headers =  "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $from = "Burks Medical Consulting".' < '.$from.' >';
    $headers .= "From: $from \r\n";
    $headers .= "Reply-To: $from \r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= "Message-ID: <". time() .rand(1,1000). "@".$_SERVER['SERVER_NAME'].">". "\r\n";
    $headers .= "<br>X-Mailer: PHP \r\n";
	$to = addslashes($_REQUEST['email']);
	$subject = "Account Activation Alert";
	if($_REQUEST['r'] == "e"){
		$mssg = "Dear ".$_REQUEST['fname']." ".$_REQUEST['lname'].", <br><br> Your new BMC employee portal account has been activated. Please login to your employee portal using the following details. <br><br> Username: ".$_REQUEST['email']."<br><br>Password: ".$_REQUEST['password']."<br><br> Thanks<br>BMC Support Team.";	
	}
	else{
		
	$mssg = "Dear ".$_REQUEST['fname']." ".$_REQUEST['lname'].",<br><br> Your new BMC user portal account has been activated. Please login to your user portal using the email and password you used when creating your account.<br><br> Thanks<br>BMC Support Team.";
}	
	if(mail($to, $subject, $mssg, $headers)){
//	echo "sent";
	}
	else{
	//	echo "not sent";
	}


	}
	
	$message = 'User updated successfully.';
	
	if($_REQUEST['r'] == "e"){
	?>
	    <script>window.location = 'emp_listing.php?message=<?php echo $message?>&msg_type=success';</script>
		<?php }else{ ?>
    <script>window.location = 'user.php?message=<?php echo $message?>&msg_type=success';</script>
	<?php }
}

$query = mysql_query("select * from tbl_user where id='".$_REQUEST[id]."'");
$row = mysql_fetch_object($query);
?>

   <!-- Start Page Content  --> 
   
<div id="page-shade"></div>
<div class="breadcrumb" style=""></div>
 
<div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>User Management</h1>
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
       <?php if($message or isset($_REQUEST[message])) 
		{
			?>
			<div class="notification error" style="width:200px">
			<?php echo $message?><?php echo $_REQUEST[message]?>
			</div>
			<?php 
		} 
		?>
        <div class="container_12"> 
        
        <div class="grid_12">
          <div class="box-header"> 
          	Edit User
            <div style="float: right;"><a style="color:" <?php if($_REQUEST['r'] == "e"){ ?>href="emp_listing.php" <?php } else {?>href="user.php"<?php }?>>Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="content_id" value="<?php echo $_REQUEST[content_id]?>" />

    <table cellspacing="0" cellpadding="4" border="0" class="greyBorder">
    
    <tr >
        <td valign="top" >First Name</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="fname" value="<?php echo $row->fname?>"></td>
    </tr>
    <tr >
        <td valign="top">Last Name</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="lname" value="<?php echo $row->lname?>"></td>
    </tr>
        <tr >
        <td valign="top" >Email</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="email" value="<?php echo $row->email?>"></td>
    </tr>
    <tr >
        <td valign="top" >State</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="state" value="<?php echo $row->state?>"></td>
    </tr>
    <tr >
        <td valign="top" >Zip</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="zip" value="<?php echo $row->zip?>"></td>
    </tr>
    <tr >
        <td valign="top">Password</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="password" value="<?php echo $row->password?>"></td>
    </tr>
    <tr>
        <td valign="top">Email Addresses:</td>
        <?php $memail = mysql_fetch_array(mysql_query("SELECT multi_email from tbl_user where id = '".$_REQUEST['id']."'")); ?>
        <td valign="top"><textarea name="multi_email" style="width:300px;height:100px"><?php echo $memail['multi_email']; ?></textarea></td>
    	
    </tr>
    
		<tr>
		<td>Status</td>
		<td><select name="status"><option <?php if(stripslashes($row->status) == 'NOT_ACTIVE'){ ?> selected="selected" <?php } ?> value="NOT_ACTIVE">NOT ACTIVE</option><option value="ACTIVE"  <?php if(stripslashes($row->status) == 'ACTIVE'){ ?> selected="selected" <?php } ?> >ACTIVE</option><option value="SUSPENDED"  <?php if(stripslashes($row->status) == 'SUSPENDED'){ ?> selected="selected" <?php } ?> >SUSPEND</option></select></td>
	</tr>

   
    <tr class="oddRow">
        <td align="center"></td>
        <td valign="top" align="left">
        	<input type="submit" name="submit" value="Update" class="button">
        </td>
    </tr>
    
    </table>
    </form>

           
          </div>
        </div>
        
        
        </div>
      
        <br class="cl">
        <!-- End Formatting --> 
        <!-- Start Forms --><!-- Start Forms --> 
        <!-- Start Notifcations --><br class="cl">
        <!-- End Notifcations --> 
                <!-- Start Layout Example --><br class="cl">
        <!-- End Layout Example --> 
        
        <!-- End Grid --> 
      </div>
      <!-- End Page Wrapper --> 
    </div>
    
    
   <!-- End Page Content  --> 

<?php include("footer.php")?>