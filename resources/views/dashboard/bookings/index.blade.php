@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-800 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-white mb-1">Manajemen Booking</h1>
            <p class="text-sm text-slate-400">Kelola semua reservasi, lihat detail, perbarui status, atau batalkan booking.</p>
        </div>
        
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <form action="{{ route('backend.bookings.index') }}" method="GET" class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan / kode..."
                    class="w-full sm:w-72 pl-10 pr-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors text-sm" />
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3.5 top-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>
    </div>

    <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700/50">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Kode Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Paket</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Jadwal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Status Bayar</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50 bg-transparent">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $booking->booking_code }}
                                <span class="block text-xs text-slate-500 font-mono mt-0.5">{{ $booking->order_id ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                                {{ $booking->user->name }}
                                <span class="block text-xs text-slate-500 mt-0.5">{{ $booking->user->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                                {{ $booking->jetskiPackage->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}
                                <span class="block text-xs text-slate-500 mt-0.5">
                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-cyan-400">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <span class="inline-flex px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-lg border
                                            @if(in_array($booking->payment_status, ['capture', 'settlement', 'paid'])) bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                            @elseif($booking->payment_status == 'pending') bg-amber-500/10 text-amber-400 border-amber-500/20
                                            @else bg-rose-500/10 text-rose-400 border-rose-500/20 @endif">
                                    {{ $booking->payment_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('backend.bookings.show', $booking->id) }}"
                                        class="text-indigo-400 hover:text-indigo-300 transition-colors" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('backend.bookings.edit', $booking->id) }}"
                                        class="text-blue-400 hover:text-blue-300 transition-colors" title="Edit Booking">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    @if($booking->payment_status === 'pending')
                                        <a href="#"
                                            class="text-emerald-400 hover:text-emerald-300 transition-colors" title="Proses Manual">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-slate-500">
                                Tidak ada data booking ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection