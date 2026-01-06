<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text fw-light">Immobilien ERP</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" role="navigation" aria-label="Hauptnavigation">

                <!--begin::Dashboard-->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!--end::Dashboard-->

                <!--begin::Wohnungen-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-building"></i>
                        <p>Wohnungen</p>
                    </a>
                </li>
                <!--end::Wohnungen-->

                <!--begin::Interessenten-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Interessenten</p>
                    </a>
                </li>
                <!--end::Interessenten-->

                <!--begin::Aufgaben-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-check2-square"></i>
                        <p>
                            Aufgaben
                            <span class="nav-badge badge text-bg-danger me-3">5</span>
                        </p>
                    </a>
                </li>
                <!--end::Aufgaben-->

                <!--begin::Separator-->
                <li class="nav-header">VERWALTUNG</li>
                <!--end::Separator-->

                <!--begin::Benutzer-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-gear"></i>
                        <p>Benutzer & Rollen</p>
                    </a>
                </li>
                <!--end::Benutzer-->

                <!--begin::Einstellungen-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Einstellungen</p>
                    </a>
                </li>
                <!--end::Einstellungen-->

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
