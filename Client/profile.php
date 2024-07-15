<?php include "../controller/check_session.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../admin/css/style.css"">
    <style>
    </style>
</head>

<body>
    <div class=" container-fluid">

    <div class="row">
        <div id="alert"></div>
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#oder">
                            You Oder
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../controller/logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Profile</h1>
            </div>

            <div class="container-xl px-4 mt-4">

                <hr class="mt-0 mb-4">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form id="form-edit-user">
                                    <input type="hidden" id="userId" />
                                    <input type="hidden" id="type" />
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Username </label>
                                        <input class="form-control" id="inputUsername" type="text"
                                            placeholder="Enter your username">
                                    </div>

                                    <div class="row gx-3 mb-3">

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="tp_number">Phone Number</label>
                                            <input class="form-control" id="tp_number" type="text"
                                                placeholder="Enter your Phone Number">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="address">Address</label>
                                            <input class="form-control" id="address" type="text"
                                                placeholder="Enter your Address">
                                        </div>
                                    </div>

                                    <div class="row gx-3 mb-3">

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="password">Password</label>
                                            <input class="form-control" id="password" type="text"
                                                placeholder="Enter your Password">
                                        </div>


                                    </div>


                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="content">
    <div id="alert"></div>
    <h2>Manage Reservation</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reservation No</th>
                    <th></th>
                    <th>Reservation Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-table">

            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<br>
<div class="container" id="item">
    <h2>Reservation Items</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reservation table Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-reservationViewItem">

            </tbody>
        </table>
    </div>
</div>
<div class="container" id="table">
    <h2>Reservation Tables</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reservation table Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-reservationViewTable">

            </tbody>
        </table>
    </div>
</div>




</div>
        </main>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="js/profile.js"></script>
    </body>

</html>
