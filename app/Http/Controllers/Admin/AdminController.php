<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUsers = User::count(); // Semua user
        $totalAdmins = User::where('usertype', 'admin')->count(); // Jika pakai kolom 'role'
        $totalRegularUsers = User::where('usertype', 'user')->count(); // Misalnya user biasa

        return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'totalRegularUsers'));
    }

    public function sparepart()
    {
        //return view('admin.sparepart');
        $spareparts = Sparepart::all(); // Ambil semua sparepart
        return view('admin.sparepart', compact('spareparts'));

    }

    public function storeSparepart(Request $request)
    {
        $validated = $request->validate([
            'nama_sparepart' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Sparepart::create($validated);

        return redirect()->route('admin.sparepart')->with('success', 'Sparepart berhasil disimpan!');
    }

    public function editSparepart($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        return view('admin.edit_sparepart', compact('sparepart'));
    }

    public function destroySparepart($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->delete();

        return redirect()->route('admin.sparepart')->with('success', 'Sparepart berhasil dihapus.');
    }

    public function updateSparepart(Request $request, string $id)
    {
            $request->validate([
            'nama_sparepart' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $sparepart->nama_sparepart = $request->nama_sparepart;
        $sparepart->deskripsi = $request->deskripsi;
        $sparepart->save();

        return redirect()->route('admin.sparepart')->with('success', 'Sparepart berhasil diperbarui!');
    }


    public function user()
    {
        $users = User::all(); // pastikan kamu sudah import model User
        return view('admin.user', compact('users'));
    }

    public function bengkel()
    {
        return view('admin.bengkel'); // Pastikan file resources/views/admin/bengkel.blade.php ada
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
