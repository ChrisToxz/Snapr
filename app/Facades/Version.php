<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\VersionService
 */
class Version extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\VersionService::class;
    }
}
