$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#contactSubmitBtn');
        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: 'php/contact.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#contactMessageBox').html('<div class="alert alert-success">' + res.message + '</div>');
                    $('#contactForm')[0].reset();
                } else {
                    $('#contactMessageBox').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function () {
                $('#contactMessageBox').html('<div class="alert alert-danger">Connection error. Please try again.</div>');
            },
            complete: function () {
                btn.prop('disabled', false).text('Send Message');
            }
        });
    });
});
