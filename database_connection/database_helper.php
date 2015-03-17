<?php



/*

author: Yifang
INPUT: 
$db (database name)

RETURN: 
$con (connection of that database)
*/
function Select_Database( $db ){

	//set up server and username and password for mysql
	$db_server = 'localhost';
	$db_username = 'jmrzoleg_teiron';
	$db_password = 'EvilStrawberry000321';

	$con = mysqli_connect ( $db_server, $db_username, $db_password, $db );
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}
	else{
		return $con;
	}
}//end of select database


/*
INPUT: 
1. $table_name
2. $con (connection from select_database)
3. $table_column

EX: CREATE TABLE Persons(FirstName CHAR(30),LastName CHAR(30),Age INT)

RETURN: 
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function Create_Table ( $con, $table_name, $table_column ){

	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}

	//implement the sql string
	$sql_query = "CREATE TABLE ".$table_name."(".$table_column.")";

	//execute query
	if(mysqli_query($con, $sql_query)){

		//echo "Table ".$table_name." created successfully";
		return 1;
	}
	else{

		//echo "Error creating table: " . mysqli_error($con);
		return 0;
	}

}


/*
INPUT: 
1. $con
2. $table_name
3. $table_column (the table column name)
4. $table_value (the column value)

EX: 
INSERT INTO Persons (FirstName, LastName, Age)
VALUES ("Glenn", "Quagmire",33)
$table_name = Persons
$table_column = FirstName, LastName, Age
$table_value = "Glenn", "Quagmire",33
(NOTE: all aboves are strings)

RETURN:
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function Insert_Into( $con, $table_name, $table_column, $table_value ){

	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}

	//create the query entry
	$sql_query = "INSERT INTO ".$table_name.
				 " (".$table_column.") 
				 VALUES (".$table_value.")";

	//execute the query
	if(!mysqli_query($con, $sql_query) ){

		echo "Error insert into table: " . mysqli_error($con);
		return 0;
	}
	else{

		//echo "insertion success";
		return 1;
	}

}


/*
INPUT:
1. $con
2. $table_name (the name of the table you wanna select from)
3. $table_column (the column name or operation you want to select from)
4. $where, $order_by: 2 conditions

EX:
SELECT column_name(s)
FROM table_name
WHERE FirstName="Peter"
ORDER BY column1, column2 

RETURN:
each item in array is a $row = mysqli_fetch_array($result)
*/

function Select_From( $con, $table_name, $table_column, $where=null, $order_by=null){

	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error()."\n";
		return -1;
	}

	$sql_query = "SELECT ".$table_column." FROM ".$table_name;
	//if there is a where condition
	if($where != null){
		$sql_query = $sql_query." WHERE ".$where;
	}
	//if order by condition
	if($order_by != null){
		$sql_query = $sql_query." ORDER BY ".$order_by;
	}

	//execute the query
	if(!mysqli_query($con, $sql_query) ){

		//echo "Error insert into table: " . mysqli_error($con)."\n";
		return 0;
	}
	else{

		//echo "success to get the result"."\n";
		$return_array = array();
		$result = mysqli_query($con, $sql_query);
		while($row = mysqli_fetch_array($result))
		{
			array_push($return_array, $row);
		}
		return $return_array;
		
	}

}


/*
INPUT:
1. $con
2. $table_name
3. $set (the updated value EX: "Age=36")
4. $where (the where condition)

EX:
UPDATE Persons SET Age=36
WHERE FirstName="Peter" AND LastName="Griffin"

RETURN:
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function Update_To( $con, $table_name, $set, $where ){

	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}

	$sql_query = "UPDATE ".$table_name." SET ".$set." WHERE ".$where;
	
	//execute the query
	if(!mysqli_query($con, $sql_query) ){

		//echo "Error insert into table: " . mysqli_error($con);
		return 0;
	}
	else{

		//echo "insertion success";
		return 1;
	}	

}

/*
INPUT:
1. $con： db connection
2. $i: project to add

EX:
ALTER TABLE 'Project' ADD 'Project_5' INT(1) NOT NULL 

RETURN:
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function add_new_project($con, $i){
	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}
	
	$sql_query = "ALTER TABLE  Project ADD  Project_".$i." INT( 1 ) NOT NULL";
	if(!mysqli_query($con, $sql_query) ){

		
		return 0;
	}
	else{

		
		return 1;
	}	
}


/*
INPUT
1. $con
2. $table_name
3. $where (where condition)

EX:
DELETE FROM table_name
WHERE some_column = some_value 

RETURN:
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function Delete_Entry( $con, $table_name, $where ){

		if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}

	$sql_query = "DELETE FROM ".$table_name." WHERE ".$where;
	
	//execute the query
	if(!mysqli_query($con, $sql_query) ){

		//echo "Error insert into table: " . mysqli_error($con);
		return 0;
	}
	else{

		//echo "insertion success";
		return 1;
	}	
}


/*
INPUTS:
$con: db connection
$table_id: PID of the user
TIME: TIME when change is made
USER: USER who submit the change
CONTENT: the file that changes
PROJECT: the PROJECT that changes
READ: 0 is unread, 1 is read

Ex:
Time CHAR(200),User CHAR(200),Content CHAR(200),Project INT,Read_ INT"

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

	return (Create_Table($con, "Update".$table_id, "Time CHAR(200),User CHAR(200),Content CHAR(200),Project CHAR(200),Read_ INT"));
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
function Update_All_Log_Table($con, $project, $User_Name, $File_Name){
	//echo $User_Name;
   	//echo "<br>";
   	
   	//echo $File_Name;
    	//echo "<br>";

	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}
	//First Step: get out the PID where Project_num == 1
	
	$where = $project."= 1";
	
	$result = mysqli_query($con,"SELECT PID FROM Project
WHERE ".$where);
	//Select_From($con, "Project", "PID", "Project", $where);
	
while($row = mysqli_fetch_array($result))//after getting PID, update one change log for each UpdateID
  {
  
    $ID = "Update".$row['PID'];
    //echo $ID;
    //echo "<br>";
    $time = time();
    
    //echo $ID;
    //echo "<br>";
    
    /*$sql="INSERT INTO ".$ID." (Time, User, Content, Project, Read_)
VALUES
(".date('[m/d H:i]',$time).",".$User_Name.",".$File_Name.", ".$project_num.", 0)";
    
    mysqli_query($con, $sql);
    */
    
    $value = "'".date('[m/d H:i]',$time)."', '".$User_Name."', '".$File_Name."', '".$project."', 1";
 
    /*echo $value;
    echo "<br>";
    echo "'[12/23 06:02]','Pan', 'Some_Random_Shit',1,0";
    echo "<br>";*/
    Insert_Into($con, $ID, "Time, User, Content, Project, Read_", $value);
  }
	
    
	
    return 1;	
}//end of Update_All_Log_Table

/*
INPUTS:
$con: db connection
$table_id: table that need to be cleared

Ex:
DELETE FROM UpdateX WHERE Read_ = 1

RETURN:
-1 == connection failed 
0 == query entry failed 
1 == success
*/
function Clear_Personal_Log_Table($con, $table_id){
  	if (mysqli_connect_errno($con)){

		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return -1;
	}
	//$table_name = "Update".$table_id;
	$where = "Read_ = 1";
  
  	return(Delete_Entry( $con, "Update".$table_id, $where ));
}//end of Clear_Personal_Log_Table


?>