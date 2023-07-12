<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App</title>
</head>
<body class="antialiased">
<div id="app">
</div>
@vite(['resources/css/app.css', 'resources/js/app.js','resources/assets/js/main.js'])
</body>
</html>
