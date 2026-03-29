<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\JetskiPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Data untuk admin
            $totalBookings = Booking::count();
            $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_price');
            $pendingBookings = Booking::where('payment_status', 'pending')->count();

            // Data untuk Grafik Booking Harian (7 hari terakhir)
            $bookingsChart = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get();

            $chartLabels = $bookingsChart->pluck('date')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d M');
            });
            $chartData = $bookingsChart->pluck('count');

            return view('dashboard.v_index.admin', compact(
                'totalBookings',
                'totalRevenue',
                'pendingBookings',
                'chartLabels',
                'chartData'
            ));
        } else {
            // Data untuk user biasa
            $bookings = $user->bookings()->with('jetskiPackage')->latest()->get();
            $packages = JetskiPackage::where('is_active', true)->get();
            $hasPendingBooking = $bookings->contains('payment_status', 'pending');
            return view('dashboard.v_index.user', [
                'bookings' => $bookings,
                'packages' => $packages,
                'hasPendingBooking' => $hasPendingBooking,
            ]);
        }
    }

    public function book(Request $request)
    {
        $request->validate([
            'jetski_package_id' => 'required|exists:jetski_packages,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        $package = JetskiPackage::findOrFail($request->jetski_package_id);

        Booking::create([
            'user_id' => auth()->id(),
            'jetski_package_id' => $package->id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'total_price' => $package->price,
        ]);

        return back()->with('success', 'Booking berhasil dibuat!');
    }
}