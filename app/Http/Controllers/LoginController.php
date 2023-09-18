<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\peta;
use App\Models\UserBendungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

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
        $hitung_user = UserBendungan::where('username', $request->email)->count();
        $hitung_email = UserBendungan::where('email', $request->email)->count();
        // dd($hitung_user);
        if ($hitung_user > 0) {
            $password = $request->password;
            // $user = UserBendungan::where('email', $request->email)->where('aktif',1)->first();
            $user = UserBendungan::where('username', $request->email)->first();
            if (!Hash::check($password, $user->password)) {
                return redirect('/login')->with('error', 'Login Gagal, Silahkan Hubungi Administrator');
            } else {
                $role = UserBendungan::where('id_role', $user->id_role)->first();
                //dd($role);
                $count_device = $role->total_device;
                $device_set = Log::where('id_user', $role->id_user)->whereNotNull('keterangan')->count();
                // dd($count_device - $device_set);
                $nama_role = $role->role->nama_role;
                $device = Log::where('id_user', $role->id_user)->where('keterangan', request()->header('user_agent'))->where('aktif', 1)->first();
                // $peta = peta::where('aktif', 1)->first();
                //dd($device);
                // $device = Log::where('id_log', $role->log->first()->id_log)->where('mac_add', trim(substr(shell_exec('getmac'), 159, 20)))->get();
                // dd($device);
                // dd($count_device-$device_set);
                if (empty($device)) {
                    if (($count_device - $device_set) != 0) {
                        // Log::where('id_user', $role->id_user)->whereNull('mac_add')->update(['mac_add' => trim(substr(shell_exec('getmac'), 159, 20))]);
                        $agent = new Agent();
                        $perangkat = $agent->device();
                        $platform = $agent->platform();
                        Log::where('id_user', $role->id_user)->whereNull('keterangan')->first()->update(['mac_add' => $platform , 'keterangan' => request()->header('user_agent')]);
                        $device = Log::where('id_user', $role->id_user)->where('mac_add', $platform)->where('aktif', 1)->first();
                        Session::put([
                            'id_user' => $user->id_user,
                            'nama' => $user->nama,
                            'email' => $user->email,
                            'hp' => $user->hp,
                            'id_role'  => $user->id_role,
                            'nama_role'  => $nama_role,
                            'id_log'  => $device->id_log,
                            'mac'  => $device->mac_add,
                            'device'  => $device->keterangan,
                            'mac_aktif'  => $device->aktif,
                            'id_desa'  => $user->id_desa,
                            'menu'  => $user->menu,
                            'total_device'  => $count_device,
                            // 'peta'  => $peta->id_peta,
                            // 'kategori_peta'  => $peta->kategori,
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
                        'device'  => $device->keterangan,
                        'mac_aktif'  => $device->aktif,
                        'id_desa'  => $user->id_desa,
                        'menu'  => $user->menu,
                        'total_device'  => $count_device,
                        // 'peta'  => $peta->id_peta,
                        // 'kategori_peta'  => $peta->kategori,
                        'login' => 1
                    ]);
                    return redirect('/')->with('success', 'Selamat Datang');
                }
            }
        } elseif($hitung_email > 0){
            $password = $request->password;
            // $user = UserBendungan::where('email', $request->email)->where('aktif',1)->first();
            $user = UserBendungan::where('email', $request->email)->first();
            if (!Hash::check($password, $user->password)) {
                return redirect('/login')->with('error', 'Login Gagal, Silahkan Hubungi Administrator');
            } else {
                $role = UserBendungan::where('id_role', $user->id_role)->first();
                //dd($role);
                $count_device = $role->total_device;
                $device_set = Log::where('id_user', $role->id_user)->whereNotNull('keterangan')->count();
                // dd($count_device - $device_set);
                $nama_role = $role->role->nama_role;
                $device = Log::where('id_user', $role->id_user)->where('keterangan', request()->header('user_agent'))->where('aktif', 1)->first();
                $peta = peta::where('aktif', 1)->first();
                //dd($device);
                // $device = Log::where('id_log', $role->log->first()->id_log)->where('mac_add', trim(substr(shell_exec('getmac'), 159, 20)))->get();
                // dd($device);
                // dd($count_device-$device_set);
                if (empty($device)) {
                    if (($count_device - $device_set) != 0) {
                        // Log::where('id_user', $role->id_user)->whereNull('mac_add')->update(['mac_add' => trim(substr(shell_exec('getmac'), 159, 20))]);
                        $agent = new Agent();
                        $perangkat = $agent->device();
                        $platform = $agent->platform();
                        Log::where('id_user', $role->id_user)->whereNull('keterangan')->first()->update(['mac_add' => $platform, 'keterangan' => request()->header('user_agent')]);
                        $device = Log::where('id_user', $role->id_user)->where('mac_add', $platform)->where('aktif', 1)->first();
                        Session::put([
                            'id_user' => $user->id_user,
                            'nama' => $user->nama,
                            'email' => $user->email,
                            'hp' => $user->hp,
                            'id_role'  => $user->id_role,
                            'nama_role'  => $nama_role,
                            'id_log'  => $device->id_log,
                            'mac'  => $device->mac_add,
                            'device'  => $device->keterangan,
                            'mac_aktif'  => $device->aktif,
                            'id_desa'  => $user->id_desa,
                            'menu'  => $user->menu,
                            'total_device'  => $count_device,
                            // 'peta'  => $peta->id_peta,
                            // 'kategori_peta'  => $peta->kategori,
                            'login' => 1
                        ]);
                        return redirect('/')->with('success', 'Selamat Datang');
                        // update(['mac_add' => trim(substr(shell_exec('getmac'), 159, 20))]);
                        // Log::firstOrCreate('');
                    } else {
                        return redirect('/login')->with('error', 'Device Anda tidak terdaftar, Hubungi Admin!!');
                    }
                } else if (!empty($device)) {
                    Session::put([
                        'id_user' => $user->id_user,
                        'nama' => $user->nama,
                        'email' => $user->email,
                        'hp' => $user->hp,
                        'id_role'  => $user->id_role,
                        'nama_role'  => $nama_role,
                        'id_log'  => $device->id_log,
                        'mac'  => $device->mac_add,
                        'device'  => $device->keterangan,
                        'mac_aktif'  => $device->aktif,
                        'id_desa'  => $user->id_desa,
                        'menu'  => $user->menu,
                        'total_device'  => $count_device,
                        // 'peta'  => $peta->id_peta,
                        // 'kategori_peta'  => $peta->kategori,
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
