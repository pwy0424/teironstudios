<?php
	if(!$_GET["cfd"] && !$_SESSION["cfd"])
	{
	    $_SESSION["cfd"] = "/";
	}
	else if(!$_GET["cfd"])
	{
	    
	}
	else
	{
	    
	    $_SESSION["cfd"] = $_GET["cfd"];
	}
	
	$ftp_server = "teironstudios.asuscomm.com";
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	$ftp_username = "admin";
	//$ftp_username = "tds";
	$ftp_userpass = "tds000321";
	$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
	
?>