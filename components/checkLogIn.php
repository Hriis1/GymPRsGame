<?php
require_once __DIR__ . "/../backend/users/userService.php";

//Get logged in user if any
$user = \UserService::getLoggedInUser($mysqli);