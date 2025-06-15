<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->usertype == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->usertype == 'bengkel') {
            if ($user->bengkel) {
                $jenisBengkel = $user->bengkel->jenis_bengkel;
                if ($jenisBengkel === 'service') {
                    return redirect()->route('bengkelService.dashboard');
                } elseif ($jenisBengkel === 'tambal_ban') {
                    return redirect()->route('tambalBan.dashboard');
                }
            } else {
                return redirect()->route('bengkel.input-toko');
            }
        }

        if ($user->usertype == 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect()->back()->withErrors(['login' => 'Role tidak dikenali.']);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
