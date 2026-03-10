<?php
$title = 'About Us - The Auto Shoppers';
$keywords = 'car service, auto repair, car maintenance, about auto shoppers';
$description = 'Discover the legacy of The Auto Shoppers. Over 30 years of excellence in automotive repair and service in Surat.';
require 'partials/head.php';
?>

<body>
    <?php require 'partials/navbar.php'; ?>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4 about-img-col" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/about.jpg"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-danger text-uppercase">About Us</h6>
                    <h1 class="mb-4">Driving Excellence for Over <span class="text-danger">30 Years</span></h1>
                    <p class="mb-4">The Auto Shoppers is your premier destination for high-quality automotive care in
                        Surat. Founded on the principles of trust, transparency, and technical excellence, we have
                        become the go-to workshop for multi-brand vehicle service.</p>
                    <p class="mb-4">Our journey began three decades ago with a single mission: to provide unbiased and
                        standardized repairs that treat every car as if it were our own. Today, we combine traditional
                        craftsmanship with state-of-the-art diagnostic technology.</p>
                    <div class="row g-4 mb-3 pb-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Certified Mastery</h6>
                                    <span>Mechanics trained in the latest EFI and hybrid technologies.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">02</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Unbiased Precision</h6>
                                    <span>We service all major brands with specialized tools and genuine parts.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">03</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Customer Centricity</h6>
                                    <span>Award-winning service recognized for honesty and reliability.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="service.php" class="btn btn-danger py-3 px-5">Explore Services<i
                            class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Fact Start -->
    <div class="container-fluid fact bg-dark my-5 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-check fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">30</h2>
                    <p class="text-white mb-0">Years Experience</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users-cog fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">22</h2>
                    <p class="text-white mb-0">Expert Technicians</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-users fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">18423</h2>
                    <p class="text-white mb-0">Satisfied Clients</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-car fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">49742</h2>
                    <p class="text-white mb-0">Complete Projects</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->

    <?php require 'partials/footer.php'; ?>
    <?php require 'partials/whatsapp.php'; ?>
</body>

</html>