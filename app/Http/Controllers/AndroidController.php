<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AndroidController extends Controller
{
    public function petabanjir(){
        return view('android.petabanjir.index');
    }
    public function petabanjir_asli(){
        return view('android.petabanjir.index_asli');
    }
}
