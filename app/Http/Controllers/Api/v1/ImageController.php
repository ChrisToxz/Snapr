<?php

namespace App\Http\Controllers\Api\v1;

use Spatie\RouteAttributes\Attributes\Get;

class ImageController
{
    #[get('test')]
    public function index() {}
}
