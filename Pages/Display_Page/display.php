<?php
require_once "../Common_Use/header.php";
require_once "../Common_Use/ftp_display.php";
//require "file.php";
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");

$where = "ID = '".$user["id"]."'";
$User_Group = Select_From($con, "User", "User_Group", $where);
$User_Group = $User_Group[0]["User_Group"];

if($User_Group == 0){
header('Location: display_public.php');
}

//path gathering
if(isset($_POST['file_path'])){
    $section_file_path = $_POST['file_path'];
}
else{
    $section_file_path = "";
}
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
     
     <script src="../../jQuery.dotdotdot/jquery.dotdotdot.js" type="text/javascript"></script>
     <script src="../../jQuery.dotdotdot/jquery.dotdotdot.min.js" type="text/javascript"></script>
    
    <style>

    
    .panel
    {
    	overflow:hidden;
    	position:relative;
    	display:block;
    }
    
    
    .btn
    {
    	margin-left:20px;
    }
    
    a:hover
    {
    	text-decoration:none;
    }
    
    div.img
    {
	  height:105px;
	  width:33%;
	  float:left;
	  text-align:center;
    }
    
    div.img img
    {
	display:inline;
    }
    
    .desc
    {
    	width:70px;
    	height:50px;
    	font-size:11px;
    	margin-left:auto;
    	margin-right:auto;
    }
    
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
            	echo '<li class="active"><a href="../Display_Page/display.php">Display</a></li>';
            	if($User_Group != 0) {echo '<li><a href="../Upload_Page/upload.php">Upload</a></li>';}
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

    <div class="container theme-showcase standard_text" style="width:100%">
    
    	<img src="../../Image/whitenobg.png" style="display:block;margin-left:auto;margin-right:auto;width:300px;height:300px">
    	<div style="margin-left:400px;margin-right:400px">
		<div style="width:50%;float:left">
			<a href='display_developer.php' style='font-size:150%;color:white'>
				<div class="color-heading" style="width:90%;margin-left:auto;margin-right:auto">Backup for Developers</div></a>
		</div>
		<div style="width:50%;float:left">
			<a href='display_public.php' style='font-size:150%;color:white'>
				<div class="color-heading" style="width:90%;margin-left:auto;margin-right:auto">Public Present</div></a>
		</div>
	</div>
	
	
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