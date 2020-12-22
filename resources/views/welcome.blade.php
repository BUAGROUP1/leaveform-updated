<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Welcome</title>
    <link rel="icon" type="image/favicon" href="/img/logo.jpg">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS-->
    <link href="/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/css/sickomode.css" />
    <link rel="stylesheet" href="/css/abc.css">

</head>

<body>
    <div class="site-wrap">
        <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
        </div>
        </div>
        <div class="site-mobile-menu-body"></div>
        </div>
        <header class="site-navbar py-3" role="banner">
        <div class="container-fluid">
        <div class="row align-items-center">
        <div class="col-11 col-xl-2">
        <h1 class="mb-0"><img src="/img/logo.jpg" style="height: 40px; width: 40px;"/><a href="/" class="text-white h2 mb-0">BUA<span class="text-primary">Leave</span> </a></h1>
        </div>
        </div>
        </div>
        </div>
        </header>
        <div class="site-section site-hero">
        <div class="container">
        <div class="row align-items-center">
        <div class="col-md-10">
        <span class="d-block mb-3 caption">Welcome</span>
        <h1 class="d-block mb-4">BUA Leave </h1>
        <span class="d-block mb-5 caption"></span>
        @if (Route::has('login'))

            @auth
                <a href="{{ url('/home') }}" class="btn-custom"><span>Home</span></a>
            @else
                <a href="{{ route('login') }}" class="btn-custom"><span>Login</span></a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-custom"><span>Register</span></a>
                @endif
            @endif

        @endif
        </div>
        </div>
        </div>
        </div>


        </div>

<!-- Bootstrap JS-->
<script src="/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/vendor/bootstrap-4.1/bootstrap.min.js"></script>

</body>

</html>
