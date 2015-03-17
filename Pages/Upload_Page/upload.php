<?php
require_once "../Common_Use/header.php";
require_once "../Common_Use/ftp.php";
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");

$where = "ID = '".$user["id"]."'";
$User_Group = Select_From($con, "User", "User_Group", $where);
$User_Group = $User_Group[0]["User_Group"];

if($User_Group == 0) {header("Location: ../Project_Page/project.php");}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" conte nt="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
 
    <title>Teiron Studio Project Overall</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../dist/css/submenu.css" rel="stylesheet">
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <link href="../Common_Use/styles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Dont actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script type="text/javascript" src="../../jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>   
     
    
    <style>
    
	.debug
	{
		border:2px solid black;
	}
	
    
    </style>
    

    
  </head>

  <body>

    <!-- Fixed navbar -->
        <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="../../Image/whitenobg.png" alt="Logo" style="height:3.5em;width:4em;position:fixed;left:10px">
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav standard_text">
            <?php
                if($User_Group != 0) {echo '<li><a href="../Home_Page/home.php"><span class="glyphicon glyphicon-home"></span> My Home</a></li>';}
                echo '<li><a href="../Project_Page/project.php">Project Portal</a></li>';
            	echo '<li><a href="../Display_Page/display.php">Display</a></li>';
            	if($User_Group != 0) {echo '<li class="active"><a href="../Upload_Page/upload.php">Upload</a></li>';}
            ?>
          </ul>

        <ul class="nav navbar-nav navbar-right standard_text">
	<?php
          if($User_Group == 2)
          {
            echo "<li><a href='../Admin_Page/admin.php'>Admin Page</a></li>";
          }
        
        ?>
        
        <li><a href='?logout'><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- end of navigation bar -->
    
    <div class="buffer"></div>
    
    

    <div class="container theme-showcase standard_text">
   
   
   
    	<?php
    	if((!ftp_chdir($ftp_conn,$_SESSION["curfolder"])))
    	{
    		$_SESSION["curfolder"] = "/TDS-S2";
    	}
    	
    	$project_name = substr_replace($_SESSION["curfolder"], "", 0, 8);
	$pos = strpos($project_name, "/");
	if($pos !== FALSE) $project_name = substr_replace($project_name,"", $pos);
	    
	    
	$where = "Name = '".$project_name."'";
	$ProjectID = Select_From($con, "ProjectNames", "PID", $where);
	    
	$where = "ID = '".$user["id"]."'";
	$PIDs = Select_From($con, "User", "PID", $where);
	$PID;
	foreach($PIDs as $temp)
	{
	    	$PID = $temp['PID'];
	}
	    
	if(!$ProjectID[0]['PID']) $flag = 0;
	else
	{
	    $where = "PID = ".$PID;
	    $column = "Project_".$ProjectID[0]['PID'];
	    $flag = Select_From($con, "Project", $column, $where)[0][0];    
	}
	    	
	if(!$flag && $_SESSION["curfolder"] != "/"){
	    	
	    	$_SESSION["curfolder"] = "/TDS-S2";
	    		 
	 }
	ftp_chdir($ftp_conn,$_SESSION["curfolder"]);

	if($_SESSION["curfolder"] == "/")
	{
		echo '<img src="../../Image/whitenobg.png" style="display:block;margin-left:auto;margin-right:auto;width:300px;height:300px">';
		echo '<div style="margin-left:300px;margin-right:300px">';
		echo '<div style="width:50%;float:left">';
		echo "<a href='?curfolder=/TDS-S2' style='font-size:150%;color:white'>";
		echo '<div class="color-heading" style="width:90%;margin-left:auto;margin-right:auto">Backup for Developers</div></a>';
		echo '</div>';
		echo '<div style="width:50%;float:left">';
		echo "<a href='upload_local.php' style='font-size:150%;color:white'>";
		echo '<div class="color-heading" style="width:90%;margin-left:auto;margin-right:auto">Public Present</div></a>';
		echo '</div>';
		echo '</div>';
	}
	else
	{
		ftp_cdup($ftp_conn);
		echo '<nav class="navbar navbar-default navbar-fixed-top" style="margin-top:50px" role="navigation">';
		  echo '<div class="container-fluid">';
		    
		    echo '<div class="navbar-header">';
		   
		      echo '<ul class="nav navbar-nav standard_text">';
		      echo '<li><a href="?curfolder='.(ftp_pwd($ftp_conn)).'">';
			echo '<img src="../../Image/back_2.ico" alt="back" style="width:20px;height:20px">';
			echo "</a></li>";
			
			
			//echo $_SESSION["curfolder"];
			//ftp_cdup($ftp_conn);
			//echo ftp_pwd($ftp_conn);
			
			ftp_chdir($ftp_conn,$_SESSION["curfolder"]);
			

			$str_buffer = substr(ftp_pwd($ftp_conn),1);
			$str_buffer = str_replace("TDS-S2", "Home", $str_buffer);
			$str_buffer = str_replace("/", "&nbsp &#x25B8 &nbsp", $str_buffer);
			//$url = ftp_pwd($ftp_conn);
		      //echo '<li><a href="'.$url.'"><p class="navbar-text">'.$str_buffer.'</p></a></li>';
		      echo '<li><p class="navbar-text">'.$str_buffer.'</p></li>';
		      echo '</ul>';
		    echo '</div>';
			
		  echo '</div>';
		echo '</nav>';


		echo '<div class="buffer"></div>';
		
		echo '<div style="height:20px;display:block"></div>';

	    	if($flag)
	    	{
	    	
	    
	    	
	    	
	    		echo '<div class="jumbotron standard_text" style="height:250px;width:100%;background-color:#EAEAFF">';
				  echo '<div style="width:50%;float:left">';
				  
					$onsubmit = "return confirm('Do Your Really Want To Add This File?');";
					echo '<form name="ftp_file" action="ftp_upload_handler.php" method="post" onsubmit='.$onsubmit.' enctype="multipart/form-data">';
					echo '<p class="secondary_header">Upload File</p><br>';
					echo '<input type="file" name="file[]" multiple>';
					echo '<input type="hidden" name="upload_folder" value="'.$_SESSION["curfolder"].'">';
					echo '<input type="submit" value="Upload Selected File">';
					echo "</form>";
				  
				    echo '</div>';

			     	echo '<div style="width:50%;float:left;">';

				     	$onsubmit2 = "return confirm('Do You Really Want To Create This Folder?');";
					echo '<form name="new_subfolder" action="new_subfolder_handler.php" method="post" onsubmit='.$onsubmit2.'>';
					echo '<p class="secondary_header">Create New Folder</p><br>';
					echo 'Enter Folder Name: <input type="text" name="subfolder_name">';
					echo '<input type="hidden" name="parent_folder" value="'.$_SESSION["curfolder"].'"> ';
					echo '<input type="submit" value="Submit">';
					echo "</form>";
	
				 echo '</div>';
				 
				 
				 
				 
			echo '</div>';
		}
	}
	?>

	<?php

	$file_list = ftp_nlist($ftp_conn, ".");
	$file_counter=0;
	$folder_counter = 0;
	
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
	    
	    if($flag)
	    {
	    	if(@ftp_chdir($ftp_conn, $file_or_dir))
	    	{
			$folder_counter++;
	    	}
	    	else{
	    		$file_counter++;
	    	}

	   }
	}
	
	
	
	if($folder_counter > 0)
			{
				echo '<div class="dropdown" style="width:45%;float:left">';
			      echo '<button class="btn btn-default dropdown-toggle" style="width:33em;background:white;border-radius:0px" type="button" data-toggle="dropdown">';
			        echo 'Show Folders...';
			      echo '</button>';
			      echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
			}
	
	
	
	
	$counter = 0;
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
	    
	    if($flag)
	    {
	    	if(@ftp_chdir($ftp_conn, $file_or_dir))
	    	{
	    	
	    	
	    		$subfile_counter = 0;
	    		$subfile_list = ftp_nlist($ftp_conn, ".");
	    		foreach($subfile_list as $subfile)
	    		{
	    			$subfile_counter++;
	    		}
		
			$dir_name = strrchr($file_or_dir,"/");
			$dir_name = str_ireplace("/","",$dir_name);

	    		if($counter != 0) echo '<li class="divider"></li>';
	    		
	    		$onsubmit3 = "return confirm('Do You Really Want To Delete This Folder?');";
	    		if($subfile_counter == 0)
	    			echo '<form name="delete_folder" action="delete_folder_handler.php" method="post" onsubmit='.$onsubmit3.'>';
	    		
	    		echo '<li style="height:3em;width:30em;margin-left:3em;padding-top:10px">';
				echo '<div>';	
				echo '<a href="?curfolder='.$file_or_dir.'"> ';
				echo '<img src="../../Image/Steel Closed.ico" alt="fileimg" style="width:30px;height:30px">  ';
				echo "&nbsp&nbsp";
				echo $dir_name;
				echo "</a>";
				
				
			if($subfile_counter == 0)
			{
				echo '  ';
				echo '<div style="margin-right:10px;float:right"><button type="submit" name="current_folder" value="'.$file_or_dir.'" style="background:white;border:none"><img src="../../Image/deletered.ico" alt="delete icon" style="width:20px;height:20px"></button></div>';
			}	
				
				
				
				echo '</div>';
				
			if($subfile_counter == 0)
				echo "</form>";
				
			echo '</li>';
			$counter++;
			ftp_cdup($ftp_conn);
	    	}

	   }
	}
	
	if($folder_counter > 0)
			{
				echo '</ul>';
				echo '</div>';
			}

		
	if($file_counter > 0)
			{
				echo '<div class="dropdown" style="width:45%;float:left">';
			      echo '<button class="btn btn-default dropdown-toggle" style="width:33em;background:white;border-radius:0px" type="button" data-toggle="dropdown">';
			        echo 'Show Files...';
			      echo '</button>';
			      echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
			}
		
		       
	$counter = 0;
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
	    
	    
	    if($flag)
	    {
	    	if(!@ftp_chdir($ftp_conn, $file_or_dir))
	    	{
	    		$dir_name = strrchr($file_or_dir,"/");
			$dir_name = str_ireplace("/","",$dir_name);
			if($counter != 0) echo '<li class="divider"></li>';
			
			echo '<li style="height:3em;width:30em;margin-left:3em;padding-top:10px">';
		    	echo "<form name=\"delete\" action=\"ftp_delete_handler.php\" method=\"post\" onsubmit=\"return confirm('Really Delete This File?');\">";
		    	
		    	echo ''.$dir_name.'<div style="margin-right:10px;float:right"><button type="submit" name="file" value="'.$file_or_dir.'" style="background:white;border:none"><img src="../../Image/deletered.ico" alt="delete icon" style="width:20px;height:20px"></button></div>';
		    	echo "</form>";
		    	echo '</li>';	    	
	    		$counter++;
	    		
	    	}
	   }
	   
	   		
	}
	
	if($file_counter>0)
	{
		echo '</ul>';
		echo '</div>';
	}


	ftp_close($ftp_conn);

	?>
	
	
	
	<div class="buffer"></div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>