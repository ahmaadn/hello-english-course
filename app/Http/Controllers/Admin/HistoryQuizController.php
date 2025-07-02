<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuiz;
use App\Models\JawabanUser;
use Illuminate\Http\Request;

class HistoryQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua history quiz, relasi user, quiz, materi, module
        $histories = HistoryQuiz::with([
            'user',
            'quiz.materi',
            'quiz.materi.module',
        ])->orderByDesc('created_at')->paginate(20);
        return view('admin.history_quiz.index', compact('histories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoryQuiz $historyQuiz)
    {
        // Ambil detail history quiz, relasi user, quiz, materi, module, dan jawaban user
        $historyQuiz->load([
            'user',
            'quiz.materi',
            'quiz.materi.module',
            'quiz.pertanyaans',
        ]);
        $jawabanUsers = JawabanUser::where('user_id', $historyQuiz->user_id)
            ->where('quiz_id', $historyQuiz->quiz_id)
            ->where('created_at', '>=', $historyQuiz->created_at->subSeconds(2)) // toleransi waktu
            ->where('created_at', '<=', $historyQuiz->created_at->addSeconds(10))
            ->get();
        return view('admin.history_quiz.show', compact('historyQuiz', 'jawabanUsers'));
    }
}
