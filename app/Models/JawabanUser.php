<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanUser extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'pertanyaan_id',
        'jawaban',
        'is_true'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
