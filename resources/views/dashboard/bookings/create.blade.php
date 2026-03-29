@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-white mb-1">Tambah Booking Manual</h1>
                <p class="text-sm text-slate-400">Buat reservasi baru untuk pelanggan secara manual.</p>
            </div>
            <a href="{{ route('backend.bookings.index') }}"
                class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/50 py-2.5 px-5 rounded-lg transition-colors text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Batal & Kembali
            </a>
        </div>

        {{-- Form Create --}}
        <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl p-6 lg:p-8">
            <form method="POST" action="{{ route('backend.bookings.store') }}" class="space-y-6 text-sm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-6">
                        <!-- Pilih User -->
                        <div>
                            <label for="user_id" class="block text-slate-400 font-medium mb-1.5">Pilih Pelanggan</label>
                            <select name="user_id" id="user_id" required 
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                <option value="" disabled selected class="bg-slate-800 text-slate-500">-- Pilih akun terdaftar --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" data-phone="{{ $user->phone ?? '' }}" {{ old('user_id') == $user->id ? 'selected' : '' }} class="bg-slate-800 text-white">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                             @error('user_id') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="phone" class="block text-slate-400 font-medium mb-1.5">Nomor Telepon Konfirmasi</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-600 transition-colors"
                                placeholder="Akan terisi otomatis atau ketik manual" />
                            @error('phone') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Pilih Paket -->
                        <div>
                            <label for="jetski_package_id" class="block text-slate-400 font-medium mb-1.5">Pilih Modul Armada</label>
                            <select name="jetski_package_id" id="jetski_package_id" required 
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                <option value="" disabled selected class="bg-slate-800 text-slate-500">-- Pilih paket jetski --</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('jetski_package_id') == $package->id ? 'selected' : '' }} class="bg-slate-800 text-white">
                                        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jetski_package_id') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-6">
                        <!-- Tanggal Booking -->
                        <div>
                            <label for="booking_date" class="block text-slate-400 font-medium mb-1.5">Tanggal Reservasi</label>
                            <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors [color-scheme:dark]" />
                            @error('booking_date') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Waktu Booking -->
                        <div>
                            <label for="booking_time" class="block text-slate-400 font-medium mb-1.5">Jam Operasional (8Pagi - 6Sore)</label>
                            <input type="time" id="booking_time" name="booking_time" value="{{ old('booking_time') }}" required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors [color-scheme:dark]" />
                            @error('booking_time') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Status Booking & Pembayaran -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="status" class="block text-slate-400 font-medium mb-1.5">Status Reservasi</label>
                                <select id="status" name="status" required 
                                    class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                    <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }} class="bg-slate-800 text-white" selected>Confirmed</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }} class="bg-slate-800 text-white">Completed</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }} class="bg-slate-800 text-white">Pending</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }} class="bg-slate-800 text-white">Cancelled</option>
                                </select>
                                @error('status') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="payment_status" class="block text-slate-400 font-medium mb-1.5">Status Bayar</label>
                                <select id="payment_status" name="payment_status" required 
                                    class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white transition-colors appearance-none">
                                    <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }} class="bg-slate-800 text-white" selected>Pending</option>
                                    <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }} class="bg-slate-800 text-white">Paid</option>
                                    <option value="failed" {{ old('payment_status') == 'failed' ? 'selected' : '' }} class="bg-slate-800 text-white">Failed</option>
                                </select>
                                @error('payment_status') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="pt-6 border-t border-slate-700/50 mt-6">
                    <label for="notes" class="block text-slate-400 font-medium mb-1.5">Keterangan Internal Admin (Opsional)</label>
                    <textarea id="notes" name="notes" rows="3"
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-600 transition-colors"
                                placeholder="Tulis instruksi khusus jika diperlukan.">{{ old('notes') }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end pt-6 border-t border-slate-700/50 mt-8">
                    <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md transition-colors w-full sm:w-auto">
                        Konfirmasi Booking Manual
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userSelect = document.getElementById('user_id');
        const phoneInput = document.getElementById('phone');

        if (userSelect && phoneInput) {
            userSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const phone = selectedOption.dataset.phone || '';
                phoneInput.value = phone;
            });
        }
    });
</script>
@endpush
