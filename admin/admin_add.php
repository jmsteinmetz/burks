<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");
if(isset($_REQUEST['aid']) && ($_REQUEST['aid']!='')){
$_q = mysql_fetch_array(mysql_query("SELECT * FROM tbl_admin where admin_id = '".$_REQUEST['aid']."'"));
}

?>
<script>
function uv(){
	var em = document.getElementById("username").value;
	//alert(em);
	
	$.post("admin_validate.php", { ce: em },
   function(data) {
     alt(data);
   });
   
   function alt(d){
   	if(d == "0"){
		//alert("not available");
		document.getElementById("e").innerHTML = 'Not Available';
		document.getElementById("username").focus();
	}
	if(d == "1"){
		document.getElementById("e").innerHTML = 'Available';
		}
   }
   }
</script>
<?php

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Submit')
{
/*	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";
*/	
if(isset($_REQUEST['aid']) && ($_REQUEST['aid'] != "")){
	$a = "UPDATE tbl_admin set
					username='".addslashes($_REQUEST['username'])."',
					password='".addslashes($_REQUEST['password'])."',
					email='".addslashes($_REQUEST['email'])."',
					content_manager='".addslashes($_REQUEST['cm'])."',
					job_manager='".addslashes($_REQUEST['jm'])."',
					user_manager='".addslashes($_REQUEST['um'])."',
					super_admin='".addslashes($_REQUEST['sa'])."',
					status='".addslashes($_REQUEST['status'])."'
					where admin_id = '".$_REQUEST['aid']."'";
} else{

	$a = "INSERT INTO tbl_admin set
					username='".addslashes($_REQUEST['username'])."',
					password='".addslashes($_REQUEST['password'])."',
					email='".addslashes($_REQUEST['email'])."',
					content_manager='".addslashes($_REQUEST['cm'])."',
					job_manager='".addslashes($_REQUEST['jm'])."',
					user_manager='".addslashes($_REQUEST['um'])."',
					super_admin='".addslashes($_REQUEST['sa'])."',
					status='".addslashes($_REQUEST['status'])."'";
					}

	mysql_query($a);
	$message = 'Admin added successfully.';
	
	?>
    <script>window.location = 'admin.php?message=<?php echo $message?>&msg_type=success';</script>
	<?php
}
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
			<?php echo  $message?><?php echo $_REQUEST[message]?>
			</div>
			<?php 
		} 
		?>
        <div class="container_12"> 
        
        <div class="grid_12">
          <div class="box-header"> 
          	New User
            <div style="float: right;"><a style="color:" href="admin.php">Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">

    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="left" colspan="2" ><!--<span class="warning">*</span>  Required Fields--></td>
   </tr>
    
    <tr >
        <td valign="top" align="right" width="20%">Username</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" onfocus="uv()" onblur="uv()" id="username" name="username" value="<?php echo $_q['username']; ?>"><div id="e" style="color:#FF0000;"></div></td>
    </tr>
    <tr >
        <td valign="top" align="right" width="20%">Password</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="password" value="<?php echo $_q['password']; ?>"></td>
    </tr>
        <tr >
        <td valign="top" align="right" width="20%">Email</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" id="email" name="email" value="<?php echo $_q['email']; ?>"></td>
    </tr>
    
	<tr>
		<td>User Type</td>
		<td>
				<table>
					<tr>
						<td>Content Manager</td>
						<td><label>Yes </label><input type="radio" name="cm" <?php if($_q['content_manager'] == 1){?> checked="checked" <?php }?> value="1">&nbsp;<label>No</label> <input type="radio" name="cm" <?php if($_q['content_manager'] == 0){?> checked="checked" <?php }?> value="0"  <?php if(!isset($_REQUEST['aid'])){?>checked="checked"<?php }?> ></td>
					</tr>
					<tr>
						<td>Job Manager</td>
						<td><label>Yes </label> <input type="radio" <?php if($_q['job_manager'] == 1){?> checked="checked" <?php }?> name="jm" value="1">&nbsp;<label>No</label> <input type="radio" name="jm" <?php if($_q['job_manager'] == 0){?> checked="checked" <?php }?> value="0" <?php if(!isset($_REQUEST['aid'])){?>checked="checked"<?php }?>></td>
					</tr>
					<tr>
						<td>User Manager</td>
						<td><label>Yes </label> <input type="radio" name="um"  <?php if($_q['user_manager'] == 1){?> checked="checked" <?php }?> value="1">&nbsp;<label>No</label> <input type="radio" name="um" <?php if($_q['user_manager'] == 0){?> checked="checked" <?php }?> value="0" <?php if(!isset($_REQUEST['aid'])){?>checked="checked"<?php }?>></td>
					</tr>
					<tr>
						<td>Super Administrator</td>
						<td><label>Yes </label> <input type="radio"  <?php if($_q['super_admin'] == 1){?> checked="checked" <?php }?> name="sa" value="1">&nbsp;<label>No</label> <input type="radio" name="sa" <?php if($_q['super_admin'] == 0){?> checked="checked" <?php }?> value="0" <?php if(!isset($_REQUEST['aid'])){?>checked="checked"<?php }?>></td>
					</tr>
				</table>
		</td>
	</tr>

	
		<tr>
		<td>Status</td>
		<td>
			<select name="status">
				<option  <?php if($_q['status'] == "0"){?> selected="selected" <?php }?> value="0">NOT ACTIVE</option>
				<option  <?php if($_q['status'] == "1"){?> selected="selected" <?php }?> value="1" >ACTIVE</option>
			</select>
		</td>
	</tr>

   
    <tr class="oddRow">
        <td align="center"></td>
        <td valign="top" align="left">
        	<input type="submit" name="submit" value="Submit" class="button">
        </td>
    </tr>
    
    </table>
    </form>

           
          </div>
        </div>
        
        
        </div>
        <div align="center"></div>
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