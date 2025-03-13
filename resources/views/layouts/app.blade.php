<!DOCTYPE html>
<html lang='en' data-theme='black'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>{{ $title }} {{ config('app.name') }}</title>
    <!-- Assuming you're using Vite to compile your assets -->
    @vite('resources/css/app.css')
</head>
<body class="bg-base-100 text-white">
<!-- Top Navbar -->
<nav class="navbar bg-base-200 shadow-md">
    <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal p-0">
            <li><a href="#">Home</a></li>
            <li><a href="#">Upload</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="container mx-auto p-6">
    {{ $slot }}
</main>
</body>
</html>
