<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative">
                {{-- Close button --}}
                <button type="button"
                        class="btn-close btn-close-white position-absolute top-0 end-0 m-3 modal-close-btn"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>

                {{-- Image --}}
                <img id="modalImage"
                     src=""
                     class="img-fluid rounded"
                     alt="Apartment image"
                     style="max-height: 90vh; width: 100%; object-fit: contain;">

                {{-- Navigation buttons overlay --}}
                <button type="button"
                        id="prevBtn"
                        class="btn btn-dark position-absolute top-50 start-0 translate-middle-y ms-3 modal-nav-btn">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <button type="button"
                        id="nextBtn"
                        class="btn btn-dark position-absolute top-50 end-0 translate-middle-y me-3 modal-nav-btn">
                    <i class="bi bi-chevron-right"></i>
                </button>

                {{-- Image counter --}}
                <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3 bg-dark text-white px-3 py-1 rounded modal-image-counter">
                    <span id="imageCounter">1 / {{ $imageCount }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
