<?php

namespace App\Http\Controllers\Bengkel;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BengkelTambalBanController extends Controller
{
    public function index()
    {
        return view('tambalBan.dashboard', compact('bengkelTambalBan'));
    }
}
