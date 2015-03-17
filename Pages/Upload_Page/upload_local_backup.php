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
		
			echo "<p>";
			
			echo "Current Directory: Public_files";
			//echo ftp_pwd($ftp_conn);
			echo $_SESSION["local_folder"];
			echo "</p>";
			
			if($_SESSION["local_folder"] != "/")
			{
				$pos = strrpos($_SESSION["local_folder"], "/");
				$parent_folder = substr_replace($_SESSION["local_folder"], "", $pos);
				if($parent_folder == "") $parent_folder = "/";
				echo '<a href="?local_folder='.$parent_folder.'">';
				echo "Parent Directory";
				echo "</a>";
				echo "<br>";
			}
			
		
		
			if($_SESSION["local_folder"] != "/"){
			$onsubmit = "return confirm('Do Your Really Want To Add This File?');";
			echo '<form name="ftp_file" action="local_upload_handler.php" method="post" onsubmit='.$onsubmit.' enctype="multipart/form-data">';
	
			echo '<input type="file" name="file[]" multiple>';	
			echo "<br>";
			echo 'Save as new file name:<input type="text" name="new_file_name">(remember to include the extension name)';
			echo "<br>";
			echo "(leave it blank will use the original file name)";
	
			echo '<input type="hidden" name="upload_folder" value="'.$_SESSION["local_folder"].'">';
	


			echo "<br>";
			echo '<input type="submit" value="Submit">';
	
			echo "</form>";
			
			echo "<br>";
			}
			
			
			if($_SESSION["local_folder"] != "/"){
			$onsubmit2 = "return confirm('Do You Really Want To Create This Folder?');";
			echo '<form name="new_subfolder" action="new_local_subfolder_handler.php" method="post" onsubmit='.$onsubmit2.'>';
			echo 'Create new folder: <input type="text" name="subfolder_name">';
			echo '<input type="hidden" name="parent_folder" value="'.$_SESSION["local_folder"].'">';
			echo '<input type="submit" value="Submit">';
			echo "</form>";
			
			echo "<br>";
			}
			
			if(strrpos($_SESSION["local_folder"], "/") !== 0){
			$onsubmit3 = "return confirm('Do You Really Want To Delete This Folder?');";
			echo '<form name="delete_folder" action="delete_local_folder_handler.php" method="post" onsubmit='.$onsubmit3.'>';
			echo '<input type="hidden" name="current_folder" value="'.$_SESSION["local_folder"].'">';
			echo '<input type="submit" value="Delete Current Folder">';
			echo "<p>";
			echo "(Only works if this folder is empty)";
			echo "</p>";
			echo "</form>";
			}
			
			$directory = "../../Public_files".$_SESSION["local_folder"];
			//get all files in specified directory
			$files = scandir($directory );
 
			//print each file name
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
						if($_SESSION["local_folder"] == "/") echo '<a href="?local_folder=/'.$file.'">';
						else echo '<a href="?local_folder='.$_SESSION["local_folder"].'/'.$file.'">';
						echo $file;
						echo "</a>";
						echo "<br>";
					}
					
					
				}
				if(!is_dir("../../Public_files".$_SESSION["local_folder"]."/".$file))
				{
					echo $file;
					echo "<form name=\"delete\" action=\"local_delete_handler.php\" method=\"post\" onsubmit=\"return confirm('Really Delete This File?');\">";
	    	
	    				echo '<input type="hidden" name="file" value="'.$file.'">';
	    				echo '<input type="submit" value="Delete">';
	    				echo "</form>";
				}
			}
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