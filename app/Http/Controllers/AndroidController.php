<?php

namespace App\Http\Controllers;

use App\Models\DataBanjirBocor;
use App\Models\DataMukaAir;
use App\Models\pendukung;
use App\Models\peta;
use App\Models\Web_custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AndroidController extends Controller
{
    public function petabanjir()
    {
        $data['peta'] = peta::where('aktif', 1)->first();
        // dd($data);
        return view('android.petabanjir.index', $data);
    }

    public function tampilpetapilih($id){
        $check = DataBanjirBocor::where('id_banjir_bocor', $id)->count();
        if($check > 0){
            $data['id'] = $id;
            $data['trans'] = DataBanjirBocor::where('id_banjir_bocor', $id)->first();
            $data['peta'] = peta::all();
            if(empty($data['trans']->id_peta)){
                $data['gambar'] = "";
            }else{
                $data['gambar'] = peta::find($data['trans']->id_peta);
            }
        }elseif($check == 0){
            $data['id'] = $id;
            $data['trans'] = DataMukaAir::where('id_banjir_muka_air', $id)->first();
            $data['peta'] = peta::all();
            if (empty($data['trans']->id_peta)) {
                $data['gambar'] = "";
            } else {
                $data['gambar'] = peta::find($data['trans']->id_peta);
            }
        }
        // dd($data);
        session()->put('android_map', url()->full());
        return view('transaksi.android.peta', $data);
    }

    public function tampilmenu($id)
    {
        // $data['pendukung'] = pendukung::where('keterangan', $id)->get();
        // dd($data);
        $data['berkas'] = pendukung::where('keterangan', $id)->first();
        $data['url'] = Storage::url($data['berkas']->berkas);
        $data['tipedata'] = Storage::mimeType($data['berkas']->berkas);
        // dd($data);
        return view('transaksi.android.view', $data);
    }

    public function tampilfoto($id)
    {
        // $data['pendukung'] = pendukung::where('keterangan', $id)->get();
        // dd($data);
        $data['berkas'] = DataBanjirBocor::where('id_banjir_bocor', $id)->first();
        if(!empty($data['berkas']->file_1)){
            $data['url1'] = Storage::url($data['berkas']->file_1);
        }
        if(!empty($data['berkas']->file_2)){
            $data['url2'] = Storage::url($data['berkas']->file_2);
        }
        if(!empty($data['berkas']->file_3)){
            $data['url3'] = Storage::url($data['berkas']->file_3);
        }
        if(!empty($data['berkas']->file_4)){
            $data['url4'] = Storage::url($data['berkas']->file_4);
        }
        if(!empty($data['berkas']->file_5)){
            $data['url5'] = Storage::url($data['berkas']->file_5);
        }
        // $data['tipedata'] = Storage::mimeType($data['berkas']->berkas);
        // dd($data);
        return view('transaksi.android.foto', $data);
    }

    public function tampilmap($id)
    {
        // $data['pendukung'] = pendukung::where('keterangan', $id)->get();
        // dd($data);
        $data['peta'] = peta::where('id_peta', $id)->first();
        // dd($data);
        return view('android.notif.index', $data);
    }
}
