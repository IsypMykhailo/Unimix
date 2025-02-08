<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Like extends Model
{
    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable =[
        'publication_id',
        'user_id'
    ];
}
