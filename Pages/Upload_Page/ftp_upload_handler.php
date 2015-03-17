<?php
require_once "../Common_Use/header.php";
include '../Common_Use/database_connection/database_helper.php';

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

session_start();

header("Location: upload.php");

$ftp_server = "teironstudios.asuscomm.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "admin";
$ftp_userpass = "tds000321";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

$file_ary = reArrayFiles($_FILES['file']);

foreach ($file_ary as $file) 
{
       // print 'File Name: ' . $file['name'];
       // print 'File Type: ' . $file['type'];
       // print 'File Size: ' . $file['size'];
    

$fp = fopen($file["tmp_name"],"r");
ftp_chdir($ftp_conn, $_POST["upload_folder"]);

//echo $_FILES["file"]["error"];

if(!$_POST["new_file_name"])
{
    $filename = $file["name"];
}
else
{
    $filename = $_POST["new_file_name"];
}

$success = ftp_fput($ftp_conn, $filename, $fp, FTP_BINARY);
if ($success)
  {
  echo "Successfully uploaded ".$filename;
  }
else
  {
  echo "Error uploading ".$filename;
  }

// close this connection and file handler
fclose($fp);


$con = select_database("jmrzoleg_User");
$where = "ID = '".$user["id"]."'";


$PIDs = Select_From($con, "User", "PID", $where);
$PID;
foreach($PIDs as $temp)
{
    $PID = $temp['PID'];
}



$time = date('[y/m/d H:i:s]',time());

$project_name = substr_replace($_POST["upload_folder"], "", 0, 8);
$pos = strpos($project_name, "/");
if(!$pos)
{
}
else $project_name = substr_replace($project_name,"", $pos);

$where = "Name = '".$project_name."'";
$ProjectID = Select_From($con, "ProjectNames", "PID", $where);

$log = $ProjectID[0]['PID'].", ".$PID.", '".$time."', '".$filename."', '".$_POST["upload_folder"]."', 0";

if($filename != "") Insert_Into( $con, "Log", "PID, UID, Time, Filename, Folder, Upload", $log);
}

ftp_close($ftp_conn);
?>