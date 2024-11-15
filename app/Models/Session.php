<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'last_activity' => 'date:d-m-Y H:i',
    ];


    /**
     * Get the user that owns the Session
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
