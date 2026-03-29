<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $logChannel = 'daily';
        Log::channel($logChannel)->info('Menerima notifikasi dari Midtrans.');
        Log::channel($logChannel)->info('Request Body:', $request->all());

        try {
            Midtrans\Config::$serverKey = config('midtrans.server_key');
            Midtrans\Config::$isProduction = config('midtrans.is_production', false);

            $notification = new Midtrans\Notification();

            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderIdFromMidtrans = $notification->order_id; // Ini berisi booking_code kita

            // Memverifikasi Signature Key Midtrans untuk keamanan
            $statusCode = $notification->status_code;
            $grossAmount = $notification->gross_amount;
            $signatureKey = $notification->signature_key;
            $serverKey = config('midtrans.server_key');
            $mySignatureKey = hash('sha512', $orderIdFromMidtrans . $statusCode . $grossAmount . $serverKey);

            if ($signatureKey !== $mySignatureKey) {
                Log::channel($logChannel)->error('Invalid Midtrans Signature Key detected.');
                return response()->json(['error' => 'Invalid signature'], 403);
            }

            Log::channel($logChannel)->info("Mencari booking dengan Kode Booking: [{$orderIdFromMidtrans}]");

            // --- PERBAIKAN UTAMA DI SINI (TYPO DIPERBAIKI) ---
            // Cari booking di database menggunakan 'booking_code' yang benar
            $booking = Booking::where('booking_code', $orderIdFromMidtrans)->first();

            if (!$booking) {
                Log::channel($logChannel)->warning("Booking dengan Kode Booking [{$orderIdFromMidtrans}] tidak ditemukan. Notifikasi diabaikan.");
                return response()->json(['message' => 'Booking not found, but notification acknowledged.'], 200);
            }

            if ($booking->payment_status === 'paid' || $booking->payment_status === 'settlement') {
                Log::channel($logChannel)->info("Pembayaran untuk Kode Booking [{$orderIdFromMidtrans}] sudah diproses. Diabaikan.");
                return response()->json(['message' => 'Payment already processed.'], 200);
            }

            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                if ($fraudStatus == 'accept') {
                    $booking->payment_status = 'paid';
                    Log::channel($logChannel)->info("Kode Booking [{$orderIdFromMidtrans}]: Status diubah menjadi 'paid'.");
                }
            } else if ($transactionStatus == 'pending') {
                Log::channel($logChannel)->info("Kode Booking [{$orderIdFromMidtrans}]: Pembayaran masih 'pending'.");
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $booking->payment_status = 'failed';
                Log::channel($logChannel)->info("Kode Booking [{$orderIdFromMidtrans}]: Status diubah menjadi 'failed'.");
            }

            $booking->save();
            Log::channel($logChannel)->info("Kode Booking [{$orderIdFromMidtrans}]: Perubahan berhasil disimpan ke database.");

        } catch (\Exception $e) {
            Log::channel($logChannel)->error('Error saat memproses notifikasi Midtrans: ' . $e->getMessage());
            Log::channel($logChannel)->error('Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Terjadi kesalahan internal.'], 500);
        }

        return response()->json(['message' => 'Notification processed successfully.']);
    }
}
