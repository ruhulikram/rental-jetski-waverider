@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-800 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-white mb-1">Manajemen Pengguna</h1>
            <p class="text-sm text-slate-400">Kelola informasi akun pengguna terdaftar, serta otoritas akses (Role).</p>
        </div>
        <form action="{{ route('backend.users.index') }}" method="GET" class="relative w-full sm:w-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email..."
                class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-slate-900/50 border border-slate-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 rounded-lg text-white placeholder-slate-500 transition-colors text-sm" />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3.5 top-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </form>
    </div>

    <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700/50">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider w-16">#</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Biodata</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Kontak</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Peran (Role)</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50 bg-transparent">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-white">{{ $user->name }}</div>
                                <div class="text-sm text-slate-400 mt-0.5">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                                {{ $user->phone ?? 'Belum diatur' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-lg border
                                            {{ $user->role === 'admin' ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' : 'bg-slate-500/10 text-slate-400 border-slate-500/20' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('backend.users.edit', $user->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-slate-700/50 hover:bg-slate-600 text-slate-300 hover:text-white border border-slate-600 rounded text-xs font-medium transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('backend.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengguna ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white border border-rose-500/20 hover:border-rose-500 rounded text-xs font-medium transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">
                                Tidak ada data pengguna ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection