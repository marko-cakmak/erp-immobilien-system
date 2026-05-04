function toggleEndDate(checkbox) {
    const endDate = document.getElementById('endDate');
    if (checkbox.checked) {
        endDate._flatpickr?.clear();
        endDate.disabled = true;
        endDate.value = '';
    } else {
        endDate.disabled = false;
        flatpickr(endDate, {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd.m.Y',
            locale: 'de',
        });
    }
}
