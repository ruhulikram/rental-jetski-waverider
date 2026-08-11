@extends('layouts.app')

@push('styles')
<style>
    /* Sembunyikan scrollbar untuk slider Chrome, Safari and Opera */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Sembunyikan scrollbar untuk IE, Edge and Firefox */
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush

@section('content')
<div class="min-h-[calc(100vh-80px)] relative items-center justify-center overflow-hidden pt-20 pb-12 lg:py-20">
    
    <!-- Floating Contact Us Button (Bottom Right, Diperbesar) -->
    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-1 right-1 md:right-8 z-50 hover:scale-[1.15] transition-transform duration-300 drop-shadow-[0_0_20px_rgba(34,211,238,0.6)]">
        <img src="{{ asset('images/hero/Contact Us!.svg') }}" alt="Contact Us" class="w-24 h-24 md:w-24 md:h-24 object-contain">
    </a>

    <!-- GAMBAR HERO FULL BLEED DESKTOP (Tampil di layar besar LG+) -->
    <div class="hidden lg:flex absolute top-0 right-0 w-[50vw] h-[100vh] pointer-events-none z-0 items-start justify-end overflow-visible">
        <div class="absolute right-[-10%] w-[60%] h-[80%] bg-gradient-to-tr from-cyan-500/40 to-blue-600/30 rounded-full blur-[120px] animate-pulse"></div>
        <img src="{{ asset('images/hero/hero-image-2.png') }}" alt="Baywalk Jetski Hero" class="absolute top-0 -right-20 h-[110%] w-auto max-w-none object-contain object-right-top drop-shadow-[0_30px_60px_rgba(34,211,238,0.5)] transform hover:scale-[1.05] transition-transform duration-700">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- ========================================== --}}
        {{-- HERO SECTION (TEXT & MOBILE PHOTO)        --}}
        {{-- ========================================== --}}
        <div class="flex flex-col lg:flex-row items-center justify-between mb-16 lg:mb-32 min-h-0 lg:min-h-[calc(100vh-160px)]">
            
            {{-- Text Content Porsi Kiri --}}
            <div class="w-full lg:w-[50%] text-center lg:text-left space-y-6 lg:space-y-8 max-w-2xl mx-auto lg:mx-0 pointer-events-auto z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-sm font-semibold tracking-wide uppercase shadow-[0_0_15px_rgba(34,211,238,0.15)]">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    Layanan Sewa Jetski Jakarta
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.1]">
                    Jelajahi Pesisir <br class="hidden sm:inline"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">Teluk Jakarta</span>
                </h1>
                
                <p class="text-base sm:text-lg lg:text-xl text-slate-400 leading-relaxed font-light">
                    Layanan sewa jetski yang aman dan terpercaya. Temukan paket terbaik kami dan nikmati waktu luang Anda mengeksplorasi laut bersama armada kami di Baywalk Mall.
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
                            Sewa Jetski
                        </a>
                        <a href="/about" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-slate-300 transition-all duration-300 bg-slate-800/50 border border-slate-700 rounded-2xl hover:bg-slate-700/50 hover:text-white focus:outline-none backdrop-blur-sm hover:-translate-y-1">
                            Pelajari Lebih Lanjut
                        </a>
                    @endauth
                </div>

                {{-- Follow Us Section --}}
                <div class="pt-6 flex flex-col items-center lg:items-start border-t border-slate-800/60 mt-8">
                    <span class="text-sm font-semibold text-slate-400 uppercase tracking-widest mb-4">Follow Us</span>
                    <div class="flex items-center gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-cyan-500 text-slate-400 hover:text-white transition-all duration-300">
                            <!-- Instagram Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-cyan-500 text-slate-400 hover:text-white transition-all duration-300">
                            <!-- Facebook Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-cyan-500 text-slate-400 hover:text-white transition-all duration-300">
                            <!-- TikTok Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512" aria-hidden="true">
                                <path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25v178.72A162.55 162.55 0 1 1 162.55 186.8h.04v77.16a85.39 85.39 0 1 0 85.35 85.39V0h77.19a162.8 162.8 0 0 0 122.87 53.6v79.15h-.04z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Spacer Porsi Kanan karena visual hero image ditarik ke tepi viewport (absolute) --}}
            <div class="hidden lg:block w-[50%] min-h-[600px]"></div>
        </div>

        {{-- ========================================== --}}
        {{-- SECTION PAKET SEWA (SLIDER KINI DI SINI)   --}}
        {{-- ========================================== --}}
        <div class="mb-32 relative group">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Pilih <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Paket</span> Anda</h2>
                <p class="text-slate-400 font-light max-w-2xl mx-auto">Kami menawarkan berbagai durasi penyewaan jetski dari yang singkat hingga petualangan panjang antar pulau.</p>
            </div>

            <!-- Tombol Navigasi Slider -->
            <button id="slider-prev" class="absolute left-0 top-[60%] -translate-y-1/2 -translate-x-2 lg:-translate-x-6 w-12 h-12 rounded-full bg-slate-800/80 border border-slate-700 text-cyan-400 flex items-center justify-center z-20 hover:bg-cyan-500 hover:text-white transition-all shadow-lg opacity-0 group-hover:opacity-100 disabled:opacity-30 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <button id="slider-next" class="absolute right-0 top-[60%] -translate-y-1/2 translate-x-2 lg:translate-x-6 w-12 h-12 rounded-full bg-slate-800/80 border border-slate-700 text-cyan-400 flex items-center justify-center z-20 hover:bg-cyan-500 hover:text-white transition-all shadow-lg opacity-0 group-hover:opacity-100 disabled:opacity-30 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>

            <!-- Wrapper Container untuk CSS Scroll Snap (Padded top/bottom to prevent glow clipping) -->
            <div id="package-slider" class="relative flex overflow-x-auto gap-8 snap-x snap-mandatory scroll-smooth hide-scrollbar py-10 px-4 -mx-4">
                
                @forelse($packages as $package)
                    <!-- Card Package Item -->
                    <div class="snap-start shrink-0 w-[85vw] sm:w-[350px] lg:w-[400px]">
                        <div class="backdrop-blur-3xl bg-slate-800/40 p-2 rounded-[2.5rem] border border-white/10 shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(34,211,238,0.2)] h-full">
                            <div class="bg-slate-900/50 rounded-[2rem] p-8 min-h-[380px] flex flex-col justify-between relative overflow-hidden group h-full">
                                <!-- Abstrak Shapes di dalam panel -->
                                <div class="absolute -top-20 -right-20 w-64 h-64 border-[40px] border-cyan-500/10 rounded-full blur-xl group-hover:border-cyan-400/20 transition-colors duration-700 pointer-events-none"></div>
                                <div class="absolute -bottom-20 -left-20 w-64 h-64 border-[40px] border-blue-600/10 rounded-full blur-xl group-hover:border-blue-500/20 transition-colors duration-700 pointer-events-none"></div>
                                
                                <div class="relative z-10 flex justify-between items-start mb-8">
                                    <div class="px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                                        <span class="text-sm font-semibold text-white flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                            Ada Hari Ini
                                        </span>
                                    </div>
                                    <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                </div>
                                
                                <div class="relative z-10 mt-auto">
                                    <h3 class="text-2xl font-bold text-white mb-2 leading-tight">{{ $package->name }}</h3>
                                    <p class="text-slate-400 mb-6 line-clamp-3 text-sm leading-relaxed">{{ $package->description }}</p>
                                    
                                    <div class="flex items-center gap-2 mb-6 text-xs font-semibold uppercase tracking-widest text-cyan-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Durasi: {{ $package->duration }} Menit
                                    </div>
                                    
                                    <div class="w-full bg-white/5 rounded-2xl p-4 border border-white/10 backdrop-blur-md flex justify-between items-center group-hover:bg-cyan-500/10 transition-colors duration-300">
                                        <div>
                                            <div class="text-xs text-slate-400 uppercase tracking-widest font-semibold mb-1">Harga Final</div>
                                            <div class="text-2xl font-black text-cyan-400">{{ $package->formatted_price }}</div>
                                        </div>
                                        @if(auth()->check())
                                        <a href="{{ route('backend.bookings.create') }}?package_id={{ $package->id }}" class="w-12 h-12 rounded-full bg-cyan-600 hover:bg-cyan-400 text-white flex items-center justify-center shadow-[0_0_15px_rgba(8,145,178,0.5)] transition-all transform hover:scale-110 cursor-pointer z-20 relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                        </a>
                                        @else
                                        <a href="{{ route('login') }}" class="w-12 h-12 rounded-full bg-cyan-600 hover:bg-cyan-400 text-white flex items-center justify-center shadow-[0_0_15px_rgba(8,145,178,0.5)] transition-all transform hover:scale-110 cursor-pointer z-20 relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="snap-start shrink-0 w-full backdrop-blur-3xl bg-slate-800/40 p-12 rounded-[2.5rem] border border-white/10 shadow-2xl flex items-center justify-center text-center h-64">
                        <div>
                            <h3 class="text-white font-bold text-xl mb-2">Pembaruan Sistem</h3>
                            <p class="text-slate-400">Paket rental sedang diperbarui untuk melayani Anda lebih baik.</p>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>

        {{-- ========================================== --}}
        {{-- SECTION GOOGLE MAPS                        --}}
        {{-- ========================================== --}}
        <div class="mb-12">
            <div class="bg-slate-800/40 backdrop-blur-xl border border-slate-700/50 rounded-[2.5rem] p-6 lg:p-10 shadow-2xl w-full">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
                            <span class="w-2 h-8 bg-cyan-500 rounded-full"></span>
                            Titik Sandar / Dermaga
                        </h2>
                        <p class="text-slate-400 font-light max-w-lg">Temui kami secara langsung di dermaga utama Baywalk Mall Pluit. Staff kami akan menyambut Anda setibanya di lokasi.</p>
                    </div>
                    <a href="https://maps.app.goo.gl/M4gq6X1x2Hh2Eih48" target="_blank" class="shrink-0 inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/5 border border-white/10 hover:bg-white/10 text-white font-medium rounded-xl transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Buka di Maps
                    </a>
                </div>

                <!-- Google Maps Embed Iframe -->
                <div class="w-full h-[400px] lg:h-[500px] rounded-[1.5rem] overflow-hidden border border-slate-700/60 shadow-inner relative">
                    <!-- Placeholder Glass overlay while loading (Optional) -->
                    <div class="absolute inset-0 bg-slate-800 animate-pulse -z-10"></div>
                    
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3626.2479235192814!2d106.7758435745552!3d-6.106824893879665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1d5611047073%3A0x1770a683e2398b4a!2sSeadoo%20Safari%20Baywalk!5e1!3m2!1sen!2sid!4v1774789416128!5m2!1sen!2sid" 
                        class="w-full h-full border-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-700" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('package-slider');
        const prevBtn = document.getElementById('slider-prev');
        const nextBtn = document.getElementById('slider-next');

        if(slider && prevBtn && nextBtn) {
            // Function to get scroll amount (one item width + gap)
            const getScrollAmount = () => {
                const item = slider.querySelector('.snap-start');
                return item ? item.offsetWidth + 32 : 300; // 32 is roughly gap-8 mapping
            };

            prevBtn.addEventListener('click', () => {
                slider.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
            });

            nextBtn.addEventListener('click', () => {
                slider.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
            });

            // Optional: Update button visibility based on scroll position
            const updateButtons = () => {
                const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                prevBtn.disabled = slider.scrollLeft <= 5;
                nextBtn.disabled = slider.scrollLeft >= maxScrollLeft - 5;
            };

            slider.addEventListener('scroll', updateButtons);
            window.addEventListener('resize', updateButtons);
            updateButtons(); // Initial check
        }
    });
</script>
@endpush
@endsection