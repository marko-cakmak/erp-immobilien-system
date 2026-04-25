let searchUrl;

document.addEventListener('DOMContentLoaded', function () {
    searchUrl = document.getElementById('searchBtn').dataset.url;

    performSearch();

    document.getElementById('searchBtn').addEventListener('click', function () {
        performSearch();
    });

    document.getElementById('searchInput').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });
});

async function performSearch() {
    const query = document.getElementById('searchInput').value.trim();

    showSpinner(true);
    clearResults();

    try {
        const params = new URLSearchParams();

        if (query) {
            params.append('name', query);
        }

        const response = await fetch(`${searchUrl}?${params.toString()}`, {
            headers: { 'Accept': 'application/json' }
        });

        if (!response.ok) {
            throw new Error('Netzwerkfehler');
        }

        const results = await response.json();
        renderSearchResults(results);

    } catch (error) {
        console.error('Suchfehler:', error);
    } finally {
        showSpinner(false);
    }
}

function renderSearchResults(results) {
    const container = document.getElementById('availableList');
    const noResults = document.getElementById('noResults');

    if (results.length === 0) {
        container.innerHTML = '';
        noResults.style.display = 'block';
        return;
    }

    noResults.style.display = 'none';

    container.innerHTML = results.map(interessent => {
        const isAssigned = assignedInteressenten.has(interessent.id);
        const itemClass = isAssigned ? 'available-item already-assigned' : 'available-item';
        const clickHandler = isAssigned ? '' : `onclick="addInteressent(${interessent.id})"`;

        return `
            <div class="list-group-item ${itemClass}"
                 ${clickHandler}
                 data-id="${interessent.id}">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-person fs-4 ${isAssigned ? 'text-success' : 'text-muted'}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">
                            ${interessent.first_name} ${interessent.last_name}
                            ${isAssigned ? '<span class="badge bg-success ms-2">Zugewiesen</span>' : ''}
                        </h6>
                        <small class="text-muted">${interessent.email}</small>
                    </div>
                    <div>
                        ${isAssigned
            ? '<i class="bi bi-check-circle-fill text-success fs-5"></i>'
            : '<i class="bi bi-plus-circle text-success fs-5"></i>'}
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

function showSpinner(show) {
    document.getElementById('searchSpinner').style.display = show ? 'block' : 'none';
}

function clearResults() {
    document.getElementById('availableList').innerHTML = '';
    document.getElementById('noResults').style.display = 'none';
}
