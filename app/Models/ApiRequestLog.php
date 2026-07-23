<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiRequestLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'method',
        'path',
        'query_string',
        'status_code',
        'ip_address',
        'user_agent',
        'response_time_ms',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->created_at = now());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
