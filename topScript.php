<?php

//Config requires
require_once __DIR__ . "/backend/config/sessionConfig.php";
require_once __DIR__ . "/backend/config/dbConfig.php";
require_once __DIR__ . "/backend/utils/dbUtils.php";

//Services
require_once __DIR__ . "/backend/users/userService.php";


// calculate URL path to project root (the folder of this file)
$projectRoot = str_replace(
    realpath($_SERVER['DOCUMENT_ROOT']),
    '',
    realpath(__DIR__ . '/')
);

//if user is not logged in
if (!isset($_SESSION["userID"])) {
    //header("Location: " . $projectRoot . "/users/login.php");
    /* echo "no user";
    exit; */
}