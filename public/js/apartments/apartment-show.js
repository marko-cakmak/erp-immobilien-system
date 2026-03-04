document.addEventListener('DOMContentLoaded', () => {
    restoreActiveTab();
    trackTabChanges();
});

function restoreActiveTab() {
    const hash = window.location.hash;
    if (!hash) {
        return;
    }

    const tab = document.querySelector(`[data-bs-target="${hash}"]`);
    if (tab) {
        bootstrap.Tab.getOrCreateInstance(tab).show();
    }
}

function trackTabChanges() {
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function () {
            history.replaceState(null, null, this.dataset.bsTarget);
        });
    });
}
