document.addEventListener('DOMContentLoaded', function () {

    const hash = window.location.hash;
    if (hash) {
        const tab = document.querySelector(`[data-bs-target="${hash}"]`);
        if (tab) bootstrap.Tab.getOrCreateInstance(tab).show();
    }

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function () {
            history.replaceState(null, null, this.dataset.bsTarget);
        });
    });

});
