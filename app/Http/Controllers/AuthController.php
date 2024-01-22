<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah dimiliki, silahkan login!',
            'nidn.unique' => 'NIDN sudah dimiliki, silahkan login!',
            'nidn.integer' => 'NIDN harus berupa angka',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
            // 'rePassword.required' => 'Konfirmasi Password tidak boleh kosong',
            // 'rePassword.same' => 'Konfirmasi Password tidak valid'
        ];

        $request->validate([
            'nidn' => 'required|integer|unique:users',
            // 'nm_karyawan' => 'required',
            'password' => 'required|min:8|max:16',
            // 'rePassword' => 'required|same:password',
        ], $messages);


        if ($request->nidn != null) {
            $user = User::create([
                'name' => $request->name,
                'nidn' => $request->nidn,
                'password' => Hash::make($request->password),

            ]);

            return redirect('/login');
        } else {
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/login');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ], $messages);

        $credentials = $request->only('name', 'password');

        // $credentials = [
        //     'name' => $request->name,
        //     'password' => $request->password,
        // ];

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            // return redirect('/rektorat/dashboard');

            if (Auth::user()->role == 'rektorat') {
                return redirect('rektorat/dashboard');
            } elseif (Auth::user()->role == 'fakultas') {
                return redirect('fakultas/dashboard');
            } elseif (Auth::user()->role == 'prodi') {
                return redirect('prodi/dashboard');
            } elseif (Auth::user()->role == 'dosen') {
                return redirect('dosen/dashboard');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('admin/dashboard');
            }
        } else {
            return back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Berhasil');
    }
}
