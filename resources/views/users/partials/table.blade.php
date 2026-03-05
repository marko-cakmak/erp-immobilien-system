<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Benutzername</th>
        <th>E-Mail</th>
        <th>Rolle</th>
        <th style="width: 150px">Aktionen</th>
    </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
        <tr class="align-middle">
            <td>{{ $users->firstItem() + $loop->index }}</td>

            <td>
                {{ $user->name }}
                @if($user->id === auth()->id())
                    <span class="badge bg-info text-dark ms-1">Sie</span>
                @endif
            </td>

            <td>
                    <span class="text-primary fw-semibold">
                        {{ $user->username ?? '–' }}
                    </span>
            </td>

            <td>{{ $user->email }}</td>

            <td>
                @if($user->role)
                    <span class="text-primary fw-semibold">
                            {{ $user->role->name }}
                        </span>
                @else
                    <span class="text-muted">–</span>
                @endif
            </td>

            <td>
                <a href="{{ route('users.edit', $user) }}"
                   class="btn btn-sm btn-info me-1"
                   title="Bearbeiten">
                    <i class="bi bi-pencil"></i>
                </a>

                @if($user->id !== auth()->id())
                    <form action="{{ route('users.destroy', $user) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-danger"
                                title="Löschen">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">
                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                <p class="mb-0 mt-2">Keine Benutzer gefunden.</p>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
