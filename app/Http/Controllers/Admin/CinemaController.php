<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CinemaController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::withCount('showtimes')->paginate(9);
        return view('admin.cinemas.index', compact('cinemas'));
    }

    public function create()
    {
        return view('admin.cinemas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cinemas', 'public');
            $data['image'] = $path;
        }

        if ($request->facilities) {
            $data['facilities'] = json_encode(explode(',', $request->facilities));
        }

        Cinema::create($data);

        return redirect()->route('admin.cinemas.index')
            ->with('success', 'Cinema created successfully.');
    }

    public function edit(Cinema $cinema)
    {
        return view('admin.cinemas.edit', compact('cinema'));
    }

    public function update(Request $request, Cinema $cinema)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($cinema->image) {
                Storage::disk('public')->delete($cinema->image);
            }
            $path = $request->file('image')->store('cinemas', 'public');
            $data['image'] = $path;
        }

        if ($request->facilities) {
            $data['facilities'] = json_encode(explode(',', $request->facilities));
        }

        $cinema->update($data);

        return redirect()->route('admin.cinemas.index')
            ->with('success', 'Cinema updated successfully.');
    }

    public function destroy(Cinema $cinema)
    {
        if ($cinema->showtimes()->count() > 0) {
            return back()->with('error', 'Cannot delete cinema with showtimes.');
        }

        if ($cinema->image) {
            Storage::disk('public')->delete($cinema->image);
        }

        $cinema->delete();

        return redirect()->route('admin.cinemas.index')
            ->with('success', 'Cinema deleted successfully.');
    }
}
