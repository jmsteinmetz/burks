<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=='Submit')
{
	$ty = "update tbl_news set
					question='".addslashes($_REQUEST['question'])."',
					answer='".addslashes($_REQUEST['answer'])."',
					date_created='".date("Y-m-d H:i:s")."',
					status = '".addslashes($_REQUEST['status'])."'   
					where id='".$_REQUEST['id']."'";
	
	mysql_query($ty) or die(mysql_error());
	
	$message = 'Record updated successfully.';
	
	?>
    <script>window.location = 'news.php?message=<?php echo $message?>&msg_type=success';</script>
	<?php
}
$qr = "select * from tbl_news where id='".$_REQUEST['id']."'";
$query = mysql_query($qr);
$row = mysql_fetch_array($query);

?>

   <!-- Start Page Content  --> 
   
    <div id="page-shade"></div>
    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>FAQ's Managment</h1>
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
          	Edit FAQ
            <div style="float: right;"><a href="news.php" title="Cancel">Back</a></div>
          </div>
          
          <div class="box table">

<form name="frm" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="id" value="<?php echo $_REQUEST[id]?>" />
    <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
    
    <tr>
        <td align="left" colspan="2" ><!--<span class="warning">*</span>  Required Fields--></td>
   </tr>

    <tr >
        <td valign="top" align="right" width="20%">Question</td>
        <td valign="top" align="left">	
			<?php 	
			$oFCKeditor = new FCKeditor('question') ;
			$oFCKeditor->BasePath	= 'FCKeditor/' ;
			$oFCKeditor->Height	= '400px' ;
			$oFCKeditor->Value		= $row['question'];
			$oFCKeditor->Create() ;
		?>
</td>
    </tr>
    
    <tr>
        <td align="right">Answer</td>
        <td valign="top" align="left">
		<?php 	
			$oFCKeditor = new FCKeditor('answer') ;
			$oFCKeditor->BasePath	= 'FCKeditor/' ;
			$oFCKeditor->Height	= '400px' ;
			$oFCKeditor->Value		= $row['answer'];
			$oFCKeditor->Create() ;
		?>
        </td>
    </tr>
	<tr>
		<td>Status</td>
		<td><select name="status"><option <?php if($row['status'] == 0){ ?> selected="selected" <?php } ?> value="0">Inactive</option><option <?php if($row['status'] == 1){ ?> selected="selected" <?php } ?> value="1">Active</option></select></td>
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