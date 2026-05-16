<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    public function show(Event $event)
    {
        if ($event->status !== 'published' && (!auth()->check() || auth()->user()->id !== $event->user_id)) {
            abort(404);
        }
        $event->load('tickets', 'user');
        
        $isWishlisted = false;
        if (auth()->check()) {
            $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
                ->where('event_id', $event->id)
                ->exists();
        }

        return view('events.show', compact('event', 'isWishlisted'));
    }
}
