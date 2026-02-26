document.addEventListener('DOMContentLoaded', function () {

    const selectedIds = new Set();
    const selectedList = document.getElementById('selectedInteressenten');
    const emptyMsg = document.getElementById('emptySelected');
    const hiddenInputs = document.getElementById('hiddenInputs');
    const searchInput = document.getElementById('searchInteressenten');

    if (!selectedList) return;

    document.querySelectorAll('.add-interessent').forEach(btn => {
        btn.addEventListener('click', function () {

            const item = this.closest('.list-group-item');
            const { id, name, email } = item.dataset;

            if (selectedIds.has(id)) return;
            selectedIds.add(id);

            emptyMsg.style.display = 'none';
            item.classList.add('d-none');

            const selected = document.createElement('div');
            selected.className =
                'list-group-item py-2 d-flex align-items-center justify-content-between';
            selected.dataset.id = id;

            selected.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle text-success me-2"></i>
                    <div>
                        <div class="fw-semibold small">${name}</div>
                        <small class="text-muted">${email}</small>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger remove-interessent">
                    <i class="bi bi-x"></i>
                </button>
            `;

            selected.querySelector('.remove-interessent')
                .addEventListener('click', function () {

                    selectedIds.delete(id);
                    selected.remove();
                    item.classList.remove('d-none');
                    document
                        .querySelector(`input[name="interessent_ids[]"][value="${id}"]`)
                        ?.remove();

                    if (selectedIds.size === 0) {
                        emptyMsg.style.display = 'block';
                    }
                });

            selectedList.appendChild(selected);

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'interessent_ids[]';
            input.value = id;
            hiddenInputs.appendChild(input);
        });
    });

    searchInput?.addEventListener('input', function () {
        const q = this.value.toLowerCase();

        document
            .querySelectorAll('#availableInteressenten .list-group-item')
            .forEach(item => {

                if (selectedIds.has(item.dataset.id)) return;

                const name = item.dataset.name?.toLowerCase() ?? '';
                item.classList.toggle('d-none', !name.includes(q));
            });
    });

});
