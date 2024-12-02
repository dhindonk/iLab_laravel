<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title') - iLab</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('template/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('template/css/feather.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('template/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('template/css/app-dark.css') }}" id="darkTheme" disabled>
    <style>
      body {
        overflow-x: hidden;
      }
      .wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }
      .auth-form {
        width: 100%;
        max-width: 400px;
        margin: auto;
        padding: 20px;
      }
      .logo-container {
        margin-bottom: 2rem;
        text-align: center;
      }
      .logo-container img {
        width: 80px;
        height: 80px;
        border-radius: 15px;
        object-fit: cover;
      }
    </style>
  </head>
  <body class="light">
    <div class="wrapper">
      <div class="auth-form">
        <div class="logo-container">
          <a class="navbar-brand" href="{{ route('auth.login') }}">
            <img src="{{ asset('logo_lab.png') }}" alt="Logo" class="img-fluid">
          </a>
        </div>
        
        @yield('content')

        <p class="mt-5 mb-3 text-muted text-center">© {{ date('Y') }} Lab Terpadu</p>
      </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/apps.js') }}"></script>
  </body>
</html> 