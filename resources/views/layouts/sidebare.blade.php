<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistem Peminjaman</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (strpos(Route::currentRouteName(), 'dashboard') == 'false') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard')}}">
            <i class="fas fa-fw fa-columns"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>User Management</span>
        </a>
        <div id="collapseTwo" class="collapse {{ (strpos(Route::currentRouteName(), 'user_management') == 'false') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'user_management.role') == 'false') ? 'active' : '' }}" href="{{ route('user_management.role.index') }}">Roles</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoMaster"
            aria-expanded="true" aria-controls="collapseTwoMaster">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwoMaster" class="collapse {{ (strpos(Route::currentRouteName(), 'master') == 'false') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data:</h6>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'master.kategori') == 'false') ? 'active' : '' }}" href="{{ route('master.kategori.index') }}">Kategori</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'master.buku') == 'false') ? 'active' : '' }}" href="{{ route('master.buku.index') }}">Buku</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'master.pengunjung') == 'false') ? 'active' : '' }}" href="{{ route('master.pengunjung.index') }}">Pengunjung</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ (strpos(Route::currentRouteName(), 'pengunjung_bermasalah') == 'false') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengunjung_bermasalah.index') }}">
        <i class="fas fa-user fa-columns"></i>
        <span> Pengunjung Bermasalah</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Transaksi</span>
        </a>
        {{-- {{ dd(  strpos(Route::currentRouteName(),'rekap_transaksi')  )   }} --}}
        <div id="collapseUtilities" class="collapse {{ (strpos(Route::currentRouteName(), 'transaksi') == 'false') ? 'show' : '' }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi:</h6>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'transaksi.peminjaman') == 'false') ? 'active' : '' }}" href="{{ route('transaksi.peminjaman.index') }}">Peminjaman</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'transaksi.pengembalian') == 'false') ? 'active' : '' }}" href="{{ route('transaksi.pengembalian.index') }}">Pengembalian</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksiBermasalah"
            aria-expanded="true" aria-controls="transaksiBermasalah">
            <i class="fas fa-fw fa-list"></i>
            <span>Daftar Transaksi</span>
        </a>
        <div id="transaksiBermasalah" class="collapse {{ (strpos(Route::currentRouteName(), 'daftar_transaksi') == 'false') ? 'show' : '' }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Transaksi:</h6>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'daftar_transaksi.berhasil') == 'false') ? 'active' : '' }}" href="{{ route('daftar_transaksi.berhasil.index') }}">Berhasil</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'daftar_transaksi.belum_kembali') == 'false') ? 'active' : '' }}" href="{{ route('daftar_transaksi.belum_kembali.index') }}">Belum Kembali</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'daftar_transaksi.terlambat') == 'false') ? 'active' : '' }}" href="{{ route('daftar_transaksi.terlambat.index') }}">Terlambat</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#RekapTransaksi"
            aria-expanded="true" aria-controls="RekapTransaksi">
            <i class="fas fa-fw fa-download"></i>
            <span>Rekap Transaksi</span>
        </a>
        <div id="RekapTransaksi" class="collapse {{ (strpos(Route::currentRouteName(), 'rekap_transaksi') == 'false') ? 'show' : '' }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Rekap Transaksi:</h6>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'rekap_transaksi.berhasil') == 'false') ? 'active' : '' }}" href="{{ route('rekap_transaksi.berhasil.index') }}">Berhasil</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'rekap_transaksi.belum_kembali') == 'false') ? 'active' : '' }}" href="{{ route('rekap_transaksi.belum_kembali.index') }}">Belum Kembali</a>
                <a class="collapse-item {{ (strpos(Route::currentRouteName(), 'rekap_transaksi.terlambat') == 'false') ? 'active' : '' }}" href="{{ route('rekap_transaksi.terlambat.index') }}">Terlambat</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-address-book"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
