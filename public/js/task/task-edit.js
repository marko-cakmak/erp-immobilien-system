document.addEventListener('DOMContentLoaded', function () {

    const form      = document.getElementById('besichtigungForm');
    const submitBtn = document.getElementById('besichtigungSubmit');

    if (!form) return;

    const fields = [
        { el: document.getElementById('besichtigungAt'), errorEl: document.getElementById('besichtigungAt-error'), required: true },
        { el: document.getElementById('statusSelect'),   errorEl: document.getElementById('statusSelect-error'),   required: true },
    ];

    const teilnehmerError = document.getElementById('teilnehmer-error');

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    function showError(el) {
        if (el) el.style.display = 'block';
    }

    function hideError(el) {
        if (el) el.style.display = 'none';
    }

    function validateField(field) {
        if (field.required && !field.el?.value) return false;
        return true;
    }

    // -------------------------------------------------------------------------
    // Live validation
    // -------------------------------------------------------------------------

    fields.forEach(field => {
        field.el?.addEventListener('change', function () {
            validateField(field) ? hideError(field.errorEl) : showError(field.errorEl);
        });
    });

    // -------------------------------------------------------------------------
    // Submit
    // -------------------------------------------------------------------------

    form.addEventListener('submit', function (e) {

        const validFields = fields.every(field => {
            if (validateField(field)) {
                hideError(field.errorEl);
                return true;
            }
            showError(field.errorEl);
            return false;
        });

        let teilnehmerValid = true;

        if (!window.selectedIds || window.selectedIds.size === 0) {
            showError(teilnehmerError);
            teilnehmerValid = false;
        } else {
            hideError(teilnehmerError);
        }

        if (!validFields || !teilnehmerValid) {
            e.preventDefault();

            const firstError =
                form.querySelector('[style*="display: block"]') ||
                form.querySelector('[style*="display:block"]');

            firstError?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Wird gespeichert...';
    });

});
