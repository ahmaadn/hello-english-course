<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'materi_id',
        'tipe',
        'title',
        'nilai_minimal'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function pertanyaans()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function historyQuizzes()
    {
        return $this->hasMany(HistoryQuiz::class);
    }
}
