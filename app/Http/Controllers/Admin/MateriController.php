<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Materi;
use App\Models\Module;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Module $module)
    {
        $materis = Materi::with(['genre', 'module'])
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.materi.index', compact('materis', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Module $module)
    {
        $genres = Genre::all();
        $modules = Module::all();
        return view('admin.materi.create', compact('genres', 'module', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer',
            'genre_id' => 'required|exists:genres,id',
            'illustrations' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Slug otomatis
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . rand(1000, 9999);

        $validated['module_id'] = $module->id;

        if ($request->hasFile('illustrations')) {
            $imagePath = $request->file('illustrations')->store('materi', 'public');
            $validated['illustrations_url'] = $imagePath;
        }
        Materi::create($validated);
        return redirect()->route('admin.module.materi.index', $module)->with('success', 'Materi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module, Materi $materi)
    {
        $genres = Genre::all();
        $modules = Module::all();
        return view('admin.materi.edit', compact('materi', 'genres', 'module', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module, Materi $materi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer',
            'genre_id' => 'required|exists:genres,id',
            'illustrations' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('illustrations')) {
            $imagePath = $request->file('illustrations')->store('materi', 'public');
            $validated['illustrations_url'] = $imagePath;
        }
        $materi->update($validated);
        return redirect()->route('admin.module.materi.index', $module)->with('success', 'Materi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module, Materi $materi)
    {
        $materi->delete();
        return redirect()->route('admin.module.materi.index', $module)->with('success', 'Materi deleted successfully.');
    }
}
