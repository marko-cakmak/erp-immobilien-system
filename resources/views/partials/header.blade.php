<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <span class="nav-link fw-bold">Immobilien ERP</span>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-4 me-1"></i>
                    <span class="d-none d-md-inline">{{ Auth::user()?->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                    <li>
                        <a href="#" class="dropdown-item text-danger py-3">
                            <i class="bi bi-box-arrow-right me-2"></i> Abmelden
                        </a>
                    </li>
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
</nav>
