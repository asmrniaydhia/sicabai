<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan pengguna terautentikasi dan memiliki usertype 'user'
        if (!Auth::check() || Auth::user()->usertype !== 'user') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memberikan ulasan.');
        }

        // Validasi input
        $validated = $request->validate([
            'id_bengkel' => 'required|exists:bengkel,id',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|min:5|max:1000',
        ]);

        // Simpan ulasan
        Rating::create([
            'id_user' => Auth::id(),
            'id_bengkel' => $validated['id_bengkel'],
            'rating' => $validated['rating'],
            'ulasan' => $validated['ulasan'],
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
