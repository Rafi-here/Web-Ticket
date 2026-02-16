<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Banner;
use App\Models\Cinema;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil banner aktif
        $banners = Banner::where('is_active', true)
            ->latest()
            ->get();

        // Format path banner
        $banners = $banners->map(function ($banner) {
            $imagePath = $banner->image;
            $imagePath = str_replace(['public/', 'storage/', '\\'], '/', $imagePath);
            $imagePath = ltrim($imagePath, '/');
            $banner->image = $imagePath;
            return $banner;
        });

        // Ambil film now playing
        $nowPlaying = Film::where('status', 'now_playing')
            ->latest()
            ->take(8)
            ->get();

        // 🔥 TAMBAHKAN: Ambil film coming soon
        $comingSoon = Film::where('status', 'coming_soon')
            ->orWhere(function ($query) {
                $query->where('release_date', '>', now())
                    ->where('status', '!=', 'now_playing');
            })
            ->latest()
            ->take(10)
            ->get();

        // Ambil cinema (tanpa filter is_active)
        $cinemas = Cinema::take(6)->get();

        return view('home', compact(
            'banners',
            'nowPlaying',
            'comingSoon',  // 🔥 DITAMBAHKAN
            'cinemas'
        ));
    }

    public function film($slug)
    {
        $film = Film::with(['category', 'showtimes.cinema'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedFilms = Film::where('category_id', $film->category_id)
            ->where('id', '!=', $film->id)
            ->where('status', 'now_playing')
            ->take(4)
            ->get();

        return view('film-detail', compact('film', 'relatedFilms'));
    }

    public function wishlist()
    {
        $wishlists = auth()->user()->wishlists()->with('film')->get();
        return view('wishlist', compact('wishlists'));
    }

    public function addToWishlist(Request $request, $filmId)
    {
        $user = auth()->user();

        if (!$user->wishlists()->where('film_id', $filmId)->exists()) {
            $user->wishlists()->create(['film_id' => $filmId]);
            return response()->json(['success' => true, 'message' => 'Added to wishlist']);
        }

        return response()->json(['success' => false, 'message' => 'Already in wishlist']);
    }

    public function removeFromWishlist($filmId)
    {
        auth()->user()->wishlists()->where('film_id', $filmId)->delete();
        return response()->json(['success' => true, 'message' => 'Removed from wishlist']);
    }
}
