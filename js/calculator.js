$(document).ready(function () {
    function calculate() {
        var baseMultiplier = parseFloat($('#carSegment').val());
        var total = 0;
        $('.service-check:checked').each(function () {
            total += parseFloat($(this).val());
        });
        var estimatedTotal = total > 0 ? Math.max(Math.round(total * baseMultiplier), 500) : 0;
        $('#totalPrice').text(estimatedTotal.toLocaleString('en-IN'));
    }

    $('#carSegment, .service-check').on('change', calculate);
});
