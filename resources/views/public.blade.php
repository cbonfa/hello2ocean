<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles / Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

</head>
<body>
  <h1 class="text-3xl font-bold underline">
    Hello world!
  </h1>
  <?php
    echo('echo');
  ?>
  @livewireScriptConfig
</body>
</html>
