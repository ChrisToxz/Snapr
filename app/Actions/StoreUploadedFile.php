<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUploadedFile
{
    use AsAction;

    public function handle(UploadedFile $file): string
    {
        return Storage::disk('snaps')->putFile('', $file);
    }
}
