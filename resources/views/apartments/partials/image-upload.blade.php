<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Bilder</h3>
        @if($mode === 'create')
            <small class="text-muted">1 Titelbild + 3 weitere Bilder</small>
        @endif
    </div>

    <div class="card-body">
        @php
            $existingImages = $mode === 'edit' ? $images->values() : collect();
        @endphp

        {{-- TITELBILD --}}
        <div class="mb-3">
            <div class="border rounded p-2 image-slot" style="height:400px;" data-index="0">

                @if($mode === 'edit' && isset($existingImages[0]))
                    <div class="image-preview">
                        <img src="{{ asset('storage/'.$existingImages[0]->path) }}">
                    </div>
                    <div class="image-action">
                        <button type="button"
                                class="btn btn-sm btn-outline-danger w-100"
                                onclick="removeImage(0, {{ $existingImages[0]->id }})">
                            Bild löschen
                        </button>
                    </div>
                    <input type="hidden"
                           name="delete_images[]"
                           id="delete_image_0"
                           value=""
                           data-original-id="{{ $existingImages[0]->id }}"
                           data-original-src="{{ asset('storage/'.$existingImages[0]->path) }}">
                @else
                    <div class="image-placeholder text-muted" onclick="triggerUpload(0)">
                        <i class="bi bi-plus-circle fs-2"></i>
                        <span>Titelbild hochladen</span>
                    </div>
                @endif

                <input type="file"
                       class="d-none"
                       name="images[0]"
                       id="image_input_0"
                       accept="image/*"
                       onchange="previewImage(this,0)">
            </div>
        </div>

        {{-- WEITERE BILDER --}}
        <div class="row g-3">
            @for($i=1; $i<4; $i++)
                <div class="col-4">
                    <div class="border rounded p-2 image-slot" style="height:140px;" data-index="{{ $i }}">

                        @if($mode === 'edit' && isset($existingImages[$i]))
                            <div class="image-preview">
                                <img src="{{ asset('storage/'.$existingImages[$i]->path) }}">
                            </div>
                            <div class="image-action">
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger w-100"
                                        onclick="removeImage({{ $i }}, {{ $existingImages[$i]->id }})">
                                    Bild löschen
                                </button>
                            </div>
                            <input type="hidden"
                                   name="delete_images[]"
                                   id="delete_image_{{ $i }}"
                                   value=""
                                   data-original-id="{{ $existingImages[$i]->id }}"
                                   data-original-src="{{ asset('storage/'.$existingImages[$i]->path) }}">
                        @else
                            <div class="image-placeholder text-muted" onclick="triggerUpload({{ $i }})">
                                <i class="bi bi-plus-circle"></i>
                                <span class="small">Bild hochladen</span>
                            </div>
                        @endif

                        <input type="file"
                               class="d-none"
                               name="images[{{ $i }}]"
                               id="image_input_{{ $i }}"
                               accept="image/*"
                               onchange="previewImage(this,{{ $i }})">
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
