<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    use HasFactory;

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

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

}
