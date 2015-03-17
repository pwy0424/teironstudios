<?php
require_once "../Common_Use/header.php";

session_start();

header("Location: upload.php");

$ftp_server = "teironstudios.asuscomm.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "admin";
$ftp_userpass = "tds000321";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

$dir = $_POST["parent_folder"]."/".$_POST["subfolder_name"];

ftp_mkdir($ftp_conn,$dir);

?>