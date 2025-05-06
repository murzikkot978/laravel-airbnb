<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'content',
        'rooms',
        'peoples',
        'price',
        'photo',
        'country',
        'city',
        'street',
        'reserved',
    ];

    protected $table = 'apartments';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
