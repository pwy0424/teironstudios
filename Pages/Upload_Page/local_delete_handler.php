<?php
require_once "../Common_Use/header.php";
session_start();

header("Location: upload_local.php");

unlink("../../Public_files".$_SESSION["local_folder"]."/".$_POST["file"]);

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

$project_name = substr_replace($_SESSION["local_folder"], "", 0, 1);
$pos = strpos($project_name, "/");
if($pos !== FALSE)$project_name = substr_replace($project_name,"", $pos);

$where = "Name = '".$project_name."'";
$ProjectID = Select_From($con, "ProjectNames", "PID", $where);

$folder = "/Public_files".$_SESSION["local_folder"];
$log = $ProjectID[0]['PID'].", ".$PID.", '".$time."', '".$_POST["file"]."', '".$folder ."', 1";

Insert_Into( $con, "Log", "PID, UID, Time, Filename, Folder, Upload", $log);


?>