<?php

include '../database_connection/database_helper.php';
require_once '../header.php';
session_start();

$con = select_database("jmrzoleg_User");

if($con != -1){
	echo "connection sucess!\n";
}
else{
	echo "failed to connect\n";
}


$x = Update_All_Log_Table($con, $_SESSION['project_upload_to'], $user['name'], $_SESSION['directory_upload_to']);

echo $_SESSION["files"];
?>