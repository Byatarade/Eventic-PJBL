<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions for the EO.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();

        // Base query for orders belonging to this EO's events
        $query = Order::whereHas('items.ticket.event', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->with(['user', 'items.ticket.event', 'items.ticket']);

        // Search by user name or order ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('eo.transactions.index', compact('orders'));
    }

    /**
     * Display the specified transaction details.
     */
    public function show(Order $transaction): View
    {
        $userId = auth()->id();

        // Ensure the order belongs to one of the EO's events
        $isOwner = $transaction->items()->whereHas('ticket.event', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->exists();

        if (!$isOwner) {
            abort(403, 'Unauthorized access to this transaction.');
        }

        $transaction->load(['user', 'items.ticket.event']);

        return view('eo.transactions.show', compact('transaction'));
    }
}
