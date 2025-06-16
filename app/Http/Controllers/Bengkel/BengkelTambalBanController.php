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

    public function update(Request $request, string $id)
    {
        // Clean the WhatsApp number
        $request->merge([
            'whatsapp' => preg_replace('/[^0-9]/', '', $request->whatsapp),
        ]);

        // Ambil bengkel berdasarkan id dan id_user yang sedang login
        $bengkel = Bengkel::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        // Validate the request
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|regex:/^[0-9]{10,13}$/',
            'foto_bengkel' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string',
            'jasa_penjemputan' => 'required|in:ada,tidak',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
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
        $fotoPath = $bengkel->foto_bengkel;
        if ($request->hasFile('foto_bengkel')) {
            if ($bengkel->foto_bengkel) {
                Storage::disk('public')->delete($bengkel->foto_bengkel);
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
        $bengkel->update($updateData);

        return response()->json(['message' => 'Bengkel berhasil diperbarui!'], 200);
    }

    public function jasa(Request $request)
    {
        // Get all categories for dropdown in add form
        $kategoriJasa = Jasa::orderBy('jenis_jasa', 'asc')->get();

        // Get user and bengkel
        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        // Get jasa services for current user's bengkel with pagination
        $jasaServices = $bengkel ? JasaService::where('id_bengkel', $bengkel->id)
            ->with('jasa')
            ->latest()
            ->paginate(10) : JasaService::whereNull('id_bengkel')->paginate(10); // Return empty paginated result if no bengkel

        return view('tambalBan.jasa', compact('kategoriJasa', 'jasaServices'));
    }

    public function jasaService(Request $request)
    {
        // Get all categories for dropdown in add form
        $kategoriJasa = Jasa::orderBy('jenis_jasa', 'asc')->get();

        // Get user and bengkel
        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        // Ambil semua data JasaService dengan relasi ke kategorinya untuk bengkel user yang login
        $query = JasaService::with('jasa');

        if ($bengkel) {
            $query->where('id_bengkel', $bengkel->id);
        } else {
            // If no bengkel, return empty paginated result
            $jasaServices = JasaService::whereNull('id_bengkel')->paginate(10);
            return view('tambalBan.jasa', compact('jasaServices', 'kategoriJasa'));
        }

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

        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        if (!$bengkel) {
            return redirect()->back()->with('error', 'Anda tidak memiliki bengkel yang terkait.');
        }

        JasaService::create([
            'jasa_id' => $validated['jasa_id'],
            'id_user' => $user->id,
            'id_bengkel' => $bengkel->id,
            'nama_jasa' => $validated['nama_jasa'],
            'harga_jasa' => $validated['harga_jasa'],
        ]);

        return redirect()->route('jasa.service')->with('success', 'Jasa service baru berhasil ditambahkan!');
    }

    public function editJasaService($id)
    {
        try {
            $user = Auth::user();
            $jasaService = JasaService::where('id', $id)
                ->where('id_user', $user->id)
                ->firstOrFail();

            $kategoriJasa = Jasa::orderBy('jenis_jasa', 'asc')->get();

            return view('tambalBan.edit_jasa', compact('jasaService', 'kategoriJasa'));
        } catch (\Exception $e) {
            Log::error('Error menampilkan form edit Jasa Service: ' . $e->getMessage());
            return redirect()->route('jasa.service')->with('error', 'Jasa Service tidak ditemukan atau Anda tidak memiliki izin.');
        }
    }

    public function updateJasaService(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $jasaService = JasaService::where('id', $id)
                ->where('id_user', $user->id)
                ->firstOrFail();

            $validated = $request->validate([
                'jasa_id' => 'required|exists:jasas,id',
                'nama_jasa' => 'required|string|max:255',
                'harga_jasa' => 'required|numeric|min:0',
            ]);

            $jasaService->update($validated);

            return redirect()->route('jasa.service')->with('success', 'Jasa Service berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error memperbarui Jasa Service: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui Jasa Service atau Anda tidak memiliki izin.');
        }
    }

    public function destroyJasaService($id)
    {
        try {
            $user = Auth::user();
            $jasaService = JasaService::where('id', $id)
                ->where('id_user', $user->id)
                ->firstOrFail();

            if ($jasaService->id_user !== $user->id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus jasa service ini.');
            }

            $jasaService->delete();

            return redirect()->route('jasa.service')->with('success', 'Jasa Service berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error menghapus Jasa Service: ' . $e->getMessage());
            return redirect()->route('jasa.service')->with('error', 'Gagal menghapus Jasa Service atau Anda tidak memiliki izin.');
        }
    }

    public function ratings(Request $request)
    {
        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        if (!$bengkel) {
            return view('tambalBan.rating', ['ratings' => collect([]), 'average_rating' => 0]);
        }

        $query = $bengkel->ratings()->with('user');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })->orWhere('ulasan', 'LIKE', "%{$search}%");
        }

        $ratings = $query->latest()->paginate(10);
        $average_rating = $bengkel->ratings()->avg('rating') ?? 0;

        return view('tambalBan.rating', compact('ratings', 'average_rating'));
    }
}