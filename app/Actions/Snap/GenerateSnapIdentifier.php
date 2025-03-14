<?php

namespace App\Actions\Snap;

use App\Models\Snap;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateSnapIdentifier
{
    use AsAction;

    public function handle(int $length = 8): string
    {
        do {
            $ident = $this->generateIdentifier($length);
        } while (Snap::whereIdent($ident)->exists());

        return $ident;
    }

    private function generateIdentifier(int $length): string
    {
        return Str::random($length);
    }
}
