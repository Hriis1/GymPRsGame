<?php

//Config requires
require_once "backend/config/sessionConfig.php";
require_once "backend/config/dbConfig.php";
require_once "backend/utils/dbUtils.php";


// calculate URL path to project root (the folder of this file)
$projectRoot = str_replace(
    realpath($_SERVER['DOCUMENT_ROOT']),
    '',
    realpath(__DIR__ . '/')
);

//if user is not logged in
if (!isset($_SESSION["userID"])) {
    //header("Location: " . $projectRoot . "/users/login.php");
    exit;
}