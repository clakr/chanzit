<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Chanz IT @yield('title')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased bg-slate-200 container mx-auto text-slate-800">
  @yield('content')
</body>

</html>
