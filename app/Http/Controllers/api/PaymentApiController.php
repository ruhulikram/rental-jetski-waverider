<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentApiController extends Controller
{
    public function getToken(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'gross_amount' => 'required|numeric',
            'package_id' => 'required|exists:jetski_packages,id',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $request->order_id,
                'gross_amount' => (int) $request->gross_amount
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ],
            'enabled_payments' => ['gopay', 'bank_transfer', 'qris'],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }
}
