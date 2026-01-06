<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}"
           class="brand-link"
           style="justify-content: flex-start; padding-left: 1rem;">
            <span class="brand-text fw-light">Immobilien ERP</span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="navigation" aria-label="Hauptnavigation">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Wohnungen -->
                @if(auth()->check() && auth()->user()->hasPermission('view_wohnungen'))
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link">
                            <i class="nav-icon bi bi-building"></i>
                            <p>Wohnungen</p>
                        </a>
                    </li>
                @endif

                <!-- Interessenten -->
                @if(auth()->check() && auth()->user()->hasPermission('view_interessenten'))
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>Interessenten</p>
                        </a>
                    </li>
                @endif

                <!-- Aufgaben -->
                @if(auth()->check() && auth()->user()->hasPermission('view_own_aufgaben'))
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link">
                            <i class="nav-icon bi bi-check2-square"></i>
                            <p>
                                Aufgaben
                                <span class="nav-badge badge text-bg-danger me-3">5</span>
                            </p>
                        </a>
                    </li>
                @endif

                @php
                    $canSeeVerwaltung =
                        auth()->check() &&
                        (
                            auth()->user()->hasPermission('manage_users') ||
                            auth()->user()->hasPermission('manage_settings')
                        );
                @endphp

                @if($canSeeVerwaltung)
                    <!-- Verwaltung -->
                    <li class="nav-header">VERWALTUNG</li>

                    <!-- Benutzer & Rollen -->
                    @if(auth()->user()->hasPermission('manage_users'))
                        <li class="nav-item">
                            <a href="#"
                               class="nav-link">
                                <i class="nav-icon bi bi-person-gear"></i>
                                <p>Benutzer & Rollen</p>
                            </a>
                        </li>
                    @endif

                    <!-- Berechtigungen -->
                    @if(auth()->user()->hasPermission('permissions.manage'))
                        <li class="nav-item">
                            <a href="#"
                               class="nav-link">
                                <i class="nav-icon bi bi-shield-lock"></i>
                                <p>Berechtigungen</p>
                            </a>
                        </li>
                    @endif
                @endif

            </ul>
        </nav>
    </div>
</aside>
