<?php

require_once '../Common_Use/google_api/src/Google_Client.php';
require_once '../Common_Use/google_api/src/contrib/Google_Oauth2Service.php';
require_once '../Common_Use/header.php';
include '../Common_Use/database_connection/database_helper.php';

session_start();

//echo "not dead 1";

$client = new Google_Client();
$client->setApplicationName("cs465tophatters");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client->setClientId('836192328458-0oao59e1vs8bna5tk6sp89gvidghms6j.apps.googleusercontent.com');
$client->setClientSecret('bATtcw5OeftLgdXTYrUu9P1z');
$client->setRedirectUri('http://teironstudios.com/index.php');
$client->setDeveloperKey('AIzaSyC3TUSS0CkPrS_e9-lW4r6OxAoAqFCIZV0');
$oauth2 = new Google_Oauth2Service($client);

//echo "not dead 2";

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client->revokeToken();
  unset($_SESSION['Flag']);
  header("Location: ../../index.php");
}

if ($client->getAccessToken()) {

  

  $user = $oauth2->userinfo->get();
  //print_r($user);

  if($user['email'] != "zhang@teironstudios.com" && $user['email'] != "pan@teironstudios.com" && $user['email'] != "michael@teironstudios.com" && $user['email'] != "jmtang10@gmail.com" ){
  	header("Location: ../Home_Page/home.php");
  }
  
 
 
  
  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "$email<div><img src='$img?sz=50'></div>"; //personal make up

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}
if($_SESSION['Flag'] != 1){
	header("Location: ../../index.php");
}


//INSERT INTO table_name VALUES (value1, value2, value3,...)
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
	Create_Personal_Log_Table($dbcon, $PID);
	
	Insert_Into( $dbcon, "Project", "PID", $PID );
	
	
	mysqli_close($dbcon);
    }



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
 
    <title>Teiron Studio Project Overall</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../../dist/css/submenu.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

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
    
    div.top-buffer
    {
    	margin-top:100px;
    }
    

    
    #logo .img-responsive 
    {
    	max-width: 40%;
    	height: auto;
    	position: relative;
    	display:block;
    	margin:20px auto;
    }
    

    
    .panel
    {
    	height: 50%;
      	overflow: hidden;
    	position: relative;
    	display:block;
    }

    </style>
    

    
  </head>

  <body>

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
          <a class="navbar-brand" href="#">Teiron Studio</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="../Home_Page/home.php">My Home</a></li>
            <li><a href="../Project_Page/project.php">Project Portal</a></li>
            <li><a href="../Display_Page/display.php">Display</a></li>
            <li><a href="../Upload_Page/upload.php">Upload</a></li>
          </ul>

        <ul class="nav navbar-nav navbar-right">
               <?php
          if($user['email'] == "zhang@teironstudios.com" || $user['email'] == "pan@teironstudios.com" || $user['email'] == "michael@teironstudios.com" || $user['email'] == "jmtang10@gmail.com")
          {
            echo "<li class='active'><a href='admin.php'>Admin Page</a></li>";
          }
        
        ?>
        <li><a href='?logout'>Log out</a></li>
        </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div><!--end of fixed-navbar -->



    <div class="container theme-showcase">
    
      <div class="top-buffer">

      </div>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
         <form action="admin.php" method="post">
         
		Register a new email: <input type="text" name="email"><br>
		
		
		
		<input class='btn btn-primary btn-lg' type="submit">
		
		<!-- a class='btn btn-default btn-lg' role='button' href='../Home_Page/home.php'>Back to Home</a -->
		<br>
		
	 </form>
	 
   	 <form action="create_new_project_handler.php" method="post">
         
		Create a new project: <input type="text" name="new_project"><br>
		
		
		
		<input class='btn btn-primary btn-lg' type="submit">
		
		<br>
		
	 </form>
      </div>
      
    <?php
    
    	$directory = "../Common_Use/project/";
 
//get all files in specified directory
	$files = scandir($directory );
 
//print each file name
	foreach($files as $file)
	{
	
		if($file != "." && $file != ".." && is_dir($directory.$file)){
			$filename = $directory.$file."/name.txt";
		  	$filename = file_get_contents($filename);
			echo "<h4> ".$file.": ".$filename;
	 		echo '<button class="btn btn-default" data-toggle="modal" data-target="#myModal'.$file.'"><h4>Edit Project</h4></button></h4>';
			echo '<div class="modal fade" id="myModal'.$file.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
 	  		echo '<div class="modal-dialog">';
    	  		echo '<div class="modal-content">';
      	  		echo '<div class="modal-header">';
          		echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
          		echo '<h4 class="modal-title" id="myModalLabel">'.$file.'</h4>';
      	  		echo '</div>';
      	  		echo '<div class="modal-body">';
      	  		echo "Project Name: ";
      	  		echo $filename;
      	  		echo '<form action="change_name_handler.php" method="post">';
      	  		echo 'Change Project Name to: ';
      	  		echo '<input type="hidden" name="project" value="'.$file.'">';
      	  		echo '<input type="text" name="new_project_name">';
      	  		echo '<input class="btn btn-default" type="submit">';
      	  		echo '</form>';
      	  		
      	  		echo '<br>';
      	  		echo 'subfolder list: ';
      	  		echo '<br>';
      	  		$directory2 = $directory.$file."/";
      	  		$files2 = scandir($directory2 );
      	  		foreach($files2 as $file2)
			{
			
				if($file2 != "." && $file2 != ".." && is_dir($directory.$file."/".$file2))
				{
					echo $file2;
					echo '<br>';
				}
			}
			
			echo 'Add New Subfolder: ';
      	  		echo '<form action="new_subfolder_handler.php" method="post">';
      	  		echo '<input type="hidden" name="project" value="'.$file.'">';
      	  		echo '<input type="text" name="new_subfolder_name">';
      	  		echo '<input class="btn btn-default" type="submit">';
      	  		echo '</form>';
      	  		
      	  		echo "<br>";
      	  		echo "Change Profile will Redirect to File Upload Page: ";
      	  		echo '<form action="change_profile_handler.php" method="post">';
      	  		echo '<input type="hidden" name="project" value="'.$file.'">';
      	  		echo '<input class="btn btn-default" type="submit" value="GO!">';
      	  		echo '</form>';
      	  		
      	  		
      	  		echo "<br>";
      	  		echo "Project Description:";
      	  		$description_path = $directory.$file."/description.txt";
      	  		$description = file_get_contents($description_path);
      	  		echo '<form action="new_description_handler.php" method="post">';
      	  		echo '<input type="hidden" name="project" value="'.$file.'">';
      	  		echo '<input type="text" name="new_description_name" value="'.$description.'">';
      	  		echo '<input class="btn btn-default" type="submit">';
      	  		echo '</form>';
      	  		
      	  		
			echo '</div>';
			
			
			echo '<div class="modal-footer">';
         		echo '<a class="btn btn-default" href="admin.php">Close</a>';
          		//echo '<input type="submit" class="btn btn-primary" value="Save changes">';
      	  		echo '</div>';
			
			echo '</div><!-- /.modal-content -->';
  	  		echo '</div><!-- /.modal-dialog -->';
	  		echo '</div><!-- /.modal -->';
	  		echo '</form>';
	
		}
		
	}
    
    
    ?>
    
    
    <?php
    	
    	$con = select_database("jmrzoleg_User");
    	$Names = Select_From($con, "User", "*");
    	
    	foreach($Names as $Name){
    	  $PID = $Name[PID];
	  echo "<h4> Email: ".$Name[email]." User Name: ".$Name[username];
	  echo '<button class="btn btn-default" data-toggle="modal" data-target="#myModal'.$PID.'"><h4>Edit Project</h4></button></h4>';
	  
	  echo '<div class="modal fade" id="myModal'.$PID.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
 	  echo '<div class="modal-dialog">';
    	  echo '<div class="modal-content">';
      	  echo '<div class="modal-header">';
          echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
          echo '<h4 class="modal-title" id="myModalLabel">'.$Name[email].'</h4>';
      	  echo '</div>';
      	  echo '<div class="modal-body">';
          
          echo "<p>User Name: </p>";
          echo "<p>".$Name[username]."</p>";
          echo "<br>";
      	  
      	  echo "<p>Project Access:</p>";
      	  
      	  
      	  $where = "PID=".$PID;
      	  $Projects = Select_From($con,"Project","*",$where);
      	  $flags;
      	  foreach($Projects as $Project) {$flags = $Project;}
	  echo '<form action="project_update_handler.php" method="post">';
	  echo '<input type="hidden" name="PID" value="'.$PID.'"/>';
      	      	
    	$directory = "../Common_Use/project/";
 
//get all files in specified directory
	$files = scandir($directory );
 
//print each file name
	foreach($files as $file)
	{
	
		if($file != "." && $file != ".." && is_dir($directory.$file)){
		  $flag = $flags[$file];
		  $filename = $directory.$file."/name.txt";
		  $filename = file_get_contents($filename);
		  
		  echo "<p> ".$filename.":  ";
		  echo "<br>";
      	  	  echo '<label class="radio-inline">';
  	  	  echo '<input type="radio" name="radio'.$PID.'_'.$file.'" value=1 ';
  	  	  if($flag == 1) echo 'checked';
  	  	  echo '> YES';
	  	  echo '</label>';
	  	  echo '<label class="radio-inline">';
  	  	  echo '<input type="radio" name="radio'.$PID.'_'.$file.'" value=0 ';
  	  	  if($flag == 0) echo 'checked';
  	  	  echo '> NO';
	  	  echo '</label>';
      	  	  echo "</p>";		
	
		}
	}
      	  
      	  
      	  
      	  
      	  
      	  
      	  echo '</div>';
      	  echo '<div class="modal-footer">';
          echo '<a class="btn btn-default" href="admin.php">Close</a>';
          echo '<input type="submit" class="btn btn-primary" value="Save changes">';
      	  echo '</div>';
    	  echo '</div><!-- /.modal-content -->';
  	  echo '</div><!-- /.modal-dialog -->';
	  echo '</div><!-- /.modal -->';
	  echo '</form>';
	  
	}
    
    ?>

<script type = "text/javascript">


$('.modal').on('hidden', function() {
    $(this).data('modal').$element.removeData();
    alert("Hello World!");
    document.write("Hello World!");
});

</script>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>