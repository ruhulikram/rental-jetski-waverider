<?php

namespace App\Http\Controllers;

use App\Models\JetskiPackage;
use Illuminate\Http\Request;

class JetskiPackageController extends Controller
{
    /**
     * Menampilkan halaman manajemen paket (form tambah & daftar paket).
     */
    public function index()
    {
        $jetskiPackages = JetskiPackage::latest()->get();
        return view('dashboard.jetskipackages.index', ['JetskiPackages' => $jetskiPackages]);
    }

    /**
     * Menyimpan paket baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jetski_packages,name',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'is_active' => 'sometimes|boolean',
        ], [
            'name.unique' => 'Nama paket ini sudah ada, silakan gunakan nama lain.',
        ]);

        JetskiPackage::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? $request->is_active : true,
        ]);

        return redirect()->route('backend.jetskipackages.index')
            ->with('success', 'Paket baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit paket.
     */
    public function edit(string $id)
    {
        $package = JetskiPackage::findOrFail($id);
        return view('dashboard.jetskipackages.edit', compact('package'));
    }

    /**
     * Mengupdate paket yang ada di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jetski_packages,name,' . $id,
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ], [
            'name.unique' => 'Nama paket ini sudah digunakan oleh paket lain.',
        ]);

        $package = JetskiPackage::findOrFail($id);
        $package->update($request->all());

        return redirect()->route('backend.jetskipackages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Menghapus paket dari database.
     */
    public function destroy(string $id)
    {
        $package = JetskiPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('backend.jetskipackages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }
}
