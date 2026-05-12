<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Event $event)
    {
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
            'tickets'            => 'required|array',
            'tickets.*.id'       => 'required|exists:tickets,id',
            'tickets.*.quantity' => 'required|integer|min:0',
        ]);

        $selectedTickets = collect($request->tickets)->filter(fn($t) => $t['quantity'] > 0)->values();

        if ($selectedTickets->isEmpty()) {
            return back()->withErrors(['tickets' => 'Pilih minimal satu tiket.']);
        }

        if ($selectedTickets->sum('quantity') > 5) {
            return back()->withErrors(['tickets' => 'Maksimal pembelian adalah 5 tiket.']);
        }

        // Hapus draft order lama yang masih pending untuk event yang sama (jika ada)
        $oldOrderId = session('checkout.order_id');
        if ($oldOrderId) {
            $oldOrder = Order::find($oldOrderId);
            if ($oldOrder && $oldOrder->status === 'pending' && $oldOrder->user_id === auth()->id()) {
                $oldOrder->delete();
            }
        }

        session(['checkout' => [
            'event_id' => $event->id,
            'tickets'  => $selectedTickets->toArray(),
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
        $ticketIds       = collect($selectedTickets)->pluck('id');
        $tickets         = Ticket::whereIn('id', $ticketIds)->get();

        return view('user.checkout.details', compact('event', 'selectedTickets', 'tickets'));
    }

    public function processDetails(Request $request, Event $event)
    {
        $request->validate([
            'orderer.name'             => 'required|string|max:255',
            'orderer.email'            => 'required|email|max:255',
            'orderer.whatsapp'         => 'required|string|max:20',
            'tickets'                  => 'required|array',
            'tickets.*.ticket_id'      => 'required|exists:tickets,id',
            'tickets.*.name'           => 'required|string|max:255',
            'tickets.*.identity_type'  => 'required|string',
            'tickets.*.identity_number'=> 'required|string|max:50',
        ]);

        $checkoutData = session('checkout');
        if (!$checkoutData || $checkoutData['event_id'] !== $event->id) {
            return redirect()->route('user.checkout.index', $event);
        }

        $selectedTickets = collect($checkoutData['tickets']);
        $ticketIds       = $selectedTickets->pluck('id');
        $tickets         = Ticket::whereIn('id', $ticketIds)->get();

        // Hitung total harga
        $totalPrice = 0;
        foreach ($selectedTickets as $selection) {
            $ticketData  = $tickets->firstWhere('id', $selection['id']);
            $totalPrice += $ticketData->price * $selection['quantity'];
        }

        // -------------------------------------------------------
        // Buat Order dengan status PENDING (user belum bayar)
        // -------------------------------------------------------
        // Jika sudah ada pending order dari session (misal user back & re-submit), hapus dulu
        $existingOrderId = $checkoutData['order_id'] ?? null;
        if ($existingOrderId) {
            $existingOrder = Order::find($existingOrderId);
            if ($existingOrder && $existingOrder->status === 'pending' && $existingOrder->user_id === auth()->id()) {
                $existingOrder->delete();
            }
        }

        $order = Order::create([
            'user_id'    => auth()->id(),
            'total_price'=> $totalPrice,
            'status'     => 'pending',
            'expired_at' => now()->addHours(24),
        ]);

        // Buat OrderItems
        foreach ($selectedTickets as $selection) {
            $ticketData = $tickets->firstWhere('id', $selection['id']);
            OrderItem::create([
                'order_id'  => $order->id,
                'ticket_id' => $ticketData->id,
                'quantity'  => $selection['quantity'],
                'price'     => $ticketData->price,
            ]);
        }

        // Simpan order_id ke session agar processPayment bisa update order yang sama
        $checkoutData['order_id']           = $order->id;
        $checkoutData['orderer']            = $request->orderer;
        $checkoutData['participant_details']= $request->tickets;
        session(['checkout' => $checkoutData]);

        return redirect()->route('user.checkout.payment', $event);
    }

    public function payment(Event $event)
    {
        $checkoutData = session('checkout');
        if (!$checkoutData || $checkoutData['event_id'] !== $event->id || !isset($checkoutData['orderer'])) {
            return redirect()->route('user.checkout.index', $event);
        }

        $selectedTickets = $checkoutData['tickets'];
        $ticketIds       = collect($selectedTickets)->pluck('id');
        $tickets         = Ticket::whereIn('id', $ticketIds)->get();

        return view('user.checkout.payment', compact('event', 'selectedTickets', 'tickets'));
    }

    public function processPayment(Request $request, Event $event)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $checkoutData = session('checkout');
        if (!$checkoutData || $checkoutData['event_id'] !== $event->id) {
            return redirect()->route('user.checkout.index', $event);
        }

        // Pastikan order_id ada di session (dibuat saat processDetails)
        $orderId = $checkoutData['order_id'] ?? null;
        if (!$orderId) {
            return redirect()->route('user.checkout.index', $event)
                             ->withErrors(['error' => 'Sesi pembayaran tidak valid. Silakan ulangi dari awal.']);
        }

        $order = Order::where('id', $orderId)
                      ->where('user_id', auth()->id())
                      ->where('status', 'pending')
                      ->first();

        if (!$order) {
            // Order tidak ditemukan atau sudah diproses
            session()->forget('checkout');
            return redirect()->route('user.tickets.index')
                             ->withErrors(['error' => 'Order tidak ditemukan atau sudah diproses.']);
        }

        // Cek apakah order sudah expired
        if ($order->expired_at && now()->gt($order->expired_at)) {
            $order->update(['status' => 'canceled']);
            session()->forget('checkout');
            return redirect()->route('user.tickets.index')
                             ->withErrors(['error' => 'Batas waktu pembayaran telah habis. Silakan buat pesanan baru.']);
        }

        // -------------------------------------------------------
        // Update status order menjadi PAID
        // -------------------------------------------------------
        $order->update([
            'status'     => 'paid',
            'expired_at' => now()->addYears(1), // Perpanjang karena sudah lunas
        ]);

        session()->forget('checkout');

        return redirect()->route('user.tickets.index')
                         ->with('success', 'Pembayaran berhasil! Tiket Anda sudah terbit. 🎉');
    }
}
