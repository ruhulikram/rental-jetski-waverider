@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-white mb-1">Edit Paket Jetski</h1>
                <p class="text-sm text-slate-400">Memperbarui informasi paket: <span class="font-semibold text-cyan-400">{{ $package->name }}</span></p>
            </div>
            <a href="{{ route('backend.jetskipackages.index') }}"
                class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/50 py-2.5 px-5 rounded-lg transition-colors text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- Form Edit --}}
        <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl p-6 lg:p-8">
            <form method="POST" action="{{ route('backend.jetskipackages.update', $package->id) }}" class="space-y-6 text-sm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-slate-400 font-medium mb-1.5">Nama Paket</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $package->name) }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors">
                            @error('name')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="duration" class="block text-slate-400 font-medium mb-1.5">Durasi (Menit)</label>
                            <input type="number" id="duration" name="duration" value="{{ old('duration', $package->duration) }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors">
                            @error('duration')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="price" class="block text-slate-400 font-medium mb-1.5">Harga Dasar (Rp)</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $package->price) }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors">
                            @error('price')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-6">
                        <div>
                            <label for="is_active" class="block text-slate-400 font-medium mb-1.5">Status Tampil</label>
                            <select id="is_active" name="is_active" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                <option value="1" {{ old('is_active', $package->is_active) == 1 ? 'selected' : '' }} class="bg-slate-800 text-white">Aktif (Tersedia)</option>
                                <option value="0" {{ old('is_active', $package->is_active) == 0 ? 'selected' : '' }} class="bg-slate-800 text-white">Tidak Aktif (Disembunyikan)</option>
                            </select>
                            @error('is_active')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="description" class="block text-slate-400 font-medium mb-1.5">Deskripsi Lengkap</label>
                            <textarea id="description" name="description" rows="5" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors">{{ old('description', $package->description) }}</textarea>
                            @error('description')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
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