<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/sweetalert2/dist/sweetalert2.css" rel="stylesheet">
    <script src="/sweetalert2/dist/sweetalert2.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <section id="user-info">
        @yield('sidebar')
    </section>
    <section class="page-wrap">
      <div id="page-content">
          <noscript>
              <p class="noscript-info">To use this application, please enable JavaScript</p>
              <a class="noscript-link" href="http://www.quackit.com/javascript/tutorial/how_to_enable_javascript.cfm">How to enable JavaScript</a>
          </noscript>
          @yield('content')
      </div>
    </section>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/functions.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    @yield('scripts')
</body>
</html>
