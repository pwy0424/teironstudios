<?php
require_once "../Common_Use/header.php";
include '../Common_Use/database_connection/database_helper.php';
$con = select_database("jmrzoleg_User");
$where = "ID = '".$user["id"]."'";
$User_Group = Select_From($con, "User", "User_Group", $where);
$User_Group = $User_Group[0]["User_Group"];

if($User_Group == 0) {header("Location: ../Project_Page/project.php");}

if($_SESSION['limit']<5) $_SESSION['limit'] = 5;

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

    <style>
    
   
    
 
    #smallPanel .panel
    {
    	height: 40%;
    	overflow: hidden;
    	position: relative;
    	display:block;
    }
    
    #largePanel .panel
    {	
    	height: 82%;
    	overflow: hidden;
    	position: relative;
    	display:block;
    	
    }
    
    .panel
    {
    	border-color:#002055;
    }
    
    .well #button1
    {
    	margin-left:auto;
    	margin-right:auto;
    }
    
    .panel-heading
    {
    	color:white;
    	background-color:#002055;
    }

    
    </style>


  </head>

  <body>


    <div class="buffer"></div>

    <div class="container theme-showcase">
    
    	
    
         <div class="page-header">
        <h1 class="main_header">My Projects (Personal Homepage)</h1>
      	</div>
      	
      <div id="smallPanel">
	
	<div class="row-fluid">
        
	   <div class="col-xs-6">
	          
	          <div class="panel">
	            <div class="panel-heading">
	              <h3 class="panel-title secondary_header">Updates (My Projects)</h3>
	            </div>
	            <div class="panel-body standard_text">
	              <div id="sb3">
	               
	              <?php

	              $where = "ID = '".$user[id]."'";
	         
	              $PIDs = Select_From($con, "User", "PID", $where);
	              $PID;
	              foreach($PIDs as $temp){
	              $PID = $temp['PID'];
	              }
	              
	              
	              $results = Select_From( $con, "Log", "*", null,"Time DESC");
	              $names = Select_From($con, "User", "*");

	              $i = 0;
	              $breaked = 0;
	              
	              	if ($_GET['more']){
	              	    $_SESSION['limit']+=5;
	              	}
	              
	             foreach($results as $result){
	              	//echo '<a href="#" class="alert-link">';
	              	if($i>=$_SESSION['limit']) {
	              		$breaked = 1;
	              		break 1;	
	              	}
             		echo "<p>";
	              	echo "At time: ";
	              	echo $result['Time'];
	              	echo ", User ";
	                
	                $name = Select_From($con, "User", "username", "PID = ".$result['UID']);	
	              	echo $name[0]['username'];
	              	
	         
	              	if($result['Upload'] == 0)
	              	    echo " uploaded";
	              	else 
	              	    echo " deleted";
	              	echo " file ";
	              	echo $result['Filename'];
	              	if($result['Upload'] == 0)
	              	    echo " to ";
	              	else 
	              	    echo " from ";
	              	$project_name = Select_From($con, "ProjectNames", "Name", "PID = ".$result['PID']);
	              	echo $project_name[0]['Name'];
	              	$foldername = str_ireplace("/TDS-S2/".$project_name[0]['Name'],"",$result['Folder']);
			//echo $result['Folder'];
			echo $foldername;
	              	echo "</p>";
	              	$i++;
	              }
	              
                      if($breaked == 1) echo '<p><a href="?more=1">More...</a></p>';
                      
                      echo '<br>';
	              ?>
	              
 <!-- 						div class="panel panel-default" id="myPanel">
					    <div class="panel-heading">
					      <h4 class="panel-title">
					        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					          Already Read Updates 
					        </a>
					        <button type="button" class="btn btn-default">CLEAR ALL</button>
					      </h4>
					    </div>
					    <div id="collapseOne" class="panel-collapse collapse">
					      <div class="panel-body">
					      	 
					        <p>
					        <input type="checkbox" class="toggle">
					        <button type="button" class="btn btn-default">MARK SELECTED AS UNREAD</button>
					      	<button type="button" class="btn btn-default">CLEAR SELECTED</button>
					        </p>
					        <p>
					        <input type="checkbox" name="delete" value="1" class="toggle">
						</p> 
						<p>
					        <input type="checkbox" name="delete" value="1" class="toggle">
						</p>
						<p>
					        <input type="checkbox" name="delete" value="1" class="toggle">
						</p>
						<p>
					        <input type="checkbox" name="delete" value="1" class="toggle">
						</p>
						<p>
					        <input type="checkbox" name="delete" value="1" class="toggle">
						</p>       
					      </div>
					    </div>
					  </div 
  -->   
	              </div>
	            </div>
	          </div>
	          
	<script type="text/javascript">
          jQuery(document).ready(function($) {
 		$('#sb3').slimScroll({
		  height: '90%'
		 });
		 });
     </script>
	          
	          
	          
		  <div class="panel">
	            <div class="panel-heading">
	              <h3 class="panel-title secondary_header">My Projects</h3>
	            </div>
	            <div class="panel-body standard_text">
	            <div id="sb2">
	            
	              <p>
	              <?php
	                //echo $PID;
	                
	                	  

$directory = "../Common_Use/project/";
//echo $directory;
 
//get all files in specified directory
$files = scandir($directory );
 
//print each file name
foreach($files as $file)
{
	
	if($file != "." && $file != ".." && is_dir($directory.$file)){
		//echo $file;
		$con = select_database("jmrzoleg_User");
		$where = "ID=".$user['id'];
	
		$result = mysqli_query($con,"SELECT * FROM User WHERE ".$where);
		while($row = mysqli_fetch_array($result))
		{
		
			$PID = $row['PID'];
		}
		$result = mysqli_query($con,"SELECT * FROM Project WHERE PID=".$PID);
		while($row = mysqli_fetch_array($result))
		{
			
			$flag = $row[$file];
			
		}
		//echo $flag;
		if($flag == 1){
		    print '<form action="../Display_Page/display.php" method="post">';
	            echo '<button type="submit" name="file_path" value="'
	            	.'project/'
	              	.$directory.$file."/name.txt"
	              	.'" class="btn btn-default btn-md">'
	              	.file_get_contents($directory.$file."/name.txt")	              	
	              	.'</button>';
	            print '</form>';

		}
	}
}
	              
	                echo '<br>';
	                
	              ?>	              
	              </p>
	              
	            </div>
	            </div>
	          </div>
	<script type="text/javascript">
          jQuery(document).ready(function($) {
 		$('#sb2').slimScroll({
		  height: '90%'
		 });
		 });
     </script>
	     
            </div><!-- /.col-xs-6 -->
            
        </div><!-- smallPanel -->
            
            
            
        <div id="largePanel">
        
          <div class="col-xs-6">
            
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title secondary_header">Last Project Component List</h3>
              </div>
              <div class="panel-body standard_text">
                <div id="sb">
                <p>A lot of shidtaweta  aj;oisefnal;if aefsjo;iawn ;elaw aefi;lnwaeflkf;nwa awlefk;nawefna;w naoiw;fn;aklenfa</p>
                <?php print_r($user); ?>
                <?php  ?>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <p>hahaha</p>
                <br>
                </div>
              </div>
           </div>
           
     <script type="text/javascript">
          jQuery(document).ready(function($) {
 		$('#sb').slimScroll({
		  height: '95%'
		 });
		 });
     </script>


          </div><!-- /.col-xs-6 -->


        </div><!-- largePanel -->
        
      </div>  
        
      <!-- Main jumbotron for a primary marketing message or call to action -->
	
     
     
     </div>
	



      <div class="buffer">
      </div>


    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>