document.addEventListener('DOMContentLoaded', function () {
    if (typeof flatpickr === 'undefined') {
        return;
    }

    document.querySelectorAll('.js-date-only').forEach(function (input) {
        flatpickr(input, {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd.m.Y',
            locale: 'de',
        });
    });
});
