<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressMateris extends Model
{
    protected $fillable = [
        'user_id',
        'materi_id',
        'status',
        'start_at',
        'finish_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
