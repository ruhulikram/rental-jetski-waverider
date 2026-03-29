<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\JetskiPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Midtrans;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar semua booking (untuk Panel Admin).
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Booking::with(['user', 'jetskiPackage'])->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('booking_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $bookings = $query->get();
        return view('dashboard.bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan form untuk membuat booking manual (untuk Panel Admin).
     */
    public function create()
    {
        $users = User::all();
        $packages = JetskiPackage::all();
        return view('dashboard.bookings.create', compact('users', 'packages'));
    }

    /**
     * Menyimpan booking baru yang dibuat dari Dashboard Pengguna.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'jetski_package_id' => 'required|exists:jetski_packages,id',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required|date_format:H:i|after_or_equal:08:00|before_or_equal:18:00',
            'phone' => 'required|string|max:15',
        ]);

        $package = JetskiPackage::findOrFail($request->jetski_package_id);
        $user = auth()->user();

        // 2. Buat Booking Code sebagai ID Transaksi
        $bookingCode = 'BOOK-' . strtoupper(uniqid());

        // 3. Konfigurasi Midtrans
        Midtrans\Config::$serverKey = config('midtrans.server_key');
        Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        // 4. Siapkan parameter untuk Midtrans, gunakan booking_code sebagai order_id
        $params = [
            'transaction_details' => [
                'order_id' => $bookingCode,
                'gross_amount' => $package->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $request->phone,
            ],
        ];

        // 5. Dapatkan Snap Token
        try {
            $snapToken = Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat transaksi pembayaran: ' . $e->getMessage());
        }

        // 6. Simpan booking ke database (TANPA order_id)
        $booking = Booking::create([
            'user_id' => $user->id,
            'jetski_package_id' => $package->id,
            'booking_code' => $bookingCode,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'total_price' => $package->price,
            'status' => 'confirmed',
            'payment_status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        if (empty($user->phone)) {
            $user->phone = $request->phone;
            $user->save();
        }

        return redirect()->route('backend.v_index.index')
            ->with('success', 'Booking berhasil dibuat! Silakan selesaikan pembayaran.');
    }

    /**
     * Menampilkan halaman konfirmasi pembayaran sukses.
     */
    public function paymentSuccess(Request $request)
    {
        // Cari booking berdasarkan booking_code dari URL
        $bookingCode = $request->query('booking_code');
        $booking = Booking::with(['user', 'jetskiPackage'])
            ->where('booking_code', $bookingCode)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('payment-success', compact('booking'));
    }


    /**
     * Menampilkan detail satu booking (untuk Panel Admin).
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'jetskiPackage'])->findOrFail($id);
        return view('dashboard.bookings.show', compact('booking'));
    }

    /**
     * Menampilkan form untuk mengedit booking (untuk Panel Admin).
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $packages = JetskiPackage::all();
        return view('dashboard.bookings.edit', ['edit' => $booking, 'packages' => $packages]);
    }

    /**
     * Mengupdate data booking di database (untuk Panel Admin).
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'jetski_package_id' => 'required|exists:jetski_packages,id',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);
        $package = JetskiPackage::findOrFail($request->jetski_package_id);

        $booking->update([
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'jetski_package_id' => $request->jetski_package_id,
            'total_price' => $package->price,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('backend.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Menghapus data booking (untuk Panel Admin).
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('backend.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Menampilkan halaman konfirmasi pembayaran sukses.
     */
//     public function paymentSuccess(Request $request)
//     {
//         // Ambil booking_code dari query string di URL
//         $bookingCode = $request->query('booking_code');

//         // Cari booking berdasarkan booking_code dan user yang sedang login
//         $booking = Booking::with(['user', 'jetskiPackage'])
//             ->where('booking_code', $bookingCode)
//             ->where('user_id', auth()->id())
//             ->firstOrFail(); // Gagal jika tidak ditemukan

//         // Tampilkan view dengan data booking
//         return view('payment-success', compact('booking'));
//     }
 }
