//layout design test file
<?php

require_once '../Common_Use/google_api/src/Google_Client.php';
require_once '../Common_Use/google_api/src/contrib/Google_Oauth2Service.php';
require_once '../Common_Use/header.php';
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");

$where = "ID = '".$user["id"]."'";
$User_Group = Select_From($con, "User", "User_Group", $where);
$User_Group = $User_Group[0]["User_Group"];

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

  if($User_Group != 2){
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
    <link href="../Common_Use/styles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script type="text/javascript" src="../../jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>   
    
    <style>
    
    div.top-buffer
    {
    	margin-top:70px;
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
    
    table,th,td
    {
	border:5px solid white;
	border-collapse:collapse;
    }
    
    th,td
    {
    	padding:10px;
    	text-align:center;
    }
    
    th
    {
    	color:white;
    	background-color:#002055;
    }
    
    td
    {
    	background-color:#EAEAFF;
    }

    .cell
    {
    	height:80px;
    	vertical-align:middle;
    }
    
    button
    {
    	float:right;
    }
  

 
    .btn-primary
    {
    	background:#002055;
    	border-color: #200033;
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
          <img src="../../Image/whitenobg.png" alt="Logo" style="height:3.5em;width:4em;position:fixed;left:10px">
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav standard_text">
            <?php
                if($User_Group != 0) {echo '<li><a href="../Home_Page/home.php"><span class="glyphicon glyphicon-home"></span> My Home</a></li>';}
                echo '<li><a href="../Project_Page/project.php">Project Portal</a></li>';
            	echo '<li><a href="../Display_Page/display.php">Display</a></li>';
            	if($User_Group != 0) {echo '<li><a href="../Upload_Page/upload.php">Upload</a></li>';}
            ?>
          </ul>

        <ul class="nav navbar-nav navbar-right standard_text">
               <?php
          if($User_Group == 2)
          {
            echo "<li class='active'><a href='admin.php'>Admin Page</a></li>";
          }
        
        ?>
        <li><a href='?logout'><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div><!--end of fixed-navbar -->



    <div class="container theme-showcase">
    
      <div class="top-buffer">

      </div>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="standard_text" style="height:200px;width:1130px">
      <div class="jumbotron standard_text" style="height:200px;width:1130px;background-color:#EAEAFF;margin-left:5px">
	  <div style="width:500px;float:left">
	        <form style="margin-left:40px" action="create_new_project_handler.php" method="post">
	             	
			<p class="secondary_header">Create New Project</p><br>
			Enter project name: <input type="text" name="new_project">
			<input class='btn btn-primary btn-sm' type="submit">
		
			
	 	</form>
	    </div>
	 
     <div style="width:500px;float:left;">
   	 
	 <form style="margin-left:90px" action="new_user_handler.php" method="post">

         	
		<p class="secondary_header">Add New User</p><br>
		Enter user email: <input type="text" name="email">
		<input class='btn btn-primary btn-sm' type="submit">

		
		
		<!-- a class='btn btn-default btn-lg' role='button' href='../Home_Page/home.php'>Back to Home</a -->
		
		
	 </form>
	 </div>
      </div>
      
     
    <?php
	$con = select_database("jmrzoleg_User");
	$Projects = Select_From($con, "ProjectNames", "*");
	
	echo '<div style="width:1140px">';

	echo '<div style="width:570px;float:left">';
	echo '<table style="width:570px">';
	echo '<tr>';
	echo '<th class="cell secondary_header">Projects</th>';
	echo '</tr>';
	
	$count = 1;
	foreach($Projects as $Project)
	{
		$filename = $Project["Name"];
		echo '<tr><td class="cell">';
		echo '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myProjectModal'.$Project["PID"].'"><span class="glyphicon glyphicon-edit"></span> Edit Project</button>';
		echo "<h4 class='standard_text'> Project_".$count.": ".$filename;
		$count += 1;
		echo '</td></tr>';
		echo '<div class="modal fade" id="myProjectModal'.$Project["PID"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	 	echo '<div class="modal-dialog">';
	    	echo '<div class="modal-content">';
	      	echo '<div class="modal-header">';
          	echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
          	echo '<h4 class="modal-title" id="myModalLabel">'.$filename.'</h4>';
      	  		echo '</div>';
      	  		echo '<div class="modal-body">';
      	  		echo "Project Name: ";
      	  		echo $filename;
      	  		echo '<form action="change_name_handler.php" method="post">';
      	  		echo 'Change Project Name to: ';
      	  		echo '<input type="hidden" name="project" value="'.$Project["PID"].'">';
      	  		echo '<input type="hidden" name="old_name" value="'.$Project["Name"].'">';
      	  		echo '<input type="text" name="new_project_name">';
      	  		echo '<input class="btn btn-default" type="submit">';
      	  		echo '</form>';
      	  		
      	  		echo '<br>';
      	  		
      	  		
      	  		echo "<br>";
      	  		echo "Change Profile: ";
      	  		echo '<form name="ftp_file" action="img_upload_handler.php" method="post" onsubmit='.$onsubmit.' enctype="multipart/form-data">';
	
			echo '<input type="file" name="file">';	
			echo '<input type="hidden" name="new_file_name" value="profile.png">';
			echo '<input type="hidden" name="upload_folder" value="/Public_files/'.$filename.'">';
	


			echo "<br>";
			echo '<input type="submit" value="Submit">';
	
			echo "</form>";
      	  		echo "<br>";
      	  		
      	  		
      	  		echo "Project Code:";
      	  		echo "<br>";
      	  		echo $Project["Code"];
      	  		echo "<br>";
      	  		echo "Change to:";
      	  		echo '<form action="new_code_handler.php" method="post">';
      	  		echo '<input type="hidden" name="project" value="'.$Project["PID"].'">';
      	  		echo '<input type="text" name="new_code" value="'.$Project["Code"].'">';
      	  		echo '<input class="btn btn-default" type="submit">';
      	  		echo '</form>';
      	  		
      	  		echo "<br>";
      	  		echo "Project Description:";
      	  		echo "<br>";
      	  		echo $Project["Description"];
      	  		echo "<br>";
      	  		echo "Change to:";
      	  		echo '<form action="new_description_handler.php" method="post">';
      	  		echo '<input type="hidden" name="project" value="'.$Project["PID"].'">';
      	  		echo '<input type="text" name="new_description" value="'.$Project["Description"].'">';
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
 	echo '</table></div>';
 	
 	echo '<div style="width:570px;float:left">';
 	
 	echo '<table style="width:570px">';
 	echo '<tr><th class="cell secondary_header">Users</th></tr>';
 	
    	$Names = Select_From($con, "User", "*");
    	
    	foreach($Names as $Name){
    	  $PID = $Name[PID];
    	  echo '<tr><td class="cell">';
    	  	echo '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myUserModal'.$PID.'"><span class="glyphicon glyphicon-edit"></span> Edit Project</button>';
	  	echo "<h4 class='standard_text'>Email: ".$Name["email"];
	  	echo '<br>';
	  	echo "User Name: ".$Name["username"];
	  	
	  echo '</td></tr>';
	  
	  echo '<div class="modal fade" id="myUserModal'.$PID.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
 	  echo '<div class="modal-dialog">';
    	  echo '<div class="modal-content">';
      	  echo '<div class="modal-header">';
          echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
          echo '<h4 class="modal-title" id="myModalLabel">'.$Name["email"].'</h4>';
      	  echo '</div>';
      	  echo '<div class="modal-body">';
          
          echo "<p>User Name: </p>";
          echo "<p>".$Name["username"]."</p>";
          echo "<br>";
          echo "<p>User Group:</p>";
          
          echo '<form action="project_update_handler.php" method="post">';
          echo '<label class="radio-inline">';
	  echo '<input type="radio" name="user_group_'.$PID.'" value=0 ';
  	  if($Name["User_Group"] == 0) echo 'checked';
  	  echo '> Guest';
	  echo '</label>';
	  echo '<label class="radio-inline">';
  	  echo '<input type="radio" name="user_group_'.$PID.'" value=1 ';
  	  if($Name["User_Group"] == 1) echo 'checked';
  	  echo '> Devloper';
	  echo '</label>';
	  echo '<label class="radio-inline">';
  	  echo '<input type="radio" name="user_group_'.$PID.'" value=2 ';
  	  if($Name["User_Group"] == 2) echo 'checked';
  	  echo '> Admin';
	  echo '</label>';
          
          
          echo "<br>";
      	  
      	  echo "<p>Project Access:</p>";
      	  
      	  
      	  $where = "PID=".$PID;
      	  $Projects = Select_From($con,"Project","*",$where);
      	  $flags;
      	  foreach($Projects as $Project) {$flags = $Project;}
	  
	  echo '<input type="hidden" name="PID" value="'.$PID.'"/>';
      	      	
    	$files = Select_From($con, "ProjectNames", "*");
 
//print each file name
	foreach($files as $file)
	{
		$flag = $flags["Project_".$file["PID"]];
		$filename = $file["Name"];
		  
		echo "<p> ".$filename.":  ";
		echo "<br>";
      	  	echo '<label class="radio-inline">';
  	  	echo '<input type="radio" name="radio'.$PID.'_'.$file["PID"].'" value=1 ';
  	  	if($flag == 1) echo 'checked';
  	  	echo '> YES';
	  	echo '</label>';
	  	echo '<label class="radio-inline">';
  	  	echo '<input type="radio" name="radio'.$PID.'_'.$file["PID"].'" value=0 ';
  	  	if($flag == 0) echo 'checked';
  	  	echo '> NO';
	  	echo '</label>';
      	  	echo "</p>";		

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
	echo '</table></div>';
	echo '</div>';
	
	
	
    
    ?>

<script type = "text/javascript">


$('.modal').on('hidden', function() {
    $(this).data('modal').$element.removeData();
    alert("Hello World!");
    document.write("Hello World!");
});

</script>

	

    </div> <!-- /container -->
    
    <div class="top-buffer">

    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>