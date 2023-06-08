<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
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
        // $useragent = $_SERVER['HTTP_USER_AGENT'];
        // $info = get_browser($useragent,true);
        // dd(gethostname());
        // dd(get_current_user());
        // dd($_SERVER['SERVER_SOFTWARE']);
        // $hitung_user = UserBendungan::where('email', $request->email)->where('aktif', 1)->count();
        $hitung_user = UserBendungan::where('email', $request->email)->count();
        if ($hitung_user > 0) {
            $password = $request->password;
            // $user = UserBendungan::where('email', $request->email)->where('aktif',1)->first();
            $user = UserBendungan::where('email', $request->email)->first();
            if (!Hash::check($password, $user->password)) {
                return redirect('/login')->with('error', 'Login Gagal, Silahkan Hubungi Administrator');
            } else {
                $role = UserBendungan::where('id_role', $user->id_role)->first();
                $count_device = $role->total_device;
                $device_set = Log::where('id_user', $role->id_user)->whereNotNull('mac_add')->count();
                // dd($count_device - $device_set);
                $nama_role = $role->role->nama_role;
                $device = Log::where('id_user', $role->id_user)->where('mac_add', trim(substr(shell_exec('getmac'), 159, 20)))->where('aktif', 1)->first();
                // dd($device);
                // $device = Log::where('id_log', $role->log->first()->id_log)->where('mac_add', trim(substr(shell_exec('getmac'), 159, 20)))->get();
                // dd($device);
                // dd($count_device-$device_set);
                if (empty($device)) {
                    if (($count_device - $device_set) != 0) {
                        // Log::where('id_user', $role->id_user)->whereNull('mac_add')->update(['mac_add' => trim(substr(shell_exec('getmac'), 159, 20))]);
                        Log::where('id_user', $role->id_user)->whereNull('mac_add')->first()->update(['mac_add' => trim(substr(shell_exec('getmac'), 159, 20)) , 'keterangan' => php_uname()]);
                        $device = Log::where('id_user', $role->id_user)->where('mac_add', trim(substr(shell_exec('getmac'), 159, 20)))->where('aktif', 1)->first();
                        Session::put([
                            'id_user' => $user->id_user,
                            'nama' => $user->nama,
                            'email' => $user->email,
                            'hp' => $user->hp,
                            'id_role'  => $user->id_role,
                            'nama_role'  => $nama_role,
                            'id_log'  => $device->id_log,
                            'mac'  => $device->mac_add,
                            'mac_aktif'  => $device->aktif,
                            'id_desa'  => $user->id_desa,
                            'total_device'  => $count_device,
                            'login' => 1
                        ]);
                        return redirect('/')->with('success', 'Selamat Datang');
                        // update(['mac_add' => trim(substr(shell_exec('getmac'), 159, 20))]);
                        // Log::firstOrCreate('');
                    } else {
                        return redirect('/login')->with('error', 'Device Anda tidak terdaftar, Hubungi Admin!!');
                    }
                }else if (!empty($device)) {
                    Session::put([
                        'id_user' => $user->id_user,
                        'nama' => $user->nama,
                        'email' => $user->email,
                        'hp' => $user->hp,
                        'id_role'  => $user->id_role,
                        'nama_role'  => $nama_role,
                        'id_log'  => $device->id_log,
                        'mac'  => $device->mac_add,
                        'mac_aktif'  => $device->aktif,
                        'id_desa'  => $user->id_desa,
                        'total_device'  => $count_device,
                        'login' => 1
                    ]);
                    return redirect('/')->with('success', 'Selamat Datang');
                }
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
