<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of ticket categories for an event.
     */
    public function index(Event $event)
    {
        $categories = $event->ticketCategories()->paginate(10);
        return view('admin.ticket-categories.index', compact('event', 'categories'));
    }

    /**
     * Show the form for creating a new ticket category.
     */
    public function create(Event $event)
    {
        return view('admin.ticket-categories.create', compact('event'));
    }

    /**
     * Store a newly created ticket category.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'max_per_order' => 'required|integer|min:1',
            'benefits' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['available'] = $request->quantity;

            if ($request->benefits) {
                $benefits = array_map('trim', explode("\n", $request->benefits));
                $data['benefits'] = json_encode($benefits);
            }

            $event->ticketCategories()->create($data);

            DB::commit();

            return redirect()
                ->route('admin.events.ticket-categories.index', $event)
                ->with('success', 'Kategori tiket berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Gagal menambahkan kategori tiket: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified ticket category.
     */
    public function show(Event $event, TicketCategory $ticketCategory)
    {
        return view('admin.ticket-categories.show', compact('event', 'ticketCategory'));
    }

    /**
     * Show the form for editing the specified ticket category.
     */
    public function edit(Event $event, TicketCategory $ticketCategory)
    {
        return view('admin.ticket-categories.edit', compact('event', 'ticketCategory'));
    }

    /**
     * Update the specified ticket category.
     */
    public function update(Request $request, Event $event, TicketCategory $ticketCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'max_per_order' => 'required|integer|min:1',
            'benefits' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();

            // Hitung selisih quantity
            $oldQuantity = $ticketCategory->quantity;
            $newQuantity = $request->quantity;
            $difference = $newQuantity - $oldQuantity;

            // Update available berdasarkan perubahan quantity
            $data['available'] = $ticketCategory->available + $difference;

            if ($request->benefits) {
                $benefits = array_map('trim', explode("\n", $request->benefits));
                $data['benefits'] = json_encode($benefits);
            }

            $ticketCategory->update($data);

            DB::commit();

            return redirect()
                ->route('admin.events.ticket-categories.index', $event)
                ->with('success', 'Kategori tiket berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Gagal memperbarui kategori tiket: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified ticket category.
     */
    public function destroy(Event $event, TicketCategory $ticketCategory)
    {
        // Cek apakah sudah ada tiket yang terjual
        if ($ticketCategory->sold_count > 0) {
            return back()->with('error', 'Tidak dapat menghapus kategori yang sudah memiliki tiket terjual.');
        }

        $ticketCategory->delete();

        return redirect()
            ->route('admin.events.ticket-categories.index', $event)
            ->with('success', 'Kategori tiket berhasil dihapus.');
    }
}
