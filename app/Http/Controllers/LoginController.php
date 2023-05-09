<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserBendungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.masuk');
    }

    public function actionlogin(Request $request)
    {
        $hitung_user = UserBendungan::where('email', $request->email)->where('aktif', 1)->count();
        if ($hitung_user > 0) {
            $password = $request->password;
            $user = UserBendungan::where('email', $request->email)->where('aktif',1)->first();
            if (!Hash::check($password, $user->password)) {
                return redirect('/login')->with('error', 'Login Gagal, Silahkan Hubungi Administrator');
            } else {
                Session::put([
                    'id_user' => $user->id_user,
                    'nama' => $user->nama,
                    'email' => $user->email,
                    'hp' => $user->hp,
                    'role'  => $user->role,
                    'id_desa'  => $user->id_desa,
                    'device_key'  => $user->device_key,
                    'aktif' => $user->aktif,
                    'login' => 1
                ]);
                return redirect('/')->with('success', 'Selamat Datang');
            }
        } else {
            return redirect('/login')->with('error', 'Login Gagal!!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
