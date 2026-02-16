<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli(
        "localhost",
        "root",
        "",
        "gym_prs_game"
    );
    
    $mysqli->set_charset("utf8");

} catch (mysqli_sql_exception $e) {
    die("MySQL error: " . $e->getMessage());
} catch (\Exception $e) {
    die("General error: " . $e->getMessage());
}
