<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PhotoProfile extends Model
{

    protected $fillable = [
        'photoprofile',
        'user_id',
    ];

    protected $table = 'photoplofiles';

    public function photos(): HasOne
    {
        return $this->hasOne(PhotoProfile::class);
    }
}
