// Image Upload for Apartment Create Page
window.triggerUpload = function(i) {
    document.getElementById('image_input_' + i).click();
};

window.previewImage = function(input, i) {
    if (!input.files[0]) return;

    const r = new FileReader();
    r.onload = e => {
        const s = document.querySelector('.image-slot[data-index="' + i + '"]');

        const placeholder = s.querySelector('.image-placeholder');
        if (placeholder) {
            placeholder.style.display = 'none';
        }

        let preview = s.querySelector('.image-preview');
        if (!preview) {
            preview = document.createElement('div');
            preview.className = 'image-preview';
            s.insertBefore(preview, s.firstChild);
        }
        preview.innerHTML = `<img src="${e.target.result}">`;

        let action = s.querySelector('.image-action');
        if (!action) {
            action = document.createElement('div');
            action.className = 'image-action';
            s.appendChild(action);
        }
        action.innerHTML = `
            <button type="button"
                    class="btn btn-sm btn-outline-danger w-100"
                    onclick="cancelNewImage(${i})">
                Bild löschen
            </button>
        `;
    };
    r.readAsDataURL(input.files[0]);
};

window.cancelNewImage = function(i) {
    const s = document.querySelector('.image-slot[data-index="' + i + '"]');

    const preview = s.querySelector('.image-preview');
    if (preview) preview.remove();

    const action = s.querySelector('.image-action');
    if (action) action.remove();

    const placeholder = s.querySelector('.image-placeholder');
    if (placeholder) {
        placeholder.style.display = 'flex';
    }

    document.getElementById('image_input_' + i).value = '';
};
