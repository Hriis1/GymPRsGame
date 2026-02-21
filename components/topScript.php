<?php
require_once __DIR__ . "/includes.php";

// calculate URL path to project root (the folder of this file)
$projectRoot = str_replace(
    realpath($_SERVER['DOCUMENT_ROOT']),
    '',
    realpath(__DIR__ . '/../')
);