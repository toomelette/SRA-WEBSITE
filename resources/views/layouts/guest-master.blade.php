<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sugar Regulatory Administration</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('layouts.guest-css-plugins')

  </head>

  <body style="zoom:90%;">
    
    @include('layouts.guest-header')

    @yield('content')
    
    @include('layouts.guest-footer')

    @include('layouts.guest-js-plugins')

  </body>
</html>
