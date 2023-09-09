<?php

namespace App\Http\Controllers;

use App\Models\DataBanjirBocor;
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
