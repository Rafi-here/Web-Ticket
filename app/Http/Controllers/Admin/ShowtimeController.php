<?php
// app/Http/Controllers/Admin/ShowtimeController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Film;
use App\Models\Cinema;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index(Request $request)
    {
        $query = Showtime::with(['film', 'cinema']);

        if ($request->filled('film_id')) {
            $query->where('film_id', $request->film_id);
        }

        if ($request->filled('cinema_id')) {
            $query->where('cinema_id', $request->cinema_id);
        }

        if ($request->filled('show_date')) {
            $query->whereDate('show_date', $request->show_date);
        }

        $showtimes = $query->orderBy('show_date', 'desc')
            ->orderBy('show_time', 'asc')
            ->paginate(15);

        $films = Film::orderBy('title')->get();
        $cinemas = Cinema::orderBy('name')->get();

        return view('admin.showtimes.index', compact('showtimes', 'films', 'cinemas'));
    }

    public function create()
    {
        $films = Film::orderBy('title')->get();
        $cinemas = Cinema::orderBy('name')->get();

        return view('admin.showtimes.create', compact('films', 'cinemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'show_date' => 'required|date|after_or_equal:today',
            'show_time' => 'required',
            'price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        Showtime::create([
            'film_id' => $request->film_id,
            'cinema_id' => $request->cinema_id,
            'show_date' => $request->show_date,
            'show_time' => $request->show_time,
            'price' => $request->price,
            'total_seats' => $request->total_seats,
            'available_seats' => $request->total_seats,
        ]);

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Jadwal tayang berhasil ditambahkan');
    }

    public function show($id)
    {
        $showtime = Showtime::with(['film', 'cinema'])->findOrFail($id);
        return view('admin.showtimes.show', compact('showtime'));
    }

    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $films = Film::orderBy('title')->get();
        $cinemas = Cinema::orderBy('name')->get();

        return view('admin.showtimes.edit', compact('showtime', 'films', 'cinemas'));
    }

    public function update(Request $request, $id)
    {
        $showtime = Showtime::findOrFail($id);

        $request->validate([
            'film_id' => 'required|exists:films,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        $showtime->update($request->all());

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Jadwal tayang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);
        $showtime->delete();

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Jadwal tayang berhasil dihapus');
    }
}
