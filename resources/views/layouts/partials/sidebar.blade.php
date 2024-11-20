<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>HOME</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-database"></i> <span>DATA MASTER</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.user.index') }}">Data Admin</a></li>
                    <li><a href="{{ route('admin.position.index') }}">Data Jabatan</a></li>
                    <li><a href="{{ route('admin.work-unit.index') }}">Data Satuan Kerja</a></li>
                    <li><a href="#">Data Karyawan</a></li>
                    <li><a href="#">Data Keterangan</a></li>
                    <li><a href="#">Data Mesin Fingerprint</a></li>
                </ul>
            </li>
            <li><a href="?p=master"><i class="fa fa-book"></i> <span>DATA ABSENSI</span></a></li>
            <li><a href="#"><i class="fa fa-file"></i> <span>LAPORAN</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
