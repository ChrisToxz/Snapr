<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Snap extends Model
{
    use HasUlids;

    protected $fillable = ['ident', 'title', 'description', 'path'];

    public function getRouteKeyName(): string
    {
        return 'ident';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
