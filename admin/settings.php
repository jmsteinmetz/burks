<?php 
session_start();
include("header.php");
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Submit')
{
	/*echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";*/
	
	mysql_query("update tbl_admin set
					username='$_REQUEST[username]',
					password='$_REQUEST[password]',
					email='$_REQUEST[email]'");
	
	$message = 'Record updated successfully.';
	$msg_type = 'success';
	
}

$query = mysql_query("select * from tbl_admin");
$row = mysql_fetch_object($query);

?>
   <!-- Start Page Content  --> 
   
    <div id="page-shade"></div>
    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Settings</h1>
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
       <?php if($message or isset($_REQUEST[message])) 
		{
			?>
			<div class="notification <?=$msg_type?><?=$_REQUEST[msg_type]?>" style="width:200px">
			<?=$message?><?=$_REQUEST[message]?>
			</div>
			<?php 
		} 
		?>
        <div class="container_12"> 
        
        <div class="grid_9">
          <div class="box-header"> 
          	Edit Settings
              <!--<div style="float: right;"><a href="camp.php" title="Cancel">Back</a></div>-->
          </div>
          
          <div class="box table">
<!--URL A -> Primary URL
URL B -> proxy
URL C -> returning visitors

If proxy -> URL B ->If Excluded city -> URL B
If returning visitor URL C
Else
URL A-->

<form name="frm" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="cID" value="<?=$_REQUEST[cID]?>" />
    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="right" colspan="2" style="padding:20px 0px 0px 0px"></td>
    </tr>
    
    <tr >
        <td valign="top" align="right" width="30%">Username</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="username" value="<?=$row->username?>"></td>
    </tr>
    
    <tr>
        <td align="right" colspan="2" style="padding:20px 0px 20px 0px"><hr color="#AIAIAI" /></td>
    </tr>
    
    <tr>
        <td align="right">Password</td>
        <td valign="top" align="left"><input type="password" style="width: 200px;" name="password" value="<?=$row->password?>">
        </td>
    </tr>
   
   <tr>
        <td align="right" colspan="2" style="padding:20px 0px 20px 0px"><hr color="#AIAIAI" /></td>
    </tr>
   
    <tr >
        <td valign="top" align="right" >Email Address</td>
        <td valign="top" align="left">
        <input type="text" style="width: 200px;" name="email" value="<?=$row->email?>">
        </td>
    </tr>

	<tr>
        <td align="right" colspan="2" style="padding:20px 0px 0px 0px"><hr color="#AIAIAI" /></td>
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