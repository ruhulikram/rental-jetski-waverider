@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-white mb-1">Detail Booking</h1>
                <p class="text-sm text-slate-400">Kode Booking: <span class="font-semibold text-cyan-400">{{ $booking->booking_code }}</span></p>
            </div>
            <a href="{{ route('backend.bookings.index') }}"
                class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/50 py-2.5 px-5 rounded-lg transition-colors text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- Main Detail Card --}}
        <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">

                {{-- Kolom 1: Detail Booking --}}
                <div class="md:col-span-2 space-y-4 text-slate-300">
                    <h3 class="text-lg font-bold text-white border-b border-slate-700/50 pb-2 mb-4">Informasi Reservasi</h3>
                    <div class="flex">
                        <p class="font-medium w-36 text-slate-500">Paket Jetski</p>
                        <p class="flex-grow">: {{ $booking->jetskiPackage->name }}</p>
                    </div>
                    <div class="flex">
                        <p class="font-medium w-36 text-slate-500">Durasi</p>
                        <p class="flex-grow">: {{ $booking->jetskiPackage->duration }} Menit</p>
                    </div>
                    <div class="flex">
                        <p class="font-medium w-36 text-slate-500">Jadwal Main</p>
                        <p class="flex-grow">: 
                            <span class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</span> 
                            pukul <span class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB</span>
                        </p>
                    </div>
                    <div class="flex items-center">
                        <p class="font-medium w-36 text-slate-500">Status Reservasi</p>
                        <div class="flex-grow flex items-center gap-2">
                            <span>:</span>
                            <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-lg border
                                @if($booking->status == 'pending') bg-amber-500/10 text-amber-400 border-amber-500/20
                                @elseif($booking->status == 'confirmed') bg-cyan-500/10 text-cyan-400 border-cyan-500/20
                                @elseif($booking->status == 'completed') bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                @else bg-rose-500/10 text-rose-400 border-rose-500/20 @endif">
                                {{ $booking->status }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Kolom 2: Detail Pembayaran --}}
                <div class="space-y-4 text-slate-300">
                    <h3 class="text-lg font-bold text-white border-b border-slate-700/50 pb-2 mb-4">Informasi Tagihan</h3>
                    <div class="flex">
                        <p class="font-medium w-32 text-slate-500">Total Biaya</p>
                        <p class="flex-grow text-cyan-400 font-bold">: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex">
                        <p class="font-medium w-32 text-slate-500">Midtrans ID</p>
                        <p class="flex-grow text-xs font-mono mt-1">: {{ $booking->order_id ?? '-' }}</p>
                    </div>
                    <div class="flex items-center">
                        <p class="font-medium w-32 text-slate-500">Status Bayar</p>
                        <div class="flex-grow flex items-center gap-2">
                            <span>:</span>
                            <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-lg border
                                @if(in_array($booking->payment_status, ['capture', 'settlement', 'paid'])) bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                @elseif($booking->payment_status == 'pending') bg-amber-500/10 text-amber-400 border-amber-500/20
                                @else bg-rose-500/10 text-rose-400 border-rose-500/20 @endif">
                                {{ $booking->payment_status }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Detail Pelanggan & Catatan --}}
            <div class="mt-8 pt-6 border-t border-slate-700/50 text-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-slate-300">
                    
                    {{-- Detail Pelanggan --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-white border-b border-slate-700/50 pb-2 mb-4">Informasi Customer</h3>
                        <div class="flex">
                            <p class="font-medium w-36 text-slate-500">Nama Akun</p>
                            <p class="flex-grow text-white">: {{ $booking->user->name }}</p>
                        </div>
                        <div class="flex">
                            <p class="font-medium w-36 text-slate-500">Email Utama</p>
                            <p class="flex-grow text-white">: {{ $booking->user->email }}</p>
                        </div>
                        <div class="flex">
                            <p class="font-medium w-36 text-slate-500">No. WhatsApp</p>
                            <p class="flex-grow text-white">: {{ $booking->user->phone ?? 'Tidak Dicantumkan' }}</p>
                        </div>
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-white border-b border-slate-700/50 pb-2 mb-4">Catatan Operasional</h3>
                        <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/50 leading-relaxed text-slate-400 italic">
                            {{ $booking->notes ?? 'Tidak ada pesan khusus dari pelanggan pada reservasi ini.' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-700/50">
                <form action="{{ route('backend.bookings.destroy', $booking->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white border border-rose-500/20 hover:border-rose-500 font-medium py-2.5 px-6 rounded-lg transition-colors text-sm">
                        Hapus Rekor
                    </button>
                </form>
                <a href="{{ route('backend.bookings.edit', $booking->id) }}"
                    class="bg-cyan-600 hover:bg-cyan-500 text-white font-medium py-2.5 px-6 rounded-lg shadow-md transition-colors text-sm">
                    Edit Booking
                </a>
            </div>
        </div>
    </div>
@endsection