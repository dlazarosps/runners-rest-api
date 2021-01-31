<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RaceController;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\ContestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v0')->group(function () {
    Route::resources([
        'races' => RaceController::class,
        'runners' => RunnerController::class,
        'contests' => ContestController::class,
    ]);

    Route::post('contests/finish', [ContestController::class, 'finish'])->name('contests.finish');
    Route::post('contests/insert', [ContestController::class, 'store'])->name('contests.insert');
    
    Route::get('contests/{race}/rank', [ContestController::class, 'rank'])->name('contests.rank');
    Route::get('contests/{type}/results', [ContestController::class, 'perType'])->name('contests.per_type');
    Route::get('contests/type/{type}/age/{age}/results', [ContestController::class, 'perAge'])->name('contests.per_age');
});

