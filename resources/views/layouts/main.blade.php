<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('logo_lab.png') }}">
    <title>iLab - Server</title>
    @stack('style')
        @include('layouts.style')
  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      @include('layouts.header')
      @include('layouts.menu')
        @yield('content')
    </div> <!-- .wrapper -->
    @include('layouts.script')
    @stack('script')
  </body>
</html>
