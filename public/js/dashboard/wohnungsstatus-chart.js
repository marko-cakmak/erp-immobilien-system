document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('wohnungsstatusChart');
    if (!canvas) return;

    const data = {
        labels: JSON.parse(canvas.dataset.labels),
        counts: JSON.parse(canvas.dataset.counts),
        colors: JSON.parse(canvas.dataset.colors),
    };

    const total = data.counts.reduce((a, b) => a + b, 0);

    if (total === 0) {
        canvas.style.display = 'none';
        document.getElementById('wohnungsstatusLegend').innerHTML = `
            <div class="text-center text-muted py-4">
                <i class="bi bi-building" style="font-size: 2rem;"></i>
                <div class="mt-2 fw-semibold">Keine Wohnungen vorhanden</div>
                <small>Es wurden noch keine Wohnungen erfasst.</small>
            </div>
        `;
        return;
    }

    const ctx = canvas.getContext('2d');
    const activeSegments = data.counts.filter(c => c > 0).length;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.counts,
                backgroundColor: data.colors,
                borderWidth: activeSegments > 1 ? 2 : 0,
                borderColor: '#fff',
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: {display: false},
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const value = context.parsed;
                            const pct = Math.round((value / total) * 100);
                            return ` ${context.label}: ${value} (${pct}%)`;
                        }
                    }
                }
            }
        }
    });

    const legend = document.getElementById('wohnungsstatusLegend');
    data.labels.forEach((label, i) => {
        const pct = Math.round((data.counts[i] / total) * 100);
        legend.innerHTML += `
            <div style="font-size: 0.8rem;">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">${label}</span>
                    <span class="fw-semibold">${data.counts[i]}</span>
                </div>
                <div style="height: 8px; border-radius: 4px; background: #eee;">
                    <div style="height: 8px; border-radius: 4px; width: ${pct}%; background-color: ${data.colors[i]};"></div>
                </div>
            </div>
        `;
    });

});
