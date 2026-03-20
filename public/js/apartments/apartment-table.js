document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.apartment-row').forEach(row => {
        const color = row.dataset.statusColor;

        row.addEventListener('mouseenter', () => {
            row.style.backgroundColor = color + '22';
        });

        row.addEventListener('mouseleave', () => {
            row.style.backgroundColor = '';
        });
    });
});
