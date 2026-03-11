<tr class="table-light">

    <th>
        <input form="searchForm"
               type="number"
               class="form-control form-control-sm"
               name="id"
               value="{{ request('id') }}"
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="type"
               value="{{ request('type') }}"
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

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="assignee"
               value="{{ request('assignee') }}"
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="text"
               class="form-control form-control-sm"
               name="apartment"
               value="{{ request('apartment') }}"
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="date"
               class="form-control form-control-sm"
               name="deadline"
               value="{{ request('deadline') }}"
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th>
        <input form="searchForm"
               type="date"
               class="form-control form-control-sm"
               name="created"
               value="{{ request('created') }}"
               onchange="document.getElementById('searchForm').submit()">
    </th>

    <th class="text-center">

        @if(request()->hasAny(['id','type','status','assignee','apartment','deadline','created']))

            <a href="{{ route('tasks.index') }}"
               class="btn btn-sm btn-secondary">

                <i class="bi bi-x-circle"></i>

            </a>

        @endif

    </th>

</tr>
