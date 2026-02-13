<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilmController extends Controller
{
    public function index()
    {
        // Gunakan paginate() dan eager loading
        $films = Film::with('category')->latest()->paginate(10);
        
        // Ambil categories untuk filter (opsional)
        $categories = Category::all();
        
        return view('admin.films.index', compact('films', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.films.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:films',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'genre' => 'required',
            'duration' => 'required|integer',
            'synopsis' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('films', 'public');
            $data['poster'] = $path;
        }

        Film::create($data);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film created successfully.');
    }

    public function show(Film $film)
    {
        // Load relasi untuk detail
        $film->load(['category', 'showtimes.cinema', 'showtimes.tickets']);
        return view('admin.films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $categories = Category::all();
        return view('admin.films.edit', compact('film', 'categories'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title' => 'required|unique:films,title,' . $film->id,
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'genre' => 'required',
            'duration' => 'required|integer',
            'synopsis' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($film->poster) {
                Storage::disk('public')->delete($film->poster);
            }
            $path = $request->file('poster')->store('films', 'public');
            $data['poster'] = $path;
        }

        $film->update($data);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film updated successfully.');
    }

    public function destroy(Film $film)
    {
        if ($film->poster) {
            Storage::disk('public')->delete($film->poster);
        }
        $film->delete();

        return redirect()->route('admin.films.index')
            ->with('success', 'Film deleted successfully.');
    }
}