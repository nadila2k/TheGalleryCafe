<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./admin_css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: black;
            color: white;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .modal-content {
            background-color: black;
            color: white;
        }

        .form-control {
            background-color: black;
            color: white;
        }

        .form-control::placeholder {
            color: lightgray;
            /* Adjust placeholder text color if needed */
        }

        .form-label {
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-close {
            filter: invert(1);
        }

        .btn-close:hover {
            filter: invert(0.8);
        }

        .table-responsive img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            /* Ensures the image covers the entire 150x150 area */
        }

        /* Style for the toggle icon */
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .form-outline {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">
                                Manage Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="food.php">
                                Manage Food
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="table.php">
                                Mange table
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">
                                Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="events.php">
                                Manage Event
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>