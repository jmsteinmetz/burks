<?php
error_reporting(0);
include("../includes/configure.php"); 
include("../includes/functions.php");

	$v = $_REQUEST['ce'];
	$q = "SELECT email FROM tbl_admin WHERE username = '".trim($v)."'";
	$q_e = mysql_query($q);
	if(mysql_num_rows($q_e)>0){
		echo "0";
	}
	else{
		echo "1";
		}
?>