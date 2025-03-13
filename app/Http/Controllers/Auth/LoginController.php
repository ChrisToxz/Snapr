<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class LoginController extends Controller
{
    #[Get('/login')]
    public function index()
    {
        return view('auth.login');
    }

    #[Post('/login', 'login.store')]
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
