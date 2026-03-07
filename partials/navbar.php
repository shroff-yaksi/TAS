<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-4 px-xl-5">
            <h2 class="m-0 text-danger d-flex align-items-center gap-1"
                style="font-family: 'Times New Roman', Times, serif; font-weight: 700; letter-spacing: 0.5px;">
                <img src="img/tas_logo_light_theme.png" alt="TAS Logo" class="logo-light" style="max-height: 40px;">
                <img src="img/tas_logo_dark_theme.png" alt="TAS Logo" class="logo-dark" style="max-height: 40px;">
                THE AUTO SHOPPERS
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?= in_array($currentPage, ['about.php','team.php']) ? 'active' : '' ?>" data-bs-toggle="dropdown">About</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="about.php" class="dropdown-item">About Us</a>
                        <a href="team.php" class="dropdown-item">Our Team</a>
                    </div>
                </div>
                <a href="service.php" class="nav-item nav-link <?= $currentPage === 'service.php' ? 'active' : '' ?>">Services</a>
                <a href="offers.php" class="nav-item nav-link <?= $currentPage === 'offers.php' ? 'active' : '' ?>">Offers</a>
                <a href="calculator.php" class="nav-item nav-link <?= $currentPage === 'calculator.php' ? 'active' : '' ?>">Calculator</a>
                <a href="contact.php" class="nav-item nav-link <?= $currentPage === 'contact.php' ? 'active' : '' ?>">Contact</a>
                <!-- Mobile-only items -->
                <div class="d-lg-none mt-3 mb-2 px-2">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted">Dark Mode</span>
                        <button id="dark-mode-toggle-mobile" class="btn btn-sm btn-outline-secondary rounded-circle"
                            style="width: 40px; height: 40px; padding: 0;">
                            <i class="fas fa-moon"></i>
                        </button>
                    </div>
                    <a href="booking.php"
                        class="btn btn-danger w-100 rounded-0 shadow-sm hover-lift d-flex align-items-center justify-content-center py-3">Book
                        Service<i class="fa fa-arrow-right ms-2 btn-icon-animate"></i></a>
                </div>
            </div>
            <div class="d-none d-lg-flex align-items-center me-4">
                <button id="dark-mode-toggle" class="btn btn-sm btn-outline-secondary rounded-circle"
                    style="width: 40px; height: 40px; padding: 0;">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
        <a href="booking.php"
            class="btn btn-danger rounded-0 px-lg-5 shadow-sm d-none d-lg-flex align-items-center">Book
            Service<i class="fa fa-arrow-right ms-3 btn-icon-animate"></i></a>
    </nav>
    <!-- Navbar End -->
