<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Jobs\ProcessPodcast;


Route::get('/redis-test', function (Request $request) {
    Redis::set('key', $request->get('query'));
    $value = Redis::get('key');
    ProcessPodcast::dispatch(['key' => $value]);
    dd($value);
});


Route::get('/', function () {
    return view('welcome');
});
