<?php
include "../Common_Use/database_connection/database_helper.php";

$con = select_database("jmrzoleg_User");

$table_name = "ProjectNames";
$set = 'Name="'.$_POST["new_project_name"].'"';
$where = "PID=".$_POST["project"];

Update_To( $con, $table_name, $set, $where );

require_once "../Common_Use/ftp.php";

ftp_chdir($ftp_conn,"/TDS-S2");

$old_file = $_POST["old_name"];
$new_file = $_POST["new_project_name"];

ftp_rename($ftp_conn, $old_file, $new_file);

rename("../../Public_files/".$old_file,"../../Public_files/".$new_file);

header("Location: admin.php");
?>