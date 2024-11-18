<!DOCTYPE html>
<html>
@include('layouts.partials.head')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div>
                    <ol class="breadcrumb" style="background-color: #3c8dbc">
                        <li class="active" style="color: #000">
                            <a style="color: #fff" href="{{ route('admin.dashboard') }}"> <i
                                    class="fa fa-chevron-circle-right"></i> Home</a>
                            <a style="color: #fff" href=""> </a>
                        </li>
                    </ol>
                </div>
            </section>

            <section class="content container-fluid">
                @yield('content')
            </section>
        </div>

        @include('layouts.partials.footer')
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
