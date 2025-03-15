<!DOCTYPE html>
<html lang="en" data-theme="black">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }} {{ config("app.name") }}</title>
        @vite("resources/css/app.css")
    </head>
    <body class="bg-base-100 text-white">
        <!-- Top Navbar -->
        <nav class="navbar bg-base-200 shadow-md">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl normal-case" href="{{ url("/") }}">
                    {{ config("app.name") }}
                </a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal p-0">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Upload</a></li>
                    <li class="flex items-center">
                        <!-- Username dropdown with plain span for alignment -->
                        <div class="dropdown dropdown-end">
                            <span tabindex="0" class="cursor-pointer text-neutral-400">
                                {{ auth()->user()->username }}
                            </span>
                            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box w-52 p-2 shadow">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Settings</a></li>
                                <li>
                                    <form method="POST" action="{{ route("logout") }}">
                                        @csrf
                                        @method("DELETE")
                                        <a onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto p-6">
            {{ $slot }}
        </main>

        <x-toast position="toast-top toast-center" />
    </body>
</html>
