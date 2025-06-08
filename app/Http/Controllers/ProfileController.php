<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.view-profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $hasChanges = false;

        // Validasi file gambar terlebih dahulu jika ada
        if ($request->hasFile('profile_photo')) {
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }

        // Update data profil lainnya (nama, email, dll)
        $user->fill($request->validated());

        // Cek apakah ada perubahan pada nama atau email
        if ($user->isDirty('name') || $user->isDirty('email')) {
            $hasChanges = true;
        }

        // Jika email diubah, set null untuk verified_at
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Simpan path foto lama untuk dihapus nanti
            $oldPhotoPath = $user->profile_photo;

            // Simpan file gambar baru
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');

            // Update path gambar di database
            $user->profile_photo = $path;
            $hasChanges = true;

            // Hapus gambar lama setelah gambar baru berhasil disimpan
            if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }
        }



        // Update password jika ada input password baru
        if ($request->filled('new_password')) {
            // Validasi password lama
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            // Memastikan bahwa password lama yang dimasukkan sesuai
            if (!Hash::check($request->current_password, $user->password)) {
                return Redirect::route('profile.edit')
                    ->withErrors(['current_password' => 'Kata sandi lama tidak sesuai.'])
                    ->withInput();
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $hasChanges = true;
        }

        // Simpan perubahan hanya jika ada perubahan
        if ($hasChanges) {
            $user->save();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } else {
            // Jika tidak ada perubahan, kembali tanpa pesan sukses
            return Redirect::route('profile.edit');
        }
    }

    /**
     * Remove the user's profile photo.
     */
    public function removePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->profile_photo) {
            // Hapus file foto dari storage
            if (Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Set profile_photo menjadi null di database
            $user->profile_photo = null;
            $user->save();
            
            return Redirect::route('profile.edit')->with('status', 'photo-removed');
        }
        
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus foto profil saat menghapus akun
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}