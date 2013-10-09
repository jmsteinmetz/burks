<?php
session_start();
// AAravind (2013.04.25) : The line below basically allowed this page to be publicly viewable. Changed it to call admin_login_check() method - which is implemented in header.php. So we have to include this before calling the method
// $_SESSION[super_admin] = "1";
include("header.php");
admin_login_check();
include("col_left.php");

?>

<script>
function popUp(URL) {

day = new Date();
id = day.getTime();

var csdate = document.frm_date.completed_startdate.value;
var cedate = document.frm_date.completed_enddate.value;

var URL = URL + 'csdate=' + csdate + '&cedate=' + cedate;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=700;left = 200,top = 200');");
}

function popUp2(URL) {

day = new Date();
id = day.getTime();

var idval = 0;
var test = document.frm_date.uid.value;
if (test != '') {
   idval = parseInt(test);
   }
else {
var uid = prompt("Enter Starting ID: ","0");
idval = parseInt(uid);
   }

var csdate = document.frm_date.completed_startdate.value;
var cedate = document.frm_date.completed_enddate.value;

var URL = URL + 'csdate=' + csdate + '&cedate=' + cedate + '&id=' + idval;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=700;left = 200,top = 200');");
}

function popUp3(URL) {

day = new Date();
id = day.getTime();


var idval = 0;
var idcnt = 0;
var test = document.frm_date.uid.value;
if (test != '') {
   idval = parseInt(test);
   URL = 'end_of_month_print_single_report.php?';
   }
else {
   idval='';
   for (var i=0 ; i < document.frm_date.chk.length ; i++) {  
      if (document.frm_date.chk[i].checked) {
         idval=idval + i + '|';
         idcnt++;
         }
      }
      if (idcnt == 0) {
      alert('No clients are selected');
      return;
      }
   }

var csdate = document.frm_date.completed_startdate.value;
var cedate = document.frm_date.completed_enddate.value;

var URL = URL + 'csdate=' + csdate + '&cedate=' + cedate + '&id=' + idval;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=700;left = 200,top = 200');");
}

function popUpView(val) {

day = new Date();
id = day.getTime();

var URL = val;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=700;left = 200,top = 200');");
}

</script>
 

<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1 style="width:500px">End of Month Report<br></h1>
       
      </div>

      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container_12"> 
        
                
        <!-- Start Table -->
        <div class="grid_8" style="width:100%;min-width:500px;">
	<div class="box-header"> 
	<table width="100%">
		<tr>
		     <td>
                     <a href="javascript:popUp('end_of_month_print_all_reports.php?')">Print All</a>
                     </td>
                     <td style="horizontal_align:left">     
		     <a href="javascript:popUp2('end_of_month_print_from_reports.php?')">Print All From ID</a>
		     </td>
                     <td style="horizontal_align:left">     
		     <a href="javascript:popUp2('end_of_month_print_single_report.php?')">Print Single From ID</a>
		     </td>
                     <td style="horizontal_align:left">     
		     <a href="javascript:popUp3('end_of_month_print_selected_report.php?')">Print Selected</a>
		     </td>
		</tr>
	</table>
	</div>
						
          <div class="box table" style="width:100%">
        <div style="overflow:auto;">
        <table cellpadding="0" cellspacing="0" border="1">
        <tr>
        <td>
             <form name="frm_date" action="" method="post">
			 
			
			
            <table width="940" align="left" cellpadding="0" cellspacing="0" border="1">
            	<tr>
                	<td>Provider:</td>
                    <td></td>
                </tr>
                <tr>
                	<td>
						<select name="usrid" style="width:400px">
                  
						<?php
						$query1 = mysql_query("select * from tbl_user WHERE type = 'FRONT_END' and status = 'ACTIVE' order by email"); 
						?>
						
                <option value="">Select Provider</option>
                <?php
				while($row1 = mysql_fetch_array($query1))
                {?>
	
				  <option <?php if($_REQUEST['usrid'] == $row1['id']){?> selected="selected" <?php } ?> value='<?php echo $row1['id']; ?>'><?php echo $row1['email'].' ('.$row1['fname'].' '.$row1['lname'].')'; ?></option>
				  
				  <?php }?>
				  </select></td>
                    <td></td>
                </tr>
               <tr>
				<td>Completed Start Date:</td>
				<td>Completed End Date:</td>
				</tr>
                <tr>
                	<td>
					<script>
	$(function() {
		$( "#completed_startdate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true
		});
		
	});
	</script>
					<input id="completed_startdate" name="completed_startdate" type="text" value="<?php echo $_REQUEST['completed_startdate']; ?>">
		</td>
        <td>
					<script>
	$(function() {
		$( "#completed_enddate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true
		});
	});
	</script>
					<input id="completed_enddate" name="completed_enddate" type="text" value="<?php echo $_REQUEST['completed_enddate']; ?>">	
		</td>
                </tr>
				
                
                
                <tr>
                <td>&nbsp;</td>
                <td align="right"><input name="uid" type="hidden" value="" />
						
						
						<input type="hidden" name="frm_dat" value="123">
						
						<input type="submit" value="Search" name="submit"></td>
                </tr>
                
                
            </table>
           
        </td>
        </tr>
        
        <tr>
        <td>
		
		<?php

			if(isset($_POST['submit'])){
							
			$rew = "SELECT job.*, usr.email as provider_email FROM tbl_jobs as job inner join tbl_user as usr on (usr.id = job.fuid) WHERE 1=1 ";
				/*if($_REQUEST['usrid'] != ""){
					$rew.= "and job.fuid = '".$_REQUEST['usrid']."'";
				}*/
				$rew.= " and job.status = 'complete'";
				
				$completed_startdate = $_REQUEST['completed_startdate'];
                                if ($completed_startdate == '')
				{
                                $completed_startdate = date('Y-m-d',strtotime(date('m').'/01/'.date('Y').' 00:00:00'));
                                }
                                else
                                {
                                $completed_startdate = date('Y-m-d',strtotime($completed_startdate));
                                }
				$completed_enddate = $_REQUEST['completed_enddate'];
                                if ($completed_enddate == '')
				{
				$completed_enddate = date('Y-m-d',strtotime(date('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00')))));
                                }
                                else
                                {
                                $completed_enddate = date('Y-m-d',strtotime($completed_enddate));
                                }

				$rew.=" and job.completed_datetime >= '" .$completed_startdate. "' and job.completed_datetime < date_add('" .$completed_enddate. "',interval 1 day)";

                                /* if($_REQUEST['usrid'] == ""){*/
				$rew.= " and job.fuid in (select id from `tbl_user` where type='FRONT_END' and status='ACTIVE') order by usr.email,usr.id";
				/*}*/
                                
                                $query = mysql_query($rew);
				
                                $val = strpos($rew,'FROM');
                                $rew = substr_replace($rew,'select proc.jid,proc.aurthorize_no,usr.email,usr.id from tbl_procedure as proc inner join',0,$val+4);
                                $val = strpos($rew,'as job');
                                $rew = substr_replace($rew,' on (proc.jid=job.id)',$val+6,0);
                                $rew.= ",proc.jid";

                                $query_proc = mysql_query($rew);
                               
				}
				else{
					
				}
			?>

			<BR>Search Results: <?php 
			$no_of_records = mysql_num_rows ($query);
                        $no_of_procs = mysql_num_rows ($query_proc);
			echo $no_of_records.' Jobs and '.$no_of_procs.' Procedures';

                        $arr = array();
                        $user = array();
                        $uid = array();
                        $rfa_count = 0;
                        $last = '';
                        $id = '';

                        while ($proc = mysql_fetch_array($query_proc))
                        {
                           /*print '/'.$id.'/'.$jid.'/'.$proc['id'].'/'.$proc['jid'].'<br>';*/
                          
                           if (strlen($id) == 0)
                           {
                           $id = $proc['id'];
                           $jid = $proc['jid'];
                           $user[] = $proc['email'];
                           $uid[] =  $proc['id'];
                           }

                           if (strcmp($id,$proc['id']) != 0)
                           {
                           $id = $proc['id']; 
                           $arr[] = $rfa_count;
                           $user[] = $proc['email'];
                           $uid[] =  $proc['id'];
                           $rfa_count = 0;
                          
                           }

                           if (strcmp($jid,$proc['jid']) != 0)
                           {
                           $jid = $proc['jid'];
                           $rfa_count++;
                           $last = '';
                           } 
                           
                          

                           $test = rtrim($proc['aurthorize_no']);
                           $test = strtolower($test);

                           if (strcmp($id,'515') == 0)
                           {
                              if (strcmp($test,'vob check') == 0)
                              {
                              $test='99999';
                              }
                           }

                           $p = strpos($test,"msr");
                           if ($p !== false)
                             {
                             $test = rtrim(substr($test,0,$p));
                             }
                          
                           $test = substr($test,-5);                       
                                                 
                           if (is_numeric($test))
                           {
                              if (strlen($last) == 0)
                              {
                              $last = $test; 
                              }
                              elseif (strcmp($last,$test) != 0)
                              {
                              $rfa_count++;
                              } 
                              else
                              {
                              $last = $test;
                              }
                           }
                           
                        }
                  
                        $arr[] = $rfa_count;
                        $user[] = $proc['email'];
                        $rfa_count = 0;
                       /*print_r($arr);
                        print '<br>'; */    

                   ?>

                <BR />
        	<table  align="left" cellpadding="0" cellspacing="0" border="1">
		<thead>	
                <tr class="box-header" style="font-size:12pt">
                                <td>ID</td>
				<td>Client</td>
                	        <td># RFAs</td>
				<td>View</td>
				<td>Select</td>
				  
                </tr>
                </thead>
                <tbody>
                <tr onMouseOver="this.bgColor='F5F1F1'" onMouseOut="this.bgColor='ffffff'">
		<td style="text-transform:capitalize; border:1px solid #9D9D9D;">

                         <?php        
                                $client_count = 0;
                                $old_id = '';
                                $new_client = 'no';
                                
				while($row = mysql_fetch_array($query))
				{
				       
                                       $new_id = $row['fuid'];
                                       
                                                                             
                                       if (strcmp($new_id,$old_id) != 0)
                                        {
                                            if (strlen($old_id) == 0)
                                            {
                                            
                                            $old_id = $new_id;
                                            $new_client = 'no';
                                            echo $client_count;?></td>
                                            <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                                            <?php echo $row['provider_email'];?></td><?php
                                            }
                                            else
                                            {
                                            $old_id = $new_id;
                                            $new_client = 'yes';
                                            $new_email = $row['provider_email'];
                                            
                                            }
                                            
                                        }
	                              
                                        if (strcmp($new_client,'yes') == 0){ ?>
                                           
                                           <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                                           <?php echo $arr[$client_count];?></td>
                                           <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                                           <a href="javascript:popUpView('end_of_month_print_single_report.php?csdate=<?php echo $completed_startdate;?>&cedate=<?php echo $completed_enddate;?>&id=<?php echo $client_count;?>')">View</a></td>
      		                           <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                                           <input type="checkbox" name="chk" checked=false></td>
                                           </tr><?php  
                                           $client_count++;
                                           $new_client = 'no';
                                           $prov_email = $new_email;?>
                                           <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                                           <?php echo $client_count;?></td> 
                                           <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php 
                                           echo $new_email;?></td><?php  
                                                                                      
                                           } 

                                         
                                } 
                             ?>
                               <td style="text-transform:capitalize; border:1px solid #9D9D9D;"><?php 
                               echo $arr[$client_count];?></td>
                               <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                               <a href="javascript:popUpView('end_of_month_print_single_report.php?csdate=<?php echo $completed_startdate;?>&cedate=<?php echo $completed_enddate;?>&id=<?php echo $client_count;?>')">View</a></td>
      		               <td style="text-transform:capitalize; border:1px solid #9D9D9D;">
                               <input type="checkbox" name="chk" checked=false></td>
                               </tr>

            </tbody>   
            <tr></tr>                   
            <BR>&nbsp&nbsp&nbsp&nbsp&nbspFinal Results: <?php 
            $rfa_count = 0;
            for ( $i = 0 ; $i <= $client_count ; $i++) { $rfa_count = $rfa_count + $arr[$i]; }
            $clients = $client_count + 1;
            echo $rfa_count.' RFAs and '.$clients.' Clients';

            $q1 = "DROP TABLE eom_tbl";
            $retval = mysql_query($q1);
            /*if (! $retval ) {
               die ('Error '.mysql_error()); } */ 
            $q2 = "CREATE TABLE eom_tbl (id int not null, uid varchar(10) not null, rfas varchar(10) not null, PRIMARY KEY (id))";
            $retval = mysql_query($q2);
            /*if (! $retval ) {
               die ('Error '.mysql_error()); }  */
            for ( $i = 0 ; $i <= $client_count ; $i++) { 
               $q3 = "INSERT INTO eom_tbl (id,uid,rfas) VALUES (".$i.",".$uid[$i].",".$arr[$i].")";
               $retval = mysql_query($q3);
               /*if (! $retval ) {
                  die ('Error '.mysql_error()); }  */
               }

            if ($_REQUEST['usrid'] != ""){
               $have1 = 0;
               for ( $i = 0 ; $i <= $client_count ; $i++) {
                  if ($_REQUEST['usrid'] == $uid[$i]) {
                  $have1 = 1;
                  ?><script type="text/javascript">document.frm_date.uid.value = "<?php echo $i; ?>";</script><?php
                  }
               }
            if ($have1 == 0) { 
               ?><script type="text/javascript">alert('No RFAs found for this Provider');</script><?php   
               } 
            }

            ?><script type="text/javascript">
                 for (var ix = 0; ix < document.frm_date.chk.length ; ix++) {
                    document.frm_date.chk[ix].checked=false;
                 }</script>
  
            <tr></tr>
               
               
              	
            </table>
        </td>
        </tr>
        </table>
	 </form>                             	
        </div>
          </div>
        </div> 
        <!-- End Table --> 
        <!-- Start Formatting -->
        
        
        <br class="cl" />

        <!-- End Formatting --> 
        <!-- Start Forms --><!-- Start Forms --> 
        <!-- Start Notifcations --><br class="cl" />
        <!-- End Notifcations --> 
                <!-- Start Layout Example --><br class="cl" />
        <!-- End Layout Example --> 
        
        <!-- End Grid --> 
      </div>
      <!-- End Page Wrapper --> 
    </div>
    <!-- End Page Content  --> 
    
<?php include("footer.php"); ?>