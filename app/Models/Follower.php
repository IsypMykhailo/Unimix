<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Follower extends Model
{
    public function follower(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'follower_id',
        'user_id'
    ];
}
