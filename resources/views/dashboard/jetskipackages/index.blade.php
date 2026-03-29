@extends('layouts.admin')

@section('content')
    <div class="mb-8 border-b border-slate-800 pb-5">
        <h1 class="text-2xl font-bold text-white mb-1">Manajemen Paket Jetski</h1>
        <p class="text-sm text-slate-400">Kelola daftar armada, perbarui harga, dan status paket sewa.</p>
    </div>

    <div class="grid lg:grid-cols-12 gap-8">
        <!-- Form Tambah Paket -->
        <div class="lg:col-span-4">
            <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl p-6 relative">
                <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Paket Baru
                </h2>

                <form method="POST" action="{{ route('backend.jetskipackages.store') }}" class="space-y-4 text-sm">
                    @csrf

                    <div>
                        <label for="name" class="block text-slate-400 font-medium mb-1.5">Nama Paket</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">
                        @error('name')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-slate-400 font-medium mb-1.5">Durasi (Menit)</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration') }}" required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">
                        @error('duration')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="price" class="block text-slate-400 font-medium mb-1.5">Harga Dasar (Rp)</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">
                        @error('price')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="description" class="block text-slate-400 font-medium mb-1.5">Deskripsi Singkat</label>
                        <textarea id="description" name="description" required rows="3"
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors">{{ old('description') }}</textarea>
                        @error('description')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                            Simpan Paket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Daftar Paket -->
        <div class="lg:col-span-8">
            <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl overflow-hidden">
                <div class="p-6 border-b border-slate-700/50">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Daftar Paket Tersedia
                    </h2>
                </div>

                @if($JetskiPackages->count() > 0)
                    <div class="divide-y divide-slate-700/50">
                        @foreach($JetskiPackages as $package)
                            <div
                                class="p-6 hover:bg-slate-800/50 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="font-bold text-white text-lg">{{ $package->name }}</h3>
                                        <span class="px-2 py-0.5 text-[10px] font-bold tracking-widest uppercase rounded border
                                                        @if($package->is_active) bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                                        @else bg-rose-500/10 text-rose-400 border-rose-500/20 @endif">
                                            {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-4 text-sm mt-2">
                                        <span class="flex items-center gap-1.5 text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $package->duration }} Menit
                                        </span>
                                        <span class="text-slate-600">|</span>
                                        <span class="font-semibold text-cyan-400">Rp
                                            {{ number_format($package->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 sm:shrink-0">
                                    <a href="{{ route('backend.jetskipackages.edit', $package->id) }}"
                                        class="inline-flex items-center justify-center bg-slate-700/50 hover:bg-slate-600 border border-slate-600 text-slate-300 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('backend.jetskipackages.destroy', $package->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center bg-rose-500/10 hover:bg-rose-500 border border-rose-500/20 hover:border-rose-500 text-rose-400 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <p class="text-slate-500">Belum ada paket jetski yang didaftarkan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection