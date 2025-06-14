<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BengkelServiceController extends Controller
{
    public function index()
    {
        $bengkel = Bengkel::where('id_user', Auth::id())->first();
        return view('bengkelService.dashboard', compact('bengkel'));
    }
}
