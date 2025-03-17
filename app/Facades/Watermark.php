<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Watermark extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'watermark';
    }
}
