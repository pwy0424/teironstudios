<?php
require_once "../Common_Use/header.php";
include '../Common_Use/database_connection/database_helper.php';

session_start();

header("Location: admin.php");

//$fp = fopen($_FILES["file"]["tmp_name"],"r");

//echo $_FILES["file"]["error"];

$filename = "profile.png";

move_uploaded_file($_FILES["file"]["tmp_name"],"../..".$_POST["upload_folder"]."/".$filename);


$con = select_database("jmrzoleg_User");
$where = "ID = '".$user["id"]."'";




$PIDs = Select_From($con, "User", "PID", $where);
$PID;
foreach($PIDs as $temp)
{
    $PID = $temp['PID'];
}

$time = date('[y/m/d H:i:s]',time());

$project_name = substr_replace($_POST["upload_folder"], "", 0, 14);
$pos = strpos($project_name, "/");
if(!$pos)
{
}
else $project_name = substr_replace($project_name,"", $pos);

$where = "Name = '".$project_name."'";
$ProjectID = Select_From($con, "ProjectNames", "PID", $where);

$log = $ProjectID[0]['PID'].", ".$PID.", '".$time."', '".$filename."', '".$_POST["upload_folder"]."', 0";

Insert_Into( $con, "Log", "PID, UID, Time, Filename, Folder, Upload", $log);

?>