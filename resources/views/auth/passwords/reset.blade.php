@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Elements Specific to Auth -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Buat Password Baru</h2>
            <p class="text-slate-400 mt-2 font-light">Silakan masukkan password baru Anda yang kuat.</p>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-2xl border border-slate-700/50 rounded-3xl shadow-2xl p-8">
            
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-slate-300 text-sm font-medium mb-2">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors" />
                    @error('email')
                        <p class="text-rose-400 text-xs mt-2"><strong>{{ $message }}</strong></p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-slate-300 text-sm font-medium mb-2">Password Baru</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                    @error('password')
                        <p class="text-rose-400 text-xs mt-2"><strong>{{ $message }}</strong></p>
                    @enderror
                </div>

                <div>
                    <label for="password-confirm" class="block text-slate-300 text-sm font-medium mb-2">Ulangi Password Baru</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-xl text-white placeholder-slate-500 transition-colors">
                </div>

                <button type="submit" 
                    class="w-full bg-cyan-600 text-white font-bold py-3.5 px-4 rounded-xl hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 focus:ring-offset-slate-800 shadow-[0_0_20px_rgba(8,145,178,0.3)] hover:shadow-[0_0_30px_rgba(8,145,178,0.5)] transition-all duration-300 hover:-translate-y-0.5 mt-4">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
