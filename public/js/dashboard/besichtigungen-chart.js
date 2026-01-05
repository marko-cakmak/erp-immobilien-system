document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('besichtigungenChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
            datasets: [
                {
                    label: 'Besichtigungen',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 38, 40, 45],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1
                },
                {
                    label: 'Vermietungen',
                    data: [5, 8, 7, 12, 10, 15, 13, 18, 16, 20, 22, 25],
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
