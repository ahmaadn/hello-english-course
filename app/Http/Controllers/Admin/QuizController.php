<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with('materi')->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materis = Materi::all();
        return view('admin.quiz.create', compact('materis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'tipe' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'nilai_minimal' => 'required|integer|min:0|max:100',
        ]);
        Quiz::create($validated);
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        return view('admin.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $materis = Materi::all();
        return view('admin.quiz.edit', compact('quiz', 'materis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'tipe' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'nilai_minimal' => 'required|integer|min:0|max:100',
        ]);
        $quiz->update($validated);
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dihapus.');
    }
}
