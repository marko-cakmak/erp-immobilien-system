// Image Upload for Apartment Edit Page
window.triggerUpload = function(i) {
    document.getElementById('image_input_' + i).click();
};

window.previewImage = function(input, i) {
    if (!input.files[0]) return;

    const r = new FileReader();
    r.onload = e => {
        const s = document.querySelector('.image-slot[data-index="' + i + '"]');
        s.querySelector('.image-preview')?.remove();
        s.querySelector('.image-action')?.remove();
        s.querySelector('.image-placeholder')?.remove();

        s.insertAdjacentHTML('afterbegin', `
            <div class="image-preview">
                <img src="${e.target.result}">
            </div>
            <div class="image-action">
                <button type="button"
                        class="btn btn-sm btn-outline-danger w-100"
                        onclick="cancelNewImage(${i})">
                    Bild löschen
                </button>
            </div>
        `);
    };
    r.readAsDataURL(input.files[0]);
};

window.cancelNewImage = function(i) {

    const fileInput = document.getElementById('image_input_' + i);
    fileInput.value = '';

    const s = document.querySelector('.image-slot[data-index="' + i + '"]');

    const deleteInput = document.getElementById('delete_image_' + i);
    const hasOriginalImage = deleteInput && deleteInput.dataset.originalId;

    if (hasOriginalImage) {

        const originalSrc = deleteInput.dataset.originalSrc;
        const originalId = deleteInput.dataset.originalId;

        s.innerHTML = `
            <div class="image-preview">
                <img src="${originalSrc}">
            </div>
            <div class="image-action">
                <button type="button"
                        class="btn btn-sm btn-outline-danger w-100"
                        onclick="removeImage(${i}, ${originalId})">
                    Bild löschen
                </button>
            </div>
            <input type="hidden" name="delete_images[]" id="delete_image_${i}" value=""
                   data-original-id="${originalId}" data-original-src="${originalSrc}">
            <input type="file" class="d-none" name="images[${i}]"
                   id="image_input_${i}" accept="image/*"
                   onchange="previewImage(this,${i})">
        `;
    } else {

        const iconSize = i === 0 ? 'fs-2' : '';
        const text = i === 0 ? 'Titelbild hochladen' : 'Bild hochladen';
        const textClass = i === 0 ? '' : 'small';

        s.innerHTML = `
            <div class="image-placeholder text-muted" onclick="triggerUpload(${i})">
                <i class="bi bi-plus-circle ${iconSize}"></i>
                <span class="${textClass}">${text}</span>
            </div>
            <input type="file" class="d-none" name="images[${i}]"
                   id="image_input_${i}" accept="image/*"
                   onchange="previewImage(this,${i})">
        `;
    }
};

window.removeImage = function(i, id) {

    const deleteInput = document.getElementById('delete_image_' + i);
    if (deleteInput) {
        deleteInput.value = id;
    }

    const s = document.querySelector('.image-slot[data-index="' + i + '"]');
    const iconSize = i === 0 ? 'fs-2' : '';
    const text = i === 0 ? 'Titelbild hochladen' : 'Bild hochladen';
    const textClass = i === 0 ? '' : 'small';

    s.innerHTML = `
        <div class="image-placeholder text-muted" onclick="triggerUpload(${i})">
            <i class="bi bi-plus-circle ${iconSize}"></i>
            <span class="${textClass}">${text}</span>
        </div>
        <input type="hidden" name="delete_images[]" id="delete_image_${i}" value="${id}">
        <input type="file" class="d-none" name="images[${i}]"
               id="image_input_${i}" accept="image/*"
               onchange="previewImage(this,${i})">
    `;
};
