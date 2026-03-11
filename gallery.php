<?php
$title = 'Gallery - The Auto Shoppers';
$keywords = 'car workshop gallery, auto service photos, car repair workshop surat';
$description = 'Take a look inside The Auto Shoppers workshop. See our modern equipment, workspace, and the quality care we provide to every vehicle.';
require 'partials/head.php';
?>

<body>
<?php require 'partials/navbar.php'; ?>

    <!-- Gallery Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-danger text-uppercase">Gallery</h6>
                <h1 class="mb-5">Inside Our Workshop</h1>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="img/about.jpg" alt="Workshop Floor">
                        </div>
                        <div class="gallery-caption">
                            <h5>Workshop Floor</h5>
                            <p>Our spacious workshop is equipped with multiple service bays, allowing us to handle several vehicles simultaneously with precision and care.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="img/service-1.jpg" alt="Diagnostic Equipment">
                        </div>
                        <div class="gallery-caption">
                            <h5>Advanced Diagnostics</h5>
                            <p>We use the latest EFI diagnostic scanners and calibration tools to accurately identify issues across all major car brands.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="img/service-2.jpg" alt="Engine Bay Work">
                        </div>
                        <div class="gallery-caption">
                            <h5>Engine Bay Work</h5>
                            <p>Our certified technicians perform detailed engine servicing, from oil changes to complete overhauls, using genuine spare parts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="img/service-3.jpg" alt="Brake & Suspension">
                        </div>
                        <div class="gallery-caption">
                            <h5>Brake & Suspension Bay</h5>
                            <p>Dedicated service area for brake repairs, suspension work, and wheel alignment using professional-grade hydraulic lifts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="img/service-4.jpg" alt="Dent & Paint">
                        </div>
                        <div class="gallery-caption">
                            <h5>Dent & Paint Studio</h5>
                            <p>Our paint booth delivers factory-finish results for dent repair, scratch removal, and full body repainting with colour matching technology.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="img/carousel-bg-1.jpg" alt="Customer Area">
                        </div>
                        <div class="gallery-caption">
                            <h5>Customer Waiting Area</h5>
                            <p>A clean and comfortable waiting space where customers can relax while their vehicle is being serviced by our expert team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
