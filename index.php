<?php
$title = 'The Auto Shoppers - Standardized Multi-Brand Car Service';
$keywords = 'car service surat, auto repair adajan, multi-brand car service, standardized car repair';
$description = 'The Auto Shoppers - Surat\'s premier standardized multi-brand car service workshop. Specialized in EFI diagnostics, engine repair, and expert maintenance.';
require 'partials/head.php';
?>

<body>
    <?php require 'partials/navbar.php'; ?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-bg-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">Professional Car
                                        Service</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Expert Care for Your
                                        Vehicle</h1>
                                    <p class="text-white mb-4 animated slideInDown">Quality service, trusted mechanics,
                                        and genuine parts. Your car deserves the best!</p>
                                    <div class="carousel-btn-group animated slideInDown">
                                        <a href="booking.php" class="btn btn-danger py-3 px-5">Book Now</a>
                                        <a href="service.php" class="btn btn-light py-3 px-5">Our Services</a>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="img/caroselcar.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-bg-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">Certified
                                        Technicians</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Multi-Brand Service
                                        Center</h1>
                                    <p class="text-white mb-4 animated slideInDown">From routine maintenance to complex
                                        repairs, we handle it all with precision and care.</p>
                                    <div class="carousel-btn-group animated slideInDown">
                                        <a href="booking.php" class="btn btn-danger py-3 px-5">Book Now</a>
                                        <a href="contact.php" class="btn btn-light py-3 px-5">Contact Us</a>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="img/caroselcar.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Service Highlights Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-certificate fa-3x text-danger flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Quality Servicing</h5>
                            <p>Standardized repairs using modern diagnostics and genuine parts.</p>
                            <a class="text-secondary border-bottom" href="service.php">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex bg-light py-5 px-4">
                        <i class="fa fa-users-cog fa-3x text-danger flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Expert Workers</h5>
                            <p>Certified mechanics trained in the latest EFI & Hybrid technologies.</p>
                            <a class="text-secondary border-bottom" href="team.php">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-tools fa-3x text-danger flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Modern Equipment</h5>
                            <p>Specialized tools for all major automotive brands.</p>
                            <a class="text-secondary border-bottom" href="about.php">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Highlights End -->

    <!-- Brands We Service Start -->
    <div class="container-fluid brands-section py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center mb-4">
                <h6 class="text-danger text-uppercase">Multi-Brand Service</h6>
                <h1 class="mb-2">Car Brands We Service</h1>
                <p class="text-muted">From budget hatchbacks to luxury sedans — we service them all</p>
            </div>
        </div>
        <div class="brands-marquee-wrapper">
            <!-- Row 1: scrolls left -->
            <div class="brands-track brands-track-left">
                <?php
                $cdn = 'https://cdn.jsdelivr.net/gh/filippofilip95/car-logos-dataset@master/logos/optimized';
                // Logos that are dark/black — need invert in dark mode instead of showing original color
                $dark_logos = ['audi', 'nissan', 'jaguar', 'land-rover', 'mercedes-benz'];
                $brands_row1 = [
                    ['Maruti Suzuki', 'suzuki'],
                    ['Hyundai',       'hyundai'],
                    ['Tata',          'tata'],
                    ['Mahindra',      'mahindra'],
                    ['Kia',           'kia'],
                    ['Renault',       'renault'],
                    ['Nissan',        'nissan'],
                    ['Honda',         'honda'],
                    ['Toyota',        'toyota'],
                    ['Volkswagen',    'volkswagen'],
                    ['Skoda',         'skoda'],
                    ['MG',            'mg'],
                    ['Jeep',          'jeep'],
                ];
                // Duplicate for seamless loop
                $brands_row1 = array_merge($brands_row1, $brands_row1);
                foreach ($brands_row1 as $brand): ?>
                    <div class="brand-card<?= in_array($brand[1], $dark_logos) ? ' logo-dark-brand' : '' ?>">
                        <img src="<?= $cdn ?>/<?= $brand[1] ?>.png"
                             alt="<?= $brand[0] ?>"
                             onerror="this.style.display='none'">
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Row 2: scrolls right -->
            <div class="brands-track brands-track-right mt-3">
                <?php
                $brands_row2 = [
                    ['Ford',        'ford'],
                    ['BMW',         'bmw'],
                    ['Mercedes',    'mercedes-benz'],
                    ['Audi',        'audi'],
                    ['Volvo',       'volvo'],
                    ['Land Rover',  'land-rover'],
                    ['Porsche',     'porsche'],
                    ['Jaguar',      'jaguar'],
                    ['Lexus',       'lexus'],
                    ['MINI',        'mini'],
                    ['Citroen',     'citroen'],
                    ['Isuzu',       'isuzu'],
                ];
                $brands_row2 = array_merge($brands_row2, $brands_row2);
                foreach ($brands_row2 as $brand): ?>
                    <div class="brand-card<?= in_array($brand[1], $dark_logos) ? ' logo-dark-brand' : '' ?>">
                        <img src="<?= $cdn ?>/<?= $brand[1] ?>.png"
                             alt="<?= $brand[0] ?>"
                             onerror="this.style.display='none'">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Brands We Service End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4 about-img-col" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/about.jpg"
                            style="object-fit: cover;" alt="">
                        <div class="position-absolute top-0 start-0 bg-light d-flex align-items-center justify-content-center about-badge"
                            style="width: 150px; height: 150px;">
                            <div class="text-center">
                                <h1 class="display-4 text-danger mb-0">30</h1>
                                <small>Years Experience</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-danger text-uppercase">About Us</h6>
                    <h1 class="mb-4"><span class="text-danger">The Auto Shoppers</span> Is The Best Place For Your Auto
                        Care</h1>
                    <p class="mb-4">Over three decades of excellence in multi-brand vehicle service. We provide
                        unbiased, factory-standard repairs for all luxury and economy cars.</p>
                    <div class="row g-4 mb-3 pb-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Complete Diagnostics</h6>
                                    <span>EFI scans and sensor calibration for all brands.</span>
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
                                    <h6>Genuine Spare Parts</h6>
                                    <span>Only original or certified aftermarket components used.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="about.php" class="btn btn-danger py-3 px-5">Read More<i
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

    <!-- Google Reviews Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="text-danger text-uppercase">Testimonials</h6>
                <h1 class="mb-2">What Our Customers Say</h1>
                <div class="d-flex align-items-center justify-content-center mb-5">
                    <a href="https://www.google.com/maps/place/The+Auto+Shoppers/@21.1702,72.7924,17z/data=!4m8!3m7!1s0x3be04f00e6e1b8a1:0x1234567890abcdef!8m2!3d21.1702!4d72.7924!9m1!1b1" target="_blank" class="d-flex align-items-center text-decoration-none">
                        <img src="https://www.google.com/favicon.ico" alt="Google" style="height: 20px;" class="me-2">
                        <span class="text-muted" style="transition: color 0.3s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Reviews from Google</span>
                    </a>
                    <span class="ms-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star-half-alt text-warning"></i>
                        <span class="fw-bold ms-1">4.6</span>
                    </span>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item text-center">
                    <div class="testimonial-text rounded p-4">
                        <div class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                        </div>
                        <p>"Excellent service and very professional staff. They diagnosed the issue quickly and fixed it at a reasonable price. Highly recommended!"</p>
                    </div>
                    <div class="mt-3">
                        <h5>Rajesh Patel</h5>
                        <small class="text-muted">via Google Reviews</small>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text rounded p-4">
                        <div class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                        </div>
                        <p>"Best multi-brand car service in Surat. They took great care of my BMW. Genuine parts and transparent pricing — will definitely come back."</p>
                    </div>
                    <div class="mt-3">
                        <h5>Amit Shah</h5>
                        <small class="text-muted">via Google Reviews</small>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text rounded p-4">
                        <div class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                        </div>
                        <p>"Very trustworthy garage. I've been bringing my car here for 5 years and they never try to upsell. Honest work and great results every time."</p>
                    </div>
                    <div class="mt-3">
                        <h5>Priya Desai</h5>
                        <small class="text-muted">via Google Reviews</small>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text rounded p-4">
                        <div class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                        </div>
                        <p>"AC wasn't cooling at all. They fixed it same day and charged very fairly. The waiting area is clean and comfortable too. Great experience."</p>
                    </div>
                    <div class="mt-3">
                        <h5>Karan Mehta</h5>
                        <small class="text-muted">via Google Reviews</small>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text rounded p-4">
                        <div class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-half-alt text-warning"></i>
                        </div>
                        <p>"Took my Hyundai for engine servicing. Work was done on time and they explained everything clearly. Very professional team."</p>
                    </div>
                    <div class="mt-3">
                        <h5>Sneha Joshi</h5>
                        <small class="text-muted">via Google Reviews</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Google Reviews End -->

    <!-- Mobile App Preview Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-primary rounded p-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-white text-center text-lg-start">
                        <h6 class="text-white text-uppercase mb-3">Future Scope</h6>
                        <h1 class="display-4 text-white mb-4">The Auto Shoppers App</h1>
                        <p class="mb-4">We are coming soon with our official mobile app! Our regular customers will be
                            able to:</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6"><i class="fa fa-check text-white me-2"></i>Get Instant Notifications
                            </div>
                            <div class="col-sm-6"><i class="fa fa-check text-white me-2"></i>Single-Tap Booking</div>
                            <div class="col-sm-6"><i class="fa fa-check text-white me-2"></i>Service History Records
                            </div>
                            <div class="col-sm-6"><i class="fa fa-check text-white me-2"></i>Direct Workshop Chat</div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                            <a href="#" class="app-store-btn">
                                <i class="fab fa-apple"></i>
                                <div class="btn-text">
                                    <small>Download on the</small>
                                    <span>App Store</span>
                                </div>
                                <span class="coming-soon-badge">Soon</span>
                            </a>
                            <a href="#" class="app-store-btn">
                                <i class="fab fa-google-play"></i>
                                <div class="btn-text">
                                    <small>Get it on</small>
                                    <span>Google Play</span>
                                </div>
                                <span class="coming-soon-badge">Soon</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center animated zoomIn">
                        <img class="img-fluid" src="img/carousel-1.png"
                            style="max-height: 400px; filter: drop-shadow(0 0 20px rgba(0,0,0,0.2));" alt="App Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile App Preview End -->

    <?php require 'partials/footer.php'; ?>
    <?php require 'partials/whatsapp.php'; ?>
</body>

</html>