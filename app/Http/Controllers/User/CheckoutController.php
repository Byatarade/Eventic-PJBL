<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Event $event)
    {
        // Pastikan event sudah publish
        if ($event->status !== 'published') {
            abort(404);
        }

        $event->load('tickets');

        return view('user.checkout.index', compact('event'));
    }
}
