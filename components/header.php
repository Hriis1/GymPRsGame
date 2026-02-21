<?php
require_once __DIR__ . "/topScriptExtended.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPRsGame</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css">

    <!-- Custom -->
    <link rel="stylesheet" href="<?= $projectRoot ?>/assets/css/navbar.css">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark gym-navbar px-4">
            <div class="container-fluid">

                <!-- LEFT SIDE -->
                <a class="navbar-brand fw-semibold" href="<?= $projectRoot ?>/game.php">GymPRs</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">

                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $projectRoot ?>">Home</a>
                        </li>
                    </ul>

                    <!-- RIGHT SIDE -->
                    <ul class="navbar-nav ms-auto align-items-lg-center">

                        <!-- Not logged in -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Create Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Log In</a>
                        </li>

                        <!-- Logged in -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Log Out</a>
                        </li>

                        <!-- Circular Profile Icon -->
                        <li class="nav-item ms-lg-3">
                            <a href="#" class="profile-icon d-flex align-items-center justify-content-center">
                                <span>H</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>