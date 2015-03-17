<?php
	if(!$_GET["curfolder"] && !$_SESSION["curfolder"])
	{
	    $_SESSION["curfolder"] = "/";
	}
	else if(!$_GET["curfolder"])
	{
	    
	}
	else
	{
	    
	    $_SESSION["curfolder"] = $_GET["curfolder"];
	}
	
	$ftp_server = "teironstudios.asuscomm.com";
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	$ftp_username = "admin";
	$ftp_userpass = "tds000321";
	$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
	
?>