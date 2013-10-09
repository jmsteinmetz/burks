<?php 
session_start();
include("header.php");
include("FCKeditor/fckeditor.php") ;
admin_login_check();
include("col_left.php");

if(isset($_REQUEST[submit]) and $_REQUEST[submit]=="Upload")
{
	for($i=0;$i<5;$i++)
	{	
		if($_FILES['userfile']['name'][$i])
		{
			$exp = explode(".",$_FILES['userfile']['name'][$i]);
			$FileName = $exp[0]."_".($i+1)."_".time().".".end(explode('.',$_FILES['userfile']['name'][$i]));
			$uploadfile = "../images/gallery/". $FileName;
			$ok = move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $uploadfile);
			mysql_query("insert into tbl_gallery set 
							image_url = '".$_REQUEST[url][$i]."',
							image_file = '".$FileName."',
							type = 'right'");
			$msg = 'Record deleted successfully';
			$msg_type="success";
		}
	}
}
if(isset($_REQUEST[act]) and $_REQUEST[act]=="d")
{
	mysql_query("delete from tbl_gallery where image_id=".$_REQUEST[image_id]);
	@unlink('../images/gallery/'.$_REQUEST[image_file]);
	$msg = 'Record deleted successfully';
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
          	Right Gallery
            <!--<div style="float: right;"><a href="news.php" title="Cancel">Back</a></div>-->
          </div>
          
          <div class="box table">
    

           
            <form name="frm" enctype="multipart/form-data" method="post" action="">
            
            <table border="0" cellpadding="2" cellspacing="0" width="70%" style="padding:15px; margin:auto">
              <tr>
              	<td align="left" style="font-size:10px; color:#F00" colspan="2">* Image Dimension: 300px x 250px</td>
        	  </tr>
              <tr>
              	<td><strong>URL</strong></td>
                <td align="center"><strong>Image File</strong></td>
              </tr>
              <tr>
              	<td><input type="text" name="url[]" value="" style="width:200px" /></td>
                <td align="center"><input name="userfile[]" type="file" id="gallery_image" size="60" /></td>
              </tr>
              <tr>
              	<td><input type="text" name="url[]" value="" style="width:200px" /></td>
                <td align="center"><input name="userfile[]" type="file" id="gallery_image" size="60" /></td>
              </tr>
              <tr>
                <td><input type="text" name="url[]" value="" style="width:200px" /></td>
                <td align="center"><input name="userfile[]" type="file" id="gallery_image" size="60" /></td>
              </tr>
              <tr>
                <td><input type="text" name="url[]" value="" style="width:200px" /></td>
                <td align="center"><input name="userfile[]" type="file" id="gallery_image" size="60" /></td>
              </tr>
              <tr>
                <td><input type="text" name="url[]" value="" style="width:200px" /></td>
                <td align="center"><input name="userfile[]" type="file" id="gallery_image" size="60" /></td>
              </tr>
              <tr>
                <td style="padding:5px 0px 0px 0px">
                    <input type="submit" name="submit" value="Upload" class="button"> 
                </td>
              </tr>
                   
                    
             </table>
            </form>
            
            
            <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center" class="greyBorder">
                <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">URL</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                    <?php 
                        $q = mysql_query("select * from tbl_gallery where type='right' order by image_id DESC");
            			$totalRows = mysql_num_rows($q);
						if ($totalRows > 0) 
						{
							while($row = mysql_fetch_array($q))
							{
								?>
								<tr>
									<td><img src="<?php echo '../images/gallery/'.$row['image_file']; ?>" alt="" width="150px"></td>
									<td><?php echo $row[image_url]; ?></td>
									<td style="padding:0px">
										<a href="right_gallery.php?image_id=<?=$row[image_id]?>&image_file=<?=$row[image_file]?>&act=d" onclick="confirm('Are you sure you want to delete this image');">
                                        	<img src="images/delete_icon.png" border="0" title="delete image">
                                        </a>
									</td>
								</tr>
								<?php
							}
						}
						else 
						{ 
							?>
                        	<tr>
                            	<td colspan="4"><font color="#FF0000"><b>NO RECORD FOUND</b></font></td>
                        	</tr>
                            <?php
                    	} 
						?>
                        
                        
                    </tbody>
                </table>
                

        
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