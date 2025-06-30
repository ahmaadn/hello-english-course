<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Module $module)
    {

        $module = $this->__getModuleWithProgressMateri(auth()->user(), $module);
        return view("pages.materi.intro", compact("module"));
    }

    public function showMateri(Module $module, Materi $materi)
    {
        $module = $this->__getModuleWithProgressMateri(auth()->user(), $module);
        return view("pages.materi.show", compact("module", "materi"));
    }

    public function start(Request $request, Module $module)
    {
        $user = $request->user();

        // buatkan progress module
        $this->__createProggresModule($user, $module);

        // cari materi pertama
        $materi = $module->materis()
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->first();

        // didalam module tidak ada materi
        if (!$materi) {
            abort(404, 'Materi not found for this module.');
        }

        $this->__createProggresMateri($user, $materi);
        return redirect()->route('materi.show', [$module, $materi]);
    }

    public function next(Request $request, Module $module, Materi $materi)
    {

    }

    private function __createProggresModule(User $user, Module $module)
    {

        // Cari progress module pada user
        $progressModule = $user->progressModules()->where('module_id', $module->id)->first();

        // progress module sudah ada
        if ($progressModule) {
            return $progressModule;
        }

        // Buat progress module baru
        $progressModule = $user->progressModules()->create([
            'module_id' => $module->id,
            'status' => 'progress',
            'start_at' => now(),
        ]);

        return [$progressModule];
    }

    private function __createProggresMateri(User $user, Materi $materi)
    {
        // cek materi progress
        $progressMateri = $user->progressMateris()
            ->where('materi_id', $materi->id)
            ->first();

        // progress materi telah ada
        if ($progressMateri) {
            return $progressMateri;
        }

        // Buat progress materi baru
        $progressMateri = $user->progressMateris()->create([
            'materi_id' => $materi->id,
            'status' => 'progress',
            'start_at' => now(),
        ]);

        return $progressMateri;
    }

    private function __getModuleWithProgressMateri(User $user, Module $module)
    {
        $userId = $user->id;
        $module = Module::with([
            // Gunakan notasi titik untuk relasi bertingkat (nested relation)
            'materis.progressMateris' => function ($query) use ($userId) {
                // Constraint ini berlaku untuk relasi 'progressMateri'
                $query->where('user_id', $userId);
            }
        ])->findOrFail($module->id);

        $module->materis->each(function ($materi) {
            // Jika collection progressMateri tidak kosong, ambil item pertama.
            // Jika kosong, first() akan mengembalikan null.
            $materi->progress = $materi->progressMateris->first();
            unset($materi->progressMateris); // Bersihkan agar output rapi
        });

        return $module;
    }
}
