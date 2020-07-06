<?php

use Illuminate\Http\Request;
use Vectorwyse\IdleTimeoutAlert\TimeoutCalculator\TimeoutCalculator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('idle-timeout-alert')->group(function () {
    Route::get('check', function (Request $request) {
        return response()->json(TimeoutCalculator::getSecondsLeft($request));
    });
});
