<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'title',
        'content',
        'order',
        'slug',
        'illustrations_url',
        'genre_id',
        'module_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
