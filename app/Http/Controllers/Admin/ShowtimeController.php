<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Film;
use App\Models\Cinema;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with(['film', 'cinema'])
            ->latest()
            ->paginate(10);
        return view('admin.showtimes.index', compact('showtimes'));
    }

    public function create()
    {
        $films = Film::where('status', 'now_playing')->get();
        $cinemas = Cinema::all();
        return view('admin.showtimes.create', compact('films', 'cinemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'price' => 'required|numeric',
        ]);

        Showtime::create($request->all());

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime created successfully.');
    }

    public function edit(Showtime $showtime)
    {
        $films = Film::where('status', 'now_playing')->get();
        $cinemas = Cinema::all();
        return view('admin.showtimes.edit', compact('showtime', 'films', 'cinemas'));
    }

    public function update(Request $request, Showtime $showtime)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'price' => 'required|numeric',
        ]);

        $showtime->update($request->all());

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime updated successfully.');
    }

    public function destroy(Showtime $showtime)
    {
        if ($showtime->tickets()->count() > 0) {
            return back()->with('error', 'Cannot delete showtime with tickets.');
        }

        $showtime->delete();

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime deleted successfully.');
    }
}
