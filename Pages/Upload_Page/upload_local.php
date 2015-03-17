<?php
require_once "../Common_Use/header.php";
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");

$where = "ID = '".$user["id"]."'";
$User_Group = Select_From($con, "User", "User_Group", $where);
$User_Group = $User_Group[0]["User_Group"];

if($User_Group == 0) {header("Location: ../Project_Page/project.php");}
session_start();

if(!$_SESSION["local_folder"])
{
	$_SESSION["local_folder"] = "/";
}
if(!$_GET["local_folder"])
{
}
else
{
	$_SESSION["local_folder"] = $_GET["local_folder"];
}

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

    	
		if(!is_dir("../../Public_files".$_SESSION["local_folder"])) $_SESSION["local_folder"] = "/";
		
		while(strpos($_SESSION["local_folder"],"//")!==FALSE)
		{
			$_SESSION["local_folder"] = str_replace("//","/",$_SESSION["local_folder"]);
		}
		if(strrpos($_SESSION["local_folder"],"/") == strlen($_SESSION["local_folder"])-1)
		{
			if($_SESSION["local_folder"] != "/") $_SESSION["local_folder"] = substr_replace($_SESSION["local_folder"], "", strlen($_SESSION["local_folder"])-1);
		}

		$project_name = substr_replace($_SESSION["local_folder"], "", 0, 1);
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
	    	
	    	if(!$flag) $_SESSION["local_folder"] = "/";
		
			$pos = strrpos($_SESSION["local_folder"], "/");
			$parent_folder = substr_replace($_SESSION["local_folder"], "", $pos);
				if($parent_folder == "") $parent_folder = "/";
				
			
			echo '<nav class="navbar navbar-default navbar-fixed-top" style="margin-top:50px" role="navigation">';
			  echo '<div class="container-fluid">';
			    
			    echo '<div class="navbar-header">';
			   
			      echo '<ul class="nav navbar-nav standard_text">';
			      if($_SESSION["local_folder"] == "/") echo '<li><a href="upload.php">'; 	
			      else echo '<li><a href="?local_folder='.$parent_folder.'">';
				echo '<img src="../../Image/back_2.ico" alt="back" style="width:20px;height:20px">';
				echo "</a></li>";
				
				$str_buffer = $_SESSION["local_folder"];
				if($str_buffer == "/")
					$str_buffer = "";
				$str_buffer = substr_replace($str_buffer, 'Home', 0, 0);
				$str_buffer = str_replace("/", "&nbsp &#x25B8 &nbsp", $str_buffer);
				
			      echo '<li><p class="navbar-text">'.$str_buffer.'</p></li>';
			      echo '</ul>';
			    echo '</div>';
				
			  echo '</div>';
			echo '</nav>';
			
			echo '<div class="buffer"></div>';
			
			echo '<div style="height:20px;display:block"></div>';
			
			
			if($_SESSION["local_folder"] != "/")
			{
			
			      echo '<div class="jumbotron standard_text" style="height:250px;width:100%;background-color:#EAEAFF">';
				  echo '<div style="width:50%;float:left">';
				  
				  	$onsubmit = "return confirm('Do Your Really Want To Add This File?');";
					echo '<form name="ftp_file" action="local_upload_handler.php" method="post" onsubmit='.$onsubmit.' enctype="multipart/form-data">';
					echo '<p class="secondary_header">Upload File</p><br>';
					//echo '<img src="../../Image/whitenobg.png" id="upfile1" style="cursor:pointer;height:30px;width:30px">';
					//echo '<input type="file" id="file1" name="file[]" style="display:text" multiple>';
					echo '<input type="file" name="file[]" multiple>';
					echo '<input type="submit" value="Upload Selected File">';
					echo "</form>";
				  
				    echo '</div>';

			     echo '<div style="width:50%;float:left;">';

			     	$onsubmit2 = "return confirm('Do You Really Want To Create This Folder?');";
				echo '<form name="new_subfolder" action="new_local_subfolder_handler.php" method="post" onsubmit='.$onsubmit2.'>';
				echo '<p class="secondary_header">Create New Folder</p><br>';
				echo 'Enter Folder Name: <input type="text" name="subfolder_name">';
				echo '<input type="hidden" name="parent_folder" value="'.$_SESSION["local_folder"].'"> ';
				echo '<input type="submit" value="Submit">';
				echo "</form>";
	
				 echo '</div>';
				 
				 
				 
				 
			      echo '</div>';
			}
			
	
			
			
			$directory = "../../Public_files".$_SESSION["local_folder"];
			//get all files in specified directory
			$files = scandir($directory );
 			
 			$file_counter = 0;
 			$folder_counter = 0;
 			
 			foreach($files as $file)
 			{
 				if($file != "." && $file != ".." && is_dir("../../Public_files".$_SESSION["local_folder"]."/".$file))
				{
					if($_SESSION["local_folder"] == "/"){
						$project_name = $file;
	    
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
				
					}
					else
					{
						$flag = TRUE;
					}
					if($flag) $folder_counter++;
				}
				if(!is_dir("../../Public_files".$_SESSION["local_folder"]."/".$file))
				{
					$file_counter++;
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
			
			

			
			
			
 			
			//print each file name
			$counter = 0;
			foreach($files as $file)
			{
				if($file != "." && $file != ".." && is_dir("../../Public_files".$_SESSION["local_folder"]."/".$file))
				{
					if($_SESSION["local_folder"] == "/"){
						$project_name = $file;
	    
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
				
					}
					else
					{
						$flag = TRUE;
					}
					if($flag)
					{
						
						
						$directory_next = "../../Public_files".$_SESSION["local_folder"]."/".$file;
						$files_next = scandir($directory_next );
						$subfile_counter = 0;
						foreach($files_next as $file_buffer)
						{
							if($file_buffer != "." && $file_buffer != "..")
								$subfile_counter++;
						}
						
						if($subfile_counter == 0)
						{
							if($counter != 0)
								echo '<li class="divider"></li>';
							$onsubmit3 = "return confirm('Do You Really Want To Delete This Folder?')";
							echo '<li style="height:3em;width:30em;margin-left:3em;padding-top:10px">';	
							echo '<form name="delete_folder" action="delete_local_folder_handler.php" method="post" onsubmit='.$onsubmit3.'>';
							echo '<div>';
							if($_SESSION["local_folder"] == "/") echo '<a href="?local_folder=/'.$file.'">';
							else echo '<a href="?local_folder='.$_SESSION["local_folder"].'/'.$file.'">';
							echo '<img src="../../Image/Steel Closed.ico" alt="fileimg" style="width:30px;height:30px">  ';
					 		echo "&nbsp&nbsp";
							echo $file;
							echo "</a>";
							echo '  ';
							echo '<div style="margin-right:10px;float:right"><button type="submit" name="current_folder" value="'.$_SESSION["local_folder"].'/'.$file.'" style="background:white;border:none"><img src="../../Image/deletered.ico" alt="delete icon" style="width:20px;height:20px"></button></div>';
							echo '</div>';
							echo "</form>";
							echo '</li>';
							$counter++;
							
						}
						else
						{
							if($counter != 0)
								echo '<li class="divider"></li>';
							echo '<li style="height:3em;width:30em;margin-left:3em;padding-top:10px">';
							echo '<div>';
							if($_SESSION["local_folder"] == "/") echo '<a href="?local_folder=/'.$file.'">';
							else echo '<a href="?local_folder='.$_SESSION["local_folder"].'/'.$file.'">';
							echo '<img src="../../Image/Steel Closed.ico" alt="fileimg" style="width:30px;height:30px">  ';
					 		echo "&nbsp&nbsp";
							echo $file;
							echo "</a>";
							echo '</div>';
							echo '</li>';
							$counter++;
						}
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
			foreach($files as $file)
			{

				if(!is_dir("../../Public_files".$_SESSION["local_folder"]."/".$file))
				{
					if($counter != 0)
						echo '<li class="divider"></li>';
					echo '<li style="height:3em;width:30em;margin-left:3em;padding-top:10px">';
					echo "<form name=\"delete\" action=\"local_delete_handler.php\" method=\"post\" onsubmit=\"return confirm('Really Delete This File?')\">";
	    				//echo ''.$file.'<div style="margin-right:10px;float:right"><input type="hidden" name="file" value="'.$file.'">';
	    				//echo '<input type="submit" value="Delete"></div>';
	    				echo ''.$file.'<div style="margin-right:10px;float:right"><button type="submit" name="file" value="'.$file.'" style="background:white;border:none"><img src="../../Image/deletered.ico" alt="delete icon" style="width:20px;height:20px"></button></div>';
	    				echo "</form>";
	    				echo '</li>';
	    				$counter++;
				}
			}
			
			if($file_counter > 0)
			{
				echo '</ul>';
				echo '</div>';
			}

	?>
	
	<script type="text/javascript">
		$("#upfile1").click(function () {
			$("#file1").trigger('click');
		});
	</script>
	
	
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