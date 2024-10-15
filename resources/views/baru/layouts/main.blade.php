<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    @stack('style')
        @include('baru.layouts.style')
  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      @include('baru.layouts.header')
      @include('baru.layouts.menu')
        @yield('content')
    </div> <!-- .wrapper -->
    @include('baru.layouts.script')
    @stack('script')
  </body>
</html>
