<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryQuiz extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'nilai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
