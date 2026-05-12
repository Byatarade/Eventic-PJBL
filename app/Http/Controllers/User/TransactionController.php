<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                    ->with(['items.ticket.event'])
                    ->latest()
                    ->get();

        return view('user.transactions.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.ticket.event']);

        return view('user.transactions.show', compact('order'));
    }
}
