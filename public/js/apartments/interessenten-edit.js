const scriptTag = document.querySelector('script[data-all-interessenten]');
const allInteressenten = JSON.parse(scriptTag.dataset.allInteressenten);
const initialAssigned = JSON.parse(scriptTag.dataset.assignedIds);
let assignedInteressenten = new Set(initialAssigned);

document.addEventListener('DOMContentLoaded', function () {
    renderAssigned();
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

function addInteressent(id) {
    assignedInteressenten.add(id);
    renderAssigned();
    performSearch();
}

function removeInteressent(id) {
    assignedInteressenten.delete(id);
    renderAssigned();
    performSearch();
}

function updateHiddenInputs() {
    const container = document.getElementById('hiddenInputs');
    container.innerHTML = Array.from(assignedInteressenten).map(id =>
        `<input type="hidden" name="interessent_ids[]" value="${id}">`
    ).join('');
}
