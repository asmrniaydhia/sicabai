<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use App\Models\Sparepart;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BengkelServiceController extends Controller
{
    public function index()
    {
        $bengkel = Bengkel::where('id_user', Auth::id())->first();
        return view('bengkelService.dashboard', compact('bengkel'));
    }

    public function barang()
    {
        // $spareparts = Sparepart::all(); // untuk dropdown
        // $barangs = Barang::all();       // untuk menampilkan daftar barang
        

        // $barangs = Barang::with('sparepart')->get();
        // $spareparts = Sparepart::all();
        // return view('bengkelService.barang', compact('barangs', 'spareparts'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id', // Ganti 'jenis_barang' menjadi 'sparepart_id' untuk konsistensi
            'merk' => 'required|string|max:100',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'id_bengkel' => 'required|exists:bengkel,id', // Validasi id_bengkel
        ]);

        // Ambil id_bengkel berdasarkan user yang login (opsional)
        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        if (!$bengkel) {
            return redirect()->back()->with('error', 'Anda tidak memiliki bengkel yang terkait.');
        }

        // Simpan data barang
        Barang::create([
            'sparepart_id' => $validated['sparepart_id'],
            'id_bengkel' => $bengkel->id, // Gunakan id_bengkel dari bengkel user
            'merk' => $validated['merk'],
            'harga_jual' => $validated['harga_jual'],
            'stok' => $validated['stok'],
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bengkel = Bengkel::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|regex:/^[0-9]{10,13}$/',
            'foto_bengkel' => 'image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string',
            'jasa_penjemputan' => 'required|in:ada,tidak',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i' . ($request->filled('jam_buka') ? '|after:jam_buka' : ''),
            'hari_libur' => 'required|array',
            'hari_libur.*' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        // Handle file upload if provided
        if ($request->hasFile('foto_bengkel')) {
            if ($bengkel->foto_bengkel) {
                Storage::disk('public')->delete($bengkel->foto_bengkel);
            }
            $validated['foto_bengkel'] = $request->file('foto_bengkel')->store('bengkel', 'public');
        } else {
            $validated['foto_bengkel'] = $bengkel->foto_bengkel;
        }

        // Perbaikan: Gunakan nilai dari request jika ada, atau pertahankan nilai lama
        $updateData = [
            'nama' => $validated['nama'],
            'whatsapp' => $validated['whatsapp'],
            'foto_bengkel' => $validated['foto_bengkel'],
            'alamat' => $validated['alamat'],
            'jasa_penjemputan' => $validated['jasa_penjemputan'],
            'jam_buka' => $request->filled('jam_buka') ? $validated['jam_buka'] : $bengkel->jam_buka,
            'jam_tutup' => $request->filled('jam_tutup') ? $validated['jam_tutup'] : $bengkel->jam_tutup,
            'hari_libur' => $validated['hari_libur'] ?? [],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
        ];

        $bengkel->update($updateData);

        return response()->json(['message' => 'Bengkel berhasil diperbarui!'], 200);
    }

    // public function edit($id)
    // {
    //     $barang = Barang::findOrFail($id);
    //     $spareparts = Sparepart::all();
    //     return view('bengkelService.edit_barang', compact('barang', 'spareparts'));
    // }

    // public function destroy($id)
    // {
    //     Barang::destroy($id);
    //     return back()->with('success', 'Barang berhasil dihapus.');
    // }



}