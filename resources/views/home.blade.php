@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] relative flex items-center justify-center overflow-hidden py-12 lg:py-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            
            {{-- Text Content --}}
            <div class="text-center lg:text-left space-y-6 lg:space-y-8 max-w-2xl mx-auto lg:mx-0">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-sm font-semibold tracking-wide uppercase shadow-[0_0_15px_rgba(34,211,238,0.15)]">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    Layanan Sewa Jetski Jakarta
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.1]">
                    Jelajahi Pesisir <br class="hidden sm:inline"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">Teluk Jakarta</span>
                </h1>
                
                <p class="text-base sm:text-lg lg:text-xl text-slate-400 leading-relaxed font-light">
                    Layanan sewa jetski yang aman dan terpercaya. Nikmati waktu luang Anda mengeksplorasi laut bersama armada kami di Baywalk Mall.
                </p>

                <!-- GAMBAR HERO MOBILE (Tampil di mobile < lg, mentok rapat ke tepi layar sebelah kiri) -->
                <div class="block lg:hidden relative my-6 -ml-4 sm:-ml-6 pr-4 sm:pr-6 w-[calc(100%+2rem)] sm:w-[calc(100%+3rem)] z-10">
                    <div class="relative w-full flex items-center justify-start">
                        <div class="absolute left-0 w-3/4 h-full bg-gradient-to-r from-cyan-500/30 to-blue-600/10 rounded-r-full blur-2xl animate-pulse"></div>
                        <img src="{{ asset('images/hero/hero-image-2.png') }}" alt="Baywalk Jetski Hero Mobile" class="relative z-10 w-full max-h-[300px] sm:max-h-[380px] object-contain object-left drop-shadow-[0_15px_30px_rgba(34,211,238,0.4)] transform hover:scale-[1.02] transition-transform duration-500">
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2 sm:pt-4">
                    @auth
                        <a href="{{ route('backend.v_index.index') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-300 bg-cyan-600 border border-transparent rounded-2xl hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 focus:ring-offset-slate-900 shadow-[0_0_30px_rgba(8,145,178,0.5)] hover:shadow-[0_0_40px_rgba(6,182,212,0.6)] hover:-translate-y-1">
                            Pesan Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-300 bg-cyan-600 border border-transparent rounded-2xl hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 focus:ring-offset-slate-900 shadow-[0_0_30px_rgba(8,145,178,0.5)] hover:-translate-y-1">
                            Mulai Berpetualang
                        </a>
                        <a href="/about" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-slate-300 transition-all duration-300 bg-slate-800/50 border border-slate-700 rounded-2xl hover:bg-slate-700/50 hover:text-white focus:outline-none backdrop-blur-sm hover:-translate-y-1">
                            Pelajari Lebih Lanjut
                        </a>
                    @endauth
                </div>
                
                {{-- Stats Grid --}}
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-800/60 mt-8">
                    <div>
                        <div class="text-3xl font-black text-white">50+</div>
                        <div class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-wider">Armada Jetski</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black text-white">5k+</div>
                        <div class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-wider">Happy Rider</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-500">4.9/5</div>
                        <div class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-wider">Rating</div>
                    </div>
                </div>
            </div>
            
            {{-- Visual Content (Glassmorphic Window) --}}
            <div class="hidden lg:block relative lg:ml-10">
                <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-[2.5rem] blur-2xl opacity-20 animate-pulse"></div>
                <div class="relative backdrop-blur-3xl bg-slate-800/40 p-2 rounded-[2.5rem] border border-white/10 shadow-2xl">
                    <div class="bg-slate-900/50 rounded-[2rem] p-8 aspect-[4/3] flex flex-col justify-between relative overflow-hidden group">
                        <!-- Decorative Abstract Shapes inside panel -->
                        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl group-hover:bg-cyan-400/30 transition-colors duration-700"></div>
                        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl group-hover:bg-blue-500/30 transition-colors duration-700"></div>
                        
                        <div class="relative z-10 flex justify-between items-start">
                            <div class="px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                                <span class="text-sm font-semibold text-white flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                    Tersedia Hari Ini
                                </span>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-white mb-2">Yamaha WaveRunner FX Cruiser</h3>
                            <p class="text-slate-400 mb-6">Paket Premium • 60 Menit</p>
                            
                            <div class="w-full bg-white/5 rounded-2xl p-4 border border-white/10 backdrop-blur-md flex justify-between items-center group-hover:bg-white/10 transition-colors duration-300">
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-widest font-semibold mb-1">Promo Khusus</div>
                                    <div class="text-2xl font-black text-cyan-400">Rp 1.500.000</div>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-cyan-500 text-white flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
