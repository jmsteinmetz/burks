<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");


?>
<script>
function uv(){
	var em = document.getElementById("email").value;
	//alert(em);
	
	$.post("user_validate.php", { ce: em },
   function(data) {
     alt(data);
   });
   
   function alt(d){
   	if(d == "0"){
		//alert("not available");
		document.getElementById("e").innerHTML = 'Not Available';
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


	$a = "INSERT INTO tbl_user set
					fname='".addslashes($_REQUEST['fname'])."',
					lname='".addslashes($_REQUEST['lname'])."',
					email='".addslashes($_REQUEST['email'])."',
					state='".addslashes($_REQUEST['state'])."',
					zip='".addslashes($_REQUEST['zip'])."',
					status='".addslashes($_REQUEST['status'])."',
					type='".addslashes($_REQUEST['type'])."',
					password='".addslashes($_REQUEST['password'])."'";

	mysql_query($a);
	$from = "generalmail@burksmedicalconsulting.com";
	$headers =  "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $from = "Burks Medical Consulting".' < '.$from.' >';
    $headers .= "From: $from \r\n";
    $headers .= "Reply-To: $from \r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= "Message-ID: <". time() .rand(1,1000). "@".$_SERVER['SERVER_NAME'].">". "\r\n";
    $headers .= "<br>X-Mailer: PHP \r\n";

//print_r($headers);
//exit;



	$to = addslashes($_REQUEST['email']);
	$subject = "New BMC Employee Account";
//	$header = "From : Burks Medical Consulting";


	if($_REQUEST['type'] == "BACK_END"){
		$mssg = "Dear ".$_REQUEST['fname']." ".$_REQUEST['lname'].", <br><br> Your new BMC employee portal account has been activated. Please login to your employee portal using the following details. <br><br> Username: ".$_REQUEST['email']."<br><br>Password: ".$_REQUEST['password']."<br><br> Thanks<br>BMC Support Team.";	
	}
	else{
		
	$mssg = "Dear ".$_REQUEST['fname']." ".$_REQUEST['lname'].",<br><br> Your new BMC user portal account has been activated. Please login to your user portal using the email and password you used when creating your account.<br><br> Thanks<br>BMC Support Team.";
}	

//	$mssg = "Your new BMC Employee Portal account has been created. \n Following are the details: \n Username: ".addslashes($_REQUEST['email'])."\n Password: ".addslashes($_REQUEST['password']);
	if(mail($to, $subject, $mssg, $headers)){
	//echo "";
	}
	else{
		//echo "not sent";
	}
	$message = 'User added successfully.';
	
	?>
    <script>window.location = 'user.php?message=<?php echo $message?>&msg_type=success';</script>
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
            <div style="float: right;"><a style="color:" href="user.php">Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">

    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="left" colspan="2" ><!--<span class="warning">*</span>  Required Fields--></td>
   </tr>
    
    <tr >
        <td valign="top" align="right" width="20%">First Name</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="fname" value=""></td>
    </tr>
    <tr >
        <td valign="top" align="right" width="20%">Last Name</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="lname" value=""></td>
    </tr>
        <tr >
        <td valign="top" align="right" width="20%">Email</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" id="email" onblur="uv();" name="email" value=""><div id="e" style="color:#FF0000;"></div></td>
    </tr>
    <tr >
        <td valign="top" align="right" width="20%">State</td>
        <td valign="top" align="left"><select labelid="state" id="state" name="state" >
                    <option value="AL" selected="selected">AL</option>
                    <option value="AK">AK</option>
                    <option value="AZ">AZ</option>
                    <option value="AR">AR</option>
                    <option value="CA">CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DE">DE</option>
                    <option value="DC">DC</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="IA">IA</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="ME">ME</option>
                    <option value="MD">MD</option>
                    <option value="MA">MA</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MS">MS</option>
                    <option value="MO">MO</option>
                    <option value="MT">MT</option>
                    <option value="NE">NE</option>
                    <option value="NV">NV</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NY">NY</option>
                    <option value="NC">NC</option>
                    <option value="ND">ND</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VT">VT</option>
                    <option value="VA">VA</option>
                    <option value="WA">WA</option>
                    <option value="WV">WV</option>
                    <option value="WI">WI</option>
                    <option value="WY">WY</option>
                </select></td>
    </tr>
    <tr >
        <td valign="top" align="right" width="20%">zip</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="zip" value=""></td>
    </tr>
    <tr >
        <td valign="top" align="right" width="20%">Password</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="password" value=""></td>
    </tr>
    
			<tr>
		<td>User Type</td>
		<td>
		<select name="type">
		<option value="BACK_END">Employee</option>
		<option value="FRONT_END" >Client</option>
		</select></td>
	</tr>

	
		<tr>
		<td>Status</td>
		<td>
		<select name="status">
		<option value="NOT_ACTIVE">NOT ACTIVE</option>
		<option value="ACTIVE" >ACTIVE</option>
		<option value="SUSPENDED" >SUSPEND</option>
		</select></td>
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