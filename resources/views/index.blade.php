<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}'}
        window.checkAuth = '{{ Auth::user() ? Auth::user()->name : null }}';
    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>

    <div id="app">
      <?php if (Auth::user()) { ?>
          @include('layouts.navbar')
          <app></app>
      <?php } ?>
    </div>

</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
