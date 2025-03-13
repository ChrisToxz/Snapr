<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-b from-base-100 to-base-200 flex items-center justify-center">
<div class="card w-96 bg-base-300 shadow-xl rounded-md">
    <div class="card-body">
        <h2 class="card-title justify-center">Login</h2>
        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Username</legend>
                <input type="text" class="input rounded-md" placeholder="Username" name="username"
                       value="{{ old('username') }}"/>
                @error('username')<p class="fieldset-label text-error/90">{{ $message }}</p>@enderror
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password</legend>
                <input type="password" class="input rounded-md" placeholder="Password" name="password"/>
                @error('password')<p class="fieldset-label text-error/90">{{ $message }}</p>@enderror
            </fieldset>
            <div class="form-control mt-6 w-full">
                <button type="submit" class="btn bg-white text-black w-full rounded-md">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
