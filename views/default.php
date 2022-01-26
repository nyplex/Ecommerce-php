<!DOCTYPE html>
<html lang="en" id="html">
<head>
    <base href="http://localhost">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1"/>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/fee3njb.css">
    <link rel="stylesheet" href="css/glide.core.css">
    <link rel="stylesheet" href="css/glide.core.min.css">
    <link rel="stylesheet" href="css/glide.theme.css">
    <link rel="stylesheet" href="css/glide.theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0fd6fa10db.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/gsap.min.js"></script>
    <script type="text/javascript" src="js/TextPlugin.min.js"></script>
    <script type="text/javascript" src="js/ScrollToPlugin.min.js"></script>
    <script type="text/javascript" src="js/ScrollTrigger.min.js"></script>
    <script type="text/javascript" src="js/glide.min.js"></script>
    <script type="text/javascript" src="js/glide.js"></script>
    <script>history.scrollRestoration = "manual"</script>
    <title><?= e($title ?? "DEFAULT TITLE") ?></title>
</head>
<body>

<?php

use App\Auth;
use App\Config;
use App\Table\UserTable;

$loggedIn = Auth::check();
$pdo = Config::getPDO();
$u = new UserTable($pdo);

if($loggedIn === true) {
    $userID = (int)$_SESSION['auth'];
    $user = $u->find($userID);
    $url = $router->url('account', ['slug' => $user->getSlug(), 'id' => $user->getId()]);
    $btn = '<button style="font-size:15px"><a class="account_button" style="text-decoration:none" href="'.$url.'">ACCOUNT</a></button><form style="height:30px;display:block;align-self:center" action="'.$router->url('logout').'" method="post"><button id="logoutButton" type="submit"><i class="fas fa-sign-out-alt"></i></button></form>';
}elseif($loggedIn === false){
    $btn = '<button id="loginButton">LOGIN</button>';
}

?>


<script src="js/script.js"></script>
<?php require "templates/navbar/navbar_desktop.php" ?>
<?php require "templates/navbar/navbar_mobile.php" ?>
<?php require "templates/signIn.php" ?>
<?=  $content ?>
<?php require "templates/footer.php" ?>



</body>
</html>