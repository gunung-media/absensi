<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>e</b>ABS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>e-</b>Absensi</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="{{ route('logout') }}" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs glyphicon glyphicon-log-out"> </span>Hallo, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle" alt="">
                            <p>{{ auth()->user()->name }} <small>Admin Web</small></p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="password.php" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ubah
                                    Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat"><i
                                        class="fa fa-sign-out"></i> Keluar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
