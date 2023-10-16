<!-- Sidebar scroll-->
<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard.superadmin') }}" class="text-nowrap logo-img">

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
                <a class="sidebar-link" href="{{ route('dashboard.superadmin') }}" aria-expanded="false">
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
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.perolehan-suara') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Perolehan Suara</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.pemetaan-petugas') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Pemetaan Petugas</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.tps') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">TPS</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.dapil') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Dapil</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.kandidat') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-alert-circle"></i>
                    </span>
                    <span class="hide-menu">Kandidat</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.partai') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-alert-circle"></i>
                    </span>
                    <span class="hide-menu">Partai</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.superadmin.user') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-cards"></i>
                    </span>
                    <span class="hide-menu">Pengguna</span>
                </a>
            </li>
            
           
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->