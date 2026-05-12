<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                    ->with(['items.ticket.event'])
                    ->latest()
                    ->get();

        // Get published events for banner carousel
        $bannerEvents = Event::where('status', 'published')
                    ->where('date', '>=', now())
                    ->with('tickets')
                    ->latest()
                    ->take(6)
                    ->get();

        return view('user.tickets.index', compact('orders', 'bannerEvents'));
    }

    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.ticket.event']);

        return view('user.tickets.show', compact('order'));
    }
}
