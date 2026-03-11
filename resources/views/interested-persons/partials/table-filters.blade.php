<tr class="table-light">

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="name"
               value="{{ request('name') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="email"
               value="{{ request('email') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="phone"
               value="{{ request('phone') }}"
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
               type="text"
               class="form-control form-control-sm"
               name="city"
               value="{{ request('city') }}"
               placeholder="Suchen..."
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th></th>

    <th>
        <select form="searchForm"
                class="form-select form-select-sm"
                name="is_active"
                onchange="document.getElementById('searchForm').submit()">

            <option value="">Alle</option>

            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>
                Aktiv
            </option>

            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>
                Inaktiv
            </option>

        </select>
    </th>

    <th class="text-center">

        @if(request()->hasAny(['name','email','phone','address','city','is_active']))

            <a href="{{ route('interested-persons.index') }}"
               class="btn btn-sm btn-secondary">

                <i class="bi bi-x-circle"></i>

            </a>

        @endif

    </th>

</tr>
