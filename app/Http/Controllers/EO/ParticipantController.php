<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\OrderItem;
use App\Models\Event;

class ParticipantController extends Controller
{
    /**
     * Display a listing of event participants.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();

        // Fetch all order items (participants) for paid orders belonging to this EO's events
        $query = OrderItem::whereHas('ticket.event', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereHas('order', function ($q) {
                $q->where('status', 'paid');
            })
            ->with(['order.user', 'ticket.event']);

        // Filter by specific event
        if ($request->filled('event_id')) {
            $query->whereHas('ticket', function ($q) use ($request) {
                $q->where('event_id', $request->event_id);
            });
        }

        // Search by user name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('order.user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $participants = $query->latest('id')->paginate(15)->withQueryString();

        // Events list for the filter dropdown
        $events = Event::where('user_id', $userId)->orderBy('name')->get();

        return view('eo.participants.index', compact('participants', 'events'));
    }
}
