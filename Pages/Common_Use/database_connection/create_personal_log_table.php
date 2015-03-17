<?php
/*

author: Yifang
INPUTS:
$con: db connection
$talbe_id: PID of the user
TIME: TIME when change is made
USER: USER who submit the change
CONTENT: the file that changes
PROJECT: the PROJECT that changes
READ: 0 is unread, 1 is read

Ex:
CREATE TABLE Update1 (Time CHAR(200),User CHAR(200),Content CHAR(200),Project INT,Read_ INT)


RETURN:
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function Create_Personal_Log_Table($con, $table_id){
	
		
	
	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}

	return (Create_Table($con, "Update".$table_id, "Time CHAR(200),User CHAR(200),Content CHAR(200),Project INT,Read_ INT"));
}//end of Create_Personal_Log_Table


/*
INPUTS:
$con: db connection
$project_num: project get changed
$User_Name: user that changes the project
$File_Name: what the user have changed

Ex:
INSERT INTO Update1 (Time, User, Content, Project, Read_)
VALUES
([12/25 9:01], Weiyang Pan, Some_thing, 1, 0)

RETURN:
-1 == connection failed 

1 == success
*/
function Update_All_Log_Table($con, $project_num, $User_Name, $File_Name){
	echo $User_Name;
   	echo "<br>";
   	
   	echo $File_Name;
    	echo "<br>";

	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}
	//First Step: get out the PID where Project_num == 1
	
	$where = "Project_".$project_num."= 1";
	
	$result = mysqli_query($con,"SELECT PID FROM Project
WHERE ".$where);
	//Select_From($con, "Project", "PID", "Project", $where);
	
while($row = mysqli_fetch_array($result))//after getting PID, update one change log for each UpdateID
  {
    $ID = "Update".$row['PID'];
    $time = time();
    
    echo $ID;
    echo "<br>";
    
    /*$sql="INSERT INTO ".$ID." (Time, User, Content, Project, Read_)
VALUES
(".date('[m/d H:i]',$time).",".$User_Name.",".$File_Name.", ".$project_num.", 0)";
    
    mysqli_query($con, $sql);
    */
    
    $value = "'".date('[m/d H:i]',$time)."', '".$User_Name."', '".$File_Name."', ".$project_num.", 0";
    /*echo $value;
    echo "<br>";
    echo "'[12/23 06:02]','Pan', 'Some_Random_Shit',1,0";
    echo "<br>";*/
    Insert_Into($con, $ID, "Time, User, Content, Project, Read_", $value);
  }
  return 1;
}
?>