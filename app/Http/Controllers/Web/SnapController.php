<?php

namespace App\Http\Controllers\Web;

use App\Models\Snap;
use Spatie\RouteAttributes\Attributes\Get;

class SnapController
{
    #[Get('/{snap}', 'snap.show')]
    public function show(Snap $snap)
    {
        return view('snap.show', ['snap' => $snap]);
    }
}
