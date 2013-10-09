<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Update')
{
/*	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";
	exit;*/
	$u = "update tbl_content set
					title='".addslashes($_REQUEST['title'])."',
					description='".addslashes($_REQUEST['description'])."',
					place='".addslashes($_REQUEST['place'])."' 
					where content_id='".$_REQUEST['content_id']."'";
					//exit;
	mysql_query($u);
	
	$message = 'Content updated successfully.';
	
	?>
    <script>window.location = 'contents.php?message=<?php echo $message?>&msg_type=success';</script>
	<?php
}
//echo ("select * from tbl_content where content_id=$_REQUEST[content_id]");exit;
$query = mysql_query("select * from tbl_content where content_id='".$_REQUEST[content_id]."'");
$row = mysql_fetch_object($query);
?>

   <!-- Start Page Content  --> 
   
    <div id="page-shade"></div>
    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Site Pages Management</h1>
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
          	Edit Content
            <div style="float: right;"><a style="color:" href="contents.php">Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="content_id" value="<?php echo $_REQUEST[content_id]?>" />

    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="left" colspan="2" ><!--<span class="warning">*</span>  Required Fields--></td>
   </tr>
    
    <tr >
        <td valign="top" align="right" width="20%">Title</td>
        <td valign="top" align="left"><input type="text" style="width: 200px;" name="title" value="<?php echo $row->title?>"></td>
    </tr>
    
    <tr>
        <td align="right">Content</td>
        <td valign="top" align="left">
        
        <?php 	
			$oFCKeditor = new FCKeditor('description') ;
			$oFCKeditor->BasePath	= 'FCKeditor/' ;
			$oFCKeditor->Height	= '400px' ;
			$oFCKeditor->Value		= stripslashes($row->description);
			$oFCKeditor->Create() ;
		?>
        
        </td>
    </tr>
		<tr>
		<td>Place/Status</td>
		<td><select name="place"><option <?php if(stripslashes($row->place) == 'inactive'){ ?> selected="selected" <?php } ?> value="inactive">Inactive</option><option value="top"  <?php if(stripslashes($row->place) == 'top'){ ?> selected="selected" <?php } ?> >Top Menu</option><option value="right"  <?php if(stripslashes($row->place) == 'right'){ ?> selected="selected" <?php } ?> >Right Menu</option></select></td>
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