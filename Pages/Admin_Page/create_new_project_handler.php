<?php
include '../Common_Use/database_connection/database_helper.php';
//include 'create_personal_log_table.php';

$con = select_database("jmrzoleg_User");

if($_POST["new_project"] != NULL)
{
    Insert_Into( $con, "ProjectNames", "Name, Code, Description","'".$_POST["new_project"]."', '".$_POST["new_project"]."', '".$_POST["new_project"]."'");
    
    $where = "Name= '".$_POST["new_project"]."'";
    $PIDs = Select_From($con, "ProjectNames", "PID", $where);
    $PID;
    foreach($PIDs as $temp)
    {
        $PID = $temp['PID'];
    }
    
    $sql_query = "ALTER TABLE Project ADD Project_".$PID." INT(1) NOT NULL";
    echo $sql_query;
    mysqli_query($con, $sql_query);
    
    

    
    $ftp_server = "teironstudios.asuscomm.com";
    $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
    $ftp_username = "admin";
    $ftp_userpass = "tds000321";
    $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

    ftp_mkdir($ftp_conn, "/TDS-S2/".$_POST["new_project"]);
    mkdir("../../Public_files/".$_POST["new_project"]);


    
    fclose($fp);
}
header("Location: admin.php");
?>