<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil banner aktif
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Format path banner
        $banners = $banners->map(function ($banner) {
            $imagePath = $banner->image;
            $imagePath = str_replace(['public/', 'storage/', '\\'], '/', $imagePath);
            $imagePath = ltrim($imagePath, '/');
            $banner->image = $imagePath;
            return $banner;
        });

        // Ambil event yang akan datang (upcoming)
        $upcomingEvents = Event::with('ticketCategories')
            ->where('status', 'upcoming')
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(8)
            ->get();

        // Ambil event featured (populer/unggulan)
        $featuredEvents = Event::with('ticketCategories')
            ->where('status', 'upcoming')
            ->where('event_date', '>=', now())
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Ambil event bulan ini
        $thisMonthEvents = Event::with('ticketCategories')
            ->where('status', 'upcoming')
            ->whereMonth('event_date', now()->month)
            ->whereYear('event_date', now()->year)
            ->orderBy('event_date')
            ->take(6)
            ->get();

        // Ambil kategori unik untuk filter
        $categories = Event::distinct()->pluck('category');

        return view('home', compact(
            'banners',
            'upcomingEvents',
            'featuredEvents',
            'thisMonthEvents',
            'categories'
        ));
    }

    public function event($slug)
    {
        $event = Event::with(['ticketCategories'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedEvents = Event::where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->where('status', 'upcoming')
            ->where('event_date', '>=', now())
            ->take(4)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }

    public function events(Request $request)
    {
        $query = Event::with('ticketCategories')
            ->where('status', 'upcoming')
            ->where('event_date', '>=', now());

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by city
        if ($request->has('city') && $request->city != '') {
            $query->where('city', $request->city);
        }

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->orderBy('event_date')->paginate(12);
        
        $categories = Event::distinct()->pluck('category');
        $cities = Event::distinct()->pluck('city');

        return view('events.index', compact('events', 'categories', 'cities'));
    }
}