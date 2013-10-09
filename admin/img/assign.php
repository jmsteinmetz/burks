<?php
error_reporting(0);
include("../includes/configure.php"); 
include("../includes/functions.php");

	$v = $_REQUEST['e'];
	$w = $_REQUEST['j'];
	$q = "update tbl_user set emp_id WHERE id = '".trim($v)."'";
	$q_e = mysql_query($q);
?>