<?php
require "../Common_Use/header.php";
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");

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
    	height: 600px;
    	width: 100%;
      	overflow: hidden;
    	position: relative;
    	display: block;
    	
    }

    .hang {
            background: none repeat scroll 0 0;
	    margin: 0;
	    padding: 0;
	    position: relative;
	    width: 100%;
	    height: 100%;
	    overflow: auto;
	    display: block;
    }
    
    .lie{
    
    	    padding: 5px;
    	    display: table-cell;
            width: 400px; /* depends on the number of columns */

    
    }
    
    .carousel-inner{
    	width: auto;
    	height: 600px;
    }
    
    .item{
    	width: 100%;
    	height: inherit;

    }
    
    #warpper{
    	width: 100%;
    	height: inherit;
    }
    .carousel-control{
    	height:inherit;
    	width:50px;
    }
    #arrow{
    	margin-top:40%;
    }
    
    .go_to_display{
    	margin-top:5%;
    	
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
          <a class="navbar-brand standard_text" style="font-size:120%" href="#"><b>Teiron Studios</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav standard_text">
            <?php
	    	$where = "ID = '".$user["id"]."'";
	    	$User_Group = Select_From($con, "User", "User_Group", $where);
	    	$User_Group = $User_Group[0]["User_Group"];
                
                if($User_Group == 1) {echo '<li><a href="../Home_Page/home.php"><span class="glyphicon glyphicon-home"></span> My Home</a></li>';}
                echo '<li><a href="../Project_Page/project.php">Project Portal</a></li>';
            	echo '<li><a href="../Display_Page/display.php">Display</a></li>';
            	if($User_Group == 1) {echo '<li class="active"><a href="../Upload_Page/upload.php">Upload</a></li>';}
            ?>
          </ul>

        <ul class="nav navbar-nav navbar-right standard_text">
        <?php
          if($user['email'] == "zhang@teironstudios.com" || $user['email'] == "pan@teironstudios.com" || $user['email'] == "michael@teironstudios.com" || $user['email'] == "jmtang10@gmail.com")
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

 <div class="container">
 
 
      <div class="top-buffer"></div>


      <div class="page-header">
        <h1 class="main_header">Project Overview</h1>
      </div>
      
       <div id="myCarousel" class="carousel slide">
	<!-- Carousel items -->
		<div class="carousel-inner">
		
			<?php 
				$count = 0;
				$dir = "../Common_Use/project/";
				$files = scandir($dir);
				foreach($files as $file){
				    if(is_dir($dir.$file) && $file != "." && $file != ".." && $file != "thumbnail"){
				    	if($count == 0){
					    print '<div class="active item">';
					    $count++;
					}
					else{
					    print '<div class="item">';
					}
					print '<img id="warpper" src="'.$dir.$file.'/profile.jpg'.'" alt="Grainger Sculpture" >';
					print '<div class = "carousel-caption">';
					//get project name & description
					$file_name = nl2br(file_get_contents($dir.$file.'/name.txt'));
					$description = nl2br(file_get_contents($dir.$file.'/description.txt'));
					print '<h1 class="secondary_header">'.$file_name.'</h1>';
					print '<p class="standard_text" style="color:white">'.$description.'</p>';
					print '</div>';
					print '</div>';	
				    }
				}
			?>
			
			<!--<div class="active item">
			    	<img id="warpper" src="image/sample1.jpg" alt="Grainger Sculpture" >
			    	<div class = "carousel-caption">
				     <h1>Project 1</h1>
				     <p>Project Description: xxx xxx</p>
				</div>
			</div>
			
			<div class="item">
				<img id="warpper" src="image/sample2.jpg" alt="Siebel" >
				<div class = "carousel-caption">
				     <h1>Project 2</h1>
				     <p>Project Description: xxx xxx</p>
				</div>
			</div>
			
			
			<div class="item">
				<img id="warpper" src="image/sample3.jpg" alt="Siebel" >
				<div class = "carousel-caption">
				     <h1>Project 3</h1>
				     <p>Project Description: xxx xxx</p>
				</div>
			</div>
			
			<div class="item">
				<img id="warpper" src="image/sample4.jpg" alt="Siebel" >
				<div class = "carousel-caption">
				     <h1>Project 4</h1>
				     <p>Project Description: xxx xxx</p>
				</div>
			</div>-->
			
			
		</div>
 		 <!-- Carousel nav -->
  		<a class="carousel-control left" href="#myCarousel" data-slide="prev"><div id="arrow">&#9668</div></a>
  		<a class="carousel-control right" href="#myCarousel" data-slide="next"><div id="arrow">&#9658</div></a>
	</div>
        <script>
 		 $(document).ready(function(){
   			 $('.carousel').carousel({
      				interval: 250
   			 });
 		 });

	</script>
	
	<div class="go_to_display">
	    <form action="../Display_Page/display.php" method="post">
	<?php
	$dir = "../Common_Use/project/";
	$files = scandir($dir);
	$counter = 0;
	print '<div class="btn-group">';
	foreach($files as $file){
	    if(is_dir($dir.$file) && $file != "." && $file != ".." && $file != "thumbnail"){
	        $file_name = nl2br(file_get_contents($dir.$file.'/name.txt'));
	        if($counter%2==0)
			print '<button type="submit" name="file_path" value="'.$dir.$file.'" class="btn btn-primary btn-lg standard_text" style="color:white">'.$file_name.'</button>';
		else
			print '<button type="submit" name="file_path" value="'.$dir.$file.'" class="btn btn-success btn-lg standard_text" style="color:white">'.$file_name.'</button>';
		
		$counter++;
	    }
	}
	print '</div>';
	?>
	    
	    <!--<button type="submit" name="file_path" value="../Common_Use/project/Project_1" class="btn btn-default btn-lg">Project 1</button>
	    <button type="submit" name="file_path" value="../Common_Use/project/Project_2" class="btn btn-default btn-lg">Project 2</button>
	    <button type="submit" name="file_path" value="../Common_Use/project/Project_3" class="btn btn-default btn-lg">Project 3</button>
	    <button type="submit" name="file_path" value="../Common_Use/project/Project_4" class="btn btn-default btn-lg">Project 4</button>
	    </form>-->
	</div>

     <!-- end of banner -->
      
     <div class="top-buffer"></div>

  
    </div> <!-- /container -->


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