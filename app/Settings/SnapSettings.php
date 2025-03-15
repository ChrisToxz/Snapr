<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SnapSettings extends Settings
{
    public bool $setWatermark;

    public static function group(): string
    {
        return 'snap';
    }
}
