<?php
$title = 'Book Service - The Auto Shoppers';
$keywords = 'car service booking, auto repair appointment, surat car repair';
$description = 'Schedule your car service appointment online at The Auto Shoppers. Convenient, reliable, and expert care for your vehicle.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>



    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-danger text-uppercase">Book Now</h6>
                    <h1 class="mb-4">Standardized Multi-Brand Car Service</h1>
                    <p class="mb-4">Experience hassle-free booking and expert care. We use genuine parts and advanced
                        diagnostics to keep your vehicle in top condition.</p>
                    <div class="row g-4 pb-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center"
                                    style="width: 45px; height: 45px;">
                                    <i class="fa fa-certificate text-danger"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Certified Experts</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center"
                                    style="width: 45px; height: 45px;">
                                    <i class="fa fa-tools text-danger"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Modern Tools</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-danger p-4 rounded wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="text-white mb-3">Need Emergency Help?</h5>
                        <p class="text-white mb-2"><i class="fa fa-phone-alt me-3"></i>+91 99798 65551</p>
                        <p class="text-white mb-0">Available Mon-Sat: 09:30 AM - 08:00 PM</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light h-100 d-flex flex-column justify-content-center p-3 p-md-4 p-lg-5 wow zoomIn"
                        data-wow-delay="0.4s">
                        <h2 class="text-dark mb-4 text-center">Schedule Service</h2>
                        <form id="bookingForm">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="name" class="form-control border-0" placeholder="Your Name"
                                        style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0"
                                        placeholder="Your Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="tel" name="phone" class="form-control border-0"
                                        placeholder="Phone Number" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select name="serviceType" class="form-select border-0" style="height: 55px;"
                                        required>
                                        <option value="" selected disabled>Select A Service</option>
                                        <option value="Diagnostic Test">Diagnostic Test</option>
                                        <option value="Engine Servicing">Engine Servicing</option>
                                        <option value="Brake Repair">Brake Repair</option>
                                        <option value="Oil Changing">Oil Changing</option>
                                        <option value="Dent & Paint">Dent & Paint</option>
                                        <option value="A/C Service">A/C Service</option>
                                        <option value="Transmission Servicing">Transmission Servicing</option>
                                        <option value="Suspension Repair">Suspension Repair</option>
                                        <option value="Wheel Alignment & Balancing">Wheel Alignment & Balancing</option>
                                        <option value="Body Coating">Body Coating</option>
                                        <option value="Car Wash & Interior Cleaning">Car Wash & Interior Cleaning</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="carMake" class="form-control border-0"
                                        placeholder="Car Make (e.g. Maruti)" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="carModel" class="form-control border-0"
                                        placeholder="Car Model" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="date" name="serviceDate" class="form-control border-0"
                                            placeholder="Service Date" style="height: 55px;" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="time" name="serviceTime" class="form-control border-0"
                                        placeholder="Service Time" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control border-0"
                                        placeholder="Special Request / Issue" style="height: 100px;"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-danger w-100 py-3" type="submit" id="bookingSubmitBtn">Book
                                        Appointment</button>
                                </div>
                            </div>
                        </form>
                        <div id="bookingMessageBox" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script src="js/booking.js"></script>
</body>
</html>
