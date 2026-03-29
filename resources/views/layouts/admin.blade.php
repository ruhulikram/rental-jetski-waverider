<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAVERIDER Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #020617; /* slate-950 */
            color: #f8fafc;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
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

        .glass-nav {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
    @stack('styles')
    @stack('scripts')
</head>

<body class="antialiased selection:bg-cyan-500 selection:text-white min-h-screen flex flex-col relative">
    {{-- Global Background Effects --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] bg-blue-600/10 rounded-full blur-[120px] mix-blend-screen"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/10 rounded-full blur-[120px] mix-blend-screen"></div>
    </div>

    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <!-- Brand -->
            <a href="/" class="flex items-center gap-3 pr-8 border-r border-slate-700/50">
                <span class="text-sm font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">
                    WAVE<span class="text-cyan-400">RIDER</span> <span class="text-xs text-rose-400 ml-1">ADMIN</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex flex-grow items-center ml-8 space-x-6">
                @auth
                    <a href="{{ route('backend.v_index.index') }}" class="text-xs font-bold uppercase tracking-wider hover:text-cyan-400 transition-colors {{ Request::is('*v_index*') ? 'text-cyan-400' : 'text-slate-400' }}">Dashboard</a>
                    <a href="{{ route('backend.bookings.index') }}" class="text-xs font-bold uppercase tracking-wider hover:text-cyan-400 transition-colors {{ Request::is('*bookings*') ? 'text-cyan-400' : 'text-slate-400' }}">Booking</a>
                    <a href="{{ route('backend.jetskipackages.index') }}" class="text-xs font-bold uppercase tracking-wider hover:text-cyan-400 transition-colors {{ Request::is('*packages*') ? 'text-cyan-400' : 'text-slate-400' }}">Paket</a>
                    <a href="{{ route('backend.users.index') }}" class="text-xs font-bold uppercase tracking-wider hover:text-cyan-400 transition-colors {{ Request::is('*users*') ? 'text-cyan-400' : 'text-slate-400' }}">Users</a>
                @endauth
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-3 border-l border-slate-700/50 pl-6">
                        <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-600 flex items-center justify-center overflow-hidden">
                            <span class="text-xs font-bold text-cyan-400">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="text-xs font-bold text-rose-400 hover:text-rose-300 transition-all uppercase tracking-wider">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="/login" class="text-sm font-medium hover:text-cyan-400">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-24 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full relative z-10 transition-all">
        
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/20 p-4 backdrop-blur-md flex items-center gap-3">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex flex-center items-center justify-center">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </span>
                <p class="text-emerald-200 text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl bg-rose-500/10 border border-rose-500/20 p-4 backdrop-blur-md flex items-center gap-3">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-rose-500/20 text-rose-400 flex flex-center items-center justify-center">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </span>
                <p class="text-rose-200 text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-rose-500/10 border border-rose-500/20 p-4 backdrop-blur-md text-rose-200 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>