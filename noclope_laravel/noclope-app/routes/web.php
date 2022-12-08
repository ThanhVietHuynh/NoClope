<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

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
Route::get('/stripe', [StripeController::class, 'index']) -> name('stripe.index');
Route::get('/stripe/cancel', [StripeController::class, 'cancel']) -> name('stripe.cancel');
Route::get('/stripe/success', [StripeController::class, 'success']) -> name('stripe.success');
Route::post('/stripe/create', [StripeController::class, 'create']) -> name('stripe.create');
Route::post('/stripe/setup', [StripeController::class, 'setup']) -> name('stripe.setup');