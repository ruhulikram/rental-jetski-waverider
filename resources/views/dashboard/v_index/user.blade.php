@extends('layouts.app')

@push('styles')
    <style>
        .custom-loader {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

        {{-- Notifikasi Sukses/Gagal (Glass Alert) --}}
        @if (session('success'))
            <div
                class="mb-8 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 p-4 backdrop-blur-md flex items-center gap-4 animate-[slideIn_0.5s_ease-out]">
                <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-emerald-400">Berhasil</h4>
                    <p class="text-emerald-200/80 text-sm mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div
                class="mb-8 rounded-2xl bg-rose-500/10 border border-rose-500/20 p-4 backdrop-blur-md flex items-center gap-4 animate-[slideIn_0.5s_ease-out]">
                <div class="w-10 h-10 rounded-full bg-rose-500/20 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-rose-400">Gagal</h4>
                    <p class="text-rose-200/80 text-sm mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Localhost Webhook Warning --}}
        @if(config('app.env') === 'local')
            <div
                class="mb-8 rounded-2xl bg-amber-500/10 border border-amber-500/20 p-4 backdrop-blur-md flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center flex-shrink-0 mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-amber-500">Mode Pengembangan Lokal</h4>
                    <p class="text-amber-200/80 text-sm mt-1 leading-relaxed">Status Midtrans webhooks mungkin tidak otomatis
                        memperbarui tabel Anda saat menjalankan proyek tanpa layanan terowongan internet (seperti ngrok/Herd's
                        expose). Harap maklum jika status tetap "Pending" setelah sukses. Secara nyata (production), status di
                        dashboard ini akan diperbarui oleh Sistem Webhook secara instan.</p>
                </div>
            </div>
        @endif

        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1
                    class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight mb-2">
                    My Dashboard</h1>
                <p class="text-cyan-400 text-lg">Hi Rider, {{ auth()->user()->name }}! 🌊</p>
            </div>
            <div
                class="flex items-center gap-2 px-4 py-2 bg-slate-800/60 border border-slate-700/50 rounded-xl backdrop-blur-md w-max">
                <span class="inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-sm font-bold text-slate-300">Member Aktif</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">
            {{-- Kolom Kiri: Form Booking --}}
            <div class="lg:col-span-7">
                @if($hasPendingBooking)
                    <div
                        class="backdrop-blur-xl bg-slate-800/40 rounded-3xl border border-rose-500/20 shadow-[0_0_30px_rgba(244,63,94,0.1)] p-8 h-full flex flex-col justify-center relative overflow-hidden">
                        <div class="absolute -right-20 -top-20 w-64 h-64 bg-rose-500/10 rounded-full blur-3xl"></div>

                        <div class="text-center relative z-10 space-y-4">
                            <div
                                class="w-20 h-20 bg-rose-500/10 rounded-full flex items-center justify-center border border-rose-500/20 mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-rose-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-extrabold text-2xl text-white">Selesaikan Tagihan Anda</h3>
                            <p class="text-slate-400 text-sm max-w-sm mx-auto">Kami menghargai kesetiaan Anda. Agar sistem terus
                                optimal, harap selesaikan pesanan Anda yang belum lunas (pada panel kanan) sebelum membuat
                                rencana booking batu baru.</p>
                        </div>
                    </div>
                @else
                    <div
                        class="backdrop-blur-xl bg-slate-800/40 rounded-3xl border border-slate-700/50 shadow-2xl p-6 md:p-8 relative overflow-hidden group">
                        <div
                            class="absolute -left-20 -top-20 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl transition duration-700 group-hover:bg-cyan-500/20">
                        </div>

                        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3 relative z-10">
                            <div class="p-2 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            Pesan Paket Baru
                        </h2>

                        <form id="bookingForm" method="POST" action="{{ route('booking.store') }}"
                            class="space-y-6 relative z-10">
                            @csrf
                            <input type="hidden" name="total_price" id="total_price_input">

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold tracking-widest uppercase text-slate-500 mb-2">Nama
                                        Pengendara</label>
                                    <input type="text" value="{{ auth()->user()->name }}"
                                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-xl text-slate-400 cursor-not-allowed text-sm focus:outline-none"
                                        readonly>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold tracking-widest uppercase text-slate-500 mb-2">Email</label>
                                    <input type="email" value="{{ auth()->user()->email }}"
                                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-xl text-slate-400 cursor-not-allowed text-sm focus:outline-none"
                                        readonly>
                                </div>
                            </div>

                            <div>
                                <label for="phone"
                                    class="block text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Nomor WhatsApp
                                    Aktif <span class="text-rose-400">*</span></label>
                                <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}" required
                                    class="w-full px-4 py-3 bg-slate-900/80 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white transition-all text-sm placeholder:text-slate-600"
                                    placeholder="Contoh: 081234567890">
                            </div>

                            <div>
                                <label for="jetski_package_id"
                                    class="block text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Armada/Paket
                                    Jetski <span class="text-rose-400">*</span></label>
                                <div class="relative">
                                    <select id="jetski_package_id" name="jetski_package_id" required
                                        class="w-full px-4 py-3 bg-slate-900/80 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white transition-all text-sm appearance-none cursor-pointer">
                                        <option value="" disabled selected class="bg-slate-800 text-slate-400">Pilih Armada Jetski</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}" data-price="{{ $package->price }}"
                                                class="bg-slate-800">
                                                {{ $package->name }} &mdash; {{ $package->duration }} Menit
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="booking_date"
                                        class="block text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Tanggal
                                        Main <span class="text-rose-400">*</span></label>
                                    <input type="date" id="booking_date" name="booking_date" required
                                        min="{{ now()->addDay()->format('Y-m-d') }}"
                                        class="w-full px-4 py-3 bg-slate-900/80 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white transition-all text-sm [color-scheme:dark]">
                                </div>
                                <div>
                                    <label for="booking_time"
                                        class="block text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Jam Main
                                        (08-18) <span class="text-rose-400">*</span></label>
                                    <input type="time" id="booking_time" name="booking_time" required min="08:00" max="18:00"
                                        class="w-full px-4 py-3 bg-slate-900/80 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white transition-all text-sm [color-scheme:dark]">
                                </div>
                            </div>

                            <div
                                class="pt-6 border-t border-slate-700/50 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                                <div>
                                    <span class="block text-xs font-bold tracking-widest uppercase text-slate-500 mb-1">Total
                                        Tagihan Awal</span>
                                    <span id="display_total_price"
                                        class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
                                        Rp 0
                                    </span>
                                </div>

                                <button type="submit" id="bookNowButton" disabled
                                    class="group relative inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-white transition-all duration-300 bg-cyan-600 border border-cyan-500 rounded-xl hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 focus:ring-offset-slate-900 disabled:opacity-40 disabled:cursor-not-allowed hover:shadow-[0_0_20px_rgba(6,182,212,0.4)] disabled:hover:shadow-none w-full sm:w-auto">
                                    Proceed to Pay
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            {{-- Kolom Kanan: Riwayat Booking --}}
            <div class="lg:col-span-5">
                <div
                    class="backdrop-blur-xl bg-slate-800/20 rounded-3xl border border-slate-700/50 shadow-2xl p-6 h-full flex flex-col">
                    <h2 class="text-xl font-bold text-slate-200 mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-cyan-500 rounded-full inline-block"></span>
                        Pesanan Anda
                    </h2>

                    <div id="booking-history"
                        class="space-y-4 overflow-y-auto pr-2 flex-grow custom-scrollbar max-h-[650px]">
                        @forelse($bookings as $booking)
                            <div
                                class="bg-slate-900/50 border border-slate-700/50 rounded-2xl p-5 hover:border-cyan-500/50 hover:bg-slate-900/80 transition-all duration-300 group">

                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-bold text-white text-lg group-hover:text-cyan-400 transition-colors">
                                            {{ $booking->jetskiPackage->name }}</h3>
                                        <div class="font-mono text-xs text-slate-500 mt-1">ID: {{ $booking->booking_code }}
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-[10px] font-black tracking-widest uppercase rounded-md border
                                                    @if(in_array($booking->payment_status, ['capture', 'settlement', 'paid'])) bg-emerald-500/10 text-emerald-400 border-emerald-500/30 shadow-[0_0_10px_rgba(16,185,129,0.2)]
                                                    @elseif($booking->payment_status == 'pending') bg-amber-500/10 text-amber-400 border-amber-500/30 animate-[pulse_2s_ease-in-out_infinite]
                                                    @else bg-rose-500/10 text-rose-400 border-rose-500/30 @endif">
                                        {{ $booking->payment_status }}
                                    </span>
                                </div>

                                <div
                                    class="flex items-center gap-2 text-sm text-slate-400 mb-4 bg-slate-800/50 p-2.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-cyan-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span
                                        class="font-medium text-slate-300">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</span>
                                    <span class="text-slate-600">|</span>
                                    <span class="font-medium text-white">{{ date('H:i', strtotime($booking->booking_time)) }}
                                        WIB</span>
                                </div>

                                <div class="flex justify-between items-center mt-2 border-t border-slate-700/50 pt-4">
                                    <div>
                                        <div class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-0.5">Total
                                            Harga</div>
                                        <p class="text-white font-bold text-xl">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    @if($booking->payment_status == 'pending')
                                        <button
                                            class="pay-now-button bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-900 font-bold py-2.5 px-6 rounded-xl shadow-lg transform transition active:scale-95 text-sm"
                                            data-snap-token="{{ $booking->snap_token }}">
                                            Bayar Sekarang
                                        </button>
                                    @elseif(in_array($booking->payment_status, ['paid', 'settlement', 'capture']))
                                        <a href="{{ route('payment.success', ['booking_code' => $booking->booking_code]) }}"
                                            class="bg-slate-800 hover:bg-cyan-600 border border-slate-600 hover:border-cyan-500 text-slate-200 hover:text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transform transition text-sm flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            E-Tiket
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div
                                class="flex flex-col items-center justify-center text-center p-8 bg-slate-900/30 rounded-2xl border border-dashed border-slate-700/50">
                                <div class="w-16 h-16 bg-slate-800/80 rounded-full flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h3 class="text-slate-300 font-bold mb-1">Tidak Ada Tagihan!</h3>
                                <p class="text-slate-500 text-sm">Mari ciptakan kenangan air Anda sekarang juga.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Midtrans --}}
    @if (config('midtrans.is_production'))
        <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const packageSelect = document.getElementById('jetski_package_id');
            const displayPriceElement = document.getElementById('display_total_price');
            const totalPriceInput = document.getElementById('total_price_input');
            const bookingForm = document.getElementById('bookingForm');
            const bookNowButton = document.getElementById('bookNowButton');

            if (bookingForm) {
                const requiredInputs = bookingForm.querySelectorAll('[required]');
                const validateForm = () => {
                    let allFilled = true;
                    requiredInputs.forEach(input => {
                        if (!input.value) allFilled = false;
                    });
                    bookNowButton.disabled = !allFilled;
                };

                const updatePrice = () => {
                    const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                    const price = selectedOption.dataset.price || 0;
                    displayPriceElement.innerText = `Rp ${parseInt(price).toLocaleString('id-ID')}`;
                    totalPriceInput.value = price;
                    validateForm();
                };

                bookingForm.addEventListener('input', validateForm);
                packageSelect.addEventListener('change', updatePrice);
                validateForm();

                // Allow user to trigger button by visual press state
                bookNowButton.addEventListener('click', function () {
                    if (!this.disabled) {
                        this.innerHTML = '<div class="custom-loader mr-2"></div> Memproses...';
                        this.disabled = true;
                        bookingForm.submit();
                    }
                });
            }

            document.querySelectorAll('.pay-now-button').forEach(button => {
                button.addEventListener('click', function () {
                    const snapToken = this.dataset.snapToken;

                    // Add loading indicator to button visually
                    const originalText = this.innerHTML;
                    this.innerHTML = '<div class="custom-loader inline-block align-middle mr-2"></div><span class="align-middle">Membuka Midtrans...</span>';

                    if (snapToken) {
                        snap.pay(snapToken, {
                            onSuccess: function (result) {
                                window.location.href = '{{ route("payment.success") }}?booking_code=' + result.order_id;
                            },
                            onPending: function (result) {
                                // Simulasi Local redirect juga agar user melihat status berubah jika bisa.
                                // Kami tidak memodifikasi DB via JS, tetapi merefresh halaman.
                                alert("Pembayaran Anda sedang kami proses dengan pihak Bank. Harap tunggu sesaat!");
                                window.location.reload();
                            },
                            onError: function (result) {
                                alert("Oops! Pembayaran Anda Gagal. Silakan coba lagi.");
                                window.location.reload();
                            },
                            onClose: function () {
                                button.innerHTML = originalText;
                            }
                        });
                    } else {
                        alert('Token pembayaran tidak valid! Hubungi Admin.');
                        button.innerHTML = originalText;
                    }
                });
            });
        });
    </script>
@endpush