<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Submit')
{
/*	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";
	exit;
*/
 $q = "insert into tbl_testimonials set
					title='".addslashes($_REQUEST['title'])."',
					testimonial='".addslashes($_REQUEST['testimonial'])."',
					date_created='".date("Y-m-d H:i:s")."',
					status = '".addslashes($_REQUEST['status'])."'";

	mysql_query($q);
	
	$message = 'Testimonial added successfully.';
	
	?>
    <script>window.location = 'testimonial.php?message=<?php echo $message?>&msg_type=success';</script>
	<?php
}
?>

   <!-- Start Page Content  --> 
   
    <div id="page-shade"></div>
    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Testimonial Management</h1>
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
          	New Testimonial
            <div style="float: right;"><a style="color:" href="testimonial.php">Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">
    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="left" colspan="2" ><!--<span class="warning">*</span>  Required Fields--></td>
   </tr>
    
        
    <tr>
        <td align="right">Title</td>
        <td valign="top" align="left"><input type="text" value="" name="title" ></td>
    </tr>
	<tr>
        <td align="right">Testimonial</td>
        <td valign="top" align="left">
        
        <?php 	
			$oFCKeditor = new FCKeditor('testimonial') ;
			$oFCKeditor->BasePath	= 'FCKeditor/' ;
			$oFCKeditor->Height	= '400px' ;
			$oFCKeditor->Value		= $row[cms_desc];
			$oFCKeditor->Create() ;
		?>
        
        </td>
    </tr>
      <tr>
        <td align="right">Status</td>
        <td valign="top" align="left"><select name="status"><option value="0">Inactive</option><option value="1">Active</option></select></td>
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