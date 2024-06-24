<?php include "partials/header.php"; ?>
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <h1>Welcome to <span>Restaurantly</span></h1>
                <h2>Delivering great food for more than 18 years!</h2>

                <div class="btns">
                    <a href="#menu" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
                    <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Book a Table</a>
                </div>
            </div>


        </div>
    </div>
</section>


<section id="menu" class="menu section-bg">
    <div class="container-fluid" data-aos="fade-up">

        <div class="section-title">
            <h2>Menu</h2>
            <p>Check Our Tasty Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="menu-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-starters">Starters</li>
                    <li data-filter=".filter-salads">Salads</li>
                    <li data-filter=".filter-specialty">Specialty</li>
                    <li data-filter=".filter-salads">Salads</li>
                    <li>Specialty</li>
                </ul>
            </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

            <div class="card" style="width: 18rem;">
                <img src="../assets/image/hero-bg.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

        </div>

    </div>
</section>

<?php include "partials/footer.php"; ?>