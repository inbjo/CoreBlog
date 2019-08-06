<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="keyword" content="@yield('keyword', config('system.keyword'))"/>
  <meta name="description" content="@yield('description', config('system.description'))"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="Flex">
  <link rel="manifest" href="/manifest.json">
  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  @yield('styles')
  <title>@yield('title',config('system.name').' - '.config('system.slogan'))</title>
</head>

@include('layouts._js')

<body class="{{ route_class() }}-page">

@section('body')

@show

</body>
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
</html>

