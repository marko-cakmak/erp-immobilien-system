document.addEventListener('DOMContentLoaded', function () {
    if (typeof flatpickr === 'undefined') {
        return;
    }

    document.querySelectorAll('.js-datetime-24h').forEach(function (input) {
        flatpickr(input, {
            enableTime: true,
            time_24hr: true,
            dateFormat: 'Y-m-d H:i',
            altInput: true,
            altFormat: 'd.m.Y H:i',
            locale: 'de',
            minDate: 'today'
        });
    });
});
