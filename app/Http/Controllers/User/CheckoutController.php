<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Event $event)
    {
        // Pastikan event sudah publish
        if ($event->status !== 'published') {
            abort(404);
        }

        $event->load('tickets');

        return view('user.checkout.index', compact('event'));
    }

    public function process(Request $request, Event $event)
    {
        if (is_string($request->tickets)) {
            $request->merge(['tickets' => json_decode($request->tickets, true)]);
        }

        $request->validate([
            'tickets' => 'required|array',
            'tickets.*.id' => 'required|exists:tickets,id',
            'tickets.*.quantity' => 'required|integer|min:0',
        ]);

        $selectedTickets = collect($request->tickets)->filter(function($t) {
            return $t['quantity'] > 0;
        })->values();

        if ($selectedTickets->isEmpty()) {
            return back()->withErrors(['tickets' => 'Pilih minimal satu tiket.']);
        }

        $totalQty = $selectedTickets->sum('quantity');
        if ($totalQty > 5) {
            return back()->withErrors(['tickets' => 'Maksimal pembelian adalah 5 tiket.']);
        }

        session(['checkout' => [
            'event_id' => $event->id,
            'tickets' => $selectedTickets->toArray(),
        ]]);

        return redirect()->route('user.checkout.details', $event);
    }

    public function details(Event $event)
    {
        $checkoutData = session('checkout');
        if (!$checkoutData || $checkoutData['event_id'] !== $event->id) {
            return redirect()->route('user.checkout.index', $event);
        }

        $selectedTickets = $checkoutData['tickets'];
        $ticketIds = collect($selectedTickets)->pluck('id');
        $tickets = \App\Models\Ticket::whereIn('id', $ticketIds)->get();

        return view('user.checkout.details', compact('event', 'selectedTickets', 'tickets'));
    }
}
