<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}">
            <div>
                <img src="/img/tablogo.png" class="logo-icon" alt="logo icon">
            </div>
        </a>
        <a href="{{ route('admin.dashboard') }}">
            <div class="text-center">
                <h4 class="logo-text">&nbsp;SIMPUS</h4>
            </div>
        </a>
        <div class="toggle-icon ms-auto mt-2"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @cannot('root')
            <li class="{{ Request::is('dashboard*') ? 'mm-active border-end border-0 border-4 border-danger' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bxs-user-badge'></i>
                    </div>
                    <div class="menu-title">DASHBOARD</div>
                </a>
            </li>
        @endcannot
        @can('root')
            <li class="{{ Request::is('dashboard*') ? 'mm-active border-end border-0 border-4 border-danger' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/master/*') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-data'></i>
                    </div>
                    <div class="menu-title">Data Master</div>
                </a>
                <ul class="{{ Request::is('admin/master/*') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                    <li class="{{ Request::is('admin/master/obat*') ? 'mm-active border-end border-0 border-4 border-danger' : '' }}">
                        <a href="{{ route('admin.obat.index') }}"><i class='bx bx-radio-circle'></i>Data Obat</a>
                    </li>
                    <li class="{{ Request::is('admin/master/dokter*') ? 'mm-active border-end border-0 border-4 border-danger' : '' }}">
                        <a href="{{ route('admin.dokter.index') }}"><i class='bx bx-radio-circle'></i>Data Dokter</a>
                    </li>
                    <li class="{{ Request::is('admin/master/user*') ? 'mm-active border-end border-0 border-4 border-danger' : '' }}">
                        <a href="{{ route('admin.user.index') }}"><i class='bx bx-radio-circle'></i>Data User</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('dashboard/laporan/*') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bxs-report'></i>
                    </div>
                    <div class="menu-title">Laporan</div>
                </a>
                <ul class="{{ Request::is('dashboard/laporan/*') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                    <li class="{{ Request::is('dashboard/laporan/berobat*') ? 'mm-active border-end border-0 border-4 border-danger' : '' }}">
                        <a href="{{ route('admin.laporan.berobat') }}"><i class='bx bx-radio-circle'></i>Laporan Berobat</a>
                    </li>
                </ul>
            </li>
        @endcan
    </ul>
    <div class="sidebar-footer">
        <p class="mb-0">Puskesmas Siulak Mukai © 2024<br>Developed by <a href="https://stenlyandika.github.io/" target="_blank">Stenly Andika</a></p>
    </div>
</div>

<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu text-white"><i class='bx bx-menu'></i>
            </div>
            <div class="position-relative d-lg-block d-none">
                @if (auth()->user()->is_root)
                    <h6 class="text-white mt-2">Sistem Informasi Puskesmas Siulak Mukai</h6>
                @else
                    <h6 class="text-white mt-2">Sistem Informasi Puskesmas Siulak Mukai</h6>
                    <h6 class="text-white mt-2">
                        @if (auth()->user()->poli != "PENDAFTARAN" && auth()->user()->poli != "APOTEK") 
                            POLI 
                        @endif
                        {{ auth()->user()->poli }}
                    </h6>
                @endif
            </div>
            <div class="top-menu ms-auto">
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/img/avatar.png" class="user-img" alt="user avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">{{ auth()->user()->nama }}</p>
                        <p class="designattion mb-0 text-danger">
                            @if (auth()->user()->is_root)
                                Super Admin
                            @else
                                Admin
                            @endif
                        </p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.user.show', auth()->user()->id) }}"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center"><i class="bx bx-log-out-circle fs-5"></i><span>Logout</span></button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>