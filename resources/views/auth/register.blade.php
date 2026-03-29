@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Elements Specific to Auth -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-xl relative z-10">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Mulai Petualangan Anda</h2>
            <p class="text-slate-400 mt-2 font-light">Buat akun untuk memesan armada jetski premium kami.</p>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-2xl border border-slate-700/50 rounded-3xl shadow-2xl p-8">
            
            <form method="POST" action="/register" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-slate-300 text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                        @error('name')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-slate-300 text-sm font-medium mb-2">No. WhatsApp</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="081234567890"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                        @error('phone')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-slate-300 text-sm font-medium mb-2">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                    @error('email')
                        <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-slate-300 text-sm font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                        @error('password')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-slate-300 text-sm font-medium mb-2">Ulangi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                    </div>
                </div>
                
                <button type="submit" 
                    class="w-full bg-white text-slate-900 font-bold py-3.5 px-4 rounded-xl hover:bg-cyan-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-slate-800 shadow-lg hover:shadow-[0_0_20px_rgba(34,211,238,0.5)] transition-all duration-300 hover:-translate-y-0.5 mt-4">
                    Buat Akun Sekarang
                </button>
            </form>
            
            <div class="mt-8 pt-6 border-t border-slate-700/50 text-center">
                <p class="text-sm text-slate-400">
                    Sudah punya akun? 
                    <a href="/login" class="text-white hover:text-cyan-400 font-bold transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection