{{-- LEFT PANEL - Wohnung wählen --}}
<div class="col-md-4">
    <div class="card mb-3">
        <div class="card-body">
            <label class="form-label fw-semibold">
                Wohnung wählen <span class="text-danger">*</span>
            </label>
            <div class="input-group mb-1">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                       class="form-control"
                       id="apartmentSearchInput"
                       placeholder="Nach Wohnung suchen..."
                       autocomplete="off"
                       data-url="{{ route('apartments.search') }}">
                <button type="button" class="btn btn-primary" id="apartmentSearchBtn">
                    <i class="bi bi-search"></i> Suchen
                </button>
            </div>
            <small id="apartmentSearchSpinner" class="text-center py-2" style="display: none;">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </small>
            <div id="apartmentResults" class="list-group mt-2"></div>
            <div id="selectedApartmentBox" class="mt-2" style="display: none;">
                <div class="d-flex align-items-center gap-2">
                    <div class="list-group-item list-group-item-success flex-grow-1">
                        <span id="selectedApartmentName"></span>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm py-0 px-1" id="clearApartmentBtn">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="apartment_id" id="apartmentId"
                   value="{{ old('apartment_id', $selectedApartmentId ?? '') }}">
            @error('apartment_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        const searchUrl = document.getElementById('apartmentSearchInput').dataset.url;--}}

{{--        document.getElementById('apartmentSearchBtn').addEventListener('click', performSearch);--}}

{{--        document.getElementById('apartmentSearchInput').addEventListener('keydown', function (e) {--}}
{{--            if (e.key === 'Enter') {--}}
{{--                e.preventDefault();--}}
{{--                performSearch();--}}
{{--            }--}}
{{--        });--}}

{{--        document.getElementById('clearApartmentBtn').addEventListener('click', function () {--}}
{{--            document.getElementById('apartmentId').value = '';--}}
{{--            document.getElementById('selectedApartmentBox').style.display = 'none';--}}
{{--            document.getElementById('apartmentSearchInput').value = '';--}}
{{--            document.getElementById('apartmentResults').innerHTML = '';--}}
{{--        });--}}

{{--        async function performSearch() {--}}
{{--            const query = document.getElementById('apartmentSearchInput').value.trim();--}}

{{--            document.getElementById('apartmentSearchSpinner').style.display = 'block';--}}
{{--            document.getElementById('apartmentResults').innerHTML = '';--}}

{{--            try {--}}
{{--                const params = new URLSearchParams();--}}
{{--                if (query) params.append('q', query);--}}

{{--                const response = await fetch(`${searchUrl}?${params.toString()}`, {--}}
{{--                    headers: { 'Accept': 'application/json' }--}}
{{--                });--}}

{{--                if (!response.ok) throw new Error('Fehler');--}}

{{--                const results = await response.json();--}}
{{--                renderResults(results);--}}

{{--            } catch (error) {--}}
{{--                console.error('Suchfehler:', error);--}}
{{--            } finally {--}}
{{--                document.getElementById('apartmentSearchSpinner').style.display = 'none';--}}
{{--            }--}}
{{--        }--}}

{{--        function renderResults(results) {--}}
{{--            const container = document.getElementById('apartmentResults');--}}

{{--            if (results.length === 0) {--}}
{{--                container.innerHTML = '<div class="list-group-item text-muted">Keine Ergebnisse gefunden.</div>';--}}
{{--                return;--}}
{{--            }--}}

{{--            container.innerHTML = results.map(apartment => `--}}
{{--            <div class="list-group-item list-group-item-action"--}}
{{--                 style="cursor: pointer;"--}}
{{--                 onclick="selectApartment(${apartment.id}, '${apartment.title} — ${apartment.street_address}, ${apartment.city}')">--}}
{{--                <div class="fw-semibold">${apartment.title}</div>--}}
{{--                <small class="text-muted">${apartment.street_address}, ${apartment.postal_code} ${apartment.city}</small>--}}
{{--            </div>--}}
{{--        `).join('');--}}
{{--        }--}}

{{--        window.selectApartment = function(id, name) {--}}
{{--            document.getElementById('apartmentId').value = id;--}}
{{--            document.getElementById('selectedApartmentName').textContent = name;--}}
{{--            document.getElementById('selectedApartmentBox').style.display = 'block';--}}
{{--            document.getElementById('apartmentResults').innerHTML = '';--}}
{{--            document.getElementById('apartmentSearchInput').value = '';--}}
{{--        };--}}

{{--        window.selectApartment = function(id, name) {--}}
{{--            document.getElementById('apartmentId').value = id;--}}
{{--            document.getElementById('selectedApartmentName').textContent = name;--}}
{{--            document.getElementById('selectedApartmentBox').style.display = 'block';--}}
{{--            document.getElementById('apartmentResults').innerHTML = '';--}}
{{--            document.getElementById('apartmentSearchInput').value = '';--}}
{{--        };--}}

{{--        // inicijalni render ako dolazimo sa apartment_id u URL-u--}}
{{--        @if(isset($selectedApartment) && $selectedApartment)--}}
{{--        selectApartment(--}}
{{--            {{ $selectedApartment->id }},--}}
{{--            '{{ $selectedApartment->title }} — {{ $selectedApartment->street_address }}, {{ $selectedApartment->city }}'--}}
{{--        );--}}
{{--        @endif--}}

{{--    });--}}
{{--</script>--}}


