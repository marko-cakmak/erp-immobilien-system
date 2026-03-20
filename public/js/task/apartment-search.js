document.addEventListener('DOMContentLoaded', function () {

    // -- Elements --
    const searchInput     = document.getElementById('apartmentSearchInput');
    const searchBtn       = document.getElementById('apartmentSearchBtn');
    const clearBtn        = document.getElementById('clearApartmentBtn');
    const resultsContainer = document.getElementById('apartmentResults');
    const spinner         = document.getElementById('apartmentSearchSpinner');
    const selectedBox     = document.getElementById('selectedApartmentBox');
    const selectedName    = document.getElementById('selectedApartmentName');
    const apartmentId     = document.getElementById('apartmentId');
    const searchUrl       = searchInput.dataset.url;

    // -- Event Listeners --
    searchBtn.addEventListener('click', performSearch);

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });

    searchInput.addEventListener('input', function () {
        clearTimeout(window.apartmentSearchTimeout);
        window.apartmentSearchTimeout = setTimeout(performSearch, 400);
    });

    clearBtn.addEventListener('click', clearSelection);

    // -- Functions --
    async function performSearch() {
        const query = searchInput.value.trim();

        showSpinner(true);
        resultsContainer.innerHTML = '';

        try {
            const params = new URLSearchParams();
            if (query) params.append('q', query);

            const response = await fetch(`${searchUrl}?${params.toString()}`, {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) throw new Error('Fehler');

            const results = await response.json();
            renderResults(results);

        } catch (error) {
            console.error('Suchfehler:', error);
        } finally {
            showSpinner(false);
        }
    }

    function renderResults(results) {
        if (results.length === 0) {
            resultsContainer.innerHTML = '<div class="list-group-item text-muted">Keine Ergebnisse gefunden.</div>';
            return;
        }

        resultsContainer.innerHTML = results.map(apartment => `
            <div class="list-group-item list-group-item-action"
                 style="cursor: pointer;"
                 onclick="selectApartment(${apartment.id}, '${apartment.title} — ${apartment.street_address}, ${apartment.city}')">
                <div class="fw-semibold">${apartment.title}</div>
                <small class="text-muted">${apartment.street_address}, ${apartment.postal_code} ${apartment.city}</small>
            </div>
        `).join('');
    }

    function clearSelection() {
        apartmentId.value = '';
        searchInput.value = '';
        resultsContainer.innerHTML = '';
        selectedBox.style.display = 'none';
        apartmentId.dispatchEvent(new Event('change'));
    }

    function showSpinner(show) {
        spinner.style.display = show ? 'block' : 'none';
    }

    window.selectApartment = function (id, name) {
        apartmentId.value = id;
        selectedName.textContent = name;
        selectedBox.style.display = 'block';
        resultsContainer.innerHTML = '';
        searchInput.value = '';
        apartmentId.dispatchEvent(new Event('change'));
    };

});
