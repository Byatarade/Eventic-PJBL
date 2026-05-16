 <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Event;

Route::get('/', function () {
    $events = Event::with('tickets')->where('status', 'published')->latest()->get();
    return view('welcome', compact('events'));
});

Route::get('/events/{event}', [\App\Http\Controllers\PublicEventController::class, 'show'])->name('events.show');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'eo') {
        return redirect()->route('eo.dashboard');
    }

    $orders = \App\Models\Order::where('user_id', auth()->id())->with('items.ticket.event')->get();
    
    // Stats calculation
    $activeTicketsCount = 0;
    foreach($orders as $order) {
        if ($order->status === 'paid') {
            foreach($order->items as $item) {
                if ($item->ticket->event->date >= now()) {
                    $activeTicketsCount += $item->quantity;
                }
            }
        }
    }
    
    $transactionCount = $orders->count();
    
    $upcomingEvents = \App\Models\Event::where('status', 'published')
        ->where('date', '>=', now())
        ->latest()
        ->take(3)
        ->get();
        
    $recentActivities = \App\Models\Order::where('user_id', auth()->id())
        ->with('items.ticket.event')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact('activeTicketsCount', 'transactionCount', 'upcomingEvents', 'recentActivities'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/events/{event}/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/events/{event}/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/events/{event}/checkout/details', [\App\Http\Controllers\User\CheckoutController::class, 'details'])->name('checkout.details');
        Route::post('/events/{event}/checkout/details', [\App\Http\Controllers\User\CheckoutController::class, 'processDetails'])->name('checkout.process_details');
        Route::get('/events/{event}/checkout/payment', [\App\Http\Controllers\User\CheckoutController::class, 'payment'])->name('checkout.payment');
        Route::post('/events/{event}/checkout/payment', [\App\Http\Controllers\User\CheckoutController::class, 'processPayment'])->name('checkout.process_payment');
        Route::get('/tickets', [\App\Http\Controllers\User\TicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{order}', [\App\Http\Controllers\User\TicketController::class, 'show'])->name('tickets.show');
        Route::get('/tickets/{order}/download', [\App\Http\Controllers\User\TicketController::class, 'download'])->name('tickets.download');
        Route::get('/transactions', [\App\Http\Controllers\User\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{order}', [\App\Http\Controllers\User\TransactionController::class, 'show'])->name('transactions.show');
        
        // Wishlist Routes
        Route::get('/wishlist', [\App\Http\Controllers\User\WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/{event}/toggle', [\App\Http\Controllers\User\WishlistController::class, 'toggle'])->name('wishlist.toggle');
        Route::delete('/wishlist/{wishlist}', [\App\Http\Controllers\User\WishlistController::class, 'destroy'])->name('wishlist.destroy');
    });

    // EO Routes
    Route::prefix('eo')->name('eo.')->middleware('eo')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\EO\DashboardController::class, 'index'])->name('dashboard');
        
        // Event Management
        Route::get('/events', [\App\Http\Controllers\EO\EventController::class, 'index'])->name('events.index');
        Route::get('/events/create', [\App\Http\Controllers\EO\EventController::class, 'create'])->name('events.create');
        Route::post('/events', [\App\Http\Controllers\EO\EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}', [\App\Http\Controllers\EO\EventController::class, 'show'])->name('events.show');
        Route::get('/events/{event}/edit', [\App\Http\Controllers\EO\EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [\App\Http\Controllers\EO\EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [\App\Http\Controllers\EO\EventController::class, 'destroy'])->name('events.destroy');
        
        // Transaction Management
        Route::get('/transactions', [\App\Http\Controllers\EO\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{transaction}', [\App\Http\Controllers\EO\TransactionController::class, 'show'])->name('transactions.show');
        
        // Analytics
        Route::get('/analytics', [\App\Http\Controllers\EO\AnalyticsController::class, 'index'])->name('analytics.index');
        
        // Participants
        Route::get('/participants', [\App\Http\Controllers\EO\ParticipantController::class, 'index'])->name('participants.index');
    });
});

require __DIR__.'/auth.php';
