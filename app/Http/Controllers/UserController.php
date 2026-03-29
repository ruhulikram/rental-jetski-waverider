<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->latest()->get();

        // Return the users to a view
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view edit dengan data user
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Cegah sesama admin mengedit data admin lain
        if (auth()->user()->role === 'admin' && $user->role === 'admin' && auth()->id() !== $user->id) {
            return redirect()->route('backend.users.index')->with('error', 'Anda tidak dapat mengedit data admin lain.');
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            // Validasi tambahan:
            // 'password' => 'nullable|string|min:8|confirmed',
            // 'phone' => 'nullable|string|max:20',
            // 'role' => 'required|in:user,admin',
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        // Jika ingin update password:
        // if ($request->filled('password')) {
        //     $user->password = bcrypt($request->password);
        // }
        // Jika ada field lain, tambahkan di sini
        $user->save();

        // Redirect ke index dengan notifikasi sukses
        return redirect()->route('backend.users.index')->with('success', 'User berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back to the users index with a success message
        return redirect()->route('backend.users.index')->with('success', 'User berhasil dihapus.');
    }
}
