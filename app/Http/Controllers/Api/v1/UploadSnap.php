<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Snap\CreateSnap;
use App\Http\Requests\UploadSnapRequest;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;

class UploadSnap
{
    #[Post('upload')]
    public function __invoke(UploadSnapRequest $request): JsonResponse
    {
        $snap = CreateSnap::run($request);

        // TODO: Should return the url to copy.
        return response()->json($snap->toArray() + ['url' => url($snap->ident)]);
    }
}
