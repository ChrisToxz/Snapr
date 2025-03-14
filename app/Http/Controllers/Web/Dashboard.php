<?php

namespace App\Http\Controllers\Web;

use App\Models\Snap;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;

#[Middleware('auth')]
class Dashboard
{
    #[Get('/')]
    #[Get('/dashboard')]
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'snaps' => Snap::all(), // TODO: Infinite loadidng
        ]);
    }
}
