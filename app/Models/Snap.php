<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Snap extends Model
{
    use HasUlids;

    protected $fillable = ['ident', 'name', 'description', 'path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
