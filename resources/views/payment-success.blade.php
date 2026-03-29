@extends('layouts.app')

@section('content')
    <div class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-900">
        {{-- Background Effects --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-4xl w-full mx-auto relative z-10">
            {{-- Success Animation Header --}}
            <div class="text-center mb-10 transform transition-all duration-700 hover:scale-105">
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="absolute inset-0 bg-green-400 rounded-full animate-ping opacity-25"></div>
                        <div class="relative bg-gradient-to-tr from-green-400 to-emerald-600 rounded-full p-5 shadow-lg shadow-green-500/50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-300 mb-3 tracking-tight">Pembayaran Berhasil!</h1>
                <p class="text-slate-400 text-lg max-w-xl mx-auto font-light">Luar biasa! Pesanan jetski Anda telah kami konfirmasi. Bersiaplah untuk petualangan seru.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                {{-- Booking Details Glass Card --}}
                <div class="backdrop-blur-xl bg-slate-800/60 rounded-3xl border border-slate-700/50 shadow-2xl overflow-hidden group hover:bg-slate-800/80 transition-all duration-500">
                    <div class="bg-gradient-to-r from-blue-600/20 to-cyan-600/20 border-b border-slate-700/50 p-5 backdrop-blur-md">
                        <h3 class="font-bold text-lg text-blue-300 flex items-center gap-3">
                            <div class="p-2 bg-blue-500/20 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h2a2 2 0 002-2V4a2 2 0 00-2-2H9z" />
                                    <path d="M4 12a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            Detail Pesanan
                        </h3>
                    </div>
                    <div class="p-6 space-y-5 text-slate-300">
                        <div class="flex justify-between items-center p-3 bg-slate-900/40 rounded-xl border border-slate-700/30">
                            <span class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Kode Booking</span>
                            <span class="font-mono bg-blue-500/10 text-blue-400 px-3 py-1.5 rounded-lg text-sm border border-blue-500/20 shadow-inner">
                                {{ $booking->booking_code }}
                            </span>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs uppercase tracking-widest text-slate-500 mb-2 font-semibold">Paket Jetski</h4>
                                <div class="bg-slate-900/30 rounded-xl p-4 border border-slate-700/30 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-slate-400">Jenis Paket</span>
                                        <span class="font-semibold text-white">{{ $booking->jetskiPackage->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-slate-400">Durasi Main</span>
                                        <span class="font-medium text-cyan-400">{{ $booking->jetskiPackage->duration }} menit</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs uppercase tracking-widest text-slate-500 mb-2 font-semibold">Jadwal</h4>
                                <div class="bg-slate-900/30 rounded-xl p-4 border border-slate-700/30 space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-slate-800 rounded-md text-blue-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-slate-800 rounded-md text-blue-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-white">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Information Glass Card --}}
                <div class="backdrop-blur-xl bg-slate-800/60 rounded-3xl border border-slate-700/50 shadow-2xl overflow-hidden group hover:bg-slate-800/80 transition-all duration-500">
                    <div class="bg-gradient-to-r from-emerald-600/20 to-teal-600/20 border-b border-slate-700/50 p-5 backdrop-blur-md">
                        <h3 class="font-bold text-lg text-emerald-300 flex items-center gap-3">
                            <div class="p-2 bg-emerald-500/20 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h2a1 1 0 100-2H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            Info Pembayaran
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="text-center p-6 bg-slate-900/50 rounded-2xl border border-slate-700/30 relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl"></div>
                            <div class="text-sm font-medium text-slate-400 mb-1">Total Dibayar</div>
                            <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400 mb-3 tracking-tight">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase shadow-sm
                                @if(in_array($booking->payment_status, ['capture', 'settlement', 'paid'])) bg-emerald-500/10 text-emerald-400 border border-emerald-500/20
                                @else bg-amber-500/10 text-amber-400 border border-amber-500/20 @endif">
                                <span class="w-1.5 h-1.5 rounded-full @if(in_array($booking->payment_status, ['capture', 'settlement', 'paid'])) bg-emerald-400 animate-pulse @else bg-amber-400 @endif"></span>
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>

                        <div class="space-y-3 p-4 bg-slate-900/30 rounded-xl border border-slate-700/30">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">ID Midtrans:</span>
                                <span class="font-mono text-slate-300 text-xs">{{ $booking->order_id ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Metode:</span>
                                <span class="font-medium text-slate-200">{{ $booking->payment_method ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Waktu:</span>
                                <span class="font-medium text-slate-200">{{ $booking->payment_time ?? now()->translatedFormat('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        <div class="bg-blue-900/20 border border-blue-800/30 rounded-xl p-5 relative overflow-hidden group-hover:bg-blue-900/30 transition-colors">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
                            <h4 class="font-semibold text-blue-300 mb-3 flex items-center gap-2 relative z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Instruksi Penting
                            </h4>
                            <ul class="text-sm text-blue-200/80 space-y-2 relative z-10">
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-400 mt-0.5">•</span>
                                    Cek email untuk e-receipt resmi.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-400 mt-0.5">•</span>
                                    Hadir 15 menit sebelum waktu main.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-400 mt-0.5">•</span>
                                    Bawa KTP/Identitas asli.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-12 flex flex-col sm:flex-row gap-5 justify-center items-center">
                <a href="{{ route('backend.v_index.index') }}"
                    class="group relative inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-xl hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 focus:ring-offset-slate-900 shadow-[0_0_20px_rgba(37,99,235,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Kembali ke Dashboard
                </a>
                
                <a href="#" class="group relative inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-slate-300 transition-all duration-200 bg-slate-800/50 border border-slate-600 rounded-xl hover:bg-slate-700/50 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600 focus:ring-offset-slate-900 w-full sm:w-auto backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform text-slate-400 group-hover:text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                    </svg>
                    Unduh E-Receipt
                </a>
            </div>
            
            <style>
                @keyframes blob {
                    0% { transform: translate(0px, 0px) scale(1); }
                    33% { transform: translate(30px, -50px) scale(1.1); }
                    66% { transform: translate(-20px, 20px) scale(0.9); }
                    100% { transform: translate(0px, 0px) scale(1); }
                }
                .animate-blob {
                    animation: blob 7s infinite;
                }
                .animation-delay-2000 {
                    animation-delay: 2s;
                }
                .animation-delay-4000 {
                    animation-delay: 4s;
                }
            </style>
        </div>
    </div>
@endsection