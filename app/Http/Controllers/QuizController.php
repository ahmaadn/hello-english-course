<?php

namespace App\Http\Controllers;

use App\Models\HistoryQuiz;
use App\Models\JawabanUser;
use App\Models\Materi;
use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function submit(Request $request, Module $module, Materi $materi, Quiz $quiz)
    {
        $jawabanUser = $request->input('jawaban', []);
        $benar = 0;
        $total = $quiz->pertanyaans->count();
        $hasil = [];

        foreach ($quiz->pertanyaans as $soal) {
            $jawaban = $jawabanUser[$soal->id] ?? null;
            $isTrue = null;
            if ($quiz->tipe === 'pilihan_ganda' || $quiz->tipe === 'drop_drag') {
                $isTrue = $jawaban && $soal->jawaban_benar && trim($jawaban) == trim($soal->jawaban_benar);
                if ($isTrue)
                    $benar++;
            }
            $hasil[] = [
                'soal' => $soal->teks,
                'jawaban_user' => $jawaban,
                'jawaban_benar' => $soal->jawaban_benar,
                'is_true' => $isTrue,
            ];
        }
        $skor = $total > 0 ? round($benar / $total * 100) : 0;

        // Simpan ke history quiz jika user login
        if (auth()->check()) {
            $userId = auth()->id();
            $history = HistoryQuiz::create([
                'user_id' => $userId,
                'quiz_id' => $quiz->id,
                'nilai' => $skor,
            ]);
            $percobaanKe = JawabanUser::where('user_id', $userId)
                ->where('quiz_id', $quiz->id)
                ->where('pertanyaan_id', $quiz->pertanyaans->first()->id ?? null)
                ->count() + 1;
            // Simpan jawaban user per soal
            foreach ($quiz->pertanyaans as $soal) {
                $jawaban = $jawabanUser[$soal->id] ?? null;
                $isTrue = null;
                if ($quiz->tipe === 'pilihan_ganda' || $quiz->tipe === 'drop_drag') {
                    $isTrue = $jawaban && $soal->jawaban_benar && trim($jawaban) == trim($soal->jawaban_benar);
                }
                JawabanUser::create([
                    'user_id' => $userId,
                    'quiz_id' => $quiz->id,
                    'pertanyaan_id' => $soal->id,
                    'jawaban' => $jawaban,
                    'is_true' => $isTrue,
                    'percobaan_ke' => $percobaanKe,
                ]);
            }
            // Update progress_materis jika nilai >= nilai_minimal
            if ($skor >= $quiz->nilai_minimal) {
                $progress = \DB::table('progress_materis')
                    ->where('user_id', $userId)
                    ->where('materi_id', $materi->id)
                    ->first();
                if (!$progress) {
                    // Belum ada progress, insert baru
                    \DB::table('progress_materis')->insert([
                        'user_id' => $userId,
                        'materi_id' => $materi->id,
                        'status' => 'finish',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } elseif ($progress->status !== 'finish' && $progress->status !== 'finish') {
                    // Sudah ada, tapi belum completed/finish, update
                    \DB::table('progress_materis')
                        ->where('user_id', $userId)
                        ->where('materi_id', $materi->id)
                        ->update([
                            'status' => 'finish',
                            'updated_at' => now(),
                        ]);
                }
                // Cek apakah semua materi pada module sudah completed oleh user
                $moduleMateriIds = $materi->module->materis->pluck('id')->toArray();
                $completedCount = \DB::table('progress_materis')
                    ->where('user_id', $userId)
                    ->whereIn('materi_id', $moduleMateriIds)
                    ->where('status', 'finish')
                    ->count();
                if ($completedCount === count($moduleMateriIds)) {
                    \DB::table('progress_modules')->updateOrInsert(
                        [
                            'user_id' => $userId,
                            'module_id' => $materi->module->id,
                        ],
                        [
                            'status' => 'finish',
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }

        return view('pages.materi.quiz-result', compact('module', 'materi', 'quiz', 'hasil', 'skor'));
        // return redirect()->route('materi.show', [$module, $materi]);
    }
}
