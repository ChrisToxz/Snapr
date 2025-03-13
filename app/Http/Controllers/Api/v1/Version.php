<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class Version extends Controller
{
    #[Get('version')]
    public function __invoke(Request $request)
    {
        // TODO: Return app version
        return response()->json(app()->version());
    }
}
