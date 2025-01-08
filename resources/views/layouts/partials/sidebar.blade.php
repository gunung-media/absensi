@php
    function activeRoute($route)
    {
        return Route::currentRouteName() == $route ? 'active' : '';
    }
@endphp

<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>HOME</span></a></li>
            <li class="treeview active">
                <a href="#"><i class="fa fa-database"></i> <span>DATA MASTER</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.fingerprint.index') }}">Data Mesin Fingerprint</a></li>
                    <li><a href="{{ route('admin.user.index') }}">Data Admin</a></li>
                    <li><a href="{{ route('admin.work-unit.index') }}">Data Satuan Kerja</a></li>
                    <li><a href="{{ route('admin.rank.index') }}">Data Pangkat/Golongan</a></li>
                    <li><a href="{{ route('admin.placement.index') }}">Data Penggajian - Penempatan </a></li>
                    <li><a href="{{ route('admin.position.index') }}">Data Jabatan</a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin.employee.index') }}"><i class="fa fa-users"></i> <span>DATA PEGAWAI</span></a>
            </li>
            <li><a href="{{ route('admin.absence.index') }}"><i class="fa fa-book"></i> <span>DATA ABSENSI</span></a>
            </li>
            <li><a href="{{ route('admin.report.index') }}"><i class="fa fa-file"></i> <span>LAPORAN</span></a></li>
        </ul>
    </section>
</aside>
