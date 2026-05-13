<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Event;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the EO dashboard.
     */
    public function index(): View
    {
        $userId = auth()->id();

        // 1. Stats
        $totalEvents = Event::where('user_id', $userId)->count();
        $activeEvents = Event::where('user_id', $userId)->where('status', 'published')->count();
        
        // Count tickets sold and revenue for this EO
        // Revenue is calculated from paid orders that contain tickets for this EO's events
        $stats = DB::table('order_items')
            ->join('tickets', 'order_items.ticket_id', '=', 'tickets.id')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('events.user_id', $userId)
            ->where('orders.status', 'paid')
            ->select(
                DB::raw('SUM(order_items.quantity) as total_tickets_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->first();

        $totalTicketsSold = $stats->total_tickets_sold ?? 0;
        $totalRevenue = $stats->total_revenue ?? 0;

        // 2. Recent Transactions (Orders)
        $recentOrders = Order::whereHas('items.ticket.event', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with(['user', 'items.ticket.event'])
            ->latest()
            ->take(5)
            ->get();

        // 3. Upcoming Events
        $upcomingEvents = Event::where('user_id', $userId)
            ->where('status', 'published')
            ->where('date', '>=', now())
            ->with(['tickets' => function($query) {
                // Eager load sum of orderItems quantity to calculate sold tickets
                $query->withSum(['orderItems as sold_count' => function($q) {
                    $q->whereHas('order', function($oq) {
                        $oq->where('status', 'paid');
                    });
                }], 'quantity');
            }])
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        return view('eo.dashboard', compact(
            'totalEvents',
            'activeEvents',
            'totalTicketsSold',
            'totalRevenue',
            'recentOrders',
            'upcomingEvents'
        ));
    }
}
