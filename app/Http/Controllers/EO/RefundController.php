<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    /**
     * Menampilkan daftar pengajuan refund untuk event milik EO.
     */
    public function index()
    {
        // Cari refund request yang ordernya mengandung event milik EO yang login
        $refunds = RefundRequest::whereHas('order.items.ticket.event', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['order.user', 'order.items.ticket.event'])
        ->latest()
        ->get();

        return view('eo.refunds.index', compact('refunds'));
    }

    /**
     * Memproses persetujuan atau penolakan refund.
     */
    public function update(Request $request, RefundRequest $refund)
    {
        // Pastikan EO memiliki hak atas order ini
        if ($refund->order->items->first()->ticket->event->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $refund->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        if ($request->status === 'approved') {
            // Ubah status order menjadi canceled atau refunded
            $refund->order->update(['status' => 'canceled']);
            $message = 'Refund berhasil disetujui. Tiket otomatis dibatalkan.';
        } else {
            $message = 'Refund ditolak.';
        }

        return back()->with('success', $message);
    }
}
