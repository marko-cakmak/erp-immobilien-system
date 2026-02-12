const scriptTag = document.querySelector('script[data-all-interessenten]');
const allInteressenten = JSON.parse(scriptTag.dataset.allInteressenten);
const initialAssigned = JSON.parse(scriptTag.dataset.assignedIds);
let assignedInteressenten = new Set(initialAssigned);
const ITEMS_PER_PAGE = 3;
let currentPage = 1;
let filteredInteressenten = [];

document.addEventListener('DOMContentLoaded', function () {
    renderAssigned();
    renderAvailable();

    document.getElementById('searchInput').addEventListener('input', function (e) {
        currentPage = 1;
        renderAvailable(e.target.value.toLowerCase());
    });

    document.getElementById('loadMoreBtn').addEventListener('click', function () {
        currentPage++;
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        renderAvailable(searchTerm);
    });
});

function renderAssigned() {
    const container = document.getElementById('assignedList');
    const emptyMessage = document.getElementById('emptyMessage');

    if (assignedInteressenten.size === 0) {
        container.innerHTML = '';
        emptyMessage.style.display = 'block';
        updateHiddenInputs();
        return;
    }

    emptyMessage.style.display = 'none';

    const assigned = allInteressenten.filter(i => assignedInteressenten.has(i.id));

    container.innerHTML = assigned.map(interessent => `
        <a href="/interested-persons/${interessent.id}"
           class="list-group-item list-group-item-action">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-person-circle fs-3 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">
                        ${interessent.first_name} ${interessent.last_name}
                    </h6>
                    <small class="text-muted d-block">
                        <i class="bi bi-envelope"></i> ${interessent.email}
                    </small>
                    <small class="text-muted d-block">
                        <i class="bi bi-telephone"></i> ${interessent.phone}
                    </small>
                </div>
                <div>
                    <button type="button"
                            class="btn btn-sm btn-danger remove-btn"
                            onclick="event.preventDefault(); removeInteressent(${interessent.id})"
                            title="Entfernen">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </a>
    `).join('');

    updateHiddenInputs();
}

function renderAvailable(searchTerm) {
    searchTerm = searchTerm || '';

    const container = document.getElementById('availableList');
    const noResults = document.getElementById('noResults');
    const loadMoreContainer = document.getElementById('loadMoreContainer');

    if (searchTerm) {
        filteredInteressenten = allInteressenten.filter(i => {
            const fullName = `${i.first_name} ${i.last_name}`.toLowerCase();
            return fullName.includes(searchTerm);
        });
    } else {
        filteredInteressenten = [...allInteressenten];
    }

    if (filteredInteressenten.length === 0) {
        container.innerHTML = '';
        noResults.style.display = 'block';
        loadMoreContainer.style.display = 'none';
        return;
    }

    noResults.style.display = 'none';

    const itemsToShow = currentPage * ITEMS_PER_PAGE;
    const visibleInteressenten = filteredInteressenten.slice(0, itemsToShow);

    container.innerHTML = visibleInteressenten.map(interessent => {
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

    if (visibleInteressenten.length < filteredInteressenten.length) {
        loadMoreContainer.style.display = 'block';
        const remaining = filteredInteressenten.length - visibleInteressenten.length;
        document.getElementById('loadMoreBtn').innerHTML = `
            <i class="bi bi-arrow-down-circle"></i> Mehr laden (${remaining} weitere)
        `;
    } else {
        loadMoreContainer.style.display = 'none';
    }
}

function addInteressent(id) {
    assignedInteressenten.add(id);
    renderAssigned();
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    renderAvailable(searchTerm);
}

function removeInteressent(id) {
    assignedInteressenten.delete(id);
    renderAssigned();
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    renderAvailable(searchTerm);
}

function updateHiddenInputs() {
    const container = document.getElementById('hiddenInputs');
    container.innerHTML = Array.from(assignedInteressenten).map(id =>
        `<input type="hidden" name="interessent_ids[]" value="${id}">`
    ).join('');
}
