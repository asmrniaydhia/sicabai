<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BengkelTambalBanController extends Controller
{
    public function index()
    {
        $bengkelTambalBan = Bengkel::where('id_user', Auth::id())->first();
        return view('tambalBan.dashboard', compact('bengkelTambalBan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil bengkel berdasarkan id dan id_user yang sedang login
        $bengkelTambalBan = Bengkel::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|regex:/^[0-9]{10,13}$/', // Validasi nomor lokal 10-13 digit
            'foto_bengkel' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string',
            'jasa_penjemputan' => 'required|in:ada,tidak',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka', // Hapus kondisi dinamis untuk kesederhanaan
            'hari_libur' => 'nullable|array',
            'hari_libur.*' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        // Konversi nomor WhatsApp ke format internasional
        $whatsapp = $validated['whatsapp'];
        if (preg_match('/^0/', $whatsapp)) {
            $whatsapp = '+62' . substr(preg_replace('/[^0-9]/', '', $whatsapp), 1);
        } elseif (!preg_match('/^\+/', $whatsapp)) {
            $whatsapp = '+62' . preg_replace('/[^0-9]/', '', $whatsapp);
        }

        // Handle file upload jika ada file baru
        $fotoPath = $bengkelTambalBan->foto_bengkel;
        if ($request->hasFile('foto_bengkel')) {
            if ($bengkelTambalBan->foto_bengkel) {
                Storage::disk('public')->delete($bengkelTambalBan->foto_bengkel);
            }
            $fotoPath = $request->file('foto_bengkel')->store('bengkel', 'public');
        }

        // Siapkan data untuk update
        $updateData = [
            'nama' => $validated['nama'],
            'whatsapp' => $whatsapp,
            'foto_bengkel' => $fotoPath,
            'alamat' => $validated['alamat'],
            'jasa_penjemputan' => $validated['jasa_penjemputan'],
            'jam_buka' => $validated['jam_buka'],
            'jam_tutup' => $validated['jam_tutup'],
            'hari_libur' => $validated['hari_libur'] ?? [],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
        ];

        // Lakukan update
        $bengkelTambalBan->update($updateData);

        return response()->json(['message' => 'Bengkel berhasil diperbarui!'], 200);
    }

    public function jasa()
    {
        return view ('tambalBan.jasa');
    }
}
