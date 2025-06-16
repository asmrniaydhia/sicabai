<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Bengkel;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function create()
    {
        $spareparts = Sparepart::all();
        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();
        $barangs = $bengkel ? Barang::where('id_bengkel', $bengkel->id)->get() : collect();

        return view('bengkelService.barang', compact('spareparts', 'barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'merk' => 'required|string|max:100',
            'harga_jual' => 'required|numeric',
            'harga_jasa' => 'required|numeric',
            'stok' => 'required|integer',
            
        ]);

        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        if (!$bengkel) {
            return redirect()->back()->with('error', 'Anda tidak memiliki bengkel yang terkait.');
        }

        Barang::create([
            'sparepart_id' => $validated['sparepart_id'],
            'id_user' => $user->id, // ID user yang login
            'id_bengkel' => $bengkel->id, // ID bengkel terkait
            'merk' => $validated['merk'],
            'harga_jual' => $validated['harga_jual'],
            'harga_jasa' => $validated['harga_jasa'],
            'stok' => $validated['stok'],
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $spareparts = Sparepart::all();
        $user = Auth::user();
        if ($barang->id_user !== $user->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit barang ini.');
        }
        return view('bengkelService.edit_barang', compact('barang', 'spareparts'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'merk' => 'required|string|max:100',
            'harga_jual' => 'required|numeric',
            'harga_jasa' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $user = Auth::user();
        if ($barang->id_user !== $user->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit barang ini.');
        }

        $barang->update([
            'sparepart_id' => $validated['sparepart_id'],
            'merk' => $validated['merk'],
            'harga_jual' => $validated['harga_jual'],
            'harga_jasa' => $validated['harga_jasa'],
            'stok' => $validated['stok'],
        ]);

        return redirect()->route('barang.create')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $user = Auth::user();

        if ($barang->id_user !== $user->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus barang ini.');
        }

        $barang->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}