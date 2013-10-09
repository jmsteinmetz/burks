<?php
	session_start();

	include("header.php");
	admin_login_check();
	require_once("../includes/pagination.php"); 
	include("col_left.php");

	$srt_qry = "select * from tbl_jobinteractions ORDER BY sent_datetime desc";

	$test = new MyPagina;
	$test->sql = $srt_qry;
	$result = $test->get_page_result(); // result set
	$num_rows = $test->get_page_num_rows(); // number of records in result set 
	$nav_links = $test->navigation(" | ", "currentStyle"); // the navigation links (define a CSS class selector for the current link)
	$nav_info = $test->page_info("to"); // information about the number of records on page ("to" is the text between the number)
	$simple_nav_links = $test->back_forward_link(false); // the navigation with only the back and forward links, use true to use images
	$total_recs = $test->get_total_rows(); // the total number of records	
	$showing = $test->page_info();

?>
         
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">Job Interactions</h1>
       
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
        <?php 
	   		if(isset($_REQUEST[message]) or $message) 
			{
				?>
				<div class="notification <?php echo $_REQUEST[msg_type]?>" style="width:200px">
				<?php echo $_REQUEST[message]?>
				</div>
				<?php 
			} 
		?>
        
        <!-- Start Table -->
        <div class="grid_8" style="width:100%">

			<div class="table" align="right" style="margin-bottom:5px" >
			<?=$showing?>
			</div>
			 

          <div class="box table" style="width:100%;border-top:1px solid #AAAAAA">
            <table cellspacing="0" width="100%">
			  
              <thead>

                <tr>
                  <td  nowrap width="1%">RFA #</td>
				  <td nowrap width="1%">Date Sent</td>
				  <td >Recipient(s)</td>
                  <td width="1%" nowrap>Status</td>
				  <td width="1%" nowrap>Action</td>
                </tr>
              </thead>
              <tbody>
              
 
	
<?php
while($res = mysql_fetch_assoc($result))					   
{
 $row[] = $res;				 
}
				for($i=0;$i<$num_rows;$i++)
				{
					if ($row[$i]['status'] == 'Failed To Send')
					{
						$sCellStyle = "border:1px solid #9D9D9D;color:red;max-width:300px;";
					}
					else
					{
						$sCellStyle = "border:1px solid #9D9D9D;max-width:300px;";
					}
					
					?>
					<tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'" >
                        <td style="<?php echo $sCellStyle; ?>" nowrap width="1%"><?php echo $row[$i]['jid']?></td>
						<td style="<?php echo $sCellStyle; ?>" nowrap width="1%"><?php echo $row[$i]['sent_datetime']?></td>
						<td style="<?php echo $sCellStyle; ?>"><?php echo $row[$i]['recipient']?></td>
						<td style="<?php echo $sCellStyle; ?>" nowrap width="1%"><?php echo $row[$i]['status'] ?></td>
						<td style="border:1px solid #9D9D9D;">
                        	<a href="form_view.php?jid=<?php echo $row[$i]['jid']?>" title="View "><img src="./img/icons/small/page.png" border="0" /></a>  
						</td>
					</tr>
                    <?php
				}
				if(!$num_rows){?>
                <tr>
                <td colspan="9" class="noRecordFound" align="center" valign="middle">
                  No Records Available
                  </td>
                </tr>
                <?php }?>
                  <tr>
                    <td align="center" colspan="9" class="mainText" ><?=$nav_links?></td>
                  </tr>
                  <tr>
                    <td align="center" colspan="9" class="mainText" ><?=$showing?></td>
                  </tr>
                            
              </tbody>
            </table>
          </div>
        </div> 
        
        <br class="cl" />
        <br class="cl" />
        <br class="cl" />
        <div>
    </div>
    
<?php include("footer.php"); ?>