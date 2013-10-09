<?php 
session_start();

include("../includes/configure.php");

if(isset($_SESSION['username']) and $_SESSION['username']!='')
{
	header('Location:camp.php');
}

if(isset($_REQUEST['Submit']) and $_REQUEST['Submit'] == 'Login')
{
	$sql = mysql_query("select * from tbl_admin where username='$_REQUEST[txtlogid]' and password = '$_REQUEST[txtpwd]' and status=1");
	$row = mysql_fetch_array($sql);
	
	if(mysql_num_rows($sql) > 0)
	{
		
			$_SESSION[admin_id] = $row[admin_id];
			$_SESSION[username] = $row[username];
			$_SESSION[email] = $row[email];
			$_SESSION[content_manager] = $row[content_manager];
			$_SESSION[job_manager] = $row[job_manager];
			$_SESSION[user_manager] = $row[user_manager];
			$_SESSION[super_admin] = $row[super_admin];
			
			header("Location:index.php");
		
	}
	else
	{
		$message = "Invalid credentials";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" media="all" href="css/base.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/jquery-ui.css" /> 
<link type="text/css" rel="stylesheet" media="all" href="css/grid.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/visualize.css" />
<title>Admin Base - Login</title>
</head>
<body>
<div id="login-wrapper">
<div class="box-header login">

Login
</div>
<div class="box">
<?php 
if(isset($message)){
if($message != "") 
{
	?>
    <div class="notification error">
    <?=$message?>
    </div>
	<?php 
} }
?>
<!--<div class="notification tip">
<span class="strong">TIP:</span> Just press login to go to the demo. </div>-->
<form action="" method="post" name="login"  class="login" onSubmit="">
  <div class="row">
    <label>Username:</label>
    <input name="txtlogid" value="Enter Username" type="text" class="textField" id="txtlogid" size="22" onFocus="javascript:this.className='textFieldFocus';if(this.value=='Enter Username')this.value='';" onBlur="javascript:this.className='textField';if(this.value=='')this.value='Enter Username';" />
 </div>

  <div class="row">
    <label>Password:</label>
    <input    name="txtpwd" value="password" type="password" class="textField" id="txtpwd" size="22" onFocus="javascript:this.className='textFieldFocus';if(this.value=='password')this.value='';" onBlur="javascript:this.className='textField';if(this.value=='')this.value='password';" />
 </div>
   <div class="row tr">
    
    <input type="submit" value="Login" name="Submit" class="button" style="width:90px!important;" />
    </div>
 </form>
	</div>
</div>


</body>
</html>