<?php
require_once 'vendor/autoload.php';

use Facebook\Facebook;

session_start();

$fb = new Facebook([
  'app_id' => '1101132038048336',
  'app_secret' => 'cad12962ccf5b9117c74973c8f9eed72',
  'default_graph_version' => 'v20.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
  if (!$accessToken) {
    echo 'Login failed';
    exit();
  }

  $_SESSION['fb_access_token'] = (string) $accessToken;

  // Fetch user's profile information
  $response = $fb->get('/me?fields=id,name,picture', $accessToken);
  $user = $response->getGraphUser();
  
  // Fetch the pages managed by the user
  $pagesResponse = $fb->get('/me/accounts', $accessToken);
  $pages = $pagesResponse->getDecodedBody();

  // Store user data and pages in session
  $_SESSION['user_name'] = $user['name'];
  $_SESSION['user_picture'] = $user['picture']['url'];
  $_SESSION['pages'] = $pages['data'];
// print_r($_SESSION);
  header('Location: insights.php');
  exit();

} catch (Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit();
}
