<?php
include "../Common_Use/database_connection/database_helper.php";

$con = select_database("jmrzoleg_User");

$table_name = "ProjectNames";
$set = 'Description="'.$_POST["new_description"].'"';
$where = "PID=".$_POST["project"];

echo $set;

Update_To( $con, $table_name, $set, $where );

header("Location: admin.php");
?>