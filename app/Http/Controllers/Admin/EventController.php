<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->withCount('ticketCategories')->orderBy('event_date')->paginate(10);

        // Get unique categories for filter
        $categories = Event::distinct()->pluck('category');

        return view('admin.events.index', compact('events', 'categories'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:events',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'venue' => 'required',
            'city' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('events', 'public');
            $data['poster'] = $path;
        }

        if ($request->artists) {
            $data['artists'] = json_encode(explode(',', $request->artists));
        }

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        $event->load('ticketCategories');
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $event->load('ticketCategories');

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|unique:events,title,' . $event->id,
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'venue' => 'required',
            'city' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $path = $request->file('poster')->store('events', 'public');
            $data['poster'] = $path;
        }

        if ($request->artists) {
            $data['artists'] = json_encode(explode(',', $request->artists));
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function toggleStatus(Event $event)
    {
        $event->update([
            'status' => $event->status === 'upcoming' ? 'cancelled' : 'upcoming'
        ]);

        return response()->json([
            'success' => true,
            'status' => $event->status
        ]);
    }
}
