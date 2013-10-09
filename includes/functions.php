<?php

function check_and_redirect_to_https()
{
	if (!$_SERVER['HTTPS']) 
	{ 
		$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
	
		header('Location:'.$url);
	}
}

function admin_login_check()
{
	if(!isset($_SESSION[username]) and ($_SESSION[username])=='')
	{
		?>
        <script>window.location='login.php';</script>
        <?php
	}
}

function front_login_check()
{
	if(!isset($_SESSION['fep_id']) and ($_SESSION['fep_id'])=='')
	{
		?>
        <script>window.location='index.php?p=logout';</script>
        <?php
	}
}
function emp_login_check()
{
	//print_r($_SESSION);
	if(!isset($_SESSION['emp_id']) or !isset($_SESSION['emp_name']))
	{
		?>
        <script>window.location='index.php';</script>
        <?php
	}
}

function ip_to_location()
{
	$return=array();
	/*echo $_SERVER['REMOTE_ADDR'];
	$url = 'http://j.maxmind.com/app/geoip.js';
	$contents = file_get_contents($url);  
	$exp = explode("function",$contents);
	foreach($exp as $val)
	{
		$exp1 = explode("()",$val);
		$return[$exp1[0]] = str_replace(array("'", ';', '{', '}', 'return'), '', $exp1[1]);
	}
	
	foreach($return as $key=>$val)
	{
		echo $key."-".$val."<br>";
	}*/
	
	return $return;
}

function detect_proxy()
{
	$flag=0;
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) || isset($_SERVER['HTTP_X_FORWARDED']) || isset($_SERVER['HTTP_FORWARDED_FOR']) ||isset($_SERVER['HTTP_VIA']) ||
	in_array($_SERVER['REMOTE_PORT'], array(8080,80,6588,8000,3128,553,554)))
	{
		$flag=1;
	}
	return $flag;
}
function random_generator($digits)
{
	srand ((double) microtime() * 10000000);

	$input = array ("A", "B", "C", "D", "E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	
	$random_generator="";
	for($i=1;$i<$digits+1;$i++)
	{ 
		if(rand(1,2) == 1)
		{
			$rand_index = array_rand($input);
			$random_generator .=$input[$rand_index];
		}
		else
		{
			$random_generator .=rand(1,10); 
		} 
	} 
	return $random_generator;
} 

function isValidURL($url)
{
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

?>