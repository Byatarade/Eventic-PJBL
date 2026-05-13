<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display the analytics and reports dashboard for the EO.
     */
    public function index(): View
    {
        $userId = auth()->id();

        // 1. Overall Stats
        $stats = DB::table('order_items')
            ->join('tickets', 'order_items.ticket_id', '=', 'tickets.id')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('events.user_id', $userId)
            ->where('orders.status', 'paid')
            ->select(
                DB::raw('SUM(order_items.quantity) as total_tickets'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'),
                DB::raw('COUNT(DISTINCT orders.id) as total_transactions')
            )
            ->first();

        $totalTickets = $stats->total_tickets ?? 0;
        $totalRevenue = $stats->total_revenue ?? 0;
        $totalTransactions = $stats->total_transactions ?? 0;

        // 2. Revenue per Event
        $eventStats = DB::table('events')
            ->leftJoin('tickets', 'events.id', '=', 'tickets.event_id')
            ->leftJoin('order_items', 'tickets.id', '=', 'order_items.ticket_id')
            ->leftJoin('orders', function($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                     ->where('orders.status', '=', 'paid');
            })
            ->where('events.user_id', $userId)
            ->select(
                'events.id',
                'events.name',
                'events.status',
                DB::raw('COALESCE(SUM(order_items.quantity), 0) as tickets_sold'),
                DB::raw('COALESCE(SUM(order_items.quantity * order_items.price), 0) as revenue')
            )
            ->groupBy('events.id', 'events.name', 'events.status')
            ->orderByDesc('revenue')
            ->get();

        // 3. Monthly Trend (Last 6 Months)
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();
        
        $monthlyDataQuery = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('tickets', 'order_items.ticket_id', '=', 'tickets.id')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->where('events.user_id', $userId)
            ->where('orders.status', 'paid')
            ->where('orders.created_at', '>=', $sixMonthsAgo)
            ->select(
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('YEAR(orders.created_at) as year'),
                DB::raw('SUM(order_items.quantity * order_items.price) as revenue'),
                DB::raw('SUM(order_items.quantity) as tickets')
            )
            ->groupBy(DB::raw('YEAR(orders.created_at)'), DB::raw('MONTH(orders.created_at)'))
            ->orderBy(DB::raw('YEAR(orders.created_at)'))
            ->orderBy(DB::raw('MONTH(orders.created_at)'))
            ->get();

        // Format chart data
        $chartLabels = [];
        $chartRevenue = [];
        $chartTickets = [];

        // Pre-fill the last 6 months with 0
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $key = $month->format('n-Y');
            
            $chartLabels[] = $month->translatedFormat('M Y');
            $chartRevenue[$key] = 0;
            $chartTickets[$key] = 0;
        }

        foreach ($monthlyDataQuery as $data) {
            $key = $data->month . '-' . $data->year;
            if (isset($chartRevenue[$key])) {
                $chartRevenue[$key] = (float) $data->revenue;
                $chartTickets[$key] = (int) $data->tickets;
            }
        }

        $chartRevenue = array_values($chartRevenue);
        $chartTickets = array_values($chartTickets);

        return view('eo.analytics.index', compact(
            'totalTickets',
            'totalRevenue',
            'totalTransactions',
            'eventStats',
            'chartLabels',
            'chartRevenue',
            'chartTickets'
        ));
    }
}
