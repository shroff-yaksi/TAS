<?php
$title = 'Service Calculator - The Auto Shoppers';
$keywords = 'car service cost calculator, auto repair estimate surat';
$description = 'Estimate your car service cost with The Auto Shoppers service price calculator.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>



    <!-- Calculator Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-danger text-uppercase">Price Estimator</h6>
                    <h1 class="mb-4">Get an Instant Estimate</h1>
                    <p class="mb-4">Select your vehicle type and the services you need to get a rough estimate of the
                        costs. Final prices may vary based on vehicle condition and specific spare parts required.</p>

                    <div class="bg-light p-4 rounded">
                        <form id="calcForm">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Vehicle Segment</label>
                                <select class="form-select" id="carSegment" required>
                                    <option value="1.0">Hatchback (Small)</option>
                                    <option value="1.2">Sedan / Compact SUV</option>
                                    <option value="1.5">SUV / Premium Sedan</option>
                                    <option value="2.0">Luxury / Performance</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Select Services</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="2500" id="s1">
                                    <label class="form-check-label" for="s1">General Service (Oil &amp; Filters) —
                                        ₹2,500 base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="1500" id="s2">
                                    <label class="form-check-label" for="s2">Wheel Alignment &amp; Balancing — ₹1,500
                                        base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="1200" id="s3">
                                    <label class="form-check-label" for="s3">Brake Cleaning &amp; Adjustment — ₹1,200
                                        base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="2000" id="s4">
                                    <label class="form-check-label" for="s4">AC Gas Refill &amp; Cleaning — ₹2,000
                                        base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="800" id="s5">
                                    <label class="form-check-label" for="s5">Full Interior Vacuuming — ₹800 base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="700" id="s6">
                                    <label class="form-check-label" for="s6">Tyre Rotation — ₹700 base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="600" id="s7">
                                    <label class="form-check-label" for="s7">Exterior Wash &amp; Window Polish — ₹600
                                        base</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input service-check" type="checkbox" value="3500" id="s8">
                                    <label class="form-check-label" for="s8">Full Detailing &amp; Paint Protection —
                                        ₹3,500 base</label>
                                </div>
                            </div>
                            <small class="text-muted d-block mt-1">* Minimum charge ₹500. Final price includes vehicle
                                segment multiplier.</small>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-danger text-white p-5 rounded h-100 d-flex flex-column justify-content-center text-center wow zoomIn"
                        data-wow-delay="0.5s">
                        <h2 class="text-white mb-4">Estimated Total</h2>
                        <h1 class="display-1 mb-4">₹<span id="totalPrice">0</span></h1>
                        <p class="mb-4">*This is an indicative labor + basic parts cost price. Taxes and additional part
                            costs are extra.</p>
                        <a href="booking.php" class="btn btn-secondary py-3 px-5">Book This Service</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Calculator End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script src="js/calculator.js"></script>
</body>
</html>
