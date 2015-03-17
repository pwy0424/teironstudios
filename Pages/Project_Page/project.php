<?php
require_once "../Common_Use/header.php";
require_once "../Common_Use/ftp.php";
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");
$where = "ID = '".$user["id"]."'";
$User_Group = Select_From($con, "User", "User_Group", $where);
$User_Group = $User_Group[0]["User_Group"];
	
session_start();

?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
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
    <link rel="stylesheet" href="flexslider.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="jquery.flexslider.js"></script>
    
    <script type="text/javascript" charset="utf-8">
	  $(window).load(function() {
	    $('.flexslider').flexslider();
	  });
    </script>

    <!-- Just for debugging purposes. Dont actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script type="text/javascript" src="../../jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>   
     <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
     
     <!-- jQuery dotdotdot plugin-->
     <script src="../../jQuery.dotdotdot/jquery.dotdotdot.js" type="text/javascript"></script>
     <script src="../../jQuery.dotdotdot/jquery.dotdotdot.min.js" type="text/javascript"></script>
    
    <style>
    
    .desc
    {
    	height:2em;
    	text-align:center;
    	width:80%;
    	margin-left:auto;
    	margin-right:auto;
    	white-space: nowrap;
    	text-overflow: ellipsis;
	overflow: hidden;
	
    }
    
    body, html {
	  height: 100%;
    }
    
    .bounding-box {
	  height: 80%;
	  width: 100%;
    }

    .special
    {
    	color:black;
    	text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
    }
    
    #logo .-responsive 
    {
    	max-width: 40%;
    	height: auto;
    	position: relative;
    	display:block;
    	margin:20px auto;
    }
    
 
    .carousel-inner{
    	width: 90%;
    	margin-left:auto;
    	margin-right:auto;
    	height: 100%;
    	min-height:200px;
	min-width:300px;
    }
    
    .item{
    	width: 100%;
    	height: inherit;

    }
    
    #warpper{
    	//width: auto;
    	//height: auto;
    	width:inherit;
    	max-width:100%;
    	height:auto;
    }
    .carousel-control{
    	//margin-top:275px;
    	position:fixed;
    	top:50%;
    	height:10%;
    	min-height:50px;
    	width:5%;
    	min-width:50px;
    	//margin-bottom:260px;
    }
    #arrow{
    	position:relative;
    	top:25%;
    }

    
    .go_to_display{
    	margin-top:5%;
    	
    }
 

    </style>
    

    
  </head>

  <body>

   <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
          </button>
          <img src="../../Image/whitenobg.png" alt="Logo" style="height:50px;width:auto">
          
        </div>
        <div class="navbar-collapse collapse margin-left:60px">
          <ul class="nav navbar-nav standard_text">
            <?php
                if($User_Group != 0) {echo '<li><a href="../Home_Page/home.php"><span class="glyphicon glyphicon-home"></span> My Home</a></li>';}
                echo '<li class="active"><a href="../Project_Page/project.php">Project Overview</a></li>';
            	echo '<li><a href="../Display_Page/display.php">Display</a></li>';
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
        <li>
          <a href='?logout'><span class="glyphicon glyphicon-log-out"></span> Log out</a>
        </li>
        </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- end of navigation bar -->
    
 
      <div style="height:50px"></div>   
	
 <div class="container-fluid" style="height:80%;min-height:400px">
 
      <div style="height:5%"></div>
      
       <div id="myCarousel" class="carousel slide" style="height:100%">
	<!-- Carousel items -->
		<div class="carousel-inner">
	
	<?php
 
 	$count = 0;
    	$projects = "../../Public_files/";
    	$file_list = scandir($projects);
    	
    	

	foreach($file_list as $file_or_dir)
	{
	    if($file_or_dir == "." || $file_or_dir == ".."){}
	    else{
	
	    $project_name = $file_or_dir;
	    
	    //print $project_name;
	    
	    $where = "Name = '".$project_name."'";
	    //echo $where;
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
	    //print "<br>".$flag;
	    
	    if(!$flag){}
	    else{
		   
		$local_folder = "../../Public_files/";
		
		//print $local_folder.$project_name.'/profile.png';
		
		if($count == 0){
			print '<div class="active item">';
				    
		}
		else{
			print '<div class="item">';
		}
		//get project name
		$file_name = $project_name;
		print '<div style="height:10%;text-align:center"><p class="secondary_header">'.$file_name.'</p></div>';
		$img_url = $local_folder.$project_name.'/profile.png' ;
		$img_url = str_replace(" ","%20",$img_url);
		print '<div class="bounding-box" style="background-size: contain; background-position: center; background-repeat: no-repeat;background-image:url('.$img_url.')".></div>';
		//print $img_url;
		//print '<img class="big-img" id="warpper" src="'.$local_folder.$project_name.'/profile.png" alt="Grainger Sculpture" >';// change location
		//print '<div class = "carousel-caption special">';
		//get project name & description
		
		//$description = nl2br(file_get_contents($local_folder.$project_name.'.txt'));
		
		$Projects = Select_From($con, "ProjectNames", "*", "Name='".$file_name."'");
		$description = $Projects[0]["Description"];
		
		print '<div style="height:1%"></div>';
		print '<div class="desc standard_text">'.$description.'</div>';
		//print '</div>';
		print '</div>';	
		$count++;		

							
		    
		    
		}
	    }//end of normal cases other than "." || ".."
	   
	}?>
	
	
			
		</div>
 		 <!-- Carousel nav -->
  		<a class="carousel-control left" href="#myCarousel" data-slide="prev"><div id="arrow" class="left-align">&#9668</div></a>
  		<a class="carousel-control right" href="#myCarousel" data-slide="next"><div id="arrow" class="right-align">&#9658</div></a>
	</div>
	
	
        <script>
 		 $(document).ready(function(){
   			 $('.carousel').carousel({
      				interval: 250
   			 });
 		 });

	</script>
	
	

     <!-- end of banner -->

	<div style="height:5%"></div>
  
    </div> <!-- /container-fluid -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
    <script type="text/javascript" src="../../dist/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src='../../dist/js/bootstrap.min1.js'></script>

  </body>
</html>