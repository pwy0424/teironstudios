<?php
require_once "../Common_Use/header.php";
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
    
    div.but-buffer
    {
      margin-top:100px;
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
          <a class="navbar-brand" href="#">Teiron Studio</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="../Home_Page/home.php">My Home</a></li>
            <li><a href="../Project_Page/project.php">Project Portal</a></li>
            <li><a href="../Display_Page/display.php">Display</a></li>
            <li class="active"><a href="../Upload_Page/upload.php">Upload</a></li>
          </ul>

        <ul class="nav navbar-nav navbar-right">
	<?php
          if($user['email'] == "zhang@teironstudios.com" || $user['email'] == "pan@teironstudios.com" || $user['email'] == "michael@teironstudios.com")
          {
            echo "<li><a href='../Admin_Page/admin.php'>Admin Page</a></li>";
          }
        
        ?>
        
        <li><a href='?logout'>Log out</a></li>
        </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- end of navigation bar -->
    
    
    
    
    
    

    <div class="top-buffer"></div>

    <div class="container theme-showcase">
    
    <p>something</p>
	
	
	<div class="but-buffer"></div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>