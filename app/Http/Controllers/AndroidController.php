<?php

namespace App\Http\Controllers;

use App\Models\peta;
use Illuminate\Http\Request;

class AndroidController extends Controller
{
    public function petabanjir(){
        $data['peta'] = peta::where('aktif', 1)->first();
        // dd($data);
        return view('android.petabanjir.index', $data);
    }
    // public function petabanjir_asli(){
    //     return view('android.petabanjir.index_asli');
    // }
}
