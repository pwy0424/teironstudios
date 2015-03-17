<?php 

include "../Common_Use/database_connection/database_helper.php";

       if($_POST["email"] != null){
	require_once '../../open.php';
	mysqli_query($dbcon,"INSERT INTO User (ID, email, username, PID)
			VALUES (NULL, '".$_POST["email"]."', NULL, NULL)");
	
	$where = "email = '".$_POST["email"]."'";
	$PIDs = Select_From($dbcon, "User", "PID", $where);
	$PID;
	
	foreach($PIDs as $temp){
	   $PID = $temp['PID'];
	}
	
	Insert_Into( $dbcon, "Project", "PID", $PID );
	
	
	mysqli_close($dbcon);
    }
 

header("Location: admin.php");
   
?>