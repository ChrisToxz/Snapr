<?php

namespace App\Actions\Snap;

use App\Actions\StoreUploadedFile;
use App\Models\Snap;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateSnap
{
    use AsAction;

    // TODO: Transform so it can also accept Livewire uploads (AKA not based on $request)
    public function handle(Request $request): Snap
    {
        $file = StoreUploadedFile::run($request->file('image'));

        $snap = $request->user()->snaps()->create([
            'ident' => GenerateSnapIdentifier::run(),
            'title' => $request->file('image')->getClientOriginalName(),
            'description' => '',
            'path' => $file,
        ]);

        return $snap;
    }
}
