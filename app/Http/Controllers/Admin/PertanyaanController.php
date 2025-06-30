<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\Quiz;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Quiz $quiz)
    {
        $tipe = $request->input('tipe');
        $data = $request->validate([
            'teks' => 'required|string',
        ]);
        $data['quiz_id'] = $quiz->id;
        if ($tipe === 'pilihan_ganda') {
            $data['options'] = json_encode($request->input('options'));
            $data['jawaban_benar'] = $request->input('jawaban_benar');
        } elseif ($tipe === 'drop_drag') {
            $data['jawaban_benar'] = $request->input('jawaban_benar_dd');
            $data['options'] = null;
        } else { // essay
            $data['jawaban_benar'] = null;
            $data['options'] = null;
        }
        Pertanyaan::create($data);
        return back()->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan, Quiz $quiz)
    {
        $pertanyaan->delete();
        return back()->with('success', 'Soal berhasil dihapus.');
    }
}
