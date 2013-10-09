<?php
	include("../includes/configure.php"); 
	include("../includes/functions.php");

	$rew = "SELECT job.id as rfa_no, job.appt_full_date as 'appointment_date', job.p_name as 'patient_name', job.p_dob as 'patient_dob', job.aurthorize_no as 'authorization_no', job.approved, job.facility, job.ref_physican as physician, insurance_company as insurance, p_dob as dob, 1 as cpt, 1 as 'expiration_date', usr.email as provider  FROM tbl_jobs as job left outer join tbl_user as usr on usr.id = job.fuid WHERE 1=1 ";
	
	if($_REQUEST['usrid'] != ""){
		$rew.= "and fuid = '".$_REQUEST['usrid']."'";
	}
	if($_REQUEST['job_st'] != ''){
			if ($_REQUEST['job_st'] != 'none') {
			$rew.= " and status = '".$_REQUEST['job_st']."'";
		}
	}
	if($_REQUEST['fac'] != '')
	{
		$rew.= " and facility = '".$_REQUEST['fac']."'";
		}
	if($_REQUEST['phy'] != none){
		$rew.= " and ref_physican = '".$_REQUEST['phy']."'";
	}
	
	$appt_startdate = $_REQUEST['sdate'];
	$appt_enddate = $_REQUEST['edate'];
	
	if ($appt_startdate == '')
	{
		if ($appt_enddate != '')
		{
			$rew.=" and appt_full_date <= '" .date('Y-m-d', strtotime($appt_enddate)) . "'";
		}
	}
	else
	{
		if ($appt_enddate == '')
		{
			$rew.=" and appt_full_date >= '" .date('Y-m-d', strtotime($appt_startdate)) . "'";
		}
		else
		{
			$rew.=" and appt_full_date BETWEEN '" .date('Y-m-d', strtotime($appt_startdate)) . "' and '" . date('Y-m-d', strtotime($appt_enddate)) . "'";
		}
	}
	
	$completed_startdate = $_REQUEST['csdate'];
	$completed_enddate = $_REQUEST['cedate'];
	
	if ($completed_startdate == '')
	{
		if ($completed_enddate != '')
		{
			$rew.=" and completed_datetime <= '" .date('Y-m-d', strtotime($completed_enddate)) . "'";
		}
	}
	else
	{
		if ($completed_enddate == '')
		{
			$rew.=" and completed_datetime >= '" .date('Y-m-d', strtotime($completed_startdate)) . "'";
		}
		else
		{
			$rew.=" and completed_datetime BETWEEN '" .date('Y-m-d', strtotime($completed_startdate)) . "' and '" . date('Y-m-d', strtotime($completed_enddate)) . "'";
		}
	}
		
	downloadXL($rew, "clientjobreport");
			
	function downloadXL($sql, $filename)
	{
         $export = mysql_query($sql);
         $fields = mysql_num_fields($export);
         
        for ($i = 0; $i < $fields; $i++) 
		{ 
			$header .= mysql_field_name($export, $i) . "\t"; 
        } 
        
		while($row = mysql_fetch_row($export)) 
		{ 
			$line = '';
			$icountfield = 0;
			$sProcedureQuery = "select aurthorize_no, approved, cpt, expiry_date from tbl_procedure where jid = '".$row[0]."'";
			$qProcedure = mysql_query($sProcedureQuery);
		
			$sAuthNo = "";
			$sApproved = "";
			$sCPT = "";
			$sExpirationDate = "";
		
			while($rowProcedure = mysql_fetch_array($qProcedure))
			{
				if ( !is_null($rowProcedure['aurthorize_no']) && (trim($rowProcedure['aurthorize_no']) != '') )
				{
					$sAuthNo .= $rowProcedure['aurthorize_no'].", ";
				}
				if (!is_null($rowProcedure['approved']))
				{
					$sApproved .= $rowProcedure['approved'].", ";
				}
				if (!is_null($rowProcedure['cpt']))
				{
					$sCPT .= $rowProcedure['cpt'].", ";
				}
				if (!is_null($rowProcedure['expiry_date']))
				{
					$sExpirationDate .= $rowProcedure['expiry_date'].", ";
				}
			}	
		
			$sAuthNo = trim($sAuthNo);
			if (strlen($AuthNo) > 1)
			{
				$sAuthNo = substr($sAuthNo, 0, strlen($AuthNo) - 1);
			}
		
			$sApproved = trim($sApproved);
			if (strlen($sApproved) > 1)
			{
				$sApproved = substr($sApproved, 0, strlen($sApproved) - 1);
			}
			
			$sCPT = trim($sCPT);
			if (strlen($sCPT) > 1)
			{
				$sCPT = substr($sCPT, 0, strlen($sCPT) - 1);
			}
			
			$sExpirationDate = trim($sExpirationDate);
			if (strlen($sExpirationDate) > 1)
			{
				$sExpirationDate = substr($sExpirationDate, 0, strlen($sExpirationDate) - 1);
			}
		
            foreach($row as $value) 
			{             
				if ((!isset($value)) OR ($value == "")) 
				{ 
					$value = "\t"; 
				} 
				else 
				{
					
					switch (mysql_field_name($export, $icountfield))
					{
						case "authorization_no":					
							$value = $sAuthNo;	
						break;
						case "approved":
							$value = $sApproved;
						break;		
						case "cpt":
							$value = $sCPT;
						break;
						case "expiration_date":
							$value = $sExpirationDate;
						break;
					}
					
					$value = str_replace('"', '""', $value); 
					$value = '"' . $value . '"' . "\t"; 									
				} 
				
				$value = stripslashes($value);
				 
				$line .= $value;
				$icountfield++;				
            } 
            $data .= trim($line)."\n"; 
        } 
        $data = str_replace("\r","",$data);
         
        if ($data == "") { 
                $data = "\n(0) Records Found!\n";                         
         }
         
        header("Content-type: application/x-msdownload"); 
        header("Content-Disposition: attachment; filename=$filename.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
        print "$header\n$data";
	}
 
?>