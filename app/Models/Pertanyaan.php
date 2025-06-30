<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = [
        'quiz_id',
        'teks',
        'jawaban_benar',
        'options'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }


}
