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

        if (Auth::user()->usertype == 'admin'){
            return redirect(route('admin.dashboard'));
        }

        if (Auth::user()->usertype == 'bengkel') {
            if (Auth::user()->bengkel) {
                // User has a bengkel record, redirect to appropriate dashboard
                $jenisBengkel = Auth::user()->bengkel->jenis_bengkel;
                if ($jenisBengkel === 'service') {
                    return redirect()->route('bengkelService.dashboard');
                } elseif ($jenisBengkel === 'tambal_ban') {
                    return redirect()->route('tambalBan.dashboard');
                }
            } else {
                // No bengkel record, redirect to input form
                return redirect()->route('bengkel.input-toko');
            }
        }

        return redirect()->back();
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
