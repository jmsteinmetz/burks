<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Update')
{
	/*echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";*/
	$a = "update tbl_jobs set
					emp_id='".addslashes($_REQUEST['emp_name'])."',
					status = 'assigned'
					where $_REQUEST[cond]";

	mysql_query($a);
	
	$message = 'Job assigned successfully.';
	
	?>
    <script>
			window.location = 'job_assign.php?message=<?php echo $message?>&msg_type=success';
	</script>
	<?php
}
$cond="";
//echo ("select * from tbl_content where content_id=$_REQUEST[content_id]");exit;
foreach($_POST['jobs'] as $val){
	if($or==1){
		$cond.=" or ";
	}
	$cond.= "id=".$val;
	$or=1;
}
$or=0;
$query = mysql_query("select * from tbl_jobs where ".$cond);
$row = mysql_fetch_object($query);
?>

   <!-- Start Page Content  --> 
   
    <div id="page-shade"></div>
    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Job Management</h1>
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
          	Assign Job
			<div style="float: right;"><a style="color:" href="<?php if($_REQUEST['pg'] == "jc"){?>job_completed.php<?php } else {?>job_assign.php<?php }?>">Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="content_id" value="<?php echo $_REQUEST[content_id]?>" />
<input type="hidden" name="cond" value="<?php echo $cond; ?>" />

    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="left" colspan="2" ><!--<span class="warning">*</span>  Required Fields--></td>
   </tr>
    
    <tr >
        <td valign="top" align="right" width="20%">Patient Name</td>
        <td valign="top" align="left"><?php echo $row->p_name?></td>
    </tr>
    <tr >
        <td valign="top" align="right" width="20%">SSN</td>
        <td valign="top" align="left"><?php echo $row->p_ssn?></td>
    </tr>
        <tr >
        <td valign="top" align="right" width="20%">Employee</td>
        <td valign="top" align="left">
			<?php 	$qry = "SELECT * FROM tbl_user where status = 'ACTIVE' and type = 'BACK_END'";
					$qry_e = mysql_query($qry);
					?>
					<select name="emp_name">
					<option value="">Employee Name</option>
					<?php
					while($qry_f = mysql_fetch_array($qry_e)){ ?>
					<option value="<?php echo $qry_f['id'] ?>"><?php echo $qry_f['fname']." ".$qry_f['lname'] ?></option>
					<?php }?>
				</select>
			
		</td>
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