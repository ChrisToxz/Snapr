<?php

namespace App\Http\Controllers\Web;

use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;

#[Middleware('auth')]
class Dashboard
{
    #[Get('/')]
    #[Get('/dashboard')]
    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'images' => Image::all(), // TODO: Infinite loadidng
        ]);
    }
}
