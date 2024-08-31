<?php
require_once 'vendor/autoload.php'; // Include the Composer autoload

use Facebook\Facebook;

session_start();

$fb = new Facebook([
  'app_id' => '1101132038048336',
  'app_secret' => 'cad12962ccf5b9117c74973c8f9eed72',
  'default_graph_version' => 'v20.0',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'pages_show_list', 'pages_read_engagement']; // Required permissions
$loginUrl = $helper->getLoginUrl('https://negcr.com/app/fb-callback.php', $permissions);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login with Facebook</title>
</head>
<body>
    <h1>Login with Facebook</h1>
    <a href="<?php echo htmlspecialchars($loginUrl); ?>">Login with Facebook</a>
</body>
</html>
