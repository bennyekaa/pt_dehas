<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\UserBendungan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class DeviceController extends Controller
{
    public function index()
    {
        $data['device'] = UserBendungan::all();
        session()->put('device', url()->full());
        return view('master.device.index', $data);
    }

    public function lihat($id_user)
    {
        $data['login_device'] = Log::Where('id_user', decrypt($id_user))->get();
        session()->put('device_login', url()->full());
        // dd($data);
        return view('master.device.lihat', $data);
    }

    public function edit($id_user){
        $data['user'] = UserBendungan::find(decrypt($id_user));
        return view('master.device.edit',$data);
    }

    public function proses(Request $request){
        $datas = array();
        if($request->fungsi == 'Edit'){
            $user = UserBendungan::find($request->id_user);
            $old_device = $user->total_device;
            $hitung = $request->total_device;
            if($hitung < $old_device){
                return redirect(session('device'))->with('error', 'Anda Tidak Bisa Memasukkan Device Kurang Dari Total Awal !!');
            }else{
                $user->total_device = $request->total_device;
                $user->save();
                // dd($hitung-$old_device);
                for ($i=0; $i < $hitung-$old_device; $i++) {
                    $item = array();
                        $item['id_log'] = (string)Str::uuid();
                        $item['id_user'] = $request->id_user;
                        $item['created_at'] = date('Y-m-d H:i:s.U');
                        $item['created_by'] = session('nama');
                    array_push($datas, $item);
                }
                // dd($datas);
                DB::table('log')->insert($datas);
                return redirect(session('device'))->with('success', 'Berhasil Tambah Device');
            }
        }
    }

    public function reset($id_log)
    {
        $log = Log::where('id_log', decrypt($id_log))->first();
        if ($log->mac_add != trim(substr(shell_exec('getmac'), 159, 20))) {
            Log::where('id_log', decrypt($id_log))->update(['mac_add' => null, 'keterangan' => null]);
            return redirect(session('device_login'))->with('success', 'Berhasil Reset Device');
        } else {
            return redirect(session('device_login'))->with('error', 'Anda Tidak Bisa Ubah Perangkat Login Anda !!');
        }
    }

    public function hapus($id_log)
    {
        $log = Log::where('id_log', decrypt($id_log))->first();
        $user = $log->id_user;
        if ($log->mac_add != trim(substr(shell_exec('getmac'), 159, 20))) {
            $log->delete();
            $hitung_log = Log::where('id_user', $user)->count();
            UserBendungan::where('id_user', $user)->update(['total_device' => $hitung_log]);
            return redirect(session('device_login'))->with('success', 'Berhasil Hapus Device');
        } else {
            return redirect(session('device_login'))->with('error', 'Anda Tidak Bisa Ubah Perangkat Login Anda !!');
        }
    }

    public function status($id_log, $set)
    {
        $log = Log::where('id_log', decrypt($id_log))->first();
        if ($log->mac_add != trim(substr(shell_exec('getmac'), 159, 20))) {
            if ($set == 0) {
                Log::where('id_log', decrypt($id_log))->update(['aktif' => 0]);
                return redirect(session('device_login'))->with('success', 'Berhasil Mengubah Status');
            } else {
                Log::where('id_log', decrypt($id_log))->update(['aktif' => 1]);
                return redirect(session('device_login'))->with('success', 'Berhasil Mengubah Status');
            }
        } else {
            return redirect(session('device_login'))->with('error', 'Anda Tidak Bisa Ubah Perangkat Login Anda !!');
        }
    }
}
