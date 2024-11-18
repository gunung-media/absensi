<!DOCTYPE html>
<html>

@include('layouts.partials.head')

<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>

    @include('layouts.partials.scripts')
</body>

</html>
