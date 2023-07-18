<aside class="main-sidebar sidebar-light-navy elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('LOGOTEDC.PNG') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar frontend (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="#"
                    class="d-block">{{ optional(auth()->user()->userMahasiswas)->nama_lengkap ?? auth()->user()->username }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend/home') ? 'active' : '' }}"
                        href="{{ route('frontend.home') }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('data_mahasiswa_mbkm_access')
                    <li
                        class="nav-item has-treeview {{ request()->is('frontend/mahasiswas*') ? 'menu-open' : '' }} {{ request()->is('frontend/pengajuans*') ? 'menu-open' : '' }} {{ request()->is('frontend/laporans*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is('frontend/mahasiswas*') ? 'active' : '' }} {{ request()->is('frontend/pengajuans*') ? 'active' : '' }} {{ request()->is('frontend/laporans*') ? 'active' : '' }}"
                            href="#">
                            <i class="fa-fw nav-icon far fa-address-card">

                            </i>
                            <p>
                                {{ trans('cruds.dataMahasiswaMbkm.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('mahasiswa_access')
                                <li class="nav-item">
                                    <a href="{{ route('frontend.mahasiswas.index') }}"
                                        class="nav-link {{ request()->is('frontend/mahasiswas') || request()->is('frontend/mahasiswas/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.mahasiswa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('pengajuan_access')
                                <li class="nav-item">
                                    <a href="{{ route('frontend.pengajuans.index') }}"
                                        class="nav-link {{ request()->is('frontend/pengajuans') || request()->is('frontend/pengajuans/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pengajuan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('laporan_access')
                                <li class="nav-item">
                                    <a href="{{ route('frontend.laporans.index') }}"
                                        class="nav-link {{ request()->is('frontend/laporans') || request()->is('frontend/laporans/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-envelope-open">

                                        </i>
                                        <p>
                                            {{ trans('cruds.laporan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if (file_exists(app_path('Http/Controllers/Frontend/ChangePasswordUserController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/password') || request()->is('/password/*') ? 'active' : '' }}"
                                href="{{ route('frontend.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
