<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetski Rental - Premium Experience</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0f172a;
            /* slate-900 */
            color: #f8fafc;
            /* slate-50 */
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* Nav behavior */
        .glass-nav {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
    @stack('styles')
</head>

<body class="antialiased selection:bg-cyan-500 selection:text-white min-h-screen flex flex-col relative">

    {{-- Background glowing orbs that persist across pages --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div
            class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/20 rounded-full blur-[120px] mix-blend-screen">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-600/20 rounded-full blur-[120px] mix-blend-screen">
        </div>
    </div>

    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <!-- Brand -->
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30 group-hover:shadow-cyan-500/50 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span
                    class="text-xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">
                    WAVE<span class="text-cyan-400">RIDER</span>
                </span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="/"
                    class="text-sm font-medium hover:text-cyan-400 transition-colors {{ Request::is('/') ? 'text-cyan-400' : 'text-slate-300' }}">Beranda</a>

                @auth
                    <a href="{{ route('backend.v_index.index') }}"
                        class="text-sm font-medium hover:text-cyan-400 transition-colors {{ Request::is('*dashboard*') ? 'text-cyan-400' : 'text-slate-300' }}">Dashboard</a>
                    <a href="/about"
                        class="text-sm font-medium hover:text-cyan-400 transition-colors {{ Request::is('about') ? 'text-cyan-400' : 'text-slate-300' }}">Tentang</a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-rose-400 hover:text-rose-300 hover:bg-rose-400/10 px-4 py-2 rounded-lg transition-all duration-200">Logout</button>
                    </form>
                @else
                    <a href="/about"
                        class="text-sm font-medium hover:text-cyan-400 transition-colors {{ Request::is('about') ? 'text-cyan-400' : 'text-slate-300' }}">Tentang</a>
                    <div class="h-6 w-px bg-slate-700"></div>
                    <a href="/login" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Login</a>
                    <a href="/register"
                        class="text-sm font-bold bg-white text-slate-900 hover:bg-cyan-400 hover:text-white px-5 py-2.5 rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">Daftar</a>
                @endauth
            </div>

            <!-- Mobile Menu Btn -->
            <div class="md:hidden">
                <button id="mobile-menu-button"
                    class="text-slate-300 hover:text-white focus:outline-none p-2 bg-slate-800/50 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-4 6h4"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-slate-900 border-t border-slate-800 absolute w-full left-0 top-20 shadow-2xl">
            <div class="px-4 py-6 space-y-4">
                <a href="/"
                    class="block px-4 py-3 text-base font-medium text-slate-300 hover:bg-slate-800 rounded-xl hover:text-cyan-400 transition">Beranda</a>
                <a href="/about"
                    class="block px-4 py-3 text-base font-medium text-slate-300 hover:bg-slate-800 rounded-xl hover:text-cyan-400 transition">Tentang
                    Kami</a>
                @auth
                    <a href="{{ route('backend.v_index.index') }}"
                        class="block px-4 py-3 text-base font-medium text-slate-300 hover:bg-slate-800 rounded-xl hover:text-cyan-400 transition">Dashboard</a>
                    <form method="POST" action="/logout" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-3 text-base font-medium text-rose-400 hover:bg-rose-500/10 rounded-xl transition">Logout</button>
                    </form>
                @else
                    <div class="h-px bg-slate-800 my-4"></div>
                    <a href="/login"
                        class="block px-4 py-3 text-base font-medium text-center text-slate-300 hover:bg-slate-800 rounded-xl transition">Login</a>
                    <a href="/register"
                        class="block px-4 py-3 text-base font-bold text-center bg-cyan-500 text-white rounded-xl hover:bg-cyan-400 shadow-md transition">Daftar
                        Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20 relative z-20">
        @yield('content')
    </main>

    <footer class="bg-slate-900 border-t border-slate-800 py-10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-medium text-slate-500">&copy; {{ date('Y') }} WAVERIDER Jetski Rental.</p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>

</html>