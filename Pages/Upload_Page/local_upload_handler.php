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

header("Location: upload_local.php");

$file_ary = reArrayFiles($_FILES['file']);

foreach ($file_ary as $file) 
{

$filename = $file["name"];


$success = move_uploaded_file($file["tmp_name"],"../../Public_files".$_SESSION["local_folder"]."/".$filename);

$con = select_database("jmrzoleg_User");
$where = "ID = '".$user["id"]."'";

$PIDs = Select_From($con, "User", "PID", $where);
$PID;
foreach($PIDs as $temp)
{
    $PID = $temp['PID'];
}

$time = date('[y/m/d H:i:s]',time());

$project_name = substr_replace($_SESSION["local_folder"], "", 0, 1);
$pos = strpos($project_name, "/");
if($pos !== FALSE)$project_name = substr_replace($project_name,"", $pos);

$where = "Name = '".$project_name."'";
$ProjectID = Select_From($con, "ProjectNames", "PID", $where);

$folder = "/Public_files".$_SESSION["local_folder"];
$log = $ProjectID[0]['PID'].", ".$PID.", '".$time."', '".$filename."', '".$folder ."', 0";

if($success) Insert_Into( $con, "Log", "PID, UID, Time, Filename, Folder, Upload", $log);
}
?>