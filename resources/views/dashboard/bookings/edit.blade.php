@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-white mb-1">Edit Reservasi</h1>
                <p class="text-sm text-slate-400">Memperbarui reservasi: <span class="font-semibold text-cyan-400">{{ $edit->booking_code }}</span></p>
            </div>
            <a href="{{ route('backend.bookings.index') }}"
                class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/50 py-2.5 px-5 rounded-lg transition-colors text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- Form Edit --}}
        <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl p-6 lg:p-8">
            <form method="POST" action="{{ route('backend.bookings.update', $edit->id) }}" class="space-y-6 text-sm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-6">
                        {{-- Nama Pelanggan (readonly) --}}
                        <div>
                            <label for="customer_name" class="block text-slate-400 font-medium mb-1.5">Nama Pelanggan</label>
                            <input type="text" id="customer_name" readonly value="{{ $edit->user->name }}"
                                class="w-full px-4 py-2.5 bg-slate-900/30 border border-slate-700/50 rounded-lg text-slate-500 cursor-not-allowed transition-colors" />
                        </div>

                        {{-- Paket Jetski --}}
                        <div>
                            <label for="jetski_package_id" class="block text-slate-400 font-medium mb-1.5">Paket Jetski</label>
                            <select id="jetski_package_id" name="jetski_package_id" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ $edit->jetski_package_id == $package->id ? 'selected' : '' }} class="bg-slate-800 text-white">
                                        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jetski_package_id')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Status Booking --}}
                        <div>
                            <label for="status" class="block text-slate-400 font-medium mb-1.5">Status Booking</label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                <option value="pending" {{ $edit->status == 'pending' ? 'selected' : '' }} class="bg-slate-800 text-white">Pending</option>
                                <option value="confirmed" {{ $edit->status == 'confirmed' ? 'selected' : '' }} class="bg-slate-800 text-white">Confirmed</option>
                                <option value="completed" {{ $edit->status == 'completed' ? 'selected' : '' }} class="bg-slate-800 text-white">Completed</option>
                                <option value="cancelled" {{ $edit->status == 'cancelled' ? 'selected' : '' }} class="bg-slate-800 text-white">Cancelled</option>
                            </select>
                            @error('status')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-6">
                        {{-- Tanggal Booking --}}
                        <div>
                            <label for="booking_date" class="block text-slate-400 font-medium mb-1.5">Tanggal Reservasi</label>
                            <input type="date" id="booking_date" name="booking_date"
                                value="{{ \Carbon\Carbon::parse($edit->booking_date)->format('Y-m-d') }}"
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors [color-scheme:dark]" required />
                            @error('booking_date')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Waktu Booking --}}
                        <div>
                            <label for="booking_time" class="block text-slate-400 font-medium mb-1.5">Waktu Operasional</label>
                            <input type="time" id="booking_time" name="booking_time"
                                value="{{ \Carbon\Carbon::parse($edit->booking_time)->format('H:i') }}"
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors [color-scheme:dark]" required />
                            @error('booking_time')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="pt-6 border-t border-slate-700/50 mt-6">
                    <label for="notes" class="block text-slate-400 font-medium mb-1.5">Catatan Khusus Admin</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-600 transition-colors"
                        placeholder="Tambahkan instruksi operasional khusus..." >{{ $edit->notes }}</textarea>
                    @error('notes')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Tombol Aksi -->
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