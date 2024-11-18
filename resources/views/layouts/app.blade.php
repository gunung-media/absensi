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
                <h1>
                    Page Header
                    <small>Optional description</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                    <li class="active">Here</li>
                </ol>
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
