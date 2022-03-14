
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon.ico') }}">

    <title>@yield('title', 'Test Project March 2022')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    @stack('styles')

</head>
<body>

    @include('partials.header')

    <div class="container-fluid mb-3">
        <div class="row g-0">

            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                @include('partials.nav')
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    @stack('scripts')

</body>
</html>
