<?php

use App\Http\Controllers\ProfileController;
use App\Jobs\ProcessPodcast;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

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
});

Route::get('/test', function () {
    return "Bon Jour....";
});

Route::get('/users', function () {
   dd(User::all());
});

Route::get('/redis-test', function (Request $request) {
    Redis::set('key', $request->get('query'));
    $value = Redis::get('key');
    ProcessPodcast::dispatch(['key' => $value]);
    dd($value);
});


require __DIR__.'/auth.php';
