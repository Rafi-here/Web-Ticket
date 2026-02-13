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
        // Ambil data banner
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

        // UNCOMMENT BARIS INI UNTUK DEBUG DATA BANNER
        // dd($banners->toArray());

        // Format ulang banner untuk memastikan image path benar
        $banners = $banners->map(function ($banner) {
            if ($banner->image) {
                $banner->image_url = asset('storage/' . $banner->image);
                // Cek apakah file ada
                $banner->image_exists = file_exists(storage_path('app/public/' . $banner->image));
            } else {
                $banner->image_url = null;
                $banner->image_exists = false;
            }
            return $banner;
        });

        $nowPlaying = Film::with('category')
            ->where('status', 'now_playing')
            ->latest()
            ->take(8)
            ->get();

        $comingSoon = Film::with('category')
            ->where('status', 'coming_soon')
            ->latest()
            ->take(8)
            ->get();

        $cinemas = Cinema::take(6)->get();

        $promos = [
            [
                'title' => 'Student Discount',
                'description' => 'Dapatkan diskon 20% dengan kartu pelajar',
                'image' => 'https://via.placeholder.com/300x200?text=Student+Discount',
            ],
            [
                'title' => 'Weekend Special',
                'description' => 'Tiket weekend spesial Rp35.000',
                'image' => 'https://via.placeholder.com/300x200?text=Weekend+Special',
            ],
        ];

        return view('home', compact('banners', 'nowPlaying', 'comingSoon', 'cinemas', 'promos'));
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
