<?php include "partials/header.php";?>



<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <h1>Welcome to <span>Restaurantly</span></h1>
                <h2>Delivering great food for more than 18 years!</h2>

                <div class="search">
                    <input type="text" id="search-input" class="form-control" placeholder="Have a question? Ask Now">
                    <a href="#menu" id="search-btn" class="btn-menu animated fadeInUp scrollto">Search</a>
                </div>

                <div class="btns">
                    <a href="#menu" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
                    <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Book a Table</a>
                </div>
            </div>


        </div>
    </div>
</section>
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
                <div class="about-img">
                    <img src="../assets/image/about.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore
                    magna aliqua.
                </p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.
                    </li>
                    <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat
                        nulla pariatur.</li>
                </ul>
                <p>
                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                </p>
            </div>
        </div>

    </div>
</section>

<section id="menu" class="menu section-bg">
    <div class="container-fluid" data-aos="fade-up" style="width: 90%;  ">

        <div class="section-title">
            <h2>Menu</h2>
            <p>Check Our Tasty Food Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="food-filter" class="menu-flters ">

                </ul>
            </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" id="item-food">

        </div>

    </div>
</section>
<section id="menu" class="menu section-bg">
    <div class="container-fluid" data-aos="fade-up" style="width: 90%;  ">

        <div class="section-title">
            <h2>Menu</h2>
            <p>Check Our Tasty Beverage Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul class="menu-flters" id="beverage-filter">
                </ul>
            </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" id="item-beverage">

        </div>

    </div>
</section>


<section id="events" class="events">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Events</h2>
            <p> Events in our Restaurant</p>
        </div>

        <div class="events-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper" id="event-Display">


            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>





<section id="book-a-table"" class=" menu section-bg">
    <div class="container-fluid" data-aos="fade-up" style="width: 90%;  ">

        <div class="section-title">
            <p>Check Our Table</p>
            <br>
            <div class="mb-3">
                <label for="datePicker" class="form-label">
                    <h2>Select a date</h2>
                </label>
                <input type="date" class="form-control" id="datePicker" placeholder="Select a date">
            </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul class="menu-flters" id="beverage-filter">
                </ul>
            </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" id="item-table">

        </div>

    </div>
</section>







<div class="modal fade" id="addPickDate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="cardAndDate">
                <div class="mb-3">
                        <label for="datePicker" class="form-label">Select a date</label>
                        <input type="date" class="form-control" id="getItemPickIpDate" placeholder="Select a date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="dineInOrTakeaway">select</label>
                        <select name="" id="dineInOrTakeaway">
                            <option value="dineIn">Dine In</option>
                            <option value="Takeaway">Take away</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="time">time</label>
                        <select name="" id="time">
                            <option value="Lunch">Lunch</option>
                            <option value="TeaTime">Tea Time</option>
                            <option value="Dinner">Dinner</option>
                        </select>
                    </div>
                    <div class="form-outline mb-4 flex-container">
                        <input type="text" class="form-control" id="cardNumber" placeholder="Card Number">
                        <img src="../assets/image/visa.png" alt="">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="cardHolderName" placeholder="Cardholder's Name">
                    </div>
                    <div class="form-outline mb-4 flex-container">
                        <input type="text" class="form-control" id="expiration" placeholder="Expiration">
                        <input type="text" class="form-control" id="Cvv" placeholder="Cvv">
                    </div>
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cardPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="payment-form">
                    <div class="mb-3">
                        <label class="form-label" for="timeItemAndTable">time</label>
                        <select name="" id="timeItemAndTable">
                            <option value="lunch">Lunch</option>
                            <option value="teaTime">Tea Time</option>
                            <option value="Diner">Diner</option>
                        </select>
                    </div>
                    <div class="form-outline mb-4 flex-container">
                        <input type="text" class="form-control" id="cardNumberCardPayment" placeholder="Card Number">
                        <img src="../assets/image/visa.png" alt="">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="cardHolderNameCardPayment"
                            placeholder="Cardholder's Name">
                    </div>
                    <div class="form-outline mb-4 flex-container">
                        <input type="text" class="form-control" id="expirationCardPayment" placeholder="Expiration">
                        <input type="text" class="form-control" id="CvvCardPayment" placeholder="Cvv">
                    </div>
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="timeForTable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="getTimeTable-form">
                    <div class="mb-3">
                        <label class="form-label" for="timeTable">time</label>
                        <select name="" id="timeTable">
                            <option value="lunch">Lunch</option>
                            <option value="teaTime">Tea Time</option>
                            <option value="Diner">Diner</option>
                        </select>
                    </div>

                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/index.js"></script>
<?php include "partials/footer.php";?>