<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    /**
     * Menampilkan form pengajuan refund.
     */
    public function create(Order $order)
    {
        // Pastikan order milik user dan sudah lunas
        if ($order->user_id !== Auth::id() || $order->status !== 'paid') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Cek jika sudah pernah mengajukan refund
        if ($order->refundRequest) {
            return redirect()->route('user.tickets.show', $order)->with('error', 'Anda sudah mengajukan refund untuk pesanan ini.');
        }

        return view('user.refunds.create', compact('order'));
    }

    /**
     * Menyimpan pengajuan refund.
     */
    public function store(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'paid') {
            abort(403);
        }

        $request->validate([
            'reason' => 'required|string|min:10',
            'bank_info' => 'required|string|min:10',
        ]);

        RefundRequest::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'bank_info' => $request->bank_info,
            'status' => 'pending',
        ]);

        // Opsional: Ubah status order menjadi sesuatu yang menandakan proses refund
        // $order->update(['status' => 'refunding']);

        return redirect()->route('user.tickets.show', $order)->with('success', 'Pengajuan refund berhasil dikirim. Menunggu persetujuan EO.');
    }
}
