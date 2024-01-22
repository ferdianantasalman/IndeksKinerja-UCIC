<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Landing
    public function landing()
    {
        // $data = auth()->user();
        return view('guest.index');
    }

    // Rektorat
    public function admin()
    {
        $data = auth()->user();
        return view('admin.dashboard')->with(['data' => $data]);
    }

    // Rektorat
    public function rektorat()
    {
        $data = auth()->user();
        return view('rektorat.dashboard.index')->with(['data' => $data]);
    }

    // Fakultas
    public function fakultas()
    {
        $data = Auth::user();

        return view('fakultas.dashboard.index')->with(['data' => $data]);
    }

    // Prodi
    public function prodi()
    {
        $data = Auth::user();

        return view('prodi.dashboard.index')->with(['data' => $data]);
    }

    // Dosen
    public function dosen()
    {
        // $data = auth()->user();
        $data = Auth::user();

        return view('dosen.dashboard.index')->with(['data' => $data]);
    }
}
