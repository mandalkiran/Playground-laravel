<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/chat',function(Request $request) {
        Log::info("CHAT FUNCTION TRIGGERED");
        \App\Events\MessageEvent::dispatch($request->data);
    });
});
Route::post('/ws-test',function(Request $request) {
    Log::info("CHAT FUNCTION TRIGGERED");
    \App\Events\MessageEvent::dispatch($request->data);
});

Route::get('/cleavr',function(Request $request) {
    Log::info("CHAT FUNCTION TRIGGERED");
    \App\Events\MessageEvent::dispatch("I love cleavr.....");
});
Route::get('/test', function () {
    Log::info("BON JOUR");
    return "Bon Jour....";
});

require __DIR__.'/auth.php';
