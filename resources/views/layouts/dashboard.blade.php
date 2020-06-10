<!-- Stored in resources/views/layouts/defaults.blade.php -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <title>Document</title>
</head>
<body>
    <div id="app">
        <div class="loader">
            <div class="loader_inner"></div>
        </div>

        <header>
            <div class="container-fluid d-flex align-items-center px-5">
                <div class="cabinet d-flex align-items-center">
                    <div class="avatar" style="background-image: url({{ asset('fortest/avatar.png') }});"></div>
                    <span class="user_name">Чуваков Алексей</span>
                </div>
            </div>
        </header>

        <main class="d-flex ">
            <sidebar></sidebar>
{{--            <div style="height: calc(100vh - 80px); width: 280px;"></div>--}}
            @yield('content')
        </main>

        <footer>

        </footer>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
