<?php

require_once "../Common_Use/header.php";

session_start();

header("Location: upload.php");

$ftp_server = "teironstudios.asuscomm.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "admin";
$ftp_userpass = "tds000321";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

ftp_rmdir($ftp_conn, $_POST["current_folder"]);

$filename = strrchr($_POST["current_folder"], "/");
$pos = strrpos($_POST["current_folder"], $filename);
$foldername = substr_replace($_POST["current_folder"], "", $pos);

$_SESSION["curfolder"] = $foldername;

?>