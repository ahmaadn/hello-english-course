<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressModules extends Model
{
    protected $fillable = [
        'user_id',
        'module_id',
        'status',
        'start_at',
        'finish_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
