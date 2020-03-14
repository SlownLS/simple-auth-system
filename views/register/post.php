<?php

use SlownLS\Auth\User;

if( isset($_POST["username"], $_POST["password"], $_POST["password_confirm"], $_POST["email"]) 
    && !empty($_POST["username"]) && !empty($_POST["password"]) 
    && !empty($_POST["password_confirm"]) && !empty($_POST["email"]) ){

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $password_confirm = htmlspecialchars($_POST["password_confirm"]);
    $email = htmlspecialchars($_POST["email"]);

    $boolRegisted = User::Register($username, $email, $password, $password_confirm);

    if( $boolRegisted ){
        header("Location: ./");
        exit();
    } else {
        User::RedirectBack();
    }
}