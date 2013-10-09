<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=="Update")
{
	mysql_query("update tbl_gallery set image_file = '".addslashes($_REQUEST[embd_ad_code])."', type = 'video' where image_id=$_REQUEST[image_id]");
	$msg = 'Record updated successfully';
	$msg_type="success";
}
?>

	
   <!-- Start Page Content  --> 
   
    <div id="page-shade"></div>
    <div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Gallery Management</h1>
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
       <?php if($message or isset($_REQUEST[message])) 
		{
			?>
			<div class="notification error" style="width:200px">
			<?=$message?><?=$_REQUEST[message]?>
			</div>
			<?php 
		} 
		?>
        <div class="container_12"> 
        
        <div class="grid_12">
          <div class="box-header"> 
          	Home Page Video Ad
            <!--<div style="float: right;"><a href="news.php" title="Cancel">Back</a></div>-->
          </div>
          
          <div class="box table">
    

           
            <form name="frm" enctype="multipart/form-data" method="post" action="">
            <?php
			$query = mysql_query("select * from tbl_gallery where type='video'");
			$row = mysql_fetch_object($query);
			
			?>
            <table border="0" cellpadding="2" cellspacing="0" width="70%" style="padding:15px; margin:auto">
              <tr>
              	<td align="left" style="font-size:10px; color:#F00">* only youtube embedded code</td>
        	  </tr>
              <tr>
                <td align="center">
                	<textarea name="embd_ad_code" style="height:200px; width:300px"><?=stripslashes($row->image_file);?></textarea><br />
                    <input type="submit" name="submit" value="Update" class="button" style="margin:5px 0px 0px 0px"> 
                </td>
                <td>
                	<?=stripslashes($row->image_file)?>
                    <input type="hidden" name="image_id" value="<?=$row->image_id?>" />
              </tr>
              <tr>
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