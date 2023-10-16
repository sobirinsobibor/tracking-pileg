<!-- Sidebar scroll-->
<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard.user') }}" class="text-nowrap logo-img">

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
                <a class="sidebar-link" href="{{ route('dashboard.user') }}" aria-expanded="false">
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
                <a class="sidebar-link" href="{{ route('dashboard.user.perolehan-suara') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Perolehan Suara</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.user.lokasi-penugasan') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Dapil & TPS</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.user.kandidat') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-alert-circle"></i>
                    </span>
                    <span class="hide-menu">Kandidat</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.user.partai') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-alert-circle"></i>
                    </span>
                    <span class="hide-menu">Partai</span>
                </a>
            </li>
           
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->