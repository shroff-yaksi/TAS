<!-- Booking Slide-In Panel Overlay -->
<div class="booking-panel-overlay" id="bookingPanelOverlay"></div>

<!-- Booking Slide-In Panel -->
<div class="booking-panel" id="bookingPanel">
    <button class="booking-panel-close" id="bookingPanelClose" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>

    <div class="booking-panel-inner">
        <div class="booking-panel-header">
            <h6 class="text-uppercase mb-2" style="color: rgba(255,255,255,0.7); font-size: 12px; letter-spacing: 2px;">Book Now</h6>
            <h3>Standardized Multi-Brand Car Service</h3>
            <p>Experience hassle-free booking and expert care. We use genuine parts and advanced diagnostics to keep your vehicle in top condition.</p>
        </div>

        <div class="d-flex gap-3 mb-3 px-1">
            <div class="d-flex align-items-center">
                <div class="d-flex flex-shrink-0 align-items-center justify-content-center"
                    style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.15);">
                    <i class="fa fa-certificate text-white" style="font-size: 14px;"></i>
                </div>
                <div class="ps-2">
                    <span class="text-white fw-bold" style="font-size: 12px;">Certified Experts</span>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex flex-shrink-0 align-items-center justify-content-center"
                    style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.15);">
                    <i class="fa fa-tools text-white" style="font-size: 14px;"></i>
                </div>
                <div class="ps-2">
                    <span class="text-white fw-bold" style="font-size: 12px;">Modern Tools</span>
                </div>
            </div>
        </div>

        <form id="bookingPanelForm">
            <div class="row g-2">
                <!-- Section 1: Client Info -->
                <div class="col-12">
                    <div class="sidebar-divider"><span>CLIENT INFO</span></div>
                </div>
                <div class="col-12">
                    <input type="text" name="name" class="form-control sidebar-input" placeholder="Your Name" required>
                </div>
                <div class="col-12">
                    <input type="email" name="email" class="form-control sidebar-input" placeholder="Your Email" required>
                </div>
                <div class="col-12">
                    <input type="tel" name="phone" class="form-control sidebar-input" placeholder="Phone Number" required>
                </div>

                <!-- Section 2: Car Info -->
                <div class="col-12">
                    <div class="sidebar-divider"><span>CAR INFO</span></div>
                </div>
                <div class="col-12">
                    <input type="text" name="carMake" class="form-control sidebar-input" placeholder="Car Make (e.g. Maruti)" required>
                </div>
                <div class="col-12">
                    <input type="text" name="carModel" class="form-control sidebar-input" placeholder="Car Model (e.g. Ciaz)" required>
                </div>
                <div class="col-12">
                    <input type="number" name="mileage" class="form-control sidebar-input" placeholder="Kilometers Driven (e.g. 45000)" min="0">
                </div>

                <!-- Section 3: Book Appointment -->
                <div class="col-12">
                    <div class="sidebar-divider"><span>BOOK APPOINTMENT</span></div>
                </div>
                <div class="col-12">
                    <input type="date" name="serviceDate" class="form-control sidebar-input" id="panelServiceDate" required>
                </div>
                <div class="col-12">
                    <label class="sidebar-label">Would you like us to pick up your vehicle?</label>
                    <select name="vehiclePickup" class="form-select sidebar-input">
                        <option value="" disabled selected>-- Please choose an option --</option>
                        <option value="Yes">Yes, please pick up</option>
                        <option value="No">No, I will drop off</option>
                    </select>
                </div>
                <div class="col-12">
                    <textarea name="message" class="form-control sidebar-input" placeholder="Additional Details" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-book-sidebar w-100" type="submit" id="panelSubmitBtn">
                        <i class="fa fa-arrow-right me-2"></i>Book Appointment
                    </button>
                </div>
            </div>
        </form>
        <div id="panelMessageBox" class="mt-3"></div>

        <div class="sidebar-emergency mt-3">
            <h6 class="text-white mb-2">Need Emergency Help?</h6>
            <i class="fa fa-phone-alt me-2"></i>
            <a href="tel:+919979865551">+91 99798 65551</a>
        </div>
    </div>
</div>

<style>
/* Booking Panel Overlay */
.booking-panel-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.35s ease, visibility 0.35s ease;
    backdrop-filter: blur(3px);
}
.booking-panel-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Booking Slide-In Panel */
.booking-panel {
    position: fixed;
    top: 0;
    right: 0;
    width: 420px;
    height: 100vh;
    z-index: 9999;
    background: linear-gradient(165deg, var(--primary) 0%, var(--primary-dark) 100%);
    box-shadow: -8px 0 30px rgba(0, 0, 0, 0.3);
    transform: translateX(100%);
    transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    overflow-y: auto;
    overflow-x: hidden;
}
.booking-panel.active {
    transform: translateX(0);
}

.booking-panel-inner {
    padding: 30px 25px 40px;
}

/* Close Button */
.booking-panel-close {
    position: absolute;
    top: 15px;
    right: 18px;
    background: rgba(255,255,255,0.15);
    border: none;
    color: #fff;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s ease;
    z-index: 10;
}
.booking-panel-close:hover {
    background: rgba(255,255,255,0.3);
    transform: rotate(90deg);
}

/* Header */
.booking-panel-header h3 {
    color: #ffffff;
    font-family: var(--font-primary);
    font-weight: 700;
    font-size: 22px;
    margin-bottom: 10px;
    line-height: 1.3;
}
.booking-panel-header p {
    color: rgba(255,255,255,0.75);
    font-size: 13px;
    line-height: 1.5;
    margin-bottom: 15px;
}

/* Responsive */
@media (max-width: 576px) {
    .booking-panel {
        width: 100%;
    }
    .booking-panel-inner {
        padding: 25px 18px 35px;
    }
}

/* Prevent body scroll when panel is open */
body.booking-panel-open {
    overflow: hidden;
}
</style>

<script>
(function() {
    var panel = document.getElementById('bookingPanel');
    var overlay = document.getElementById('bookingPanelOverlay');
    var closeBtn = document.getElementById('bookingPanelClose');
    var dateInput = document.getElementById('panelServiceDate');

    // Set date constraints
    if (dateInput) {
        var today = new Date();
        var max = new Date();
        max.setDate(today.getDate() + 30);
        dateInput.setAttribute('min', today.toISOString().split('T')[0]);
        dateInput.setAttribute('max', max.toISOString().split('T')[0]);
    }

    function openPanel() {
        panel.classList.add('active');
        overlay.classList.add('active');
        document.body.classList.add('booking-panel-open');
    }

    function closePanel() {
        panel.classList.remove('active');
        overlay.classList.remove('active');
        document.body.classList.remove('booking-panel-open');
    }

    // Close on overlay click or close button
    overlay.addEventListener('click', closePanel);
    closeBtn.addEventListener('click', closePanel);

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && panel.classList.contains('active')) {
            closePanel();
        }
    });

    // Expose globally
    window.openBookingPanel = openPanel;

    // Intercept all booking links
    document.addEventListener('click', function(e) {
        var link = e.target.closest('a[href*="booking.php"], a[data-booking]');
        if (link) {
            e.preventDefault();
            openPanel();
        }
    });

    // Handle panel form submission
    var panelForm = document.getElementById('bookingPanelForm');
    var panelMsgBox = document.getElementById('panelMessageBox');
    var panelSubmitBtn = document.getElementById('panelSubmitBtn');

    if (panelForm) {
        panelForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var originalText = panelSubmitBtn.innerHTML;
            panelSubmitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Sending...';
            panelSubmitBtn.disabled = true;

            var formData = new FormData(panelForm);

            fetch('php/booking.php', {
                method: 'POST',
                body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.success) {
                    panelMsgBox.innerHTML = '<div class="alert alert-success py-2" style="font-size:13px;">' + data.message + '</div>';
                    panelForm.reset();
                } else {
                    panelMsgBox.innerHTML = '<div class="alert alert-warning py-2" style="font-size:13px;">' + data.message + '</div>';
                }
            })
            .catch(function() {
                panelMsgBox.innerHTML = '<div class="alert alert-danger py-2" style="font-size:13px;">Something went wrong. Please try again.</div>';
            })
            .finally(function() {
                panelSubmitBtn.innerHTML = originalText;
                panelSubmitBtn.disabled = false;
            });
        });
    }
})();
</script>
