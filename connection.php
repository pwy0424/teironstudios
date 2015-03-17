<?php
	/**
 	 * this is the file that only contains the connection to SQL:
 	 * reference: http://php.net/manual/en/function.mysql-connect.php
 	 * reference: my old project: Apartment Explorer
 	 * 		http://aptexplorer.web.engr.illinois.edu/tenant_menu.php
 	 */
 	
 	$dbcon = @mysqli_connect("localhost", "jmrzoleg_teiron", "EvilStrawberry000321", "jmrzoleg_User");
		if(! $dbcon)
		{
			echo("<P>Unable to connect to database.</P>");
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
	//	if(! @mysqli_select_db("ddbuilder_Character", $dbcon))
	//	{
	//		echo("<P>Unable to open database.</P>");
	//		exit();
	//	}
		
		//echo("<p>yay finally connected server</p>");
		$result = mysqli_query($dbcon,"SELECT * FROM User");
		
		//  		echo("<p>result from result:</p>");
		//while($row = mysqli_fetch_array($result))
		 // {
		 // echo "email: ". $row['email'] . "; PID: " . $row['PID'];
		 // echo "<br>";
		 // }

				//mySQL operation
		
	mysqli_close($dbcon);
?>