<?php
$title = 'Book Service - The Auto Shoppers';
$keywords = 'car service booking, auto repair appointment, surat car repair';
$description = 'Schedule your car service appointment online at The Auto Shoppers. Convenient, reliable, and expert care for your vehicle.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    <!-- Booking Info Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-danger text-uppercase">Book Now</h6>
                    <h1 class="mb-4">Standardized Multi-Brand Car Service</h1>
                    <p class="mb-4">Experience hassle-free booking and expert care. We use genuine parts and advanced
                        diagnostics to keep your vehicle in top condition.</p>
                    <div class="row g-4 pb-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center"
                                    style="width: 65px; height: 65px; border-radius: 50%;">
                                    <i class="fa fa-certificate text-danger fa-2x"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Certified Experts</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center"
                                    style="width: 65px; height: 65px; border-radius: 50%;">
                                    <i class="fa fa-tools text-danger fa-2x"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Modern Tools</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-danger p-4 rounded wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="text-white mb-3">Need Emergency Help?</h5>
                        <p class="text-white mb-0"><i class="fa fa-phone-alt me-3"></i><a href="tel:+919979865551" class="text-white text-decoration-none">+91 99798 65551</a></p>
                    </div>
                </div>
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.4s">
                    <div class="p-4 p-md-5 text-center rounded booking-glass-card">
                        <div class="mb-4">
                            <i class="fa fa-calendar-check text-danger" style="font-size: 64px;"></i>
                        </div>
                        <h3 class="mb-3">Ready to Book?</h3>
                        <p class="text-muted mb-4">Click below to fill out the booking form. It only takes a minute!</p>
                        <button class="btn btn-danger py-3 px-5" onclick="openBookingPanel()">
                            <i class="fa fa-arrow-right me-2"></i>Book Appointment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Info End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script>
        // Auto-open booking panel when this page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                if (typeof openBookingPanel === 'function') {
                    openBookingPanel();
                }
            }, 600);
        });
    </script>
</body>
</html>
