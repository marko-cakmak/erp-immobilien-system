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


    // IMAGE PREVIEW + REMOVE
    const input = document.getElementById('repairPhotosInput');
    const preview = document.getElementById('repairPhotosPreview');

    if (!input || !preview) return;

    let filesArray = [];

    input.addEventListener('change', function () {

        filesArray = Array.from(this.files);
        renderPreview();

    });


    function renderPreview() {

        preview.innerHTML = '';

        const dataTransfer = new DataTransfer();

        filesArray.forEach((file, index) => {

            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function (e) {

                const item = document.createElement('div');
                item.className = 'repair-photo-preview-item';

                const img = document.createElement('img');
                img.className = 'repair-photo-preview-thumb';
                img.src = e.target.result;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'repair-photo-remove';
                removeBtn.textContent = 'Remove';

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

});
