<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CLONE G-drive</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    @if (Auth::check() )
      <script>
        window.Laravel = {!!json_encode([
          'isLoggedin' => true,
          'user' => [
            'name' => Auth::user()->name,
            'roles' => Auth::user()->roles()->first()->name
          ]
        ])!!}
      </script>
    @else
      <script>
        window.Laravel = {!! json_encode([ 'isLoggedin' => false ])!!}
      </script>
    @endif

    <div id='app'>
      <router-view></router-view>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>

  </body>
</html>
