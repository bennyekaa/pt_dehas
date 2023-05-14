<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo/pt_dehas.jpg') }}">
        </div>
        <div class="sidebar-brand-text mx-3">PT Dehas</div>
    </a>
    <hr class="sidebar-divider my-0">

    @if (session('role') == 0)
        <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Input Data Waduk</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Input Data Waduk</h6>
                    <a class="collapse-item" href="{{ url('transaksi/mukaair/index') }}">Waduk Banjir</a>
                    <a class="collapse-item" href="buttons.html">Waduk Bocor</a>
                </div>
            </div>
        </li>
    @elseif(session('role') == 1)

        <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('import') }}">
                <i class="fas fa-fw fa-file-import"></i>
                <span>Import</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Master</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master</h6>
                    <a class="collapse-item" href="{{ url('user') }}">User</a>
                    <a class="collapse-item" href="buttons.html">Waduk</a>
                    <a class="collapse-item" href="{{ url('bendungan') }}">Bendungan</a>
                    <a class="collapse-item" href="{{ url('desa') }}">Desa</a>
                    <a class="collapse-item" href="{{ url('titikkumpul') }}">Titik Kumpul</a>
                    <a class="collapse-item" href="{{ url('pengungsian') }}">Pengungsian</a>
                    <a class="collapse-item" href="{{ url('web') }}">Website</a>
                </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('banjir') }}">
                <i class="fas fa-fw fa-window-maximize"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
        </li>
    @endif



    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('user/tambah') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Register</span>
    </a>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Logout</span>
        </a>
    </li> --}}

    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
