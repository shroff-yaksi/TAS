<?php
$title = 'Updates - The Auto Shoppers';
$keywords = 'auto shoppers news, car service updates surat';
$description = 'Latest news and updates from The Auto Shoppers workshop in Surat.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-danger text-uppercase">Latest Updates</h6>
                <h1 class="mb-5">News & Tips</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light p-4 rounded">
                        <img src="img/service-1.jpg" class="img-fluid rounded mb-3" alt="">
                        <h5>Winter Car Care Tips</h5>
                        <p class="text-muted"><i class="fa fa-calendar me-2"></i>January 2026</p>
                        <p>Essential maintenance tips to keep your car running smoothly during winter months.</p>
                        <a href="#" class="text-danger">Read More →</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-light p-4 rounded">
                        <img src="img/service-2.jpg" class="img-fluid rounded mb-3" alt="">
                        <h5>New Equipment Installed</h5>
                        <p class="text-muted"><i class="fa fa-calendar me-2"></i>December 2025</p>
                        <p>We've upgraded our diagnostic equipment with the latest technology for better service.</p>
                        <a href="#" class="text-danger">Read More →</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light p-4 rounded">
                        <img src="img/service-3.jpg" class="img-fluid rounded mb-3" alt="">
                        <h5>Extended Hours</h5>
                        <p class="text-muted"><i class="fa fa-calendar me-2"></i>November 2025</p>
                        <p>We're now open till 7 PM on weekdays to better serve you!</p>
                        <a href="#" class="text-danger">Read More →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
