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
        $bengkelTambalBan = Bengkel::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|regex:/^[0-9]{10,13}$/',
            'foto_bengkel' => 'image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string',
            'jasa_penjemputan' => 'required|in:ada,tidak',
            // Perbaikan: Validasi hanya jika field ada dan tidak kosong
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i' . ($request->filled('jam_buka') ? '|after:jam_buka' : ''),
            'hari_libur' => 'required|array',
            'hari_libur.*' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        // Handle file upload if provided
        if ($request->hasFile('foto_bengkel')) {
            if ($bengkelTambalBan->foto_bengkel) {
                Storage::disk('public')->delete($bengkelTambalBan->foto_bengkel);
            }
            $validated['foto_bengkel'] = $request->file('foto_bengkel')->store('bengkel', 'public');
        } else {
            $validated['foto_bengkel'] = $bengkelTambalBan->foto_bengkel;
        }

        // Perbaikan: Gunakan nilai dari request jika ada, atau pertahankan nilai lama
        $updateData = [
            'nama' => $validated['nama'],
            'whatsapp' => $validated['whatsapp'],
            'foto_bengkel' => $validated['foto_bengkel'],
            'alamat' => $validated['alamat'],
            'jasa_penjemputan' => $validated['jasa_penjemputan'],
            'jam_buka' => $request->filled('jam_buka') ? $validated['jam_buka'] : $bengkelTambalBan->jam_buka,
            'jam_tutup' => $request->filled('jam_tutup') ? $validated['jam_tutup'] : $bengkelTambalBan->jam_tutup,
            'hari_libur' => $validated['hari_libur'] ?? [],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
        ];

        $bengkelTambalBan->update($updateData);

        return response()->json(['message' => 'Bengkel berhasil diperbarui!'], 200);
    }

    public function jasa()
    {
        return view ('tambalBan.jasa');
    }
}
