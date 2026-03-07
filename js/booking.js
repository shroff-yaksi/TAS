$(document).ready(function () {
    $('#bookingForm').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#bookingSubmitBtn');
        btn.prop('disabled', true).text('Booking...');

        $.ajax({
            url: 'php/booking.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#bookingMessageBox').html('<div class="alert alert-success">' + res.message + '</div>');
                    $('#bookingForm')[0].reset();
                } else {
                    $('#bookingMessageBox').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function () {
                $('#bookingMessageBox').html('<div class="alert alert-danger">Connection error. Please try again.</div>');
            },
            complete: function () {
                btn.prop('disabled', false).text('Book Appointment');
            }
        });
    });
});
