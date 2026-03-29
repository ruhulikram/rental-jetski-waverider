<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Http;


class PaymentController extends Controller
{

    public function checkout($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->payment_status === 'paid') {
            return redirect()->route('backend.bookings.index')
                ->with('info', 'Booking ini sudah dibayar.');
        }

        $serverKey = config('midtrans.server_key'); // simpan di .env
        $authHeader = 'Basic ' . base64_encode($serverKey . ':');

        $payload = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'enabled_payments' => [
                'gopay',
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
                'indomaret',
                'credit_card'
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
            'callbacks' => [
                'finish' => route('payment.success')
            ]
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $authHeader,
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $payload);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal mendapatkan Snap Token dari Midtrans.');
        }

        $snapToken = $response->json()['token'];

        // Simpan Snap Token & Timestamp ke database
        $booking->update([
            'snap_token' => $snapToken,
            'snap_token_created_at' => now(),
        ]);

        return view('payments.checkout', compact('booking', 'snapToken'));
    }

    public function success()
    {
        return view('payments.success');
    }
}
