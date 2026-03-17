document.addEventListener('DOMContentLoaded', () => {

    // AUTOGROW TEXTAREA
    document.querySelectorAll('.task-autogrow').forEach(el => {

        const resize = () => {
            if (!el.value) return;
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
        };

        el.addEventListener('input', resize);
        resize();
    });


    // DELETE EXISTING PHOTOS
    document.querySelectorAll('.repair-photo-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const item = document.getElementById('photo-' + id);

            item.style.display = 'none';

            item.querySelector('.delete-photo-input').disabled = false;
        });
    });


    // IMAGE PREVIEW + REMOVE (new uploads)
    const input = document.getElementById('repairPhotosInput');
    const preview = document.getElementById('repairPhotosPreview');

    if (!input || !preview) return;

    let filesArray = [];

    input.addEventListener('change', function () {
        const newFiles = Array.from(this.files);
        filesArray = filesArray.concat(newFiles);
        renderPreview();
    });

    function renderPreview() {

        // Ukloni samo preview nove slike (one bez id atributa)
        preview.querySelectorAll('.repair-photo-preview-item').forEach(el => el.remove());

        const dataTransfer = new DataTransfer();

        filesArray.forEach((file, index) => {

            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function (e) {

                const item = document.createElement('div');
                item.className = 'repair-photo-item repair-photo-preview-item';

                const img = document.createElement('img');
                img.className = 'img-fluid rounded';
                img.src = e.target.result;
                img.style.cursor = 'pointer';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-danger w-100 mt-1';
                removeBtn.style.cssText = 'padding: 1px 0; font-size: 0.7rem; line-height: 1.2;';
                removeBtn.textContent = 'Bild entfernen';

                removeBtn.addEventListener('click', () => {
                    filesArray.splice(index, 1);
                    renderPreview();
                });

                item.appendChild(img);
                item.appendChild(removeBtn);
                preview.appendChild(item);
            };

            reader.readAsDataURL(file);
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }

    // LIGHTBOX
    document.getElementById('photoModal')?.addEventListener('show.bs.modal', function (e) {
        const trigger = e.relatedTarget;
        document.getElementById('photoModalImg').src = trigger.dataset.src;
    });

});
