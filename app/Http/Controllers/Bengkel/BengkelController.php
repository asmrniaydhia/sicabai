<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BengkelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('input-toko.dataToko'); // Correct view path
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->usertype !== 'bengkel' || Auth::user()->bengkel) {
            return redirect()->route('dashboard')->with('error', 'Akses tidak diizinkan.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|regex:/^[0-9]{10,13}$/',
            'jenis_bengkel' => 'required|in:service,tambal_ban',
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

        // Handle file upload
        $fotoPath = $request->file('foto_bengkel')->store('bengkel', 'public');

        // Create record with user ID
        Bengkel::create([
            'id_user' => Auth::id(),
            'nama' => $validated['nama'],
            'whatsapp' => $validated['whatsapp'],
            'jenis_bengkel' => $validated['jenis_bengkel'],
            'foto_bengkel' => $fotoPath,
            'alamat' => $validated['alamat'],
            'jasa_penjemputan' => $validated['jasa_penjemputan'],
            'jam_buka' => $validated['jam_buka'],
            'jam_tutup' => $validated['jam_tutup'],
            'hari_libur' => $validated['hari_libur'] ?? [],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
        ]);

        // Redirect based on jenis_bengkel
        if ($validated['jenis_bengkel'] === 'service') {
            return redirect()->route('bengkelService.dashboard')->with('success', 'Bengkel berhasil ditambahkan!');
        } else {
            return redirect()->route('tambalBan.dashboard')->with('success', 'Bengkel berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Placeholder untuk detail bengkel
        $bengkel = Bengkel::with('ratings.user')
            ->leftJoin('ratings', 'bengkel.id', '=', 'ratings.id_bengkel')
            ->select(
                'bengkel.*',
                DB::raw('COALESCE(AVG(ratings.rating), 0) as average_rating')
            )
            ->where('bengkel.id', $id)
            ->groupBy('bengkel.id')
            ->firstOrFail();

        return view('bengkel_detail', compact('bengkel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
