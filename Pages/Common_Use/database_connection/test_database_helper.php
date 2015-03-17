<?php

/*
author: Pan,
this file is to update all personal logs on all tables
*/

include 'database_helper.php';
//include 'create_personal_log_table.php';

$con = select_database("jmrzoleg_User");

if($con != -1){
	echo "connection sucess!\n";
}
else{
	echo "failed to connect\n";
}

echo "test";
//$status = Create_Personal_Log_Table($con, 15);

$status = Update_All_Log_Table($con, 1, 'Yifang', 'Some_Even_Worse_Shit');
echo "update :".$status;
//$status = Create_Table($con, "Update1", "FirstName CHAR(200),LastName CHAR(30),Age INT,Read_ INT");
//echo "select from table: ".$status;
/*
while($row = mysqli_fetch_array($status))
  {
  echo $row['PID'];
  echo "<br>";
  }
*/
//$status = Insert_Into($con, "Update2", "Time, User, Content, Project, Read_", "'[12/23 06:02]','Pan', 'Some_Random_Shit',1,0");
//echo "insert: ".$status."\n";

/*
$status = Update_To($con, "test_table", "LastName = 'matlock'", "FirstName = 'josh'");
echo "update success\n";


$status = Delete_Entry($con, "test_table", "FirstName = 'josh'");

$result = Select_From($con, "test_table", "*", "FirstName = 'josh'");
print_r($result);
*/
?>