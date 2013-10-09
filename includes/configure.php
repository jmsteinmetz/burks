<?php
	//error_reporting(E_ALL & ~E_NOTICE);
	set_time_limit(0);
	
	// Define Script Setup
	
	// Define our webserver variables
	// FS = Filesystem (physical) c:\www\wamp
	// WS = Webserver (virtual) http://localhost/
	
	// Current Script Name
	define('SCRIPT_NAME',substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],"/")+1));
	// Current Script WS Path
	define('SCRIPT_PATH', $_SERVER['PHP_SELF']);
	
	// You can setup testing server variables for a testing machine, such as Win32.
	//if (preg_match("/^[CDEFGHIJKL]{1}:/i", $_SERVER['DOCUMENT_ROOT'])) {
	if ($_SERVER['SERVER_NAME'] == 'burks') 
	{	
		define('TESTING_SERVER', 1); // Set to '1' to use settings for testing server
		define('HTTP_SERVER', 'http://burks/');  // testing server
		//define('DIR_FS_DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ptcl/');
		//define('DIR_WS_DOCUMENT_ROOT', HTTP_SERVER . 'adpurls/');
	} 
	else 
	{
		define('TESTING_SERVER', 0); // Web Server
		define('HTTP_SERVER', 'http://www.adpurls.com/');
		define('DIR_FS_DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
		define('DIR_WS_DOCUMENT_ROOT', HTTP_SERVER);
	} 
	define('DOMAIN_NAME', 'adpurls.com');
	define('HTTPS', false);
	
	// define our database connection
	if (TESTING_SERVER) 
	{
		define('DB_SERVER', 'localhost');
		define('DB_SERVER_USERNAME', 'root');
		define('DB_SERVER_PASSWORD', 'root');
		define('DB_DATABASE', 'burksmedical');
		define('USE_PCONNECT', 0);
		//echo "123";
	} 
	else 
	{ // Web Server
		define('DB_SERVER', 'bmcrfasystem.db.9766129.hostedresource.com');
		define('DB_SERVER_USERNAME', 'bmcrfasystem');
		define('DB_SERVER_PASSWORD', 'BmCConnie2013@');
		define('DB_DATABASE', 'bmcrfasystem');
		define('USE_PCONNECT', 0);
	}

	mysql_pconnect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
	mysql_select_db(DB_DATABASE) or die(mysql_error());

?>