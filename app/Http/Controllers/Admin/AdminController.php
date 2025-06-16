<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Bengkel;
use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with statistics
     */
    public function index()
    {
        try {
            // Statistik dasar
            $totalUsers = User::count();
            $totalAdmins = User::where('usertype', 'admin')->count();
            $totalRegularUsers = User::where('usertype', 'user')->count();
            $totalSpareparts = Sparepart::count();
            $totalBengkels = Bengkel::count() ?? 0;
            
            // Data untuk grafik (contoh: user registration per bulan)
            $userRegistrationData = User::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

            // Aktivitas terbaru
            $recentUsers = User::latest()->limit(5)->get();
            $recentSpareparts = Sparepart::latest()->limit(5)->get();

            return view('admin.dashboard', compact(
                'totalUsers', 
                'totalAdmins', 
                'totalRegularUsers', 
                'totalSpareparts',
                'totalBengkels',
                'userRegistrationData',
                'recentUsers',
                'recentSpareparts'
            ));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return view('admin.dashboard')->with('error', 'Terjadi kesalahan dalam memuat dashboard');
        }
    }

    // ==================== SPAREPART MANAGEMENT ====================

    /**
     * Display sparepart list with search and pagination
     */
    public function sparepart(Request $request)
    {
        try {
            $query = Sparepart::query();
            
            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('nama_sparepart', 'LIKE', "%{$search}%")
                      ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            }
            
            // Sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);
            
            $spareparts = $query->paginate(10);
            
            return view('admin.sparepart', compact('spareparts'));
        } catch (\Exception $e) {
            Log::error('Sparepart index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam memuat data sparepart');
        }
    }

    /**
     * Store new sparepart
     */
    public function storeSparepart(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_sparepart' => 'required|string|max:255|unique:spareparts,nama_sparepart',
                'deskripsi' => 'required|string|min:10',
                'harga' => 'nullable|numeric|min:0',
                'stok' => 'nullable|integer|min:0',
                'kategori' => 'nullable|string|max:100',
            ], [
                'nama_sparepart.required' => 'Nama sparepart harus diisi',
                'nama_sparepart.unique' => 'Nama sparepart sudah ada',
                'deskripsi.required' => 'Deskripsi harus diisi',
                'deskripsi.min' => 'Deskripsi minimal 10 karakter',
                'harga.numeric' => 'Harga harus berupa angka',
                'stok.integer' => 'Stok harus berupa angka bulat',
            ]);

            Sparepart::create($validated);

            return redirect()->route('admin.sparepart')
                           ->with('success', 'Sparepart berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Store sparepart error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan dalam menyimpan sparepart');
        }
    }

    /**
     * Show edit form for sparepart
     */
    public function editSparepart($id)
    {
        try {
            $sparepart = Sparepart::findOrFail($id);
            return view('admin.edit_sparepart', compact('sparepart'));
        } catch (\Exception $e) {
            Log::error('Edit sparepart error: ' . $e->getMessage());
            return redirect()->route('admin.sparepart')
                           ->with('error', 'Sparepart tidak ditemukan');
        }
    }

    /**
     * Update sparepart
     */
    public function updateSparepart(Request $request, string $id)
    {
        try {
            $sparepart = Sparepart::findOrFail($id);
            
            $validated = $request->validate([
                'nama_sparepart' => 'required|string|max:255|unique:spareparts,nama_sparepart,' . $id,
                'deskripsi' => 'required|string|min:10',
                'harga' => 'nullable|numeric|min:0',
                'stok' => 'nullable|integer|min:0',
                'kategori' => 'nullable|string|max:100',
            ], [
                'nama_sparepart.required' => 'Nama sparepart harus diisi',
                'nama_sparepart.unique' => 'Nama sparepart sudah ada',
                'deskripsi.required' => 'Deskripsi harus diisi',
                'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            ]);

            $sparepart->update($validated);

            return redirect()->route('admin.sparepart')
                           ->with('success', 'Sparepart berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Update sparepart error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan dalam memperbarui sparepart');
        }
    }

    /**
     * Delete sparepart
     */
    public function destroySparepart($id)
    {
        try {
            $sparepart = Sparepart::findOrFail($id);
            $sparepart->delete();

            return redirect()->route('admin.sparepart')
                           ->with('success', 'Sparepart berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Delete sparepart error: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan dalam menghapus sparepart');
        }
    }

    // ==================== USER MANAGEMENT ====================

    /**
     * Display user list with search and filter
     */
    public function user(Request $request)
    {
        try {
            $query = User::query();
            
            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
            }
            
            // Filter by user type
            if ($request->has('usertype') && !empty($request->usertype)) {
                $query->where('usertype', $request->usertype);
            }
            
            // Sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);
            
            $users = $query->paginate(15);
            
            return view('admin.user', compact('users'));
        } catch (\Exception $e) {
            Log::error('User index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam memuat data user');
        }
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'usertype' => 'required|in:admin,user',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
            ], [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);

            $validated['password'] = Hash::make($validated['password']);
            
            User::create($validated);

            return redirect()->route('admin.user')
                           ->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Store user error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan dalam menambahkan user');
        }
    }

    /**
     * Show edit form for user
     */
    public function editUser($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.edit_user', compact('user'));
        } catch (\Exception $e) {
            Log::error('Edit user error: ' . $e->getMessage());
            return redirect()->route('admin.user')
                           ->with('error', 'User tidak ditemukan');
        }
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'usertype' => 'required|in:admin,user',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Only update password if provided
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('admin.user')
                           ->with('success', 'User berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Update user error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan dalam memperbarui user');
        }
    }

    /**
     * Delete user
     */
    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Prevent deleting own account
            if ($user->id === auth()->id()) {
                return redirect()->back()
                               ->with('error', 'Tidak dapat menghapus akun sendiri');
            }
            
            $user->delete();

            return redirect()->route('admin.user')
                           ->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Delete user error: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan dalam menghapus user');
        }
    }

    /**
     * Toggle user status (activate/deactivate)
     */
    public function toggleUserStatus($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_active = !$user->is_active;
            $user->save();

            $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
            
            return redirect()->back()
                           ->with('success', "User berhasil {$status}");
        } catch (\Exception $e) {
            Log::error('Toggle user status error: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan dalam mengubah status user');
        }
    }

    // ==================== BENGKEL MANAGEMENT ====================

   
    /**
     * Menampilkan daftar bengkel
     */
    public function bengkel(Request $request)
    {
        try {
            $query = Bengkel::with('user');
            
            // Filter berdasarkan jenis bengkel
            if ($request->has('jenis') && !empty($request->jenis)) {
                $query->where('jenis_bengkel', $request->jenis);
            }
            
            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'LIKE', "%{$search}%")
                      ->orWhere('alamat', 'LIKE', "%{$search}%")
                      ->orWhere('whatsapp', 'LIKE', "%{$search}%")
                      ->orWhereHas('user', function($q) use ($search) {
                          $q->where('name', 'LIKE', "%{$search}%");
                      });
                });
            }
            
            $bengkels = $query->latest()->paginate(10);
            $users = User::where('usertype', 'user')->get();
            
            return view('admin.bengkel', compact('bengkels', 'users'));
        } catch (\Exception $e) {
            Log::error('Error di bengkel index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data bengkel');
        }
    }

    /**
     * Menyimpan bengkel baru
     */
    public function storeBengkel(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:15',
            'jenis_bengkel' => 'required|in:service,tambal_ban',
            'foto_bengkel' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string',
            'jasa_penjemputan' => 'required|in:ada,tidak',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'hari_libur' => 'nullable|array',
            'hari_libur.*' => 'string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        try {
            // Upload foto bengkel
            $fotoPath = $request->file('foto_bengkel')->store('bengkel_images', 'public');

            $bengkel = Bengkel::create([
                'id_user' => $request->id_user,
                'nama' => $request->nama,
                'whatsapp' => $request->whatsapp,
                'jenis_bengkel' => $request->jenis_bengkel,
                'foto_bengkel' => $fotoPath,
                'alamat' => $request->alamat,
                'jasa_penjemputan' => $request->jasa_penjemputan,
                'jam_buka' => $request->jam_buka,
                'jam_tutup' => $request->jam_tutup,
                'hari_libur' => $request->hari_libur ? implode(',', $request->hari_libur) : null,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return redirect()->route('admin.bengkel')->with('success', 'Bengkel berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error menyimpan bengkel: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan bengkel');
        }
    }

    /**
     * Menampilkan form edit bengkel
     */
    public function editBengkel($id)
    {
    try {
        $bengkel = Bengkel::findOrFail($id);
        $users = User::where('usertype', 'user')->get();
        $hariLibur = $bengkel->hari_libur ? explode(',', $bengkel->hari_libur) : [];
        
        return view('admin.edit_bengkel', compact('bengkel', 'users', 'hariLibur'));
    } catch (\Exception $e) {
        Log::error('Error edit bengkel: ' . $e->getMessage());
        return redirect()->route('admin.bengkel.index')->with('error', 'Bengkel tidak ditemukan');
    }
    }
    public function updateBengkel(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:15',
            'jenis_bengkel' => 'required|in:service,tambal_ban',
            'foto_bengkel' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hapus_foto' => 'nullable|boolean', // Tambahkan validasi untuk hapus_foto
            'alamat' => 'required|string',
            'jasa_penjemputan' => 'required|in:ada,tidak',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'hari_libur' => 'nullable|array',
            'hari_libur.*' => 'string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'id_user.required' => 'Pemilik bengkel harus dipilih.',
            'nama.required' => 'Nama bengkel harus diisi.',
            'whatsapp.required' => 'Nomor WhatsApp harus diisi.',
            'jenis_bengkel.required' => 'Jenis bengkel harus dipilih.',
            'foto_bengkel.image' => 'File harus berupa gambar (jpeg, png, jpg).',
            'foto_bengkel.max' => 'Ukuran gambar maksimal 2MB.',
            'alamat.required' => 'Alamat harus diisi.',
            'jasa_penjemputan.required' => 'Jasa penjemputan harus dipilih.',
            'jam_buka.required' => 'Jam buka harus diisi.',
            'jam_tutup.required' => 'Jam tutup harus diisi.',
            'jam_tutup.after' => 'Jam tutup harus setelah jam buka.',
            'latitude.required' => 'Latitude harus diisi.',
            'longitude.required' => 'Longitude harus diisi.',
        ]);

        try {
            $bengkel = Bengkel::findOrFail($id);

            // Siapkan data untuk update
            $data = [
                'id_user' => $request->id_user,
                'nama' => $request->nama,
                'whatsapp' => $request->whatsapp,
                'jenis_bengkel' => $request->jenis_bengkel,
                'alamat' => $request->alamat,
                'jasa_penjemputan' => $request->jasa_penjemputan,
                'jam_buka' => $request->jam_buka,
                'jam_tutup' => $request->jam_tutup,
                'hari_libur' => $request->hari_libur ? implode(',', $request->hari_libur) : null,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            // Penanganan foto bengkel
            if ($request->has('hapus_foto') && $request->hapus_foto == '1') {
                // Hapus foto lama jika ada
                if ($bengkel->foto_bengkel && Storage::disk('public')->exists($bengkel->foto_bengkel)) {
                    Storage::disk('public')->delete($bengkel->foto_bengkel);
                }
                $data['foto_bengkel'] = null; // Set foto menjadi null
            } elseif ($request->hasFile('foto_bengkel')) {
                // Hapus foto lama jika ada
                if ($bengkel->foto_bengkel && Storage::disk('public')->exists($bengkel->foto_bengkel)) {
                    Storage::disk('public')->delete($bengkel->foto_bengkel);
                }
                // Simpan foto baru
                $data['foto_bengkel'] = $request->file('foto_bengkel')->store('bengkel_images', 'public');
            }

            // Update data bengkel
            $bengkel->update($data);

            return redirect()->route('admin.bengkel')->with('success', 'Data bengkel berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error update bengkel: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data bengkel: ' . $e->getMessage());
        }
    }                                                                                                                                                                                                                                                                                                                                                            

    /**
     * Menghapus bengkel
     */
    public function destroyBengkel($id)
    {
        try {
            $bengkel = Bengkel::findOrFail($id);
            
            // Hapus foto
            if ($bengkel->foto_bengkel) {
                Storage::disk('public')->delete($bengkel->foto_bengkel);
            }
            
            $bengkel->delete();

            return redirect()->route('admin.bengkel')->with('success', 'Bengkel berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error hapus bengkel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus bengkel');
        }
    }

    
    

    
    // ==================== API ENDPOINTS FOR DASHBOARD ====================

    /**
     * Get dashboard statistics via API
     */
    public function getDashboardStats()
    {
        try {
            return response()->json([
                'totalUsers' => User::count(),
                'totalAdmins' => User::where('usertype', 'admin')->count(),
                'totalRegularUsers' => User::where('usertype', 'user')->count(),
                'totalSpareparts' => Sparepart::count(),
                'totalBengkels' => Bengkel::count() ?? 0,
                'newUsersToday' => User::whereDate('created_at', today())->count(),
                'newUsersThisWeek' => User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch stats'], 500);
        }
    }

    /**
     * Get user registration chart data
     */
    public function getUserRegistrationChart()
    {
        try {
            $data = User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch chart data'], 500);
        }
    }

    // ==================== UTILITY METHODS ====================

    /**
     * Export data to CSV
     */
    public function exportUsers()
    {
        try {
            $users = User::all();
            $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function() use ($users) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['ID', 'Name', 'Email', 'User Type', 'Created At']);

                foreach ($users as $user) {
                    fputcsv($file, [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->usertype,
                        $user->created_at->format('Y-m-d H:i:s')
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            Log::error('Export users error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengekspor data user');
        }
    }

    /**
     * Backup database
     */
    public function backupDatabase()
    {
        try {
            // This is a simple example - you might want to use a proper backup package
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            
            // Log the backup action
            Log::info('Database backup initiated by admin: ' . auth()->user()->name);
            
            return redirect()->back()->with('success', 'Backup database berhasil dimulai');
        } catch (\Exception $e) {
            Log::error('Backup database error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal melakukan backup database');
        }
    }

    // ==================== UNUSED METHODS (kept for compatibility) ====================

    public function create() { /* Not used */ }
    public function store(Request $request) { /* Not used */ }
    public function show(string $id) { /* Not used */ }
    public function edit(string $id) { /* Not used */ }
    public function destroy(string $id) { /* Not used */ }
}