<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function status($id, $set){
        $peta = peta::find(decrypt($id));
        $peta->aktif = $set;
        $peta->updated_at = now();
        $peta->updated_by = session('username');
        $peta->save();
        if($set == 1){
            peta::where('id_peta','<>',decrypt($id))->update(['aktif' => 0]);
        }
        session()->put('peta', decrypt($id));
        return redirect(session('halaman_peta'))->with('success', 'Peta Aktif Diubah');
    }
}
