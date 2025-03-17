<?php

namespace App\Actions\Snap;

use App\Actions\StoreUploadedFile;
use App\Models\Snap;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateSnap
{
    use AsAction;

    public function handle(UploadedFile $file): Snap
    {
        $path = StoreUploadedFile::run($file);

        // ? TODO: Should I rely on auth() here? Or always pass the user?
        $snap = auth()->user()->snaps()->create([
            'ident' => GenerateSnapIdentifier::run(),
            'title' => $file->getClientOriginalName(),
            'description' => '',
            'path' => $path,
        ]);

        return $snap;
    }
}
