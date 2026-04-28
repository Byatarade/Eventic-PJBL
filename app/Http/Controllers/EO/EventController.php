<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of EO's events.
     */
    public function index(): View
    {
        $events = Event::where('user_id', auth()->id())
            ->withCount('tickets')
            ->latest()
            ->get();

        return view('eo.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create(): View
    {
        return view('eo.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'datetime' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'terms' => ['nullable', 'string'],
            'organizer_name' => ['required', 'string', 'max:255'],
            'organizer_social' => ['nullable', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:2048'],
            'tickets' => ['required', 'array', 'min:1'],
            'tickets.*.type' => ['required', 'string', 'max:255'],
            'tickets.*.price' => ['required', 'integer', 'min:0'],
            'tickets.*.stock' => ['required', 'integer', 'min:1'],
        ]);

        // Determine status based on which button was pressed
        $status = $request->has('draft') ? 'draft' : 'published';

        // Handle banner upload
        $imagePath = null;
        if ($request->hasFile('banner')) {
            $imagePath = $request->file('banner')->store('events/banners', 'public');
        }

        // Create event
        $event = Event::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['datetime'],
            'image' => $imagePath,
            'status' => $status,
            'terms' => $validated['terms'],
            'organizer_name' => $validated['organizer_name'],
            'organizer_social' => $validated['organizer_social'],
        ]);

        // Create tickets
        foreach ($validated['tickets'] as $ticketData) {
            Ticket::create([
                'event_id' => $event->id,
                'type' => $ticketData['type'],
                'price' => $ticketData['price'],
                'stock' => $ticketData['stock'],
                'max_per_user' => 5, // Default limit per user
            ]);
        }

        return redirect()
            ->route('eo.events.index')
            ->with('success', 'Event berhasil dibuat!');
    }
    /**
     * Display the specified event.
     */
    public function show(Event $event): View
    {
        // Ensure the event belongs to the authenticated user
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $event->load('tickets');
        return view('eo.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event): View
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $event->load('tickets');
        return view('eo.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'datetime' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'terms' => ['nullable', 'string'],
            'organizer_name' => ['required', 'string', 'max:255'],
            'organizer_social' => ['nullable', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:2048'],
            'tickets' => ['required', 'array', 'min:1'],
            'tickets.*.type' => ['required', 'string', 'max:255'],
            'tickets.*.price' => ['required', 'integer', 'min:0'],
            'tickets.*.stock' => ['required', 'integer', 'min:1'],
        ]);

        // Handle banner upload
        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->image = $request->file('banner')->store('events/banners', 'public');
        }

        $event->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['datetime'],
            'terms' => $validated['terms'],
            'organizer_name' => $validated['organizer_name'],
            'organizer_social' => $validated['organizer_social'],
            'status' => $request->has('draft') ? 'draft' : 'published',
        ]);

        // Update tickets: Delete removed ones and update/create current ones
        $keepTicketIds = [];
        foreach ($validated['tickets'] as $ticketData) {
            $ticket = $event->tickets()->updateOrCreate(
                ['type' => $ticketData['type']],
                [
                    'price' => $ticketData['price'],
                    'stock' => $ticketData['stock'],
                    'max_per_user' => 5,
                ]
            );
            $keepTicketIds[] = $ticket->id;
        }
        
        // Remove tickets that are no longer in the list
        $event->tickets()->whereNotIn('id', $keepTicketIds)->delete();

        return redirect()
            ->route('eo.events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete banner
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        // Delete tickets (cascade should handle this if configured, but doing it manually to be safe)
        $event->tickets()->delete();
        $event->delete();

        return redirect()
            ->route('eo.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }
}
