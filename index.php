<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
require_once 'google_api/src/Google_Client.php';
require_once 'google_api/src/contrib/Google_Oauth2Service.php';
require_once 'connection.php';



session_start();

$client = new Google_Client();
$client->setApplicationName("cs465tophatters");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client->setClientId('836192328458-0oao59e1vs8bna5tk6sp89gvidghms6j.apps.googleusercontent.com');
$client->setClientSecret('bATtcw5OeftLgdXTYrUu9P1z');
$client->setRedirectUri('http://teironstudios.com/index.php');
$client->setDeveloperKey('AIzaSyC3TUSS0CkPrS_e9-lW4r6OxAoAqFCIZV0');
$oauth2 = new Google_Oauth2Service($client);

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
    unset($_SESSION['Flag']);
  $client->revokeToken();
}

if ($client->getAccessToken()) {

  

  $user = $oauth2->userinfo->get();
  //print_r($user);

  
  //insert database SELECTION here
  //$user[email]
  $flag = null; //not in
  $_SESSION['Flag'] = 0;
  while($row = mysqli_fetch_array($result))
  {
    if ($user[email] == $row['email']){
    	$flag = $row;
    	$_SESSION['Flag'] = 1;
    }
    
    //echo "<p>blank</p>" . $flag . "<br>";
  }
  
  require_once 'open.php';
  
  if($flag){
  	echo "<p>successfully logged in!</p>" . "<br>";
  	if($flag['ID'] == null){
  		print_r($user);
  		echo("User ID is: ".$user[id]);
  		mysqli_query($dbcon,"UPDATE User SET ID='".$user[id].
		"' WHERE email='".$user[email]."'");
		mysqli_query($dbcon,"UPDATE User SET username='".$user[name].
		"' WHERE email='".$user[email]."'");

		//print_r($dbcon);
		mysqli_close($dbcon);
		header("Location: Pages/Home_Page/home.php");
		//echo("1.session ID is:". $SESSION['ID']);
  	}
  	elseif($flag['ID'] == $user[id]){
  		mysqli_close($dbcon);
  		header("Location: Pages/Home_Page/home.php");
  		//echo("2.session ID is:". $SESSION['ID']);
  	}
  		
  	else{	//hacking
  		$_SESSION['Flag'] = 0;
  		mysqli_close($dbcon);
  		header("Location: fail.php");
  	
  	}
  	
  	
  	
  }
  elseif($flag == null){
  	//echo "<p>Sorry, you are not our user, please connect to admin.</p>" . "<br>";
  	mysqli_close($dbcon);
  	header("Location: fail.php");
  }
  
  
  
  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "$email<div><img src='$img?sz=50'></div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
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

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <link href="Pages/Common_Use/styles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script type="text/javascript" src="jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>   
    
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
    
    a
    {
    	font-family:'Open Sans', sans-serif;
    	font-size:100%:
    	color:white;
    }
    
    body
    {
    	background-color:black;
    }


    </style>
    

    
  </head>

  <body>



    <div class="container theme-showcase" style="height:100%;width:100%;margin-top:5%">


      

     
     	<div>
          <img src="/Image/whitenobg.png" style="height:400px;min-height:200px;width:400px;min-width:200px;display:block;margin-left:auto;margin-right:auto">
      
         
         
        <?php if(isset($personMarkup)): ?>
	<?php print $personMarkup ?>
	<?php endif ?>
	<?php
	print "<div style='text-align:center'>";
	  if(isset($authUrl)) {
 	   print "<a class='btn btn-primary btn-lg' role='button' href='$authUrl'>Login with Google Account</a>";
 	 } else {
 	  print "<a class='btn btn-primary btn-lg' role='button' href='?logout'>Logout</a>";
 	 }
 	 print "</div>";
	?>
	
	  
         
        
 






	
        </div>

      

    </div> <!-- container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>