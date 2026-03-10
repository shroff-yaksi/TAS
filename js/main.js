(function ($) {
    "use strict";

    // Spinner — dismiss after 300ms to allow WOW.js + DOM to settle on all pages
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 300);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 300) {
    //         $('.sticky-top').css('top', '0px');
    //     } else {
    //         $('.sticky-top').css('top', '-100px');
    //     }
    // });


    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').addClass('show');
        } else {
            $('.back-to-top').removeClass('show');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 0, 'swing');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 25,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

    // Dark Mode Toggle
    $(document).ready(function () {
        const darkMode = localStorage.getItem('darkMode');
        
        // Function to update all toggle icons and mobile label
        function updateToggleIcons(isDark) {
            const iconClass = isDark ? 'fa-sun' : 'fa-moon';
            const removeClass = isDark ? 'fa-moon' : 'fa-sun';
            $('#dark-mode-toggle i, #dark-mode-toggle-mobile i')
                .removeClass(removeClass)
                .addClass(iconClass);
            $('#dark-mode-label').text(isDark ? 'Light Mode' : 'Dark Mode');
        }
        
        // Default to light mode if not set
        if (darkMode === 'enabled') {
            $('body').addClass('dark-mode');
            updateToggleIcons(true);
        } else if (darkMode === null) {
            localStorage.setItem('darkMode', 'disabled');
        }

        // Handle clicks on both desktop and mobile toggle buttons
        $('#dark-mode-toggle, #dark-mode-toggle-mobile').click(function () {
            $('body').toggleClass('dark-mode');
            const isDark = $('body').hasClass('dark-mode');
            localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
            updateToggleIcons(isDark);
        });
    });

})(jQuery);

// Newsletter form handler — runs on all pages
$(document).ready(function () {
    $('#newsletterForm').on('submit', function (e) {
        e.preventDefault();
        var email = $(this).find('input').val();
        var btn = $(this).find('button');
        btn.prop('disabled', true).text('...');

        $.ajax({
            url: 'php/newsletter.php',
            type: 'POST',
            data: { email: email },
            success: function (res) {
                if (res.success) {
                    $('#newsletterMessage').html('<span class="text-success">' + res.message + '</span>');
                    $('#newsletterForm')[0].reset();
                } else {
                    $('#newsletterMessage').html('<span class="text-warning">' + (res.message || 'Error') + '</span>');
                }
            },
            error: function () {
                $('#newsletterMessage').html('<span class="text-danger">Connection error.</span>');
            },
            complete: function () {
                btn.prop('disabled', false).text('SignUp');
            }
        });
    });
});
