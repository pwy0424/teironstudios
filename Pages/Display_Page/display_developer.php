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

    <div class="container theme-showcase">
    
    	<div class="page-header">
      		<h1 class="main_header">Project Display</h1>
      	</div>
     
      
      
    <div class="display_section col-xs-12 col-md-4">
        <div class="panel standard_text" style="height:700px;border:3px solid #002055">
	    <div class="panel-heading">
	        <h4 class="panel-title secondary_header">File List</h4>
	    </div>
	    	
	    <div class="panel-body" id="scroll">
		    <div style="height:20px;display:block"></div>
	

	
	        <?php
	
			ftp_chdir($ftp_conn,$_SESSION["cfd"]);
			
			
			$parent_filename = ftp_pwd($ftp_conn);
			$dir_name = strrchr($parent_filename,"/");
			$dir_name = str_ireplace("/","",$dir_name);
			
			ftp_cdup($ftp_conn);
			$grandparent_filename = ftp_pwd($ftp_conn);
			echo '<div class="img">';
				
					echo '<a href="?cfd='.($grandparent_filename).'">';
					echo '<img src="../../Image/Steel Open.ico" alt="Open File" style="width:60px;height:60px;display:block;margin-left:auto;margin-right:auto"><div class="overflow desc">'.$dir_name.' (Current Directory)</div>';
					echo "</a>";
				
			echo '</div>';
		
			if((!ftp_chdir($ftp_conn,$_SESSION["cfd"])) || ($_SESSION["cfd"] == "/"))
		    	{
		    		$_SESSION["cfd"] = "/TDS-S2";
		    	}
		
			ftp_chdir($ftp_conn,$_SESSION["cfd"]);
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
					echo '<div class="img">';
						
				 		echo '<a href="?cfd='.$file_or_dir.'"><img src="../../Image/Steel Closed.ico" alt="Closed File" style="width:60px;height:60px;display:block;margin-left:auto;margin-right:auto"><div class="overflow desc">'.$dir_name.'</div></a>';
				 		
				 	echo '</div>';
					ftp_cdup($ftp_conn);
					
				    }
				    else
				    {
				    	$dir_name = strrchr($file_or_dir,"/");
					$dir_name = str_ireplace("/","",$dir_name);
					echo '<div class="img">';
				    			echo '<form action="../Display_Page/display_developer.php?cfd='.(ftp_pwd($ftp_conn)).'" method="post">';
				    	
				    	
				    			echo '<button type="submit" name="file_path" value="'.$file_or_dir.'" style="background:transparent;border:none">';
				    	
				    			echo '<img src="../../Image/File.ico" alt="File" style="width:60px;height:60px;display:block;margin-left:auto;margin-right:auto">';
				    	
				    			echo '<div class="overflow desc" style="color:#5555FF">'.$dir_name.'</div>';
				    	
				    			echo '</button>';
				    	
				    			echo "</form>";
				    	
				    	
				    	echo '</div>';

				    }
				    
			    }
			   
			}
	
		?>
		
		
	
	    </div><!--end of panel-body-->
	    
	    <script type="text/javascript">
		 jQuery(document).ready(function($){
    			$('#scroll').slimScroll({
        			height: '95%'
   			 });
		 });
		 
		 jQuery(document).ready(function($) {
		    $(".overflow").dotdotdot({
		    		ellipsis	: '... ',
		    		wrap		: 'word',
		    		fallbackToLetter: true
		    });
		});
		
		
		 
	    </script>
	  
	 </div><!--end of panel-->
	 
	
	</div><!--end of display section-->
	
	
	<div class="display_section col-xs-12 col-md-8">
		<div class="panel standard_text" style="height:700px;border:3px solid #002055">
			<div class="panel-heading">
				<h4 class="panel-title secondary_header">
				File Display
				</h4>
			</div>
		    <div class="panel-body" style="height:95%;padding:10px">
		    
	    <?php
	  
	  	//print $_POST['file_path'];
	  	$ext = pathinfo($section_file_path, PATHINFO_EXTENSION);
	  	
	  	if($ext == "jpg" 
	  	|| $ext == "png" 
	  	|| $ext == "bmp"){
	  	    //display the image
	  	    $local_file = "temp.".$ext;
	  	    $local_fp = fopen($local_file, "w");
	  	    $d = ftp_nb_fget($ftp_conn, $local_fp, $section_file_path, FTP_BINARY);
	  	    while ($d == FTP_MOREDATA)
			  {
			  // do whatever you want
			  // continue downloading
			  $d = ftp_nb_continue($ftp_conn);
			  }
			
			if ($d != FTP_FINISHED)
			  {
			  echo "Error downloading $server_file";
			  exit(1);
			  }
		    fclose($local_fp);
		    print '<img src="temp.'.$ext.'" style="width:inherit;height:inherit;display:block;margin-left:auto;margin-right:auto">';
		    //from w3school http://www.w3schools.com/php/func_ftp_nb_fget.asp
	  	}
	  	else if($ext == "txt"
	  		|| $ext == "html"
	  		|| $ext == "php"
	  		|| $ext == "js"
	  		|| $ext == "css"){
	  		
	  		//display the image
	  	    $local_file = "temp.".$ext;
	  	    $local_fp = fopen($local_file, "w");
	  	    $d = ftp_nb_fget($ftp_conn, $local_fp, $section_file_path, FTP_BINARY);
	  	    while ($d == FTP_MOREDATA)
			  {
			  // do whatever you want
			  // continue downloading
			  $d = ftp_nb_continue($ftp_conn);
			  }
			
			if ($d != FTP_FINISHED)
			  {
			  echo "Error downloading $server_file";
			  exit(1);
			  }
		    fclose($local_fp);
	  	    print nl2br(file_get_contents("temp.".$ext));
	  		
	  	}
	  	else if($ext == ""){
	  	    print '<h2 class="secondary_header">Please click the file to display.</h2>';
	  	}
	  	else if($ext == "pdf"){
	  		$pdf = "/TDS-S2/Project Portal/test.pdf";
			$local_file = "temp.".$ext;
			$local_fp = fopen($local_file, "w");
			$d = ftp_nb_fget($ftp_conn, $local_fp, $section_file_path, FTP_BINARY);
			while ($d == FTP_MOREDATA)
			  {
			  // do whatever you want
			  // continue downloading
			  $d = ftp_nb_continue($ftp_conn);
			  }
			
			if ($d != FTP_FINISHED)
			  {
			  echo "Error downloading $server_file";
			  exit(1);
			  }
			fclose($local_fp);
	  	    print '<iframe src="temp.pdf" style="width:600px;height:600px;display:block;margin-left:auto;margin-right:auto">';
	  	}
	  	else{
	  		print "Sorry, We can not display this type of file.";
	  	}
	  
	  	ftp_close($ftp_conn);
	    ?>
		 
		</div>
		

	
	
	
	</div><!--end of panel-->
	</div><!--end of display section-->
	
	
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