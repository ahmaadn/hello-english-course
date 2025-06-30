<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_url',
        'estimated',
        'user_id',
        'order'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
