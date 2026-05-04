document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('personSearchInput');
    const searchBtn = document.getElementById('personSearchBtn');
    const clearBtn = document.getElementById('clearPersonBtn');
    const resultsContainer = document.getElementById('personResults');
    const spinner = document.getElementById('personSearchSpinner');
    const selectedBox = document.getElementById('selectedPersonBox');
    const selectedName = document.getElementById('selectedPersonName');
    const personId = document.getElementById('personId');
    const searchUrl = searchInput.dataset.url;

    searchBtn.addEventListener('click', performSearch);

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });

    searchInput.addEventListener('input', function () {
        clearTimeout(window.personSearchTimeout);
        window.personSearchTimeout = setTimeout(performSearch, 400);
    });

    clearBtn.addEventListener('click', clearSelection);

    async function performSearch() {
        const query = searchInput.value.trim();

        showSpinner(true);
        resultsContainer.innerHTML = '';

        try {
            const params = new URLSearchParams();
            if (query) params.append('name', query);

            const response = await fetch(`${searchUrl}?${params.toString()}`, {
                headers: {'Accept': 'application/json'}
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

        resultsContainer.innerHTML = results.map(person => `
            <div class="list-group-item list-group-item-action"
                 style="cursor: pointer;"
                 onclick="selectPerson(${person.id}, '${person.first_name} ${person.last_name}')">
                <div class="fw-semibold">${person.first_name} ${person.last_name}</div>
                <small class="text-muted">${person.email ?? ''} ${person.phone ? '· ' + person.phone : ''}</small>
            </div>
        `).join('');
    }

    function clearSelection() {
        personId.value = '';
        searchInput.value = '';
        resultsContainer.innerHTML = '';
        selectedBox.style.display = 'none';
    }

    function showSpinner(show) {
        spinner.style.display = show ? 'block' : 'none';
    }

    window.selectPerson = function (id, name) {
        personId.value = id;
        selectedName.textContent = name;
        selectedBox.style.display = 'block';
        resultsContainer.innerHTML = '';
        searchInput.value = '';
    };

});
