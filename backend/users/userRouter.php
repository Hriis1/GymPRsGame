<?php

require_once __DIR__ . "/userService.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST["action"] ?? "") == "registerUser") { //register user
        $username = $_POST["username"] ?? "";
        $email = $_POST["email"] ?? "";
        $pass = $_POST["password"] ?? "";
        $passConf = $_POST["password_confirm"] ?? "";

        $res = \UserService::register($username, $email, $pass, $passConf, $mysqli);
        echo $res;
    }
}