<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">KLINIK FAHEEMA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('home') }}">KH</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('home') }}"
                    class="nav-link"><i class="fa-solid fa-gauge-high"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master</li>
            <li class="nav-item dropdown {{ $type_menu === 'specialist_code' || $type_menu === 'doctor' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fa-solid fa-table"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Str::startsWith(request()->path(), 'specialistcode') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('specialistcode.index') }}">Kode Spesialis</a>
                    </li>
                    <li class="{{ Str::startsWith(request()->path(), 'doctor') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('doctor.index') }}">Dokter</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Lainnya</li>
            <li class="nav-item dropdown {{ $type_menu === 'user' || $type_menu === 'permission' || $type_menu === 'rolepermission' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fa-solid fa-screwdriver-wrench"></i> <span>Pengaturan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Str::startsWith(request()->path(), 'permission') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('permission.index') }}">Hak Akses</a>
                    </li>
                    <li class="{{ Str::startsWith(request()->path(), 'rolepermission') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('rolepermission.index') }}">Level Pengguna</a>
                    </li>
                    <li class="{{ Str::startsWith(request()->path(), 'user') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('user.index') }}">Akun Pengguna</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'clinicprofile' ? 'active' : '' }}">
                <a href="{{ route('clinicprofile.index') }}"
                    class="nav-link"><i class="fa-solid fa-house-medical-circle-check"></i><span>Profil Klinik</span></a>
            </li>
        </ul>
    </aside>
</div>
