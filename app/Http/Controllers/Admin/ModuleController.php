<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::with(['user'])
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $moduleCount = Module::count();
        return view('admin.module.create', compact('moduleCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estimated' => 'required|integer',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = $this->createSlug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $this->__uploadService($request);
        }
        Module::create($validated);
        return redirect()->route('admin.module.index')->with('success', 'Module created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('admin.module.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        $genres = \App\Models\Genre::all();
        return view('admin.module.edit', compact('module', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estimated' => 'required|integer',
        ]);
        // Update image jika ada file baru
        if ($request->hasFile('image')) {
            $validated['image_url'] = $this->__uploadService($request);
        }
        $module->update($validated);
        return redirect()->route('admin.module.index')->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.module.index')->with('success', 'Module deleted successfully.');
    }

    public function createSlug(string $name)
    {
        $prefix = 'module';
        $namePart = substr($name, 0, 10);
        $slug = Str::slug($prefix . '-' . $namePart . '-' . time());
        return $slug;
    }

    private function __uploadService($request)
    {
        if (config('cloudinary.cloud_url')) {
            $imagePath = Cloudinary::uploadApi()->upload($request->file('image')->getRealPath())['secure_url'];
        } else {
            $imagePath = $request->file('illustrations')->store('materi_illustrations', 'public');
            $imagePath = asset('storage/' . $imagePath);
        }
        return $imagePath;
    }
}
