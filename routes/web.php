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
    return view('dashboard');
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
        Route::get('/tickets', function() { return view('user.tickets.index'); })->name('tickets.index');
        Route::get('/transactions', function() { return view('user.transactions.index'); })->name('transactions.index');
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
        Route::get('/transactions', function() { return view('eo.transactions.index'); })->name('transactions.index');
        
        // Analytics
        Route::get('/analytics', function() { return view('eo.analytics.index'); })->name('analytics.index');
        
        // Participants
        Route::get('/participants', function() { return view('eo.participants.index'); })->name('participants.index');
    });
});

require __DIR__.'/auth.php';
