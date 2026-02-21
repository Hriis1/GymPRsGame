<?php
require_once __DIR__ . "/topScript.php";

//Get logged in user if any
$user = \UserService::getLoggedInUser($mysqli);

if (!$user) { //if no user go to log in page
    header("Location: " . $projectRoot . "/users/login.php");
    exit;
}
