@extends('layouts.app')

@section('content')
    <div class="min-h-[calc(100vh-80px)] py-12 lg:py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Header Halaman About Us -->
            <header class="mb-12 text-center max-w-3xl mx-auto">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    Di Balik <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">WAVERIDER</span>
                </h1>
                <p class="text-lg text-slate-400 font-light leading-relaxed">
                    Mengenal lebih jauh tentang platform rental jetski premium kami dan tim profesional yang memastikan
                    petualangan Anda selalu epik dan aman.
                </p>
            </header>

            <!-- Informasi Website -->
            <section
                class="mb-16 bg-slate-800/40 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl group-hover:bg-cyan-500/20 transition-colors duration-700">
                </div>

                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-2 h-8 bg-cyan-500 rounded-full"></span>
                    Misi Kami
                </h2>
                <div class="space-y-4 text-slate-300 font-light leading-relaxed text-lg relative z-10">
                    <p>
                        Kami adalah platform terkemuka yang menyediakan layanan penyewaan jetski premium untuk pengalaman
                        liburan tak terlupakan di perairan. Misi utama kami adalah memberikan akses mudah, eksklusif, dan
                        super aman ke armada jetski laut berkualitas tinggi.
                    </p>
                    <p>
                        Sejak didirikan, kami telah melayani ribuan pelanggan dan terus berinovasi untuk menawarkan paket
                        rental yang paling menarik. Baik Anda seorang petualang berpengalaman yang mencari adrenalin tingkat
                        tinggi, maupun sekadar ingin bersantai mengarungi teluk, kami memiliki pilihan armada yang sempurna
                        untuk Anda.
                    </p>
                </div>
            </section>

            <!-- Tim Kami -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-white mb-10 text-center">Nakhoda Kami</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Anggota Tim 1 -->
                    <div
                        class="bg-slate-800/30 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 text-center hover:-translate-y-2 transition-transform duration-300 group">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full mb-5 p-1">
                            <div
                                class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center border-2 border-slate-800 overflow-hidden">
                                <img src="{{ asset('images/team/photo1.jpg') }}" alt="CEO & Founder"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-400 transition-colors">John Doe
                        </h3>
                        <p class="text-sm text-cyan-500 font-medium uppercase tracking-wider">CEO & Founder</p>
                    </div>

                    <!-- Anggota Tim 2 -->
                    <div
                        class="bg-slate-800/30 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 text-center hover:-translate-y-2 transition-transform duration-300 group">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full mb-5 p-1">
                            <div
                                class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center border-2 border-slate-800 overflow-hidden">
                                <img src="{{ asset('images/team/photo2.jpg') }}" alt="COO"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-400 transition-colors">Michael
                            Smith</h3>
                        <p class="text-sm text-cyan-500 font-medium uppercase tracking-wider">COO</p>
                    </div>

                    <!-- Anggota Tim 3 -->
                    <div
                        class="bg-slate-800/30 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 text-center hover:-translate-y-2 transition-transform duration-300 group">
                        <div
                            class="w-24 h-24 mx-auto bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mb-5 p-1">
                            <div
                                class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center border-2 border-slate-800 overflow-hidden">
                                <img src="{{ asset('images/team/photo3.jpg') }}" alt="CMO"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-400 transition-colors">David
                            Johnson</h3>
                        <p class="text-sm text-cyan-500 font-medium uppercase tracking-wider">CMO</p>
                    </div>

                    <!-- Anggota Tim 4 -->
                    <div
                        class="bg-slate-800/30 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 text-center hover:-translate-y-2 transition-transform duration-300 group">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-rose-500 to-orange-600 rounded-full mb-5 p-1">
                            <div
                                class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center border-2 border-slate-800 overflow-hidden">
                                <img src="{{ asset('images/team/photo4.jpg') }}" alt="CS Lead"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-400 transition-colors">Robert
                            Williams</h3>
                        <p class="text-sm text-cyan-500 font-medium uppercase tracking-wider">CS Lead</p>
                    </div>
                </div>
            </section>

            <!-- Hubungi Kami -->
            <section class="text-center py-12 border-t border-slate-800 mt-12">
                <h2 class="text-3xl font-bold text-white mb-4">Butuh Kapal Lebih Besar?</h2>
                <p class="text-slate-400 mb-8 max-w-2xl mx-auto font-light">
                    Atau mungkin Anda memiliki pertanyaan bisnis terkait kolaborasi wisata bahari, event korporat, dan
                    penyewaan fleet? Jangan ragu untuk menghubungi kami.
                </p>
                <a href="mailto:info@jetskirental.com"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-slate-900 font-bold rounded-2xl shadow-[0_0_20px_rgba(255,255,255,0.2)] hover:shadow-[0_0_30px_rgba(255,255,255,0.4)] hover:-translate-y-1 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kirim Email Ke Tim Kami
                </a>
            </section>
        </div>
    </div>
@endsection