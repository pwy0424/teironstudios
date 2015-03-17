<?php
include "../Common_Use/database_connection/database_helper.php";

$con = select_database("jmrzoleg_User");

$table_name = "ProjectNames";
$set = 'Code="'.$_POST["new_code"].'"';
$where = "PID=".$_POST["project"];

echo $set;

Update_To( $con, $table_name, $set, $where );

header("Location: admin.php");
?>