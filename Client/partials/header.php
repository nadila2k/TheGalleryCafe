<?php include './../controller/check_session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Gallery Café</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">The Gallery Café</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="Index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
          <li class="dropdown"><a href="#"><span>Cart</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                <div class="table-responsive">
                  <table class="table table-dark table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Shopping Bag</th>
                        <th>Format</th>
                        <th>Quantity</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody id="cart-details" class="cart-body">
                    </tbody>
                    <tfoot>
                      <tr>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td id="total"></td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td><button type="button"  class="btn btn-primary btn-block btn-lg" onclick="cartSubmit()">Submit</button></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </li>

            </ul>
          </li>
          
          <li><a class="nav-link scrollto" href="#events">Events</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
          <li><a class="nav-link scrollto" href="./../controller/logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="#book-a-table" class="book-a-table-btn scrollto d-none d-lg-flex">Book a table</a>

    </div>
     
  </header>
 
  <div id="alert"></div>
 