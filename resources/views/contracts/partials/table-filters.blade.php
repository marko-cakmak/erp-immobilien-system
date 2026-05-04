<tr class="table-light">

    <th></th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="apartment"
               value="{{ request('apartment') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="interested_person"
               value="{{ request('interested_person') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <select form="searchForm"
                class="form-select form-select-sm"
                name="status"
                onchange="document.getElementById('searchForm').submit()">
            <option value="">Alle</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                    {{ request('status') == $status->id ? 'selected' : '' }}>
                    {{ $status->name }}
                </option>
            @endforeach
        </select>
    </th>

    <th></th>
    <th></th>

    <th class="text-center">
        @if(request()->hasAny(['apartment', 'interested_person', 'status']))
            <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-x-circle"></i>
            </a>
        @endif
    </th>

</tr>
