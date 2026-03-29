<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\Api\PaymentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//=== Autentikasi user (jika perlu token) ===
// Route::middleware('auth:sanctum')->group(function () {

    // Get snap token (proses checkout)
    Route::post('/payment/checkout/{id}', [PaymentController::class, 'checkout'])->name('api.payment.checkout');

    // Payment success view (opsional, jika app pakai web view)
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('api.payment.success');

    Route::post('/midtrans/notification', [MidtransWebhookController::class, 'handle']);

Route::middleware('auth:sanctum')->post('/midtrans/token', [PaymentApiController::class, 'getToken']);

// });

// === Callback Midtrans (webhook) ===
// Route::post('/midtrans/callback', [MidtransCallbackController::class, 'receive'])->name('api.midtrans.callback');
