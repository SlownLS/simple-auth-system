<?php

use SlownLS\Auth\User;

if( isset($_POST["username"], $_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"]) ){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $boolLogged = User::Login($username, $password);

    if( $boolLogged ){
        User::addNotification("success", "Login successfully completed.");
        header("Location: ./?p=dashboard");
    } else {
        User::RedirectBack();
    }
}