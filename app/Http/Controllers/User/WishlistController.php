<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Menampilkan daftar wishlist user.
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->with('event.tickets')
            ->latest()
            ->get();

        return view('user.wishlist.index', compact('wishlists'));
    }

    /**
     * Menambah atau menghapus event dari wishlist (Toggle).
     */
    public function toggle(Request $request, Event $event)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
            $message = 'Event berhasil dihapus dari wishlist.';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'event_id' => $event->id
            ]);
            $status = 'added';
            $message = 'Event berhasil ditambahkan ke wishlist.';
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => $status,
                'message' => $message
            ]);
        }

        return back()->with('success', $message);
    }

    /**
     * Menghapus event dari wishlist secara spesifik.
     */
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return back()->with('success', 'Event dihapus dari wishlist.');
    }
}
