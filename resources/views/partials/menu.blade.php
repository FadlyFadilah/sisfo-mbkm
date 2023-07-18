<aside class="main-sidebar sidebar-light-navy elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('LOGOTEDC.PNG') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="#"
                    class="d-block">{{ auth()->user()->userMahasiswas()->nama_lengkap ?? auth()->user()->username }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}"
                        href="{{ route('admin.home') }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is('admin/permissions*') ? 'active' : '' }} {{ request()->is('admin/roles*') ? 'active' : '' }} {{ request()->is('admin/users*') ? 'active' : '' }}"
                            href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('prodi_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.prodis.index') }}"
                            class="nav-link {{ request()->is('admin/prodis') || request()->is('admin/prodis/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.prodi.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('periode_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.periodes.index') }}"
                            class="nav-link {{ request()->is('admin/periodes') || request()->is('admin/periodes/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.periode.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('program_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.programs.index') }}"
                            class="nav-link {{ request()->is('admin/programs') || request()->is('admin/programs/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-chalkboard-teacher">

                            </i>
                            <p>
                                {{ trans('cruds.program.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('data_mahasiswa_mbkm_access')
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/mahasiswas*') ? 'menu-open' : '' }} {{ request()->is('admin/pengajuans*') ? 'menu-open' : '' }} {{ request()->is('admin/laporans*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is('admin/mahasiswas*') ? 'active' : '' }} {{ request()->is('admin/pengajuans*') ? 'active' : '' }} {{ request()->is('admin/laporans*') ? 'active' : '' }}"
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
                                    <a href="{{ route('admin.mahasiswas.index') }}"
                                        class="nav-link {{ request()->is('admin/mahasiswas') || request()->is('admin/mahasiswas/*') ? 'active' : '' }}">
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
                                    <a href="{{ route('admin.pengajuans.index') }}"
                                        class="nav-link {{ request()->is('admin/pengajuans') || request()->is('admin/pengajuans/*') ? 'active' : '' }}">
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
                                    <a href="{{ route('admin.laporans.index') }}"
                                        class="nav-link {{ request()->is('admin/laporans') || request()->is('admin/laporans/*') ? 'active' : '' }}">
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
                @can('rekapitulasi_data_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.rekapitulasi-datas.index') }}"
                            class="nav-link {{ request()->is('admin/rekapitulasi-datas') || request()->is('admin/rekapitulasi-datas/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon far fa-flag">

                            </i>
                            <p>
                                {{ trans('cruds.rekapitulasiData.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                href="{{ route('profile.password.edit') }}">
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
