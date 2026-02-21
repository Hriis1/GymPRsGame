<?php

require_once __DIR__ . "/userService.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST["action"] ?? "") == "registerUser") { //register user
        $username = $_POST["username"] ?? "";
        $email = $_POST["email"] ?? "";
        $pass = $_POST["password"] ?? "";
        $passConf = $_POST["password_confirm"] ?? "";

        $res = \UserService::registerUser($username, $email, $pass, $passConf, $mysqli);
        echo $res;
        exit;
    }

    if (($_POST["action"] ?? "") == "logInUser") { //log in user
        $username = $_POST["username"] ?? "";
        $pass = $_POST["password"] ?? "";
        $remember = isset($_POST["remember"]);

        $res = \UserService::validateAndLogInUser($username, $pass, $remember,$mysqli);
        echo $res;
        exit;
    }
}