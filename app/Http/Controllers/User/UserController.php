<?php

namespace App\Http\Controllers\User;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mulai query dengan relasi ratings
        $query = Bengkel::leftJoin('ratings', 'bengkel.id', '=', 'ratings.id_bengkel')
            ->select(
                'bengkel.id',
                'bengkel.id_user',
                'bengkel.nama',
                'bengkel.foto_bengkel',
                'bengkel.jenis_bengkel',
                'bengkel.whatsapp',
                'bengkel.alamat',
                'bengkel.jam_buka',
                'bengkel.jam_tutup',
                'bengkel.hari_libur',
                'bengkel.jasa_penjemputan',
                'bengkel.latitude',
                'bengkel.longitude',
                DB::raw('COALESCE(AVG(ratings.rating), 0) as average_rating')
            )
            ->groupBy(
                'bengkel.id',
                'bengkel.id_user',
                'bengkel.nama',
                'bengkel.foto_bengkel',
                'bengkel.jenis_bengkel',
                'bengkel.whatsapp',
                'bengkel.alamat',
                'bengkel.jam_buka',
                'bengkel.jam_tutup',
                'bengkel.hari_libur',
                'bengkel.jasa_penjemputan',
                'bengkel.latitude',
                'bengkel.longitude'
            );

        // Filter berdasarkan jasa_penjemputan
        if ($request->filled('jasa_penjemputan')) {
            if ($request->jasa_penjemputan === 'ada') {
                $query->where('bengkel.jasa_penjemputan', 'ada');
            } elseif ($request->jasa_penjemputan === 'tidak_ada') {
                $query->where('bengkel.jasa_penjemputan', '!=', 'ada');
            }
        }

        // Filter berdasarkan jenis_bengkel
        if ($request->filled('jenis_bengkel')) {
            $query->where('bengkel.jenis_bengkel', $request->jenis_bengkel);
        }

        // Urutkan berdasarkan rating tertinggi
        if ($request->filled('sort_rating') && $request->sort_rating === 'desc') {
            $query->orderBy('average_rating', 'desc');
        }

        // Ambil data (batasi 10 jika tidak ada filter rating, atau ambil semua jika ada filter)
        $bengkels = $query->take(10)->get();

        return view('user.dashboard', compact('bengkels'));
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
        $bengkel = Bengkel::with(['ratings', 'barangs.sparepart', 'jasaService'])->findOrFail($id);

        return view('user.detail', compact('bengkel'));
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
