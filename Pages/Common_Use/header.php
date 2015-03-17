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
  //$_SESSION['limit'] = 3;
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
  $_SESSION['limit'] = 3;
  header("Location: ../../index.php");
}

if ($client->getAccessToken()) {

  

  $user = $oauth2->userinfo->get();
  //print_r($user);

  
 
  
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

$_SESSION['limit'];

?>