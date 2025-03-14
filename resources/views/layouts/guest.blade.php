<!DOCTYPE html>
<html lang="en" data-theme="black">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? "" }} {{ config("app.name") }}</title>
        @vite("resources/css/app.css")
    </head>
    <body class="bg-base-100 text-white">
        <!-- Top Navbar -->
        <nav class="navbar bg-base-200 shadow-md">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl normal-case" href="{{ url("/") }}">
                    Powered by {{ config("app.name") }}
                </a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal p-0"></ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto p-6">
            {{ $slot }}
        </main>
    </body>
</html>
