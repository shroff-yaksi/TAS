<?php
$title = 'Contact Us - The Auto Shoppers';
$keywords = 'contact auto shoppers, car service contact surat, auto repair inquiry';
$description = 'Get in touch with The Auto Shoppers. Contact us for car service inquiries, bookings, and support.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>



    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-danger text-uppercase">Contact Us</h6>
                <h1 class="mb-5">Get In Touch for Any Query</h1>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 h-100">
                                <h5 class="text-uppercase">Visit Us</h5>
                                <p class="m-0"><a href="https://maps.app.goo.gl/YSUD6vzPV9RNrCSu7" target="_blank"
                                        class="text-dark text-decoration-none"><i
                                            class="fa fa-map-marker-alt text-danger me-2"></i>5QXH+JQW, Adajan Gam,
                                        Surat, Gujarat 394510</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 h-100">
                                <h5 class="text-uppercase">Call Us</h5>
                                <p class="m-0"><i class="fa fa-phone-alt text-danger me-2"></i>+91 99798 65551</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 h-100">
                                <h5 class="text-uppercase">Email Us</h5>
                                <p class="m-0"><i
                                        class="fa fa-envelope-open text-danger me-2"></i>theautoshoppers.in@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.48880114516265!2d72.77910821436583!3d21.199281930565146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04d948b9cbc91%3A0x1e6dcd8d36cce190!2sThe%20Auto%20Shoppers!5e0!3m2!1sen!2sin!4v1772800171666!5m2!1sen!2sin"
                        frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <p class="mb-4">Have questions about our services or need a custom quote? Fill out the form
                            below and our team will get back to you within 24 hours.</p>
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="subject"
                                            placeholder="Subject" required>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message"
                                            name="message" style="height: 100px" required></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-danger w-100 py-3" type="submit" id="contactSubmitBtn">Send
                                        Message</button>
                                </div>
                            </div>
                        </form>
                        <div id="contactMessageBox" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script src="js/contact.js"></script>
</body>
</html>
