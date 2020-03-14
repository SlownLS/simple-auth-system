<?php

require "database.php";
require "vendor/autoload.php";

use SlownLS\Auth\User;

User::SetDatabase($db);

$pages = [
    "index" => [ 
        "title" => "Login",
    ],
    "register" => [ 
        "title" => "Register",
    ],
    "dashboard" => [ 
        "title" => "Dashboard",
    ],
    "logout" => [ 
        "title" => "Logout",
    ]
];

$page = "index";

if( isset($_GET["p"]) && !empty($_GET["p"]) ){
    $page = htmlspecialchars($_GET["p"]);
}

if( !isset($pages[$page]) ){
    $page = "index";
}

if( $page == "dashboard" && !User::IsLogged() ) {
    $page = "index";
}

if( isset($_POST) && !empty($_POST) ){
    if( file_exists("views/$page/post.php") ){
        require "views/$page/post.php";
    }
}

ob_start();

require "views/$page/view.php";

$content = ob_get_clean();

$title = $pages[$page]["title"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlownLS | <?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./">SlownLS | Simple Auth System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?p=register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    

    <div class="h-100 row align-items-center">
        <div class="container">
            <h3 class="text-center mb-5"><?= $title ?></h3>

            <?php if( User::HasNotifications() ){ ?>
                <?php foreach(User::GetNotifications() as $key => $value){ ?>
                    <div class="alert alert-<?= $value["type"] ?>">
                        <?= $value["message"] ?>
                    </div>

                    <?php User::DestroyNotification($key); ?>
                <?php } ?>
            <?php } ?>

            <?= $content ?>
        </div>
    </div>
</body>
</html>