@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Elements Specific to Auth -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-cyan-600/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-slate-400 mt-2 font-light">Masuk untuk melanjutkan petualangan Anda.</p>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-2xl border border-slate-700/50 rounded-3xl shadow-2xl p-8">

            {{-- Alerts --}}
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl mb-6 text-sm flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 p-4 rounded-xl mb-6 text-sm flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-slate-300 text-sm font-medium mb-2">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors" />
                    @error('email')
                        <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-slate-300 text-sm font-medium">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-cyan-400 hover:text-cyan-300 transition-colors">Lupa Password?</a>
                        @endif
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                    @error('password')
                        <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-600 bg-slate-900/50 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-slate-800">
                    <label for="remember" class="ml-2 block text-sm text-slate-400">
                        Ingat Saya
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-cyan-600 text-white font-bold py-3.5 px-4 rounded-xl hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 focus:ring-offset-slate-800 shadow-[0_0_20px_rgba(8,145,178,0.3)] hover:shadow-[0_0_30px_rgba(8,145,178,0.5)] transition-all duration-300 hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-700/50 text-center">
                <p class="text-sm border-gray-600 text-slate-400">
                    Belum bergabung dengan kru? 
                    <a href="/register" class="text-white hover:text-cyan-400 font-bold transition-colors">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection