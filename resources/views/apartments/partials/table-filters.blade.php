<tr class="table-light">

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="title"
               value="{{ request('title') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="internal_number"
               value="{{ request('internal_number') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="address"
               value="{{ request('address') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="number"
               step="0.5"
               class="form-control form-control-sm"
               name="rooms"
               value="{{ request('rooms') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th></th>

    <th></th>

    <th>
        <select form="searchForm"
                class="form-select form-select-sm"
                name="status"
                onchange="document.getElementById('searchForm').submit()">

            <option value="">Alle</option>

            @foreach($statuses as $status)

                <option value="{{ $status->id }}"
                    {{ request('status') == $status->id ? 'selected' : '' }}>

                    {{ $status->label }}

                </option>

            @endforeach

        </select>
    </th>

    <th class="text-center">

        @if(request()->hasAny(['internal_number','title','address','rooms','status']))

            <a href="{{ route('apartments.index') }}"
               class="btn btn-sm btn-secondary">

                <i class="bi bi-x-circle"></i>

            </a>

        @endif

    </th>

</tr>
