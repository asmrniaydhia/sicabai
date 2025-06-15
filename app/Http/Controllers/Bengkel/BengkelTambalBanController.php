<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BengkelTambalBanController extends Controller
{
    public function index()
    {
        $bengkelTambalBan = Bengkel::where('id_user', Auth::id())->first();
        return view('tambalBan.dashboard', compact('bengkelTambalBan'));
    }
}
