<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
      'user_id',
      'apartment_id',
      'start_date',
      'end_date',
    ];

    protected $table = 'reservations';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }
}
