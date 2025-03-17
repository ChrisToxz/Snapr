<?php

namespace App\Actions\Snap;

use App\Actions\StoreUploadedFile;
use App\Facades\Watermark;
use App\Models\Snap;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateSnap
{
    use AsAction;

    public function handle(UploadedFile $file): Snap
    {

        // TODO: Proper flow of handling watermark -> Refacte StoreUploadFile to accept a path rather than the uploaded file.
        // Check if user enabled it or not

        $watermarked = Watermark::applyWatermark($file->path(), 'Chris');

        $extension = $file->getClientOriginalExtension();
        $tempPath = sys_get_temp_dir().'/watermarked-'.uniqid().'.'.$extension;

        $watermarked->save($tempPath);

        $uploadedFile = new \Illuminate\Http\UploadedFile(
            $tempPath,
            'watermarked.'.$extension,
            mime_content_type($tempPath),
            null,
            true
        );

        $path = StoreUploadedFile::run($uploadedFile);

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
