<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/smk-budi-luhur.png') }}" alt="SMK Budi Luhur" style="max-width: 50px; max-height: 50px; width: auto; height: auto; object-fit: contain; border-radius: 5px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <i class="fas fa-school" style="display: none;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SMK Budi Luhur</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
            <!-- Nav Item - Absensi Siswa -->
            <li class="nav-item {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('absensi.index') }}">
                    <i class="fas fa-fw fa-clipboard-check"></i>
                    <span>Absensi Siswa</span>
                </a>
            </li>
            
            <!-- Nav Item - Absensi Guru -->
            <li class="nav-item {{ request()->routeIs('guru-absensi.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru-absensi.index') }}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Absensi Guru</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->isSiswa())
            <!-- Nav Item - Absensi Saya (untuk siswa) -->
            <li class="nav-item {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('absensi.create') }}">
                    <i class="fas fa-fw fa-clipboard-check"></i>
                    <span>Absensi Saya</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->isAdmin())
            <!-- Nav Item - Kelas -->
            <li class="nav-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelas.index') }}">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Kelas</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
            <!-- Nav Item - Laporan -->
            <li class="nav-item {{ request()->routeIs('laporan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('laporan') }}">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Laporan</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->isSiswa())
            <!-- Nav Item - Riwayat Absensi (untuk siswa) -->
            <li class="nav-item {{ request()->routeIs('dashboard.siswa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.siswa') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Riwayat Absensi</span>
                </a>
            </li>
        @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

