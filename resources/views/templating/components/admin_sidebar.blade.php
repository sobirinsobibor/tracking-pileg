<!-- Sidebar scroll-->
<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard.admin') }}" class="text-nowrap logo-img">
            
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Menu</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.perolehan-suara') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-bar-chart-fill"></i>
                    </span>
                    <span class="hide-menu">Perolehan Suara</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.pemetaan-petugas') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-person-vcard-fill"></i>
                    </span>
                    <span class="hide-menu">Pemetaan Petugas</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.tps') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </span>
                    <span class="hide-menu">TPS</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.dapil') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Dapil</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.kandidat') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-person-square"></i>
                    </span>
                    <span class="hide-menu">Kandidat</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.partai') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-flag-fill"></i>
                    </span>
                    <span class="hide-menu">Partai</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.desa') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-flag-fill"></i>
                    </span>
                    <span class="hide-menu">Desa</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.kecamatan') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-flag-fill"></i>
                    </span>
                    <span class="hide-menu">Kecamatan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.admin.user') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-people-fill"></i>
                    </span>
                    <span class="hide-menu">Pengguna</span>
                </a>
            </li>
           
           
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->