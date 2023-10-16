<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hitung Suara</title>
    <link rel="shortcut icon" type="image/png" href=" {{ asset('modernize/src/assets/images/logos/favicon.png') }} " />
    <link rel="stylesheet" href="{{ asset('modernize/src/assets/css/styles.min.css') }}" />
    <link rel="icon" href="{{ asset('modernize/src/assets/images/icon/3d-cube.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('modernize/src/assets/libs/apexcharts/dist/apexcharts.css') }}">
    {{-- data table --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    {{-- data table --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @yield('css-page')
</head>

<body>
  <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            @if(Auth::user()->id_role === 1)
                @include('templating.components.super_admin_sidebar')
            @elseif(Auth::user()->id_role === 2)
                @include('templating.components.admin_sidebar')
            @elseif(Auth::user()->id_role === 3)
                @php
                    $isRegisteredToTPS = App\Models\DetailLocationOfVotingPlace::where('id_user', Auth::user()->id)->count();
                @endphp
                    @if( $isRegisteredToTPS > 0) {{-- kl sudah ada tpsnya  --}}
                        @include('templating.components.user_sidebar')
                    @else
                        @include('templating.components.handling_if_no_tps')
                    @endif
            @endif
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                    </li>

                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li>
                            {{ Auth::user()->name }}
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                                <img src="{{ asset('modernize/src/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="/profile" class="d-flex align-items-center gap-2 dropdown-item mb-4">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary m-auto d-block">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid">
            @yield('main-content')
        </div>
        </div>
    </div>
    <script src="{{ asset('modernize/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/js/dashboard.js') }}"></script>

    {{-- datatable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    {{-- datatable button --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    @yield('js-page')

</body>

</html>