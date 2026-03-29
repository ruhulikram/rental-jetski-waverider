@extends('layouts.admin')

@section('content')
    <div>
        {{-- Header Section --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight mb-2">Command Center</h1>
                <p class="text-cyan-400 text-lg">Ringkasan Aktivitas WAVERIDER hari ini, {{ auth()->user()->name }}.</p>
            </div>
            <div class="flex items-center gap-2 px-4 py-2 bg-slate-800/60 border border-slate-700/50 rounded-xl backdrop-blur-md w-max">
                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-widest text-slate-300">Sistem Online</span>
            </div>
        </div>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Total Pendapatan -->
            <div class="backdrop-blur-xl bg-slate-800/40 rounded-[2rem] border border-cyan-500/20 shadow-lg p-6 relative overflow-hidden group hover:border-cyan-500/40 transition-colors">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-colors"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-widest uppercase text-slate-400 mb-1">Total Pendapatan (Lunas)</p>
                        <p class="text-3xl font-black text-white">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex-shrink-0 w-14 h-14 bg-cyan-500/10 border border-cyan-500/20 rounded-2xl flex items-center justify-center">
                        <svg class="h-7 w-7 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Booking -->
            <div class="backdrop-blur-xl bg-slate-800/40 rounded-[2rem] border border-indigo-500/20 shadow-lg p-6 relative overflow-hidden group hover:border-indigo-500/40 transition-colors">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-colors"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-widest uppercase text-slate-400 mb-1">Total Booking</p>
                        <p class="text-3xl font-black text-white">{{ $totalBookings ?? 0 }} <span class="text-lg font-semibold text-slate-500">Pesanan</span></p>
                    </div>
                    <div class="flex-shrink-0 w-14 h-14 bg-indigo-500/10 border border-indigo-500/20 rounded-2xl flex items-center justify-center">
                        <svg class="h-7 w-7 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Booking Pending -->
            <div class="backdrop-blur-xl bg-slate-800/40 rounded-[2rem] border border-amber-500/20 shadow-lg p-6 relative overflow-hidden group hover:border-amber-500/40 transition-colors">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-colors"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-widest uppercase text-slate-400 mb-1">Menunggu Pembayaran</p>
                        <p class="text-3xl font-black text-white">{{ $pendingBookings ?? 0 }} <span class="text-lg font-semibold text-slate-500">Antrian</span></p>
                    </div>
                    <div class="flex-shrink-0 w-14 h-14 bg-amber-500/10 border border-amber-500/20 rounded-2xl flex items-center justify-center">
                        <svg class="h-7 w-7 text-amber-400 outline-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Booking --}}
        <div class="backdrop-blur-xl bg-slate-800/40 rounded-[2.5rem] border border-slate-700/50 shadow-2xl p-6 md:p-10">
            <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                <div class="p-2 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                </div>
                Tren Booking (7 Hari Terakhir)
            </h3>

            @if(!empty($chartLabels) && $chartLabels->isNotEmpty())
                <div style="height: 350px;">
                    <canvas id="bookingChart"></canvas>
                </div>
            @else
                <div class="h-80 flex flex-col items-center justify-center text-center bg-slate-900/30 rounded-3xl border border-dashed border-slate-700/50">
                    <div class="w-16 h-16 bg-slate-800/80 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    </div>
                    <p class="text-slate-400 font-medium tracking-wide">Analisis Grafik Belum Tersedia. Belum ada data 7 hari terakhir.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartLabels = @json($chartLabels ?? []);
            const chartData = @json($chartData ?? []);

            if (chartLabels.length > 0 && document.getElementById('bookingChart')) {
                const ctx = document.getElementById('bookingChart').getContext('2d');
                
                // Set Chart.js defaults for Dark Theme
                Chart.defaults.color = '#94a3b8'; // slate-400
                Chart.defaults.font.family = "'Outfit', sans-serif";

                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(6, 182, 212, 0.5)'); // Cyan-500
                gradient.addColorStop(1, 'rgba(6, 182, 212, 0.0)'); 

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Jumlah Booking',
                            data: chartData,
                            backgroundColor: gradient,
                            borderColor: '#06b6d4', // Cyan-500
                            borderWidth: 3,
                            pointBackgroundColor: '#0f172a',
                            pointBorderColor: '#06b6d4',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.4, // Smooth curve
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(51, 65, 85, 0.5)', // slate-700
                                    drawBorder: false,
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(51, 65, 85, 0.5)', // slate-700
                                    drawBorder: false,
                                    borderDash: [5, 5],
                                },
                                ticks: {
                                    precision: 0,
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                titleColor: '#fff',
                                bodyColor: '#cbd5e1',
                                borderColor: 'rgba(51, 65, 85, 1)',
                                borderWidth: 1,
                                padding: 12,
                                displayColors: false,
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush