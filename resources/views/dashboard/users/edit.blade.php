@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-white mb-1">Edit Pengguna</h1>
                <p class="text-sm text-slate-400">Memperbarui detail untuk pengguna: <span class="font-semibold text-cyan-400">{{ $user->name }}</span></p>
            </div>
            <a href="{{ route('backend.users.index') }}"
                class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/50 py-2.5 px-5 rounded-lg transition-colors text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- Form Edit --}}
        <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl p-6 lg:p-8">
            <form method="POST" action="{{ route('backend.users.update', $user->id) }}" class="space-y-6 text-sm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-slate-400 font-medium mb-1.5">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">
                            @error('name')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="block text-slate-400 font-medium mb-1.5">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">
                            @error('email')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-slate-400 font-medium mb-1.5">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">
                            @error('phone')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-6">
                        <div>
                            <label for="role" class="block text-slate-400 font-medium mb-1.5">Role Pengguna</label>
                            <select id="role" name="role" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }} class="bg-slate-800 text-white">User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }} class="bg-slate-800 text-white">Admin</option>
                            </select>
                            @error('role')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="block text-slate-400 font-medium mb-1.5">Password Baru (Opsional)</label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-600 transition-colors"
                                placeholder="Biarkan kosong jika tidak diubah">
                            @error('password')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-slate-400 font-medium mb-1.5">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-600 transition-colors"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-slate-700/50 mt-8">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-500 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md transition-colors w-full sm:w-auto">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection