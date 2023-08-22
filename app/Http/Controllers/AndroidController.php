<?php

namespace App\Http\Controllers;

use App\Models\pendukung;
use App\Models\peta;
use App\Models\Web_custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AndroidController extends Controller
{
    public function petabanjir(){
        $data['peta'] = peta::where('aktif', 1)->first();
        // dd($data);
        return view('android.petabanjir.index', $data);
    }

    public function tampilmenu($id){
        // $data['pendukung'] = pendukung::where('keterangan', $id)->get();
        // dd($data);
        $data['berkas'] = pendukung::where('keterangan',$id)->first();
        $data['url'] = Storage::url($data['berkas']->berkas);
        $data['tipedata'] = Storage::mimeType($data['berkas']->berkas);
        // dd($data);
        return view('transaksi.android.view', $data);
    }
}
