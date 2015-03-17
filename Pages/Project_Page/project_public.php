<?php

	require_once "../Common_Use/header.php";
	require_once "../Common_Use/ftp.php";
	//require "file.php";
	include '../Common_Use/database_connection/database_helper.php';
	$con = select_database("jmrzoleg_User");
	
	session_start();

	ftp_chdir($ftp_conn,$_SESSION["curfolder"]);
	
	ftp_cdup($ftp_conn);


	if((!ftp_chdir($ftp_conn,$_SESSION["curfolder"])) || ($_SESSION["curfolder"] == "/"))
    	{
    		$_SESSION["curfolder"] = "/TDS-S2";
    	}

	ftp_chdir($ftp_conn,$_SESSION["curfolder"]);
	$file_list = ftp_nlist($ftp_conn, ".");

	foreach($file_list as $file_or_dir)
	{
	
	    $project_name = substr_replace($file_or_dir, "", 0, 8);
	    $pos = strpos($project_name, "/");
	    if(!$pos)
	    {
	    }
	    else $project_name = substr_replace($project_name,"", $pos);
	    //get project_name
	    
	    
	    $where = "Name = '".$project_name."'";
	    $ProjectID = Select_From($con, "ProjectNames", "PID", $where);
	    
	    $where = "ID = '".$user["id"]."'";
	    $PIDs = Select_From($con, "User", "PID", $where);
	    $PID;
	    foreach($PIDs as $temp)
	    {
	    	$PID = $temp['PID'];
	    }
	    //get user's PID
	    
	    if(!$ProjectID[0]['PID']) {$flag = 0;}
	    else
	    {
	    	$where = "PID = ".$PID;
	    	$column = "Project_".$ProjectID[0]['PID'];
	    	$flag = Select_From($con, "Project", $column, $where)[0][0];    
	    }
	    //check for administration stuff
	    //get the flag
	    
	    if(!$flag){}
	    else{
		    if(@ftp_chdir($ftp_conn, $file_or_dir))
		    {
			
			$dir_name = strrchr($file_or_dir,"/");
			$dir_name = str_ireplace("/","",$dir_name);
		 	echo '<p>'.$dir_name.'</p>';
			ftp_cdup($ftp_conn);
		    }
		    else
		    {
		    	//display nothing
		    }
	    }
	   
	}



?>