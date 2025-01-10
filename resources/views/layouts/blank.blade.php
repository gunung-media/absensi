<!DOCTYPE html>
<html>
@include('layouts.partials.head')

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <b href="#" class="navbar-brand">e<b>-Absensi</b></b>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>

        <div class="content-wrapper">
            <div class="container">
                <section class="content container-fluid">
                    @yield('content')
                </section>
            </div>
        </div>

        @include('layouts.partials.footer')
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
