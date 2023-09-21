<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataBanjirBocor;
use App\Models\DataMukaAir;
use App\Models\peta;
use Illuminate\Http\Request;

class petaController extends Controller
{
    public function index(){
        $data['peta'] = peta::all();
        session()->put('halaman_peta', url()->full());
        // dd(session()->all());
        return view('master.peta.index', $data);
    }

    public function lihat($id){
        $data['berkas'] = peta::find(decrypt($id));
        return view('master.peta.lihat', $data);
    }

    public function status($id, $kirim){
        // $peta = peta::find(decrypt($id));
        // $peta->aktif = $set;
        // $peta->updated_at = date('Y-m-d H:i:s.U');
        // $peta->updated_by = session('username');
        // dd(decrypt($id));
        $check = DataBanjirBocor::where('id_banjir_bocor',decrypt($kirim))->count();
        if($check > 0){
            $data = DataBanjirBocor::find(decrypt($kirim));
            $data->id_peta = decrypt($id);
            $data->updated_at = date('Y-m-d H:i:s.U');
            $data->updated_by = 'Generate';
            $data->save();
        }else{
            $data = DataMukaAir::find(decrypt($kirim));
            // dd($data);
            $data->id_peta = decrypt($id);
            $data->updated_at = date('Y-m-d H:i:s.U');
            $data->updated_by = 'Generate';
            $data->save();
        }
        // $peta->save();
        // if($set == 1){
        //     peta::where('id_peta','<>',decrypt($id))->update(['aktif' => 0]);
        // }
        // return response()->json(['message' => 'Status berhasil diperbarui']);
        // session()->put('peta', decrypt($id));
        return redirect(session('current'))->with('success', 'Peta Telah Dipilih');
    }
    public function statusAndroid($id, $kirim){
        // $peta = peta::find($id);
        // $peta->aktif = $set;
        // $peta->updated_at = date('Y-m-d H:i:s.U');
        // $peta->updated_by = session('username');
        // dd(decrypt($id));
        $check = DataBanjirBocor::where('id_banjir_bocor',$kirim)->count();
        if($check > 0){
            $data = DataBanjirBocor::find($kirim);
            $data->id_peta = $id;
            $data->updated_at = date('Y-m-d H:i:s.U');
            $data->updated_by = 'Generate';
            $data->save();
        }else{
            $data = DataMukaAir::find($kirim);
            // dd($data);
            $data->id_peta = $id;
            $data->updated_at = date('Y-m-d H:i:s.U');
            $data->updated_by = 'Generate';
            $data->save();
        }
        // $peta->save();
        // if($set == 1){
        //     peta::where('id_peta','<>',decrypt($id))->update(['aktif' => 0]);
        // }
        // return response()->json(['message' => 'Status berhasil diperbarui']);
        // session()->put('peta', decrypt($id));
        return redirect(session('android_map'));
    }
}
