<?php

namespace App\Actions\Snap;

use App\Actions\StoreUploadedFile;
use App\Models\Snap;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateSnap
{
    use AsAction;

    public function handle(Request $request): Snap
    {
        $file = StoreUploadedFile::run($request->file('image'));

        return $request->user()->snaps()->create([
            'ident' => GenerateSnapIdentifier::run(),
            'title' => $request->file('image')->getClientOriginalName(),
            'description' => '',
            'path' => $file,
        ]);
    }
}
