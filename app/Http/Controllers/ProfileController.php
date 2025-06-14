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
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}