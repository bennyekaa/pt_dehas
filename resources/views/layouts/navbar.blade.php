<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo/kop.png') }}">
        </div>
        {{-- <div class="sidebar-brand-text mx-3">PT Dehas</div> --}}
    </a>
    <hr class="sidebar-divider my-0">

    @if (session('nama_role') == 'OPERATOR')
        {{-- <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Input Data Waduk</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Input Data Waduk</h6>
                    <a class="collapse-item"
                        href="{{ url('transaksi/mukaair/index') }}/{{ encrypt(session('id_role')) }}">Muka Air Waduk</a>
                    <a class="collapse-item"
                        href="{{ url('transaksi/bocor/index') }}/{{ encrypt(session('id_role')) }}">Indikasi Masalah</a>
                </div>
            </div>
        </li>
    @elseif(session('nama_role') == 'ADMIN')
        {{-- <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li> --}}

        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('import') }}">
            <i class="fas fa-fw fa-file-import"></i>
            <span>Import</span>
        </a>
    </li> -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
                aria-expanded="true" aria-controls="collapseMaster">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Master</span>
            </a>
            <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master</h6>
                    <a class="collapse-item" href="{{ url('bendungan') }}">Bendungan</a>
                    {{-- <a class="collapse-item" href="{{ url('desa') }}">Desa</a>
                    {{-- <a class="collapse-item" href="{{ url('device') }}">Device</a>
                    <a class="collapse-item" href="{{ url('kategoribocor') }}">Kategori Bocor</a>
                    <a class="collapse-item" href="{{ url('pengungsian') }}">Pengungsian</a>
                    <a class="collapse-item" href="{{ url('statusbocor') }}">Status Bocor</a>
                    <a class="collapse-item" href="{{ url('titikkumpul') }}">Titik Kumpul</a> --}}
                    <a class="collapse-item" href="{{ url('user') }}">User</a>
                    <a class="collapse-item" href="{{ url('jabatan') }}">Jabatan</a>
                    {{-- <a class="collapse-item" href="{{ url('peta') }}">Peta</a> --}}
                    {{-- <a class="collapse-item" href="{{ url('waduk') }}">Waduk</a> --}}
                    {{-- <a class="collapse-item" href="{{ url('web') }}">Website</a> --}}
                </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrans"
                aria-expanded="true" aria-controls="collapseTrans">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTrans" class="collapse" aria-labelledby="headingTrans" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Waduk</h6>
                    <a class="collapse-item"
                        href="{{ url('transaksi/mukaair/index') }}/{{ encrypt(session('id_role')) }}">Muka Air Waduk</a>
                    <a class="collapse-item"
                        href="{{ url('transaksi/bocor/index') }}/{{ encrypt(session('id_role')) }}">Indikasi Masalah</a>
                </div>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('laporan') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
        </li> --}}
    @elseif(session('nama_role') == 'DEWA')
        {{-- <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}

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

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('import') }}">
                <i class="fas fa-fw fa-file-import"></i>
                <span>Import</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
                aria-expanded="true" aria-controls="collapseMaster">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Master</span>
            </a>
            <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master</h6>
                    <a class="collapse-item" href="{{ url('bendungan') }}">Bendungan</a>
                    <a class="collapse-item" href="{{ url('desa') }}">Desa</a>
                    <a class="collapse-item" href="{{ url('device') }}">Device</a>
                    <a class="collapse-item" href="{{ url('kategoribocor') }}">Kategori Bocor</a>
                    <a class="collapse-item" href="{{ url('pengungsian') }}">Pengungsian</a>
                    <a class="collapse-item" href="{{ url('statusbocor') }}">Status Bocor</a>
                    <a class="collapse-item" href="{{ url('titikkumpul') }}">Titik Kumpul</a>
                    <a class="collapse-item" href="{{ url('user') }}">User</a>
                    <a class="collapse-item" href="{{ url('jabatan') }}">Jabatan</a>
                    <a class="collapse-item" href="{{ url('pendukung') }}">Pendukung</a>
                    <a class="collapse-item" href="{{ url('peta') }}">Peta</a>
                    <a class="collapse-item" href="{{ url('waduk') }}">Waduk</a>
                    <a class="collapse-item" href="{{ url('web') }}">Website</a>
                </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrans"
                aria-expanded="true" aria-controls="collapseTrans">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTrans" class="collapse" aria-labelledby="headingTrans" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Waduk</h6>
                    <a class="collapse-item"
                        href="{{ url('transaksi/mukaair/index') }}/{{ encrypt(session('id_role')) }}">Muka Air Waduk</a>
                    <a class="collapse-item"
                        href="{{ url('transaksi/bocor/index') }}/{{ encrypt(session('id_role')) }}">Indikasi Masalah</a>
                </div>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('laporan') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
        </li> --}}
    @elseif(session('nama_role') == 'DEVELOPER')
        {{-- <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li> --}}

        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('import') }}">
            <i class="fas fa-fw fa-file-import"></i>
            <span>Import</span>
        </a>
    </li> -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
                aria-expanded="true" aria-controls="collapseMaster">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Master</span>
            </a>
            <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master</h6>
                    <a class="collapse-item" href="{{ url('bendungan') }}">Bendungan</a>
                    <a class="collapse-item" href="{{ url('desa') }}">Desa</a>
                    <a class="collapse-item" href="{{ url('device') }}">Device</a>
                    <a class="collapse-item" href="{{ url('kategoribocor') }}">Kategori Bocor</a>
                    <a class="collapse-item" href="{{ url('pengungsian') }}">Pengungsian</a>
                    {{-- <a class="collapse-item" href="{{ url('statusbocor') }}">Status Bocor</a> --}}
                    <a class="collapse-item" href="{{ url('titikkumpul') }}">Titik Kumpul</a>
                    <a class="collapse-item" href="{{ url('user') }}">User</a>
                    <a class="collapse-item" href="{{ url('jabatan') }}">Jabatan</a>
                    {{-- <a class="collapse-item" href="{{ url('pendukung') }}">Pendukung</a> --}}
                    {{-- <a class="collapse-item" href="{{ url('peta') }}">Peta</a> --}}
                    <a class="collapse-item" href="{{ url('waduk') }}">Waduk</a>
                    <a class="collapse-item" href="{{ url('web') }}">Website</a>
                </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrans"
                aria-expanded="true" aria-controls="collapseTrans">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTrans" class="collapse" aria-labelledby="headingTrans" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Waduk</h6>
                    <a class="collapse-item"
                        href="{{ url('transaksi/mukaair/index') }}/{{ encrypt(session('id_role')) }}">Muka Air Waduk</a>
                    <a class="collapse-item"
                        href="{{ url('transaksi/bocor/index') }}/{{ encrypt(session('id_role')) }}">Indikasi Masalah</a>
                </div>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('laporan') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
        </li> --}}
    @elseif (session('nama_role') == 'BALAI')
        {{-- <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Detail Data Waduk<span class="right badge badge-danger">{{ session('total') }}</span></span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Detail Data Waduk</h6>
                    <a class="collapse-item"
                        href="{{ url('transaksi/mukaair/index') }}/{{ encrypt(session('id_role')) }}">Muka Air
                        Waduk<span class="right badge badge-danger">{{ session('hitungmukaair') }}</span></a>
                    <a class="collapse-item"
                        href="{{ url('transaksi/bocor/index') }}/{{ encrypt(session('id_role')) }}">Indikasi
                        Masalah<span class="right badge badge-danger">{{ session('hitungbocor') }}</span></a>
                </div>
            </div>
        </li>
        @if (session('menu') == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Cetak</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan</h6>
                        <a class="collapse-item" href="{{ url('laporan') }}">Data Bendungan</a>
                    </div>
                </div>
            </li>
        @endif
    @elseif (session('nama_role') == 'BPBD')
        {{-- <li class="nav-item {{ Request::segment(1) == '/' ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('detailbendungan') }}">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Detail Bendungan</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) == 'map' ? 'active' : '' }}" href="{{ url('map') }}">
                <i class="fas fa-fw fa-map-marked"></i>
                <span>Kelola Maps</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Detail Data Waduk<span class="right badge badge-danger">{{ session('total') }}</span></span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Detail Data Waduk</h6>
                    <a class="collapse-item"
                        href="{{ url('transaksi/mukaair/index') }}/{{ encrypt(session('id_role')) }}">Muka Air
                        Waduk<span class="right badge badge-danger">{{ session('hitungmukaair') }}</span></a>
                    <a class="collapse-item"
                        href="{{ url('transaksi/bocor/index') }}/{{ encrypt(session('id_role')) }}">Indikasi
                        Masalah<span class="right badge badge-danger">{{ session('hitungbocor') }}</span></a>
                </div>
            </div>
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
