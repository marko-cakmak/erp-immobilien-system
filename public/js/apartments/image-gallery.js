// Image Gallery for Apartment Show Page
(function() {
    const images = window.apartmentImages || [];
    let currentIndex = 0;

    // Open modal with specific image
    window.openImageModal = function(index) {
        currentIndex = index;
        document.getElementById('modalImage').src = images[currentIndex];
        new bootstrap.Modal(document.getElementById('imageModal')).show();
        updateButtons();
        updateCounter();
    };

    // Update navigation buttons
    function updateButtons() {
        document.getElementById('prevBtn').style.display = currentIndex === 0 ? 'none' : 'block';
        document.getElementById('nextBtn').style.display = currentIndex === images.length - 1 ? 'none' : 'block';
    }

    // Update image counter
    function updateCounter() {
        document.getElementById('imageCounter').textContent = `${currentIndex + 1} / ${images.length}`;
    }

    // Previous image
    document.getElementById('prevBtn')?.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            document.getElementById('modalImage').src = images[currentIndex];
            updateButtons();
            updateCounter();
        }
    });

    // Next image
    document.getElementById('nextBtn')?.addEventListener('click', function() {
        if (currentIndex < images.length - 1) {
            currentIndex++;
            document.getElementById('modalImage').src = images[currentIndex];
            updateButtons();
            updateCounter();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('imageModal');
        if (modal && modal.classList.contains('show')) {
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex--;
                document.getElementById('modalImage').src = images[currentIndex];
                updateButtons();
                updateCounter();
            } else if (e.key === 'ArrowRight' && currentIndex < images.length - 1) {
                currentIndex++;
                document.getElementById('modalImage').src = images[currentIndex];
                updateButtons();
                updateCounter();
            } else if (e.key === 'Escape') {
                bootstrap.Modal.getInstance(modal)?.hide();
            }
        }
    });
})();
