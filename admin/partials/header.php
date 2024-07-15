<?php include './../controller/check_session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar" id="navBar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">
                                <i class="fas fa-list-alt"></i> Manage Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="food.php">
                                <i class="fas fa-hamburger"></i> Manage Food and Beverage
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="table.php">
                                <i class="fas fa-chair"></i> Manage Table
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">
                                <i class="fas fa-users"></i> Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="events.php">
                                <i class="fas fa-calendar-alt"></i> Manage Event
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./../controller/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>