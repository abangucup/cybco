<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        $kredensial = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($kredensial)) {
            $role = auth()->user()->role;
            if ($role == 'admin') {
                Alert::success('Berhasil Login', 'Anda Login Sebagai ' . $role);
                return redirect()->route('dashboard.admin');
            } elseif ($role == 'guru') {
                Alert::success('Berhasil Login', 'Anda Login Sebagai ' . $role);
                return redirect()->route('dashboard.guru');
            } else {
                Alert::success('Berhasil Login', 'Anda Login Sebagai ' . $role);
                return redirect()->route('dashboard.siswa');
            }
        }

        Alert::toast('Username atau Password tidak sesuai', 'error');
        return back();
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Berhasil Logout', 'success');
        return redirect()->route('home');
    }
}
