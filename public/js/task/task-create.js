document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('taskForm');
    const submitBtn = document.getElementById('submitBtn');

    const typeSelect = document.getElementById('typeSelect');
    const repairTypeSelect = document.getElementById('repairTypeSelect');

    const fields = [
        { el: document.getElementById('apartmentSelect'), errorId: 'apartmentSelect-error', message: 'Bitte eine Wohnung auswählen.', required: true },
        { el: typeSelect, errorId: 'typeSelect-error', message: 'Bitte einen Aufgabentyp wählen.', required: true },
        { el: repairTypeSelect, errorId: 'repairType-error', message: 'Bitte einen Reparaturtyp wählen.', required: false },
        { el: document.getElementById('assignedTo'), errorId: 'assignedTo-error', message: 'Bitte einen Bearbeiter auswählen.', required: true },
        { el: document.getElementById('deadlineAt'), errorId: 'deadlineAt-error', message: 'Das Datum muss in der Zukunft liegen.', required: false, validate: el => !el.value || new Date(el.value) > new Date() },
    ];

    const deadlineAt = document.getElementById('deadlineAt');

    if (deadlineAt) {

        const now = new Date();
        const pad = n => String(n).padStart(2, '0');

        deadlineAt.setAttribute(
            'min',
            `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`
        );

    }

    const messageEl = document.getElementById('messageInput');
    const charCount = document.getElementById('charCount');

    if (messageEl && charCount) {

        charCount.textContent = messageEl.value.length;

        messageEl.addEventListener('input', () => {
            charCount.textContent = messageEl.value.length;
        });

    }

    function setInvalid(field) {

        if (!field.el) return;

        field.el.classList.add('is-invalid');
        field.el.classList.remove('is-valid');

        const div = document.getElementById(field.errorId);

        if (div && !div.dataset.serverError) {
            div.textContent = field.message;
        }

    }

    function setValid(el) {

        if (!el) return;

        el.classList.remove('is-invalid');
        el.classList.add('is-valid');

    }

    function validateField(field) {

        if (!field.el) return true;

        const selectedTypeKey =
            typeSelect?.selectedOptions[0]?.dataset?.key;

        // Reparatur zahtijeva repair type
        if (field.el === repairTypeSelect && selectedTypeKey === 'reparatur') {
            return !!repairTypeSelect.value;
        }

        if (field.required && !field.el.value) return false;

        if (field.validate && !field.validate(field.el)) return false;

        return true;

    }

    fields.forEach(field => {

        if (!field.el) return;

        field.el.addEventListener('change', function () {
            validateField(field) ? setValid(this) : setInvalid(field);
        });

    });

    function toggleRepairType() {

        const wrapper = document.getElementById('repairTypeWrapper');

        if (!repairTypeSelect || !typeSelect || !wrapper) return;

        const selectedTypeKey =
            typeSelect?.selectedOptions[0]?.dataset?.key;

        if (selectedTypeKey === 'reparatur') {

            wrapper.style.visibility = 'visible';
            repairTypeSelect.disabled = false;

        } else {

            wrapper.style.visibility = 'hidden';
            repairTypeSelect.disabled = true;
            repairTypeSelect.value = '';

        }

    }

    if (typeSelect) {
        typeSelect.addEventListener('change', toggleRepairType);
    }

    toggleRepairType();

    if (form) {

        form.addEventListener('submit', function (e) {

            const valid = fields.every(field => {

                if (validateField(field)) {
                    setValid(field.el);
                    return true;
                }

                setInvalid(field);
                return false;

            });

            if (!valid) {

                e.preventDefault();

                const firstError = form.querySelector('.is-invalid');

                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }

                return;

            }

            if (submitBtn) {

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Wird gespeichert...';

            }

        });

    }

});
