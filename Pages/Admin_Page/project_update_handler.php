<?php
include "../Common_Use/database_connection/database_helper.php";

$PID = $_POST["PID"];



$set = "PID=".$PID;
	
$con = select_database("jmrzoleg_User");
$Projects = Select_From($con, "ProjectNames", "*");

foreach($Projects as $project)
{	
    $set.=", ";
    $set = $set."Project_".$project["PID"]."=".$_POST["radio".$PID."_".$project["PID"]];	

}
$table_name = "Project";
$table_name2 = "User";

$where = "PID=".$PID;
$set2 = "User_Group=".$_POST["user_group_".$PID];
Update_To( $con, $table_name, $set, $where );
Update_To($con, $table_name2, $set2, $where);

header("Location: admin.php");
?>