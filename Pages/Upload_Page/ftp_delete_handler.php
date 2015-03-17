<?php
require_once "../Common_Use/header.php";

session_start();

header("Location: upload.php");

$ftp_server = "teironstudios.asuscomm.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "admin";
$ftp_userpass = "tds000321";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);


if (ftp_delete($ftp_conn, $_POST["file"]))
  {
  echo $_POST["file"]." deleted";
  }
else
  {
  echo "Could not delete ".$_POST["file"];
  }



// close this connection and file handler
ftp_close($ftp_conn);

include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");
$where = "ID = '".$user["id"]."'";

$PIDs = Select_From($con, "User", "PID", $where);
$PID;
foreach($PIDs as $temp)
{
    $PID = $temp['PID'];
}

$time = date('[y/m/d H:i:s]',time());
$filename = strrchr($_POST["file"], "/");
$pos = strrpos($_POST["file"], $filename);
$foldername = substr_replace($_POST["file"], "", $pos);
$filename = str_ireplace("/","",$filename);

$project_name = substr_replace($_POST["file"], "", 0, 8);
$pos = strpos($project_name, "/");
$project_name = substr_replace($project_name,"", $pos);

$where = "Name = '".$project_name."'";
$ProjectID = Select_From($con, "ProjectNames", "PID", $where);

$log = $ProjectID[0]['PID'].", ".$PID.", '".$time."', '".$filename."', '".$foldername."', 1";

Insert_Into( $con, "Log", "PID, UID, Time, Filename, Folder, Upload", $log);

?>