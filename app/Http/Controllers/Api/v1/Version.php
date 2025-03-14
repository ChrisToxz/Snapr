<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class Version extends Controller
{
    #[Get('version')]
    public function __invoke(Request $request): JsonResponse
    {
        // TODO: Return app version
        return response()->json(\App\Facades\Version::long());
    }
}
