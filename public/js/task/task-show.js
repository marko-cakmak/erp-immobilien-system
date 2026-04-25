document.addEventListener('DOMContentLoaded', function () {

    const hash = window.location.hash;
    if (hash) {
        setTimeout(function () {
            const tab = document.querySelector(`[data-bs-target="${hash}"]`);
            if (tab) bootstrap.Tab.getOrCreateInstance(tab).show();
        }, 100);
    }

    if (document.querySelector('.alert')) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function () {
            history.replaceState(null, null, this.dataset.bsTarget);
        });
    });

});
