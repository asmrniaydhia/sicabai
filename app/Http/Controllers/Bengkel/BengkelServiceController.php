<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Barang;
use App\Models\Bengkel;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'merk' => 'required|string|max:100',
            'harga_jual' => 'required|numeric',
            'harga_jasa' => 'required|numeric',
            'stok' => 'required|integer',
            'id_bengkel' => 'required|exists:bengkel,id',
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
            'id_bengkel' => $bengkel->id,
            'merk' => $validated['merk'],
            'harga_jual' => $validated['harga_jual'],
            'harga_jasa' => $validated['harga_jasa'],
            'stok' => $validated['stok'],
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
{
    // Log the raw input for debugging
    Log::info('Raw WhatsApp Input: ' . $request->whatsapp);

    // Ambil bengkel berdasarkan id dan id_user yang sedang login
    $bengkel = Bengkel::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

    // Validate the request with strict WhatsApp format
    $validated = $request->validate([
        'nama' => 'required|string|max:100',
        'whatsapp' => 'required|regex:/^\+62[0-9]{9,12}$/', // Must start with +62 followed by 9-12 digits
        'foto_bengkel' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'alamat' => 'required|string',
        'jasa_penjemputan' => 'required|in:ada,tidak',
        'jam_buka' => 'required|date_format:H:i',
        'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
        'hari_libur' => 'nullable|array',
        'hari_libur.*' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'lat' => 'required|numeric|between:-90,90',
        'lng' => 'required|numeric|between:-180,180',
    ]);

    // No additional formatting; use the validated whatsapp as-is
    $whatsapp = $validated['whatsapp'];

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
        'whatsapp' => $whatsapp, // Use the validated whatsapp without modification
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
    public function edit($id)
    {
        // $barang = Barang::findOrFail($id);
        // $spareparts = Sparepart::all();
        // return view('bengkelService.edit_barang', compact('barang', 'spareparts'));
    }

    public function destroy($id)
    {
        // Barang::destroy($id);
        // return back()->with('success', 'Barang berhasil dihapus.');
    }

    public function ratings(Request $request)
    {
        $user = Auth::user();
        $bengkel = Bengkel::where('id_user', $user->id)->first();

        if (!$bengkel) {
            return view('bengkelService.ratings', ['ratings' => collect([]), 'average_rating' => 0]);
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

        return view('bengkelService.ratings', compact('ratings', 'average_rating'));
    }
}