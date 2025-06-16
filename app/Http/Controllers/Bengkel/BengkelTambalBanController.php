<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Jasa;
use App\Models\JasaService;

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

    public function jasa(Request $request)
    {
        return view ('tambalBan.jasa');
    }

    // AdminController.php

    // ==================== JASA SERVICE MANAGEMENT ====================

    public function jasaService(Request $request)
    {
        // Ambil SEMUA KATEGORI untuk dropdown di form tambah data
        $kategoriJasa = Jasa::orderBy('jenis_jasa', 'asc')->get();

        // Ambil semua data JasaService dengan relasi ke kategorinya
        $query = JasaService::with('jasa');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nama_jasa', 'LIKE', "%{$search}%")
                  ->orWhereHas('jasa', function($q) use ($search) {
                      $q->where('jenis_jasa', 'LIKE', "%{$search}%");
                  });
        }
        
        $jasaServices = $query->latest()->paginate(10);
        
        // Kirim data service dan data kategori ke view
        return view('tambalBan.jasa', compact('jasaServices', 'kategoriJasa'));
    }

    public function storeJasaService(Request $request)
    {
        $validated = $request->validate([
            'jasa_id' => 'required|exists:jasas,id',
            'nama_jasa' => 'required|string|max:255',
            'harga_jasa' => 'required|numeric|min:0',
        ]);

        JasaService::create($validated);
        return redirect()->route('jasa.service.store')->with('success', 'Jasa service baru berhasil ditambahkan!');
    }

    public function editJasaService($id)
    {
        try {
            // Cari Jasa Service yang akan di-edit
            $jasaService = JasaService::findOrFail($id);

            // Ambil semua kategori untuk pilihan dropdown
            $kategoriJasa = Jasa::orderBy('jenis_jasa', 'asc')->get();

            // Kirim data ke view edit
            return view('tambalBan.edit_jasa', compact('jasaService', 'kategoriJasa'));
        } catch (\Exception $e) {
            Log::error('Error menampilkan form edit Jasa Service: ' . $e->getMessage());
            return redirect()->route('jasa.service.edit')->with('error', 'Jasa Service tidak ditemukan.');
        }
    
    }

    public function updateJasaService(Request $request, $id)
    {
        try {
            $jasaService = JasaService::findOrFail($id);
            
            $validated = $request->validate([
                'jasa_id' => 'required|exists:jasas,id',
                // Aturan unique diubah agar tidak memeriksa nama Jasa Service yang sedang diedit
                'nama_jasa' => 'required|string|max:255|unique:jasa_services,nama_jasa,' . $id,
                'harga_jasa' => 'required|numeric|min:0',
            ]);

            $jasaService->update($validated);

            return redirect()->route('jasa.service')->with('success', 'Jasa Service berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error memperbarui Jasa Service: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui Jasa Service.');
        }
    }

    public function destroyJasaService($id)
    {
        try {
            $jasaService = JasaService::findOrFail($id);
            $jasaService->delete();

            return redirect()->route('jasa.service')->with('success', 'Jasa Service berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error menghapus Jasa Service: ' . $e->getMessage());
            return redirect()->route('jasa.service.destroy')->with('error', 'Gagal menghapus Jasa Service.');
        }
    }

    
}
